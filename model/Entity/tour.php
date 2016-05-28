<?php


class Tour{
    private $tour_id;
    private $tour_name;
    private $user_id;
    private $start_place;
    private $end_place;
    private $start_date;
    private $end_date;
    private $last_stop_id;

    public function set_tour_id($tour_id){
        $this->tour_id=$tour_id;

    }
    public function get_tour_id(){
        return $this->tour_id;
    }

    public function set_tour_name($tour_name){
        $this->tour_name=$tour_name;

    }
    public function get_tour_name(){
        return $this->tour_name;
    }

    public function set_user_id($user_id){
        $this->user_id=$user_id;
    }
    public function get_user_id(){
        return $this->user_id;
    }

    public function get_start_place(){
        return $this->start_place;
    }
    public function set_start_place($start_place){
        $this->start_place=$start_place;
    }

    public function get_end_place(){
        return $this->end_place;
    }
    public function set_end_place($end_place){
        $this->end_place=$end_place;
    }

    public function get_start_date(){
        return $this->start_date;
    }
    public function set_start_date($start_date){
        $this->start_date=$start_date;
    }

    public function get_end_date(){
        return $this->end_date;
    }
    public function set_end_date($end_date){
        $this->end_date=$end_date;
    }

    public function get_last_stop_id(){
        return $this->last_stop_id;
    }
    public function set_last_stop_id($last_stop_id){
        $this->last_stop_id=$last_stop_id;
    }
}