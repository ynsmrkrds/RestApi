--
-- creates "APIDB" database
--
CREATE DATABASE APIDB;

--
-- uses "APIDB"
--
USE APIDB;

--
-- creates "user" Table:
--
CREATE TABLE IF NOT EXISTS user (id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
userName VARCHAR(50), userSurname VARCHAR(50), gender VARCHAR(1));

--
-- creates "request" Table:
--
CREATE TABLE IF NOT EXISTS request (id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
requestType VARCHAR(6), responseTime VARCHAR(15), responseTimestamp VARCHAR(10));