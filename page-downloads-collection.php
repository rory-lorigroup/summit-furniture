<?php
/**
 * Template Name: Collection Download
 *
 * @package Summit_Furniture
 */

get_header();
$title = get_the_title();

?>
	<main id="primary" class="site-main summit-collection">
		<header class="summit-furniture-header">
				<h1>
					<?= $title ?>
				</h1>
				<div class="summit-archive-actions">
					<a class="back-to-all-link" href="/downloads/">Return to all downloads</a>
				</div>
		</header>
		<div class="summit-collection-products-wrap summit-downloads">
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
						'taxonomy' => 'product-collection',
						'field' => 'slug',
						'terms' => $title,
					),
				)
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id = get_the_ID();
					$post_thumbnail = get_the_post_thumbnail($post_id);
					$sku = get_post_meta( $post_id, '_sku', true);
					$url = 'https://summitfurniture.com/wp-content/uploads/' . $sku . '.zip';
					$headers = get_headers($url);
					$raw_title = get_the_title();
					$product_title = str_replace($title, '', $raw_title);
			
					if ($headers && strpos($headers[7], '200') !== false) {
					?>
					<a class="summit-btn download-btn" href="<?= $url ?>">
						<h4><?= $product_title ?></h4>
					</a>
					<?php
					}
				}
			}
			?>
		</div>
	</main><!-- #main -->
	<?php
get_footer();