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
        $logo_model = new LogoModel();
        $links_model = new SiteUrl();
        $data['logo'] = $logo_model->findAll();
        $data['audio'] = $links_model->getAudio();
        $data['video'] = $links_model->getVideo();
        return view('/admin/links', $data);
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


    public function update_logo($id = null)
    {
        $logo_model = new LogoModel();
        $logo = $logo_model->find($id);
        log_message('debug', message: 'image received: ' . $id); // 

        if (!$logo) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'logo' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[logo]', // Ensures a file was actually uploaded
                    'is_image[logo]',
                    'mime_in[logo,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[logo,2048]', // Max size 2MB
                ],
            ],
        ];


        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $img = $this->request->getFile('logo');

        if ($this->request->getFile('logo') && $img->isValid() && !$img->hasMoved()) {

            // a. Get the old image's filename from the record we fetched earlier.
            $oldImage = $logo['url']; // Assuming 'image' is your DB column name

            // b. If an old image exists, delete it from the server.
            if ($oldImage && file_exists(ROOTPATH . 'uploads/' . $oldImage)) {
                unlink(ROOTPATH . 'uploads/' . $oldImage);
            }

            // c. Upload the new image.
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'uploads', $newName);

            // d. Add the new image's filename to our data array for saving.
            $data['url'] = $newName;
        }

        if ($logo_model->update($id, $data)) {
            // Redirect to the correct list page.
            return redirect()->to('/admin/links/')->with('message', 'Program category updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $logo_model->errors());
        }


    }

    public function delete_link($id = null)
    {
        $linkModel = new SiteUrl();

        // Security Check: Is the user logged in?
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        // Security Check: Is user an admin OR the owner of the comment?
        if (session()->get('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }

        // If checks pass, delete the comment
        $linkModel->delete($id);

        return redirect()->back()->with('success', 'link deleted successfully.');
    }


    public function update_link($id = null)
    {
        // Validation rules
        log_message('debug', message: 'ID received: ' . ($id ?? 'null')); // 

        $rules = [
            'link' => [
                'label' => 'URL Adress',
                // Corrected table name to 'program_categories'
                'rules' => "required|valid_url_strict|is_unique[site_url.url]",
                'errors' => [
                    'required' => 'The url {field} is required.',
                    'is_unique' => 'This url already exists. Please choose another.'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Security Check: User must be the owner
        $linkModel = new SiteUrl();
        $link = $linkModel->find($id);
        if (!$link || session()->get('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to do this.');
        }

        // Update the data in the database
        $linkModel->update($id, ['url' => $this->request->getPost('link')]);

        // Redirect back with a success message
        return redirect()->back()->with('message', 'link updated successfully.');
    }

}