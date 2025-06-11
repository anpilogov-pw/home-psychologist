<style>
	.a-hp-org-contacts {
		display: flex;
		flex-direction: column;
		gap: 12px;
		padding: 12px;
		border-radius: 8px;
		background: #FAFAFA;
	}

	.a-hp-org-contacts__title {
		color: black;
		line-height: 150%;
		font-size: 20px;
	}

	.a-hp-org-contacts__address {
		background: #F0F0F0;
		padding: 4px 12px;
		border-radius: 4px;
		text-decoration: none;
		color: black;
		pointer-events: none;
	}
</style>

<?php
$email = get_field('hp-org-email', 'option');
$title = isset($attributes['hp-contacts-title']) ? sanitize_text_field($attributes['hp-contacts-title']) : t('no-text');
?>

<div class="a-hp-org-contacts">
	<div class="a-hp-org-contacts__title">
		<?php echo $title ?>
	</div>
	<div class="a-hp-org-contacts__address">
		e-mail: <?php echo esc_html($email); ?>
	</div>
</div>