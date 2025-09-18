<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsCategoryModel;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class NewsData extends BaseController
{
    public function index()
    {
        $news_model = new NewsModel();
        $categoryModel = new NewsCategoryModel();


        $selectedCategoryTitle = $this->request->getVar('category_title');

        $pager = \Config\Services::pager(); // Load the Pager service

        // 1. Get the full list of news. With the model fix, this list will now have a stable order.
        $allNews = $news_model->getNewsWithDetails($selectedCategoryTitle);

        $perPage = 3;
        $total = count($allNews);


        $page = $pager->getCurrentPage();

        // 4. Create the pagination links.
        $data['pager'] = $pager->makeLinks($page, $perPage, $total, 'bootstrap5_pagination');


        $data['news'] = array_slice($allNews, ($page - 1) * $perPage, $perPage);
        $data['selectedCategoryTitle'] = $selectedCategoryTitle;
        $data['categories'] = $categoryModel->findAll();
        $data['popular'] = $news_model->getPopularNews();
        return view('news', $data);
    }


    public function show($id = null)
    {
        $news_model = new NewsModel();

        // Fetch the single news article from the model
        $news_data = $news_model->getNewsDetailsById((int) $id);


        if (empty($news_data)) {
            // This is the standard CodeIgniter way to show a 404 error page
            throw new PageNotFoundException('The page you are looking for is not found.');
        }

        $data['news'] = $news_data;
        $data['popular'] = $news_model->getPopularNews($id);

        return view('news_detail', $data);
    }

    public function sport()
    {
        $news_model = new NewsModel();
        $categoryModel = new NewsCategoryModel();


      

        $pager = \Config\Services::pager(); // Load the Pager service

        // 1. Get the full list of news. With the model fix, this list will now have a stable order.
        $allNews = $news_model->getNewsWithDetails('ስፖርት');

        $perPage = 2;
        $total = count($allNews);


        $page = $pager->getCurrentPage();

        // 4. Create the pagination links.
        $data['pager'] = $pager->makeLinks($page, $perPage, $total, 'bootstrap5_pagination');
        $data['sport'] = array_slice($allNews, ($page - 1) * $perPage, $perPage);
        $data['popular'] = $news_model->getPopularNews();
        return view('sport', $data);
    }

     public function business()
    {
        $news_model = new NewsModel();
        $categoryModel = new NewsCategoryModel();


      

        $pager = \Config\Services::pager(); // Load the Pager service

        // 1. Get the full list of news. With the model fix, this list will now have a stable order.
        $allNews = $news_model->getNewsWithDetails('ቢዝነስ');

        $perPage = 2;
        $total = count($allNews);


        $page = $pager->getCurrentPage();

        // 4. Create the pagination links.
        $data['pager'] = $pager->makeLinks($page, $perPage, $total, 'bootstrap5_pagination');
        $data['bussiness'] = array_slice($allNews, ($page - 1) * $perPage, $perPage);
        $data['popular'] = $news_model->getPopularNews();
        return view('bussiness', $data);
    }
}
