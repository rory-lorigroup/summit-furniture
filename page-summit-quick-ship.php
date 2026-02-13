<?php
/**
 * Template Name: Summit Quick Ship
 *
 * @package Summit_Furniture
 */

get_header();
$featured_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>

<main id="primary" class="site-main summit-interior-quick-ship">
	<header>
		<div class="quick-ship-hero-image" style="background-image:url(<?php echo esc_url($featured_image_url); ?>)">
		</div>
		<div class="quick-ship-intro">
			<h1>
				<?= esc_html_e('Quick Ship: In Stock and Project Ready') ?>
			</h1>
			<p>
				<?= esc_html_e('Explore our Quick Ship collection at Summit Furniture, where we offer a wide selection of furniture that\'s immediately available for shipment from the US. This carefully chosen range ensures you receive both quality and style swiftly, without the usual waiting period. Ideal for those urgent redecorating projects or when you\'re keen to quickly enhance your living space. Our Quick Ship service means you can realize your design ambitions without delay, ensuring timely and efficient delivery of your preferred pieces.') ?>
			</p>
		</div>	
	</header>
	<section class="quick-ship-product-grid">
		<?php
			$args = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'meta_query'     => array(
					array(
						'key'     => 'quick_ship',
						'value'   => true, // We're using boolean value directly
						'compare' => '=',   // '=' for true
						'type'    => 'BOOLEAN' // Specify the type as BOOLEAN
					),
				),
				'orderby'        => 'meta_value', // Order by meta value
				'meta_key'       => '_sku', // The meta key for SKU
				'order'          => 'ASC', // Order in ascending order
			);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$permalink = get_permalink();
				$featured_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				echo '<a class="quick-ship-product" href="' . esc_url( $permalink ) . '">';
				if ( $featured_image_url ) {
					echo '<img src="' . esc_url( $featured_image_url ) . '" alt="' . get_the_title() . '">';
				} 
				echo '<h4>' . get_the_title() . '</h4>';
				echo '</a>';

			}
			wp_reset_postdata(); // Reset post data to prevent conflicts
		}
		?>
		</section>
	</main>
	<?php
get_footer();