<div id="group-body">
	<div >
		<groups></groups>
	</div>

	<template id="groups-template">
		<div class='container-fluid landingLeft'  v-if="displayGroups">
			<h4 class='landingTitle'>Public Knots</h4>
			<div v-for="group in groups">
				<div class='publicKnot' v-on:click="goToPost(group)">	
						@{{group.title}}
				</div>
			</div>

		</div>
		<div class='container-fluid landingRight' v-if="displayGroups">
		<h2 class='landingTitle'>Tangler</h2>
		<div class='landingContent'>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
		</div>
		<h4 class='landingDiscover'>Discover</h4>
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


</div>
