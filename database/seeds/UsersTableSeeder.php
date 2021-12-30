<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();  //清空資料庫
        \App\VendorData::truncate();  //清空資料庫
        \App\Visit::truncate();  //清空資料庫
        \App\SkillJschool::truncate();  //清空資料庫

        \App\User::create([
            'username' => 'admin',
            'password' => bcrypt(env('DEFAULT_USER_PWD')),
            'login_type'=>'local',
            'name' => '系統管理員',
            'group_id'=>'1',
        ]);

        \App\User::create([
            'username' => 'ztan1',
            'password' => bcrypt(env('DEFAULT_USER_PWD')),
            'login_type'=>'local',
            'name' => '彰安國中職探中心',
            'group_id'=>'4',
        ]);

        \App\User::create([
            'username' => 'ztan2',
            'password' => bcrypt(env('DEFAULT_USER_PWD')),
            'login_type'=>'local',
            'name' => '大同國中職探中心',
            'group_id'=>'4',
        ]);

        \App\User::create([
            'username' => 'ztan3',
            'password' => bcrypt(env('DEFAULT_USER_PWD')),
            'login_type'=>'local',
            'name' => 'xx國中職探中心',
            'group_id'=>'4',
        ]);

        $s_schools = [
            's070316'=>'鹿港高中',
            's070408'=>'員林農工',
            's070409'=>'崇實高工',
            's070405'=>'秀水高工',
            's070403'=>'二林工商',
            's070401'=>'彰師大附工',
            's070406'=>'彰化高商',
            's070410'=>'員林家商',
            's070415'=>'北斗家商',
            's070402'=>'永靖高工',
            's071413'=>'大慶商工',
            's071414'=>'達德商工',
            's061306'=>'私立明台高中',
        ];

        foreach($s_schools as $k=>$v){
            $s_user = \App\User::create([
                'username' => $k,
                'password' => bcrypt(env('DEFAULT_USER_PWD')),
                'login_type'=>'local',
                'name' => "聯絡人姓名",
                'group_id'=>'8',
            ]);
            \App\VendorData::create([
                'vendor_name' => $v,
                'about' => $v.'簡介',
                'user_id' => $s_user->id,
            ]);

        }

        $j_schools = [
        's074535'=>'和群國中',
        's074507'=>'彰德國中',
        's074503'=>'鹿鳴國中',
        's074540'=>'彰泰國中',
        's074524'=>'伸港國中',
        's074502'=>'鹿港國中',
        's074517'=>'芳苑國中',
        's074512'=>'萬興國中',
        ];

        foreach($j_schools as $k=>$v){
            $att['jschool_code'] = $k;
            $att['jschool_name'] = $v;
            \App\SkillJschool::create($att);
        }

        
    }
}
