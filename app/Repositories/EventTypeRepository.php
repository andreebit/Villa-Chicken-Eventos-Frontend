<?php

namespace App\Repositories;

class EventTypeRepository extends Repository
{

    /**
     * @return string
     */
    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/event-types';
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