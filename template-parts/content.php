<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Summit_Furniture
 */
$id = get_the_ID();
$headline = get_field('article_headline', $id );
$file = get_field('article_pdf', $id );
if (!empty( get_the_post_thumbnail() ) ) { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php 
		echo '<a href=" ' . esc_url($file) .' ">';
		the_post_thumbnail();
		echo '<h2>' . esc_html( get_the_title($id) ) . '</h2>';
		echo '</a>';
		?>
	</article>
<?php
}
?>
