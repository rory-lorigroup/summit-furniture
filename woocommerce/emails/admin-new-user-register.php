<?php
defined( 'ABSPATH' ) || exit;

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email );
$user_id = $email->object->ID;
$user_role = $email->object->roles;
$user_meta = get_user_meta( $user_id );
$approval_link = 'https://summitfurniture.com/wp-admin/users.php?afrfb-status-query-submit=addify-afrfb-fields&action_email=approved&paged=1&user=' . $user_id . '&_wpnonce=99b3ceac9e';
$denial_link = 'https://summitfurniture.com/wp-admin/users.php?afrfb-status-query-submit=addify-afrfb-fields&action_email=disapprove&paged=1&user=' . $user_id . '&_wpnonce=99b3ceac9e';
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
</style>
<div class="email-wrapper">
<?php
if ( in_array('trade', $user_role) ) {
	echo '<h2>' . esc_html('A new user has applied for the Summit Trade Program.') . '</h2>';
	echo '<p>' . esc_html('Please review their details below.') . '</p>';
	$user_state = !empty($user_meta['shipping_state']['0']) ? $user_meta['shipping_state']['0'] . ', ' : '';
	$uk = ['GB', 'UK', 'IE', 'NO', 'CH', 'DK', 'FI', 'DE', 'NL', 'SE', 'AT', 'RU', 'PL', 'HU', 'IS', 'CZ', 'SK', 'MD', 'UA'];
	$monaco = ['MC', 'FR', 'ES', 'PT', 'IT', 'TY', 'GR', 'BE', 'LU', 'HR', 'SI', 'BA', 'RO', 'CS', 'BG', 'CY', 'IL', 'JO', 'SA', 'KW', 'QA', 'AE'];
	if ( !empty($user_meta['shipping_country']['0']) ) {
		$country_string = implode('', $user_meta['shipping_country']);
		if ( in_array($country_string, $uk) ) {
			$routing = 'trade@summitfurniture.co.uk';
		}
		if ( in_array($country_string, $monaco) ) {
			$routing = 'trade@summitfurniture.eu';
		}
		if ( !in_array($country_string, $uk) && !in_array($country_string, $monaco) ) {
			$routing = 'trade@summitfurniture.com';
		}
	}
	?>
	<div class="user-data">
		<p>
			<strong>First Name: </strong>
			<?php echo $user_meta['first_name']['0']; ?>
		</p>
		<p>
			<strong>Last Name: </strong>
			<?php echo $user_meta['last_name']['0']; ?>
		</p>
		<p>
			<strong>Email: </strong>
			<?php echo esc_html( $email->object->user_email ) ?>
		</p>
		<p>
			<strong>Address: </strong>
			<?php echo $user_meta['shipping_address_1']['0'] . ', ' . $user_meta['shipping_city']['0'] . ' ' . $user_state .  ' ' . $user_meta['shipping_country']['0'] . ' ' . $user_meta['shipping_postcode']['0']; ?>
		</p>
		<p>
			<strong>Business Name: </strong>
			<?php echo $user_meta['business_name']['0']; ?>
		</p>
		<p>
			<strong>Resale Certificate: </strong>
			<?php echo $user_meta['retail_cert_number']['0']; ?>
		</p>
		<p>
			<strong>Which Best Describes Your Business: </strong>
			<?php echo str_replace('_', ' ', $user_meta['business_description']['0']); ?>
		</p>
		<p>
			<strong>How Did You Hear About Us: </strong>
			<?php echo str_replace('_', ' ', $user_meta['word_of_mouth']['0']); ?>
		</p>
		<p>
			<a href="<?php echo $approval_link ?>">Approve this user automatically</a>
		</p>
	</div>
	<hr />
	<p>
		This message has been sent to <?php echo $routing ?> for review.
	</p>
	<?php
}
if ( in_array('customer', $user_role) ) {
	echo '<h2>' . esc_html('A new retail user has registered on Summit Furniture. No further action is needed.') . '</h2>';
}
?>
</div>
<?php
