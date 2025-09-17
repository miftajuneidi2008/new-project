<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function index()
    {
            $news_model = new NewsModel();
            $data['news'] = $news_model->getNewsWithDetails();
            return view('index', $data);
            
    }
}
