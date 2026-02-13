<?php
/**
 * Custom Single Product Template
 *
 * This template replaces the default WooCommerce content-single-product.php
 * and consolidates all customizations previously done via hooks in summit-product.php.
 *
 * @package Summit_Furniture
 */

defined( 'ABSPATH' ) || exit;

global $product;

$post_ID         = get_the_ID();
$post_type       = get_field( 'item_type', $post_ID );
$quick_ship      = get_post_meta( $post_ID, 'quick_ship', true );
$product_sku     = get_post_meta( $post_ID, '_sku', true );
$description     = get_the_content();
$terms           = get_the_terms( $post_ID, 'product-collection' );
$collection_slug = '';

if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
	$collection_slug = $terms[0]->slug;
}

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		
		<?php // Quick Ship Tag ?>
		<?php if ( '1' === $quick_ship ) : ?>
			<div class="quick-ship-tag"><?php esc_html_e( 'Quick Ship' ); ?></div>
		<?php endif; ?>

		<?php // Save and Share Buttons ?>
		<div class="summit-save-and-share">
			<a class="summit-email-share" href="mailto:?subject=Check out this product from Summit Furniture&body=https://<?php echo esc_attr( $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ); ?>">
				<img src="/wp-content/themes/summit-furniture/img/email.png" alt="Share page via email"/>
				<span class="screen-reader-text">Share page via email.</span>
			</a>
			<?php if ( is_user_logged_in() ) : ?>
				<?php echo do_shortcode( '[ti_wishlists_addtowishlist] ' ); ?>
			<?php else : ?>
				<img alt="Login" class="product-login retail lazyloaded" data-src="https://summitfurnstg.wpengine.com/wp-content/uploads/Flag.png" src="https://summitfurnstg.wpengine.com/wp-content/uploads/Flag.png">
			<?php endif; ?>
		</div>

		<?php // Product Info Wrapper ?>
		<div class="summit-product">
			
			<?php // Fabric Collection Name ?>
			<?php if ( 'fabric' === $post_type ) : ?>
				<?php
				$fcollection = get_the_terms( $post_ID, 'product-fabric-collection', true );
				if ( $fcollection && ! is_wp_error( $fcollection ) ) :
					$name = join( '', wp_list_pluck( $fcollection, 'name' ) );
				?>
					<h6 class="fabric-coll"><?php echo esc_html( $name ); ?></h6>
				<?php endif; ?>
			<?php endif; ?>

			<?php // Product Title ?>
			<h1 class="product_title entry-title"><?php echo get_the_title( $post_ID ); ?></h1>

			<?php // SKU ?>
			<p class="sku"><?php echo esc_html( $product_sku ); ?></p>

			<?php // Product Description ?>
			<?php if ( ! empty( $description ) ) : ?>
				<div class="summit-product-info">
					<p><?php echo apply_filters( 'the_content', $description ); ?></p>
				</div>
			<?php endif; ?>

			<?php // Toulon Collection Intro ?>
			<?php if ( 'furniture' === $post_type && 'toulon' === $collection_slug ) : ?>
				<p class="summit-toulon-intro">
					<?php
					printf(
						/* translators: %s: Product title */
						'Created with Santa Barbara Designs® for the world\'s most beautiful spaces, the %s is a love letter to light and shadow. The hexagonal canopy floats like a dream above, while nickel-plated fittings shimmer in the sun. Precious metal against warm teak— it\'s a romance of materials that never grows old. This is the shade you fall for at first sight and treasure for a lifetime.',
						esc_html( get_the_title( $post_ID ) )
					);
					?>
				</p>
			<?php endif; ?>

			<?php // Pricing and Login Messaging ?>
			<?php if ( ! is_user_logged_in() ) : ?>
				<?php if ( 'furniture' === $post_type ) : ?>
					<p>To request a quote or place an order, please contact your <a href="/sales" style="text-decoration: underline">Summit Sales Representative.</a>  To receive the benefits of being a Trade Program member, including a special discount on all Summit products, click <a href="/trade-account/" style="text-decoration: underline">here.</a></p>
					<a style="font-weight: bold" href="mailto:sales@summitfurniture.com?subject=Product Inquiry&body=Please send me more information about <?php echo esc_attr( $product_sku ); ?> and information on how to place an order.">Place an order or inquire</a>
					<?php if ( '1' === $quick_ship ) : ?>
						<p><?php esc_html_e( 'All product available through the Quick Ship program is shipped from the US. Contact Summit Sales for information on all our Quick Ship available items.' ); ?></p>
					<?php endif; ?>
				<?php else : ?>
					<a style="font-weight: bold" href="mailto:sales@summitfurniture.com?subject=Sample Request&body=Please send me a sample of <?php echo esc_attr( $product_sku ); ?>.">Request a sample</a>
				<?php endif; ?>
			<?php else : ?>
				<?php if ( 'furniture' === $post_type ) : ?>
					<?php
					$current_user = wp_get_current_user();
					$user_role    = $current_user->roles;
					if ( in_array( 'trade', $user_role, true ) ) :
					?>
						<p>To request a discounted quote as a Trade Program member or to place an order, please contact your <a href="/trade-account/" style="text-decoration: underline">Summit Sales Representative.</a></p>
					<?php else : ?>
						<p>To request a quote or place an order, please contact your <a href="/sales" style="text-decoration: underline">Summit Sales Representative.</a>  To receive the benefits of being a Trade Program member, including a special discount on all Summit products, click <a href="/trade-account/" style="text-decoration: underline">here.</a></p>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- /.summit-product -->

		<?php // Short Collection Description ?>
		<?php
		if ( ! empty( $terms ) && strtolower( $collection_slug ) !== 'toulon' ) :
			$term              = $terms[0];
			$termID            = $term->term_id;
			$short_description = wp_strip_all_tags( get_field( 'archive_content', 'product-collection_' . $termID ) );
			if ( ! empty( $short_description ) ) :
		?>
			<p class="summit-short-collection"><?php echo esc_html( $short_description ); ?></p>
		<?php
			endif;
		endif;
		?>

		<?php // Fabric Details ?>
		<?php if ( 'fabric' === $post_type && ( get_field( 'width' ) || get_field( 'repeat' ) || get_field( 'abrasion' ) ) ) : ?>
			<ul class="summit-fabric-meta">
				<li class="width">Width: <?php the_field( 'width' ); ?></li>
				<li class="repeat">Repeat: <?php the_field( 'repeat' ); ?></li>
				<li class="abrasion">Abrasion: <?php the_field( 'abrasion' ); ?></li>
				<li class="material">Material: <?php the_field( 'fabric_content' ); ?></li>
			</ul>
		<?php endif; ?>

		<?php // Product Meta Section ?>
		<div class="product_meta">

			<?php // Dimensions Dropdown ?>
			<?php
			$post_collection = get_the_terms( $post_ID, 'product-collection' );
			$excluded_collections = array( 'umbrosa', 'santa-barbara-designs', 'toulon' );
			$show_furniture_details = 'furniture' === $post_type && $post_collection && ! is_wp_error( $post_collection ) && ! in_array( $post_collection[0]->slug, $excluded_collections, true );
			?>
			
			<?php if ( $show_furniture_details ) : ?>
				<div class="dimensions summit-dropdown product-details">
					<h4 class="dropdown-toggle open-toggle">Dimensions</h4>
					<div class="dropdown-content open-toggle">
						<?php if ( get_field( 'dimensions_w' ) || get_field( 'dimensions_h' ) || get_field( 'dimensions_d' ) ) : ?>
							<ul class="product-meta">
								<?php if ( get_field( 'dimensions_w' ) ) : ?>
									<li class="width">W <?php the_field( 'dimensions_w' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_d' ) ) : ?>
									<li class="depth">D <?php the_field( 'dimensions_d' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_h' ) ) : ?>
									<li class="height">H <?php the_field( 'dimensions_h' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_diameter' ) ) : ?>
									<li class="height">DIA <?php the_field( 'dimensions_diameter' ); ?></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>

						<?php if ( get_field( 'dimensions_sw' ) || get_field( 'dimensions_sd' ) || get_field( 'dimensions_sh' ) || get_field( 'dimensions_ah' ) ) : ?>
							<ul class="product-meta">
								<?php if ( get_field( 'dimensions_sw' ) ) : ?>
									<li class="seatwidth">SW <?php the_field( 'dimensions_sw' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_sd' ) ) : ?>
									<li class="seatdepth">SD <?php the_field( 'dimensions_sd' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_sh' ) ) : ?>
									<li class="seatheight">SH <?php the_field( 'dimensions_sh' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_ah' ) ) : ?>
									<li class="actualheight">AH <?php the_field( 'dimensions_ah' ); ?></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>

						<?php if ( get_field( 'dimensions_com' ) || get_field( 'dimensions_wt' ) ) : ?>
							<ul class="product-meta">
								<?php if ( get_field( 'dimensions_com' ) ) : ?>
									<li class="com">COM <?php the_field( 'dimensions_com' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_wt' ) ) : ?>
									<li class="weight">Weight <?php the_field( 'dimensions_wt' ); ?></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>

						<?php if ( get_field( 'dimensions_fw' ) || get_field( 'dimensions_fd' ) || get_field( 'dimensions_fh' ) ) : ?>
							<ul class="product-meta">
								<?php if ( get_field( 'dimensions_fw' ) ) : ?>
									<li class="fw">FW <?php the_field( 'dimensions_fw' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_fd' ) ) : ?>
									<li class="fd">FD <?php the_field( 'dimensions_fd' ); ?></li>
								<?php endif; ?>
								<?php if ( get_field( 'dimensions_fh' ) ) : ?>
									<li class="fh">FW <?php the_field( 'dimensions_fh' ); ?></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>

				<?php // Maintenance and Care Dropdown ?>
				<div class="summit-dropdown product-care">
					<h4 class="dropdown-toggle"><?php esc_html_e( 'Maintenance and Care' ); ?></h4>
					<div class="dropdown-content">
						<p><?php esc_html_e( 'Summit furniture is crafted from plantation-grown teak, a uniquely durable hardwood rich in natural oils and silicates. These natural compounds give teak exceptional resistance to moisture, rot, and insects, making it ideal for outdoor environments.' ); ?></p>
						<p><?php esc_html_e( 'Over time, teak undergoes a graceful transformation from its original warm honey brown color to a silvery grey patina. As teak matures, you may observe slight changes in grain, tone, or surface texture. These variations do not affect performance and are part of teak\'s organic evolution.' ); ?></p>
						<p><?php esc_html_e( 'To keep your Summit furniture looking its best, please follow the steps in maintenance and care guide.' ); ?></p>
						<a class="care-download" href="<?php echo esc_url( '/wp-content/themes/summit-furniture/pdf/Summit-Maintenance-and-Care.pdf' ); ?>">
							<?php esc_html_e( 'Download the Complete Guide.' ); ?>
						</a>
					</div>
				</div>

				<?php // Fabrics and Finishes Dropdown ?>
				<?php
				$fabric_terms = get_terms( array( 'taxonomy' => 'product-fabric-collection' ) );
				$interior_finishes = get_terms( array(
					'taxonomy'   => 'product-finish',
					'hide_empty' => false,
					'meta_key'   => 'location',
					'meta_value' => 'interior',
				) );
				$exterior_finishes = get_terms( array(
					'taxonomy'   => 'product-finish',
					'hide_empty' => false,
					'meta_key'   => 'location',
					'meta_value' => 'exterior',
				) );
				?>
				<div class="summit-dropdown fabrics">
					<h4 class="dropdown-toggle">Fabrics and Finishes</h4>
					<div class="dropdown-content">
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
							<div class="summit-fabric-tab">
								<span class="summit-finish-tab">Finishes</span>
							</div>
						</div>

						<?php // Nina Campbell Fabrics ?>
						<div class="summit-fabric-content summit-nina-campbell-fabrics">
							<?php
							if ( $fabric_terms && ! is_wp_error( $fabric_terms ) ) :
								foreach ( $fabric_terms as $term ) :
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
									if ( $ncquery->have_posts() ) :
							?>
									<div class="fabric-family"><?php echo esc_html( $termName ); ?></div>
									<div class="fabric-group">
										<?php while ( $ncquery->have_posts() ) : $ncquery->the_post(); ?>
											<div class="single-fabric">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'thumbnail' ); ?>
													<p><?php the_title(); ?></p>
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

						<?php // Ultra Collection Fabrics ?>
						<div class="summit-fabric-content summit-ultra-collection-fabrics" style="display: none">
							<?php
							if ( $fabric_terms && ! is_wp_error( $fabric_terms ) ) :
								foreach ( $fabric_terms as $term ) :
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
									if ( $ultra_query->have_posts() ) :
							?>
									<div class="fabric-family"><?php echo esc_html( $termName ); ?></div>
									<div class="fabric-group">
										<?php while ( $ultra_query->have_posts() ) : $ultra_query->the_post(); ?>
											<div class="single-fabric">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'thumbnail' ); ?>
													<p><?php the_title(); ?></p>
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

						<?php // Summit Endurance Fabrics ?>
						<div class="summit-fabric-content summit-endurance-fabrics">
							<?php
							if ( $fabric_terms && ! is_wp_error( $fabric_terms ) ) :
								foreach ( $fabric_terms as $term ) :
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
											array(
												'relation' => 'OR',
												array(
													'key'     => 'nc_collection',
													'compare' => 'NOT EXISTS',
												),
												array(
													'key'     => 'nc_collection',
													'value'   => '0',
													'compare' => '=',
													'type'    => 'NUMERIC',
												),
											),
											array(
												'relation' => 'OR',
												array(
													'key'     => 'ultra_collection',
													'compare' => 'NOT EXISTS',
												),
												array(
													'key'     => 'ultra_collection',
													'value'   => '0',
													'compare' => '=',
													'type'    => 'NUMERIC',
												),
											),
										),
									);

									$sequery = new WP_Query( $seargs );
									if ( $sequery->have_posts() ) :
							?>
									<div class="fabric-family"><?php echo esc_html( $termName ); ?></div>
									<div class="fabric-group">
										<?php while ( $sequery->have_posts() ) : $sequery->the_post(); ?>
											<div class="single-fabric">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'thumbnail' ); ?>
													<p><?php the_title(); ?></p>
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

						<?php // Finishes ?>
						<div class="summit-fabric-content summit-finishes">
							<img class="finishes-hero" src="/wp-content/uploads/finishes.webp" />
							<h3><?php esc_html_e( 'Interior' ); ?></h3>
							<div class="finishes-group">
								<?php
								if ( $interior_finishes && ! is_wp_error( $interior_finishes ) ) :
									foreach ( $interior_finishes as $finish ) :
										$finishTermID   = $finish->term_id;
										$finishName     = $finish->name;
										$taxonomy_key   = $finish->taxonomy . '_' . $finishTermID;
										$finishPhoto    = get_field( 'image', $taxonomy_key );
										$termLink       = get_term_link( $finish );
								?>
									<div class="single-finish">
										<a href="<?php echo esc_url( $termLink ); ?>"><img src="<?php echo esc_url( $finishPhoto ); ?>" alt="<?php echo esc_attr( $finishName ); ?>" /></a>
										<div class="fabric-family"><?php echo esc_html( $finishName ); ?></div>
									</div>
								<?php
									endforeach;
								endif;
								?>
							</div>
							<h3><?php esc_html_e( 'Exterior' ); ?></h3>
							<div class="finishes-group">
								<?php
								if ( $exterior_finishes && ! is_wp_error( $exterior_finishes ) ) :
									foreach ( $exterior_finishes as $finish ) :
										$finishTermID   = $finish->term_id;
										$finishName     = $finish->name;
										$taxonomy_key   = $finish->taxonomy . '_' . $finishTermID;
										$finishPhoto    = get_field( 'image', $taxonomy_key );
										$termLink       = get_term_link( $finish );
								?>
									<div class="single-finish">
										<a href="<?php echo esc_url( $termLink ); ?>"><img src="<?php echo esc_url( $finishPhoto ); ?>" alt="<?php echo esc_attr( $finishName ); ?>" /></a>
										<div class="fabric-family"><?php echo esc_html( $finishName ); ?></div>
									</div>
								<?php
									endforeach;
								endif;
								?>
							</div>
						</div>

					</div><!-- /.dropdown-content -->
				</div><!-- /.summit-dropdown.fabrics -->

			<?php endif; // end show_furniture_details ?>

			<?php // 3D Viewer and Resources (Furniture Only) ?>
			<?php if ( 'furniture' === $post_type ) : ?>
				<?php
				$uuid            = get_field( 'uuid' );
				$uuid2           = get_field( 'uuid2' );
				$tearsheet       = get_field( 'tearsheet' );
				$trade_files     = get_field( 'trade_files' );
				$revit           = $trade_files !== null && $trade_files['revit'];
				$cad             = $trade_files !== null && $trade_files['cad'];
				$sketch_up       = $trade_files !== null && $trade_files['sketch_up'];
				$trade_tearsheet = $trade_files !== null && $trade_files['trade_tearsheet'];
				$coll_tearsheet  = $terms ? get_field( 'collection_tearsheet', 'product-collection_' . $terms[0]->term_id ) : '';
				?>
				<div class="summit-3d">
					<?php if ( $uuid ) : ?>
						<div class="summit-3d-viewer" style="min-width:300px;width:100%;height:350px;">
							<sayduck-viewer product="<?php echo esc_attr( $uuid ); ?>" mode="variants" background="#f5f5f5" hide-product-info hide-branding hide-photo-studio hide-embed hide-picker hide-dimensions hide-toggle-lights hide-fullscreen dimensions-on-load></sayduck-viewer>
						</div>
					<?php elseif ( $uuid2 ) : ?>
						<div class="summit-3d-viewer" style="min-width:300px;width:100%;height:350px;">
							<sayduck-viewer product="<?php echo esc_attr( $uuid2 ); ?>" mode="variants" background="#f5f5f5" hide-product-info hide-branding hide-photo-studio hide-embed hide-picker hide-dimensions hide-toggle-lights hide-fullscreen dimensions-on-load></sayduck-viewer>
						</div>
					<?php endif; ?>

					<div class="summit-resources">
						<div class="trade-resources">
							<?php if ( ! empty( $revit ) ) : ?>
								<?php if ( is_user_logged_in() ) : ?>
									<a href="<?php echo esc_url( $trade_files['revit'] ); ?>" target="_blank">Revit</a>
								<?php else : ?>
									<a class="product-login trade">Revit</a>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( ! empty( $cad ) ) : ?>
								<?php if ( is_user_logged_in() ) : ?>
									<a href="<?php echo esc_url( $trade_files['cad'] ); ?>" target="_blank">CAD</a>
								<?php else : ?>
									<a class="product-login trade">CAD</a>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( ! empty( $sketch_up ) ) : ?>
								<?php if ( is_user_logged_in() ) : ?>
									<a href="<?php echo esc_url( $trade_files['sketch_up'] ); ?>" target="_blank">SketchUp</a>
								<?php else : ?>
									<a class="product-login trade">SketchUp</a>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( ! empty( $trade_tearsheet ) ) : ?>
								<?php if ( is_user_logged_in() ) : ?>
									<a href="<?php echo esc_url( $trade_files['trade_tearsheet'] ); ?>" target="_blank">Technical Tear Sheet</a>
								<?php else : ?>
									<a class="product-login trade">Technical Tear Sheet</a>
								<?php endif; ?>
							<?php endif; ?>
						</div>

						<div class="all-resources">
							<?php if ( $terms && 'Umbrosa' === $terms[0]->name ) : ?>
								<a href="/wp-content/themes/summit-furniture/pdf/summit-umbrosa-fabrics.pdf">Download Fabrics Tear Sheet</a>
							<?php else : ?>
								<?php if ( $terms && $terms[0]->slug !== 'santa-barbara-designs' && $terms[0]->slug !== 'toulon' ) : ?>
									<a href="<?php echo esc_url( SUMMIT_FABRICS_FINISHES_PDF_URL ); ?>">Download Fabrics &amp; Finishes</a>
								<?php endif; ?>
								<?php if ( $terms && 'toulon' === $terms[0]->slug ) : ?>
									<a href="<?php echo esc_url( '/wp-content/uploads/Toulon-Regatta-Fabrics-and-Trim.pdf' ); ?>">Download Fabrics &amp; Finishes</a>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( ! empty( $coll_tearsheet ) ) : ?>
								<a href="<?php echo esc_url( $coll_tearsheet ); ?>">Download Collection Brochure</a>
							<?php endif; ?>

							<?php if ( ! empty( $tearsheet ) ) : ?>
								<a href="<?php echo esc_url( $tearsheet ); ?>">Download Tear Sheet</a>
							<?php endif; ?>

							<?php
							$installation_guide = get_field( 'installation_guide' );
							if ( ! empty( $installation_guide ) ) :
							?>
								<a href="<?php echo esc_url( $installation_guide['url'] ); ?>" target="_blank">Installation Guide</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

		</div><!-- /.product_meta -->

	</div><!-- /.summary -->

	<?php // Related Products ?>
	<?php
	if ( 'furniture' === $post_type ) {
		$related_terms  = get_the_terms( $post_ID, 'product-collection' );
		$related_tax    = 'product-collection';
	} else {
		$related_terms  = get_the_terms( $post_ID, 'product-fabric-collection' );
		$related_tax    = 'product-fabric-collection';
	}

	if ( $related_terms && ! is_wp_error( $related_terms ) ) :
		$relatedTermID   = $related_terms[0]->term_id;
		$relatedTermName = $related_terms[0]->name;

		$related_args = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'post__not_in'   => array( $post_ID ),
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => $related_tax,
					'field'    => 'term_id',
					'terms'    => $relatedTermID,
				),
			),
		);

		$related_query = new WP_Query( $related_args );
		if ( $related_query->have_posts() ) :
	?>
		<div class="summit-related-products-wrap">
			<h2>More from the <strong><?php echo esc_html( $relatedTermName ); ?> Collection</strong></h2>
			<div class="summit-related-products">
				<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
					<div class="summit-slide">
						<a href="<?php the_permalink(); ?>" aria-label="Link for <?php the_title_attribute(); ?>">
							<?php the_post_thumbnail( 'medium' ); ?>
						</a>
						<h4><a href="<?php the_permalink(); ?>" aria-label="Link for <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php
		endif;
		wp_reset_postdata();
	endif;
	?>

	<?php // Designer Section ?>
	<?php
	$designer_terms = get_the_terms( $post_ID, 'product-designer' );
	if ( ! empty( $designer_terms ) && ! is_wp_error( $designer_terms ) ) :
		$designerTermID   = $designer_terms[0]->term_id;
		$designerTermName = $designer_terms[0]->name;
	?>
		<div class="summit-designer-wrap">
			<img class="summit-designer-headshot" src="<?php echo esc_url( get_field( 'cover', 'product-designer_' . $designerTermID ) ); ?>" />
			<div class="summit-designer-info">
				<h4 class="summit-designer-name"><?php echo esc_html( $designerTermName ); ?></h4>
				<?php echo get_field( 'content', 'product-designer_' . $designerTermID ); ?>
			</div>
		</div>
	<?php endif; ?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
