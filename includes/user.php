<?php
// If it's going to need the database, the it's probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject{

	protected static $table_name = "users";
	protected static $db_fields = array('id', 'username', 'password', 'first_name', 'last_name');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	
	public function full_name(){
		if(isset($this->first_name) && isset($this->last_name)){
			return $this->first_name . " " . $this->last_name; 
		} else {
			return "";
		}
	}
	
	
	public static function authenticate($username = "", $password = "") {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);

		$sql  = "SELECT * FROM users ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	// Common Database Methods
	public static function find_all(){
		return self::find_by_sql("SELECT * FROM " . self::$table_name);
	}
	
	
	public static function find_by_id($id=0) {
		$result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	public static function count_all(){
		global $database;
		$sql = "SELECT COUNT(*) FROM ".self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
	
	
	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
	
	
	private static function instantiate($record) {
		// Could check that $record exists and is an array
		// Simple, long-form approach:
		
		$object = new self;
		// $object->id 		   = $record['id'];
		// $object->username   = $record['username'];
		// $object->password   = $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name  = $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute => $value){
			if($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	
	private function has_attribute($attribute) {
	  // get_object_vars returns an associative array with all attributes 
	  // (incl. private ones!) as the keys and their current values as the value
	  $object_vars = $this->attributes();
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $object_vars);
	}

	
	// return an array of attribute names and their values
	protected function attributes() { 		
		$attributes = array();
		foreach(self::$db_fields as $field) {
			if(property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	// sanitize the values before submitting
	protected function sanitized_attributes() {
		global $database;
		$clean_attributes = array();
		
		foreach($this->attributes() as $key => $value){
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	
	
	// save user - create if does not exist or update if exists
	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	
	// create a new user
	public function create() {
		global $database;
		$attributes = $this->sanitized_attributes();

		$sql  = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		
		if($database->query($sql)) {
			$this->id = $database->insert_id();
			return true;
		} else {
			return false;
		}
	}
	
	

	// update an existing user
	public function update() {
		global $database;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}='{$value}'";
		}

		$sql  = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id=". $database->escape_value($this->id);
		
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	

	
	// delete user
	public function delete() {
		global $database;
		
		$sql  = "DELETE FROM ".self::$table_name." ";
		$sql .= "WHERE id=". $database->escape_value($this->id);
		$sql .= " LIMIT 1";
		$database->query($sql);
			return ($database->affected_rows() == 1) ? true : false;
	
		// After deleting, the instance of User still exists, even though the database entry does not.
		// This can be useful, as in: echo $user->first_name . " was deleted";
	}
}