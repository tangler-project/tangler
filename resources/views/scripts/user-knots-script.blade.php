<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');
	Vue.component('home',{
		template: '#home-template',

		data: function(){

			return {

				postId:0,

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
					is_private:"",
					password:"",
					confirmPassword:""
				},

				event:{
					img_url:"",
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
					id:"",
					vote: 0,
					input:"",
					img_url:"",
					upVotes:0,
					downVotes:0
					
				},
				
				posts:[],

				group: {},
				groupObject:{},
				//arrays for individual group data
				groupPosts:[],
				groupEvents:[],
				pageTransitionSpeed: 800,
				pageTransitionSpeedFast: 500,
				navbarTransitionSpeed: 900,
				menuState: false,

			};
		},

		created: function(){
			this.fetchGroups();
			this.fetchPrivateGroups();
			this.fetchEvents();

			//events Pusher
			this.pushPosts();
		},

		methods:{
			
			setVotesDown: function(e, postId){
				e.preventDefault();

				this.post.id =  postId;
				this.post.vote = -1;

				this.$http.post('/api/setVotes/', this.post).then((response)=>{
					//fetch posts
					this.fetchPosts();
				});
			},
			//setting the votes up
			setVotesUp: function(e, postId){
				e.preventDefault();

				this.buttonClicked = true;

				this.post.id =  postId;
				this.post.vote = 1;

				this.$http.post('/api/setVotes/', this.post).then((response)=>{
					//fetch posts
					this.fetchPosts();
						
				});
			},

			//function to leave knot (group)
			removeMeFromGroup: function(group){
				console.log(group);

				this.$http.get('/api/leaveKnot/'+group.id).then((response)=>{
						this.fetchPrivateGroups();	
				});

			},

			editUser: function(e){
				e.preventDefault();
				
				this.editUserInfo.name = this.user.name;
				this.editUserInfo.email = this.user.email;

				this.editUserInfo.img_url = $('#uploadedImageUser').val();

				this.$http.post('/api/userUpdate', this.editUserInfo).then((response)=>{
					//success
					console.log(response.body);
					//change the view
					
					
				}, (response) => {
					//error
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

				this.$http.get('/api/deleteEvent/'+this.currentEvent.id).then((response)=>{
					this.event.title="";
					this.event.content="";
					this.event.start_date="";
					this.event.end_date="";
					this.event.img_url="";
					
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
				this.event.img_url = $('#uploadedImageEvent').val();

				console.log(this.event.img_url);

				this.$http.post('/add/event', this.event).then((response)=>{
					//component
					this.fetchEvents();
					//clear the info
					this.event.title="";
					this.event.content="";
					this.event.start_date="";
					this.event.end_date="";
					this.event.img_url="";
			  		this.backToEvents();

				//getting the errors back from validate 
				//need array to run through errors to display them
				}, (response) => {
			    	showErrors = ''
			    	$('.createEventErrors').append(
			    		response.body.title[0] + '<br>' +
			    		response.body.content[0] + '<br>' +
			    		response.body.start_date[0] + '<br>' +
			    		response.body.end_date[0]
			    		);
			  	});
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
				this.post.img_url = $('#uploadedImage').val();

				this.$http.post('/add/post', this.post).then((response)=>{
					//calling the event for pusher to load posts on other pages
					this.$http.get('/postEvent').then((response)=>{
						console.log(response);
					});
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
						this.group.is_private = "1";
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
			   	$('.topNbarHome').css('display', 'none');
			    $('.changeGroupView').css('display', 'none');
			    $('.nbarUserChangeKnot').css('display', 'none');
			    $('.topNbarUser').css('display', 'flex');
				$('.publicUserGroupView').css('display', 'flex');
			    $('.nbarUser').css('display', 'none');
				$('.publicUserGroupLeft').stop().animate({
				  	scrollTop: $('.publicUserGroupLeft')[0].scrollHeight
				}, 10);
			},

			hideAllNbar: function(){
				$('.nbarUserThreads').css('display', 'none');
				$('.nbarUserCreateKnot').css('display', 'none');
				$('.nbarUserJoinKnot').css('display', 'none');
				$('.nbarUserLeaveKnot').css('display', 'none');
				$('.nbarUserProfileEdit').css('display', 'none');
				$('.createNewEvent').css('display', 'none');
				$('.editEvent').css('display', 'none');
			},

			openMenu: function(menu){
				this.menuState = true;
				this.hideAllNbar();
				$('.nbarUser').css('display', 'flex');
				$(menu).css('display', 'flex');
				$('.cover').css('display', 'block');
				$('.topNbarHover').animate({
					top: '-100px'
				}, this.navbarTransitionSpeed);
				$('.topNbarHover').animate({
					top: '-100px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupRight').animate({
					right: '-150px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupLeft').animate({
					left: '-150px'
				}, this.navbarTransitionSpeed);
				$('.changeGroupRight').animate({
					right: '-150px'
				}, this.navbarTransitionSpeed);
				$('.changeGroupLeft').animate({
					left: '-150px'
				}, this.navbarTransitionSpeed);
				$('.createNewPost').animate({
					left: '-150px'
				}, this.navbarTransitionSpeed);
				setTimeout(function(){
					$('.nbarUser').css('z-index', '3');
				}, this.navbarTransitionSpeed);
			},

			showCreateEvent: function(){
				this.openMenu('.createNewEvent');
			},	

			showEditEvent: function(){
				this.openMenu('.editEvent');
			},

			backToEvents: function(){
				$('.createNewEvent').css('display', 'none');
				$('.editEvent').css('display', 'none');
    			$('.listOfEvents').css('display', 'block');
			},

			toUserHome: function(){
				$('.publicUserGroupView').css('display', 'flex');
			    $('.mediaView').css('display', 'none');
			    $('.nbarUser').css('display', 'none');
			    $('.cover').css('display', 'none');
			},

			toChooseKnot: function(){
				$('.topNbarHome').css('display', 'flex');
				$('.publicUserGroupView').css('display', 'none');
			    $('.topNbarUser').css('display', 'none');
			    $('.changeGroupView').css('display', 'flex');
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
				this.openMenu('.nbarUserThreads');
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
				this.menuState = false;
			    $('.nbarUser').css('z-index', '-1');
				$('.topNbarHover').animate({
					top: '-42px'
				}, this.navbarTransitionSpeed);
				$('.createNewPost').animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.changeGroupRight').animate({
					right: '0px'
				}, this.navbarTransitionSpeed);
				$('.changeGroupLeft').animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupRight').animate({
					right: '0px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupLeft').animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.topNbarTab').stop().animate({
					top: '0px',
					opacity: '1'
				}, 300);
				setTimeout(function(){
					$('.nbarUser').css('display', 'none');
					$('.cover').css('display', 'none');	
					$('.linkOutline').css('left', '1px')
				}, this.navbarTransitionSpeed - 50);
			},

			showTopNbar: function(){
				$('.topNbarHover').stop().animate({
					top: '0px'
				}, 300);
				$('.topNbarTab').stop().animate({
					top: '-42px',
					opacity: '0'
				}, 300);
				setTimeout(function(){
					$('.topNbarUser').css('pointer-events', 'auto');
					$('.topNbarHome').css('pointer-events', 'auto');
					$('.searchBar').css('pointer-events', 'auto');
				}, 300);
			},

			hideTopNbar: function(){
				if(this.menuState == false){
					$('.topNbarHover').stop().animate({
						top: '-42px'
					}, 300);
					$('.topNbarTab').stop().animate({
						top: '0px',
						opacity: '1'
					}, 300);
				}
				setTimeout(function(){
					$('.topNbarUser').css('pointer-events', 'none');
					$('.topNbarHome').css('pointer-events', 'none');
					$('.searchBar').css('pointer-events', 'none');
				}, 300);
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

			showManageKnots: function(){
				this.openMenu('.nbarUserJoinKnot');
			},

			showCreateKnot: function(){
				this.hideAllNbar();
				$('.nbarUserCreateKnot').css('opacity', '0');
				$('.nbarUserCreateKnot').css('display', 'flex');
				$('.nbarUserCreateKnot').animate({
					opacity: '1'
				}, 400);
			},

			showJoinKnot: function(){
				this.hideAllNbar();
				$('.nbarUserJoinKnot').css('opacity', '0');
				$('.nbarUserJoinKnot').css('display', 'flex');
				$('.nbarUserJoinKnot').animate({
					opacity: '1'
				}, 400);
			},

			showLeaveKnot: function(){
				this.hideAllNbar();
				$('.nbarUserLeaveKnot').css('opacity', '0');
				$('.nbarUserLeaveKnot').css('display', 'flex');
				$('.nbarUserLeaveKnot').animate({
					opacity: '1'
				}, 400);
			},

			showEditProfile: function(){
				this.openMenu('.nbarUserProfileEdit');
			},

			knotIsPrivate: function(){
				$('.isPrivateBtn').css('background-color', '#999');
				$('.isPublicBtn').css('background-color', '#555');
				$('#isPrivateInput').val('1');
			},

			knotIsPublic: function(){
				$('.isPrivateBtn').css('background-color', '#555');
				$('.isPublicBtn').css('background-color', '#999');
				$('#isPrivateInput').val('0');
			},

			//Pusher start
			pushPosts: function (){		
				// Enable pusher logging - don't include this in production
			    // Pusher.logToConsole = true;
			    var vm = this;
			    var pusher = new Pusher('d7a30c850a3fae6a16a5', {
			      encrypted: true
			    });
			    var channel = pusher.subscribe('postChannel');
			    channel.bind('postEvent', function(data) {
			      vm.fetchPosts();
			      vm.scrollToBottom();
			      
			    });
			}
			//pusher end
		}
	});


	new Vue({
		el: '#home-body'

	});
	
	//using filestack function grabs that img url of the pic just uploaded and saves it
	//it in a hidden input
	function showImage(){
		document.getElementById('uploadedImage').value = event.fpfile.url;
	}

	function showImageUser(){
		document.getElementById('uploadedImageUser').value = event.fpfile.url;
	}
	//end filestack

	

</script>
