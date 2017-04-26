<?php

namespace App\Repositories;

use App\Repositories\Traits\CrudRepositoryTrait;

class PackageRepository extends Repository
{

    use CrudRepositoryTrait;

    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/packages';
    }

    /**
     * @param $eventTypeId
     * @return mixed|null|\stdClass
     */
    public function getByEventType($eventTypeId)
    {
        $filters = ['event_type_id' => $eventTypeId];
        return $this->getAll($filters);
    }

}