
<div class='changeGroupView'>

	<div class='homeTabParent'>
		<div class='changeGroupLeft content' v-on:mouseover='mouseInLeft'>
			<div class='publicKnotParent' v-for="group in groups">
				<div class='publicUserKnot' v-on:click="goToPost(group,'.topNbarUserPublic')"><img class='groupBanner' v-bind:src="group.img_url">
					<div class='groupName'>
						@{{group.title}}
					</div>
				</div>
			</div>	
		</div>


		<div class='changeGroupRight content' v-on:mouseover='mouseInRight'>
			<div class='privateKnotParent' v-for="group in privateGroups">
				<div class='privateKnot' v-on:click="goToPost(group,'.topNbarUser')"><img class='groupBanner' v-bind:src="group.img_url">
					<div class='groupNameRight'>
						@{{group.title}}
					</div>
				</div>
			</div>	
		</div>
		<div class='leftSideTab'>
			<div class='leftSideTabText'>Public</div>
		</div>
		<div class='rightSideTab'>
			<div class='rightSideTabText'>Private</div>
		</div>
	</div>
	

</div>


<div class='publicUserGroupView'>
	<div class='publicUserGroupLeft' id='userPosts'>
		{{-- <div class='posts list-group'> --}}
			<div class='posts' v-for="post in groupPosts">
				<div class="outputText" onchange="showEmoji()">@{{post.content}}
					<div class='avatarDiv'>
						<div class='usernameDiv'>
							@{{ post.user.name }}
						</div>
						<img class='avatarImg' v-bind:src="post.user.img_url" alt="">
					</div>
				{{-- <img v-bind:src="post.img_url" alt=""> --}}
					{{-- BEGIN THUBS UP-DOWN--}}
					<div class='thumbsParent'>
						<form method="POST" class="likeForm">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input id="postVote" type="" name="vote" value="1" v-model="post.vote" hidden>
							<input id="postIdUp" type="" name="post_id" value=@{{post.id}} v-model="postId" hidden>

							<button type="submit" class="thumbsBtn" v-on:click="setVotesUp($event, post.id)" >
								<i class="fa fa-thumbs-o-up" aria-hidden="true" > @{{post.likes}}</i>
							</button>
						</form>
						<form method="POST" class="dislikeForm">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input id="postVote" type="" name="vote" value="-1" v-model="post.vote" hidden>
							<input id="postIdDown" type="" name="post_id" value=@{{post.id}} v-model="postId" hidden>

							<button type="submit" class="thumbsBtn" v-on:click="setVotesDown($event, post.id)" >
								<i class="fa fa-thumbs-down" aria-hidden="true"> @{{post.dislikes}}</i>
							</button>	
						</form>
					</div>
					{{-- END --}}
					<div class='postDate'>@{{post.created_at}}</div>
				</div>
				
			</div>
		{{-- </div>	 --}}
	</div>
			

	<div class='createNewPost'>
		<form method='POST' class='postForm'>
			{{-- {{ csrf_field() }} --}}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
			
			<input id='postInput' class='form-control' type='text' name='input' v-model="post.input" autofocus>

			<input type="hidden" name="img_url" id="uploadedImage" value="" v-model="post.img_url">
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Add Photo" onchange="showImage();" data-fp-multiple="false"  data-fp-crop-ratio="3.3" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)">
			{{-- END FILESTACK --}}

			<button type='submit' hidden v-on:click="savePost">Post</button>
		</form>
	</div>

	<div class='publicUserGroupRight'>
		<div class="listOfEvents">
			<div v-for="event in groupEvents">
				<div class='eventContainer'>
			  		<div class='eventContentDiv'>@{{event.content}}</div>
				  	<div class='dateContainer'>
				  		<div class='eventStartDate'> @{{event.start_date}} </div>	
				  	 	<div class='eventEndDate'> @{{event.end_date}} </div>	
				  	</div>
				  	<div class='eventBannerDiv'>
				  	{{-- <img v-bind:src="event.img_url" alt=""><br> --}}
					  	<img class='eventBannerImg' src="http://placehold.it/400x300">
					  	<div class='eventTitleDiv'><strong>@{{event.title}}</strong></div>
					</div>
			  		<div class='editDiv' v-if="event.owner_id == {{Auth::user()->id}}">
				  		<button v-on:click="goToEvent(event)">Edit</button>
			  		</div>
				 </div>
			</div>
	  	</div> 	
	</div>

</div>
