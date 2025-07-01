<?php
$title = isset($attributes['hp-hero-title']) ? sanitize_text_field($attributes['hp-hero-title']) : t('no-text');
$subtitle = isset($attributes['hp-hero-subtitle']) ? sanitize_text_field($attributes['hp-hero-subtitle']) : t('no-text');
$image_url = get_template_directory_uri() . '/assets/img/hero-background.webp';

$args = [
    'post_type'      => 'hp_books',
    'posts_per_page' => 4,
    'orderby'        => 'modified',
    'order'          => 'DESC',
    'meta_query'     => [
        [
            'key'     => 'hp-on-main',
            'value'   => '1',
            'compare' => '='
        ]
    ]
];

$query = new WP_Query($args);
?>

<section class="hp-hero" style="background: radial-gradient(97.19% 96.17% at 50% 100%, #FFF 50%, rgba(255, 255, 255, 0.00) 100%), url(<?php echo esc_url($image_url); ?>), #FFF;">
	<div class="hp-block">
		<hgroup class="hp-hero__hgroup">
			<h1 class="hp-hero__title"><?php echo esc_html($title); ?></h1>
			<p class="hp-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
		</hgroup>
		<?php if ($query->have_posts()): ?>
			<div class="hp-hero__list">
				<?php while ($query->have_posts()): $query->the_post(); ?>
            <?php get_template_part('template-parts/components/book-mini-card', null, ['post' => get_post()]); ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
    <?php wp_reset_postdata(); ?>
	</div>
</section>