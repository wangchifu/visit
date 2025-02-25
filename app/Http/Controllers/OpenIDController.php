<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolData;
use App\User;
use Illuminate\Support\Facades\Auth;

// RP申請獲得
define('CLIENT_ID', env('CLIENT_ID'));
define('CLIENT_SECRET', env('CLIENT_SECRET'));
//
define('AUTH_SECRET', '');
//define('REDIR_URI0', 'http://openid.zipko.info/callback.php');
define('REDIR_URI0', 'https://visit.chc.edu.tw/auth/callback');
define('WELL_KNOWN_URL', 'https://chc.sso.edu.tw/.well-known/openid-configuration');
// 預設0由設定檔的URL決定；設定為1則每次皆由WELL_KNOWN取回END POINT URL
define('DYNAMICAL_ENDPOINT', 0);
// DYNAMICAL_ENDPOINT設為0下方三項需填寫
define('AUTH_ENDPOINT', 'https://chc.sso.edu.tw/oidc/v1/azp');
define('TOKEN_ENDPOINT', 'https://chc.sso.edu.tw/oidc/v1/token');
define('USERINFO_ENDPOINT', 'https://chc.sso.edu.tw/oidc/v1/userinfo');
define('JWKS_URI', 'https://chc.sso.edu.tw/oidc/v1/jwksets');
//
// PROFILE URL
define('PROFILE_ENDPOINT', 'https://chc.sso.edu.tw/moeresource/api/v1/oidc/profile');

class OpenIDController extends Controller
{
    public function sso(){
        //session_start();
        $obj= new openid();
        session(['azp_state'=>rand(0,9999999)]);
        if(!session()->has('nonce')){
            session(['nonce'=>base64_encode(session('azp_state'))]);
        }else{
            session(['nonce'=>session('nonce')]);
        }

        //$_SESSION['azp_state']=rand(0,9999999); //隨機產生state值
        //$_SESSION['nonce']=isset($_SESSION['nonce'])? $_SESSION['nonce']:base64_encode($_SESSION['azp_state']);

        $auth_ep=AUTH_ENDPOINT;
        if(DYNAMICAL_ENDPOINT){
            $auth_ep=$ep->getEndPoint()->authorization_endpoint;
        }
        $link = $auth_ep . "?response_type=code&client_id=". CLIENT_ID ."&redirect_uri=".urlencode(REDIR_URI0) ."&scope=openid+email+profile+eduinfo+personid&state=".session('azp_state')."&nonce=".session('nonce');
    //       dd($link);
        return redirect($link);

    }

    public function callback(Request $request){
      $code= $_GET['code'];
      $state= $_GET['state'];
      
      //驗證 $state
      if( !isset($_GET['code']) ||  !isset($_GET['state'])){
        die ("認證伺服器回傳結果失敗！");
      }
      
      if( strcmp($state, session('azp_state'))){
        die ("錯誤的認證狀態，請重新嘗試！");
      }      
      
      $obj= new openid();
      
      $token_ep=TOKEN_ENDPOINT;
      if(DYNAMICAL_ENDPOINT){
         $token_ep=$ep->getEndPoint()->token_endpoint;
      }
      
      $acctoken= $obj->getAccessToken($token_ep ,$code, REDIR_URI0);
      if( !$acctoken || !isset($acctoken->access_token) ) {
        die ("無法取得ACCESS TOKEN");
      }
      // 把access token, id_token記到session中
      // 未來需要取得其他scope再用此access token 來做
      session(['access_token'=>$acctoken->access_token]);
      session(['id_token'=>$acctoken->id_token]);
      
        //驗證 access token
      if(!session()->has('access_token')){
        die ("無存取用權杖，無法取回使用者資料！");
      }

      //取回access token
      //include "config.php";
      //include "library.class.php";
      //$obj= new openid();

      $token_ep2=USERINFO_ENDPOINT;
      if(DYNAMICAL_ENDPOINT){
        $token_ep2=$ep->getEndPoint()->userinfo_endpoint;
      }

      $userinfo = $obj->getUserinfo($token_ep2 ,session('access_token'), true);
      $profile = $obj->getUserinfo("https://chc.sso.edu.tw/cncresource/api/v1/personid" ,session('access_token'), true);
      $edufile = $obj->getUserinfo("https://chc.sso.edu.tw/cncresource/api/v1/eduinfo" ,session('access_token'), true);
      if( !$userinfo) {
        die ("無法取得 USER INFO");
      }


      // 把access token記到session中
      //print_r($userinfo);
      //echo "<hr>";
      //print_r($profile);      
      //echo "<hr>";
      //print_r($edufile);      
      //die();
      $schools_name = config('app.schools_name');


      $user_obj['username'] = $userinfo['sub'];
      $user_obj['password'] = "openID";
      $user_obj['success'] = 1;            
      $user_obj['name'] = $userinfo['name'];      
      $user_obj['personid'] = $profile['personid'];
      $user_obj['edu_key'] = $user_obj['personid'];
      $user_obj['uid'] = "openID";
      $user_obj['code'] = $edufile['schoolid'];
      $user_obj['school'] =$schools_name[$user_obj['code']];
      $user_obj['kind'] = $edufile['titles'][0]['titles'][0];      
      $user_obj['title'] = $edufile['titles'][0]['titles'][1];


      session(['Gsuite' => $user_obj]);
      session(['username'=>$user_obj['username']]);
      session(['password'=>$user_obj['password']]);
      session(['pwd'=>$user_obj['password']]);
      

        //學生禁止訪問
        if ($user_obj['success']) {
            if ($user_obj['kind'] == "學生") {
                abort(403, '僅限國中小教職員登入');
            }           
            
            //session(['Gsuite' => $user_obj]);
            session(['username'=>$user_obj['username']]);
            session(['password'=>$user_obj['password']]);
            session(['pwd'=>$user_obj['password']]);
            session(['name'=>$user_obj['name']]);
            session(['code'=>$user_obj['code']]);            
            session(['school_name'=>$schools_name[$user_obj['code']]]);
            //session(['pwd'=>bcrypt($user_obj['password'])]);

            //是否已有此帳號
            $school_data = SchoolData::where('edu_key', $user_obj['personid'])                
                ->first();

            if (empty($school_data)) {
                return redirect()->route('gsuite.register');                      
            } else {                
                //更新密碼
                $att['password'] = $user_obj['password'];
                $att['name'] = $user_obj['name'];
                $school_data->user->update($att);
                
                //更新學校資料
                $att2['school_code'] = $user_obj['code'];                
                $att2['school_name'] = $schools_name[$user_obj['code']];
                $att2['kind'] = $user_obj['kind'];
                $att2['title'] = $user_obj['title'];
                $att2['edu_key'] = $user_obj['personid'];
                $att2['uid'] = "no uid";
                //dd($att2);
                //$att2['user_id'] = $school_data->user->id;
                $school_data->update($att2);
                
                Auth::login($school_data->user);
                return redirect()->route('index');                                                             
            }            
        
        };      

    }
}

class openid {
    /**
     *
    */
    public function getEndPoint($rtn_array=false){
      $options = array(
        'http' => array(
          'header'  => '',
          'method'  => 'GET',
          'content' => ''
        ));
      $context = stream_context_create($options);
      $result = file_get_contents(WELL_KNOWN_URL, false, $context);
      $u= json_decode($result, $rtn_array);
      return $u; //object
    }
  
    public function getAccessToken($token_ep='' ,$code='', $redir_uri='' ,$rtn_array=false){
      $hash = base64_encode( CLIENT_ID . ":" . CLIENT_SECRET);
      $data = array('grant_type' => 'authorization_code', 'code'=> $code,
        'redirect_uri' => $redir_uri);
      $header= array( "Content-type: application/x-www-form-urlencoded",
         "Authorization: Basic $hash" ) ;
      $options = array(
          'http' => array(
            'header'  => $header,
            'method'  => 'POST',
            'content' => http_build_query($data)
          ));
      $context = stream_context_create($options);
      $result = file_get_contents($token_ep, false, $context);
      $j= json_decode($result, $rtn_array);
      return $j;
    }
    public function getModnExp($jwks_uri){
      $options = array(
        'http' => array(
          'header'  => '',
          'method'  => 'GET',
          'content' => ''
        ));
      $context = stream_context_create($options);
      $result = file_get_contents($jwks_uri, false, $context);
      $u= json_decode($result, true);
      return $u; //object
    }
   
    public function getUserinfo($token_ep='' ,$accesstoken='',$rtn_array=false){
      $header= array( "Authorization: Bearer $accesstoken" );
      $options = array(
          'http' => array(
            'header'  => $header,
            'method'  => 'GET',
            'content' => ''
          ));
      $context = stream_context_create($options);
      $result = file_get_contents($token_ep, false, $context);
      $u= json_decode($result,$rtn_array);
      return $u;
    }
    public function urlsafeB64Encode($input)
    {
      return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }
  
    public function urlsafeB64Decode($input)
    {
      $remainder = strlen($input) % 4;
      if ($remainder) {
         $padlen = 4 - $remainder;
         $input .= str_repeat('=', $padlen);
      }
      return base64_decode(strtr($input, '-_', '+/'));
    }
   
  
  }