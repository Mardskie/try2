CREATE DATABASE intramurals_system;
USE intramurals_system;

CREATE TABLE registration (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE,
    Password VARCHAR(50),
    ConfirmPassword VARCHAR(50),
    user_type ENUM('athlete', 'coach', 'dean', 'tournamentmanager', 'department') NOT NULL DEFAULT 'athlete'
);

CREATE TABLE department (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    DeptName VARCHAR(50)
);

CREATE TABLE tournamentmanager (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE,
    Fname VARCHAR(50),
    Lname VARCHAR(50),
    Mobile VARCHAR(15),
    DeptID INT,
    FOREIGN KEY (DeptID) REFERENCES department(UserID)
);

CREATE TABLE event (
    EventID INT PRIMARY KEY AUTO_INCREMENT,
    Category VARCHAR(50),
    EventName VARCHAR(100),
    NoOfParticipant INT,
    TournamentManager INT,
    FOREIGN KEY (TournamentManager) REFERENCES tournamentmanager(UserID)
);

CREATE TABLE coach (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE,
    Fname VARCHAR(50),
    Lname VARCHAR(50),
    Mobile VARCHAR(15),
    DeptID INT,
    FOREIGN KEY (DeptID) REFERENCES department(UserID) 
);

CREATE TABLE dean (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE,
    Fname VARCHAR(50),
    Lname VARCHAR(50),
    Mobile VARCHAR(15),
    DeptID INT,
    FOREIGN KEY (DeptID) REFERENCES department(UserID) 
);

CREATE TABLE athletes (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    EventID INT,
    DeptID INT,
    Lastname VARCHAR(50),
    Firstname VARCHAR(50),
    MiddleInitial VARCHAR(1),
    Course VARCHAR(50),
    Year INT,
    Civilstatus VARCHAR(20),
    Gender VARCHAR(10),
    Birthdate DATE,
    Contactno VARCHAR(15),
    Address VARCHAR(100),
    CoachID INT,
    DeanID INT,
    FOREIGN KEY (UserID) REFERENCES registration(UserID),
    FOREIGN KEY (EventID) REFERENCES event(EventID),
    FOREIGN KEY (DeptID) REFERENCES department(UserID),
    FOREIGN KEY (CoachID) REFERENCES coach(UserID),
    FOREIGN KEY (DeanID) REFERENCES dean(UserID)
);

DELIMITER //

CREATE TRIGGER sync_user_id_after_registration_insert
AFTER INSERT ON registration
FOR EACH ROW
BEGIN
    INSERT INTO athletes (UserID) VALUES (NEW.UserID);
    INSERT INTO coach (UserID) VALUES (NEW.UserID);
    INSERT INTO department (UserID) VALUES (NEW.UserID);
    INSERT INTO dean (UserID) VALUES (NEW.UserID);
    INSERT INTO tournamentmanager (UserID) VALUES (NEW.UserID);
END;
//

DELIMITER ;

