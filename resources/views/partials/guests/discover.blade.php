<div class='container-fluid discoverView'>
	<div class='discoverLeft'>
		<div class='discoverTitle' v-on:click='toDiscoverContentOne'><img class='discoverTitleImg' src="/img/create.jpg"></div>
		<div class='discoverTitle' v-on:click='toDiscoverContentTwo'><img class='discoverTitleImg' src="/img/connect2.jpg"></div>
		<div class='discoverTitle' v-on:click='toDiscoverContentThree'><img class='discoverTitleImg' src="/img/events.jpg"></div>
		<div class='discoverTabParent'>
			<div class='discoverLeftTab'></div>
		</div>
	</div>
	<div class='discoverRight'>

		<div id='discoverContent1'>
			<div class='discoverContent'>
				<div class='discoverContentTitle'>Create</div>
				Strengthen your connections by creating Knots and extending threads for others to join your knots.
				<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
			</div>
		</div>
		<div id='discoverContent2'>
			<div class='discoverContent'>
				<div class='discoverContentTitle'>Connect</div>
				Sew new friendships and stay connected with what's important to you. Join your friends knots or create a knot of your own.
				<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
			</div>
		</div>
		<div id='discoverContent3'>
			<div class='discoverContent'>
				<div class='discoverContentTitle'>Unite</div>
				Unite for popular causes and grow your community.  Whether you have a non-profit or a fundraiser it's easy to get people involved and unite them for your events.
				<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
			</div>
		</div>
	</div>
</div>