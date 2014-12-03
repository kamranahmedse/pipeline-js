@extends('layouts.front.default')

@section('content')
	<!-- Stat .main-content -->
	<div class="main-content signup">
		<div class="attract-msg">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span2"></div>
					<div class="span8">
						<div class="ledge">
							<h2 class="p40 text-left">Register your self</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> 
						</div>
					</div>
					<div class="span2"></div>
				</div>
			</div>
		</div>
		<!-- End .attract-msg -->

		<div class="main-intro light_grey">
			<div class="container-fluid min-pad20">
				<div class="row-fluid">
					<div class="span2"></div>
					<div class="span8">
						{{ Form::open(array('url' => URL::route('processRegisterUser'), 'method' => 'post', 'class' => 'register-form' )) }}
							<div class="row-fluid">
								<div class="span6">
									{{ Form::label('username', 'Username*') }}
									{{ Form::text('username', Input::old('username'), array('class'=> 'input-block span12 fat-input')) }}
								</div>
								<div class="span6">
									{{ Form::label('email', 'Email*') }}
									{{ Form::email('email', Input::old('email'), array('class'=> 'input-block span12 fat-input')) }}
								</div>
							</div>
							<div class="row-fluid">
								<div class="span6">
									{{ Form::label('password', 'Password*') }}
									{{ Form::password('password', array('class'=> 'input-block span12 fat-input')) }}
								</div>
								<div class="span6">
									{{ Form::label('password_confirmation', 'Confirm Password*') }}
									{{ Form::password('password_confirmation', array('class'=> 'input-block span12 fat-input')) }}
								</div>
							</div>								
							<div class="row-fluid m15">
								<div class="span3">
									{{ Form::submit('submit', array('class'=>'cust-btn fat-btn span12 bluish')) }}
								</div>
								<div class="span9">
									<p class="register-alt">Already Registered? <a href="{{ URL::route('loginUser') }}">Login</a></p>
								</div>
							</div>

							@if( $errors->has() )
								<div class="row-fluid">
									<div class="alert error">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										@foreach ($errors->all() as $error)
											<p>{{ $error }}</p>
										@endforeach
									</div>
								</div>
							@endif

						{{ Form::close() }}

					</div>
					<div class="span2"></div>
				</div>
			</div>
		</div>
		<!-- End .main-intro -->
	</div>
	<!-- End .main-content -->
@stop