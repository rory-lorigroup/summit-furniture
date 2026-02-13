<?php

add_filter('woocommerce_save_account_details_required_fields', 'wc_save_account_details_required_fields' );
function wc_save_account_details_required_fields( $required_fields ){
    unset( $required_fields['account_display_name'] );
    return $required_fields;
}

add_action( 'woocommerce_save_account_details', 'summit_save_account_details' );
function summit_save_account_details( $user_id ) {
	update_user_meta( $user_id, 'shipping_phone', wc_clean( $_POST[ 'shipping_phone' ] ) );
}

add_action('user_register', 'add_form_link', 10, 2);
function add_form_link( $user_id, $userdata ) {
    	$country = get_user_meta($user_id, 'shipping_country');
		$country_string = implode('', $country);
		$uk = ['UK', 'IE', 'NO', 'CH', 'DK', 'FI', 'DE', 'NL', 'SE', 'AT', 'RU', 'PL', 'HU', 'IS', 'CZ', 'SK', 'MD', 'UA'];
		$monaco = ['MC', 'FR', 'ES', 'PT', 'IT', 'TY', 'GR', 'BE', 'LU', 'HR', 'SI', 'BA', 'RO', 'CS', 'BG', 'CY', 'IL', 'JO', 'SA', 'KW', 'QA', 'AE'];
		if ( in_array($country_string, $uk) ) {
			update_user_meta( $user_id, 'assigned_representative', '4149' ); // UK
		}
		if ( in_array($country_string, $monaco) ) {
			update_user_meta( $user_id, 'assigned_representative', '4148' ); // Monaco
		}
		if ( !in_array($country_string, $uk) && !in_array($country_string, $monaco) ) {
			update_user_meta( $user_id, 'assigned_representative', '4150' ); // Monterey
		}
}