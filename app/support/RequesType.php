<?php
namespace app\support;

class RequesType{
    public static function get(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}