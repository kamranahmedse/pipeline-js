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
	
	<div class="page-wrapper">

		<!-- .header -->
		<div class="header">
			<div class="row-fluid">
				<div class="content">
					<div class="container-fluid">
						<div class="span12">
							<a href="{{ URL::to('/') }}" id="logo" class="pull-left red">RasP.is</a>
							<div class="navigation pull-right">
								<ul>
									@if( !Auth::check() )
										<li class="pull-left">{{ HTML::link( URL::to('/'), 'Home' ) }}</li>
										<li class="pull-left">{{ HTML::link( URL::route('registerUser'), 'Register' ) }}</li>
										<li class="pull-left">{{ HTML::link( URL::route('loginUser'), 'Login' ) }}</li>
									@else
										<li class="pull-left">{{ HTML::link( URL::route('logoutUser'), 'Logout' ) }}</li>
									@endif
								</ul>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end .header -->

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

	<!-- End footer -->

	</div>
	<!--  End Page-wrap -->
	


	@section('footerAssets')
		<script type="text/javascript" src="{{ URL::to('assets/scripts/jq.js') }}"></script>
		<script type="text/javascript" src="{{ URL::to('assets/scripts/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::to('assets/scripts/modules/app.js') }}"></script>
	@show

</body>
</html>