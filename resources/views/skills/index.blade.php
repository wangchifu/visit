@extends('layouts.master')

@section('page-title', '國中技藝教育')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="col-12">
            國中技藝教育
        </h2>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">國中技藝教育列表</li>
                </ol>
            </nav>

                <table class="table table-hover table-light">
                    <thead class="card-header custom-title2">
                    <tr>
                        <th nowrap>
                            方式
                        </th>
                        <th nowrap width="200">
                            辦理學校
                        </th>
                        <th nowrap width="400">
                            開設職群
                        </th>
                        <th nowrap>
                            動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($skill_data as $v)
                    <tr>
                        <td>
                            {{ $v['type'] }}
                        </td>
                        <td>
                            {{ $v['school'] }}
                        </td>
                        <td>
                            {!! $v['career'] !!}
                        </td>
                        <td>
                            <a href="{{ route('skills.show',$v['id']) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> 詳看內容</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $skills->links() }}

        </div>
    </div>
</div>
@endsection
