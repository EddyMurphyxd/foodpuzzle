<?php /* Template Name: Home page */ ?>
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
	<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'hbd-theme' )  ); ?>
	<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'hbd-theme' ) . '&after=</div>') ?>
	                    </div><!-- .entry-content -->

	<?php /* Microformatted category and tag links along with a comments link */ ?>
	                </div><!-- #post-<?php the_ID(); ?> -->

	<?php /* Close up the post div and then end the loop with endwhile */ ?>      

	<?php endwhile; ?>

	<div class="quick-link">
	  <a href="/index.php/about-us"><p>Вперше на сайті? Давай познайомимось!</p></a>
	</div>
</section><!-- #main-section -->
 
<?php get_footer(); ?>