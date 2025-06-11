<?php
add_filter('slim_seo_meta_title', function ($title) {
	if (is_search()) {
		return t('search.result.text') . " «" . esc_html(get_search_query()) . '» — ' . t('title');
	}

	return $title;
});

add_filter('slim_seo_meta_description', function ($description) {
	if (is_paged()) {
		return '';
	}

	return $description;
});