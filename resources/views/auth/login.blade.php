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