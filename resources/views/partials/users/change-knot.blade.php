
<div class='container-fluid changeGroupView'>

	<div class='container-fluid changeGroupLeft'>
		<div v-for="group in groups">
			<div class='publicUserKnot' v-on:click="goToPost(group)"><img class='groupBanner' src="http://placehold.it/800x250">
				<div class='groupName'>
					@{{group.title}} @{{group.id}}
				</div>
			</div>
		</div>	
	</div>
	<div class='container-fluid changeGroupRight'>
		<div v-for="group in privateGroups">
			<div class='privateKnot' v-on:click="goToPost(group)"><img class='groupBanner' src="http://placehold.it/800x250">
				<div class='groupName'>
					@{{group.title}} @{{group.id}}
				</div>
			</div>
		</div>	
	</div>

</div>


<div class='container-fluid publicUserGroupView'>
	<div class='publicUserGroupLeft'>
		<div class='posts list-group'>
			<div v-for="post in groupPosts">
				<h5>@{{post.owner_id}}</h5>
				<p>@{{post.content}}<p>
				<strong>@{{post.created_at}}</strong>
			</div>
		</div>	
	</div>

	<div class='createNewPost'>
		<form method='POST'>
			{{ csrf_field() }}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input id='postInput' class='form-control' type='text' name='content' v-model="post.input" autofocus>
			<button type='submit' class='hidden' v-on:click="savePost">Post</button>
		</form>
	</div>

	<div class='publicUserGroupRight'>
		<div class="list-group listOfEvents">
			<button class='btn createEventButton' v-on:click="showCreateEvent">New Event</button>
			<div v-for="event in groupEvents">
			  	<div class="list-group-item list-group-item-action">
				  	<h5>@{{event.title}}</h5>
				  	<p>@{{event.content}}</p>
				  	<span>Starts: </span><strong>@{{event.start_date}}</strong>
				  	<span>Ends: </span><strong>@{{event.end_date}}</strong>
			  	</div>
			</div>
	  	</div>
	  	<div class='createNewEvent'>
			<button class='btn eventBackButton' v-on:click="backToEvents">Back</button>
    		<form method='POST'>
    			{{ csrf_field() }}
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

    			<input class='form-control' type='text' name='title' placeholder='Title'>
    			<input class='form-control' type='text' name='description' placeholder='Description'>
    			<input class='form-control' type='datetime-local' name='start_date' placeholder='Start Date/Time'>
    			<input class='form-control' type='datetime-local' name='end_date' placeholder='End Date/Time'>
    			<button type='submit' class='btn createEventButton' v-on:click="saveEvent">Create Event</button>
    		</form>
		</div>
	</div>
</div>
