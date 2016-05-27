<?php


class Place{
    private $place_id;
    private $no_of_visitors;

    public function set_place_id($place_id){
        $this->place_id=$place_id;

    }
    public function get_place_id(){
        return $this->place_id;
    }

    public function set_no_of_visitors($visitors){
        $this->no_of_visitors=$visitors;

    }
    public function get_no_of_visitors(){
        return $this->no_of_visitors;
    }
}