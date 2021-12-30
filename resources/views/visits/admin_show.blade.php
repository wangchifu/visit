@extends('layouts.master_clean')

@section('page-title', $visit->visit_name)

@section('content')
    <h2>{{ $visit->visit_name }}</h2>
    <div class="col-12">
        <div class="card">
            <div class="card-header custom-title">
                詳細內容
            </div>
            <div class="card-body">
                <table class="table table-bordered table-light">
                    <tr>
                        <td width="130">
                            <strong>名稱/類別</strong>
                        </td>
                        <td>
                        <span class="badge badge-primary">{{ $visit->user->vendor_data->vendor_name }}
                            <span class="badge badge-light">{{ $groups[$visit->user->group_id] }}</span>
                        </span>
                            <span class="badge badge-info">點閱
                            <span class="badge badge-light">{{ $visit->views }}</span>
                        </span>
                            <span class="badge badge-success">參訪
                            <span class="badge badge-light">{{ $visit->visits }}</span>
                        </span>

                        </td>
                        <td width="120">
                            <strong>單位網址</strong>
                        </td>
                        <td>
                            @if(empty($visit->user->website))
                                -
                            @else
                                <a href="{{ $visit->user->website }}" target="_blank"><i class="fas fa-globe"></i></a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>單位簡介</strong>
                        </td>
                        <td colspan="3">
                            <?php $vendor_about = nl2br($visit->user->vendor_data->about); ?>
                            {!! $vendor_about !!}
                        </td>
                    </tr>
                    @if($visit->user->group_id == 8)
                        <tr>
                            <td>
                                <strong>科系學習內容</strong>
                            </td>
                            <td colspan="3">
                                <?php $visit_about = nl2br($visit->about); ?>
                                {!! $visit_about !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>畢業生出路</strong>
                            </td>
                            <td colspan="3">
                                <?php $graduate = nl2br($visit->graduate); ?>
                                {!! $graduate !!}
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>
                                <strong>行程簡介</strong>
                            </td>
                            <td colspan="3">
                                <?php $visit_about = nl2br($visit->about); ?>
                                {!! $visit_about !!}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            <strong>照片集</strong>
                        </td>
                        <td colspan="3">
                            @if(!empty($files))
                                @foreach($files as $k=>$v)
                                    <?php
                                    $file = "visits/".$visit->id."/".$v;
                                    $file = str_replace('/','&',$file);
                                    ?>
                                    <div style="float:left;padding: 10px;">
                                        <a href="{{ url('img/'.$file) }}" target="_blank"><img src="{{ url('img/'.$file) }}" width="200"></a>
                                    </div>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>單位地址</strong>
                        </td>
                        <td colspan="3">
                            {{ $visit->user->address }}
                        </td>
                    </tr>
                    @auth
                        <tr>
                            <td>
                                <strong>聯絡資訊</strong>
                            </td>
                            <td colspan="3">
                                聯絡人：{{ $visit->user->name }}<br>
                                聯絡電話：{{ $visit->user->telephone_number }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>電子郵件</strong>
                            </td>
                            <td colspan="3">
                                {{ $visit->user->email }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Line ID</strong>
                            </td>
                            <td colspan="3">
                                {{ $visit->user->line_id }}<br>
                            </td>
                        </tr>
                    @endauth
                    <tr>
                        <td>
                            <strong>關鍵字</strong>
                        </td>
                        <td colspan="3">
                            @foreach(explode(',',$visit->tabs) as $v)
                                <a href="{{ route('searches.tab',$v) }}"><span class="badge badge-pill badge-info">#{{ $v }}</span></a>
                            @endforeach
                        </td>
                    </tr>
                </table>
                @if(auth()->check())
                    @if(auth()->user()->group_id == 2)
                        <?php
                        $check = \App\Matchmaking::where('user_id',auth()->user()->id)
                            ->where('visit_id',$visit->id)
                            ->first();
                        ?>
                        @if(!empty($check))
                            <strong class="text-danger">你已申請</strong>
                        @else
                            <a href="{{ route('matchmaking.store',$visit->id) }}" class="btn btn-success" id="create" onclick="return confirm('確定要參訪？')"><i class="fas fa-play"></i> 我要參訪</a>
                        @endif
                    @endif
                @else
                    <a href="{{ route('gsuite.login') }}" class="btn btn-danger">國中小端請先登入</a>
                @endif
            </div>
        </div>
    </div>
@endsection
