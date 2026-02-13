<?php
/**
 * Template Name: Types Archive
 *
 * @package Summit_Furniture
 */

get_header();
$args = array(
  'taxonomy' => 'type',
  'hide_empty' => false,
  'hierarchical' => false,
  'orderby' => 'meta_value_num',
  'order' => 'ASC',
  'meta_query' => array(
  	array(
        'key' => 'priority',
		'value' => '',
        'compare' => '!=', //or "NOT EXISTS", for non-existence of this key
		'type' => 'NUMERIC',
    ),
    array(
        'key' => 'show_in_types_archive',
        'value' => true,
        'compare' => '=', // Make sure it's set to true
        'type' => 'BOOLEAN'
    )
  ),  
);
$terms = get_terms($args);

?>

	<main id="primary" class="site-main summit-types">
		<div class="summit-types-wrap">
			<header class="summit-furniture-header">
				<h1>
					Types
				</h1>
			</header>
			<div class="summit-types-grid">
		<?php 
		foreach ($terms as $term) {
			$term_link = get_term_link( $term );
			$term_id = $term->term_id;
			$name = $term->name;
			$slug = $term->slug;
			$cover = get_field('type_cover', 'term_' . $term_id);
			?>
			<div class="summit-single-type">
				<a href="<?= $term_link ?>">
					<img src="<?= esc_url($cover); ?>" alt="Cover image for the <?= esc_html($name); ?> Product Type">
				</a>
				<div class="content">
					<h2>
						<a href="<?= $term_link ?>"><?= esc_html($name); ?></a>
					</h2>
				</div>
			</div>
			<?php
		}
		?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();