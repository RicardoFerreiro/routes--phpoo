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

        return 'NotFoundController@index';
    }
    private function dynamicRouter()
    {
    }

    public function get(){
        return $this->simpleRouter();
    }
}
