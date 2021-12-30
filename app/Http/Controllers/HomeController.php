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
        $path = str_replace('&','/',$path);
        $path = storage_path('app/public/'.$path);
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function delFile($file,$url)
    {
        $file = str_replace('&','/',$file);
        $url = str_replace('&','/',$url);
        unlink(storage_path('app/public/'.$file));
        return redirect($url);
    }

    //下載已上傳之檔案
    public function getFile($file)
    {
        $file = str_replace('&','/',$file);
        $file = storage_path('app/public/'.$file);
        return response()->download($file);
    }


    //檢查帳號是否被使用了
    public function check_local_user(Request $request)
    {
        $check_user = User::where('username',$request->input('username'))
            ->first();
        if(empty($check_user)){
            $result = 'success';
        }else{
            $result = 'failed';
        }
        echo json_encode($result);
        return;
    }

    public function back()
    {
        return view('back');
    }
}
