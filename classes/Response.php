<?php
	class Response
	{
		public $status;
		public $value;
		public $message;
		
		public function __construct($status, $value, $message) 
		{
			$this->status = $status;
			$this->value = $value;
			$this->message = $message;
		}
		
		public function json()
		{
			return json_encode($this);
		}
	}
?>