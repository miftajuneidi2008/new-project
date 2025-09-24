<?php

namespace App\Controllers;

use App\Models\LogoModel;
use App\Models\NewsCategoryModel;
use App\Models\NewsModel;
use App\Models\ProgramCategoryModel;
use App\Models\ProgramModel;
use App\Models\SiteUrl;

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
    public function links()
    {
        return view('/admin/links');
    }
    public function siteLink()
    {
        return view('/admin/site_link');
    }
    public function create()
    {
        $model = new SiteUrl();
        $rules = [
            'link' => [
                'label' => 'URL Adress',
                // Corrected table name to 'program_categories'
                'rules' => "required|valid_url_strict|is_unique[site_url.url]",
                'errors' => [
                    'required' => 'The url {field} is required.',
                    'is_unique' => 'This url already exists. Please choose another.'
                ]
            ],
            'url_type' => [
                'label' => 'URL Type',
                // This rule ensures the submitted ID actually exists in the 'url_types' table.
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must select a URL type.',
                    'is_not_unique' => 'The selected URL type is not valid.'
                ]
            ],

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $link_type = $this->request->getPost('url_type');
        $link = $this->request->getPost('link');

        $data = [
            'url_type' => $link_type,
            'url' => $link,
            'user_id' => session()->get('userId'),
        ];

        $model->save($data);
        return redirect()->back()->with('success', 'Link added successfully.');

    }
    public function show_logo()
    {

        return view('admin/show_logo');
    }
    public function add_logo()
    {
        $logo_model = new LogoModel();
        $rules = [
            'url' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[url]', // Ensures a file was actually uploaded
                    'is_image[url]',
                    'mime_in[url,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[url,2048]', // Max size 2MB
                ],
            ],
        ];


        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('url');

        if ($img->isValid() && !$img->hasMoved()) {

            $newName = $img->getRandomName();


            $img->move(ROOTPATH . 'uploads', $newName);

            $data = [
                'url' => $newName,
                'user_id' => session()->get('userId'),
            ];



            if ($logo_model->save($data)) {
                return redirect()->to('/admin/site-link')->with('message', 'Logo created successfully.');
            }
        }
        // This case is for database errors, not validation errors.
        return redirect()->back()->withInput()->with('errors', ['database' => 'Failed to save the logo to the database.']);
    }
    
}