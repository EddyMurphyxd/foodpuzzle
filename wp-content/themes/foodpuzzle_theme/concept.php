<?php /* Template Name: Concept page */ ?>

<?php get_header(); ?>
<section id="main-section">
    <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>

    <?php } ?>
    
    <?php while ( have_posts() ) : the_post() ?>

    <?php /* Create a div with a unique ID thanks to the_ID() and semantic classes with post_class() */ ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php /* an h2 title */ ?>

    <?php /* Microformatted, translatable post meta */ ?>

    <?php /* The entry content */ ?>
      <div class="entry-content">
        <div class="concept-image-teaser">
          <img src="<?php echo the_field('concept_image'); ?>" alt="">

          <div class="text text-shadow">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'hbd-theme' )  ); ?>
            <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'hbd-theme' ) . '&after=</div>') ?>
          </div>
        </div>
        
        <div class="container">
          <div class="additional-content">
            <div class="row columns-center">
              <div class="wow slideInLeft col-sm-3">
                <p class="title">Легко</p>
                <p class="gray">*<?php echo the_field('quick_teaser_text'); ?></p>
              </div>

              <div class="wow fadeInDown col-sm-3 col-sm-offset-1">
                <p class="title">Зручно</p>
                <p class="gray">*<?php echo the_field('easy_teaser_text'); ?></p>
              </div>

              <div class="wow slideInRight col-sm-3 col-sm-offset-1">
                <p class="title">Корисно</p>
                <p class="gray">*<?php echo the_field('healthy_teaser_text'); ?></p>
              </div>
            </div>
          </div>
        </div>

          <?php 
            $profits = explode(PHP_EOL, get_field('profits_textarea'));
          ?>

          <div class="concept-carousel">
            <?php 
              $conceptCarousel =  do_shortcode('[owl-carousel category="Concept-slider" items="1" autoplay="false" autoplayHoverPause="false" loop="true" dots="false" mouseDrag="false" nav="true" navText=","]'); 

              echo $conceptCarousel;
            ?>
          </div>
          
          <div class="container">
            <div class="profits">
              <div class="row">
                <div class="col-sm-12 text-center margin-bottom-25">
                  <h2>ЦЕ ДІЙСНО ТАК ЗРУЧНО, ЯК ЗДАЄТЬСЯ?</h2>
                </div>
              </div>

              <div class="row profits-row columns-center">
                <?php
                  $counter = 0;
                ?>

                <?php foreach ($profits as $profit): ?>
                  <?php if ($counter == 3): $counter = 0; ?>
                    </div>

                    <div class="row profits-row columns-center">
                  <?php endif; ?>

                  <div class="wow fadeInUp col-sm-3<?php if ($counter > 0) echo ' col-sm-offset-1'?>">
                    <div class="text-wrapper">
                      <p><?php $counter++; echo $profit; ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>

                <?php if (count($profits) % 1 == 0): ?>
                  <div class="wow fadeInUp col-sm-3 col-sm-offset-1"></div>
                <?php endif; ?>

                <?php if (count($profits) % 2 == 0): ?>
                  <div class="wow fadeInUp col-sm-3 col-sm-offset-1"></div>
                  <div class="wow fadeInUp col-sm-3 col-sm-offset-1"></div>
                <?php endif; ?>
              </div>
            </div>
          </div>

      </div><!-- .entry-content -->
    <?php /* Microformatted category and tag links along with a comments link */ ?>
    
    </div><!-- #post-<?php the_ID(); ?> -->

    <?php /* Close up the post div and then end the loop with endwhile */ ?>      

    <?php endwhile; ?>

  <div class="quick-link">
    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>"><p>Спробуй! Тобі сподобається!</p></a>
  </div>
</section><!-- #main-section -->
 
<?php get_footer(); ?>