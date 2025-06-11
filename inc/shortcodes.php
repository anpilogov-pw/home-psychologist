<?php
function render_articles_component($args = [])
{
	$args = shortcode_atts([
		'order' => 'ASC',
		'limit' => 6,
	], $args, 'hp_articles');

	$order = strtoupper($args['order']);
	$limit = max(1, intval($args['limit']));

	$query_args = [
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $limit,
	];

	if ($order === 'R') {
		// Специальная логика: сначала WP_Query на 50, потом shuffle
		$random_query = new WP_Query([
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 50,
			'orderby' => 'date',
			'order' => 'DESC',
			'no_found_rows' => true, // отключаем подсчёт общего количества
		]);

		$posts = $random_query->have_posts() ? $random_query->posts : [];

		if (!empty($posts)) {
			shuffle($posts);
			$posts = array_slice($posts, 0, $limit);
		}

		// Используем WP_Query на основе выбранных ID
		$post_ids = wp_list_pluck($posts, 'ID');
		$query = new WP_Query([
			'post_type' => 'post',
			'post__in' => $post_ids,
			'orderby' => 'post__in', // сохранить порядок
			'posts_per_page' => $limit,
		]);
	} else {
		$query_args['orderby'] = 'title';
		$query_args['order'] = in_array($order, ['ASC', 'DESC']) ? $order : 'ASC';
		$query = new WP_Query($query_args);
	}

	// Вывод через template-part
	ob_start();
	get_template_part('template-parts/components/articles-list', null, ['query' => $query]);
	return ob_get_clean();
}

function hp_articles_shortcode($atts)
{
	return render_articles_component($atts);
}
add_shortcode('hp_articles', 'hp_articles_shortcode');
