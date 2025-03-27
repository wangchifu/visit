@extends('layouts.master')

@section('page-title', '本機登入')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4>本機登入</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3 row">
                        <label for="username" class="col-md-2 col-form-label text-md-end">帳號</label>
                        <div class="col-md-8">
                            <input tabindex="1" id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-md-2 col-form-label text-md-end">密碼</label>
                        <div class="col-md-8">
                            <input tabindex="2" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
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
<br><br>
@endsection