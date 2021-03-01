
<?php //echo '------ERROR------' . '<br>'; ?>
<?php if ($_POST['auth']) { ?>
	<span style="color: red">Неверный логин или пароль</span>
<?php } ?>

<?php if ($_POST['reg']) { ?> 
	<?php if (!$_POST['login']) { ?>
 		<span style="color: red">Введите имя</span>
	<?php } else {?>
		<?php if ($checkLogin) { ?>
			<span style="color: red">Пользователь с таким именем уже существует</span>
		<?php } else { ?>
			<?php if ($_POST['password']) {?>
				<?php if ($_POST['password'] != $_POST['password_repeat']) { ?>
 					<span style="color: red">Пароли не совпадают</span>
				<?php } else {?>
					<?php if (!$log) {?>
						<span style="color: red">Не удалось зарегистрировать пользователя.</span>
						<span style="color: red">Повторите попытку позже.</span>
					<?php } ?>
				<?php } ?>
			<?php } else {?>
				<span style="color: red">Введите пароль</span>
			<?php } ?>
		<?php } ?>
	<?php } ?>
<?php } ?>

<?php //echo '-----------------------' . '<br>'; ?>
