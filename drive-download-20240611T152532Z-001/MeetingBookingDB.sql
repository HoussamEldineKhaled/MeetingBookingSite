CREATE TABLE Company(
    CompanyID INT NOT NULL,
    CompanyName VARCHAR(255) NOT NULL,
    CompanyDescription VARCHAR(500),
    CompayEmail CHAR(30),
    CompanyLogo IMAGE,
    CompanyActive BIT, 
    PRIMARY KEY (CompanyID),
    
    
);

CREATE TABLE SystemUser (
    ID INT NOT NULL,
    Name VARCHAR(255) NOT NULL,
    Birth DATE, 
    Gender VARCHAR(1),
    Email VARCHAR(30),
    Password  VARCHAR(11) NOT NULL UNIQUE,

    Role VARCHAR(10),
    CompanyID INT,
    PRIMARY KEY (ID),
    CONSTRAINT GenderSecurityManagement CHECK(Gender = 'F' OR Gender = 'M' ),
    CONSTRAINT SecurityManagementRole CHECK(Role = 'Company' OR Role = 'Admin')
);

CREATE TABLE Room(
    RoomID INT NOT NULL,
    RoomLocation VARCHAR(200),
    RoomCapacity INT,
    RoomDescription VARCHAR(500),
    RelatedCompany INT,
    PRIMARY KEY (RoomID),
    FOREIGN KEY (RelatedCompany) REFERENCES Company(CompanyID)
);

CREATE TABLE Meeting (
    ReservationID  INT NOT NULL,
    StartTime DATETIME,
    EndTime   DATETIME,
    RelatedRoom INT,
    NumberOfAttendees INT,
    MeetingStatus BIT,
    MeetingManagerID INT,
    PRIMARY KEY (ReservationID),
    FOREIGN KEY (RelatedRoom) REFERENCES Room(RoomID),
    FOREIGN KEY (MeetingManagerID) REFERENCES SystemUser(ID)
);

ALTER TABLE SystemUser
ADD FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID);