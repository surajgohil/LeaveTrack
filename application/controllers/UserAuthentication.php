<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuthentication extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function signUp(){

        $this->form_validation->set_rules('employee_code', 'Employee Code', 'required|alpha_numeric|min_length[3]|max_length[10]|is_unique[users.employee_code]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[20]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[10]|max_length[200]');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('zip', 'ZIP Code', 'required|numeric|min_length[5]|max_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => 3,
                'data' => $this->form_validation->error_array(),
            ];
        } else {

            $data = $this->input->post();
            $insertData = [
                'employee_name' => $data['first_name'].' '.$data['last_name'],
                'employee_code' => $data['employee_code'],
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'username'      => $data['username'],
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'password'      => password_hash($data['password'], PASSWORD_BCRYPT),
                'address'       => $data['address'],
                'country'       => $data['country'],
                'state'         => $data['state'],
                'city'          => $data['city'],
                'zip'           => $data['zip'],
            ];
            $this->load->model('UserModel');
            if ($this->UserModel->insertData('users', $insertData)) {
                $response = [
                    'status' => 1,
                    'data' => [
                        'redirectUrl' => base_url().'signIn',
                    ],
                    'message' => 'Registration successful!',
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => 'Failed to register. Please try again.',
                ];
            }
        }

        echo json_encode($response);
    }

    public function signIn() {

        $this->form_validation->set_rules('identifier', 'Email or Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {

            $response = [
                'status' => 'error',
                'message' => validation_errors()
            ];
            echo json_encode($response);
            return;
        }

        $identifier = $this->input->post('identifier');
        $password = $this->input->post('password');

        $this->load->model('UserModel');
        $user = $this->UserModel->getUserByIdentifier($identifier);

        if ($user) {
            if (password_verify($password, $user['password'])) {

                $response = [
                    'status' => 1,
                    'data' => [
                        'redirectUrl' => base_url().'home',
                    ],
                    'message' => 'Login successful'
                ];
                unset($user['password']);
                
                $this->session->set_userdata([
                    'id' => $user['id'],
                    'employee_name' => $user['employee_name'],
                    'employee_code' => $user['employee_code'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'address' => $user['address'],
                    'country' => $user['country'],
                    'state' => $user['state'],
                    'city' => $user['city'],
                    'zip' => $user['zip'],
                ]);

            } else {

                $response = [
                    'status' => 0,
                    'message' => 'Invalid password'
                ];
            }

            echo json_encode($response);

        } else {

            $response = [
                'status' => 0,
                'message' => 'User not found'
            ];
            echo json_encode($response);
        }
    }
}
