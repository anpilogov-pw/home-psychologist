<?php

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Регистрирует все меню в теме.
 */

add_action('after_setup_theme', function() {
	$menus = [
		'header' => t('menu.header'),
		'footer' => t('menu.footer'),
		'footer_tax' => t('menu.footer.tax'),
		'footer_docs' => t('menu.footer.docs'),
	];

	register_nav_menus($menus);
});