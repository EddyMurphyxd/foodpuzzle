<?php /* Template Name: Shipping page */ ?>

<?php get_header(); ?>

<section id="main-section" class="shipping-page">
  
  <div class="container">
    <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>

    <?php } ?>
    
    <?php while ( have_posts() ) : the_post() ?>

    <?php /* Create a div with a unique ID thanks to the_ID() and semantic classes with post_class() */ ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php /* an h2 title */ ?>

    <?php /* Microformatted, translatable post meta */ ?>

    <?php /* The entry content */ ?>
      <div class="entry-content">
        <div class="shipping-keyvisual" style="background-image: url(<?php echo get_field('shipping_keyvisual_image'); ?>);">
          <div class="keyvisual-text">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'hbd-theme' )  ); ?>
          </div>
        </div>

        <div class="shipping-info">
          
        </div>
      </div><!-- .entry-content -->
    <?php /* Microformatted category and tag links along with a comments link */ ?>
    
    </div><!-- #post-<?php the_ID(); ?> -->

    <?php /* Close up the post div and then end the loop with endwhile */ ?>      

    <?php endwhile; ?>
  </div>
</section><!-- #main-section -->
 
<?php get_footer(); ?>