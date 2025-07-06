@extends('layouts.master')

@section('page-title', '首頁')

@section('content')
<div class="content-info">
    @if($errors->any())
    <div class="form-group">
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h2>最新公告</h2>
    @auth
    @if(auth()->user()->group_id =="1" or auth()->user()->group_id =="4")
    <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> 新增公告</a>
    @endif
    @endauth
    <table class="table table-hover table-light">
        <thead class="card-header custom-title2">
        <tr>
            <th nowrap width="120">
                公告日期
            </th>
            <th nowrap>
                標題
            </th>
            <th nowrap width="160">
                發佈人
            </th>
            <th nowrap width="70">
                點閱
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>
                    {{ substr($post->created_at,0,10) }}
                </td>
                <td>
                    <a href="{{ route('posts.show',$post->id) }}">{{ str_limit($post->title,40) }}</a>
                </td>
                <td>
                    {{ $post->user->name }}
                </td>
                <td>
                    {{ $post->views }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection