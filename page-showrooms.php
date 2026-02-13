<?php
/**
 * Template Name: Showrooms
 *
 * @package Summit_Furniture
 */

get_header();

$showrooms = get_field('showrooms');

?>

	<main id="primary" class="site-main summit-showrooms">
	
		<div class="summit-showrooms-wrap">
			<header class="summit-showrooms-header">
				<h1>
					Showrooms
				</h1>
			</header>
			<div class="showrooms-intro">
				<?= the_content(); ?>
			</div>
		<?php 
		foreach ($showrooms as $showroom) {
			$cover = $showroom['location_photo'];
			$prehead = $showroom['pre-header_location'];
			$hq = $showroom['hq_detail'];
			$name = $showroom['location_header'];
			$content = $showroom['intro_and_address'];
			$email = $showroom['Email'];
			$link = $showroom['virtual_tour_link'];
			?>
			<div class="summit-single-showroom">
				<img src="<?= esc_url($cover); ?>" alt="Cover image for the <?= esc_html($name); ?> Collection">
				<div class="content">
					<h6>
						<?= esc_html($prehead);
						if (!empty($hq)) {
							?><span> • <?= $hq ?></span><?php
						}
						?>
					</h6>
					<h2>
						<?= esc_html($name); ?>
					</h2>
					<?= $content ?>
					<a class="no-translate" href="mailto:<?= $email ?>"><?= $email; ?></a>
					<?php
// 					if ( !empty($link) ) {
// 						echo '<a class="virtual-tour" href="' . esc_url($link) . '">3D Virtual Tour</a>';
// 					}
					?>
				</div>
			</div>
			<?php
		}
		?>
		</div>
	</main><!-- #main -->

<?php
get_footer();