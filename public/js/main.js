'use strict';

$('.logo').click(function(){
	$('.topNbarGuest').css('display', 'none');
	$('.TopNbarUser').css('display', 'none');
	$('.nbarGuest').css('display', 'flex');
    $('.nbarUser').css('display', 'flex');
    $('.cover').css('display', 'block');
});

$('.closeNbarGuest').click(function(){
	$('.nbarGuest').css('display', 'none');
	$('.nbarGuestSignup').css('display', 'none');
	$('.nbarGuestLogin').css('display', 'none');
	$('.nbarGuestMain').css('display', 'flex');
	$('.topNbarGuest').css('display', 'flex');
	$('.cover').css('display', 'none');
});

$('.closeNbarChangeKnot').click(function(){
	$('.nbarUser').css('display', 'none');
	$('.nbarUserCreateKnot').css('display', 'none');
	$('.nbarUserJoinKnot').css('display', 'none');
	$('.nbarUserChangeKnot').css('display', 'flex');
	$('.cover').css('display', 'none');
	$('.nbarUserLeaveKnot').css('display', 'none');
});

$('.closeNbarUser').click(function(){
    $('.nbarUser').css('display', 'none');
    $('.nbarUserThreads').css('display', 'none');
    $('.nbarUserMain').css('display', 'flex');
    $('.TopNbarUser').css('display', 'flex');
    $('.cover').css('display', 'none');
});

$('.landingDiscover, .linkDiscover').click(function(){
	$('.landingView').css('display', 'none');
	$('.contactView').css('display', 'none');
	$('.publicGroupView').css('display', 'none');
	$('.discoverView').css('display', 'block');
	$('.logoLine').css('left', '30%');
	$('.nbarGuest').css('left', '30%');
	$('.nbarGuest').css('display', 'none');
	$('.topNbarGuest').css('display', 'flex');
	$('.cover').css('display', 'none');
});

$('.linkHome').click(function(){
	$('.discoverView').css('display', 'none');
	$('.contactView').css('display', 'none');
	$('.publicGroupView').css('display', 'none');
	$('.landingView').css('display', 'flex');
	$('.logoLine').css('left', '50%');
	$('.nbarGuest').css('left', '50%');
	$('.nbarGuest').css('display', 'none');
	$('.topNbarGuest').css('display', 'flex');
	$('.cover').css('display', 'none');
});

$('.linkChangeKnot').click(function(){
    $('.publicUserGroupView').css('display', 'none');
    $('.TopNbarUser').css('display', 'none');
    $('.changeGroupView').css('display', 'flex');
    $('.logoLine').css('left', '50%');
    $('.nbarUser').css('left', '50%');
    $('.nbarUser').css('display', 'none');
    $('.nbarUserMain').css('display', 'none');
    $('.nbarUserChangeKnot').css('display', 'flex');
    $('.mediaView').css('display', 'none');
    $('.cover').css('display', 'none');
});

$('.linkContact').click(function(){
	$('.landingView').css('display', 'none');
	$('.discoverView').css('display', 'none');
	$('.publicGroupView').css('display', 'none');
	$('.contactView').css('display', 'block');
	$('.logoLine').css('left', '30%');
	$('.nbarGuest').css('left', '30%');
	$('.nbarGuest').css('display', 'none');
	$('.topNbarGuest').css('display', 'flex');
	$('.cover').css('display', 'none');
});

$('.publicKnot, .privateKnot, .publicUserKnot').click(function(){
	$('.landingView').css('display', 'none');
    $('.changeGroupView').css('display', 'none');
	$('.discoverView').css('display', 'none');
    $('.nbarUserChangeKnot').css('display', 'none');
    $('.nbarUserMain').css('display', 'flex');
    $('.TopNbarUser').css('display', 'flex');
    $('.publicGroupView').css('display', 'flex');
	$('.publicUserGroupView').css('display', 'flex');
	$('.logoLine').css('left', '60%');
	$('.nbarGuest').css('left', '60%');
	$('.nbarUser').css('left', '60%');
	$('.nbarGuest').css('display', 'none');
    $('.nbarUser').css('display', 'none');
    $('.topNbarGuest').css('display', 'flex');
});

$('.publicKnot').click(function(){
	$('.publicGroupLeft').stop().animate({
	  	scrollTop: $('.publicGroupLeft')[0].scrollHeight
	}, 10);
});

$('.publicUserKnot').click(function(){
	$('.publicUserGroupLeft').stop().animate({
	  	scrollTop: $('.publicUserGroupLeft')[0].scrollHeight
	}, 10);
});

$('.linkSignup, .linkSignupReturn').click(function(){
	$('.nbarGuestMain').css('display', 'none');
	$('.topNbarGuest').css('display', 'none');
	$('.nbarGuest').css('display', 'flex');
	$('.nbarGuestSignup').css('display', 'flex');
	$('.nbarGuestLogin').css('display', 'none');
});

$('.linkLogin').click(function(){
	$('.nbarGuestSignup').css('display', 'none');
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
    $('.nbarUser').css('left', '20%');
    $('.nbarUser').css('display', 'none');
    $('.cover').css('display', 'none');
});

$('.linkUserHome').click(function(){
    $('.publicUserGroupView').css('display', 'flex');
    $('.mediaView').css('display', 'none');
    $('.logoLine').css('left', '60%');
    $('.nbarUser').css('left', '60%');
    $('.nbarUser').css('display', 'none');
    $('.cover').css('display', 'none');
});

$('.linkCreateKnot').click(function(){
	$('.nbarUserChangeKnot').css('display', 'none');
	$('.nbarUserCreateKnot').css('display', 'flex');
});

$('.linkJoinKnot').click(function(){
	$('.nbarUserChangeKnot').css('display', 'none');
	$('.nbarUserJoinKnot').css('display', 'flex');
});

$('.linkLeaveKnot').click(function(){
	$('.nbarUserChangeKnot').css('display', 'none');
	$('.nbarUserLeaveKnot').css('display', 'flex');
});

$('.linkThreads').click(function(){
	$('.nbarUser').css('display', 'flex');
	$('.nbarUserMain').css('display', 'none');
	$('.TopNbarUser').css('display', 'none');
	$('.nbarUserThreads').css('display', 'flex');
});

$('.linkChangeKnotReturn').click(function(){
	$('.nbarUserChangeKnot').css('display', 'flex');
	$('.nbarUserJoinKnot').css('display', 'none');
	$('.nbarUserCreateKnot').css('display', 'none');
	$('.nbarUserLeaveKnot').css('display', 'none');
});

$('.linkUserMainReturn').click(function(){
	$('.nbarUserMain').css('display', 'flex');
	$('.nbarUserThreads').css('display', 'none');
});
