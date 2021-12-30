@extends('layouts.master_back')

@section('page-title', '編輯職群課程資訊')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            編輯職群課程資訊
        </h1>
        <div class="col-12">
            <button class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fas fa-chevron-left"></i> 返回</button>
            <br>
            <br>
            {{ Form::open(['route' => 'skills.edit_data_store', 'method' => 'POST','Enctype'=>'Multipart/Form-Data','id'=>'store']) }}
            <div class="card">
                <div class="card-header">
                    <h2>{{ $careers[$career_id] }} 資訊</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="course"><strong class="text-danger">課程內容大綱*</strong></label>
                        {{ Form::textarea('course',$course,['id'=>'course','class' => 'form-control', 'placeholder' => '請填內容','required'=>'required']) }}
                    </div>
                    <div class="form-group">
                        <label for="excellent"><strong class="text-danger">優良事蹟*</strong></label>
                        {{ Form::textarea('excellent',$excellent,['id'=>'excellent','class' => 'form-control', 'placeholder' => '請填內容']) }}
                    </div>
                    <div class="form-group">
                        <label for="files[]"><strong class="text-danger">活動照片*(限5MB以下圖檔)</strong></label>
                    @foreach($files as $v)
                            <?php
                            $path = "skill_datas&".$skill_data->id."&".$v;
                            ?>
                            <p><img src="{{ url('file/'.$path) }}" width="80"> <a href="{{ route('del_file',['file'=>$path,'url'=>'skills&high_school']) }}" onclick="return confirm('確定刪除此檔？')"><i class="fas fa-times-circle text-danger"></i></a></p>
                    @endforeach
                        {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple']) }}
                    </div>
                    <input type="hidden" name="skill_id" value="{{ $skill_id }}">
                    <input type="hidden" name="career_id" value="{{ $career_id }}">
                    <input type="hidden" name="action" value="{{ $action }}">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定送出？')"><i class="fas fa-play"></i> 送出</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
