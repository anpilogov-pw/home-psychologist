<?php
add_action('wp_ajax_load_expert_posts', 'hp_load_expert_posts');
add_action('wp_ajax_nopriv_load_expert_posts', 'hp_load_expert_posts');

if (!wp_script_is('hp-ajax-expert-posts', 'enqueued')) {
	wp_enqueue_script(
		'hp-ajax-expert-posts',
		get_template_directory_uri() . '/assets/js/ajax-expert-posts.js',
		[],
		null,
		true
	);

	wp_localize_script('hp-ajax-expert-posts', 'hp_ajax', [
		'url'   => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('hp_ajax_nonce'),
	]);
}

function hp_load_expert_posts() {
	check_ajax_referer('hp_ajax_nonce', 'nonce');

	$expert_id = absint($_POST['expert_id'] ?? 0);
	$paged     = absint($_POST['paged'] ?? 1);
	$limit     = 6;

	if (!$expert_id || $paged < 1) {
		wp_send_json_error();
	}

	$query = new WP_Query([
		'post_type'      => 'post',
		'posts_per_page' => $limit,
		'paged'          => $paged,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'meta_query'     => [
			[
				'key'     => 'hp-post-author',
				'value'   => (string) $expert_id,
				'compare' => 'LIKE',
			],
		],
	]);

	ob_start();
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			get_template_part('template-parts/components/article-card', null, ['post' => get_post()]);
		}
		wp_reset_postdata();
	}

	$html = ob_get_clean();

	wp_send_json_success([
		'html'            => $html,
		'max_num_pages'   => $query->max_num_pages,
		'current_page'    => $paged,
	]);
}
