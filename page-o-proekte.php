<?php get_header(); ?>

<main class="hp-main hp-mainhp-main_about">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php breadcrumbs(); ?>
	<div class="hp-block">
		<div class="hp-about">
			<?php the_content(); ?>
		</div>
	</div>
	<?php get_template_part('template-parts/page/page-articles-block', null, [
		'title' => t('page.articles.block.title.populars'),
		'link_text' => t('page.articles.block.link.title'),
		'link' => '/blog/'
	]); ?>
</main>

<?php get_footer(); ?>