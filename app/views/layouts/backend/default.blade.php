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

	<!-- Modals -->

	<div class="modal fade" id="remove-event-modal">
		<div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			 <h1>Remove URL</h1>
		</div>
		<div class="modal-body">
			<p>The action can't be undone. You won't be able to use the short URL again. If you had used this shortened URL anywhere or had given this to any one, it won't work again.</p>

			<p>Are you sure to remove this URL?</p>
		</div>
		<div class="modal-footer">
		    <a href="#" class="button small-button" data-dismiss="modal">Close</a>
			<a href="#" class="button red-button small-button">Delete</a>
		</div>
	</div>

	<div class="modal fade unstyled light_grey" id="new-event-modal">
		<div class="modal-header unstyled">
			 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			 <h1>Store a new Bookmark</h1>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span8 offset2">
					<div class="new-event-form">
						<label for="url_title" class="event-title">Title</label>
						<input type="text" name="url_title" class="span12" />

						<label for="url" class="event-date">URL</label>
						<div class="input-prepend span12" style="margin-left: 0px;">
							<input type="text" name="url" class="span11" style="width: 87%;" />
							<a class="btn btn-primary add-on" style="padding: 14px;"><i class="icon icon-white icon-resize-small"></i></a>
						</div>

						<label for="shortened_url" class="event-date">Shortened URL</label>
						<input type="text" name="shortened_url" class="span12" readonly="readonly" style="border: 1px solid white;" />
						
					</div>
				</div>
				<div class="span2"></div>
			</div>
		</div>
		<div class="modal-footer unstyled" style="margin-bottom:20px;">
		    <a href="#" class="button small-button" data-dismiss="modal">Cancel</a>
			<a href="#" class="button red-button small-button">Create</a>
		</div>
	</div>	

	<!-- Modals End -->

	{{--*/ 
		$currentRoute = Route::current()->getName();

		$dashboardPage = ( $currentRoute == 'userDashboard' ) ? 'active' : '';
		$bookmarksPage = ( $currentRoute == 'userBookmarks' ) ? 'active' : '';
		$profilePage = ( $currentRoute == 'userProfile' ) ? 'active' : '';
	/*--}}

	<div class="page-wrapper user-logged-in">

		<!-- .loggedin-menu -->
		<div class="loggedin-menu">
			<div class="row-fluid">
				<div class="span2">
					<h1 class="red">RasP.is</h1>
				</div>
				<div class="span10">
					<ul class="user-menu m0 pull-right">
						<li class="pull-left">{{ HTML::link(URL::route('userDashboard'), 'Dashboard', array('class' => $dashboardPage )) }}</li>
						<li class="pull-left">{{ HTML::link(URL::route('userBookmarks'), 'Bookmarks', array('class' => $bookmarksPage )) }}</li>
						<li class="pull-left">{{ HTML::link(URL::route('userProfile'), 'Profile', array('class' => $profilePage )) }}</li>
						<li class="pull-left">{{ HTML::link( URL::route('logoutUser'), 'Logout' ) }}</li>
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
				<p class="credits span12">&copy; {{ date('Y') }}, All rights Reserved by <span class="emph">RasP.is</span></p>
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