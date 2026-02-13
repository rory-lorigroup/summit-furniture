/* jQuery */

$(document).ready(function(){
	if ( 768 > window.innerWidth  ) {
		var height = '430px';
	} else {
		var height = '315px';
	}
	$('.folder-view-more').on('click', function() {
		if ( $(this).hasClass('viewing-all') ) {
			$(this).removeClass('viewing-all');
			$(this).prev().css('height', height);
		} else {
			$(this).prev().css('height', 'auto');
			$(this).text('View Less');
			$(this).addClass('viewing-all');
		}
	});
	
	$('.summit-single-wishlist button').on('click', function() {
		setTimeout(() => {
			location.reload(true);
		}, 750);
	});
});





