<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('form_validation');
    }

    public function applyLeave() {

        $this->form_validation->set_rules('employeeCode', 'Employee Code', 'required|alpha_numeric');
        $this->form_validation->set_rules('fromDate', 'From Date', 'required');
        $this->form_validation->set_rules('toDate', 'To Date', 'required');
        $this->form_validation->set_rules('leaveType', 'Leave Type', 'required|integer');
        $this->form_validation->set_rules('comments', 'Comments', 'max_length[300]');
        
        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => 3,
                'data' => $this->form_validation->error_array(),
            ];
            echo json_encode($response);

        }else{

            
            $data = [
                'employee_id'   => $this->session->userdata('id'),
                'employee_code' => $this->input->post('employeeCode'),
                'from_date'     => $this->input->post('fromDate'),
                'to_date'       => $this->input->post('toDate'),
                'leave_type'    => $this->input->post('leaveType'),
                'comments'      => $this->input->post('comments'),
                'number_of_day' => calculateLeaveDays($this->input->post('fromDate'), $this->input->post('toDate')),
            ];
    
            $result = $this->UserModel->insertData('employee_leave_master', $data);
            if ($result) {
                echo json_encode([
                    'status' => 1,
                    'message' => 'Leave application submitted successfully!'
                ]);
            } else {
                echo json_encode([
                    'status' => 0,
                    'message' => 'Failed to submit leave application. Please try again.'
                ]);
            }
        }
    }

    public function leaveListing()
    {
        $leaveType = $this->db->get('leave_master')->result_array();
        
        if (!empty($leaveType)) {
            $query = "SELECT `lm`.`leave_type` AS leave_name, COUNT(`elm`.`leave_type`) AS leave_count 
                    FROM `employee_leave_master` `elm`
                    LEFT JOIN `leave_master` `lm` ON `elm`.`leave_type` = `lm`.`id`
                    WHERE `elm`.`employee_id` = " . $this->session->userdata('id') . "
                    GROUP BY `elm`.`leave_type`";

            $employeeLeave = $this->db->query($query)->result_array();

            if (!empty($employeeLeave)) {
                $labels = array_column($employeeLeave, 'leave_name');
                $data = array_column($employeeLeave, 'leave_count');
                $backgroundColor = [];

                foreach ($labels as $label) {
                    $backgroundColor[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }

                echo json_encode([
                    'status' => 1,
                    'data' => [
                        'labels' => $labels,
                        'datasets' => [
                            'label' => 'Leaves Taken',
                            'data' => $data,
                            'backgroundColor' => $backgroundColor,
                        ]
                    ],
                    'message' => 'Data found.'
                ]);
            } else {
                echo json_encode([
                    'status' => 0,
                    'data' => [
                        'labels' => [],
                        'datasets' => [
                            'label' => '',
                            'data' => [],
                            'backgroundColor' => [],
                        ]
                    ],
                    'message' => 'No data found.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 0,
                'message' => 'Leave type data not found.'
            ]);
        }
    }

    public function getLeaveHistory() {
        $employeeId = $this->session->userdata('id');
        
        // Join employee_leave_master with leave_master to get leave type name
        $this->db->select('elm.*, lm.leave_type AS leave_name');
        $this->db->from('employee_leave_master elm');
        $this->db->join('leave_master lm', 'elm.leave_type = lm.id', 'left');
        $this->db->where('elm.employee_id', $employeeId);
        $leaveHistory = $this->db->get()->result_array();
        
        if (!empty($leaveHistory)) {
            echo json_encode([
                'status' => 1,
                'data' => $leaveHistory,
            ]);
        } else {
            echo json_encode([
                'status' => 0,
                'message' => 'No leave history found.',
            ]);
        }
    }
    
}
