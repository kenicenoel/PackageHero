
CREATE DATABASE IF NOT EXISTS websource_package_data;
USE websource_package_data;

CREATE TABLE users
(
	userId  int(5) AUTO_INCREMENT NOT NULL PRIMARY KEY,
	Username varchar(25) NOT NULL,
	Password varchar(36) NOT NULL,
	FirstName varchar(20),
	LastName varchar(20),
	EmailAddress varchar(50),
	PhoneNumber varchar(11),
	Country varchar(30),
	LastLoginTime timestamp NULL DEFAULT NULL,
  LastModifiedOn timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

);


CREATE TABLE packages
(
	PackageID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	TrackingNumber varchar(50) NOT NULL,
	HAWB varchar(50),
	CustomerName varchar(50),
	MainIssue varchar(50) DEFAULT Not entered,
	Description varchar(300) NOT NULL,
	HideFromCountry varchar(30),
	Photo1 varchar(50),
	Photo2 varchar(50),
	Photo3 varchar(50),
	Photo4 varchar(50),
	Photo5 varchar(50),
	Resolved varchar(3) DEFAULT No,
	ResolvedBy varchar(25),
	IssueCreationTime timestamp DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE updates
(
	UpdateNumber int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	PackageID int(11) NOT NULL,
	Note varchar(200),
	TimeCreated timestamp DEFAULT CURRENT_TIMESTAMP,
	Username varchar(25),
	FOREIGN KEY updates(PackageID) references packages(PackageID)

);


CREATE TABLE newsfeed
(
	NewsfeedNumber int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	PackageID int(11) NOT NULL,
	News varchar(200),
	TimeCreated timestamp DEFAULT CURRENT_TIMESTAMP,
	Username varchar(25),
	FOREIGN KEY newsfeed(PackageID) references packages(PackageID)

);

CREATE TABLE hiddenissues
(
	HiddenIssueNumber int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	PackageID int(11) NOT NULL,
	HiddenFromCountry varchar(200),
	HiddenBy varchar(25),
	FOREIGN KEY hiddenissues(PackageID) references packages(PackageID)
);
