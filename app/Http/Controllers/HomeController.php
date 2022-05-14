<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{

    public function index()
    {
        //return view('index');
    }

    //顯示上傳之圖片
    public function getImg($path)
    {
        $path = str_replace('&', '/', $path);
        $path = storage_path('app/public/' . $path);
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function delFile($file, $url)
    {
        $file = str_replace('&', '/', $file);
        $url = str_replace('&', '/', $url);
        unlink(storage_path('app/public/' . $file));
        return redirect($url);
    }

    //下載已上傳之檔案
    public function getFile($file)
    {
        $file = str_replace('&', '/', $file);
        $file = storage_path('app/public/' . $file);
        return response()->download($file);
    }


    //檢查帳號是否被使用了
    public function check_local_user(Request $request)
    {
        $check_user = User::where('username', $request->input('username'))
            ->first();
        if (empty($check_user)) {
            $result = 'success';
        } else {
            $result = 'failed';
        }
        echo json_encode($result);
        return;
    }

    public function back()
    {
        return view('back');
    }

    public function pic()
    {
        $key = rand(10000, 99999);
        $back = rand(0, 9);
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);

        session(['chaptcha' => $key]);

        $cht = array(0 => "零", 1 => "壹", 2 => "貳", 3 => "參", 4 => "肆", 5 => "伍", 6 => "陸", 7 => "柒", 8 => "捌", 9 => "玖");
        //$cht = array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9");
        $cht_key = "";
        for ($i = 0; $i < 5; $i++) $cht_key .= $cht[substr($key, $i, 1)];

        header("Content-type: image/gif");
        $images = asset('images/captcha_bk/captcha_bk' . $back . '.gif');

        $context = stream_context_create([
            "ssl" => [
                "verify_peer"      => false,
                "verify_peer_name" => false
            ]
        ]);

        $fileContent = file_get_contents($images, false, $context);
        $im = imagecreatefromstring($fileContent);
        $text_color = imagecolorallocate($im, $r, $g, $b);

        imagettftext($im, 50, 0, 50, 50, $text_color, public_path('font/wt071.ttf'), $cht_key);
        imagegif($im);
        imagedestroy($im);
    }
}
