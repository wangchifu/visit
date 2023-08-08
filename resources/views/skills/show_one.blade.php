@extends('layouts.master_clean')

@section('page-title', '國中技藝教育')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            國中技藝教育-職群介紹
        </h1>
        <div class="col-12">
            <!--
            <h3>學期：{{ $skill->semester }}</h3>-->
            <h3>承辦學校：{{ $school_data['name'] }}</h3>
            <h3>辦理方式：{{ $school_data['type'] }}</h3>
            <div class="card">
                <div class="card-header">
                    <h4>{{ $careers[$career_id] }}</h4>
                </div>
                <div class="card-body">
                    <?php
                    if(!empty($skill_data)){
                        $course = nl2br($skill_data->course);
                        $excellent = nl2br($skill_data->excellent);
                    }else{
                        $course = "";
                        $excellent = "";
                    }
                    ?>
                    <div class="form-group">
                        <label for="course"><strong class="text-danger">課程內容大綱</strong></label>
                        <br>
                        {!! $course !!}
                    </div>
                    @if(!empty($excellent))
                    <div class="form-group">
                        <label for="excellent"><strong class="text-danger">優良事蹟</strong></label>
                        <br>
                        {!! $excellent !!}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="files[]"><strong class="text-danger">活動照片</strong></label>
                        <br>
                        @foreach($files as $v)
                            <?php
                                $path = "skill_datas&".$skill_data->id."&".$v;
                            ?>
                            <img src="{{ url('file/'.$path) }}" width="500">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
