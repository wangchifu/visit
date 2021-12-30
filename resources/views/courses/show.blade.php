@extends('layouts.master_back')

@section('page-title', '職探課程管理')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            職探課程報名表示範
        </h1>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">職探課程管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">職探課程報名表示範</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">報名表示範</div>
                <div class="card-body">
                    <?php $i=1; ?>
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
                                            {{ Form::radio('answer['.$k.']',$v2,null,['class'=>'form-check-input','id'=>'answer'.$k.'-'.$k2]) }}
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
                                {{ Form::text('answer['.$k.']',null,['class' => 'form-control','id'=>'answer'.$k]) }}
                            @endif
                            @if($v['type']=="textarea")
                                {{ Form::textarea('answer['.$k.']',null,['class' => 'form-control','id'=>'answer'.$k]) }}
                            @endif
                        </div>
                    <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
