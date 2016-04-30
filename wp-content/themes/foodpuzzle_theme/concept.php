<?php /* Template Name: Concept page */ ?>

<?php get_header(); ?>
<section id="main-section">
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
        <div class="concept-image-teaser">
          <img src="<?php echo the_field('concept_image'); ?>" alt="">

          <div class="text">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'hbd-theme' )  ); ?>
            <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'hbd-theme' ) . '&after=</div>') ?>
          </div>
        </div>

        <div class="additional-content">
          <div class="row columns-center">
            <div class="col-sm-3">
              <p class="title">ШВИДКО</p>
              <p class="gray">*<?php echo the_field('quick_teaser_text'); ?></p>
            </div>

            <div class="col-sm-3 col-sm-offset-1">
              <p class="title">Зручно</p>
              <p class="gray">*<?php echo the_field('easy_teaser_text'); ?></p>
            </div>

            <div class="col-sm-3 col-sm-offset-1">
              <p class="title">Корисно</p>
              <p class="gray">*<?php echo the_field('healthy_teaser_text'); ?></p>
            </div>
          </div>

          <div class="profits">
            <div class="row">
              <div class="col-sm-12 text-center margin-bottom-25">
                <h2>ЦЕ ДІЙСНО ТАК ЗРУЧНО, ЯК ЗДАЄТЬСЯ?</h2>
              </div>
            </div>

            <div class="row profits-row columns-center">
              <?php 
                $profits = explode(PHP_EOL, get_field('profits_textarea'));
                $counter = 0;
              ?>

              <?php foreach ($profits as $profit): ?>
                <?php if ($counter == 3): $counter = 0; ?>
                  </div>

                  <div class="row profits-row columns-center">
                <?php endif; ?>

                <div class="col-sm-3<?php if ($counter > 0) echo ' col-sm-offset-1'?>">
                  <div class="text-wrapper">
                    <p><?php $counter++; echo $profit; ?></p>
                  </div>
                </div>
              <?php endforeach; ?>

              <?php if (count($profits) % 3 != 0): ?>
                <div class="col-sm-3 col-sm-offset-1"></div>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </div><!-- .entry-content -->
    <?php /* Microformatted category and tag links along with a comments link */ ?>
    
    </div><!-- #post-<?php the_ID(); ?> -->

    <?php /* Close up the post div and then end the loop with endwhile */ ?>      

    <?php endwhile; ?>
  </div>

  <div class="quick-link">
    <a href="#" target="_blank"><p>Спробуй! Тобі сподобається!</p></a>
  </div>
</section><!-- #main-section -->
 
<?php get_footer(); ?>