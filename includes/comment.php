<?php 

require_once(LIB_PATH.DS.'database.php');
require_once("initialize.php");

class Comment extends DatabaseObject {

	protected static $table_name="comments";
	protected static $db_fields=array('id', 'photograph_id', 'created', 'author', 'body');

	public $id;
	public $photograph_id;
	public $created;
	public $author;
	public $body;

	
	// try to send an email for an added comment
	/*public function try_to_send_notification(){
		
		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->SMTPAuth      = true;   
		$mail->SMTPKeepAlive = true;   
		$mail->Host          = 'smtp.gmail.com'; 
		$mail->Port          = 465;
		$mail->SMTPSecure    = 'ssl';
		$mail->Username      = ;
		$mail->Password      = ;
		$mail->SetFrom('');
		$mail->AddReplyTo('');

		$mail->FromName = "Sender Name";
		$mail->From     = "";
		$mail->AddAddress("");
		$mail->Subject  = "Mail Test at ".strftime("%T", time());
		$mail->Body     = $message;
		$message = wordwrap($message,70);	
		$created = datetime_to_text($this->created);
		$mail->Body     = <<< EMAILBODY
		A new comment has been received in Photo Gallery
		At {$this->created}, {$this->author} wrote:
		{$this->body}	
		EMAILBODY;
		$result = $mail->Send();
		echo $result ? 'Sent' : 'Error';
		return $result ;
	}*/
	
	
	public static function make( $photo_id, $author = "", $body = "" ) {
		date_default_timezone_set('Europe/Bucharest');
		
		if(!empty($photo_id) && !empty($body)) {
			$comment = new Comment();
			$comment->photograph_id = (int)$photo_id;
			$comment->created = strftime("%Y-%m-%d %H:%M:%S", time());

			if($author != ""){
				$comment->author = $author;	
			} else {
				$comment->author = "anonymous";
			}
			
			$comment->body = $body;
			return $comment;
		} else {
			return false;
		}
	}
	
	
	// return all the comments of a photograph
	public static function find_comments_on( $photo_id = 0 ) {

		global $database;

		$sql  = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE photograph_id=" .$photo_id;
		$sql .= " ORDER BY created ASC";
		return self::find_by_sql($sql);
	}
	
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
	}


	public static function find_by_id($id=0) {
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
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
		
		$object = new self;
		
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

		foreach($this->attributes() as $key => $value){
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}

	
	public function save() {
	  // A new record won't have an id yet.
		return isset($this->id) ? $this->update() : $this->create();
	}
	

	// create a new comment - PDO
	public function create() {

		global $database;

		$sql  = "INSERT INTO comments ( id, photograph_id, created, author, body ) 
		         VALUES ( :id, :photograph_id, :created, :author, :body )";
		$result = $database->connection->prepare( $sql );
		$result->bindParam(':id', $this->id, PDO::PARAM_INT);
		$result->bindParam(':photograph_id', $this->photograph_id , PDO::PARAM_INT);
		$result->bindParam(':created', $this->created , PDO::PARAM_INT);
		$result->bindParam(':author', $this->author, PDO::PARAM_STR);
		$result->bindParam(':body', $this->body, PDO::PARAM_STR);
		$result->execute(); 
		
		return ($result->rowCount() == 1) ? true : false;
	}


	public function update() {
		global $database;

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


	public function delete() {
		global $database;

		$sql = "DELETE FROM ".self::$table_name;
		$sql .= " WHERE id=". $database->escape_value($this->id);
		$sql .= " LIMIT 1";

		$database->query($sql);

		return ($database->affected_rows() == 1) ? true : false;
	}

}