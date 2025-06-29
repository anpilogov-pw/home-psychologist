<?php
/**
 * @var WP_Post $post
 */

if (!isset($post) || !$post instanceof WP_Post) {
	return;
}

setup_postdata($post); // Обеспечим доступ к функциям шаблона типа the_title(), и т.д.

$exp_echeck = get_field('hp_book_age_check');
$exp_number = get_field('hp_book_age_number');
$ozon = get_field('hp_book_ozon');
$wb = get_field('hp_book_wb');
?>


<article id="book-<?php the_ID(); ?>" class="hp-book-card">
	<div class="hp-book-image">
		<?php if ($exp_echeck) : ?>
			<div class="hp-book-age">
				<span class="hp-book-age__text">
					<?php echo esc_html($exp_number); ?>+
				</span>
			</div>
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>">
			<?php if (has_post_thumbnail($post)): ?>
				<?php the_post_thumbnail('medium_large', ['class' => 'hp-book-image__img']); ?>
			<?php else: ?>
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.jpg'); ?>"
					alt="Изображение отсутствует" class="hp-book-image__img" />
			<?php endif; ?>
		</a>
	</div>
	<div class="hp-book-rating">
		<div class="hp-book-rating__item">
			<span><?php echo esc_html($ozon); ?>/10</span>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/ozon.png'); ?>" width="24" height="24" alt="Рейтинг Ozon" loading="lazy">
		</div>
		<div class="hp-book-rating__item">
			<span><?php echo esc_html($wb); ?>/10</span>
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/wb.png'); ?>" width="24" height="24" alt="Рейтинг WB" loading="lazy">
		</div>
	</div>
	<header class="hp-book-card-header">
		<h3 class="hp-book-card-title" title="<?php the_title(); ?>">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php
		$authors = get_field('hp_book_author', $post->ID);

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
				echo '<p class="hp-book-card-authors">' . implode(', ', $links) . '</p>';
			}
		}
		?>
	</header>
	<div class="hp-book-card-excerpt">
		<?php
		if (has_excerpt()) {
			the_excerpt();
		} else {
			echo wp_trim_words(get_the_content(), 20);
		}
		?>
	</div>
	<footer class="hp-book-card-meta">
			<p class="hp-book-card-cats">
					<time datetime="<?php echo get_the_date('c'); ?>" class="hp-book-card-date hidden">
							<?php echo get_the_date(); ?>
					</time>
					<?php
					// Получаем термины таксономии hp_book_taxonomy, связанные с текущей записью
					$terms = get_the_terms(get_the_ID(), 'hp_book_taxonomy');
					
					// Проверяем, если термины найдены
					if (!empty($terms) && !is_wp_error($terms)) {
							// С помощью array_map создаем ссылки на термины
							$term_links = array_map(function ($term) {
									return sprintf(
											'<a href="%s" class="hp-book-card-cat-link">%s</a>',
											esc_url(get_term_link($term)),
											esc_html($term->name)
									);
							}, $terms);
							
							// Выводим термины, разделенные запятой
							echo implode(', ', $term_links);
					}
					?>
			</p>
	</footer>
</article>

<?php wp_reset_postdata(); ?>