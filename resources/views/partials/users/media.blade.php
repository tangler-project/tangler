<div class='container-fluid mediaView'>
	<div class='mediaLeft'>Image Here</div>
	<div class='mediaRight'>

		<div v-for="post in groupPosts">
		
				<div class="col-sm-3">
					<img class='mediaTD' v-bind:src="post.img_url">
				</div>
		</div>

	</div>
</div>