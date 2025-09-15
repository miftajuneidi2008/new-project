<?php

namespace App\Controllers;
use App\Models\NewsCategoryModel;
class NewsCategory extends BaseController
{ /**
  * Display a list of all news categories.
  */
    public function index()
    {
        $model = new NewsCategoryModel();
        $data['news_categories'] = $model->findAll();

        return view('admin/news_category/index', $data);
    }

    /**
     * Show the form for creating a new news category.
     */
    public function new()
    {
        return view('admin/news_category/new/index');
    }

    /**
     * Process the creation of a new news category.
     */
    public function create()
    {
        $model = new NewsCategoryModel();

        $rules = [
            'title' => [
                'label' => 'Title', // Human-readable name for the field
                'rules' => 'required|min_length[3]|max_length[255]|is_unique[news_categories.title]',
                'errors' => [
                    'required' => 'The category {field} is required.',
                    'is_unique' => 'This category title already exists. Please choose another.'
                ]
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'permit_empty|min_length[10]', // 'permit_empty' allows it to be optional
            ]

        ];

        if (!$this->validate($rules)) {
            // If validation fails, redirect back to the form with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $userId = session()->get('user_id');
        if (!$userId) {
            // Handle case where user is not logged in or session expired
            return redirect()->to('/login')->with('error', 'You must be logged in to create a category.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'user_id' => $userId,
            'description' => $this->request->getPost('description'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/admin/news_category')->with('message', 'News category created successfully.');
        } else {
            // This case is for database errors, not validation errors.
            return redirect()->back()->withInput()->with('errors', ['database' => 'Failed to save the category to the database.']);
        }
    }

    /**
     * Show the form for editing a news category.
     */
    public function edit($id = null)
    {
        $model = new NewsCategoryModel();
        $data['news_category'] = $model->find($id);

        return view('admin/news_category/edit', $data);
    }

    /**
     * Process the updating of a news category.
     */
    public function update($id = null)
    {
        $model = new NewsCategoryModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/admin/news_category')->with('message', 'News category updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    /**
     * Delete a news category.
     */
    public function delete($id = null)
    {
        $model = new NewsCategoryModel();

        if ($model->delete($id)) {
            return redirect()->to('/admin/news_category')->with('message', 'News category deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete news category.');
        }
    }

}
