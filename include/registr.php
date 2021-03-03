<?php

//$host = 'localhost';
//$dbname = 'ct96865_listeg';

class QueryBuilder
{
	public $pdo;

	function __construct($user, $pass)
	{
		// 1. Connect
		$this->pdo = new PDO("mysql:host=localhost; dbname=ct96865_listeg", "$user", "$pass");
	}

	// List for everything
	function all($table)
	{
		
		// 2. Prepare the statement
		$statement = $this->pdo->prepare("SELECT * FROM $table"); //подготовить (двойные ковычки позволяют использовать переменные(парсинг))
		$statement->execute(); //выполнить
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);//die; // получаем массив fetchAll() ["id"]=>"16", [0]=> "16" .../ fetchAll(2) ["id"]=>"16" .../  то же что константа PDO::FETCH_ASSOC = 2

		return $results;
	}

	//Add new one item in database
	function store($table, $data)
	{	
		//для корректной работы нужны создать динамическую строку корректного sql запроса
		// 1. get keys // 
		$keys = array_keys($data);
		// 2. create string  title, content // 
		$stringOfKeys = implode(',', $keys);
		// 3. сформировать метки :*...
		$placeholders = ":".implode(', :', $keys);

		$sql = "INSERT INTO $table ($stringOfKeys) VALUES($placeholders)"; //передали метки :title...
		$statement = $this->pdo->prepare($sql);
		$statement->execute($data); //чтобы не использовать bindParam для каждой метки
		$count = $statement->rowCount();
		return $count;
	}

	//Get one task for show on display
	function getOne($table, $id)
	{
		$statement = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
		$statement->bindParam(":id", $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		return $result;
	}


	function getLast($table)
	{
		
		// 2. Prepare the statement
		$statement = $this->pdo->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT 1"); //подготовить (двойные ковычки позволяют использовать переменные(парсинг))
		$statement->execute(); //выполнить
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);//die; // получаем массив fetchAll() ["id"]=>"16", [0]=> "16" .../ fetchAll(2) ["id"]=>"16" .../  то же что константа PDO::FETCH_ASSOC = 2

		return $results;
	}

	//Get one task for show on display
	function checkLogin($table, $login)
	{
		$statement = $this->pdo->prepare("SELECT * FROM $table WHERE name=:login");
		$statement->bindParam(":login", $login);
		$statement->execute();
		$result = $statement->fetch();

		return $result['name'];
	}


}

$db = new QueryBuilder($user, $pass);
//$userById = $db->getOne("users", '5');

$data = [
	//'active'=> ($_POST['active'] ? $_POST['active'] : '7'),
	'name' => $_POST['login'],
	'mail' => ($_POST['mail'] ? $_POST['mail'] : null),
	'phone' => ($_POST['phone'] ? $_POST['phone'] : null),
	'password' => ($_POST['password'] != '' && $_POST['password'] == $_POST['password_repeat'] ? md5(trim($_POST['password'])) : null),
	//'recieve_notice' => ($_POST['recieve_notice'] ? $_POST['recieve_notice'] : ''),
];// $data это просто $_POST записано по ключам массива для понимания

$checkLogin = $db->checkLogin("users", $data['name']);
$log = $db->store("users", $data);

?>