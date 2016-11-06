	<div class='cover' v-on:click='closeNbarGuest'></div>
	<div class='container-fluid landingView'>
		<div class='container-fluid landingLeft' v-on:mouseover='mouseInLeft'>
			

			<div class='publicKnotParent' v-for="group in groups" id="content">
				<div class='publicKnot' v-on:click="goToPost(group)"><img class='groupBanner' v-bind:src="group.img_url">
					<div class='groupName'>
						@{{group.title}}
					</div>
				</div>
			</div>

		</div>
		<div class='landingRight' v-on:mouseover='mouseInRight'>
			
			<div class='rightSideTab'>
				<div class='rightSideTabText'>Welcome</div>
			</div>
			<div class='leftSideTab'>
				<div class='leftSideTabText'>Public</div>
			</div>
			<div class='landingContent'>
			<div class='landingTitle'>Tanglr</div>
				Tanglr is San Antonio's premiere Social Media Platform! Get tangled with 
				friends, family, colleagues and stay connected with what matters most! Scroll down or press Discover to learn more...
			<h4 class='actionDivBlue' v-on:click="toDiscover">Discover</h4>
			</div>
			<div class='downArrow' v-on:click='arrowScroll'>
				<img class='arrowImg' src="/img/down-arrow.png" alt="">
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
					<div class='eventContainer'>
				  		<div class='eventContentDiv'>@{{event.content}}
					  		<div class='eventDate'>@{{event.start_date}} <span class='to'>to</span> @{{event.end_date}}</div>
						  	<img  class="eventBannerImg" v-bind:src="event.img_url" alt="">
					  		<div class='eventTitleDiv'><strong>@{{event.title}}</strong></div>
					  		</div>
				  		</div>
					</div>
				</div>
		  	</div>
		</div>

	</div>

