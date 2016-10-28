<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');
	Vue.component('home',{
		template: '#home-template',

		data: function(){

			return {
				groups: [],
				privateGroups:[],

				user: {!!json_encode(Auth::user())!!} ,
				
				editUserInfo:{
					password:"",
					newPassword:"",
					confirmNewPassword:""
				},
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

				currentEvent:{},


				knot:{
					name:"",
					password:""
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
			editUser: function(e){
				e.preventDefault();
				
				this.editUserInfo.name = this.user.name;
				this.editUserInfo.email = this.user.email;

				this.$http.post('/api/userUpdate', this.editUserInfo).then((response)=>{
					console.log(response.body);
					
				}, (response) => {
			    	console.log(response.body);
			  	});
				
			},
			//soft deletes user
			deleteUser: function(e){
				// e.preventDefault();
				this.$http.get('/api/deleteUser/'+this.user.id).then((response)=>{
					//loging out
					this.$http.get('auth/logout').then((response)=>{
							
						});
			  	});
			},

			editEvent:function(e){
				e.preventDefault();
				
				console.log(this.event);
				this.$http.post('/api/editEvent/'+this.currentEvent.id, this.event).then((response)=>{
					//reload the events
					this.fetchEvents();
					this.backToEvents();
				});
			},
			deleteEvent:function(e){
				e.preventDefault();
				console.log("delete");

				this.$http.get('/api/deleteEvent/'+this.currentEvent.id).then((response)=>{
					console.log(response);
					this.fetchEvents();
					this.backToEvents();
				});
			},
			goToEvent: function(event){
				//call edit view
				this.showEditEvent();
				//get the values for the post on the edit view
				this.event.title = event.title;
				this.event.content = event.content;
				this.event.start_date = event.start_date;
				this.event.end_date = event.end_date;
				//save the current event to user for editing or deleting
				this.currentEvent = event;
				
				
			},
			//function to make a request and tie an user to a knot
			joinKnot: function(e){
				e.preventDefault();

				this.$http.post('/api/addKnot/', this.knot).then((response)=>{
					//refresh the users private groups
					this.fetchPrivateGroups();
					//clear the info
					this.knot.name="";
					this.knot.password="";
					//this will console log the custom errors
					//also will log success when knot added successfully
					console.log(response.data);

				//getting the errors back from validate 
				//need array to run through errors to display them
				}, (response) => {
			    	console.log(response.body);
			  	});
			},

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
					//clear the info
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
						
						this.fetchGroups();
						this.fetchPrivateGroups();

						//show success message close this view
						//scroll to see the new group

						//clear
						this.group.title = "";
						this.group.password = "";
						this.group.confirmPassword = "";
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
					//just getting the public groups
					this.$set('groups', response.body);

				});	
			},

			fetchPrivateGroups: function(){
				this.$http.get('api/private-groups/').then((response) => {
					
					this.$set('privateGroups', response.body);

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

			showEditEvent: function(){
				$('.listOfEvents').css('display', 'none');
   			$('.editEvent').css('display', 'block');
			},

			backToEvents: function(){
				$('.createNewEvent').css('display', 'none');
				$('.editEvent').css('display', 'none');
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
			    $('.nbarUserProfileEdit').css('display', 'none');
			    $('.nbarUserMain').css('display', 'flex');
			    $('.TopNbarUser').css('display', 'flex');
			    $('.cover').css('display', 'none');
			},

			closeUserHomeNbar: function(){
				$('.nbarUser').css('display', 'none');
				$('.nbarUserCreateKnot').css('display', 'none');
				$('.nbarUserProfileEdit').css('display', 'none');
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

			showEditProfile: function(){
				$('.nbarUserChangeKnot').css('display', 'none');
				$('.nbarUserMain').css('display', 'none');
				$('.nbarUserProfileEdit').css('display', 'flex');
			},
		}
	});


	new Vue({
		el: '#home-body'

	});
	


</script>
