<?php
//顯示某目錄下的檔案
if (! function_exists('get_files')) {
    function get_files($folder){
        $files = [];
        if (is_dir($folder)) {
            if ($handle = opendir($folder)) { //開啟現在的資料夾
                while (false !== ($file = readdir($handle))) {
                    //避免搜尋到的資料夾名稱是false,像是0
                    if ($file != "." && $file != ".." && $file != "title_image.png") {
                        //去除掉..跟.
                        array_push($files,$file);
                    }
                }
                closedir($handle);
            }
        }
        return $files;
    }
}


//刪除某目錄下的任何東西1
if (! function_exists('delete_dir')) {
    function delete_dir($dir)
    {
        if (!file_exists($dir))
        {
            return true;
        }

        if (!is_dir($dir) || is_link($dir))
        {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item)
        {
            if ($item == '.' || $item == '..')
            {
                continue;
            }

            if (!delete_dir($dir . "/" . $item))
            {
                chmod($dir . "/" . $item, 0777);

                if (!delete_dir($dir . "/" . $item))
                {
                    return false;
                }
            }
        }

        return rmdir($dir);
    }
}

//查指定日期為哪一個學期
if(! function_exists('get_date_semester')){
    function get_date_semester($date)
    {
        $d = explode('-',$date);
        //查目前學期
        $y = (int)$d[0] - 1911;
        $array1 = array(8, 9, 10, 11, 12, 1);
        $array2 = array(2, 3, 4, 5, 6, 7);
        if (in_array($d[1], $array1)) {
            if ($d[1] == 1) {
                $this_semester = ($y - 1) . "1";
            } else {
                $this_semester = $y . "1";
            }
        } else {
            $this_semester = ($y - 1) . "2";
        }

        return $this_semester;

    }
}

//發email
if(! function_exists('send_mail')){
    function send_mail($to,$subject,$body)
    {
        $data = array("subject"=>$subject,"body"=>$body,"receipt"=>"{$to}");
        $data_string = json_encode($data);
        $ch = curl_init('https://school.chc.edu.tw/api/mail');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'AUTHKEY: #chc7237182#')
        );
        $result = curl_exec($ch);
        $obj = json_decode($result,true);
        //if( $obj["success"] == true) {
            //echo "<body onload=alert('已mail通知')>";
        //};


    }
}

//檢查是否為技藝教育自辦國中
if(! function_exists('check_skill')){
    function check_skill($school_id)
    {
        //$j_schools = config('app.j_schools');
        $j_schools = get_jschools();
        $test_id = "s".$school_id;
        $schools = array_flip($j_schools);
        if(in_array($test_id,$schools)){
            return true;
        }else{
            return false;
        }
    }
}

//檢查是否為技藝教育自辦國中
if(! function_exists('get_jschools')){
    function get_jschools()
    {
        $skill_jschools = \App\SkillJschool::where('disable',null)->get();
        $jschools = [];
        foreach($skill_jschools as $skill_jschool){
            $jschools[$skill_jschool->jschool_code] = $skill_jschool->jschool_name;
        }
        return $jschools;
    }
}