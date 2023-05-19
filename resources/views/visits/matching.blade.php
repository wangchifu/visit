@extends('layouts.master_back')

@section('page-title', '行程管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            行程「{{ $visit->visit_name }}」媒合
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">行程列表</a></li>
                    <li class="breadcrumb-item active" aria-current="page">行程媒合</li>
                </ol>
            </nav>

                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th>
                                項次
                            </th>
                            <th>
                                報名單位
                            </th>
                            <th>
                                申請日期
                            </th>
                            <th>
                                動作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $k=>$v)
                        <tr>
                            <td>
                            @if($show_match[$v][$visit->id]['situation'] == 1)
                                    <strong class="text-warning">申請</strong>
                            @elseif($show_match[$v][$visit->id]['situation'] == 2)
                                    <strong class="text-success">通過</strong>
                            @elseif($show_match[$v][$visit->id]['situation'] == 3)
                                    <strong class="text-danger">退回</strong>
                            @endif
                            </td>
                            <td>

                                <?php
                                $user = \App\User::where('id',$v)->first();
                                $school_data = \App\SchoolData::where('user_id',$user->id)->first();
                                ?>
                                {{ $school_data->school_name }}
                                {{ $user->name }}
                                <a href="{{ route('visits.show_user',['user'=>$v,'visit_id'=>$visit->id]) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-eye"></i> 詳細聯絡</a>
                                <br>
                                <?php
                                    $visit_data = \App\VisitData::where('matchmaking_id',$show_match[$v][$visit->id]['id'])->first();
                                ?>
                                @if(!empty($visit_data->id))
                                    日期:{{ $visit_data->visit_date }} 師:{{ $visit_data->teachers }}人 年：{{ $visit_data->grade }} 生:{{ $visit_data->students }}人
                                @endif
                            </td>
                            <td>
                                {{ $show_match[$v][$visit->id]['created_at'] }}
                            </td>
                            <td>
                            @if($show_match[$v][$visit->id]['situation'] == 1)
                                <a href="{{ route('visits.pass',$show_match[$v][$visit->id]['id']) }}" class="btn btn-success btn-sm" onclick="return confirm('你確定要通過？')"><i class="fas fa-check"></i> 通過</a>
                                <a href="{{ route('visits.no_pass',$show_match[$v][$visit->id]['id']) }}" class="btn btn-warning btn-sm" onclick="return confirm('你確定要退回？')"><i class="fas fa-times"></i> 退回</a>
                                <a href="{{ route('visits.del',$show_match[$v][$visit->id]['id']) }}" class="btn btn-danger btn-sm" onclick="return confirm('你確定要刪除？')"><i class="fas fa-times"></i> 刪除</a>
                            @elseif($show_match[$v][$visit->id]['situation'] == 2)
                                <a href="{{ route('visits.no_pass',$show_match[$v][$visit->id]['id']) }}" class="btn btn-warning btn-sm" onclick="return confirm('你確定要退回？')"><i class="fas fa-times"></i> 退回</a>
                                <a href="{{ route('visits.del',$show_match[$v][$visit->id]['id']) }}" class="btn btn-danger btn-sm" onclick="return confirm('你確定要刪除？')><i class="fas fa-times"></i> 刪除</a>
                            @elseif($show_match[$v][$visit->id]['situation'] == 3)
                                <a href="{{ route('visits.pass',$show_match[$v][$visit->id]['id']) }}" class="btn btn-success btn-sm" onclick="return confirm('你確定要通過？')"><i class="fas fa-check"></i> 通過</a>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

        </div>
    </div>
</div>
@endsection
