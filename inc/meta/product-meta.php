<?php

if ( ! defined( 'SUMMIT_FABRICS_FINISHES_PDF_URL' ) ) {
    define( 'SUMMIT_FABRICS_FINISHES_PDF_URL', 'https://www.summitfurniture.com/wp-content/uploads/FAB-Download.pdf' );
}

/**
 * Add Product Video Custom Field
 */

// Add meta box for product video
function summit_add_product_video_meta_box() {
	add_meta_box(
		'summit_product_video',
		__( 'Product Video', 'summit-furniture' ),
		'summit_product_video_meta_box_callback',
		'product',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'summit_add_product_video_meta_box' );

// Enqueue media uploader scripts
function summit_enqueue_product_video_scripts( $hook ) {
	global $post;
	
	if ( $hook === 'post.php' || $hook === 'post-new.php' ) {
		if ( isset( $post ) && $post->post_type === 'product' ) {
			wp_enqueue_media();
			wp_enqueue_script(
				'summit-product-video-upload',
				get_template_directory_uri() . '/js/summit-product-video-upload.js',
				array( 'jquery' ),
				'1.0.0',
				true
			);
		}
	}
}
add_action( 'admin_enqueue_scripts', 'summit_enqueue_product_video_scripts' );

// Meta box callback function
function summit_product_video_meta_box_callback( $post ) {
	wp_nonce_field( 'summit_save_product_video', 'summit_product_video_nonce' );
	
	$video_id = get_post_meta( $post->ID, '_summit_product_video_id', true );
	$video_url = $video_id ? wp_get_attachment_url( $video_id ) : '';
	$poster_id = get_post_meta( $post->ID, '_summit_product_video_poster_id', true );
	$poster_url = $poster_id ? wp_get_attachment_image_url( $poster_id, 'medium' ) : '';
	?>
	<div class="summit-product-video-field">
		<!-- Video Field -->
		<p><strong><?php esc_html_e( 'Video', 'summit-furniture' ); ?></strong></p>
		<input type="hidden" id="summit_product_video_id" name="summit_product_video_id" value="<?php echo esc_attr( $video_id ); ?>" />
		
		<div id="summit-video-preview" style="margin-bottom: 10px;">
			<?php if ( $video_url ) : ?>
				<video src="<?php echo esc_url( $video_url ); ?>" style="max-width: 100%; height: auto;" controls></video>
			<?php endif; ?>
		</div>
		
		<p>
			<button type="button" class="button" id="summit_upload_video_button">
				<?php echo $video_id ? esc_html__( 'Change Video', 'summit-furniture' ) : esc_html__( 'Select Video', 'summit-furniture' ); ?>
			</button>
			<?php if ( $video_id ) : ?>
				<button type="button" class="button" id="summit_remove_video_button" style="color: #a00;">
					<?php esc_html_e( 'Remove', 'summit-furniture' ); ?>
				</button>
			<?php endif; ?>
		</p>
		
		<hr style="margin: 15px 0;" />
		
		<!-- Poster Field -->
		<p><strong><?php esc_html_e( 'Video Poster Image', 'summit-furniture' ); ?></strong></p>
		<input type="hidden" id="summit_product_video_poster_id" name="summit_product_video_poster_id" value="<?php echo esc_attr( $poster_id ); ?>" />
		
		<div id="summit-poster-preview" style="margin-bottom: 10px;">
			<?php if ( $poster_url ) : ?>
				<img src="<?php echo esc_url( $poster_url ); ?>" style="max-width: 100%; height: auto;" />
			<?php endif; ?>
		</div>
		
		<p>
			<button type="button" class="button" id="summit_upload_poster_button">
				<?php echo $poster_id ? esc_html__( 'Change Poster', 'summit-furniture' ) : esc_html__( 'Select Poster', 'summit-furniture' ); ?>
			</button>
			<?php if ( $poster_id ) : ?>
				<button type="button" class="button" id="summit_remove_poster_button" style="color: #a00;">
					<?php esc_html_e( 'Remove', 'summit-furniture' ); ?>
				</button>
			<?php endif; ?>
		</p>
		<p class="description"><?php esc_html_e( 'This image will be shown as the thumbnail in the gallery.', 'summit-furniture' ); ?></p>
	</div>
	<?php
}

// Save product video meta
function summit_save_product_video( $post_id ) {
	// Check nonce
	if ( ! isset( $_POST['summit_product_video_nonce'] ) || ! wp_verify_nonce( $_POST['summit_product_video_nonce'], 'summit_save_product_video' ) ) {
		return;
	}
	
	// Check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	// Check permissions
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	// Save the video attachment ID
	if ( isset( $_POST['summit_product_video_id'] ) ) {
		$video_id = absint( $_POST['summit_product_video_id'] );
		if ( $video_id ) {
			update_post_meta( $post_id, '_summit_product_video_id', $video_id );
		} else {
			delete_post_meta( $post_id, '_summit_product_video_id' );
		}
	}
	
	// Save the poster attachment ID
	if ( isset( $_POST['summit_product_video_poster_id'] ) ) {
		$poster_id = absint( $_POST['summit_product_video_poster_id'] );
		if ( $poster_id ) {
			update_post_meta( $post_id, '_summit_product_video_poster_id', $poster_id );
		} else {
			delete_post_meta( $post_id, '_summit_product_video_poster_id' );
		}
	}
}
add_action( 'save_post_product', 'summit_save_product_video' );

// Helper function to get product video URL
function summit_get_product_video( $product_id = null ) {
	if ( ! $product_id ) {
		$product_id = get_the_ID();
	}
	$video_id = get_post_meta( $product_id, '_summit_product_video_id', true );
	return $video_id ? wp_get_attachment_url( $video_id ) : '';
}
