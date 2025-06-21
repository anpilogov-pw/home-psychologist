<?php get_header(); ?>

<main class="hp-main hp-main_archive">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<div class="hp-archive">
			<?php 
			/**
			* Вызываем sidebar-book в шаблоне
			*/
			get_template_part('template-parts/aside/sidebar-book', null, []); 
			?>
			<section class="hp-posts">
				<?php if (have_posts()): ?>
					<header class="hp-posts__header">
						<nav class="hp-posts__nav">
							<?php
							$is_active = (isset($_GET['orderby']) && $_GET['orderby'] == 'title' && $_GET['order'] == 'ASC') ? '' : 'hp-button_gray';
							get_template_part('template-parts/components/link_button', null, [
								'id' => 'hp-orderby-title-asc',
								'href' => '?orderby=title&order=ASC',
								'text' => 'А-Я',
								'class' => $is_active
							]);
							?>
							<?php
							$is_active = (isset($_GET['orderby']) && $_GET['orderby'] == 'title' && $_GET['order'] == 'DESC') ? '' : 'hp-button_gray';
							get_template_part('template-parts/components/link_button', null, [
								'id' => 'hp-orderby-title-decs',
								'href' => '?orderby=title&order=DESC',
								'text' => 'Я-А',
								'class' => $is_active
							]);
							?>
						</nav>
					</header>
				<?php endif; ?>
				<div class="hp-posts__list">
					<?php if (have_posts()):
						while (have_posts()):
							the_post(); ?>
							<?php get_template_part('template-parts/components/book-card', null, ['post' => get_post()]); ?>
						<?php endwhile; else: ?>
						<?php get_template_part('template-parts/page/page-no-posts'); ?>
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
	
	<?php get_template_part('template-parts/page/page-seo-block'); ?>
</main>

<?php get_footer(); ?>