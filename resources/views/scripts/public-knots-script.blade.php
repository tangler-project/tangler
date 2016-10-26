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
				console.log(this.groups[group].id);
				//api request to get the view for that group
			},

			getGroupId: function(group){
				console.log(group.id);
			}
			
		}

	});


	new Vue({
		el: '#group-body'

	});


</script>


