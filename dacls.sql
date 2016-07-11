CREATE TABLE dacls_activity_log (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    activity_type int(10) UNSIGNED NOT NULL REFERENCES dacls_activity_type(id),
    employee int(10) UNSIGNED NOT NULL REFERENCES dacls_employee(id),
    activity_date int(10) UNSIGNED DEFAULT 0 NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE dacls_activity_type (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE dacls_employee (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    date_created int(10) UNSIGNED DEFAULT 0 NOT NULL,
    door_entry_code char(6) DEFAULT '0' NOT NULL,
    first_name varchar(128) NOT NULL,
    last_name varchar(128) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE dacls_sessions (
    id varchar(40) NOT NULL,
    ip_address varchar(45) NOT NULL,
    timestamp int(10) UNSIGNED DEFAULT 0 NOT NULL,
    data blob NOT NULL,
    KEY dacls_sessions_timestamp (timestamp),
    PRIMARY KEY(id)
);

CREATE TABLE dacls_user (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    email varchar(128) NOT NULL,
    password char(13) NOT NULL,
    salt char(22) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO dacls_user
    SET email = 'joe@example.com',
        password = 'LqdaexXBdinuE',
        salt = 'Lqu94niVim%p20f:yEbRCY';

INSERT INTO dacls_activity_type
    SET name = 'Clock in';

INSERT INTO dacls_activity_type
    SET name = 'Clock out';

INSERT INTO dacls_employee
    SET date_created = '1465772400',
        door_entry_code = 'j8kuth',
        first_name = 'Lewis',
        last_name = 'Morley';

INSERT INTO dacls_employee
    SET date_created = '1465772400',
        door_entry_code = '018keo',
        first_name = 'Sienna',
        last_name = 'Barnett';

INSERT INTO dacls_employee
    SET date_created = '1465772400',
        door_entry_code = '4v57qu',
        first_name = 'Rachel',
        last_name = 'Skinner';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 1,
        activity_date = '1465804380';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 1,
        activity_date = '1465817460';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 1,
        activity_date = '1465820820';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 1,
        activity_date = '1465835700';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 1,
        activity_date = '1465891620';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 1,
        activity_date = '1465904220';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 1,
        activity_date = '1465907400';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 1,
        activity_date = '1465921800';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 1,
        activity_date = '1465977420';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 1,
        activity_date = '1465990200';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 1,
        activity_date = '1465993740';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 1,
        activity_date = '1466007780';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 1,
        activity_date = '1466064000';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1465804620';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1465817460';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1465820820';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1465835700';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1465891200';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1465903740';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1465907400';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1465921800';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1465977780';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1465990380';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1465993800';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1466008200';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1466064000';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1466076600';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 2,
        activity_date = '1466080140';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 2,
        activity_date = '1466094900';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1465804800';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1465817400';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1465821000';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1465837200';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1465890420';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1465904100';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1465907100';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1465922340';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1465977300';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1465990200';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1465993800';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1466008980';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1466063700';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1466076780';

INSERT INTO dacls_activity_log
    SET activity_type = 1,
        employee = 3,
        activity_date = '1466080140';

INSERT INTO dacls_activity_log
    SET activity_type = 2,
        employee = 3,
        activity_date = '1466096460';
