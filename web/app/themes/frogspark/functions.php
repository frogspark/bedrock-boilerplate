<?php

global $bootstrap_four_version;

$bootstrap_four_version = '4.0.0';

if (! isset($content_width)) {
  $content_width = 837;
}

if (! function_exists('bootstrap_four_widgets_init')):
  function bootstrap_four_widgets_init(){
    register_sidebar(
      array(
        'name' => __('Footer Column One', 'bootstrap-four'),
        'id' => 'footer_column_one',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
      )
    );
    register_sidebar(
      array(
        'name' => __('Footer Column Two', 'bootstrap-four'),
        'id' => 'footer_column_two',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
      )
    );
    register_sidebar(
      array(
        'name' => __('Footer Column Three', 'bootstrap-four'),
        'id' => 'footer_column_three',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
      )
    );
    register_sidebar(
      array(
        'name' => __('Footer Column Four', 'bootstrap-four'),
        'id' => 'footer_column_four',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
      )
    );
    register_sidebar(array(
      'name' => __('Sidebar', 'bootstrap-four'),
      'id' => 'sidebar',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
    ));
  }
endif;
add_action('widgets_init', 'bootstrap_four_widgets_init');

if (! function_exists('bootstrap_four_setup')):
  function bootstrap_four_setup(){
    add_theme_support('custom-background', array(
      'default-color' => 'ffffff',
    ));
    
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ));
    
    register_nav_menus(array(
      'main_menu' => __('Main Menu', 'bootstrap-four'),
    ));

    add_editor_style('css/bootstrap-new.css');
  }
endif;
add_action('after_setup_theme', 'bootstrap_four_setup');

if (! function_exists('bootstrap_four_theme_styles')):
  function bootstrap_four_theme_styles(){
    global $bootstrap_four_version;
  }
endif;
add_action('wp_enqueue_scripts', 'bootstrap_four_theme_styles');


if (! function_exists('bootstrap_four_theme_scripts')):
  function bootstrap_four_theme_scripts()
  {
      global $bootstrap_four_version;
  }
endif;
add_action('wp_enqueue_scripts', 'bootstrap_four_theme_scripts');


function bootstrap_four_nav_li_class($classes, $item){
  $classes[] .= ' nav-item';
  return $classes;
}
add_filter('nav_menu_css_class', 'bootstrap_four_nav_li_class', 10, 2);

function bootstrap_four_nav_anchor_class($atts, $item, $args){
  if(isset($atts['class'])):
    $atts['class'] .= ' nav-link';
  endif;
  return $atts;
}
add_filter('nav_menu_link_attributes', 'bootstrap_four_nav_anchor_class', 10, 3);

function bootstrap_four_comment_form_before(){
  echo '<div class="card"><div class="card-block">';
}
add_action('comment_form_before', 'bootstrap_four_comment_form_before', 10, 5);

function bootstrap_four_comment_form($fields){
  $fields['fields']['author'] = '
    <fieldset class="form-group comment-form-email">
      <label for="author">' . __('Name *', 'bootstrap-four') . '</label>
      <input type="text" class="form-control" name="author" id="author" placeholder="' . __('Name', 'bootstrap-four') . '" aria-required="true" required>
    </fieldset>';
  $fields['fields']['email'] ='
    <fieldset class="form-group comment-form-email">
      <label for="email">' . __('Email address *', 'bootstrap-four') . 'Email address *</label>
      <input type="email" class="form-control" id="email" placeholder="' . __('Enter email', 'bootstrap-four') . '" aria-required="true" required>
      <small class="text-muted">' . __('Your email address will not be published.', 'bootstrap-four') . '</small>
    </fieldset>';
  $fields['fields']['url'] = '
    <fieldset class="form-group comment-form-email">
      <label for="url">' . __('Website *', 'bootstrap-four') . '</label>
      <input type="text" class="form-control" name="url" id="url" placeholder="' . __('http://example.org', 'bootstrap-four') . '">
    </fieldset>';
  $fields['comment_field'] = '
    <fieldset class="form-group">
      <label for="comment">' . __('Comment *', 'bootstrap-four') . '</label>
      <textarea class="form-control" id="comment" name="comment" rows="3" aria-required="true" required></textarea>
    </fieldset>';
  $fields['comment_notes_before'] = '';
  $fields['class_submit'] = 'btn btn-primary';
  return $fields;
}
add_filter('comment_form_defaults', 'bootstrap_four_comment_form', 10, 5);

function bootstrap_four_comment_form_after(){
  echo '</div><!-- .card-block --></div><!-- .card -->';
}
add_action('comment_form_after', 'bootstrap_four_comment_form_after', 10, 5);


/*
* Bootstrap 4 functions.
*/

function bootstrap_four_get_posts_pagination($args = ''){
  global $wp_query;
  $pagination = '';

  if($GLOBALS['wp_query']->max_num_pages > 1):
    $defaults = array(
      'total' => isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1,
      'current' => get_query_var('paged') ? intval(get_query_var('paged')) : 1,
      'type' => 'array',
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
    );
    $params = wp_parse_args($args, $defaults);
    $paginate = paginate_links($params);
    if($paginate):
      $pagination .= "<ul class='pagination'>";
      foreach ($paginate as $page):
        if (strpos($page, 'current')):
          $pagination .= "<li class='active'>$page</li>"; else :
          $pagination .= "<li>$page</li>";
        endif;
      endforeach;
      $pagination .= "</ul>";
    endif;
  endif;
  return $pagination;
}

function bootstrap_four_the_posts_pagination($args = ''){
  echo bootstrap_four_get_posts_pagination($args);
}

define('ACF_EARLY_ACCESS', '5');

/*
* ACF map.
*/

function google_API_key(){
  acf_update_setting('google_api_key', 'AIzaSyBCYAhBrCAzjCaD20jz2WacR9T-7Dw2HO0');
}
add_action('acf/init', 'google_API_key');

/*
* Help.
*/

function help($value){
  try {
      echo '<pre>';
      print_r($value);
      echo '</pre>';
  } catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage();
  }
  return;
}

/*
* Allow SVG upload.
*/

function cc_mime_types($mimes){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*
* Allow featured image 
*/
function mytheme_post_thumbnails() {
  add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'mytheme_post_thumbnails' );

/*
* Print multi-level menu.
*/

// function print_multi_level_menu($menu, $parent_item_class = 'parent-item'){
//   reset($menu);
//   $submenu = false;
//   $parent = null;
//   echo '<ul class="nav">';
//   foreach ($menu as $current){
//     $anchor_class = 'nav-link';
//     if ($current->menu_item_parent == 0){
//       if ($parent != null) {
//         echo '</li>';
//       }
//       $parent = $current;
//       if ($submenu == true){
//         $submenu = false;
//         echo '</ul></div>';
//       }
//     }
//     $next = next($menu);
//     if ($current->menu_item_parent == $parent->ID){
//       if (!$submenu){
//         $submenu = true;
//         echo '<div class="submenu">';
//         echo '<ul class="flex-column nav">';
//       }
//     } else {
//       if ($next && $next->menu_item_parent != 0) {
//         $anchor_class = 'nav-link ';
//         $anchor_class .= $parent_item_class;
//       }
//     }
//     echo '<li class="nav-item">';
//     echo '<a href="'.$current->url.'" class="'.$anchor_class.'">';
//     echo $current->title;
//     echo '</a>';
//     if ($current->menu_item_parent == $parent->ID) {
//       echo '</li>';
//     }
//     if($next && $next->menu_item_parent != 0 && $current->menu_item_parent != $parent->ID){
//       echo '<span class="submenu-toggle"></span>';
//     }
//     if (!$next){
//       if ($current->menu_item_parent != 0) {
//         echo '</ul></div>';
//       } else {
//         echo '</li>';
//       }
//     }
//   }
//   echo '</ul>';
// }

function print_multi_level_menu($menu, $parent_item_class = 'parent-item'){
  reset($menu);
  $submenu = false;
  $parent = null;
  echo '<ul class="nav">';
  foreach ($menu as $current){
    $anchor_class = 'nav-link d-flex align-items-center font-weight-medium';
    if ($current->menu_item_parent == 0){
      if ($parent != null) {
        echo '</li>';
      }
      $parent = $current;
      if ($submenu == true){
        $submenu = false;
        echo '</ul></div>';
      }
    }
    $next = next($menu);
    if ($current->menu_item_parent == $parent->ID){
      if (!$submenu){
        $submenu = true;
        echo '<div class="submenu">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-12">';
        echo '<ul class="nav flex-lg-row flex-column">';
      }
    } else {
      if ($next && $next->menu_item_parent != 0) {
        $anchor_class = $anchor_class." ";
        $anchor_class .= $parent_item_class;
      }
    }
    echo '<li class="nav-item">';
    echo '<a href="'.$current->url.'" class="'.$anchor_class.'">';
    echo '<span class="link-text">';
    echo $current->title;
    echo '</span>';
    echo '</a>';
    if ($current->menu_item_parent == $parent->ID) {
      echo '</li>';
    }
    if($next && $next->menu_item_parent != 0 && $current->menu_item_parent != $parent->ID){
      echo '<span class="submenu-toggle d-xl-none d-block"></span>';
    }
    if (!$next){
      if ($current->menu_item_parent != 0) {
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      } else {
        echo '</li>';
      }
    }
  }
  echo '</ul>';
}

function print_mobile_menu($menu, $parent_item_class = 'parent-item'){
  reset($menu);
  $submenu = false;
  $parent = null;
  echo '<ul class="nav">';
  echo '<div class="container">';
  echo '<div class="row justify-content-center">';
  echo '<div class="col-lg-6 col-md-8 col-sm-10 col-11">';
  foreach ($menu as $current){
    $anchor_class = 'nav-link d-flex align-items-center justify-content-center font-weight-medium';
    if ($current->menu_item_parent == 0){
      if ($parent != null) {
        echo '</li>';
      }
      $parent = $current;
      if ($submenu == true){
        $submenu = false;
        echo '</ul></div>';
      }
    }
    $next = next($menu);
    if ($current->menu_item_parent == $parent->ID){
      if (!$submenu){
        $submenu = true;
        echo '<div class="submenu">';
        echo '<ul class="nav flex-lg-row flex-column">';
      }
    } else {
      if ($next && $next->menu_item_parent != 0) {
        $anchor_class = $anchor_class." ";
        $anchor_class .= $parent_item_class;
      }
    }
    echo '<li class="nav-item">';
    echo '<a href="'.$current->url.'" class="'.$anchor_class.'">';
    echo $current->title;
    echo '</a>';
    if ($current->menu_item_parent == $parent->ID) {
      echo '</li>';
    }
    if($next && $next->menu_item_parent != 0 && $current->menu_item_parent != $parent->ID){
      echo '<span class="submenu-toggle d-xl-none d-block"></span>';
    }
    if (!$next){
      if ($current->menu_item_parent != 0) {
        echo '</ul>';
        echo '</div>';
      } else {
        echo '</li>';
      }
    }
  }
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</ul>';
}

/*
* Wordpress menu separator.
*/

function add_admin_menu_separator($position){
  global $menu;
  $menu[$position] = array(
    0	=> '',
    1	=> 'read',
    2	=> 'separator' . $position,
    3	=> '',
    4	=> 'wp-menu-separator'
  );
}
add_action('admin_init', 'add_admin_menu_separator');

function set_admin_menu_separator(){
  do_action('admin_init', 26);
}
add_action('admin_menu', 'set_admin_menu_separator');

/*
* Options pages.
*/

if (function_exists('acf_add_options_page')) {
  /* Standard Options */
  acf_add_options_page();
  
  /* 404 */
  $error_page = array(
    'page_title' => '404 Page',
    'menu_slug' => 'error_page',
    'post_id' => 'error_page',
    'icon_url' => 'dashicons-warning'
  );
  acf_add_options_page($error_page);
}

/*
* Placing Yoast at the bottom of each page.
*/

add_action('add_meta_boxes', function(){
  remove_meta_box('nf_admin_metaboxes_appendaform', ['page', 'post'], 'side');
}, 99);

add_filter('wpseo_metabox_prio', function(){
  return 'low';
});

/*
* Remove the comments.
*/ 
function remove_all(){
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_all');

/*
* Hidden elements from the admin view.
*/

function remove_admin_only(){
  remove_menu_page('tools.php');
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
if (!current_user_can('administrator')){
  add_action('admin_menu', 'remove_admin_only');
}

/*
* Add shortcodes.
*/

function get_email_address(){
  $email_address = get_field('email_address', 'options');
  return "<a href=\"mailto:{$email_address}\">{$email_address}</a>";
}
function get_phone_number(){
  $phone_number = get_field('phone_number', 'options');
  return "<a href=\"tel:{$phone_number}\">{$phone_number}</a>";
}
function get_address(){
  $address = get_field('location', 'options')['address'];
  return "{$address}";
}
function get_company_number(){
  $company_number = get_field('company_number', 'options');
  return "{$company_number}";
}
function get_vat_number(){
  $vat_number = get_field('vat_number', 'options');
  return "{$vat_number}";
}
function get_sitename(){
  $sitename = get_bloginfo('name');
  return "{$sitename}";
}
function get_date(){
  $date = get_the_date('F Y');
  return "{$date}";
}
function register_shortcodes(){
  add_shortcode('email', 'get_email_address');
  add_shortcode('phone', 'get_phone_number');
  add_shortcode('address', 'get_address');
  add_shortcode('company_number', 'get_company_number');
  add_shortcode('vat_number', 'get_vat_number');
  add_shortcode('company', 'get_sitename');
  add_shortcode('date', 'get_date');
}
add_action('init', 'register_shortcodes');

/*
* Adds image classes.
*/

function add_image_class($class){
  $class .= ' img-fluid mb-4';
  return $class;
}
add_filter('get_image_tag_class', 'add_image_class');

/*
* Hides the taxonomy description.
*/

function admin_css() {
  echo '<style type="text/css">.term-description-wrap { display: none; }</style>';
}

/*
* Auto-closes all flexible content fields.
*/

add_action('admin_head', 'admin_css');
function my_acf_admin_head() {
  echo '<script type="text/javascript"> (function($){ $(document).ready(function(){ $(".layout").addClass("-collapsed"); }); })(jQuery); </script>';
}
add_action('acf/input/admin_head', 'my_acf_admin_head');

/*
* Adjusting the WordPress footer.
*/

function remove_footer_admin() {
  echo 'Website by <a href="https://frogspark.co.uk" target="_blank">Frogspark</a>';
}   
add_filter('admin_footer_text', 'remove_footer_admin');

/*
* Disables RSS feeds site-wide.
*/

function rss_disable_feed() {
  wp_die( __('No RSS feed is available. Please visit our <a href="'. get_bloginfo('url') .'">homepage</a>') );
}   
add_action('do_feed', 'rss_disable_feed', 1);
add_action('do_feed_rdf', 'rss_disable_feed', 1);
add_action('do_feed_rss', 'rss_disable_feed', 1);
add_action('do_feed_rss2', 'rss_disable_feed', 1);
add_action('do_feed_atom', 'rss_disable_feed', 1);

/*
* Removes the "Welcome" panel.
*/
remove_action('welcome_panel', 'wp_welcome_panel');

// Add support for featured images
add_theme_support( 'post-thumbnails' );

// /*
// * WooCommerce support.
// */
// add_theme_support('woocommerce');

// /*
// * Setting products per row.
// */
// add_filter('loop_shop_columns', 'loop_columns');
// if (!function_exists('loop_columns')) {
//   function loop_columns() {
//     return 3;
//   }
// }

// /*
// * Changing "cart" to "basket".
// */
// function woo_custom_change_cart_string($translated_text, $text, $domain) {
//   $translated_text = str_replace("cart", "basket", $translated_text);
//   $translated_text = str_replace("Cart", "Basket", $translated_text);
//   $translated_text = str_replace("View Cart", "View Basket", $translated_text);
// return $translated_text;
// }
// add_filter('gettext', 'woo_custom_change_cart_string', 100, 3);
// add_filter('ngettext', 'woo_custom_change_cart_string', 100, 3);
// add_filter('woocommerce_product_add_to_cart_text', 'woo_custom_single_add_to_cart_text');
// add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text');
// function woo_custom_single_add_to_cart_text() {
//   return __('Add to Basket', 'woocommerce');
// }

// /*
// * Removing the breadcrumbs.
// */
// add_action('init', 'woo_remove_wc_breadcrumbs');
// function woo_remove_wc_breadcrumbs() {
//   remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
// }

// /*
// * Adding the product gallery.
// */
// add_theme_support('wc-product-gallery-slider');
// add_theme_support('wc-product-gallery-lightbox');

// /*
// * Removing the "Additional information" tabs.
// */
// add_filter('woocommerce_product_tabs', 'frogspark_remove_product_tabs', 98);
// function frogspark_remove_product_tabs($tabs) {
//   unset($tabs['additional_information']); 
//   return $tabs;
// }

// /*
// * Hides categories from the product page.
// */
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// /*
// * Updating the search placeholder text.
// */
// // add_filter('gettext', 'translate_text');
// // add_filter('ngettext', 'translate_text');
// // function translate_text($translated) {
// // $translated = str_ireplace('Search products&hellip;', 'Search products', $translated);
// // return $translated;
// // }
// /*

// * Adjusting the product image.
// */
// function replacing_template_loop_product_thumbnail() {
//   remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
//   function wc_template_loop_product_replaced_thumb() {
//     global $post;
//     echo  '<div class="product-image"><div class="bg-landscape bg-p-center" style="background-image: url('.get_the_post_thumbnail_url($post->ID).');"></div></div>';
//   }
//   add_action( 'woocommerce_before_shop_loop_item_title', 'wc_template_loop_product_replaced_thumb', 10);
// }
// add_action( 'woocommerce_init', 'replacing_template_loop_product_thumbnail');

// /*
// * Adjusting the "Add to cart" button.
// */
// function remove_loop_button(){
//   remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
// }
// add_action('init','remove_loop_button');
// add_action('woocommerce_after_shop_loop_item', 'replace_add_to_cart');

// /**
//  * Returns product price based on sales.
//  * 
//  * @return string
//  */
// function get_product_price() {
//   global $product;
//   if( $product->is_on_sale() ) {
//       return $product->get_sale_price();
//   }
//   return $product->get_regular_price();
// }
// function replace_add_to_cart() {
//   global $product;
//   $link = $product->get_permalink();
//   if(has_term('keepsakes-shop', 'product_cat', $product->get_id())) {
//     echo '
//       <div class="d-flex flex-column">
//         <p class="mb-4 font-weight-bold">'.get_woocommerce_currency_symbol().get_product_price().'</p>
//         <a class="product-view" href="'.esc_attr($link).'">
//           <button class="btn-tertiary">
//             <div class="ml-auto">
//               view details
//             </div>
//           </button>
//         </a>
//       </div>';
//   }
//   else {
//     echo '
//       <a class="product-view" href="'.esc_attr($link).'">
//         <button class="btn-tertiary d-flex w-100">'.
//           get_woocommerce_currency_symbol().get_product_price().
//           '<div class="ml-auto">
//             add to basket
//             <i class="far fa-shopping-basket pl-3"></i>
//           </div>
//         </button>
//       </a>';
//   }
// }


// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating');

// function wc_add_short_description() {
// 	global $product;
//   echo '<div itemprop="description" class="wysiwyg mb-6">'.get_the_excerpt().'</div>';
// }
// add_action( 'woocommerce_after_shop_loop_item_title', 'wc_add_short_description' );

// /*
// * Removes related products.
// */
// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// /*
// * Adding alt tags to images.
// */
// add_filter('wp_get_attachment_image_attributes', 'change_attachement_image_attributes', 20, 2);
// function change_attachement_image_attributes($attr, $attachment){
//   $parent = get_post_field('post_parent', $attachment);
//   $type = get_post_field('post_type', $parent);
//   if($type != 'product'){
//     return $attr;
//   }
//   $title = get_post_field('post_title', $parent);
//   $attr['alt'] = $title;
//   $attr['title'] = $title;
//   return $attr;
// }
// add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
//   return array(
//       'width' => 300,
//       'height' => 300,
//       'crop' => 0,
//   );
// } );

/* rewright for permalinks */ 
function add_rewrite_rules(){
  global $wp_rewrite;
  add_rewrite_rule('^<*permalink structure here*>/([^/]*)/?','index.php?&collections=$matches[1]','top');
  // example of rewrite
  // add_rewrite_rule('^memorials/memorial-collections/([^/]*)/?','index.php?&collections=$matches[1]','top');
}
add_action('init', 'add_rewrite_rules');

/*
* Adds a custom logo to the login page.
*/
function custom_login_logo() {
  echo '<style type="text/css">
    h1 {
      border-radius: 4px;
      padding: 6px 10px !important;
    }
    h1 a { 
      background-image: url('.get_field('logo', 'option')['url'].') !important;
      background-position: center !important;
      background-repeat: no-repeat !important;
      background-size: contain !important;
      height: 0 !important;
      margin-bottom: 0 !important;
      padding-bottom: 25% !important;
      width: 100% !important;
    }
  </style>';
}
add_action('login_head', 'custom_login_logo');

function get_navigation() {
  return get_template_part('inc/_navigation');
}

function get_hero() {
  return get_template_part('inc/_hero');
}

function load_map_script() {
  return get_template_part('inc/_map-script');
}