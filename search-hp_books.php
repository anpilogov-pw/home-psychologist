<?php get_header(); ?>

<main class="hp-main hp-main_posts">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<div class="hp-archive hp-archive_single">
			<section class="hp-posts hp-posts_books">
				<div class="hp-posts__list">
					<?php if (have_posts()):
						while (have_posts()):
							the_post(); ?>
							<?php get_template_part('template-parts/components/book-card', null, ['post' => get_post()]); ?>
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

	<?php get_template_part('template-parts/page/page-articles-block', null, [
		'title' => t('page.articles.block.title.populars'),
		'show_link' => false
	]); ?>
</main>

<?php get_footer(); ?>А