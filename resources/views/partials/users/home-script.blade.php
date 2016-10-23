<script>
	Vue.component('posts',{

		template: '#posts-template',

		data: function(){
			return {
				posts: []
			};
		},

		created: function(){
			this.fetchPosts();
			
		},

		methods:{
			fetchPosts: function(){
				// var resource = this.$resource('api/posts');
				//resource.get
				$.getJSON('api/posts',function(data){

					this.posts = data;

				}.bind(this));
			}
		}
	});


	new Vue({
		el: '#post-body'


	});
</script>