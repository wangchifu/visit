@extends('layouts.master_back')

@section('page-title', '本機帳號編修')

@section('content')
<div class="row justify-content-center">
    
    <hr class="w-100">
    <div class="col-12">
        <div class="card">
            <div class="card-header custom-title"><h4>本機帳號編修</h4></div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('users.admin_update',$user->id) }}" id="register" onsubmit="">
                    @csrf
                    <h5>1.申請帳號資料</h5>

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 control-label"><strong class="text-danger">帳號*</strong></label>

                        <div class="col-md-12">
                            <input id="username" type="text" class="form-control" name="username" value="{{$user->username }}" readonly>
                        </div>
                    </div>

                    <hr>

                    <h5>2.單位資料</h5>
                    <?php
                    /*  $readonly=null;
                      $disabled=null;
                      $about=null;
                      $vendor_name=null;
                      $group_id=null;
                      */
                    //去除第一個群組:管理員
                    //去除第二個群組:國中小
                    //去除第三個群組:職探中心
                    //去除第四個群組：高中職
                    foreach(config('app.groups') as $k=>$v){
                        $groups_select[$k] = $k.$v;
                    }

                    foreach(config('app.townships') as $k=>$v){
                        $townships[$k] = $k." ".$v;
                    }
                    ?>

                    <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                        <label for="group_id" class="col-md-4 control-label"><strong class="text-danger">單位類別*</strong></label>
                        <div class="col-md-12">
                            {{ Form::select('group_id', $groups_select,$user->group_id , ['id' => 'group_id', 'class' => 'form-control','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="vendor_name" class="col-md-4 control-label">單位名稱(限企業)</label>
                        <div class="col-md-12">
                            <?php
                            $vendor_name=(empty($user->vendor_data))?null:$user->vendor_data->vendor_name;
                            $about=(empty($user->vendor_data))?null:$user->vendor_data->about;
                            ?>
                            {{ Form::text('vendor_name',$vendor_name,['id'=>'vendor_name','class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="about" class="col-md-4 control-label">單位簡介(限企業)</label>
                        <div class="col-md-12">
                            {{ Form::textarea('about',$about,['id'=>'about','class' => 'form-control',"rows"=>"3"]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="group_id" class="col-md-4 col-form-label"><strong class="text-danger">所屬鄉鎮*</strong></label>
                        <div class="col-md-12">
                            {{ Form::select('township', $townships,$user->township, ['id' => 'group_id', 'class' => 'form-control','placeholder'=>'請選擇你的鄉鎮','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="col-md-4 control-label"><strong class="text-danger">單位地址*</strong></label>

                        <div class="col-md-12">
                            {{ Form::text('address',$user->address,['id'=>'address','class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label"><strong class="text-danger">聯絡人*</strong></label>

                        <div class="col-md-12">
                            {{ Form::text('name',$user->name,['id'=>'name','class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telephone_number" class="col-md-4 control-label"><strong class="text-danger">聯絡人電話*</strong></label>

                        <div class="col-md-12">
                            {{ Form::text('telephone_number',$user->telephone_number,['id'=>'telephone_number','class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label"><strong class="text-danger">電子信箱*</strong></label>

                        <div class="col-md-12">
                            {{ Form::text('email',$user->email,['id'=>'email','class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website" class="col-md-4 col-form-label">單位網址(含 http:// )</label>

                        <div class="col-md-12">
                            {{ Form::text('website',$user->website,['id'=>'website','class' => 'form-control','placeholder'=>'http://']) }}
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
                            <input id="page" type="hidden"  name="page" value="{{$page}}">
                             <input  type="hidden"  name="id" value="{{$user->id}}">
                              <button type="button" class="btn btn-primary" onclick="location.href='/users/index?page={{$page}}';">
                                返回
                            </button>
                            <button type="submit" class="btn btn-primary" onclick="if(confirm('您確定送出嗎?')) return true;else return false">
                                <i class="fas fa-share-square"></i> 送出修改
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
