<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="HandheldFriendly" content="true" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>

  <link rel="stylesheet" href="/app/themes/frogspark/scss/dist/bundle.min.css?v=<?php echo time(); ?>" type="text/css" media="all" />
  <script src="/app/themes/frogspark/js/dist/bundle.min.js?v=<?php echo time(); ?>"></script>

  <!-- Favicon generated by: https://www.favicon-generator.org -->
  <link rel="apple-touch-icon" sizes="57x57" href="/app/themes/frogspark/fav.ico/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/app/themes/frogspark/fav.ico/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/app/themes/frogspark/fav.ico/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/app/themes/frogspark/fav.ico/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/app/themes/frogspark/fav.ico/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/app/themes/frogspark/fav.ico/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/app/themes/frogspark/fav.ico/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/app/themes/frogspark/fav.ico/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/app/themes/frogspark/fav.ico/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/app/themes/frogspark/fav.ico/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/app/themes/frogspark/fav.ico/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/app/themes/frogspark/fav.ico/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/app/themes/frogspark/fav.ico/favicon-16x16.png">
  <link rel="manifest" href="/app/themes/frogspark/fav.ico/manifest.json">
  <meta name="msapplication-TileImage" content="/app/themes/frogspark/fav.ico/ms-icon-144x144.png">

  <!-- Google Analytics generated by: https://analytics.google.com/analytics/web/ -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php if (get_field('google_analytics_id', 'option')): the_field('google_analytics_id', 'option'); endif; ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php if (get_field('google_analytics_id', 'option')): the_field('google_analytics_id', 'option'); endif; ?>');
  </script>

  <!-- Cookie popup generated by: https://cookieconsent.insites.com/download/ -->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
  <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {"background": "#000000"},
        "button": {"background": "#FFFFFF", "text": "#000000"}
      },
      "position": "bottom-left",
      "content": {"href": "/cookie-policy/"}
    })});
  </script>
</head>
<body <?php body_class(); ?>>

<?php get_template_part('inc/navigation'); ?>