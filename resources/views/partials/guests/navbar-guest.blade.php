@include('errors.login-register')

<div class='topNbarHover' v-on:mouseover='showTopNbar' v-on:mouseleave='hideTopNbar'>
	<div class="form-group searchBar">
      	<input type="text" class="searchInput" placeholder="Search" id="searchBar">
    </div>
	<div class='topNbarGuest' id="home">
		<div class='guestTopLink linkHome' v-on:click="toHome">Home</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkDiscover' v-on:click="toDiscover">Discover</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkContact' v-on:click="toContact">The Team</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink' v-on:click="showSignUp">Sign Up</div>
	</div>
	<div class='topNbarTab'>Navigation</div>
</div>

<div class='nbarGuest'>
	<div class='nbarGuestMain'>
		<div class='logLinks'>
			<div class='linkSignupReturn' v-on:click="returnSignUp">Sign up</div>
			<div class='linkLogin' v-on:click="showLogIn">Log in</div>
		</div>
		<div>
			@include('auth.register')
			@include('auth.login')
		</div>
	</div>	
</div>