<?php

class User
{
	protected $id, $username, $email, $first_name, $last_name, $password, $is_admin, $blog_name;
	
	function __construct($id, $username, $email, $first_name, $last_name, $password, $is_admin, $blog_name)
	{
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->password = $password;
		$this->is_admin = $is_admin;
		$this->blog_name = $blog_name;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>