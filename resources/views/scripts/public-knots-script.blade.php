<script>
	// Vue.http.headers.common['X-CSRF-TOKEN'] = 
	// 	document.querySelector('#token').getAttribute('value');
	console.log("linked");
	Vue.component('groups',{
		template: '#groups-template',

		data: function(){
			return {
				groups: [],
				group: {}
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
				//display view for that group guests
			    $('.landingView').css('display', 'none');
			   	$('.changeGroupView').css('display', 'none');
			    $('.discoverView').css('display', 'none');
			    $('.logoLine').css('left', '60%');
			    $('.nbarGuest').css('left', '60%');
			   	$('.topNbarGuest').css('display', 'flex');
			   	var id = group.id;
			   	console.log(id);

			   	this.$http.get('api/groups/'+id).then((response) => {
					console.log(response);	
			   	});
			   	
			    $('.publicGroupLeft').stop().animate({
			          scrollTop: $('.publicGroupLeft')[0].scrollHeight
			    }, 10);
			

				
				
			},

			
		}

	});


	new Vue({
		el: '#group-body'

	});


</script>


