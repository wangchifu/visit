@extends('layouts.master')

@section('page-title', '公告內容')

@section('content')
<div class="content-info">
    <h2>{{ $post->title }}</h2>
    <small>發布單位： {{ $post->user->name }} ｜ 發布日期： {{ substr($post->created_at,0,10) }} ｜ 點閱： {{ $post->views }}</small>
    @auth
    @if((auth()->user()->group_id =="1" or auth()->user()->group_id =="4") and $post->user_id == auth()->user()->id)
        <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> 修改公告</a>
        <button type="submit" class="btn btn-danger btn-sm" onclick="if(confirm('您確定要刪除嗎?')) getElementById('delete').submit();else return false"><i class="fas fa-times"></i> 刪除公告</button>
            {{ Form::open(['route' => ['posts.destroy',$post->id], 'method' => 'DELETE','id'=>'delete']) }}
            {{ Form::close() }}
    @endif
    @endauth
    <?php
        $content = nl2br($post->content);
    ?>
    <p>
        {!! $content !!}
    </p>
    @if(!empty($files))
    <div class="card my-4">
        <h6 class="card-header">附件下載</h6>
        <div class="card-body">
            @foreach($files as $k=>$v)
                <?php
                $file = "posts/".$post->id."/".$v;
                $file = str_replace('/','&',$file);
                ?>
                <a href="{{ url('file/'.$file) }}" class="btn btn-primary btn-sm" style="margin:3px"><i class="fas fa-download"></i> {{ $v }}</a>
            @endforeach
        </div>
    </div>
    @endif
    <hr>
    <a href="{{ route('index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
</div>
@endsection