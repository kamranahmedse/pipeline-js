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
				<div class="span8 nourl-form-container">
					{{ Form::open(array('method' => 'post', 'url' => URL::route('shortenBookmark'))) }}
						<div class="row-fluid" style="margin-top:100px;">
							{{ Form::text('long_url', Input::old('long_url', ''), array( 'placeholder' => 'Put your long URL that is to be shortened, here!', 'class' => 'short_it span12 nourl-shortenbox')) }}
						</div>
						<div class="row-fluid">
							{{ Form::submit('Shorten It', array('class' => 'span12 createEventBtn nourl-shortensubmit')) }}
						</div>
					{{ Form::close() }}

					@if( $errors->has() )
						<div class="row-fluid">
							@foreach( $errors->all() as $error)
								<div class="alert alert-error nourl-error">
									{{ $error }}
								</div>
							@endforeach
						</div>
					@endif

					@if( Session::has('message') )
						<div class="row-fluid">
							<div class="alert alert-error nourl-error">
								{{ Session::get('message') }}
							</div>
						</div>
					@endif

				</div>
				<div class="span2"></div>
			</div>

		</div>
	</div>
	<!-- End .main-intro -->
@stop