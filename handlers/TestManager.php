<?php

	require_once _PATH.'classes/models/user.php';
	require_once _PATH.'classes/models/offer.php';
	require_once _PATH.'classes/models/job.php';
	require_once _PATH.'classes/models/font.php';
	
	
	final class TestManager
	{
		private static $Instance = false;
	
		public static function getInstance()
		{
			if( self::$Instance == false )
			{
				self::$Instance = new TestManager();
			}
			return self::$Instance;
		}
		
		private function __construct()
		{
				
		}
		
		public function testUserClass()
		{
			$now = date('Y-m-d H:i:s');
			
			$user = new User(0, $now, "testuser", "testpassword");
			$user->save();
			print json_encode( User::get($user->id, $user->register_date, $user->login, $user->password) );
			$user->remove();
			print json_encode( User::getAll() );
		}
		
		public function testFontClass()
		{
			$now = date('Y-m-d H:i:s');
		
			$user = new User(0, $now, "testuser", "testpassword");
			$user->save();
				
			$font = new Font(0, $user->id, "testname", "testpath");
			$font->save();
			print json_encode( Font::get($font->id, $font->usr_id, $font->name, $font->path) );
			$font->remove();
			print json_encode( Font::getAll() );
			
			$user->remove();
		}
		
		public function testJobClass()
		{
			$now = date('Y-m-d H:i:s');
				
			$user = new User(0, $now, "testuser", "testpassword");
			$user->save();
			
			$font = new Font(0, $user->id, "testname", "testpath");
			$font->save();
			
			$job = new Job(0, $user->id, $font->id, 100, $now, $now, "testproperties");
			$job->save();
			print json_encode( Job::get($job->id, $job->usr_id, $job->fnt_id, $job->points, $job->date_start, $job->date_end, $job->properties) );
			$job->remove();
			print json_encode( Job::getAll() );
			
			$font->remove();
			$user->remove();
		}
		
		public function testOfferClass()
		{
			$now = date('Y-m-d H:i:s');
				
			$user = new User(0, $now, "testuser", "testpassword");
			$user->save();
				
			$font = new Font(0, $user->id, "testname", "testpath");
			$font->save();
				
			$job = new Job(0, $user->id, $font->id, 100, $now, $now, "testproperties");
			$job->save();
			
			$offer = new Offer(0, $job->id, $user->id, $now, "testhtml", 100, 1);
			$offer->save();
			print json_encode( Offer::get($offer->id, $offer->job_id, $offer->usr_id, $offer->date, $offer->html, $offer->score, $offer->win) );
			$offer->remove();
			print json_encode( Offer::getAll() );
			
			$job->remove();
			$font->remove();
			$user->remove();
		}
	}

?>