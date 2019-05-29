<?php get_header(); ?>

<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<?php $query = array('post_type' => 'story', 'posts_per_page' => 1, 'paged' => $paged); ?>
<?php $posts = new WP_Query($query); ?>
<?php while($posts->have_posts()) : $posts->the_post(); ?>

<section id="featured-story">
    <div class="container py-15">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><span class="underline-this-green">Your Stories</span></h3>
            </div>
        </div>

        <div class="row pt-10 pt-lg-15">
            <div class="col-lg-6">
                <div class="featured-story-video"></div>
            </div>
            <div class="col-lg-5 offset-lg-1 mt-10 mt-lg-0">
                <h3><?php echo get_the_excerpt(); ?></h3>
                <a href="<?php the_permalink(); ?>">
                    <button type="button" class="btn btn-lg btn-purple btn-global">
                        <?php the_title(); ?></button></a>
            </div>
        </div>

        <div class="row mt-10">
            <div class="col-lg-12">
                <a href="/your-stories">
                <?php $buttonLeft = get_field('your_stories_button'); ?>
                <button type="button" class="btn btn-lg btn-green btn-global">
                        Your Stories</button></a>
            </div>
        </div>
    </div>
</section>

<?php endwhile; wp_reset_postdata(); ?>

<?php get_footer(); ?>