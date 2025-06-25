<?php

require_once get_template_directory() . '/inc/init.php';
require_once get_template_directory() . '/inc/template_include.php';
require_once get_template_directory() . '/inc/fonts.php';
require_once get_template_directory() . '/inc/i18n.php';
require_once get_template_directory() . '/inc/menus_register.php';
require_once get_template_directory() . '/inc/sidebars_register.php';
require_once get_template_directory() . '/inc/manage-hp-authors-posts-columns.php';
require_once get_template_directory() . '/inc/manage-hp-books-posts-columns.php';
require_once get_template_directory() . '/inc/manage-hp-experts-posts-columns.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/rank_math.php';
require_once get_template_directory() . '/inc/shortcodes.php';
require_once get_template_directory() . '/inc/admin-notification.php';
require_once get_template_directory() . '/inc/fancybox.php';

function theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'theme_setup');

function enqueue_assets()
{
  $theme_version = wp_get_theme()->get('Version');
  wp_enqueue_style('css', get_template_directory_uri() . '/index.css', array(), $theme_version, 'all');
  wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/index.js', [], $theme_version, false);
}
add_action('wp_enqueue_scripts', 'enqueue_assets');



