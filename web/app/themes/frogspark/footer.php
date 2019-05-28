<?php wp_footer(); ?>

<footer>

    <section class="py-10 pt-lg-0 pb-lg-10" style="">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="footer-box py-10">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="px-lg-10">
                                        <h3>Making a difference to people with mental health issues and <span
                                                class="underline-this">their families</span></h3>
                                        <button type="button" class="btn btn-lg btn-purple btn-global">Donate To
                                            Headhigh</button></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="px-lg-10 pt-10 pt-sm-0">
                                        <h3>Making a difference to people with mental health issues and <span
                                                class="underline-this-green">their families</span></h3>
                                        <button type="button" class="btn btn-lg btn-green btn-global">How to be involved</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container footer-spacing">
        <div class="row">
            <div class="col-lg-6">
                <a class="navbar-brand" href="/">

                    <?php 
                    $image = get_field('logo', 'options');
                    if( !empty($image) ): ?>
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <?php endif; ?>

                </a>

                <p class="pt-10 copyright"><?php the_field('copyright', 'options'); ?></p>
            </div>
            <div class="col-lg-6 col-12 pt-10 pt-sm-0">

                <nav class="navbar navbar-expand navbar-light bg-light navbar-custom" role="navigation">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'main_menu',
                            'depth'             => 2,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse justify-content-lg-end',
                            'container_id'      => 'bs-example-navbar-collapse-1',
                            'menu_class'        => 'nav nav-footer navbar-nav align-items-center',
                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'            => new WP_Bootstrap_Navwalker(),
                        ) );
                    ?>
                </nav>

                <div class="justify-content-lg-end d-lg-flex pt-5 pt-lg-10 align-items-center">

                    <div class="social-media mr-lg-10">
                        <?php $social = get_field('social', 'options'); ?>
                        <?php foreach ($social as $item): ?>
                        <a href="<?php echo $item['social_url']; ?>"><i
                                class="fab rounded-circle fa-<?php echo $item['social']; ?>"></i></a>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="mt-5 mt-sm-0 btn btn-lg btn-purple btn-global">Donate</button></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

</body>

</html>