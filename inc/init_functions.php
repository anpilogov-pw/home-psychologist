<?php

add_action('init', function () {
	global $wp_post_types;

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
});
