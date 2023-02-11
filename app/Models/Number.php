<?php 

namespace App\Models;

class Number
{
	protected static $table = 'numbers';
	protected $id;
	protected $number;
	protected $created_at;
	
	public static function find(int $id)
	{
		$rows = app()->getDB()->find(self::$table, $id);
		return count($rows) > 0 ? $rows[0] : [];
	}
	
	public static function create()
	{
		$number = rand(100, 999);

		$columns = 'number, created_at';
		$values = $number. ', FROM_UNIXTIME('.time().')';

		return app()->getDB()->insert(self::$table, $columns, $values);
	}
	
	public static function all()
	{
		return app()->getDB()->selectAll(self::$table);
    }

	public static function truncate()
	{
		return app()->getDB()->truncate(self::$table);
    }
}