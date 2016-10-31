<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');

	Vue.component('welcome',{
		template: '#welcome-template',

		data: function(){
			return {
				groups: [],
				group: {},
				groupObject:{},
				//arrays for individual group data
				groupPosts:[],
				groupEvents:[],
				pageState: 1,
				pageTransitionSpeed: 800,
				pageTransitionSpeedFast: 500,
			};
		},

		created: function(){
			this.fetchGroups();
			
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

			goToPost: function(group){
			    
			    var component = this;
			   	this.$http.get('api/groups/'+group.id).then((response) => {	
			   		
					this.$set('groupObject', response.body);
					this.$set('groupPosts', response.body.post);
					this.$set('groupEvents', response.body.event);

			   	});
				$('.logoLine').css('left', '60%');
			    $('.nbarGuest').css('left', '60%');
			    $('.landingView').css('display', 'none');
				$('.discoverView').css('display', 'none');
			    $('.publicGroupView').css('display', 'flex');
				$('.nbarGuest').css('display', 'none');
			    $('.nbarUser').css('display', 'none');
			    $('.topNbarGuest').css('display', 'flex');
			    $('.publicGroupLeft').stop().animate({
			          scrollTop: $('.publicGroupLeft')[0].scrollHeight
			    }, 10);	

			},

			closeNbarGuest: function(){
				$('.nbarGuest').animate({
					width: '0px',
					marginLeft: '0px'
				}, 1000);
				$('.landingRight').animate({
					right: '0px'
				}, 1000);
				$('.landingLeft').animate({
					left: '0px'
				}, 1000);
				$('.topNbarGuest').animate({
					top: '0px'
				}, 1000);
				setTimeout(function(){
				$('.nbarGuest').css('display', 'none');
				$('.nbarGuestSignup').css('display', 'flex');
				$('.nbarGuestLogin').css('display', 'none');
				$('.topNbarGuest').css('display', 'flex');
				$('.cover').css('display', 'none');	
				$('.linkOutline').css('left', '1px')
				}, 950);
			},

			showSignUp: function(){
				$('.nbarGuestLogin').css('display', 'none');
				$('.nbarGuest').css('display', 'flex');
				$('.cover').css('display', 'block');
				$('.nbarGuest').animate({
					width: '300px',
					marginLeft: '-150px'
				}, 1000);
				$('.landingRight').animate({
					right: '-150px'
				}, 1000);
				$('.landingLeft').animate({
					left: '-150px'
				}, 1000);
				$('.topNbarGuest').animate({
					top: '-42px'
				}, 1000);
			},

			showLogIn: function(){
				$('.nbarGuestLogin').css('opacity', '0');
				$('.nbarGuestSignup').css('display', 'none');
				$('.nbarGuestLogin').css('display', 'flex');
				$('.nbarGuestLogin').animate({
					opacity: '1'
				}, 300);
				$('.linkOutline').animate({
					left: '67px'
				}, 300);
			},

			returnSignUp: function(){
				$('.nbarGuestSignup').css('opacity', '0');
				$('.nbarGuestLogin').css('display', 'none');
				$('.nbarGuestSignup').css('display', 'flex');
				$('.nbarGuestSignup').animate({
					opacity: '1'
				}, 300);
				$('.linkOutline').animate({
					left: '1px'
				}, 300);
			},

			toHome: function(){
				if(this.pageState > 1){
					this.pageState = 1;	
					$('.landingView').css('display', 'flex');
					$('.landingRight').css('opacity', '0');
					$('.landingLeft').css('opacity', '0');
					$('.landingRight').css('top', '-200');
					$('.landingLeft').css('top', '200');
					$('.landingLeft').animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingRight').animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingView').animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.discoverView').animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.discoverRight').animate({
						top: '200px'
					}, this.pageTransitionSpeed);
					$('.discoverLeft').animate({
						top: '-200px'
					}, this.pageTransitionSpeed);
					setTimeout(function(){
						$('.publicGroupView').css('display', 'none');
						$('.discoverView').css('display', 'none');
						$('.contactView').css('display', 'none');
					}, this.pageTransitionSpeed);
				}
			},

			toDiscover: function(){
				if(this.pageState == 1){
					this.pageState = 2;
					$('.publicGroupView').css('display', 'none');
					$('.discoverRight').css('opacity', '0');
					$('.discoverLeft').css('opacity', '0');
					$('.discoverRight').css('top', '200');
					$('.discoverLeft').css('top', '-200');
					$('.discoverView').css('display', 'block');
					$('.discoverLeft').animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.discoverRight').animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingView').animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.discoverView').animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingRight').animate({
						top: '-200px'
					}, this.pageTransitionSpeed);
					$('.landingLeft').animate({
						top: '200px'
					}, this.pageTransitionSpeed);
					setTimeout(function(){
						$('.landingView').css('display', 'none');	
					}, this.pageTransitionSpeed);
				} else if(this.pageState == 3) {
					this.pageState = 2;
					$('.contactView').css('display', 'none');
				}
				
			},

			changeDiscoverContent: function(show, hideOne, hideTwo){
				$(hideOne).css('display', 'none');
				$(hideTwo).css('display', 'none');
				$(show).css('opacity', '0');
				$(show).css('display', 'block');
				$(show).css('left', '-50px');
				$(show).animate({
					opacity: '1',
					left: '0px'
				}, this.pageTransitionSpeedFast);
				$(hideTwo).animate({
					opacity: '0'
				}, this.pageTransitionSpeedFast);
				$(hideOne).animate({
					opacity: '0'
				}, this.pageTransitionSpeedFast);
			},

			toDiscoverContentOne: function(){
				if(this.pageState == 3 || this.pageState == 4){
					this.pageState = 2;
					this.changeDiscoverContent('#discoverContent1', '#discoverContent2', '#discoverContent3');
				}
			},

			toDiscoverContentTwo: function(){
				if(this.pageState == 2 || this.pageState == 4){
					this.pageState = 3;
					this.changeDiscoverContent('#discoverContent2', '#discoverContent1', '#discoverContent3');
				}
			},

			toDiscoverContentThree: function(){
				if(this.pageState == 2 || this.pageState == 3){
					this.pageState = 4;
					this.changeDiscoverContent('#discoverContent3', '#discoverContent1', '#discoverContent2');
				}
			},

			toContact: function(){
				$('.landingView').css('display', 'none');
				$('.discoverView').css('display', 'none');
				$('.publicGroupView').css('display', 'none');
				$('.contactView').css('display', 'block');
				$('.logoLine').css('left', '50%');
				$('.nbarGuest').css('left', '50%');
				$('.nbarGuest').css('display', 'none');
				$('.topNbarGuest').css('display', 'flex');
				$('.cover').css('display', 'none');
			},

			toContactOne: function(){
				$('#contact3').css('display', 'none');
				$('#contact2').css('display', 'none');
				$('#contact1').css('display', 'block');
			},

			toContactTwo: function(){
				$('#contact3').css('display', 'none');
				$('#contact1').css('display', 'none');
				$('#contact2').css('display', 'block');
			},

			toContactThree: function(){
				$('#contact1').css('display', 'none');
				$('#contact2').css('display', 'none');
				$('#contact3').css('display', 'block');
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
					$('.topNbarGuest').css('pointer-events', 'auto');
				}, 300);
			},

			hideTopNbar: function(){
				$('.topNbarHover').stop().animate({
					top: '-42px'
				}, 300);
				$('.topNbarTab').stop().animate({
					top: '0px',
					opacity: '1'
				}, 300);
				setTimeout(function(){
					$('.topNbarGuest').css('pointer-events', 'none');
				}, 300);
			},
		}
	});


	
	new Vue({
		el: '#welcome-body'
		

	});

	//search bar
	var $searchBar = $('#searchBar');
	$searchBar.keyup(function() {
		
		$rows = $('#content div');

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


