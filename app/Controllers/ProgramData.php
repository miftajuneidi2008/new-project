<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AddsModel;
use App\Models\CommentModel;
use App\Models\ProgramCategoryModel;
use App\Models\ProgramComment;
use App\Models\ProgramModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class ProgramData extends BaseController
{
    public function index()
    {
        $program_model = new ProgramCategoryModel();
        $data['program_category'] = $program_model->findAll();
        return $this->render('program', $data);
    }
    public function show($id)
    {
        $program_model = new ProgramModel();
        $program_category_model = new ProgramCategoryModel();
        $adds_model = new AddsModel();


        // Fetch the single news article from the model
        $pager = \Config\Services::pager();


        $data['program_list'] = $program_model->getNewsPostDetails((int) $id);
        $data['program_name'] = $program_category_model->find($id);
        $data['adds'] = $adds_model->findAll();

        $perPage = 3;
        $total = count($data['program_list']);


        $page = $pager->getCurrentPage();


        $data['pager'] = $pager->makeLinks($page, $perPage, $total, 'bootstrap5_pagination');


        $data['program_list'] = array_slice($data['program_list'], ($page - 1) * $perPage, $perPage);
        $data['popular'] = $program_model->getPopularPost();

        return $this->render('program_list', $data);
    }
    public function program_details($id)
    {
        $program_model = new ProgramModel();

        // Fetch the single news article from the model
        $program_model->incrementViewCount($id);
        $program_data = $program_model->getProgramDetailsById((int) $id);


        if (empty($program_data)) {
            // This is the standard CodeIgniter way to show a 404 error page
            throw new PageNotFoundException('The page you are looking for is not found.');
        }

        $data['program'] = $program_data;
        log_message('info', 'Program Data: ' . print_r($data['program'], true));
        $data['popular'] = $program_model->getPopularPrograms($id);

        return $this->render('program_details', $data);
    }

    public function create($id = null)
    {

        $comment_model = new ProgramComment();
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
        log_message('info', 'Program ID: ' . $this->request->getPost('comment'));
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $userId = $session->get('userId');
        $comment = $this->request->getPost('comment');
        $data = [
            'program_id' => $id,
            'user_id' => $userId,
            'comment' => $comment
        ];

        if ($userId) {
            // Save the comment to the database
            $comment_model->save($data);
            return redirect()->to("/post/$id")->with('message', 'Comment added successfully.');
        }

        return redirect()->to("/post/$id")->with('error', 'Failed to add comment.');
    }
}
