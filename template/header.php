<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php'; 

if ($_GET['cookie']) {
    setcookie('login', $_COOKIE['login'], time() - 60 * 60 * 24 * 30, '/');
}

if (empty($_SESSION['join'])){
    if (! isset($_GET['login']) && $_GET['login'] != 'yes'){
        Header("Location: /?login=yes");
    }
} else {
    if ($_SESSION['join'] === true && isset($_COOKIE['login'])) {
        setcookie('login', $_COOKIE['login'], time() + 60 * 60 * 24 * 30, '/');
    }
}

$host = 'localhost';
$user = 'ct96865_listeg';
$pass = 'qwe1as';
$dbname = 'ct96865_listeg';


$connect = mysqli_connect($host, $user, $pass, $dbname);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
 } // else {
// //    echo mysqli_get_host_info($connect);
// }

// if (!empty($_SESSION['join'])){
//     $login = $_SESSION['join'];
//     setcookie('login', $login, time() + 60 *60 * 24 * 30, '/');
// }
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/styles.css" rel="stylesheet">
    <title>Listeg</title>
</head>

<body>

    <div class="header">
    	<div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix">
        <?php showMenu ($menu, $class='main-menu') ?>
        <a href="<?=!empty($_SESSION['join']) ? '/route/exit/' : '/?login=yes' ?> "><?=!empty($_SESSION['join']) ? 'Выход' : 'Авторизация' ?></a>
    </div>
