<?php

	final class DatabaseManager
	{
		private static $Instance = false;
	
		public static function getInstance()
		{
			if( self::$Instance == false )
			{
				self::$Instance = new DatabaseManager();
			}
			return self::$Instance;
		}
		
		private $mysqli;
		
		private function __construct() 
		{
			$this->mysqli = new mysqli(_HOST, _DB_USER, _DB_PASSWORD, _DATABASE);
			$this->mysqli->query("SET NAMES 'utf8'");
		}
		
		public function select($query)
		{
			$result = $this->mysqli->query($query);
			$values = $result->fetch_all(MYSQLI_NUM);
			
			return $values;
		}
		
		public function insert($query)
		{
			return $this->mysqli->query($query);
		}
		
		public function delete($query)
		{
			return $this->mysqli->query($query);
		}
		
		public function lock($tableName)
		{
			$this->mysqli->query("lock tables `$tableName` write");
		}
		
		public function unlock()
		{
			$this->mysqli->query("unlock tables");
		}
		
		public function maxId($tableName)
		{
			$result = $this->mysqli->query("select max(id) from `$tableName`");
			$values = $result->fetch_all(MYSQLI_NUM);
				
			return $values[0][0];
		}
	}
	
?>