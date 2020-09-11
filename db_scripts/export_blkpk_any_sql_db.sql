-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: is3-dev.ict.ru.ac.za    Database: blackpeakltd
-- ------------------------------------------------------
-- Server version	8.0.20

CREATE DATABASE IF NOT EXISTS database_name;
USE blackpeakltd;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `clientID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL UNIQUE,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`clientID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daytrip` (
  `tripNumber` int NOT NULL AUTO_INCREMENT UNIQUE,
  `tripDate` date DEFAULT NULL,
  `bedRequest` varchar(255) DEFAULT NULL,
  `bookingID` int DEFAULT NULL,
  PRIMARY KEY (`tripNumber`),
  KEY `bookingID` (`bookingID`),
  CONSTRAINT `daytrip_ibfk_1` FOREIGN KEY (`bookingID`) REFERENCES `booking` (`bookingID`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `driver` (
  `driverID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `dateOFBirth` date DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(255) DEFAULT NULL,
  `licenseCode` int DEFAULT NULL,
  PRIMARY KEY (`driverID`),
  KEY `licenseCode` (`licenseCode`),
  CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`licenseCode`) REFERENCES `license` (`licenseCode`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `license` (
  `licenseCode` int NOT NULL UNIQUE,
  `description` varchar(255) DEFAULT NULL,
  `classification` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`licenseCode`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle` (
  `registrationNumber` int NOT NULL UNIQUE,
  `dateOfPurchase` date DEFAULT NULL,
  `numberOfSeats` int DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `licenseCode` int DEFAULT NULL,
  PRIMARY KEY (`registrationNumber`),
  KEY `licenseCode` (`licenseCode`),
  CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`licenseCode`) REFERENCES `license` (`licenseCode`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehiclebooking` (
  `bookingID` int DEFAULT NULL,
  `registrationNumber` int DEFAULT NULL,
  KEY `bookingID` (`bookingID`),
  KEY `registrationNumber` (`registrationNumber`),
  CONSTRAINT `vehiclebooking_ibfk_1` FOREIGN KEY (`bookingID`) REFERENCES `booking` (`bookingID`),
  CONSTRAINT `vehiclebooking_ibfk_2` FOREIGN KEY (`registrationNumber`) REFERENCES `vehicle` (`registrationNumber`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiclebooking`
--

LOCK TABLES `vehiclebooking` WRITE;
/*!40000 ALTER TABLE `vehiclebooking` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehiclebooking` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-09 17:16:24

--
-- Table structure for table `driverlicense`
--

DROP TABLE IF EXISTS `driverlicense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `driverlicense` (
  `licenseCode` int DEFAULT NULL,
  `driverID` int DEFAULT NULL,
  KEY `licenseCode` (`licenseCode`),
  KEY `driverID` (`driverID`),
  CONSTRAINT `driverlicense_ibfk_1` FOREIGN KEY (`licenseCode`) REFERENCES `license` (`licenseCode`),
  CONSTRAINT `driverlicense_ibfk_2` FOREIGN KEY (`driverID`) REFERENCES `driver` (`licenseCode`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `bookingID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `initialCollectionPoint` varchar(255) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `numberOfPassengers` int DEFAULT NULL,
  `clientID` int DEFAULT NULL,
  `driverID` int DEFAULT NULL,
  `registrationNumber` int DEFAULT NULL,
  PRIMARY KEY (`bookingID`),
  KEY `clientID` (`clientID`),
  KEY `driverID` (`driverID`),
  KEY `registrationNumber` (`registrationNumber`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`driverID`) REFERENCES `driver` (`driverID`),
  CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`registrationNumber`) REFERENCES `vehicle` (`registrationNumber`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;