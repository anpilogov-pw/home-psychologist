<?php get_header(); ?>

<main class="hp-main hp-main_search">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php breadcrumbs(); ?>
	<?php
	if (have_posts()):
		while (have_posts()):
			the_post();
			the_content();
		endwhile;
	endif;
	?>
</main>

<?php get_footer(); ?>