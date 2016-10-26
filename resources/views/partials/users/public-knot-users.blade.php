<div class='container-fluid publicUserGroupView'>

<div id="post-body">
	<div >
		{{-- <posts></posts>	 --}}
	</div>

	<template id="posts-template">
		<div class="publicUserGroupLeft">
			<div v-for="post in posts">
				<div class="posts">
					<h5>@{{ post.user.name }}</h5>
					<p>
						@{{post.content}}
						<br><strong>group owner</strong>
						@{{post.group.id}}
					</p>
					<strong>@{{post.created_at}}</strong>
				</div>
				
			</div>
			<div class='createNewPost'>
				<form method='POST'>
					<input id='postInput' class='form-control' type='text' name='post' v-model="post.content" autofocus>
					<button type='submit' class='hidden' v-on:click="savePost">Post</button>
				</form>
			</div>
		</div>
	</template>
</div>

	{{-- <div class='publicUserGroupRight'>
		<div class="list-group listOfEvents">
		<button class='btn createEventButton'>New Event</button>
		  	<div class="list-group-item list-group-item-action">
		    	<h5 class="list-group-item-heading">Event Title</h5>
		    	<h5 class="list-group-item-heading">DateTime</h5>
		    	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		  	</div>
		  	<div class="list-group-item list-group-item-action">
		    	<h5 class="list-group-item-heading">Event Title</h5>
		    	<h5 class="list-group-item-heading">DateTime</h5>
		    	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		  	</div>
		  	<div class="list-group-item list-group-item-action">
		    	<h5 class="list-group-item-heading">Event Title</h5>
		    	<h5 class="list-group-item-heading">DateTime</h5>
		    	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		  	</div>
		  	<div class="list-group-item list-group-item-action">
		    	<h5 class="list-group-item-heading">Event Title</h5>
		    	<h5 class="list-group-item-heading">DateTime</h5>
		    	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		  	</div>
		  	<div class="list-group-item list-group-item-action">
		    	<h5 class="list-group-item-heading">Event Title</h5>
		    	<h5 class="list-group-item-heading">DateTime</h5>
		    	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		  	</div>
		</div>
		<div class='createNewEvent'>
			<button class='btn eventBackButton'>Back</button>
    		<form method='POST'>
    			<input class='form-control' type='text' name='name' placeholder='Title'>
    			<input class='form-control' type='text' name='email' placeholder='Description'>
    			<input class='form-control' type='datetime-local' name='password' placeholder='Start Date/Time'>
    			<input class='form-control' type='datetime-local' name='confirmPassword' placeholder='End Date/Time'>
    			<button type='submit' class='btn createEventButton'>Create Event</button>
    		</form>
    	</div>
	</div> --}}
</div>