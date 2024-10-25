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
unit_id INT NOT NULL AUTO_INCREMENT,
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
id INT NOT NULL,
username varchar(45),
password varchar(60),
role varchar(50),
PRIMARY KEY(id)
);

INSERT INTO departments (dept_name) VALUES ("Physician");
INSERT INTO departments (dept_name) VALUES ("Nursing");
INSERT INTO departments (dept_name) VALUES ("Accounting");
INSERT INTO departments (dept_name) VALUES ("HR");
INSERT INTO departments (dept_name) VALUES ("Records");


INSERT INTO employees
(first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
('Martin', 'Donna', 2122222222, '1990-03-05', 'HR Supervisor', 50000, 'donnam', 4, '12 Willow Road');

INSERT INTO employees
(first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
('Beverly', 'Banks', 2124444444, '1995-09-07', 'Accountant', 40000, 'banksb', 3, '911 Market Street');

INSERT INTO employees
(first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
('Daniel', 'Doe', 2178890000, '1986-03-05', 'CNA', 58000, 'doed', 2, '212 Willow Road');

INSERT INTO employees
(first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
('Sophie', 'Collins', 2123333333, '1987-03-19', 'Physician', 70000, 'collinss', 1, '400 Baugher Avenue');

INSERT INTO employees
(first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
('Mary', 'Fisher', 2134658907, '1989-03-24', 'Physician', 67000, 'fisherm', 1, '120 Baugher Avenue');

INSERT INTO residential_sector
(unit, phone, location)
VALUES
('Personal Care', 3133330000, 'East Wing');

INSERT INTO residential_sector
(unit, phone, location)
VALUES
('Independent Living', 3133339999, 'West Wing');

INSERT INTO residential_sector
(unit, phone, location)
VALUES
('Skilled Care', 3133330870, 'South Wing');

INSERT INTO physician
(first_name, last_name, emp_id, specialty)
VALUES
('Mary', 'Fisher', 5, 'Cardiology');

INSERT INTO physician
(first_name, last_name, emp_id, specialty)
VALUES
('Sophie', 'Collins', 4, 'Neurology');

INSERT INTO accounting_record (insurance, monthly_rent) VALUES ('United Care', 800);
INSERT INTO accounting_record (insurance, monthly_rent) VALUES ('United Care', 900);

INSERT INTO CARE (notes) VALUES ('Likes to eat lunch at 12:00 noon.');
INSERT INTO CARE (notes) VALUES ('Goes to bed at 8:00 pm with.');
INSERT INTO Care (notes) VALUES ('Eats breakfast at 8:00 am.');

INSERT INTO clinical_notes
(current_illness,medication_refusal,diet_plan, emergency_calls, physician_id, note)
VALUES
('Peripheral Artery Disease', 'none','mediterranean diet', 'none',1, 'needs checked on regulary');

INSERT INTO clinical_notes
(current_illness,medication_refusal,diet_plan, emergency_calls, physician_id, note)
VALUES
('High Blood Pressure', 'none','grains', 'none',2, 'needs checked on regulary');

INSERT INTO medical_records
(medications, vaccinations, allergies, note_id, treatment)
VALUES
('Amlodipine', 'Flu', 'Nut', 1, 'XYZ');

INSERT INTO medical_records
(medications, vaccinations, allergies, note_id, treatment)
VALUES
('Amlodipine', 'HPV', 'Milk', 2, 'SAZ');

INSERT INTO residents 
(first_name, last_name, dob, mailing_address, physician_id,account_id, ssn, emergency_contact, care_id, rec_id, unit_id, address)
VALUES
('John', 'Doe', '1995-09-09', '13 Malo Street', 1, 1, 238179900, 2126579999,1,1,1,'E');

INSERT INTO residents 
(first_name, last_name, dob, mailing_address, physician_id,account_id, ssn, emergency_contact, care_id, rec_id, unit_id, address)
VALUES
('Joys', 'Munchkin', '1960-12-09', '13 Alpha Street', 2, 2, 238179900, 2126579999,2,2,1,'E');

