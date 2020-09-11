
CREATE DATABASE IF NOT EXISTS database_name;
USE blackpeakltd;-

--
-- Table structure for table `user` and `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `userRoleID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `accessLevel`''
) 

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userID` int NOT NULL AUTO_INCREMENT UNIQUE,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  'userRoleID' int DEFAULT NULL,
  PRIMARY KEY (`userID`),
  FOREIGN KEY (`userRoleID`) REFERENCES `user_role` (`userRoleID`)
);
