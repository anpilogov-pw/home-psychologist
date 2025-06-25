<?php get_header(); ?>

<main class="hp-main hp-main_single hp-main_person">
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php
			$avatar = get_field('hp_author_avatar');
			$career = get_field('hp_author_career');
			$bio = get_field('hp_author_bio');
			$terms = get_the_terms( get_the_ID(), 'hp_book_taxonomy' );
		?>
		<article id="person-<?php the_ID(); ?>" class="hp-block hp-person">
			<?php if ($avatar) : ?>
				<picture class="hp-person-picture" data-fancybox data-src="<?php echo esc_url($avatar); ?>" data-caption="<?php the_title(); ?>">
					<img class="hp-person-picture__image" src="<?php echo esc_url($avatar); ?>" width="248" height="248" alt="<?php the_title(); ?>">
				</picture>
			<?php else: ?>
				<picture class="hp-person-picture">
					<img class="hp-person-picture__image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.jpg'); ?>" width="248" height="248" alt="Изображение отсутствует" />
				</picture>
			<?php endif; ?>
			<section class="hp-person__wrapper">
				<h1 class="hp-person__title"><?php the_title(); ?></h1>

				<?php if (!empty($terms) && !is_wp_error($terms)): ?>
					<div class="hp-person-block">
						<h2 class="hp-person-block__title">Рубрики автора:</h2>
						<ul class="hp-person-block-list">
							<?php foreach ($terms as $term): ?>
								<?php $term_link = get_term_link( $term ); ?>
								<li class="hp-person-block-list__item">
									<?php if (!is_wp_error($term_link)): ?>
										<a class="hp-chips hp-chips_link" href="<?php echo esc_url($term_link); ?>" title="<?php echo esc_attr($term->name); ?>">
											<?php echo esc_html($term->name); ?>
										</a>
									<?php else: ?>
										<span class="hp-chips" title="<?php echo esc_attr($term->name); ?>">
											<?php echo esc_html($term->name); ?>
										</span>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if ($career) : ?>
					<div class="hp-person-block">
						<h2 class="hp-person-block__title">Профессия:</h2>
						<p class="hp-chips hp-chips_prof" title="<?php echo esc_attr($career); ?>">
							<?php echo esc_html($career); ?>
						</p>
					</div>
				<?php endif; ?>

				<?php if ($bio) : ?>
					<div class="hp-person-block">
						<h2 class="hp-person-block__title">Биография:</h2>
						<div class="hp-person-block__wrapper">
							<?php echo wp_kses_post($bio); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if( have_rows('hp_author_achievements') ): ?>
					<div class="hp-person-block hp-person-block_list">
						<h2 class="hp-person-block__title">Награды и рейтинги:</h2>
						<div class="hp-person-block__wrapper">
							<ul class="hp-person-achievement-list">
								<?php while( have_rows('hp_author_achievements') ): the_row(); ?>
									<?php
										$achievement_description = get_sub_field('hp_author_achievement_description');
										$achievement_date = get_sub_field('hr_author_date_achievement');
									?>
									<li class="hp-person-achievement-list__item">
										<p><span><?php echo esc_html($achievement_date); ?></span>&nbsp;-<?php echo esc_html($achievement_description); ?></p>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>
			</section>
		</article>
	<?php endwhile; endif; ?>

	<?php get_template_part('template-parts/page/page-books-block', null, [
		'title' => 'Книги автора',
		'show_link' => false,
		'color_schema' => 'gray'
	]); ?>
</main>

<?php get_footer(); ?>