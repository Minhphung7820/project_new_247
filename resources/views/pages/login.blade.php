@extends('layout.master')

@section('tieude')
Đăng nhập
@endsection

@section('noidung')

<div class="row">
    <div class="col-lg-12">      
<div class="card">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <form action="{{ route('login-user') }}" method="post">
            @csrf
            @if($errors->any())
            @foreach($errors->all() as $error)
            <span style="color: red;font-weight:bold;">{{$error}}</span><br>
            @endforeach
            @endif
            @if (\Session::has('login_error'))
            <span style="color: red;font-weight:bold;">{!! \Session::get('login_error') !!}</span>
            @endif
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email <span style="color: red;font-weight:bold;">(*)</span></label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu <span style="color: red;font-weight:bold;">(*)</span></label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
            <button type="submit" style="width:100%;height:50px;" class="btn btn-primary fw-bold">Đăng nhập</button>
        </form>
        <br>
    </div>
    <div class="row p-3">
            <div class="col-lg-12 mb-2">
                  <a href="{{route('login-with-facebook')}}"><button style="width:100%;height:50px;" type="button" class="btn btn-primary fw-bold"><i class="fab fa-facebook-square"></i> Đăng nhập với Facebook</button></a>
            </div>
            <br>
            <div class="col-lg-12">
                  <a href="{{route('login-with-google')}}"><button  style="width:100%;height:50px;" type="button" class="btn btn-danger fw-bold"><i class="fab fa-google"></i> Đăng nhập với Google</button></a>
            </div>
    </div>
    <div class="row p-3">
        <div class="col-lg-12 text-center">
        <a class="fw-bold" href="{{ route('view-register') }}">Đăng ký</a>
        </div>
    </div>
</div>



    </div>
</div>
@endsection