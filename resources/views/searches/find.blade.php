@extends('layouts.master')

@section('page-title', '搜尋'.$find)

@section('content')
    <div class="row">
        <h2>{{ $groups[$group_id] }}查詢「{{ $find }}」行程</h2>
        <div class="col-12">
            <div class="card">
                <div class="card-header custom-title2">
                    <strong>「{{ $find }}」 行程列表</strong>　　　　<a href="#" class="badge badge-secondary" onclick="history.back()"><i class="fas fa-chevron-circle-left"></i> 返回</a>
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
                                <small>{{ $visit->vendor_name }}</small>
                                <img class="img-fluid rounded mb-3 mb-md-0" src="{{ $img }}" alt="標題圖片">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <table class="table table-light">
                                        <tr>
                                            <td>
                                                <h3>{{ $visit->visit_name }}</h3>
                                                <h5>{{ $visit_careers[$visit->visit_careers] }}</h5>
                                            </td>
                                            <td class="text-left">
                                                @foreach(explode(',',$visit->tabs) as $v)
                                                    <a href="{{ route('searches.tab',$v) }}"><span class="badge badge-danger">#{{ $v }}</span></a>
                                                @endforeach
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
                                        <tr>
                                            <td colspan="3">
                                                <p>{{ $about }}<a href="{{ route('searches.show',['visit'=>$visit->id,'action'=>'vendor']) }}" class="btn"><i class="fas fa-eye"></i> 看詳細</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
