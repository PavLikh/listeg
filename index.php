<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/header.php'; ?>
<?php
$login = null;
$password = null;
$success = false;
$error = false;

function logIn($login, $password, $connect)
{

  $result = mysqli_query(
  $connect,"select password from users where name = '".mysqli_escape_string($connect, $login)."'");
  $data = mysqli_fetch_assoc($result);
  if ($password == $data['password']) {
      return true;
  }

}
if(empty($_SESSION['join'])){

  if (! empty($_POST)) {
  	if (empty($_POST['login']) || empty($_POST['password'])) {
          $error = true;
    } else {
          $login = trim($_POST['login']);
          $password = md5(trim($_POST['password']));
          $success = logIn($login, $password, $connect);
          if ($success) {
          		$_SESSION['join'] = true;
            	setcookie('login', $login, time() + 60 *60 * 24 * 30, '/');
            	Header("Location: /");
          } else {
          		$error = true; 
          }
              
    }
  }
}

?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td class="left-collum-index">
				<h1><?=head($menu) ?></h1>
				<h4>Этот сайт использует cookie.</h4>
				<p>Добрый день. Это учебный проект, он находится в процессе разработки и наполнения. </p>
				<p>Пока не активна регистрация, временные ники и пароли для авторизации:</p>
				<p>name1 pass: a1</p>
				<p>name2 pass: a2</p>
				<p>name3 pass: a3</p>

			</td>
			<td class="right-collum-index"  <?=! empty($_SESSION['join']) ? 'hidden' : '' ?>>
				
				<div class="project-folders-menu">
					<ul class="project-folders-v">
    					<li class="project-folders-v-active"><a href="/?login=yes">Авторизация</a></li>
    					<li><a href="#">Регистрация</a></li>
    					<li><a href="#">Забыли пароль?</a></li>
					</ul>
				    <div class="clearfix"></div>
				</div>
                
				<div class="index-auth">
                    <?php if ($success) {?> 
                            <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php' ?>
                    <?php } else { ?>
                        <?php if ($error) {?>
                                <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/error.php' ?> 
                        <?php } ?>
                        <?php if (isset($_GET['login']) && $_GET['login'] == 'yes') { ?>
                            <form action="" method="post">
        						<table width="100%" border="0" cellspacing="0" cellpadding="0">
        							<tr>
        								<td class="iat" <?= !empty($_COOKIE['login']) ? 'hidden' : '' ?>>
                                            <label for="login_id">Ваш e-mail:</label>
                                            <input id="login_id" size="30" name="login" value="<?= htmlspecialchars($_POST['login'] ?? ($_COOKIE['login'] ?? ''));  ?>">
                                        </td>
        							</tr>
        							<tr>
        								<td class="iat">
                                            <label for="password_id">Ваш пароль:</label>
                                            <input id="password_id" size="30" name="password" type="password" value="<?= htmlspecialchars($_POST['password'] ?? '');  ?>">
                                        </td>
        							</tr>
        							        							<tr>
        								<td class="iat" <?= !empty($_COOKIE['login']) ? '' : 'hidden' ?>>
                                            <a href="/?cookie=del">Сменить пользователя</a>
                                        </td>
        							</tr>
        							<tr>
        								<td><input type="submit" value="Войти"></td>
        							</tr>
        						</table>
                            </form>
                        <?php } ?>
                    <?php } ?>
				</div>
			
			</td>
        </tr>

    </table>
    
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>
