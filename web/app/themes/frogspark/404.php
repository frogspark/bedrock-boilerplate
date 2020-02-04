<?php if (is_404()): ?>
<?php get_header(); ?>
<?php get_navigation(); ?>

<section class="align-items-center bg-gradient hero mb-16 mobile-bg-secondary py-16 py-lg-24">
  <div class="container">
    <div class="row">
      <div class="col-12" data-aos="fade-up" data-aos-delay="200">
        <div class="row">
          <div class="col-12 col-lg-8 col-xl-6 offset-lg-2 offset-xl-3 text-center">
            <h1 class="mb-0 text-quaternary text-uppercase"><?php the_field('title', 'error_page'); ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="pb-16">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 offset-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="wysiwyg"><?php the_field('content', 'error_page'); ?></div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
<?php endif; ?>