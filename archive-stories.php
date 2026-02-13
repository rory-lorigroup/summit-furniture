<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Summit_Furniture
 */

get_header();
?>

<main id="primary" class="site-main summit-stories">
		<header class="summit-furniture-header">
				<h1>
					Design Journal
				</h1>
		</header>
			<?php
			$args = array(
				'post_type' => 'stories',
				'posts_per_page' => -1,
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) {
				echo '<div class="summit-stories-wrap">';
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id = get_the_ID();
					$post_thumbnail = get_the_post_thumbnail($post_id);
					$permalink = get_the_permalink();
					$prefix = get_field('story_prefix', $post_id);
					$headline = get_field('story_headline', $post_id);
					?>
					<div class="story">
						<a href="<?= $permalink?>"></a>
						<?= $post_thumbnail; ?>
						<div class="story-content">
							<p><?= esc_html($prefix) ?></p>
							<h4><?= esc_html($headline) ?></h4>
						</div>
					</div>
				<?php
				}
				echo '</div>';
			}
			?>
	</main><!-- #main -->

<?php
get_footer();
