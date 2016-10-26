<div id="body">
	<groups></groups>
</div>

<template id="groups-template">
	

	<div class='container-fluid changeGroupView' v-if="displayGroups">
		<div class='container-fluid changeGroupLeft'>
			<div v-for="group in groups">
				
				<div class='publicUserKnot'><img class='groupBanner' src="http://placehold.it/800x200">
					<div class='groupName' v-on:click="goToPost(group)">
						@{{group.title}}
					</div>
				</div>

			</div>
			
			
		</div>
		<div class='container-fluid changeGroupRight'>
			<div v-for="group in privateGroups">

				<div class='privateKnot' v-on:click="goToPost(group)">
					@{{group.title}}
				</div>

			</div>
			
		</div>
	</div>

	<div v-if="displayGroupData">
			<div class='container-fluid publicGroupView'>
				<div class='publicGroupLeft'>
					<div class='posts list-group'>
						<div v-for="post in groupPosts">
							<h5>@{{post.owner_id}}</h5>
							<p>@{{post.content}}<p>
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
		</div>
</template>