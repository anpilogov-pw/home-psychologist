<?php get_header(); ?>

<main class="hp-main hp-main_posts">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<div class="hp-archive hp-archive_single">
			<section class="hp-posts hp-posts_books">
				<div class="hp-posts__list">
					<?php
					// Получаем значение параметра 'cat' из URL
					$taxonomy = 'hp_book_taxonomy'; // Название вашей таксономии
					$term_id = isset($_GET['tax_id']) ? intval($_GET['tax_id']) : 0; // Значение параметра 'cat'

					// Настройка аргументов для поиска
					$args = array(
						'post_type' => 'hp_books', // Тип записи
						'posts_per_page' => 10, // Количество постов на странице
						'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Пагинация
						'orderby' => 'date',
						'order' => 'DESC',
					);

					// Если есть параметр для таксономии, добавляем tax_query
					if ($term_id) {
						$args['tax_query'] = array(
							array(
								'taxonomy' => $taxonomy,
								'field' => 'id',
								'terms' => $term_id,
								'operator' => 'IN',
							),
						);
					}

					$query = new WP_Query($args);

					// Проверяем, есть ли посты в результате запроса
					if ($query->have_posts()):
						while ($query->have_posts()): $query->the_post(); ?>
							<?php get_template_part('template-parts/components/book-card', null, ['post' => get_post()]); ?>
						<?php endwhile;
					else:
						get_template_part('template-parts/page/page-no-results');
					endif;
					?>
				</div>

				<?php if ($query->have_posts()): ?>
					<footer class="hp-posts__footer">
						<?php
						the_posts_pagination(array(
							'prev_text' => '<span class="hidden">Предыдущая</span>' . file_get_contents(get_template_directory() . '/assets/icons/arrow-left.svg'),
							'next_text' => '<span class="hidden">Следующая</span>' . file_get_contents(get_template_directory() . '/assets/icons/arrow-right.svg'),
							'screen_reader_text' => 'Навигация по записям',
						));
						?>
					</footer>
				<?php endif; ?>
			</section>
		</div>
	</div>

	<?php get_template_part('template-parts/page/page-articles-block', null, [
		'title' => t('page.articles.block.title.populars'),
		'show_link' => false
	]); ?>
</main>

<?php get_footer(); ?>
