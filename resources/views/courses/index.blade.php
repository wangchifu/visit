@extends('layouts.master_back')

@section('page-title', '職探課程管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            職探課程管理
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">職探課程管理</li>
                </ol>
            </nav>
            <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> 新增課程</a>
            <a href="{{ route('courses.download_semester',$semester) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> 下載{{ $semester }}學期媒合成功檔案</a>
            <br>
            圖例：<i class="fas fa-ban text-danger"></i>停用　<i class="far fa-check-circle text-success"></i>啟用
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="80">
                            學期
                        </th>
                        <th nowrap>
                            相關日期
                        </th>
                        <th nowrap>
                            課程名稱
                        </th>
                        <th>
                            附件
                        </th>
                        <th>
                            管理動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>
                            {{ $course->semester }}
                        </td>
                        <td width="130" nowrap>
                            <small>
                            報名：{{ $course->start_date }}<br>
                            截止：{{ $course->stop_date }}<br>
                            活動：{{ $course->active_date }}
                            </small>

                        </td>
                        <td nowrap>
                            @if($course->disable=="1")
                                <i class="fas fa-ban text-danger"></i>
                                {{ $course->course_name }}
                            @else
                                <i class="far fa-check-circle text-success"></i>
                                <a href="{{ route('courses.show',$course->id) }}">{{ $course->course_name }}</a>
                            @endif
                        </td>
                        <td>
                            <?php
                            //有無附件
                            $files = get_files(storage_path('app/public/courses/'.$course->id));
                            ?>
                            @foreach($files as $k=>$v)
                                    <a href="{{ url('file/courses&'.$course->id.'&'.$v) }}"><i class="fas fa-file text-primary"></i></a> <a href="{{ route('courses.file_del',['course_id'=>$course->id,'file'=>$v]) }}" onclick="return confirm('確定刪除 {{ $v }}？')"><i class="fas fa-minus-circle text-danger"></i></a>　
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @if($course->disable=="1")
                                    <a href="{{ route('courses.active',$course->id) }}" class="btn btn-warning btn-sm">已停</a>
                                @else
                                    <a href="{{ route('courses.active',$course->id) }}" class="btn btn-success btn-sm">已啟</a>
                                @endif
                                @if($course->disable=="1")
                                <a href="{{ route('questions.index',$course->id) }}" class="btn btn-info btn-sm">
                                    表單
                                </a>
                                @endif
                                <a href="{{ route('courses.matching',$course->id) }}" class="btn btn-primary btn-sm">
                                    已報
                                    <span class="badge badge-light">{{ count($course->matchmakings) }}</span>
                                </a>
                                <a href="{{ route('courses.edit',$course->id) }}" class="btn btn-info btn-sm">修</a>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="if(confirm('會刪除底下已報名資料喔！')) $('#delete{{ $course->id }}').submit();else return false"">
                                    刪
                                </button>
                            </div>
                            {{ Form::open(['route' => ['courses.destroy',$course->id], 'method' => 'DELETE','id'=>'delete'.$course->id]) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
