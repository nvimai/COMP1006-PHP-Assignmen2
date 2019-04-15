CREATE DATABASE 200385752Comp1006Assignment2;
USE 200385752Comp1006Assignment2;

CREATE TABLE countries (
	countryID VARCHAR(2) NOT NULL, -- Country abbreviations
    countryName VARCHAR(24) NOT NULL,
    PRIMARY KEY (countryID)
);

CREATE TABLE states (
	stateID VARCHAR(2) NOT NULL, -- State abbreviations
	stateName VARCHAR(24) NOT NULL,
	countryID VARCHAR(2) NOT NULL,
	PRIMARY KEY (stateID, countryID),
	FOREIGN KEY (countryID) REFERENCES countries(countryID)
);

CREATE TABLE users (
	userID INT NOT NULL AUTO_INCREMENT,
	firstName VARCHAR(24) NOT NULL,
	lastName VARCHAR(24) NOT NULL,
	middleName VARCHAR(24),
	email VARCHAR(100) NOT NULL,
	password VARCHAR(255) NOT NULL,
	streetAddress VARCHAR(100) NOT NULL,
	city VARCHAR(24) NOT NULL,
	stateID VARCHAR(2) NOT NULL,
	countryID VARCHAR(2) NOT NULL,
	postalCode VARCHAR(6) NOT NULL,
	PRIMARY KEY (userID),
	FOREIGN KEY (stateID) REFERENCES states(stateID),
	FOREIGN KEY (countryID) REFERENCES countries(countryID)
);

CREATE TABLE categories (
	categoryID INT NOT NULL AUTO_INCREMENT,
	categoryName VARCHAR(30) NOT NULL,
	PRIMARY KEY (categoryID)
);

CREATE TABLE products (
	productID INT NOT NULL AUTO_INCREMENT,
	productName VARCHAR(255) NOT NULL, 
	categoryID INT NOT NULL, 
	description TEXT,
	price DOUBLE[(10,2)],
	image BLOB,
	PRIMARY KEY (productID),
	FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
);

INSERT INTO countries (countryID, countryName) VALUES 
('CA', 'Canada');
    
INSERT INTO states (stateID, stateName, countryID) VALUES
	('AB', 'Alberta', 'CA'),
	('BC', 'British Columbia', 'CA'),
	('MB', 'Manitoba', 'CA'),
	('NB', 'New Brunswick', 'CA'),
	('NL', 'Newfoundland Labrador', 'CA'),
	('NS', 'Nova Scotia', 'CA'),
	('NT', 'Northwest Territories', 'CA'),
	('NU', 'Nunavut', 'CA'),
	('ON', 'Ontario', 'CA'),
	('PE', 'Prince Edward Island', 'CA'),
	('QC', 'Quebec', 'CA'),
	('SK', 'Saskatchewan', 'CA'),
	('YT', 'Yukon', 'CA');

INSERT INTO users (firstName, lastName, middleName, email, password, streetAddress, city, stateID, countryID, postalCode) VALUES
	('Nhat', 'Mai', 'Vuong Minh', 'nhat@gmail.com', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '25 B College Crescent', 'Barrie', 'ON', 'CA', 'L4M2W4'),
	('Arya', 'Filsoofi', NULL, 'test@test.com', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '100 Cundles Road', 'Barrie', 'ON', 'CA', 'L4M5U5'),
	('Lena', 'Lai', NULL, 'Lena@gmail.com', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '50 Cook Street', 'Barrie', 'ON', 'CA', 'L4M5U5'),
	('Seung', 'Kim', 'Hyun', 'Seung@gmail.com', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '100 Cundles Road', 'Barrie', 'ON', 'CA', 'L4M5A8');

INSERT INTO categories (categoryName) vALUES 
('Books & Audible'),
('Electronic, Computer & Office');

INSERT INTO products (productName, categoryID, description, price, image) VALUES
('Apple iPhone 7', 1, null, 800.00, null);
    
SELECT * from users;
SELECT password(password) from users;
Select firstName, lastName, middleName, email, streetAddress, city, states.stateName, countries.countryName from users
inner join countries on countries.countryID = users.countryID
inner join states on states.stateID = users.stateID;
SELECT * from states;
SELECT * from countries;