@extends('layouts.master_back')

@section('page-title', '廠商帳號')

@section('content')
    <?php
    foreach(config('app.groups') as $k=>$v){
        if($k==16 or $k==32){
            $groups_select[$k] = $k.$v;
        }        
    }
    ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>廠商帳號</h1>
            {{ Form::open(['route' => 'visits.vendor_user', 'method' => 'POST','id'=>'all_user']) }}
            <div class="form-group">
                <label for="group_id" class="col-md-4 col-form-label"><strong class="text-danger">請選擇群組</strong></label>
                <div class="col-md-12">
                    {{ Form::select('group_id', $groups_select,$group_id, ['id' => 'group_id', 'class' => 'form-control','required'=>'required','onchange'=>"$('#all_user').submit()"]) }}
                </div>
            </div>
            {{ Form::close() }}
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        帳號
                    </th>
                    <th>
                        名稱
                    </th>
                    <th>
                        單位
                    </th>
                    <th>
                        動作
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->username }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                    @if($group_id == "2")
                        {{ $user->school_data->school_name }}
                    @endif
                    @if($group_id >= "8")
                        @if(!empty($user->vendor_data))
                        {{ $user->vendor_data->vendor_name }}
                        @endif
                    @endif
                    </td>
                    <td>
                        @if($user->id != auth()->user()->id)
                        <a href="{{ route('sims.impersonate_vendor',$user->id) }}" class="btn btn-secondary btn-sm" onclick="return confirm('確定要模擬這個帳號？')">模擬</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection