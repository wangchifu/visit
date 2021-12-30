@extends('layouts.master_back')

@section('page-title', '新增職探課程')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            新增職探課程
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">職探課程管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">新增活動課程</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">課程設定</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'courses.store', 'method' => 'POST','files' => true,'id'=>'create']) }}
                    @include('courses.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
