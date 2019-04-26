<?php

include_once 'lib/bootstrap-four-wp-navwalker.php';

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

require get_template_directory() . '/inc/customizer.php';

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
* Print multi-level menu.
*/

function print_multi_level_menu($menu, $parent_item_class = 'parent-item'){
  reset($menu);
  $submenu = false;
  $parent = null;
  echo '<ul class="nav">';
  foreach ($menu as $current){
    $anchor_class = 'nav-link';
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
        echo '<ul class="nav flex-column">';
      }
    } else {
      if ($next && $next->menu_item_parent != 0) {
        $anchor_class = 'nav-link ';
        $anchor_class .= $parent_item_class;
      }
    }
    echo '<li class="nav-item">';
    echo '<a href="' . $current->url . '" class="' . $anchor_class . '">';
    echo $current->title;
    echo '</a>';
    if ($current->menu_item_parent == $parent->ID) {
      echo '</li>';
    }
    if (!$next){
      if ($current->menu_item_parent != 0) {
        echo '</ul></div>';
      } else {
        echo '</li>';
      }
    }
  }
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
* Add Shortcodes
*/

function get_email_address(){
  $email_address = get_field('email_address', 'options');
  return "<a href=\"mailto:{$email_address}\">{$email_address}</a>";
}
function get_phone_number(){
  $phone_number = get_field('phone_number', 'options');
  $number = ltrim($phone_number, '0');
  $tel = str_replace(' ', '', $number);
  return "<a href=\"tel:{$tel}\">{$number}</a>";
}
function register_shortcodes(){
  add_shortcode('email', 'get_email_address');
  add_shortcode('phone', 'get_phone_number');
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