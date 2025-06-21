<?php get_header();

$show_offer_block = get_field('hp-show-offer-block', 'option');
$offer_block_text = get_field('hp-offer-block-text', 'option');
$offer_block_text_link = get_field('hp-offer-block-link-text', 'option');
$offer_block_link = get_field('hp-offer-block-link', 'option');
?>

<main class="hp-main hp-main_archive hp-main_person hp-main_authors">
	<?php get_template_part('template-parts/page/page-header'); ?>
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<div class="hp-block">
		<div class="hp-archive hp-archive_single">
			<section class="hp-posts hp-posts_persons">
				<div class="hp-posts__list">
					<?php if (have_posts()):
						while (have_posts()):
							the_post(); ?>
							<?php get_template_part('template-parts/components/author-card', null, ['post' => get_post()]); ?>
						<?php endwhile; else: ?>
						<?php get_template_part('template-parts/page/page-no-posts'); ?>
					<?php endif; ?>
				</div>
				<?php if (have_posts()): ?>
					<footer class="hp-posts__footer">
						<?php
						the_posts_pagination(array(
							'prev_text' => '<span class="hidden">Предыдущая</span>' . file_get_contents(get_template_directory() . '/assets/icons/arrow-left.svg'),
							'next_text' => '<span class="hidden">Следующая</span>' . file_get_contents(get_template_directory() . '/assets/icons/arrow-right.svg'),
							'screen_reader_text' => 'Навигация по записям',
						));
						?>
					</footer>
				<?php endif; ?>
			</section>
		</div>
	</div>

	<?php if ($show_offer_block): ?>
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