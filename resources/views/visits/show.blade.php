@extends('layouts.master_back')

@section('page-title', '行程內容')

@section('content')
    @include('layouts.bootbox')
    <div class="row">
        <div class="col-12">
            <h1>{{ $visit->visit_name }} 行程內容</h1>
            <small>{{ $visit->user->vendor_data->vendor_name }}</small>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    1.行程相關照片
                </div>
                <div class="card-body">
                    <div>
                        @if(!empty($files))
                            @foreach($files as $k=>$v)
                                <?php
                                $file = "visits/".$visit->id."/".$v;
                                $file = str_replace('/','&',$file);
                                ?>
                                <div style="float:left;padding: 10px;">
                                    <img src="{{ url('img/'.$file) }}" width="200">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <hr class="w-100">
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-table-title">
                    2.詳細行程資料
                </div>
                <div class="card-body">
                    <div>
                        <table class="table table-light">
                            <thead>
                            <tr>                                
                                <th nowrap>
                                    行程類別
                                </th>
                                <th nowrap>
                                    行程名稱
                                </th>
                                <th nowrap>
                                    行程簡介
                                </th>
                                <th nowrap>
                                    搜尋標籤
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{ $visit_careers[$visit->visit_careers ] }}
                                </td>
                                <td>
                                    {{ $visit->visit_name }}
                                </td>
                                <td>
                                    <?php
                                        $real_path = storage_path('app/public/visits_docx/'.$visit->id);
                                        $docx = get_files($real_path);
                                        if(!empty($docx)){
                                            $path = asset('storage/visits_docx').'/'.$visit->id.'/'.$docx[0];
                                        }
                                    ?>
                                    <?php $about = nl2br($visit->about); ?>
                                    @if(!empty($docx[0]))
                                        學習單下載：<a href="{{ $path }}"><i class="fas fa-download"></i></a>
                                        <br>
                                    @endif
                                    <p style="font-size: 1.2rem;">
                                        {!! $about !!}
                                    </p>
                                </td>
                                <td>
                                    <?php $tabs = explode(',',$visit->tabs); ?>
                                    @foreach($tabs as $k=>$v)
                                        <p class="text-info">#{{ $v }}</p>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection