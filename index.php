<?php get_header(); 

//var_dump(is_404());
//exit;

?>


<main class="hp-main">
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