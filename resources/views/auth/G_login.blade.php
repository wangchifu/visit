@extends('layouts.master')

@section('page-title', '國中小 Gsuite 登入')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <ul class="nav nav-tabs mt-2 mb-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">1.彰化 GSuite 登入</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sso') }}">2.彰化縣教育雲端登入 (OpenID)</a>
                    </li>                    
                </ul>
                <div class="card-header"><h4>參訪學校登入</h4></div>

                <div class="card-body">
                    <img src="{{ asset('images/gsuite_logo.png') }}" class="img-fluid">
                    <form id="form" method="POST" action="{{ route('gsuite.auth') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="username" class="col-md-2 col-form-label text-md-end">帳號</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input tabindex="1" id="username" type="text" class="form-control" name="username" required autofocus placeholder="教育處 Gsuite 帳號">
                                    <span class="input-group-text">@chc.edu.tw</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-2 col-form-label text-md-end">密碼</label>
                            <div class="col-md-8">
                                <input tabindex="2" id="password" type="password" class="form-control" name="password" required placeholder="OpenID 密碼">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button tabindex="3" type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> 登入
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection