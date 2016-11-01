<div class='container-fluid discoverView'>
	<div class='discoverLeft'>
		<div class='discoverTitle' v-on:click='toDiscoverContentOne'><img class='discoverTitleImg' src="/img/create.jpg"></div>
		<div class='discoverTitle' v-on:click='toDiscoverContentTwo'><img class='discoverTitleImg' src="/img/share.jpg"></div>
		<div class='discoverTitle' v-on:click='toDiscoverContentThree'><img class='discoverTitleImg' src="/img/events.jpg"></div>
		<div class='discoverTabParent'>
			<div class='discoverLeftTab'></div>
		</div>
	</div>
	<div class='discoverRight'>
		<div class='discoverContent' id='discoverContent1'>
			<h3>Create</h3>
			Strengthen your connections by creating Knots and extending threads for others to join your knots. 
		</div>
		<div class='discoverContent' id='discoverContent2'>
			<h3>Connect</h3>
			Sew new friendships and stay connected with what's important to you. Join your friends knots or create a knot of your own.
		</div>
		<div class='discoverContent' id='discoverContent3'>
			<h3>Unite</h3>
			Unite for popular causes and grow your community.  Whether you have a non-profit or a fundraiser it's easy to get people involved and unite them for your events.
		</div>
		<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
	</div>
</div>