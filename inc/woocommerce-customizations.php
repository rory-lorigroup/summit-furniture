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