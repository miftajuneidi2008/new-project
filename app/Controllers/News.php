<?php

namespace App\Controllers;

class News extends BaseController
{
    public function news(): string
    {
        return view('admin/news/index');
    }

 
 
}
