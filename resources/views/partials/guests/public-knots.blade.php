	<div class='container-fluid landingView'>
		<div class='container-fluid landingLeft'>

			{{-- search bar --}}
			<br><br>
			<div class="form-group">
	          <input type="text" class="form-control" placeholder="Search on table" id="searchBar">
	        </div>
	        {{-- end search bar --}}

			<div v-for="group in groups" id="content">
				<div class='publicKnot' v-on:click="goToPost(group)"><img class='groupBanner' v-bind:src="group.img_url">
					<div class='groupName'>
						@{{group.title}} @{{group.id}}
					</div>
				</div>
			</div>

		</div>
		<div class='container-fluid landingRight'>
			<h2 class='landingTitle'>Tangler</h2>
			<div class='landingContent'>
				Tangler is San Antonio's premiere Social Media Platform! Get tangled with 
				friends, family, colleagues and stay connected with what matters most! Scroll down or press Discover to learn more...
			</div>
			<h4 class='landingDiscover' v-on:click="toDiscover">Discover</h4>
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

