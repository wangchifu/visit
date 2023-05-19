@extends('layouts.master_back')

@section('page-title', '查看全部心得')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">
            查看全部心得
        </h1>
        <div class="col-12">
        <table class="table table-hover bg-light">
            <thead>
            <tr>
                <th>
                    時間
                </th>
                <th nowrap>
                    心得填寫人
                </th>
                <th nowrap>
                    心得內容
                </th>
                <th nowrap>
                    附圖
                </th>
                <th>
                    動作
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($experiences as $experience)
                <tr>
                    <td>
                       {{ $experience->created_at }}
                    </td>
                    <td>
                        {{ $experience->user->school_data->school_name }} {{ $experience->user->name }}
                    </td>
                    <td>
                        {{ $experience->experience }}
                    </td>
                    <td>
                        <?php
                        $folder = storage_path('app/public/experiences/'.$experience->id);
                        $files = get_files($folder);
                        ?>
                        @foreach($files as $k=>$v)
                            <?php $file = 'experiences&'.$experience->id.'&'.$v; ?>
                            <a href="{{ url('img/'.$file) }}" target="_blank"><i class="fas fa-file"></i>{{$k+1}}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin_destroy',$experience->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定嗎？')">刪除</a>
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
