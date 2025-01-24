<?php

namespace App\Http\Controllers;


abstract class Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
    }
}
