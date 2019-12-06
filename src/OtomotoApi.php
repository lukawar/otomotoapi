<?php

namespace OtomotoApi\Client;

interface OtomotoApi
{
    const VERSION = '1.0.0';

    public function getDataWithParameter($optionPath, $option);
    public function getCategory($option);
    public function getVersions($category, $brand, $model);
    public function getUserAdversList();
    public function getUserAdver($id);
    public function createAdvert();
    public function activateAdvert($id);
    public function getCitiesList($page);
    public function setImageCollection($images);
}