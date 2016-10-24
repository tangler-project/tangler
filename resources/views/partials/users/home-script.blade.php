<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');


	
	Vue.component('posts',{


		template: '#posts-template',

		data: function(){
			return {
				posts: [],
				post: {}
			};
		},

		created: function(){
			this.fetchPosts();
			
		},

		methods:{
			scrollToBottom: function(){
				$('.publicUserGroupLeft').stop().animate({
				  	scrollTop: $('.publicUserGroupLeft')[0].scrollHeight
				}, 800);
				$('.createNewPost').val('');
			},

			fetchPosts: function(){

				this.$http.get('api/posts').then((response) => {
					// Another way to fetch the data...
					// this.posts = response.data;
					this.$set('posts', response.body);
				});	
			},
			savePost: function(e){
				e.preventDefault();
				
				var component = this;
				this.$http.post('/add/post', this.post).then((response)=>{
					component.fetchPosts();
					component.scrollToBottom();
				});
			}
		}

	});


	new Vue({
		el: '#post-body'


	});


</script>