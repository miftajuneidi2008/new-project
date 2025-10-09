<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AddsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Adds extends BaseController
{
    public function index()
    {
        $adds_model = new AddsModel();
        $data['adds'] = $adds_model->findAll();
        return view('admin/adds/index', $data);
    }
    public function create()
    {
        $adds_model = new AddsModel();
        $rules = [
            'photo' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[photo]', // Ensures a file was actually uploaded
                    'is_image[photo]',
                    'mime_in[photo,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[photo,2048]', // Max size 2MB
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

        $img = $this->request->getFile('photo');

        if ($img->isValid() && !$img->hasMoved()) {

            $newName = $img->getRandomName();


            $img->move(ROOTPATH . 'uploads', $newName);

            $data = [
                'photo' => $newName,
            ];



            if ($adds_model->save($data)) {
                return redirect()->to('/admin/adds')->with('message', 'ማስታወቂያ በተሳካ ሁኔታ ተቀምጧል።');
            }
        }
        // This case is for database errors, not validation errors.
        return redirect()->back()->withInput()->with('errors', ['database' => 'ማስታወቂያውን ወደ የውሂብ ጎታ ማስቀመጥ አልተሳካም።']);
    }
    public function update_add($id = null)
    {
        $adds_model = new AddsModel();
        $adds = $adds_model->find($id);
        log_message('debug', message: 'image received: ' . $id); // 

        if (!$adds) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'photo' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[photo]', // Ensures a file was actually uploaded
                    'is_image[photo]',
                    'mime_in[photo,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[photo,2048]', // Max size 2MB
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
        $img = $this->request->getFile('photo');

        if ($this->request->getFile('photo') && $img->isValid() && !$img->hasMoved()) {

            // a. Get the old image's filename from the record we fetched earlier.
            $oldImage = $adds['photo']; // Assuming 'image' is your DB column name

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

        if ($adds_model->update($id, $data)) {
            // Redirect to the correct list page.
            return redirect()->to('/admin/adds/')->with('message', '
ማስታወቂያ በተሳካ ሁኔታ ዘምኗል');
        } else {
            return redirect()->back()->withInput()->with('errors', $adds_model->errors());
        }


    }
    public function delete_add($id = null)
    {

        $adds_model = new AddsModel();
        $adds = $adds_model->find($id);

        $userId = session()->get('userId');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You must be logged in to create a category.');
        }

        if (!$adds) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $oldImage = $adds['photo'];

        if ($oldImage && file_exists(ROOTPATH . 'uploads/' . $oldImage)) {
            unlink(ROOTPATH . 'uploads/' . $oldImage);
        }


        if ($adds_model->delete($id)) {
            return redirect()->to('/admin/adds')->with('message', 'ማስታወቂያ በተሳካ ሁኔታ ተሰርዟል።');
        } else {
            return redirect()->back()->with('errors', '
ማስታወቂያ መሰረዝ አልተሳካም።');
        }


    }
}
