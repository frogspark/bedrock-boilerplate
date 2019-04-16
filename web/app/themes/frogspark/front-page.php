<?php get_header(); ?>

  <?php get_template_part('navigation-default'); ?>

  <div class="container jumbotron benefits">

    <div class="row mt-10 mb-10">
        <?php $software = get_field('software'); ?>
        <?php foreach($software as $item): ?>
            <div class="col-lg-4">
                <img src="<?php echo $item['software_icon']['url']; ?>" height="68" width="72"><br/><br />
                <h3 class="benefits-title"><?php echo $item['software_title']; ?></h3>
                <p><?php echo $item['software_description']; ?></p>
                <button type="button" class="btn btn-secondary software-btn"><?php echo $item['software_button_text']; ?></button>
            </div>
        <?php endforeach; ?>
    </div>

    <hr class="content-spacer">

  <div class="row">
        <div class="col-lg-6">
            <h3 class="benefits-title"><?php the_field('benefits_main_title'); ?></h3>
            <p><?php the_field('benefits_main_desc'); ?></p>
            <p></p>
        </div>
        <div class="col-lg-6">
            <h3 class="benefits-title"></h3>
            <p></p>
        </div>
    </div>

    <div class="row mt-10">
        <?php $benefits = get_field('benefits'); ?>
        <?php foreach($benefits as $item): ?>
            <div class="col-lg-4 mb-10">
                <img src="<?php echo $item['benefits_icon']['url']; ?>" height="68" width="72"><br/><br />
                <h3 class="benefits-title"><?php echo $item['benefits_title']; ?></h3>
                <p><?php echo $item['benefits_description']; ?></p>
                <p><a class="book-demo-link" href="<?php echo $item['benefits_link']; ?>"><?php echo $item['benefits_link_text']; ?></a></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php get_footer(); ?>
