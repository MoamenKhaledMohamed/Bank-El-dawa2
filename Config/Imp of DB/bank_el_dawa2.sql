-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2020 at 04:20 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank el dawa2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activites`
--

CREATE TABLE `activites` (
  `ID_Act` int(11) NOT NULL,
  `NameOfEvent` varchar(40) DEFAULT NULL,
  `Type_Event` varchar(40) DEFAULT NULL,
  `Palce` varchar(40) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activites_voulnteers`
--

CREATE TABLE `activites_voulnteers` (
  `ID_Voul` int(14) NOT NULL,
  `ID_Act` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `UserType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `ID_Dep` int(4) NOT NULL,
  `Name` varchar(40) DEFAULT NULL,
  `ID_Employee` int(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`ID_Dep`, `Name`, `ID_Employee`) VALUES
(32131, 'erydyfdy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donners`
--

CREATE TABLE `donners` (
  `ID_Donner` int(14) NOT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Country` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID_Employee` int(14) NOT NULL,
  `Salary` int(15) DEFAULT NULL,
  `ID_Dep` int(4) DEFAULT NULL,
  `Image_profile` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `needy`
--

CREATE TABLE `needy` (
  `ID_Needy` int(14) NOT NULL,
  `Subvention_Type` varchar(40) DEFAULT NULL,
  `Image_Profile` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `ID` int(14) NOT NULL,
  `Phone` int(12) NOT NULL,
  `Job` varchar(30) NOT NULL,
  `Qualification` varchar(30) NOT NULL,
  `Age` int(3) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Id_Needy` int(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `ID_Tool` int(11) NOT NULL,
  `Name_Tool` varchar(200) DEFAULT NULL,
  `TypeTool` varchar(30) DEFAULT NULL,
  `Quantatiy` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tools_given`
--

CREATE TABLE `tools_given` (
  `ID_Tool_Given` int(11) NOT NULL,
  `ID_Donner` int(14) DEFAULT NULL,
  `DateIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tools_taken`
--

CREATE TABLE `tools_taken` (
  `ID_Tool_Taken` int(11) NOT NULL,
  `ID_Needy` int(14) DEFAULT NULL,
  `DateOut` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voulnteers`
--

CREATE TABLE `voulnteers` (
  `ID_Voul` int(14) NOT NULL,
  `specialty` varchar(40) DEFAULT NULL,
  `Level` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`ID_Act`);

--
-- Indexes for table `activites_voulnteers`
--
ALTER TABLE `activites_voulnteers`
  ADD PRIMARY KEY (`ID_Voul`,`ID_Act`),
  ADD KEY `ID_Act` (`ID_Act`);

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`UserName`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`ID_Dep`),
  ADD UNIQUE KEY `ID_Employee` (`ID_Employee`);

--
-- Indexes for table `donners`
--
ALTER TABLE `donners`
  ADD PRIMARY KEY (`ID_Donner`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID_Employee`),
  ADD KEY `ID_Dep` (`ID_Dep`);

--
-- Indexes for table `needy`
--
ALTER TABLE `needy`
  ADD PRIMARY KEY (`ID_Needy`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Id_Needy` (`Id_Needy`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`ID_Tool`);

--
-- Indexes for table `tools_given`
--
ALTER TABLE `tools_given`
  ADD PRIMARY KEY (`ID_Tool_Given`),
  ADD KEY `ID_Donner` (`ID_Donner`);

--
-- Indexes for table `tools_taken`
--
ALTER TABLE `tools_taken`
  ADD PRIMARY KEY (`ID_Tool_Taken`),
  ADD KEY `ID_Needy` (`ID_Needy`);

--
-- Indexes for table `voulnteers`
--
ALTER TABLE `voulnteers`
  ADD PRIMARY KEY (`ID_Voul`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activites_voulnteers`
--
ALTER TABLE `activites_voulnteers`
  ADD CONSTRAINT `activites_voulnteers_ibfk_1` FOREIGN KEY (`ID_Voul`) REFERENCES `voulnteers` (`ID_Voul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activites_voulnteers_ibfk_2` FOREIGN KEY (`ID_Act`) REFERENCES `activites` (`ID_Act`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`ID_Employee`) REFERENCES `employees` (`ID_Employee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donners`
--
ALTER TABLE `donners`
  ADD CONSTRAINT `donners_ibfk_1` FOREIGN KEY (`ID_Donner`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`ID_Employee`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`ID_Dep`) REFERENCES `departement` (`ID_Dep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `needy`
--
ALTER TABLE `needy`
  ADD CONSTRAINT `needy_ibfk_1` FOREIGN KEY (`ID_Needy`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`Id_Needy`) REFERENCES `needy` (`ID_Needy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tools_given`
--
ALTER TABLE `tools_given`
  ADD CONSTRAINT `tools_given_ibfk_1` FOREIGN KEY (`ID_Tool_Given`) REFERENCES `tools` (`ID_Tool`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tools_given_ibfk_2` FOREIGN KEY (`ID_Donner`) REFERENCES `donners` (`ID_Donner`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tools_taken`
--
ALTER TABLE `tools_taken`
  ADD CONSTRAINT `tools_taken_ibfk_1` FOREIGN KEY (`ID_Tool_Taken`) REFERENCES `tools` (`ID_Tool`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tools_taken_ibfk_2` FOREIGN KEY (`ID_Needy`) REFERENCES `needy` (`ID_Needy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `voulnteers`
--
ALTER TABLE `voulnteers`
  ADD CONSTRAINT `voulnteers_ibfk_1` FOREIGN KEY (`ID_Voul`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
