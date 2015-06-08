<?php

	require_once _PATH.'handlers/SessionManager.php';
	require_once _PATH.'classes/models/font.php';
	require_once _PATH.'classes/models/user.php';
	require_once _PATH.'classes/models/job.php';
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
			
			$result = $user->save();
			
			if( $result->status == 1 )
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
			$user_name = SessionManager::getInstance()->getUser()->login;
			
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
					$response = new Response(0, null, "Nieodpowiednie rozszerzenie pliku! Oczekiwano .ttf");
					return $response->json();
				}
				
				if( move_uploaded_file($_FILES["fontFile"]["tmp_name"], $target_file) )
				{
					$filename = pathinfo($target_file, PATHINFO_FILENAME);
					$filepath = _URL."media/$user_name/".pathinfo($target_file, PATHINFO_BASENAME);
					
					$font = new Font(0, SessionManager::getInstance()->getUser()->id, $filename, $filepath);
					$font->save();
				}
			}
			
			header( 'Location: '._URL.'jobs/add' );
		}
		
		public function removeJob($job_id)
		{
			$job = Job::get($job_id, null, null, null, null, null, null)->value[0];
			$result = $job->remove();
			
			if($result->status == 1)
			{
				$response = new Response(1, null, "Job zostal usuniety");
				return $response->json();
			}
			else
			{
				$response = new Response(0, null, "Nie udalo sie usunac joba");
				return $response->json();
			}
		}
		
		public function addJob($properties, $points, $font)
		{
			$now = date('Y-m-d H:i:s');
			
			$job = new Job(0, SessionManager::getInstance()->getUser()->id, $font, $points, $now, null, $properties);
			
			$result = $job->save();
			
			if( $result->status == 1 )
			{
				$response = new Response(1, $result->value[0], "Zlecenie zostalo zapisane");
				return $response->json();
			}
			else
			{
				$response = new Response(0, null, "Zlecenie nie zostalo zapisane");
				return $response->json();
			}
		}
		
		public function getJobs($user_login, $fnt_id, $points_min, $points_max, $date_start, $date_end)
		{
			Logger::log("dostalem ".$user_login);
			
			$user_id = null;
			
			if($user_login != null)
			{
				$user = User::get(null, null, $user_login, null)->value[0];
				
				if( $user != null)
				{
					$user_id = $user->id;
				}
				else
				{
					$response = new Response(1, null, "Nie znaleziono uzytkownika '".$user_login."'");
					return $response->json();
				}
			}
				
			$result = Job::get(null, $user_id, $fnt_id, null, null, null, null);			
			$jobs_temp = $result->value;
			$jobs = array();
						
			if( count($jobs_temp) == 0 )
			{
				$response = new Response(0, null, "Nie znaleziono zadnych jobow spelniajacych zadane kryteria");
				return $response->json();
			}
			else
			{
				foreach ($jobs_temp as $job) 
				{
					$isValid = true;
									
					if( $points_min != null && $isValid )
					{
						if( $job->points < $points_min )
						{
							$isValid = false;
						}
					}
					
					if( $points_max != null && $isValid )
					{
						if( $job->points > $points_max )
						{
							$isValid = false;
						}
					}
					
					if( $date_start != null && $isValid )
					{
						if( $job->date_start < $date_start )
						{
							$isValid = false;
						}
					}
					
					if( $date_end != null && $isValid )
					{
						if( $job->date_start > $date_end )
						{
							$isValid = false;
						}
					}
					
					if( $isValid )
					{
						$jobs[] = $job;
					}
				}
			}
			
			if( count($jobs) == 0 )
			{
				$response = new Response(1, null, "Nie znaleziono zadnych jobow spelniajacych zadane kryteria");
				return $response->json();
			}
			else
			{
				$dict = array();
				$dict["users"] = array();
				$dict["fonts"] = array();
				
				foreach(User::getAll()->value as $u)
				{
					$dict["users"][$u->id] = $u->login;
				}
				
				foreach(Font::getAll()->value as $f)
				{
					$dict["fonts"][$f->id] = $f->name;
				}
			
				$response = new Response(1, json_encode($jobs), json_encode($dict));
				return $response->json();
			}
		}
		
		public function getFontPath($id)
		{
			$font = Font::get($id, null, null, null);
			
			return $font->value[0]->path;
		}
		
		public function getJobPropertiesFile()
		{
		
		}
		
		public function defaultAction($action)
		{
			
		}
	}

?>