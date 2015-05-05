<?php

	require_once _PATH.'handlers/DatabaseManager.php';
	require_once _PATH.'handlers/Logger.php';
	require_once _PATH.'classes/Result.php';

	class Font
	{
		public $id;
		public $usr_id;
		public $name;
		public $path;
		
		public function __construct($id, $usr_id, $name, $path)
		{
			$this->id = $id;
			$this->usr_id = $usr_id;
			$this->name = $name;
			$this->path = $path;
		}
		
		public function save()
		{
			DatabaseManager::getInstance()->lock("font");
			
			$query = "insert into `font`(`id`, `usr_id`, `name`, `path`) values(DEFAULT, '$this->usr_id', '$this->name', '$this->path')";
			$status = DatabaseManager::getInstance()->insert($query);
			
			$this->id = DatabaseManager::getInstance()->maxId('font');
				
			DatabaseManager::getInstance()->unlock();
				
			Logger::dbLog($status, null, $query);
				
			return new Result($status, null, $query);
		}
		
		public function remove()
		{
			$query = "delete from `font` where id = $this->id";
			$status = DatabaseManager::getInstance()->delete($query);
		
			Logger::dbLog($status, null, $query);
		
			return new Result($status, null, $query);
		}
		
		public static function get($id, $usr_id, $name, $path)
		{
			$where = "";
			
			if($id != null || $usr_id != null || $name != null || $path != null)
			{
				$where = " where ";
				
				if($id != null)
				{
					$where .= "id = $id ";
				}
				
				if($usr_id != null)
				{
					$where .= "and usr_id = $usr_id ";
				}
				
				if($name != null)
				{
					$where .= "and name = '$name' ";
				}
				
				if($path != null)
				{
					$where .= "and path = '$path' ";
				}
				
				$where = str_replace("where and","where",$where);
			}
			
			$query = "select * from `font`".$where;
			
			$result = DatabaseManager::getInstance()->select($query);
			$arr = array();
				
			foreach($result as $r)
			{
				$arr[] = new Font($r[0], $r[1], $r[2], $r[3]);
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