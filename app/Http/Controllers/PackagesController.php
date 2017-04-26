<?php

namespace App\Http\Controllers;

use App\Repositories\PackageRepository;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(PackageRepository $packageRepository)
    {
        $data = $packageRepository->getAll();
        return view('packages.index', ['items' => $data->data]);
    }


    public function create()
    {
        return view('packages.form');
    }

    public function edit()
    {
        return view('packages.form');
    }

    public function delete()
    {

    }


}
