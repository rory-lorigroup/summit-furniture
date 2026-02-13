<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Summit_Furniture
 */

?>

<section class="no-results not-found">

		<?php
		if ( is_search() ) :
			?>
			<header class="page-header">
				<h1 class="page-title" style="text-align: center"><?php esc_html_e( 'There are no results for your search. Please try again.', 'summit-furniture' ); ?></h1>
			</header><!-- .page-header -->
		<?php

		else :
			?>

			<header class="page-header">
				<h1 class="page-title" style="text-align: center"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'summit-furniture' ); ?></h1>
			</header><!-- .page-header -->
			<div class="summit-inline-search">
				<?php echo get_search_form(false); ?>
			</div>
		<?php
		endif;
		?>
</section><!-- .no-results -->
