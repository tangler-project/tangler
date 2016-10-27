<script>
	Vue.component('groups',{
		template: '#groups-template',

		data: function(){

			return {
				groups: [],
				privateGroups:[],

				post:{},
				posts:[],

				group: {},
				groupObject:{},
				//arrays for individual group data
				groupPosts:[],
				groupEvents:[],

				displayGroups:true,
				displayGroupData:false

			};
		},

		created: function(){
			this.fetchGroups();
			this.fetchPrivateGroups();
			this.fetchPosts();
		},

		methods:{
			fetchGroups: function(){
				this.$http.get('api/groups').then((response) => {
					var array = response.body;
					var result=[];
					//filter the result array to just display public posts
					for(var i=0; i < array.length; i++){
						if(array[i].is_private == 0)//if that element is not private
							result.push(array[i]);
					}
					this.$set('groups', result);

				});	
			},

			fetchPrivateGroups: function(){
				this.$http.get('api/groups').then((response) => {
					var array = response.body;
					var result=[];
					//filter the result array to just display public posts
					for(var i=0; i < array.length; i++){
						if(array[i].is_private == 1)//if that element is not private
							result.push(array[i]);
					}
					this.$set('privateGroups', result);

				});	
			},

			goToPost: function(group){
				console.log(group.id);
				//display the groups data
				this.displayGroupData = true;
				//hide the groups views
				this.displayGroups = false;
				//alignment
				$('.logoLine').css('left', '60%');
			    $('.nbarGuest').css('left', '60%');
			    
			    var component = this;
			   	this.$http.get('api/groups/'+group.id).then((response) => {	
			   		
					this.$set('groupObject', response.body);
					this.$set('groupPosts', response.body.post);
					this.$set('groupEvents', response.body.event);
		
			   	});

			   	//scroll bottom animation
			    $('.publicGroupLeft').stop().animate({
			          scrollTop: $('.publicGroupLeft')[0].scrollHeight
			    }, 10);	
			},

			savePost: function(e){
				e.preventDefault();
				
				// var component = this;
				this.$http.post('/add/post', this.post).then((response)=>{
					console.log(this.post);
					this.fetchPosts();
					this.scrollToBottom();

				});
			},

			// scrollToBottom: function(){
			// 	$('.publicUserGroupLeft').stop().animate({
			// 	  	scrollTop: $('.publicUserGroupLeft')[0].scrollHeight
			// 	}, 800);
			// 	$('#postInput').val('');
			// },

			fetchPosts: function(){

				this.$http.get('api/posts').then((response) => {
					// Another way to fetch the data...
					// this.posts = response.data;
					this.$set('posts', response.data);
				});	
			},

			

				
		}

	});


	new Vue({
		el: '#body'


	});
	


</script>



</script>