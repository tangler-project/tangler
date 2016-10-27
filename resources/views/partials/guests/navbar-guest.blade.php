@include('errors.login-register')

<div class='topNbarGuest' id="home">
	<div class='guestTopLink linkHome'>Home</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkDiscover'>Discover</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkContact'>Contact</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink' v-on:click="showSignUp">Sign Up</div>
</div>


<div class='nbarGuest'>
	<div class='nbarGuestMain'>
		<div class='navLink linkHome'>Home</div>
		<div class='navLink linkDiscover'>Discover</div>
		<div class='navLink linkContact'>Contact</div>
		<div class='navLink linkSignup' v-on:click="showSignUp">Sign Up</div>
		<div class='closeNbarGuest' v-on:click="closeNbarGuest">X</div>
	</div>

	@include('auth.register')
	@include('auth.login')
	
</div>