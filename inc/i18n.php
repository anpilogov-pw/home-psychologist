<?php
if (!defined('ABSPATH')) {
	exit;
}

// Кеш для переводов (чтобы не читать файл на каждый вызов)
$translations_cache = [];

/**
 * Получить текущий язык (можно адаптировать под WP локаль)
 * По умолчанию 'ru'
 */
function get_current_locale()
{
	// Например, можно использовать get_locale() и преобразовать к формату файла:
	$locale = get_locale(); // 'ru_RU', 'en_US' и т.п.
	return strtolower(substr($locale, 0, 2)); // 'ru', 'en'
}

/**
 * Функция загрузки переводов для текущего языка
 */
function load_translations()
{
	global $translations_cache;

	$locale = get_current_locale();
	$path = get_template_directory() . "/lang/{$locale}.json";

	if (isset($translations_cache[$locale])) {
		return $translations_cache[$locale];
	}

	if (file_exists($path)) {
		$content = file_get_contents($path);
		$translations = json_decode($content, true);
		if (json_last_error() === JSON_ERROR_NONE && is_array($translations)) {
			$translations_cache[$locale] = $translations;
			return $translations;
		}
	}

	// Если файл отсутствует или ошибка — вернуть пустой массив
	$translations_cache[$locale] = [];
	return [];
}

/**
 * Основная функция перевода
 */
function t($key)
{
	$translations = load_translations();

	if (isset($translations[$key]) && $translations[$key] !== '') {
		return $translations[$key];
	}

	// Возвращаем ключ, если перевода нет
	return $key;
}
