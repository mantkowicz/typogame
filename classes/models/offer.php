<?php

	require_once _PATH.'handlers/DatabaseManager.php';
	require_once _PATH.'classes/Result.php';

	class Offer
	{
		public $id;
		public $job_id;
		public $usr_id;
		public $date;
		public $html;
		public $score;
		public $win;
		
		public function __construct($id, $job_id, $usr_id, $date, $html, $score, $win)
		{
			$this->id = $id;
			$this->job_id = $job_id;
			$this->usr_id = $usr_id;
			$this->date = $date;
			$this->html = $html;
			$this->score = $score;
			$this->win = $win;
		}
		
		public function save()
		{
			DatabaseManager::getInstance()->lock("offer");
			
			$query = "insert into `offer`(`id`, `job_id`, `usr_id`, `date`, `html`, `score`, `win`) values(DEFAULT, '$this->job_id', '$this->usr_id', '$this->date', '$this->html', '$this->score', '$this->win')";
			$status = DatabaseManager::getInstance()->insert($query);
				
			$this->id = DatabaseManager::getInstance()->maxId('offer');
				
			DatabaseManager::getInstance()->unlock();
			
			Logger::dbLog($status, null, $query);
				
			return new Result($status, null, $query);
		}
		
		public function remove()
		{
			$query = "delete from `offer` where id = $this->id";
			$status = DatabaseManager::getInstance()->delete($query);
		
			Logger::dbLog($status, null, $query);
		
			return new Result($status, null, $query);
		}
		
		public static function get($id, $job_id, $usr_id, $date, $html, $score, $win)
		{
			$where = "";
			
			if($id != null || $job_id != null || $usr_id != null || $date != null || $html != null || $score != null || $win != null)
			{
				$where = " where ";
				
				if($id != null)
				{
					$where .= "id = $id ";
				}
				
				if($job_id != null)
				{
					$where .= "and job_id = $job_id ";
				}
				
				if($usr_id != null)
				{
					$where .= "and usr_id = $usr_id ";
				}
				
				if($date != null)
				{
					$where .= "and date = STR_TO_DATE('$date','%Y-%m-%d %h:%i:%s') ";
				}
				
				if($html != null)
				{
					$where .= "and html = '$html' ";
				}
				
				if($score != null)
				{
					$where .= "and score = $score ";
				}
				
				if($win != null)
				{
					$where .= "and win = $win ";
				}
				
				$where = str_replace("where and","where",$where);
			}
			
			$query = "select * from `offer`".$where;
			
			$result = DatabaseManager::getInstance()->select($query);
			$arr = array();
				
			foreach($result as $r)
			{
				$arr[] = new Offer($r[0], $r[1], $r[2], $r[3], $r[4], $r[5], $r[6]);
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