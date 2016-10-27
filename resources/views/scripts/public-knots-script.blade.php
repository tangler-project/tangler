<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');

	console.log("linked");
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
		}
	});


	
	new Vue({
		el: '#welcome-body'
		

	});


</script>


