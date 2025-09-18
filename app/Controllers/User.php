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
        $data['siltie'] = $news_model->getLatestNewsDetailsByCategory('ስልጤ');
        $data['centeral_ethiopia'] = $news_model->getLatestNewsDetailsByCategory('ማእከላዊ ኢትዮጵያ');
        $data['ethiopia'] = $news_model->getLatestNewsDetailsByCategory('ኢትዮጵያ');
        $data['africa'] = $news_model->getLatestNewsDetailsByCategory('አፍሪካ');
        $data['world'] = $news_model->getLatestNewsDetailsByCategory('ዓለም');
        $data['sport'] = $news_model->getLatestNewsDetailsByCategory('ስፖርት');
        $data['bussiness'] = $news_model->getLatestNewsDetailsByCategory('ቢዝነስ');
        return view('index', $data);

    }
}
