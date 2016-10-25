@if(count($errors))
	<div class="alert alert-danger text-center">
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>
@endif

<div class='topNbarGuest'>
	<div class='guestTopLink linkHome'>Home</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkDiscover'>Discover</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkContact'>Contact</div>
	<div class='topLinkSeperator'>/</div>
	<div class='guestTopLink linkSignup'>Sign Up</div>
</div>


<div class='nbarGuest'>
	<div class='nbarGuestMain'>
		<div class='navLink linkHome'>Home</div>
		<div class='navLink linkDiscover'>Discover</div>
		<div class='navLink linkContact'>Contact</div>
		<div class='navLink linkSignup'>Sign Up</div>
		<div class='closeNbarGuest'>X</div>
	</div>

	@include('auth.register')
	@include('auth.login')
	
</div>