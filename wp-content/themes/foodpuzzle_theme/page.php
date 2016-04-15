<?php /* Template Name: Default custom template*/ ?>

<?php get_header(); ?>
 
<?php the_post(); ?>
<div class="container">
  <section id="main-section">
    <div class="entry-content" <?php post_class(); ?>>
      <?php the_content(); ?>
      <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
    </div><!-- .entry-content -->  
  </section> <!-- #main-section -->
</div> <!-- .container -->
 
<?php if ( get_post_custom_values('comments') ) comments_template() // Add a custom field with Name and Value of "comments" to enable comments on this page ?>
 
<?php get_footer(); ?>