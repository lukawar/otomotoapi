<?php

namespace OtomotoApi\Client;

class OtomotoApiConnect
{

    private $path_dev = 'https://sbotomotopl.playground.lisbontechhub.com/api/open/';   //playground
    private $path_prod = 'https://www.otomoto.pl/api/open/';   //prod version

    public $config;
    public $path;
    public $token;
    public $option;
    public $parameters = null;

    public function __construct($config, $type)
    {
        $this->config = (object)$config;

        $path = ['dev' => $this->path_dev, 'prod' => $this->path_prod];
        $this->path = $path[$type];
        $this->token = $this->getToken();
        return true;
    }

    public function connect($option, $type='GET')
    {
        $path = $this->path . $option;
        $this->option = $path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($type=='POST')
            curl_setopt($ch, CURLOPT_POST, 1);
        else
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        if(!is_null($this->parameters)) {
            //die(var_dump($this->parameters));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->parameters);
        }

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer ' . $this->token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public function getToken() {

        $path = $this->path . 'oauth/token';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=password&username=" . $this->config->login . "&password=" . $this->config->pass);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->config->idKey . ':' . $this->config->key);

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            die('Error:' . curl_error($ch));
        }
        curl_close($ch);

        $array = json_decode($result, true);
        return $array['access_token'];
    }

    public function getLastUsed()
    {
        return $this->option;
    }

}