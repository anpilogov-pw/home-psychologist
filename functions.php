<?php
require_once get_template_directory() . '/inc/init.php';
require_once get_template_directory() . '/inc/template_include.php';
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
require_once get_template_directory() . '/inc/hp-load-expert-posts.php';
require_once get_template_directory() . '/inc/hp-load-author-books.php';
require_once get_template_directory() . '/inc/transliterate.php';
require_once get_template_directory() . '/inc/generate-toc-from-content.php';
require_once get_template_directory() . '/inc/add-anchor-ids-to-heading.php';
require_once get_template_directory() . '/inc/hp_comment_submission.php';

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
});

add_filter('script_loader_tag', function ($tag, $handle) {
  if ($handle === 'google-fonts-preconnect') {
    return
      '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n" .'<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
  }
  return $tag;
}, 10, 2);


add_action('wp_enqueue_scripts', function () {
  $theme_version = wp_get_theme()->get('Version');
  wp_enqueue_style('css', get_template_directory_uri() . '/index.css', array(), $theme_version, 'all');
  wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false);
  wp_enqueue_script('google-fonts-preconnect', '', [], '', false);
  wp_enqueue_style( 'google-fonts-inter', 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap', [], null );

  if (is_archive() || is_tax()) {
    wp_enqueue_script('mobile-menu-script', get_template_directory_uri() . '/assets/js/mobile-menu-button.js', array(), $theme_version, true);
  }

  if (is_single()) {
    wp_enqueue_script('share-script', get_template_directory_uri() . '/assets/js/share.js', array(), $theme_version, true);
    wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/assets/js/lib/fancybox/fancybox.css', [], '6.0.5' );
    wp_enqueue_script( 'fancybox-js', get_template_directory_uri() . '/assets/js/lib/fancybox/fancybox.umd.js', [], '6.0.5', true );
    wp_enqueue_script( 'fancybox-init', get_template_directory_uri() . '/assets/js/fancybox-init.js', ['fancybox-js'], $theme_version, true );
    wp_enqueue_script( 'gallery', get_template_directory_uri() . '/assets/js/gallery.js', [], $theme_version, true );
    wp_enqueue_script( 'copy', get_template_directory_uri() . '/assets/js/copy.js', [], $theme_version, true );
    wp_enqueue_script( 'comment', get_template_directory_uri() . '/assets/js/comment.js', [], $theme_version, true );
  }
});



