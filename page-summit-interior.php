<?php
/**
 * Template Name: Summit Interior Page
 *
 * @package Summit_Furniture
 */

get_header();
$bg_image = get_field('full_screen_background_image', get_the_ID() );
?>
	
	<main id="primary" class="site-main summit-interior" 
		  <?php if (!empty($bg_image) ) { 
			?>style="background-image: url('<?php echo esc_url($bg_image['url']); ?>');"
		  <?php
		} ?>
		>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();