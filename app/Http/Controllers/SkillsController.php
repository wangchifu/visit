<?php

namespace App\Http\Controllers;

use App\RebackSkill;
use App\SchoolData;
use App\Skill;
use App\SkillData;
use App\SkillJschool;
use App\User;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function admin()
    {
        //高中
        $s_schools = User::where('group_id','8')
            ->pluck('name','username')->toArray();
        //國中
        //$j_schools = config('app.j_schools');
        $j_schools = get_jschools();

        //職群
        $careers = config('app.careers');

        $semester = get_date_semester(date('Y-m-d'));
        $data = [
            'j_schools'=>$j_schools,
            's_schools'=>$s_schools,
            'careers'=>$careers,
            'semester'=>$semester,
        ];
        return view('skills.admin',$data);
    }

    public function admin_store(Request $request)
    {
        $att['type'] = $request->input('type');
        if($att['type']==1){
            $att['username'] = $request->input('s_username');
        }else{
            $att['username'] = $request->input('j_username');
        }

        $att['semester'] = $request->input('semester');
        $att['career_ids'] = serialize($request->input('career_ids'));
        $skill = Skill::create($att);

        if($att['type']==2){
            $att2['username'] = $request->input('j_username');
            $att2['co_name'] = $request->input('co_name');
            $att2['class_num'] = $request->input('class_num');
            $att2['people_num'] = $request->input('people_num');
            $att2['situation'] = '2';
            $att2['skill_id'] = $skill->id;
            RebackSkill::create($att2);
        }

        return redirect()->route('skills.admin_list');
    }

    public function admin_list(Request $request)
    {
        $skills = Skill::all();
        $semesters = [];
        foreach($skills as $skill){
            $semesters[$skill->semester] = $skill->semester;
        }
        $semester = (empty($request->input('semester')))?get_date_semester(date('Y-m-d')):$request->input('semester');


        $select_skills = Skill::where('semester',$semester)
            ->get();
        $skill_data1=[];
        $skill_data2=[];
        $careers = config('app.careers');
        //$j_schools = config('app.j_schools');
        $j_schools = get_jschools();
        $i=0;
        $j=0;
        $reback_data = [];
        foreach($select_skills as $skill){
            if($skill->type=="1"){
                $skill_data1[$i]['id'] = $skill->id;
                $user = User::where('username',$skill->username)->first();
                $skill_data1[$i]['school'] = $user->name;
                $career_ids = unserialize($skill->career_ids);

                $skill_data1[$i]['career'] = $career_ids;

                $k =0 ;
                foreach($skill->reback_skills as $reback_skill){
                    $reback_data[$skill->id][$k]['id'] = $reback_skill->id;
                    $school = SchoolData::where('school_code',substr($reback_skill->username,1,6))->first();
                    $reback_data[$skill->id][$k]['school'] = $school->school_name;
                    $reback_data[$skill->id][$k]['class_num'] = $reback_skill->class_num;
                    $reback_data[$skill->id][$k]['people_num'] = $reback_skill->people_num;
                    $reback_data[$skill->id][$k]['situation'] = $reback_skill->situation;
                    $k++;
                }


                $i++;
            }else{
                $skill_data2[$j]['id'] = $skill->id;
                $skill_data2[$j]['school'] = $j_schools[$skill->username];
                $career_ids = unserialize($skill->career_ids);

                $reback_skill2 = RebackSkill::where('skill_id',$skill->id)->first();
                $skill_data2[$j]['co_name'] = $reback_skill2->co_name;
                $skill_data2[$j]['situation'] = $reback_skill2->situation;
                $skill_data2[$j]['career'] = $career_ids;
                $j++;
            }
        }




        $data = [
            'semester'=>$semester,
            'semesters'=>$semesters,
            'skill_data1'=>$skill_data1,
            'reback_data'=>$reback_data,
            'skill_data2'=>$skill_data2,
            'careers'=>$careers,
        ];
        return view('skills.admin_list',$data);
    }

    public function admin_jschool()
    {
        $jschools = SkillJschool::orderBy('disable')
            ->get();
        $data = [
            'jschools'=>$jschools,
        ];
        return view('skills.admin_jschool',$data);
    }

    public function admin_jschool_store(Request $request)
    {
        SkillJschool::create($request->all());
        return redirect()->route('skills.admin_jschool');
    }

    public function admin_jschool_del(SkillJschool $skill_jschool)
    {
        RebackSkill::where('username',$skill_jschool->jschool_code)->delete();
        Skill::where('username',$skill_jschool->jschool_code)->delete();
        $skill_jschool->delete();
        return redirect()->route('skills.admin_jschool');
    }

    public function admin_jschool_change(SkillJschool $skill_jschool)
    {
        $att['disable'] = (empty($skill_jschool->disable))?'1':null;
        $skill_jschool->update($att);
        return redirect()->route('skills.admin_jschool');
    }

    public function admin_ok(RebackSkill $reback_skill)
    {
        $att['situation'] = "2";
        $reback_skill->update($att);
        return redirect()->route('skills.admin_list');
    }

    public function admin_notok(RebackSkill $reback_skill)
    {
        $att['situation'] = "3";
        $reback_skill->update($att);
        return redirect()->route('skills.admin_list');
    }

    public function admin_del_reback(RebackSkill $reback_skill)
    {
        $reback_skill->delete();
        return redirect()->route('skills.admin_list');
    }

    public function admin_edit_data(Skill $skill)
    {
        return view('skills.admin_edit_data');
    }

    public function admin_del(Skill $skill)
    {
        RebackSkill::where('skill_id',$skill->id)->delete();
        SkillData::where('skill_id',$skill->id)->delete();
        $skill->delete();
        return redirect()->route('skills.admin_list',$skill->semester);
    }


    public function index()
    {
        $skills = Skill::orderBy('type')
            ->paginate(20);

        $skill_data=[];
        $careers = config('app.careers');
        //$j_schools = config('app.j_schools');
        $j_schools = get_jschools();
        $i=0;
        foreach($skills as $skill){
            if($skill->type=="1"){
                $skill_data[$i]['id'] = $skill->id;
                $skill_data[$i]['type'] = "合作";
                $user = User::where('username',$skill->username)->first();
                $skill_data[$i]['school'] = $user->name;
                $career_ids = unserialize($skill->career_ids);
                foreach($career_ids as $v){
                    if(!isset($skill_data[$i]['career'])) $skill_data[$i]['career'] = null;
                    $skill_data[$i]['career'] .= $careers[$v].",";
                }
                $skill_data[$i]['career'] = substr($skill_data[$i]['career'],0,-1);
                $skill_data[$i]['career'] = str_replace(',','<br>',$skill_data[$i]['career']);
                $i++;
            }else{
                $skill_data[$i]['id'] = $skill->id;
                $skill_data[$i]['type'] = "自辦";
                $skill_data[$i]['school'] = $j_schools[$skill->username];
                $career_ids = unserialize($skill->career_ids);
                foreach($career_ids as $v){
                    if(!isset($skill_data[$i]['career'])) $skill_data[$i]['career'] = null;
                    $skill_data[$i]['career'] .= $careers[$v].",";
                }
                $skill_data[$i]['career'] = substr($skill_data[$i]['career'],0,-1);
                $skill_data[$i]['career'] = str_replace(',','<br>',$skill_data[$i]['career']);
                $i++;
            }
        }


        $data = [
            'skills'=>$skills,
            'skill_data'=>$skill_data,
        ];
        return view('skills.index',$data);
    }

    public function show(Skill $skill)
    {
        if($skill->type=="1"){
            $school_data['type'] = "合作方式";
            $user = User::where('username',$skill->username)->first();
            $school_data['school'] = $user->name;
        }else{
            $school_data['type'] = "自辦方式";
            //$j_schools = config('app.j_schools');
            $j_schools = get_jschools();
            $school_data['school'] = $j_schools[$skill->username];
        }

        $career_ids = unserialize($skill->career_ids);
        $careers = config('app.careers');

        $data = [
            'skill'=>$skill,
            'school_data'=>$school_data,
            'career_ids'=>$career_ids,
            'careers'=>$careers,
        ];
        return view('skills.show',$data);
    }

    public function show_one($skill_id,$career_id)
    {
        $skill_data = SkillData::where('skill_id',$skill_id)
            ->where('career_id',$career_id)
            ->first();
        $skill = Skill::where('id',$skill_id)->first();
        if($skill->type=="1"){
            $user = User::where('username',$skill->username)
                ->first();
            $school_data['type'] = "合作方式";
            $school_data['name'] = $user->name;
        }else{
            $school_data['type'] = "自辦方式";
            //$j_schools = config('app.j_schools');
            $j_schools = get_jschools();
            $school_data['name'] = $j_schools[$skill->username];
        }

        if(!empty($skill_data)){
            $folder = storage_path('app/public/skill_datas/'.$skill_data->id);
            $files = get_files($folder);
        }else{
            $files =[];
        }


        $careers = config('app.careers');
        $data = [
            'skill_data'=>$skill_data,
            'skill'=>$skill,
            'careers'=>$careers,
            'career_id'=>$career_id,
            'school_data'=>$school_data,
            'files'=>$files,
        ];
        return view('skills.show_one',$data);
    }

    public function application(Skill $skill)
    {
        $skill_data = [];
        if($skill->type=="1"){
            $skill_data['id'] = $skill->id;
            $user = User::where('username',$skill->username)->first();
            $skill_data['school'] = $user->name;
            $career_ids = unserialize($skill->career_ids);

            $skill_data['career'] = $career_ids;
            $skill_data['type'] = "合作";
        }
        $careers = config('app.careers');
        $data = [
            'skill_data'=>$skill_data,
            'career_ids'=>$career_ids,
            'careers'=>$careers,
        ];
        return view('skills.application',$data);
    }

    public function application_store(Request $request)
    {
        $reback_skill = RebackSkill::where('username',"s".auth()->user()->school_data->school_code)
            ->where('skill_id',$request->input('skill_id'))
            ->first();
        if(empty($reback_skill)){

            $att['username'] = "s".auth()->user()->school_data->school_code;
            $att['co_name'] = "-";
            $att['class_num'] = $request->input('class_num');
            $att['people_num'] = $request->input('people_num');
            $att['situation'] = "1";
            $att['skill_id'] = $request->input('skill_id');

            RebackSkill::create($att);
        }
        return redirect()->route('skills.my_skill');
    }

    public function high_school()
    {
        if(auth()->user()->group_id == '8') {
            $skills = Skill::where('username', auth()->user()->username)
                ->where('type', '1')
                ->get();
            $school_name = auth()->user()->name;
        }else{
            $skills = Skill::where('username', "s".auth()->user()->school_data->school_code)
                ->where('type', '2')
                ->get();
            $school_name = auth()->user()->school_data->school_name;
        }
        $data = [
            'skills'=>$skills,
            'school_name'=>$school_name,
        ];
        return view('skills.high_school',$data);
    }

    public function high_school_show_co()
    {
        if(auth()->user()->group_id == '8') {
            $skills = Skill::where('username', auth()->user()->username)
                ->where('type', '1')
                ->get();
            $school_name = auth()->user()->name;
        }else{
            $skills = Skill::where('username', "s".auth()->user()->school_data->school_code)
                ->where('type', '2')
                ->get();
            $school_name = auth()->user()->school_data->school_name;
        }

        //$j_schools = config('app.j_schools');
        $j_schools = get_jschools();

        $data = [
            'skills'=>$skills,
            'school_name'=>$school_name,
            'j_schools'=>$j_schools,
        ];
        return view('skills.high_school_show_co',$data);
    }

    public function high_school_ok(RebackSkill $reback_skill)
    {
        $att['situation'] = "2";
        $reback_skill->update($att);
        return redirect()->route('skills.high_school_show_co');
    }

    public function high_school_notok(RebackSkill $reback_skill)
    {
        $att['situation'] = "3";
        $reback_skill->update($att);
        return redirect()->route('skills.high_school_show_co');
    }

    public function edit_data($skill_id,$career_id)
    {
        $skill_data = SkillData::where('skill_id',$skill_id)
            ->where('career_id',$career_id)
            ->first();
        if(!empty($skill_data)){
            $course = $skill_data->course;
            $excellent = $skill_data->excellent;
            $action = 'update';
        }else{
            $course = null;
            $excellent = null;
            $action = 'create';
        }

        if(!empty($skill_data)){
            $folder = storage_path('app/public/skill_datas/'.$skill_data->id);
            $files = get_files($folder);
        }else{
            $files =[];
        }

        $careers = config('app.careers');
        $data= [
            'skill_id'=>$skill_id,
            'career_id'=>$career_id,
            'careers'=>$careers,
            'course'=>$course,
            'excellent'=>$excellent,
            'action'=>$action,
            'skill_data'=>$skill_data,
            'files'=>$files,
            ];
        return view('skills.edit_data',$data);
    }

    public function edit_data_store(Request $request)
    {

        $att['skill_id'] = $request->input('skill_id');
        $att['career_id'] = $request->input('career_id');
        $att['course'] = $request->input('course');
        $att['excellent'] = $request->input('excellent');


        if($request->input('action') == "create"){
            $skill_data = SkillData::create($att);
        }else{
            $skill_data = SkillData::where('skill_id',$att['skill_id'])
                ->where('career_id',$att['career_id'])
                ->first();
            $skill_data->update($att);
        }

        $folder = 'skill_datas/'.$skill_data->id;

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

            }
        }
        if(auth()->user()->group_id==8){
            return redirect()->route('skills.high_school');
        }elseif(auth()->user()->group_id==2){
            return redirect()->route('skills.my_skill');
        }


    }

    public function my_skill()
    {
        $reback_skills = RebackSkill::where('username','s'.auth()->user()->school_data->school_code)
            ->orderBy('id','DESC')
            ->get();
        $i=0;
        $my_skill = [];
        foreach($reback_skills as $reback_skill){
            if($reback_skill->skill->type==1){
                $user = User::where('username',$reback_skill->skill->username)->first();
                $my_skill[$i]['school'] = $user->name;
                $my_skill[$i]['type'] = "合作";


                $my_skill[$i]['co_name'] = "-";
            }else{
                //$j_schools = config('app.j_schools');
                $j_schools = get_jschools();
                $my_skill[$i]['school'] = $j_schools[$reback_skill->skill->username];
                $my_skill[$i]['type'] = "自辦";
                $my_skill[$i]['co_name'] = $reback_skill->co_name;
            }
            $career_ids = unserialize($reback_skill->skill->career_ids);
            $my_skill[$i]['career_ids'] = $career_ids;

            $my_skill[$i]['class_num'] = $reback_skill->class_num;
            $my_skill[$i]['people_num'] = $reback_skill->people_num;
            $my_skill[$i]['situation'] = $reback_skill->situation;
            $my_skill[$i]['skill_id'] = $reback_skill->skill->id;
            $i++;
        }
        $careers = config('app.careers');

        $data = [
            'my_skill' => $my_skill,
            'careers'=>$careers,
        ];
        return view('skills.my_skill',$data);
    }


}
