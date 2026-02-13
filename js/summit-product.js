/* jQuery */

( function( $ ) {
	
// 	if (window.innerWidth > 767) {
// 		setTimeout(() => {
// 			const imageCount = $('.woocommerce div.product div.woocommerce-product-gallery--with-images');

// 			if (imageCount[0].firstElementChild.className === 'woocommerce-product-gallery__wrapper') {
// 				$('.woocommerce div.product div.images .woocommerce-product-gallery__image a:first-child').append('<a class="summit-gallery-trigger"></a>');
// 				$('a.summit-gallery-trigger').on('click', function() {
// 					$('.woocommerce div.product div.images .woocommerce-product-gallery__image a:first-child').click();
// 				});
// 			} else {
// 				$('.woocommerce div.product div.images div.flex-viewport').append('<a class="summit-gallery-trigger"></a>');
// 				$('a.summit-gallery-trigger').on('click', function() {
// 					$('.flex-active-slide a').click();
// 				});
// 			}
// 		}, 500);
//     }
	
	$('.product-login.retail').on( 'click', function() {
		$('.summit-login-modal.retail').addClass('open-modal');
	});
	
	$('.product-login.trade').on( 'click', function() {
		$('.summit-login-modal.trade').addClass('open-modal');
	});
	
	$(document).mouseup(function(e) {
    	var container = $(".summit-login-modal.open-modal");
    	// if the target of the click isn't the container nor a descendant of the container
    	if (!container.is(e.target) && container.has(e.target).length === 0) {
        	container.removeClass('open-modal');
    	}
	});
	
	
	$('.summit-endurance-tab').on('click', function() {
		$('.summit-nina-campbell-fabrics').css('display', 'none');
		$('.summit-finishes').css('display', 'none');
		$('.summit-ultra-collection-fabrics').css('display', 'none');
		$('.summit-endurance-fabrics').css('display', 'block');
	});
	
	$('.nina-campbell-tab').on('click', function() {
		$('.summit-endurance-fabrics').css('display', 'none');
		$('.summit-ultra-collection-fabrics').css('display', 'none');
		$('.summit-finishes').css('display', 'none');		
		$('.summit-nina-campbell-fabrics').css('display', 'block');
	});
	
	$('.ultra-collection-tab').on('click', function() {
		$('.summit-endurance-fabrics').css('display', 'none');
		$('.summit-finishes').css('display', 'none');		
		$('.summit-nina-campbell-fabrics').css('display', 'none');
		$('.summit-ultra-collection-fabrics').css('display', 'block');
	});
	
	$('.summit-finish-tab').on('click', function() {
		$('.summit-endurance-fabrics').css('display', 'none');
		$('.summit-ultra-collection-fabrics').css('display', 'none');
		$('.summit-nina-campbell-fabrics').css('display', 'none');
		$('.summit-finishes').css('display', 'block');
	});
	
}( jQuery ) );





