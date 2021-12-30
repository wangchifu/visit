<?php

namespace App\Http\Controllers;

use App\Course;
use App\Matchmaking;
use App\Visit;
use App\VisitData;
use Illuminate\Http\Request;

class MatchmakingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function courses_index()
    {
        $matchmakings = Matchmaking::where('user_id',auth()->user()->id)
            ->where('visit_id',null)
            ->where('course_id','!=',null)
            ->orderBy('id','DESC')
            ->get();

        $data= [
            'matchmakings'=>$matchmakings,
        ];
        return view('matchmakings.courses.index',$data);
    }

    public function courses_show(Course $course)
    {
        $data = [
            'course'=>$course,
        ];
        return view('matchmakings.courses.show',$data);
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

    public function visit_data(Visit $visit)
    {

        $data = [
            'visit'=>$visit,
        ];
        return view('searches.visit_data',$data);
    }


    public function store(Request $request)
    {
        $att['situation'] = "1";
        $att['user_id'] = auth()->user()->id;
        $att['visit_id'] = $request->input('visit_id');
        $matchmaking = Matchmaking::create($att);

        $att2['user_id'] = auth()->user()->id;
        $att2['matchmaking_id'] = $matchmaking->id;
        $att2['visit_date'] = $request->input('visit_date');
        $att2['teachers'] = $request->input('teachers');
        $att2['students'] = $request->input('students');
        VisitData::create($att2);

        $visit = Visit::where('id',$att['visit_id'])->first();

        //寄mail
        $to = $visit->user->email;
        $subject = env('APP_NAME')." 已經有申請參訪者！行程編號[{$visit->id}]";
        $body = $subject." 請上網站 ".env('APP_URL')." 審核國中小的申請單！";

        send_mail($to,$subject,$body);


        return redirect()->route('visits.my_visit');
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
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function all()
    {
        $matchmakings = Matchmaking::orderBy('id','DESC')->paginate(20);
        $data = [
            'matchmakings'=>$matchmakings,
        ];
        return view('matchmakings.admin_show_all',$data);
    }
}
