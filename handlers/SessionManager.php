<?php

	final class SessionManager
	{
		private static $Instance = false;
	
		public static function getInstance()
		{
			if( self::$Instance == false )
			{
				self::$Instance = new SessionManager();
			}
			return self::$Instance;
		}
	
		private function __construct()
		{
			$this->mysqli = new mysqli(_HOST, _DB_USER, _DB_PASSWORD, _DATABASE);
		}
		
		public function getColor()
		{
			return 120;
		}
		
		public function getName()
		{
			return 'Admin';
		}
		
		public function getFirstLetter()
		{
			return 'A';
		}
		
		public function getId()
		{
			return 1;
		}
	}

?>