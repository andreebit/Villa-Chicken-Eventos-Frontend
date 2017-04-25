<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index()
    {
        return view('packages.index');
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
