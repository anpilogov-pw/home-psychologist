<?php
$author_id = $args['author_id'] ?? '';
$title = $args['title'] ?? 'Книги автора';
$limit = $args['limit'] ?? 6;

if (!$author_id) {
	return;
}

$query = new WP_Query([
	'post_type'      => 'hp_books',
	'posts_per_page' => $limit,
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

$show_button = $query->max_num_pages > 1;

if (!$query->have_posts()) {
	return;
}
?>

<section class="hp-books-block hp-books-block_gray">
	<div class="hp-block hp-books-block__wrapper">
		<hgroup class="hp-books-block__hgroup">
			<h2 class="hp-books-block__title">
				<?php echo esc_html($title); ?>
			</h2>
		</hgroup>
		<div class="hp-books-list">
			<?php while ($query->have_posts()): $query->the_post(); ?>
				<?php get_template_part('template-parts/components/book-card', null, ['post' => get_post()]); ?>
			<?php endwhile; ?>
		</div>
	</div>
	<?php if ($show_button): ?>
		<div class="hp-block hp-books-block__upload">
			<?php get_template_part('template-parts/components/button', null, [
				'id'          => 'hp-books-author-upload',
				'text'        => 'Загрузить ещё',
				'aria_label'  => 'Загрузить ещё книги',
				'icon'        => file_get_contents(get_template_directory() . '/assets/icons/arrow-dawn.svg'),
				'data'        => [
					'author-id' => $author_id,
				],
			]); ?>
		</div>
	<?php endif; ?>
</section>

<?php wp_reset_postdata(); ?>
