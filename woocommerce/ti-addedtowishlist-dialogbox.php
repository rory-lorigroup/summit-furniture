<?php
/**
 * The Template for displaying dialog for message added to wishlist product.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-addedtowishlist-dialogbox.php.
 *
 * @version             2.5.0
 * @package           TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="tinvwl_added_to_wishlist tinv-modal tinv-modal-open">
	<div class="tinv-overlay"></div>
	<div class="tinv-table">
		<div class="tinv-cell">
			<div class="tinv-modal-inner summit-modal">
				<button class="summit-modal-close button tinvwl-button tinvwl_button_close" type="button"><span>&#10005;</span>
				</button>
				<img class="summit-modal-icon" src="/wp-content/uploads/Flag.png" alt="Add to Folder">
				<p class="product-title"><?php echo $msg; // WPCS: xss ok. ?></p>
				<?php if ( isset( $dialog_custom_url ) && isset( $dialog_custom_html ) ) : ?>
						<button class="button tinvwl-button tinvwl_button_view tinvwl-btn-onclick"
								data-url="<?php echo esc_url( $dialog_custom_url ); ?>"
								type="button"><?php echo $dialog_custom_html; // WPCS: xss ok. ?></button>
					<?php endif; ?>
					<button class="button summit-folder-add-button tinvwl-button tinvwl_button_close" type="button"><?php esc_html_e( 'Close', 'ti-woocommerce-wishlist-premium' ); ?>
					</button>
			</div>
		</div>
	</div>
</div>