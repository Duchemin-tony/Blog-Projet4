<?php 

namespace Blog\model;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host=localhost:8889;dbname=projet44;charset=utf8', 'root', 'root');
		return $db;
	}
}