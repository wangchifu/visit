@extends('layouts.master_clean')

@section('page-title', '職探課程-詳細報名資料')

@section('content')

<div class="row">
    <h1 class="col-12">
        詳細報名資料
    </h1>
    <div class="col-12">
        <div class="card">
            <div class="card-header">{{ $user->school_data->school_name }} {{ $user->school_data->title }} {{ $user->name }} 報名資料</div>
            <div class="card-body">
            <h2>{{ $matchmaking->course->course_name }}</h2>
                <h4>{{ $matchmaking->course->active_date }} {{ $matchmaking->course->active_place }}</h4>
                <?php $i=1; ?>
                {{ Form::open(['route' => 'courses.admin_store_answer', 'method' => 'POST']) }}
                @foreach($questions as $question)
                    <div class="form-group">
                        <label>{{ $i }}.{{ $question->title }}</label>
                        <?php
                            $answer = \App\Answer::where('question_id',$question->id)
                            ->where('user_id',$user->id)
                            ->first();
                        ?>
                        <input type="text" class="form-control" name="answer[{{ $answer->id }}]" value="{{ $answer->answer }}">
                    </div>
                <?php $i++; ?>
                @endforeach
                <button type="submit" class="btn btn-success btn-sm" onclick="if(confirm('您確定要修改別人的資料嗎?')) return true;else return false"><i class="fas fa-save"></i> 儲存修改</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
