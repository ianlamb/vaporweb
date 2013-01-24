<?php

class UserFile extends Eloquent {

	public static $timestamps = true;
    public static $table = 'files';

    public function user()
    {
        return $this->belongs_to('User');
    }

}

?>