<?php
/**
 * The Template for displaying dialog for add to wishlist product.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-addtowishlist-dialogbox.php.
 *
 * @version             1.21.3
 * @package           TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="tinvwl_add_to_select_wishlist tinv-modal">
	<div class="tinv-overlay"></div>
	<div class="tinv-table">
		<div class="tinv-cell">
			<div class="tinv-modal-inner summit-modal">
				<button class="summit-modal-close button tinvwl-button tinvwl_button_close" type="button"><span>&#10005;</span>
				</button>
				<img class="summit-modal-icon" src="https://summitfurnstg.wpengine.com/wp-content/uploads/Flag.png" alt="Add to Folder">
				<?php
					$product = get_queried_object();
					$id = $product->ID;
					$title = $product->post_title;
					echo get_the_post_thumbnail( $id );
					echo '<p class="product-title">' . esc_html( $title ) . '</p>';
				?>
				<label>
					<p style="margin-bottom: 0;">
						Save to:
					</p>
					<select class="summit-hide-blank tinvwl_wishlist"></select>
				</label>
				<input class="summit-new-folder tinvwl_new_input" type="text" value="" placeholder="Create New"/>
				<button class="summit-folder-add-button button tinvwl-button tinvwl_button_add" type="button"><?php echo wp_kses_post( tinv_get_option( 'add_to_wishlist' . ( $loop ? '_catalog' : '' ), 'text' ) ); ?>
				</button>
			</div>
		</div>
	</div>
</div>
