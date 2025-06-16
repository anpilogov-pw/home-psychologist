<?php
/**
 * @var WP_Post $post
 */

if (!isset($post) || !$post instanceof WP_Post) {
	return;
}

setup_postdata($post);

$avatar = get_field('hp_expert_avatar');
$career = get_field('hp_expert_prof');
?>

<article id="person-<?php the_ID(); ?>" class="hp-person-card">
	<div class="hp-person-avatar">
		<a href="<?php the_permalink(); ?>">
			<?php if ($avatar) : ?>
				<img class="hp-person-avatar__img" src="<?php echo esc_url($avatar); ?>" width="172" height="172" alt="<?php the_title(); ?>">
			<?php else: ?>
				<img class="hp-person-avatar__img" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/placeholder.jpg'); ?>" width="172" height="172" alt="Изображение отсутствует" />
			<?php endif; ?>
		</a>
	</div>

	<header class="hp-person-card-header">
		<hgroup class="hp-person-card-title">
			<h3 class="hp-person-card-name">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
			</h3>
			<?php if ($career) : ?>
				<p class="hp-person-card-career">
					<?php echo esc_html($career); ?>
				</p>
			<?php endif; ?>
		</hgroup>
	</header>

	<div class="hp-person-card-excerpt">
		<?php if (has_excerpt()) : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
	</div>

	<footer class="hp-person-card-meta">
		<?php
		get_template_part('template-parts/components/link_button', null, [
			'text' => t('more'),
			'href' => get_permalink(),
			'class' => 'hp-button_hard-outline',
		]);
		?>
		<time datetime="<?php echo get_the_date('c'); ?>" class="hidden">
			<?php echo get_the_date(); ?>
		</time>
	</footer>
</article>

<?php wp_reset_postdata(); ?>