<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PlaceData;
use App\User;
use App\VendorData;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //改以username登入，非email
    public function username()
    {
        return 'username';
    }

    /**
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );

    }
     * **/

    public function attemptLogin(Request $request)
    {
        if (Auth::attempt([
            'username' => $request->input('username'),
            'password'=>$request->input('password'),
            'disable' => null,
            'login_type'=>'local',
        ])) {
            // 如果認證通過...
            return redirect()->intended('dashboard');
        }else{
            $user = User::where('username',$request->input('username'))
                ->where('login_type','local')
                ->first();

            if(empty($user)){
                $words = "無此主機帳號，若為學校端請以 Gsuite 登入";
            }else{
                if(password_verify($request->input('password'), $user->password)){
                    if($user->disable == "1"){
                        $words = "你被停權了！";
                    }elseif($user->disable == "2" and $user->login_type=="local"){
                        $words = "等候審核中...";
                    }
                }else{
                    $words = "密碼錯誤！若為「國中小端」請由 Gsuite 登入";
                }
            }

            abort(403, $words);


        }
    }




    public function logout()
    {
        session(['Gsuite'=>""]);
        Auth::logout();
        return redirect()->route('index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function do_register(Request $request)
    {
        $check_user = User::where('username',$request->input('username'))
            ->where('login_type','local')
            ->first();
        if(!empty($check_user)){
            $words = $request->input('username') ." 這個帳號已經被使用了！";
            abort(403, $words);
        }

        //新增使用者
        $att['username'] = $request->input('username');
        $att['password'] = bcrypt($request->input('password'));
        $att['login_type'] = "local";
        $att['name'] = $request->input('name');
        $att['group_id'] = $request->input('group_id');
        $att['township'] = $request->input('township');
        $att['address'] = $request->input('address');
        $att['telephone_number'] = $request->input('telephone_number');
        $att['email'] = $request->input('email');
        $att['line_id'] = $request->input('line_id');
        $att['website'] = $request->input('website');
        $att['disable'] = "2";
        $user = User::create($att);

        $att2['vendor_name'] = $request->input('vendor_name');
        $att2['about'] = $request->input('about');
        $att2['user_id'] = $user->id;
        VendorData::create($att2);

        //查所有管理者
        $admins = User::where('group_id','1')
            ->get();
        $to = "";
        foreach($admins as $admin) {
            $to .= $admin->email . ",";
        }

        $to = substr($to,0,-1);
        $subject = env('APP_NAME')." 有新的註冊者，使用者編號[{$user->id}]";
        $body = $subject."，帳號「{$user->username}」，請上 ".env('APP_URL')." 查看並審核！";

        send_mail($to,$subject,$body);


        return redirect()->route('index');
    }



}
