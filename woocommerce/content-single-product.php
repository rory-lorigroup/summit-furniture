# Summit theme change — woocommerce/content-single-product.php

Two edits for the June 2026 product-description rollout (Abby's items #3 and #4).
Make these in the summit-furniture repo so the GitHub Actions deploy doesn't
overwrite them — do not rely on the WP Theme File Editor alone.

---

## Edit 1 — Replace the hardcoded trade/ordering copy (~lines 111–134)

### Current block ("Pricing and Login Messaging")

```php
<?php // Pricing and Login Messaging ?>
<?php if ( ! is_user_logged_in() ) : ?>
	<?php if ( 'furniture' === $post_type ) : ?>
		<p>To request a quote or place an order, please contact your <a href="/sales" style="text-decoration: underline">Summit Sales Representative.</a>  To receive the benefits of being a Trade Program member, including a special discount on all Summit products, click <a href="/trade-account/" style="text-decoration: underline">here.</a></p>
		<a style="font-weight: bold" href="mailto:sales@summitfurniture.com?subject=Product Inquiry&body=Please send me more information about <?php echo esc_attr( $product_sku ); ?> and information on how to place an order.">Place an order or inquire</a>
		<?php if ( '1' === $quick_ship ) : ?>
			<p><?php esc_html_e( 'All product available through the Quick Ship program is shipped from the US. Contact Summit Sales for information on all our Quick Ship available items.' ); ?></p>
		<?php endif; ?>
	<?php else : ?>
		<a style="font-weight: bold" href="mailto:sales@summitfurniture.com?subject=Sample Request&body=Please send me a sample of <?php echo esc_attr( $product_sku ); ?>.">Request a sample</a>
	<?php endif; ?>
<?php else : ?>
	<?php if ( 'furniture' === $post_type ) : ?>
		<?php
		$current_user = wp_get_current_user();
		$user_role    = $current_user->roles;
		if ( in_array( 'trade', $user_role, true ) ) :
			?>
			<p>To request a discounted quote as a Trade Program member or to place an order, please contact your <a href="/trade-account/" style="text-decoration: underline">Summit Sales Representative.</a></p>
		<?php else : ?>
			<p>To request a quote or place an order, please contact your <a href="/sales" style="text-decoration: underline">Summit Sales Representative.</a> To receive the benefits of being a Trade Program member, including a special discount on all Summit products, click <a href="/trade-account/" style="text-decoration: underline">here.</a></p>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
```

### New block

Per the "Summit Product Description Format 2026" doc: bold first paragraph
linking Summit Sales Representative to /sales, then the Trade Program line
linking "here" to /trade-account/.

```php
<?php // Pricing and Login Messaging ?>
<?php if ( ! is_user_logged_in() ) : ?>
	<?php if ( 'furniture' === $post_type ) : ?>
		<p><strong>To request a quote, fabric sample, or place an order, please contact your <a href="/sales" style="text-decoration: underline">Summit Sales Representative.</a></strong></p>
		<p>Qualified Trade Program members enjoy preferred pricing across the Summit collection. Register <a href="/trade-account/" style="text-decoration: underline">here</a>.</p>
		<?php if ( '1' === $quick_ship ) : ?>
			<p><?php esc_html_e( 'All product available through the Quick Ship program is shipped from the US. Contact Summit Sales for information on all our Quick Ship available items.' ); ?></p>
		<?php endif; ?>
	<?php else : ?>
		<a style="font-weight: bold" href="mailto:sales@summitfurniture.com?subject=Sample Request&body=Please send me a sample of <?php echo esc_attr( $product_sku ); ?>.">Request a sample</a>
	<?php endif; ?>
<?php else : ?>
	<?php if ( 'furniture' === $post_type ) : ?>
		<?php
		$current_user = wp_get_current_user();
		$user_role    = $current_user->roles;
		if ( in_array( 'trade', $user_role, true ) ) :
			?>
			<p><strong>To request a discounted quote, fabric sample, or place an order as a Trade Program member, please contact your <a href="/trade-account/" style="text-decoration: underline">Summit Sales Representative.</a></strong></p>
		<?php else : ?>
			<p><strong>To request a quote, fabric sample, or place an order, please contact your <a href="/sales" style="text-decoration: underline">Summit Sales Representative.</a></strong></p>
			<p>Qualified Trade Program members enjoy preferred pricing across the Summit collection. Register <a href="/trade-account/" style="text-decoration: underline">here</a>.</p>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
```

Notes / open items:
- **"Place an order or inquire" mailto link is removed** above, per Abby's
  instruction #3 ("replace all current copy through 'Place an order or
  inquire'") and her target mock, which doesn't show it. If she wants to keep
  it, reinsert the single `<a ...>Place an order or inquire</a>` line after
  the Trade Program paragraph.
- The logged-in **trade-member** variant is updated to the new phrasing while
  keeping the discount mention, styled bold to match: "To request a discounted
  quote, fabric sample, or place an order as a Trade Program member..." The
  Register line is intentionally omitted for trade members (they're already
  registered).
- The fabric "Request a sample" link is untouched.

---

## Edit 2 — Remove the collection blurb from product pages (~lines 170–182)

Delete this entire block ("Short Collection Description"). It renders the
Collection term's `archive_content` field on every product page. Do NOT blank
the Archive Content fields themselves — the /collections/ overview page uses
the same field for its teaser text.

```php
<?php // Short Collection Description ?>
<?php
if ( ! empty( $terms ) && strtolower( $collection_slug ) !== 'toulon' ) :
	$term              = $terms[0];
	$termID            = $term->term_id;
	$short_description = wp_strip_all_tags( get_field( 'archive_content', 'product-collection_' . $termID ) );
	if ( ! empty( $short_description ) ) :
		?>
		<p class="summit-short-collection"><?php echo esc_html( $short_description ); ?></p>
		<?php
	endif;
endif;
?>
```

(The Toulon collection was already excluded from this block; its separate
hardcoded intro at ~lines 98–109 is untouched.)
