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
		}
		
		public function login($user)
		{
			$_SESSION['user'] = $user->id;
		}
		
		public function logout()
		{
			session_unset(); 
			session_destroy();
		}
		
		public function getUser()
		{
			if( !isset($_SESSION['user']) || $_SESSION['user'] == null )
			{
				Logger::log("PUSTO");
				return null;
			}
			
			Logger::log(json_encode(User::get($_SESSION['user'], null, null, null)->value[0]));
			
			return User::get($_SESSION['user'], null, null, null)->value[0];
		}
	}

?>