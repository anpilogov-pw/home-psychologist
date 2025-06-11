<?php get_header();

$is_experts = is_post_type_archive('hp_experts') || is_category('hp_experts');
$is_authors = is_post_type_archive('hp_authors') || is_category('hp_authors');
$show_offer_block = get_field('hp-show-offer-block', 'option');
$offer_block_text = get_field('hp-offer-block-text', 'option');
$offer_block_text_link = get_field('hp-offer-block-link-text', 'option');
$offer_block_link = get_field('hp-offer-block-link', 'option');
?>

<main class="hp-main hp-main_archive">
	<?php get_template_part('template-parts/page/page-header'); ?>

	<?php breadcrumbs(); ?>

	<?php if (have_posts()):
		while (have_posts()):
			the_post(); ?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<p><?php the_excerpt(); ?></p>
		<?php endwhile; else: ?>
		Записей нет.
	<?php endif; ?>

	<?php if (($is_experts || $is_authors) && $show_offer_block): ?>
		<?php
		get_template_part('template-parts/page/page-offer-block', null, [
			'text' => $offer_block_text,
			'link' => $offer_block_link,
			'link_text' => $offer_block_text_link,
		]);
		?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>