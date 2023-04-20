@extends('layout.master')

@section('tieude')
Đăng ký
@endsection


@section('noidung')
<!-- <img src="https://lh3.googleusercontent.com/a-/AFdZucqMaBUZkGMm_0LeCuUStvkuJzIqX3hWItJev_7q=s96-c" alt="" width="100px" height="200px"> -->
<div class="card">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        @if(Session::has('email_exist'))
        <span style="color: red;font-weight:bold;">{{Session::get('email_exist')}}</span><br>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $error)
        <span style="color: red;font-weight:bold;">{{$error}}</span><br>
        @endforeach
        @endif
        <form action="{{ route('custom-register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên tài khoản <span style="color: red;font-weight:bold;">(*)</span></label>
                <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Địa chỉ Email <span style="color: red;font-weight:bold;">(*)</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu <span style="color: red;font-weight:bold;">(*)</span></label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu <span style="color: red;font-weight:bold;">(*)</span></label>
                <input type="password" name="password_confirm" value="{{ old('password_confirm') }}" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
</div>
@endsection