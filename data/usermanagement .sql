-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 09:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermanagement`
--
CREATE DATABASE IF NOT EXISTS usermanagement; USE usermanagement;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `USERID` int(11) NOT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `USERID` int(11) NOT NULL,
  `AGE` int(11) DEFAULT NULL,
  `GENDER` varchar(255) DEFAULT NULL,
  `FNAME` varchar(255) DEFAULT NULL,
  `LNAME` varchar(255) DEFAULT NULL,
  `MOBILENUM` varchar(20) DEFAULT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `USERID` int(11) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL,
  `NUMEMPLOYEES` int(11) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companylocation`
--

CREATE TABLE `companylocation` (
  `LOCACATION` varchar(255) NOT NULL,
  `LOCATIONID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fill`
--

CREATE TABLE `fill` (
  `USERID` int(11) NOT NULL,
  `FORMID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `FORMID` int(11) NOT NULL,
  `JOBID` int(11) DEFAULT NULL,
  `JOBVACID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasskills`
--

CREATE TABLE `hasskills` (
  `USERID` int(11) NOT NULL,
  `SKILLID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `INTERESTS` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `COM_USERID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobvacancy`
--

CREATE TABLE `jobvacancy` (
  `TYPE` varchar(255) DEFAULT NULL,
  `TITLE` varchar(255) DEFAULT NULL,
  `DESCRIPTION` varchar(1024) DEFAULT NULL,
  `JOBID` int(11) NOT NULL,
  `FORMID` int(11) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `COMPID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `REQUIREMENTS` varchar(255) NOT NULL,
  `VACANCYID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `SKILL` varchar(255) NOT NULL,
  `SKILLID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `companylocation`
--
ALTER TABLE `companylocation`
  ADD PRIMARY KEY (`LOCATIONID`),
  ADD KEY `FK_HASLOCATION` (`USERID`);

--
-- Indexes for table `fill`
--
ALTER TABLE `fill`
  ADD PRIMARY KEY (`USERID`,`FORMID`),
  ADD KEY `FK_FILL2` (`FORMID`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`FORMID`),
  ADD KEY `FK_INITIATE` (`JOBID`);

--
-- Indexes for table `hasskills`
--
ALTER TABLE `hasskills`
  ADD PRIMARY KEY (`USERID`,`SKILLID`),
  ADD KEY `FK_HASSKILLS2` (`SKILLID`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_COMPANYINTERESTS` (`COM_USERID`),
  ADD KEY `FK_USERINTERESTS` (`USERID`);

--
-- Indexes for table `jobvacancy`
--
ALTER TABLE `jobvacancy`
  ADD PRIMARY KEY (`JOBID`),
  ADD KEY `FK_CREATE` (`USERID`),
  ADD KEY `FK_INITIATE2` (`FORMID`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`VACANCYID`),
  ADD KEY `FK_NEEDS` (`JOBID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`SKILLID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `companylocation`
--
ALTER TABLE `companylocation`
  MODIFY `LOCATIONID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `FORMID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobvacancy`
--
ALTER TABLE `jobvacancy`
  MODIFY `JOBID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `SKILLID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companylocation`
--
ALTER TABLE `companylocation`
  ADD CONSTRAINT `FK_HASLOCATION` FOREIGN KEY (`USERID`) REFERENCES `company` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fill`
--
ALTER TABLE `fill`
  ADD CONSTRAINT `FK_FILL2` FOREIGN KEY (`FORMID`) REFERENCES `applicant` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`USERID`) REFERENCES `applicant` (`USERID`);

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `FK_INITIATE` FOREIGN KEY (`JOBID`) REFERENCES `jobvacancy` (`JOBID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasskills`
--
ALTER TABLE `hasskills`
  ADD CONSTRAINT `fk_usesr_id` FOREIGN KEY (`USERID`) REFERENCES `applicant` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkk_skill_id` FOREIGN KEY (`SKILLID`) REFERENCES `skills` (`SKILLID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interest`
--
ALTER TABLE `interest`
  ADD CONSTRAINT `fk_int_user_id` FOREIGN KEY (`USERID`) REFERENCES `applicant` (`USERID`);

--
-- Constraints for table `jobvacancy`
--
ALTER TABLE `jobvacancy`
  ADD CONSTRAINT `FK_CREATE` FOREIGN KEY (`USERID`) REFERENCES `company` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_INITIATE2` FOREIGN KEY (`FORMID`) REFERENCES `form` (`FORMID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `FK_NEEDS` FOREIGN KEY (`JOBID`) REFERENCES `jobvacancy` (`JOBID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
