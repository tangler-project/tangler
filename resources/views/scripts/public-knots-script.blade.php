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
				
			}
		}

	});


	new Vue({
		el: '#group-body'


	});
</script>