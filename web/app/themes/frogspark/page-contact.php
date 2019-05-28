<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_header(); ?>

<div class="container py-15">
    <div class="row">
        <div class="col-lg-6"><?php echo do_shortcode('[ninja_form id=1]'); ?></div>
        <div class="offset-lg-1 col-lg-5 pt-10 pt-lg-0">
            <h3>Call us</h3>
            <p><a href="tel:<?php echo the_field('phone_number', 'options'); ?>"><?php echo the_field('phone_number', 'options'); ?></a></p>
            <h3>Text Us</h3>
            <p><a href="tel:<?php echo the_field('phone_number', 'options'); ?>"><?php echo the_field('phone_number', 'options'); ?></a></p>
            <h3>Email us</h3>
            <p><a href="mailto:<?php echo the_field('email', 'options'); ?>"><?php echo the_field('email_address', 'options'); ?></a></p>
            <a href=""><button type="button" class="btn btn-global btn-green mt-5">Get Involved</button></a>
        </div>
    </div>
</div>

<?php get_footer(); ?>