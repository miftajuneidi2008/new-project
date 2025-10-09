<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;
use CodeIgniter\HTTP\ResponseInterface;

class Schedule extends BaseController
{
    public function index()
    {
        $schedule_model = new ScheduleModel();
        $data['schedules'] = $schedule_model->findAll();
        return view('admin/schedule/index', $data);
    }
    public function create()
    {
        $schedule_model = new ScheduleModel();
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

        if ($schedule_model->save($data)) {
            return redirect()->to('/admin/schedule/')->with('message', 'መርሐግብር በተሳካ ሁኔታ ተቀምጧል');
        }

        // This case is for database errors, not validation errors.
        return redirect()->back()->withInput()->with('errors', ['database' => 'መርሐ ግብሩን ወደ የውሂብ ጎታ ማስቀመጥ አልተሳካም።']);


    }
    public function delete($id = null)
    {
        $scheduleModel = new ScheduleModel();

        // Security Check: Is the user logged in?
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        // Security Check: Is user an admin OR the owner of the comment?
        if (session()->get('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }

        // If checks pass, delete the comment
        $scheduleModel->delete($id);

        return redirect()->back()->with('success', '
መርሐግብር በተሳካ ሁኔታ ተሰርዟል።');
    }

    public function edit($id = null)
    {
        $scheduleModel = new ScheduleModel();

        // Security Check: Is the user logged in?
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        // Security Check: Is user an admin OR the owner of the comment?
        if (session()->get('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }
        $data['schedule'] = $scheduleModel->find($id);
        if (empty( $data['schedule'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Schedule item not found: ' . $id);
        }
        return view('admin/schedule/edit/index', $data);
    }
    public function update($id = null)
    {
        $scheduleModel = new ScheduleModel();

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

        if ($scheduleModel->update($id, $data)) { 
            // Redirect to the correct list page.
            return redirect()->to(uri:  '/admin/schedule/'.$id. '/edit')->with('message', 'መርሐግብር በተሳካ ሁኔታ ዘምኗል።');
        } else {
            return redirect()->back()->withInput()->with('errors', $scheduleModel->errors());
        }
    }
}
