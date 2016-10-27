<script>
	Vue.component('groups',{
		template: '#groups-template',

		data: function(){

			return {
				groups: [],
				privateGroups:[],

				post:{},
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
			   		
					this.$set('groupObject', response.body);
					this.$set('groupPosts', response.body.post);
					this.$set('groupEvents', response.body.event);
		
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
			}	
		}
	});


	new Vue({
		el: '#body'

	});
	


</script>



</script>