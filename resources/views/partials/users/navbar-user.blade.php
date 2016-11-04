<div class='cover' v-on:click='closeUserNbar'></div>
<div class='nbarUser'>

	<div class='nbarUserThreads'>
		<div v-for="user in groupObject.users">
			<div class='navLink'>@{{user.name}}</div>
		</div>
	</div>
	
	<div class='manageKnots'>
		<div class='manageNav'>
			<div class='manageKnotsLinks linkJoinKnot' v-on:click="showJoinKnot">Join</div>
			<div class='manageKnotsLinks linkCreateKnot' v-on:click="showCreateKnot">Create</div>
			<div class='manageKnotsLinks linkLeaveKnot' v-on:click="showLeaveKnot">Leave</div>
			<div class='linkOutlineUser'></div>
		</div>

		<div class='nbarUserCreateKnot'>
			<form method='POST'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input class='form-control' type='text' name='title' placeholder='Knot Name' v-model="group.title">

				<input class='form-control' type='text' name='description' placeholder='Knot Description' v-model="group.description">

				<input class='form-control' type='hidden' name='is_private' value='1' id='isPrivateGroup' v-model="group.is_private">

				<div class='isPrivateBtn' v-on:click='knotIsPrivate'>Private</div>
				<div class='isPublicBtn' v-on:click='knotIsPublic'>Public</div>
				<input class='form-control' type='password' name='password' placeholder='Password' v-model="group.password">
				<input class='form-control' type='password' name='confirmPassword' placeholder='Confirm Password' v-model="group.confirmPassword">


				<input type="hidden" name="img_url" id="uploadedImageGroup" value="" v-model="group.img_url">
				{{-- FILESTACK --}}
				<input type="filepicker-dragdrop" data-fp-button-text="Avatar" onchange="showImageGroup();" data-fp-multiple="false" data-fp-crop-min="600,600" data-fp-crop-max="1200, 1200" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)">
				{{-- END FILESTACK --}}

				<button type='submit' class='btn signupButton' 
					v-on:click="saveGroup">
					Create</button><br>
			</form>
			<div class="createCreateKnotErrors"></div>
		</div>

		<div class='nbarUserJoinKnot'>
			<form method='POST'>
				<input class='form-control' type='text' name='knotName' placeholder='Knot Name' v-model="knot.name">
				<input class='form-control' type='password' name='knotPassword' placeholder='Knot Password' v-model="knot.password">
				<button type='submit' class='btn loginButton' v-on:click="joinKnot">Join</button>
			</form>
			<div class="createJoinKnotErrors"></div>
		</div>

		<div class='nbarUserLeaveKnot'>
			<div v-for="group in privateGroups">
				<div class='navLink' v-on:click="removeMeFromGroup(group)">@{{group.title}}</div>
			</div>
		</div>
	</div>
		
	

	<div class='nbarUserProfileEdit'>
		<form method='POST' action="{{ action('Auth\AuthController@postRegister') }}">
			<div class="createEditUserErrors"></div>
			{{ csrf_field() }}
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Avatar" onchange="showImageUser();" data-fp-multiple="false" data-fp-crop-dim="230,230" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)">
			{{-- END FILESTACK --}}
			<input class='form-control' type='text' name='name' placeholder='Your Name' v-model="user.name">			
			<input class='form-control' type='email' name='email' placeholder='Your Email' v-model="user.email">
			
			<input type="hidden" name="img_url" id="uploadedImageUser" value="" v-model="user.img_url">

			<input class='form-control' type='password' name='password' placeholder='Your Password' v-model="editUserInfo.password">
			<input class='form-control' type='password' name='password' placeholder='New Password' v-model="editUserInfo.newPassword">
			<input class='form-control' type='password' name='password_confirmation' placeholder='Confirm Password' v-model="editUserInfo.confirmNewPassword">

			<button type='submit' class='btn editBtn' v-on:click="editUser">Edit</button>
		</form>
		<a href="{{action('Auth\AuthController@getLogout')}}"><button class='btn logoutBtn'>Log out</button></a>
		<form class='deleteUser' action="{{action('Auth\AuthController@getLogout')}}">
			<button type='submit' class='btn deativateBtn' v-on:click="deleteUser">Delete Account</button>
		</form>
	</div>

	<div class='createNewEvent'>
		<form method='POST'>
			{{ csrf_field() }}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<input class='form-control eventInputs' type='text' name='title' placeholder='Title' v-model="event.title">
			<input class='form-control eventInputs' type='text' name='content' placeholder='Description' v-model="event.content">
			<input class='form-control eventInputs' type='datetime-local' name='start_date' placeholder='Start Date/Time' v-model="event.start_date">
			<input class='form-control eventInputs' type='datetime-local' name='end_date' placeholder='End Date/Time' v-model="event.end_date">

			<input type="hidden" name="img_url" id="uploadedImageEvent" value="" v-model="event.img_url">
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Add Photo" onchange="showImageEvent();" data-fp-multiple="false" data-fp-crop-dim="230,230" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)">
			{{-- END FILESTACK --}}

			<button type='submit' class='btn createEventButton' v-on:click="saveEvent">Create Event</button>
		</form>
		<div class='createEventErrors'></div>
	</div>
	<div class='editEvent'>
		<form method='POST'>
			{{ csrf_field() }}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<input class='form-control eventInputs' type='text' name='title' placeholder='Title' v-model="event.title">
			<input class='form-control eventInputs' type='text' name='content' placeholder='Description' v-model="event.content">
			<input class='form-control eventInputs' type='datetime-local' name='start_date' placeholder='Start Date/Time' v-model="event.start_date">
			<input class='form-control eventInputs' type='datetime-local' name='end_date' placeholder='End Date/Time' v-model="event.end_date">

			<input type="hidden" name="img_url" id="uploadedImageEventEdit" value="" v-model="event.img_url">
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Add Photo" onchange="showImageEventEdit();" data-fp-multiple="false" data-fp-crop-dim="230,230" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)">
			{{-- END FILESTACK --}}

			<button type='submit' class='btn' v-on:click="editEvent">Edit</button>
		</form>
		<form class='deleteEventBtn'>
			<button type='submit' class='btn' v-on:click="deleteEvent">Delete</button>
		</form>
		<div class="createEditEventErrors"></div>
	</div>
	
	{{-- <div class='container-fluid mediaView'>
		<table>
			<tr>
				<div v-for="post in groupPostsWithImages">
						<img class='mediaTD' v-bind:src="post.img_url">
				</div>
		</table>
	</div> --}}

	<div class="container-fluid mediaView" id="mediaTable">
		
	</div>

</div>

<div class='topNbarHover' v-on:mouseover='showTopNbar' v-on:mouseleave='hideTopNbar'>
	<div class="form-group searchBar">
      	<input type="text" class="searchInput form-control" placeholder="Search" id="searchBar">
    </div>
	<div class='topNbarUser'>
		<div class='guestTopLink linkChangeKnot' v-on:click="toChooseKnot">Home</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkMedia' v-on:click="toMedia">Media</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkThreads' v-on:click="toThreads">Threads</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkCreateKnot' v-on:click="showEditProfile">@{{user.name}}</div>
	</div>
	<div class='topNbarHome'>
		<div class='guestTopLink linkCreateKnot' v-on:click="showManageKnots">Manage Knots</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkCreateKnot' v-on:click="showEditProfile">@{{user.name}}</div>	
	</div>
	<div class='topNbarUserPublic'>
		<div class='guestTopLink linkChangeKnot' v-on:click="toChooseKnot">Home</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkMedia' v-on:click="toMedia">Media</div>
		<div class='topLinkSeperator'>/</div>
		<div class='guestTopLink linkCreateKnot' v-on:click="showEditProfile">@{{user.name}}</div>
	</div>
	<div class='topNbarTab'>Navigation</div>
</div>

