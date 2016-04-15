<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
  <title>
    <?php
      if ( is_single() ) { single_post_title(); }
      // elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
      elseif ( is_page() ) { single_post_title(''); }
      elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
      elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
      else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?>
  </title>
 
  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
  <link rel="stylesheet" type="text/css" href="/wp-content/themes/foodpuzzle_theme/styles/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="/wp-content/themes/foodpuzzle_theme/styles/animate.css" />
  <link rel="stylesheet" type="text/css" href="/wp-content/themes/foodpuzzle_theme/styles/pandaFilter.css" />
  <link rel="stylesheet" type="text/css" href="/wp-content/themes/foodpuzzle_theme/styles/layout.css" />

  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'hbd-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
  <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'hbd-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
</head>
<?php
  $pageClass = '';

  if (is_home() || is_front_page()) {
    $pageClass = 'home-page';
  } else if (is_page()) {
    $pageClass = 'default';
  } else if (is_shop()) {
    $pageClass = 'shop';
  } else if (wc_get_page_id( 'cart' ) == get_the_ID()) {
    $pageClass = 'cart';
  }
?>
<body class="<?php echo $pageClass;?>">
<div id="wrapper">
  <header class="main-header">
    <nav class="main-navigation">
      <?php #wp_page_menu( 'sort_column=menu_order' ); ?>
      <div id="logo-wrapper">
        <a href="http://foodpuzzle.local">Foodpuzzle</a>
      </div>
      <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header' ) ); ?>
    </nav><!-- .main-navigation -->
  </header><!-- .main-header -->
 
  <main>