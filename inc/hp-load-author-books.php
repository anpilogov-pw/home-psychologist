<?php
add_action('wp_ajax_load_author_books', 'hp_load_author_books');
add_action('wp_ajax_nopriv_load_author_books', 'hp_load_author_books');

if (!wp_script_is('hp-ajax-author-books', 'enqueued')) {
	wp_enqueue_script(
		'hp-ajax-author-books',
		get_template_directory_uri() . '/assets/js/ajax-author-books.js',
		[],
		null,
		true
	);

	wp_localize_script('hp-ajax-author-books', 'hp_ajax', [
		'url'   => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('hp_ajax_nonce'),
	]);
}

function hp_load_author_books() {
	check_ajax_referer('hp_ajax_nonce', 'nonce');

	$author_id = absint($_POST['author_id'] ?? 0);
	$paged     = absint($_POST['paged'] ?? 1);
	$limit     = 6;

	if (!$author_id || $paged < 1) {
		wp_send_json_error();
	}

	$query = new WP_Query([
		'post_type'      => 'hp_books',
		'posts_per_page' => $limit,
		'paged'          => $paged,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'meta_query'     => [
			[
				'key'     => 'hp_book_author',
				'value'   => (string) $author_id,
				'compare' => 'LIKE',
			],
		],
	]);

	ob_start();
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			get_template_part('template-parts/components/book-card', null, ['post' => get_post()]);
		}
		wp_reset_postdata();
	}
	$html = ob_get_clean();

	wp_send_json_success([
		'html'          => $html,
		'max_num_pages' => $query->max_num_pages,
		'current_page'  => $paged,
	]);
}