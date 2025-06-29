<?php
function render_articles_component($args = [])
{
	$args = shortcode_atts([
		'order'   => 'ASC',
		'limit'   => 6,
		'exclude' => '',
	], $args, 'hp_articles');

	$order       = strtoupper($args['order']);
	$limit       = max(1, intval($args['limit']));
	$exclude_ids = array_filter(array_map('intval', explode(',', $args['exclude'])));

	$query_args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
	];

	if (!empty($exclude_ids)) {
		$query_args['post__not_in'] = $exclude_ids;
	}

	if ($order === 'R') {
		$random_query_args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 50,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'no_found_rows'  => true,
		];

		if (!empty($exclude_ids)) {
			$random_query_args['post__not_in'] = $exclude_ids;
		}

		$random_query = new WP_Query($random_query_args);
		$posts = $random_query->have_posts() ? $random_query->posts : [];

		if (!empty($posts)) {
			shuffle($posts);
			$posts = array_slice($posts, 0, $limit);
		}

		$post_ids = wp_list_pluck($posts, 'ID');

		$query = new WP_Query([
			'post_type'      => 'post',
			'post__in'       => $post_ids,
			'orderby'        => 'post__in',
			'posts_per_page' => $limit,
		]);
	} else {
		$query_args['orderby'] = 'title';
		$query_args['order']   = in_array($order, ['ASC', 'DESC']) ? $order : 'ASC';
		$query = new WP_Query($query_args);
	}

	ob_start();
	get_template_part('template-parts/components/articles-list', null, ['query' => $query]);
	return ob_get_clean();
}

function hp_articles_shortcode($atts)
{
	return render_articles_component($atts);
}
add_shortcode('hp_articles', 'hp_articles_shortcode');


function render_books_component($args = [])
{
	$args = shortcode_atts([
		'order'   => 'ASC',
		'limit'   => 6,
		'exclude' => '',
	], $args, 'hp_books');

	$order       = strtoupper($args['order']);
	$limit       = max(1, intval($args['limit']));
	$exclude_ids = array_filter(array_map('intval', explode(',', $args['exclude'])));

	$query_args = [
		'post_type'      => 'hp_books',
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
	];

	if (!empty($exclude_ids)) {
		$query_args['post__not_in'] = $exclude_ids;
	}

	if ($order === 'R') {
		$random_query_args = [
			'post_type'      => 'hp_books',
			'post_status'    => 'publish',
			'posts_per_page' => 50,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'no_found_rows'  => true,
		];

		if (!empty($exclude_ids)) {
			$random_query_args['post__not_in'] = $exclude_ids;
		}

		$random_query = new WP_Query($random_query_args);
		$posts = $random_query->have_posts() ? $random_query->posts : [];

		if (!empty($posts)) {
			shuffle($posts);
			$posts = array_slice($posts, 0, $limit);
		}

		$post_ids = wp_list_pluck($posts, 'ID');

		$query = new WP_Query([
			'post_type'      => 'hp_books',
			'post__in'       => $post_ids,
			'orderby'        => 'post__in',
			'posts_per_page' => $limit,
		]);
	} else {
		$query_args['orderby'] = 'title';
		$query_args['order']   = in_array($order, ['ASC', 'DESC']) ? $order : 'ASC';
		$query = new WP_Query($query_args);
	}

	ob_start();
	get_template_part('template-parts/components/books-list', null, ['query' => $query]);
	return ob_get_clean();
}

function hp_books_shortcode($atts)
{
	return render_books_component($atts);
}
add_shortcode('hp_books', 'hp_books_shortcode');
