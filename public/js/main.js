'use strict';

$('.logo').click(function(){
	$('.topNbarGuest').css('display', 'none');
	$('.TopNbarUser').css('display', 'none');
	$('.nbarGuest').css('display', 'flex');
    $('.nbarUser').css('display', 'flex');
    $('.cover').css('display', 'block');
});

