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

				// $.getJSON('api/posts',function(data){
				
				// 	console.log("in");
				// 	this.posts = data;

				// }.bind(this));

				this.$http.get('api/posts').then((response) => {
					this.$set('posts', response.body);
				});	
			},
			savePost: function(){
				this.$http.save('/add/post').then((response)=>{

				});
			}
		}

	});


	new Vue({
		el: '#post-body'


	});
</script>