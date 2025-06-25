<?php
$expert_id = $args['expert_id'] ?? '';
$title = $args['title'] ?? 'Публикации эксперта';
$limit = $args['limit'] ?? 6;

if (!$expert_id) {
	return;
}

$query = new WP_Query([
	'post_type'      => 'post',
	'posts_per_page' => $limit,
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

$show_button = $query->max_num_pages > 1;

if (!$query->have_posts()) {
	return;
}
?>

<section class="hp-articles-block">
	<div class="hp-block hp-articles-block__wrapper">
		<hgroup class="hp-articles-block__hgroup">
			<h2 class="hp-articles-block__title">
				<?php echo esc_html($title); ?>
			</h2>
		</hgroup>
		<div class="hp-articles-list">
			<?php while ($query->have_posts()): $query->the_post(); ?>
				<?php get_template_part('template-parts/components/article-card', null, ['post' => get_post()]); ?>
			<?php endwhile; ?>
		</div>
	</div>
	<?php if ($show_button): ?>
		<div class="hp-block hp-articles-block__upload">
			<?php get_template_part('template-parts/components/button', null, [
				'id'          => 'hp-post-experts-upload',
				'text'        => 'Загрузить ещё',
				'aria_label'  => 'Загрузить ещё публикации',
				'icon'        => file_get_contents(get_template_directory() . '/assets/icons/arrow-dawn.svg'),
				'data'        => [
					'expert-id' => $expert_id,
				],
			]); ?>
		</div>
	<?php endif; ?>
</section>

<?php wp_reset_postdata(); ?>
