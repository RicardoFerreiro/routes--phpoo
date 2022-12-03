<?php

namespace app\core;

use app\routes\Routes;
use app\support\RequesType;
use app\support\Uri;

class RoutersFilter
{
    private string $uri;
    private string $method;
    private array $RoutesRegistered;

    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = RequesType::get();
        $this->RoutesRegistered = Routes::get();
    }

    private function simpleRouter()
    {
        if(array_key_exists($this->uri,$this->RoutesRegistered[$this->method])){
            return $this->RoutesRegistered[$this->method][$this->uri];
        }

        return null;
    }
    private function dynamicRouter()
    {
        foreach($this->RoutesRegistered[$this->method] as $index => $route){
            $regex = str_replace('/', '\/',ltrim($index,'/'));
            if($index !== '/' && preg_match("/^$regex$/", trim($this->uri,'/'))){
                $routerRegisteredFound = $route;
                break;

            }else{
                $routerRegisteredFound = null;
            }
        }

        return $routerRegisteredFound;
        
    }

    public function get(){
        $router = $this->simpleRouter();

        if($router){
            return $router;
        }
        // return $this->simpleRouter();
        $router = $this->dynamicRouter();

        if($router){
            return $router;
        }
        return 'NotFoundController@index';
    }
}
