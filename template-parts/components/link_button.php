<?php
/**
 * Компонент кнопки с расширенной поддержкой атрибутов.
 *
 * Аргументы:
 * @param string $text         Текст кнопки (обязательный)
 * @param string $href         Ссылка (обязательный)
 * @param string $icon         SVG-код иконки (опционально)
 * @param string $id           ID кнопки (опционально)
 * @param string $class        Дополнительные CSS классы (опционально)
 */

$text = $args['text'] ?? t('ui.button.title');
$icon = $args['icon'] ?? '';
$id = $args['id'] ?? '';
$class = $args['class'] ?? '';
$href = $args['href'] ?? '';

$button_text = esc_html($text);
$id_attr = $id ? 'id="' . esc_attr($id) . '"' : '';
$href_attr = $href ? 'href="' . esc_attr($href) . '"' : '';
$class_attr = 'hp-button ' . esc_attr($class);
?>

<a <?= $id_attr ?> <?= $href_attr ?> class="<?= $class_attr ?>">
	<?php if ($icon): ?>
		<span class="hp-button__text">
			<?= $icon ?>
		</span>
	<?php endif; ?>
	<span class="hp-button__text">
		<?= $button_text ?>
	</span>
</a>