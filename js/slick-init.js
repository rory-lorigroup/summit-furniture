$(document).ready(function(){
	$('.summit-related-products').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		dots: true,
    	prevArrow: false,
    	nextArrow: false,
		autoplay: true,
		autoplaySpeed: 5000,
		responsive: [
    		{
      			breakpoint: 1024,
      			settings: {
        			slidesToShow: 3,
        			slidesToScroll: 1,
      			},
    		},
			{
      			breakpoint: 480,
      			settings: {
        			slidesToShow: 2,
        			slidesToScroll: 1,
      			},
    		},
		]
	});
	
	$('.collection-cover-slider').slick({
		dots: false,
		arrows: false,
		infinite: true,
		autoplay: true,
		autoplaySpeed: 4000,
		speed: 1000,
		fade: true,
	});
	
	$('.collection-mobile-cover-slider').slick({
		dots: false,
		arrows: false,
		infinite: true,
		autoplay: true,
		autoplaySpeed: 4000,
		speed: 1000,
		fade: true,
	});
});