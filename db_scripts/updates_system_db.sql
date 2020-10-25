-- Context switch to the correct DB
CREATE DATABASE IF NOT EXISTS blackpeakltd;
USE blackpeakltd;

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `addressID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `address1` VARCHAR(255) NOT NULL,
  `address2` VARCHAR(255),
  `address3` VARCHAR(255),
  `city` VARCHAR(255) NOT NULL,
  `state` CHAR(2) NOT NULL,
  `code` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`addressID`)
);

-- Modified the 'booking' table to modify 'initialCollectionPoint' 
-- changing it to be a fk to associate with the 'address' table 
ALTER TABLE `booking` MODIFY COLUMN `initialCollectionPoint` int NOT NULL;
ALTER TABLE `booking` ADD FOREIGN KEY (`initialCollectionPoint`) 
REFERENCES `address`(`addressID`);

-- modified 'daytrip' table change datatype for tripdate column and 2 new columns
ALTER TABLE `daytrip` MODIFY COLUMN `tripDate` DATETIME NOT NULL;
ALTER TABLE `daytrip` 
ADD COLUMN `collectionPoint` VARCHAR(512) NULL,
ADD COLUMN `destinationPoint` VARCHAR(512) NULL;

ALTER TABLE `booking` 
ADD COLUMN `longitude` VARCHAR(256) NULL,
ADD COLUMN `latitude` VARCHAR(256) NULL,
ADD COLUMN `hasLocation` VARCHAR(256) NOT NULL;