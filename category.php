<?php get_header(); ?>

<main class="hp-main hp-main_category">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<div class="hp-archive">
			<?php get_sidebar(); ?>
			<section class="hp-posts">
				<?php if (have_posts()): ?>
					<header class="hp-posts__header">
						<nav class="hp-posts__nav">
							<?php
							$current_orderby = $_GET['orderby'] ?? '';
							$current_order = strtoupper($_GET['order'] ?? 'DESC');

							// Определим, в каком направлении сейчас сортировка по дате
							$is_date_asc = ($current_orderby === 'date' && $current_order === 'ASC');
							$is_date_desc = ($current_orderby === 'date' && $current_order === 'DESC');

							// Кнопка сортировки по дате: переключение направления
							get_template_part('template-parts/components/link_button', null, [
								'id' => 'hp-orderby-date-toggle',
								'href' => '?orderby=date&order=' . ($is_date_asc ? 'DESC' : 'ASC'),
								'text' => 'По новизне ' . ($is_date_asc ? '↑' : '↓'),
								'class' => ($current_orderby === 'date') ? '' : 'hp-button_gray'
							]);

							// Кнопка "Сбросить", если есть параметры сортировки
							if (!empty($current_orderby) || !empty($_GET['order'])) {
								get_template_part('template-parts/components/link_button', null, [
									'id' => 'hp-orderby-reset',
									'href' => strtok($_SERVER["REQUEST_URI"], '?'), // Убираем GET-параметры
									'text' => 'Сбросить',
									'class' => 'hp-button_gray'
								]);
							}
							?>
						</nav>
					</header>
				<?php endif; ?>
				<div class="hp-posts__list">
					<?php if (have_posts()):
						while (have_posts()): ?>
							<?php get_template_part('template-parts/components/article-card', null, ['post' => the_post()]); ?>
						<?php endwhile; else: ?>
						<?php get_template_part('template-parts/page/page-no-results'); ?>
					<?php endif; ?>
				</div>
				<?php if (have_posts()): ?>
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
</main>

<?php get_footer(); ?>