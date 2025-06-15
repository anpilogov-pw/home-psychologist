<?php get_header(); ?>

<main class="hp-main hp-main_posts">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<div class="hp-archive">
			<?php get_sidebar(); ?>
			<section class="hp-posts">
				lol
			</section>
		</div>
	</div>

	<?php get_template_part('template-parts/page/page-articles-block', null, [
		'title' => t('page.articles.block.title.populars'),
		'show_link' => false
	]); ?>
</main>

<?php get_footer(); ?>А