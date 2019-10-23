<header>
  <div class="container">
    <div class="row">
      <div class="align-items-center col-6 col-lg-auto d-flex flex-row">
        <a class="logo" href="/"><img alt="Logo" src="<?php echo get_field('logo', 'option')['url']; ?>"></a>
      </div>
      <div class="align-items-center col-6 col-lg d-flex flex-row justify-content-end">
        <nav class="d-none d-lg-block" id="navigation">
          <?php // $menu = wp_get_nav_menu_items('Main menu'); ?>
          <?php // echo print_multi_level_menu($menu); ?>
        </nav>
        <nav class="d-block d-lg-none" id="navigation-mobile">
          <?php // $menu = wp_get_nav_menu_items('Main menu'); ?>
          <?php // echo print_multi_level_menu($menu); ?>
        </nav>
        <div class="d-lg-none d-block">
          <button class="align-items-center d-flex flex-row p-0" id="burger" name="menu" type="button">
            <span class="burger"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</header>