<?php
/**
 * @var WP_Post $post
 */

if (!isset($post) || !$post instanceof WP_Post) {
	return;
}

setup_postdata($post); // Обеспечим доступ к функциям шаблона типа the_title(), и т.д.
?>

<article id="post-<?php the_ID(); ?>" class="hp-card">
	<div class="hp-article-image">
		<a href="<?php the_permalink(); ?>">
			<?php if (has_post_thumbnail($post)): ?>
				<?php the_post_thumbnail('medium_large', ['class' => 'hp-article-image__img', 'loading' => 'lazy']); ?>
			<?php else: ?>
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.webp'); ?>"
					alt="Изображение отсутствует" class="hp-article-image__img" />
			<?php endif; ?>
		</a>
	</div>

	<header class="hp-card-header">
		<h3 class="hp-card-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php
		$authors = get_field('hp-post-author', $post->ID);

		if (!empty($authors) && is_array($authors)) {
			$links = array_map(function ($authorPost) {
				if ($authorPost instanceof WP_Post) {
					return sprintf(
						'<a href="%s">%s</a>',
						esc_url(get_permalink($authorPost)),
						esc_html(get_the_title($authorPost))
					);
				}
				return null;
			}, $authors);

			$links = array_filter($links);

			if (!empty($links)) {
				echo '<p class="hp-card-authors">' . implode(', ', $links) . '</p>';
			}
		}
		?>
	</header>

	<div class="hp-card-excerpt">
		<?php
		if (has_excerpt()) {
			the_excerpt();
		} else {
			echo wp_trim_words(get_the_content(), 20);
		}
		?>
	</div>

	<footer class="hp-card-meta">
		<p class="hp-card-cats">
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

<?php wp_reset_postdata(); ?>