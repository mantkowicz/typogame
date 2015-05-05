<?php

	require_once _PATH.'handlers/DatabaseManager.php';
	require_once _PATH.'classes/Result.php';

	class Job
	{
		public $id;
		public $usr_id;
		public $fnt_id;
		public $points;
		public $date_start;
		public $date_end;
		public $properties;
		
		public function __construct($id, $usr_id, $fnt_id, $points, $date_start, $date_end, $properties)
		{
			$this->id = $id;
			$this->usr_id = $usr_id;
			$this->fnt_id = $fnt_id;
			$this->points = $points;
			$this->date_start = $date_start;
			$this->date_end = $date_end;
			$this->properties = $properties;
		}
		
		public function save()
		{
			DatabaseManager::getInstance()->lock("job");
			
			$query = "insert into `job`(`id`, `usr_id`, `fnt_id`, `points`, `date_start`, `date_end`, `properties`) values(DEFAULT, $this->usr_id, $this->fnt_id, $this->points, '$this->date_start', '$this->date_end', '$this->properties')";
			$status = DatabaseManager::getInstance()->insert($query);
				
			$this->id = DatabaseManager::getInstance()->maxId('job');
				
			DatabaseManager::getInstance()->unlock();
			
			Logger::dbLog($status, null, $query);
				
			return new Result($status, null, $query);
		}
		
		public function remove()
		{
			$query = "delete from `job` where id = $this->id";
			$status = DatabaseManager::getInstance()->delete($query);
		
			Logger::dbLog($status, null, $query);
		
			return new Result($status, null, $query);
		}
		
		public static function get($id, $usr_id, $fnt_id, $points, $date_start, $date_end, $properties)
		{
			$where = "";
			
			if($id != null || $usr_id != null || $fnt_id != null || $points != null || $date_start != null || $date_end != null || $properties != null)
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
				
				if($fnt_id != null)
				{
					$where .= "and fnt_id = $fnt_id ";
				}
				
				if($points != null)
				{
					$where .= "and points = $points ";
				}
				
				if($date_start != null)
				{
					$where .= "and date_start = STR_TO_DATE('$date_start','%Y-%m-%d %h:%i:%s') ";
				}
				
				if($date_end != null)
				{
					$where .= "and date_end = STR_TO_DATE('$date_end','%Y-%m-%d %h:%i:%s') ";
				}
				
				if($properties != null)
				{
					$where .= "and properties = '$properties' ";
				}
				
				$where = str_replace("where and","where",$where);
			}
			
			$query = "select * from `job`".$where;
			
			$result = DatabaseManager::getInstance()->select($query);
			$arr = array();
				
			foreach($result as $r)
			{
				$arr[] = new Job($r[0], $r[1], $r[2], $r[3], $r[4], $r[5], $r[6]);
			}
			
			Logger::dbLog($status, $arr, $query);
				
			return new Result($status, $arr, $query);
		}
		
		public static function getAll()
		{
			return self::get(null, null, null, null, null, null, null);
		}
	}
	
?>