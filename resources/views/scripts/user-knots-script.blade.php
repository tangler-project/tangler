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
			//function to make a request and tie an user to a knot
			joinKnot: function(){

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
