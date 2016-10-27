<div class='cover'></div>
<div class='nbarUser'>
	<div class='nbarUserMain'>
		<div class='navLink linkChangeKnot' v-on:click="toChooseKnot">Home</div>
		<div class='navLink linkUserHome' v-on:click="toUserHome">Messages</div>
		<div class='navLink linkMedia' v-on:click="toMedia">Media</div>
		<div class='navLink linkThreads' v-on:click="toThreads">Threads</div>
		<div class='closeNbarUser' v-on:click="closeUserNbar">X</div>
	</div>
	<div class='nbarUserThreads'>
		<div class='linkUserMainReturn' v-on:click="returnToNbar">Back</div>
		<div class='navLink'>George</div>
		<div class='navLink'>Michael</div>
		<div class='navLink'>Nico</div>
		<div class='navLink'>Jose</div>
		<div class='closeNbarUser' v-on:click="closeUserNbar">X</div>
	</div>
	<div class='nbarUserChangeKnot'>
		<div class='navLink linkCreateKnot' v-on:click="showCreateKnot">Create Knot</div>
		<div class='navLink linkJoinKnot' v-on:click="showJoinKnot">Join Knot</div>
		<div class='navLink linkLeaveKnot' v-on:click="showLeaveKnot">Leave Knot</div>
		<div class='navLink linkLogout' ><a href="{{action('Auth\AuthController@getLogout')}}">Log out</a></div>
		<div class='closeNbarChangeKnot' v-on:click="closeUserHomeNbar">X</div>
	</div>
	
	<div class='nbarUserCreateKnot'>
		<div class='linkChangeKnotReturn' v-on:click="returnToHomeNbar">Back</div>
		<form method='POST'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input class='form-control' type='text' name='title' placeholder='Knot Name' v-model="group.title">
			<input type='file' class='custom-file-input'>
			<input class='form-control' type='password' name='password' placeholder='Password' v-model="group.password">
			<input class='form-control' type='password' name='confirmPassword' placeholder='Confirm Password' v-model="group.confirmPassword">
			<button type='submit' class='btn signupButton' 
				v-on:click="saveGroup">
				Create</button><br>
			<div class='closeNbarChangeKnot' v-on:click="closeUserHomeNbar">X</div>
		</form>
	</div>
		
	
	<div class='nbarUserJoinKnot'>
		<div class='linkChangeKnotReturn' v-on:click="returnToHomeNbar">Back</div>
		<form method='POST'>
			<input class='form-control' type='text' name='knotName' placeholder='Knot Name'>
			<input class='form-control' type='password' name='knotPassword' placeholder='Knot Password'>
			<button type='submit' class='btn loginButton'>Join</button>
			<div class='closeNbarChangeKnot' v-on:click="closeUserHomeNbar">X</div>
		</form>
	</div>
	<div class='nbarUserLeaveKnot'>
		<div class='linkChangeKnotReturn' v-on:click="returnToHomeNbar">Back</div>
		<div class='navLink'>Lassen</div>
		<div class='navLink'>F Society</div>
		<div class='navLink'>PDPsi</div>
		<div class='closeNbarChangeKnot' v-on:click="closeUserHomeNbar">X</div>
	</div>
</div>

<div class='TopNbarUser'>
	<div class='guestTopLink linkChangeKnot' v-on:click="toChooseKnot">Home</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkUserHome' v-on:click="toUserHome">Messages</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkMedia' v-on:click="toMedia">Media</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkThreads' v-on:click="toThreads">Threads</div>
</div>