<?php

// Disable WooCommerce Lightbox
function disable_woocommerce_lightbox() {
	remove_theme_support('wc-product-gallery-lightbox');
}
add_action('after_setup_theme', 'disable_woocommerce_lightbox');
 
// Disable cart fragments for better performance
function disable_woocommerce_cart_fragments() { 
   wp_dequeue_script( 'wc-cart-fragments' ); 
}
add_action( 'wp_enqueue_scripts', 'disable_woocommerce_cart_fragments', 11 );

// Remove product page tabs
add_filter( 'woocommerce_product_tabs', 'summit_remove_all_product_tabs', 98 );
function summit_remove_all_product_tabs( $tabs ) {
	unset( $tabs['description'] );
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );
	return $tabs;
}

// Remove breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Resize Thumbnails
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
return array(
'width'  => 200,
		'height' => 200,
		'crop'   => 0,
	);
} );

// Remove default WooCommerce single product summary hooks since we use a custom template
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Remove default related products (handled in custom template)
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/**
 * Insert video poster image as second tile in product gallery
 *
 * @param array $gallery_image_ids Array of gallery image attachment IDs.
 * @return array Modified array with poster inserted as second item.
 */
function summit_insert_video_poster_in_gallery( $gallery_image_ids ) {
	global $product;
	
	if ( ! $product ) {
		return $gallery_image_ids;
	}
	
	$product_id = $product->get_id();
	$poster_id  = get_post_meta( $product_id, '_summit_product_video_poster_id', true );
	
	// If no poster is set, return original gallery
	if ( ! $poster_id ) {
		return $gallery_image_ids;
	}
	
	$poster_id = absint( $poster_id );
	
	// Remove poster from gallery if it already exists to avoid duplicates
	$gallery_image_ids = array_values( array_diff( $gallery_image_ids, array( $poster_id ) ) );
	
	// Insert poster as first gallery item (appears second after featured image)
	array_splice( $gallery_image_ids, 0, 0, $poster_id );
	
	return $gallery_image_ids;
}
add_filter( 'woocommerce_product_get_gallery_image_ids', 'summit_insert_video_poster_in_gallery' );

/**
 * Add video-tile class to second li in flex-control-nav if product has video and poster
 */
function summit_add_video_tile_class() {
	if ( ! is_product() ) {
		return;
	}
	
	global $product;
	
	if ( ! $product ) {
		return;
	}
	
	$poster_id = get_post_meta( $product->get_id(), '_summit_product_video_poster_id', true );
	$video_id  = get_post_meta( $product->get_id(), '_summit_product_video_id', true );
	
	if ( ! $poster_id || ! $video_id ) {
		return;
	}
	?>
	<script>
	jQuery(document).ready(function($) {
		setTimeout(function() {
			$('.flex-control-nav li:nth-child(2)').addClass('video-tile');
		}, 100);
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'summit_add_video_tile_class' );

/**
 * Add video modal to product page if product has a video
 */
function summit_product_video_modal() {
	if ( ! is_product() ) {
		return;
	}
	
	global $product;
	
	if ( ! $product ) {
		return;
	}
	
	$video_id  = get_post_meta( $product->get_id(), '_summit_product_video_id', true );
	
	if ( ! $video_id ) {
		return;
	}
	
	$video_url = wp_get_attachment_url( $video_id );
	
	if ( ! $video_url ) {
		return;
	}
	?>
	<div id="summit-video-modal" class="summit-video-modal">
		<div class="summit-video-modal-overlay"></div>
		<div class="summit-video-modal-content">
			<button class="summit-video-modal-close" aria-label="Close video">&times;</button>
			<video id="summit-modal-video" controls playsinline>
				<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
				Your browser does not support the video tag.
			</video>
		</div>
	</div>
	<style>
		.summit-video-modal {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 99999;
		}
		.summit-video-modal.active {
			display: flex;
			align-items: center;
			justify-content: center;
		}
		body.summit-video-modal-open {
			overflow: hidden;
		}
		.summit-video-modal-overlay {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.85);
		}
		.summit-video-modal-content {
			position: relative;
			width: 90%;
			max-width: 900px;
			z-index: 1;
		}
		.summit-video-modal-content video {
			width: 100%;
			height: auto;
			display: block;
		}
		.summit-video-modal-close {
			position: absolute;
			top: -40px;
			right: 0;
			background: none;
			border: none;
			color: #fff;
			font-size: 32px;
			cursor: pointer;
			padding: 10px;
			line-height: 1;
			-webkit-tap-highlight-color: transparent;
		}
		.summit-video-modal-close:hover,
		.summit-video-modal-close:focus {
			opacity: 0.7;
		}
		@media (max-width: 767px) {
			.summit-video-modal-content {
				width: 95%;
			}
			.summit-video-modal-close {
				top: -45px;
				right: -5px;
				font-size: 40px;
				padding: 15px;
			}
		}
	</style>
	<?php
}
add_action( 'wp_footer', 'summit_product_video_modal' );

