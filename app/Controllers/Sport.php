<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Sport extends BaseController
{
    public function index()
    {
    $news_model = new NewsModel();
    $data['sport'] = $news_model->getNewsWithDetails('ስፖርት');
    return view('/sport',$data);

    }
}
