
<div class='container-fluid changeGroupView'>

	<div class='container-fluid changeGroupLeft'>
		<div class='publicKnotParent' v-for="group in groups">
			<div class='publicUserKnot' v-on:click="goToPost(group,'.topNbarUserPublic')"><img class='groupBanner' src="http://placehold.it/1400x425">
				<div class='groupName'>
					@{{group.title}} @{{group.id}}
				</div>
			</div>
		</div>	
	</div>
	<div class='container-fluid changeGroupRight'>
		<div v-for="group in privateGroups">
			<div class='privateKnot' v-on:click="goToPost(group,'.topNbarUser')"><img class='groupBanner' src="http://placehold.it/1400x425">
				<div class='groupName'>
					@{{group.title}} @{{group.id}}
				</div>
			</div>
		</div>	
	</div>

</div>


<div class='container-fluid publicUserGroupView'>
	<div class='publicUserGroupLeft' id='userPosts'>
		<div class='posts list-group'>
			<div v-for="post in groupPosts">
				<h5>@{{ post.user.name }}</h5>
				<p class="outputText" onchange="showEmoji()">@{{post.content}}<p>
				<img v-bind:src="post.img_url" alt=""><br>
				<strong>@{{post.created_at}}</strong>
				
				{{-- BEGIN THUBS UP-DOWN--}}
				<form method="POST" class="pull-left">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input id="postVote" type="" name="vote" value="1" v-model="post.vote" hidden>
					<input id="postIdUp" type="" name="post_id" value=@{{post.id}} v-model="postId" hidden>

					<button type="submit" class="btn btn-default btn-md btn-thumbs" v-on:click="setVotesUp($event, post.id)" >
						<i class="fa fa-thumbs-o-up" aria-hidden="true" >@{{post.likes}}</i>
					</button>
				</form>
				<form method="POST" >
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input id="postVote" type="" name="vote" value="-1" v-model="post.vote" hidden>
					<input id="postIdDown" type="" name="post_id" value=@{{post.id}} v-model="postId" hidden>

					<button type="submit" class="btn btn-default btn-md btn-thumbs" v-on:click="setVotesDown($event, post.id)" >
						<i class="fa fa-thumbs-down" aria-hidden="true">@{{post.dislikes}}</i>
					</button>	
				</form>
				{{-- END --}}
			</div>
		</div>	
	</div>
			

	<div class='createNewPost'>
		<form method='POST'>
			{{-- {{ csrf_field() }} --}}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
			
			<input id='postInput' class='form-control' type='text' name='input' v-model="post.input" autofocus>

			<input type="hidden" name="img_url" id="uploadedImage" value="" v-model="post.img_url">
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Add Photo" onchange="showImage();" data-fp-multiple="false" data-fp-crop-dim="230,230" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)">
			{{-- END FILESTACK --}}

			<button type='submit' hidden v-on:click="savePost">Post</button>
		</form>
	</div>

	<div class='publicUserGroupRight'>
		<div class="list-group listOfEvents">
			<button class='btn createEventButton' v-on:click="showCreateEvent">New Event</button>
			<div v-for="event in groupEvents">
			  	<div class="list-group-item list-group-item-action">
			  		<div v-if="event.owner_id == {{Auth::user()->id}}">
				  		<button class='btn' v-on:click="goToEvent(event)">Edit</button>
			  		</div>
				  	<h5>@{{event.title}}</h5>
				  	<p>@{{event.content}}</p>
				  	<img v-bind:src="event.img_url" alt=""><br>
				  	<span>Starts: </span><strong>@{{event.start_date}}</strong>
				  	<span>Ends: </span><strong>@{{event.end_date}}</strong>

			  	</div>
			</div>
	  	</div>
	  	
	</div>
</div>
