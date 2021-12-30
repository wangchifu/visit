@extends('layouts.master_back')

@section('page-title', '職探課程管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            職探課程媒合->聯絡人資訊
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">職探課程管理</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.matching',$course_id) }}">職探課程媒合</a></li>
                    <li class="breadcrumb-item active" aria-current="page">聯絡人資訊</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">資訊</div>
                <div class="card-body">
                    <label>學校</label>
                    <ul>
                        <li>{{ $user->school_data->school_name }}</li>
                    </ul>
                    <label>職稱</label>
                    <ul>
                        <li>{{ $user->school_data->title }}</li>
                    </ul>
                    <label>聯絡人</label>
                    <ul>
                        <li>{{ $user->name }}</li>
                    </ul>
                    <label>電話</label>
                    <ul>
                        <li>{{ $user->telephone_number }}</li>
                    </ul>
                    <label>email</label>
                    <ul>
                        <li>{{ $user->email }}</li>
                    </ul>
                    <label>LINE ID</label>
                    <ul>
                        <li>{{ $user->line_id }}</li>
                    </ul>
                    <label>地址</label>
                    <ul>
                        <li>{{ $user->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
