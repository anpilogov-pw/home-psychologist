<?php get_header(); ?>

<main class="hp-main hp-page-about">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php breadcrumbs(); ?>
	<div class="hp-block">
		<article class="hp-about">
			<?php the_content(); ?>
		</article>
	</div>
</main>

<?php get_footer(); ?>