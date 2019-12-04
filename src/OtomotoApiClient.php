<?php

namespace OtomotoApi\Client;

class OtomotoApiClient implements OtomotoApi
{
    private $path_dev = 'https://sbotomotopl.playground.lisbontechhub.com/api/open/';   //playground
    private $path_prod = 'https://otomoto.pl/api/open/';   //prod version

    public $config;
    public $path;

    public function __construct($config, $type)
    {
        $this->config = $config;

        $path = ['dev' => $this->path_dev, 'prod' => $this->path];
        $this->path = $path[$type];

        return true;
    }

    public function prepare()//: OtomotoApi
    {
        var_dump($this->path);
        var_dump($this->config);
    }
}

