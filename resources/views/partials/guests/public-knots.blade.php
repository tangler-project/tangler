<div id="group-body">
	<div >
		<groups></groups>
	</div>

	<template id="groups-template">
		<div class='container-fluid landingLeft'>
			<h4 class='landingTitle'>Public Knots</h4>
			<div v-for="(group, index) in groups">
				<div class='publicKnot' id='publicKnot@{{group.id}}' v-on:click="goToPost(group)">	
						@{{group.title}}
						@{{index}}
				</div>
			</div>
		</div>
	</template>
</div>

