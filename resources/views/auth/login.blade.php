{{-- guest logn navbar --}}
<div class='nbarGuestLogin'>
	<form method='POST' action="{{ action('Auth\AuthController@postLogin') }}">
		{{ csrf_field() }}
		<input class='form-control' type='email' name='email' placeholder='Your Email' required>
		<input class='form-control' type='password' name='password' placeholder='Your Password' required>
		<button type='submit' class='btn loginButton'>Log in</button>
	</form>
	@include('errors.login-register')
</div>

