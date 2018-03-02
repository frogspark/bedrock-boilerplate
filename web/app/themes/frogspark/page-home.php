<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_header(); ?>

  <?php get_template_part( 'navigation-default' ); ?>

  <div class="hero" style="background: linear-gradient(to bottom, rgba(0,0,0,0.74), rgba(0,0,0,0.2)), url('./app/themes/frogspark/img/hero.jpg');">
    <div class="container hero-content">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="hero-h1">Header</h1>
          <h2 class="hero-h2">Subheader</h2>
          <a href="#" class="btn btn--primary">Find out more</a>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
