<?php
	class Result
	{
		public $status;
		public $value;
		public $query;

		public function __construct($status, $value, $query)
		{
			if($status == null) $status = "null";
			if($value  == null) $value  = "null";
			if($query  == null) $query  = "null";
			
			$this->status = $status;
			$this->value = $value;
			$this->query = $query;
		}
	}
?>