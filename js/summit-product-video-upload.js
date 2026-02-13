/**
 * Product Video Media Uploader
 */
(function($) {
	'use strict';

	$(document).ready(function() {
		var videoUploader;
		var posterUploader;

		// Video Upload button click
		$('#summit_upload_video_button').on('click', function(e) {
			e.preventDefault();

			if (videoUploader) {
				videoUploader.open();
				return;
			}

			videoUploader = wp.media({
				title: 'Select Product Video',
				button: {
					text: 'Use this video'
				},
				library: {
					type: 'video'
				},
				multiple: false
			});

			videoUploader.on('select', function() {
				var attachment = videoUploader.state().get('selection').first().toJSON();
				
				$('#summit_product_video_id').val(attachment.id);
				$('#summit-video-preview').html(
					'<video src="' + attachment.url + '" style="max-width: 100%; height: auto;" controls></video>'
				);
				$('#summit_upload_video_button').text('Change Video');
				
				if ($('#summit_remove_video_button').length === 0) {
					$('#summit_upload_video_button').after(
						' <button type="button" class="button" id="summit_remove_video_button" style="color: #a00;">Remove</button>'
					);
				}
			});

			videoUploader.open();
		});

		// Video Remove button click
		$(document).on('click', '#summit_remove_video_button', function(e) {
			e.preventDefault();
			$('#summit_product_video_id').val('');
			$('#summit-video-preview').html('');
			$('#summit_upload_video_button').text('Select Video');
			$(this).remove();
		});

		// Poster Upload button click
		$('#summit_upload_poster_button').on('click', function(e) {
			e.preventDefault();

			if (posterUploader) {
				posterUploader.open();
				return;
			}

			posterUploader = wp.media({
				title: 'Select Video Poster Image',
				button: {
					text: 'Use this image'
				},
				library: {
					type: 'image'
				},
				multiple: false
			});

			posterUploader.on('select', function() {
				var attachment = posterUploader.state().get('selection').first().toJSON();
				
				$('#summit_product_video_poster_id').val(attachment.id);
				$('#summit-poster-preview').html(
					'<img src="' + attachment.url + '" style="max-width: 100%; height: auto;" />'
				);
				$('#summit_upload_poster_button').text('Change Poster');
				
				if ($('#summit_remove_poster_button').length === 0) {
					$('#summit_upload_poster_button').after(
						' <button type="button" class="button" id="summit_remove_poster_button" style="color: #a00;">Remove</button>'
					);
				}
			});

			posterUploader.open();
		});

		// Poster Remove button click
		$(document).on('click', '#summit_remove_poster_button', function(e) {
			e.preventDefault();
			$('#summit_product_video_poster_id').val('');
			$('#summit-poster-preview').html('');
			$('#summit_upload_poster_button').text('Select Poster');
			$(this).remove();
		});
	});
})(jQuery);
