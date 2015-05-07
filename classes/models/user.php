<?php

	require_once _PATH.'handlers/Logger.php';
	require_once _PATH.'handlers/DatabaseManager.php';
	require_once _PATH.'classes/Result.php';

	class User
	{
		public $id;
		public $register_date;
		public $login;
		public $password;
		
		public function __construct($id, $register_date, $login, $password)
		{
			$this->id = $id;
			$this->register_date = $register_date;
			$this->login = $login;
			$this->password = $password;
		}
		
		public function getColor()
		{
			return ( ord( $firstLetter ) + ($_SESSION['user'] * 15) ) % 360;
		}
		
		public function save()
		{
			DatabaseManager::getInstance()->lock("users");
			
			$query = "insert into `users`(`id`, `register_date`, `login`, `password`) values(DEFAULT, '$this->register_date', '$this->login', '$this->password')";
			$status = DatabaseManager::getInstance()->insert($query);
			
			$this->id = DatabaseManager::getInstance()->maxId('users');
			
			DatabaseManager::getInstance()->unlock();
			
			Logger::dbLog($status, null, $query);
			
			return new Result($status, null, $query); 
		}
		
		public function remove()
		{
			$query = "delete from `users` where id = $this->id";
			$status = DatabaseManager::getInstance()->delete($query);
			
			Logger::dbLog($status, null, $query);
				
			return new Result($status, null, $query);
		}
		
		public static function get($id, $register_date, $login, $password)
		{
			$where = "";
			
			if($id != null || $register_date != null || $login != null || $password != null)
			{
				$where = " where ";
				
				if($id != null)
				{
					$where .= "id = $id ";
				}
				
				if($register_date != null)
				{
					$where .= "and register_date = STR_TO_DATE('$register_date','%Y-%m-%d %h:%i:%s') ";
				}
				
				if($login != null)
				{
					$where .= "and login = '$login' ";
				}
				
				if($password != null)
				{
					$where .= "and password = '$password' ";
				}
				
				$where = str_replace("where and","where",$where);
			}
			
			$query = "select * from `users`".$where;
			
			$result = DatabaseManager::getInstance()->select($query);
			$arr = array();
				
			foreach($result as $r)
			{
				$arr[] = new User($r[0], $r[1], $r[2], $r[3]);
			}
			
			Logger::dbLog($status, $arr, $query);
				
			return new Result($status, $arr, $query);
		}
		
		public static function getAll()
		{
			return self::get(null, null, null, null);
		}
	}
	
?>