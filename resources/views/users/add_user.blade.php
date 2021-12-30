@extends('layouts.master_back')

@section('page-title', '新增本機帳號')

@section('content')
<?php
foreach(config('app.groups') as $k=>$v){
    if($k == "1" or $k == "4" or $k=="8")
    $groups_select[$k] = $k.$v;
}
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>新增本機帳號</h1>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fas fa-list-ol"></i> 本機帳號管理</a>
                <a href="{{ route('users.wait') }}" class="btn btn-secondary"><i class="fas fa-question-circle"></i> 待審列表</a>
                <a href="{{ route('users.add_user') }}" class="btn btn-success disabled"><i class="fas fa-plus-circle"></i> 新增本機帳號</a>
                <a href="{{ route('users.all_user') }}" class="btn btn-info"><i class="fas fa-th-list"></i> 全部帳號</a>
            </div>
            {{ Form::open(['route' => 'users.store_add_user', 'method' => 'POST','id'=>'add_user']) }}
            <div class="card my-4">
                <h3 class="card-header">使用者資料</h3>
                <div class="card-body">
                    @include('layouts.alert')
                    <div class="form-group">
                        <label for="group_id" class="col-md-4 control-label"><strong class="text-danger">單位類別*</strong></label>
                        {{ Form::select('group_id', $groups_select,null , ['id' => 'group_id', 'class' => 'form-control','required'=>'required']) }}
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-md-4 control-label"><strong class="text-danger">帳號</strong></label>
                        <input id="username" type="text" class="form-control" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-md-4 control-label"><strong class="text-danger">名稱</strong></label>
                        <input id="name" type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('確定儲存？')">
                            <i class="fas fa-save"></i> 儲存設定
                        </button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script>
    $("#username").on('change', function(){
        var username = $('#username').val();
        $.ajax({
            type: "POST",
            url: "{{ route('check_local_user') }}",
            dataType: 'json',
            data: $("#add_user").serialize(),

            error: function (result) {
                alert("連接失敗");
                $('#username').val('');
                $('#username').focus();
            },
            success: function (result) {
                if (result == 'success') {
                    alert('可以使用此帳號!');

                } else {
                    alert("此帳號已被使用");
                    $('#username').val('');
                    $('#username').focus();

                }
            }
        });
    });

</script>
@endsection