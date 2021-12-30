@extends('layouts.master_back')

@section('page-title', '國中技藝教育')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            國中技藝教育
        </h1>
        <div class="col-12">
        <table class="table table-hover bg-light">
            <thead>
            <tr>
                <th>
                    辦理學校
                </th>
                <th>
                    方式
                </th>
                <th>
                    開設職群
                </th>
                <th>
                    合作單位
                </th>
                <th>
                    班級數
                </th>
                <th>
                    人數
                </th>
                <th>
                    狀況
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($my_skill as $k => $v)
                <tr>
                    <td>
                        @if($v['situation'] == "1")
                            <span class="text-warning"><i class="fas fa-pause-circle"></i></span>
                        @elseif($v['situation'] == "2")
                            <span class="text-success"><i class="fas fa-check-circle"></i></span>
                        @elseif($v['situation'] == "3")
                            <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                        @endif
                        {{ $v['school'] }}
                    </td>
                    <td>
                        {{ $v['type'] }}
                    </td>
                    <td>
                        @foreach($v['career_ids'] as $v2)
                            <p>{{ $careers[$v2] }}<a href="{{ route('skills.edit_data',['skill_id'=>$v['skill_id'],'career_id'=>$v2]) }}" class="btn btn-round"><i class="fas fa-edit"></i> 編輯資訊</a></p>
                        @endforeach
                    </td>
                    <td>
                        {{ $v['co_name'] }}
                    </td>
                    <td>
                        {{ $v['class_num'] }}
                    </td>
                    <td>
                        {{ $v['people_num'] }}
                    </td>
                    <td>
                        @if($v['situation'] == "1")
                            <strong><span class="text-warning">申請中</span></strong>
                        @elseif($v['situation'] == "2")
                            <strong><span class="text-success">通過</span></strong>
                        @elseif($v['situation'] == "3")
                            <strong><span class="text-danger">退回</span></strong>
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
