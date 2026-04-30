/* jQuery */

$(document).ready(function(){
	var $grid = $('.summit-type-products-wrap');
	$grid.isotope({
  		itemSelector: '.type-product',
  		layoutMode: 'masonry',
		masonry: {
            gutter: 20
        }
	});

	// bind filter button click
	$('.summit-filters li').on( 'click', 'a', function() {
	var filterValue = $( this ).attr('filterclass');
	$grid.isotope({ filter: '.'+filterValue });
	});	
});




