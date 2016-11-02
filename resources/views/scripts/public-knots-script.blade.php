<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');

	Vue.component('welcome',{
		template: '#welcome-template',

		data: function(){
			return {

				errors:[],

				groups: [],
				group: {},
				groupObject:{},
				//arrays for individual group data
				groupPosts:[],
				groupEvents:[],
				signInState: false,
				pageState: 1,
				pageTransitionSpeed: 800,
				pageTransitionSpeedFast: 500,
				navbarTransitionSpeed: 900,
				canScroll: true,
			};
		},

		created: function(){
			this.fetchGroups();
			this.bindScroll();
			
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
			   	this.pageState = 0;
			   	this.toGroupTransition();

			},

			toGroupTransition: function(){
				$('.publicGroupRight').css('opacity', '0');
				$('.publicGroupLeft').css('opacity', '0');
				$('.publicGroupRight').css('top', '200px');
				$('.publicGroupLeft').css('top', '-200px');
				$('.publicGroupView').css('display', 'flex');
				$('.publicGroupLeft').stop().animate({
					top: '0px',
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.publicGroupRight').stop().animate({
					top: '0px',
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.changeGroupView').stop().animate({
					opacity: '0'
				}, this.pageTransitionSpeed);
				$('.publicGroupView').stop().animate({
					opacity: '1'
				}, this.pageTransitionSpeed);
				$('.landingRight').stop().animate({
					top: '-200px'
				}, this.pageTransitionSpeed);
				$('.landingLeft').stop().animate({
					top: '200px'
				}, this.pageTransitionSpeed);
				setTimeout(function(){
					$('.landingView').css('display', 'none');
				}, this.pageTransitionSpeed);
			},

			closeNbarGuest: function(){
				this.signInState = false;
				$('.cover').css('pointer-events', 'none');
				$('.nbarGuest').css('z-index', '-1');
				$('.topNbarHover').stop().animate({
					top: '-42px'
				}, this.navbarTransitionSpeed);
				$('.landingRight').stop().animate({
					right: '0px'
				}, this.navbarTransitionSpeed);
				$('.landingLeft').stop().animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.discoverRight').stop().animate({
					right: '0px'
				}, this.navbarTransitionSpeed);
				$('.discoverLeft').stop().animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.publicGroupRight').stop().animate({
					right: '0px'
				}, this.navbarTransitionSpeed);
				$('.publicGroupLeft').stop().animate({
					left: '0px'
				}, this.navbarTransitionSpeed);
				$('.topNbarTab').stop().animate({
					top: '0px',
					opacity: '1'
				}, 300);
				setTimeout(function(){
					$('.nbarGuest').css('display', 'none');
					$('.nbarGuestSignup').css('display', 'flex');
					$('.nbarGuestLogin').css('display', 'none');	
					$('.linkOutline').css('left', '1px');
					$('.publicKnot').css('pointer-events', 'auto');
				}, this.navbarTransitionSpeed - 50);
			},

			showSignUp: function(){
				this.signInState = true;
				$('.nbarGuestLogin').css('display', 'none');
				$('.nbarGuest').css('display', 'flex');
				$('.cover').css('display', 'block');
				$('.cover').css('pointer-events', 'none');
				$('.publicKnot').css('pointer-events', 'none');
				$('.topNbarHover').stop().animate({
					top: '-100px'
				}, this.navbarTransitionSpeed);
				$('.landingRight').stop().animate({
					right: '-150px'
				}, this.navbarTransitionSpeed);
				$('.landingLeft').stop().animate({
					left: '-150px'
				}, this.navbarTransitionSpeed);
				$('.discoverRight').stop().animate({
					right: '-150px'
				}, this.navbarTransitionSpeed);
				$('.discoverLeft').stop().animate({
					left: '-150px'
				}, this.navbarTransitionSpeed);
				$('.publicGroupRight').stop().animate({
					right: '-150px'
				}, this.navbarTransitionSpeed);
				$('.publicGroupLeft').stop().animate({
					left: '-150px'
				}, this.navbarTransitionSpeed);
				setTimeout(function(){
					$('.nbarGuest').css('z-index', '3');
					$('.cover').css('pointer-events', 'auto');
				}, this.navbarTransitionSpeed);
			},

			showLogIn: function(){
				$('.nbarGuestLogin').css('opacity', '0');
				$('.nbarGuestSignup').css('display', 'none');
				$('.nbarGuestLogin').css('display', 'flex');
				$('.nbarGuestLogin').animate({
					opacity: '1'
				}, 400);
				$('.linkOutline').animate({
					left: '67px'
				}, 400);
			},

			returnSignUp: function(){
				$('.nbarGuestSignup').css('opacity', '0');
				$('.nbarGuestLogin').css('display', 'none');
				$('.nbarGuestSignup').css('display', 'flex');
				$('.nbarGuestSignup').animate({
					opacity: '1'
				}, 400);
				$('.linkOutline').animate({
					left: '1px'
				}, 400);
			},

			toHome: function(){
				if(this.pageState > 1 && this.signInState == false){
					this.pageState = 1;	
					$('.landingView').css('display', 'flex');
					$('.landingRight').css('opacity', '0');
					$('.landingLeft').css('opacity', '0');
					$('.landingRight').css('top', '-200');
					$('.landingLeft').css('top', '200');
					$('.landingLeft').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingRight').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingView').stop().animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.discoverView').stop().animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.discoverRight').stop().animate({
						top: '200px'
					}, this.pageTransitionSpeed);
					$('.discoverLeft').stop().animate({
						top: '-200px'
					}, this.pageTransitionSpeed);
					setTimeout(function(){
						$('.publicGroupView').css('display', 'none');
						$('.discoverView').css('display', 'none');
						$('.contactView').css('display', 'none');
					}, this.pageTransitionSpeed);
				} else if (this.pageState == 0 && this.signInState == false) {
					this.pageState = 1;
					$('.landingLeft').css('opacity', '0');
					$('.landingRight').css('opacity', '0');
					$('.landingLeft').css('top', '200px');
					$('.landingRight').css('top', '-200px');
					$('.landingView').css('display', 'flex');
					$('.landingRight').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingLeft').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.publicGroupView').stop().animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.landingView').stop().animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.publicGroupLeft').stop().animate({
						top: '-200px'
					}, this.pageTransitionSpeed);
					$('.publicGroupRight').stop().animate({
						top: '200px'
					}, this.pageTransitionSpeed);
					setTimeout(function(){
						$('.publicGroupView').css('display', 'none');
					}, this.pageTransitionSpeed);
				}
			},

			toDiscover: function(){
				if(this.pageState == 1 && this.signInState == false){
					this.pageState = 2;
					$('.discoverTabParent').css('height', '33.3%');
					$('.discoverLeftTab').css('height', '100%');
					$('#discoverContent1').css('display', 'flex');
					$('#discoverContent1').css('opacity', '1');
					$('#discoverContent2, #discoverContent3').css('display', 'none');
					$('.publicGroupView').css('display', 'none');
					$('.discoverRight').css('opacity', '0');
					$('.discoverLeft').css('opacity', '0');
					$('.discoverRight').css('top', '200');
					$('.discoverLeft').css('top', '-200');
					$('.discoverView').css('display', 'block');
					$('.discoverLeft').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.discoverRight').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingView').stop().animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.discoverView').stop().animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.landingRight').stop().animate({
						top: '-200px'
					}, this.pageTransitionSpeed);
					$('.landingLeft').stop().animate({
						top: '200px'
					}, this.pageTransitionSpeed);
					setTimeout(function(){
						$('.landingView').css('display', 'none');	
					}, this.pageTransitionSpeed);
				} else if(this.pageState == 0){
					this.pageState = 2;
					$('.discoverLeft').css('opacity', '0');
					$('.discoverRight').css('opacity', '0');
					$('.discoverLeft').css('top', '200px');
					$('.discoverRight').css('top', '-200px');
					$('.discoverView').css('display', 'flex');
					$('.discoverRight').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.discoverLeft').stop().animate({
						top: '0px',
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.publicGroupView').stop().animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.discoverView').stop().animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.publicGroupLeft').stop().animate({
						top: '-200px'
					}, this.pageTransitionSpeed);
					$('.publicGroupRight').stop().animate({
						top: '200px'
					}, this.pageTransitionSpeed);
					setTimeout(function(){
						$('.publicGroupView').css('display', 'none');
					}, this.pageTransitionSpeed);
				}
				
			},

			discoverScrollDown: function(show, hideOne, hideTwo){
				$(show).css('display', 'flex');
				$(show).css('opacity', '0');
				$(show).css('top', '200px');
				$(show).stop().animate({
					opacity: '1',
					top: '0px'
				}, this.pageTransitionSpeed);
				$(hideOne).stop().animate({
					opacity: '0',
					top: '-200px'
				}, this.pageTransitionSpeed);
				$(hideTwo).stop().animate({
					opacity: '0',
					top: '-200px'
				}, this.pageTransitionSpeed);
				setTimeout(function(){
					$(hideOne).css('display', 'none');
					$(hideTwo).css('display', 'none');
				}, this.pageTransitionSpeed);
			},

			discoverScrollUp: function(show, hideOne, hideTwo){
				$(show).css('display', 'flex');
				$(show).css('opacity', '0');
				$(show).css('top', '-200px');
				$(show).stop().animate({
					opacity: '1',
					top: '0px'
				}, this.pageTransitionSpeed);
				$(hideOne).stop().animate({
					opacity: '0',
					top: '200px'
				}, this.pageTransitionSpeed);
				$(hideTwo).stop().animate({
					opacity: '0',
					top: '200px'
				}, this.pageTransitionSpeed);
				setTimeout(function(){
					$(hideOne).css('display', 'none');
					$(hideTwo).css('display', 'none');
				}, this.pageTransitionSpeed);
			},

			toDiscoverContentOne: function(){
				if((this.pageState == 3 || this.pageState == 4) && this.signInState == false){
					this.pageState = 2;
					this.discoverScrollUp('#discoverContent1', '#discoverContent2', '#discoverContent3');
					$('.discoverTabParent').stop().animate({
						height: '33.3%'
					}, this.pageTransitionSpeed);
					$('.discoverLeftTab').stop().animate({
						height: '100%'
					}, this.pageTransitionSpeed);
				}
			},

			toDiscoverContentTwo: function(){
				$('.discoverTabParent').stop().animate({
					height: '66.6%'
				}, this.pageTransitionSpeed);
				$('.discoverLeftTab').stop().animate({
					height: '50%'
				}, this.pageTransitionSpeed);
				if(this.pageState == 2 && this.signInState == false){
					this.pageState = 3;
					this.discoverScrollDown('#discoverContent2', '#discoverContent1', '#discoverContent3');
				} else if (this.pageState == 4 && this.signInState == false) {
					this.pageState = 3;
					this.discoverScrollUp('#discoverContent2', '#discoverContent3', '#discoverContent1');
				}
			},

			toDiscoverContentThree: function(){
				if((this.pageState == 2 || this.pageState == 3) && this.signInState == false){
					this.pageState = 4;
					this.discoverScrollDown('#discoverContent3', '#discoverContent1', '#discoverContent2');
					$('.discoverTabParent').stop().animate({
						height: '100%'
					}, this.pageTransitionSpeed);
					$('.discoverLeftTab').stop().animate({
						height: '33.3%'
					}, this.pageTransitionSpeed);
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
				if(this.signInState == false){
					$('.topNbarHover').stop().animate({
						top: '0px'
					}, 300);
					$('.topNbarTab').stop().animate({
						top: '-42px',
						opacity: '0'
					}, 300);
					setTimeout(function(){
						$('.topNbarGuest').css('pointer-events', 'auto');
						$('.searchBar').css('pointer-events', 'auto');
					}, 300);
				}
			},

			hideTopNbar: function(){
				if(this.signInState == false){
					$('.topNbarHover').stop().animate({
						top: '-42px'
					}, 300);
					$('.topNbarTab').stop().animate({
						top: '0px',
						opacity: '1'
					}, 300);
				}
				setTimeout(function(){
					$('.topNbarGuest').css('pointer-events', 'none');
					$('.searchBar').css('pointer-events', 'none');
				}, 300);
			},

			noScroll: function(){
				this.canScroll = false;
			},

			yesScroll: function(){
				this.canScroll = true;
			},

			bindScroll: function(){
				var vm = this;
				var scrollAgain = true;
				$(document).bind('mousewheel', function(e){
					var delta = e.originalEvent.wheelDelta;
					if(delta > 0 && scrollAgain == true){
						//scroll up
						if(vm.pageState == 2){
							scrollAgain = false;
							vm.toHome();
							setTimeout(function(){
								scrollAgain = true;
							}, vm.pageTransitionSpeed);
						}else if(vm.pageState == 3){
							scrollAgain = false;
							vm.toDiscoverContentOne();
							setTimeout(function(){
								scrollAgain = true;
							}, vm.pageTransitionSpeed);
						}else if(vm.pageState == 4){
							scrollAgain = false;
							vm.toDiscoverContentTwo();
							setTimeout(function(){
								scrollAgain = true;
							}, vm.pageTransitionSpeed);
						}
					}
					else if(delta < 0 && scrollAgain == true){
						//scroll down
						if(vm.canScroll == true && vm.pageState == 1){
							scrollAgain = false;
							vm.toDiscover();
							setTimeout(function(){
								scrollAgain = true;
							}, vm.pageTransitionSpeed);
						}else if(vm.pageState == 2){
							scrollAgain = false;
							vm.toDiscoverContentTwo();
							setTimeout(function(){
								scrollAgain = true;
							}, vm.pageTransitionSpeed);
						}else if(vm.pageState == 3){
							scrollAgain = false;
							vm.toDiscoverContentThree();
							setTimeout(function(){
								scrollAgain = true;
							}, vm.pageTransitionSpeed);
						}
					}
				});
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


