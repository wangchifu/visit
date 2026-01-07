<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Matchmaking;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where('user_id',auth()->user()->id)
            ->orderBy('active_date','DESC')
            ->paginate(20);
        $semester = get_date_semester(date('Y-m-d'));

        $data = [
            'courses'=>$courses,
            'semester'=>$semester,
        ];
        return view('courses.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att['start_date'] = $request->input(('start_date'));
        $att['active_date'] = $request->input(('active_date'));
        $att['stop_date'] = $request->input(('stop_date'));
        $att['semester'] = get_date_semester($att['active_date']);
        $att['active_place'] = $request->input(('active_place'));
        $att['course_name'] = $request->input(('course_name'));
        $att['about'] = $request->input(('about'));
        $att['tabs'] = $request->input(('tabs'));
        $att['user_id'] = auth()->user()->id;
        $att['views'] = 0;
        $att['visits'] = 0;
        $att['disable'] = 1;
        $course = Course::create($att);

        //處理檔案上傳
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];

                $file->storeAs('public/courses/' .$course->id, $info['original_filename']);

            }
        }


        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $q= [];
        foreach($course->questions as $question){
            $q[$question->order_by][$question->id]['title'] = $question->title;
            $q[$question->order_by][$question->id]['type'] = $question->type;
            $q[$question->order_by][$question->id]['option'] = $question->option;
        }
        ksort($q);
        $questions = [];
        foreach($q as $k1=>$v1){
            foreach($v1 as $k2=>$v2){
                $questions[$k2]['title'] = $v2['title'];
                $questions[$k2]['type'] = $v2['type'];
                $questions[$k2]['option'] = $v2['option'];
            }
        }
        $data = [
            'course'=>$course,
            'questions'=>$questions
        ];
        return view('courses.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $data = [
            'course'=>$course,
        ];
        return view('courses.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $att['start_date'] = $request->input(('start_date'));
        $att['active_date'] = $request->input(('active_date'));
        $att['stop_date'] = $request->input(('stop_date'));
        $att['active_place'] = $request->input(('active_place'));
        $att['course_name'] = $request->input(('course_name'));
        $att['about'] = $request->input(('about'));
        $att['tabs'] = $request->input(('tabs'));
        $course->update($att);

        //處理檔案上傳
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];

                $file->storeAs('public/courses/' .$course->id, $info['original_filename']);

            }
        }


        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if($course->user_id != auth()->user()->id){
            abort(403,'你沒有權限！');
        }
        Matchmaking::where('course_id',$course->id)->delete();
        Answer::where('course_id',$course->id)->delete();
        Question::where('course_id',$course->id)->delete();
        $course->delete();

        delete_dir(storage_path('app/public/courses/'.$course->id));

        return redirect()->route('courses.index');
    }

    public function active(Course $course)
    {
        if($course->user_id != auth()->user()->id){
            abort(403,'你沒有權限！');
        }
        $att['disable'] = ($course->disable==1)?null:1;
        $course->update($att);
        return redirect()->route('courses.index');
    }

    public function matching(Course $course)
    {
        $match_makings = Matchmaking::where('course_id',$course->id)
            ->get();
        $show_match=[];
        foreach($match_makings as $match_making){
            $show_match[$match_making->user_id][$match_making->course_id]['semester'] = $course->semester;
            $show_match[$match_making->user_id][$match_making->course_id]['id'] = $match_making->id;
            $show_match[$match_making->user_id][$match_making->course_id]['situation'] = $match_making->situation;
            $show_match[$match_making->user_id][$match_making->course_id]['date'] = $match_making->created_at;
        }

        $had_users = Matchmaking::where('course_id',$course->id)
            ->orderBy('id')
            ->groupBy('user_id')
            ->get();

        $i = 0 ;
        $users = [];
        foreach($had_users as $had_user){
            $users[$i] = $had_user->user_id;
            $i++;
        }

        //查此course有哪些學校申請同期課程
        $semester = $course->semester;
        $same_courses = Course::where('semester',$semester)
            ->get();
        $school_app = [];
        $school_pass = [];
        $school_back = [];
        foreach($same_courses as $same_course){
            foreach($same_course->matchmakings as $matchmaking){
                if(!isset($school_app[$matchmaking->user->school_data->school_name])) $school_app[$matchmaking->user->school_data->school_name] = 0;
                if(!isset($school_pass[$matchmaking->user->school_data->school_name])) $school_pass[$matchmaking->user->school_data->school_name] = 0;
                if(!isset($school_back[$matchmaking->user->school_data->school_name])) $school_back[$matchmaking->user->school_data->school_name] = 0;
                if($matchmaking->situation == 3){
                    $school_back[$matchmaking->user->school_data->school_name]++;
                }
                if($matchmaking->situation == 2){
                    $school_pass[$matchmaking->user->school_data->school_name]++;
                }
                if($matchmaking->situation == 1){
                    $school_app[$matchmaking->user->school_data->school_name]++;
                }
            }
        }

        $data = [
            'show_match'=>$show_match,
            'course'=>$course,
            //'questions'=>$questions,
            'users'=>$users,
            //'show_answers'=>$show_answers,
            'school_app'=>$school_app,
            'school_pass'=>$school_pass,
            'school_back'=>$school_back,
        ];
        return view('courses.matching',$data);
    }

    public function show_answer(Matchmaking $matchmaking)
    {

        $user = $matchmaking->user;

        $questions = Question::where('course_id',$matchmaking->course_id)
            ->orderBy('order_by')
            ->get();


        $answers = Answer::where('course_id',$matchmaking->course_id)
            ->get();

        $show_answers = [];
        foreach($answers as $answer){
            $show_answers[$answer->user_id][$answer->question_id] = $answer->answer;
        }


        $data = [
            'matchmaking'=>$matchmaking,
            'questions'=>$questions,
            'user'=>$user,
            'show_answers'=>$show_answers,
        ];
        return view('courses.show_answer',$data);
    }

    public function admin_store_answer(Request $request)
    {
        foreach($request->input('answer') as $k=>$v){
            $answer = Answer::where('id',$k)->first();
            $att['answer'] = $v;
            $answer->update($att);
        }

        echo "<body onLoad=\"window.close();\">";
    }


    public function download(Course $course)
    {
        $match_makings = Matchmaking::where('course_id',$course->id)
            ->where('situation','2')
            ->get();

        $question_data = [];

        foreach($course->questions as $question){
            $answers = Answer::where('question_id',$question->id)
                ->get();
                $question_data[$question->id] = $question->title;
            foreach($answers as $answer){
                $answer_data[$question->id][$answer->user_id] = $answer->answer;
            }
        }
        $q = ",";
        foreach($question_data as $k=>$v){
            $q .= $v.",";
        }
        $q = substr($q,0,-1);
        $csv = $course->course_name.",參加學校,職稱,聯絡人,電話{$q}\r\n";
        foreach($match_makings as $match_making){
            $a = ",";
            foreach($question_data as $k1=>$v1){
                $a .= $answer_data[$k1][$match_making->user_id].",";
            }
            $a = substr($a,0,-1);
            $csv .= ",".$match_making->user->school_data->school_name.",".$match_making->user->school_data->title.",".$match_making->user->name.",".$match_making->user->telephone_number."{$a}\r\n";
        }
        $filename = $course->course_name.".csv";
        header("Content-type: text/csv");
        header('Content-Type: text/csv;charset=utf-8');
        header("Content-Disposition: attachment; filename={$filename}");
        header("Pragma: no-cache");
        header("Expires: 0");


        echo $csv;
        die;

    }

    public function download_semester($semester)
    {
        $courses = Course::where('semester',$semester)->get();
        $csv = "";
        foreach($courses as $course){
            $match_makings = Matchmaking::where('course_id',$course->id)
                ->where('situation','2')
                ->get();

            $question_data = [];

            foreach($course->questions as $question){
                $answers = Answer::where('question_id',$question->id)
                    ->get();
                $question_data[$question->id] = $question->title;
                foreach($answers as $answer){
                    $answer_data[$question->id][$answer->user_id] = $answer->answer;
                }
            }
            $q = ",";
            foreach($question_data as $k=>$v){
                $q .= $v.",";
            }
            $q = substr($q,0,-1);
            $csv .= $course->course_name.",參加學校,職稱,聯絡人,電話{$q}\r\n";
            foreach($match_makings as $match_making){
                $a = ",";
                foreach($question_data as $k1=>$v1){
                    $a .= $answer_data[$k1][$match_making->user_id].",";
                }
                $a = substr($a,0,-1);
                $csv .= ",".$match_making->user->school_data->school_name.",".$match_making->user->school_data->title.",".$match_making->user->name.",".$match_making->user->telephone_number."{$a}\r\n";
            }
        }

        $filename = $semester.".csv";
        header("Content-type: text/csv");
        header('Content-Type: text/csv;charset=utf-8');
        header("Content-Disposition: attachment; filename={$filename}");
        header("Pragma: no-cache");
        header("Expires: 0");


        echo $csv;
        die;
    }

    public function pass(Matchmaking $matchmaking)
    {
        $att['situation'] = 2;
        $matchmaking->update($att);

        $to = $matchmaking->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名職探課程「".$matchmaking->course->course_name."」審核通過！媒合編號[{$matchmaking->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";

        //send_mail($to,$subject,$body);


        $att2['visits'] = $matchmaking->course->visits+1;
        $matchmaking->course->update($att2);
        return redirect()->route('courses.matching',$matchmaking->course_id);
    }

    public function no_pass(Matchmaking $matchmaking)
    {
        $att['situation'] = 3;
        if($matchmaking->course->visits > 0){
            $att2['visits'] = $matchmaking->course->visits-1;
            $matchmaking->course->update($att2);
        }
        $matchmaking->update($att);

        $to = $matchmaking->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名職探課程「".$matchmaking->course->course_name."」審核失敗，十分可惜！媒合編號[{$matchmaking->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";
        //send_mail($to,$subject,$body);

        return redirect()->route('courses.matching',$matchmaking->course_id);
    }

    public function del(Matchmaking $matchmaking)
    {
        $to = $matchmaking->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名職探課程「".$matchmaking->course->course_name."」已遭刪除，非常抱歉！媒合編號[{$matchmaking->id}]";
        $body = $subject." 請上網站 http://visit.chc.edu.tw 確認！";
        //send_mail($to,$subject,$body);

        Answer::where('user_id',$matchmaking->user_id)
            ->where('course_id',$matchmaking->course_id)
            ->delete();

        $matchmaking->delete();
        return redirect()->route('courses.matching',$matchmaking->course_id);
    }

    public function show_user(User $user,$course_id)
    {
        $data = [
            'course_id'=>$course_id,
            'user'=>$user,
        ];
        return view('courses.show_user',$data);
    }

    public function file_del($course_id,$file)
    {
        $del_file = storage_path('app/public/courses/'.$course_id.'/'.$file);
        unlink($del_file);
        return redirect()->route('courses.index');
    }
}
