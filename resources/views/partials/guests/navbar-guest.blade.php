
<div class='mobileNbar' id="home">
	<div class='linkParent mobileLinkParent'>
		<div class='guestTopLink homeLink mobileLink' v-on:click="toHome">Home</div>
		<div class='guestTopLink mobileMid mobileLink' v-on:click="toDiscover">Discover</div>
		<div class='guestTopLink mobileLink' v-on:click="showSignUp">Sign Up</div>
	</div>
</div>



<div class='topNbarHover' v-on:mouseover='showTopNbar' v-on:mouseleave='hideTopNbar'>
	<div class="form-group searchBar">
      	<input type="text"  class="searchInput form-control" placeholder="Search group" id="searchBar">
    </div>
	<div class='topNbarGuest' id="home">
		<div class='linkParent'>
			<div class='guestTopLink homeLink' v-on:click="toHome">Home</div>
			<div class='guestTopLink midTopLink' v-on:click="toDiscover">Discover</div>
			<div class='guestTopLink' v-on:click="showSignUp">Sign Up</div>
		</div>
	</div>
	<div class='topNbarTab'>
		Navigation
	</div>
</div>

<div class='nbarGuest'>
	<div class='nbarGuestMain'>
		<div class='logLinks'>
			<div class='linkSignupReturn' v-on:click="returnSignUp">Sign up</div>
			<div class='linkLogin' v-on:click="showLogIn">Log in</div>
			<div class='linkOutline'></div>
		</div>
		<div>
			@include('auth.register')
			@include('auth.login')
		</div>
	</div>	
</div>

