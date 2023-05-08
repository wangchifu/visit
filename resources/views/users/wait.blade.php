@extends('layouts.master_back')

@section('page-title', '本機帳號管理')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>本機帳號管理-待審列表</h1>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fas fa-list-ol"></i> 本機帳號管理</a>
                <a href="{{ route('users.wait') }}" class="btn btn-secondary disabled"><i class="fas fa-question-circle"></i> 待審列表</a>
                <a href="{{ route('users.add_user') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> 新增本機帳號</a>
                <a href="{{ route('users.all_user') }}" class="btn btn-info"><i class="fas fa-th-list"></i> 全部帳號</a>
                <a href="{{ route('users.search') }}" class="btn btn-warning"><i class="fas fa-search"></i></i> 搜尋帳號</a>
            </div>

                        <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">帳號</th>
                                    <th scope="col">名稱</th>
                                    <th scope="col">類別</th>
                                    <th scope="col">狀況</th>
                                    <th scope="col">建立時間</th>
                                    <th scope="col">編修</th>
                                  </tr>
                                </thead>
                                <tbody>
<?php
$groups_ary=config('app.groups');
//dd($groups_ary);
?>
    
                    @foreach($users as $user)
                    <tr class="small"> <th scope="row">{{ $user->id}}</th>
                        <td>{{ $user->username}}</td>
                        <td>{{ $user->name}}</td>
                        
                        <td>{{$user->group_id }}{{ $groups_ary[$user->group_id] }}</td>
                        <td>@if($user->disable=='2')
                                <span style="color:red">申請中</span>
                                @elseif($user->disable=='1')
                                停用
                                @else
                                啟用
                                @endif
                            </td>
                        <td>{{$user->created_at}}</td>
                        <td>
<a href="{{ route('users.apply',['user'=>$user->id,'page'=>$page]) }}" class="btn btn-success  btn-sm" onclick="return confirm('確定要改變審核結果嗎？')">核准</a>
<a href="{{ route('users.edit',['user'=>$user->id,'page'=>$page]) }}" class="btn btn-primary  btn-sm">編修</a>
<a href="{{ route('users.destroy',$user->id) }}" class="btn btn-danger  btn-sm" onclick="return window.confirm('確定刪除？確定？')">刪除</a></td>

                    </tr>
                    @endforeach
                </table>
                {{ $users->links() }}

        </div>
    </div>
</div>
@endsection
