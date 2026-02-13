/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = document.getElementById( 'summit-menu-toggle' );
	
	const closeButton = document.getElementById( 'close-summit-menu' );
	
	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );
		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );
	
	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	closeButton.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );
		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );
	
	// If menu is open and they click outside it, close it.
	document.body.addEventListener('click', function( event ){
		if ( siteNavigation.classList.contains('toggled') ) {
			if (!siteNavigation.contains(event.target) && !button.contains(event.target) ) {
				siteNavigation.classList.remove('toggled');
			}
		}
	});

}() );
