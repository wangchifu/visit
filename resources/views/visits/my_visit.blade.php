@extends('layouts.master_back')

@section('page-title', '我的參訪行程')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            我的參訪行程
        </h1>
        <div class="col-12">
        <table class="table table-hover bg-light">
            <thead>
            <tr>
                <th nowrap>
                    辦理單位
                </th>
                <th nowrap>
                    行程名稱
                </th>
                <th nowrap>
                    聯絡資訊
                </th>
                <th nowrap>
                    參加狀況
                </th>
                <th nowrap>
                    申請日期<br>
                    狀況
                </th>
                <th nowrap>
                    訪後心得
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($matchmakings as $matchmaking)
                <?php
                    $visit_data = \App\VisitData::where('matchmaking_id',$matchmaking->id)->first();
                ?>
                <tr>
                    <td>
                        {{ $matchmaking->visit->user->vendor_data->vendor_name }}<br>
                        <small>{{ $groups[$matchmaking->visit->user->group_id] }}</small>
                    </td>
                    <td>
                        <a href="{{ route('searches.show',[$matchmaking->visit->id,'vendor']) }}" target="_blank">{{ $matchmaking->visit->visit_name }}</a>
                    </td>
                    <td>
                        {{ $matchmaking->visit->user->name }}<br>
                        {{ $matchmaking->visit->user->telephone_number }}<br>
                        {{ $matchmaking->visit->user->email }}<br>
                        Line ID：{{ $matchmaking->visit->user->line_id }}<br>
                    </td>
                    <td>
                        {{ $visit_data->visit_date }}<br>
                        師：{{ $visit_data->teachers }}<br>
                        年：{{ $visit_data->grade }}<br>
                        生：{{ $visit_data->studens }}
                    </td>
                    <td>
                        {{ $matchmaking->created_at }}<br>
                        @if($matchmaking->situation == "1")
                            <strong class="text-warning">申請中</strong> <a href="{{ route('matchmaking.destroy',$matchmaking->id) }}" onclick="return confirm('確定要取消申請嗎？')"><i class="fas fa-times-circle text-danger"></i></a>
                        @elseif($matchmaking->situation == "2")
                            <strong class="text-success">通過</strong>
                        @elseif($matchmaking->situation == "3")
                            <strong class="text-danger">退回</strong>
                        @endif
                    </td>
                    <td>
                        
                        <a href="{{ route('experiences.index',$matchmaking) }}" class="btn btn-primary btm-sm"><i class="fas fa-upload"></i> 上傳</a>
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        </div>
    </div>
</div>
@endsection
