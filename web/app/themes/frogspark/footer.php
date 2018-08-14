<?php wp_footer(); ?>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-2">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column_one")) : endif; ?>
      </div>
      <div class="col-12 col-lg-2">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column_two")) : endif; ?>
      </div>
      <div class="col-12 col-lg-2">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column_three")) : endif; ?>
      </div>
      <div class="col-12 col-lg-2">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("footer_column_four")) : endif; ?>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
