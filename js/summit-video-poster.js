/**
 * Summit Video Poster Gallery Script
 *
 * Prevents video poster thumbnail from triggering carousel slide change.
 *
 * @package Summit_Furniture
 */

( function( $ ) {
	'use strict';

	$( document ).ready( function() {
		var $modal = $( '#summit-video-modal' );
		var $video = $( '#summit-modal-video' );

		// Open modal when video tile is clicked
		$( document ).on( 'click', '.video-tile', function( e ) {
			e.preventDefault();
			e.stopPropagation();
			$modal.addClass( 'active' );
			$video[0].play();
		});

		// Close modal when close button is clicked
		$( '.summit-video-modal-close' ).on( 'click', function() {
			$modal.removeClass( 'active' );
			$video[0].pause();
			$video[0].currentTime = 0;
		});

		// Close modal when overlay is clicked
		$( '.summit-video-modal-overlay' ).on( 'click', function() {
			$modal.removeClass( 'active' );
			$video[0].pause();
			$video[0].currentTime = 0;
		});

		// Close modal on escape key
		$( document ).on( 'keydown', function( e ) {
			if ( e.key === 'Escape' && $modal.hasClass( 'active' ) ) {
				$modal.removeClass( 'active' );
				$video[0].pause();
				$video[0].currentTime = 0;
			}
		});
	});

}( jQuery ) );
