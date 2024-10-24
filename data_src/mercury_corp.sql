create database mercurycorp;
use mercurycorp;

CREATE TABLE IF NOT EXISTS care(
care_id INT NOT NULL AUTO_INCREMENT,
notes longtext,
PRIMARY KEY (care_id)
);
CREATE TABLE IF NOT EXISTS departments(
dept_id INT NOT NULL AUTO_INCREMENT,
dept_name varchar(45),
PRIMARY KEY (dept_id)
);
CREATE TABLE IF NOT EXISTS employees(
emp_id INT NOT NULL AUTO_INCREMENT,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
mobile_no INT, 
dob date,
job_title varchar(100),
salary float,
email varchar(100),
department_id INT,
address varchar(200),
PRIMARY KEY (emp_id),
FOREIGN KEY (department_id) REFERENCES departments(dept_id)
);
CREATE TABLE IF NOT EXISTS physician(
physician_id INT NOT NULL AUTO_INCREMENT,
first_name varchar(100),
last_name varchar(100),
emp_id INT, 
specialty varchar(45),
PRIMARY KEY (physician_id),
FOREIGN KEY (emp_id) REFERENCES employees (emp_id)
);
CREATE TABLE IF NOT EXISTS clinical_notes(
note_id INT NOT NULL AUTO_INCREMENT,
current_illness varchar(100),
medication_refusal varchar(100),
diet_plan varchar(100),
emergency_calls varchar(100),
hospice varchar(100),
physician_id INT,
note longtext,
PRIMARY KEY (note_id),
FOREIGN KEY (physician_id) REFERENCES physician (physician_id)
);
CREATE TABLE IF NOT EXISTS accounting_record(
account_id INT NOT NULL AUTO_INCREMENT,
insurance varchar(45) NOT NULL,
monthly_rent float,
PRIMARY KEY (account_id)
);
CREATE TABLE IF NOT EXISTS visits (
visit_id INT NOT NULL AUTO_INCREMENT,
date date,
visit_type varchar(45),
physician_id INT,
note_id INT,
primary key (visit_id),
foreign key (physician_id) references physician (physician_id),
foreign key (note_id) references clinical_notes(note_id)
);
CREATE TABLE IF NOT EXISTS medical_records(
rec_id INT NOT NULL AUTO_INCREMENT,
medications varchar(100),
vaccinations varchar(100),
allergies varchar(100),
note_id INT,
treatment varchar(100),
PRIMARY KEY (rec_id),
FOREIGN KEY (note_id) REFERENCES clinical_notes (note_id)
);
CREATE TABLE IF NOT EXISTS residential_sector(
unit_id INT,
unit varchar(100),
phone INT,
location varchar(100),
PRIMARY KEY (unit_id)
);
CREATE TABLE IF NOT EXISTS residents (
	res_id INT NOT NULL AUTO_INCREMENT,
    first_name varchar(100) NOT NULL,
    last_name varchar(100) NOT NULL,
    dob date,
    mailing_address varchar(100),
    physician_id INT,
    account_id INT,
    ssn INT NOT NULL,
    emergency_contact INT NOT NULL,
    care_id INT,
    rec_id INT,
    unit_id INT,
    address varchar (100),
    PRIMARY KEY (res_id),
    FOREIGN KEY (physician_id) REFERENCES physician (physician_id),
    FOREIGN KEY (account_id) REFERENCES accounting_record (account_id),
    FOREIGN KEY (care_id) REFERENCES care (care_id),
    FOREIGN KEY (rec_id) REFERENCES medical_records(rec_id),
    FOREIGN KEY (unit_id) REFERENCES residential_sector(unit_id) 
);
CREATE TABLE IF NOT EXISTS login(
id INT,
username varchar(45),
password varchar(60),
role varchar(50),
PRIMARY KEY(id)
);