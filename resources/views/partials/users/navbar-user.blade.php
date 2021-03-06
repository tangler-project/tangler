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
			<form method='POST' class="knotForm">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input class='form-control' type='text' name='title' placeholder='Knot Name' v-model="group.title">

				<input class='form-control' type='hidden' name='is_private' value='1' id='isPrivateGroup' v-model="group.is_private">

				<div class='isPrivateBtn' v-on:click='knotIsPrivate'>Private</div>
				<div class='isPublicBtn' v-on:click='knotIsPublic'>Public</div>


				<div id="hideOrShowPasswordFields">
					<input class='form-control' type='password' name='password' placeholder='Password' v-model="group.password">
					<input class='form-control' type='password' name='confirmPassword' placeholder='Confirm Password' v-model="group.confirmPassword">
				</div>

				<input type="hidden" name="img_url" id="uploadedImageGroup" value="" v-model="group.img_url">
				{{-- FILESTACK --}}
				<input type="filepicker-dragdrop" data-fp-button-text="Banner" onchange="showImageGroup();" data-fp-multiple="false" data-fp-crop-ratio="3.3" data-fp-apikey="AFGvWoJTST9mOgo2z7O7Pz" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)" class='filestack'>
				{{-- END FILESTACK --}}

				<button type='submit' class='btn signupButton' 
					v-on:click="saveGroup">
					Create</button>
				<br>
			</form>
			{{-- <br><br><br> --}}
			<div class="createCreateKnotErrors errors"></div>
			<div class="createKnotSuccess success"></div>
		</div>

		<div class='nbarUserJoinKnot'>
			<form method='POST'>
				<input class='form-control' type='text' name='knotName' placeholder='Knot Name' v-model="knot.name">
				<input class='form-control' type='password' name='knotPassword' placeholder='Knot Password' v-model="knot.password">
				<button type='submit' class='btn loginButton' v-on:click="joinKnot">Join</button>
			</form>
			<div class="createJoinKnotErrors errors"></div>
			<div class="joinKnotSuccess success"></div>
		</div>

		<div class='nbarUserLeaveKnot'>
			<div v-for="group in privateGroups">
				<div class='leaveParent'>
					<img class='leaveImg' v-bind:src='group.img_url'>
					<div class='leaveX' v-on:click="removeMeFromGroup(group)">X</div>
					<div class='leaveName'>	@{{group.title}} </div>
				</div>
			</div>
		</div>

	</div>
		
	

	<div class='nbarUserProfileEdit'>
		<form method='POST' class="userEditForm">
			
			{{-- {{ csrf_field() }} --}}
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Avatar" onchange="showImageUser();" data-fp-multiple="false" data-fp-crop-ratio="1/1" data-fp-apikey="AFGvWoJTST9mOgo2z7O7Pz" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)" class='filestack'>
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
		<br><br><br>
		<div class="createEditUserErrors errors"></div>
		<div class="createEditUserSuccess success"></div>
	</div>

	<div class='createNewEvent'>

		<form method='POST' class="eventForm">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<input class='form-control eventInputs' type='text' name='title' placeholder='Title' v-model="event.title">
			<input class='form-control eventInputs' type='text' name='content' placeholder='Description' v-model="event.content">
			<input class='form-control eventInputs' type='datetime-local' name='start_date' placeholder='Start Date/Time' v-model="event.start_date">
			<input class='form-control eventInputs' type='datetime-local' name='end_date' placeholder='End Date/Time' v-model="event.end_date">

			<input type="hidden" name="img_url" id="uploadedImageEvent" value="" v-model="event.img_url">
			{{-- FILESTACK --}}
			
			<input type="filepicker-dragdrop" data-fp-button-text="Add Photo" onchange="showImageEvent();" data-fp-multiple="false" data-fp-crop-ratio="1/1" data-fp-apikey="AFGvWoJTST9mOgo2z7O7Pz" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)" class='filestack'>
			{{-- END FILESTACK --}}
			

			<button type='submit' class='btn createEventButton' v-on:click="saveEvent">Create Event</button>
		</form>
		<br>
		<div class='createEventErrors errors'></div>
		<div class="createEventSuccess success"></div>
	</div>
	<div class='editEvent'>
		<form method='POST' class="eventForm">
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<input class='form-control eventInputs' type='text' name='title' placeholder='Title' v-model="event.title">
			<input class='form-control eventInputs' type='text' name='content' placeholder='Description' v-model="event.content">
			<input class='form-control eventInputs' type='datetime-local' name='start_date' placeholder='Start Date/Time' v-model="event.start_date">
			<input class='form-control eventInputs' type='datetime-local' name='end_date' placeholder='End Date/Time' v-model="event.end_date">

			<input type="hidden" name="img_url" id="uploadedImageEventEdit" value="" v-model="event.img_url">
			{{-- FILESTACK --}}
			<input type="filepicker-dragdrop" data-fp-button-text="Add Photo" onchange="showImageEventEdit();" data-fp-multiple="false" data-fp-crop-ratio="1/1" data-fp-apikey="AFGvWoJTST9mOgo2z7O7Pz" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="false" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)" class='filestack'>
			{{-- END FILESTACK --}}

			<button type='submit' class='btn' v-on:click="editEvent">Edit</button>
		</form>
		<form class='deleteEventBtn'>
			<button type='submit' class='btn' v-on:click="deleteEvent">Delete</button>
		</form>

		<div class="createEditEventErrors errors"></div>
		<div class="editEventSuccess success"></div>
	</div>
	
	

	<div class="container-fluid mediaView" id="mediaTable">
		
	</div>

</div>

<div class='topNbarHover' v-on:mouseover='showTopNbar' v-on:mouseleave='hideTopNbar'>
	<div class="form-group searchBar">
      	<input type="text" class="searchInput form-control" placeholder="Search group" id="searchBar">
    </div>
	<div class='topNbarUser'>
		<div class='guestTopLinkUser linkChangeKnot' v-on:click="toChooseKnot">Home</div>
		<div class='guestTopLinkUser linkChangeKnot' v-on:click="showCreateEvent">Create Event</div>
		<div class='guestTopLinkUser linkMedia' v-on:click="toMedia">Media</div>
		<div class='guestTopLinkUser linkThreads' v-on:click="toThreads">Threads</div>
		<div class='guestTopLinkUser linkCreateKnot' v-on:click="showEditProfile">@{{user.name}}</div>
	</div>
	<div class='topNbarHome'>
		<div class='guestTopLinkUser linkCreateKnot' v-on:click="showManageKnots">Manage Knots</div>
		<div class='guestTopLinkUser linkCreateKnot' v-on:click="showEditProfile">@{{user.name}}</div>	
	</div>
	<div class='topNbarUserPublic'>
		<div class='guestTopLinkUser linkChangeKnot' v-on:click="toChooseKnot">Home</div>
		<div class='guestTopLinkUser linkChangeKnot' v-on:click="showCreateEvent">Create Event</div>
		<div class='guestTopLinkUser linkMedia' v-on:click="toMedia">Media</div>
		<div class='guestTopLinkUser linkCreateKnot' v-on:click="showEditProfile">@{{user.name}}</div>
	</div>
	<div class='topNbarTab'>
		Navigation	
	</div>
</div>



<div class='mobileNbar' v-on:mouseover='showTopNbar' v-on:mouseleave='hideTopNbar'>
	<div class='topNbarUser mobileLinkParent'>
		<div class='guestTopLinkUser linkChangeKnot mobileLink' v-on:click="toChooseKnot">Home</div>
		<div class='guestTopLinkUser linkChangeKnot mobileLink' v-on:click="showCreateEvent">Create Event</div>
		<div class='guestTopLinkUser linkMedia' v-on:click="toMedia">Media</div>
		<div class='guestTopLinkUser linkThreads' v-on:click="toThreads">Threads</div>
		<div class='guestTopLinkUser linkCreateKnot mobileLink' v-on:click="showEditProfile">@{{user.name}}</div>
	</div>
	<div class='topNbarHome mobileLinkParent'>
		<div class='guestTopLinkUser linkCreateKnot mobileLinkHome' v-on:click="showManageKnots">Manage Knots</div>
		<div class='guestTopLinkUser linkCreateKnot mobileLinkHome' v-on:click="showEditProfile">@{{user.name}}</div>	
	</div>
	<div class='topNbarUserPublic mobileLinkParent'>
		<div class='guestTopLinkUser linkChangeKnot mobileLink' v-on:click="toChooseKnot">Home</div>
		<div class='guestTopLinkUser linkChangeKnot mobileLink' v-on:click="showCreateEvent">Create Event</div>
		<div class='guestTopLinkUser linkMedia' v-on:click="toMedia">Media</div>
		<div class='guestTopLinkUser linkCreateKnot mobileLink' v-on:click="showEditProfile">@{{user.name}}</div>
	</div>
</div>

