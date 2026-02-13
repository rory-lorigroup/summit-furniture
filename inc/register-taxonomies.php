<?php
/**
 * Custom Product Taxonomies
 *
 * @package Summit_Furniture
 */

/**
 * Generate taxonomy labels array.
 *
 * @param string $singular Singular name for the taxonomy.
 * @param string $plural   Plural name for the taxonomy.
 * @return array Taxonomy labels.
 */
function summit_get_taxonomy_labels( $singular, $plural ) {
	return array(
		/* translators: %s: Taxonomy plural name */
		'name'              => sprintf( _x( '%s', 'Taxonomy general name', 'summit-furniture' ), $plural ),
		/* translators: %s: Taxonomy singular name */
		'singular_name'     => sprintf( _x( '%s', 'Taxonomy singular name', 'summit-furniture' ), $singular ),
		/* translators: %s: Taxonomy plural name */
		'search_items'      => sprintf( __( 'Search %s', 'summit-furniture' ), $plural ),
		/* translators: %s: Taxonomy plural name */
		'all_items'         => sprintf( __( 'All %s', 'summit-furniture' ), $plural ),
		/* translators: %s: Taxonomy singular name */
		'parent_item'       => sprintf( __( 'Parent %s', 'summit-furniture' ), $singular ),
		/* translators: %s: Taxonomy singular name */
		'parent_item_colon' => sprintf( __( 'Parent %s:', 'summit-furniture' ), $singular ),
		/* translators: %s: Taxonomy singular name */
		'edit_item'         => sprintf( __( 'Edit %s', 'summit-furniture' ), $singular ),
		/* translators: %s: Taxonomy singular name */
		'view_item'         => sprintf( __( 'View %s', 'summit-furniture' ), $singular ),
		/* translators: %s: Taxonomy singular name */
		'update_item'       => sprintf( __( 'Update %s', 'summit-furniture' ), $singular ),
		/* translators: %s: Taxonomy singular name */
		'add_new_item'      => sprintf( __( 'Add New %s', 'summit-furniture' ), $singular ),
		/* translators: %s: Taxonomy singular name */
		'new_item_name'     => sprintf( __( 'New %s Name', 'summit-furniture' ), $singular ),
		'menu_name'         => $plural,
	);
}

/**
 * Register custom product taxonomies.
 */
function summit_register_product_taxonomies() {
	// Type taxonomy.
	register_taxonomy(
		'type',
		array( 'product' ),
		array(
			'hierarchical'      => true,
			'labels'            => summit_get_taxonomy_labels( 'Type', 'Types' ),
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
		)
	);

	// Collection taxonomy.
	register_taxonomy(
		'product-collection',
		array( 'product' ),
		array(
			'hierarchical'      => true,
			'labels'            => summit_get_taxonomy_labels( 'Collection', 'Collections' ),
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'collection',
				'with_front' => false,
				'ep_mask'    => EP_ALL,
			),
		)
	);

	// Designer taxonomy.
	register_taxonomy(
		'product-designer',
		array( 'product' ),
		array(
			'hierarchical'      => true,
			'labels'            => summit_get_taxonomy_labels( 'Designer', 'Designers' ),
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'designer',
				'with_front' => false,
				'ep_mask'    => EP_ALL,
			),
		)
	);

	// Fabric Collection taxonomy.
	register_taxonomy(
		'product-fabric-collection',
		array( 'product' ),
		array(
			'hierarchical'      => true,
			'labels'            => summit_get_taxonomy_labels( 'Fabric Collection', 'Fabric Collections' ),
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
		)
	);

	// Finish taxonomy.
	register_taxonomy(
		'product-finish',
		array( 'product' ),
		array(
			'hierarchical'      => true,
			'labels'            => summit_get_taxonomy_labels( 'Finish', 'Finishes' ),
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
		)
	);
}
add_action( 'init', 'summit_register_product_taxonomies' );