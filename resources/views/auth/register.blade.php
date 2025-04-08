@extends('layouts.master')

@section('page-title', '廠商申請帳號')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header custom-title">
                <h4>媒合流程</h4>
            </div>
            <div class="card-body">
                <p>
                    1.資料申請 <i class="fas fa-forward text-info"></i>
                    2.等候審核通過 <i class="fas fa-forward text-info"></i>
                    3.開設行程 <i class="fas fa-forward text-info"></i>
                    4.國中小選填參訪行程
                </p>

            </div>
        </div>
    </div>
    <hr class="w-100">
    <div class="col-12">
        <div class="card">
            <div class="card-header custom-title"><h4>申請為「受訪單位」</h4></div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('do.register') }}" id="register" onsubmit="">
                    @csrf
                    <h5>1.申請帳號資料</h5>

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 control-label"><strong class="text-danger">帳號*</strong></label>

                        <div class="col-md-12">
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label"><strong class="text-danger">密碼*</strong></label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label"><strong class="text-danger">確認密碼*</strong></label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required onchange="p_checkpwd();">
                        </div>
                    </div>

                    <hr>

                    <h5>2.單位資料</h5>
                    <?php
                    $readonly=null;
                    $disabled=null;
                    $about=null;
                    $vendor_name=null;
                    $group_id=null; ?>
                    @include('layouts.vendor_basic_form')

                    <div class="form-group">
                        <div class="col-md-4 text-md-left">
                        </div>
                        <div class="col-md-6 text-md-left">
                            <a href="{{ route('login') }}"><img src="{{ route('pic') }}" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="chaptcha" class="col-md-4 control-label"><strong class="text-danger">驗證碼*</strong></label>
                        <div class="col-md-6 col-md-offset-4">
                            <input tabindex="3" id="password" type="text" class="form-control" name="chaptcha" required placeholder="請將上圖國字轉阿拉伯數字" maxlength="5">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('確定？')">
                                <i class="fas fa-share-square"></i> 送出申請
                            </button>
                        </div>
                    </div>
                </form>
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
        // var username = $('#username').val();
        /**
        $.ajax({
            type: "POST",
            url: "{{ route('check_local_user') }}",
            dataType: 'json',
            data: $("#register").serialize(),

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
        */
    });

</script>
@endsection
