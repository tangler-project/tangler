<div class='container-fluid mediaView'>
	<div class='mediaLeft'>Image Here</div>
	<div class='mediaRight'>

		<div v-for="post in groupPosts">
		
				<div class="col-sm-3" v-show="post.img_url">
					<img class='mediaTD' v-bind:src="post.img_url">
				</div>
		</div>

	</div>
</div>