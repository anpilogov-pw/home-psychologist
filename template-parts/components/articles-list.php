<?php
/**
 * @var WP_Query $query
 */

$query = $args['query'] ?? null;

if (!$query instanceof WP_Query || !$query->have_posts()) {
	return;
}
?>

<div class="custom-articles">
	<?php while ($query->have_posts()):
		$query->the_post(); ?>
		<article class="custom-article">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="excerpt"><?php echo wp_trim_words(get_the_content(), 20); ?></div>
		</article>
	<?php endwhile; ?>
</div>

<?php wp_reset_postdata(); ?>