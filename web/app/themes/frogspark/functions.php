<?php

/*
* Bootstrap 4.
*/

global $bootstrap_four_version;
$bootstrap_four_version = '4.0.0';

if (! function_exists('bootstrap_four_setup')):
  function bootstrap_four_setup(){
    add_theme_support('title-tag');
    add_theme_support('html5', array(
      'search-form',
    ));
    register_nav_menus(array(
      'main_menu' => __('Main menu', 'bootstrap-four'),
    ));
    add_editor_style('css/bootstrap-new.css');
  }
endif;
add_action('after_setup_theme', 'bootstrap_four_setup');

if (! function_exists('bootstrap_four_theme_scripts')):
  function bootstrap_four_theme_scripts() {
    global $bootstrap_four_version;
  }
endif;
add_action('wp_enqueue_scripts', 'bootstrap_four_theme_scripts');

/*
* Define ACF.
*/

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
* Print menu.
*/

function print_menu($menu, $parent_item_class = 'parent-item'){
  reset($menu);
  $submenu = false;
  $parent = null;
  echo '<ul class="nav">';
  foreach ($menu as $current):
    $anchor_class = 'nav-link p-0';
    if ($current->menu_item_parent == 0):
      if ($parent != null):
        echo '</li>';
      endif;
      $parent = $current;
      if ($submenu == true):
        $submenu = false;
        echo '</ul></div>';
      endif;
    endif;
    $next = next($menu);
    if ($current->menu_item_parent == $parent->ID):
      if (!$submenu):
        $submenu = true;
        echo '<div class="pb-4 pt-8 px-8 submenu">';
        echo '<ul class="flex-column nav">';
      endif;
    else:
      if ($next && $next->menu_item_parent != 0):
        $anchor_class = 'nav-link p-0 ';
        $anchor_class .= $parent_item_class;
      endif;
    endif;
    echo '<li class="nav-item">';
    echo '<a class="'.$anchor_class.'" href="'.$current->url.'">';
    echo $current->title;
    echo '</a>';
    if ($current->menu_item_parent == $parent->ID):
      echo '</li>';
    endif;
    if (!$next):
      if ($current->menu_item_parent != 0):
        echo '</ul></div>';
      else:
        echo '</li>';
      endif;
    endif;
  endforeach;
  echo '</ul>';
}

/*
* Print mobile menu.
*/

function print_mobile_menu($menu, $parent_item_class = 'parent-item'){
  reset($menu);
  $submenu = false;
  $parent = null;
  echo '<div class="pt-30 pb-2"><div class="container"><div class="g-0 mx-n4 row"><div class="col-12">';
  echo '<ul class="nav">';
  foreach ($menu as $current):
    $anchor_class = 'nav-link p-0';
    if ($current->menu_item_parent == 0):
      if ($parent != null):
        echo '</li>';
      endif;
      $parent = $current;
      if ($submenu == true):
        $submenu = false;
        echo '</ul></div>';
      endif;
    endif;
    $next = next($menu);
    if ($current->menu_item_parent == $parent->ID):
      if (!$submenu):
        $submenu = true;
        echo '<div class="submenu">';
        echo '<ul class="flex-column nav">';
      endif;
    else:
      if ($next && $next->menu_item_parent != 0):
        $anchor_class = 'nav-link p-0 ';
        $anchor_class .= $parent_item_class;
      endif;
    endif;
    echo '<li class="nav-item">';
    echo '<a class="'.$anchor_class.'" href="'.$current->url.'">';
    echo $current->title;
    echo '</a>';
    if ($current->menu_item_parent == $parent->ID):
      echo '</li>';
    endif;
    if($next && $next->menu_item_parent != 0 && $current->menu_item_parent != $parent->ID){
      echo '<span class="submenu-toggle"><i class="far fa-chevron-down text-primary"></i></span>';
    }
    if (!$next):
      if ($current->menu_item_parent != 0):
        echo '</ul></div>';
      else:
        echo '</li>';
      endif;
    endif;
  endforeach;
  echo '</ul>';
  echo '</div></div></div></div>';
}

/*
* Wordpress menu separator.
*/

function add_admin_menu_separator($position){
  global $menu;
  $menu[$position] = array(
    0	=> '',
    1	=> 'read',
    2	=> 'separator'.$position,
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
  echo 'Web Design Derby - <a href="https://frogspark.co.uk" target="_blank">Frogspark</a>';
}   
add_filter('admin_footer_text', 'remove_footer_admin');

/*
* Disables RSS feeds site-wide.
*/

function rss_disable_feed() {
  wp_die(__('No RSS feed is available. Please visit our <a href="'. get_bloginfo('url') .'">homepage</a>'));
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

/*
* Adds a custom logo to the login page.
*/

function custom_login_logo() {
  echo '<style type="text/css">
    h1 a { 
      background-image: url('.get_field('logo', 'option')['url'].') !important;
      background-position: center !important;
      background-repeat: no-repeat !important;
      background-size: contain !important;
      height: 0 !important;
      padding-bottom: 25% !important;
      width: 100% !important;
    }
  </style>';
}
add_action('login_head', 'custom_login_logo');

/*
* Disables the admin bar.
*/

add_filter('show_admin_bar', '__return_false');