@extends('layouts.master')

@section('page-title', $visit->visit_name)

@section('content')
    <div class="row">
        <h2>{{ $visit->visit_name }}</h2>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('searches.vendor',$visit->user->group_id) }}">參訪查詢</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $visit->visit_name }}</li>
                    <li class="">　　<a href="#" class="badge badge-secondary" onclick="history.back()"><i class="fas fa-chevron-circle-left"></i> 返回</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            {{ Form::open(['route'=>'matchmaking.store','method'=>'post']) }}
                <div class="form-group">
                    <label for="date">*參訪日期</label>
                    <input type="date" class="form-control" id="date" name="visit_date" placeholder="{{ date('Y/m/d') }}" required maxlength="10">
                    <small id="emailHelp" class="form-text text-muted">請依上列日期格式</small>
                </div>
                <div class="form-group">
                    <label for="teachers">*帶隊教職人數</label>
                    <input type="text" class="form-control" id="teachers" name="teachers" required>
                </div>
                <div class="form-group">
                    <label for="grade">*參訪學生年級</label>
                    <input type="text" class="form-control" id="grade" name="grade" required>
                </div>
                <div class="form-group">
                    <label for="students">*參訪學生人數</label>
                    <input type="text" class="form-control" id="students" name="students" required>
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('送出後，就會自動電子信件聯絡對方，不得刪除，建議通過對方審查後，互相打電話聯繫相關事宜！')">確認送出</button>
                <input type="hidden" name="visit_id" value="{{ $visit->id }}">
            {{ Form::close() }}
        </div>
    </div>

@endsection
