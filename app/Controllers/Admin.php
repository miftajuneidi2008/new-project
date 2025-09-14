<?php

namespace App\Controllers;

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
        $data['userName'] = session()->get('userName');
        $data['userEmail'] = session()->get('userEmail');
        $data['userRole'] = session()->get('userRole');
        $data['userAvatar'] = session()->get('userAvatar');
        return view('/admin/index', $data); 
    }
}