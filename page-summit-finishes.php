<?php
/**
 * Template Name: Summit Finishes
 *
 * @package Summit_Furniture
 */

get_header();
?>
<?php if ( get_field( 'finishes_cover' ) ) : ?>
	<img class="finishes-hero" src="<?php the_field( 'finishes_cover' ); ?>" alt="Finishes cover image." />
<?php endif ?>
<main id="primary" class="site-main summit-interior-fabrics" style="margin-top: 3rem">
	<?php
	$interior_finishes = get_terms( array(
		'taxonomy' => 'product-finish',
		'hide_empty' => false,
		'meta_key' => 'location',
		'meta_value' => 'interior'
	) );
	$exterior_finishes = get_terms( array(
		'taxonomy' => 'product-finish',
		'hide_empty' => false,
		'meta_key' => 'location',
		'meta_value' => 'exterior'
	) );
	$post_ID = get_the_id();
	?>
	<section class="summit-fabrics">
		<header class="summit-furniture-header">
			<h1>
				<?= esc_html_e('Finishes') ?>
			</h1>
			<?= do_shortcode('[addtoany]'); ?>
		</header>
		<div class="summit-fabric-content summit-finishes">
			<h2><?php echo esc_html_e('Interior') ?></h2>
				<div class="finishes-group">
				<?php
				foreach ($interior_finishes as $finish) {
					$termID = $finish->term_id;
					$finishName = $finish->name;
					$finishPhoto = get_field('image', 'product-finish' . '_' . $termID);
					$finishLocation = get_field('location', 'product-finish' . '_' . $termID);
					?>
					<div class="single-finish">
						<img src="<?= $finishPhoto ?>" />
						<div class="fabric-family"><?= $finishName ?></div>
					</div>
					<?php
					}
				?>
				</div>	
				<h2 style="margin-top: 2rem"><?php echo esc_html_e('Exterior') ?></h2>
				<div class="finishes-group">
				<?php
				foreach ($exterior_finishes as $finish) {
					$termID = $finish->term_id;
					$finishName = $finish->name;
					$finishPhoto = get_field('image', 'product-finish' . '_' . $termID);
					$finishLocation = get_field('location', 'product-finish' . '_' . $termID);
					?>
					<div class="single-finish">
						<img src="<?= $finishPhoto ?>" />
						<div class="fabric-family"><?= $finishName ?></div>
					</div>
					<?php
					}
				?>
				</div>
			</div>
	</section>
</main>
	<?php
get_footer();