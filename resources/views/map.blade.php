@extends('layouts.master_map')

@section('page-title', '參訪體驗地圖')

@section('content')
    <div class="row">
        <div class="index-map indexmap-bg">
            <div class="col-12">
                <div class="">
                    <h2>參訪體驗地圖</h2>
                    <h5>An Experience Map</h5>
                    <!-- Pop UP -->
                    <div class="col-12">
                        <!-- 彰化市 -->
                        <div class="modal fade" id="defaultModal500" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">彰化市 <small>Changhua
                                                City</small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/500.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','500') }}'">探索本市</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 芬園鄉 -->
                        <div class="modal fade" id="defaultModal502" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">芬園鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/502.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','502') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 花壇鄉 -->
                        <div class="modal fade" id="defaultModal503" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">花壇鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/503.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','503') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 秀水鄉 -->
                        <div class="modal fade" id="defaultModal504" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">秀水鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/504.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','504') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 鹿港鎮 -->
                        <div class="modal fade" id="defaultModal505" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">鹿港鎮 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/505.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','505') }}'">探索本鎮</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 福興鄉 -->
                        <div class="modal fade" id="defaultModal506" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">福興鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/506.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','506') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 線西鄉 -->
                        <div class="modal fade" id="defaultModal507" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">線西鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/507.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','507') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 和美鎮 -->
                        <div class="modal fade" id="defaultModal508" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">和美鎮 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/508.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','508') }}'">探索本鎮</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 伸港鄉 -->
                        <div class="modal fade" id="defaultModal509" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">伸港鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/509.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','509') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 員林市 -->
                        <div class="modal fade" id="defaultModal510" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">員林市 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/510.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','510') }}'">探索本市</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 社頭鄉 -->
                        <div class="modal fade" id="defaultModal511" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">社頭鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/511.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','511') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 永靖鄉 -->
                        <div class="modal fade" id="defaultModal512" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">永靖鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/512.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','512') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 埔心鄉 -->
                        <div class="modal fade" id="defaultModal513" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">埔心鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/513.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','513') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 溪湖鎮 -->
                        <div class="modal fade" id="defaultModal514" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">溪湖鎮 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/514.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','514') }}'">探索本鎮</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 大村鄉 -->
                        <div class="modal fade" id="defaultModal515" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">大村鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/515.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','515') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 埔鹽鄉 -->
                        <div class="modal fade" id="defaultModal516" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">埔鹽鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/516.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','516') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 田中鎮 -->
                        <div class="modal fade" id="defaultModal520" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">田中鎮 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/520.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','520') }}'">探索本鎮</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 北斗鎮 -->
                        <div class="modal fade" id="defaultModal521" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">北斗鎮 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/521.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','521') }}'">探索本鎮</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 田尾鄉 -->
                        <div class="modal fade" id="defaultModal522" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">田尾鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/522.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','522') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 埤頭鄉 -->
                        <div class="modal fade" id="defaultModal523" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">埤頭鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/523.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','523') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 溪州鄉 -->
                        <div class="modal fade" id="defaultModal524" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">溪州鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/524.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','524') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 竹塘鄉 -->
                        <div class="modal fade" id="defaultModal525" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">竹塘鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/525.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','525') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 二林鎮 -->
                        <div class="modal fade" id="defaultModal526" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">二林鎮 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/526.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','526') }}'">探索本鎮</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 大城鄉 -->
                        <div class="modal fade" id="defaultModal527" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">大城鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/527.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','527') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 芳苑鄉 -->
                        <div class="modal fade" id="defaultModal528" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">芳苑鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/528.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','528') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 二水鄉 -->
                        <div class="modal fade" id="defaultModal530" role="dialog" aria-labelledby="defaultModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">二水鄉 <small></small></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- MAP-INFO -->
                                        <iframe src="{{ asset('template/530.html') }}" id="mapFrame" style="width:100%; min-height: 485px; border: none;"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-round-lg btn-default"
                                                data-dismiss="modal" onclick="javascript:location.href='{{ route('searches.township','530') }}'">探索本鄉</button>
                                        <button type="button" class="btn btn-round-lg btn-light"
                                                data-dismiss="modal">關閉</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-body text-center">

                        <div id="mapGroup" class="contRelative">
                            <img src="{{ asset('template/images/map/11.svg') }}" id="mapAll" />
                            <img id="mapHover" style="display: none;" />
                            <img src="{{ 'template/images/blank.png' }}" usemap="#Map" id="mapShapemap" />
                        </div>
                        <map name="Map" id="Map">
                            <area shape="poly" coords="327,322,327,360,313,382,327,387,337,377,352,381,358,389,371,391,381,384,391,386,395,389,401,388,384,374,385,355,375,346,369,343,377,331,362,334,352,324"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal513" alt="埔心鄉" title="埔心鄉" onmouseover="javascript:set_mouse_over('513');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="317,299,325,316,348,320,360,328,389,318,395,327,408,325,439,313,451,307,451,285,444,279,431,280,418,284,385,284,373,273,358,268,348,277,348,285,331,294"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal515" alt="大村鄉" title="大村鄉" onmouseover="javascript:set_mouse_over('515');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="455,309,402,330,391,327,388,320,372,327,367,342,387,351,386,373,398,386,410,397,425,397,429,386,453,386,466,392,474,396,486,386,476,377,473,365,480,359,466,331"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal510" alt="員林市" title="員林市" onmouseover="javascript:set_mouse_over('510');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="405,409,405,390,394,390,382,385,372,390,359,388,353,385,337,376,326,385,312,383,299,393,310,397,314,407,322,412,339,416,351,424,365,431,370,424,380,428,384,436,392,435,390,426"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal512" alt="永靖鄉" title="永靖鄉" onmouseover="javascript:set_mouse_over('512');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="399,442,395,434,387,437,381,428,373,425,367,430,360,428,342,415,329,413,319,410,310,397,297,401,283,402,278,418,288,427,300,435,310,444,320,443,331,453,340,455,351,457,366,468,367,475,377,471,393,456"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal522" alt="田尾鎮" title="田尾鎮" onmouseover="javascript:set_mouse_over('522');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="377,489,374,481,372,478,363,473,357,459,338,457,330,452,326,445,306,442,306,461,316,466,320,471,320,480,328,485,334,490,334,500,339,507,349,504,355,502,359,507,367,511,378,517,383,507,387,502,385,496"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal521" alt="北斗鎮" title="北斗鎮" onmouseover="javascript:set_mouse_over('521');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="308,476,317,477,318,472,307,460,308,446,304,438,284,423,284,407,275,393,266,391,249,385,242,393,244,408,236,433,240,452,236,464,234,483,238,490,238,505,251,521,255,528,259,533,262,522,269,517,274,506,270,493,279,490,285,498,288,489,295,485"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal523" alt="埤頭鄉" title="埤頭鄉" onmouseover="javascript:set_mouse_over('523');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="327,323,326,354,318,378,305,395,279,398,270,386,262,381,256,371,237,345,245,337,256,340,262,331,270,326,272,312,287,318,295,325,314,326"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal514" alt="溪湖鎮" title="溪湖鎮" onmouseover="javascript:set_mouse_over('514');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="446,276,413,281,376,281,364,271,355,264,348,250,344,236,342,220,345,216,364,212,378,212,390,217,401,212,419,217,424,222,428,231,436,235,436,248,438,262"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal503" alt="花壇鄉" title="花壇鄉" onmouseover="javascript:set_mouse_over('503');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="344,211,342,227,344,241,350,258,356,264,352,274,347,284,322,302,315,286,306,269,309,261,296,252,296,247,302,243,298,230,298,221,292,207,300,195,294,187,308,175,321,176,325,187,329,197,331,202,325,209"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal504" alt="秀水鄉" title="秀水鄉" onmouseover="javascript:set_mouse_over('504');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="305,272,319,301,328,318,316,325,309,322,294,322,285,313,278,311,274,322,264,336,252,334,245,342,243,337,237,332,225,322,212,311,214,303,200,289,218,287,225,277,229,272,225,267,239,253,256,255,264,263,280,268,295,272"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal516" alt="埔鹽鄉" title="埔鹽鄉" onmouseover="javascript:set_mouse_over('516');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="197,292,215,306,215,316,246,344,246,351,259,372,269,387,275,389,267,392,250,385,242,393,242,399,244,405,234,427,237,442,240,449,235,458,221,463,213,459,213,451,201,447,188,446,182,454,180,470,174,478,143,480,140,487,135,493,117,479,109,467,110,455,113,440,120,428,131,421,135,410,136,398,142,392,153,389,155,373,160,358,176,353,184,347,188,316"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal526" alt="二林鎮" title="二林鎮" onmouseover="javascript:set_mouse_over('526');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="484,408,473,399,456,388,429,387,425,397,413,400,401,390,401,409,386,426,388,435,393,444,388,457,401,459,405,466,421,471,434,466,446,471,463,471,466,462,474,448,474,425"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal511" alt="社頭鄉" title="社頭鄉" onmouseover="javascript:set_mouse_over('511');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="465,474,455,472,439,468,431,465,425,472,410,468,404,465,402,460,391,458,371,473,375,482,381,491,387,501,381,510,381,518,394,532,412,544,422,553,425,546,428,529,435,525,439,527,451,520,460,518,470,510,466,502,456,495,462,484"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal520" alt="田中鎮" title="田中鎮" onmouseover="javascript:set_mouse_over('520');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="468,537,457,529,455,521,441,528,428,530,427,542,428,552,418,558,413,568,407,576,408,583,409,593,422,595,435,600,452,603,470,607,489,609,503,605,516,593,530,591,531,575,521,565,503,565,490,567,480,553"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal530" alt="二水鄉" title="二水鄉" onmouseover="javascript:set_mouse_over('530');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="406,592,407,575,415,560,420,555,412,548,401,536,387,521,379,518,366,515,356,506,346,506,339,508,335,497,335,492,315,476,292,487,286,499,276,492,271,499,275,506,267,515,261,523,259,535,253,525,247,529,246,537,246,547,304,577,335,578,355,587,391,589"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal524" alt="溪州鄉" title="溪州鄉" onmouseover="javascript:set_mouse_over('524');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="246,547,246,532,251,523,238,504,236,487,234,480,234,463,220,464,209,461,207,451,184,447,180,456,178,468,174,480,153,480,143,480,142,486,138,492,139,500,150,507,141,515,142,523,146,529,168,535,195,537,215,535,232,542"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal525" alt="竹塘鄉" title="竹塘鄉" onmouseover="javascript:set_mouse_over('525');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="143,530,145,523,142,512,150,507,140,502,135,495,131,488,118,479,110,472,108,465,107,454,98,456,86,452,81,439,79,428,67,431,46,426,45,439,38,452,26,466,15,476,3,480,-1,492,3,511,20,523,42,530,76,537,110,533,127,534"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal527" alt="大城鄉" title="大城鄉" onmouseover="javascript:set_mouse_over('527');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="50,417,51,426,59,426,72,424,76,429,78,443,88,452,109,451,120,430,132,412,138,397,142,391,150,388,158,379,162,357,173,354,187,341,191,317,200,288,198,278,185,271,164,252,161,230,156,224,136,240,125,261,123,278,119,288,114,295,103,292,96,306,92,316,93,332,86,337,86,348,69,364,65,372,71,378,66,393,55,407"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal528" alt="芳苑鄉" title="芳苑鄉" onmouseover="javascript:set_mouse_over('528');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="297,218,296,234,298,243,295,249,300,254,309,258,305,268,296,272,283,268,267,263,261,256,244,253,226,263,228,272,222,281,221,286,201,287,191,284,193,277,182,274,161,251,163,232,157,225,178,213,197,203,207,201,215,207,222,207,230,207,238,213,238,220,242,218,241,213,246,208,256,205,265,210,280,215"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal506" alt="福興鄉" title="福興鄉" onmouseover="javascript:set_mouse_over('506');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="436,241,436,252,438,265,444,274,452,282,450,291,455,303,454,317,465,329,472,349,478,361,485,359,497,349,500,334,500,313,487,302,487,291,492,285,514,284,522,291,533,290,539,283,537,276,520,267,504,256,484,255,473,252,473,243,471,228,453,232,440,235"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal502" alt="芬園鄉" title="芬園鄉" onmouseover="javascript:set_mouse_over('502');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="318,178,325,191,328,200,325,207,349,214,358,212,379,212,391,214,404,212,416,214,426,219,430,229,439,234,457,228,471,225,469,209,473,199,472,190,464,173,460,152,441,138,424,137,408,135,387,130,383,131,375,142,371,152,356,164,340,166,329,171"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal500" alt="彰化市"
                                  title="彰化市" onmouseover="javascript:set_mouse_over('500');" onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="294,141,302,148,304,160,309,169,294,179,296,188,298,191,292,202,295,215,287,217,269,207,257,203,244,207,242,219,236,212,232,202,222,204,213,200,205,195,201,192,193,189,188,188,185,182,184,164,188,159,200,159,215,153,226,145,226,134,228,129,236,116,228,110,238,109,253,107,269,116,277,129"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal505" alt="鹿港鎮" title="鹿港鎮" onmouseover="javascript:set_mouse_over('505');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="383,127,374,139,374,147,365,158,356,162,341,166,317,174,308,169,303,159,302,149,298,141,321,95,326,89,330,82,330,68,350,56,356,64,356,93,373,114"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal508" alt="和美鎮" title="和美鎮" onmouseover="javascript:set_mouse_over('508');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="320,93,294,139,278,130,274,119,261,105,247,104,232,108,218,103,209,115,198,133,183,134,178,128,182,116,193,97,208,93,217,89,225,73,238,60,247,53,253,64,259,71,275,74,290,78,307,89"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal507" alt="線西鄉" title="線西鄉" onmouseover="javascript:set_mouse_over('507');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="246,53,261,69,283,73,296,79,311,88,320,89,327,82,326,69,349,54,334,15,314,0,300,4,299,16,287,28,286,35,267,48,255,48"
                                  href="javascript:;" data-toggle="modal" data-target="#defaultModal509" alt="伸港鎮" title="伸港鎮" onmouseover="javascript:set_mouse_over('509');"
                                  onmouseout="javascript:set_mouse_out();">
                            <area shape="poly" coords="413,80" href="javascript:;" />
                        </map>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection