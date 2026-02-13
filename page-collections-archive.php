<?php
/**
 * Template Name: Collections Archive
 *
 * @package Summit_Furniture
 */

get_header();

$args = array(
  'taxonomy' => 'product-collection',
  'orderby' => 'meta_value_num',
  'order' => 'ASC',
  'hide_empty' => false,
  'hierarchical' => false,
  'parent' => 0,
  'meta_query' => array(
    array(
      'key' => 'priority',
      'type' => 'NUMERIC',
    ),
  ),
);
$terms = get_terms($args);
?>

<main id="primary" class="site-main summit-collections">
  <div class="summit-collections-wrap">
    <header class="summit-collections-header">
      <h1>Collections</h1>
    </header>

<?php foreach ($terms as $term) {
  // Check if this collection has at least one published product
  $product_check = new WP_Query(array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'product-collection',
        'field'    => 'term_id',
        'terms'    => $term->term_id,
      ),
    ),
  ));

  // Skip if no products found
  if (!$product_check->have_posts()) {
    continue;
  }

	  

  $term_id = $term->term_id;
  $name = $term->name;
  $slug = $term->slug;
  $cover = esc_url(get_field('cover', 'term_' . $term_id));
  $content = wp_kses_post(get_field('archive_content', 'term_' . $term_id));
  $collection_link = esc_url(get_permalink(get_page_by_path('collection')));
?>
	  
      <div class="summit-single-collection">
        <a class="image-wrap" href="/collection/<?= $slug ?>">
          <img src="<?= $cover ?>" alt="Cover image for the <?= esc_html($name) ?> Collection">
        </a>
        <div class="content">
          <a href="/collection/<?= $slug ?>">
            <h2><?= esc_html($name) ?></h2>
            <?= $content ?>
          </a>
        </div>
      </div>
    <?php } ?>

  </div>
</main><!-- #main -->

<?php get_footer();
