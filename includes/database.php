<?php

require_once(LIB_PATH.DS.'config.php');

class Database{

	public  $connection;
	public  $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	

	
	function __construct(){
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mysql_real_escape_string" );
	}

	

	// open database connection - PDO
	public function open_connection () {

		try{
			$this->connection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->connection->exec("SET NAMES 'utf8'");
		} catch (Exception $e){
			echo "Could not connect to the databse - PDO connection";
		exit;
		}
	}
	

	
	// close database connection - PDO
	public function close_connection(){

		$this->connection = null;
	}
	
	

	// query database - PDO
	public function query ( $sql ) {

		$this->last_query = $sql;

		try{
			$result = $this->connection->query($sql);
		}catch (Exception $e){
			echo "Data could not be retrieved from database - query() aici";
			exit;
		}

		//$this->displayQuery($result);
		return $result;		
	}
	

	// fetch array(to be used if we have other database than mysql)
	public function fetch_array( $result_set ){

		return $result_set->fetch(PDO::FETCH_ASSOC);
	}
	


	// count number of rows
	public function num_rows( $result_set ){

		return $result_set->fetchColumn();
		//return mysqli_num_rows($result_set);
	}
	


	// returns the last id inserted over the current db connection
	public function insert_id(){
		
		//return mysqli_insert_id();
		return $this->connection->lastInsertId();
	}
	
	
	public function affected_rows(){

		return $this->connection->rowCount();
	}
	
	
	
	// confirm query - PDO
	private function confirm_query( $result ) {

		if ( !$result ) {
			$output  = "Database query failed: ". mysqli_error($this->connection) . "<br /><br />";
			$output .= "Last SQL query: " . $this->last_query;
			die($output);
		}
	}
	
}


$database = new Database();