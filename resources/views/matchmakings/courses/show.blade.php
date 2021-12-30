@extends('layouts.master_clean')

@section('page-title', '職探課程-詳細報名資料')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            詳細報名資料
        </h1>
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ auth()->user()->school_data->school_name }} {{ auth()->user()->school_data->title }} {{ auth()->user()->name }} 報名資料</div>
                <div class="card-body">
                <h2>{{ $course->course_name }}</h2>
                    <h4>{{ $course->active_date }} {{ $course->active_place }}</h4>
                    <?php $i=1; ?>
                    @foreach($course->questions as $question)
                        <div class="form-group">
                            <label>{{ $i }}.{{ $question->title }}</label>
                            <?php
                                $answer = \App\Answer::where('question_id',$question->id)
                                ->where('user_id',auth()->user()->id)
                                ->first();
                            ?>
                            <input type="text" class="form-control" value="{{ $answer->answer }}" readonly="readonly">
                        </div>
                    <?php $i++; ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
