@extends('layouts.master_back')

@section('page-title', '報名資訊管理')

@section('content')
<div class="container">
    <h1></i> [ {{ $course->course_name }} ] 報名表</h1>
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">課程管理</a></li>
                <li class="breadcrumb-item active" aria-current="page">設計課程報名表</li>
            </ol>
        </nav>
        <a href="{{ route('questions.create',$course->id) }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> 新增題目</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="2" nowrap>順序</th>
                    <th nowrap>題目</th>
                    <th width="500">作答選項示範</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($questions as $question)
            <tr>
                <td width="30">
                    {{ $i }}
                </td>
                <td>
                    {{ Form::open(['route' => ['questions.destroy',$question->id], 'method' => 'DELETE','id'=>'delete'.$question->id]) }}
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除這題？會刪除底下這題的任何已填資料喔！')">刪</button>
                    {{ Form::close() }}
                </td>
                <td>
                    <p> {{ $question->title }}</p>
                    @if($question->description)
                    <small class="text-primary">({{ $question->description }})</small>
                    @endif
                </td>
                <td>
                    @if($question->type == "text")
                        <div class="row">
                            <div class="col-3">
                                <strong>單行文字：</strong>
                            </div>
                            <div class="col-9">
                                <input name="Q{{ $question->id }}" type="{{ $question->type }}" class="form-control" placeholder="單行文字範例">
                            </div>
                        </div>

                    @elseif($question->type == "radio")
                        <?php
                        $items = unserialize($question->option);
                        ?>
                        <div class="row">
                            <div class="col-3">
                                <strong>單選：</strong>
                            </div>
                            <div class="col-9">
                                @foreach($items as $k=>$v)
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input id="q{{ $question->id }}{{ $k }}" class="form-check-input" name="Q{{ $question->id }}" type="radio" value="1">
                                            <label class="form-check-label" for="q{{ $question->id }}{{ $k }}">{{ $v }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    @elseif($question->type == "checkbox")
                        <?php
                        $items = unserialize($question->option);
                        ?>
                        <div class="row">
                            <div class="col-3">
                                <strong>多選：</strong>
                            </div>
                            <div class="col-9">
                                @foreach($items as $k=>$v)
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input id="q{{ $question->id }}{{ $k }}" class="form-check-input" name="Q{{ $question->id }}[]" type="checkbox" value="1">
                                            <label class="form-check-label" for="q{{ $question->id }}{{ $k }}">{{ $v }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    @elseif($question->type == "textarea")
                        <div class="row">
                            <div class="col-3">
                                <strong>多行文字：</strong>
                            </div>
                            <div class="col-9">
                                <textarea name="Q{{ $question->id }}" class="form-control" placeholder="第一行&#X0a;第二行"></textarea>
                            </div>
                        </div>

                    @endif
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection