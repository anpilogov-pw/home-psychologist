<?php get_header(); ?>

<main class="hp-main hp-main_single hp-main_book">
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php
			$gallery = get_field('hp_book-gallery');
			$ibsn = get_field('hp_book_ibsn');
			$publish_date = get_field('hp_book_year');
			$description = get_field('hp_book_description');
			$age_check = get_field('hp_book_age_check');
			$age = get_field('hp_book_age_number');
			$terms = get_the_terms( get_the_ID(), 'hp_book_taxonomy' );
			$authors = get_field('hp_book_author');
			$ozon = get_field('hp_book_ozon');
			$wb = get_field('hp_book_wb');
			$id = get_the_ID();
		?>
		<article id="book-<?php the_ID(); ?>" class="hp-block hp-book">
			<div class="hp-book-content">
				<div class="hp-book-content__wrapper">
					<div class="hp-book-header">
						<?php get_template_part('template-parts/components/button', null, [
							'id'          => 'hp-share',
							'text'        => 'Поделиться книгой',
							'aria_label'  => 'Поделиться книгой',
							'icon'        => file_get_contents(get_template_directory() . '/assets/icons/reply-fill.svg'),
							'class' => 'hp-button_outline'
						]); ?>
						<div class="hp-book-rating">
							<div class="hp-book-rating__item">
								<span><?php echo esc_html($ozon); ?>/10</span>
								<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/ozon.png'); ?>" width="24" height="24" alt="Рейтинг Ozon" loading="lazy">
							</div>
							<div class="hp-book-rating__item">
								<span><?php echo esc_html($wb); ?>/10</span>
								<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/wb.png'); ?>" width="24" height="24" alt="Рейтинг WB" loading="lazy">
							</div>
						</div>
					</div>
					<div id="hp-book-gallery" class="hp-book-gallery">
						<div class="hp-book-gallery__thumbnail">
							<botton type="button" class="hp-book-gallery__prev" aria-label="Следующий слайд">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
									<path fill="currentColor" fill-rule="evenodd" d="M2.33 10.164a.75.75 0 0 1 1.004-.335L12 14.16l8.664-4.331a.75.75 0 1 1 .672 1.34l-9 4.5a.75.75 0 0 1-.672 0l-9-4.5a.75.75 0 0 1-.335-1.004Z" clip-rule="evenodd"/>
								</svg>
							</botton>
							<a href="<?php echo esc_url($gallery[0]['url']); ?>" data-fancybox="book-gallery" data-caption="<?php echo esc_attr($gallery[0]['alt'] ?? ''); ?>">
								<img id="active-main-image" src="<?php echo esc_url($gallery[0]['url']); ?>" alt="<?php echo esc_attr($gallery[0]['alt'] ?? ''); ?>" width="296" height="380" />
							</a>
							<botton type="button" class="hp-book-gallery__next" aria-label="Следующий слайд">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
									<path fill="currentColor" fill-rule="evenodd" d="M2.33 10.164a.75.75 0 0 1 1.004-.335L12 14.16l8.664-4.331a.75.75 0 1 1 .672 1.34l-9 4.5a.75.75 0 0 1-.672 0l-9-4.5a.75.75 0 0 1-.335-1.004Z" clip-rule="evenodd"/>
								</svg>
							</botton>
						</div>
						<div class="hp-book-gallery__wrapper">
							<botton type="button" class="hp-book-gallery-list__start" aria-label="Предыдущий слайд">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
									<path fill="#15803D" fill-rule="evenodd" d="M11.664 8.33a.75.75 0 0 1 .672 0l9 4.5a.748.748 0 0 1 .16 1.24.75.75 0 0 1-.832.1L12 9.84l-8.664 4.33a.75.75 0 1 1-.672-1.34l9-4.5Z" clip-rule="evenodd"/>
								</svg>
							</botton>
							<div class="hp-book-gallery-list">
								<?php foreach ($gallery as $index => $image): ?>
									<a href="<?php echo esc_url($image['url']); ?>" data-fancybox="book-gallery" data-caption="<?php echo esc_attr($image['alt']); ?>">
										<img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" width="86" height="86" loading='lazy' />
									</a>
								<?php endforeach; ?>
							</div>
							<botton type="button" class="hp-book-gallery-list__end" aria-label="Следующий слайд">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
									<path fill="#15803D" fill-rule="evenodd" d="M2.33 10.164a.75.75 0 0 1 1.004-.335L12 14.16l8.664-4.331a.75.75 0 1 1 .672 1.34l-9 4.5a.75.75 0 0 1-.672 0l-9-4.5a.75.75 0 0 1-.335-1.004Z" clip-rule="evenodd"/>
								</svg>
							</botton>
						</div>
					</div>
				</div>
				<div class="hp-book-single">
					<h1 class="hp-book-single__title"><?php the_title(); ?></h1>
					<?php if ($age_check) : ?>
						<p class="hp-book-single__item">Возрастное ограничение: <span class="hp-chips" title="<?php echo esc_attr($age); ?>"><?php echo esc_html($age); ?>+</span></p>
					<?php endif; ?>
					<p class="hp-book-single__item">
						Рубрики: 
						<?php if (!empty($terms) && !is_wp_error($terms)): ?>
							<?php foreach ($terms as $term): ?>
								<?php $term_link = get_term_link( $term ); ?>
									<?php if (!is_wp_error($term_link)): ?>
										<a class="hp-chips hp-chips_link" href="<?php echo esc_url($term_link); ?>" title="<?php echo esc_attr($term->name); ?>">
											<?php echo esc_html($term->name); ?>
										</a>
									<?php else: ?>
										<span class="hp-chips" title="<?php echo esc_attr($term->name); ?>">
											<?php echo esc_html($term->name); ?>
										</span>
									<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</p>
					<p class="hp-book-single__item">
						Автор: 
						<?php foreach ($authors as $raw_post): ?>
							<?php 
								$author_post = get_post($raw_post->ID);
							?>
							<a class="hp-chips hp-chips_link" href="<?= esc_url(get_permalink($author_post->ID)); ?>" title="<?php echo esc_attr($author_post->post_title); ?>">
								<?php echo esc_html($author_post->post_title); ?>
							</a>
						<?php endforeach; ?>
					</p>
					<p class="hp-book-single__item">
						ISBN: 
						<span class="hp-chips" title="<?php echo esc_attr($ibsn); ?>" data-copy="<?php echo esc_attr($ibsn); ?>">
							<?php echo esc_html($ibsn); ?>
							<svg class="hp-chips__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16" aria-hidden="true">
								<g clip-path="url(#a)">
									<path fill="#15803D" d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2Zm5 10v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-2v5a2 2 0 0 1-2 2H5Zm6-8V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2V6a2 2 0 0 1 2-2h5Z"/>
								</g>
								<defs>
									<clipPath id="a">
										<path fill="#fff" d="M0 0h16v16H0z"/>
									</clipPath>
								</defs>
							</svg>
						</span>
					</p>
					<p class="hp-book-single__item">
						Год публикации: 
						<span class="hp-chips" title="<?php echo esc_attr($publish_date); ?>">
							<?php echo esc_html($publish_date); ?>
							<svg class="hp-chips__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16" aria-hidden="true">
								<g clip-path="url(#a)">
									<path fill="#15803D" d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Z"/>
									<path fill="#15803D" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5ZM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1Z"/>
								</g>
								<defs>
									<clipPath id="a">
										<path fill="#fff" d="M0 0h16v16H0z"/>
									</clipPath>
								</defs>
							</svg>
						</span>
					</p>
					<p class="hp-book-single__item">
						Последнее обновление: 
						<span class="hp-chips" title="<?php echo get_the_modified_time('d.m.Y'); ?>">
							<?php echo get_the_modified_time('d.m.Y'); ?>
							<svg class="hp-chips__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16" aria-hidden="true">
								<g clip-path="url(#a)">
									<path fill="#15803D" d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Z"/>
									<path fill="#15803D" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5ZM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1Z"/>
								</g>
								<defs>
									<clipPath id="a">
										<path fill="#fff" d="M0 0h16v16H0z"/>
									</clipPath>
								</defs>
							</svg>
						</span>
					</p>
					<section class="hp-book-description">
						<h2 class="hp-book-description__title">Описание:</h2>
						<div class="hp-book-description__text">
							<?php echo wp_kses_post($description); ?>
						</div>
					</section>
				</div>
			</div>
		</article>

		<?php if (comments_open()) : ?>
			<?php if (get_comments_number()) : ?>
				<section class="hp-block hp-book-comments" aria-labelledby="comments-title">
					<hgroup class="hp-book-comments-header">
						<h2 class="hp-book-comments-header__title" id="comments-title">Отзывы читателей</h2>
						<div class="hp-book-comments-header__actions">
							<?php get_template_part('template-parts/components/button', null, [
									'id' => "hp-add-comment",
									'text' => 'Оставить отзыв',
									'aria_label' => 'Оставить отзыв',
							]); ?>
						</div>
					</hgroup>
					<div class="hp-book-comments__list">
						<?php
							$comments = get_comments([
								'post_id' => get_the_ID(),
								'status'  => 'approve',
								'type'    => 'comment',
							]);

							foreach ($comments as $comment) :
								$rating = intval(get_comment_meta($comment->comment_ID, 'hp_rating', true));
								$rating = ($rating >= 1 && $rating <= 5) ? $rating : 0;

								$stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating); // Заполненные и пустые звезды
							?>
							<article class="hp-book-comment" itemscope itemtype="https://schema.org/Review">
								<?php if ($rating): ?>
									<div class="hp-book-comment__ratin" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
										<meta itemprop="worstRating" content="1"/>
										<meta itemprop="bestRating" content="5"/>
										<meta itemprop="ratingValue" content="<?php echo esc_attr($rating); ?>"/>
										<div class="static-star-rating" aria-label="Оценка: <?php echo $rating; ?> из 5">
											<?php for ($i = 1; $i <= 5; $i++): ?>
												<span class="star <?php echo ($i <= $rating) ? 'filled' : ''; ?>">★</span>
											<?php endfor; ?>
										</div>
									</div>
								<?php endif; ?>

								<p class="hp-book-comment__review" itemprop="reviewBody">
									<?php echo esc_html($comment->comment_content); ?>
								</p>

								<header class="hp-book-comment__header">
									<strong class="hp-book-comment__author" itemprop="author">
										<?php echo esc_html($comment->comment_author); ?>
									</strong>
									<time class="hp-book-comment__time hidden" datetime="<?php echo get_comment_time('c', true, $comment); ?>" itemprop="datePublished">
										<?php echo get_comment_date('', $comment); ?>
									</time>
								</header>
							</article>
						<?php endforeach; ?>
					</div>
				</section>
			<?php else: ?>
				<div class="hp-block hp-no-commnts">
					<?php get_template_part('template-parts/components/no-comments'); ?>
				</div>
			<?php endif; ?>
			<?php get_template_part('template-parts/components/comment-form', null, [
				'id' => get_the_ID(),
			]); ?>
		<?php endif; ?>

	<?php endwhile; endif; ?>

	<?php
	$current_post_id = get_the_ID();
	get_template_part('template-parts/page/page-books-block', null, [
		'title' => 'Читайте также',
		'link_text' => 'Каталог книг',
		'link' => '/knigi/',
		'show_link' => true,
		'order' => 'R',
		'limit' => 6,
		'color_schema' => 'gray',
		'exclude' => $current_post_id
	]);
	?>
</main>

<?php get_footer(); ?>