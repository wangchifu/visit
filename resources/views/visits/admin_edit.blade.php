@extends('layouts.master_back')

@section('page-title', '編輯行程')

@section('content')
    @include('layouts.bootbox')
    <div class="row">
        <div class="col-12">
            <h1>管理員 編輯行程</h1>
        </div>
        @if($user->group_id != "1")
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">行程管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">編輯行程</li>
                </ol>
            </nav>
        </div>
        <br><br>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    行程資料
                </div>
                <div class="card-body">
                    {{ Form::model($visit,['route' =>['visits.admin_update',$visit->id], 'method' => 'PATCH','files' => true,'id'=>'setup']) }}
                    @include('visits.form')
                    <input type="hidden" name="page" value="{{ $page }}">
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>
@endsection