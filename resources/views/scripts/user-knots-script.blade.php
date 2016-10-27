<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');
	Vue.component('home',{
		template: '#home-template',

		data: function(){

			return {
				groups: [],
				privateGroups:[],

				
				group:{
					title:"",
					password:"",
					confirmPassword:""
				},

				event:{
					title:"",
					content:"",
					start_date:"",
					end_date:""
				},

				post:{
					input:""
				},
				
				posts:[],

				group: {},
				groupObject:{},
				//arrays for individual group data
				groupPosts:[],
				groupEvents:[],

			};
		},

		created: function(){
			this.fetchGroups();
			this.fetchPrivateGroups();
			this.fetchEvents();
		},

		methods:{

			fetchEvents:function(){
				this.$http.get('api/events/'+this.groupId).then((response) => {
					//setting the array of events with the new event
					this.$set('groupEvents', response.body);	
				});	
			},
			
			saveEvent: function(e){
				e.preventDefault();
				var component = this;
				this.event.group_id = this.groupId;

				this.$http.post('/add/event', this.event).then((response)=>{
					//component
					this.fetchEvents();
					this.event.title="";
					this.event.content="";
					this.event.start_date="";
					this.event.end_date="";

				//getting the errors back from validate 
				//need array to run through errors to display them
				}, (response) => {
			    	console.log(response.body);
			  	});
			  	this.backToEvents();
			},
			//NAVBAR USER SCRIPT
			scrollToBottom: function(){
				$('.publicUserGroupLeft').stop().animate({
				  	scrollTop: $('.publicUserGroupLeft')[0].scrollHeight
				}, 800);
				$('#postInput').val('');
			},

			fetchPosts: function(){

				this.$http.get('api/posts/'+this.groupId).then((response) => {
					//setting the array with the new post
					this.$set('groupPosts', response.body);
					
				});	
			},
			savePost: function(e){
				e.preventDefault();
				var component = this;
				//getting the group id and assigning that variable
				this.post.group_id = this.groupId;

				this.$http.post('/add/post', this.post).then((response)=>{
					this.fetchPosts();
					this.scrollToBottom();

				}, (response) => {
		    		console.log(response.body);
				});
			},
			saveGroup: function(e){
				e.preventDefault();
				var component = this;

				this.$http.post('/add/group', this.group).then((response)=>{
					//if response fails, now im checking for incorrect
					//match of passwords
					if(response.body == 'fail'){
						console.log("passwords do not match");
					}
					else{
						console.log("should be updating view");
						//component
						this.fetchGroups();
						this.fetchPrivateGroups();
					}
				//getting the errors back from validate 
				//need array to run through errors to display them
				}, (response) => {
			    	console.log(response.body);
			  	});
			},
			//END
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
			    var component = this;
			   	this.$http.get('api/groups/'+group.id).then((response) => {
			   		this.groupId = group.id;
			   		
					this.$set('groupObject', response.body);

					this.fetchPosts();
					// this.$set('groupPosts', response.body.post);
					this.fetchEvents();
		
			   	});

			    $('.changeGroupView').css('display', 'none');
			    $('.nbarUserChangeKnot').css('display', 'none');
			    $('.nbarUserMain').css('display', 'flex');
			    $('.TopNbarUser').css('display', 'flex');
				$('.publicUserGroupView').css('display', 'flex');
				$('.logoLine').css('left', '60%');
				$('.nbarUser').css('left', '60%');
			    $('.nbarUser').css('display', 'none');
				$('.publicUserGroupLeft').stop().animate({
				  	scrollTop: $('.publicUserGroupLeft')[0].scrollHeight
				}, 10);
			},


			showCreateEvent: function(){
				$('.listOfEvents').css('display', 'none');
    			$('.createNewEvent').css('display', 'block');
			},	

			backToEvents: function(){
				$('.createNewEvent').css('display', 'none');
    			$('.listOfEvents').css('display', 'block');
			},

			toUserHome: function(){
				$('.publicUserGroupView').css('display', 'flex');
			    $('.mediaView').css('display', 'none');
			    $('.logoLine').css('left', '60%');
			    $('.nbarUser').css('left', '60%');
			    $('.nbarUser').css('display', 'none');
			    $('.cover').css('display', 'none');
			},

			toChooseKnot: function(){
				$('.publicUserGroupView').css('display', 'none');
			    $('.TopNbarUser').css('display', 'none');
			    $('.changeGroupView').css('display', 'flex');
			    $('.logoLine').css('left', '50%');
			    $('.nbarUser').css('left', '50%');
			    $('.nbarUser').css('display', 'none');
			    $('.nbarUserMain').css('display', 'none');
			    $('.nbarUserChangeKnot').css('display', 'flex');
			    $('.mediaView').css('display', 'none');
			    $('.cover').css('display', 'none');
			},

			toMedia: function(){
				$('.publicGroupView').css('display', 'none');
			    $('.publicUserGroupView').css('display', 'none');
			    $('.mediaView').css('display', 'block');
			    $('.logoLine').css('left', '20%');
			    $('.nbarUser').css('left', '20%');
			    $('.nbarUser').css('display', 'none');
			    $('.cover').css('display', 'none');
			},

			toThreads: function(){
				$('.nbarUser').css('display', 'flex');
				$('.nbarUserMain').css('display', 'none');
				$('.TopNbarUser').css('display', 'none');
				$('.nbarUserThreads').css('display', 'flex');
			},

			returnToNbar: function(){
				$('.nbarUserMain').css('display', 'flex');
				$('.nbarUserThreads').css('display', 'none');
			},

			returnToHomeNbar: function(){
				$('.nbarUserChangeKnot').css('display', 'flex');
				$('.nbarUserJoinKnot').css('display', 'none');
				$('.nbarUserCreateKnot').css('display', 'none');
				$('.nbarUserLeaveKnot').css('display', 'none');
			},

			closeUserNbar: function(){
				$('.nbarUser').css('display', 'none');
			    $('.nbarUserThreads').css('display', 'none');
			    $('.nbarUserMain').css('display', 'flex');
			    $('.TopNbarUser').css('display', 'flex');
			    $('.cover').css('display', 'none');
			},

			closeUserHomeNbar: function(){
				$('.nbarUser').css('display', 'none');
				$('.nbarUserCreateKnot').css('display', 'none');
				$('.nbarUserJoinKnot').css('display', 'none');
				$('.nbarUserChangeKnot').css('display', 'flex');
				$('.cover').css('display', 'none');
				$('.nbarUserLeaveKnot').css('display', 'none');
			},

			showCreateKnot: function(){
				$('.nbarUserChangeKnot').css('display', 'none');
				$('.nbarUserCreateKnot').css('display', 'flex');
			},

			showJoinKnot: function(){
				$('.nbarUserChangeKnot').css('display', 'none');
				$('.nbarUserJoinKnot').css('display', 'flex');
			},

			showLeaveKnot: function(){
				$('.nbarUserChangeKnot').css('display', 'none');
				$('.nbarUserLeaveKnot').css('display', 'flex');
			},
		}
	});


	new Vue({
		el: '#home-body'

	});
	


</script>
