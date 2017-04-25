<?php

namespace App\Repositories;

class EventTypeRepository extends Repository
{

    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/event-types';
    }

}