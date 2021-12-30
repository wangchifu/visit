@extends('layouts.master')

@section('page-title', '參訪心得')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="col-12">
            參訪體驗心得
        </h2>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">參訪體驗心得列表</li>
                </ol>
            </nav>

                <table class="table table-hover table-light">
                    <thead class="card-header custom-title2">
                    <tr>
                        <th nowrap>
                            類別
                        </th>
                        <th nowrap>
                            辦理單位
                        </th>
                        <th>
                            活動名稱
                        </th>
                        <th nowrap>
                            參訪學校
                        </th>
                        <th nowrap>
                            動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($experiences as $experience)
                        <tr>
                            <td>
                                <?php
                                    if(empty($experience->matchmaking->course_id)){
                                        $type = "參訪行程";
                                        $do_user = $experience->matchmaking->visit->user->vendor_data->vendor_name;
                                        $active_name = $experience->matchmaking->visit->visit_name;
                                    }else{
                                        $type = "職探課程";
                                        $active_name = $experience->matchmaking->course->course_name;
                                        $do_user = $experience->matchmaking->course->user->name;
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
                                {{ $experience->user->school_data->school_name }}
                            </td>
                            <td>
                                <a href="{{ route('experience.guest_show',$experience->id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-eye"></i> 看內容</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $experiences->links() }}
        </div>
    </div>
</div>
@endsection
