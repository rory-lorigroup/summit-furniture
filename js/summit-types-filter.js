/* jQuery */

$(document).ready(function(){
// 	$('li.filter a').on('click', function() {
// 		var filterClass = $(this).attr('filterclass');
// 		$('.summit-type-products-wrap .type-product').show().filter(':not(.' + filterClass +')').hide();
// 	});
// 	
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




