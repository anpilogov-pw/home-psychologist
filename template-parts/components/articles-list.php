<?php
/**
 * @var WP_Query $query
 */

$query = $args['query'] ?? null;

if (!$query instanceof WP_Query || !$query->have_posts()) {
	return;
}
?>

<div class="hp-articles-list">
	<?php while ($query->have_posts()):
		$query->the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="hp-card">
			<!-- Изображение -->
			<div class="hp-article-image">
				<a href="<?php the_permalink(); ?>">
					<?php if (has_post_thumbnail()): ?>
						<?php the_post_thumbnail('medium_large', ['class' => 'hp-article-image__img']); ?>
					<?php else: ?>
						<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.jpg'); ?>"
							alt="Изображение отсутствует" class="hp-article-image__img" />
					<?php endif; ?>
				</a>
			</div>

			<header class="hp-card-header">
				<h3 class="hp-card-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<?php
				$authors = get_field('hp-post-author');

				if (!empty($authors) && is_array($authors)) {
					$links = array_map(function ($post) {
						if ($post instanceof WP_Post) {
							$url = get_permalink($post);
							$name = get_the_title($post);

							return sprintf('<a href="%s">%s</a>', esc_url($url), esc_html($name));
						}
						return null;
					}, $authors);

					// Убираем возможные null, если что-то пошло не так
					$links = array_filter($links);

					if (!empty($links)) {
						echo '<p class="hp-card-authors">' . implode(', ', $links) . '</p>';
					}
				}
				?>
			</header>

			<!-- Основной контент (отрывок) -->
			<div class="hp-card-excerpt">
				<?php
				if (has_excerpt()) {
					the_excerpt();
				} else {
					echo wp_trim_words(get_the_content(), 20);
				}
				?>
			</div>

			<!-- Метаинформация статьи -->
			<footer class="hp-card-meta">
				<!-- Категории -->
				<p class="hp-card-cats">
					<!-- Дата публикации -->
					<time datetime="<?php echo get_the_date('c'); ?>" class="hp-card-date">
						<?php echo get_the_date(); ?>
					</time>
					<?php
					$categories = get_the_category();

					if (!empty($categories)) {
						$category_links = array_map(function ($cat) {
							return sprintf(
								'<a href="%s" class="hp-card-cat-link">%s</a>',
								esc_url(get_category_link($cat->term_id)),
								esc_html($cat->name)
							);
						}, $categories);

						echo ' | ' . implode(', ', $category_links);
					}
					?>
				</p>
			</footer>
		</article>
	<?php endwhile; ?>
</div>

<?php wp_reset_postdata(); ?>