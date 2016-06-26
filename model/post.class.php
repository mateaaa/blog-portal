<?php

class Post
{
	protecetd $id, $title, $text, $created, $user_id;
	
	function __construct($id, $title, $text, $created, $user_id)
	{
		$this->id = $id;
		$this->title = $title;
		$this->text = $text;
		$this->created = $created;
		$this->user_id = $user_id;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>