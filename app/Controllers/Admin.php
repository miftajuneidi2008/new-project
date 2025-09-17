<?php

namespace App\Controllers;

use App\Models\NewsCategoryModel;
use App\Models\NewsModel;
use App\Models\ProgramCategoryModel;
use App\Models\ProgramModel;

class Admin extends BaseController
{

    public function __construct()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        // If user is admin, redirect from regular dashboard
        if (session()->get('userRole') === 'admin') {
            return redirect()->to('/admin/index');
        }
    }
    public function index(): string
    {
        $news_model = new NewsModel();
        $program_model = new ProgramModel();
        $program_category = new ProgramCategoryModel();
        $news_category = new NewsCategoryModel();
        $news_model = new NewsModel();
        $data['userName'] = session()->get('userName');
        $data['userEmail'] = session()->get('userEmail');
        $data['userRole'] = session()->get('userRole');
        $data['userAvatar'] = session()->get('userAvatar');
        $data['news'] = $news_model->countAll();
        $data['program'] = $program_model->countAll();
        $data['program_category'] = $program_category->countAll();
        $data['news_category'] = $news_category->countAll();
        return view('/admin/index', $data);
    }
}