<?php
/**
 * Template Name: Summit Fabrics
 *
 * @package Summit_Furniture
 */

get_header();
?>

<?php if ( get_field( 'fabrics_cover' ) ) : ?>
	<img class="fabrics-hero" src="<?php the_field( 'fabrics_cover' ); ?>" alt="Fabrics cover image." />
<?php endif; ?>
<main id="primary" class="site-main summit-interior-fabrics" style="margin-top: 2.5rem">
	<?php
	$terms = get_terms( array( 'taxonomy' => 'product-fabric-collection' ) );
	?>
	<section class="summit-fabrics">
		<header class="summit-furniture-header">
			<h1><?php esc_html_e( 'Fabrics' ); ?></h1>
			<?php echo do_shortcode( '[addtoany]' ); ?>
		</header>
		
<p class="summit-fabrics-download">
  <a href="https://www.summitfurniture.com/wp-content/uploads/FAB-Download.pdf">DOWNLOAD SUMMIT FABRICS</a>
</p>
		

		<div class="summit-tabs-wrap">
			<div class="summit-fabric-tab">
				<span class="summit-endurance-tab">Summit Endurance Fabrics</span>
			</div>
			<div class="summit-fabric-tab">
				<span class="nina-campbell-tab">Nina Campbell Collection</span>
			</div>
			<div class="summit-fabric-tab">
				<span class="ultra-collection-tab">Ultra Collection</span>
			</div>
		</div>

		<!-- Nina Campbell -->
		<div class="summit-fabric-content summit-nina-campbell-fabrics">
			<?php
			if ( $terms && ! is_wp_error( $terms ) ) :
				foreach ( $terms as $term ) :
					$termID   = $term->term_id;
					$termName = $term->name;

					$ncargs = array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => 25,
						'tax_query'      => array(
							array(
								'taxonomy' => 'product-fabric-collection',
								'field'    => 'term_id',
								'terms'    => $termID,
							),
						),
						'meta_query'     => array(
							array(
								'key'   => 'nc_collection',
								'value' => '1',
								'type'  => 'NUMERIC',
							),
						),
					);
					$ncquery = new WP_Query( $ncargs );
					if ( $ncquery->have_posts() ) : ?>
						<div class="fabric-family"><?php echo esc_html( $termName ); ?></div>
						<div class="fabric-group">
							<?php
							while ( $ncquery->have_posts() ) :
								$ncquery->the_post();
								$title = get_the_title();
								?>
								<div class="single-fabric">
									<a href="<?php echo esc_url( get_the_permalink() ); ?>">
										<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="Image of <?php echo esc_attr( $termName . ' ' . $title ); ?>" height="200" width="200" />
										<p><?php echo esc_html( $title ); ?></p>
									</a>
								</div>
							<?php endwhile; ?>
						</div>
					<?php
					endif;
					wp_reset_postdata();
				endforeach;
			endif;
			?>
		</div>

		<!-- Ultra Collection -->
		<div class="summit-fabric-content summit-ultra-collection-fabrics">
			<?php
			if ( $terms && ! is_wp_error( $terms ) ) :
				foreach ( $terms as $term ) :
					$termID   = $term->term_id;
					$termName = $term->name;

					$ultra_args = array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => 25,
						'tax_query'      => array(
							array(
								'taxonomy' => 'product-fabric-collection',
								'field'    => 'term_id',
								'terms'    => $termID,
							),
						),
						'meta_query'     => array(
							array(
								'key'   => 'ultra_collection',
								'value' => '1',
								'type'  => 'NUMERIC',
							),
						),
					);
					$ultra_query = new WP_Query( $ultra_args );
					if ( $ultra_query->have_posts() ) : ?>
						<div class="fabric-family"><?php echo esc_html( $termName ); ?></div>
						<div class="fabric-group">
							<?php
							while ( $ultra_query->have_posts() ) :
								$ultra_query->the_post();
								$title = get_the_title();
								?>
								<div class="single-fabric">
									<a href="<?php echo esc_url( get_the_permalink() ); ?>">
										<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="Image of <?php echo esc_attr( $termName . ' ' . $title ); ?>" height="200" width="200" />
										<p><?php echo esc_html( $title ); ?></p>
									</a>
								</div>
							<?php endwhile; ?>
						</div>
					<?php
					endif;
					wp_reset_postdata();
				endforeach;
			endif;
			?>
		</div>

		<!-- Summit Endurance (exclude Nina & Ultra; allow NOT EXISTS) -->
		<div class="summit-fabric-content summit-endurance-fabrics">
			<?php
			if ( $terms && ! is_wp_error( $terms ) ) :
				foreach ( $terms as $term ) :
					$termID   = $term->term_id;
					$termName = $term->name;

					$seargs = array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => 25,
						'tax_query'      => array(
							array(
								'taxonomy' => 'product-fabric-collection',
								'field'    => 'term_id',
								'terms'    => $termID,
							),
						),
						'meta_query'     => array(
							'relation' => 'AND',
							// Not Nina: either meta not set OR value != 1
							array(
								'relation' => 'OR',
								array(
									'key'     => 'nc_collection',
									'compare' => 'NOT EXISTS',
								),
								array(
									'key'     => 'nc_collection',
									'value'   => '1',
									'compare' => '!=',
									'type'    => 'NUMERIC',
								),
							),
							// Not Ultra: either meta not set OR value != 1
							array(
								'relation' => 'OR',
								array(
									'key'     => 'ultra_collection',
									'compare' => 'NOT EXISTS',
								),
								array(
									'key'     => 'ultra_collection',
									'value'   => '1',
									'compare' => '!=',
									'type'    => 'NUMERIC',
								),
							),
						),
					);

					$sequery = new WP_Query( $seargs );
					if ( $sequery->have_posts() ) : ?>
						<div class="fabric-family"><?php echo esc_html( $termName ); ?></div>
						<div class="fabric-group">
							<?php
							while ( $sequery->have_posts() ) :
								$sequery->the_post();
								$title = get_the_title();
								?>
								<div class="single-fabric">
									<a href="<?php echo esc_url( get_the_permalink() ); ?>">
										<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="Image of <?php echo esc_attr( $termName . ' ' . $title ); ?>" height="200" width="200" />
										<p><?php echo esc_html( $title ); ?></p>
									</a>
								</div>
							<?php endwhile; ?>
						</div>
					<?php
					endif;
					wp_reset_postdata();
				endforeach;
			endif;
			?>
		</div>

	</section>
</main>

<?php
get_footer();
