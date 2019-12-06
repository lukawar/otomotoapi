<?php

namespace OtomotoApi\Client;

class OtomotoApiClient extends OtomotoApiConnect implements OtomotoApi
{
    public function getDataWithParameter($optionPath, $option=null)  // cities, locations etc
    {
        if(!is_null($option))
            $option = '/'.$option;
        return $this->connect($optionPath . $option);
    }

    public function getCategory($option=null)
    {
        if(!is_null($option))
            $option = '/'.$option;
        return $this->connect('categories' . $option);
    }

    public function getVersions($category, $brand, $model)
    {
        return json_decode($this->connect(sprintf('/categories/%s/models/%s/versions/%s', $category, $brand, $model)), true);
    }

    public function getUserAdversList()
    {
        return $this->connect('account/adverts/');
    }

    public function getUserAdver($id)
    {
        return $this->connect('account/adverts/' . $id);
    }

    public function getCitiesList($page=1)
    {
        return $this->connect('cities?page=' . $page);
    }

    public function createAdvert($data)
    {
        $this->parameters = $data;
        return $result = $this->connect('account/adverts', 'POST');
    }

    public function setActiveAdvert($id)
    {
        return $this->connect('account/adverts/' . $id . '/activate', 'POST');
    }

    public function setImageCollection($images)
    {
        if(is_array($images)) {
            $this->parameters = json_encode($images, true);
            return $this->connect('/imageCollections');
        }

        return false;
    }

}

