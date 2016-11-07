<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');

	Vue.component('welcome',{
		template: '#welcome-template',

		data: function(){
			return {
				newUser:{},
				errorPassword:false,
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
				mouseLeft: false,
				mouseRight: false,
				mobileVersion: false,
				mobileLeft: true,
			};
		},

		created: function(){
			this.fetchGroups();
			this.bindScroll();	
		},

		ready: function(){
			this.checkMobile();
		},

		methods:{
			//validate password and confirm password for registration
			validateARegister: function(e){
				if(this.newUser.password != this.newUser.confirmPassword){
					e.preventDefault();
					this.errorPassword = true;
				}
				
			},

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

			fetchPosts: function(){

				this.$http.get('api/posts/'+this.groupId).then((response) => {
					//setting the array with the new post
					this.$set('groupPosts', response.body);
				});	
			},

			goToPost: function(group){
			    //hide search bar
				$('#searchBar').hide();

			    var component = this;
			   	this.$http.get('api/groups/'+group.id).then((response) => {	

			   		this.groupId = group.id;

					this.$set('groupObject', response.body);
					// this.$set('groupPosts', response.body.post);
					// console.log(response.body.post);
					this.$set('groupEvents', response.body.event);

					this.fetchPosts();
			   	});
			   	this.pageState = 0;
			   	this.toGroupTransition();

			},

			toGroupTransition: function(){
				$('.midTopLink').css('pointer-events', 'auto');
				$('.homeLink').css('pointer-events', 'auto');
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
				var vm = this;
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
				if(vm.mobileVersion == true){
					if(vm.mobileLeft == false){
						setTimeout(function(){
							$('.landingRight, .discoverRight, .publicGroupRight').animate({
								width: '85%'
							}, 700);
							$('.landingLeft, .discoverLeft, .publicGroupLeft').animate({
								width: '15%'
							}, 700);
							$('.mobileArrow').animate({
								left: '15%',
								opacity: '1'
							}, 700);
							$('.landingContent, .arrowImg, .discoverContent').animate({
								opacity: '1'
							}, 700);
						}, 900);
					} else if(vm.mobileLeft == true) {
						setTimeout(function(){
							$('.landingRight, .discoverRight, .publicGroupRight').animate({
								width: '15%'
							}, 700);
							$('.landingLeft, .discoverLeft, .publicGroupLeft').animate({
								width: '85%'
							}, 700);
							$('.mobileArrow').animate({
								left: '85%',
								opacity: '1'
							}, 700);
							$('.landingContent, .arrowImg, .discoverContent').animate({
								opacity: '0'
							}, 700);
						}, 900);
					}
				}
				setTimeout(function(){
					$('.nbarGuest').css('display', 'none');
					$('.nbarGuestSignup').css('display', 'flex');
					$('.nbarGuestLogin').css('display', 'none');	
					$('.linkOutline').css('left', '1px');
					$('.publicKnot').css('pointer-events', 'auto');
				}, this.navbarTransitionSpeed - 50);
			},

			showSignUp: function(){
				var vm = this;
				this.signInState = true;
				$('.nbarGuestLogin').css('display', 'none');
				$('.nbarGuest').css('display', 'flex');
				$('.cover').css('display', 'block');
				$('.cover').css('pointer-events', 'none');
				$('.publicKnot').css('pointer-events', 'none');
				if(this.mobileVersion == true){
					$('.landingRight, .discoverRight, .publicGroupRight, .landingLeft, .discoverLeft, .publicGroupLeft').animate({
						width: '50%'
					}, 600);
					$('.mobileArrow').animate({
						left: '50%',
						opacity: '0'
					}, 600);
					setTimeout(function(){
						$('.topNbarHover').stop().animate({
							top: '-100px'
						}, 700);
						$('.landingRight').stop().animate({
							right: '-150px'
						}, 700);
						$('.landingLeft').stop().animate({
							left: '-150px'
						}, 700);
						$('.discoverRight').stop().animate({
							right: '-150px'
						}, 700);
						$('.discoverLeft').stop().animate({
							left: '-150px'
						}, 700);
						$('.publicGroupRight').stop().animate({
							right: '-150px'
						}, 700);
						$('.publicGroupLeft').stop().animate({
							left: '-150px'
						}, 700);
					}, 600);
					setTimeout(function(){
						$('.nbarGuest').css('z-index', '3');
						$('.cover').css('pointer-events', 'auto');
					}, 1300);
				} else {
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
					$('.leftSideTab, .rightSideTab').stop().animate({
						opacity: '0'
					}, 300);
					setTimeout(function(){
						$('.nbarGuest').css('z-index', '3');
						$('.cover').css('pointer-events', 'auto');
					}, 800);
				}
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
				$('.midTopLink').css('pointer-events', 'auto');
				$('.homeLink').css('pointer-events', 'none');
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

				//show navbar
				$('#searchBar').fadeIn();
			},

			toDiscover: function(){
				$('.midTopLink').css('pointer-events', 'none');
				$('.homeLink').css('pointer-events', 'auto');
				if(this.pageState == 1 && this.signInState == false){
					this.pageState = 2;
					$('.discoverTitleCover1').css('opacity', '0');
					$('.discoverTabParent').css('height', '33.3%');
					$('.discoverLeftTab').css('height', '100%');
					$('#discoverContent1').css('display', 'flex');
					$('#discoverContent1').css('opacity', '1');
					$('#discoverContent1').css('top', '0px');
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
					$('.discoverTitleCover1').css('opacity', '0');
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
					$('.discoverTitleCover1').stop().animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.discoverTitleCover2, .discoverTitleCover3').stop().animate({
						opacity: '0.5'
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
				$('.discoverTitleCover2').stop().animate({
					opacity: '0'
				}, this.pageTransitionSpeed);
				$('.discoverTitleCover1, .discoverTitleCover3').stop().animate({
					opacity: '0.5'
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
					$('.discoverTitleCover3').stop().animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.discoverTitleCover1, .discoverTitleCover2').stop().animate({
						opacity: '0.5'
					}, this.pageTransitionSpeed);
				}
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
					$('.rightSideTab').stop().animate({
							opacity: '0'
						}, 300);
					$('.leftSideTab').stop().animate({
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

			mouseInRight: function(){
				this.mouseLeft = false;
				if(this.signInState == false){
					$('.leftSideTab').stop().animate({
							opacity: '0'
						}, 400);
					$('.rightSideTab').stop().animate({
							opacity: '1'
						}, 400);
					$('.groupName').stop().animate({
							opacity: '0',
							left: '-30px'
						}, 500);
				}
			},

			mouseInLeft: function(){
				this.mouseLeft = true;
				if(this.signInState == false && this.mobileLeft == true){
					$('.leftSideTab').stop().animate({
							opacity: '1'
						}, 400);
					$('.rightSideTab').stop().animate({
							opacity: '0'
						}, 400);
					$('.groupName').stop().animate({
							opacity: '1',
							left: '0px'
						}, 500);
				}
			},

			bindScroll: function(){
				var vm = this;
				var scrollAgain = true;
				$(document).bind('mousewheel', function(e){
					console.log(vm.mobileVersion);
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
						if(vm.mouseLeft == false && vm.pageState == 1){
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

			arrowScroll: function(){
				// if(this.mobileVersion == false){
					if(this.mouseLeft == false && this.pageState == 1){
						scrollAgain = false;
						this.toDiscover();
						setTimeout(function(){
							scrollAgain = true;
						}, this.pageTransitionSpeed);
					}else if(this.pageState == 2){
						scrollAgain = false;
						this.toDiscoverContentTwo();
						setTimeout(function(){
							scrollAgain = true;
						}, this.pageTransitionSpeed);
					}else if(this.pageState == 3){
						scrollAgain = false;
						this.toDiscoverContentThree();
						setTimeout(function(){
							scrollAgain = true;
						}, this.pageTransitionSpeed);
					}
					else if(this.pageState == 4){
						scrollAgain = false;
						this.toDiscoverContentTwo();
						setTimeout(function(){
							scrollAgain = true;
						}, this.pageTransitionSpeed);
					}
				// }
			},

			checkMobile: function(){
				var vm = this;
				if ($(window).width() <= 768) {
					vm.mobileVersion = true;
					vm.mobileActive();
				} else if ($(window).width() > 768) {
					vm.mobileVersion = false;
				}
				$(window).on('resize', function(){
					if ($(window).width() <= 768 && vm.mobileVersion == false) {
						vm.mobileVersion = true;
						vm.mobileActive();
					} else if ($(window).width() > 768 && vm.mobileVersion == true) {
						vm.mobileVersion = false;
						vm.mobileDeactive();
					}
				});
			},

			mobileSwitch: function(){
				if(this.mobileLeft == false){
					this.mobileLeft = true;
					$('.landingRight, .discoverRight, .publicGroupRight').animate({
						width: '15%'
					}, this.pageTransitionSpeed);
					$('.landingLeft, .discoverLeft, .publicGroupLeft').animate({
						width: '85%'
					}, this.pageTransitionSpeed);
					$('.mobileArrow').animate({
						left: '85%'
					}, this.pageTransitionSpeed);
					$('.landingContent, .arrowImg, .discoverContent').animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.outputText').animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.createNewPost').animate({
						opacity: '1',
						width: '85%'
					}, this.pageTransitionSpeed);
					$('.eventContainer').animate({
						opacity: '0',
						width: '15%'
					}, this.pageTransitionSpeed);
					$('.publicKnot, .publicUserKnot, .privateKnot, .groupBanner').css('pointer-events', 'auto');
				} else {
					this.mobileLeft = false;
					$('.landingRight, .discoverRight, .publicGroupRight').animate({
						width: '85%'
					}, this.pageTransitionSpeed);
					$('.landingLeft, .discoverLeft, .publicGroupLeft').animate({
						width: '15%'
					}, this.pageTransitionSpeed);
					$('.mobileArrow').animate({
						left: '15%'
					}, this.pageTransitionSpeed);
					$('.landingContent, .arrowImg, .discoverContent').animate({
						opacity: '1'
					}, this.pageTransitionSpeed);
					$('.outputText').animate({
						opacity: '0'
					}, this.pageTransitionSpeed);
					$('.createNewPost').animate({
						opacity: '0',
						width: '15%'
					}, this.pageTransitionSpeed);
					$('.eventContainer').animate({
						opacity: '1',
						width: '85%'
					}, this.pageTransitionSpeed);
					$('.publicKnot, .publicUserKnot, .privateKnot, .groupBanner').css('pointer-events', 'none');
				}
			},

			mobileActive: function(){
				this.mobileLeft = false;
				$('.landingRight, .discoverRight, .publicGroupRight').css('width', '85%');
				$('.landingLeft, .discoverLeft, .publicGroupLeft').css('width', '15%');
				$('.rightSideTab, .leftSideTab, .searchBar').css('display', 'none');
				$('.mobileArrow').css('display', 'block');
				$('.mobileArrow').css('left', '15%');
				$('.outputText, .createNewPost').css('opacity', '0');
				// $('.groupBanner').removeClass('gbZoom');
				setTimeout(function(){
					$('.publicKnot, .publicUserKnot, .privateKnot, .groupBanner').css('pointer-events', 'none');
					}, 600);
			},

			mobileDeactive: function(){
				this.mobileLeft = true;
				$('.landingRight, .discoverRight, .publicGroupRight').css('width', '50%');
				$('.landingLeft, .discoverLeft, .publicGroupLeft').css('width', '50%');
				$('.rightSideTab, .leftSideTab, .searchBar').css('display', 'flex');
				$('.mobileArrow').css('display', 'none');
				$('.landingContent, .arrowImg, .discoverContent').css('opacity', '1');
				$('.publicKnot, .publicUserKnot, .privateKnot, .groupBanner').css('pointer-events', 'auto');
				$('.outputText, .createNewPost').css('opacity', '1');
				// $('.groupBanner').addClass('gbZoom');
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


