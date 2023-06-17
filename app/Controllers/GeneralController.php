<?php

namespace App\Controllers;

class GeneralController extends BaseController
{
    public function index()
    {
        return view('general/general');
    }
}