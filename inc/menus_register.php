<?php

function header_menus_register()
{
	register_nav_menus(array(
		'header' => 'Меню в шапке'
	));
}
add_action('after_setup_theme', 'header_menus_register');
