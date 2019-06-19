<header>
  <div class="container">
    <div class="row">
      <div class="align-items-center col-6 col-lg-auto d-flex flex-row">
        <a class="logo" href="/"><img alt="<?php echo get_field('logo', 'option')['alt']; ?>" src="<?php echo get_field('logo', 'option')['url']; ?>"></a>
      </div>
      <div class="align-items-center col-6 col-lg d-flex flex-row justify-content-end">
        <nav id="navigation">
          <?php // $menu = wp_get_nav_menu_items('Main menu'); ?>
          <?php // echo print_multi_level_menu($menu); ?>
        </nav>
        <div class="d-lg-none d-block">
          <button class="align-items-center d-flex flex-row p-0" id="burger" name="menu" type="button">
            <span>Menu</span>
            <span class="burger"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</header>