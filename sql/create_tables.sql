#department table
-- CREATE TABLE department (
-- department_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- department_name VARCHAR(255) UNIQUE NOT NULL,
-- department_head VARCHAR(255) NOT NULL,
-- department_contact_no VARCHAR(15) NOT NULL,
-- created_at DATETIME,
-- updated_at DATETIME
-- );

#job title table
-- CREATE TABLE job_title (
-- job_title_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- job_title_name VARCHAR(255) UNIQUE NOT NULL,
-- job_title_description TEXT NOT NULL,
-- department_id INT(11) UNSIGNED NOT NULL,
-- created_at DATETIME,
-- updated_at DATETIME,
-- FOREIGN KEY (department_id) REFERENCES department(department_id)
-- );


# employee table 
-- CREATE TABLE employee (
-- employee_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- first_name VARCHAR(255) NOT NULL,
-- last_name VARCHAR(255) NOT NULL,
-- middle_name VARCHAR(255),
-- extension_name VARCHAR(255),
-- email VARCHAR(255) UNIQUE NOT NULL,
-- address TEXT NOT NULL,
-- gender VARCHAR(50) NOT NULL,
-- birth_date DATE NOT NULL,
-- date_hired DATE NOT NULL,
-- nationality VARCHAR(255) NOT NULL,
-- cellphone_no VARCHAR(15) UNIQUE NOT NULL,
-- job_title_id INT(11) UNSIGNED,
-- created_by INT(11),
-- created_at DATETIME,
-- updated_by INT(11),
-- updated_at DATETIME,
-- FOREIGN KEY (job_title_id) REFERENCES job_title(job_title_id), 
-- CONSTRAINT CHK_Gender CHECK (gender='Male' OR gender='Female'
-- OR gender='Lesbian' OR gender='Gay' OR gender='Transwomen' OR gender='Transman'),
-- CONSTRAINT UC_Employee UNIQUE (first_name,last_name,middle_name)
-- );


# user table
-- CREATE TABLE user (
-- user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
-- email VARCHAR(255) UNIQUE NOT NULL,
-- password VARCHAR(255) NOT NULL,
-- employee_id INT(11) UNSIGNED,
-- created_by INT(11) UNSIGNED,
-- created_at DATETIME,
-- updated_by INT(11) UNSIGNED,
-- updated_at DATETIME,
-- FOREIGN KEY (employee_id) REFERENCES employee(employee_id),
-- FOREIGN KEY (created_by) REFERENCES user(user_id),
-- FOREIGN KEY (updated_by) REFERENCES user(user_id) 
-- );

CREATE TABLE time_in (
time_in_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
time_log DATETIME DEFAULT CURRENT_TIMESTAMP,
employee_id INT(11) UNSIGNED,
FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
);

CREATE TABLE time_out (
time_out_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
time_log DATETIME DEFAULT CURRENT_TIMESTAMP,
employee_id INT(11) UNSIGNED,
FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
);

CREATE TABLE attendance (
time_in_id INT(11) UNSIGNED,
time_out_id INT(11) UNSIGNED,
over_time_hours INT(11) UNSIGNED,
total_hours_worked INT(11) UNSIGNED,
FOREIGN KEY (time_in_id) REFERENCES time_in(time_in_id),
FOREIGN KEY (time_out_id) REFERENCES time_out(time_out_id)
);