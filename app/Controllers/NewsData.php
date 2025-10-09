<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AddsModel;
use App\Models\NewsCategoryModel;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CommentModel;

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
        return $this->render('news', $data);
    }


    public function show($id = null)
    {
        $news_model = new NewsModel();
        $adds_model = new AddsModel();

        // Fetch the single news article from the model
        $news_model->incrementViewCount($id);
        $news_data = $news_model->getNewsDetailsById((int) $id);


        if (empty($news_data)) {
            // This is the standard CodeIgniter way to show a 404 error page
            throw new PageNotFoundException('The page you are looking for is not found.');
        }

        $data['news'] = $news_data;
        $data['popular'] = $news_model->getPopularNews($id);
        $data['adds'] = $adds_model->findAll();

        return $this->render('news_detail', $data);
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
        return $this->render('sport', $data);
    }

    public function business()
    {
        $news_model = new NewsModel();
        $adds_model = new AddsModel();
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
        $data['adds'] = $adds_model->findAll();
        return $this->render('bussiness', $data);
    }

    public function create($id = null)
    {

        $comment_model = new CommentModel();
        $session = session();
        $rules = [
            'comment' => [
                'label' => 'Comment', // Human-readable name for the field
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'The {field} is required.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $userId = $session->get('userId');
        $comment = $this->request->getPost('comment');
        $data = [
            'news_id' => $id,
            'user_id' => $userId,
            'comment' => $comment
        ];

        if ($userId) {
            // Save the comment to the database
            $comment_model->save($data);
            return redirect()->to("/news/$id")->with('message', 'Comment added successfully.');
        }

        return redirect()->to("/news/$id")->with('error', 'Failed to add comment.');
    }

}