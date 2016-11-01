<div class='cover'></div>
<div class='nbarUser'>
	<div class='nbarUserMain'>
		<div class='navLink linkUserProfile' v-on:click="showEditProfile">Hi, {{Auth::user()->name}}</div>
		<div class='navLink linkChangeKnot' v-on:click="toChooseKnot">Home</div>
		<div class='navLink linkUserHome' v-on:click="toUserHome">Messages</div>
		<div class='navLink linkMedia' v-on:click="toMedia">Media</div>
		<div class='navLink linkThreads' v-on:click="toThreads">Threads</div>
		<div class='closeNbarUser' v-on:click="closeUserNbar">X</div>
	</div>
	<div class='nbarUserThreads'>
		<div class='linkUserMainReturn' v-on:click="returnToNbar">Back</div>
		<div v-for="user in groupObject.users">
			<div class='navLink'>@{{user.name}}</div>
		</div>
		<div class='closeNbarUser' v-on:click="closeUserNbar">X</div>
	</div>
	<div class='nbarUserChangeKnot'>
		<div class='navLink linkCreateKnot' v-on:click="showCreateKnot">Create Knot</div>
		<div class='navLink linkJoinKnot' v-on:click="showJoinKnot">Join Knot</div>
		<div class='navLink linkLeaveKnot' v-on:click="showLeaveKnot">Leave Knot</div>
		<div class='navLink linkLogout'><a href="{{action('Auth\AuthController@getLogout')}}">Log out</a></div>
		<div class='closeNbarChangeKnot' v-on:click="closeUserHomeNbar">X</div>
	</div>
	
	<div class='nbarUserCreateKnot'>
		<div class='linkChangeKnotReturn' v-on:click="returnToHomeNbar">Back</div>
		<form method='POST'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input class='form-control' type='text' name='title' placeholder='Knot Name' v-model="group.title">

			<input class='form-control' type='text' name='is_private' value='1' id='isPrivateInput' v-model="group.is_private">
			<div class='isPrivateBtn' v-on:click='knotIsPrivate'>Private</div>
			<div class='isPublicBtn' v-on:click='knotIsPublic'>Public</div>

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
			<input class='form-control' type='text' name='knotName' placeholder='Knot Name' v-model="knot.name">
			<input class='form-control' type='password' name='knotPassword' placeholder='Knot Password' v-model="knot.password">
			<button type='submit' class='btn loginButton' v-on:click="joinKnot">Join</button>
			<div class='closeNbarChangeKnot' v-on:click="closeUserHomeNbar">X</div>
		</form>
	</div>
	<div class='nbarUserLeaveKnot'>
		<div class='linkChangeKnotReturn' v-on:click="returnToHomeNbar">Back</div>
		<div v-for="group in privateGroups">
			<div class='navLink' v-on:click="removeMeFromGroup(group)">@{{group.title}}</div>
		</div>

		
		<div class='closeNbarChangeKnot' v-on:click="closeUserHomeNbar">X</div>
	</div>
	<div class='nbarUserProfileEdit'>
		<form method='POST' action="{{ action('Auth\AuthController@postRegister') }}">
			{{ csrf_field() }}
			<input class='form-control' type='text' name='name' placeholder='Your Name' v-model="user.name">			
			<input class='form-control' type='email' name='email' placeholder='Your Email' v-model="user.email">
			
			<input type="hidden" name="img_url" id="uploadedImageUser" value="" v-model="user.img_url">
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Tangle Your Profile!" onchange="showImageUser();" data-fp-multiple="false" data-fp-crop-dim="230,230" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)">
			{{-- END FILESTACK --}}

			<input class='form-control' type='password' name='password' placeholder='Your Password' v-model="editUserInfo.password">
			<input class='form-control' type='password' name='password' placeholder='New Password' v-model="editUserInfo.newPassword">
			<input class='form-control' type='password' name='password_confirmation' placeholder='Confirm Password' v-model="editUserInfo.confirmNewPassword">

			<button type='submit' class='btn' v-on:click="editUser">Edit</button><br>
		</form>
		<form action="{{action('Auth\AuthController@getLogout')}}">
			<button type='submit' class='btn' v-on:click="deleteUser">Deactivate Account</button>
		</form>
			<div class='closeNbarUser' v-on:click="closeUserNbar">X</div>
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