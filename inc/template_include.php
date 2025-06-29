<?php
add_filter('template_include', function($template) {
	if (is_search()) {
		$post_type = get_query_var('post_type');
		if (is_array($post_type)) {
			$post_type = reset($post_type);
		}
		if ($post_type) {
			$custom_template = locate_template("search-{$post_type}.php");
			if ($custom_template) {
				return $custom_template;
			}
		}
	}
	return $template;
});
