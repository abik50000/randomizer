<?php

namespace App\Core;

class App {
	
	public static $instance;
	public DB $db;
	public Router $router;

	protected function __construct() {}

	public static function getInstance()
	{
		if (self::$instance == null) {	
			self::$instance = new App();
		}

		return self::$instance;
	}
	
	public function getDB()
	{
		if(empty($this->db)) {
			$this->db = DB::getInstance();
		}
		return $this->db;
	}
	
	public function getRouter()
	{
		if(empty($this->router)) {
			$this->router = Router::getInstance();
		}
		return $this->router;
	}
}
