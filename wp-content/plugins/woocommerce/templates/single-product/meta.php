<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>
  
  <!-- Template for 3 columns description - start -->
  
  <div class="row">
    <div class="col-sm-4 product-weight-column">
      <h3>ВАГА 1 ПОРЦІЇ</h3>
      <p class="bold"><?php echo get_post_meta( $post->ID, '_weight_text_field', true ); ?></p>

      <p class="small-gray">*<?php echo get_post_meta( $post->ID, '_weight_textarea', true ); ?></p>
      
    </div>

    <div class="col-sm-4 product-time-column">
      <h3>ЧАС ПРИГОТУВАННЯ</h3>

      <p class="bold"><?php echo get_post_meta( $post->ID, '_time_text_field', true ); ?></p>

      <p class="small-gray">*<?php echo get_post_meta( $post->ID, '_time_textarea', true ); ?></p>
    </div>

    <div class="col-sm-4 product-difficulty-column">
      <h3>РІВЕНЬ СКЛАДНОСТІ</h3>

      <p class="bold"><?php echo get_post_meta( $post->ID, '_difficulty_text_field', true ); ?></p>

      <p class="small-gray">*<?php echo get_post_meta( $post->ID, '_difficulty_textarea', true ); ?></p>
    </div>
  </div>

  <!-- Template for 3 columns description - end -->

  <!-- Template for ingridients - start -->

  <div class="row">
    <div class="col-sm-12">
      <h2>І Н Г Р А Д І Є Н Т И</h2>
      <p>все це ви знайдете в пакеті від foodpuzzle</p>
    </div>
  </div>

  <div class="row">
    <?php
      $ingridients = get_post_meta( $post->ID, '_ingridients_list_textarea', true );
      $ingrArray   = explode(",", $ingridients);
      $counter = 0;
    ?>

    <?php foreach ($ingrArray as $item): ?>
      <?php if ($counter == 3): ?>
        </div>

        <div class="row">
      <?php endif; ?>

      <div class="col-sm-4">
        <p class="ingridient"><?php $counter++; echo $item; ?></p>
      </div>
    <?php endforeach;?>
  </div>

  <!-- Template for ingridients - end -->

  <!-- Template for required items - start -->
  <div class="row">
    <div class="col-sm-12">
      <h2>І Н В Е Н Т А Р</h2>
      <p>те, що вам знадобиться для приготування</p>
    </div>
  </div>

  <div class="row">
    <?php
      $requiredItems = get_post_meta( $post->ID, '_required_items_textarea', true );
      $itemsArray   = explode(",", $requiredItems);
      $counter = 0;
    ?>

    <?php foreach ($itemsArray as $item): ?>
      <?php if ($counter == 3): ?>
        </div>

        <div class="row">
      <?php endif; ?>

      <div class="col-sm-4">
        <p class="required-item"><?php $counter++; echo $item; ?></p>
      </div>
    <?php endforeach;?>
  </div>
  <!-- Template for required items - end -->

  <div class="general-description">
    <?php the_content(); ?>
  </div>

	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
