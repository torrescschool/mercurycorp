create database mercurycorp;
use mercurycorp;

CREATE TABLE IF NOT EXISTS care(
care_id INT NOT NULL auto_increment ,
notes longtext,
PRIMARY KEY (care_id)
);
CREATE TABLE IF NOT EXISTS departments(
dept_id INT NOT NULL auto_increment,
dept_name varchar(45),
PRIMARY KEY (dept_id)
);
CREATE TABLE IF NOT EXISTS medical_records(
rec_id INT NOT NULL auto_increment,
res_id int,
vaccinations varchar(100),
allergies varchar(100),
admission_date DATE,
discharge_date DATE,
PRIMARY KEY (rec_id)
);
CREATE TABLE IF NOT EXISTS employees(
emp_id INT NOT NULL,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
mobile_no INT, 
dob date,
job_title varchar(100),
salary float,
email  varchar(100) NOT NULL,
department_id INT,
address varchar(200),
PRIMARY KEY (emp_id),
FOREIGN KEY (department_id) REFERENCES departments(dept_id)
);
CREATE TABLE IF NOT EXISTS physician(
physician_id INT NOT NULL ,
first_name varchar(100) NOT NULL,
last_name varchar(100) NOT NULL,
emp_id INT, 
specialty varchar(45),
PRIMARY KEY (physician_id),
FOREIGN KEY (emp_id) REFERENCES employees (emp_id)
);
CREATE TABLE IF NOT EXISTS clinical_notes(
note_id INT NOT NULL AUTO_INCREMENT,
current_illness varchar(100),
medication_refusal BOOLEAN,
diet_plan varchar(100),
emergency_calls varchar(100),
ishospice BOOLEAN,
physician_id INT,
note longtext,
rec_id INT,
PRIMARY KEY (note_id),
FOREIGN KEY (physician_id) REFERENCES physician (physician_id),
FOREIGN KEY (rec_id) REFERENCES medical_records (rec_id)
);

-- physician order 
CREATE TABLE IF NOT EXISTS physician_orders(
order_id INT AUTO_INCREMENT,
record_id INT,
order_date DATE,
order_text longtext,
physician_id INT,
PRIMARY KEY (order_id),
FOREIGN KEY (rec_id) REFERENCES MedicalRecords(rec_id)
FOREIGN KEY (physician_id) REFERENCES physician (physician_id)
)
-- med/treatment table
CREATE TABLE IF NOT EXISTS meds_treats(
type_id INT AUTO_INCREMENT,
type_name varchar(50)
emp_id INT
datetime_given DATETIME,
notes varchar(100),
medication_refused BOOLEAN
order_id INT,
PRIMARY KEY (type_id)
FOREIGN KEY (order_id) REFERENCES physicianorders(order_id)
FOREIGN KEY (emp_id) REFERENCES employees (emp_id)
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

CREATE TABLE IF NOT EXISTS residential_sector(
unit_id INT NOT NULL AUTO_INCREMENT,
unit varchar(100),
phone INT,
location varchar(100),
PRIMARY KEY (unit_id)
);
CREATE TABLE IF NOT EXISTS residents (
	res_id CHAR(35) NOT NULL ,
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
CREATE TABLE users (
    user_id int auto_increment,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('resident', 'employee', 'physician') NOT NULL,  
    linked_id CHAR(36) NOT NULL ,
    PRIMARY KEY (user_id)
);

INSERT INTO departments (dept_name) VALUES ("Physician");
INSERT INTO departments (dept_name) VALUES ("Nursing");
INSERT INTO departments (dept_name) VALUES ("Accounting");
INSERT INTO departments (dept_name) VALUES ("HR");
INSERT INTO departments (dept_name) VALUES ("Records");


INSERT INTO employees
(emp_id, first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
(100,'Martin', 'Donna', 2122222222, '1990-03-05', 'HR Supervisor', 50000, 'donnam', 4, '12 Willow Road');

INSERT INTO employees
(emp_id,first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
(101, 'Beverly', 'Banks', 2124444444, '1995-09-07', 'Accountant', 40000, 'banksb', 3, '911 Market Street');

INSERT INTO employees
(emp_id,first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
(102,'Daniel', 'Doe', 2178890000, '1986-03-05', 'CNA', 58000, 'doed', 2, '212 Willow Road');

INSERT INTO employees
(emp_id,first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
(103,'Sophie', 'Collins', 2123333333, '1987-03-19', 'Physician', 70000, 'collinss', 1, '400 Baugher Avenue');

INSERT INTO employees
(emp_id,first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
(104,'Mary', 'Fisher', 2134658907, '1989-03-24', 'Physician', 67000, 'fisherm', 1, '120 Baugher Avenue');

INSERT INTO employees
(emp_id,first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
(105,'Mandy', 'Oliver', 3331222222, '1987-03-24', 'HR', 50000, 'oliverm', 4, '190 Baugher Avenue');

INSERT INTO employees
(emp_id,first_name, last_name,mobile_no,dob,job_title,salary,email,department_id,address)
VALUES
(106,'Alex', 'Tide', 3331234522, '1987-03-24', 'HR', 50000, 'tideam', 4, '190 Baugher Avenue');

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
(physician_id, first_name, last_name, emp_id, specialty)
VALUES
(104, 'Mary', 'Fisher', 104, 'Cardiology');

INSERT INTO physician
(physician_id,first_name, last_name, emp_id, specialty)
VALUES
(103,'Sophie', 'Collins', 103, 'Neurology');

INSERT INTO accounting_record (insurance, monthly_rent) VALUES ('United Care', 800);
INSERT INTO accounting_record (insurance, monthly_rent) VALUES ('United Care', 900);

INSERT INTO CARE (notes) VALUES ('Likes to eat lunch at 12:00 noon.');
INSERT INTO CARE (notes) VALUES ('Goes to bed at 8:00 pm with.');
INSERT INTO Care (notes) VALUES ('Eats breakfast at 8:00 am.');

INSERT INTO medical_records
(vaccinations, allergies)
VALUES
('Flu', 'Nut');

INSERT INTO medical_records
(vaccinations, allergies)
VALUES
('HPV', 'Milk');

INSERT INTO clinical_notes
(current_illness,medication_refusal,diet_plan, emergency_calls, physician_id, note, rec_id)
VALUES
('Peripheral Artery Disease', 'FALSE','mediterranean diet', 'none',104, 'needs checked on regulary', 1);

INSERT INTO clinical_notes
(current_illness,medication_refusal,diet_plan, emergency_calls, physician_id, note, rec_id)
VALUES
('High Blood Pressure', 'FALSE','grains', 'none',103, 'needs checked on regulary', 2);


INSERT INTO residents 
(res_id,first_name, last_name, dob, mailing_address, physician_id,account_id, ssn, emergency_contact, care_id, rec_id, unit_id, address)
VALUES
('R001','John', 'Doe', '1995-09-09', '13 Malo Street', 104, 1, 238179900, 2126579999,1,1,1,'E');

INSERT INTO residents 
(res_id,first_name, last_name, dob, mailing_address, physician_id,account_id, ssn, emergency_contact, care_id, rec_id, unit_id, address)
VALUES
('R002','Joys', 'Munchkin', '1960-12-09', '13 Alpha Street', 103, 2, 238179900, 2126579999,2,2,1,'E');

ALTER TABLE employees
ADD CONSTRAINT unique_email UNIQUE (email);

ALTER TABLE users
CHANGE password_hash password VARCHAR(255);

ALTER TABLE users
CHANGE linked_id id char(36);

ALTER TABLE physician
ADD COLUMN email VARCHAR(255) NOT NULL;

UPDATE physician
SET email = 'collinss'
WHERE physician_id = 103;

UPDATE physician
SET email = 'fisherm'
WHERE physician_id = 104;

alter table users
modify COLUMN role varchar(25);