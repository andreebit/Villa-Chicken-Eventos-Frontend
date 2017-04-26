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

}