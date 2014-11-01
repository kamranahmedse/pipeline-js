@extends('layouts.front.default')

@section('content')
	<!-- .featured-area -->
	<div class="featured-area">
		<div class="row-fluid">
			<div class="featured-content">
				<h1>URL Shortening, Bookmarking, Tracking the popularity of URLs was never so easy</h1>
				<p class="m14">Now easily remember, save and track the popularity of your URLs</p>
				<p class="m14"><a href="#shorten-url">Shorten a URL</a> or Learn More</p>
			</div>
		</div>
	</div>		
	<!-- end featured-area -->

	<!-- Stat .main-content -->
	<div class="main-content">
		<div class="attract-msg" id="shorten-url">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span3"></div>
					<div class="span6">
						<div class="ledge">
							<h2 class="p40">A revolutionary URL Shortener! Built just for you...</h2>
							<p class="ledge-summary">
								Manage, track and promote your URLs in a free and easy manner!
								{{ HTML::link(URL::route('registerUser'), 'Register for free!') }}
							</p> 
							<div class="row-fluid home-shortener-widget">
								<input type="text" name="shortenUrlNow" placeholder="http://long/long/long/url/that/cant/be/rememberd/easily"  class="span10 pull-left" />
								<a class="btn btn-primary span2 pull-right" style="margin-left: 0px;" href="#"><i class="icon icon-resize-small icon-white"></i></a>
							</div>
						</div>
					</div>
					<div class="span3"></div>
				</div>
			</div>
		</div>
		<!-- End .attract-msg -->

		<div class="main-intro light_grey">
			<div class="container-fluid min-pad20">
				<div class="row-fluid">
					<div class="span2"></div>
					<div class="span8">
						<h1>Why chosing <span class="red">RasP.is?</span></h1>
						<ul>
							<li><span class="emphasize">Shorten your URLs</span>! RasP.is the next revolutionary URL shortener that allows you to shorten your URLs with custom shortener code or by using a dummy short code that will be generated for your long URL. Shorter thus easier to remember and to distribute.</li>

							<li>You <span class="emphasize">don't need to be registered</span> on the site to use our services. You can shorten your URLs without even registering yourself. Though a registered user can do much more than just shortening URLs.</li>

							<li><span class="emphasize">Register through your Social Networking Accounts</span>! Just use your accounts on popular social networking sites to get the most out of <span class="emphasize">RasP.is</span> and let us do the heavy lifting for you.</li>

							<li><span class="emphasize">Track the popularity of your URLs</span>! Yes you heard it right. We show you different kind of stats to allow you to track the popularity of your shortened URLs.</li>

							<li>Wait! We are not just limited to that... Believe in us, <span class="emphasize">we are evolving and we would keep the new features coming.</span></li>

							<li>We are and we'll <span class="emphasize">always be free</span> ...even if they find a person in this world who can jump from one planet to another in a matter of seconds.</li>

						</ul>
					</div>
					<div class="span2"></div>
				</div>
				<div class="row-fluid">
					<div class="span5"></div>
					<div class="span2">
						<a href="{{ URL::route('registerUser') }}" class="span12 createEventBtn">Register yourself Now!</a>
					</div>
					<div class="span5"></div>
				</div>
			</div>
		</div>
		<!-- End .main-intro -->
	</div>
	<!-- End .main-content -->
@stop
