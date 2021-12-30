@extends('layouts.master_back')

@section('page-title', '高中職-國中技藝教育')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            高中職-國中技藝教育：審核
        </h1>
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skills.high_school') }}">高中職技藝管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('skills.high_school_show_co') }}">審核合作學校</a>
                </li>
            </ul>
                <table class="table table-striped table-light">
                    <thead>
                    <tr>
                        <th nowrap>
                            學期
                        </th>
                        <th nowrap>
                            辦理學校
                        </th>
                        <th nowrap>
                            開設職群
                        </th>
                        <th nowrap>
                            報名學校
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($skills as $skill)
                    <tr>
                        <td>
                            {{ $skill->semester }}
                        </td>
                        <td>
                            {{ $school_name }}
                        </td>
                        <td>
                            <?php
                                $career_ids = unserialize($skill->career_ids);
                                $careers = config('app.careers');
                            ?>
                            @foreach($career_ids as $v)
                                <p>{{ $careers[$v] }}</p>
                            @endforeach
                        </td>
                        <td>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th nowrap>
                                        申請學校
                                    </th>
                                    <th nowrap>
                                        班級數
                                    </th>
                                    <th nowrap>
                                        人數
                                    </th>
                                    <th nowrap>
                                        狀況
                                    </th>
                                    <th nowrap>
                                        動作
                                    </th>
                                </tr>
                                </thead>
                            @foreach($skill->reback_skills as $reback_skill)
                                <tr>
                                    <td nowrap>
                                        <?php
                                            $school_data = \App\SchoolData::where('school_code',substr($reback_skill->username,1,6))->first();
                                        ?>
                                        {{ $school_data->school_name }}
                                    </td>
                                    <td>
                                        {{ $reback_skill->class_num }}
                                    </td>
                                    <td>
                                        {{ $reback_skill->people_num }}
                                    </td>
                                    <td nowrap>
                                        @if($reback_skill->situation =="1")
                                            申請
                                        @elseif($reback_skill->situation =="2")
                                            <span class="text-success">通過</span>
                                        @elseif($reback_skill->situation =="3")
                                            <span class="text-danger">退回</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span>
                                        <a href="{{ route('skills.high_school_ok',$reback_skill->id) }}" class="btn btn-success btn-sm">過</a>
                                        <a href="{{ route('skills.high_school_notok',$reback_skill->id) }}" class="btn btn-danger btn-sm">退</a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
