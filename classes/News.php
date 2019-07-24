<?php

class News{
	private $_db;

	public function __construct(){
		$this->_db	= Database::getInstance();
	}

	public function showing_news($column, $value, $page='', $perpage=''){

		return $this->_db->showing_news($column, $value, $page, $perpage);
	}

	public function showing_all_news($column, $value){
		return $this->_db->showing_all_news($column, $value);
	}
	
	public function get_info_id($column, $value){
		return $this->_db->get_info_id('news', $column, $value);
	}

	public function get_info_home($column, $value){
		return $this->_db->get_info_home('news', $column, $value);
	}

	public function get_info_home_child($column, $value){
		return $this->_db->get_info_home_child('news', $column, $value);
	}

	public function adding_news( $fields = array() )
	{
		if ( $this->_db->insert('news', $fields) ) return true; else return false;
	}

	public function updating_news( $fields = array(), $id )
	{
		if ( $this->_db->update('news',$fields, $id) ) return true; else return false;
	}

	public function deleting_news($id )
	{
		if ( $this->_db->delete('news', $id) ) return true; else return false;
	}

	public function searching($fields){
		return $this->_db->searching('news', $fields);
	}
}


?>