<?php

add_action('init', function () {
	global $wp_post_types;

	// Пререименовываем "Публикации" в "Статьи"
	if (isset($wp_post_types['post'])) {
		$labels = &$wp_post_types['post']->labels;
		$labels->name = 'Статьи';
		$labels->singular_name = 'Статья';
		$labels->add_new = 'Добавить статью';
		$labels->add_new_item = 'Добавить новую статью';
		$labels->edit_item = 'Редактировать статью';
		$labels->new_item = 'Новая статья';
		$labels->view_item = 'Просмотр статьи';
		$labels->search_items = 'Поиск статей';
		$labels->not_found = 'Статей не найдено';
		$labels->not_found_in_trash = 'В корзине нет статей';
		$labels->all_items = 'Все статьи';
		$labels->menu_name = 'Статьи';
		$labels->name_admin_bar = 'Статья';
	}

	// Отключаем emoji скрипты и стили
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

	// Для редактора Gutenberg
	add_filter('tiny_mce_plugins', function ($plugins) {
		if (is_array($plugins)) {
			return array_diff($plugins, ['wpemoji']);
		}
		return [];
	});

	// Отключаем DNS prefetch на emoji CDN
	add_filter('emoji_svg_url', '__return_false');
});
