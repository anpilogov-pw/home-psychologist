<?php
$email = get_field('hp-org-email', 'option');
$title = isset($attributes['hp-contacts-title']) ? sanitize_text_field($attributes['hp-contacts-title']) : t('no-text');
?>

<section class="hp-org-contacts">
	<h2 class="hp-org-contacts__title">
		<?php echo $title ?>
	</h2>
	<address class="hp-org-contacts__address not-italic">
		e-mail:
		<a href="mailto:<?php echo esc_attr($email); ?>">
			<?php echo esc_html($email); ?>
		</a>
	</address>
</section>