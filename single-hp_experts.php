<?php get_header(); ?>

<main class="hp-main hp-main_single hp-main_person">
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php
			$avatar = get_field('hp_expert_avatar');
			$career = get_field('hp_expert_prof');
			$bio = get_field('hp_expert_bio');
			$categories = get_the_category();
			$id = get_the_ID();
		?>
		<article id="person-<?php the_ID(); ?>" class="hp-block hp-person">
			<?php if ($avatar) : ?>
				<picture class="hp-person-picture" data-fancybox data-src="<?php echo esc_url($avatar); ?>" data-caption="<?php the_title(); ?>">
					<img class="hp-person-picture__image" src="<?php echo esc_url($avatar); ?>" width="248" height="248" alt="<?php the_title(); ?>">
				</picture>
			<?php else: ?>
				<picture class="hp-person-picture">
					<img class="hp-person-picture__image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.webp'); ?>" width="248" height="248" alt="Изображение отсутствует" />
				</picture>
			<?php endif; ?>
			<section class="hp-person__wrapper">
				<h1 class="hp-person__title"><?php the_title(); ?></h1>

				<?php if (!empty($categories) && !is_wp_error($categories)): ?>
					<div class="hp-person-block">
						<h2 class="hp-person-block__title">Рубрики эксперта:</h2>
						<ul class="hp-person-block-list">
							<?php foreach ($categories as $category): ?>
								<li class="hp-person-block-list__item">
									<a class="hp-chips hp-chips_link" href="<?php echo esc_url(get_category_link($category->term_id)); ?>" title="<?php echo esc_attr($category->name); ?>">
										<?php echo esc_html($category->name); ?>
									</a>
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
						<h2 class="hp-person-block__title">Об эксперте:</h2>
						<div class="hp-person-block__wrapper">
							<?php echo wp_kses_post($bio); ?>
						</div>
					</div>
				<?php endif; ?>
			</section>
		</article>
		<?php if( have_rows('hp_person_license') ): ?>
			<section class="hp-block hp-person-licenses">
				<h2 class="hp-person-licenses__title">Лицензии</h2>
				<ul class="hp-person-licenses-list">
					<?php while( have_rows('hp_person_license') ): the_row(); ?>
						<?php
							$license_name = get_sub_field('hp_license_name');
							$license_date = get_sub_field('hp_license_date');
							$license_image = get_sub_field('hp_license_image');

							if ($license_date) {
								$license_date_obj = DateTime::createFromFormat('Ymd', $license_date);
								if ($license_date_obj) {
									$datetime_attr = $license_date_obj->format('Y-m-d');
									$display_date = $license_date_obj->format('Y');
								}
							}
						?>
						<li class="hp-person-licenses-list__item">
							<article class="hp-persone-license-card" data-fancybox="gallery" data-src="<?php echo esc_url($license_image); ?>" data-caption="<?php echo esc_html($license_name); ?>">
								<?php if ($avatar) : ?>
									<img class="hp-persone-license-card__image" src="<?php echo esc_url($license_image); ?>" width="258" height="320" alt="<?php echo esc_html($license_name); ?>">
								<?php else: ?>
									<img class="hp-persone-license-card__image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.webp'); ?>" width="172" height="172" alt="Изображение отсутствует" />
								<?php endif; ?>
								<h3 class="hp-persone-license-card__title" title="<?php echo esc_html($license_name); ?>"><?php echo esc_html($license_name); ?></h3>
								<time class="hidden" datetime="<?php echo esc_attr($datetime_attr ?? ''); ?>"><?php echo esc_html($display_date); ?></time>
							</article>
						</li>
					<?php endwhile; ?>
				</ul>
			</section>
		<?php endif; ?>
	<?php endwhile; endif; ?>

	<?php if ($id) : ?>
		<?php get_template_part('template-parts/page/page-expert-articles-block', null, [
			'title' => 'Статьи эксперта',
			'expert_id' => $id
		]); ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>