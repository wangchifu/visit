@extends('layouts.master_back')

@section('page-title', '心得上傳')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="col-12">
                <?php
                    if(empty($matchmaking->course_id)){
                        $title = $matchmaking->visit->visit_name;
                        $page = "visits/my_visit";
                    }else{
                        $title = $matchmaking->course->course_name;
                        $page = "matchmakings/ztans";
                    }
                ?>
                {{ $title }}心得上傳
            </h1>
            <div class="col-12">
                {{ Form::open(['route' => 'experiences.store', 'method' => 'POST','Enctype'=>'Multipart/Form-Data','id'=>'store']) }}
                <div class="card">
                    <div class="card-header">
                        <h2>資訊</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="experience"><strong class="text-danger">心得感想*</strong></label>
                            {{ Form::textarea('experience',null,['id'=>'experience','class' => 'form-control', 'placeholder' => '請填內容','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="files[]"><strong class="text-danger">活動照片四張*(限5MB以下圖檔)</strong></label>
                            {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple']) }}
                        </div>
                        <button class="btn btn-secondary" onclick="history.back()"><i class="fas fa-backward"></i> 返回</button>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('確定送出？')"><i class="fas fa-play"></i> 送出</button>
                    </div>
                </div>
                <input type="hidden" name="matchmaking_id" value="{{ $matchmaking->id }}">
                <input type="hidden" name="page" value="{{ $page }}">
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection