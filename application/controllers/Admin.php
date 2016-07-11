<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array(
            'session'
        ));

        $this->load->model('EmployeeModel');
    }

    public function clockTimesReport()
    {
        if (!$this->session->isAuthorized) {
            redirect('/');
        }

        $this->data['employees'] = $this->EmployeeModel->getAllEmployeesClockTimes();

        $this->data['title'] = 'Clock times';

        $this->load->view('templates/header', $this->data);
        $this->load->view('admin/clockTimesReport', $this->data);
        $this->load->view('templates/footer');
    }

    public function createEmployee()
    {
        $this->load->library('form_validation');

        if (!$this->session->isAuthorized) {
            redirect('/');
        }

        if ($this->input->post('createEmployee')) {
            if ($this->form_validation->run()) {
                $employee = $this->EmployeeModel->createEmployee(array(
                    'first_name' => $this->input->post('firstName'),
                    'last_name' => $this->input->post('lastName')
                ));

                if ($employee) {
                    $this->data['successMessage'] = "The employee {$employee->first_name} {$employee->last_name} has been created. Their door entry code is {$employee->door_entry_code}.";
                }
            }
        }

        $this->data['title'] = 'Create employee';

        $this->load->view('templates/header', $this->data);
        $this->load->view('admin/createEmployee', $this->data);
        $this->load->view('templates/footer');
    }

    public function dashboard()
    {
        if (!$this->session->isAuthorized) {
            redirect('/');
        }

        $this->data['title'] = 'Dashboard';

        $this->load->view('templates/header', $this->data);
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }

    public function employeeAverageWorkingTimeReport()
    {
        if (!$this->session->isAuthorized) {
            redirect('/');
        }

        $startDate = new DateTime('2016-01-01');
        $endDate = new DateTime();

        $this->data['employees'] = $this->EmployeeModel->calculateEmployeeAverageWorkingTimeBetweenDates($startDate, $endDate);

        $this->data['title'] = 'Employee average working time';
        $this->data['startDate'] = $startDate->getTimestamp();
        $this->data['endDate'] = $endDate->getTimestamp();

        $this->load->view('templates/header', $this->data);
        $this->load->view('admin/employeeAverageWorkingTimeReport', $this->data);
        $this->load->view('templates/footer');
    }

    public function employeePunctualityReport()
    {
        if (!$this->session->isAuthorized) {
            redirect('/');
        }

        $startDate = new DateTime('2016-01-01');
        $endDate = new DateTime();

        $this->data['employees'] = $this->EmployeeModel->calculateEmployeePunctualityBetweenDates($startDate, $endDate);

        $this->data['title'] = 'Employee punctuality';
        $this->data['startDate'] = $startDate->getTimestamp();
        $this->data['endDate'] = $endDate->getTimestamp();

        $this->load->view('templates/header', $this->data);
        $this->load->view('admin/employeePunctualityReport', $this->data);
        $this->load->view('templates/footer');
    }

    public function employeesClockedInReport()
    {
        if (!$this->session->isAuthorized) {
            redirect('/');
        }

        $this->data['employees'] = $this->EmployeeModel->getAllEmployeesClockedIn();

        $this->data['title'] = 'Employees clocked in';

        $this->load->view('templates/header', $this->data);
        $this->load->view('admin/employeesClockedInReport', $this->data);
        $this->load->view('templates/footer');
    }
}
