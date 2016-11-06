<script>
	

	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');
	Vue.component('home',{
		template: '#home-template',

		data: function(){

			return {
				

				//time in ms to close navbar after action
				timeNavClose:550,

				timeToFadeMessage:350,

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
				mouseLeft: false,

			};
		},
		//runs on reload
		created: function(){
			this.fetchGroups();
			this.fetchPrivateGroups();
			this.fetchEvents();

			//events Pusher
			this.pushPosts();
			this.pushEvents();
		},
		//computed properties
		computed:{
			//function gets the posts for the group and filters them
			//and returns the posts that have images
			groupPostsWithImages: function(){
				return this.groupPosts.filter(function (post) {
					if(post.img_url != "")
			      		return post;
			    })
			}
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
				this.$http.get('/api/leaveKnot/'+group.id).then((response)=>{
						this.fetchPrivateGroups();	
				});
			},

			editUser: function(e){
				e.preventDefault();
				var vm = this;

				this.editUserInfo.name = this.user.name;
				this.editUserInfo.email = this.user.email;

				this.editUserInfo.img_url = $('#uploadedImageUser').val();

				this.$http.post('/api/userUpdate', this.editUserInfo).then((response)=>{
					//this will console log the custom errors
					if(typeof(response.data) == "string"){
						//add css for error message
						$('.createEditUserErrors').html("");
						$('.createEditUserErrors').append(
					    		response.data + '<br>'
				    	);
					}
					else{
						//also will log success when knot added successfully
						//add CSS class here for success message
						$('.createEditUserSuccess').html("");
						$('.createEditUserSuccess').append(
					    		'Your accout was successfully edited.'
				    	);
				    	//close navbar
				    	setTimeout(function(){ 
				    		vm.closeUserNbar();
				    		$('.createEditUserErrors').fadeOut(this.timeToFadeMessage);
				    		$('.createEditUserSuccess').fadeOut(this.timeToFadeMessage);
				    	}, vm.timeNavClose);

				    	this.editUserInfo.password="";
				    	this.editUserInfo.newPassword="";
				    	this.editUserInfo.confirmNewPassword="";
				    	$('form.userEditForm').find("div").find("div").html("Or drop files here");
					}
					
					
				}, (response) => {
					//error
					//make the object an array
		    		var array = $.map(response.data, function(value, index) {
					    return [value];
					});
				
			    	$('.createEditUserErrors').html("");
		    		for(var i=0; i < array.length; i++){
					    $('.createEditUserErrors').append(
				    		array[i] + '<br>'
			    		);
		    		}
			    	
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
				var vm = this;
				this.event.img_url = $('#uploadedImageEventEdit').val();

				this.$http.post('/api/editEvent/'+this.currentEvent.id, this.event).then((response)=>{
					//this will console log the custom errors
					if(typeof(response.data) == "string"){
						//add css for error message
						$('.createEditEventErrors').html("");
						$('.createEditEventErrors').append(
					    		response.data + '<br>'
				    	);
					}
					else{
						//reload the events
						this.fetchEvents();
						//clear filestack grey box
						$('form.eventForm').find("div").find("div").html("Or drop files here");
						this.event.img_url = "";

						$('.editEventSuccess').append(
					 	   		'Knot successfully edited!'
			  		  	).fadeOut(2000);
						//close navbar
				    	setTimeout(function(){ vm.closeUserNbar(); }, vm.timeNavClose);
					}

				}, (response) => {
					//make the object an array
		    		var array = $.map(response.data, function(value, index) {
					    return [value];
					});
				
			    	$('.createEditEventErrors').html("");
		    		for(var i=0; i < array.length; i++){
					    $('.createEditEventErrors').append(
				    		array[i] + '<br>'
			    		);
		    		}
			  	});
			},
			deleteEvent:function(e){
				e.preventDefault();
				var vm = this;
				
				this.$http.get('/api/deleteEvent/'+this.currentEvent.id).then((response)=>{
					this.event.title="";
					this.event.content="";
					this.event.start_date="";
					this.event.end_date="";
					this.event.img_url="";
					
					this.fetchEvents();
					// this.backToEvents();
					//close navbar
			    	setTimeout(function(){ vm.closeUserNbar(); }, vm.timeNavClose);
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
				var vm = this;

				this.$http.post('/api/addKnot/', this.knot).then((response)=>{
					//refresh the users private groups
					this.fetchPrivateGroups();
					//clear the info
					this.knot.name="";
					this.knot.password="";
					//this will console log the custom errors
					if(typeof(response.data) == "string"){
						//add css for error message
						$('.createJoinKnotErrors').html("");
						$('.createJoinKnotErrors').append(
					    		response.data + '<br>'
				    	);
					}
					else{
						
						$('.joinKnotSuccess').append(
					 	   		'Knot added to your list'
			  		  	).fadeOut(2000);

						//scrolling bottom once a group is private
						if(this.group.is_private== 1)
							vm.scrollToBottom('.changeGroupRight', false);
						
				    	//close navbar
				    	setTimeout(function(){ 
				    		vm.closeUserNbar(); 
				    		$('.createJoinKnotErrors').fadeOut(this.timeToFadeMessage);
					    	
				    	}, vm.timeNavClose);
				    	
					}
					//maybe go to that knot?

				//getting the errors back from validate 
				}, (response) => {
					//make the object an array
		    		var array = $.map(response.data, function(value, index) {
					    return [value];
					});
				
			    	$('.createJoinKnotErrors').html("");
		    		for(var i=0; i < array.length; i++){
					    $('.createJoinKnotErrors').append(
				    		array[i] + '<br>'
			    		);
		    		}
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
				
				var vm = this;
				//clear old values if there are any


				this.event.group_id = this.groupId;
				this.event.img_url = $('#uploadedImageEvent').val();

				this.$http.post('/add/event', this.event).then((response)=>{
					//event call
					this.$http.get('/eventEvent').then((response)=>{});

					//component
					this.fetchEvents();
					//clear the info
					this.event.title="";
					this.event.content="";
					this.event.start_date="";
					this.event.end_date="";
					this.event.img_url="";

					$('form.eventForm').find("div").find("div").html("Or drop files here");
					// this.backToEvents();

					$('.createEventSuccess').append(
					 	   		'Event successfully created!'
		  		  	).fadeOut(2000);

			  		//close navbar
			    	setTimeout(function(){ vm.closeUserNbar(); }, vm.timeNavClose);

				//getting the errors back from validate 
				//need array to run through errors to display them
				}, (response) => {
					//make the object an array
		    		var array = $.map(response.data, function(value, index) {
					    return [value];
					});
				
			    	$('.createEventErrors').html("");
		    		for(var i=0; i < array.length; i++){
					    $('.createEventErrors').append(
				    		array[i] + '<br>'
			    		);
		    		}
			    			
			  	});
			},
			//NAVBAR USER SCRIPT
			scrollToBottom: function(srcollThis, shouldClear){
				$(srcollThis).stop().animate({
				  	scrollTop: $(srcollThis)[0].scrollHeight
				}, 500);
				if(shouldClear){
					$('#postInput').val('');
				}
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
					this.$http.get('/postEvent').then((response)=>{});
					this.fetchPosts();

					this.scrollToBottom('.publicUserGroupLeft', true);
					//clear values
					this.post.img_url ="";
					this.post.input="";
					$('form.postForm').find("div").find("div").html("Or drop files here");

				}, (response) => {
		    		// console.log(response.body);
				});
			},
			saveGroup: function(e){
				e.preventDefault();
				var vm = this;

				this.group.img_url = $('#uploadedImageGroup').val();
				this.group.is_private = $('#isPrivateGroup').val();

				this.$http.post('/add/group', this.group).then((response)=>{
					


					//if response fails, now im checking for incorrect
					//match of passwords 
					//this will console log the custom errors
					if(typeof(response.data) == 'string'){
						$('.createCreateKnotErrors').html("");
						$('.createCreateKnotErrors').append(
					    		response.data + '<br>'
				    	);
					}
					else{
						$('.createCreateKnotErrors').html("");

						
						$('.createKnotSuccess').append(
					 	   		'Knot successfully created!'
				  		  	).fadeOut(2000);

						this.fetchGroups();
						this.fetchPrivateGroups();
						//if group created is private scroll private

						if(this.group.is_private == '1')
							this.scrollToBottom('.changeGroupRight', true);
						else{
							this.scrollToBottom('.changeGroupLeft', true);
						}

						//clear
						this.group.title = "";
						this.group.description="";
						this.group.password = "";
						this.group.confirmPassword = "";
						this.group.is_private = "1";
						this.group.img_url="";
						//clear filestack
						// $('.fp_btn').html("");
						$('form.knotForm').find("div").find("div").html("Or drop files here");

						//close navbar
				    	setTimeout(function(){ vm.closeUserNbar(); }, vm.timeNavClose);
						//display flash success
					}
						
					
				//getting the errors back from validate 
				//need array to run through errors to display them
				}, (response) => {
					if(!response == null){
				    	//make the object an array
			    		var array = $.map(response.data, function(value, index) {
						    return [value];
						});
					
				    	$('.createCreateKnotErrors').html("");
			    		for(var i=0; i < array.length; i++){
						    $('.createCreateKnotErrors').append(
					    		array[i] + '<br>'
				    		);
			    		}
					}
					else{
						$('.createCreateKnotErrors').html("Group name already taken");
					}
			  	});
			},
			//END
			fetchGroups: function(){
				//show search bar
				$('.searchBar').show();

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

			goToPost: function(group, nbar){
				//hide search bar
				$('.searchBar').hide();

			    var component = this;
			   	this.$http.get('api/groups/'+group.id).then((response) => {
			   		this.groupId = group.id;
			   		
					this.$set('groupObject', response.body);

					this.fetchPosts();
					// this.$set('groupPosts', response.body.post);
					this.fetchEvents();
		
			   	});
				this.toGroupTransition();
			   	$('.topNbarHome').css('display', 'none');
			    $(nbar).css('display', 'flex');
				
					
			},

			hideAllNbar: function(){
				$('.nbarUserThreads').css('display', 'none');
				$('.nbarUserCreateKnot').css('display', 'none');
				$('.nbarUserJoinKnot').css('display', 'none');
				$('.nbarUserLeaveKnot').css('display', 'none');
				$('.nbarUserProfileEdit').css('display', 'none');
				$('.createNewEvent').css('display', 'none');
				$('.editEvent').css('display', 'none');
				$('.manageKnots').css('display', 'none');
				$('.mediaView').css('display', 'none');
			},

			openMenu: function(menu){



				this.menuState = true;
				this.hideAllNbar();
				$('.nbarUser').css('display', 'flex');
				$(menu).css('display', 'flex');
				$('.cover').css('display', 'block');
				$('.cover').css('pointer-events', 'none');
				$('.publicUserKnot').css('pointer-events', 'none');
				$('.privateKnot').css('pointer-events', 'none');
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
				$('.leftSideTab, .rightSideTab').stop().animate({
					opacity: '0'
				}, 300);
				setTimeout(function(){
					$('.nbarUser').css('z-index', '3');
					$('.cover').css('pointer-events', 'auto');
				}, this.navbarTransitionSpeed);
			},

			showCreateEvent: function(){
				//clear event if is not clear
				this.event.title="";
				this.event.content="";
				this.event.start_date="";
				this.event.end_date="";
				this.event.img_url="";
				//clear errors
				$('.createEventErrors').html("");

				this.openMenu('.createNewEvent');
			},	

			showEditEvent: function(){
				//clear errors
				$('.createEditEventErrors').html("");
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
				// $('.publicUserGroupView').css('display', 'none');
			    $('.topNbarUser').css('display', 'none');
			    $('.topNbarUserPublic').css('display', 'none');
			    // $('.changeGroupView').css('display', 'flex');

			    $('.changeGroupLeft').css('opacity', '0');
				$('.changeGroupRight').css('opacity', '0');
				$('.changeGroupLeft').css('top', '200px');
				$('.changeGroupRight').css('top', '-200px');
				$('.changeGroupView').css('display', 'flex');
				$('.changeGroupRight').stop().animate({
					top: '0px',
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.changeGroupLeft').stop().animate({
					top: '0px',
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.publicUserGroupView').stop().animate({
					opacity: '0'
				}, this.pageTransitionSpeed);
				$('.changeGroupView').stop().animate({
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.publicUserGroupLeft').stop().animate({
					top: '-200px'
				}, this.pageTransitionSpeed);
				$('.publicUserGroupRight').stop().animate({
					top: '200px'
				}, this.pageTransitionSpeed);
				$('.createNewPost').stop().animate({
					bottom: '200px',
					opacity: '1'
				}, this.pageTransitionSpeed);
				setTimeout(function(){
					$('.publicUserGroupView').css('display', 'none');
				}, this.pageTransitionSpeed);


				//show navbar
				$('.searchBar').fadeIn();
			},

			toMedia: function(){

				this.createMediaTable();

				this.menuState = true;
				this.hideAllNbar();
				$('.nbarUser').css('display', 'flex');
				$('.nbarUser').css('width', '700px');
				$('.nbarUser').css('margin-left', '-350px');
				$('.mediaView').css('display', 'flex');
				$('.cover').css('display', 'block');
				$('.cover').css('pointer-events', 'none');
				$('.topNbarHover').stop().animate({
					top: '-100px'
				}, this.navbarTransitionSpeed);
				$('.topNbarHover').stop().animate({
					top: '-100px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupRight').stop().animate({
					right: '-350px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupLeft').stop().animate({
					left: '-350px'
				}, this.navbarTransitionSpeed);
				$('.createNewPost').stop().animate({
					left: '-350px'
				}, this.navbarTransitionSpeed);
				setTimeout(function(){
					$('.nbarUser').css('z-index', '3');
					$('.cover').css('pointer-events', 'auto');
				}, this.navbarTransitionSpeed);
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
				$('.cover').css('display', 'none');
			    $('.nbarUser').css('z-index', '-1');
				$('.topNbarHover').stop().animate({
					top: '-42px'
				}, this.navbarTransitionSpeed);
				$('.createNewPost').stop().animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.changeGroupRight').stop().animate({
					right: '0px'
				}, this.navbarTransitionSpeed);
				$('.changeGroupLeft').stop().animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupRight').stop().animate({
					right: '0px'
				}, this.navbarTransitionSpeed);
				$('.publicUserGroupLeft').stop().animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.topNbarTab').stop().animate({
					top: '0px',
					opacity: '1'
				}, 300);
				setTimeout(function(){
					$('.nbarUser').css('display', 'none');
					$('.cover').css('display', 'none');	
					$('.linkOutlineUser').css('left', '0px');
					$('.nbarUser').css('width', '300px');
					$('.nbarUser').css('margin-left', '-150px');
					$('.publicUserKnot').css('pointer-events', 'auto');
					$('.privateKnot').css('pointer-events', 'auto');
				}, this.navbarTransitionSpeed - 50);
			},

			showTopNbar: function(){
				if(this.menuState == false){
					$('.topNbarHover').stop().animate({
						top: '0px'
					}, 300);
					$('.topNbarTab').stop().animate({
						top: '-42px',
						opacity: '0'
					}, 300);
					$('.rightSideTab').stop().animate({
							opacity: '0'
						}, 300);
					$('.leftSideTab').stop().animate({
							opacity: '0'
						}, 300);
					setTimeout(function(){
						$('.topNbarUser').css('pointer-events', 'auto');
						$('.topNbarUserPublic').css('pointer-events', 'auto');
						$('.topNbarHome').css('pointer-events', 'auto');
						$('.searchBar').css('pointer-events', 'auto');
					}, 300);
				}
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
					$('.topNbarUserPublic').css('pointer-events', 'none');
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
				$('.manageKnots').css('display', 'flex');
			},

			showCreateKnot: function(){
				this.hideAllNbar();
				$('.manageKnots').css('display', 'flex');
				$('.nbarUserCreateKnot').css('opacity', '0');
				$('.nbarUserCreateKnot').css('display', 'flex');
				$('.nbarUserCreateKnot').animate({
					opacity: '1'
				}, 400);
				$('.linkOutlineUser').animate({
					left: '76px'
				}, 400);
			},

			showJoinKnot: function(){
				this.hideAllNbar();
				$('.manageKnots').css('display', 'flex');
				$('.nbarUserJoinKnot').css('opacity', '0');
				$('.nbarUserJoinKnot').css('display', 'flex');
				$('.nbarUserJoinKnot').animate({
					opacity: '1'
				}, 400);
				$('.linkOutlineUser').animate({
					left: '0px'
				}, 400);
			},

			showLeaveKnot: function(){
				this.hideAllNbar();
				$('.manageKnots').css('display', 'flex');
				$('.nbarUserLeaveKnot').css('opacity', '0');
				$('.nbarUserLeaveKnot').css('display', 'flex');
				$('.nbarUserLeaveKnot').animate({
					opacity: '1'
				}, 400);
				$('.linkOutlineUser').animate({
					left: '158px'
				}, 400);
			},

			showEditProfile: function(){
				this.openMenu('.nbarUserProfileEdit');
			},

			knotIsPrivate: function(){
				$('#hideOrShowPasswordFields').show();

				$('.isPrivateBtn').css('background-color', '#999');
				$('.isPublicBtn').css('background-color', '#555');
				$('#isPrivateGroup').val('1');
			},

			knotIsPublic: function(){
				$('#hideOrShowPasswordFields').hide();

				$('.isPrivateBtn').css('background-color', '#555');
				$('.isPublicBtn').css('background-color', '#999');
				$('#isPrivateGroup').val('0');
			},

			toGroupTransition: function(){
				$('.publicUserGroupRight').css('opacity', '0');
				$('.publicUserGroupLeft').css('opacity', '0');
				$('.publicUserGroupRight').css('top', '200px');
				$('.publicUserGroupLeft').css('top', '-200px');
				$('.createNewPost').css('bottom', '-100px');
				$('.publicUserGroupView').css('display', 'flex');
				$('.publicUserGroupLeft').stop().animate({
					top: '0px',
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.publicUserGroupRight').stop().animate({
					top: '0px',
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.changeGroupView').stop().animate({
					opacity: '0'
				}, this.pageTransitionSpeed);
				$('.publicUserGroupView').stop().animate({
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.changeGroupRight').stop().animate({
					top: '-200px'
				}, this.pageTransitionSpeed);
				$('.changeGroupLeft').stop().animate({
					top: '200px'
				}, this.pageTransitionSpeed);
				setTimeout(function(){
					$('.createNewPost').stop().animate({
						bottom: '0px'
					}, this.pageTransitionSpeed);
					$('.changeGroupView').css('display', 'none');
				}, this.pageTransitionSpeed);
			},

			instantToBottom: function(){
			    var element = document.getElementById("userPosts");
			    element.scrollTop = element.scrollHeight;
			},

			mouseInRight: function(){
				
				this.mouseLeft = false;
				if(this.menuState == false){
					$('.leftSideTab').stop().animate({
							opacity: '0'
						}, 400);
					$('.rightSideTab').stop().animate({
							opacity: '1'
						}, 400);
					$('.groupNameRight').stop().animate({
							opacity: '1',
							right: '0px'
						}, 500);
					$('.groupName').stop().animate({
							opacity: '0',
							left: '-30px'
						}, 500);
				}
				
			},

			mouseInLeft: function(){

				this.mouseLeft = true;
				if(this.menuState == false){
					$('.leftSideTab').stop().animate({
							opacity: '1'
						}, 400);
					$('.rightSideTab').stop().animate({
							opacity: '0'
						}, 400);
					$('.groupName').stop().animate({
							opacity: '1',
							left: '0'
						}, 500);
					$('.groupNameRight').stop().animate({
							opacity: '0',
							right: '-30px'
						}, 500);
				}


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
			      vm.scrollToBottom('.publicUserGroupLeft', false);
			      
			    });
			},
			//Pusher start
			pushEvents: function (){		
				// Enable pusher logging - don't include this in production
			    // Pusher.logToConsole = true;
			    var vm = this;
			    var pusher = new Pusher('d7a30c850a3fae6a16a5', {
			      encrypted: true
			    });
			    var channel = pusher.subscribe('eventChannel');
			    channel.bind('eventEvent', function(data) {
			      vm.fetchEvents();
			    });
			},
			//pusher end

			createMediaTable:function(){
				var content ="";
				content ="";
			 	content += '<table>';
			 	content += "<tr>";

			 	for(var i=0; i < this.groupPostsWithImages.length; i++){
			 		if(i % 3 == 0 && i != 0){
			 			content += "</tr>";
			 			content += "<tr>";
			 		}
			 		content += "<td><img class='mediaTD' src='"+this.groupPostsWithImages[i].img_url+"'</td>";
			 	}
			 
			 	content += '</table>';
			 	
				$('#mediaTable').html(content);
			}

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

	function showImageGroup(){
		document.getElementById('uploadedImageGroup').value = event.fpfile.url;
	}

	function showImageEvent(){
		document.getElementById('uploadedImageEvent').value = event.fpfile.url;
	}

	function showImageEventEdit(){
		document.getElementById('uploadedImageEventEdit').value = event.fpfile.url;
	}
	//end filestack

	//search bar
	var $searchBar = $('#searchBar');
	$searchBar.keyup(function() {
		
		$rows = $('.content div');

	    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
	        reg = RegExp(val, 'i'),
	        text;
	    
	    $rows.show().filter(function() {
	        text = $(this).text().replace(/\s+/g, ' ');
	        return !reg.test(text);
	    }).hide();
	});
	//end


</script>
