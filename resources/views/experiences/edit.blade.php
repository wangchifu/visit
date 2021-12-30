@extends('layouts.master_back')

@section('page-title', '心得上傳')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="col-12">
                <?php
                    if(empty($experience->matchmaking->course_id)){
                        $title = $experience->matchmaking->visit->visit_name;
                        $page = "visits/my_visit";
                    }else{
                        $title = $experience->matchmaking->course->course_name;
                        $page = "my_course";
                    }
                ?>
                {{ $title }}心得上傳 <a href="{{ route('experiences.destroy',$experience->id) }}" class="btn btn-danger tn-sm" onclick="return confirm('確定刪除？')">刪除</a>
            </h1>
            <div class="col-12">
                {{ Form::open(['route' => ['experiences.update',$experience->id], 'method' => 'POST','Enctype'=>'Multipart/Form-Data','id'=>'store']) }}
                <div class="card">
                    <div class="card-header">
                        <h2>資訊</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="experience"><strong class="text-danger">心得感想*</strong></label>
                            {{ Form::textarea('experience',$experience->experience,['id'=>'experience','class' => 'form-control', 'placeholder' => '請填內容','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="files[]"><strong class="text-danger">活動照片四張*(限5MB以下圖檔)</strong></label>
                            @foreach($files as $v)
                                <?php $file = 'experiences&'.$experience->id.'&'.$v; ?>
                                <p><img src="{{ url('file/'.$file) }}" width="100"><a href="{{ route('del_file',['file'=>$file,'url'=>'experience&'.$experience->id.'&edit']) }}" onclick="return confirm('確定刪除？')"><span class="text-danger"><i class="fas fa-times-circle"></i></span></a></p>
                            @endforeach
                            {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple']) }}
                        </div>
                        <button class="btn btn-secondary" onclick="history.back()"><i class="fas fa-backward"></i> 返回</button>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('確定送出？')"><i class="fas fa-play"></i> 送出</button>
                    </div>
                </div>
                <input type="hidden" name="page" value="{{ $page }}">
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection