<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/3/2016
 * Time: 2:09 PM
 */


class Place{
    private $place_id;
    private $no_of_visitors;
    private $name;
    private $description;
    private $image;

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

    public function set_name($name){
        $this->name=$name;
    }
    public function get_name(){
        return $this->name;
    }

    public function get_description(){
        return $this->description;
    }
    public function set_description($desc){
        $this->description=$desc;
    }

    public function get_image(){
        return $this->image;
    }
    public function set_image($image){
        $this->image=$image;
    }
}