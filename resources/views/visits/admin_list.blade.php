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
                    <ul class="list-group">
                        <li class="list-group-item">1.建立及公告相關產(企)業參訪地點資訊<br>
                            <form action="{{ route('visits.admin_list_download') }}" method="post">
                            @csrf
                            起：<input type="date" name="start" required><br>
                            迄：<input type="date" name="stop" required><br>
                            <input type="hidden" name="action" value="action1">
                            <input type="submit" name="submit" value="列出名冊">
                            <input type="submit" name="submit" value="下載 Excel">
                            </form>
                        </li>
                        <li class="list-group-item">2.建立及公告職涯宣講人員名單<br>
                            <form action="{{ route('visits.admin_list_download') }}" method="post">
                            @csrf
                            起：<input type="date" name="start" required><br>
                            迄：<input type="date" name="stop" required><br>
                            <input type="hidden" name="action" value="action2">
                            <input type="submit" name="submit" value="列出名冊">
                            <input type="submit" name="submit" value="下載 Excel">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection