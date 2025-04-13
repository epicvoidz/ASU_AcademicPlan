-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 28, 2025 at 06:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs_ite_ma_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cs_ite_course_catalog_jan30`
--

CREATE TABLE `cs_ite_course_catalog_jan30` (
  `COL 1` varchar(14) DEFAULT NULL,
  `COL 2` varchar(64) DEFAULT NULL,
  `COL 3` varchar(8) DEFAULT NULL,
  `COL 4` varchar(8) DEFAULT NULL,
  `COL 5` varchar(8) DEFAULT NULL,
  `COL 6` varchar(9) DEFAULT NULL,
  `COL 7` varchar(7) DEFAULT NULL,
  `COL 8` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cs_ite_course_catalog_jan30`
--

INSERT INTO `cs_ite_course_catalog_jan30` (`COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`) VALUES
('courseNum', 'courseName', 'Fall_Odd', 'Spr_Even', 'Sum_Even', 'Fall_Even', 'Spr_Odd', 'Sum_Odd'),
('CS305', 'Concepts of Computer Programming', 'DL', 'SCN', 'DL', 'DL', 'SCD', 'DL'),
('CS307', 'Foundations of Web Development', '', 'DL', '', '', 'DL', ''),
('CS309/CS309L', 'Introduction to Digital Logic Design/Digital Design Lab', 'CN', 'CD', 'DL', 'CN', 'CD', 'DL'),
('CS310', 'Professional Ethics of Computing', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('CS317', 'Computer Science I', 'SCN', 'SCD', 'DL', 'SCN', 'SCD', 'DL'),
('CS318', 'Computer Science II', 'SCN', 'SCD', 'SCN', 'SCD', 'SCN', 'SCN'),
('CS340', 'Introduction to Assembly Language and Computer Organization', '', 'CD', 'CD', '', 'CD', 'CD'),
('CS365/ITE365', 'Visual Application Development', 'DL', '', '', 'DL', '', ''),
('CS367/ITE367', 'Enterprise Appliccation Development', '', '', '', '', 'CN', ''),
('CS372', 'Data Structures (Computer Science III)', 'SCN', 'SCD', 'SCN', 'SCD', 'SCN', 'SCN'),
('CS380', 'Programming for the Web', '', '', 'BL', '', '', 'BL'),
('CS382/ITE382', 'Mobile Device Software Development', '', 'CN', '', '', 'CN', ''),
('CS385', 'Pragmatic Artificial Intelligence – Cloud Based Machine Learning', '', '', '', 'DL', '', ''),
('CS409', 'Computer Organization and Architecture', 'CN', '', '', 'CN', '', ''),
('CS414', 'Programming Language', 'CD', '', '', 'CN', '', ''),
('CS415', 'Operating Systems', '', 'SCN', '', '', 'SCD', ''),
('CS417', 'Topics in Object Oriented Programming', 'SCN', '', '', 'SCD', '', ''),
('CS418', 'Advanced Object Oriented Applications', '', '', '', '', '', ''),
('CS423', 'Computer Graphics/Game Design', 'CN', '', '', '', '', ''),
('CS451', 'Software Engineering', 'DL', '', 'DL', 'DL', '', 'DL'),
('CS452/CS452L', 'Senior Software Engineering Project/SSEP Lab', 'BL', 'BL', '', 'BL', 'BL', ''),
('CS454', 'System Security Management', '', '', 'DL', '', '', 'DL'),
('CS462', 'Directed Study/Special Computer Science Project', '', '', '', '', '', ''),
('CS472', 'Analysis of Algorithms', '', 'SCN', '', '', 'SCN', ''),
('CS474', 'Introduction to Formal Language Theory', '', '', '', '', '', ''),
('CS475', 'Introduction to the Theory of Computing', '', '', 'SCD', '', '', ''),
('CS484', 'Applied Cryptography and System Security', 'DL', '', '', 'DL', '', ''),
('CS485', 'Modern Artificial Intelligence', '', '', '', '', '', 'SCN'),
('CS486', 'Natural Language Processing', '', '', '', '', '', 'SCN'),
('CS487', 'Robotics', '', '', '', 'CN', '', ''),
('CS488', 'AI Reasoning, Decisions, and Learning', '', '', '', '', '', ''),
('CS489', 'Soft Computing and Fuzzy Logic', '', '', '', '', '', ''),
('ITE301', 'Problem Solving with Computers', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('ITE305', 'Networking Fundamentals', 'CN', '', 'CN', 'CN', '', 'CN'),
('ITE306', 'Local Area Networks', 'CN', '', 'CN', 'CN', '', 'CN'),
('ITE307', 'Wide Area Networks', '', 'CN', '', '', 'CN', ''),
('ITE308', 'Network Architectures', '', 'CN', '', '', 'CN', ''),
('ITE313', 'Data Analysis & Visualization', '', 'DL', '', '', 'DL', ''),
('ITE315', 'Scripting Languages and System Administration', '', '', 'CN', '', '', 'DL'),
('ITE321', 'System Analysis & Design', 'DL', '', '', 'DL', '', ''),
('ITE327/ITE327L', 'Database Systems/Database Systems Lab', 'CN', '', 'DL', 'CN', '', 'DL'),
('ITE350', 'UX Design', '', '', 'DL', '', '', 'DL'),
('ITE365/CS365', 'Visual Application Develop', '', '', '', '', '', ''),
('ITE367/CS367', 'Enterprise Application Development', '', '', '', '', '', ''),
('ITE371', 'Health Information Technology Concepts and Practices', '', '', '', '', 'DL', ''),
('ITE382/CS382', 'Mobile Device Software Development', '', '', '', '', '', ''),
('ITE405', 'Internetworking Devices', '', 'CN', '', '', 'CN', ''),
('ITE406', 'The Internet', '', 'CN', '', '', 'CN', ''),
('ITE407', 'Network Processes and Protocols', '', '', 'CN', '', '', 'CN'),
('ITE408', 'Enterprise Network Design and Management', '', '', 'CN', '', '', 'CN'),
('ITE451', 'Software Engineering', 'DL', '', 'DL', 'DL', '', 'DL'),
('ITE452', 'Senior Software Engineering Project', 'BL', 'BL', '', 'BL', 'BL', '');

-- --------------------------------------------------------

--
-- Table structure for table `cs_ite_ma_courses`
--

CREATE TABLE `cs_ite_ma_courses` (
  `COL 1` varchar(14) DEFAULT NULL,
  `COL 2` varchar(66) DEFAULT NULL,
  `COL 3` varchar(8) DEFAULT NULL,
  `COL 4` varchar(8) DEFAULT NULL,
  `COL 5` varchar(8) DEFAULT NULL,
  `COL 6` varchar(9) DEFAULT NULL,
  `COL 7` varchar(7) DEFAULT NULL,
  `COL 8` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cs_ite_ma_courses`
--

INSERT INTO `cs_ite_ma_courses` (`COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`) VALUES
('courseNum', 'courseName', 'Fall_Odd', 'Spr_Even', 'Sum_Even', 'Fall_Even', 'Spr_Odd', 'Sum_Odd'),
('CS307', 'Foundations of Web Development', '', 'DL', '', '', 'DL', ''),
('CS309/CS309L', 'Introduction to Digital Logic Design/Digital Design Lab', 'CN', 'CD', 'DL', 'CN', 'CD', 'DL'),
('CS310', 'Professional Ethics of Computing', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('CS317', 'Computer Science I', 'SCN', 'SCD', 'DL', 'SCN', 'SCD', 'DL'),
('CS318', 'Computer Science II', 'SCN', 'SND', 'SCN', 'SCD', 'SCN', 'SCN'),
('CS340', 'Introduction to Assembly Language and Computer Organization', '', 'CD', 'CD', '', 'CD', 'CD'),
('CS365/ITE365', 'Visual Application Development', 'DL', '', '', 'DL', '', ''),
('CS367/ITE367', 'Enterprise Appliccation Development', '', '', '', '', 'CN', ''),
('CS372', 'Data Structures (Computer Science III)', 'SCN', 'SCD', 'SCN', 'SCD', 'SCN', 'SCN'),
('CS380', 'Programming for the Web', '', '', 'BL', '', '', 'BL'),
('CS382/ITE382', 'Mobile Device Software Development', '', 'CN', '', '', 'CN', ''),
('CS385', 'Pragmatic Artificial Intelligence â€“ Cloud Based Machine Learning', '', '', '', 'DL', '', ''),
('CS409', 'Computer Organization and Architecture', 'CN', '', '', 'CN', '', ''),
('CS414', 'Programming Language', 'CD', '', '', 'CN', '', ''),
('CS415', 'Operating Systems', '', 'SCN', '', '', 'SCD', ''),
('CS417', 'Topics in Object Oriented Programming', 'SCN', '', '', 'SCD', '', ''),
('CS418', 'Advanced Object Oriented Applications', '', '', '', '', '', ''),
('CS423', 'Computer Graphics/Game Design', 'CN', '', '', '', '', ''),
('CS451', 'Software Engineering', 'DL', '', 'DL', 'DL', '', 'DL'),
('CS452/CS452L', 'Senior Software Engineering Project/SSEP Lab', 'BL', 'BL', '', 'BL', 'BL', ''),
('CS454', 'System Security Management', '', '', 'DL', '', '', 'DL'),
('CS462', 'Directed Study/Special Computer Science Project', '', '', '', '', '', ''),
('CS472', 'Analysis of Algorithms', '', 'SCN', '', '', 'SCN', ''),
('CS474', 'Introduction to Formal Language Theory', '', '', '', '', '', ''),
('CS475', 'Introduction to the Theory of Computing', '', '', 'SCD', '', '', ''),
('CS484', 'Applied Cryptography and System Security', 'DL', '', '', 'DL', '', ''),
('CS485', 'Modern Artificial Intelligence', '', '', '', '', '', 'SCN'),
('CS486', 'Natural Language Processing', '', '', '', '', '', 'SCN'),
('CS487', 'Robotics', '', '', '', 'CN', '', ''),
('CS488', 'AI Reasoning, Decisions, and Learning', '', '', '', '', '', ''),
('CS489', 'Soft Computing and Fuzzy Logic', '', '', '', '', '', ''),
('ITE301', 'Problem Solving with Computers', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('ITE305', 'Networking Fundamentals', 'CN', '', 'CN', 'CN', '', 'CN'),
('ITE306', 'Local Area Networks', 'CN', '', 'CN', 'CN', '', 'CN'),
('ITE307', 'Wide Area Networks', '', 'CN', '', '', 'CN', ''),
('ITE308', 'Network Architectures', '', 'CN', '', '', 'CN', ''),
('ITE313', 'Data Analysis & Visualization', '', 'DL', '', '', 'DL', ''),
('ITE315', 'Scripting Languages and System Administration', '', '', 'CN', '', '', 'DL'),
('ITE321', 'System Analysis & Design', 'DL', '', '', 'DL', '', ''),
('ITE327/ITE327L', 'Database Systems/Database Systems Lab', 'CN', '', 'DL', 'CN', '', 'DL'),
('ITE350', 'UX Design', '', '', 'DL', '', '', 'DL'),
('ITE365/CS365', 'Visual Application Develop', '', '', '', '', '', ''),
('ITE367/CS367', 'Enterprise Application Development', '', '', '', '', '', ''),
('ITE371', 'Health Information Technology Concepts and Practices', '', '', '', '', 'DL', ''),
('ITE382/CS382', 'Mobile Device Software Development', '', '', '', '', '', ''),
('ITE405', 'Internetworking Devices', '', 'CN', '', '', 'CN', ''),
('ITE406', 'The Internet', '', 'CN', '', '', 'CN', ''),
('ITE407', 'Network Processes and Protocols', '', '', 'CN', '', '', 'CN'),
('ITE408', 'Enterprise Network Design and Management', '', '', 'CN', '', '', 'CN'),
('ITE441', 'System Integration & Architecture', ' \"', ' DL', ' \"', ' \"', ' DL', ' \"'),
('ITE450', 'Human Computer Interaction', ' \"', ' DL', ' \"', ' \"', ' DL', ' \"'),
('ITE451', 'Software Engineering', 'DL', '', 'DL', 'DL', '', 'DL'),
('ITE452', 'Senior Software Engineering Project', 'BL', 'BL', '', 'BL', 'BL', ''),
('MA308', 'Discrete Mathematics', ' D', ' BL', ' BL', ' D', ' BL', ' BL'),
('MA310', 'Matrices & Linear Algebra', 'D', '', 'BL', 'D', '', 'BL'),
('MA331', 'Applied Probability & Statistics', 'BL', 'BL', '', 'BL', 'BL', ''),
('UNV300', 'Pathways to Success', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('UNV400', 'Career Seminar', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('Elective1', 'Elective1', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('Elective2', 'Elective2', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('Elective3', 'Elective3', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('Elective4', 'Elective4', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL'),
('Elective5', 'Elective5', 'DL', 'DL', 'DL', 'DL', 'DL', 'DL');

-- --------------------------------------------------------

--
-- Table structure for table `ma_course_catalog`
--

CREATE TABLE `ma_course_catalog` (
  `COL 1` varchar(9) DEFAULT NULL,
  `COL 2` varchar(74) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ma_course_catalog`
--

INSERT INTO `ma_course_catalog` (`COL 1`, `COL 2`) VALUES
('courseNum', 'courseName'),
('MA301', 'Precalculus Algebra'),
('MA302', 'Precalculus Trigonometry'),
('MA303', 'Calculus I'),
('MA304', 'Calculus II'),
('MA305', 'Calculus III'),
('MA308', 'Discrete Mathematics'),
('MA309', 'Business Calculus'),
('MA310', 'Matrices and Linear Algebra'),
('MA311', 'Advanced Mathematics for Teachers'),
('MA314', 'College Geometry'),
('MA320', 'Introduction to Abstract Algebra'),
('MA321', 'Differential Equations'),
('MA330', 'Advanced Mathematical Software'),
('MA331', 'Applied Probability and Statistics'),
('MA380', 'Functions and Modeling'),
('MA401', 'Complex Variables'),
('MA422', 'Operations Research'),
('MA423', 'Numerical Analysis'),
('MA431', 'Introduction to Mathematical Statistics'),
('MA445', 'Mathematical Modeling and Simulation'),
('MA452', 'Introductory Real Analysis'),
('MA454', 'Materials and Methods of Teaching Mathematics in Middle School/High School'),
('MA470', 'Senior Mathematics Seminar'),
('MA480', 'Special Topics in Mathematics');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
