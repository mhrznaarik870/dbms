
-- Table for employee details
CREATE TABLE IF NOT EXISTS empdetails (
  empid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) ,
  address VARCHAR(255),
  phoneno VARCHAR(20),
  email VARCHAR(255),
  department VARCHAR(255),
  updated_comments text(100),
  Reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table for resigned employees
CREATE TABLE IF NOT EXISTS resigned_employees (
  empid INT PRIMARY KEY,
   name VARCHAR(255) ,
  address VARCHAR(255),
  phoneno VARCHAR(20),
  email VARCHAR(255),
  department VARCHAR(255),
  resignation_comments VARCHAR(1000),
  Reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  
);

