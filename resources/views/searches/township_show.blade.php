@extends('layouts.master')

@section('page-title', $visit->visit_name)

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{ $visit->visit_name }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('map') }}">參訪體驗地圖</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('searches.township',$visit->user->township) }}">{{ $townships[$visit->user->township] }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $visit->name }}</li>
                    <li class="">　　<a href="#" class="badge badge-secondary" onclick="history.back()"><i class="fas fa-chevron-circle-left"></i> 返回</a></li>
                </ol>
            </nav>
        </div>
        @include('searches.show_content')
    </div>

@endsection
