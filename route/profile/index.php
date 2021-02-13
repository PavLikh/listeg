<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/header.php'; ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td class="left-collum-index">
				<p>Практика работы с БД</p>
				<h1><?=head($menu) ?></h1>
				<?php	

					$login = $_COOKIE['login'];
					$result = mysqli_query(
	                $connect,
	                "SELECT u.* FROM groups AS g
					LEFT JOIN group_user AS gu ON gu.group_id = g.id
					LEFT JOIN users AS u ON gu.user_id = u.id
					WHERE u.name = '$login'");?>

	                <ul>
	                <?php foreach (mysqli_fetch_assoc($result) as $value) { ?>
	              		<li>
				    		<?=$value?>
						</li>
	                <?php } ?>
	      			</ul>
			</td>

			<td class="left-collum-index">
				<h3>Группы пользователя</h3>

				<?php

				   	$result = mysqli_query(
	                $connect,
	                "SELECT g.name AS Group_name FROM groups AS g
					LEFT JOIN group_user AS gu ON gu.group_id = g.id
					LEFT JOIN users AS u ON gu.user_id = u.id
					WHERE u.name = '$login'"); ?>
	                <ul>
	                <?php while ($row=mysqli_fetch_assoc($result)) {?>
	              		<li>
				    		<?= $row['Group_name'] ?>
						</li>
	                <?php } ?>
	      			</ul>

				</ul>

			</td>
		</tr>
	</table>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>