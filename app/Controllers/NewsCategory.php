<?php

namespace App\Controllers;

class NewsCategory extends BaseController
{
    public function index(): string
    {
        return view('admin/news_category/index');
    }
 
}
