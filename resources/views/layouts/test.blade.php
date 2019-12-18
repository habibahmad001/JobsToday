<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<title>{{ $page_title or 'Super Quiz2.' }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">

  	<!-- CSRF Token -->
  	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="{{ asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ asset('css/jquery-ui.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet">

	<!-- custom scrollbar stylesheet -->
	<link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css" >

 	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
  <div class="wrapper">
		<header>
			<div class="logo">
				<a href="list-view.html"><img src="{{URL::asset('/images/logo.png')}}" alt="" title=""></a>
			</div>
			@if(!Auth::guest())
				<ul class="nav navbar-nav right-button navbar-right">
					<li class="dropdown user">
						<a href="#" data-toggle="dropdown" role="button" aria-expanded="true" class="dropdown-toggle">
							{{ strtoupper(Auth::user()->first_name[0]) }}
						</a>
						<ul role="menu" class="dropdown-menu">
							<div class="menu-box">
								<div class="top-container">
									<div class="image"><img src="{{URL::asset('/images/user-thumbnail.png')}}"></div>
									<div class="info">
										<div class="name">{{ Auth::user()->first_name .' '. Auth::user()->last_name }}</div>
										<div class="email">{{ Auth::user()->email }}</div>
									</div>
								</div>
								<div class="bottom-container">
									<a href="{{ URL::to('/my-account')}}">My Account</a>
									<a href="{{ route('logout') }}"
		                  onclick="event.preventDefault();
		                           document.getElementById('logout-form').submit();">Sign Out</a>
									 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	 	                  {{ csrf_field() }}
	 	              </form>
								</div>
							</div>
						</ul>
					</li>
				</ul>
			@endif
			<div class="search-container">
				<form>
					<input type="search" name="ddfdf" placeholder="Search here" class="header-search">
					<input type="submit" name="">
				</form>
			</div>
		</header>
		<section class="content">
      @yield('content')
    </section>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
      <!-- custom scrollbar plugin -->
			<script src="{{ asset('js/jquery-ui.js') }}"></script>
  	 <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
		 <script src="{{ asset('js/main.js') }}"></script>
  	 <script src="{{ asset('js/custom.js') }}"></script>
		 @yield('js_libraries')
</body>
</html>
