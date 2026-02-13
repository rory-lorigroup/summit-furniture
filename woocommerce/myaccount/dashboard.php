<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$current_user = wp_get_current_user();
$wc_address_book = WC_Address_Book::get_instance();
$assigned_rep = !empty($current_user->assigned_representative) ? $current_user->assigned_representative : '4150';
$address = get_field('address', $assigned_rep);
$phone = get_field('phone_number', $assigned_rep);
$email = get_field('email', $assigned_rep);
?>
<header class="summit-account-header">
	<h1>
		<?= get_the_title(); ?>
	</h1>
	<h2>
		<?= esc_html( $current_user->first_name ); ?>
		<?= esc_html( $current_user->last_name ); ?>
	</h2>
</header>
<div class="dashboard">
	<div class="summit-info summit-account-info">
		<div>
		<div class="summit-dash-subheader">
			Account Information
		</div>
		<p>
			Manage your profile, password, email, and other personal details.
		</p>
		</div>
		<a class="summit-info summit-account-btn" href="<?= esc_url( wc_get_endpoint_url( 'edit-account' ) ) ?>">Manage Account Information</a>
	</div>
	<div class="summit-info summit-folders-info">
		<div>
		<div class="summit-dash-subheader">
			My Folders
		</div>
			<ul class="summit-dash-folders">
				<?php 
					$wl        = new TInvWL_Wishlist();
					$wishlists = $wl->get_by_user();
					foreach ($wishlists as $wishlist) {
						$folder_items = tinvwl_get_wishlist_products($wishlist['ID'], array('count' => 9999999));
						?>
						<li class="summit-dash-folder">
							<a title="<?php echo esc_attr( $wishlist['title'] ); ?>" class="folder-anchor wishlist-anchor" href="/folders/view/<?= $wishlist['share_key'] ?>">
							<?php echo esc_html( $wishlist['title'] ); ?>
						</a>
						<p>
							<?php 
							$folder_count = !empty($folder_items) ? count($folder_items) : '';
							echo esc_html($folder_count); 
							?>
						</p>
					</li>
					<?php
					}
				?>
			</ul>
		</div>
		<a class="summit-account-btn" href="/folders/">View All Folders</a>
	</div>
<!-- 	<div class="summit-info summit-payment-info">
		<div>
		<div class="summit-dash-subheader">
			Payment Information
		</div>
		<p>
			Manage your credit cards and other payment accounts.
		</p>
		</div>
		<a class="summit-info summit-account-btn" href="#">Update Payment Information</a>
	</div>
	<div class="summit-info summit-orders-info">
		<div>
		<div class="summit-dash-subheader">
			Orders
		</div>
		<p>
			You currently do not have any orders.
		</p>
		</div>
		<a class="summit-info summit-account-btn" href="#">View Orders</a>
	</div> -->
	<div class="summit-info summit-shipping-info">
		<div>
		<div class="summit-dash-subheader">
			Shipping Addresses
		</div>
		<p>
			Manage your shipping addresses.
		</p>
		</div>
		<?php 
 		$wc_address_book->add_additional_address_button( 'shipping' ); 
		?>
	</div>
	<?php
	if ( in_array("trade", $current_user->roles) ) {
		?>
		<div class="summit-info summit-contact-info summit-trade-rep">
		<div class="summit-dash-subheader">
			My Showroom
		</div>
		<div class="contact-group">
			<div class="summit-sales-rep-address">
				<span><?php echo $address ?></span>
			</div>
		</div>
		<div class="contact-group">
			<a style="display:block" href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
			<a style="display:block" href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
		</div>
	</div>
		<?php
	} else {
		?>
		<div class="summit-info summit-contact-info">
		<div class="summit-dash-subheader">
			Customer Support
		</div>
		<div class="contact-info">
		<div class="contact-group">
			<a style="display:block" href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
			<a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
		</div>
		
		<div class="contact-group">
			<h6>
				Customer Service Hours
			</h6>
			<p>
				Monday - Friday, 9 AM – 5 PM PST
			</p>
			<p>
				Saturday &amp; Sunday, 10 AM – 2 PM PST
			</p>
		</div>
		</div>
	</div>
		<?php
	}
	?>
	<span style="height:50px; grid-row: 4; grid-column: 1; background: transparent"></span> <!-- Change back to grid-row: 3 post demo -->
</div>


<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
