<div class='nbarGuestSignup'>
	<form method='POST' action="{{ action('Auth\AuthController@postRegister') }}">
		{{ csrf_field() }}
		<input class='form-control' type='text' name='name' placeholder='Your Name'>			
		<input class='form-control' type='email' name='email' placeholder='Your Email'>
		<input class='form-control' type='password' name='password' placeholder='Your Password'>
		<input class='form-control' type='password' name='password_confirmation' placeholder='Confirm Password'>
		<button type='submit' class='btn signupButton'>Sign Up</button><br>
{{-- 		<button type='submit' class='btn btn-primary loginButton'>Facebook</button>
		<button type='submit' class='btn btn-warning loginButton'>Google</button> --}}
	</form>
</div>