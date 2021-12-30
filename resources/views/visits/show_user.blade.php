@extends('layouts.master_back')

@section('page-title', '行程管理')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="col-12">
            聯絡人資訊
        </h2>
        <div class="col-12">
            <div class="card">
                <div class="card-header">資訊</div>
                <div class="card-body">
                    <label>學校</label>
                    <ul>
                        <li>{{ $user->school_data->school_name }}</li>
                    </ul>
                    <label>職稱</label>
                    <ul>
                        <li>{{ $user->school_data->title }}</li>
                    </ul>
                    <label>聯絡人</label>
                    <ul>
                        <li>{{ $user->name }}</li>
                    </ul>
                    <label>電話</label>
                    <ul>
                        <li>{{ $user->telephone_number }}</li>
                    </ul>
                    <label>email</label>
                    <ul>
                        <li>{{ $user->email }}</li>
                    </ul>
                    <label>LINE ID</label>
                    <ul>
                        <li>{{ $user->line_id }}</li>
                    </ul>
                    <label>地址</label>
                    <ul>
                        <li>{{ $user->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
