@extends('layouts.master_back')

@section('page-title', '全部帳號')

@section('content')
    <?php
    foreach(config('app.groups') as $k=>$v){
        $groups_select[$k] = $k.$v;
    }
    ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>全部帳號</h1>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fas fa-list-ol"></i> 本機帳號管理</a>
                <a href="{{ route('users.wait') }}" class="btn btn-secondary"><i class="fas fa-question-circle"></i> 待審列表</a>
                <a href="{{ route('users.add_user') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> 新增本機帳號</a>
                <a href="{{ route('users.all_user') }}" class="btn btn-info"><i class="fas fa-th-list"></i> 全部帳號</a>
                <a href="{{ route('users.search') }}" class="btn btn-warning disabled"><i class="fas fa-search"></i></i> 搜尋帳號</a>
            </div>
            {{ Form::open(['route' => 'users.search', 'method' => 'POST']) }}
            <div class="form-group">
                <label for="group_id" class="col-md-4 col-form-label"><strong class="text-danger">請輸入要搜尋的字串</strong></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="find">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary btn-sm">送出</button>
                </div>
            </div>
            {{ Form::close() }}
            @if(!empty($find))
            <h2>搜尋..{{ $find }}</h2>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        帳號
                    </th>
                    <th>
                        名稱
                    </th>
                    <th>
                        單位
                    </th>
                    <th>
                        狀況
                    </th>
                    <th>
                        動作
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->username }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                    @if($user->group_id == "2")
                        {{ $user->school_data->school_name }}
                    @endif
                    @if($user->group_id >= "8")
                        @if(!empty($user->vendor_data))
                        {{ $user->vendor_data->vendor_name }}
                        @endif
                    @endif
                    </td>
                    <td>
                        @if($user->disable=='2')
                            <span style="color:red">申請中</span>
                            @elseif($user->disable=='1')
                            停用
                            @else
                            啟用
                        @endif
                    </td>
                    <td>
                        @if($user->group_id != '1' and $user->group_id != "2")
                        <a href="{{ route('users.edit',['user'=>$user->id,'page'=>0]) }}" class="btn btn-primary  btn-sm">編修</a>
                        <a href="{{ route('users.destroy',$user->id) }}" class="btn btn-danger  btn-sm" onclick="return window.confirm('確定刪除？確定？')">刪除</a>
                        @endif
                        @if($user->login_type=="local")
                        <a href="{{ route('users.reset_pwd',$user->id) }}" class="btn btn-info btn-sm" onclick="return window.confirm('確定要還原 {{ $user->username }} 的密碼為 {{ env('DEFAULT_USER_PWD') }}')"><i class="fas fa-undo-alt"></i> 密</a>
                        @endif
                        <a href="{{ route('sims.impersonate',$user->id) }}" class="btn btn-secondary btn-sm" onclick="return confirm('確定要模擬這個帳號？')">模擬</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection