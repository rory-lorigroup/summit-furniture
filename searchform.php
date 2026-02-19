<?php
if ( ! function_exists( 'summitIsMobile' ) ) {
	function summitIsMobile() {
		$ua = isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
		return (bool) preg_match( '#(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)#i', $ua );
	}
}

if ( summitIsMobile() === true ) {
	$placeholder = 'Search';
} else {
	$placeholder = 'Enter a product, collection, product type, or designer.';
}
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<img class="summit-search-icon" src="/wp-content/themes/summit-furniture/img/search-white.png" height="25" width="25"/>
    <input class="search-input" type="search" value="" name="s" id="s" placeholder="<?= $placeholder ?>" />
</form>