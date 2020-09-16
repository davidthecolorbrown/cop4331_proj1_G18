# Create Users Table if it doesn't already exist
CREATE TABLE IF NOT EXISTS `cop4331a_db`.`Users` (
    `ID` INT NOT NULL AUTO_INCREMENT, 
    `DateCreated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `DateLastLoggedIn` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `FirstName` VARCHAR(50) NOT NULL DEFAULT '', 
    `LastName` VARCHAR(50) NOT NULL DEFAULT '', 
    `Login` VARCHAR(50) NOT NULL DEFAULT '', 
    `Password` VARCHAR(50) NOT NULL DEFAULT '', 
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

# create Contacts Table if it doesn't already exist
CREATE TABLE IF NOT EXISTS `cop4331a_db`.`Contacts` (
    `ID` INT NOT NULL AUTO_INCREMENT, 
    `FirstName` VARCHAR(50) NOT NULL DEFAULT '', 
    `LastName` VARCHAR(50) NOT NULL DEFAULT '', 
    `Email` VARCHAR(50) NOT NULL DEFAULT '',
    `PhoneNumber` VARCHAR(50) NOT NULL DEFAULT '',
    `Address` VARCHAR(50) NOT NULL DEFAULT '',
    `City` VARCHAR(50) NOT NULL DEFAULT '',
    `State` VARCHAR(50) NOT NULL DEFAULT '',
    `Zip` VARCHAR(50) NOT NULL DEFAULT '',   
    `UserID` INT NOT NULL DEFAULT '0' , 
    `DateCreated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

# insert test data for Users table
insert into `cop4331a_db`.`Users` (FirstName,LastName,Login,Password) VALUES ('Rick','Leinecker','RickL','COP4331');
insert into `cop4331a_db`.`Users` (FirstName,LastName,Login,Password) VALUES ('Sam','Hill','SamH','Test');
insert into `cop4331a_db`.`Users` (FirstName,LastName,Login,Password) VALUES ('Rick','Leinecker','RickL','5832a71366768098cceb7095efb774f2');
insert into `cop4331a_db`.`Users` (FirstName,LastName,Login,Password) VALUES ('Sam','Hill','SamH','0cbc6611f5540bd0809a388dc95a615b');

# insert test Contacts table
INSERT INTO `cop4331a_db`.`Contacts` (`FirstName`, `LastName`, `Email`,`PhoneNumber`,`Address`, `City`, `State`, `Zip`,`UserID`) VALUES
    ('Gerald', 'Foster', 'foster_1@email.com', '407-001-9001', '994 Transport Plaza', 'Ocala', 'FL', '34479', 1),
    ('Kevin', 'Hawkins', 'hawkins_1@email.com', '407-001-9002', '03231 Dwight Hill', 'Atlanta', 'GA', '30351', 1),
    ('Diana', 'Davis', 'davis_1@email.com', '407-001-9003', '35 Fairfield Parkway', 'Fargo', 'ND', '58122', 1),
    ('Heather', 'Gonzalez', 'email_1@email.com', '407-001-9004', '1 4th Trail', 'Albuquerque', 'NM', '87105', 1),
    ('Nancy', 'Gomez', 'email_1@email.com', '407-001-9005', '121 Southridge Lane', 'Valdosta', 'GA', '31605', 1),
    ('Terry', 'Hart', 'email_2@email.com', '407-002-9006', '353 Messerschmidt Pass', 'Burbank', 'CA', '91520', 2),
    ('Beverly', 'Wood', 'email_2@email.com', '407-002-9007', '21 Bluestem Trail', 'Washington', 'DC', '20557', 2),
    ('Fred', 'Roberts', 'email_3@email.com', '407-003-9008', '9 Main Crossing', 'Gilbert', 'AZ', '85297', 3),
    ('Maria', 'Cox', 'email_3@email.com', '407-003-9009', '1 Crest Line Pass', 'Albuquerque', 'NM', '87190', 3),
    ('Evelyn', 'Warren', 'email_3@email.com', '407-003-9010', '8589 Macpherson Way', 'Flint', 'MI', '48505', 3),
    ('Shirley', 'Vasquez', 'email_3@email.com', '407-003-9011', '0 Mallard Junction', 'Kansas City', 'MO', '64109', 3),
    ('Maria', 'Fuller', 'email_3@email.com', '407-003-9012', '05402 Badeau Crossing', 'New Orleans', 'LA', '70149', 3),
    ('Deborah', 'Parker', 'email_3@email.com', '407-003-9013', '45475 Hauk Drive', 'Toledo', 'OH', '43699', 3),
    ('Linda', 'Frazier', 'email_3@email.com', '407-003-9014', '6 Rigney Road', 'Lynn', 'MA', '01905', 3),
    ('Randy', 'Ray', 'email_3@email.com', '407-003-9015', '477 Arrowood Parkway', 'Tulsa', 'OK', '74184', 3),
    ('Nancy', 'Gomez', 'email_4@email.com', '407-004-9016', '121 Southridge Lane', 'Valdosta', 'GA', '31605', 4),
    ('Anthony', 'Tucker', 'email_4@email.com', '407-004-9017', '46 Redwing Center', 'Springfield', 'MO', '65810', 4),
    ('Lisa', 'Hanson', 'email_4@email.com', '407-004-9018', '335 Mesta Terrace', 'Wilmington', 'DE', '19805', 4);
