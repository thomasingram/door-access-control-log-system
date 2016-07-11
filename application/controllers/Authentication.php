<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array(
            'session'
        ));

        $this->load->model('UserModel');
    }

    public function login()
    {
        $this->load->library('form_validation');

        if ($this->session->isAuthorized) {
            redirect('/admin/dashboard');
        }

        if ($this->input->post('login')) {
            if ($this->form_validation->run()) {
                $foundUser = $this->UserModel->getLoginUser(
                    $this->input->post('email'),
                    $this->input->post('password')
                );

                if ($foundUser) {
                    $this->session->isAuthorized = true;

                    redirect('/admin/dashboard');
                }

                $this->data['loginError'] = 'Incorrect email or password.';
            }
        }

        $this->data['title'] = 'Login';

        $this->load->view('templates/header', $this->data);
        $this->load->view('authentication/login', $this->data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        $this->session->isAuthorized = false;

        redirect('/login');
    }
}
