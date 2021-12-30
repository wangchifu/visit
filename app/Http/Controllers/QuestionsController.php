<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $questions = Question::where('course_id',$course->id)
            ->orderBy('order_by')->get();
        $data = [
            'course'=>$course,
            'questions'=>$questions,
        ];

        return view('questions.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        $data = [
            'course'=>$course,
        ];
        return view('questions.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('type')=='radio' or $request->input('type')=='checkbox') {
            foreach ($request->input('option') as $v) {
                if (empty($v)) {
                    abort(403, '你有選項是空的');
                }
            }
        }
        $att['order_by'] = $request->input('order_by');
        $att['title'] = $request->input('title');
        $att['description'] = $request->input('description');
        $att['type'] = $request->input('type');
        $att['course_id'] = $request->input('course_id');
        $att['option'] = serialize($request->input('option'));

        Question::create($att);
        return redirect()->route('questions.index',$request->input('course_id'));
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
    public function destroy(Question $question)
    {
        Answer::where('question_id',$question)->delete();
        $question->delete();
        return redirect()->route('questions.index',$question->course_id);
    }
}
