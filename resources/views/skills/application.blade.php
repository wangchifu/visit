@extends('layouts.master')

@section('page-title', '國中技藝教育申請')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            國中技藝教育申請
        </h1>
        <div class="col-12">
                {{ Form::open(['route' => 'skills.application_store', 'method' => 'POST']) }}
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th nowrap>
                            辦理學校
                        </th>
                        <th nowrap>
                            開設職群
                        </th>
                        <th nowrap>
                            開班方式
                        </th>
                        <th nowrap width="150">
                            申請單位
                        </th>
                        <th nowrap width="150">
                            申請班數
                        </th>
                        <th width="150">
                            申請人數
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            {{ $skill_data['school'] }}
                        </td>
                        <td nowrap>
                            @foreach($career_ids as $v)
                                <p>{{ $careers[$v] }}</p>
                            @endforeach
                        </td>
                        <td>
                            {{ $skill_data['type'] }}
                        </td>
                        <td>
                            {{ auth()->user()->school_data->school_name }}
                        </td>
                        <td>
                            {{ Form::text('class_num',null,['id'=>'class_num','class' => 'form-control','required'=>'required']) }}
                        </td>
                        <td>
                            {{ Form::text('people_num',null,['id'=>'people_num','class' => 'form-control','required'=>'required']) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                    <input type="hidden" name="skill_id" value="{{ $skill_data['id'] }}">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="if(confirm('您確定送出嗎?')) return true;else return false"><i class="fas fa-plane"></i> 送出申請</button>
                {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
