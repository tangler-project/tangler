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
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
		<div class='discoverContent' id='discoverContent2'>
			<h3>Connect</h3>
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		</div>
		<div class='discoverContent' id='discoverContent3'>
			<h3>Unite</h3>
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		</div>
		<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
	</div>
</div>