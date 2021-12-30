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
                    申請日期
                </th>
                <th nowrap>
                    狀況
                </th>
                <th nowrap>
                    心得
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($matchmakings as $matchmaking)
                <tr>
                    <td>
                        {{ $matchmaking->visit->user->vendor_data->vendor_name }}<br>
                        <small>{{ $groups[$matchmaking->visit->user->group_id] }}</small>
                    </td>
                    <td>
                        {{ $matchmaking->visit->visit_name }}
                    </td>
                    <td>
                        {{ $matchmaking->visit->user->name }}<br>
                        {{ $matchmaking->visit->user->telephone_number }}<br>
                        {{ $matchmaking->visit->user->email }}<br>
                        Line ID：{{ $matchmaking->visit->user->line_id }}<br>
                    </td>
                    <td>
                        {{ $matchmaking->created_at }}
                    </td>
                    <td>
                        @if($matchmaking->situation == "1")
                            <strong class="text-warning">申請</strong>
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
