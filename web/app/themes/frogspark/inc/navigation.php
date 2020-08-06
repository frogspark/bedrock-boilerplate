<nav class="navbar navbar-expand-xl bg-white py-3 navbar-custom main-nav" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <?php $logo = get_field('logo', 'options'); ?>
        <?php if( $logo ): $logo_alt = $logo['alt']; endif; ?>
        <a class="navbar-brand" href="/"><img height="60px" src="<?php echo $logo['url']; ?>" alt="<?php if($logo): echo $logo_alt; endif; ?>"></a>
        
        <button class="hamburger navbar-toggler d-flex d-xl-none hamburger--collapse" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>

        <?php
            wp_nav_menu( array(
                'theme_location'    => 'main_menu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav ml-auto',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
            ) );
        ?>
    </div>
</nav>