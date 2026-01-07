<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Matchmaking;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class ZtansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where('disable',null)
        ->orderBy('active_date','DESC')
            ->paginate(20);
        $ztans = User::where('group_id',4)->get();
        $data = [
            'courses'=>$courses,
            'ztans'=>$ztans,
        ];
        return view('ztans.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        $start = str_replace('-','',$course->start_date);
        $stop = str_replace('-','',$course->stop_date);

        if(date('Ymd') > $stop or date('Ymd') < $start){
            $words = "不是報名時間內，無法報名！";

            return view('layouts.error',compact('words'));
        }
        $questions =[];
        $matchmaking = Matchmaking::where('course_id',$course->id)
            ->where('user_id',auth()->user()->id)
            ->first();
        $q=[];
        foreach($course->questions as $question){
            $q[$question->order_by][$question->id]['title'] = $question->title;
            $q[$question->order_by][$question->id]['type'] = $question->type;
            $q[$question->order_by][$question->id]['option'] = $question->option;
        }
        ksort($q);
        foreach($q as $k1=>$v1){
            foreach($v1 as $k2=>$v2){
                $questions[$k2]['title'] = $v2['title'];
                $questions[$k2]['type'] = $v2['type'];
                $questions[$k2]['option'] = $v2['option'];
            }
        }
        $data = [
            'course'=>$course,
            'matchmaking'=>$matchmaking,
            'questions'=>$questions
        ];
        return view('ztans.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answers = $request->input('answer');
        $att['answer'] = null;
        $all = [];
        if (!empty($answers)){
            foreach ($answers as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k1 => $v1) {
                        $att['answer'] .= $v1 . ",";
                    }
                    $att['answer'] = substr($att['answer'], 0, -1);
                } else {
                    $att['answer'] = $v;

                }


                $att['question_id'] = $k;
                $att['course_id'] = $request->input('course_id');
                $att['user_id'] = auth()->user()->id;
                $one = [
                    'answer' => $att['answer'],
                    'question_id' => $att['question_id'],
                    'course_id' => $att['course_id'],
                    'user_id' => $att['user_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                array_push($all, $one);
            }
            Answer::insert($all);
        }

        $att2['situation'] = "1";
        $att2['user_id'] = auth()->user()->id;
        $att2['course_id'] = $request->input('course_id');

        $test_m = Matchmaking::where('user_id',$att2['user_id'])
            ->where('course_id',$att2['course_id'])
            ->first();
        if(!empty($test_m->id)){
            $words = "你已經報名過了！請點其他連結離開！";
            return view('layouts.error',compact('words'));
        }

        $matchmaking = Matchmaking::create($att2);
        $course = Course::where('id',$att2['course_id'])->first();
        $to = $course->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名職探課程「".$course->course_name."」，媒合編號[{$matchmaking->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 審核！";

        //send_mail($to,$subject,$body);

        return redirect()->route('matchmakings.ztans_index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //點閱+1
        if(session('course'.$course->id) != 1){
            $att['views'] = $course->views+1;
            $course->update($att);
            session(['course'.$course->id=>1]);
        }
        $data = [
            'course'=>$course,
        ];
        return view('ztans.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function intro_ztan(User $user)
    {
        $courses = Course::where('disable',null)
        ->where('user_id',$user->id)
        ->orderBy('active_date','DESC')
            ->paginate(20);
        $ztans = User::where('group_id',4)->get();        

        $data = [
            'user'=>$user,
            'courses'=>$courses,
            'ztans'=>$ztans,
        ];

        return view('intro_ztan',$data);
    }
}
