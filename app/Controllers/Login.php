<?php

namespace App\Controllers;

use App\Models\User;
class Login extends BaseController
{
    protected $userModel;
    protected $googleClient;
    protected $session;

    public function __construct()
    {
         $this->session = \Config\Services::session();
        $this->userModel = new User();

        
        
        $this->googleClient = new \Google\Client();
        $this->googleClient->setClientId(env('google.client.id'));
        $this->googleClient->setClientSecret(env('google.client.secret'));
        $this->googleClient->setRedirectUri(env('google.redirect.uri'));
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
    }
    public function index(): string
    {
         $data['googleAuthUrl'] = $this->googleClient->createAuthUrl();
        return $this->render('login',$data);
    }

     public function gmailCallback()
    {
        $code = $this->request->getVar('code');

        if (!isset($code)) {
            return redirect()->to('/login')->with('error', 'Google login failed: No authorization code.');
        }

        try {
            $this->googleClient->fetchAccessTokenWithAuthCode($code);
            $accessToken = $this->googleClient->getAccessToken();

            if (isset($accessToken['error'])) {
                throw new \Exception($accessToken['error_description']);
            }

            $oAuth2 = new \Google\Service\Oauth2($this->googleClient);
            $userInfo = $oAuth2->userinfo->get();

            $email = $userInfo->getEmail();
            $name = $userInfo->getName();
            $avatar = $userInfo->getPicture();

            $user = $this->userModel->getUserByEmail($email);

            if ($user) {

              
                // User exists, log them in
                $this->session->set('isLoggedIn', true);
                $this->session->set('userId', $user['id']);
                $this->session->set('userName', $user['name']);
                $this->session->set('userEmail', $user['email']);
                $this->session->set('userRole', $user['role']);
                $this->session->set('userAvatar', $user['avatar']);

                log_message('debug', 'Session data set for existing user: ' . print_r($this->session->get(), true));


                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin')->with('success', 'Welcome Admin!');
                } else {
                    return redirect()->to('/')->with('success', 'Welcome ' . $user['name'] . '!');
                }
            } else {
                // New user, register them
           
                $newUser = [
                    'email' => $email,
                    'name'  => $name,
                    'avatar' => $avatar,
                    'role'  => 'user', // Default role for new users
                ];
                $this->userModel->insert($newUser);
                $newUserId = $this->userModel->getInsertID();

                $this->session->set('isLoggedIn', true);
                $this->session->set('userId', $newUserId);
                $this->session->set('userName', $name);
                $this->session->set('userEmail', $email);
                $this->session->set('userRole', 'user'); // Set default role
                $this->session->set('userAvatar', $avatar);

                return redirect()->to('/')->with('success', 'Welcome ' . $name . '! Your account has been created.');
            }

        } catch (\Exception $e) {
            log_message('error', 'Google login error: ' . $e->getMessage());
            return redirect()->to('/login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }

    public function news_login($id=null){
        
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }

}