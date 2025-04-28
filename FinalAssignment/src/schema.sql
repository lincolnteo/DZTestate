CREATE DATABASE IF NOT EXISTS DZT_DB;

USE DZT_DB;

CREATE TABLE Landlords (
    ID INT AUTO_INCREMENT,
    UserName VARCHAR(200),
    Password VARCHAR(200),
    PRIMARY KEY (ID)
);

CREATE TABLE Users (
    ID INT AUTO_INCREMENT,
    UserName VARCHAR(200),
    Password VARCHAR(200),
    PRIMARY KEY (ID)
);

CREATE TABLE Properties (
    ID INT AUTO_INCREMENT,
    LandlordID INT,
    Beds INT,
    RentalMonths INT,
    RentalPrice REAL,
    PRIMARY KEY (ID),
    FOREIGN KEY (LandlordID) REFERENCES Landlords (ID)
);

CREATE TABLE Testimonials (
    ID INT AUTO_INCREMENT,
    UserID INT,
    ServiceName VARCHAR(200),
    Date DATE,
    Comment TEXT,
    PRIMARY KEY (ID),
    FOREIGN KEY (UserID) REFERENCES Users (ID)
);
