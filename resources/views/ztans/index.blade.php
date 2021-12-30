@extends('layouts.master')

@section('page-title', '職探課程列表')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="col-12">
            職探課程列表
        </h2>
        <div class="col-12">
            <div class="row">
                <div class="col-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">職探課程列表</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-9">
                    @foreach($ztans as $ztan)
                        <a href="{{ route('intro_ztan',$ztan->id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-external-link-square-alt"></i> {{ $ztan->name }}</a>
                    @endforeach
                </div>
            </div>
                <table class="table table-hover table-light">

                    <thead class="card-header custom-title2">
                    <tr>
                        <th>
                            項次
                        </th>
                        <th width="120" nowrap>
                            活動時間
                        </th>
                        <th width="120" nowrap>
                            報名時間
                        </th>
                        <th width="160" nowrap>
                            活動地點
                        </th>
                        <th nowrap>
                            課程名稱
                        </th>
                        <th>
                            標籤
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($courses as $course)
                    <tr>
                        <td>
                            {{ $i }}
                        </td>
                        <td>
                            {{ $course->active_date }}
                        </td>
                        <td>
                            <p>
                                {{ substr($course->start_date,5,5) }}~{{ substr($course->stop_date,5,5) }}
                            </p>
                        </td>

                        <td>
                            {{ $course->active_place }}
                        </td>
                        <td>
                            <h5>
                                <a href="{{ route('ztans.show',$course->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-hand-point-up"></i> {{ $course->course_name }}</a>
                            </h5>
                        </td>
                        <td>
                            <?php
                            $tabs = explode(',',$course->tabs);
                            ?>
                            @foreach($tabs as $tab)
                                    <span class="badge badge-primary">{{ $tab }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
