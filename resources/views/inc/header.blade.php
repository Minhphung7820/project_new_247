<!DOCTYPE HTML>
<html lang="vi">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="htmlcss bootstrap menu, navbar, hover nav menu CSS examples" />
	<meta name="description" content="Bootstrap 5 navbar hover examples for any type of project, Bootstrap 5" />

	<title>@yield('tieude')</title>

	<!-- Bootstrap css and js -->
	<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

	<!-- menukit css and js  -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/menukit.css') }}">
	<script type="text/javascript" src="{{ asset('assets/menukit.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- <script src="{{ asset('js/jquery.floatit.js') }}"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<!-- <script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('body').bind('cut copy paste', function(e) {
				e.preventDefault();
			});
			jQuery("body").on("contextmenu", function(e) {
				return false;
			});
		});
		jQuery(document).keydown(function(event) {
			if (event.keyCode == 123) {
				return false;
			}
			if (event.ctrlKey && event.shiftKey && event.keyCode == 67) {
				return false;
			}
			if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
				return false;
			}
		});
		document.onkeydown = function(e) {
			if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
				return false;
			} else {
				return true;
			}
		};
		jQuery(document).keypress("u", function(e) {
			if (e.ctrlKey) {
				return false;
			} else {
				return true;
			}
		});
		document.body.addEventListener('keydown', event => {
			if (event.ctrlKey && 'spa'.indexOf(event.key) !== -1) {
				event.preventDefault()
			}
		})
	</script> -->
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<!-- ======= Bpptstrap icons ======== -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

	<script src="{{ asset('js/FacebookCallback.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>


<body>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<?php

	use App\Models\CateModel;
	?>

	<header class="section-header bg-light border-bottom">
		<section class="py-3">
			<div class="container">
				<!-- <div class="row py-3">
					<div class="col-lq-12">
						
					</div>
				</div> -->
				<div class="row gy-3 align-items-center">
					<div class="col-3 col-sm col-md-2 col-xl-2">
						<a href="/" style="text-decoration: none;" class="brand-wrap h3 me-3">
							<!-- <img id="logo_web" src="https://uptime.com/media/website_profiles/24h.com.vn.png" style="border-radius: 50%;" alt="" width="150px" height="100px"> -->
							News247
						</a> <!-- brand-wrap.// -->
					</div>
					<div class="col-9 col-sm-8 col-md-5 col-xl-7">
						<form>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search">
								<button class="btn  btn-success" type="submit"> Search </button>
							</div>
						</form> <!-- search-wrap .end// -->
					</div> <!-- col.// -->
					<div class="col-12 col-sm col-md-5 col-lg-4 col-xl-3 text-end">

						<a class="btn btn-secondary" href="#"> Liên hệ </a>
						@if(!Auth::check())
						<a class="btn btn-secondary" href="{{ route('getLogin') }}"> <i class="fas fa-user-circle"></i> Đăng nhập </a>
						<!-- <a class="btn btn-secondary" href="{{ route('view-register') }}"> <i class="	fas fa-user-plus"></i> Đăng ký </a> -->
						@else
						<a class="btn btn-secondary" href="{{ route('getTai_khoan') }}"> <i class="	fas fa-user-check"></i> {{Auth::user()->name}} </a>
						@endif
						<!-- <div class="dropdown d-inline-block hover">
							<a class="btn btn-secondary" data-bs-toggle="dropdown" href="#"> Cart <span class="badge bg-danger rounded-pill">2</span> </a>
							<div class="dropdown-menu px-3 dropdown-menu-end">
								asdasda sdasdasadasd asdasdasd Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							</div>
						</div> -->
					</div>
				</div> <!-- row.// -->
			</div> <!-- container.// -->
		</section> <!-- header-main .// -->

		<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
			<div class="container">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="main_nav">
					<ul class="navbar-nav">

						<!-- -------- menu item -------- -->
						<li class="nav-item dropdown hover darken-onshow">
							<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Danh mục tin</a>
							<ul class="boxUlCategoryMenu dropdown-menu">
								<?php

								$data = CateModel::where("parent_id", "=", 0)->where("parentS_ID", "=", 0)->where("date_deleCate", "=", null)->where("statusCate", "=", 1)->get();
								foreach ($data as $value) {
									$checkParect = CateModel::where("parent_ID", "=", $value->categoryId)->where("date_deleCate", "=", null)->where("statusCate", "=", 1)->where("parentS_ID", "=", 0)->get();
									if (count($checkParect) > 0) {
										echo ' <li class="CategoryMenu has-megasubmenu" data-id="' . $value->categoryId . '">
					<a class="dropdown-item" href="/tin-' . $value->aliasCat . '">' . $value->nameCat . ' <i class="icon-arrow"></i></a>
					
					</li>';
									} else {
										echo ' <li class="CategoryMenu" data-id="' . $value->categoryId . '">
					<a class="dropdown-item" href="/tin-' . $value->aliasCat . '">' . $value->nameCat . '</a>
					
					</li>';
									}
								}
								?>
								<!-- <li class="CategoryMenu" data-id="1"><a class="dropdown-item" href="#"> Dropdown item 1 </a></li> -->
								<!-- <li class="CategoryMenu has-megasubmenu" data-id="2">
				<a class="dropdown-item" href="#"> Dropdown item 2 <i class="icon-arrow"></i> </a>
				<div class="megasubmenu dropdown-menu">
				   <div class="row">
		                <div class="col-6">
		                    	<h6 class="title">Title Menu hahaa</h6>
		                        <ul class="list-unstyled">
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                        </ul>
		                </div>
		                <div class="col-6">
		                    <h6 class="title">Title Menu Two</h6>
		                        <ul class="list-unstyled">
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                        </ul>
		                </div>
						
		            </div>
				 </div>
			</li> -->
								<!-- <li class="CategoryMenu has-megasubmenu" data-id="3">
				<a class="dropdown-item" href="#"> Dropdown item 3 <i class="icon-arrow"></i> </a>
				<div class="megasubmenu dropdown-menu">
				   <div class="row">
		                <div class="col-6">
		                    	<h6 class="title">Title Menu hehe</h6>
		                        <ul class="list-unstyled">
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                        </ul>
		                </div>
		                <div class="col-6">
		                    <h6 class="title">Title Menu Two</h6>
		                        <ul class="list-unstyled">
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                        </ul>
		                </div>
						
		            </div>
				 </div>
			  </li> -->
								<!-- <li class="CategoryMenu has-megasubmenu" data-id="4">
			  	 <a class="dropdown-item" href="#"> Dropdown item 4 <i class="icon-arrow"></i> </a>
			  	 <div class="megasubmenu dropdown-menu">
				   <div class="row">
		                <div class="col-6">
		                    	<h6 class="title">Title Menu One</h6>
		                        <ul class="list-unstyled">
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                        </ul>
		                </div>
		                <div class="col-6">
		                    <h6 class="title">Title Menu Two</h6>
		                        <ul class="list-unstyled">
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                            <li><a href="#">Custom Menu</a></li>
		                        </ul>
		                </div>
						
		            </div>
				 </div>
			  </li> -->
								<!-- <li class="CategoryMenu has-megasubmenu"  data-id="5">
			  	 <a class="dropdown-item" href="#"> Dropdown item 5 <i class="icon-arrow"></i> </a>
			  	 <div class="megasubmenu dropdown-menu">
				    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				    proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
				    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				    consequat.
				 </div>
			  </li> -->
								<!-- <li class="CategoryMenu"  data-id="6"><a class="dropdown-item" href="#"> Dropdown item 6 </a></li> -->
							</ul>
						</li>
						<!-- -------- menu item end// -------- -->

						<!-- -------- menu item -------- -->
						<li class="nav-item">
							<a class="nav-link" href="{{ route('homePage') }}"><i class="fas fa-home"></i></a>
						</li>
						<!-- -------- menu item end// -------- -->

						<!-- -------- menu item -------- -->
						<!-- <li class="nav-item">
							<a class="nav-link" href="#">Others</a>
						</li> -->
						<!-- -------- menu item end// -------- -->

						<!-- -------- menu item -------- -->
						<!-- <li class="nav-item">
							<a class="nav-link" href="#">Others</a>
						</li> -->
						<!-- -------- menu item end// -------- -->

						<!-- -------- menu item -------- -->
						<?php
						$list = CateModel::where("parent_id", "=", 0)
							->where("parentS_ID", "=", 0)
							->where("date_deleCate", "=", null)
							->where("statusCate", "=", 1)
							->limit(10)
							->get();
						?>
						<?php foreach ($list as $row) { ?>
							<li class="nav-item dropdown hover">
								<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><?= $row->nameCat ?></a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="/tin-<?= $row->aliasCat ?>"> Xem tất cả </a></li>
									<?php
									$cate_son = CateModel::where("parent_id", "=", $row->categoryId)
										->where("parentS_ID", "=", 0)
										->where("date_deleCate", "=", null)
										->where("statusCate", "=", 1)
										->get();
									?>
									<?php foreach ($cate_son as $r) { ?>
										<li><a class="dropdown-item" href="/tin-<?= $r->aliasCat ?>"> <?= $r->nameCat ?></a></li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
						<!-- -------- menu item end// -------- -->
					</ul> <!-- navbar-nav.// -->

					<!-- <ul class="navbar-nav ms-auto"> -->
					<!-- -------- menu item -------- -->
					<!-- <li class="nav-item">
							<a class="nav-link" href="#">Others</a>
						</li> -->
					<!-- -------- menu item end// -------- -->

					<!-- -------- menu item -------- -->
					<!-- <li class="nav-item dropdown hover">
							<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Dropdown </a>
							<ul class="dropdown-menu dropdown-menu-end">
								<li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
								<li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
								<li><a class="dropdown-item" href="#"> Submenu item 3 </a></li>
							</ul>
						</li> -->
					<!-- -------- menu item end// -------- -->

					<!-- -------- menu item -------- -->
					<!-- <li class="nav-item dropdown hover">
							<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">
								@if(Auth::check())
								{{Auth::user()->name}}
								@else
								Tài khoản
								@endif
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								@if(Auth::check())
								@if(Auth::user()->role == 2)
								<li><a class="dropdown-item" href="{{ url('admin/') }}"> Vào trang quản trị</a></li>
								@endif
								<li><a class="dropdown-item" href="{{ route('getTai_khoan') }}"> Thông tin tài khoản</a></li>
								<li><a class="dropdown-item" href="#"> Đơn hàng của tôi</a></li>
								<li><a class="dropdown-item" href="#"> Đổi mật khẩu</a></li>
								<li><a class="dropdown-item" href="{{ route('get_logout') }}"> Đăng xuất</a></li>

								@else
								<li><a class="dropdown-item" href="{{ route('getLogin') }}"> Đăng nhập</a></li>
								<li><a class="dropdown-item" href="{{ route('view-register') }}"> Đăng ký</a></li>
								<li><a class="dropdown-item" href="#"> Quên mật khẩu</a></li>
								@endif

							</ul>
						</li> -->
					<!-- -------- menu item end// -------- -->

					<!-- </ul> navbar-nav.// -->

				</div> <!-- navbar-collapse.//    -->
			</div> <!-- container.// -->
		</nav> <!-- navbar-main  .// -->


		<button type="button" class="btn btn-danger" id="btn_back_to_top"><i class="	fas fa-angle-up"></i></button>
		<div id="btn_grp_connect_social" class="btn-group-vertical">
			<button style="background-color: #3366cc; border:none;" type="button" class="btn btn-primary"><i class="fab fa-facebook-square"></i></button>
			<button style="background-color: #3399ff; border:none;" type="button" class="btn btn-secondary"><i class="fab fa-twitter"></i></button>
			<button style="background-color: #D50F25; border:none;" type="button" class="btn btn-danger"><i class="fab fa-google"></i></button>
			<button style="background-color: #cc3366; border:none;" type="button" class="btn btn-danger"><i class="fab fa-instagram"></i></button>
			<button style="background-color: #ff0000; border:none;" type="button" class="btn btn-danger"><i class="fab fa-youtube"></i></button>
			<div id="btn_show_hide_group_social">
                       <span class="btn_hide_group_social"><i class="fas fa-angle-right"></i></span>
			</div>
		</div>
		<div id="btn_show_hide_group_social_on">
                   <span class="btn_show_group_social"><i class="	fas fa-angle-left"></i></span>
		</div>
	</header> <!-- section-header.// -->