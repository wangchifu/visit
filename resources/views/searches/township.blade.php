@extends('layouts.master')

@section('page-title', $township_name)

@section('content')
    <div class="row">
        <h2>{{ $township_name }}參訪查詢</h2>
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('map') }}">參訪體驗地圖</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $township_name }}</li>
                    <li class="">　　<a href="#" class="badge badge-secondary" onclick="history.back()"><i class="fas fa-chevron-circle-left"></i> 返回</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-title">
                    <strong>{{ $township_name }}行程列表</strong>
                </div>
                <div class="card-body">

                    @foreach($visits as $visit)
                        <?php
                        $about = str_limit($visit->about,100);
                        $files = get_files(storage_path('app/public/visits/'.$visit->id));
                        if(empty($files)){
                            $img = asset('images/700x300.png');
                        }else{
                            $file = "visits/".$visit->id."/".$files[0];
                            $real_file = str_replace('/','&',$file);
                            $img = url('img/'.$real_file);
                        }

                        ?>

                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid rounded mb-3 mb-md-0" src="{{ $img }}" alt="標題圖片">
                                <br>
                                <br>
                                <a class="btn btn-primary btn-sm" href="{{ route('searches.show',['visit'=>$visit->id,'action'=>'townships']) }}"><i class="fas fa-eye"></i>  詳細內容</a>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <table class="table table-light">
                                        <tr>
                                            <td>
                                                <h3>{{ $visit->visit_name }}</h3>
                                                <small>{{ $visit->vendor_name }}</small>
                                                <p>{{ $about }}</p>
                                            </td>
                                            <td class="text-right" width="135" nowrap>
                                                <span class="badge badge-info">點閱
                                                    <span class="badge badge-light">{{ $visit->views }}</span>
                                                </span>
                                                <span class="badge badge-success">參訪
                                                    <span class="badge badge-light">{{ $visit->visits }}</span>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                        <hr>
                    @endforeach
                    {{ $visits->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection
