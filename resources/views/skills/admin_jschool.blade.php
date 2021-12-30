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
                    <a class="nav-link" href="{{ route('skills.admin_list') }}">管理開辨項目</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('skills.admin_jschool') }}">管理自辦國中</a>
                </li>
            </ul>
            <br>
            <div class="card">
                <div class="card-header">
                    學校列表
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th nowrap>
                                序號
                            </th>
                            <th nowrap width="160">
                                s+學校代碼
                            </th>
                            <th nowrap width="160">
                                學校名稱
                            </th>
                            <th>
                                狀態
                            </th>
                            <th nowrap>
                                動作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {{ Form::open(['route' => 'skills.admin_jschool_store', 'method' => 'POST','id'=>'add_user']) }}
                        <tr>
                            <td>

                            </td>
                            <td>
                                <input type="text" class="form-control" name="jschool_code" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="jschool_name" required>
                            </td>
                            <td>

                            </td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('確定新增？')"><i class="fas fa-plus-circle"></i> 新增學校</button>
                            </td>
                        </tr>
                        {{ Form::close() }}
                        <?php $i=1; ?>
                        @foreach($jschools as $jschool)
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    {{ $jschool->jschool_code }}
                                </td>
                                <td>
                                    @if($jschool->disable == "1")
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @else
                                        <i class="fas fa-check-circle text-success"></i>
                                    @endif
                                    {{ $jschool->jschool_name }}
                                </td>
                                <td>
                                    @if($jschool->disable == "1")
                                        <strong class="text-danger">停用</strong>
                                    @else
                                        <strong class="text-success">啟用</strong>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('skills.admin_jschool_change',$jschool->id) }}" class="btn btn-primary btn-sm" onclick="return confirm('確定更改？')">變更啟用</a>
                                    <a href="{{ route('skills.admin_jschool_del',$jschool->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('刪除會一併刪除該校的所有技藝班資料，真的要刪？不考慮用停用的？')">刪除學校</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
