<?php
  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'hbd-theme', TEMPLATEPATH . '/languages' );
  
  add_theme_support( 'menus' );

  $locale = get_locale();
  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
  if ( is_readable($locale_file) )
      require_once($locale_file);

  // Get the page number
  function get_page_number() {
      if ( get_query_var('paged') ) {
          print ' | ' . __( 'Page ' , 'hbd-theme') . get_query_var('paged');
      }
  } // end get_page_number

  // Custom callback to list comments in the hbd-theme style
  function custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
      $GLOBALS['comment_depth'] = $depth;
    ?>
      <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
          <div class="comment-author vcard"><?php commenter_link() ?></div>
          <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'hbd-theme'),
                      get_comment_date(),
                      get_comment_time(),
                      '#comment-' . get_comment_ID() );
                      edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'hbd-theme') ?>
            <div class="comment-content">
              <?php comment_text() ?>
          </div>
          <?php // echo the comment reply link
              if($args['type'] == 'all' || get_comment_type() == 'comment') :
                  comment_reply_link(array_merge($args, array(
                      'reply_text' => __('Reply','hbd-theme'),
                      'login_text' => __('Log in to reply.','hbd-theme'),
                      'depth' => $depth,
                      'before' => '<div class="comment-reply-link">',
                      'after' => '</div>'
                  )));
              endif;
          ?>
  <?php } // end custom_comments
  
  // Custom callback to list pings
  function custom_pings($comment, $args, $depth) {
         $GLOBALS['comment'] = $comment;
          ?>
              <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                  <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'hbd-theme'),
                          get_comment_author_link(),
                          get_comment_date(),
                          get_comment_time() );
                          edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
      <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'hbd-theme') ?>
              <div class="comment-content">
                  <?php comment_text() ?>
              </div>
  <?php } // end custom_pings
  
  // Produces an avatar image with the hCard-compliant photo class
  function commenter_link() {
      $commenter = get_comment_author_link();
      if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
          $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
      } else {
          $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
      }
      $avatar_email = get_comment_author_email();
      $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
      echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
  } // end commenter_link
  
  // For category lists on category archives: Returns other categories except the current one (redundant)
  function cats_meow($glue) {
      $current_cat = single_cat_title( '', false );
      $separator = "\n";
      $cats = explode( $separator, get_the_category_list($separator) );
      foreach ( $cats as $i => $str ) {
          if ( strstr( $str, ">$current_cat<" ) ) {
              unset($cats[$i]);
              break;
          }
      }
      if ( empty($cats) )
          return false;

      return trim(join( $glue, $cats ));
  } // end cats_meow
  
  // For tag lists on tag archives: Returns other tags except the current one (redundant)
  function tag_ur_it($glue) {
      $current_tag = single_tag_title( '', '',  false );
      $separator = "\n";
      $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
      foreach ( $tags as $i => $str ) {
          if ( strstr( $str, ">$current_tag<" ) ) {
              unset($tags[$i]);
              break;
          }
      }
      if ( empty($tags) )
          return false;

      return trim(join( $glue, $tags ));
  } // end tag_ur_it
  
  // Register widgetized areas
  function theme_widgets_init() {
      // Area 1
      register_sidebar( array (
      'name' => 'Primary Widget Area',
      'id' => 'primary_widget_area',
      'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
      'after_widget' => "</li>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );

      // Area 2
      register_sidebar( array (
      'name' => 'Secondary Widget Area',
      'id' => 'secondary_widget_area',
      'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
      'after_widget' => "</li>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );
  } // end theme_widgets_init

  add_action( 'init', 'theme_widgets_init' );
  
  $preset_widgets = array (
      'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
      'secondary_widget_area'  => array( 'links', 'meta' )
  );
  if ( isset( $_GET['activated'] ) ) {
      update_option( 'sidebars_widgets', $preset_widgets );
  }
  // update_option( 'sidebars_widgets', NULL );
  
  // Check for static widgets in widget-ready areas
  function is_sidebar_active( $index ){
    global $wp_registered_sidebars;

    $widgetcolums = wp_get_sidebars_widgets();

    if ($widgetcolums[$index]) return true;

      return false;
  } // end is_sidebar_active

  // Unhook the WooCommerce wrappers
  remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
  remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

  // Hook own functions to display the wrappers this theme requires
  add_action('woocommerce_before_main_content', 'foodpuzzle_theme_wrapper_start', 10);
  add_action('woocommerce_after_main_content', 'foodpuzzle_theme_wrapper_end', 10);

  // Remove breadcrumbs
  add_action( 'init', 'jk_remove_wc_breadcrumbs' );
  
  function jk_remove_wc_breadcrumbs() {
      remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
  }

  function foodpuzzle_theme_wrapper_start() {
    echo '<section id="main-section">';
  }

  function foodpuzzle_theme_wrapper_end() {
    echo '</section>';
  }

  add_action( 'after_setup_theme', 'woocommerce_support' );
  function woocommerce_support() {
      add_theme_support( 'woocommerce' );
  }

  add_action( 'woocommerce_after_shop_loop_item_title', 'my_add_short_description', 9 );
  function my_add_short_description() {
      echo '<span class="title-description">' . the_excerpt() . '</span><br />';
  }

  add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
  function wcs_woo_remove_reviews_tab($tabs) {
   unset($tabs['reviews']);
   return $tabs;
  }

  function register_my_menus() {
    register_nav_menus(
      array(
        'main-menu' => __( 'main-menu' ),
        'footer-menu' => __( 'Footer menu' )
      )
    );
  }

  add_action( 'init', 'register_my_menus' );

  // Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
  add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
  function woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
     <a class="main-cart cart-contents " href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><span class="qty"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span></a>
    <?php
    
    $fragments['a.cart-contents'] = ob_get_clean();
    
    return $fragments;
  }


  // Custom product fields

  // Display Fields
  add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

  // Save Fields
  add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );


  function woo_add_custom_general_fields() {

    global $woocommerce, $post;
    
    echo '<div class="options_group">';
    
    // Text Field
    woocommerce_wp_text_input( 
      array( 
        'id'          => '_teaser_text_field', 
        'label'       => __( 'Короткий опис до готування', 'woocommerce' ) 
      )
    );
    
    // Text Field
    woocommerce_wp_text_input( 
    	array( 
    		'id'          => '_weight_text_field', 
    		'label'       => __( 'Вага порції', 'woocommerce' ), 
    		'placeholder' => '100гр',
    		'desc_tip'    => 'true',
    		'description' => __( 'Буде виводитись на детальній сторінці продукту', 'woocommerce' ) 
    	)
    );

    // Textarea
    woocommerce_wp_textarea_input( 
    	array( 
    		'id'          => '_weight_textarea', 
    		'label'       => __( 'Короткий опис', 'woocommerce' ), 
    		'placeholder' => '', 
    		'description' => __( 'суп дуже ситний, наїсться навіть', 'woocommerce' ) 
    	)
    );

    // Text Field
    woocommerce_wp_text_input( 
    	array( 
    		'id'          => '_time_text_field', 
    		'label'       => __( 'Час приготування', 'woocommerce' ), 
    		'placeholder' => '15-20хв'
    	)
    );

    // Textarea
    woocommerce_wp_textarea_input( 
    	array( 
    		'id'          => '_time_textarea', 
    		'label'       => __( 'Короткий опис до часу приготування', 'woocommerce' ), 
    		'placeholder' => '', 
    		'description' => __( 'ви встигнете навіть нафарбувати нігті', 'woocommerce' ) 
    	)
    );

    // Text Field
    woocommerce_wp_text_input( 
    	array( 
    		'id'          => '_difficulty_text_field', 
    		'label'       => __( 'Рівень складності', 'woocommerce' ), 
    		'placeholder' => 'легко'
    	)
    );

    // Textarea
    woocommerce_wp_textarea_input( 
    	array( 
    		'id'          => '_difficulty_textarea', 
    		'label'       => __( 'Короткий опис до складності', 'woocommerce' ), 
    		'placeholder' => '', 
    		'description' => __( 'приготує навіть ваша дитина', 'woocommerce' ) 
    	)
    );
    
    echo '</div>';


    
    echo '<div class="options_group">';

    // Textarea
    woocommerce_wp_textarea_input( 
    	array( 
    		'id'          => '_ingridients_list_textarea', 
    		'label'       => __( 'Що входить в доставку', 'woocommerce' ), 
    		'placeholder' => 'Броколі,папір,ложка,тарілка', 
    		'description' => __( 'Перелічіть товари, які будуть в упаковці, через кому. Приклад: "Броколі,мясо,шинка,паста"', 'woocommerce' ) 
    	)
    );

    // Textarea
    woocommerce_wp_textarea_input( 
    	array( 
    		'id'          => '_required_items_textarea', 
    		'label'       => __( 'Що потрібно мати клієнту', 'woocommerce' ), 
    		'placeholder' => 'Сотейник,блендер,жінка', 
    		'description' => __( 'Перелічіть товари, які потрібні клієнту, через кому. Приклад: "Сотейник,блендер,жінка"', 'woocommerce' ) 
    	)
    );

    echo '</div>';
  	
  }

  function woo_add_custom_general_fields_save( $post_id ){
    // Text Field
    $woocommerce_text_field = $_POST['_teaser_text_field'];
    if( !empty( $woocommerce_text_field ) )
      update_post_meta( $post_id, '_teaser_text_field', esc_attr( $woocommerce_text_field ) );

  	// Text Field
  	$woocommerce_text_field = $_POST['_weight_text_field'];
  	if( !empty( $woocommerce_text_field ) )
  		update_post_meta( $post_id, '_weight_text_field', esc_attr( $woocommerce_text_field ) );

  	// Textarea
  		$woocommerce_textarea = $_POST['_weight_textarea'];
  		if( !empty( $woocommerce_textarea ) )
  			update_post_meta( $post_id, '_weight_textarea', esc_html( $woocommerce_textarea ) );
  		
  	// Text Field
  	$woocommerce_text_field = $_POST['_time_text_field'];
  	if( !empty( $woocommerce_text_field ) )
  		update_post_meta( $post_id, '_time_text_field', esc_attr( $woocommerce_text_field ) );

  	// Textarea
  		$woocommerce_textarea = $_POST['_time_textarea'];
  		if( !empty( $woocommerce_textarea ) )
  			update_post_meta( $post_id, '_time_textarea', esc_html( $woocommerce_textarea ) );

  	// Text Field
  	$woocommerce_text_field = $_POST['_difficulty_text_field'];
  	if( !empty( $woocommerce_text_field ) )
  		update_post_meta( $post_id, '_difficulty_text_field', esc_attr( $woocommerce_text_field ) );

  	// Textarea
  		$woocommerce_textarea = $_POST['_difficulty_textarea'];
  		if( !empty( $woocommerce_textarea ) )
  			update_post_meta( $post_id, '_difficulty_textarea', esc_html( $woocommerce_textarea ) );

  	// Textarea
  		$woocommerce_textarea = $_POST['_ingridients_list_textarea'];
  		if( !empty( $woocommerce_textarea ) )
  			update_post_meta( $post_id, '_ingridients_list_textarea', esc_html( $woocommerce_textarea ) );

  	// Textarea
  		$woocommerce_textarea = $_POST['_required_items_textarea'];
  		if( !empty( $woocommerce_textarea ) )
  			update_post_meta( $post_id, '_required_items_textarea', esc_html( $woocommerce_textarea ) );
  	
  }

  function remove_linked_products($tabs){
    unset($tabs['inventory']);

    unset($tabs['shipping']);

    unset($tabs['linked_product']);

    unset($tabs['attribute']);

    unset($tabs['advanced']);

    return($tabs);
  }

  add_filter('woocommerce_product_data_tabs', 'remove_linked_products', 10, 1);

  /*
   * wc_remove_related_products
   * 
   * Clear the query arguments for related products so none show.
   * Add this code to your theme functions.php file.  
   */
  function wc_remove_related_products( $args ) {
  	return array();
  }
  add_filter('woocommerce_related_products_args','wc_remove_related_products', 10); 

  // Hook in
  add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

  // Our hooked in function - $fields is passed via the filter!
  function custom_override_checkout_fields( $fields ) {
       unset($fields['order']['order_comments']);

       unset($fields['billing']['billing_company']);
       unset($fields['billing']['billing_address_2']);
       unset($fields['billing']['billing_city']);
       unset($fields['billing']['billing_postcode']);
       unset($fields['billing']['billing_country']);
       unset($fields['billing']['billing_state']);
       unset($fields['billing']['billing_last_name']);

       return $fields;
  }

  //NUMBER OF PRODICTS TO DISPLAY ON SHOP PAGE
  add_filter('loop_shop_per_page', create_function('$cols', 'return 1000;'));

  add_filter( 'woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1 );
  function wc_hide_trailing_zeros( $trim ) {
      // set to false to show trailing zeros
      return true;
  }

  /**
   * Change the Shop archive page title.
   * @param  string $title
   * @return string
   */
  function wc_custom_shop_archive_title( $title ) {
    if ( is_shop() ) {
      return str_replace( __( 'Products', 'woocommerce' ), 'Страви', $title );
    }

    return $title;
  }

  add_filter( 'wp_title', 'wc_custom_shop_archive_title' );
?>