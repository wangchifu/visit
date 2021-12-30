<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$users = User::all();
        //$users = User::orderBy('id')->paginate(2);
        $users = User::where('login_type','local')->paginate(10);
        //$page=($_GET[page])?$_GET[page]:NULL;
        $page=(Input::get('page'))?Input::get('page'):1;
        $data = [
            'users'=>$users,
            'page'=>$page,
        ];
        //return view('ztans.index',$data);
        return view('users.index',$data);
    }
    public function wait()
    {
        $users = User::where('login_type','local')
            ->where('disable','2')
            ->paginate(10);
        $page=(Input::get('page'))?Input::get('page'):1;
        $data = [
            'users'=>$users,
            'page'=>$page,
        ];
        return view('users.wait',$data);
    }
    public function ok()
    {
        $users = User::where('login_type','local')
            ->where('disable',null)
            ->paginate(10);
        $page=(Input::get('page'))?Input::get('page'):1;
        $data = [
            'users'=>$users,
            'page'=>$page,
        ];
        return view('users.ok',$data);
    }

    public function add_user()
    {
        return view('users.add_user');
    }

    public function all_user(Request $request)
    {
        $group_id = (empty($request->input('group_id')))?"1":$request->input('group_id');
        $users = User::where('group_id',$group_id)->get();

        $data = [
            'group_id'=>$group_id,
            'users'=>$users,
        ];

        return view('users.all_user',$data);
    }

    public function store_add_user(Request $request)
    {
        User::create([
            'username' => $request->input('username'),
            'password' => bcrypt(env('DEFAULT_USER_PWD')),
            'login_type'=>'local',
            'name' => $request->input('name'),
            'group_id'=>$request->input('group_id'),
        ]);

        return redirect()->route('users.index');
    }

    public function reset_pwd(User $user)
    {
        if($user->username == "admin"){
            $words = "不能動 admin ！";
            return view('layouts.error',compact('words'));
        }

        $att['password'] = bcrypt(env('DEFAULT_USER_PWD'));
        $user->update($att);
        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->username == "admin"){
            $words = "不能動 admin ！";
            return view('layouts.error',compact('words'));
        }

        $page=Input::get('page');
        $data=[
            'user'=>$user,
            'page'=>$page,
        ];
        return view('users.edit',$data);

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
 
    public function admin_update(Request $request, User $user)
    {
        $page=Input::post('page');
        //$att['disable']=NULL;
       // dd($request->all());
      //  die();
        $user->update($request->all());
        
        $group_id=$request->input('group_id');
        $user_id=$request->input('id');
        if ($group_id >= '8'){
			$att2['about'] = $request->input('about');
			$att2['vendor_name'] = $request->input('vendor_name');
			$att2['user_id'] =$user_id;
			$user->vendor_data->update($att2);
		}
        return redirect('users/index?page='.$page); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    public function destroy(User $user)
    {
        if($user->username == "admin"){
            $words = "不能動 admin ！";
            return view('layouts.error',compact('words'));
        }

      //dd($request->all());
      $page=(Input::get('page'))?Input::get('page'):1;
      //自己不能刪除自己
      if (auth()->user()->id ==$user->id) {return redirect('users/index?page='.$page); }
      //不刪除管理者
      if ($user->id==1) {return redirect('users/index?page='.$page); }

      //刪除含vendor_data的部分
      if ($user->group_id >= '8') {
		  $user->vendor_data->delete();		  
		  }
      $user->delete();

        $to = $user->email;
        $subject = env('APP_NAME')." 系統通知！使用者編號[{$user->id}]";
        $body = $subject."，你的帳號「{$user->username}」已遭刪除，請想一想哪出錯！，請上 ".env('APP_URL')." 查看！";

        send_mail($to,$subject,$body);

      return redirect('users/index?page='.$page); 
    }

    public function apply(User $user,$page)
    {
        if($user->username == "admin"){
            $words = "不能動 admin ！";
            return view('layouts.error',compact('words'));
        }
        //啟用或申請中
        if($user->disable =='2'){
            $att['disable']=NULL;
            $result = "已通過你的帳號申，使用者編號[{$user->id}]";
        }else{
            $att['disable']=2;
            $result = "退回你的帳號申請，使用者編號[{$user->id}]";
        }
        
        $user->update($att);

        $to = $user->email;
        $subject = env('APP_NAME')." ".$result;
        $body = $subject."，你的帳號已通過審核！，請上 ".env('APP_URL')." 查看！";

        send_mail($to,$subject,$body);

        return redirect('users/index?page='.$page); 
    }  

    public function info(Request $request)
    {
        
        $save_message=!empty($request->input('save_message'));
        $user = auth()->user();
        $school_data=($user->group_id==2)?auth()->user()->school_data:array();
        $data=[
            'user'=>$user,
            'school_data'=>$school_data,
            'save_message'=>$save_message,
        ];
        return view('users.edit_info',$data);
    }  

    
    public function info_update(Request $request)
    {
     
        $att['name'] = $request->input('name');
        $att['intro_ztan'] = $request->input('intro_ztan');
        $att['telephone_number'] = $request->input('telephone_number');
        $att['email'] = $request->input('email');
        $att['line_id'] = $request->input('line_id');
        if(!empty($request->input('password')))
            $att['password'] = bcrypt($request->input('password'));
        auth()->user()->update($att);
        
        return redirect('users/info?save_message=1'); 
    }    



}
