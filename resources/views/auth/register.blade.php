<div class='nbarGuestSignup'>
	<form method='POST' action="{{ action('Auth\AuthController@postRegister') }}">
		{{ csrf_field() }}
		<input class='form-control' type='text' name='name' placeholder='Your Name' required>			
		<input class='form-control' type='email' name='email' placeholder='Your Email' required>
		<input class='form-control' type='password' name='password' placeholder='Your Password' v-model="newUser.password" required>
		<input class='form-control' type='password' name='password_confirmation' placeholder='Confirm Password' v-model="newUser.confirmPassword" required>

		<button type='submit' class='btn signupButton' v-on:click="validateARegister">Get Tangled</button><br>
{{-- 		<button type='submit' class='btn btn-primary loginButton'>Facebook</button>
		<button type='submit' class='btn btn-warning loginButton'>Google</button> --}}
	</form>
	<div v-show="errorPassword">
		<p class="errors">The passwords entered do not match</p>
	</div>
	@include('errors.login-register')
</div>
