@extends('layouts.backend.default')

@section('content')
	<div class="no-events-msg">
		<div class="row-fluid">
			<div class="span12">
				<div class="ledge">
					<h1 class="white text-center">Seems like you have no shortened URLs!</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="light_grey">
		<div class="container-fluid min-pad20">
			<div class="row-fluid">
				<div class="span2"></div>
				<div class="span8">
					<div class="row-fluid" style="margin-top:100px;">
						<input type="text" name="short_it" placeholder="Put your long URL that is to be shortened, here!" class="short_it span12" style="padding: 30px;" />
					</div>
					<div class="row-fluid">
						<a href="#" class="span12 createEventBtn" style="margin-top:0px;">Shorten it</a>
					</div>
				</div>
				<div class="span2"></div>
			</div>
		</div>
	</div>
	<!-- End .main-intro -->
@stop