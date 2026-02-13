<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Summit_Furniture
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TKQQMZML');</script>
	<!-- End Google Tag Manager -->
	
	<!-- jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<!-- Slick slider -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<script type="text/javascript" src="/wp-content/themes/summit-furniture/js/slick.min.js"></script>
	
	<!-- Isotope -->
	<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
	
	<!-- Masonry -->
	<script src="/wp-content/themes/summit-furniture/js/masonry.min.js"></script>
	<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
	
	<!-- Select2 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	
	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '679638279133960');
	fbq('track', 'PageView');
	</script>
	<noscript>
	<img height="1" width="1"
	src="https://www.facebook.com/tr?id=679638279133960&ev=PageView
	&noscript=1"/>
	</noscript>
	<!-- End Meta Pixel Code -->


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<script>
	  fbq('track', 'CompleteRegistration');
	</script>
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKQQMZML"
					  height="0" width="0" style="display:none;visibility:hidden">
		</iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'summit-furniture' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="summit-action-links">
			<div class="summit-search">
				<img class="summit-search-trigger" src="/wp-content/themes/summit-furniture/img/Search.png" height="15" width="15"/>
			</div>
			<div class="summit-translate">
				<?php echo do_shortcode('[gtranslate]'); ?>
			</div>
		</div>
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="/wp-content/themes/summit-furniture/img/summit-logo.png" /></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="/wp-content/themes/summit-furniture/img/summit-logo.png" /></a></p>
				<?php
			endif;
		?>
		</div><!-- .site-branding -->
		<div class="summit-action-links">
			<div class="summit-search mobile-only">
				<img class="summit-search-trigger" src="/wp-content/themes/summit-furniture/img/Search.png" height="15" width="15"/>
			</div>
			<div class="summit-retail-trigger">
				<a href="#">
					<img src="/wp-content/themes/summit-furniture/img/Account.png" height="17.5" width="17.5"/>
				</a>
			</div>
			<div class="summit-translate mobile-only">
				<?php echo do_shortcode('[gtranslate]'); ?>
			</div>
			<button id="summit-menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span><?php esc_html_e( 'Menu', 'summit-furniture' ); ?></span></button>
		</div>
	</header><!-- #masthead -->
	
	<div class="summit-search-form">
<!-- 		<span class="summit-close-form">&#x2715</span> -->
		<?php echo get_search_form(false); ?>
	</div>
	
	<div class="summit-professionals-login">
		<div class="summit-professionals-heading">
			<h2>Trade Account Login</h2>
			<a class="trade-login" href="/trade-account">Join Our Trade Program</a>
		</div>
		<?php 
		$args = array(
			'remember' => false,
        	'label_username' => __( 'Login' ),
        	'label_password' => __( 'Password' ),
    	);
		echo wp_login_form($args); ?>
	</div>
	<div class="summit-retail-login <?php if ( is_user_logged_in() ) { echo esc_html_e('logged-in'); } ?>">
		<?php
		if ( !is_user_logged_in() ) {
		$args = array(
			'remember' => false,
        	'label_username' => __( 'User Name' ),
        	'label_password' => __( 'Password' ),
    	);
		?>
		<div class="login-wrapper">
			<div class="summit-retail-heading">
				<h2>Log In</h2>
			</div>
			<?php echo wp_login_form($args); ?>
			</div>
		<div class="create-account-wrapper">
			<div class="summit-retail-heading">
				<h2>Create An Account</h2>
			</div>
			<div class="create-wrap">
			<p>
				Creating an account will unlock a range of benefits, including the ability to view product pricing, save your favorites, and access a dedicated space for all your account-related information.
			</p>
			<a class="login-btn" href="/retail-account/">Register a Retail Account</a>
			<a class="login-btn" href="/trade-account/">Join our Trade Program</a>
			</div>
		</div>
		<?php
		} else {
			?>
			<div class="summit-account-links">
				<a href="/my-account/">My Dashboard</a>
				<a href="/my-account/edit-account/">Account Information</a>
				<a href="/my-account/addresses/shipping/">Shipping Addresses</a>
				<a href="/folders/">My Folders</a>
			</div>
			<?php
		}
		?>
	</div>
	<nav id="site-navigation" class="main-navigation">
		<div class="summit-menu">
			<span id="close-summit-menu" class="close-menu"></span>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'retail-menu',
						'menu_id'        => 'summit-menu',
					)
				);
				?>
		</div>
	</nav><!-- #site-navigation -->
	
