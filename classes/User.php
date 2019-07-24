<?php

class User{

	private $_db;

	public function __construct(){
		$this->_db	= Database::getInstance();
	}

	public function register_user($fields = array())
	{
		if ( $this->_db->insert('users', $fields) ) return true; else return false;
	}

	public function cek_email($email){
		$data = $this->_db->get_info('users', 'email', $email);
		if ( empty($data) ) return false; else return true;
	}

	public function login_user($email, $password){
		
		$data = $this->_db->get_info('users', 'email', $email);	
		if ( password_verify($password, $data['password']) ) return true; else return false;
	}

	public function get_user()
	{
		return $this->_db->get_info('users');
	}

	public function get_user_id($table, $column ,$value)
	{
		return $this->_db->get_info($table, $column, $value);
	}

	public function update_user($fields = array(), $id )
	{
		if ( $this->_db->update('users',$fields, $id) ) return true; else return false;
	}

	public function delete_user($id)
	{
		if ( $this->_db->delete('users', $id) ) return true; else return false;
	}

	public function is_loggedIn(){
		if ( Session::exists('email') ) return true; else return false;
	}

	public function searching($fields){
		return $this->_db->searching('users', $fields);
	}
}


?>