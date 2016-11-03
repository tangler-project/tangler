	<div class='cover' v-on:click='closeNbarGuest'></div>
	<div class='container-fluid landingView'>
		<div class='container-fluid landingLeft' v-on:mouseover='noScroll' v-on:mouseleave='yesScroll'>

			<div class='publicKnotParent' v-for="group in groups" id="content">
				<div class='publicKnot' v-on:click="goToPost(group)"><img class='groupBanner' v-bind:src="group.img_url">
					<div class='groupName'>
						@{{group.title}} @{{group.id}}
					</div>
				</div>
			</div>

		</div>
		<div class='landingRight'>
			<div class='landingContent'>
			<div class='landingTitle'>Tangler</div>
				Tangler is San Antonio's premiere Social Media Platform! Get tangled with 
				friends, family, colleagues and stay connected with what matters most! Scroll down or press Discover to learn more...
			<h4 class='actionDivBlue' v-on:click="toDiscover">Discover</h4>
			</div>
		</div>

	</div>


	<div class='publicGroupView'>
		<div class='publicGroupLeft'>
			<div class='posts' v-for="post in groupPosts">
				<div class="outputText">@{{post.content}}
					<div class='avatarDiv'>
						<img class='avatarImg' v-bind:src="post.user.img_url" alt="">
					</div>
					<div class='usernameDiv'>
						@{{ post.user.name }}
					</div>
					<div class='postDate'>@{{post.created_at}}</div>
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

