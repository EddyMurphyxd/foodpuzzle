<?php /* Template Name: Home page */ ?>
<?php get_header(); ?>
<section id="main-section">
	<h1 class="hidden meta">Швидка доставка їжі</h1>
	<h2 class="hidden meta">Швидка доставка їжі по Львову та його межами. Швидка доставка виключно якісних інгридієнтів та наборів для страв з рецептами.</h2>
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

	<div id="promo-modal">
		<div class="inner">
			<button class="close">x</button>

			<h3>Привіт, наш сервіс закінчує етап підготовки і вже зовсім скоро ми з радістю доставлятимемо набори для Вас!</h3>

			<p>Якщо Ви хочете першими дізнатись про наш початок, залиште свою електронну пошту і ми обов'язково повідомимо Вам про відкриття та зробимо персональну знижку ;)</p>

			<form action="<?php echo get_site_url(); ?>/wp-content/themes/foodpuzzle_theme/potential-customer.php" class="form-group">
				<input type="mail" class="form-control" name="potential-customer" required>
				<input type="submit" value="Повідомте мене!">
			</form>
		</div>
	</div>

	<div class="quick-link">
	  <a href="/index.php/about-us"><p>Вперше на сайті? Давай познайомимось!</p></a>
	</div>
</section><!-- #main-section -->
 
<?php get_footer(); ?>