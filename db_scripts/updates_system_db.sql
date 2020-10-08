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