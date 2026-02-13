<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Summit_Furniture
 */

get_header();
global $wp_query; 
?>

	<main id="primary" class="site-main summit-search-results">
		
		<div class="summit-search-wrap">

		<?php if ( have_posts() ) : ?>

			<header>
				<p>
					<?php echo esc_html($wp_query->post_count) . ' of ' . $wp_query->found_posts . ' results for ' . get_search_query(); ?>
				</p>
			</header>
				
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
			
			</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
