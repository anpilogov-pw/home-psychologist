<?php 
get_header(); 

$email = get_field('hp-org-email', 'option');

?>

<main class="hp-main hp-main_404">
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
	<div class="hp-block">
		<div class="hp-error">
			<h1 class="hp-error__title">404</h1>
			<p class="hp-error__description">К сожалению, запрашиваемая страница не существует или была перемещена.</p>
			<h2 class="hp-error__subtitle">Что можно сделать:</h2>
			<ul class="hp-error__list">
				<li>Вернуться на <a href="<?php echo esc_url(home_url('/')); ?>">главную страницу</a></li>
				<li>Проверить правильность введённого адреса</li>
				<li>Воспользоваться поиском по одному из разделов</li>
			</ul>
			<p class="hp-error__note">Если вы уверены, что страница должна быть доступна, пожалуйста, <a href="mailto:<?php echo esc_attr($email); ?>">свяжитесь с нами</a>.</p>
		</div>
	</div>
</main>

<?php get_footer(); ?>