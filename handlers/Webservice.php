<?php

	require_once _PATH.'handlers/SessionManager.php';
	require_once _PATH.'classes/models/font.php';
	require_once _PATH.'classes/models/user.php';
	require_once _PATH.'classes/Response.php';

	class Webservice
	{
		private static $Instance = false;
		
		public static function getInstance()
		{
			if( self::$Instance == false )
			{
				self::$Instance = new Webservice();
			}
			return self::$Instance;
		}
				
		private function __construct()
		{
			
		}
		
		public function login($login, $password)
		{
			$result = User::get(null, null, $login, null);
			
			if( $result->value[0]->password == $password )
			{
				SessionManager::getInstance()->login($result->value[0]);
				
				$response = new Response(1, $result->value[0], "Dane logowania poprawne!");
				return $response->json();
			}
			else 
			{
				$response = new Response(0, null, "Podano niepoprawne dane logowania!");
				return $response->json();
			}			
		}
		
		public function logout()
		{
			SessionManager::getInstance()->logout();
			
			header("Location: "._URL."login.php");
			die();
		}
		
		public function register($login, $password)
		{
			$now = date('Y-m-d H:i:s');
			
			$user = new User(0, $now, $login, $password);
			
			if( $user->save()->status == 1 )
			{
				$response = new Response(1, $result->value[0], "Konto zostalo utworzone!");
				return $response->json();
			}
			else
			{
				$response = new Response(0, null, "Konto nie zostalo utworzone!");
				return $response->json();
			}
		}
		
		public function addFont()
		{
			$user_name = SessionManager::getInstance()->getName();
			
			$target_dir = _MEDIA."$user_name/";
			
			if( !file_exists($target_dir) )
			{
				mkdir($target_dir);
			}
			
			$file_name = basename($_FILES["fontFile"]["name"]);
			$target_file = $target_dir . $file_name;
			
			if( !file_exists($target_file) )
			{
				$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
				
				if($fileType != "ttf")
				{
					return "Zle rozszerzenie";
				}
				
				if( move_uploaded_file($_FILES["fontFile"]["tmp_name"], $target_file) )
				{
					$filename = pathinfo($target_file, PATHINFO_FILENAME);
					$filepath = _URL."media/$user_name/".pathinfo($target_file, PATHINFO_BASENAME);
					
					$font = new Font(0, SessionManager::getInstance()->getId(), $filename, $filepath);
					$font->save();
				}
			}
			
			header( 'Location: '._URL.'jobs/add' );
		}
		
		public function removeJob()
		{
		
		}
		
		public function addJob()
		{
		
		}
		
		public function getJobs()
		{
		
		}
		
		public function getJobFontFile()
		{
		
		}
		
		public function getJobPropertiesFile()
		{
		
		}
		
		public function defaultAction($action)
		{
			
		}
	}

?>