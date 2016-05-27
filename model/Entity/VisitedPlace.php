<?php

include_once 'place.php';

class VisitedPlace extends Place{
    private $user_id;
    private $date;
    private $times_visited;

    public function set_user_id($user_id){
        $this->user_id=$user_id;
    }

    public function get_user_id(){
        return $this->user_id;
    }

    public function set_date($date){
        $this->date=$date;
    }

    public function get_date(){
        return $this->date;
    }

    public function set_times_visited($times_visited){
        $this->times_visited=$times_visited;
    }

    public function get_times_visited(){
        return $this->times_visited;
    }
}