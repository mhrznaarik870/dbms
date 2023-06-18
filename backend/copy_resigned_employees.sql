USE empdirectory;

CREATE TABLE IF NOT EXISTS resigned_employees (
    empid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    address VARCHAR(20) NOT NULL,
    phoneno BIGINT(10),
    email VARCHAR(50),
    department VARCHAR(20),
    resignation_comments VARCHAR(100),
    Reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Copy data from empdetails table to resigned_employees table
INSERT INTO resigned_employees (name, address, phoneno, email, department, resignation_comments, Reg_date)
SELECT name, address, phoneno, email, department, :resignation_comments, Reg_date
FROM empdetails
WHERE empid = :empid;
