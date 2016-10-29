	<div class='container-fluid landingView'>
		<div class='container-fluid landingLeft'>
			<div class='publicKnotParent' v-for="group in groups">
				<div class='publicKnot' v-on:click="goToPost(group)"><img class='groupBanner' src="http://placehold.it/1400x425">
					<div class='groupName'>
						@{{group.title}} @{{group.id}}
					</div>
				</div>
			</div>

		</div>
		<div class='container-fluid landingRight'>
			<div class='landingContent'>
			<h2 class='landingTitle'>Tangler</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
			<h4 class='landingDiscover' v-on:click="toDiscover">Discover</h4>
			</div>
		</div>

	</div>


	<div class='container-fluid publicGroupView'>
		<div class='publicGroupLeft'>
			<div class='posts list-group'>
				<div v-for="post in groupPosts">
					<h5>@{{post.owner_id}}</h5>
					<p>@{{post.content}}<p>
					<img v-bind:src="post.img_url" alt="">
					<strong>@{{post.created_at}}</strong>
				</div>	
			</div>	
		</div>

		<div class='publicGroupRight'>
			<div class="list-group">
				<div v-for="event in groupEvents">
				  	<div class="list-group-item list-group-item-action">
					  	<h5>@{{event.title}}</h5>
					  	<p>@{{event.content}}</p>
					  	<span>Starts: </span><strong>@{{event.start_date}}</strong>
					  	<span>Ends: </span><strong>@{{event.end_date}}</strong>
				  	</div>
				</div>
		  	</div>
		</div>
	</div>

