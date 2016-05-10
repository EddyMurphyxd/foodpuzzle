<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

$product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
$single_cat = array_shift( $product_cats );

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>

<?php 
	$productFilterCategory = (is_object($single_cat)) ? $single_cat->slug : '';
?>

<article data-filter-category="<?php echo $productFilterCategory; ?>" <?php array_push($classes, 'panda-filter-item wow fadeInUp'); post_class( $classes ); ?>>

	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	echo '<figure>';
	do_action( 'woocommerce_before_shop_loop_item_title' );
	echo '</figure>';

	?>

	<div class="product-info-overlay">
		<div class="product-info">
			<?php
				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 * @hooked woocommerce_template_loop_product_title - 9
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 * @hooked my_add_short_description - 9
				 */
				// do_action( 'woocommerce_after_shop_loop_item_title' );
				$price = get_post_meta( get_the_ID(), '_regular_price', true);
				$teaserField = get_field('_teaser_text_field');
				$weightField = get_field('_weight_text_field');
				$timeField = get_field('_time_text_field');
				$difficultyField = get_field('_difficulty_text_field');

			?>

			
			<p><?php if (!empty($teaserField)): ?><?php echo $teaserField; ?>.<?php endif; ?></p>
			<p><?php if (!empty($weightField)): ?>1 порція: <?php echo $weightField; ?>.<?php endif; ?></p>
			<p><?php if (!empty($timeField)): ?>час приготування: <?php echo $timeField; ?>.<?php endif; ?></p>
			<p><?php if (!empty($difficultyField)): ?>складність: <?php echo $difficultyField; ?><?php endif; ?></p>
			<span class="price">
				<span class="amount"><?php echo $price . ' ' . get_woocommerce_currency_symbol(); ?> </span>
			</span>
		</div>
	</div>
	
	<?php
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
	?>

</article>