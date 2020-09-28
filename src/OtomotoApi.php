<?php

namespace OtomotoApi\Client;

interface OtomotoApi
{
    const VERSION = '1.1.1';

    public function getDataWithParameter($optionPath, $option);
    public function getCategory($option);
    public function getVersions($category, $brand, $model);
    public function getEngineCodes($category, $brand, $model);
    public function getUserAdversList();
    public function getUserAdver($id);
    public function createAdvert($data);
    public function updateAdvert($id, $data);
    public function setActiveAdvert($id);
    public function setInactiveAdvert($id);
    public function getCitiesList($page);
    public function setImageCollection($images);
}