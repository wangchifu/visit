@extends('layouts.master')

@section('page-title', '職探課程列表')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            {{ $course->course_name }}
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('ztans.index') }}">職探課程列表</a></li>
                    <li class="breadcrumb-item active" aria-current="page">課程內容</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <div class="text-right">
                        <span >點閱：{{ $course->views }}</span>　　<span>媒合：{{ $course->visits }}</span>
                    </div>
                    <span>詳細內容</span>

                </div>
                <div class="card-body">
                    <?php $about = nl2br($course->about); ?>
                    {!! $about !!}
                </div>
                    <?php
                    //有無附件
                    $files = get_files(storage_path('app/public/courses/'.$course->id));
                    ?>
                @if(!empty($files))
                <div class="card-footer">
                    附件：<br>
                    @foreach($files as $k=>$v)
                        <p><a href="{{ url('file/courses&'.$course->id.'&'.$v) }}"><i class="fas fa-download"></i> {{ $v }}</a></p>
                    @endforeach
                </div>
                @endif
            </div>
            <br>
            @auth
                @if(auth()->user()->group_id=="2")
                    <?php
                        $matchmaking = \App\Matchmaking::where('user_id',auth()->user()->id)
                        ->where('course_id',$course->id)
                        ->first();
                    ?>
                    @if(empty($matchmaking))
                    <a href="{{ route('ztans.create',$course->id) }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> 我要報名
                    </a>
                    @else
                        <strong class="text-danger">你已報名</strong>
                    @endif
                @else
                    <span class="text-danger">僅限學校登入後報名</span>
                @endif

            @endauth
            @guest
                <span class="text-danger">僅限學校登入後報名</span>
            @endguest

        </div>
    </div>
</div>
@endsection
