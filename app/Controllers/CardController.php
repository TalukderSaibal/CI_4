<?php

namespace App\Controllers;

use App\Models\CardModel;

class CardController extends BaseController
{
    protected $model;

    public function __construct(){
        $this->model = new CardModel;
    }

    public function index(){
        return view('TestFile/test');
    }
}