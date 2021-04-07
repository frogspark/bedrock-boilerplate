<?php /* Template Name: News */ ?>
<?php get_header(); ?>
  <?php get_navigation(); ?>

  <div class="container">
    <?php $paged = get_query_var('paged') ? get_query_var('paged') : 1; ?>
    <?php $options = array('post_type'=>'post', 'posts_per_page'=>8, 'paged' => $paged); ?>
    <?php $posts = new WP_Query($options); ?>
    <?php if($posts->have_posts()): ?>
      <div class="row d-lg-flex d-none">
        <div class="col-12"></div>
      </div>
      <div class="row d-lg-none d-flex">
        <div class="col-12"></div>
      </div>
      <?php $page_count = $posts->max_num_pages; ?>
      <?php if ($page_count > 1): ?>
        <div class="row">
          <div class="col-12">
            <h5 class="alt-heading no-transform mb-4">More posts</h5>
            <nav class="pagination" aria-label='Categories navigation'>
              <?php
                $current_pg = max(1, $paged);
                echo paginate_links(array(
                  'base' => get_pagenum_link(1) . '%_%',
                  'format' => 'page/%#%/', 
                  'current' => $current_pg, 
                  'total' => $page_count, 
                  'prev_next' => false));                                            
              ?>
            </nav>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>

<?php get_footer(); ?>