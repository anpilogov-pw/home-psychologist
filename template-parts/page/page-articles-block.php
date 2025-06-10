<?php
/**
 * Компонент блок со статьями.
 *
 * Аргументы:
 * @param string $title         Заголовок блока (обязательный)
 * @param string $link_text   Текст ссылки (опционально)
 * @param string $link         Ссылка (опционально)
 * @param string $show_link         Тип отображения (по умолчанию: true)
 * @param string $order           Тип сортировки: ASC | DEC | R (опционально) (по умолчанию: R)
 * @param string $limit         Кол-во записей (опционально) (по умолчанию: 6)
 */

$title = $args['title'] ?? t('ui.button.title');
$link_text = $args['link_text'] ?? t('ui.button.title');
$link = $args['link'] ?? home_url();
$show_link = $args['show_link'] ?? true;
$order = $args['order'] ?? 'R';
$limit = $args['limit'] ?? 6;
?>

<section class="hp-articles-block">
	<div class="hp-block hp-articles-block__wrapper">
		<hgroup class="hp-articles-block__hgroup">
			<h2 class="hp-articles-block__title">
				<?php echo esc_html($title); ?>
			</h2>
			<div class="hp-articles-block__actions">
				<?php if ($show_link): ?>
					<?php
					get_template_part('template-parts/components/link_button', null, [
						'text' => $link_text,
						'href' => $link,
						'class' => 'hp-button_outline',
						'icon' => file_get_contents(get_template_directory() . '/assets/icons/arrow-right.svg'),
					]);
					?>
				<?php endif; ?>
			</div>
		</hgroup>
		<?php echo render_articles_component(['order' => $order, 'limit' => $limit]); ?>
	</div>
</section>