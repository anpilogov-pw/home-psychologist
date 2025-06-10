<?php get_header(); ?>

<main class="hp-main hp-main_archive">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php breadcrumbs(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p><?php the_excerpt(); ?></p>
	<?php endwhile; else: ?>
		Записей нет.
	<?php endif; ?>
</main>

<?php get_footer(); ?>