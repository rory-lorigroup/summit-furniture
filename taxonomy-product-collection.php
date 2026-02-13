<?php
/**
 * The template for the Summit Product Collections.
 *
 * @package Summit_Furniture
 */

get_header();
$term                  = get_queried_object();
$term_id               = $term->term_id;
$term_name             = $term->name;
$is_cover_gallery      = get_field( 'collection_cover_slideshow', 'term_' . $term_id );
$collection_cover      = get_field( 'collection_cover', 'term_' . $term_id );
$collection_mobile_cover           = get_field( 'collection_mobile_cover', 'term_' . $term_id );
$collection_cover_gallery          = get_field( 'collection_cover_gallery', 'term_' . $term_id );
$collection_mobile_cover_gallery   = get_field( 'collection_cover_mobile_gallery', 'term_' . $term_id );
$collection_content                = get_field( 'content', 'term_' . $term_id );
$collection_gallery                = get_field( 'collection_gallery', 'term_' . $term_id );
$collection_tearsheet              = get_field( 'collection_tearsheet', 'term_' . $term_id );

// Defaults for designer fields.
$collection_designer_id        = '';
$collection_designer_headshot  = '';
$collection_designer_bio       = '';
$collection_designer_name      = '';

if ( $term_name !== 'Summit Classics' ) {
	$collection_designer_id = get_field( 'collection_designer', 'term_' . $term_id );

	if ( ! empty( $collection_designer_id ) ) {
		$collection_designer_headshot = get_field( 'cover', 'term_' . $collection_designer_id );
		$collection_designer_bio      = get_field( 'content', 'term_' . $collection_designer_id );

		$designer_term = get_term( $collection_designer_id );
		if ( $designer_term && ! is_wp_error( $designer_term ) ) {
			$collection_designer_name = $designer_term->name;
		}
	}
}

// Handy flag for later.
$has_collection_designer = ! empty( $collection_designer_id ) && ! empty( $collection_designer_name );
?>

<?php
if ( $is_cover_gallery === true ) {
	?>
	<div class="collection-cover-slider">
		<?php foreach ( $collection_cover_gallery as $cover ) : ?>
			<img src="<?= esc_url( $cover['url'] ); ?>" alt="<?= esc_attr( $cover['alt'] ); ?>">
		<?php endforeach; ?>
	</div>

	<div class="collection-mobile-cover-slider">
		<?php foreach ( $collection_mobile_cover_gallery as $cover ) : ?>
			<img src="<?= esc_url( $cover['url'] ); ?>" alt="<?= esc_attr( $cover['alt'] ); ?>">
		<?php endforeach; ?>
	</div>
	<?php
} else {
	echo '<img class="collection-cover" src="' . esc_url( $collection_cover ) . '" />';
	echo '<img class="collection-cover mobile" src="' . esc_url( $collection_mobile_cover ) . '" />';
}
?>
<main id="primary" class="site-main summit-collection">
	<header class="summit-furniture-header">
		<?php
		$term      = get_queried_object();
		$term_slug = isset( $term->slug ) ? $term->slug : '';

		if ( $term_slug === 'santa-barbara-designs' ) {
			echo '<h1>Santa Barbara Designs<sup>®</sup></h1>';
		} else {
			echo '<h1>' . esc_html( $term->name ) . '</h1>';
		}
		?>
		<div class="summit-archive-actions">
			<a class="back-to-all-link" href="/collections/">Return to all collections</a>
			<?= do_shortcode( '[addtoany]' ); ?>
		</div>
	</header>

	<div class="summit-collection-info">
		<?= wp_kses_post( $collection_content ); ?>
		<?php
		if ( $collection_tearsheet ) {
			echo '<a class="collection-tearsheet" href="' . esc_url( $collection_tearsheet ) . '">Download Collection Brochure</a>';
		}
		?>
	</div>

	<?php
	$args  = array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'meta_key'       => '_sku',
		'post_status'    => 'publish',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => '_sku',
				'compare' => 'EXISTS',
			),
		),
		'tax_query'      => array(
			array(
				'taxonomy' => 'product-collection',
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		),
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		echo '<div class="summit-collection-products-wrap">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id        = get_the_ID();
			$post_thumbnail = get_the_post_thumbnail( $post_id );
			$permalink      = get_the_permalink();
			?>
			<div class="collection-product">
				<a href="<?= esc_url( $permalink ); ?>">
					<?= $post_thumbnail; ?>
					<h4><?= esc_html( get_the_title() ); ?></h4>
				</a>
			</div>
			<?php
		}
		echo '</div>';
	}
	?>

	<?php if ( ! empty( $collection_gallery ) ) : ?>
		<div class="collection-gallery-spacer spacer-top"></div>
		<div class="collection-gallery">
			<?php
			foreach ( $collection_gallery as $gallery ) {
				$width    = $gallery['width'];
				$height   = $gallery['height'];
				$img_type = intval( $width ) > intval( $height ) ? 'landscape' : 'portrait';
				echo '<img class="' . esc_attr( $img_type ) . ' " src="' . esc_url( $gallery['url'] ) . '" alt="' . esc_attr( $gallery['alt'] ) . '" />';
			}
			?>
		</div>
		<div class="collection-gallery-spacer"></div>
	<?php endif; ?>
</main><!-- #main -->

<?php
// Only show designer section when:
// - Not Summit Classics or Summit Covers
// - AND a collection designer actually exists.
if (
	$term_name !== 'Summit Classics'
	&& $term_name !== 'Summit Covers'
	&& $has_collection_designer
) :
	?>
	<div class="summit-collection-designer">
		<?php
		$term      = get_queried_object();
		$term_slug = isset( $term->slug ) ? $term->slug : '';

		if ( $term_slug === 'umbrosa' ) {
			echo '<h6>Summit X Umbrosa</h6>';
		} elseif ( $term_slug === 'santa-barbara-designs' ) {
			echo '<h6>Summit X Santa Barbara Designs<sup>®</sup></h6>';
		} else {
			echo '<h6>Icons of Design</h6>';
		}
		?>

		<div class="summit-designer-info">
			<h4 class="summit-designer-name">
				<?= esc_html( $collection_designer_name ); ?>
			</h4>
			<?= wp_kses_post( $collection_designer_bio ); ?>
		</div>

		<?php if ( ! empty( $collection_designer_headshot ) ) : ?>
			<img class="summit-designer-headshot" src="<?= esc_url( $collection_designer_headshot ); ?>" alt="<?= esc_attr( $collection_designer_name ); ?>" />
		<?php endif; ?>
	</div>
<?php
endif;

get_footer();
