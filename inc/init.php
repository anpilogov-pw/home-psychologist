<?php

if (!defined('ABSPATH')) {
	exit;
}

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

// Оключение базы под Category
add_action('init', function () {
		register_taxonomy('category', 'post', [
				'hierarchical' => true,
				'public' => true,
				'rewrite' => [
					'slug' => 'blog',
					'with_front' => false,
				],
				'show_ui' => true,
				'show_in_rest' => true,
				'labels' => get_taxonomy('category')->labels,
		]);
}, 11);

// Оключение базы под hp_book_taxonomy
add_action('init', function () {
		register_taxonomy('hp_book_taxonomy', array('hp_books', 'hp_authors'), [
				'hierarchical' => true,
				'public' => true,
				'rewrite' => [
					'slug' => 'knigi',
					'with_front' => false,
				],
				'show_ui' => true,
				'show_in_rest' => true,
				'labels' => [
						'name' => 'Категории',
						'singular_name' => 'Категория',
						'menu_name' => 'Жанры',
						'all_items' => 'Все жанры',
						'edit_item' => 'Изменить жанр',
						'view_item' => 'Посмотреть жанр',
						'update_item' => 'Обновить жанр',
						'add_new_item' => 'Добавить новый жанр',
						'new_item_name' => 'Новое название жанра',
						'parent_item' => 'Родительский жанр',
						'parent_item_colon' => 'Родительский жанр:',
						'search_items' => 'Поиск жанров',
						'not_found' => 'Жанры не найдены',
						'no_terms' => 'Нет жанров',
						'filter_by_item' => 'Фильтровать по жанрам',
						'items_list_navigation' => 'Навигация по жанрам',
						'items_list' => 'Список жанров',
						'back_to_items' => '← Перейти к жанрам',
						'item_link' => 'Ссылка на жанр',
						'item_link_description' => 'Ссылка на жанр',
				],
				'object_type' => array('hp_books'),
		]);
}, 11);

function custom_posts_per_page( $query ) {
		// Проверяем, является ли запрос основным и не является ли административным
		if ( !is_admin() && $query->is_main_query() ) {
				// Проверка на нужный тип поста
				if ( is_post_type_archive('hp_authors') || is_post_type_archive('hp_experts') ) {
						// Устанавливаем количество выводимых постов
						$query->set( 'posts_per_page', 16 ); // Количество постов на странице
				}

				if (is_tax('hp_book_taxonomy')) {
						// Устанавливаем количество выводимых постов
						$query->set( 'posts_per_page', 8 ); // Количество постов на странице
				}
		}
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );

function filter_query_by_post_type($query) {
		if (is_tax('hp_book_taxonomy') && $query->is_main_query()) {
				$query->set('post_type', 'hp_books');
		}
}
add_action('pre_get_posts', 'filter_query_by_post_type');


function custom_redirect_search_with_post_type() {
		if (is_search() && ( empty($_GET['s']) || empty($_GET['search']))) {
			$redirect_url = home_url();

			// Выполняем 301 редирект
			wp_redirect($redirect_url, 301);
		}
		
		// Проверяем, что это страница поиска и параметр 's' присутствует в URL
		if (is_search() && !empty($_GET['s']) && !isset($_GET['post_type'])) {
				// Получаем текст поиска
				$search_text = sanitize_text_field($_GET['s']);
				
				// Формируем новый URL с добавлением параметра post_type=post
				$redirect_url = home_url("/?s={$search_text}&post_type=post");
				
				// Выполняем 301 редирект
				wp_redirect($redirect_url, 301);
				exit; // Останавливаем выполнение кода после редиректа
		}
}
add_action('template_redirect', 'custom_redirect_search_with_post_type');

add_filter('rewrite_rules_array', function($rules) {
    $new_rules = array(
        'knigi/([^/]+)/([^/]+)/?$' => 'index.php?hp_books=$matches[2]&hp_book_taxonomy=$matches[1]',
    );

    return $new_rules + $rules;
});

