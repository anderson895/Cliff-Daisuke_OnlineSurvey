-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 10:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinesurvey`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminaccount`
--

CREATE TABLE `adminaccount` (
  `ID` int(6) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `PASSWORD` varchar(61) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adminaccount`
--

INSERT INTO `adminaccount` (`ID`, `NAME`, `EMAIL`, `PASSWORD`) VALUES
(1, 'Administrator', 'admin', '$2y$10$8tCsH8cmrWTYBIlTWvsLYeTQx.OtYRj16SOnaGPHCSs3cJm1m1482'),
(13, 'edward', 'admin3', '$2y$10$zXX6SbZId3K1UGYcO89VeuQ/nID.RRlAXzHRDXBpb06kqV9ifUtvC');

-- --------------------------------------------------------

--
-- Table structure for table `answerby`
--

CREATE TABLE `answerby` (
  `ID` int(6) NOT NULL,
  `ATT` int(10) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `CLIENTTYPE` varchar(15) NOT NULL,
  `GENDER` varchar(7) NOT NULL,
  `AGE` int(2) NOT NULL,
  `REGION` varchar(25) NOT NULL,
  `SERVICEAVAIL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ccanswer`
--

CREATE TABLE `ccanswer` (
  `ID` int(11) NOT NULL,
  `DATEANSWER` varchar(20) NOT NULL,
  `CHOICEANSWER` varchar(5) NOT NULL,
  `QUE` varchar(10) NOT NULL,
  `ANSWERBY` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `choicecc`
--

CREATE TABLE `choicecc` (
  `ID` int(6) NOT NULL,
  `ccid` varchar(20) NOT NULL,
  `CHOICE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `choicecc`
--

INSERT INTO `choicecc` (`ID`, `ccid`, `CHOICE`) VALUES
(6, '5', 'Easy to See'),
(7, '5', 'Somewhat easy to see'),
(8, '5', 'Difficult to See'),
(9, '5', 'Not visible at all'),
(10, '5', 'N/A'),
(11, '7', 'Helped very much'),
(12, '7', 'Somewhat helped'),
(13, '7', 'Did not help'),
(15, '7', 'N/A'),
(16, '8', 'Oo?'),
(17, '8', 'Medyo'),
(18, '8', 'Hindi'),
(19, '8', 'Ewan'),
(20, '4', 'Yes,aware before my transaction with this office'),
(21, '4', 'Yes,but aware only when I saw the CC of this office'),
(22, '4', 'No, not aware of the CC');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(6) NOT NULL,
  `ANSID` varchar(3) NOT NULL,
  `COMMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questioncc`
--

CREATE TABLE `questioncc` (
  `ID` int(6) NOT NULL,
  `TITLE` varchar(20) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questioncc`
--

INSERT INTO `questioncc` (`ID`, `TITLE`, `DESCRIPTION`) VALUES
(4, 'CC1', 'Do you know about the Citizens Charter(document of an agency\'s services and reqs.)?'),
(5, 'CC2', 'If Yes to the previous question, did you see this office\'s Citizens\'s Charter?'),
(7, 'CC3', 'If Yes to the previous question,did you use the Citizen\'s Charter as a guide?');

-- --------------------------------------------------------

--
-- Table structure for table `sqtags`
--

CREATE TABLE `sqtags` (
  `ID` int(6) NOT NULL,
  `TAGS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveyanswer`
--

CREATE TABLE `surveyanswer` (
  `ID` int(6) NOT NULL,
  `DATEANSWER` varchar(20) NOT NULL,
  `CHOICESCORE` varchar(10) NOT NULL,
  `QUESTION` varchar(20) NOT NULL,
  `ANSWERBY` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveyquestion`
--

CREATE TABLE `surveyquestion` (
  `ID` int(6) NOT NULL,
  `TITLE` varchar(20) NOT NULL,
  `QUESTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `surveyquestion`
--

INSERT INTO `surveyquestion` (`ID`, `TITLE`, `QUESTION`) VALUES
(2, 'SQD1', 'I spent an acceptable amount of the time to complete my transaction.(Responsiveness)'),
(3, 'SQD2', 'The office  accurately informed and followed the transaction\'s requirements and steps.(Reliability)'),
(4, 'SQD3', 'My online transaction (including steps and payment) was simple and convenient (Access and Facilities)'),
(5, 'SQD4', 'I easily  found the information about my transaction from the office or its website(Communication)'),
(6, 'SQD5', 'I paid an acceptable amount of fees for my transaction. (Costs)'),
(7, 'SQD6', 'I am confident my online transaction was secure(Integrity)'),
(8, 'SQD7', 'The office\'s online support was available, or (if asked questions) online support was quick to respond (Assurance).'),
(9, 'SQD8', 'I got what i needed from the goverment office(Outcome)'),
(12, 'ngiii', 'wazzup');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaccount`
--
ALTER TABLE `adminaccount`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `answerby`
--
ALTER TABLE `answerby`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ccanswer`
--
ALTER TABLE `ccanswer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `choicecc`
--
ALTER TABLE `choicecc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `questioncc`
--
ALTER TABLE `questioncc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sqtags`
--
ALTER TABLE `sqtags`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `surveyanswer`
--
ALTER TABLE `surveyanswer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `surveyquestion`
--
ALTER TABLE `surveyquestion`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminaccount`
--
ALTER TABLE `adminaccount`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `answerby`
--
ALTER TABLE `answerby`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ccanswer`
--
ALTER TABLE `ccanswer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `choicecc`
--
ALTER TABLE `choicecc`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questioncc`
--
ALTER TABLE `questioncc`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sqtags`
--
ALTER TABLE `sqtags`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveyanswer`
--
ALTER TABLE `surveyanswer`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveyquestion`
--
ALTER TABLE `surveyquestion`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
