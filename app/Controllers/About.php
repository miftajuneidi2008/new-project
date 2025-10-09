<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use CodeIgniter\HTTP\ResponseInterface;

class About extends BaseController
{
    public function index()
    {
        $about_model = new AboutModel();
        $data['about'] = $about_model->findAll();
        return view('admin/about/index', $data);
    }
    public function create()
    {
        $about_model = new AboutModel();
        $session = session();
        $userId = $session->get('userId');
        $rules = [

            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[20]',
                'errors' => [
                    'required' => 'The description is required.',
                    'min_length' => 'The description must be at least 20 characters long.'
                ]
            ],

        ];


        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('userId');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You must be logged in to create a category.');
        }





        $dirtyHTML = $this->request->getPost('description');

        $config = \HTMLPurifier_Config::createDefault();
        // A safe set of allowed HTML tags and attributes
        $config->set('HTML.Allowed', 'p,b,strong,i,em,ul,ol,li,a[href],br,h1,h2,h3,h4,h5,h6');

        $purifier = new \HTMLPurifier($config);
        $cleanHTML = $purifier->purify($dirtyHTML);

        $data = [
            'description' => $cleanHTML,
        ];

        if ($about_model->save($data)) {
            return redirect()->to('/admin/about/')->with('message', 'መረጃዉ በተሳካ ሁኔታ ተቀምጧል');
        }

        // This case is for database errors, not validation errors.
        return redirect()->back()->withInput()->with('errors', ['database' => 'መረጃዉ ወደ የውሂብ ጎታ ማስቀመጥ አልተሳካም።']);


    }
    public function delete($id = null)
    {
        $about_model = new AboutModel();

        // Security Check: Is the user logged in?
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        // Security Check: Is user an admin OR the owner of the comment?
        if (session()->get('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }

        // If checks pass, delete the comment
        $about_model->delete($id);

        return redirect()->back()->with('success', '
መረጃዉ በተሳካ ሁኔታ ተሰርዟል።');
    }

    public function edit($id = null)
    {
        $about_model = new AboutModel();

        // Security Check: Is the user logged in?
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        // Security Check: Is user an admin OR the owner of the comment?
        if (session()->get('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }
        $data['about'] = $about_model->find($id);
        if (empty($data['about'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Schedule item not found: ' . $id);
        }
        return view('admin/about/edit/index', $data);
    }
    public function update($id = null)
    {
        $about_model = new AboutModel();

        // Security Check: Is the user logged in?
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        // Security Check: Is user an admin OR the owner of the comment?
        if (session()->get('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }

        $rules = [

            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[20]',
                'errors' => [
                    'required' => 'The description is required.',
                    'min_length' => 'The description must be at least 20 characters long.'
                ]
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

        $data = [
            'description' => $cleanHTML,
        ];

        if ($about_model->update($id, $data)) {
            // Redirect to the correct list page.
            return redirect()->to(uri: '/admin/about/' . $id . '/edit')->with('message', 'መረጃዉ በተሳካ ሁኔታ ዘምኗል።');
        } else {
            return redirect()->back()->withInput()->with('errors', $about_model->errors());
        }
    }
}
