@extends('layout.master3')

@section('tieude')
{{ Auth::user()->name }}
@endsection

@section('noidung')
<div class="card">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
  @if (\Session::has('login_facebook_success'))
<span style="color: green;font-weight:bold;">{!! \Session::get('login_facebook_success') !!}</span>
@endif
@if (\Session::has('login_google_success'))
<span style="color: green;font-weight:bold;">{!! \Session::get('login_google_success') !!}</span>
@endif
@if (\Session::has('success'))
<span style="color: green;font-weight:bold;">{!! \Session::get('success') !!}</span>
@endif
@if(Auth::check())
@if (\Session::has('register_successful'))
<span style="color: green;font-weight:bold;">{!! \Session::get('register_successful') !!}</span>
@endif 
<h2>Xin chào {{ Auth::user()->name }}</h2>
<h4>{{ Auth::user()->email }}</h4>
@if(Auth::user()->provider == null)
<img src="{{ asset('upload/img') }}/{{Auth::user()->avatar}}" alt="" width="200px" height="200px" style="border-radius: 50%;">
@else
<img src="{{Auth::user()->avatar}}" alt="" width="200px" height="200px" style="border-radius: 50%;">
@endif

<br><br>
<form action="{{ route('logout-custom') }}" method="post">
    @csrf
    <button class="btn btn-danger fw-bold" type="sublit"><i class="fas fa-power-off"></i> Đăng xuất</button>
</form>
<div id="kq"></div>
@if(Auth::user()->provider == null)
<form id="formtest" enctype="multipart/form-data">
    @csrf
<input type="file" name="myFile" id="myFile">
<button class="HEHE">Gửi</button>
</form>
@endif
<!-- <img src="https://graph.facebook.com/v3.3/3918717908353866/picture?type=normal" alt=""> -->
@endif
  </div>
</div>

@endsection