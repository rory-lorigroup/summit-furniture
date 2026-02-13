<?php
/**
 * Summit Furniture functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Summit_Furniture
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function summit_furniture_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Summit Furniture, use a find and replace
		* to change 'summit-furniture' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'summit-furniture', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'retail-menu' => esc_html__( 'Retail', 'summit-furniture' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'summit_furniture_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'summit_furniture_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function summit_furniture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'summit_furniture_content_width', 640 );
}
add_action( 'after_setup_theme', 'summit_furniture_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function summit_furniture_scripts() {
	wp_enqueue_style( 'summit-furniture-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'summit-furniture-style', 'rtl', 'replace' );

	wp_enqueue_script( 'summit-furniture-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'summit-furniture-header', get_template_directory_uri() . '/js/summit-header.js', array(), _S_VERSION, true );
	
	/* Typography */
	wp_enqueue_style( 'summit-furniture-typography', get_template_directory_uri() . '/css/summit-typography.css' );
	
	/* Globals */
	wp_enqueue_style( 'summit-furniture-globals', get_template_directory_uri() . '/css/summit-globals.css' );
	
	/* Header */
	wp_enqueue_style( 'summit-furniture-header', get_template_directory_uri() . '/css/summit-header.css' );
	
	/* Footer */
	wp_enqueue_style( 'summit-furniture-footer', get_template_directory_uri() . '/css/summit-footer.css' );
	
	/* Account */
	wp_enqueue_style( 'summit-furniture-account', get_template_directory_uri() . '/css/summit-account.css' );
	wp_enqueue_script( 'summit-furniture-account-js', get_template_directory_uri() . '/js/summit-account.js', array(), _S_VERSION, true );
	
	/* Interior Template */
	if ( is_page_template( 'page-summit-interior.php' ) || is_home() || is_page_template( 'page-summit-interior-dark.php' ) ) {
		wp_enqueue_style( 'summit-furniture-interior', get_template_directory_uri() . '/css/summit-interior-page.css' );
	}
	
	/* Single Product */
	if ( is_product() ) {
		wp_enqueue_style( 'summit-furniture-product-style', get_template_directory_uri() . '/css/summit-product.css' );
	}
	
	/* Collections Archive */
	if ( is_page_template( 'page-collections-archive.php' ) ) {
		wp_enqueue_style( 'summit-furniture-collections-archive', get_template_directory_uri() . '/css/summit-collections-archive.css' );
	}
	
	/* Single Collection */
	if ( is_tax('product-collection') || is_page_template('page-downloads-collection.php') ) {
		wp_enqueue_style( 'summit-furniture-single-collection', get_template_directory_uri() . '/css/summit-single-collection.css' );
	}
	
	/* Stories Archive */
	if ( is_archive('stories') ) {
		wp_enqueue_style( 'summit-furniture-stories-archive', get_template_directory_uri() . '/css/summit-stories-archive.css' );
	}
	
	/* Designers Archive */
	if ( is_page_template( 'page-designers-archive.php' ) ) {
		wp_enqueue_style( 'summit-furniture-designers-archive', get_template_directory_uri() . '/css/summit-designers-archive.css' );
	}
	
	/* Single Designer */
	if ( is_tax('product-designer') ) {
		wp_enqueue_style( 'summit-furniture-single-designer', get_template_directory_uri() . '/css/summit-single-designer.css' );
	}
	
	/* Types Archive */
	if ( is_page_template( 'page-types-archive.php' ) ) {
		wp_enqueue_style( 'summit-furniture-types-archive', get_template_directory_uri() . '/css/summit-types-archive.css' );
	}
	
	/* Single Type */
	if ( is_tax('type') ) {
		wp_enqueue_style( 'summit-furniture-single-type', get_template_directory_uri() . '/css/summit-single-type.css' );
		wp_enqueue_script( 'summit-furniture-type-filter', get_template_directory_uri() . '/js/summit-types-filter.js', array(), _S_VERSION, true );
	}
	
	/* Showrooms */
	if ( is_page_template( 'page-showrooms.php' ) ) {
		wp_enqueue_style( 'summit-furniture-showrooms', get_template_directory_uri() . '/css/summit-showrooms.css' );
	}
	
	/* Registration Styling */
	wp_enqueue_style( 'summit-furniture-registration', get_template_directory_uri() . '/css/summit-registration.css' );
	
	/* Fabrics and Finishes */
	if ( is_page_template( 'page-summit-fabrics.php' ) || is_page_template( 'page-summit-finishes.php' ) ) {
		wp_enqueue_style( 'summit-furniture-fabrics-archive', get_template_directory_uri() . '/css/summit-fabrics-page.css' );
		wp_enqueue_script( 'summit-furniture-product-js', get_template_directory_uri() . '/js/summit-product.js', array(), _S_VERSION, true );
	}
	
	/* Search */
	if ( is_search() ) {
		wp_enqueue_style( 'summit-furniture-search-style', get_template_directory_uri() . '/css/summit-search.css' );
	}
	
	/* Quick Ship */
	if ( is_page_template( 'page-summit-quick-ship.php' ) ) {
		wp_enqueue_style( 'summit-furniture-quick-ship', get_template_directory_uri() . '/css/summit-quick-ship.css' );
	}
	
	/* Slick */
	wp_enqueue_style( 'summit-furniture-slick-theme', get_template_directory_uri() . '/css/slick-theme.css' );
	
	wp_enqueue_script( 'summit-furniture-slick-init', get_template_directory_uri() . '/js/slick-init.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'summit-furniture-jquery-validate', get_template_directory_uri() . '/js/jquery.validate.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'summit-furniture-registration-js', get_template_directory_uri() . '/js/summit-registration.js', array(), _S_VERSION, true );
	
}
add_action( 'wp_enqueue_scripts', 'summit_furniture_scripts' );


/**
 * Admin Scripts
 */
function summit_admin_style(){
    wp_enqueue_style( 'summit-furniture-admin-style', get_template_directory_uri() . '/css/summit-admin.css' );
}
add_action('admin_enqueue_scripts', 'summit_admin_style');

/**
 * Load all PHP files from /inc directory and subdirectories.
 */
foreach ( glob( get_template_directory() . '/inc/{,*/}*.php', GLOB_BRACE ) as $file ) {
	require $file;
}

/**
 * Add WooCommerce support.
 */ 
add_theme_support( 'woocommerce' );
remove_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

function chronicle_custom_fonts( $system_fonts ) {
 
  $system_fonts[ 'Chronicle' ] = array(
    'fallback' => 'Times New Roman, serif',
    'weights' => array(
      '400',
    ),
  );
  return $system_fonts;
 
}
add_filter( 'kadence_blocks_add_custom_fonts', 'chronicle_custom_fonts' );

add_action('wp_head', function() {
	?>
	<script>// Prevent mobile browsers from auto-focusing on input
	document.addEventListener('DOMContentLoaded', function () {
	const input = document.querySelector('#user_login');
	if (input) {
		input.blur(); // force blur in case browser auto-focuses
	}
		
		const input2 = document.querySelector('#user_pass');
	if (input2) {
		input2.blur(); // force blur in case browser auto-focuses
	}
	});
</script>
<?php
});









