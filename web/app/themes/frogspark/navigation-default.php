<?php
$locations = get_nav_menu_locations();
$main = wp_get_nav_menu_object($locations['main_menu']);
$main_menu = wp_get_nav_menu_items($main, array('order' => 'DESC'));
$phone = get_theme_mod('phone');
$email = get_theme_mod('email');
