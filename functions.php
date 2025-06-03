<?php

require_once get_template_directory() . '/inc/init_functions.php';
require_once get_template_directory() . '/inc/menus_register.php';
require_once get_template_directory() . '/inc/manage-hp-authors-posts-columns.php';
require_once get_template_directory() . '/inc/manage-hp-experts-posts-columns.php';


function theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'theme_setup');

function enqueue_assets()
{
  $theme_version = wp_get_theme()->get('Version');
  wp_enqueue_style('css', get_template_directory_uri() . '/assets/css/index.css', array(), $theme_version, 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_assets');
