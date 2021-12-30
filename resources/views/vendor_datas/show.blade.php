@extends('layouts.master_back')

@section('page-title', '綜合資訊')

@section('content')
    @include('layouts.bootbox')
    <div class="row">
        <div class="col-12">
            <h1>{{ $user->vendor_data->vendor_name }} 的綜合資訊</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    綜合資訊
                </div>
                <div class="card-body">
                    @include('layouts.alert')
                    {{ Form::model($user,['route' => ['vendor_datas.update',$user->id], 'method' => 'PATCH','id'=>'update']) }}
                    <?php
                    $readonly = "readonly";
                    $disabled = "disabled";
                    $about = $user->vendor_data->about;
                    $vendor_name = $user->vendor_data->vendor_name;
                    $group_id = $user->group_id;
                    ?>
                    @include('layouts.vendor_basic_form')
                    <button type="submit" class="btn btn-info" id="update" onclick="return confirm('確定修改綜合資訊？')"><i class="far fa-edit"></i> 修改資料</button>
                    {{ Form::close() }}
                </div>
            </div>
            <br>

        </div>
    </div>
@endsection
