<?php

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Регистрирует все меню в теме.
 */
function register_theme_menus()
{
	$menus = [
		'header' => t('menu.header'),
		'footer' => t('menu.footer'),
		'footer_tax' => t('menu.footer.tax'),
		'footer_docs' => t('menu.footer.docs'),
	];

	register_nav_menus($menus);
}
add_action('after_setup_theme', 'register_theme_menus');