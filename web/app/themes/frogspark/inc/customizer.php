<?php
  add_action('customize_register', 'theme_footer_customizer');

  function theme_footer_customizer($wp_customize){

     //adding section in wordpress customizer   
    $wp_customize->add_section('footer_settings_section', array(
      'title'          => 'Website Details'
     ));
    //adding setting for footer text area
    $wp_customize->add_setting('phone_setting', array(
     'default'        => '',
     ));
    $wp_customize->add_control('phone_setting', array(
     'label'   => 'Contact number',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
     'default'        => '',
     ));
    $wp_customize->add_control('contact_email', array(
     'label'   => 'Contact Email',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
    
    $wp_customize->add_setting('contact_address1', array(
     'default'        => '',
     ));
    $wp_customize->add_control('contact_address1', array(
     'label'   => 'Contact Address 1',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_address2', array(
      'default'        => '',
      ));
     $wp_customize->add_control('contact_address2', array(
      'label'   => 'Contact Address 2',
       'section' => 'footer_settings_section',
      'type'    => 'text',
     ));

     $wp_customize->add_setting('contact_address3', array(
      'default'        => '',
      ));
     $wp_customize->add_control('contact_address3', array(
      'label'   => 'Contact Address 3',
       'section' => 'footer_settings_section',
      'type'    => 'text',
     ));

     $wp_customize->add_setting('contact_address4', array(
      'default'        => '',
      ));
     $wp_customize->add_control('contact_address4', array(
      'label'   => 'Contact Address 4',
       'section' => 'footer_settings_section',
      'type'    => 'text',
     ));
    
     $wp_customize->add_setting('facebook', array(
     'default'        => '',
     ));
    $wp_customize->add_control('facebook', array(
     'label'   => 'Facebook Link',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
    
     $wp_customize->add_setting('twitter', array(
     'default'        => '',
     ));
    $wp_customize->add_control('twitter', array(
     'label'   => 'Twitter Link',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
    
    $wp_customize->add_setting('instagram', array(
     'default'        => '',
     ));
    $wp_customize->add_control('instagram', array(
     'label'   => 'Instagram Link',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
    
    $wp_customize->add_setting('youtube', array(
     'default'        => '',
     ));
    $wp_customize->add_control('youtube', array(
     'label'   => 'Youtube Link',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
    
    $wp_customize->add_setting('pinterest', array(
     'default'        => '',
     ));
    $wp_customize->add_control('pinterest', array(
     'label'   => 'Pinterest Link',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
    
    $wp_customize->add_setting('googleplus', array(
     'default'        => '',
     ));
    $wp_customize->add_control('googleplus', array(
     'label'   => 'Google+ Link',
      'section' => 'footer_settings_section',
     'type'    => 'text',
    ));
  }

?>