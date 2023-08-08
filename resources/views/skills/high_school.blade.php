@extends('layouts.master_back')

@section('page-title', '高中職-國中技藝教育')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            高中職-國中技藝教育：管理
        </h1>
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('skills.high_school') }}">高中職技藝管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skills.high_school_show_co') }}">審核合作學校</a>
                </li>
            </ul>
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <!--
                        <th width="150">
                            學期
                        </th>
                        -->
                        <th width="200">
                            辦理學校
                        </th>
                        <th>
                            開設職群
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($skills as $skill)
                    <tr>
                        <!--
                        <td>
                            {{ $skill->semester }}
                        </td>
                        -->
                        <td>
                            {{ $school_name }}
                        </td>
                        <td>
                            <?php
                                $career_ids = unserialize($skill->career_ids);
                                $careers = config('app.careers');
                            ?>
                            @foreach($career_ids as $v)
                                <p>{{ $careers[$v] }} <a href="{{ route('skills.edit_data',['skill_id'=>$skill->id,'career_id'=>$v]) }}" class="btn btn-round"><i class="fas fa-edit"></i> 編輯資訊</a></p>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
