<?php
//Define the Database for easy configuration
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "htl");

class Database{
	
	private $connection;
	public $last_query;

	function __construct() {
		$this->open_connection();
	}
	
	//Open Connection Function
	public function open_connection() {
		$this->connection = mysql_connect(DB_SERVER,DB_USER, DB_PASS);
		if(!$this->connection) {
			die("Database Connection Failed: " . mysql_error());
		}
		else {
			$db_select = mysql_select_db(DB_NAME, $this->connection);
			if(!$db_select) {
				die("Database Selection Failed: " .mysql_error());
			}
		}
	}
	
	//Close Connection Function
	public function close_connection() {
		if(isset($this->connection)) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	
	//Query Function
	public function query($sql) {
		$this->last_query = $sql;
		$result = mysql_query($sql, $this->connection);
		$this->confirm_query($result);
		return $result;
	}
	
	//Database Natural Method
	public function fetch_array($result_set) {
		return mysql_fetch_array($result_set);
	}
	
	public function num_rows($result_set) {
		return mysql_num_rows($result_set);
	}
	
	public function insert_id() {
		return mysql_insert_id($this->connection);
	}
	
	public function affected_rows() {
		return mysql_affected_rows($this->connection);
	}
	
	// Confirm Query Function
	private function confirm_query($result) {
		if(!$result) {
			$output = "Database Query Failed: " . mysql_error() . "<br/>";
			$output .= "Last SQL Query: " . $this->last_query;
			die($output);
		}
	}
	
	
}


$db = new Database();

?>