@extends('layouts.master_back')

@section('page-title', '國中技藝教育管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            國中技藝教育管理
        </h1>
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skills.admin') }}">新增開辨項目</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('skills.admin_list') }}">管理開辨項目</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skills.admin_jschool') }}">管理自辦國中</a>
                </li>
            </ul>
            <br>

                <h3>請先選學年度 <a href="" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> 下載表單</a></h3>
                {{ Form::open(['route' => 'skills.admin_list','id'=>'myform', 'method' => 'POST']) }}
                {{ Form::select('semester', $semesters,$semester, ['id' => 'semester', 'class' => 'form-control','onchange'=>'$("#myform").submit()']) }}
                {{ Form::close() }}
                <hr>
                <h3>合作方式</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="150">
                            辦理學校
                        </th>
                        <th width="150">
                            開設職群
                        </th>
                        <th>
                            申請學校資料
                        </th>
                        <th>
                            動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($skill_data1 as $v)
                    <tr>
                        <td>
                            {{ $v['school'] }}
                        </td>
                        <td>
                            @foreach($v['career'] as $v1)
                                <p>{{ $careers[$v1] }}</p>
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
                                        申請班級數
                                    </th>
                                    <th nowrap>
                                        申請人數
                                    </th>
                                    <th nowrap>
                                        狀況
                                    </th>
                                    <th nowrap>
                                        動作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($reback_data))
                                    @foreach($reback_data[$v['id']] as $v3)
                                        <tr>
                                            <td>
                                                @if($v3['situation'] == "1")
                                                    <i class="fas fa-file text-warning"></i>
                                                @elseif($v3['situation'] == "2")
                                                    <i class="fas fa-check-circle text-success"></i>
                                                @elseif($v3['situation'] == "3")
                                                    <i class="fas fa-times-circle text-danger"></i>
                                                @endif
                                                {{ $v3['school'] }}
                                            </td>
                                            <td>
                                                {{ $v3['class_num'] }}
                                            </td>
                                            <td>
                                                {{ $v3['people_num'] }}
                                            </td>
                                            <td>
                                                @if($v3['situation'] == "1")
                                                    審核中
                                                @elseif($v3['situation'] == "2")
                                                    通過
                                                @elseif($v3['situation'] == "3")
                                                    退回
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('skills.admin_ok',$v3['id']) }}" class="btn btn-success btn-sm" onclick="return confirm('你確定通過審核？')"><i class="fas fa-check"></i> 過</a>
                                                <a href="{{ route('skills.admin_notok',$v3['id']) }}" class="btn btn-warning btn-sm" onclick="return confirm('你確定退回審核？')"><i class="fas fa-undo"></i> 退</a>
                                                <a href="{{ route('skills.admin_del_reback',$v3['id']) }}" class="btn btn-danger btn-sm" onclick="return confirm('你確定刪除申請嗎？')"><i class="fas fa-times"></i>  刪</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <a href="{{ route('skills.admin_del',$v['id']) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？連同申請案也刪掉喔！！')"><i class="fas fa-trash"></i> 全刪</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <h3>自辦方式</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="150">
                            辦理學校
                        </th>
                        <th width="150">
                            開設職群
                        </th>
                        <th>
                            合作學校/單位
                        </th>
                        <th>
                            動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($skill_data2 as $v)
                        <tr>
                            <td>
                                {{ $v['school'] }}
                            </td>
                            <td>
                                @foreach($v['career'] as $v2)
                                    <p>{{ $careers[$v2] }}</p>
                                @endforeach
                            </td>
                            <td>
                                @if($v['situation'] == "1")
                                    <i class="fas fa-file text-warning"></i>
                                @elseif($v['situation'] == "2")
                                    <i class="fas fa-check-circle text-success"></i>
                                @elseif($v['situation'] == "3")
                                    <i class="fas fa-times-circle text-danger"></i>
                                @endif
                                {{ $v['co_name'] }}
                            </td>
                            <td>
                                <a href="{{ route('skills.admin_del',$v['id']) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？連同申請案也刪掉喔！！')"><i class="fas fa-trash"></i> 全刪</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
