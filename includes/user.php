<?php

require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject{

	protected static $table_name = "users";
	protected static $db_fields = array('id', 'username', 'email', 'password');
	public $id;
	public $username;
	public $email;
	public $password;
	
	
	// check if user and password combination exists in database
	public static function authenticate( $email = "", $password = "" ) {

		$sql  = "SELECT * FROM users WHERE email = '{$email}' 
									   AND password = '{$password}'
				LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}


	// check if email used for registartion already exists
	public static function check_email( $email ){

		global $database;
	
		try{
			$results = $database->connection->prepare("SELECT email FROM ".self::$table_name." WHERE email = :email LIMIT 1");
			$results->bindValue(':email', $email, PDO::PARAM_STR);
			$results->execute();
		} catch (Exception $e){
			echo "Data could not be retrieved from the database - check_email";
			exit;
		}

		if( $results->rowCount() == 1 ){
			return true;
		} else {
			return false;
		} 
}

	
	
	// Common Database Methods
	public static function find_all(){

		return self::find_by_sql("SELECT * FROM " . self::$table_name);
	}
	
	
	public static function find_by_id( $id = 0 ) {

		$result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	public static function count_all() {

		global $database;

		$sql = "SELECT COUNT(*) FROM ".self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
	
	
	public static function find_by_sql( $sql = "" ) {

		global $database;
		$result_set = $database->query($sql);
		$object_array = array();

		while ($row = $database->fetch_array($result_set)) {
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
	
	
	private static function instantiate( $record ) {
		
		$object = new self;
		
		foreach( $record as $attribute => $value ){
			if( $object->has_attribute( $attribute ) ) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	
	private function has_attribute( $attribute ) {

	  $object_vars = $this->attributes();
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
			$clean_attributes[$key] = $value;
		}
		return $clean_attributes;
	}
	
	
	// save user - create if does not exist or update if exists
	public function save(){
		
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	
	// create a new user - PDO
	public function create() {
		
		global $database;

		$sql  = "INSERT INTO users ( id, username, email, password )
		         VALUES ( :id, :username, :email, :password )";
		$result = $database->connection->prepare( $sql );
		$result->bindParam(':id', $this->id, PDO::PARAM_INT);
		$result->bindParam(':username', $this->username, PDO::PARAM_STR);       
		$result->bindParam(':email', $this->email, PDO::PARAM_STR);       
		$result->bindParam(':password', $this->password, PDO::PARAM_STR);    
		$result->execute(); 
		
		return ($result->rowCount() == 1) ? true : false;
	}
	
	

	// update an existing user - PDO
	public function update() {

		global $database;

		$sql = "UPDATE users 
				SET username = :username, 
            	    password = :password
                WHERE id = :id";
        $result = $database->connection->prepare( $sql );
		$result->bindParam(':username', $this->username, PDO::PARAM_STR);
		$result->bindParam(':password', $this->password, PDO::PARAM_STR);
		$result->bindParam(':id', $this->id, PDO::PARAM_INT);
		$result->execute();

		return ($result->rowCount() == 1) ? true : false;
	}
	
	
	// delete user - must transform to PDO
	public function delete() {

		global $database;
		
		$sql  = "DELETE FROM users 
		         WHERE id = :id 
		         LIMIT 1";
		$result = $database->connection->prepare( $sql );      
		$result->bindParam(':id', $this->id, PDO::PARAM_INT);
		$result->execute();

		return ($result->rowCount() == 1) ? true : false;
	}


}