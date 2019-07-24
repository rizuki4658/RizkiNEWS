<?php

class Database{
	private static $INSTANCE = null;
	private $mysqli,
			$HOST	= 'localhost',
			$USER	= 'root',
			$PASS	= '',
			$DBNAME	= 'clnews';

	public function __construct()
	{
	
		$this->mysqli = new mysqli( $this->HOST, $this->USER, $this->PASS, $this->DBNAME);
	
		if ( mysqli_connect_error() ) {
			die('Connection is error');
		}
	
	}


	public static function getInstance(){
		if ( !isset( self::$INSTANCE ) ) {
			self::$INSTANCE = NEW Database();
		}

		return self::$INSTANCE;
	}


	public function insert( $table, $fields =array()){
		$column			=	implode(", ", array_keys($fields) );
		$valuesArrays 	= array();
		$i 				=	0;
		foreach ($fields as $key => $values) {
			if (is_int($values)) {
				$valuesArrays[$i]	= $this->escape($values);
			}else{
				$valuesArrays[$i]	= "'" . $this->escape($values) . "'";
			}
			$i++;
		}
		$values = implode(", ", $valuesArrays);

		$query  = "INSERT INTO $table ($column) VALUES ($values)";
		//die($query);
		return $this->run_query($query, "ERROR FOR INSERT");
	}

	public function update($table, $fields, $id){
		$valuesArrays 	= array();
		$i 				= 0;

		foreach ($fields as $key=>$values) {
			if ( is_int($values) ) {
				$valuesArrays[$i] = $key . "=".$this->escape($values);
			}else{
				$valuesArrays[$i] = $key . "='" . $this->escape($values) . "'";
			}
			$i++;
		}

		$values = implode(", ", $valuesArrays);

		$query = "UPDATE $table SET $values WHERE id = $id";
		
		//die($query);
		return $this->run_query($query, 'Error For UPDATE');
	}

	public function delete($table, $id){
		$id = $this->escape($id);
		$query = "DELETE FROM $table WHERE id = $id";
		
		//die($query);
		return $this->run_query($query, 'Error For DELETE');
	}

	public function run_query($query, $msg){
		if ( $this->mysqli->query($query) ) return true; else die($msg);
	}

	public function escape($name){
		return $this->mysqli->real_escape_string($name);
	}

	public function get_info($table, $column='', $value=''){
		if ( !is_int($value)) $value = "'" . $value . "'";

			if ( $column != '') {
				
				$query = "SELECT * FROM $table WHERE $column = $value";
				//die($query);
				$result = $this->mysqli->query($query);
			
				while ( $row = $result->fetch_assoc() ) {
					return $row;
				}
		
			}else{

				$query = "SELECT * FROM $table";

				$result = $this->mysqli->query($query);
			
				while ( $row = $result->fetch_assoc() ) {
					$results[] = $row;
				}

				return $results;
			}
	}

	public function showing_news($column='' ,$value='', $page='', $perpage=''){
		if ( !is_int($value)) $value = "'" . $value . "'";

			if ( $column != '') {
				$start		= ($page >1) ? ($page * $perpage) - $perpage : 0;
				$query 		= "SELECT * FROM news WHERE $column = $value ORDER BY id DESC LIMIT $start, $perpage";
				
				$result 	= $this->mysqli->query($query);
				
				return $result;
			}else{
				$start	= ($page >1) ? ($page * $perpage) - $perpage : 0;
				$query 	= "SELECT * FROM news ORDER BY id DESC LIMIT $start, $perpage";

				$result = $this->mysqli->query($query);
			

				return $result;
			}
	}
	public function showing_all_news($column='' ,$value=''){
		if ( !is_int($value)) $value = "'" . $value . "'";

			if ( $column != '') {
				$query_all	= "SELECT * FROM news WHERE $column = $value ORDER BY id DESC";
				$results	= $this->mysqli->query($query_all);
				
				return $results;
			}else{

				$query = "SELECT * FROM news ORDER BY id DESC";

				$result = $this->mysqli->query($query);
			

				return $result;
			}
	}
	public function searching($table, $fields){
		$valuesArrays 	= array();
		$i 				= 0;

		foreach ($fields as $key=>$values) {
			if ( is_int($values) ) {
				$valuesArrays[$i] = $key . " LIKE '%".$this->escape($values)."%'";
			}else{
				$valuesArrays[$i] = $key . " LIKE '%" . $this->escape($values) . "%'";
			}
			$i++;
		}

		$values = implode(" OR ", $valuesArrays);
		$query = "SELECT * FROM $table WHERE $values ORDER BY id DESC LIMIT 10";
		
		//die($query);
		$result = $this->mysqli->query($query);

		return $result;
	}
	
	public function get_info_id($table, $column, $value){
		if ( !is_int($value)) $value = "'" . $value . "'"; else $value = $value; 

			if ( $column != '') {
				
				$query = "SELECT * FROM $table WHERE $column = $value";
				//die($query);
				$result = $this->mysqli->query($query);
				return $result;
			}

	}

	public function get_info_home($table, $column, $value){
		if ( !is_int($value)) $value = "'" . $value . "'"; else $value = $value; 

			if ( $column != '') {
				
				$query = "SELECT * FROM $table WHERE $column = $value ORDER BY id DESC LIMIT 1";
				//die($query);
				$result = $this->mysqli->query($query);
				return $result;
			}

	}

	public function get_info_home_child($table, $column, $value){
		if ( !is_int($value)) $value = "'" . $value . "'"; else $value = $value; 

			if ( $column != '') {
				
				$query = "SELECT * FROM $table WHERE $column = $value ORDER BY title DESC LIMIT 1";
				//die($query);
				$result = $this->mysqli->query($query);
				return $result;
			}

	}

	public function close_connection(){
		$this->mysqli->close();
	}	
}
?>