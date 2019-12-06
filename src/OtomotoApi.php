<?php

namespace OtomotoApi\Client;

interface OtomotoApi
{
    const VERSION = '1.0.1';

    public function getDataWithParameter($optionPath, $option);
    public function getCategory($option);
    public function getVersions($category, $brand, $model);
    public function getUserAdversList();
    public function getUserAdver($id);
    public function createAdvert($data);
    public function setActiveAdvert($id);
    public function getCitiesList($page);
    public function setImageCollection($images);
}