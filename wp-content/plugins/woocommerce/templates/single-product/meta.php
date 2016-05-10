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
  <?php 
    $weightText = get_post_meta( $post->ID, '_weight_text_field', true );
    $weightTextarea = get_post_meta( $post->ID, '_weight_textarea', true );
    $timeText   = get_post_meta( $post->ID, '_time_text_field', true );
    $timeTextarea = get_post_meta( $post->ID, '_time_textarea', true );
    $diffText   = get_post_meta( $post->ID, '_difficulty_text_field', true );
    $diffTextarea = get_post_meta( $post->ID, '_difficulty_textarea', true );
  ?>
  
  <div class="row columns-center description-columns-row">
    <?php if (!empty($weightText)): ?>
    <div class="col-sm-3 product-weight-column wow fadeInLeft">
      <p class="title">Вага 1 порції</p>
      <p class="bold"><?php echo $weightText; ?>.</p>

      <?php if (!empty($weightTextarea)): ?><p class="small-gray">*<?php echo $weightTextarea; ?></p><?php endif; ?>
      
    </div>
    <?php endif; ?>

    <?php if (!empty($timeText)): ?>
    <div class="col-sm-3 col-sm-offset-1 product-time-column wow fadeInDown">
      <p class="title">Час приготування</p>

      <p class="bold"><?php echo $timeText; ?>.</p>

      <?php if (!empty($timeTextarea)): ?><p class="small-gray">*<?php echo $timeTextarea; ?></p><?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($diffText)): ?>
    <div class="col-sm-3 col-sm-offset-1 product-difficulty-column wow fadeInRight">
      <p class="title">Рівень складності</p>

      <p class="bold"><?php echo $diffText; ?></p>

      <?php if (!empty($diffTextarea)): ?><p class="small-gray">*<?php echo $diffTextarea; ?></p><?php endif; ?>
    </div>
    <?php endif; ?>
  </div>

  <!-- Template for 3 columns description - end -->

  <!-- Template for ingridients - start -->

  <div class="row ingridients-row">
    <div class="col-sm-12">
      <h2 class="wow fadeInUp">І Н Г Р А Д І Є Н Т И</h2>
      <p class="wow fadeInUp">все це ви знайдете в пакеті від foodpuzzle</p>
    </div>
  </div>

  <div class="row columns-center">
    <?php
      $ingridients = get_post_meta( $post->ID, '_ingridients_list_textarea', true );
      $ingrArray   = explode(",", $ingridients);
      $counter = 0;
    ?>

    <?php foreach ($ingrArray as $item): ?>
      <?php if ($counter == 3): $counter = 0; ?>
        </div>

        <div class="row columns-center">
      <?php endif; ?>

      <div class="wow fadeInDown col-sm-3<?php if ($counter > 0) echo ' col-sm-offset-1'?>">
        <p class="ingridient"><?php $counter++; echo $item; ?></p>
      </div>
    <?php endforeach;?>

    <?php if (count($ingrArray) % 2 == 0): ?>
      <div class="wow fadeInDown col-sm-3 col-sm-offset-1"></div>
    <?php endif; ?>

    <?php if (count($ingrArray) % 1 == 0): ?>
      <div class="wow fadeInDown col-sm-3 col-sm-offset-1"></div>
      <div class="wow fadeInDown col-sm-3 col-sm-offset-1"></div>
    <?php endif; ?>
  </div>

  <!-- Template for ingridients - end -->

  <!-- Template for required items - start -->
  <div class="row required-items-row">
    <div class="col-sm-12">
      <h2 class="wow fadeInUp">І Н В Е Н Т А Р</h2>
      <p class="wow fadeInUp">те, що вам знадобиться для приготування</p>
    </div>
  </div>

  <div class="row columns-center">
    <?php
      $requiredItems = get_post_meta( $post->ID, '_required_items_textarea', true );
      $itemsArray   = explode(",", $requiredItems);
      $counter = 0;
    ?>

    <?php foreach ($itemsArray as $item): ?>
      <?php if ($counter == 3): $counter = 0; ?>
        </div>

        <div class="row columns-center">
      <?php endif; ?>

      <div class="wow fadeInDown col-sm-3<?php if ($counter > 0) echo ' col-sm-offset-1'?>">
        <p class="required-item"><?php $counter++; echo $item; ?></p>
      </div>
    <?php endforeach;?>

    <?php if (count($itemsArray) % 2 == 0): ?>
      <div class="wow fadeInDown col-sm-3 col-sm-offset-1"></div>
    <?php endif; ?>

    <?php if (count($itemsArray) % 1 == 0): ?>
      <div class="wow fadeInDown col-sm-3 col-sm-offset-1"></div>
      <div class="wow fadeInDown col-sm-3 col-sm-offset-1"></div>
    <?php endif; ?>

  </div>
  <!-- Template for required items - end -->

  <div class="ingridients-image-wrapper">
    <?php 
      $imgSrc = get_field( "ingridient_image" );
    ?>

    <img src="<?php echo $imgSrc; ?>" alt="">
  </div>

  <div class="general-description wow fadeIn">
    <?php the_content(); ?>
  </div>

  <?php
    $recommendatedDishes = get_field('recommendated_dishes');
  ?>

  <?php if (!empty($recommendatedDishes)): ?>
    <div class="recommendated-dishes">
      <h2 class="wow fadeInUp">Ми рекомендуємо!</h2>

      <ul class="wow fadeIn columns-center">
        <?php foreach ($recommendatedDishes as $key): ?>
          <?php 
            $productArray = get_object_vars($key);
            $productID    = $productArray['ID'];

            $product       = wc_get_product($productID);
            $productURL    = get_permalink($productID);
            $productImage  = $product->get_image();
            $productTeaser = $productArray['post_title'];
          ?>

          <li class="col-sm-offset-1">
            <a href="<?php echo $productURL; ?>">
              <?php echo $productImage; ?>
              <p><?php echo $productTeaser; ?></p>
            </a>
          </li>

        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
