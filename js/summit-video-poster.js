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
		var $body = $( 'body' );

		function openModal() {
			$modal.addClass( 'active' );
			$body.addClass( 'summit-video-modal-open' );
			if ( $video.length && $video[0] ) {
				$video[0].play();
			}
		}

		function closeModal() {
			$modal.removeClass( 'active' );
			$body.removeClass( 'summit-video-modal-open' );
			if ( $video.length && $video[0] ) {
				$video[0].pause();
				$video[0].currentTime = 0;
			}
		}

		// Open modal when video tile is clicked
		$( document ).on( 'click touchend', '.video-tile', function( e ) {
			e.preventDefault();
			e.stopPropagation();
			openModal();
		});

		// Close modal when close button is clicked
		$( '.summit-video-modal-close' ).on( 'click touchend', function( e ) {
			e.preventDefault();
			closeModal();
		});

		// Close modal when overlay is clicked
		$( '.summit-video-modal-overlay' ).on( 'click touchend', function( e ) {
			e.preventDefault();
			closeModal();
		});

		// Close modal on escape key
		$( document ).on( 'keydown', function( e ) {
			if ( e.key === 'Escape' && $modal.hasClass( 'active' ) ) {
				closeModal();
			}
		});
	});

}( jQuery ) );
