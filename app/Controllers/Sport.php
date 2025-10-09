<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AddsModel;
use App\Models\NewsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Sport extends BaseController
{
    public function index()
    {
    $news_model = new NewsModel();
    $adds_model = new  AddsModel();   
     $data['adds'] = $adds_model->findAll();
    $data['sport'] = $news_model->getNewsWithDetails('ስፖርት');
    return $this->render('/sport',$data);

    }
}
