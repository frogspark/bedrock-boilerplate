<?php
  add_action('customize_register', 'social_media');

  add_action('customize_register', 'site_information');

  function site_information($wp_customize)
  {
      $wp_customize->add_section('site_information', array(
      'title' => 'Site Information'
    ));

      $wp_customize->add_setting('phone', array(
      'default' => '',
    ));
      $wp_customize->add_control('phone', array(
      'label' => 'Phone Number',
      'section' => 'site_information',
      'type' => 'text',
     ));

      $wp_customize->add_setting('email', array(
    'default' => '',
    ));
      $wp_customize->add_control('email', array(
    'label' => 'Email Address',
     'section' => 'site_information',
    'type' => 'text',
   ));

      $wp_customize->add_setting('company_registration_number', array(
  'default'        => '',
  ));
      $wp_customize->add_control('company_registration_number', array(
  'label'   => 'Company Registration Number',
   'section' => 'site_information',
  'type'    => 'text',
 ));

      $wp_customize->add_setting('google_tag_manager', array(
  'default'        => '',
  ));
      $wp_customize->add_control('google_tag_manager', array(
  'label'   => 'Google Tag Manager - Container ID',
   'section' => 'site_information',
  'type'    => 'text',
 ));
  }


  function social_media($wp_customize)
  {
      $wp_customize->add_section('social_media', array(
      'title'          => 'Social Media'
     ));


      $wp_customize->add_setting('facebook', array(
     'default'        => '',
     ));
      $wp_customize->add_control('facebook', array(
     'label'   => 'Facebook Link',
      'section' => 'social_media',
     'type'    => 'text',
    ));

      $wp_customize->add_setting('twitter', array(
     'default'        => '',
     ));
      $wp_customize->add_control('twitter', array(
     'label'   => 'Twitter Link',
      'section' => 'social_media',
     'type'    => 'text',
    ));

      $wp_customize->add_setting('instagram', array(
     'default'        => '',
     ));
      $wp_customize->add_control('instagram', array(
     'label'   => 'Instagram Link',
      'section' => 'social_media',
     'type'    => 'text',
    ));

      $wp_customize->add_setting('youtube', array(
     'default'        => '',
     ));
      $wp_customize->add_control('youtube', array(
     'label'   => 'Youtube Link',
      'section' => 'social_media',
     'type'    => 'text',
    ));

      $wp_customize->add_setting('linkedin', array(
     'default'        => '',
     ));
      $wp_customize->add_control('linkedin', array(
     'label'   => 'LinkedIn Link',
      'section' => 'social_media',
     'type'    => 'text',
    ));
  }
