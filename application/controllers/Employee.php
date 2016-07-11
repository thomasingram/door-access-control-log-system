<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array(
            'session'
        ));

        $this->load->model('EmployeeModel');
    }

    public function clockInAndOut()
    {
        $this->load->library('form_validation');

        if ($this->input->post()) {
            if ($this->form_validation->run()) {
                $employee = $this->EmployeeModel->getEmployeeByDoorEntryCode($this->input->post('doorEntryCode'));

                if ($employee) {
                    if ($this->input->post('clockIn')) {
                        $isEmployeeNowClockedIn = $this->EmployeeModel->updateEmployeeClockStatus($employee->id, CLOCK_IN);

                        if ($isEmployeeNowClockedIn) {
                            $this->data['clockMessage'] = 'Clocked in at ' . date('H:i') . '.';
                        } else {
                            $this->data['clockError'] = 'You’re already clocked in – clock out before clocking in.';
                        }
                    } elseif ($this->input->post('clockOut')) {
                        $isEmployeeNowClockedOut = $this->EmployeeModel->updateEmployeeClockStatus($employee->id, CLOCK_OUT);

                        if ($isEmployeeNowClockedOut) {
                            $this->data['clockMessage'] = 'Clocked out at ' . date('H:i') . '.';
                        } else {
                            $this->data['clockError'] = 'You’re already clocked out.';
                        }
                    }
                } else {
                    $this->data['clockError'] = 'Unknown door entry code.';
                }
            }
        }

        $this->data['title'] = 'Clock in/out';

        $this->load->view('templates/header', $this->data);
        $this->load->view('employee/clockInAndOut', $this->data);
        $this->load->view('templates/footer');
    }
}
