<?php

class Foto{
	private $_db;

	public function __construct(){
		$this->_db	= Database::getInstance();
	}
	
	public function get_foto_email($table, $column ,$value)
	{
		return $this->_db->get_info($table, $column, $value);
	}

	public function update_foto($fields = array(), $id )
	{
		
		if ( $this->_db->update('users', $fields, $id) ) return true; else return false;
	}
}


?>