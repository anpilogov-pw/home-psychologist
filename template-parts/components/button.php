<?php
/**
 * Компонент кнопки с расширенной поддержкой атрибутов.
 *
 * Аргументы:
 * @param string $text         Текст кнопки (обязательный)
 * @param string $aria_label   Атрибут aria-label (опционально)
 * @param string $icon         SVG-код иконки (опционально)
 * @param string $type         Тип кнопки: button | submit | reset (по умолчанию: button)
 * @param string $id           ID кнопки (опционально)
 * @param string $name         Name кнопки (опционально)
 * @param string $class        Дополнительные CSS классы (опционально)
 * @param bool   $disabled     Отключено ли (опционально)
 * @param array  $data         Ассоциативный массив data-атрибутов (опционально)
 */

$text = $args['text'] ?? t('ui.button.title');
$aria_label = $args['aria_label'] ?? t('ui.button.aria-label');
$icon = $args['icon'] ?? '';
$type = $args['type'] ?? 'button';
$id = $args['id'] ?? '';
$name = $args['name'] ?? '';
$class = $args['class'] ?? '';
$disabled = !empty($args['disabled']) ? 'disabled' : '';
$data_attrs = '';

if (!empty($args['data']) && is_array($args['data'])) {
	foreach ($args['data'] as $key => $value) {
		$data_key = esc_attr($key);
		$data_val = esc_attr($value);
		$data_attrs .= " data-{$data_key}=\"{$data_val}\"";
	}
}

$button_text = esc_html($text);
$button_type = esc_attr($type);
$aria_attr = $aria_label ? 'aria-label="' . esc_attr($aria_label) . '"' : '';
$id_attr = $id ? 'id="' . esc_attr($id) . '"' : '';
$name_attr = $name ? 'name="' . esc_attr($name) . '"' : '';
$class_attr = 'hp-button ' . esc_attr($class);
?>

<button 
	type="<?= $button_type ?>" 
	<?= $id_attr ?> 
	<?= $name_attr ?> 
	class="<?= $class_attr ?>" 
	<?= $aria_attr ?>
	<?= $disabled ?> 
	<?= $data_attrs ?>
>
	<span class="hp-button__text">
		<?= $button_text ?>
	</span>
	<?php if ($icon): ?>
		<span class="hp-button__icon">
			<?= $icon ?>
		</span>
	<?php endif; ?>
</button>