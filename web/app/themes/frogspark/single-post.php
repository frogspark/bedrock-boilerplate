<?php
/**
 * Template Name: Single Post
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_header(); ?>

  <?php 
  
  $date = Date('d-m-Y', strtotime($post->post_date));
  
  ?>

  <?php get_template_part( 'navigation-default' ); ?>

  <section class="single-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <h2 class="header"><?php echo get_the_title(); ?></h2>
          <span class="single-blog__date">Posted <?php echo $date; ?></span>
        </div>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
