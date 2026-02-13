<?php
/**
 * The single wishlist/folder.
 *
 * Overridden from TI Wishlist plugin.
 *
 * @version             2.3.3
 * @package           TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$page_title = $wishlist['title'];
$current_user = wp_get_current_user();
$assigned_rep = !empty($current_user->assigned_representative) ? $current_user->assigned_representative : '4150';
$email = get_field('email', $assigned_rep);
$type = $current_user->roles[0];
?>
<div class="summit-single-wishlist-wrap">
	<div class="summit-single-wishlist">
		<header class="summit-account-header">
			<h1>
				<?= $page_title ?>
			</h1>
			<div class="summit-folder-actions">
				<a class="summit-account-btn" href="/folders">Return to All Folders</a>
				<a class="summit-account-btn" href="mailto:<?php echo $email ?>?subject=Estimate requested by <?php echo  $current_user->first_name . ' ' . $current_user->last_name ?> for a saved folder&body=I am requesting an estimate for this folder: https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>. I am a <?php echo $type ?> user.">Request an Estimate</a>
				<a class="summit-email-share" href="mailto:?subject=View my saved folder on Summit Furniture&body=Please click this link to view my folder: https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"><img src="/wp-content/themes/summit-furniture/img/email.png" alt="Share page via email"/><span class="screen-reader-text">Share page via email.</span></a>
			</div>
		</header>
	
	<?php $form_url = tinv_url_wishlist( $wishlist['share_key'], $wl_paged, true ); ?>
	<form action="<?php echo esc_url( $form_url ); ?>" method="post" autocomplete="off" data-tinvwl_sharekey="<?php echo $wishlist['share_key'] ?>">
		<div class="summit-single-wishlist-inner">
			<?php
			global $product, $post;
			// store global product data.
			$_product_tmp = $product;
			// store global post data.
			$_post_tmp = $post;
		
			foreach ( $products as $wl_product ) {

				// override global product data.
				$product = apply_filters( 'tinvwl_wishlist_item', $wl_product['data'] );

				unset( $wl_product['data'] );
				if ( ( $wl_product['quantity'] > 0 ) ) {
					?>
					<table class="folder-hidden-data">
						<tr class="<?php echo esc_attr( apply_filters( 'tinvwl_wishlist_item_class', 'wishlist_item', $wl_product, $product ) ); ?>" data-tinvwl-pid="<?php echo esc_attr( $wl_product['ID'] ); ?>"></tr>
					</table>
					<div class="folder-item" id="folder-item-<?php echo esc_attr( $wl_product['ID'] ); ?>" data-row-id="<?php echo esc_attr( $wl_product['ID'] ); ?>" data-tinvwl-pid="<?php echo esc_attr( $wl_product['ID'] ); ?>">
						<div class="product-remove">
							<button type="submit" name="tinvwl-remove"
									value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
									title="<?php _e( 'Remove', 'ti-woocommerce-wishlist-premium' ) ?>">
								x
							</button>
						</div>
						<?php if ( isset( $wishlist_table_row['colm_image'] ) && $wishlist_table_row['colm_image'] ) { ?>
							<div class="product-thumbnail">
								<?php
								$thumbnail = apply_filters( 'tinvwl_wishlist_item_thumbnail', $product->get_image(), $wl_product, $product );

								if ( ! $product->is_visible() ) {
									echo $thumbnail; // WPCS: xss ok.
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_url ), $thumbnail ); // WPCS: xss ok.
								}
								?>
							</div>
						<?php } ?>
						<div class="item-details">
							<div class="item-details-wrapper">
								<h3 class="product-name" style="margin:0"><?= esc_html( $product->name ); ?></h3>
								<?php if ( $qty ) { 
									if ($current_user->ID === $wishlist['author']) {
									?>
									<div class="product-quant">
									<?php
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "wishlist_qty[{$wl_product['ID']}]",
										'input_value' => $wl_product['quantity'],
										'min_value'   => '0',
									), $product, false );
									echo apply_filters( 'tinvwl_wishlist_item_quantity', $product_quantity, $wl_product, $product ); // WPCS: xss ok.
									?>
								</div>
							<?php } else { ?>
								<h3 class="product-quant" style="margin:0">QTY: <?= esc_html( $wl_product['quantity'] ) ?></h3>
								<?php }
								}
								?>
							</div>
						</div>
					</div>
				<?php
					} // End if().
				} // End foreach().
			// restore global product data.
			$product = $_product_tmp; ?>
		</div>
	</form>
</div>
</div>
