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
                <a href="{{ route('users.all_user') }}" class="btn btn-info disabled"><i class="fas fa-th-list"></i> 全部帳號</a>
                <a href="{{ route('users.search') }}" class="btn btn-warning"><i class="fas fa-search"></i></i> 搜尋帳號</a>
            </div>
            {{ Form::open(['route' => 'users.all_user', 'method' => 'POST','id'=>'all_user']) }}
            <div class="form-group">
                <label for="group_id" class="col-md-4 col-form-label"><strong class="text-danger">請選擇群組</strong></label>
                <div class="col-md-12">
                    {{ Form::select('group_id', $groups_select,$group_id, ['id' => 'group_id', 'class' => 'form-control','required'=>'required','onchange'=>"$('#all_user').submit()"]) }}
                </div>
            </div>
            {{ Form::close() }}
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
                    @if($group_id == "2")
                        {{ $user->school_data->school_name }}
                    @endif
                    @if($group_id >= "8")
                        @if(!empty($user->vendor_data))
                        {{ $user->vendor_data->vendor_name }}
                        @endif
                    @endif
                    </td>
                    <td>
                        @if($user->id != auth()->user()->id)
                        <a href="{{ route('sims.impersonate',$user->id) }}" class="btn btn-secondary btn-sm" onclick="return confirm('確定要模擬這個帳號？')">模擬</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection