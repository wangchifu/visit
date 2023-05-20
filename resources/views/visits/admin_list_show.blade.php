@extends('layouts.master_back')

@section('page-title', '廠商行程管理-全部')

@section('content')
    @include('layouts.bootbox')
    <div class="row">
        <div class="col-12">
            <h1>廠商行程管理</h1>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('visits.admin') }}">待審行程</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('visits.admin_all') }}">全部行程</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">列冊下載</a>
                </li>
            </ul>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    列冊
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-success btn-sm" onclick="history.back()"><i class="fas fa-backward"></i> 返回</a>
                    <table border='1'>
                        <tr>
                            @foreach($data[1] as $k=>$v)
                            <th>{{ $k }}</th>
                            @endforeach
                        </tr>
                        @foreach($data as $k1=>$v1)
                            <tr>
                            @foreach($v1 as $k2=>$v2)
                            <td>{{ $v2 }}</td>
                            @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection