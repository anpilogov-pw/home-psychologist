<?php $post_id = $args['id'] ?? '' ?>

<div class="hp-review-form__wrapper" data-show="false">
	<form action="/submit-review" method="post" class="hp-review-form">
		<div class="hp-form-group">
			<label for="fullname">ФИО <span class="required">*</span></label>
			<input type="text" id="fullname" name="fullname" required>
		</div>

		<div class="hp-form-group">
			<label for="fullname">E-mail <span class="required">*</span></label>
			<input type="email" id="email" name="email" required>
		</div>

		<div class="hp-form-group">
			<label for="review">Ваш отзыв <span class="required">*</span></label>
			<textarea id="review" name="review" rows="5" required></textarea>
		</div>

		<fieldset class="hp-form-group">
			<legend>Оценка <span class="required">*</span></legend>
			<div class="rating-options" role="radiogroup" aria-label="Оценка">
				<input type="radio" id="star5" name="rating" value="5" required>
				<label for="star5" title="Отлично">★</label>

				<input type="radio" id="star4" name="rating" value="4">
				<label for="star4" title="Хорошо">★</label>

				<input type="radio" id="star3" name="rating" value="3">
				<label for="star3" title="Нормально">★</label>

				<input type="radio" id="star2" name="rating" value="2">
				<label for="star2" title="Плохо">★</label>

				<input type="radio" id="star1" name="rating" value="1">
				<label for="star1" title="Ужасно">★</label>
			</div>
		</fieldset>

		<div class="hp-honeypot">
			<label for="website">Ваш сайт (оставьте это поле пустым)</label>
			<input type="text" id="website" name="website" autocomplete="off">
		</div>

		<input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id ?>" required>

		<div class="hp-form-buttons">
			<button class="hp-form-button" type="submit">Отправить отзыв</button>
			<button class="hp-form-button" type="reset">Закрыть</button>
		</div>
	</form>
</div>
