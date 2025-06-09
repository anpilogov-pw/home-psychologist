<style>
	.a-hp-offer-block {
		display: flex;
		flex-direction: column;
		gap: 12px;
		padding: 12px;
		border-radius: 8px;
		background: #FAFAFA;
	}

	.a-hp-offer-block__text {
		color: black;
		line-height: 120%;
	}

	.a-hp-offer-block__link {
		background: #F0F0F0;
		padding: 4px 12px;
		border-radius: 4px;
		text-decoration: none;
		color: black;
		pointer-events: none;
	}
</style>

<?php
$text = isset($attributes['hp-offer-block-text']) ? sanitize_text_field($attributes['hp-offer-block-text']) : t('no-text');
$link = isset($attributes['hp-offer-block-link']) ? $attributes['hp-offer-block-link'] : 'https://';
$link_text = isset($attributes['hp-offer-block-link-title']) ? sanitize_text_field($attributes['hp-offer-block-link-title']) : t('no-text');
?>

<div class="a-hp-offer-block">
	<div class="a-hp-offer-block__text">
		<?php echo $text; ?>
	</div>
	<div class="a-hp-offer-block__link">
		<?php echo $link_text; ?> | url: <?php echo $link; ?>
	</div>
</div>