@extends('layouts.master_back')

@section('page-title', '個人資料編修')

@section('content')
<div class="container">
    <div class="row">
        <h1>個人資料編修</h1>
        <div class="col-12">
            @if ($save_message)
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button> 資料已經儲存
            </div>
            @endif
            <div class="card">
                <div class="card-header custom-title"><h4>各項資料</h4></div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.info_update') }}" id="edit_info_form" onsubmit="">
                        @csrf
                        <h5>帳號資料</h5>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">帳號</label>

                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control" name="username" value="{{$user->username }}" readonly>
                            </div>
                        </div>

                        @if(auth()->user()->group_id == 2)
                            <div class="form-group">
                                <label for="username" class="col-md-12 control-label">姓名：{{ $user->name}} ，任教學校：{{ $school_data->school_name}} ，職稱：{{ $school_data->title}}</label>
                            </div>    
                        @else
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">修改密碼</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">確認新密碼</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" onchange="p_checkpwd();">
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><strong class="text-danger">
                            @if(auth()->user()->group_id > 4)
                                聯絡人*
                            @else
                                姓名*
                            @endif
                            </strong></label>
                            <div class="col-md-12">
                                {{ Form::text('name',$user->name,['id'=>'name','class' => 'form-control', 'required']) }}
                            </div>
                        </div>
                        @if(auth()->user()->group_id == 4)
                            <div class="form-group">
                                <label for="intro_ztan" class="col-md-4 control-label">職探中心簡介</label>
                                <div class="col-md-12">
                                {{ Form::textarea('intro_ztan',$user->intro_ztan,['class' => 'form-control','rows'=>'4', 'placeholder' => '請填內容']) }}
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="telephone_number" class="col-md-4 control-label"><strong class="text-danger">電話*</strong></label>

                            <div class="col-md-12">
                                {{ Form::text('telephone_number',$user->telephone_number,['id'=>'telephone_number','class' => 'form-control', 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"><strong class="text-danger">電子信箱*</strong></label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="line_id" class="col-md-4 col-form-label">聯絡人 <i class="fab fa-line"></i> Line ID</label>

                            <div class="col-md-12">
                                {{ Form::text('line_id',$user->line_id,['id'=>'line_id','class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-share-square"></i> 送出修改
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function p_checkpwd(){
        if($('#password').val() != $('#password-confirm').val()){
            alert('兩次密碼不同！');
            $('#password').val('');
            $('#password-confirm').val('');
            $('#password').focus();
        }
    }

    $("#username").on('change', function(){
        var username = $('#username').val();
        $.ajax({
            url: "{{ route('check_local_user') }}",
            method: "POST",
            dataType: 'json',
            data: $("#register").serialize(),

            error: function (result) {
                alert("連接失敗");
            },
            success: function (result) {
                if (result == 'success') {
                    alert('OK!');

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
