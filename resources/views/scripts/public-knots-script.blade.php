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
				$('.nbarGuest').css('display', 'none');
				$('.nbarGuestSignup').css('display', 'none');
				$('.nbarGuestLogin').css('display', 'none');
				$('.nbarGuestMain').css('display', 'flex');
				$('.topNbarGuest').css('display', 'flex');
				$('.cover').css('display', 'none');
			},

			showSignUp: function(){
				$('.nbarGuestMain').css('display', 'none');
				$('.topNbarGuest').css('display', 'none');
				$('.nbarGuest').css('display', 'flex');
				$('.nbarGuestSignup').css('display', 'flex');
				$('.nbarGuestLogin').css('display', 'none');
			},

			showLogIn: function(){
				$('.nbarGuestSignup').css('display', 'none');
				$('.nbarGuestLogin').css('display', 'flex');
			},

			toHome: function(){
				$('.discoverView').css('display', 'none');
				$('.contactView').css('display', 'none');
				$('.publicGroupView').css('display', 'none');
				$('.landingView').css('display', 'flex');
				$('.logoLine').css('left', '50%');
				$('.nbarGuest').css('left', '50%');
				$('.nbarGuest').css('display', 'none');
				$('.topNbarGuest').css('display', 'flex');
				$('.cover').css('display', 'none');
			},

			toDiscover: function(){
				$('.landingView').css('display', 'none');
				$('.contactView').css('display', 'none');
				$('.publicGroupView').css('display', 'none');
				$('.discoverView').css('display', 'block');
				$('.logoLine').css('left', '50%');
				$('.nbarGuest').css('left', '50%');
				$('.nbarGuest').css('display', 'none');
				$('.topNbarGuest').css('display', 'flex');
				$('.cover').css('display', 'none');
			},

			toDiscoverContentOne: function(){
				$('#discoverContent3').css('display', 'none');
				$('#discoverContent2').css('display', 'none');
				$('#discoverContent1').css('display', 'block');
			},

			toDiscoverContentTwo: function(){
				$('#discoverContent3').css('display', 'none');
				$('#discoverContent1').css('display', 'none');
				$('#discoverContent2').css('display', 'block');
			},

			toDiscoverContentThree: function(){
				$('#discoverContent2').css('display', 'none');
				$('#discoverContent1').css('display', 'none');
				$('#discoverContent3').css('display', 'block');
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
				setTimeout(function(){
					$('.topNbarGuest').css('pointer-events', 'auto');
				}, 300);
			},

			hideTopNbar: function(){
				$('.topNbarHover').stop().animate({
					top: '-42px'
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


