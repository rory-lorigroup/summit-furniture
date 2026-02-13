<?php
/**
 * The template for the Summit Product Collections.
 *
 *
 * @package Summit_Furniture
 */

get_header();
$term 	 = get_queried_object();
$term_id = $term->term_id;
$designer_name = $term->name;
$designer_headshot = get_field('cover', 'term_' . $term_id);
$designer_bio = get_field('content', 'term_' . $term_id);
?>
	<div class="summit-designer">
		<div class="summit-designer-info">
			<h4 class="summit-designer-name"><?php echo $designer_name ?></h4>
			<?= $designer_bio ?>
		</div>
		<img class="summit-designer-headshot" src="<?= esc_url($designer_headshot) ?>" />
	</div>
	<main id="primary" class="site-main summit-designer-products">
		<div class="summit-designer-products-wrap">
			<?php
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
				'meta_key'   => '_sku',
    			'post_status' => 'publish',
    			'orderby'    => 'meta_value',
    			'order'      => 'ASC',
    			'meta_query' => array(
        			array(
            			'key'     => '_sku',
            			'compare' => 'EXISTS',
        			),
    			),
				'tax_query' => array(
					array(
						'taxonomy' => 'product-designer',
						'field' => 'term_id',
						'terms' => $term_id,
					),
				)
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id = get_the_ID();
					$post_thumbnail = get_the_post_thumbnail($post_id);
					$permalink = get_the_permalink();
					?>
					<div class="designer-product">
						<a href="<?= $permalink?>">
							<?= $post_thumbnail; ?>
							<h4><?= get_the_title(); ?></h4>
						</a>
					</div>
				<?php
				}
			}
			?>
		</div>
		<a class="back-to-all-link" href="/designers/">Return to all designers</a>
	</main><!-- #main -->
	<?php
get_footer();