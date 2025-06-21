<?php get_header(); ?>

<main class="hp-main hp-main_category">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<div class="hp-archive hp-archive_book">
			<?php 
			/**
			* Вызываем sidebar-book в шаблоне
			*/
			get_template_part('template-parts/aside/sidebar-book', null, []); 
			?>
			<section class="hp-posts">
				<?php 
				// Получаем текущую таксономию и её термин
				$taxonomy = 'hp_book_taxonomy'; // Название вашей таксономии
				$term_id = get_queried_object()->term_id; // ID текущего термина

				// Проверка параметров в URL
				$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'date';
				$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

				// Убедитесь, что пагинация работает корректно
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				// Новый WP_Query для фильтрации по типу записи и таксономии
				$args = array(
					'post_type' => 'hp_books', // Ограничение выборки только по типу записи hp_books
					'orderby' => $orderby,
					'order' => $order,
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy,
							'terms' => $term_id,
							'field' => 'id',
							'operator' => 'IN',
						),
					),
					'post_status' => 'publish',
					'posts_per_page' => 8, // Количество записей на странице
					'paged' => $paged, // Текущая страница для пагинации
				);

				$query = new WP_Query($args);
				
				// Проверяем, есть ли посты в результате запроса
				if ($query->have_posts()): ?>
					<header class="hp-posts__header">
						<nav class="hp-posts__nav">
							<?php
							$is_active = (isset($_GET['orderby']) && $_GET['orderby'] == 'date' && $_GET['order'] == 'DESC') ? '' : 'hp-button_gray';
							get_template_part('template-parts/components/link_button', null, [
								'id' => 'hp-orderby-date-desc',
								'href' => '?orderby=date&order=DESC',
								'text' => 'По новизне',
								'class' => $is_active
							]);
							?>
							<?php
							$is_active = (isset($_GET['orderby']) && $_GET['orderby'] == 'date' && $_GET['order'] == 'ASC') ? '' : 'hp-button_gray';
							get_template_part('template-parts/components/link_button', null, [
								'id' => 'hp-orderby-comment-desc',
								'href' => '?orderby=date&order=ASC',
								'text' => 'По популярности',
								'class' => $is_active
							]);
							?>
						</nav>
					</header>
					<div class="hp-posts__list">
						<?php while ($query->have_posts()): $query->the_post(); ?>
							<?php get_template_part('template-parts/components/book-card', null, ['post' => get_post()]); ?>
						<?php endwhile; ?>
					</div>
					<footer class="hp-posts__footer">
						<?php
						the_posts_pagination(array(
							'prev_text' => '<span class="hidden">Предыдущая</span>' . file_get_contents(get_template_directory() . '/assets/icons/arrow-left.svg'),
							'next_text' => '<span class="hidden">Следующая</span>' . file_get_contents(get_template_directory() . '/assets/icons/arrow-right.svg'),
							'screen_reader_text' => 'Навигация по записям',
						));
						?>
					</footer>
				<?php else: ?>
					<?php get_template_part('template-parts/page/page-no-results'); ?>
				<?php endif; ?>
			</section>
		</div>
	</div>
</main>

<?php get_footer(); ?>
