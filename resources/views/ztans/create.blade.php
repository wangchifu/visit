@extends('layouts.master')

@section('page-title', '職探課程列表')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            {{ $course->active_date }} {{ $course->course_name }}<small>({{ $course->active_place }})</small>
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('ztans.index') }}">職探課程列表</a></li>
                    <li class="breadcrumb-item active" aria-current="page">填寫報名表單</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">填寫報名表單</div>
                <div class="card-body">
                    <h3 class="text-primary">{{ auth()->user()->school_data->school_name }} {{ auth()->user()->name }}</h3>
                    @if(empty($matchmaking->id))
                        <?php $i=1; ?>
                        {{ Form::open(['route' => 'ztans.store', 'method' => 'POST','id'=>'store']) }}
                        @foreach($questions as $k=>$v)
                            <div class="form-group">
                                <label for="answer{{ $k }}">
                                    <strong>{{ $i }}. {{ $v['title'] }}</strong>
                                    @if(!empty($v['description']))
                                        <small class="text-primary">({{ $v['description'] }})</small>
                                    @endif
                                </label>
                                @if($v['type']=="radio")
                                    <?php $radio = unserialize($v['option']); ?>
                                    @foreach($radio as $k2=>$v2)
                                        <div class="form-group">
                                            <div class="form-check">
                                                {{ Form::radio('answer['.$k.']',$v2,null,['class'=>'form-check-input','required'=>'required','id'=>'answer'.$k.'-'.$k2]) }}
                                                <label class="form-check-label" for="answer{{ $k }}-{{$k2}}"><span class="btn btn-info btn-sm">{{ $v2 }}</span></label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($v['type']=="checkbox")
                                    <?php $checkbox = unserialize($v['option']); ?>

                                    @foreach($checkbox as $k2=>$v2)
                                        <div class="form-group">
                                            <div class="form-check">
                                                {{ Form::checkbox('answer['.$k.'][]',$v2,null,['class'=>'form-check-input','id'=>'answer'.$k.'-'.$k2]) }}
                                                <label class="form-check-label" for="answer{{ $k }}-{{$k2}}"><span class="btn btn-info btn-sm">{{ $v2 }}</span></label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($v['type']=="text")
                                    {{ Form::text('answer['.$k.']',null,['class' => 'form-control','required'=>'required','id'=>'answer'.$k]) }}
                                @endif
                                @if($v['type']=="textarea")
                                    {{ Form::textarea('answer['.$k.']',null,['class' => 'form-control','required'=>'required','rows'=>'3','id'=>'answer'.$k]) }}
                                @endif
                            </div>
                            <?php $i++; ?>
                        @endforeach
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('確定報名？')"><i class="fas fa-paper-plane"></i> 送出</button>
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        {{ Form::close() }}
                    @else
                        <h4>
                            你已報名
                            @if($matchmaking->situation == 1)
                                <span class="text-warning"> -申請中</span>
                            @elseif($matchmaking->situation == 2)
                                <span class="text-success"> -通過申請</span>
                            @endif
                        </h4>
                        請至 <a href="{{ route('matchmakings.ztans_index') }}" class="btn btn-primary btn-sm"><i class="fas fa-file"></i> 我的報名</a> 看詳細內容
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
