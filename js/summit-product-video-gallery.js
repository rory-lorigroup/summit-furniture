/**
 * Product Video Gallery - Frontend
 */
(function($) {
	'use strict';

	function initVideoGallery() {
		var $thumbs = $('.flex-control-thumbs li');
		var $videoSlide = $('.summit-product-video-slide');
		
		if (!$thumbs.length || !$videoSlide.length) {
			return false;
		}

		// Find video slide index within the gallery wrapper
		var $galleryWrapper = $('.woocommerce-product-gallery__wrapper');
		var videoIndex = $galleryWrapper.children().index($videoSlide);
		
		// Add play icon class to video thumbnail
		$thumbs.eq(videoIndex).addClass('summit-video-thumb');

		// Click handler for video thumbnail
		$thumbs.eq(videoIndex).on('click', function() {
			setTimeout(function() {
				var video = $videoSlide.find('video')[0];
				if (video) {
					video.muted = true; // Mute for autoplay policy
					var playPromise = video.play();
					if (playPromise !== undefined) {
						playPromise.then(function() {
							video.muted = false; // Unmute after play starts
						}).catch(function(error) {
							console.log('Video autoplay prevented:', error);
						});
					}
				}
			}, 300);
		});

		// Pause video when clicking other thumbnails
		$thumbs.not('.summit-video-thumb').on('click', function() {
			var video = $videoSlide.find('video')[0];
			if (video) {
				video.pause();
			}
		});

		return true;
	}

	$(document).ready(function() {
		// Try immediately
		if (!initVideoGallery()) {
			// If flexslider not ready, wait and retry
			var checkInterval = setInterval(function() {
				if (initVideoGallery()) {
					clearInterval(checkInterval);
				}
			}, 200);

			// Stop trying after 5 seconds
			setTimeout(function() {
				clearInterval(checkInterval);
			}, 5000);
		}
	});
})(jQuery);
