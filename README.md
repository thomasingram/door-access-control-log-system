# Door Access Control & Log System

## Minimum requirements

* PHP version 5.4 or greater.
* MySQL version 5.1 or greater.

## Installation instructions

1. Unzip the package.
2. Upload the folders and files to your server. Normally the index.php file will be at your root.
3. Create a new database and import the dacls.sql file.
4. Open the application/config/config.php file with a text editor and set your base URL.
5. Open the application/config/database.php file with a text editor and set your database settings (hostname, username, password, database).

## Log in

Log in to the ‘administration area’ with the email and password shown below.

http://dacls.local/index.php/login

Email: joe@example.com
Password: 55CVh1T*JDB8AEu

Note: Your login URL may be different depending on your environment.

## Clock in/out

Employees can track their time from the clock in/out screen.

http://dacls.local/index.php/employee/clock_in_out

+------------+-----------+-----------------+
| First name | Last name | Door entry code |
+------------+-----------+-----------------+
| Lewis      | Morley    | j8kuth          |
| Sienna     | Barnett   | 018keo          |
| Rachel     | Skinner   | 4v57qu          |
+------------+-----------+-----------------+

Note: Your clock in/out URL may be different depending on your environment.