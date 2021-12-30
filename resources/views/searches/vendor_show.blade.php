@extends('layouts.master')

@section('page-title', $visit->visit_name)

@section('content')
    <div class="row">
        <h2>{{ $visit->visit_name }}</h2>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('searches.vendor',$visit->user->group_id) }}">{{ $groups[$visit->user->group_id] }}參訪查詢</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $visit->visit_name }}</li>
                    <li class="">　　<a href="#" class="badge badge-secondary" onclick="history.back()"><i class="fas fa-chevron-circle-left"></i> 返回</a></li>
                </ol>
            </nav>
        </div>
        @include('searches.show_content')
    </div>

@endsection
