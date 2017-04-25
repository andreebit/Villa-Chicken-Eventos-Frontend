<?php

namespace App\Repositories;

class PackageRepository extends Repository
{

    public function endpoint()
    {
        return env('API_BASE_URL') . '/api/v1/packages';
    }

}