@extends('layouts.master_back')

@section('page-title', '行程管理')

@section('content')
    @include('layouts.bootbox')
    <div class="row">
        <div class="col-12">
            <h1>{{ $user->vendor_data->vendor_name }} 行程維護</h1>
        </div>
        <div class="col-12">
            <a href="{{ route('visits.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> 新增行程</a>
        </div>
        <br>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    綜合資訊
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                        <tr>
                            <th>序號</th>
                            <th>行程名稱</th>
                            <th>瀏覽</th>
                            <th>參訪</th>
                            <th>審核</th>
                            <th>動作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($user->visits as $visit)
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    {{ $visit->visit_name }}
                                </td>
                                <td>
                                    {{ $visit->views }}
                                </td>
                                <td>
                                    {{ $visit->visits }}
                                </td>
                                <td>
                                    @if($visit->disable=="1")
                                        <strong class="text-warning">送審中</strong>
                                    @elseif($visit->disable=="2")
                                        <strong class="text-danger">請重送</strong>
                                    @elseif($visit->disable==null)
                                        <strong class="text-success">已通過</strong>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('visits.matching',$visit->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-users"></i> 已報
                                        <span class="badge badge-light">{{ count($visit->matchmakings) }}</span>
                                    </a>
                                    <a href="{{ route('visits.show',$visit->id) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-eye"></i> 詳細</a>
                                    <a href="{{ route('visits.edit',$visit->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> 編輯</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm('您確定要刪除嗎?')) $('#delete{{ $visit->id }}').submit();else return false"><i class="fas fa-trash"></i> 刪除</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            {{ Form::open(['route' => ['visits.destroy',$visit->id], 'method' => 'DELETE','id'=>'delete'.$visit->id]) }}
                            {{ Form::close() }}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection