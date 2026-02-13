<?php
/**
 * The Template for displaying empty wishlist.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-wishlist-empty.php.
 *
 * @version             2.5.2
 * @package           TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$page_title = $wishlist['title'];
?>
<div class="summit-single-wishlist-wrap" style="min-height: 44vh;">
	<div class="summit-single-wishlist">
		<div class="folder-empty">
		<?php if ( get_current_user_id() === $wishlist['author'] ) {
			$msg = esc_html__( 'Your {wishlist_title} folder is currently empty.', 'ti-woocommerce-wishlist-premium' );
		} else {
			$msg = esc_html__( 'This {wishlist_title} folder is currently empty.', 'ti-woocommerce-wishlist-premium' );
		}
		echo '<p style="display: block; text-align: center; font-size: 1.5rem;">' . tinvwl_message_placeholders( $msg, null, $wishlist ) . '</p>';
		?>
		<button class="summit-btn" style="color: black; border-color: black; border-width: .5px; display: block; margin: 0 auto;" ><a href="/collections">View all Collections</a></button>
		</div>
	</div>
</div>

	<?php do_action( 'tinvwl_wishlist_is_empty' ); ?>
