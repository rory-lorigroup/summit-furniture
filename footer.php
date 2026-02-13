<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Summit_Furniture
 */

?>

	<?php 
	if ( !is_front_page() && !is_home() ) {
		echo do_shortcode('[sfms_signup_form]');
	}
	?>
	<div class="summit-social">
		<a href="https://www.instagram.com/summitfurniture/?hl=en"><img src="/wp-content/themes/summit-furniture/img/instagram.png" /></a>
		<a href="https://www.facebook.com/summitfurnitureinc/photos/"><img src="/wp-content/themes/summit-furniture/img/facebook.png" /></a>
		<a href="https://www.linkedin.com/company/summit-furniture"><img src="/wp-content/themes/summit-furniture/img/linkedin.png" /></a>
	</div>

	<footer id="colophon" class="summit-footer">
		<div class="summit-footer-identity">
			<p class="site-footer-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="/wp-content/themes/summit-furniture/img/summit-logo-white.png" /></a></p>
			<p class="no-translate">
			a landscape forms company<br/>
			<span class="no-translate" style="font-size:11px;">© <?php echo date("Y"); ?>, Landscape Forms, Inc.</span>
			</p>
		</div>
		<div class="summit-footer-menus">
			<ul>
				<li><a href="/collections">Collections</a></li>
				<li><a href="/types">Types</a></li>
			</ul>
			<ul>
				<li><a href="/sales">Sales</a></li>
				<li><a href="/showrooms">Showrooms</a></li>
			</ul>
			<ul>
				<li><a href="/our-heritage">Our Heritage</a></li>
				<li><a href="/quality-and-craftsmanship">Quality &amp; Craftsmanship</a></li>
				<li><a href="/residential-limited-warranty">Residential Warranty</a></li>
				<li><a href="/hospitality-limited-warranty">Contract Warranty</a></li>
			</ul>
			<ul>
				<li><a href="/shipping-and-refund-policy">Shipping &amp; Refund Policy</a></li>
				<li><a href="/privacy">Privacy Policy</a></li>
				<li><a href="/terms-of-service">Terms of Service</a></li>
			</ul>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( is_product() ) {
	$post_ID = get_the_id();
	$post_type = get_field( 'item_type', $post_ID );
	if ('furniture' === $post_type) {
		?>
		<script src="/wp-content/themes/summit-furniture/js/summit-product.js"></script>
		<script src="https://viewer.sayduck.com" type="module" async></script>
		<?php
	} else {
		remove_theme_support( 'wc-product-gallery-lightbox' );
	}
} ?>

<?php if (!is_user_logged_in()) {
	?>
	<div class="summit-login-modal retail">
		<?php wp_login_form(); ?>
		<a class="summit-btn" href="/retail-account">Create an Account</a>
	</div>
	<div class="summit-login-modal trade">
		<h2>
			<?php echo esc_html('Log In or Create an Account to Download') ?>
		</h2>
		<?php wp_login_form(); ?>
		<a class="summit-btn" href="/trade-account">Create an Account</a>
	</div>
	<div class="summit-modal social">
		<?php echo do_shortcode('[sfms_signup_form]'); ?>
	</div>
<?php
} ?>
<script type="text/javascript">
_linkedin_partner_id = "7570841";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(l) {
if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
window.lintrk.q=[]}
var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})(window.lintrk);
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=7570841&fmt=gif" />
</noscript>
<?php wp_footer(); ?>

</body>
</html>
