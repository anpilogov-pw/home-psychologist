<?php
add_action('wp_ajax_submit_hp_comment', 'handle_hp_comment_submission');
add_action('wp_ajax_nopriv_submit_hp_comment', 'handle_hp_comment_submission');

if (!wp_script_is('hp-form', 'enqueued')) {
	add_action('wp_enqueue_scripts', function () {
		wp_enqueue_script( 'hp-form', get_template_directory_uri() . '/assets/js/form.js', [], null, true );
		wp_localize_script('hp-form', 'wp_data', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'post_id'  => get_the_ID(),
			'nonce'    => wp_create_nonce('hp_comment_nonce')
		]);
	});
}

function handle_hp_comment_submission() {
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'hp_comment_nonce')) {
		wp_send_json_error('Неверный токен безопасности.');
	}

	$post_id = intval($_POST['post_id']);
	$author  = sanitize_text_field($_POST['fullname']);
	$email   = sanitize_email($_POST['email']);
	$content = wp_kses_post($_POST['review']);
	$rating  = intval($_POST['rating']);

	$post = get_post($post_id);
	if (!$post || get_post_type($post_id) !== 'hp_books') {
		wp_send_json_error('Неверная запись.');
	}

	if (!$author || !$email || !$content || $rating < 1 || $rating > 5) {
		wp_send_json_error('Проверьте правильность заполнения формы.');
	}

	if (!comments_open($post_id) || get_option('comment_registration')) {
		wp_send_json_error('Комментирование отключено.');
	}

	$existing = get_comments([
		'post_id' => $post_id,
		'author_email' => $email,
		'count' => true,
		'status' => 'all' // Учитываем даже ожидающие модерации
	]);

	if ($existing > 0) {
		wp_send_json_error('Вы уже оставляли комментарий к этой книге.');
	}

	$comment_id = wp_insert_comment([
		'comment_post_ID'      => $post_id,
		'comment_author'       => $author,
		'comment_author_email' => $email,
		'comment_content'      => $content,
		'comment_type'         => '',
		'comment_approved'     => 0,
	]);

	if (!$comment_id || is_wp_error($comment_id)) {
		wp_send_json_error('Ошибка при сохранении комментария.');
	}

	add_comment_meta($comment_id, 'hp_rating', $rating);
	wp_send_json_success('Комментарий отправлен и ожидает модерации.');
}


