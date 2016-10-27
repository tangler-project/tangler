<div class='cover'></div>
<div class='nbarUser'>
	<div class='nbarUserMain'>
		<div class='navLink linkChangeKnot'>Home</div>
		<div class='navLink linkUserHome'>Messages</div>
		<div class='navLink linkMedia'>Media</div>
		<div class='navLink linkThreads'>Threads</div>
		<div class='closeNbarUser'>X</div>
	</div>
	<div class='nbarUserThreads'>
		<div class='linkUserMainReturn'>Back</div>
		<div class='navLink'>George</div>
		<div class='navLink'>Michael</div>
		<div class='navLink'>Nico</div>
		<div class='navLink'>Jose</div>
		<div class='closeNbarUser'>X</div>
	</div>
	<div class='nbarUserChangeKnot'>
		<div class='navLink linkCreateKnot'>Create Knot</div>
		<div class='navLink linkJoinKnot'>Join Knot</div>
		<div class='navLink linkLeaveKnot'>Leave Knot</div>
		<div class='navLink linkLogout' ><a href="{{action('Auth\AuthController@getLogout')}}">Log out</a></div>
		<div class='closeNbarChangeKnot'>X</div>
	</div>
	<div id="navbarCreateKnot">
		<div>
			<createknot></createknot>
		</div>

		<template id="createknot-template">
			<div class='nbarUserCreateKnot'>
				<div class='linkChangeKnotReturn'>Back</div>
				<form method='POST'>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input class='form-control' type='text' name='title' placeholder='Knot Name' v-model="group.title">
					<input type='file' class='custom-file-input'>
					<input class='form-control' type='password' name='password' placeholder='Password' v-model="group.password">
					<input class='form-control' type='password' name='confirmPassword' placeholder='Confirm Password' v-model="group.confirmPassword">
					<button type='submit' class='btn signupButton' 
						v-on:click="saveGroup">
						Create</button><br>
					<div class='closeNbarChangeKnot'>X</div>
				</form>
			</div>
		</template>
	</div>
	
	<div class='nbarUserJoinKnot'>
		<div class='linkChangeKnotReturn'>Back</div>
		<form method='POST'>
			<input class='form-control' type='text' name='knotName' placeholder='Knot Name'>
			<input class='form-control' type='password' name='knotPassword' placeholder='Knot Password'>
			<button type='submit' class='btn loginButton'>Join</button>
			<div class='closeNbarChangeKnot'>X</div>
		</form>
	</div>
	<div class='nbarUserLeaveKnot'>
		<div class='linkChangeKnotReturn'>Back</div>
		<div class='navLink'>Lassen</div>
		<div class='navLink'>F Society</div>
		<div class='navLink'>PDPsi</div>
		<div class='closeNbarChangeKnot'>X</div>
	</div>
</div>

<div class='TopNbarUser'>
	<div class='guestTopLink linkChangeKnot'>Home</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkUserHome'>Messages</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkMedia'>Media</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkThreads'>Threads</div>
</div>