<?php

class User extends Eloquent {

	public static $timestamps = true;

	public function files()
     {
          return $this->has_many('UserFile');
     }
	
}

?>