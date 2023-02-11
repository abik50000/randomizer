<?php

namespace App\Core;

use mysqli;

class DB {

    protected static $instance;
    protected $connection;

	protected function __construct() {}

    public static function getInstance()
	{
		if (empty(self::$instance)) {	
			self::$instance = (new DB)->connect();
		}
	
		return self::$instance;
	}

    public function connect()
    {   
        try {
            if (!$this->connection) {	
                $this->connection = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            }
        } catch(\Throwable $e) {
			var_dump($e);
            throw new \Exception('Service Unavailable due to database', 503);
        }

        return $this;
    }

	public function query($sql)
	{
		return $this->connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($table, $id)
	{
		return $this->connection->query('SELECT * FROM '. $table . ' WHERE id = '. $id)->fetchAll(\PDO::FETCH_ASSOC);
    }	

	public function selectAll($table)
	{
		return $this->connection->query('SELECT * FROM '. $table)->fetchAll(\PDO::FETCH_ASSOC);
    }

	public function insert(string $table, string $columns, string $values)
	{
		$this->connection->query('INSERT INTO '.$table.' ('. $columns. ') VALUES ('. $values . ')');
		return $this->connection->lastInsertId();
    }

	public function delete(string $table, int $id)
	{
		return $this->connection->query('DELETE FROM '.$table.' WHERE id = '.$id);
    }

	public function truncate(string $table)
	{
		return $this->connection->query('TRUNCATE '.$table);
    }
}
