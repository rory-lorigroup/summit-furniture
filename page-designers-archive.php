<?php
/**
 * Template Name: Designers Archive
 *
 * @package Summit_Furniture
 */

get_header();
$args = array(
  'taxonomy' => 'product-designer',
  'orderby' => 'meta_value',
  'order' => 'ASC',
  'hide_empty' => false,
  'hierarchical' => false,
  'parent' => 0,
  'meta_query' => array(
       array(
           'key'     => 'order',
        ),
  ),
);
$terms = get_terms($args);

?>

	<main id="primary" class="site-main summit-designers">
	
		<div class="summit-designers-wrap">
			<header class="summit-designers-header">
				<h1>
					Designers
				</h1>
			</header>
		<div class="summit-designers-inner-wrap">
		<?php 
		foreach ($terms as $term) {
			$term_id = $term->term_id;
			$name = $term->name;
			$slug = $term->slug;
			$cover = get_field('cover', 'term_' . $term_id);
			$alpha = get_term_meta($term_id, 'alpha_sort', true);
			if ($name === 'Charles Verey') {
				continue;
			} else {
			?>
			<div class="summit-single-designer">
				<a href="/designer/<?= $slug ?>">
					<img src="<?= esc_url($cover); ?>" alt="Cover image for <?= esc_html($name); ?>, designer at Summit Furniture">
				</a>
				<div class="content">
					<h2>
						<?php
						if ($name === 'Winch') {
							echo 'Winch Design';
						} else {
							echo esc_html($name);
						}
						?>
					</h2>
				</div>
			</div>
			<?php
			}
		}
		?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();