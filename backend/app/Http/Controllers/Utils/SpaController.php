<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;

class SpaController extends Controller
{
    public function index()
    {
        return view('vue');
    }
}
