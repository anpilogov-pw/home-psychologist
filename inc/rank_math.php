<?php
add_filter('rank_math/frontend/title', function ($title) {
	if (is_home() && is_paged()) {
		$paged = get_query_var('paged');
		$title = 'Блог | Страница ' . $paged . ' | ' . get_bloginfo('name');
	}
	return $title;
});

add_filter('rank_math/frontend/title', function ($title) {
	if (is_category() && is_paged()) {
		$cat_title = single_cat_title('', false);
		$paged = get_query_var('paged');
		$title = $cat_title . ' | Страница ' . $paged . ' | ' . get_bloginfo('name');
	}
	return $title;
});

add_filter('rank_math/frontend/description', function ($description) {
	if (is_paged()) {
		return ''; // отключает meta description на страницах пагинации
	}
	return $description;
});
