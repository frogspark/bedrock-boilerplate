<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="HandheldFriendly" content="true" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
    
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text|Karla:400,700" rel="stylesheet">
    <link rel="stylesheet" href="./app/themes/frogspark/scss/dist/bundle.min.css" type="text/css" media="all" />
    <script src="./app/themes/frogspark/js/dist/bundle.min.js"></script>
</head>
<body <?php body_class(); ?>>
