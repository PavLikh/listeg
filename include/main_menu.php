<?php

$menu = [
	['title' => 'Главные новости', 'sort' => 4, 'path' => '/route/news/'],
	['title' => 'Главная', 'sort' => 1, 'path' => '/'],
	['title' => 'Каталог', 'sort' => 5, 'path' => '/route/catalog/'],
	['title' => 'О нас', 'sort' => 2, 'path' => '/route/about/'],
	['title' => 'Контакты', 'sort' => 3, 'path' => '/route/contacts/'],
	['title' => 'Профиль', 'sort' => 6, 'path' => '/route/profile/'],
];

// function arraySort ($key = 'sort', $sort = SORT_ASC)
// {
// 	return function($a, $b) use ($key, $sort) {
// 			if ($sort == SORT_ASC) {
// 				return $a[$key] <=> $b[$key];
// 			}	else {
// 				return $b[$key] <=> $a[$key];
// 			};
// 		};
// }

//usort($menu, arraySort();

function arraySort($array, $key = 'sort', $sort = SORT_ASC)
{
	usort($array, function($a, $b) use ($key, $sort) {
				return $sort == SORT_DESC ? $b[$key] <=> $a[$key] : $a[$key] <=> $b[$key];


			});
	return $array;
};


function showMenu($menu, $class='', $sort = SORT_ASC) {
	$menu = arraySort($menu, 'sort', $sort);
	include $_SERVER['DOCUMENT_ROOT'] . '/template/menu.php';
}

function head($menu) {
    foreach ($menu as $value) {
    	if ($value['path'] == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
    		return $value['title'];
    	}
    }
}

function isCurrentUrl($url)
{
   return $url == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}

function trimLine($line, $lineLength = 14)
{
	if (strlen($line) > $lineLength) {
		$line = substr($line, 0, $lineLength) . '...';
	}
	return $line;
}