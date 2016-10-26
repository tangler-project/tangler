<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');

	Vue.component('createknot',{
		
		template: '#createknot-template',

		data: function(){
			return {
				groups: [],
				privateGroups:[],


				group:{
					title:"",
					password:"",
					confirmPassword:""
				},
				
			};
		},


		methods:{
			saveGroup: function(e){
				e.preventDefault();
				// var component = this;

				this.$http.post('/add/group', this.group).then((response)=>{
					//if response fails, now im checking for incorrect
					//match of passwords
					if(response.body == 'fail'){
						console.log("passwords do not match");
					}
					else{
						console.log("should be updating view");
						this.fetchGroups();
						this.fetchPrivateGroups();
					}
				//getting the errors back from validate 
				//need array to run through errors to display them
				}, (response) => {
			    	
			    	console.log(response.body);
			  	});
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
			}
		}

	});

	new Vue({
		el: '#navbarCreateKnot'
	});

</script>