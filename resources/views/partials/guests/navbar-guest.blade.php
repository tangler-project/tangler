@if(count($errors))
	<div class="alert alert-danger text-center">
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>
@endif

<div class='topNbarGuest'>
	<div class='guestTopLink linkHome'>Home</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkDiscover'>Discover</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkContact'>Contact</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkSignup'>Sign Up</div>
</div>


<div class='nbarGuest'>
	<div class='nbarGuestMain'>
		<div class='navLink linkHome'>Home</div>
		<div class='navLink linkDiscover'>Discover</div>
		<div class='navLink linkContact'>Contact</div>
		<div class='navLink linkSignup'>Sign Up</div>
		<div class='closeNbarGuest'>X</div>
	</div>

	
	<div class='nbarGuestSignup'>
		<div class='linkLogin'>Log in</div>
		<form method='POST' action="{{ action('Auth\AuthController@postRegister') }}">
			{{ csrf_field() }}
			<input class='form-control' type='text' name='name' placeholder='Your Name'>			
			<input class='form-control' type='email' name='email' placeholder='Your Email'>
			
			<input class='form-control' type='password' name='password' placeholder='Your Password'>

			<input class='form-control' type='password' name='password_confirmation' placeholder='Confirm Password'>
			
			<button type='submit' class='btn signupButton'>Sign Up</button><br>
			<button type='submit' class='btn btn-primary loginButton'>Facebook</button>
			<button type='submit' class='btn btn-warning loginButton'>Google</button>
			<div class='closeNbarGuest'>X</div>
		</form>
	</div>
	<div class='nbarGuestLogin'>
		<div class='linkSignupReturn'>Sign up</div>
		<form method='POST' action="{{ action('Auth\AuthController@postLogin') }}">
			{{ csrf_field() }}
			<input class='form-control' type='email' name='email' placeholder='Your Email'>
			<input class='form-control' type='password' name='password' placeholder='Your Password'>
			<button type='submit' class='btn loginButton'>Log in</button>
			<button type='submit' class='btn btn-primary loginButton'>Facebook</button>
			<button type='submit' class='btn btn-warning loginButton'>Google</button>
			<div class='closeNbarGuest'>X</div>
		</form>
	</div>
</div>