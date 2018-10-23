<?php get_header(); ?>

<?php get_template_part('navigation', 'default'); ?>

<?php
  global $wp_query;
  $result_count = $wp_query->found_posts;
  if ($result_count == 1) {
      $results = 'result';
  } else {
      $results = 'results';
  }
?>
<section class="container py-8">
  <div class="row">
<?php if (have_posts()): ?>
  <div class="col-24" data-aos="fade-in">
    <p class="mb-5">Your search returned <span class="text-primary"><?php echo $result_count; ?></span> <?php echo $results; ?>...</p>

  <ul class="nav flex-column">
  <?php while (have_posts()): the_post(); ?>
    <?php $fields = get_fields($post->ID); ?>

      <li class="mb-3"><a href="<?php the_permalink(); ?>" class="text-primary lead"><?php the_title(); ?></a>
        <?php if (get_field('introduction')): ?>
          <span class="d-block">
          <?php
            /**
            * Needlessly complex string trimming, sorry
            */
            $char_limit = 140; // The number of characters
            $heading = get_field('introduction'); // The original, unaltered heading

            // If the heading is longer than our limit...
            if (strlen($heading) > $char_limit) {
                // ...trim the heading
                $trimmed_heading = substr($heading, 0, $char_limit);

                // If the last character is not a letter...
                while (preg_match('([^a-zA-Z])', substr($trimmed_heading, -1), $matches)) {
                    // ...reduce the string length by 1 character until it is...
                    $trimmed_heading = substr($heading, 0, $char_limit--);
                }
                echo $trimmed_heading;
                // ...so that our ellipsis makes sense
                echo '...';
            } else {
                // Else just print the unaltered heading
                echo $heading;
            }
          ?>
        </span>
    <?php endif; ?>
    </li>

  <?php endwhile; wp_reset_postdata(); ?>
  </ul>
  </div>
<?php else: ?>
  <div class="col-24" data-aos="fade-in">
    <p>Sorry, there are no results that matched your search criteria.</p>
  </div>
<?php endif;?>
</div>
</section>

<?php get_footer(); ?>
