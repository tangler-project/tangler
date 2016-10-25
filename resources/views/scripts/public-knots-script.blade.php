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
					this.$set('groups', response.body);
				});	
			},
			goToPost: function(){
				
				console.log(this.group);
			},
			isPrivate: function(){
				console.log(this.post.is_private);
				return this.post.is_private == 0;
			}
		}

	});


	new Vue({
		el: '#group-body'


	});
</script>