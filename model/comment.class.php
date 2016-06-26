<?php

class Post
{
	protecetd $id, $text, $post_id, $user_id;
	
	function __construct($id, $text, $post_id, $user_id)
	{
		$this->id = $id;
		$this->text = $text;
		$this->post_id = $post_id;
		$this->user_id = $user_id;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>