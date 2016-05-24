<?php
class Database{

	private static $db = null;
	private $serverName = 'localhost';
	private $userName = 'omar';
	private $password = '123';

	public static function getInstance($dbname){
		
		if (!Database::$db) {
			new Database($dbname);
		} 
		return Database::$db;
	}

	private function __construct($dbname){
		Database::$db = @mysqli_connect($this->serverName,$this->userName, $this->password, $dbname);
		if(!Database::$db){
			die("Error in DB connection");
		}
	}

}

?>
