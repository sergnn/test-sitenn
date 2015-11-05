<div class="regform">
	<form role="form" id="regf" method="post" action="reg.php">
		<div class="form-group">
			<label for="name">Ф. И. О. </label>
			<input class="form-control" id="name" name="name" type="text" required>
		</div>
		<div class="form-group">
			<label for="status">Статус:</label>
			<select class="form-control" name="status" id="status">
				<option value="0">юридическое лицо</option>
				<option value="1">частное лицо</option>
			</select>
		</div>
		<div class="form-group">
			<label for="email">E-mail:</label>
			<input class="form-control" name="email" id="email" name="email" type="email" required>
		</div>
		<div class="form-group">
			<label for="phone">Телефон:</label>
			<input class="form-control" name="phone" id="phone" type="number" required>
		</div>
		<div class="form-group">
			<label for="city">Город:</label>
			<input class="form-control" name="city" id="city" name="city" type="text" required>
		</div>
		<div class="form-group">
			<label for="street">Улица:</label>
			<input class="form-control" name="street" id="street" name="street" type="text" required>
		</div>
		<div class="form-group">
			<label for="building">Дом:</label>
			<input class="form-control" name="building" id="building" name="building" type="text" required>
		</div>
		<div class="form-group">
			<label for="flat">Квартира:</label>
			<input class="form-control" name="flat" id="flat" name="flat" type="text" required>
		</div>
		<div class="form-group">
			<label for="login">Логин:</label>
			<input class="form-control" name="login" id="login" type="text" required>
		</div>
		<div class="form-group">
			<label for="pass">Пароль:</label>
			<input class="form-control" name="pass" id="pass" type="password" required>
		</div>
		<input class="btn btn-success" type="submit" value="Зарегистрироваться">

	</form>
</div>