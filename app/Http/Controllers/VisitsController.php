<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\Matchmaking;
use App\SchoolData;
use App\User;
use App\Visit;
use App\VisitData;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

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
        $docx = [];
        $n = count($tabs);
        $user = User::where('id',auth()->user()->id)->first();
        $visit_careers = config('app.visit_careers');
        $data = [
            'tabs'=>$tabs,
            'n'=>$n,
            'user'=>$user,
            'files'=>$files,
            'docx'=>$docx,
            'visit_careers'=>$visit_careers,
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
        $att['visit_careers'] = $request->input('visit_careers');        
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

        //send_mail($to,$subject,$body);


    
        //處理學習單
        if($request->hasFile('docx')){
            $docx = $request->file('docx');
            $docx_info = [
                //'mime-type' => $file->getMimeType(),
                'original_filename' => $docx->getClientOriginalName(),
                'extension' => $docx->getClientOriginalExtension(),
                //'size' => $docx->getClientSize(),
            ];
            $docx->storeAs('public/visits_docx/'.$visit->id, $docx_info['original_filename']);            
        }

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
        $visit_careers = config('app.visit_careers');
        $data = [
            'visit'=>$visit,
            'files'=>$files,
            'visit_careers'=>$visit_careers,
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
        $visit_careers = config('app.visit_careers');
        
        //有無學習單
        $real_path = storage_path('app/public/visits_docx/'.$visit->id);
        $docx = get_files($real_path);
        $data = [
            'visit'=>$visit,
            'user'=>$user,
            'tabs'=>$tabs,
            'n'=>$n,
            'files'=>$files,
            'docx'=>$docx,
            'visit_careers'=>$visit_careers,
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
            $att['visit_careers'] = $request->input('visit_careers');       
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

            //send_mail($to,$subject,$body);


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

            //處理學習單
            if($request->hasFile('docx')){
                $docx = $request->file('docx');
                $docx_info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $docx->getClientOriginalName(),
                    'extension' => $docx->getClientOriginalExtension(),
                    //'size' => $docx->getClientSize(),
                ];
                if(is_dir(storage_path('app/public/visits_docx/'.$visit->id))){
                    delete_dir(storage_path('app/public/visits_docx/'.$visit->id));
                }
                
                $docx->storeAs('public/visits_docx/'.$visit->id, $docx_info['original_filename']);            
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
            if(is_dir($folder)){
                delete_dir($folder);
            }
            
            $folder2 = storage_path('app/public/visits_docx/'.$visit->id);
            if(is_dir($folder2)){
                delete_dir($folder2);
            }

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

    public function docx_delete($visit_id,$file)
    {
        $visit = Visit::where('id',$visit_id)->first();

        if($visit->user_id != auth()->user()->id){
            $words = "你想做什麼？";
            return view('layouts.errors',compact('words'));
        }
        $real_file = storage_path('app/public/visits_docx/'.$visit_id."/".$file);
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

        //send_mail($to,$subject,$body);


        $att2['visits'] = $matchmaking->visit->visits+1;
        $matchmaking->visit->update($att2);
        return redirect()->route('visits.matching',$matchmaking->visit_id);
    }

    public function no_pass(Matchmaking $matchmaking)
    {
        $to = $matchmaking->user->email;
        $subject = $matchmaking->user->school_data->school_name." ".$matchmaking->user->name."報名行程「".$matchmaking->visit->visit_name."」審核失敗，十分可惜！媒合編號[{$matchmaking->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";
        //send_mail($to,$subject,$body);


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

        //send_mail($to,$subject,$body);

        $matchmaking->delete();
        return redirect()->route('visits.matching',$matchmaking->visit_id);
    }

    public function admin()
    {
        //
        $visits = Visit::where('disable','1')->orderBy('id','DESC')->get();
        $visit_careers = config('app.visit_careers');
        $data = [
            'visits'=>$visits,
            'visit_careers'=>$visit_careers,
        ];
        return view('visits.admin',$data);
    }

    public function admin_all(Request $request)
    {
        //
        $page = $request->input('page');
        $visits = Visit::orderBy('id','DESC')->paginate(10);
        $visit_careers = config('app.visit_careers');
        $data = [
            'visits'=>$visits,
            'visit_careers'=>$visit_careers,
            'page'=>$page,
        ];
        return view('visits.admin_all',$data);
    }
    public function admin_list()
    {
        //
        
        $data = [

        ];
        return view('visits.admin_list',$data);
    }

    public function admin_list_download(Request $request)
    {
        $att = $request->all();
        //dd($att);
        $visit_careers = config('app.visit_careers');
        $visit_datas = VisitData::where('visit_date','>=',$att['start'])
        ->where('visit_date','<=',$att['stop'])
        ->orderBy('visit_date','DESC')
        ->get();

        if($att['action']=="action1"){
            $i=1;
            foreach($visit_datas as $visit_data){
                if(!empty($visit_data->matchmaking->visit)){
                    if($visit_data->matchmaking->visit->user->group_id=="16"){
                        $data[$i]['編號'] = $i;
                        if(empty($visit_data->matchmaking->visit->visit_careers)){
                            $data[$i]['相關類別及職群'] = "-";
                        }else{
                            $data[$i]['相關類別及職群'] = $visit_careers[$visit_data->matchmaking->visit->visit_careers];
                        }
                        $data[$i]['名稱'] = $visit_data->matchmaking->visit->visit_name;
                        $data[$i]['地址'] = $visit_data->matchmaking->visit->user->address;
                        $data[$i]['聯絡人'] = $visit_data->matchmaking->visit->user->name;
                        $data[$i]['服務電話'] = $visit_data->matchmaking->visit->user->telephone_number;
                        $visit_id = $visit_data->matchmaking->visit_id;
                        $docx = get_files(storage_path('app/public/visits_docx/'.$visit_id));
                        if(empty($docx[0])){
                            $data[$i]['提供課程教案或活動學習單'] = " ";
                        }else{
                            $data[$i]['提供課程教案或活動學習單'] = "V";
                        }
                        $data[$i]['最近一次參訪時間'] = $visit_data->visit_date;
                        if(empty($visit_data->user->school_data)){
                            $unit = " ";
                        }else{
                            $unit = $visit_data->user->school_data->school_name;
                        }
                        $data[$i]['參訪人員'] = $unit." 教職".$visit_data->teachers."名 帶領 ".$visit_data->grade." 學生".$visit_data->students."名";
                        $data[$i]['行程簡介'] = $visit_data->matchmaking->visit->about;
                        if(empty($visit_data->matchmaking->visit->user->vendor_data)){
                            $data[$i]['單位簡介'] = " ";
                        }else{
                            $data[$i]['單位簡介'] = $visit_data->matchmaking->visit->user->vendor_data->about;
                        }
                        $i++;   
                    }
                }
                                  
            }
            $data2 = [
                'data'=>$data,
            ];
            if($att['submit'] == "列出名冊"){
                return view('visits.admin_list_show',$data2);
            }
            if($att['submit'] == "下載 Excel"){
                $list = collect($data);
                return (new FastExcel($list))->download('1-建立及公告相關產(企)業參訪地點資訊.xlsx');
            }
            
        }

        if($att['action']=="action2"){
            $i=1;
            foreach($visit_datas as $visit_data){
                if(!empty($visit_data->matchmaking->visit)){
                    if($visit_data->matchmaking->visit->user->group_id=="32"){
                        $data[$i]['編號'] = $i;
                        if(empty($visit_data->matchmaking->visit->visit_careers)){
                            $data[$i]['相關類別及職群'] = "-";
                        }else{
                            $data[$i]['相關類別及職群'] = $visit_careers[$visit_data->matchmaking->visit->visit_careers];
                        }
                        $data[$i]['姓名'] = $visit_data->matchmaking->visit->user->name;
                        if(empty($visit_data->matchmaking->visit->user->vendor_data)){
                            $data[$i]['單位簡介'] = " ";
                        }else{
                            $data[$i]['單位簡介'] = $visit_data->matchmaking->visit->user->vendor_data->about;
                        }
                        $data[$i]['單位地址'] = $visit_data->matchmaking->visit->user->address;
                        $data[$i]['宣講時間'] = $visit_data->visit_date;
                        if(empty($visit_data->user->school_data)){
                            $unit = " ";
                        }else{
                            $unit = $visit_data->user->school_data->school_name;
                        }
                        $data[$i]['參加人員'] = $unit." 教職".$visit_data->teachers."名 帶領 ".$visit_data->grade." 學生".$visit_data->students."名";
                        $data[$i]['服務電話'] = $visit_data->matchmaking->visit->user->telephone_number;
                        $i++;
                    }
                }
            }
            
            $data2 = [
                'data'=>$data,
            ];
            if($att['submit'] == "列出名冊"){
                return view('visits.admin_list_show',$data2);
            }
            if($att['submit'] == "下載 Excel"){
                $list = collect($data);
                return (new FastExcel($list))->download('2-建立及公告職涯宣講人員名單.xlsx');
            }
        }

    }

    public function admin_edit(Visit $visit,$page=null)
    {
        //dd($page);
        if(is_null($page)) $page = 1;
        $user = auth()->user();
        $tabs = explode(',',$visit->tabs);
        $n = count($tabs);
        //有無附件
        $files = get_files(storage_path('app/public/visits/'.$visit->id));
        $visit_careers = config('app.visit_careers');
        
        //有無學習單
        $real_path = storage_path('app/public/visits_docx/'.$visit->id);
        $docx = get_files($real_path);
        $data = [
            'page'=>$page,
            'visit'=>$visit,
            'user'=>$user,
            'tabs'=>$tabs,
            'n'=>$n,
            'files'=>$files,
            'docx'=>$docx,
            'visit_careers'=>$visit_careers,
        ];

        return view('visits.admin_edit',$data);
    }

    public function admin_update(VisitRequest $request,Visit $visit)
    {
        $att['visit_careers'] = $request->input('visit_careers');       
        $att['visit_name'] = $request->input('visit_name');
        $att['graduate'] = $request->input('graduate');
        $att['about'] = $request->input('about');
        $page = $request->input('page');
        //$att['views'] = 0;
        //$att['visits'] = 0;
        //$att['tabs'] = serialize($request->input('tabs'));
        $att['tabs'] = "";
        foreach($request->input('tabs') as $k => $v){
            $att['tabs'] .= $v.",";
        }
        $att['tabs'] = substr($att['tabs'],0,-1);

        $visit->update($att);

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

        //處理學習單
        if($request->hasFile('docx')){
            $docx = $request->file('docx');
            $docx_info = [
                //'mime-type' => $file->getMimeType(),
                'original_filename' => $docx->getClientOriginalName(),
                'extension' => $docx->getClientOriginalExtension(),
                //'size' => $docx->getClientSize(),
            ];
            if(is_dir(storage_path('app/public/visits_docx/'.$visit->id))){
                delete_dir(storage_path('app/public/visits_docx/'.$visit->id));
            }
            
            $docx->storeAs('public/visits_docx/'.$visit->id, $docx_info['original_filename']);            
        }

        return redirect(url('visits/admin_all'.'?page='.$page));

    }

    public function admin_file_delete($visit_id,$page,$file)
    {
        $visit = Visit::where('id',$visit_id)->first();

        $real_file = storage_path('app/public/visits/'.$visit_id."/".$file);
        if(file_exists($real_file)){
            unlink($real_file);
        }

        return redirect(url('visits/'.$visit_id.'/admin_edit/'.$page));

    }

    public function admin_docx_delete($visit_id,$page,$file)
    {
        $visit = Visit::where('id',$visit_id)->first();

        $real_file = storage_path('app/public/visits_docx/'.$visit_id."/".$file);
        if(file_exists($real_file)){
            unlink($real_file);
        }

        return redirect(url('visits/'.$visit_id.'/admin_edit/'.$page));

    }

    public function admin_show(Visit $visit)
    {

        $groups = config('app.groups');
        $townships = config('app.townships');
        $files = get_files(storage_path('app/public/visits/'.$visit->id));
        $visit_careers = config('app.visit_careers');
        $data = [
            'townships' => $townships,
            'visit' => $visit,
            'groups' => $groups,
            'files' => $files,
            'visit_careers'=>$visit_careers,
        ];

        return view('visits.admin_show',$data);
    }

    public function admin_pass(Visit $visit)
    {

        $to = $visit->user->email;
        $subject = env('APP_NAME')." 送審行程審核通過！";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！行程編號[{$visit->id}]";
        //send_mail($to,$subject,$body);


        $att['disable'] = null;
        $visit->update($att);


        return redirect()->route('visits.admin');
    }

    public function admin_back (Visit $visit)
    {

        $to = $visit->user->email;
        $subject = env('APP_NAME')." 送審行程遭退回，請修改後再送！行程編號[{$visit->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";
        //send_mail($to,$subject,$body);


        $att['disable'] = "2";
        $visit->update($att);



        return redirect()->route('visits.admin');
    }

    public function admin_delete(Visit $visit)
    {
        $to = $visit->user->email;
        $subject = env('APP_NAME')." 送審行程遭刪除，請重新設計！行程編號[{$visit->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 確認！";

        //send_mail($to,$subject,$body);


        $dir = storage_path('app/public/visits/'.$visit->id);
        delete_dir($dir);

        Matchmaking::where('visit_id',$visit->id)->delete();

        $visit->delete();


        return redirect()->route('visits.admin');
    }

}
