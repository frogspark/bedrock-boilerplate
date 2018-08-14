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

<div class="acf-map">
  <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
    <address class="map-address"><span><?php echo strtr(get_field('location')['address'], array(', ' => ', </span><span>')); ?></span></address>
  </div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9rktByHWRIYbrgSY2TeR8QJwCaoe55ME"></script>
<?php get_footer(); ?>
