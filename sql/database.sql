-- Create a database
CREATE DATABASE IF NOT EXISTS if0_37911031_loginpage;

-- Switch to the database
USE if0_37911031_loginpage;

-- Create a users table
CREATE TABLE IF NOT EXISTS users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);
