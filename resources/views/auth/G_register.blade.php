@extends('layouts.master')

@section('page-title', '啟用帳號')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h4>啟用帳號</h4></div>

            <div class="card-body">
                @include('layouts.alert')
                <form method="POST" action="{{ route('gsuite.register.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="school" class="col-md-4 col-form-label text-md-right">學校</label>

                        <div class="col-md-6">
                            <input id="school" type="text" class="form-control" name="school" value="{{ session('Gsuite')['school'] }}" readonly="readonly" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">聯絡人姓名</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ session('Gsuite')['name'] }}" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="township" class="col-md-4 col-form-label text-md-right">學校所屬鄉鎮</label>

                        <div class="col-md-6">
                            <select id="township" name="township" class="form-control">
                                <option value="">請選擇鄉鎮</option>
                                @foreach(config('app.townships') as $k =>$v)
                                    <option value="{{ $k }}">{{ $k }} {{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right"><i class="fas fa-map-marked-alt"></i> 學校地址</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telephone_number" class="col-md-4 col-form-label text-md-right"><strong class="text-danger"><i class="fas fa-phone-square"></i> 聯絡人電話*</strong></label>

                        <div class="col-md-6">
                            <input id="telephone_number" type="tel" class="form-control" name="telephone_number" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right"><strong class="text-danger"><i class="fas fa-envelope-square"></i> 電子信箱*</strong></label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="line_id" class="col-md-4 col-form-label text-md-right"><i class="fab fa-line"></i> Line ID</label>

                        <div class="col-md-6">
                            <input id="line_id" type="text" class="form-control" name="line_id">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="website" class="col-md-4 col-form-label text-md-right"><i class="fas fa-globe"></i> 學校網址</label>

                        <div class="col-md-6">
                            <input id="website" type="text" class="form-control" name="website" placeholder="http://">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus-square"></i> 立即啟用
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
