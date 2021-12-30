@extends('layouts.master_back')

@section('page-title', '國中技藝教育管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            國中技藝教育管理
        </h1>
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('skills.admin') }}">新增開辨項目</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skills.admin_list') }}">管理開辨項目</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skills.admin_jschool') }}">管理自辦國中</a>
                </li>
            </ul>
            <br>
            {{ Form::open(['route' => 'skills.admin_store', 'method' => 'POST']) }}
            <div class="form-group">
                <label>1.學年度</label>
                {{ Form::text('semester',$semester,['id'=>'semester','class' => 'form-control','maxlength'=>'4']) }}
            </div>
            <div class="form-group">
                <label>2.辦理方式</label><br>
                <input type="radio" name="type" id="type1" value="1" checked onclick="show1()">
                <label for="type1"><span class="btn btn-primary btn-sm">合作</span><small>(須申請)</small></label>　
                <input type="radio" name="type" id="type2" value="2" onclick="show2()">
                <label for="type2"><span class="btn btn-info btn-sm">自辦</span><small>(直接通過)</small></label>
            </div>
            <div class="form-group">
                <label>3.辦理學校</label>
                <div id="show1">
                    {{ Form::select('s_username', $s_schools,null, ['id' => 's_username', 'class' => 'form-control']) }}
                </div>
                <div id="show2" style="display:none">
                    {{ Form::select('j_username', $j_schools,null, ['id' => 'j_username', 'class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label>4.開設職群(多選)</label>
                {{ Form::select('career_ids[]', $careers,null, ['id' => 'career_id', 'class' => 'form-control','multiple'=>'multiple']) }}
            </div>
            <div class="form-group">
                <div id="show3" style="display:none">
                    <label>5.合作單位</label>
                    {{ Form::text('co_name','無',['id'=>'co_name','class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <div id="show4" style="display:none">
                    <label>6.核定班級數</label>
                    {{ Form::text('class_num','0',['id'=>'class_num','class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <div id="show5" style="display:none">
                    <label>7.核定人數</label>
                    {{ Form::text('people_num','0',['id'=>'people_num','class' => 'form-control']) }}
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('確定嗎？')"><i class="fas fa-plus-circle"></i> 新增</button>
            {{ Form::close() }}

        </div>
    </div>
</div>
<script>
    function show1() {
        $("#show1").show();
        $("#show2").hide();
        $("#show3").hide();
        $("#show4").hide();
        $("#show5").hide();
    }
    function show2() {
        $("#show2").show();
        $("#show1").hide();
        $("#show3").show();
        $("#show4").show();
        $("#show5").show();
    }
</script>
@endsection
