<?php

namespace App\Http\Controllers;

use App\Http\Requests\GsuiteRequest;
use App\SchoolData;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GsuiteController extends Controller
{
    public function login()
    {
        return view('auth.G_login');
    }


    public function register()
    {
        return view('auth.G_register');
    }

    public function register_store(Request $request)
    {
        //建立新的本機帳號
        $att['username'] = session('username');
        $att['password'] = session('pwd');
        $att['login_type'] = "gsuite";
        $att['name'] = session('Gsuite')['name'];
        $att['group_id'] = "2";
        $att['township'] = $request->input('township');
        $att['address'] = $request->input('address');
        $att['telephone_number'] = $request->input('telephone_number');
        $att['email'] = $request->input('email');
        $att['line_id'] = $request->input('line_id');
        $att['website'] = $request->input('website');        
        $user = User::create($att);


        //建立學校資料

        $att2['school_code'] = session('Gsuite')['code'];
        $att2['school_name'] = session('Gsuite')['school'];
        $att2['kind'] = session('Gsuite')['kind'];
        $att2['title'] = session('Gsuite')['title'];
        $att2['edu_key'] = session('Gsuite')['edu_key'];
        $att2['uid'] = session('Gsuite')['uid'];
        $att2['user_id'] = $user->id;
        dd($att2);
        SchoolData::create($att2);

        if(Auth::attempt([
            'username' => session('username'),
            'password' => session('password'),
            'login_type'=>'gsuite',
            ])){
            return redirect()->route('index');
        }
    }


    public function auth(Request $request)
    {
        $data = array("email"=>$request->input('username'),"password"=>$request->input('password'));
        $data_string = json_encode($data);
        $ch = curl_init('https://school.chc.edu.tw/api/auth');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        $obj = json_decode($result,true);

        if($obj['success']) {
            //非國中小端，即登出
            $school = ['5','6','7','8'];
            //完全中學
            $per_j_school = ['071311','071317','074308','074313','074323','074328','074339'];
            if(!in_array(substr($obj['code'],3,1),$school)
                and !in_array($obj['code'],$per_j_school)
            ){
                session(['Gsuite'=>""]);
                abort(403, '僅限國中小端登入');
            }

            if($obj['kind'] != "教職員"){
                abort(403, '僅限國中小教職員登入');
            }


            session(['Gsuite' => $obj]);
            session(['username'=>$request->input('username')]);
            session(['password'=>$request->input('password')]);
            session(['pwd'=>bcrypt($request->input('password'))]);

            $user = User::where('username',$request->input('username'))
                ->where('login_type','gsuite')
                ->first();

            if(empty($user)){
                return redirect()->route('gsuite.register');
            }else{

                //更新密碼
                $att['password'] = session('pwd');
                $att['name'] = session('Gsuite')['name'];
                $user->update($att);

                //更新學校資料
                $att2['school_code'] = session('Gsuite')['code'];
                $att2['school_name'] = session('Gsuite')['school'];
                $att2['kind'] = session('Gsuite')['kind'];
                $att2['title'] = session('Gsuite')['title'];
                $att2['edu_key'] = session('Gsuite')['edu_key'];
                $att2['uid'] = session('Gsuite')['uid'];
                $att2['user_id'] = $user->id;
                if(empty($user->school_data)){
                    SchoolData::create($att2);
                }else{
                    $user->school_data->update($att2);
                }

                if(Auth::attempt(['username' => session('username'), 'password' => session('password')])){
                    return redirect()->route('index');
                }

            }
        };

        return back();
    }
}
