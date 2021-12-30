@extends('layouts.master_clean')

@section('page-title', '觀看參訪體驗心得')

@section('content')
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
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>
                觀看參訪體驗心得
            </h1>
            <div class="card">
                <div class="card-header">
                    <h4>{{ $type }}：{{ $active_name }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label><strong class="text-danger">辦理單位</strong></label>
                        <br>
                        {{ $do_user }}
                    </div>
                    <div class="form-group">
                        <label><strong class="text-danger">參加單位</strong></label>
                        <br>
                        {{ $experience->user->school_data->school_name }}
                    </div>
                    <div class="form-group">
                        <label><strong class="text-danger">心得感想</strong></label>
                        <br>
                        <?php $show = nl2br($experience->experience); ?>
                        {!! $show !!}

                    </div>
                    <div class="form-group">
                        <label><strong class="text-danger">活動照片</strong></label>
                        <br>
                        @foreach($files as $v)
                            <?php $file = 'experiences&'.$experience->id.'&'.$v; ?>
                            <p><img src="{{ url('file/'.$file) }}" width="500"></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
