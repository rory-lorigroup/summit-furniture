<?php
/**
 * Template Name: Summit Blank Page
 *
 * @package Summit_Furniture
 */

get_header();
?>

	<main id="primary" class="site-main summit-interior summit-blank">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'blank' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();