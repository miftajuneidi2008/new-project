<?php

namespace App\Controllers;

class ProgramCategory extends BaseController
{
    public function index(): string
    {
        return view('admin/program_category/index');
    }
 
}
