<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		RasP.is 
		@yield('title')
	</title>
	@section('headAssets')
		<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-responsive.min.css') }}">
		<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
	@show
</head>
<body>

	<div class="page-wrapper user-logged-in">

		<!-- .loggedin-menu -->
		<div class="loggedin-menu">
			<div class="row-fluid">
				<div class="span2">
					<h1 class="red">RasP.is</h1>
				</div>
				<div class="span10">
					<ul class="user-menu m0 pull-right">
						<li class="pull-left"><a href="#" class="active">Dashboard</a></li>
						<li class="pull-left"><a href="#">Bookmarks</a></li>
						<li class="pull-left"><a href="#">Profile</a></li>
						<li class="pull-left"><a href="#">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End .loggedin-menu -->

		@yield('content')
		
		<!-- Start footer -->
		<div class="footer">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span2"></div>
					<div class="span4 feedbacks">
						<h3><a href="#">Those who have used it!</a></h3>
						<p>Our users say it best. Hear how some of our favorite users used <span class="emphasize">RasP.is</span> to manager their URLs.</p>
					</div>
					<div class="span4 takeTour">
						<h3><a href="#">Got some time?</a></h3>
						<p>Stay awhile. Head over to our tour and get a little more familiar with all of the great RasP.is features</p>
					</div>
					<div class="span2"></div>
				</div>
			</div>
		</div>

		<div class="footer-nav">
			<div class="container-fluid">
				<div class="row-fluid">
					<ul class="foot-social-nav">
						<li class="span3"></li>
						<li class="span3">
							<h4>Get the Latest</h4>
							<h3>
								<a href="#" class="twitter-bg">Follow on Twitter</a>
							</h3>
						</li>
						<li class="span3">
							<h4>Keep in Touch!</h4>
							<h3>
								<a href="#" class="facebook-bg">Like on Facebook</a>
							</h3>
						</li>							

						<li class="span2"></li>	
						<div class="clearfix"></div>
					</ul>
				</div>
			</div>
			<div class="row-fluid">
				<p class="credits span12">&copy; 2014, All rights Reserved by <span class="emph">RasP.is</span></p>
			</div>				
		</div>
	</div>

	@section('footerAssets')
		<script type="text/javascript" src="{{ URL::to('assets/scripts/jq.js') }}"></script>
		<script type="text/javascript" src="{{ URL::to('assets/scripts/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::to('assets/scripts/main.js') }}"></script>
	@show

</body>
</html>