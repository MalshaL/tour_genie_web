<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/26/2016
 * Time: 7:11 AM
 */
include 'place.php';

class TourStop extends Place{
    private $tour_id;
    private $user_id;
    private $tour_order;
    private $date;

    public function set_tour_id($tour_id){
        $this->tour_id=$tour_id;

    }
    public function get_tour_id(){
        return $this->tour_id;
    }

    public function set_user_id($user_id){
        $this->user_id=$user_id;
    }
    public function get_user_id(){
        return $this->user_id;
    }

    public function get_tour_order(){
        return $this->tour_order;
    }
    public function set_tour_order($tour_order){
        $this->tour_order=$tour_order;
    }

    public function get_date(){
        return $this->date;
    }
    public function set_date($date){
        $this->date=$date;
    }
}