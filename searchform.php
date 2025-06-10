<?php
$current_post_type = '';
$current_cat_id = '';
$current_input_text = '';

if (is_singular()) {
	$current_post_type = get_post_type();
} elseif (is_post_type_archive()) {
	$queried_object = get_queried_object();
	if ($queried_object && isset($queried_object->name)) {
		$current_post_type = $queried_object->name;
	}
} elseif (is_category() || is_tag() || is_tax()) {
	$queried_object = get_queried_object();
	if ($queried_object && isset($queried_object->taxonomy)) {
		$taxonomies = get_object_taxonomies(null, 'objects');
		if (isset($taxonomies[$queried_object->taxonomy])) {
			$linked_post_types = $taxonomies[$queried_object->taxonomy]->object_type;
			if (count($linked_post_types) === 1) {
				$current_post_type = $linked_post_types[0];
			} else {
				$current_post_type = 'post';
			}
		}

		if (is_category() && $queried_object && isset($queried_object->term_id)) {
			$current_cat_id = $queried_object->term_id;
		}
	}
} else {
	$current_post_type = 'post';
}

if ($current_post_type === 'post') {
	$current_input_text = t('search.title.post');
} elseif ($current_post_type === 'hp_books') {
	$current_input_text = t('search.title.books');
} elseif ($current_post_type === 'hp_authors') {
	$current_input_text = t('search.title.authors');
} elseif ($current_post_type === 'hp_experts') {
	$current_input_text = t('search.title.experts');
} else {
	$current_input_text = t('search.title');
}
?>

<form role="search" method="get" class="hp-search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="hp-search-input" class="hp-search-field-label">
		<input id="hp-search-input" type="search" class="hp-search-field" placeholder="<?php echo $current_input_text; ?>" value="<?php echo get_search_query(); ?>" name="s" required />
	</label>

	<?php if (!empty($current_post_type)): ?>
		<input type="hidden" name="post_type" value="<?php echo esc_attr($current_post_type); ?>" />
	<?php endif; ?>

	<?php if (!empty($current_cat_id)): ?>
		<input type="hidden" name="cat" value="<?php echo esc_attr($current_cat_id); ?>" />
	<?php endif; ?>

	<button type="submit" class="hp-search-submit">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
			<g clip-path="url(#a)">
				<path fill="#F4F4F5"
					d="M17.613 15.515a9.75 9.75 0 1 0-2.095 2.097h-.002c.045.06.093.117.147.173l5.775 5.775a1.5 1.5 0 0 0 2.123-2.121l-5.775-5.775a1.5 1.5 0 0 0-.173-.15v.001ZM18 9.75a8.25 8.25 0 1 1-16.5 0 8.25 8.25 0 0 1 16.5 0Z" />
			</g>
			<defs>
				<clipPath id="a">
					<path fill="#fff" d="M0 0h24v24H0z" />
				</clipPath>
			</defs>
		</svg>
	</button>
</form>