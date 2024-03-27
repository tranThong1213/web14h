<?php
use Carbon\Carbon;
use App\Models\Category;
$now = Carbon::now('Asia/Ho_Chi_Minh')->locale('vi');
$categoryFooter  = Category::where('name','!=','Chưa phân loại')->withCount('posts')->orderBy('created_at','DESC')->take(12)->get();

?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="_token" content="{{ csrf_token()}}" />


  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link rel="icon" type="image/png" href="{{ asset('kcnew/frontend/img/logo24h.png') }}"  sizes="160x160">

	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('blog_template/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('blog_template/css/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('blog_template/css/bootstrap.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{ asset('blog_template/css/magnific-popup.css') }}">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{ asset('blog_template/css/flexslider.css') }}">

	<!-- Owl Carousel -->
	<!-- <link rel="stylesheet" href="{{ asset('blog_template/css/owl.carousel.min.') }}"> -->
	<link rel="stylesheet" href="{{ asset('blog_template/css/owl.theme.default.min.css') }}">
	
	<!-- Flaticons  -->
	<link rel="stylesheet" href="{{ asset('blog_template/fonts/flaticon/font/flaticon.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('blog_template/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">

	<!-- Modernizr JS -->
	<script src="{{ asset('blog_template/js/modernizr-2.6.2.min.js') }}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->


	<!-- =====  CSS - Teamplate KCNEWS =========== -->


    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700">

    <!-- ==== Font Awesome ==== -->
    <link rel="stylesheet" href="{{ asset('kcnew/frontend/css/font-awesome.min.css') }}">

    <!-- ==== Bootstrap Framework ==== -->
    <link rel="stylesheet" href="{{ asset('kcnew/frontend/css/bootstrap.min.css') }}">

    <!-- ==== Bar Rating Plugin ==== -->
    <link rel="stylesheet" href="{{ asset('kcnew/frontend/css/fontawesome-stars-o.min.css') }}">

    <!-- ==== Main Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('kcnew/frontend/style.css') }}">

    <!-- ==== Responsive Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('kcnew/frontend/css/responsive-style.css') }}">

    <!-- ==== Theme Color Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('kcnew/frontend/css/colors/theme-color-9.css') }}" id="changeColorScheme">

    <!-- ==== Custom Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('kcnew/frontend/css/custom.css') }}">

    @yield('custom_css')

</head>
		
	<header class="header--section header--style-3">
		<!-- Header Topbar Start -->
		<div class="header--topbar " style="background: orange;">

			<div class="container">
				<div class="float--left float--xs-none text-xs-center">
					<!-- Header Topbar Info Start -->
					<ul class="header--topbar-info nav">
						<li>
							<a href="{{ route('categories.index') }}">
								<img style="border-radius: 12px; height: 40px;" src="{{ asset('kcnew/frontend/img/logo24h.png') }}" alt="logo">
							</a>
						</li>
						<!-- <li><i class="fa fm fa-map-marker"></i>Hồ Chí Minh</li>
						<li><i class="fa fm fa-mixcloud"></i>28<sup>0</sup> C</li>
						<li style="text-transform: capitalize" ><i class="fa fm fa-calendar"></i>Hôm nay ( {{ $now->translatedFormat('l') }}, Ngày {{ $now->translatedFormat('jS F')}} Năm {{ $now->translatedFormat('Y')}} )</li> -->
					</ul>
					<!-- Header Topbar Info End -->
				</div>
	
				<div class="float--right float--xs-none text-xs-center">
					<!-- Header Topbar Action Start -->
					<ul class="header--topbar-action nav">
							@guest
							<li class="btn-cta">
								<a href="{{ route('login') }}">
									<i class="fa fm fa-user-o"></i>
									<span>Đăng Nhập</span>
								</a>
							</li>
							@endguest

							@auth
								<li class="has-dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#">
										<i class="fa fm fa-user-o"></i>
										{{ auth()->user()->name }} 
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" style="background: orange;">
										@if(auth()->user()->role->name !== 'user')
										<li>
											<a href="{{ route('admin.index') }}">Admin - Dashbroad</a>
										</li>
										@endif
										<li>
											<a href="{{ route('profile') }}">Tài khoản của tôi</a>
										</li>
										<li>
											<a onclick="event.preventDefault(); document.getElementById('nav-logout-form').submit();"
											href="">Đăng xuất
											<i class="fa fm fa-arrow-circle-right" ></i>
											</a>

											<form id="nav-logout-form" action="{{ route('logout') }}" method="POST">
												@csrf
											</form>
										</li>
									</ul>
								</li>
							@endauth

					</ul>
					<!-- Header Topbar Action End -->
	
	
					<!-- Header Topbar Social Start -->
					
					<!-- Header Topbar Social End -->
				</div>
			</div>
		</div>
		<!-- Header Topbar End -->
	
		<!-- Header Navbar Start -->
		<div class="header--navbar navbar bd--color-1 bg--color-0" data-trigger="sticky"  style="background: orange;">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#headerNav"
						aria-expanded="false" aria-controls="headerNav">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
	
				<div id="headerNav" class="navbar-collapse collapse float--left">
					<!-- Header Menu Links Start -->
					<ul class="header--menu-links nav navbar-nav" data-trigger="hoverIntent">
						<li>
							<a href="{{ route('categories.index') }}">

								<i class="icon_home fa fa-home"></i>
							</a>
						</li>
						@foreach($categories as $category)
							<li><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></li>
						@endforeach

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Trang<i
									class="fa flm fa-angle-down"></i></a>
							<ul class="dropdown-menu" style="background: orange; color:black">
								<li><a href="{{ route('about') }}">Giới thiệu</a></li>
								<li><a href="{{ route('contact.create') }}">Liên hệ</a></li>
								<li><a href="{{ route('erorrs.404') }}">404</a></li>
							</ul>
						</li>
						<!-- <li>
						<a href="{{ route('home') }}">
								<span style="color: #ccc; margin-right: 10px;">Tất cả</span>
								<img  width="17" class="icon-menu" src="https://static.vnncdn.net/v1/icon/menu-center.svg">
							</a>
						</li> -->
					</ul>
					<!-- Header Menu Links End -->
				</div>
	
				<!-- Header Search Form Start -->
				<form method="POST" action="{{ route('search') }}" class="header--search-form float--right" data-form="validate">
					@csrf	
					<input type="search" name="search" placeholder="Search..." class="header--search-control form-control"
                    required>
	
					<button type="submit" class="header--search-btn btn"><i
							class="header--search-icon fa fa-search"></i></button>
				</form>
				<!-- Header Search Form End -->
			</div>
		</div>
		<!-- Header Navbar End -->
	</header>

	<!-- Header Section End -->
	<div id="page" style="padding:5%" class="wrapper">
	
		<!-- Posts Filter Bar Start -->
		<div class="posts--filter-bar style--3 hidden-xs">
			<!-- <div class="container">
				<ul class="nav">
					<li>
						<a href="{{ route('newPost') }}">
							<i class="fa fa-star-o"></i>
							<span>Tin tức mới nhất</span>
						</a>
					</li>
				
					<li>
						<a href="{{ route('hotPost') }}">
							<i class="fa fa-fire"></i>
							<span>Tin nóng</span>
						</a>
					</li>
					<li>
						<a href="{{ route('viewPost') }}">
							<i class="fa fa-eye"></i>
							<span>Xem nhiều nhất</span>
						</a>
					</li>
				</ul>
			</div> -->
		</div>

		<!-- News Ticker Start -->
		<!-- <div class="news--ticker">
			<div class="container">
				<div class="title">
					<h2>Tin mới cập nhật</h2>
				</div>

				<div class="news-updates--list" data-marquee="true">
					<ul class="nav">
						@foreach ($posts_new as $posts_new)
							<li>
								<h3 class="h3"><a href="{{ route('posts.show', $posts_new[0]) }}">{{ $posts_new[0]->title }}</a></h3>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div> -->

		@yield('content')

	</div>
	

	<footer id="colorlib-footer" style="background: orange;color:black">
		<div class="container">
			<div class="row">
				<div class="col-md-2   colorlib-widget">
					<ul class="colorlib-footer-links">
						<li><a href="{{ route('home') }}"></i>Trang chủ</a></li>
						<li><a href="{{ route('about') }}"></i>Giới thiệu</a></li>
						<li><a href="{{ route('contact.create') }}"></i>Liên hệ</a></li>
						<li><a href="{{ route('contact.create') }}"></i>Mới nhất</a></li>
					</ul>
				</div>
				<div class="col-md-2  colorlib-widget">
						<ul class="colorlib-footer-links">
							@for($i = 0; $i < 4; $i++)
							<li><a href="{{ route('categories.show', $categoryFooter[$i] ) }}">{{ $categoryFooter[$i]->name }}</a></li>
							@endfor
							
						</ul>
				</div>
				<div class="col-md-2  colorlib-widget">
						<ul class="colorlib-footer-links">
							@for($i = 4; $i < 8; $i++)
							<li><a href="{{ route('categories.show', $categoryFooter[$i] ) }}">{{ $categoryFooter[$i]->name }}</a></li>
							@endfor
							
						</ul>
				</div>

				<div class="col-md-2  colorlib-widget">
						<ul class="colorlib-footer-links">
							@for($i = 8; $i < 12; $i++)
							<li><a href="{{ route('categories.show', $categoryFooter[$i] ) }}">{{ $categoryFooter[$i]->name }}</a></li>
							@endfor
						</ul>
				</div>

				
			</div>
		
		</div>


	
		<div class="container" style="background: orange;">
			<div style=" padding: 15px 0; display: flex;" class=" row">
				<div class="col-md-4">
					<p>
						<a href="{{ route('home') }}">
							<img style="border-radius: 12px; width: 120px;" src="{{ asset('kcnew/frontend/img/logo24h.png') }}" alt="logo">
						</a>
					</p>
					<p>
						<span style="font-size: 14px" class="block">Báo tiếng Việt nhiều người xem nhất</span>
					</p>
					<p>
						<span style="font-size: 14px" class="block">Thuộc Bộ Khoa học Công nghệ</span>
					</p>
					<p>
						<span style="font-size: 14px" class="block">Số giấy phép: 548/GP-BTTTT ngày 27/06/2022</span>
					</p>
				</div>
				<div class="col-md-4">
					<p>
						<span style="font-size: 14px" class="block">Tổng biên tập: Nhóm HUFLIT</span>
					</p>
					<p>
						<span style="font-size: 14px" class="block">Địa chỉ: 828 Sư Vạn Hạnh</span>
					</p>
					<p>
						<span style="font-size: 14px" class="block">Điện thoại: 0947384573</span>
					</p>
				</div>
				<div class="col-md-4">
					<p>
						<small style="font-size: 14px" class="block">&copy; 2023. Toàn bộ bản quyền thuộc nhóm HUFLIT</small>
					</p>
					
				</div>
			</div>
		</div>
	</footer>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	
		<!-- jQuery -->
	<script src="{{ asset('blog_template/js/jquery.min.js') }}"></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('blog_template/js/jquery.easing.1.3.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('blog_template/js/bootstrap.min.js') }}"></script>
	<!-- Waypoints -->
	<script src="{{ asset('blog_template/js/jquery.waypoints.min.js') }}"></script>
	<!-- Stellar Parallax -->
	<script src="{{ asset('blog_template/js/jquery.stellar.min.js') }}"></script>
	<!-- Flexslider -->
	<script src="{{ asset('blog_template/js/jquery.flexslider-min.js') }}"></script>
	<!-- Owl carousel -->
	<script src="{{ asset('blog_template/js/owl.carousel.min.js') }}"></script>
	<!-- Magnific Popup -->
	<script src="{{ asset('blog_template/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('blog_template/js/magnific-popup-options.js') }}"></script>
	<!-- Counters -->
	<script src="{{ asset('blog_template/js/jquery.countTo.js') }}"></script>
	<!-- Main -->
	<script src="{{ asset('blog_template/js/main.js') }}"></script>

	<script src="{{ asset('js/function.js') }}"></script>


	<!-- ==== JS TEAMPLATED KCNEWS jQuery Library ==== -->
	<!-- <script src="{{ asset('kcnew/frontend/js/jquery-3.2.1.min.js') }}"></script> -->

	<!-- ==== Bootstrap Framework ==== -->
	<!-- <script src="{{ asset('kcnew/frontend/js/bootstrap.min.js') }}"></script> -->

	<!-- ==== StickyJS Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/jquery.sticky.min.js') }}"></script>

	<!-- ==== HoverIntent Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/jquery.hoverIntent.min.js') }}"></script>

	<!-- ==== Marquee Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/jquery.marquee.min.js') }}"></script>

	<!-- ==== Validation Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/jquery.validate.min.js') }}"></script>

	<!-- ==== Isotope Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/isotope.min.js') }}"></script>

	<!-- ==== Resize Sensor Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/resizesensor.min.js') }}"></script>

	<!-- ==== Sticky Sidebar Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/theia-sticky-sidebar.min.js') }}"></script>

	<!-- ==== Zoom Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/jquery.zoom.min.js') }}"></script>

	<!-- ==== Bar Rating Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/jquery.barrating.min.js') }}"></script>

	<!-- ==== Countdown Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/jquery.countdown.min.js') }}"></script>

	<!-- ==== RetinaJS Plugin ==== -->
	<script src="{{ asset('kcnew/frontend/js/retina.min.js') }}"></script>

	<!-- ==== Main JavaScript ==== -->
	<script src="{{ asset('kcnew/frontend/js/main.js') }}"></script>
	

	<script >
		$(function(){

			function isEmail(email) {
				var regex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/;
				return regex.test(email);
			}
			$(document).on("click", "#subscibe-btn", (e) => {
				e.preventDefault();
				let _this = $(e.target);
		
				let email = _this.parents("form").find("input[name='subscribe-email']").val();
				if( ! isEmail( email))
				{
					$("body").append("<div class='global-message alert alert-danger subscribe-error'>Không đúng định dạng email.</div>");
				}
				else
				{
					//send email
					//1 using ajax
					let formData = new FormData();
					let _token = $("meta[name='_token']").attr("content");
					 
					formData.append('_token', _token);
					formData.append('email', email);

					$.ajax({
						url: "{{ route('newsletter_store') }}",
						type: "POST",
						dataType: "JSON",
						processData: false,
						contentType: false,
						data: formData,
						success: (respond) => {
							let message = respond.message;
							$("body").append("<div class='global-message alert alert-danger subscribe-success'>"+ message +"</div>");
						
							_this.parents("form").find("input[name='subscribe-email']").val('');
						},
						statusCode: {
							500: () => {								 
								$("body").append("<div class='global-message alert alert-danger subscribe-error'>Email này đã subscribe website chúng tôi</div>");

							}
						} 
					});
					 
				}
				setTimeout( () => {
	 
					$(".global-message.subscribe-error, .global-message.subscribe-success").remove();

				}, 5000 );
			});
		});
	</script>

	@yield('custom_js')

</body>
</html>

