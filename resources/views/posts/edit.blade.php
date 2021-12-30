@extends('layouts.master')

@section('page-title', '修改公告')

@section('content')
<div class="content-info">
    <h1>修改公告</h1>
    {{ Form::model($post,['route' => ['posts.update',$post->id], 'method' => 'PATCH','id'=>'setup', 'files' => true]) }}
    <div class="card my-4">
        <h3 class="card-header">公告資料</h3>
        <div class="card-body">
            <div class="form-group">
                <label for="title"><strong>標題*</strong></label>
                {{ Form::text('title',null,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入標題','required'=>'required']) }}
            </div>
            <div class="form-group">
                <label for="content"><strong>內文*</strong></label>
                {{ Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control', 'rows' => 10, 'placeholder' => '請輸入內容','required'=>'required']) }}
            </div>
            <div class="form-group">
                <label for="files[]">附件( 不大於5MB )</label>
                <br>
                @if(!empty($files))
                    @foreach($files as $k=>$v)
                        <?php
                        $file = "posts/".$post->id."/".$v;
                        $file = str_replace('/','&',$file);
                        ?>
                        <a href="{{ url('posts/'.$file.'/fileDel') }}" class="btn btn-danger btn-sm" id="fileDel{{ $k }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle"></i> {{ $v }}</a>
                    @endforeach
                @endif
                {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple']) }}
            </div>
            <div class="form-group">
                <a href="#" class="btn btn-secondary" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                <button type="submit" class="btn btn-primary" onclick="return confirm('確定儲存？')">
                    <i class="fas fa-save"></i> 儲存設定
                </button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection