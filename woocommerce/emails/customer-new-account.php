<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 6.0.0
 */

defined( 'ABSPATH' ) || exit;
$user_role = $email->object->roles;
?>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
	a,
	h2,
	p,
	span {
		font-family: 'Roboto', sans-serif;
	}
	.email-wrapper {
		padding: 50px;
	}
	a.logo {
		width: 50%; 
		display: block; 
		margin: 0 auto 50px;
	}
	img.header-img {
		width: 100%; 
		display: block; 
		margin: 0 auto 25px;
	}
	h2 {
		color: white; 
		font-weight: 100; 
		text-align: center;
		font-size: 28px;
	}
	p {
		font-weight: 100;
		color: white;
		font-size: 15px;
	}
	.customer-tiles {
		max-width: 90%;
		margin: 0 auto 25px;
	}
	.customer-tiles td {
		padding: .5rem;
	}
	.customer-tiles a {
		width: 175px;
		display: block;
		background: white;
	}
	.customer-tiles span {
		height: 30px;
		font-size: 14px;
		color: #000;
		line-height: 28px;
	}
	.customer-tiles img {
		height: 175px;
		width: 175px;
		object-fit: cover;
	}
	a.customer-cta {
		font-size: 14px;
		text-decoration: none;
		margin-bottom: 50px;
		display: block;
	}
</style>
<div class="email-wrapper">
	<a class="logo" href="https://www.summitfurniture.com">
		<img src="https://summitfurnstg.wpengine.com/wp-content/themes/summit-furniture/img/summit-logo-white.png" />
	</a>
<?php
if ( in_array('trade', $user_role) ) {
	echo '<img class="header-img" src="https://summitfurnstg.wpengine.com/wp-content/uploads/tk1-2048x1114.webp" />';
	echo '<h2>' . esc_html('Thank you for your interest in the Summit Furniture trade program.') . '</h2>';
	echo '<p>' . esc_html('A sales representative will reply to you shortly.') . '</p>';
}
if ( in_array('customer', $user_role) ) {
	echo '<h2>' . esc_html('Thank you creating an account with Summit Furniture.') . '</h2>';
	echo '<a class="customer-cta" href="https://summitfurniture.com">' . esc_html('Log in to see pricing and access all your Summit Furniture account features.') . '</a>';
	?>
	<table class="customer-tiles">
		<tbody>
			<tr>
				<td>
					<a href="https://summitfurniture.com/collections"><img src="https://summitfurnstg.wpengine.com/wp-content/uploads/SUMMMIT-MODULAR-CM.webp" /><span>Collections</span></a>
				</td>
				<td>
					<a href="https://summitfurniture.com/our-story"><img src="https://summitfurnstg.wpengine.com/wp-content/uploads/SF-A-B-scaled.webp" /><span>Our Story</span></a>
				</td>
				<td>
					<a href="https://summitfurniture.com/quality-and-craftsmanship"><img src="https://summitfurnstg.wpengine.com/wp-content/uploads/QC2-scaled.webp" /><span>Quality & Craftsmanship</span></a>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}
?>
	<div class="footer">
		<!-- add icons here -->
	</div>
</div>
<?php
