@extends('layouts.master')

@section('page-title', '國中技藝教育管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            國中技藝教育
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('skills.index') }}">國中技藝教育列表</a></li>
                    <li class="breadcrumb-item active" aria-current="page">詳看內容</li>
                </ol>
            </nav>
            <!--
            <h3>學期：{{ $skill->semester }}</h3>
            -->
            <h3>承辦學校：{{ $school_data['school'] }}</h3>
            <h3>辦理方式：{{ $school_data['type'] }}</h3>
            <div class="card">
                <div class="card-header">
                    職群列表
                </div>
                <div class="card-body">
                    <ul class="navbar-nav feature-box ml-auto">
                    @foreach($career_ids as $v)
                        <li>
                        <a href="{{ route('skills.show_one',['skill_is'=>$skill->id,'career_id'=>$v]) }}" class="btn btn-round btn-info btn-sm" target="_blank"><i class="fas fa-hand-point-up"></i> {{ $careers[$v] }}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <br>
            @if($skill->type=="1")
                @auth
                    @if(auth()->user()->group_id=="2")
                        <?php
                         $check = \App\RebackSkill::where('skill_id',$skill->id)
                            ->where('username','s'. auth()->user()->school_data->school_code)
                            ->first();
                        ?>
                        @if(substr(auth()->user()->school_data->school_code,0,4) == "0745")
                            @if(empty($check))
                            <a href="{{ route('skills.application',$skill->id) }}" class="btn btn-primary"><i class="fas fa-gavel"></i> 我要申請</a>
                            @else
                                <span class="text-danger">你已申請過了</span>
                            @endif
                        @else
                            <strong class="text-danger">國中端請登入申請</strong>
                        @endif
                    @else
                        <strong class="text-danger">國中端請登入申請</strong>
                    @endif
                @endauth
                @guest
                        <strong class="text-danger">國中端請登入申請</strong>
                @endguest
            @endif
        </div>
    </div>
</div>
@endsection
