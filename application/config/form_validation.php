<?php
$config = array(
    'admin/createEmployee' => array(
        array(
            'field' => 'firstName',
            'label' => 'First name',
            'rules' => 'required'
        ),
        array(
            'field' => 'lastName',
            'label' => 'Last name',
            'rules' => 'required'
        )
    ),
    'authentication/login' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),
    'employee/clockInAndOut' => array(
        array(
            'field' => 'doorEntryCode',
            'label' => 'Door entry code',
            'rules' => 'required'
        )
    )
);
