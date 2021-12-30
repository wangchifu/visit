@extends('layouts.master_back')

@section('page-title', '查看全部媒合')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            查看全部媒合
        </h1>
        <div class="col-12">
        <table class="table table-hover bg-light">
            <thead>
            <tr>
                <th>
                    類別
                </th>
                <th nowrap>
                    辦理單位
                </th>
                <th nowrap>
                    行程名稱
                </th>
                <th nowrap>
                    申請單位
                </th>
                <th nowrap>
                    申請時間
                </th>
                <th nowrap>
                    狀況
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($matchmakings as $matchmaking)
                <tr>
                    <td>
                        <?php
                        if(empty($matchmaking->course_id)){
                            $type = "參訪行程";
                            $do_user = $matchmaking->visit->user->vendor_data->vendor_name;
                            $active_name = $matchmaking->visit->visit_name;
                        }else{
                            $type = "職探課程";
                            $active_name = $matchmaking->course->course_name;
                            $do_user = $matchmaking->course->user->name;
                        }
                        ?>
                        {{ $type }}
                    </td>
                    <td>
                        {{ $do_user }}
                    </td>
                    <td>
                        {{ $active_name }}
                    </td>
                    <td>
                        {{ $matchmaking->user->school_data->school_name }}
                    </td>
                    <td>
                        {{ $matchmaking->created_at }}
                    </td>
                    <td>
                        @if($matchmaking->situation == "1")
                            <strong class="text-warning">申請中</strong>
                        @elseif($matchmaking->situation == "2")
                            <strong class="text-success">同意</strong>
                        @elseif($matchmaking->situation == "3")
                            <strong class="text-danger">退回</strong>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $matchmakings->links() }}
        </div>
    </div>
</div>
@endsection
