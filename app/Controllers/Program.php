<?php

namespace App\Controllers;

class Program extends BaseController
{
    public function index(): string
    {
        return view('admin/program/index');
    }
 
}
