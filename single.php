<?php get_header(); ?>

<main class="hp-main hp-main_single">
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<article>
			<?php
			if (have_posts()):
				while (have_posts()):
					the_post();
					the_content();
				endwhile;
			endif;
			?>
		</article>
		<aside></aside>
	</div>

	<?php get_template_part('template-parts/page/page-articles-block', null, [
		'title' => t('page.articles.block.title.populars'),
		'link_text' => t('page.articles.block.link.title'),
		'link' => '/blog/'
	]); ?>
</main>

<?php get_footer(); ?>