@extends('layouts.master_back')

@section('page-title', '我的職探課程')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            我的職探課程
        </h1>
        <div class="col-12">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th>
                            開課單位
                        </th>
                        <th>
                            活動時間
                        </th>
                        <th>
                            課程名稱
                        </th>
                        <th>
                            報名表
                        </th>
                        <th>
                            狀況
                        </th>
                        <th>
                            心得
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($matchmakings as $matchmaking)
                        <tr>
                            <td>
                                {{ $matchmaking->course->user->name }}
                            </td>
                            <td>
                                {{ $matchmaking->course->active_date }}
                            </td>
                            <td>
                                {{ $matchmaking->course->course_name }}
                            </td>
                            <td>
                                <a href="{{ route('matchmakings.ztans_show',$matchmaking->course_id) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-eye"></i> 報名資料</a>
                            </td>
                            <td>
                                @if($matchmaking->situation == 1)
                                    <strong class="text-warning">申請中</strong>
                                @elseif($matchmaking->situation == 2)
                                    <strong class="text-success">通過</strong>
                                @elseif($matchmaking->situation == 3)
                                    <strong class="text-danger">未錄取</strong>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('experiences.index',$matchmaking) }}" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i> 上傳</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

        </div>
    </div>
</div>
@endsection
