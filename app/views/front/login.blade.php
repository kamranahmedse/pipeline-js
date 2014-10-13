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
							<h2 class="p40 text-left">Login to your Account</h2>
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

						{{ Form::open(array('url' => URL::route('processLoginUser'), 'method' => 'post', 'class' => 'register-form' )) }}
							<div class="row-fluid">
								<div class="span3"></div>
								<div class="span6">
								{{ Form::label('username', 'Username*') }}
								{{ Form::text('username', Input::old('username'), array('class'=> 'input-block span12 fat-input')) }}
								</div>
								<div class="span3"></div>
							</div>
							<div class="row-fluid">
								<div class="span3"></div>
								<div class="span6">
									{{ Form::label('password', 'Password*') }}
									{{ Form::password('password', array('class'=> 'input-block span12 fat-input')) }}
								</div>
								<div class="span3"></div>
							</div>								
							<div class="row-fluid m15">
								<div class="span3"></div>
								<div class="span3">
									{{ Form::submit('submit', array('class'=>'cust-btn fat-btn span12 bluish')) }}
								</div>
								<div class="span3">
									<p class="register-alt">Need an account? <a href="{{ URL::route('registerUser') }}" class="emph">Register</a></p>
								</div>
								<div class="span3"></div>
							</div>
							<div class="row-fluid">
								<div class="span3"></div>
								<div class="span6">
									<div class="alert error">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  <p class="m0">Invalid Username/Password entered.</p>
									  <!-- <p class="m0">Have you <a href="#" class="emph">Forgot your username/password?</a></p> -->
									</div>
								</div>
								<div class="span3"></div>
							</div>
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