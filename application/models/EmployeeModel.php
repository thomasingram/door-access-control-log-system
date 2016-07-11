<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{
    /**
     * @param  DateTime $startDate
     * @param  DateTime $endDate
     * @return array
     */
    public function calculateEmployeeAverageWorkingTimeBetweenDates(DateTime $startDate, DateTime $endDate)
    {
        $endOfEndDate = clone $endDate;
        $endOfEndDate->setTime(23, 59, 59);

        $employees = $this->getAllEmployees();

        foreach ($employees as $employee) {
            $averageHoursPerDay = 0;
            $numberOfDays = 0;
            $totalHours = 0;

            $date = clone $startDate;
            $date->setTime(0, 0, 0);

            while ($date < $endOfEndDate) {
                $clockTimes = $this->getEmployeeClockTimesBetweenDates($employee->id, $date, $date);

                if ($clockTimes) {
                    for ($i = 0; $i < count($clockTimes['clockInTimes']); $i++) {
                        if (!isset($clockTimes['clockOutTimes'][$i])) {
                            break;
                        }

                        $clockInTime = $clockTimes['clockInTimes'][$i];
                        $clockOutTime = $clockTimes['clockOutTimes'][$i];

                        $totalHours += (strtotime($clockOutTime) - strtotime($clockInTime)) / 3600;
                    }

                    $numberOfDays++;
                }

                $date->add(new DateInterval('P1D'));
            }

            if ($numberOfDays > 0) {
                $averageHoursPerDay = $totalHours / $numberOfDays;
            }

            $employee->averageHoursPerDay = $averageHoursPerDay;
            $employee->totalHours = $totalHours;
        }

        return $employees;
    }

    /**
     * @param  DateTime $startDate
     * @param  DateTime $endDate
     * @return array
     */
    public function calculateEmployeePunctualityBetweenDates(DateTime $startDate, DateTime $endDate)
    {
        $endOfEndDate = clone $endDate;
        $endOfEndDate->setTime(23, 59, 59);

        $employees = $this->getAllEmployees();

        foreach ($employees as $employee) {
            $lateForWork = 0;
            $leftWorkEarly = 0;

            $date = clone $startDate;
            $date->setTime(0, 0, 0);

            while ($date < $endOfEndDate) {
                $clockTimes = $this->getEmployeeClockTimesBetweenDates($employee->id, $date, $date);

                if ($clockTimes) {
                    $firstClockInTime = array_shift($clockTimes['clockInTimes']);

                    if (strtotime($firstClockInTime) > strtotime(WORK_START_TIME)) {
                        $lateForWork++;
                    }

                    if (count($clockTimes['clockOutTimes']) > 0) {
                        $lastClockOutTime = array_pop($clockTimes['clockOutTimes']);

                        if (strtotime($lastClockOutTime) < strtotime(WORK_END_TIME)) {
                            $leftWorkEarly++;
                        }
                    }
                }

                $date->add(new DateInterval('P1D'));
            }

            $employee->lateForWork = $lateForWork;
            $employee->leftWorkEarly = $leftWorkEarly;
        }

        return $employees;
    }

    /**
     * @return string
     */
    private function createDoorEntryCode()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $doorEntryCode = '';
        for ($i = 0; $i < 6; $i++) {
            $doorEntryCode .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $doorEntryCode;
    }

    /**
     * @param  array        $employee
     * @return object|false
     *
     * Expects 2 items:
     * - 'first_name'
     * - 'last_name'
     */
    public function createEmployee(array $employee)
    {
        $this->db->insert('dacls_employee', [
            'first_name' => $employee['first_name'],
            'last_name' => $employee['last_name'],
            'date_created' => time(),
            'door_entry_code' => $this->createDoorEntryCode()
        ]);

        return $this->getEmployeeById($this->db->insert_id());
    }

    /**
     * @return array
     */
    public function getAllEmployees()
    {
        return $this->db->get('dacls_employee')
            ->result();
    }

    /**
     * @return array|null
     */
    public function getAllEmployeesClockedIn()
    {
        $employees = $this->getAllEmployees();

        $employeesClockedIn = [];
        foreach ($employees as $employee) {
            $employeeClockStatus = $this->getEmployeeClockStatus($employee->id);

            if ((int) $employeeClockStatus['status'] === CLOCK_IN) {
                $employee->clockInTime = $employeeClockStatus['clockTime'];
                $employeesClockedIn[] = $employee;
            }
        }

        if (count($employeesClockedIn) === 0) {
            return null;
        }

        return $employeesClockedIn;
    }

    /**
     * @return array
     */
    public function getAllEmployeesClockTimes()
    {
        return $this->db->select('dacls_employee.first_name, dacls_employee.last_name, dacls_activity_type.name AS activity_type, dacls_activity_log.activity_date')
            ->join('dacls_employee', 'dacls_employee.id = dacls_activity_log.employee', 'inner')
            ->join('dacls_activity_type', 'dacls_activity_type.id = dacls_activity_log.activity_type', 'inner')
            ->where('dacls_activity_log.activity_type', CLOCK_IN)
            ->or_where('dacls_activity_log.activity_type', CLOCK_OUT)
            ->order_by('dacls_activity_log.activity_date', 'DESC')
            ->get('dacls_activity_log')
            ->result();
    }

    /**
     * @param  string      $doorEntryCode
     * @return object|null
     */
    public function getEmployeeByDoorEntryCode($doorEntryCode)
    {
        $employees = $this->db->where('door_entry_code', $doorEntryCode)
            ->get('dacls_employee')
            ->result();

        if (count($employees) === 0) {
            return null;
        }

        return array_pop($employees);
    }

    /**
     * @param  int         $id
     * @return object|null
     */
    public function getEmployeeById($id)
    {
        $employees = $this->db->where('id', $id)
            ->get('dacls_employee')
            ->result();

        if (count($employees) === 0) {
            return null;
        }

        return array_pop($employees);
    }

    /**
     * @param  int   $id
     * @return array
     */
    public function getEmployeeClockStatus($id)
    {
        $clockTime = 0;
        $status = CLOCK_OUT;

        $clockTimes = $this->db->where('employee = ' . $id . ' AND (activity_type = ' . CLOCK_IN . ' OR activity_type = ' . CLOCK_OUT . ')')
            ->order_by('activity_date', 'DESC')
            ->limit(1)
            ->get('dacls_activity_log')
            ->row();

        if ($clockTimes) {
            $clockTime = $clockTimes->activity_date;
            $status = $clockTimes->activity_type;
        }

        return [
            'clockTime' => $clockTime,
            'status' => $status
        ];
    }

    /**
     * @param  int        $id
     * @param  DateTime   $startDate
     * @param  DateTime   $endDate
     * @return array|null An array with arrays of clock in and clock out times in 24-hour clock.
     */
    public function getEmployeeClockTimesBetweenDates($id, DateTime $startDate, DateTime $endDate)
    {
        $startOfStartDate = clone $startDate;
        $startOfStartDate->setTime(0, 0, 0);

        $endOfEndDate = clone $endDate;
        $endOfEndDate->setTime(23, 59, 59);

        $clockTimes = $this->db->select('activity_date, activity_type')
            ->where('employee = ' . $id . ' AND (activity_type = ' . CLOCK_IN . ' OR activity_type = ' . CLOCK_OUT . ') AND activity_date >= ' . $startOfStartDate->getTimestamp() . ' AND activity_date <= ' . $endOfEndDate->getTimestamp())
            ->order_by('activity_date', 'ASC')
            ->get('dacls_activity_log')
            ->result();

        if (count($clockTimes) === 0) {
            return null;
        }

        $clockInTimes = [];
        $clockOutTimes = [];

        foreach ($clockTimes as $clockTime) {
            if ((int) $clockTime->activity_type === CLOCK_IN) {
                $clockInTimes[] = date('Hi', $clockTime->activity_date);
            } else {
                $clockOutTimes[] = date('Hi', $clockTime->activity_date);
            }
        }

        return [
            'clockInTimes' => $clockInTimes,
            'clockOutTimes' => $clockOutTimes
        ];
    }

    /**
     * @param  int     $id
     * @param  int     $status
     * @return boolean
     */
    public function updateEmployeeClockStatus($id, $status)
    {
        $currentClockStatus = $this->getEmployeeClockStatus($id);

        if ((int) $currentClockStatus['status'] === $status) {
            return false;
        }

        return $this->db->insert('dacls_activity_log', array(
            'activity_date' => time(),
            'activity_type' => $status,
            'employee' => $id
        ));
    }
}
