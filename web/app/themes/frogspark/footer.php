<?php wp_footer(); ?>

<footer>

<div class="container footer">
  <div class="row">
    <div class="col-lg-3">
        <img class="footer-logo" src="/app/themes/frogspark/img/logo-stacked.svg" height="45" width="29">
    </div>
    <div class="col-lg-3">
        <?php
        if(is_active_sidebar('footer_column_one')){
        dynamic_sidebar('footer_column_one');
        }
        ?>
    </div>
    <div class="col-lg-3">
        <?php
        if(is_active_sidebar('footer_column_two')){
        dynamic_sidebar('footer_column_two');
        }
        ?>
    </div>
    <div class="col-lg-3">
    <h3 class="footer-nav-title">Contact Us</h3>
        <ul>
            <li><a href="tel: 0115 534645"><?php the_field('phone_number', "option"); ?></a></li>
            <li><a href="mailto: info@custodian.com"><?php the_field('email_address', "option"); ?></a></li>
        </ul>
    </div>
    <hr>
    <div class="col-lg-6">
        <h3 class="footer-address">This is an address, address road, Derby, DE4 5GU</h3>
    </div>
    <div class="col-lg-6 social-media-container">
        <a class="sm-link" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="sm-link" href="#"><i class="fab fa-twitter"></i></a>
        <a class="sm-link" href="#"><i class="fab fa-instagram"></i></a>
        <a class="sm-link" href="#"><i class="fab fa-youtube"></i></a>
    </div>
  </div>
</div>
  
</footer>

</body>
</html>
