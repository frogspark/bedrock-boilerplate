<header>
  <div class="container">
    <div class="row">
      <div class="col-6 col-lg-auto d-flex align-items-center">
        <a class="logo" href="/"><img alt="<?php echo get_bloginfo('name'); ?>" src="<?php echo get_field('logo', 'option')['url']; ?>"></a>
      </div>
      <div class="col-6 col-lg d-flex align-items-center justify-content-end">
        <nav class="d-none d-lg-block h-100 w-100 position-relative" id="navigation">
          <?php // $menu = wp_get_nav_menu_items('Main menu'); ?>
          <?php // echo print_multi_level_menu($menu); ?>
        </nav>
        <nav class="d-block d-lg-none" id="navigation-mobile">
          <?php // $menu = wp_get_nav_menu_items('Main menu'); ?>
          <?php // echo print_multi_level_menu($menu); ?>
        </nav>
        <div class="d-block d-lg-none">
          <button class="d-flex align-items-center p-0" id="burger" name="menu" type="button">
            <span class="burger"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</header>