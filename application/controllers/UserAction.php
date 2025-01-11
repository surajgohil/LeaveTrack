<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAction extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }

	public function index() {
		$userId = $this->session->userdata('id');
		if($userId > 0){
			$this->load->view('header');
			$data['data'] = $this->db->where('employee_id', $this->session->userdata('id'))->get('employee_leave_master')->result_array();
			$this->load->view('home',  $data);
			$this->load->view('footer');
		}else{
			$this->load->view('signIn');
		}
	}

	public function applyLeave(){
		$userId = $this->session->userdata('id');
		if($userId > 0){
			$this->load->view('header');
			$data['data'] = $this->db->get('leave_master')->result_array();
			$this->load->view('applyLeave',  $data);
			$this->load->view('footer');
		}else{
			$this->load->view('signIn');
		}
	}

	public function leaveReporting(){
		$userId = $this->session->userdata('id');
		if($userId > 0){
			$this->load->view('header');
			$this->load->view('leaveReporting');
			$this->load->view('footer');
		}else{
			$this->load->view('signIn');
		}
	}

	public function dashboard(){
		$userId = $this->session->userdata('id');
		if($userId > 0){
			$this->load->view('header');
			$this->load->view('dashboard');
			$this->load->view('footer');
		}else{
			$this->load->view('signIn');
		}
	}

	public function signIn(){
		$this->load->view('signIn');
	}

	public function signUp(){
		$this->load->view('signUp');
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->load->view('signIn');
	}
}
