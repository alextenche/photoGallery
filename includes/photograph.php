<?php 

require_once(LIB_PATH.DS.'database.php');

class Photograph extends DatabaseObject {
	
	protected static $table_name = "photographs";
	protected static $db_fields = array('id', 'user_id', 'filename', 'type', 'size', 'caption');
	public $id;
	public $user_id;
	public $filename;
	public $type;
	public $size;
	public $caption;
	
	private $temp_path;
	protected $upload_dir = "images";
	public $errors = array();
  

	protected $upload_errors = array(
		UPLOAD_ERR_OK 			=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
		UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
		UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
		UPLOAD_ERR_NO_FILE 		=> "No file.",
		UPLOAD_ERR_NO_TMP_DIR   => "No temporary directory.",
		UPLOAD_ERR_CANT_WRITE   => "Can't write to disk.",
		UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);


	// Pass in $_FILE(['uploaded_file']) as an argument
	public function attach_file($file) {
		// Perform error checking on the form parameters
		if(!$file || empty($file) || !is_array($file)) {
			// error: nothing uploaded or wrong argument usage
			$this->errors[] = "No file was uploaded.";
			return false;
		} elseif($file['error'] != 0) {
			// error: report what PHP says went wrong
			$this->errors[] = $this->upload_errors[$file['error']];
			return false;
		} else {
			// set object attributes to the form parameters.
			$this->temp_path  = $file['tmp_name'];
			$this->filename   = basename($file['name']);
			$this->type       = $file['type'];
			$this->size       = $file['size'];
			// Don't worry about saving anything to the database yet.
			return true;
		}
	}
	


	// custom save
	public function save() {
		// A new record won't have an id yet.
		if(isset($this->id)) {
			$this->update();
		} else {
			if(!empty($this->errors)) { return false; }
		  
			if(strlen($this->caption) > 255) {
				$this->errors[] = "The caption can only be 255 characters long.";
				return false;
			}
		
			if(empty($this->filename) || empty($this->temp_path)) {
				$this->errors[] = "The file location was not available.";
				return false;
			}
			
			$target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
		  
			if(file_exists($target_path)) {
				$this->errors[] = "The file {$this->filename} already exists.";
				return false;
			}
		
			if(move_uploaded_file($this->temp_path, $target_path)) {
				if($this->create()) {
					unset($this->temp_path);
					return true;
				}
			} else {
				$this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
				return false;
			}
		}
	}
	
	
	// remove photo from database and delete the file
	public function destroy() {
		// first remove database entry, second remove the file
		if($this->delete()) {
			$target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
			return unlink($target_path) ? true : false;
		} else {
			// database delete failed
			return false;
		}
	}
	
	
	public function image_path() {

	  	return $this->upload_dir.DS.$this->filename;
	}
	
	
	// human readable file size
	public function size_as_text() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} MB";
		}
	}
	
	
	// finding all the comments of a photo
	public function comments() {
		return Comment::find_comments_on($this->id);
	}
	
	
	// Common Database Methods
	//----------------------------------------------------------------------------------------------
	public static function find_all( $user_id ) {
		return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE user_id = ".$user_id);
	}
  
  
	public static function find_by_id( $id=0 ) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id=".$id." LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
  
	// counting all for pagination
	public static function count_all(){

		global $database;
		$sql = "SELECT COUNT(*) FROM ".self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);
	}
  
  
	public static function find_by_sql( $sql="" ) {
		
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
		$object = new self;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
			if($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	
	private function has_attribute($attribute) {
		// We don't care about the value, we just want to know if the key exists
		// Will return true or false
		return array_key_exists($attribute, $this->attributes());
	}

	
	protected function attributes() { 
		// return an array of attribute names and their values
		$attributes = array();
		foreach(self::$db_fields as $field) {
			if(property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
		

	// create a new user - PDO
	public function create() {
		
		global $database;

		$sql  = "INSERT INTO photographs ( id, user_id, filename, type, size, caption )
		         VALUES ( :id, :user_id, :filename, :type, :size, :caption )";
		$result = $database->connection->prepare( $sql );
		$result->bindParam(':id', $this->id, PDO::PARAM_INT);
		$result->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
		$result->bindParam(':filename', $this->filename, PDO::PARAM_STR);
		$result->bindParam(':type', $this->type, PDO::PARAM_STR);
		$result->bindParam(':size', $this->size, PDO::PARAM_INT);
		$result->bindParam(':caption', $this->caption, PDO::PARAM_STR);
		$result->execute(); 
		
		return ($result->rowCount() == 1) ? true : false;
	}


	public function update() {
	  global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id=". $database->escape_value($this->id);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}


	// delete photo - PDO
	public function delete() {

		global $database;
		
		$sql  = "DELETE FROM ". self::$table_name .
		       " WHERE id = :id LIMIT 1";
		$result = $database->connection->prepare( $sql );      
		$result->bindParam(':id', $this->id, PDO::PARAM_INT);
		$result->execute();

		return ($result->rowCount() == 1) ? true : false;
	}
		
}