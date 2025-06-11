<style>
	.a-hp-articles-block {
		display: flex;
		flex-direction: column;
		gap: 12px;
		padding: 12px;
		border-radius: 8px;
		background: #FAFAFA;
	}

	.a-hp-articles-block__title {
		color: black;
		line-height: 150%;
		font-size: 20px;
		font-weight: bold;
	}

	.a-hp-articles-block__info {
		display: flex;
		flex-direction: row;
		gap: 12px;
	}

	.a-hp-articles-block__item {
		background: #F0F0F0;
		padding: 4px 12px;
		border-radius: 4px;
		text-decoration: none;
		color: black;
		pointer-events: none;
	}
</style>

<?php
$title = $attributes['hp-articles-block-title'] ?? t('ui.button.title');
$link_text = $attributes['hp-articles-block-link-text'] ?? t('ui.button.title');
$link = $attributes['hp-articles-block-link'] ?? home_url();
$show_link = $attributes['hp-articles-block-show-link'] ?? true;
$order = $attributes['hp-articles-block-order'] ?? 'R';
$limit = $attributes['hp-articles-block-limit'] ?? 6;
?>

<div class="a-hp-articles-block">
	<div class="a-hp-articles-block__title">
		<?php echo $title ?>
	</div>
	<div class="a-hp-articles-block__info">
		<div class="a-hp-articles-block__item">
			Тип сортировки: <?php echo esc_html($order); ?>
		</div>
		<div class="a-hp-articles-block__item">
			Кол-во: <?php echo esc_html($limit); ?>
		</div>
		<div class="a-hp-articles-block__item">
			Ссылка показывается? (<?php echo esc_html($show_link); ?>)
		</div>
	</div>
</div>