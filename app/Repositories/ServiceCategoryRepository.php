<?php

namespace App\Repositories;

class ServiceCategoryRepository extends Repository
{

    /**
     * @return string
     */
    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/service-categories';
    }

    /**
     * @return array
     */
    public function getPairIdName() {
        $data = $this->getAll();
        $items = $data->data;

        $array = [];
        foreach ($items as $item) {
            $array[$item->id] = $item->name;
        }

        return $array;
    }

}