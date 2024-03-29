@extends('layouts.master_back')

@section('page-title', '廠商行程管理-待審')

@section('content')
    @include('layouts.bootbox')
    <div class="row">
        <div class="col-12">
            <h1>廠商行程管理</h1>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="#">待審行程</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('visits.admin_all') }}">全部行程</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('visits.admin_list') }}">列冊下載</a>
                </li>
            </ul>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    列表
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                        <tr>
                            <th>序號</th>
                            <th>辦理單位</th>
                            <th>行程類別</th>
                            <th>行程名稱</th>
                            <th>審核狀態</th>
                            <th>動作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($visits as $visit)
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    {{ $visit->user->vendor_data->vendor_name }}
                                </td>
                                <td>
                                    {{ $visit_careers[$visit->visit_careers] }}
                                </td>
                                <td>
                                    <a href="{{ route('visits.admin_show',$visit->id) }}" target="_blank">{{ $visit->visit_name }}</a>
                                </td>
                                <td>
                                    <strong class="text-danger">審核中</strong>
                                </td>
                                <td>
                                    <a href="{{ route('visits.admin_pass',$visit->id) }}" class="btn btn-success btn-sm" onclick="return confirm('確定要通過？')">通過</a>
                                    <a href="{{ route('visits.admin_back',$visit->id) }}" class="btn btn-warning btn-sm" onclick="return confirm('確定要退回，請他重送？')">退回</a>
                                    <a href="{{ route('visits.admin_delete',$visit->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除？')">刪除</a>
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
@endsection