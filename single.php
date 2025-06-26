<?php get_header(); ?>

<main class="hp-main hp-main_single">
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php
			global $post;
			$content = apply_filters('the_content', $post->post_content);
			$toc = generate_toc_from_content($content, $modified_content);
			$content_with_ids = add_anchor_ids_to_headings($content);

			$post_subtitle = get_field('hp_post_subtitle');
			$post_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
			$post_img_full = get_the_post_thumbnail_url(get_the_ID(), 'full');
			$post_authors = get_field('hp-post-author');
			$categories = get_the_category();
		?>

		<section class="hp-block hp-single">
			<aside class="hp-article-aside">
				<?php if (!empty($toc)): ?>
					<section class="hp-article-toc">
						<h2 class="hp-article-toc__title">Содержание статьи</h2>
						<ul id="toc" class="hp-article-toc-list">
							<?php $i = 1; ?>
							<?php foreach ($toc as $item): ?>
								<li class="hp-article-toc-list__item">
									<a class="hp-article-toc__link" href="#<?= esc_attr($item['id']) ?>">
										<?= $i++ . '. ' . esc_html($item['text']) ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</section>
				<?php endif; ?>


				<?php foreach ($post_authors as $raw_post): ?>
					<?php 
						$author_post = get_post($raw_post->ID);

						// Получаем аватар
						$avatar_field = get_field('hp_expert_avatar', $author_post->ID);
						if (is_array($avatar_field)) {
							$avatar_url = $avatar_field['url'];
						} elseif (is_numeric($avatar_field)) {
							$avatar_url = wp_get_attachment_url($avatar_field);
						} else {
							$avatar_url = $avatar_field;
						}

						// Получаем профессию
						$career = get_field('hp_expert_prof', $author_post->ID);
					?>
					<section class="hp-author-toast">
						<?php if ($avatar_url) : ?>
							<picture class="hp-author-toast-picture">
								<img class="hp-author-toast-picture__image" src="<?= esc_url($avatar_url); ?>" width="54" height="54" alt="<?= esc_attr($author_post->post_title); ?>" loading="lazy">
							</picture>
						<?php else: ?>
							<picture class="hp-author-toast-picture">
								<img class="hp-author-toast-picture__image" src="<?= esc_url(get_template_directory_uri() . '/assets/img/placeholder.jpg'); ?>" width="54" height="54" alt="Изображение отсутствует" loading="lazy">
							</picture>
						<?php endif; ?>
						<div class="hp-author-toast__wrapper">
							<p class="hp-author-toast__name">
								<a href="<?= esc_url(get_permalink($author_post->ID)); ?>" title="<?= esc_attr($author_post->post_title); ?>">
									<?= esc_html($author_post->post_title); ?>
								</a>
							</p>

							<p class="hp-author-toast__prof"><?= esc_html($career); ?></p>
						</div>
					</section>
				<?php endforeach; ?>

			</aside>

			<article id="post-<?php the_ID(); ?>" class="hp-article">
				<header class="hp-article__header">
					<div class="hp-article-block">
						<span class="hp-article-block__title">Опубликовано:</span>
						<time datetime="<?php echo get_the_date('c'); ?>" class="hp-chips !flex !flex-row !flex-nowrap !gap-3">
							<?php echo get_the_date(); ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16">
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
						</time>
					</div>

					<?php if (!empty($categories) && !is_wp_error($categories)): ?>
						<div class="hp-article-block">
							<span class="hp-article-block__title">Рубрика:</span>
							<ul class="hp-article-block-list">
								<?php foreach ($categories as $category): ?>
									<li class="hp-article-block-list__item">
										<a class="hp-chips hp-chips_link" href="<?php echo esc_url(get_category_link($category->term_id)); ?>" title="<?php echo esc_attr($category->name); ?>">
											<?php echo esc_html($category->name); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</header>

				<hgroup class="hp-article__hgroup">
					<h1 class="hp-article__title"><?php the_title(); ?></h1>

					<?php if ($post_subtitle) : ?>
						<p class="hp-article__subtitle"><?php echo esc_html($post_subtitle); ?></p>
					<?php endif; ?>

					<?php if ($post_img) : ?>
						<picture class="hp-article-picture" data-fancybox data-src="<?php echo esc_url($post_img_full); ?>" data-caption="<?php the_title(); ?>">
							<img class="hp-article-picture__image" src="<?php echo esc_url($post_img); ?>" width="296" height="167" alt="<?php the_title(); ?>" loading="lazy">
						</picture>
					<?php else: ?>
						<picture class="hp-article-picture">
							<img class="hp-article-picture__image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.jpg'); ?>" width="296" height="167" alt="Изображение отсутствует" loading="lazy"/>
						</picture>
					<?php endif; ?>
				</hgroup>

				<div id="post-content" class="hp-article__body">
					<?php echo $content_with_ids; ?>
				</div>

				<footer class="hp-article__footer">
					<div class="hp-article-block">
						<span class="hp-article-block__title">Опубликовано:</span>
						<time datetime="<?php echo get_the_date('c'); ?>" class="hp-chips !flex !flex-row !flex-nowrap !gap-3">
							<?php echo get_the_date(); ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 16 16">
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
						</time>
					</div>
					<?php get_template_part('template-parts/components/button', null, [
						'id'          => 'hp-share',
						'text'        => 'Поделиться статьёй',
						'aria_label'  => 'Поделиться статьёй',
						'icon'        => file_get_contents(get_template_directory() . '/assets/icons/reply-fill.svg'),
						'class' => 'hp-button_outline'
					]); ?>
				</footer>
			</article>
		</section>
	<?php endwhile; endif; ?>

	<?php get_template_part('template-parts/page/page-articles-block', null, [
		'title' => t('page.articles.block.title.populars'),
		'link_text' => t('page.articles.block.link.title'),
		'link' => '/blog/'
	]); ?>

	<?php get_template_part('template-parts/page/page-taxonomies', null, []); ?>
</main>

<?php get_footer(); ?>