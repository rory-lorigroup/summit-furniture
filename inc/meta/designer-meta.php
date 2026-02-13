<?php

function summit_designer_sorting_meta( $term_id, $taxonomy, $args ){
    if ($taxonomy === 'product-designer') {
		$term = get_term($term_id, 'product-designer');
		$name = $term->name;
		$alpha = explode(' ', $name);
		$alpha_sort = end($alpha);
		update_term_meta($term_id, 'alpha_sort', $alpha_sort);
	}
}
add_action( 'edited_terms', 'summit_designer_sorting_meta', 10, 3 );