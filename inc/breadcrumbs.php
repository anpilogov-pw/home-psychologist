<?php
if (!defined('ABSPATH')) {
	exit;
}

function breadcrumbs()
{

	// Получаем главную страницу сайта
	$home_url = home_url();

	// Старт хлебных крошек
	$breadcrumbs = '<nav class="hp-block hp-breadcrumbs" aria-label="Навигация по страницам"><ul class="hp-breadcrumbs-list">';

	// Массив для микроразметки JSON-LD
	$breadcrumb_json = array();

	// Главная страница
	$breadcrumbs .= '<li><a href="' . $home_url . '">' . t('breadcrumbs.home.title') . '</a></li>';
	$breadcrumb_json[] = array(
		"@type" => "ListItem",
		"position" => 1,
		"name" => urldecode(get_bloginfo('name')),
		"item" => $home_url
	);

	if (is_front_page()) {
		return;
	} elseif (is_home()) {
		$page_for_posts_id = get_option('page_for_posts');
		if ($page_for_posts_id) {
			$title = get_the_title($page_for_posts_id);
			$link = get_permalink($page_for_posts_id);
		} else {
			$title = t('page.title.blog');
			$link = home_url('/');
		}

		$breadcrumbs .= '<li>' . esc_html($title) . '</li>';
		$breadcrumb_json[] = [
			"@type" => "ListItem",
			"position" => 2,
			"name" => $title,
			"item" => $link
		];
	}

	// Условие для разных типов страниц
	if (is_single()) {
		// Если это запись
		$categories = get_the_category();
		if ($categories) {
			$breadcrumbs .= '<li><a href="' . urldecode(get_category_link($categories[0]->term_id)) . '">' . $categories[0]->name . '</a></li>';
			$breadcrumb_json[] = array(
				"@type" => "ListItem",
				"position" => 2,
				"name" => urldecode($categories[0]->name),
				"item" => urldecode(get_category_link($categories[0]->term_id))
			);
		}
		$breadcrumbs .= '<li>' . urldecode(get_the_title()) . '</li>';
		$breadcrumb_json[] = array(
			"@type" => "ListItem",
			"position" => 3,
			"name" => urldecode(get_the_title()),
			"item" => urldecode(get_permalink())
		);
	} elseif (is_page()) {
		// Если это страница
		$breadcrumbs .= '<li>' . urldecode(get_the_title()) . '</li>';
		$breadcrumb_json[] = array(
			"@type" => "ListItem",
			"position" => 2,
			"name" => urldecode(get_the_title()),
			"item" => urldecode(get_permalink())
		);
	} elseif (is_category()) {
		// Если это 
		
		// Страница блога
		$page_for_posts_id = get_option('page_for_posts');
		if ($page_for_posts_id) {
			$blog_title = get_the_title($page_for_posts_id);
			$blog_link = get_permalink($page_for_posts_id);

			$breadcrumbs .= '<li><a href="' . esc_url($blog_link) . '">' . esc_html($blog_title) . '</a></li>';
			$breadcrumb_json[] = [
				"@type" => "ListItem",
				"position" => 2,
				"name" => $blog_title,
				"item" => $blog_link
			];
		}

		// Текущая категория
		$category = get_queried_object();
		$breadcrumbs .= '<li>' . esc_html($category->name) . '</li>';
		$breadcrumb_json[] = [
			"@type" => "ListItem",
			"position" => 3,
			"name" => $category->name,
			"item" => get_category_link($category->term_id)
		];
	} elseif (is_tag()) {
		// Если это тег
		$breadcrumbs .= '<li>' . urldecode(single_tag_title('', false)) . '</li>';
		$breadcrumb_json[] = array(
			"@type" => "ListItem",
			"position" => 2,
			"name" => urldecode(single_tag_title('', false)),
			"item" => urldecode(get_tag_link(get_queried_object_id()))
		);
	} elseif (is_archive()) {
		// Если это архив
		$breadcrumbs .= '<li>' . urldecode(post_type_archive_title('', false)) . '</li>';
		$breadcrumb_json[] = array(
			"@type" => "ListItem",
			"position" => 2,
			"name" => urldecode(post_type_archive_title('', false)),
			"item" => urldecode(get_post_type_archive_link(get_post_type()))
		);
	}

	// Закрытие списка
	$breadcrumbs .= '</ul></nav>';

	// Выводим JSON-LD разметку в <script> тегах
	echo $breadcrumbs;
	echo '<script type="application/ld+json">' . json_encode(array(
		"@context" => "https://schema.org",
		"@type" => "BreadcrumbList",
		"itemListElement" => $breadcrumb_json
	)) . '</script>';
}
