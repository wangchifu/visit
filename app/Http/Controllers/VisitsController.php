<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\Matchmaking;
use App\SchoolData;
use App\User;
use App\Visit;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class VisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::where('id',auth()->user()->id)->first();
        $data = [
            'user'=>$user,
        ];
        //dd($user);
        return view('visits.index',$data);

        /*
        $visits = Visit::where('user_id',auth()->user()->id)
            ->orderBy('create_at','DESC')
            ->paginate(20);

        $data = [
            'visits'=>$visits,
        ];
        dd($data);
        return view('visits.index',$data);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tabs = ['0'=>''];
        $files = [];
        $n = count($tabs);
        $user = User::where('id',auth()->user()->id)->first();
        $data = [
            'tabs'=>$tabs,
            'n'=>$n,
            'user'=>$user,
            'files'=>$files,
        ];

        return view('visits.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitRequest $request)
    {
        $att['visit_name'] = $request->input('visit_name');
        $att['graduate'] = $request->input('graduate');
        $att['about'] = $request->input('about');
        $att['views'] = 0;
        $att['visits'] = 0;
        //$att['tabs'] = serialize($request->input('tabs'));
        $att['tabs'] = "";
        foreach($request->input('tabs') as $k => $v){
            $att['tabs'] .= $v.",";
        }
        $att['tabs'] = substr($att['tabs'],0,-1);

        $att['user_id'] = auth()->user()->id;

        //預設新增visit為不啟用，須經審核
        $att['disable'] = "1";

        $visit = Visit::create($att);


        //查所有管理者
        $admins = User::where('group_id','1')
            ->get();
        $to = "";
        foreach($admins as $admin) {
            $to .= $admin->email . ",";
        }

        $to = substr($to,0,-1);
        $subject = env('APP_NAME')." 有新的行程需被審核！行程編號[{$visit->id}]";
        $body = $subject." 行程名稱：「{$visit->visit_name}」，請上 ".env('APP_URL')." 查看並審核！";

        send_mail($to,$subject,$body);



        $folder = 'visits/'.$visit->id;

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

                $file->storeAs('public/' . $folder, $info['original_filename']);
                $file_path = storage_path('app/public/'.$folder.'/'.$info['original_filename']);

                $img = Image::make($file_path);

                $img->resize(800,null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                //$img->crop(800, 300,0,0);
                //$img->resize(800,600);
                $img->save($file_path);

            }
        }

        return redirect()->route('visits.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        //有無附件
        $files = get_files(storage_path('app/public/visits/'.$visit->id));

        $data = [
            'visit'=>$visit,
            'files'=>$files,
        ];
        return view('visits.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        $user = auth()->user();
        $tabs = explode(',',$visit->tabs);
        $n = count($tabs);
        //有無附件
        $files = get_files(storage_path('app/public/visits/'.$visit->id));
        $data = [
            'visit'=>$visit,
            'user'=>$user,
            'tabs'=>$tabs,
            'n'=>$n,
            'files'=>$files,
        ];

        return view('visits.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VisitRequest $request,Visit $visit)
    {

        if($visit->user_id != auth()->user()->id){
            $words = "你不是這行程的所有者！";
            return view('layouts.errors',compact('words'));
        }else{
            $att['visit_name'] = $request->input('visit_name');
            $att['graduate'] = $request->input('graduate');
            $att['about'] = $request->input('about');
            //$att['views'] = 0;
            //$att['visits'] = 0;
            //$att['tabs'] = serialize($request->input('tabs'));
            $att['tabs'] = "";
            foreach($request->input('tabs') as $k => $v){
                $att['tabs'] .= $v.",";
            }
            $att['tabs'] = substr($att['tabs'],0,-1);
            $att['user_id'] = auth()->user()->id;

            //預設修改visit後，為不啟用，須經審核
            $att['disable'] = "1";

            $visit->update($att);

            //查所有管理者
            $admins = User::where('group_id','1')
                ->get();
            $to = "";
            foreach($admins as $admin) {
                $to .= $admin->email . ",";
            }

            $to = substr($to,0,-1);
            $subject = env('APP_NAME')." 有行程經過修改需被審核！行程編號[{$visit->id}]";
            $body = $subject." 行程名稱「{$visit->visit_name}」，請上 ".env('APP_URL')." 查看並審核！";

            send_mail($to,$subject,$body);


            $folder = 'visits/'.$visit->id;

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

                    $file->storeAs('public/' . $folder, $info['original_filename']);
                    $file_path = storage_path('app/public/'.$folder.'/'.$info['original_filename']);

                    $img = Image::make($file_path);

                    $img->resize(800,null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    //$img->crop(800, 300,0,0);
                    //$img->resize(800,600);
                    $img->save($file_path);

                }
            }

            return redirect()->route('visits.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        if($visit->user_id != auth()->user()->id){
            $words = "你不是這行程的所有者！";
            return view('layouts.errors',compact('words'));
        }else{
            $folder = storage_path('app/public/visits/'.$visit->id);
            delete_dir($folder);

            Matchmaking::where('visit_id',$visit->id)->delete();
            $visit->delete();

            return redirect()->route('visits.index');
        }
    }

    public function file_delete($visit_id,$file)
    {
        $visit = Visit::where('id',$visit_id)->first();

        if($visit->user_id != auth()->user()->id){
            $words = "你想做什麼？";
            return view('layouts.errors',compact('words'));
        }
        $real_file = storage_path('app/public/visits/'.$visit_id."/".$file);
        if(file_exists($real_file)){
            unlink($real_file);
        }

        return redirect()->route('visits.edit',$visit_id);

    }


    public function my_visit()
    {
        $matchmakings = Matchmaking::where('user_id',auth()->user()->id)
            ->where('course_id',null)
            ->get();
        $groups = config('app.groups');
        $data = [
            'matchmakings'=>$matchmakings,
            'groups'=>$groups,
        ];
        return view('visits.my_visit',$data);
    }


    public function matching(Visit $visit)
    {

        $match_makings = Matchmaking::where('visit_id',$visit->id)->get();
        $show_match=[];
        foreach($match_makings as $match_making){
            $show_match[$match_making->user_id][$match_making->visit_id]['id'] = $match_making->id;
            $show_match[$match_making->user_id][$match_making->visit_id]['situation'] = $match_making->situation;
            $show_match[$match_making->user_id][$match_making->visit_id]['created_at'] = $match_making->created_at;
        }
        $had_users = Matchmaking::where('visit_id',$visit->id)
            ->groupBy('user_id')
            ->get();

        $i = 0 ;
        $users = [];
        foreach($had_users as $had_user){
            $users[$i] = $had_user->user_id;
            $i++;
        }
        //dd($users);
        if($users != null) {
            $school_datas = SchoolData::where('user_id',$users)->get();
            $data = [
                'show_match'=>$show_match,
                'visit'=>$visit,
                'users'=>$users,
                'school_datas'=>$school_datas,
            ];
        } else {
            $data = [
                'show_match'=>$show_match,
                'visit'=>$visit,
                'users'=>$users,
            ];
        }



        return view('visits.matching',$data);
    }

    public function pass(Matchmaking $matchmaking)
    {

        $att['situation'] = 2;
        $matchmaking->update($att);

        $to = $matchmaking->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名行程「".$matchmaking->visit->visit_name."」審核通過！媒合[{$matchmaking->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";

        send_mail($to,$subject,$body);


        $att2['visits'] = $matchmaking->visit->visits+1;
        $matchmaking->visit->update($att2);
        return redirect()->route('visits.matching',$matchmaking->visit_id);
    }

    public function no_pass(Matchmaking $matchmaking)
    {
        $to = $matchmaking->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名行程「".$matchmaking->visit->visit_name."」審核失敗，十分可惜！媒合編號[{$matchmaking->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";
        send_mail($to,$subject,$body);


        $att['situation'] = 3;
        if($matchmaking->visit->visits > 0){
            $att2['visits'] = $matchmaking->visit->visits-1;
            $matchmaking->visit->update($att2);
        }
        $matchmaking->update($att);



        return redirect()->route('visits.matching',$matchmaking->visit_id);
    }

    public function show_user(User $user,$visit_id)
    {
        $data = [
            'visit_id'=>$visit_id,
            'user'=>$user,
        ];
        return view('visits.show_user',$data);
    }

    public function del(Matchmaking $matchmaking)
    {
        $to = $matchmaking->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名職探課程「".$matchmaking->visit->visit_name."」遭刪除！媒合編號[{$matchmaking->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";

        send_mail($to,$subject,$body);

        $matchmaking->delete();
        return redirect()->route('visits.matching',$matchmaking->visit_id);
    }

    public function admin()
    {
        $visits = Visit::where('disable','1')->orderBy('id','DESC')->get();
        $data = [
            'visits'=>$visits
        ];
        return view('visits.admin',$data);
    }

    public function admin_show(Visit $visit)
    {

        $groups = config('app.groups');
        $townships = config('app.townships');
        $files = get_files(storage_path('app/public/visits/'.$visit->id));

        $data = [
            'townships' => $townships,
            'visit' => $visit,
            'groups' => $groups,
            'files' => $files,
        ];

        return view('visits.admin_show',$data);
    }

    public function admin_pass(Visit $visit)
    {

        $to = $visit->user->email;
        $subject = env('APP_NAME')." 送審行程審核通過！";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！行程編號[{$visit->id}]";
        send_mail($to,$subject,$body);


        $att['disable'] = null;
        $visit->update($att);


        return redirect()->route('visits.admin');
    }

    public function admin_back (Visit $visit)
    {

        $to = $visit->user->email;
        $subject = env('APP_NAME')." 送審行程遭退回，請修改後再送！行程編號[{$visit->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";
        send_mail($to,$subject,$body);


        $att['disable'] = "2";
        $visit->update($att);



        return redirect()->route('visits.admin');
    }

    public function admin_delete(Visit $visit)
    {
        $to = $visit->user->email;
        $subject = env('APP_NAME')." 送審行程遭刪除，請重新設計！行程編號[{$visit->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";

        send_mail($to,$subject,$body);


        $dir = storage_path('app/public/visits/'.$visit->id);
        delete_dir($dir);

        Matchmaking::where('visit_id',$visit->id)->delete();

        $visit->delete();


        return redirect()->route('visits.admin');
    }

}
