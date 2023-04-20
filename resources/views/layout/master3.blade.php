@includeIf('inc.header')


<div class="container">
  <div class="row pt-4 pb-4">
    <div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
      <div class="card">

        <div class="card-body">
          <div class="list-group">
            @if(Auth::user()->role == 2)
              <a href="/admin" class="list-group-item list-group-item-action"><i class="fas fa-user-secret"></i> Vào trang quản trị</a>
            @endif
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-key"></i> Đổi mật khẩu</a>
            <a href="{{ route('get_logout') }}" class="list-group-item list-group-item-action"><i class="	fas fa-power-off"></i> Đăng xuất</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9 col-sm-6 col-xs-12 mb-4">
      @yield('noidung')
    </div>
  </div>
</div>
@includeIf('inc.footer')