<div class='container-fluid discoverView'>
	<div class='discoverLeft'>
		<div class='discoverTitle' v-on:click='toDiscoverContentOne'>
			<img class='discoverTitleImg' src="/img/create.jpg">
			<div class='discoverTitleCover1'></div>
		</div>
		<div class='discoverTitle' v-on:click='toDiscoverContentTwo'>
			<img class='discoverTitleImg' src="/img/connect2.jpg">
			<div class='discoverTitleCover2'></div>
		</div>
		<div class='discoverTitle' v-on:click='toDiscoverContentThree'>
			<img class='discoverTitleImg' src="/img/events.jpg">
			<div class='discoverTitleCover3'></div>
		</div>
		<div class='discoverTabParent'>
			<div class='discoverLeftTab'>
				<div class='leftSideTabText'>Discover</div>
			</div>
		</div>
	</div>
	<div class='discoverRight'>

		<div id='discoverContent1'>
			<div class='discoverContent'>
				<div class='discoverContentTitle'>Create</div>
				  Strengthen your connections by creating Knots and extending threads for others to get tangled.  Users can create Knots for others to join via a private network. We use password protection that strengthens connections through your experience with tanglr
				<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
				<div class='downArrow' v-on:click='arrowScroll'>
					{{-- &#10151 --}}
					<img class='arrowImg' src="/img/down-arrow2.png" alt="">
				</div>
			</div>
		</div>
		<div id='discoverContent2'>
			<div class='discoverContent'>
				<div class='discoverContentTitle'>Connect</div>
				Sew new friendships and connect with interactive, realtime chats/posts and customize your experience with avatar images and adding images from your connections in our media area.  Did we mention access to your photos on Facebook, Instagram, and Google? Oh yeah!

                
				<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
				<div class='downArrow' v-on:click='arrowScroll'>
					{{-- &#10151 --}}
					<img class='arrowImg' src="/img/down-arrow2.png" alt="">
				</div>
			</div>
		</div>
		<div id='discoverContent3'>
			<div class='discoverContent'>
				<div class='upArrow' v-on:click='arrowScroll'>
					{{-- &#10151 --}}
					<img class='arrowImgUp' src="/img/down-arrow2.png" alt="">
				</div>
				{{-- <br><br> --}}
				<div class='discoverContentTitle'>Unite</div>
				Unite for popular causes and grow your community whether you have a dinner, non-profit or a fundraiser it's easy to get people involved and unite them for your events.

                Build your movement with Tanglr below!
				<h4 class='actionDivBlue' v-on:click="showSignUp">Sign Up</h4>
			</div>
		</div>
	</div>
</div>