<?php

namespace App\Repositories;

class ServiceCategoryRepository extends Repository
{

    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/service-categories';
    }

}