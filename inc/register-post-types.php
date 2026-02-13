<?php
/**
 * Custom Post Types
 *
 * @package Summit_Furniture
 */

/**
 * Register Representative custom post type.
 */
function summit_register_representative_post_type() {
	$labels = array(
		'name'               => _x( 'Representatives', 'Post type general name', 'summit-furniture' ),
		'singular_name'      => _x( 'Representative', 'Post type singular name', 'summit-furniture' ),
		'menu_name'          => _x( 'Representatives', 'Admin Menu text', 'summit-furniture' ),
		'name_admin_bar'     => _x( 'Representative', 'Add New on Toolbar', 'summit-furniture' ),
		'add_new'            => __( 'Add New', 'summit-furniture' ),
		'add_new_item'       => __( 'Add New Representative', 'summit-furniture' ),
		'new_item'           => __( 'New Representative', 'summit-furniture' ),
		'edit_item'          => __( 'Edit Representative', 'summit-furniture' ),
		'view_item'          => __( 'View Representative', 'summit-furniture' ),
		'all_items'          => __( 'All Representatives', 'summit-furniture' ),
		'search_items'       => __( 'Search Representatives', 'summit-furniture' ),
		'parent_item_colon'  => __( 'Parent Representatives:', 'summit-furniture' ),
		'not_found'          => __( 'No representatives found.', 'summit-furniture' ),
		'not_found_in_trash' => __( 'No representatives found in Trash.', 'summit-furniture' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Sales representatives for Summit Furniture.', 'summit-furniture' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'representative' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-businessman',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'taxonomies'         => array( 'category', 'post_tag' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'representative', $args );
}
add_action( 'init', 'summit_register_representative_post_type' );

/**
 * Register Stories custom post type.
 */
function summit_register_stories_post_type() {
	$labels = array(
		'name'               => _x( 'Stories', 'Post type general name', 'summit-furniture' ),
		'singular_name'      => _x( 'Story', 'Post type singular name', 'summit-furniture' ),
		'menu_name'          => _x( 'Stories', 'Admin Menu text', 'summit-furniture' ),
		'name_admin_bar'     => _x( 'Story', 'Add New on Toolbar', 'summit-furniture' ),
		'add_new'            => __( 'Add New', 'summit-furniture' ),
		'add_new_item'       => __( 'Add New Story', 'summit-furniture' ),
		'new_item'           => __( 'New Story', 'summit-furniture' ),
		'edit_item'          => __( 'Edit Story', 'summit-furniture' ),
		'view_item'          => __( 'View Story', 'summit-furniture' ),
		'all_items'          => __( 'All Stories', 'summit-furniture' ),
		'search_items'       => __( 'Search Stories', 'summit-furniture' ),
		'parent_item_colon'  => __( 'Parent Story:', 'summit-furniture' ),
		'not_found'          => __( 'No stories found.', 'summit-furniture' ),
		'not_found_in_trash' => __( 'No stories found in Trash.', 'summit-furniture' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Stories and articles for Summit Furniture.', 'summit-furniture' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'stories' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-book-alt',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'stories', $args );
}
add_action( 'init', 'summit_register_stories_post_type' );