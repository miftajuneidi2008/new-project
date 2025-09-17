<?php

namespace App\Controllers;
use App\Models\NewsModel;
use App\Models\NewsCategoryModel;


class News extends BaseController
{
    public function index()
    {
        $model = new NewsModel();
        $data['news'] = $model->getNewsWithDetails();

        return view('admin/news/index', $data);
    }

    /**
     * Show the form for creating a new news category.
     */
    public function new()
    {
        $category_Model = new NewsCategoryModel();
        $data['program_categories'] = $category_Model->findAll();
        return view('admin/news/new/index', $data);
    }


    public function create()
    {
        $news_model = new NewsModel();
        $session = session();
        $userId = $session->get('userId');
        $rules = [
            'title' => [
                'label' => 'Title',
                'rules' => 'required|min_length[3]|max_length[255]|is_unique[program_categories.title]',
                'errors' => [
                    'required' => 'The category title is required.',
                    'is_unique' => 'This category title already exists.'
                ]
            ],
            'news_category_id' => [
                'label' => 'News Category',
                // This rule ensures the submitted ID actually exists in the 'news_categories' table.
                'rules' => 'required|is_not_unique[news_categories.id]',
                'errors' => [
                    'required' => 'You must select a news category.',
                    'is_not_unique' => 'The selected news category is not valid.'
                ]
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[20]',
                'errors' => [
                    'required' => 'The description is required.',
                    'min_length' => 'The description must be at least 20 characters long.'
                ]
            ],
            'image' => [ // Rules for the OPTIONAL featured image
                'label' => 'Image File',
                'rules' => [
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[image,2048]', // Max size 2MB
                ],
            ],
        ];


        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('userId');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You must be logged in to create a category.');
        }

        $img = $this->request->getFile('image');

        if ($img->isValid() && !$img->hasMoved()) {

            $newName = $img->getRandomName();


            $img->move(ROOTPATH . 'uploads', $newName);

            $dirtyHTML = $this->request->getPost('description');

            $config = \HTMLPurifier_Config::createDefault();
            // A safe set of allowed HTML tags and attributes
            $config->set('HTML.Allowed', 'p,b,strong,i,em,ul,ol,li,a[href],br,h1,h2,h3,h4,h5,h6');

            $purifier = new \HTMLPurifier($config);
            $cleanHTML = $purifier->purify($dirtyHTML);

            $data = [
                'title' => $this->request->getPost('title'),
                'user_id' => $userId,
                'category_id' => $this->request->getPost('news_category_id'),
                'photo' => $newName,
                'description' => $cleanHTML,
            ];

            if ($news_model->save($data)) {
                return redirect()->to('/admin/news/new')->with('message', 'News  created successfully.');
            }
        }
        // This case is for database errors, not validation errors.
        return redirect()->back()->withInput()->with('errors', ['database' => 'Failed to save the news to the database.']);


    }

    /**
     * Show the form for editing a news category.
     */
    public function edit($id = null)
    {
        $model = new NewsModel();
        $categoryModel = new NewsCategoryModel();
        $data['news_categories'] = $categoryModel->findAll();
        $data['news'] = $model->find($id);

        return view('admin/news/edit/index', $data);
    }


    public function update($id = null)
    {
        $model = new NewsModel();

        // 1. First, fetch the existing record from the database.
        // This is crucial for getting the old image filename to delete it later.
        $programCategory = $model->find($id);
        if (!$programCategory) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 2. Define all validation rules, including for the optional image.
        $rules = [
            'title' => [
                'label' => 'Title',
                // Corrected table name to 'program_categories'
                'rules' => "required|min_length[3]|max_length[255]|is_unique[program_categories.title,id,{$id}]",
                'errors' => [
                    'required' => 'The category {field} is required.',
                    'is_unique' => 'This category title already exists. Please choose another.'
                ]
            ],
            'news_category_id' => [
                'label' => 'News Category',
                // This rule ensures the submitted ID actually exists in the 'news_categories' table.
                'rules' => 'required|is_not_unique[news_categories.id]',
                'errors' => [
                    'required' => 'You must select a news category.',
                    'is_not_unique' => 'The selected news category is not valid.'
                ]
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'permit_empty', // Simplified rule: min_length conflicts with permit_empty
            ],
            'image' => [ // Validation for the optional new image
                'label' => 'Image File',
                'rules' => [
                    // These rules ONLY run if a file has been uploaded.
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[image,2048]',
                ],
            ],
        ];


        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $dirtyHTML = $this->request->getPost('description');

        $config = \HTMLPurifier_Config::createDefault();
        // A safe set of allowed HTML tags and attributes
        $config->set('HTML.Allowed', 'p,b,strong,i,em,ul,ol,li,a[href],br,h1,h2,h3,h4,h5,h6');

        $purifier = new \HTMLPurifier($config);
        $cleanHTML = $purifier->purify($dirtyHTML);
        // 4. Prepare the text data for update.
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $cleanHTML,
            'news_category_id' => $this->request->getPost('news_category_id')
        ];

        // 5. Handle the optional file upload.
        $img = $this->request->getFile('image');

        // This condition is only true if the user selected a new file to upload.
        if ($this->request->getFile('image') && $img->isValid() && !$img->hasMoved()) {

            // a. Get the old image's filename from the record we fetched earlier.
            $oldImage = $programCategory['photo']; // Assuming 'image' is your DB column name

            // b. If an old image exists, delete it from the server.
            if ($oldImage && file_exists(ROOTPATH . 'uploads/' . $oldImage)) {
                unlink(ROOTPATH . 'uploads/' . $oldImage);
            }

            // c. Upload the new image.
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'uploads', $newName);

            // d. Add the new image's filename to our data array for saving.
            $data['photo'] = $newName;
        }

        // 6. Perform the database update.
        // The $data array will contain the new image filename ONLY if one was uploaded.
        if ($model->update($id, $data)) {
            // Redirect to the correct list page.
            return redirect()->to('/admin/news/')->with('message', 'Program category updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }


    public function delete($id = null)
    {
        log_message('debug', 'image found: ' . print_r(12, return: true)); // Check $user data

        $model = new NewsModel();
        $old_data = $model->find($id);
        ;
        $oldImage = $old_data['photo'];

        if ($oldImage && file_exists(ROOTPATH . 'uploads/' . $oldImage)) {
            unlink(ROOTPATH . 'uploads/' . $oldImage);
        }


        if ($model->delete($id)) {
            return redirect()->to('/admin/news')->with('message', 'News deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete program category.');
        }
    }



}
