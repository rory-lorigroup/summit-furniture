<?php
/**
 * replace the '%product-fabric-collection%' tag with the first 
 * term slug in the fabric collection taxonomy
 * 
 * @wp-hook post_link
 * @param string $permalink
 * @param WP_Post $post
 * @return string
 */
add_filter( 'post_type_link', 'summit_fabrics_permalink', 10, 2 );
function summit_fabrics_permalink( $permalink, $post ) {

    if( $post->post_type == 'product' ) {
      $default_term = 'furniture';
      $terms = wp_get_post_terms( $post->ID, 'product-fabric-collection' );

      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
          $term = $terms[0]->slug;
		  $termwithdash = $term . '-';
          $title = str_replace($termwithdash, '', $post->post_name);
}
      else {
          $term = $default_term;
		  $title = $post->post_name;
}
	  
	  $newStructure = '/' . $term . '/' . $title;
      $permalink = str_replace( '/%product-fabric-collection%/%product%', $newStructure, $permalink );
    }
    return $permalink;
}