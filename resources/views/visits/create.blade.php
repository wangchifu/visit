@extends('layouts.master_back')

@section('page-title', '新增行程')

@section('content')
    @include('layouts.bootbox')
    <div class="row">
        <div class="col-12">
            <h1>{{ $user->vendor_data->vendor_name }} 新增行程</h1>
        </div>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">行程列表</a></li>
                    <li class="breadcrumb-item active" aria-current="page">新增行程</li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    行程資料
                </div>
                <div class="card-body">
                    {{ Form::open(['route' =>'visits.store', 'method' => 'POST','files' => true,'id'=>'setup']) }}
                    @include('visits.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>
@endsection