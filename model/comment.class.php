<?php

class Comment
{
	protected $id, $text, $post_id, $user_id;
	
	function __construct($id, $text, $post_id, $user_id, $created)
	{
		$this->id = $id;
		$this->text = $text;
		$this->post_id = $post_id;
		$this->user_id = $user_id;
                $this->created = $created;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>