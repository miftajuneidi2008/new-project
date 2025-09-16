<?php

namespace App\Controllers;
use App\Models\ProgramCategoryModel;

class ProgramCategory extends BaseController
{/**
 * Display a list of all news categories.
 */
    public function index()
    {
        $model = new ProgramCategoryModel();
        $data['program_categories'] = $model->findAll();

        return view('admin/program_category/index', $data);
    }

    /**
     * Show the form for creating a new news category.
     */
    public function new()
    {
        return view('admin/program_category/new/index');
    }


    public function create()
    {
        $model = new ProgramCategoryModel();
        $session = session();
        $userId = $session->get('userId');
        $rules = [
            'title' => [
                'label' => 'Title', // Human-readable name for the field
                'rules' => 'required|min_length[3]|max_length[255]|is_unique[news_categories.title]',
                'errors' => [
                    'required' => 'The category {field} is required.',
                    'is_unique' => 'This category title already exists. Please choose another.'
                ]
            ],
            'image' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[image]',
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[image,2048]', // Max size is 2048 KB (2MB)
                ],
            ],


            'description' => [
                'label' => 'Description',
                'rules' => 'permit_empty|min_length[10]', // 'permit_empty' allows it to be optional
            ]

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

            $data = [
                'title' => $this->request->getPost('title'),
                'user_id' => $userId,
                'photo' => $newName,
                'description' => $this->request->getPost('description'),
            ];

            if ($model->save($data)) {
                return redirect()->to('/admin/program_category/new')->with('message', 'News category created successfully.');
            }
        }
        // This case is for database errors, not validation errors.
        return redirect()->back()->withInput()->with('errors', ['database' => 'Failed to save the category to the database.']);

    }

    /**
     * Show the form for editing a news category.
     */
    public function edit($id = null)
    {
        $model = new ProgramCategoryModel();
        $data['program_category'] = $model->find($id);

        return view('admin/program_category/edit/index', $data);
    }

    /**
     * Process the updating of a news category.
     */
    public function update($id = null)
    {
        $model = new ProgramCategoryModel();

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

        // 4. Prepare the text data for update.
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
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
            return redirect()->to('/admin/program_category')->with('message', 'Program category updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }


    public function delete($id = null)
    {
        $model = new ProgramCategoryModel();
        $old_data = $model->find($id);
        $oldImage = $old_data['photo'];

        if ($oldImage && file_exists(ROOTPATH . 'uploads/' . $oldImage)) {
            unlink(ROOTPATH . 'uploads/' . $oldImage);
        }


        if ($model->delete($id)) {
            return redirect()->to('/admin/program_category')->with('message', 'News category deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete program category.');
        }
    }

}
