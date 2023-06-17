CREATE TABLE admindetalis(
    adminid INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY;
    adminname VARCHAR(20) required;
    adminpass VARCHAR(25) required;
    address VARCHAR(30) required;
    phoneno BIGINT(11) required;
    email VARCHAR(40) required;
    adminimage VARCHAR(255) required;
    Reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
)