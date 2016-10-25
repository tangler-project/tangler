<div id="group-body">
	<div >
		<groups></groups>
	</div>

	<template id="groups-template">
		<div class='container-fluid landingLeft'>
			<h4 class='landingTitle'>Public Knots</h4>
			<div v-for="group in groups">
				<div class='publicKnot' v-on:click="goToPost">
					{{-- <div v-if="isPrivate($event)"> --}}
						@{{group.title}}
					{{-- </div> --}}
				</div>
			</div>
		</div>
	</template>
</div>

