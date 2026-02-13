<?php
/**
 * The Template for displaying wishlist manage this plugin.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-wishlist-manage.php.
 *
 * @version             2.5.0
 */

/**
 * Template variables.
 *
 * @var array $wishlists Wishlists data.
 * @var string $wl_paged Number of the current page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$current_user = wp_get_current_user();
$assigned_rep = !empty($current_user->assigned_representative) ? $current_user->assigned_representative : '4150';
$email = get_field('email', $assigned_rep);
$type = $current_user->roles[0];
?>
<div class="summit-account summit-folders-archive">
	<header class="summit-account-header">
		<h1>
		<?php esc_html_e( 'My Folders' ); ?>
		</h1>
		<h2>
			<?= esc_html( $current_user->first_name ); ?>
			<?= esc_html( $current_user->last_name ); ?>
		</h2>
	</header>
	<?php foreach ( $wishlists as $wishlist ) {
		?><div class="summit-folder-wrap" data-wishlist-id="<?php echo esc_attr( $wishlist['ID'] ); ?>">
			<div class="summit-manage-folders-header">
			<div title="<?php echo esc_attr( $wishlist['title'] ); ?>" class="folder-anchor wishlist-anchor">
				<?php echo esc_html( $wishlist['title'] ); ?>
			</div>
			<div class="summit-folder-actions">
				<a class="summit-account-btn desktop-btn" href="mailto:<?php echo $email ?>?subject=Estimate requested by <?php echo  $current_user->first_name . ' ' . $current_user->last_name ?> for a saved folder&body=I am requesting an estimate for this folder: https://summitfurniture.com/folders/view/<?= $wishlist['share_key'] ?>. I am a <?php echo $type ?> user.">Request an Estimate</a>
				<a class="summit-account-btn folder-manage desktop-btn" href="/folders/view/<?= $wishlist['share_key'] ?>"><?= esc_html('Manage folder') ?></a>
				<a class="summit-email-share" href="mailto:?subject=View my saved folder on Summit Furniture&body=Please click this link to view my folder: https://summitfurniture.com/folders/view/<?= $wishlist['share_key'] ?>"><img width="25" height="25" src="/wp-content/themes/summit-furniture/img/email.png" alt="Share page via email"/><span class="screen-reader-text">Share page via email.</span></a>
			</div>
			</div>	
			<?php
			$products = tinvwl_get_wishlist_products($wishlist['ID'], array('count' => 9999999));
			$count = count((array)$products);
			if ( !empty($products) ) {
				?>
					<div class="folder-content">
						<?php foreach ($products as $product) {
							$product_ID = $product['product_id'];
							$quantity = $product['quantity'] > 0 ? 'QTY: ' . $product['quantity'] : '';
							?>
							<div id="folder-item folder-item-<?= esc_html($product_ID); ?>" data-row-id="<?= esc_html($product_ID); ?>">
								<div class="item-wrapper">
									<div class="product-thumbnail">
										<?= get_the_post_thumbnail($product_ID); ?>
									</div>
									<div class="item-details">
										<div class="item-details-wrapper">
											<h3 class="product-name"><?= esc_html( get_the_title($product_ID) ); ?></h3>
											<h3 class="product-quant">
												<?= esc_html( $quantity ) ?>
											</h3>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
					?>
					</div>
					<?php 
					if ($count > 4) {
						?>
						<div class="summit-account-btn folder-view-more mobile-btn">
							<?= esc_html_e('View More') ?>	
						</div>
						<?php
					} 
					?>
					<a class="summit-account-btn mobile-btn" href="mailto:<?php echo $email ?>?subject=Estimate requested by <?php echo  $current_user->first_name . ' ' . $current_user->last_name ?> for a saved folder&body=I am requesting an estimate for this folder: https://summitfurniture.com/folders/view/<?= $wishlist['share_key'] ?>. I am a <?php echo $type ?> user.">Request an Estimate</a>
					<a class="summit-account-btn folder-manage mobile-btn" href="/folders/view/<?= $wishlist['share_key'] ?>"><?= esc_html('Manage folder') ?></a>
					<?php
					} else {
					?>
					<div class="folder-content empty">
						<p class="folder-empty">
							<?= esc_html_e('You currently do not have any folders. '); ?>
							<a href="/collections"><?= esc_html_e('Browse our product collections '); ?></a>
							<?= esc_html_e('and save a product to start your first folder.'); ?>
						</p>
					</div>
					<?php
				}
			?>
		</div>
	<?php
	}
	?>
</div>