<style>
	.a-hp-hero {
		display: flex;
		flex-direction: column;
		gap: 12px;
		padding: 12px;
		border-radius: 8px;
		background: #FAFAFA;
	}

	.a-hp-hero__title {
		color: black;
		line-height: 150%;
		font-size: 20px;
		font-weight: bold;
	}

	.a-hp-hero__subtitle {
		background: #F0F0F0;
		padding: 4px 12px;
		border-radius: 4px;
		text-decoration: none;
		color: black;
		pointer-events: none;
	}
</style>

<?php
$title = isset($attributes['hp-hero-title']) ? sanitize_text_field($attributes['hp-hero-title']) : t('no-text');
$subtitle = isset($attributes['hp-hero-subtitle']) ? sanitize_text_field($attributes['hp-hero-subtitle']) : t('no-text');
?>

<div class="a-hp-hero">
	<div class="a-hp-hero__title"><?php echo esc_html($title); ?></div>
	<div class="a-hp-hero__subtitle"><?php echo esc_html($subtitle); ?></div>
</div>