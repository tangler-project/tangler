'use strict';

$('.logo').click(function(){
	$('.nbarGuest').css('display', 'flex');
});

$('.closeNbarGuest').click(function(){
	$('.nbarGuest').css('display', 'none');
	$('.nbarGuestSignup').css('display', 'none');
	$('.nbarGuestLogin').css('display', 'none');
	$('.nbarGuestMain').css('display', 'flex');
});

$('.landingDiscover, .linkDiscover').click(function(){
	$('.landingView').css('display', 'none');
	$('.contactView').css('display', 'none');
	$('.publicGroupView').css('display', 'none');
	$('.discoverView').css('display', 'block');
	$('.logoLine').css('left', '30%');
	$('.nbarGuest').css('left', '30%');
	$('.nbarGuest').css('display', 'none');
});

$('.linkHome').click(function(){
	$('.discoverView').css('display', 'none');
	$('.contactView').css('display', 'none');
	$('.publicGroupView').css('display', 'none');
	$('.landingView').css('display', 'flex');
	$('.logoLine').css('left', '50%');
	$('.nbarGuest').css('left', '50%');
	$('.nbarGuest').css('display', 'none');
});

$('.linkChangeKnot').click(function(){
        $('.publicUserGroupView').css('display', 'none');
        $('.TopNbarUser').css('display', 'none');
        $('.changeGroupView').css('display', 'flex');
        $('.logoLine').css('left', '50%');
        $('.nbarGuest').css('left', '50%');
        $('.nbarGuest').css('display', 'none');
});

$('.linkContact').click(function(){
	$('.landingView').css('display', 'none');
	$('.discoverView').css('display', 'none');
	$('.publicGroupView').css('display', 'none');
	$('.contactView').css('display', 'block');
	$('.logoLine').css('left', '30%');
	$('.nbarGuest').css('left', '30%');
	$('.nbarGuest').css('display', 'none');
});

$('.publicKnot, .privateKnot').click(function(){
	$('.landingView').css('display', 'none');
        $('.changeGroupView').css('display', 'none');
	$('.discoverView').css('display', 'none');
        $('.TopNbarUser').css('display', 'flex');
        $('.publicGroupView').css('display', 'flex');
	$('.publicUserGroupView').css('display', 'flex');
	$('.logoLine').css('left', '60%');
	$('.nbarGuest').css('left', '60%');
	$('.nbarGuest').css('display', 'none');
});

$('.linkSignup').click(function(){
	$('.nbarGuestMain').css('display', 'none');
	$('.nbarGuest').css('display', 'flex');
	$('.nbarGuestSignup').css('display', 'flex');
});

$('.linkLogin').click(function(){
	$('.nbarGuestMain').css('display', 'none');
	$('.nbarGuest').css('display', 'flex');
	$('.nbarGuestLogin').css('display', 'flex');
});

$('.createEventButton').click(function(){
        $('.listOfEvents').css('display', 'none');
        $('.createNewEvent').css('display', 'block');
});

$('.eventBackButton').click(function(){
        $('.createNewEvent').css('display', 'none');
        $('.listOfEvents').css('display', 'block');
});

$('.linkMedia').click(function(){
        $('.publicGroupView').css('display', 'none');
        $('.publicUserGroupView').css('display', 'none');
        $('.mediaView').css('display', 'block');
        $('.logoLine').css('left', '20%');
        $('.nbarGuest').css('left', '20%');
        $('.nbarGuest').css('display', 'none');
});

$('.linkUserHome').click(function(){
        $('.publicUserGroupView').css('display', 'flex');
        $('.mediaView').css('display', 'none');
        $('.logoLine').css('left', '60%');
        $('.nbarGuest').css('left', '60%');
        $('.nbarGuest').css('display', 'none');
});
