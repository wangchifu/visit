@extends('layouts.master')

@section('page-title', '國中小 Gsuite 登入')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <ul class="nav nav-tabs" style="margin: 10px">
                    <li class="nav-item">
                      <a class="nav-link active" href="#">彰化 GSuite 登入</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('sso') }}">彰化縣教育雲端登入 (OpenID)
                    </a>
                    </li>                    
                </ul>
                <div class="card-header"><h4>參訪學校登入</h4></div>

                <div class="card-body">
                    <img src="{{ asset('images/gsuite_logo.png') }}">
                    <form id="form" method="POST" action="{{ route('gsuite.auth') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label text-md-right">帳號</label>
                            <div class="input-group col-md-8">
                                <input tabindex="1" id="username" type="text" class="form-control" name="username" required autofocus aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="教育處 Gsuite 帳號">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">@chc.edu.tw</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">密碼</label>

                            <div class="col-md-8">
                                <input tabindex="2" id="password" type="password" class="form-control" name="password" required placeholder="OpenID 密碼">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
