<?php
	class Result
	{
		public $status;
		public $value;
		public $query;

		public function __construct($status, $value, $query)
		{			
			$this->status = $status;
			$this->value = $value;
			$this->query = $query;
		}
	}
?>