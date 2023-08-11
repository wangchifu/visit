@extends('layouts.master_clean')

@section('page-title', '職探中心簡介')

@section('content')
    <div class="row">

            <div class="col-12">
                <div class="content-info">
                    <h2>{{ $user->name }}簡介</h2>
                    <div class="card">
                        <div class="card-header">
                            內容
                        </div>
                        <div class="card-body">
                            <?php
                                $intro_ztan = nl2br($user->intro_ztan);
                            ?>
                            {!! $intro_ztan !!}
                        </div>
                    </div>
                    <hr>
                    <h2>所屬課程</h2>
                    <table class="table table-hover table-light">

                        <thead class="card-header custom-title2">
                        <tr>
                            <th>
                                項次
                            </th>
                            <th width="120" nowrap>
                                活動時間
                            </th>
                            <th width="120" nowrap>
                                報名時間
                            </th>
                            <th width="160" nowrap>
                                活動地點
                            </th>
                            <th nowrap>
                                課程名稱
                            </th>
                            <th>
                                標籤
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($courses as $course)
                        <tr>
                            <td>
                                {{ $i }}
                            </td>
                            <td>
                                {{ $course->active_date }}
                            </td>
                            <td>
                                <p>
                                    {{ substr($course->start_date,5,5) }}~{{ substr($course->stop_date,5,5) }}
                                </p>
                            </td>
    
                            <td>
                                {{ $course->active_place }}
                            </td>
                            <td>
                                <h5>
                                    <a href="{{ route('ztans.show',$course->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-hand-point-up"></i> {{ $course->course_name }}</a>
                                </h5>
                            </td>
                            <td>
                                <?php
                                $tabs = explode(',',$course->tabs);
                                ?>
                                @foreach($tabs as $tab)
                                        <span class="badge badge-primary">{{ $tab }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>

    </div>
@endsection