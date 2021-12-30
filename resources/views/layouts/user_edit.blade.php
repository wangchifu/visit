<?php
//去除第一個群組:管理員
//去除第二個群組:國中小
//去除第三個群組:職探中心
//去除第四個群組：高中職
foreach(config('app.groups') as $k=>$v){
    if($k > 8) $groups_select[$k] = $v;
}

foreach(config('app.townships') as $k=>$v){
    $townships[$k] = $k." ".$v;
}
?>
<div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
    <label for="group_id" class="col-md-4 control-label"><strong class="text-danger">單位類別*</strong></label>
    <div class="col-md-12">
        {{ Form::select('group_id', $groups_select,null, ['id' => 'group_id', 'class' => 'form-control','placeholder'=>'請選擇類別','required'=>'required',$disabled=>$disabled]) }}
    </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="vendor_name" class="col-md-4 control-label"><strong class="text-danger">單位名稱*</strong></label>
    <div class="col-md-12">
        {{ Form::text('vendor_name',$vendor_name,['id'=>'vendor_name','class' => 'form-control','required'=>'required',$readonly=>$readonly]) }}
    </div>
</div>

<div class="form-group">
    <label for="about" class="col-md-4 control-label"><strong class="text-danger">單位簡介*</strong></label>
    <div class="col-md-12">
        {{ Form::textarea('about',$about,['id'=>'about','class' => 'form-control',"rows"=>"3",'required'=>'required']) }}
    </div>
</div>

<div class="form-group">
    <label for="township" class="col-md-4 col-form-label"><strong class="text-danger">所屬鄉鎮*</strong></label>
    <div class="col-md-12">
        {{ Form::select('township', $townships,null, ['id' => 'township', 'class' => 'form-control','placeholder'=>'請選擇你的鄉鎮','required'=>'required']) }}
    </div>
</div>

<div class="form-group">
    <label for="address" class="col-md-4 control-label"><strong class="text-danger">單位地址*</strong></label>

    <div class="col-md-12">
        {{ Form::text('address',$user->address,['id'=>'address','class' => 'form-control','required'=>'required']) }}
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-md-4 control-label"><strong class="text-danger">聯絡人*</strong></label>

    <div class="col-md-12">
        {{ Form::text('name',$user->name,['id'=>'name','class' => 'form-control','required'=>'required']) }}
    </div>
</div>

<div class="form-group">
    <label for="telephone_number" class="col-md-4 control-label"><strong class="text-danger">聯絡人電話*</strong></label>

    <div class="col-md-12">
        {{ Form::text('telephone_number',$user->telephone_number,['id'=>'telephone_number','class' => 'form-control','required'=>'required']) }}
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-md-4 control-label"><strong class="text-danger">電子信箱*</strong></label>

    <div class="col-md-12">
        {{ Form::text('email',$user->email,['id'=>'email','class' => 'form-control','required'=>'required']) }}
    </div>
</div>

<div class="form-group">
    <label for="website" class="col-md-4 col-form-label">單位網址(含 http:// )</label>

    <div class="col-md-12">
        {{ Form::text('website',old('website'),['id'=>'website','class' => 'form-control','placeholder'=>'http://']) }}
    </div>
</div>

<div class="form-group">
    <label for="line_id" class="col-md-4 col-form-label">聯絡人 <i class="fab fa-line"></i> Line ID</label>

    <div class="col-md-12">
        {{ Form::text('line_id',old('website'),['id'=>'line_id','class' => 'form-control','value'=>$user->line_id]) }}
    </div>
</div>