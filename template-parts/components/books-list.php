<?php
/**
 * @var WP_Query $query
 */

$query = $args['query'] ?? null;

if (!$query instanceof WP_Query || !$query->have_posts()) {
	return;
}
?>

<div class="hp-books-list">
	<?php while ($query->have_posts()):
		$query->the_post(); ?>
		<?php get_template_part('template-parts/components/book-card', null, ['post' => get_post()]); ?>
	<?php endwhile; ?>
</div>

<?php wp_reset_postdata(); ?>