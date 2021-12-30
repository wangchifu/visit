@extends('layouts.master_back')

@section('page-title', '修改職探課程')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            修改職探課程
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">職探課程管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">修改活動課程</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">課程設定</div>
                <div class="card-body">
                    {{ Form::open(['route' => ['courses.update',$course->id], 'method' => 'POST','files' => true,'id'=>'create']) }}
                    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
                    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />

                    <div class="form-group">
                        <label for="datepicker1"><strong class="text-danger">開始報名時間*</strong></label>
                        <input id="datepicker1" name="start_date" width="250" value="{{ $course->start_date }}">
                        <script>
                            $('#datepicker1').datepicker({ format: 'yyyy-mm-dd' });
                        </script>
                    </div>

                    <div class="form-group">
                        <label for="datepicker3"><strong class="text-danger">最後報名時間*</strong></label>
                        <input id="datepicker3" name="stop_date" width="250" value="{{ $course->stop_date }}">
                        <script>
                            $('#datepicker3').datepicker({ format: 'yyyy-mm-dd' });
                        </script>
                    </div>

                    <div class="form-group">
                        <label for="datepicker2"><strong class="text-danger">活動時間*</strong></label>
                        <input id="datepicker2" name="active_date" width="250" value="{{ $course->active_date }}">
                        <script>
                            $('#datepicker2').datepicker({ format: 'yyyy-mm-dd' });
                        </script>
                    </div>

                    <div class="form-group">
                        <label for="active_place"><strong class="text-danger">活動地點*</strong></label>
                        {{ Form::text('active_place',$course->active_place,['id'=>'active_place','class' => 'form-control','required'=>'required']) }}
                    </div>

                    <div class="form-group">
                        <label for="course_anme"><strong class="text-danger">課程名稱*</strong></label>
                        {{ Form::text('course_name',$course->course_name,['id'=>'course_name','class' => 'form-control','required'=>'required']) }}
                    </div>

                    <div class="form-group">
                        <label for="about">課程簡介</label>
                        {{ Form::textarea('about',$course->about,['id'=>'about','class' => 'form-control','rows'=>'4']) }}
                    </div>

                    <div class="form-group">
                        <label for="tabs">搜尋標籤<small>(用,分隔)</small></label>
                        {{ Form::text('tabs',$course->tabs,['id'=>'about','class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label for="files[]">附件<small>(選填，單檔不大於5MB)</small></label>
                        {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple']) }}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('確定儲存？')">
                            <i class="fas fa-save"></i> 儲存設定
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
