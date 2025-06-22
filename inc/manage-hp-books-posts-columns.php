<?php
add_filter('manage_hp_books_posts_columns', function ($columns) {
		$columns['hp_on_main'] = 'На главной';
    return $columns;
}, 100); // Приоритет 100 — чтобы сработать после других плагинов


add_action('manage_hp_books_posts_custom_column', function($column, $post_id) {
    if ($column === 'hp_on_main') {
        $value = get_field('hp-on-main', $post_id);
        $checked = $value ? 'checked' : '';
        echo '<label class="hp-switch">
					<input type="checkbox" class="hp-toggle" data-post="' . $post_id . '" ' . $checked . '>
					<span class="hp-slider"><span class="hp-label"></span></span>
					<span class="spinner" style="float:none;display:none;margin-left:5px;"></span>
			</label>';
    }
}, 10, 2);

add_action('admin_enqueue_scripts', function($hook) {
    if ($hook !== 'edit.php' || $_GET['post_type'] !== 'hp_books') return;

    wp_enqueue_script('hp-books-toggle', get_template_directory_uri() . '/admin/hp-books-toggle.js', ['jquery'], null, true);
		wp_enqueue_script('hp-notification', get_template_directory_uri() . '/admin/hp-nitification.js', ['jquery'], null, true);
    wp_localize_script('hp-books-toggle', 'HPBooksAjax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('hp_books_toggle_nonce')
    ]);
		wp_enqueue_style('hp-books-toggle-style', get_template_directory_uri() . '/admin/hp-books-toggle.css');
});

add_action('wp_ajax_hp_books_toggle_on_main', function() {
    check_ajax_referer('hp_books_toggle_nonce', 'nonce');

    $post_id = intval($_POST['post_id'] ?? 0);
    $value = ($_POST['value'] ?? '') === '1' ? 1 : 0;

    if (!get_post($post_id)) {
        wp_send_json_error('Пост не найден');
    }

    // Сохраняем поле ACF
    update_field('hp-on-main', $value, $post_id);

    // Обновляем дату изменения
    wp_update_post([
        'ID' => $post_id,
        'post_modified' => current_time('mysql'),
        'post_modified_gmt' => current_time('mysql', 1)
    ]);

    wp_send_json_success('Сохранено');
});


add_action('admin_head', function () {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'hp_books') {
        echo '<style>
            .column-hp_on_main {
                max-width: 130px !important;
                width: 130px !important;
            }
        </style>';
    }
});

