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
$term_name = $term->name;
$term_children = get_term_children( $term_id, 'type' );
?>
	<main id="primary" class="site-main summit-type">
		<header class="summit-furniture-header">
			<h1><?= $term_name ?></h1>
			<div class="summit-archive-actions">
				<a class="back-to-all-link" href="/types/">Return to all types</a>
				<?= do_shortcode('[addtoany]'); ?>
			</div>
		</header>
		<?php
		if ( !empty($term_children) ) {
			?>
			<div class="sub-header summit-dropdown">
				<h4 class="dropdown-toggle">
					<?php echo esc_html('Filters') ?>
				</h4>
				<ul class="summit-filters dropdown-content">
					<li class="filter"><a filterclass="chairs"><?php echo esc_html('View All') ?></a></li>
						<?php
						foreach($term_children as $term_child) {
							$child_object = get_term( $term_child );
							$child_name = $child_object->name;
							$child_slug = $child_object->slug;
							echo '<li class="filter"><a filterclass="' . str_replace('-', '', $child_slug) .'">' . $child_name . '</a></li>';
						}	
						?>
				</ul>
			</div>
		<?php
		}
		?>
		<div class="summit-type-products-wrap">
			<?php
			$args = array(
				'post_type' => 'product',
				'tax_query' => array(
					array(
						'taxonomy' => 'type',
						'field' => 'term_id',
						'terms' => array($term_id),
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
					$post_types = get_the_terms( $post_id, 'type' );
					?>
					<div class="type-product
							<?php
							foreach($post_types as $post_type) {
								$type_slug = $post_type->slug;
								echo str_replace('-', '', $type_slug) . ' ';
							} ?>
								">
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
	</main><!-- #main -->
	<?php
get_footer();