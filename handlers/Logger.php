<?php

	class Logger
	{
		private static function getNow()
		{
			return date('Y-m-d H:i:s');
		}
		
	public static function dbLog($status, $value, $query)
		{
			if($status == null) $status = "null";
			if($value  == null) $value  = "null";
			if($query  == null) $query  = "null";			
						
			$file = _PATH.'logs/database.log';
			$now = self::getNow();
			
			$log  = "\n";
			$log .= "$now"."\n";
			$log .= "status: $status"."\n";
			$log .= " value: ".json_encode($value)."\n";
			$log .= " query: $query"."\n";
			$log .= "\n";			
			
			file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
		}
		
		public static function log($message)
		{
			if($message == null) $status = "null";
				
			$file = _PATH.'logs/application.log';
			$now = self::getNow();
				
			$log  = "\n";
			$log .= "$now"."\n";
			$log .= "message: $message"."\n";
			$log .= "\n";
				
			file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
		}
	}

?>