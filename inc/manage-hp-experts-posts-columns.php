<?php

if (!defined('ABSPATH')) {
	exit;
}

add_filter('manage_hp_experts_posts_columns', function ($columns) {
	$executed_columns = ['cb', 'title', 'categories'];
	$new_columns = [];
	if (isset($columns['cb'])) {
		$new_columns['cb'] = $columns['cb'];
	}
	$new_columns['acf_field_name'] = 'ФИО';
	$new_columns['acf_field_avatar'] = 'Аватар';
	foreach ($columns as $key => $value) {
		if (!in_array($key, $executed_columns, true)) {
			$new_columns[$key] = $value;
		}
	}
	return $new_columns;
});

add_filter('manage_edit-hp_experts_sortable_columns', function ($columns) {
	$columns['acf_field_name'] = 'acf_field_name';
	return $columns;
});

add_action('pre_get_posts', function ($query) {
	if (!is_admin() || !$query->is_main_query())
		return;
	if ($query->get('orderby') === 'acf_field_name') {
		$query->set('meta_key', 'hp_expert_name');
		$query->set('orderby', 'meta_value');
	}
});

add_action('admin_head', function () {
	echo '<style>
        .column-acf_field_avatar {
            width: 48px !important;
            max-width: 48px;
            text-align: center;
        }
        .column-acf_field_avatar img {
            height: 48px;
            width: auto;
            border-radius: 50%;
        }
    </style>';
});


add_action('manage_hp_experts_posts_custom_column', function ($column, $post_id) {
	if ($column === 'acf_field_name') {
		$name = get_field('hp_expert_name', $post_id);
		$secondname = get_field('hp_expert_secondname', $post_id);
		$link = get_edit_post_link($post_id);
		echo '<a href="' . esc_url($link) . '">' . esc_html($name) . "&nbsp;" . esc_html($secondname) . '</a>';
	}
	if ($column === 'acf_field_avatar') {
		$image_url = get_field('hp_expert_avatar', $post_id);
		if ($image_url) {
			echo '<img src="' . esc_url($image_url) . '" width="48" height="48" style="height: 48px; border-radius:50%;">';
		} else {
			echo '—';
		}
	}
}, 10, 2);

add_action('acf/save_post', function ($post_id) {
	if (get_post_type($post_id) !== 'hp_experts' || is_numeric($post_id) === false) {
		return;
	}

	$name = get_field('hp_expert_name', $post_id);
	$secondname = get_field('hp_expert_secondname', $post_id);

	if ($name) {
		$new_title = trim("{$name} {$secondname}");
		remove_action('acf/save_post', __FUNCTION__);
		wp_update_post([
			'ID' => $post_id,
			'post_title' => sanitize_text_field($new_title),
		]);
		add_action('acf/save_post', __FUNCTION__);
	}
}, 20);