<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/3/2016
 * Time: 2:09 PM
 */
include_once 'Place.php';

class SavedPlace extends Place{
    private $user_id;

    public function set_user_id($user_id){
        $this->user_id=$user_id;
    }

    public function get_user_id(){
        return $this->user_id;
    }
}
