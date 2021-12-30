<?php

namespace App\Http\Controllers;

use App\Visit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function township($township)
    {
        //$search_data = [];

        $visits = DB::table('visits')
            ->join('users', 'visits.user_id', '=', 'users.id')
            ->join('vendor_datas','vendor_datas.user_id','=','users.id')
            ->where('users.township',$township)
            ->where('visits.disable',null)
            ->select('visits.*','vendor_datas.vendor_name as vendor_name','users.group_id')
            ->paginate(10);

        $townships = config('app.townships');
        $groups = config('app.groups');
        $data = [
            'visits'=>$visits,
            'township_name'=>$townships[$township],
            'groups'=>$groups,
        ];
        return view('searches.township',$data);
    }

    public function show(Visit $visit,$action,$tab=null) {

        $s_key = "visit".$visit->id;
        if(!session($s_key)) {
            $att['views'] = $visit->views+1;
            $visit->update($att);
        }

        session([$s_key => '1']);

        $groups = config('app.groups');
        $townships = config('app.townships');
        $files = get_files(storage_path('app/public/visits/'.$visit->id));

        $data = [
            'townships' => $townships,
            'visit' => $visit,
            'groups' => $groups,
            'files' => $files,
            'tab' => $tab,
        ];
        if($action == "townships") {
            return view('searches.township_show',$data);
        }
        if($action == "vendor"){
            return view('searches.vendor_show',$data);
        }
        if($action == "tab"){
            return view('searches.tab_show',$data);
        }
    }

    public function vendor($group_id) {
        //$search_data = [];
        //學校以相同學校排序
        if($group_id==8){
            $visits = DB::table('visits')
                ->join('vendor_datas','vendor_datas.user_id','=','visits.user_id')
                ->join('users','users.id','=','visits.user_id')
                ->where('users.group_id',$group_id)
                ->where('visits.disable',null)
                ->select('visits.*','vendor_datas.vendor_name as vendor_name','users.group_id')
                ->orderByDesc('user_id')
                ->orderByDesc('views')
                ->paginate(10);
        }else{
            $visits = DB::table('visits')
                ->join('vendor_datas','vendor_datas.user_id','=','visits.user_id')
                ->join('users','users.id','=','visits.user_id')
                ->where('users.group_id',$group_id)
                ->where('visits.disable',null)
                ->select('visits.*','vendor_datas.vendor_name as vendor_name','users.group_id')
                ->orderByDesc('views')
                ->orderByDesc('id')
                ->paginate(10);
        }

        //dd($visits);
        $groups = config('app.groups');

        $data = [
            'group_id'=>$group_id,
            'visits' => $visits,
            'vendor' =>$groups[$group_id],
            'groups' => $groups,
        ];
        //dd($visits);
        return view('searches.vendor',$data);
    }

    public function tab($tab)
    {
        //$search_data = [];

        $visits = DB::table('visits')
            ->join('vendor_datas','vendor_datas.user_id','=','visits.user_id')
            ->join('users','users.id','=','visits.user_id')
            ->where('visits.tabs','like','%'.$tab.'%')
            ->where('visits.disable',null)
            ->select('visits.*','vendor_datas.vendor_name as vendor_name','users.group_id')
            ->paginate(10);

        $groups = config('app.groups');
        $data = [
            'visits'=>$visits,
            'tab'=>$tab,
            'groups'=>$groups,
        ];
        return view('searches.tab',$data);
    }

    public function find(Request $request)
    {
        $find = $request->input('find');
        $group_id = $request->input('group_id');

        if(mb_strlen($find) < 2){
            $words = "搜尋字元至少要二個字！";
            return view('layouts.error',compact('words'));
        }

        $visits = DB::table('visits')
            ->join('vendor_datas','vendor_datas.user_id','=','visits.user_id')
            ->join('users','users.id','=','visits.user_id')
            ->where('users.group_id',$group_id)
            ->where('visits.disable',null)
            ->where('visit_name','like','%'.$find.'%')
            ->select('visits.*','vendor_datas.vendor_name as vendor_name','users.group_id')
            ->orderByDesc('views')
            ->orderByDesc('id')
            ->get();

        $groups = config('app.groups');

        $data=[
            'visits'=>$visits,
            'groups'=>$groups,
            'find'=>$find,
        ];
        return view('searches.find',$data);

    }

}
