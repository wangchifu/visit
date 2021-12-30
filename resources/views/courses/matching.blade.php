@extends('layouts.master_back')

@section('page-title', '職探課程管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            職探課程「{{ $course->course_name }}」媒合
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">職探課程管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">職探課程媒合</li>
                </ol>
            </nav>
            <a href="{{ route('courses.download',$course->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> 下載媒合成功檔案</a>
                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th>
                                學期
                            </th>
                            <th>
                                狀態
                            </th>
                            <th>
                                報名單位
                            </th>
                            <th>
                                申
                            </th>
                            <th>
                                通
                            </th>
                            <th>
                                退
                            </th>
                            <th>
                                問卷
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
                                {{ $show_match[$v][$course->id]['semester'] }}
                            </td>
                            <td>
                            @if($show_match[$v][$course->id]['situation'] == 1)
                                    <strong class="text-warning">申請</strong>
                            @elseif($show_match[$v][$course->id]['situation'] == 2)
                                    <strong class="text-success">通過</strong>
                            @elseif($show_match[$v][$course->id]['situation'] == 3)
                                    <strong class="text-danger">退回</strong>
                            @endif
                            </td>
                            <td>
                                <?php
                                $user = \App\User::where('id',$v)->first();
                                ?>
                                {{ $user->school_data->school_name }}
                                {{ $user->name }}<br>
                                {{ substr($show_match[$v][$course->id]['date'],0,16) }}
                                <a href="{{ route('courses.show_user',['user'=>$v,'course_id'=>$course->id]) }}" class="badge badge-info"><i class="fas fa-eye"></i> 聯絡</a>
                            </td>
                            <th>
                                {{ $school_app[$user->school_data->school_name] }}
                            </th>
                            <td>
                                {{ $school_pass[$user->school_data->school_name] }}
                            </td>
                            <td>
                                {{ $school_back[$user->school_data->school_name] }}
                            </td>
                            <td>
                                <a href="{{ route('courses.show_answer',$show_match[$v][$course->id]['id']) }}" class="badge badge-info" target="_blank"><i class="fas fa-file"></i> 內容</a>
                            </td>
                            <td>
                            @if($show_match[$v][$course->id]['situation'] == 1)
                                <a href="{{ route('courses.pass',$show_match[$v][$course->id]['id']) }}" class="badge badge-success" onclick="return confirm('你確定要通過？')"><i class="fas fa-check"></i> 通過</a>
                                <a href="{{ route('courses.no_pass',$show_match[$v][$course->id]['id']) }}" class="badge badge-warning" onclick="return confirm('你確定要退回？')"><i class="fas fa-times"></i> 退回</a>
                                <a href="{{ route('courses.del',$show_match[$v][$course->id]['id']) }}" class="badge badge-danger" onclick="return confirm('你確定要刪除？')"><i class="fas fa-times"></i> 刪除</a>
                            @elseif($show_match[$v][$course->id]['situation'] == 2)
                                <a href="{{ route('courses.no_pass',$show_match[$v][$course->id]['id']) }}" class="badge badge-warning" onclick="return confirm('你確定要退回？')"><i class="fas fa-times"></i> 退回</a>
                                <a href="{{ route('courses.del',$show_match[$v][$course->id]['id']) }}" class="badge badge-danger" onclick="return confirm('你確定要刪除？')"><i class="fas fa-times"></i> 刪除</a>
                            @elseif($show_match[$v][$course->id]['situation'] == 3)
                                <a href="{{ route('courses.pass',$show_match[$v][$course->id]['id']) }}" class="badge badge-success" onclick="return confirm('你確定要通過？')"><i class="fas fa-check"></i> 通過</a>
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
