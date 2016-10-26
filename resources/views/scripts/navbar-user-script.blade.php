<script>
    console.log("linked");
	Vue.http.headers.common['X-CSRF-TOKEN'] = 
		document.querySelector('#token').getAttribute('value');

	Vue.component('createknot',{
		
		template: '#createknot-template',

		data: function(){
			return {
				group:{}
			};
		},

		methods:{
			savePost: function(e){
				e.preventDefault();
				var component = this;
				this.$http.post('/add/group', this.group).then((response)=>{
					// component.fetchPosts();
					// component.scrollToBottom();
				});
			}
		}

	});

	new Vue({
		el: '#navbarCreateKnot'
	});

</script>