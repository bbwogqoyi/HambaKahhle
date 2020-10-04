-- Host: is3-dev.ict.ru.ac.za    Database: blackpeakltd
-- ------------------------------------------------------
-- Server version	8.0.20

CREATE DATABASE IF NOT EXISTS blackpeakltd CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE blackpeakltd;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `clientID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL UNIQUE,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`clientID`)
);

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daytrip`
--

DROP TABLE IF EXISTS `daytrip`;
CREATE TABLE `daytrip` (
  `tripNumber` int NOT NULL AUTO_INCREMENT UNIQUE,
  `tripDate` date DEFAULT NULL,
  `bedRequest` varchar(255) DEFAULT NULL,
  `bookingID` int DEFAULT NULL,
  PRIMARY KEY (`tripNumber`),
  KEY `bookingID` (`bookingID`),
  CONSTRAINT `daytrip_ibfk_1` FOREIGN KEY (`bookingID`) REFERENCES `booking` (`bookingID`)
);

--
-- Dumping data for table `daytrip`
--

LOCK TABLES `daytrip` WRITE;
/*!40000 ALTER TABLE `daytrip` DISABLE KEYS */;
/*!40000 ALTER TABLE `daytrip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daytripdepot`
--

DROP TABLE IF EXISTS `daytripdepot`;
CREATE TABLE `daytripdepot` (
  `tripNumber` int DEFAULT NULL,
  `startDepotID` int DEFAULT NULL,
  `destinationDepotID` int DEFAULT NULL,
  KEY `tripNumber` (`tripNumber`),
  KEY `startDepotID` (`startDepotID`),
  KEY `destinationDepotID` (`destinationDepotID`),
  CONSTRAINT `daytripdepot_ibfk_1` FOREIGN KEY (`tripNumber`) REFERENCES `daytrip` (`tripNumber`),
  CONSTRAINT `daytripdepot_ibfk_2` FOREIGN KEY (`startDepotID`) REFERENCES `depot` (`depotID`),
  CONSTRAINT `daytripdepot_ibfk_3` FOREIGN KEY (`destinationDepotID`) REFERENCES `depot` (`depotID`)
);


--
-- Dumping data for table `daytripdepot`
--

LOCK TABLES `daytripdepot` WRITE;
/*!40000 ALTER TABLE `daytripdepot` DISABLE KEYS */;
/*!40000 ALTER TABLE `daytripdepot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE `depot` (
  `depotID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `depotName` varchar(255) DEFAULT NULL,
  `streetNumber` int DEFAULT NULL,
  `streetName` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(255) DEFAULT NULL,
  `numberOfBedsAvailable` int DEFAULT NULL,
  PRIMARY KEY (`depotID`)
);


--
-- Dumping data for table `depot`
--

LOCK TABLES `depot` WRITE;
/*!40000 ALTER TABLE `depot` DISABLE KEYS */;
/*!40000 ALTER TABLE `depot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
  `driverID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `dateOFBirth` date DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`driverID`)
);

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `license`
--

DROP TABLE IF EXISTS `license`;
CREATE TABLE `license` (
  `licenseCode` int NOT NULL UNIQUE,
  `description` varchar(255) DEFAULT NULL,
  `classification` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`licenseCode`)
);

--
-- Dumping data for table `license`
--

LOCK TABLES `license` WRITE;
/*!40000 ALTER TABLE `license` DISABLE KEYS */;
/*!40000 ALTER TABLE `license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE `vehicle` (
  `registrationNumber` VARCHAR(32) NOT NULL UNIQUE,
  `dateOfPurchase` date DEFAULT NULL,
  `numberOfSeats` int DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `licenseCode` int DEFAULT NOT NULL,
  PRIMARY KEY (`registrationNumber`),
  KEY `licenseCode` (`licenseCode`),
  CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`licenseCode`) REFERENCES `license` (`licenseCode`)
);

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiclebooking`
--

DROP TABLE IF EXISTS `vehiclebooking`;
CREATE TABLE `vehiclebooking` (
  `bookingID` int NOT NULL,
  `registrationNumber` VARCHAR(32) NOT NULL,
  KEY `bookingID` (`bookingID`),
  KEY `registrationNumber` (`registrationNumber`),
  CONSTRAINT `vehiclebooking_ibfk_1` FOREIGN KEY (`bookingID`) REFERENCES `booking` (`bookingID`),
  CONSTRAINT `vehiclebooking_ibfk_2` FOREIGN KEY (`registrationNumber`) REFERENCES `vehicle` (`registrationNumber`)
);

--
-- Dumping data for table `vehiclebooking`
--

LOCK TABLES `vehiclebooking` WRITE;
/*!40000 ALTER TABLE `vehiclebooking` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehiclebooking` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `driverlicense`
--

DROP TABLE IF EXISTS `driverlicense`;
CREATE TABLE `driverlicense` (
  `licenseCode` int DEFAULT NULL,
  `driverID` int DEFAULT NULL,
  KEY `licenseCode` (`licenseCode`),
  KEY `driverID` (`driverID`),
  FOREIGN KEY (`licenseCode`) REFERENCES `license` (`licenseCode`),
  FOREIGN KEY (`driverID`) REFERENCES `driver` (`driverID`)
);

--
-- Dumping data for table `driverlicense`
--

LOCK TABLES `driverlicense` WRITE;
/*!40000 ALTER TABLE `driverlicense` DISABLE KEYS */;
/*!40000 ALTER TABLE `driverlicense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `bookingID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `initialCollectionPoint` varchar(255) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `numberOfPassengers` int DEFAULT NULL,
  `clientID` int DEFAULT NULL,
  `driverID` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`bookingID`),
  KEY `clientID` (`clientID`),
  KEY `driverID` (`driverID`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`driverID`) REFERENCES `driver` (`driverID`)
);

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;


-- New tables: 'sys_user' and 'address'
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `userID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL UNIQUE,
  `password` varchar(255) DEFAULT NULL,
  `userTypeCd` int DEFAULT NULL,
  PRIMARY KEY (`userID`)
);