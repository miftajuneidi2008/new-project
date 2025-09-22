<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CommentModel;
class Comment extends BaseController
{  public function delete($id = null)
    {
        $commentModel = new CommentModel();
        $comment = $commentModel->find($id);

        // Security Check: Is the user logged in?
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must be logged in.');
        }

        // Security Check: Is user an admin OR the owner of the comment?
        if (session()->get('userRole') !== 'admin' && session()->get('userId') != $comment['user_id']) {
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }
        
        // If checks pass, delete the comment
        $commentModel->delete($id);
        
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    public function update($id = null)
{
    // Validation rules
    $rules = [ 'comment' => 'required|min_length[3]' ];
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Security Check: User must be the owner
    $commentModel = new CommentModel();
    $comment = $commentModel->find($id);
    if (!$comment || $comment['user_id'] != session()->get('userId')) {
        return redirect()->back()->with('error', 'You do not have permission to do this.');
    }
    
    // Update the data in the database
    $commentModel->update($id, ['comment' => $this->request->getPost('comment')]);
    
    // Redirect back with a success message
    return redirect()->back()->with('message', 'Comment updated successfully.');
}
}
