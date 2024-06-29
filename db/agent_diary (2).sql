-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 11:05 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agent_diary`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accomodations`
--

CREATE TABLE `tbl_accomodations` (
  `accomodation_id` int(11) NOT NULL,
  `accomodation_name` varchar(255) DEFAULT NULL,
  `accomodation_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accomodations`
--

INSERT INTO `tbl_accomodations` (`accomodation_id`, `accomodation_name`, `accomodation_status`, `created_at`, `updated_at`) VALUES
(1, '1 BHK', 1, '1573473982', '1573473982'),
(2, '2 BHK', 1, '1573473989', '1573473989'),
(3, '3 BHK', 1, '1573473996', '1573473996'),
(4, '4 BHK', 1, '1573474003', '1573474003'),
(5, '3 BHK + Servant ', 1, '1573474016', '1573474016'),
(6, '2 BHK + Study', 1, '1583565599', '1583565599'),
(7, '3 BHK + Study', 1, '1583565613', '1583565613'),
(8, '4 BHK + Study', 1, '1583565627', '1583565627'),
(9, '2 BHK + Study + Servent', 1, '1719110158', '1719110158'),
(10, '3 BHK + Study + Servent', 1, '1719110175', '1719110175'),
(11, '4 BHK + Study + Servent', 1, '1719110192', '1719110192'),
(12, '2 BHK + Servent', 1, '1719110240', '1719110240'),
(13, '4 BHK + Servent', 1, '1719110287', '1719110287');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_additional_cost`
--

CREATE TABLE `tbl_additional_cost` (
  `additional_cost_id` int(11) NOT NULL,
  `product_additional_detail_id` int(11) DEFAULT NULL,
  `product_unit_detail_id` int(11) DEFAULT NULL,
  `current_rate` varchar(255) NOT NULL,
  `current_rate_unit` varchar(255) DEFAULT NULL,
  `current_rate_gst` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_additional_parking_cost`
--

CREATE TABLE `tbl_additional_parking_cost` (
  `additional_parking_cost_id` int(11) NOT NULL,
  `product_unit_detail_id` int(11) DEFAULT NULL,
  `current_rate` varchar(255) NOT NULL,
  `current_rate_unit` varchar(255) DEFAULT NULL,
  `current_rate_gst` varchar(255) DEFAULT NULL,
  `add_o_price` varchar(255) DEFAULT NULL,
  `add_s_price` varchar(255) DEFAULT NULL,
  `add_b_price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_additional_plc_cost`
--

CREATE TABLE `tbl_additional_plc_cost` (
  `additional_plc_cost_id` int(11) NOT NULL,
  `product_plc_detail_id` int(11) DEFAULT NULL,
  `product_unit_detail_id` int(11) DEFAULT NULL,
  `current_rate` varchar(255) NOT NULL,
  `current_rate_unit` varchar(255) DEFAULT NULL,
  `current_rate_gst` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_roles`
--

CREATE TABLE `tbl_admin_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `role_status` tinyint(1) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_roles`
--

INSERT INTO `tbl_admin_roles` (`role_id`, `role_name`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '1573276249', '1573276249');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_teams`
--

CREATE TABLE `tbl_admin_teams` (
  `team_id` int(11) NOT NULL,
  `team_title` varchar(255) DEFAULT NULL,
  `team_first_name` varchar(255) DEFAULT NULL,
  `team_last_name` varchar(255) DEFAULT NULL,
  `team_email` varchar(255) DEFAULT NULL,
  `team_user_id` varchar(255) DEFAULT NULL,
  `team_password` varchar(255) DEFAULT NULL,
  `team_hash` varchar(255) DEFAULT NULL,
  `team_mobile` varchar(255) DEFAULT NULL,
  `team_whatsapp_no` varchar(255) DEFAULT NULL,
  `team_role_id` varchar(255) DEFAULT NULL,
  `work_time_from` varchar(255) DEFAULT NULL,
  `work_time_to` varchar(255) DEFAULT NULL,
  `date_register` varchar(255) DEFAULT NULL,
  `team_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_teams`
--

INSERT INTO `tbl_admin_teams` (`team_id`, `team_title`, `team_first_name`, `team_last_name`, `team_email`, `team_user_id`, `team_password`, `team_hash`, `team_mobile`, `team_whatsapp_no`, `team_role_id`, `work_time_from`, `work_time_to`, `date_register`, `team_status`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'Rakesh', 'Kumar', 'admin@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e1', '949ba59ab949ba59abbe56e057f20949ba59abbe56e057f20be56e057f20', '7793042536', '', '1', '08:00', '06:00', '09-11-2019', 1, '1573276500', '1573276808'),
(2, 'Mr', 'Mukesh', 'Kumar', 'mukesh@gmail.com', 'mukesh', 'e10adc3949ba59abbe56e057f20f883e2', '949ba59abbe56e057f20949ba59abbe56e057f20', '9999999999', '9999999999', '1', '08:00', '06:00', '09-11-2019', 1, '1573277253', '1573277533');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agents`
--

CREATE TABLE `tbl_agents` (
  `agent_id` int(11) NOT NULL,
  `agent_code` varchar(255) DEFAULT NULL,
  `agent_title` varchar(255) DEFAULT NULL,
  `agent_first_name` varchar(255) DEFAULT NULL,
  `agent_last_name` varchar(255) DEFAULT NULL,
  `sdw_title` varchar(255) DEFAULT NULL,
  `sdw_first_name` varchar(255) DEFAULT NULL,
  `sdw_last_name` varchar(255) DEFAULT NULL,
  `agent_email` varchar(255) DEFAULT NULL,
  `agent_user_id` varchar(255) DEFAULT NULL,
  `agent_password` varchar(255) DEFAULT NULL,
  `agent_hash` varchar(255) DEFAULT NULL,
  `agent_mobile` varchar(255) DEFAULT NULL,
  `agent_contact_no` varchar(255) DEFAULT NULL,
  `agent_whatsapp_no` varchar(255) DEFAULT NULL,
  `agent_role_id` varchar(255) DEFAULT NULL,
  `date_register` varchar(255) DEFAULT NULL,
  `agent_status` tinyint(1) DEFAULT 0,
  `builder_group_id` varchar(255) DEFAULT NULL,
  `agent_city_id` int(11) DEFAULT NULL,
  `agent_state_id` int(11) DEFAULT NULL,
  `agent_plan_id` int(11) DEFAULT NULL,
  `accept_terms` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:accept, 0:not accept',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `is_individual` tinyint(1) DEFAULT NULL COMMENT '1:Individual, 0: Non Individual',
  `firm_type_id` int(11) DEFAULT NULL,
  `firm_name` varchar(255) DEFAULT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `address_3` text DEFAULT NULL,
  `agent_country_id` int(11) DEFAULT NULL,
  `agent_contact_person` varchar(255) DEFAULT NULL,
  `rera_registered` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1: registered, 0:not registered',
  `rera_no` varchar(255) DEFAULT NULL,
  `owner_title` varchar(255) DEFAULT NULL,
  `owner_first_name` varchar(255) DEFAULT NULL,
  `owner_last_name` varchar(255) DEFAULT NULL,
  `owner_mobile` varchar(255) DEFAULT NULL,
  `owner_contact_no` varchar(255) DEFAULT NULL,
  `owner_whatsapp_no` varchar(255) DEFAULT NULL,
  `rera_dor` varchar(255) DEFAULT NULL,
  `rera_valid_till` varchar(255) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `adhar_no` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `tan_no` varchar(255) DEFAULT NULL,
  `cin_no` varchar(255) DEFAULT NULL,
  `agent_logo` varchar(255) DEFAULT NULL,
  `cin_image` varchar(255) DEFAULT NULL,
  `tan_image` varchar(255) DEFAULT NULL,
  `pan_image` varchar(255) DEFAULT NULL,
  `gst_image` varchar(255) DEFAULT NULL,
  `adhar_image` varchar(255) DEFAULT NULL,
  `rera_image` varchar(255) DEFAULT NULL,
  `agent_image` varchar(255) DEFAULT NULL,
  `associate_complete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_amenities`
--

CREATE TABLE `tbl_amenities` (
  `amenitie_id` int(11) NOT NULL,
  `amenitie_name` varchar(255) DEFAULT NULL,
  `amenitie_image` varchar(255) DEFAULT NULL,
  `amenitie_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_amenities`
--

INSERT INTO `tbl_amenities` (`amenitie_id`, `amenitie_name`, `amenitie_image`, `amenitie_status`, `created_at`, `updated_at`) VALUES
(1, 'Lift', 'c4d285b75abd1e1ba4c9713cf8c1fd0e.png', 1, '1573533175', '1573534900'),
(2, 'Maintenance Staff', 'd53e9da354becc4e4a21b1f5152f0842.png', 1, '1573533901', '1573534946'),
(3, 'Reserved Parking', '77e78516495bdb12b2f8f0c21145b1a0.png', 1, '1573534855', '1573534855'),
(4, 'Business Center', 'f5f2083b0f1c3485eccd5573d465fc95.png', 1, '1583564348', '1583564348'),
(5, 'GYM', '0a19ae6e1ac74250f9a1f1d01a6f6a81.png', 1, '1583564368', '1583564368'),
(6, 'Indore Games', '5a136806537df27327e35037181bfa2f.png', 1, '1583564391', '1583564391'),
(7, 'Firefighting Equipment', 'ebaed53d068d90c3ec0ca1c609230a91.png', 1, '1583564438', '1583564438'),
(8, 'Vastu Compliant', '5fd0f4d6235fc0634e825438327209e6.png', 1, '1583564469', '1583564469'),
(9, 'Swimming Pool', 'c89a502f71b13de85ea943b728c0522a.png', 1, '1583564494', '1583564494'),
(10, 'Shopping Center', 'ad8612552607a33192f72e0e5c866897.png', 1, '1583564598', '1583564598'),
(11, 'Open Theater', '863ef801ee840b319ae9fdc661f455bb.png', 1, '1583564634', '1583564634'),
(12, 'senior Citizen Park', '33e0c2dcf92a671c80c3b55fe171592e.png', 1, '1583564951', '1583564951'),
(13, 'Multipurpose Hall', '7616f1b25e03ef3de44c2d06ebce222c.png', 1, '1583565151', '1583565151'),
(14, 'Security', 'c33dd434e0eed3766f6e579037db83e4.png', 1, '1583565186', '1583565186'),
(15, 'Club House', '4fe22ce92cde7f36f16831b27b19178b.png', 1, '1583565205', '1583565205'),
(16, 'Kids Play Area', '8efd3f22e2be7563387ff6617b521b44.png', 1, '1583565220', '1583565220'),
(17, 'Power Backup', 'a7bcf492049c009ece226c1be239fe8f.png', 1, '1583565275', '1583565275'),
(18, 'Rain Water Harvesting', '240df6cc6c2ee5f603e165cecd04827d.png', 1, '1583565296', '1583565296');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_authorities`
--

CREATE TABLE `tbl_authorities` (
  `authority_id` int(11) NOT NULL,
  `authority_name` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `authority_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_authorities`
--

INSERT INTO `tbl_authorities` (`authority_id`, `authority_name`, `state_id`, `city_id`, `authority_status`, `created_at`, `updated_at`) VALUES
(1, 'JAIPUR DEVELOPMENT AUTHORITY', 8, 474, 1, '1573724562', '1574153296'),
(2, 'UIT', 8, 401, 1, '1574395718', '1574395718'),
(3, ' Gurugram Metropolitan Development Authority', 6, 347, 1, '1719112450', '1719112450'),
(4, 'Delhi Development Authority', 7, 361, 1, '1719112492', '1719112492');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_basic_cost`
--

CREATE TABLE `tbl_basic_cost` (
  `basic_cost_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `current_rate` varchar(255) DEFAULT NULL,
  `current_rate_unit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_basic_cost`
--

INSERT INTO `tbl_basic_cost` (`basic_cost_id`, `inventory_id`, `current_rate`, `current_rate_unit`) VALUES
(1, 2, '165000', '1'),
(2, 1, '19000', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookings`
--

CREATE TABLE `tbl_bookings` (
  `booking_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `sdw_title` varchar(255) DEFAULT NULL,
  `sdw` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `tower` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `accommodation` varchar(255) DEFAULT NULL,
  `deal_amount` varchar(255) DEFAULT NULL,
  `booking_amount` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `drawn_on` varchar(255) DEFAULT NULL,
  `booking_date` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `unit_no` varchar(255) DEFAULT NULL,
  `unit_ref_no` varchar(255) DEFAULT NULL,
  `inventory_id` varchar(255) DEFAULT NULL,
  `product_unit_detail_id` varchar(255) DEFAULT NULL,
  `booking_status` tinyint(1) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`booking_id`, `lead_id`, `customer_name`, `sdw_title`, `sdw`, `dob`, `address`, `state_id`, `city_id`, `project_id`, `tower`, `floor`, `size`, `accommodation`, `deal_amount`, `booking_amount`, `payment_mode`, `cheque_no`, `drawn_on`, `booking_date`, `remark`, `created_at`, `unit_no`, `unit_ref_no`, `inventory_id`, `product_unit_detail_id`, `booking_status`, `comment`, `account_id`, `user_id`) VALUES
(1, 39, 'Mr. Test Test', 'Mr.', 'test test test', '', '', '6', '347', '4', '', '', '2125 Sq.Ft', '3', '', '', '', '', '', '', '', '1718037046', '101', 'T-H/3BHk/2125/101', '5', '7', 0, NULL, 26, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_budgets`
--

CREATE TABLE `tbl_budgets` (
  `budget_id` int(11) NOT NULL,
  `budget_name` varchar(255) DEFAULT NULL,
  `budget_amount` varchar(255) DEFAULT NULL,
  `budget_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_budgets`
--

INSERT INTO `tbl_budgets` (`budget_id`, `budget_name`, `budget_amount`, `budget_status`, `created_at`, `updated_at`) VALUES
(1, '5 Lac', '500000', 1, '1574855207', '1574951207'),
(2, '10 Lac', '1000000', 1, '1574855217', '1574951214'),
(3, '15 Lac', '1500000', 1, '1574855224', '1574951221'),
(4, '20 Lac', '2000000', 1, '1574855254', '1574951229'),
(5, '25 Lac', '2500000', 1, '1574855262', '1574951236'),
(6, '30 Lac', '3000000', 1, '1574951251', '1574951251'),
(7, '35 Lac', '3500000', 1, '1574951266', '1574951266'),
(8, '40 Lac', '4000000', 1, '1574951276', '1574951276'),
(9, '45 Lac', '4500000', 1, '1574951288', '1574951288'),
(10, '50 Lac', '5000000', 1, '1574951299', '1574951299'),
(11, '60 Lac', '6000000', 1, '1574951308', '1574951308'),
(12, '70 Lac', '7000000', 1, '1574951317', '1574951317'),
(13, '80 Lac', '8000000', 1, '1574951326', '1574951326'),
(14, '90 Lac', '9000000', 1, '1574951336', '1574951336'),
(15, '1 Crore', '10000000', 1, '1574951365', '1574951365'),
(16, '1.25 Crore', '12500000', 1, '1574951401', '1574951401'),
(17, '1.5 Crore', '15000000', 1, '1574951411', '1574951411'),
(18, '1.75 Crore', '17500000', 1, '1574951424', '1574951424'),
(19, '2 Crore', '20000000', 1, '1574951432', '1574951432'),
(20, '2.5 Crore', '25000000', 1, '1574951441', '1574951441'),
(21, '3 Crore', '30000000', 1, '1574951454', '1574951454'),
(22, '3.5 Crore', '35000000', 1, '1574951463', '1574951463'),
(23, '4 Crore', '40000000', 1, '1574951471', '1574951471'),
(24, '4.5 Crore', '45000000', 1, '1574951485', '1574951485'),
(25, '5 Crore', '50000000', 1, '1574951500', '1574951500'),
(26, '6 Crore', '60000000', 1, '1574951508', '1574951508'),
(27, '7 Crore', '70000000', 1, '1574951520', '1574951520'),
(28, '8 Crore', '80000000', 1, '1574951527', '1574951527'),
(29, '9 Crore', '90000000', 1, '1574951537', '1574951537'),
(30, '10 Crore', '100000000', 1, '1574951544', '1574951544');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_builders`
--

CREATE TABLE `tbl_builders` (
  `builder_id` int(11) NOT NULL,
  `builder_email` varchar(255) DEFAULT NULL,
  `date_register` varchar(255) DEFAULT NULL,
  `builder_status` tinyint(1) DEFAULT 0,
  `builder_group_id` int(11) DEFAULT NULL,
  `builder_city_id` int(11) DEFAULT NULL,
  `builder_state_id` int(11) DEFAULT NULL,
  `director_name` varchar(255) DEFAULT NULL,
  `director_contact_no` varchar(255) DEFAULT NULL,
  `director_email` varchar(255) DEFAULT NULL,
  `representative_name` varchar(255) DEFAULT NULL,
  `representative_contact_no` varchar(255) DEFAULT NULL,
  `representative_email` varchar(255) DEFAULT NULL,
  `builder_logo` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `firm_type_id` int(11) DEFAULT NULL,
  `firm_name` varchar(255) DEFAULT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `address_3` text DEFAULT NULL,
  `builder_country_id` int(11) DEFAULT NULL,
  `builder_mobile` varchar(255) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `pan_image` varchar(255) DEFAULT NULL,
  `adhar_no` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `gst_image` varchar(255) DEFAULT NULL,
  `tan_no` varchar(255) DEFAULT NULL,
  `tan_image` varchar(255) DEFAULT NULL,
  `cin_no` varchar(255) DEFAULT NULL,
  `cin_image` varchar(255) DEFAULT NULL,
  `about_builder` text DEFAULT NULL,
  `representative_title` varchar(255) DEFAULT NULL,
  `director_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_builders`
--

INSERT INTO `tbl_builders` (`builder_id`, `builder_email`, `date_register`, `builder_status`, `builder_group_id`, `builder_city_id`, `builder_state_id`, `director_name`, `director_contact_no`, `director_email`, `representative_name`, `representative_contact_no`, `representative_email`, `builder_logo`, `created_at`, `updated_at`, `firm_type_id`, `firm_name`, `address_1`, `address_2`, `address_3`, `builder_country_id`, `builder_mobile`, `pan_no`, `pan_image`, `adhar_no`, `gst_no`, `gst_image`, `tan_no`, `tan_image`, `cin_no`, `cin_image`, `about_builder`, `representative_title`, `director_title`) VALUES
(1, 'info@ameya.com', '06-10-2023', NULL, 3, 347, 6, 'Isshu Sehgal', '9654441722', 'ishu@ameya.in', '', '', '', '', '1679669897', '1696582443', 4, 'Ameya Commercial Project Pvt Ltd.', 'Sector 42', 'Golf Course Road ', '', 1, '9999999999', '', '', NULL, '', '', '', '', '', '', '', '', 'Mr.'),
(2, 'Info@orris.com', '23-05-2024', 1, 4, 347, 6, 'Gupta', '', '', 'Saurabh', '', '', '', '1716473573', '1716473573', 4, 'Orris Infrastructure Pvt Ltd', 'J-5/10, DLF Phase-2', 'M G Road', '', 1, '9999999998', '', '', NULL, '', '', '', '', '', '', '', 'Mr.', 'Mr.'),
(3, 'info@orris.com', '23-05-2024', 1, 4, 347, 6, 'Gupta', '', '', 'Saurabh', '', '', '', '1716479981', '1716479981', 4, 'Ora Land and Housing Private Limited', 'J-5/10, DLF Phase-2', 'M G Road', '', 1, '9999999998', '', '', NULL, '', '', '', '', '', '', '', 'Mr.', 'Mr.'),
(4, 'mail@dlf.com', '24-05-2024', 1, 9, 0, 0, '', '', '', '', '', '', '', '1716509104', '1716509104', 5, 'DLF LTD.', '', '', '', 1, '9999999997', '', '', NULL, '', '', '', '', '', '', '', '', ''),
(5, 'info@godrej.com', '25-05-2024', 1, 5, 347, 6, '', '', '', 'Avi Gupta', '', '', 'a7b0afef9f43bdbaf2e19481984cb91f.png', '1716643879', '1716643879', 4, 'Godrej 101 Phase 3', 'Sector -79', '', '', 1, '9999999996', '', '', NULL, '', '', '', '', '', '', 'The Godrej story began in 1897, with the manufacturing of locks. Since then, we have set several benchmarks. From a state-of-the-art manufacturing facility in a suburb of Mumbai, we’ve reached homes, offices, industries and the hearts of millions of people in India and around the world. With a proud tradition of many firsts, we find ourselves at work every day, building on the foundations of trust that were laid 126 years ago.', 'Mr.', 'Mr.'),
(6, 'worldwidemanesar@gmail.com', '22-06-2024', 1, 10, 347, 6, 'TEJ PRAKASH BANSAL', '9953563840', 'worldwidemanesar@gmail.com', '', '', '', '32696f460d29b3891ac8f89550c4a1c0.jpg', '1719018799', '1719018799', 4, 'WORLDWIDE RESORTS AND ENTERTAINMENT PRIVATE LIMITED', 'SCO 2,3,4 OLD JUDICIAL COMPLEX', 'JHARSA ROAD, SECTOR 15', '', 1, '9953563840', '', '', NULL, '', '', '', '', '', '', 'Welcome to the Worldwide Group - a part of MDLR global conglomerate that operates in\r\nvarious industries, including hospitality, entertainment, shopping malls, media and education,\r\ndelivering successful projects that meet the highest standards of quality and functionality', '', 'Mr.'),
(7, 'loonlanddevelopmentltd@gmail.com', '26-06-2024', 1, 2, 347, 6, 'AMIT RAJ', '', '', 'Bharat Vigmal', '', '', 'f24210d2d990d24e539ef476355d9f7a.png', '1719418572', '1719418572', 5, 'Loon Land Development Ltd', 'M3M Urbana Business park, ', '10th Floor, Tower A,', 'Sector -67', 1, '9711348349', '', '', NULL, '', '', '', '', '', '', '', 'Mr.', 'Mr.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_builder_groups`
--

CREATE TABLE `tbl_builder_groups` (
  `builder_group_id` int(11) NOT NULL,
  `builder_group_name` varchar(255) DEFAULT NULL,
  `builder_group_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_builder_groups`
--

INSERT INTO `tbl_builder_groups` (`builder_group_id`, `builder_group_name`, `builder_group_status`, `created_at`, `updated_at`) VALUES
(1, 'AIPL', 1, '1679669317', '1679669317'),
(2, 'M3M Group', 1, '1679669332', '1679669332'),
(3, 'Ameya Group', 1, '1679669348', '1679669348'),
(4, 'Orris Group', 1, '1716464778', '1716464778'),
(5, 'Godrej Group', 1, '1716464804', '1716464804'),
(6, 'Elan Group', 1, '1716464818', '1716464818'),
(7, 'Signature Group', 1, '1716464834', '1716464834'),
(8, 'Sobha', 1, '1716465609', '1716465609'),
(9, 'DLF ', 1, '1716509033', '1716509033'),
(10, 'Worldwide Group', 1, '1719018284', '1719018284');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chats`
--

CREATE TABLE `tbl_chats` (
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_on` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `state_id` varchar(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `city_name`, `district_id`, `state_id`, `country_id`) VALUES
(1, 'Kupwara', 1, '1', 1),
(2, 'Handwara', 1, '1', 1),
(3, 'Karnah', 1, '1', 1),
(4, 'Gurez', 2, '1', 1),
(5, 'Bandipore', 2, '1', 1),
(6, 'Sonawari', 2, '1', 1),
(7, 'Sopore', 2, '1', 1),
(8, 'Pattan', 2, '1', 1),
(9, 'Baramula', 2, '1', 1),
(10, 'Uri', 2, '1', 1),
(11, 'Gulmarg', 2, '1', 1),
(12, 'Kangan', 3, '1', 1),
(13, 'Ganderbal', 3, '1', 1),
(14, 'Srinagar', 3, '1', 1),
(15, 'Beerwah', 4, '1', 1),
(16, 'Badgam', 4, '1', 1),
(17, 'Chadura', 4, '1', 1),
(18, 'Pampore', 5, '1', 1),
(19, 'Tral', 5, '1', 1),
(20, 'Pulwama', 5, '1', 1),
(21, 'Shupiyan', 5, '1', 1),
(22, 'Pahalgam', 6, '1', 1),
(23, 'Bijbehara', 6, '1', 1),
(24, 'Anantnag', 6, '1', 1),
(25, 'Kulgam', 6, '1', 1),
(26, 'Duru', 6, '1', 1),
(27, 'Leh', 7, '1', 1),
(28, 'Kargil', 8, '1', 1),
(29, 'Zanskar', 8, '1', 1),
(30, 'Banihal', 9, '1', 1),
(31, 'Ramban', 9, '1', 1),
(32, 'Doda', 9, '1', 1),
(33, 'Kishtwar', 9, '1', 1),
(34, 'Thathri', 9, '1', 1),
(35, 'Bhalessa (Gandoh)', 9, '1', 1),
(36, 'Bhaderwah', 9, '1', 1),
(37, 'Gool Gulab Garh', 10, '1', 1),
(38, 'Reasi', 10, '1', 1),
(39, 'Udhampur', 10, '1', 1),
(40, 'Chenani', 10, '1', 1),
(41, 'Ramnagar', 10, '1', 1),
(42, 'Haveli', 11, '1', 1),
(43, 'Mendhar', 11, '1', 1),
(44, 'Surankote', 11, '1', 1),
(45, 'Thanamandi', 12, '1', 1),
(46, 'Rajauri', 12, '1', 1),
(47, 'Budhal', 12, '1', 1),
(48, 'Kalakote', 12, '1', 1),
(49, 'Nowshehra', 12, '1', 1),
(50, 'Sunderbani', 12, '1', 1),
(51, 'Akhnoor', 13, '1', 1),
(52, 'Jammu', 13, '1', 1),
(53, 'Ranbirsinghpora', 13, '1', 1),
(54, 'Bishna', 13, '1', 1),
(55, 'Samba', 13, '1', 1),
(56, 'Billawar', 14, '1', 1),
(57, 'Bashohli', 14, '1', 1),
(58, 'Kathua', 14, '1', 1),
(59, 'Hiranagar', 14, '1', 1),
(60, 'Pangi(T)', 15, '2', 1),
(61, 'Chaurah(T)', 15, '2', 1),
(62, 'Saluni(T)', 15, '2', 1),
(63, 'Bhalai(S.T)', 15, '2', 1),
(64, 'Dalhousie(T)', 15, '2', 1),
(65, 'Bhattiyat(T)', 15, '2', 1),
(66, 'Sihunta(S.T)', 15, '2', 1),
(67, 'Chamba(T)', 15, '2', 1),
(68, 'Holi(S.T)', 15, '2', 1),
(69, 'Brahmaur(T)', 15, '2', 1),
(70, 'Nurpur(T)', 16, '2', 1),
(71, 'Indora(T)', 16, '2', 1),
(72, 'Fatehpur(T)', 16, '2', 1),
(73, 'Jawali(T)', 16, '2', 1),
(74, 'Harchakian(S.T)', 16, '2', 1),
(75, 'Shahpur(T)', 16, '2', 1),
(76, 'Dharmsala(T)', 16, '2', 1),
(77, 'Kangra(T)', 16, '2', 1),
(78, 'Baroh(T)', 16, '2', 1),
(79, 'Dera Gopipur(T)', 16, '2', 1),
(80, 'Jaswan(T)', 16, '2', 1),
(81, 'Rakkar(S.T)', 16, '2', 1),
(82, 'Khundian(T)', 16, '2', 1),
(83, 'Thural(S.T)', 16, '2', 1),
(84, 'Dhira(S.T)', 16, '2', 1),
(85, 'Jai Singhpur(T)', 16, '2', 1),
(86, 'Palampur(T)', 16, '2', 1),
(87, 'Baijnath(T)', 16, '2', 1),
(88, 'Multhan(S.T)', 16, '2', 1),
(89, 'Udaipur (S.T)', 17, '2', 1),
(90, 'Lahul     (T)', 17, '2', 1),
(91, 'Spiti       (T)', 17, '2', 1),
(92, 'Manali(T)', 18, '2', 1),
(93, 'Kullu(T)', 18, '2', 1),
(94, 'Sainj(S.T)', 18, '2', 1),
(95, 'Banjar(T)', 18, '2', 1),
(96, 'Ani(S.T)', 18, '2', 1),
(97, 'Nermand(T)', 18, '2', 1),
(98, 'Padhar(T)', 19, '2', 1),
(99, 'Jogindarnagar(T)', 19, '2', 1),
(100, 'Lad Bharol(T)', 19, '2', 1),
(101, 'Sandhol(S.T)', 19, '2', 1),
(102, 'Dharmpur(S.T)', 19, '2', 1),
(103, 'Kotli(S.T)', 19, '2', 1),
(104, 'Sarkaghat(T)', 19, '2', 1),
(105, 'Baldwara(S.T)', 19, '2', 1),
(106, 'Sundarnagar(T)', 19, '2', 1),
(107, 'Mandi(T)', 19, '2', 1),
(108, 'Aut(S.T)', 19, '2', 1),
(109, 'Bali Chowki(S.T)', 19, '2', 1),
(110, 'Thunag(T)', 19, '2', 1),
(111, 'Chachyot(T)', 19, '2', 1),
(112, 'Nihri(S.T)', 19, '2', 1),
(113, 'Karsog(T)', 19, '2', 1),
(114, 'Tira Sujanpur(T)', 20, '2', 1),
(115, 'Nadaun(T)', 20, '2', 1),
(116, 'Hamirpur(T)', 20, '2', 1),
(117, 'Barsar(T)', 20, '2', 1),
(118, 'Dhatwal(ST)', 20, '2', 1),
(119, 'Bhoranj(T)', 20, '2', 1),
(120, 'Bharwain(S.T)', 21, '2', 1),
(121, 'Amb(T)', 21, '2', 1),
(122, 'Bangana(T)', 21, '2', 1),
(123, 'Una(T)', 21, '2', 1),
(124, 'Haroli(S.T)', 21, '2', 1),
(125, 'Ghumarwin(T)', 22, '2', 1),
(126, 'Jhanduta(T)', 22, '2', 1),
(127, 'Naina Devi(S.T)', 22, '2', 1),
(128, 'Bilaspur Sadar(T)', 22, '2', 1),
(129, 'Arki(T)', 23, '2', 1),
(130, 'Ramshahr(S.T)', 23, '2', 1),
(131, 'Nalagarh(T)', 23, '2', 1),
(132, 'Krishangarh(S.T)', 23, '2', 1),
(133, 'Kasauli(T)', 23, '2', 1),
(134, 'Solan(T)', 23, '2', 1),
(135, 'Kandaghat(T)', 23, '2', 1),
(136, 'Rajgarh(T)', 24, '2', 1),
(137, 'Nohra(S.T)', 24, '2', 1),
(138, 'Pachhad(T)', 24, '2', 1),
(139, 'Renuka(T)', 24, '2', 1),
(140, 'Dadahu(S.T)', 24, '2', 1),
(141, 'Nahan(T)', 24, '2', 1),
(142, 'Paonta Sahib(T)', 24, '2', 1),
(143, 'Kamrau(S.T)', 24, '2', 1),
(144, 'Shalai(T)', 24, '2', 1),
(145, 'Ronhat(S.T)', 24, '2', 1),
(146, 'Rampur(T)', 25, '2', 1),
(147, 'Nankhari(S.T)', 25, '2', 1),
(148, 'Kumharsain(T)', 25, '2', 1),
(149, 'Seoni(T)', 25, '2', 1),
(150, 'Shimla Rural(T)', 25, '2', 1),
(151, 'Shimla Urban(T)', 25, '2', 1),
(152, 'Junga(S.T)', 25, '2', 1),
(153, 'Theog(T)', 25, '2', 1),
(154, 'Chaupal(T)', 25, '2', 1),
(155, 'Cheta(S.T)', 25, '2', 1),
(156, 'Nerua(S.T)', 25, '2', 1),
(157, 'Jubbal(T)', 25, '2', 1),
(158, 'Kotkhai(T)', 25, '2', 1),
(159, 'Tikar(S.T)', 25, '2', 1),
(160, 'Rohru(T)', 25, '2', 1),
(161, 'Chirgaon(T)', 25, '2', 1),
(162, 'Dodra Kwar(T)', 25, '2', 1),
(163, 'Hangrang(S.T)', 26, '2', 1),
(164, 'Poo(T)', 26, '2', 1),
(165, 'Morang(T)', 26, '2', 1),
(166, 'Kalpa(T)', 26, '2', 1),
(167, 'Nichar(T)', 26, '2', 1),
(168, 'Sangla(T)', 26, '2', 1),
(169, 'Dhar Kalan', 27, '3', 1),
(170, 'Pathankot', 27, '3', 1),
(171, 'Gurdaspur', 27, '3', 1),
(172, 'Batala', 27, '3', 1),
(173, 'Dera Baba Nanak', 27, '3', 1),
(174, 'Ajnala', 28, '3', 1),
(175, 'Amritsar -I', 28, '3', 1),
(176, 'Amritsar- II', 28, '3', 1),
(177, 'Tarn-Taran', 28, '3', 1),
(178, 'Patti', 28, '3', 1),
(179, 'Khadur Sahib', 28, '3', 1),
(180, 'Baba Bakala', 28, '3', 1),
(181, 'Bhulath', 29, '3', 1),
(182, 'Kapurthala', 29, '3', 1),
(183, 'Sultanpur Lodhi', 29, '3', 1),
(184, 'Phagwara', 29, '3', 1),
(185, 'Shahkot', 30, '3', 1),
(186, 'Nakodar', 30, '3', 1),
(187, 'Phillaur', 30, '3', 1),
(188, 'Jalandhar - I', 30, '3', 1),
(189, 'Jalandhar -II', 30, '3', 1),
(190, 'Dasua', 31, '3', 1),
(191, 'Mukerian', 31, '3', 1),
(192, 'Hoshiarpur', 31, '3', 1),
(193, 'Garhshankar', 31, '3', 1),
(194, 'Nawanshahr', 32, '3', 1),
(195, 'Balachaur', 32, '3', 1),
(196, 'Anandpur Sahib', 33, '3', 1),
(197, 'Rupnagar', 33, '3', 1),
(198, 'Kharar', 33, '3', 1),
(199, 'S.A.S.Nagar (Mohali)', 33, '3', 1),
(200, 'Bassi Pathana', 34, '3', 1),
(201, 'Fatehgarh Sahib', 34, '3', 1),
(202, 'Amloh', 34, '3', 1),
(203, 'Khamanon', 34, '3', 1),
(204, 'Samrala', 35, '3', 1),
(205, 'Khanna', 35, '3', 1),
(206, 'Payal', 35, '3', 1),
(207, 'Ludhiana (East)', 35, '3', 1),
(208, 'Ludhiana (West)', 35, '3', 1),
(209, 'Raikot', 35, '3', 1),
(210, 'Jagraon', 35, '3', 1),
(211, 'Nihal Singhwala', 36, '3', 1),
(212, 'Bagha Purana', 36, '3', 1),
(213, 'Moga', 36, '3', 1),
(214, 'Zira', 37, '3', 1),
(215, 'Firozepur', 37, '3', 1),
(216, 'Jalalabad', 37, '3', 1),
(217, 'Fazilka', 37, '3', 1),
(218, 'Abohar', 37, '3', 1),
(219, 'Malout', 38, '3', 1),
(220, 'Giddarbaha', 38, '3', 1),
(221, 'Muktsar', 38, '3', 1),
(222, 'Faridkot', 39, '3', 1),
(223, 'Jaitu', 39, '3', 1),
(224, 'Rampura Phul', 40, '3', 1),
(225, 'Bathinda', 40, '3', 1),
(226, 'Talwandi Sabo', 40, '3', 1),
(227, 'Sardulgarh', 41, '3', 1),
(228, 'Budhlada', 41, '3', 1),
(229, 'Mansa', 41, '3', 1),
(230, 'Barnala', 42, '3', 1),
(231, 'Malerkotla', 42, '3', 1),
(232, 'Dhuri', 42, '3', 1),
(233, 'Sangrur', 42, '3', 1),
(234, 'Sunam', 42, '3', 1),
(235, 'Moonak', 42, '3', 1),
(236, 'Samana', 43, '3', 1),
(237, 'Nabha', 43, '3', 1),
(238, 'Patiala', 43, '3', 1),
(239, 'Rajpura', 43, '3', 1),
(240, 'Dera Bassi', 43, '3', 1),
(241, 'Chandigarh', 44, '4', 1),
(242, 'Puraula', 45, '5', 1),
(243, 'Rajgarhi', 45, '5', 1),
(244, 'Dunda', 45, '5', 1),
(245, 'Bhatwari', 45, '5', 1),
(246, 'Joshimath', 46, '5', 1),
(247, 'Chamoli', 46, '5', 1),
(248, 'Pokhari **', 46, '5', 1),
(249, 'Karnaprayag', 46, '5', 1),
(250, 'Tharali', 46, '5', 1),
(251, 'Gair Sain **', 46, '5', 1),
(252, 'Ukhimath', 47, '5', 1),
(253, 'Rudraprayag', 47, '5', 1),
(254, 'Ghansali **', 48, '5', 1),
(255, 'Devprayag', 48, '5', 1),
(256, 'Pratapnagar', 48, '5', 1),
(257, 'Tehri', 48, '5', 1),
(258, 'Narendranagar', 48, '5', 1),
(259, 'Chakrata', 49, '5', 1),
(260, 'Vikasnagar **', 49, '5', 1),
(261, 'Dehradun', 49, '5', 1),
(262, 'Rishikesh **', 49, '5', 1),
(263, 'Srinagar **', 50, '5', 1),
(264, 'Pauri', 50, '5', 1),
(265, 'Thali Sain', 50, '5', 1),
(266, 'Dhoomakot', 50, '5', 1),
(267, 'Lansdowne', 50, '5', 1),
(268, 'Kotdwara', 50, '5', 1),
(269, 'Munsiari', 51, '5', 1),
(270, 'Dharchula', 51, '5', 1),
(271, 'Didihat', 51, '5', 1),
(272, 'Gangolihat', 51, '5', 1),
(273, 'Pithoragarh', 51, '5', 1),
(274, 'Kapkot **', 52, '5', 1),
(275, 'Bageshwar', 52, '5', 1),
(276, 'Bhikia Sain', 53, '5', 1),
(277, 'Ranikhet', 53, '5', 1),
(278, 'Almora', 53, '5', 1),
(279, 'Champawat', 54, '5', 1),
(280, 'Kosya Kutauli', 55, '5', 1),
(281, 'Nainital', 55, '5', 1),
(282, 'Dhari', 55, '5', 1),
(283, 'Haldwani', 55, '5', 1),
(284, 'Kashipur', 56, '5', 1),
(285, 'Kichha', 56, '5', 1),
(286, 'Sitarganj', 56, '5', 1),
(287, 'Khatima', 56, '5', 1),
(288, 'Roorkee', 57, '5', 1),
(289, 'Hardwar', 57, '5', 1),
(290, 'Laksar', 57, '5', 1),
(291, 'Kalka', 58, '6', 1),
(292, 'Panchkula', 58, '6', 1),
(293, 'Naraingarh', 59, '6', 1),
(294, 'Ambala', 59, '6', 1),
(295, 'Barara', 59, '6', 1),
(296, 'Jagadhri', 60, '6', 1),
(297, 'Chhachhrauli', 60, '6', 1),
(298, 'Shahbad', 61, '6', 1),
(299, 'Pehowa', 61, '6', 1),
(300, 'Thanesar', 61, '6', 1),
(301, 'Guhla', 62, '6', 1),
(302, 'Kaithal', 62, '6', 1),
(303, 'Nilokheri', 63, '6', 1),
(304, 'Indri', 63, '6', 1),
(305, 'Karnal', 63, '6', 1),
(306, 'Assandh', 63, '6', 1),
(307, 'Gharaunda', 63, '6', 1),
(308, 'Panipat', 64, '6', 1),
(309, 'Israna', 64, '6', 1),
(310, 'Samalkha', 64, '6', 1),
(311, 'Gohana', 65, '6', 1),
(312, 'Ganaur', 65, '6', 1),
(313, 'Sonipat', 65, '6', 1),
(314, 'Kharkhoda', 65, '6', 1),
(315, 'Narwana', 66, '6', 1),
(316, 'Jind', 66, '6', 1),
(317, 'Julana', 66, '6', 1),
(318, 'Safidon', 66, '6', 1),
(319, 'Ratia', 67, '6', 1),
(320, 'Tohana', 67, '6', 1),
(321, 'Fatehabad', 67, '6', 1),
(322, 'Dabwali', 68, '6', 1),
(323, 'Sirsa', 68, '6', 1),
(324, 'Rania', 68, '6', 1),
(325, 'Ellenabad', 68, '6', 1),
(326, 'Adampur', 69, '6', 1),
(327, 'Hisar', 69, '6', 1),
(328, 'Narnaund', 69, '6', 1),
(329, 'Hansi', 69, '6', 1),
(330, 'Bawani Khera', 70, '6', 1),
(331, 'Bhiwani', 70, '6', 1),
(332, 'Tosham', 70, '6', 1),
(333, 'Siwani', 70, '6', 1),
(334, 'Loharu', 70, '6', 1),
(335, 'Dadri', 70, '6', 1),
(336, 'Maham', 71, '6', 1),
(337, 'Rohtak', 71, '6', 1),
(338, 'Beri', 72, '6', 1),
(339, 'Bahadurgarh', 72, '6', 1),
(340, 'Jhajjar', 72, '6', 1),
(341, 'Mahendragarh', 73, '6', 1),
(342, 'Narnaul', 73, '6', 1),
(343, 'Kosli', 74, '6', 1),
(344, 'Rewari', 74, '6', 1),
(345, 'Bawal', 74, '6', 1),
(346, 'Pataudi', 75, '6', 1),
(347, 'Gurgaon', 75, '6', 1),
(348, 'Sohna', 75, '6', 1),
(349, 'Taoru', 75, '6', 1),
(350, 'Nuh', 75, '6', 1),
(351, 'Ferozepur Jhirka', 75, '6', 1),
(352, 'Punahana', 75, '6', 1),
(353, 'Faridabad', 76, '6', 1),
(354, 'Ballabgarh', 76, '6', 1),
(355, 'Palwal', 76, '6', 1),
(356, 'Hathin', 76, '6', 1),
(357, 'Hodal', 76, '6', 1),
(358, 'Narela', 77, '7', 1),
(359, 'Saraswati Vihar', 77, '7', 1),
(360, 'Model Town', 77, '7', 1),
(361, 'Civil Lines', 78, '7', 1),
(362, 'Sadar Bazar', 78, '7', 1),
(363, 'Kotwali', 78, '7', 1),
(364, 'Seelam Pur', 79, '7', 1),
(365, 'Shahdara', 79, '7', 1),
(366, 'Seema Puri', 79, '7', 1),
(367, 'Gandhi Nagar', 80, '7', 1),
(368, 'Vivek Vihar', 80, '7', 1),
(369, 'Preet Vihar', 80, '7', 1),
(370, 'Parliament Street', 81, '7', 1),
(371, 'Connaught Place', 81, '7', 1),
(372, 'Chanakya Puri', 81, '7', 1),
(373, 'Karol Bagh', 82, '7', 1),
(374, 'Pahar Ganj', 82, '7', 1),
(375, 'Darya Ganj', 82, '7', 1),
(376, 'Punjabi Bagh', 83, '7', 1),
(377, 'Patel Nagar', 83, '7', 1),
(378, 'Rajouri Garden', 83, '7', 1),
(379, 'Najafgarh', 84, '7', 1),
(380, 'Delhi Cantonment.', 84, '7', 1),
(381, 'Vasant Vihar', 84, '7', 1),
(382, 'Defence Colony', 85, '7', 1),
(383, 'Hauz Khas', 85, '7', 1),
(384, 'Kalkaji', 85, '7', 1),
(385, 'Karanpur', 86, '8', 1),
(386, 'Ganganagar', 86, '8', 1),
(387, 'Sadulshahar', 86, '8', 1),
(388, 'Padampur', 86, '8', 1),
(389, 'Raisinghnagar', 86, '8', 1),
(390, 'Anupgarh', 86, '8', 1),
(391, 'Gharsana', 86, '8', 1),
(392, 'Vijainagar', 86, '8', 1),
(393, 'Suratgarh', 86, '8', 1),
(394, 'Sangaria', 87, '8', 1),
(395, 'Tibi', 87, '8', 1),
(396, 'Hanumangarh', 87, '8', 1),
(397, 'Pilibanga', 87, '8', 1),
(398, 'Rawatsar', 87, '8', 1),
(399, 'Nohar', 87, '8', 1),
(400, 'Bhadra', 87, '8', 1),
(401, 'Bikaner', 88, '8', 1),
(402, 'Poogal', 88, '8', 1),
(403, 'Lunkaransar', 88, '8', 1),
(404, 'Kolayat', 88, '8', 1),
(405, 'Nokha', 88, '8', 1),
(406, 'Khajuwala', 88, '8', 1),
(407, 'Chhatargarh', 88, '8', 1),
(408, 'Taranagar', 89, '8', 1),
(409, 'Rajgarh', 89, '8', 1),
(410, 'Sardarshahar', 89, '8', 1),
(411, 'Churu', 89, '8', 1),
(412, 'Dungargarh', 89, '8', 1),
(413, 'Ratangarh', 89, '8', 1),
(414, 'Sujangarh', 89, '8', 1),
(415, 'Jhunjhunun', 90, '8', 1),
(416, 'Chirawa', 90, '8', 1),
(417, 'Buhana', 90, '8', 1),
(418, 'Khetri', 90, '8', 1),
(419, 'Nawalgarh', 90, '8', 1),
(420, 'Udaipurwati', 90, '8', 1),
(421, 'Behror', 91, '8', 1),
(422, 'Mandawar', 91, '8', 1),
(423, 'Kotkasim', 91, '8', 1),
(424, 'Tijara', 91, '8', 1),
(425, 'Kishangarh Bas', 91, '8', 1),
(426, 'Ramgarh', 91, '8', 1),
(427, 'Alwar', 91, '8', 1),
(428, 'Bansur', 91, '8', 1),
(429, 'Thanagazi', 91, '8', 1),
(430, 'Rajgarh', 91, '8', 1),
(431, 'Lachhmangarh', 91, '8', 1),
(432, 'Kathumar', 91, '8', 1),
(433, 'Pahari', 92, '8', 1),
(434, 'Kaman', 92, '8', 1),
(435, 'Nagar', 92, '8', 1),
(436, 'Deeg', 92, '8', 1),
(437, 'Nadbai', 92, '8', 1),
(438, 'Kumher', 92, '8', 1),
(439, 'Bharatpur', 92, '8', 1),
(440, 'Weir', 92, '8', 1),
(441, 'Bayana', 92, '8', 1),
(442, 'Rupbas', 92, '8', 1),
(443, 'Baseri', 93, '8', 1),
(444, 'Bari', 93, '8', 1),
(445, 'Sepau', 93, '8', 1),
(446, 'Dhaulpur', 93, '8', 1),
(447, 'Rajakhera', 93, '8', 1),
(448, 'Todabhim', 94, '8', 1),
(449, 'Nadoti', 94, '8', 1),
(450, 'Hindaun', 94, '8', 1),
(451, 'Karauli', 94, '8', 1),
(452, 'Mandrail', 94, '8', 1),
(453, 'Sapotra', 94, '8', 1),
(454, 'Gangapur', 95, '8', 1),
(455, 'Bamanwas', 95, '8', 1),
(456, 'Malarna Doongar', 95, '8', 1),
(457, 'Bonli', 95, '8', 1),
(458, 'Chauth Ka Barwara', 95, '8', 1),
(459, 'Sawai Madhopur', 95, '8', 1),
(460, 'Khandar', 95, '8', 1),
(461, 'Baswa', 96, '8', 1),
(462, 'Mahwa', 96, '8', 1),
(463, 'Sikrai', 96, '8', 1),
(464, 'Dausa', 96, '8', 1),
(465, 'Lalsot', 96, '8', 1),
(466, 'Kotputli', 97, '8', 1),
(467, 'Viratnagar', 97, '8', 1),
(468, 'Shahpura', 97, '8', 1),
(469, 'Chomu', 97, '8', 1),
(470, 'Phulera (HQ.Sambhar)', 97, '8', 1),
(471, 'Dudu (HQ. Mauzamabad)', 97, '8', 1),
(472, 'Phagi', 97, '8', 1),
(473, 'Sanganer', 97, '8', 1),
(474, 'Jaipur', 97, '8', 1),
(475, 'Amber', 97, '8', 1),
(476, 'Jamwa Ramgarh', 97, '8', 1),
(477, 'Bassi', 97, '8', 1),
(478, 'Chaksu', 97, '8', 1),
(479, 'Fatehpur', 98, '8', 1),
(480, 'Lachhmangarh', 98, '8', 1),
(481, 'Sikar', 98, '8', 1),
(482, 'Danta Ramgarh', 98, '8', 1),
(483, 'Sri Madhopur', 98, '8', 1),
(484, 'Neem Ka Thana', 98, '8', 1),
(485, 'Ladnu', 99, '8', 1),
(486, 'Didwana', 99, '8', 1),
(487, 'Jayal', 99, '8', 1),
(488, 'Nagaur', 99, '8', 1),
(489, 'Kheenvsar', 99, '8', 1),
(490, 'Merta', 99, '8', 1),
(491, 'Degana', 99, '8', 1),
(492, 'Parbatsar', 99, '8', 1),
(493, 'Makrana', 99, '8', 1),
(494, 'Nawa', 99, '8', 1),
(495, 'Phalodi', 100, '8', 1),
(496, 'Osian', 100, '8', 1),
(497, 'Bhopalgarh', 100, '8', 1),
(498, 'Jodhpur', 100, '8', 1),
(499, 'Shergarh', 100, '8', 1),
(500, 'Luni', 100, '8', 1),
(501, 'Bilara', 100, '8', 1),
(502, 'Jaisalmer', 101, '8', 1),
(503, 'Pokaran', 101, '8', 1),
(504, 'Fatehgarh', 101, '8', 1),
(505, 'Sheo', 102, '8', 1),
(506, 'Baytoo', 102, '8', 1),
(507, 'Pachpadra', 102, '8', 1),
(508, 'Siwana', 102, '8', 1),
(509, 'Gudha Malani', 102, '8', 1),
(510, 'Barmer', 102, '8', 1),
(511, 'Ramsar', 102, '8', 1),
(512, 'Chohtan', 102, '8', 1),
(513, 'Sayla', 103, '8', 1),
(514, 'Ahore', 103, '8', 1),
(515, 'Jalor', 103, '8', 1),
(516, 'Bhinmal', 103, '8', 1),
(517, 'Bagora', 103, '8', 1),
(518, 'Sanchore', 103, '8', 1),
(519, 'Raniwara', 103, '8', 1),
(520, 'Sheoganj', 104, '8', 1),
(521, 'Sirohi', 104, '8', 1),
(522, 'Pindwara', 104, '8', 1),
(523, 'Abu Road', 104, '8', 1),
(524, 'Reodar', 104, '8', 1),
(525, 'Jaitaran', 105, '8', 1),
(526, 'Raipur', 105, '8', 1),
(527, 'Sojat', 105, '8', 1),
(528, 'Rohat', 105, '8', 1),
(529, 'Pali', 105, '8', 1),
(530, 'Marwar Junction', 105, '8', 1),
(531, 'Desuri', 105, '8', 1),
(532, 'Sumerpur', 105, '8', 1),
(533, 'Bali', 105, '8', 1),
(534, 'Kishangarh', 106, '8', 1),
(535, 'Ajmer', 106, '8', 1),
(536, 'Peesangan', 106, '8', 1),
(537, 'Beawar', 106, '8', 1),
(538, 'Masuda', 106, '8', 1),
(539, 'Nasirabad', 106, '8', 1),
(540, 'Bhinay', 106, '8', 1),
(541, 'Sarwar', 106, '8', 1),
(542, 'Kekri', 106, '8', 1),
(543, 'Malpura', 107, '8', 1),
(544, 'Peeplu', 107, '8', 1),
(545, 'Niwai', 107, '8', 1),
(546, 'Tonk', 107, '8', 1),
(547, 'Todaraisingh', 107, '8', 1),
(548, 'Deoli', 107, '8', 1),
(549, 'Uniara', 107, '8', 1),
(550, 'Hindoli', 108, '8', 1),
(551, 'Nainwa', 108, '8', 1),
(552, 'Indragarh', 108, '8', 1),
(553, 'Keshoraipatan', 108, '8', 1),
(554, 'Bundi', 108, '8', 1),
(555, 'Asind', 109, '8', 1),
(556, 'Hurda', 109, '8', 1),
(557, 'Shahpura', 109, '8', 1),
(558, 'Banera', 109, '8', 1),
(559, 'Mandal', 109, '8', 1),
(560, 'Raipur', 109, '8', 1),
(561, 'Sahara', 109, '8', 1),
(562, 'Bhilwara', 109, '8', 1),
(563, 'Kotri', 109, '8', 1),
(564, 'Jahazpur', 109, '8', 1),
(565, 'Mandalgarh', 109, '8', 1),
(566, 'Beejoliya', 109, '8', 1),
(567, 'Bhim', 110, '8', 1),
(568, 'Deogarh', 110, '8', 1),
(569, 'Amet', 110, '8', 1),
(570, 'Kumbhalgarh', 110, '8', 1),
(571, 'Rajsamand', 110, '8', 1),
(572, 'Railmagra', 110, '8', 1),
(573, 'Nathdwara', 110, '8', 1),
(574, 'Mavli', 111, '8', 1),
(575, 'Gogunda', 111, '8', 1),
(576, 'Kotra', 111, '8', 1),
(577, 'Jhadol', 111, '8', 1),
(578, 'Girwa', 111, '8', 1),
(579, 'Vallabhnagar', 111, '8', 1),
(580, 'Dhariawad', 111, '8', 1),
(581, 'Salumbar', 111, '8', 1),
(582, 'Sarada', 111, '8', 1),
(583, 'Kherwara', 111, '8', 1),
(584, 'Dungarpur', 112, '8', 1),
(585, 'Aspur', 112, '8', 1),
(586, 'Sagwara', 112, '8', 1),
(587, 'Simalwara', 112, '8', 1),
(588, 'Ghatol', 113, '8', 1),
(589, 'Garhi', 113, '8', 1),
(590, 'Banswara', 113, '8', 1),
(591, 'Bagidora', 113, '8', 1),
(592, 'Kushalgarh', 113, '8', 1),
(593, 'Rashmi', 114, '8', 1),
(594, 'Gangrar', 114, '8', 1),
(595, 'Begun', 114, '8', 1),
(596, 'Rawatbhata', 114, '8', 1),
(597, 'Chittaurgarh', 114, '8', 1),
(598, 'Kapasan', 114, '8', 1),
(599, 'Dungla', 114, '8', 1),
(600, 'Bhadesar', 114, '8', 1),
(601, 'Nimbahera', 114, '8', 1),
(602, 'Chhoti Sadri', 114, '8', 1),
(603, 'Bari Sadri', 114, '8', 1),
(604, 'Pratapgarh', 114, '8', 1),
(605, 'Arnod', 114, '8', 1),
(606, 'Pipalda', 115, '8', 1),
(607, 'Digod', 115, '8', 1),
(608, 'Ladpura', 115, '8', 1),
(609, 'Ramganj Mandi', 115, '8', 1),
(610, 'Sangod', 115, '8', 1),
(611, 'Mangrol', 116, '8', 1),
(612, 'Antah', 116, '8', 1),
(613, 'Baran', 116, '8', 1),
(614, 'Atru', 116, '8', 1),
(615, 'Kishanganj', 116, '8', 1),
(616, 'Shahbad', 116, '8', 1),
(617, 'Chhabra', 116, '8', 1),
(618, 'Chhipabarod', 116, '8', 1),
(619, 'Khanpur', 117, '8', 1),
(620, 'Jhalrapatan', 117, '8', 1),
(621, 'Aklera', 117, '8', 1),
(622, 'Manohar Thana', 117, '8', 1),
(623, 'Pachpahar', 117, '8', 1),
(624, 'Pirawa', 117, '8', 1),
(625, 'Gangdhar', 117, '8', 1),
(626, 'Behat', 118, '9', 1),
(627, 'Saharanpur', 118, '9', 1),
(628, 'Nakur', 118, '9', 1),
(629, 'Deoband', 118, '9', 1),
(630, 'Kairana', 119, '9', 1),
(631, 'Shamli **', 119, '9', 1),
(632, 'Muzaffarnagar', 119, '9', 1),
(633, 'Budhana', 119, '9', 1),
(634, 'Jansath', 119, '9', 1),
(635, 'Najibabad', 120, '9', 1),
(636, 'Bijnor', 120, '9', 1),
(637, 'Nagina', 120, '9', 1),
(638, 'Dhampur', 120, '9', 1),
(639, 'Chandpur', 120, '9', 1),
(640, 'Thakurdwara', 121, '9', 1),
(641, 'Moradabad', 121, '9', 1),
(642, 'Bilari', 121, '9', 1),
(643, 'Sambhal', 121, '9', 1),
(644, 'Chandausi', 121, '9', 1),
(645, 'Suar', 122, '9', 1),
(646, 'Bilaspur', 122, '9', 1),
(647, 'Rampur', 122, '9', 1),
(648, 'Shahabad', 122, '9', 1),
(649, 'Milak', 122, '9', 1),
(650, 'Dhanaura', 123, '9', 1),
(651, 'Amroha', 123, '9', 1),
(652, 'Hasanpur', 123, '9', 1),
(653, 'Sardhana', 124, '9', 1),
(654, 'Mawana', 124, '9', 1),
(655, 'Meerut', 124, '9', 1),
(656, 'Baraut **', 125, '9', 1),
(657, 'Baghpat', 125, '9', 1),
(658, 'Khekada **', 125, '9', 1),
(659, 'Modinagar', 126, '9', 1),
(660, 'Ghaziabad', 126, '9', 1),
(661, 'Hapur', 126, '9', 1),
(662, 'Garhmukteshwar', 126, '9', 1),
(663, 'Dadri', 127, '9', 1),
(664, 'Gautam Buddha Nagar **', 127, '9', 1),
(665, 'Jewar **', 127, '9', 1),
(666, 'Sikandrabad', 128, '9', 1),
(667, 'Bulandshahr', 128, '9', 1),
(668, 'Siana', 128, '9', 1),
(669, 'Anupshahr', 128, '9', 1),
(670, 'Debai **', 128, '9', 1),
(671, 'Shikarpur **', 128, '9', 1),
(672, 'Khurja', 128, '9', 1),
(673, 'Khair', 129, '9', 1),
(674, 'Gabhana **', 129, '9', 1),
(675, 'Atrauli', 129, '9', 1),
(676, 'Koil', 129, '9', 1),
(677, 'Iglas', 129, '9', 1),
(678, 'Sasni **', 130, '9', 1),
(679, 'Sikandra Rao', 130, '9', 1),
(680, 'Hathras', 130, '9', 1),
(681, 'Sadabad', 130, '9', 1),
(682, 'Chhata', 131, '9', 1),
(683, 'Mat', 131, '9', 1),
(684, 'Mathura', 131, '9', 1),
(685, 'Etmadpur', 132, '9', 1),
(686, 'Agra', 132, '9', 1),
(687, 'Kiraoli', 132, '9', 1),
(688, 'Kheragarh', 132, '9', 1),
(689, 'Fatehabad', 132, '9', 1),
(690, 'Bah', 132, '9', 1),
(691, 'Tundla **', 133, '9', 1),
(692, 'Firozabad', 133, '9', 1),
(693, 'Jasrana', 133, '9', 1),
(694, 'Shikohabad', 133, '9', 1),
(695, 'Kasganj', 134, '9', 1),
(696, 'Patiyali', 134, '9', 1),
(697, 'Aliganj', 134, '9', 1),
(698, 'Etah', 134, '9', 1),
(699, 'Jalesar', 134, '9', 1),
(700, 'Mainpuri', 135, '9', 1),
(701, 'Karhal', 135, '9', 1),
(702, 'Bhogaon', 135, '9', 1),
(703, 'Gunnaur', 136, '9', 1),
(704, 'Bisauli', 136, '9', 1),
(705, 'Bilsi **', 136, '9', 1),
(706, 'Sahaswan', 136, '9', 1),
(707, 'Budaun', 136, '9', 1),
(708, 'Dataganj', 136, '9', 1),
(709, 'Baheri', 137, '9', 1),
(710, 'Meerganj', 137, '9', 1),
(711, 'Aonla', 137, '9', 1),
(712, 'Bareilly', 137, '9', 1),
(713, 'Nawabganj', 137, '9', 1),
(714, 'Faridpur', 137, '9', 1),
(715, 'Pilibhit', 138, '9', 1),
(716, 'Bisalpur', 138, '9', 1),
(717, 'Puranpur', 138, '9', 1),
(718, 'Powayan', 139, '9', 1),
(719, 'Tilhar', 139, '9', 1),
(720, 'Shahjahanpur', 139, '9', 1),
(721, 'Jalalabad', 139, '9', 1),
(722, 'Nighasan', 140, '9', 1),
(723, 'Gola Gokaran Nath', 140, '9', 1),
(724, 'Mohammdi', 140, '9', 1),
(725, 'Lakhimpur', 140, '9', 1),
(726, 'Dhaurahara', 140, '9', 1),
(727, 'Misrikh', 141, '9', 1),
(728, 'Sitapur', 141, '9', 1),
(729, 'Laharpur', 141, '9', 1),
(730, 'Biswan', 141, '9', 1),
(731, 'Mahmudabad', 141, '9', 1),
(732, 'Sidhauli', 141, '9', 1),
(733, 'Shahabad', 142, '9', 1),
(734, 'Sawayajpur **', 142, '9', 1),
(735, 'Hardoi', 142, '9', 1),
(736, 'Bilgram', 142, '9', 1),
(737, 'Sandila', 142, '9', 1),
(738, 'Safipur', 143, '9', 1),
(739, 'Hasanganj', 143, '9', 1),
(740, 'Unnao', 143, '9', 1),
(741, 'Purwa', 143, '9', 1),
(742, 'Bighapur **', 143, '9', 1),
(743, 'Malihabad', 144, '9', 1),
(744, 'Bakshi Ka Talab**', 144, '9', 1),
(745, 'Lucknow', 144, '9', 1),
(746, 'Mohanlalganj', 144, '9', 1),
(747, 'Maharajganj', 145, '9', 1),
(748, 'Tiloi', 145, '9', 1),
(749, 'Rae Bareli', 145, '9', 1),
(750, 'Lalganj', 145, '9', 1),
(751, 'Dalmau', 145, '9', 1),
(752, 'Unchahar **', 145, '9', 1),
(753, 'Salon', 145, '9', 1),
(754, 'Kaimganj', 146, '9', 1),
(755, 'Amritpur **', 146, '9', 1),
(756, 'Farrukhabad', 146, '9', 1),
(757, 'Chhibramau', 147, '9', 1),
(758, 'Kannauj', 147, '9', 1),
(759, 'Tirwa **', 147, '9', 1),
(760, 'Jaswantnagar **', 148, '9', 1),
(761, 'Saifai **', 148, '9', 1),
(762, 'Etawah', 148, '9', 1),
(763, 'Bharthana', 148, '9', 1),
(764, 'Chakarnagar **', 148, '9', 1),
(765, 'Bidhuna', 149, '9', 1),
(766, 'Auraiya', 149, '9', 1),
(767, 'Rasulabad', 150, '9', 1),
(768, 'Derapur', 150, '9', 1),
(769, 'Akbarpur', 150, '9', 1),
(770, 'Bhognipur', 150, '9', 1),
(771, 'Sikandra **', 150, '9', 1),
(772, 'Bilhaur', 151, '9', 1),
(773, 'Kanpur', 151, '9', 1),
(774, 'Ghatampur', 151, '9', 1),
(775, 'Madhogarh **', 152, '9', 1),
(776, 'Jalaun', 152, '9', 1),
(777, 'Kalpi', 152, '9', 1),
(778, 'Orai', 152, '9', 1),
(779, 'Konch', 152, '9', 1),
(780, 'Moth', 153, '9', 1),
(781, 'Garautha', 153, '9', 1),
(782, 'Tahrauli **', 153, '9', 1),
(783, 'Mauranipur', 153, '9', 1),
(784, 'Jhansi', 153, '9', 1),
(785, 'Talbehat', 154, '9', 1),
(786, 'Lalitpur', 154, '9', 1),
(787, 'Mahroni', 154, '9', 1),
(788, 'Hamirpur', 155, '9', 1),
(789, 'Rath', 155, '9', 1),
(790, 'Maudaha', 155, '9', 1),
(791, 'Kulpahar', 156, '9', 1),
(792, 'Charkhari', 156, '9', 1),
(793, 'Mahoba', 156, '9', 1),
(794, 'Banda', 157, '9', 1),
(795, 'Baberu', 157, '9', 1),
(796, 'Atarra', 157, '9', 1),
(797, 'Naraini', 157, '9', 1),
(798, 'Karwi', 158, '9', 1),
(799, 'Mau', 158, '9', 1),
(800, 'Bindki', 159, '9', 1),
(801, 'Fatehpur', 159, '9', 1),
(802, 'Khaga', 159, '9', 1),
(803, 'Lalganj Ajhara', 160, '9', 1),
(804, 'Kunda', 160, '9', 1),
(805, 'Pratapgarh', 160, '9', 1),
(806, 'Patti', 160, '9', 1),
(807, 'Sirathu', 161, '9', 1),
(808, 'Manjhanpur', 161, '9', 1),
(809, 'Chail', 161, '9', 1),
(810, 'Soraon', 162, '9', 1),
(811, 'Phulpur', 162, '9', 1),
(812, 'Allahabad **', 162, '9', 1),
(813, 'Bara', 162, '9', 1),
(814, 'Karchhana', 162, '9', 1),
(815, 'Handia', 162, '9', 1),
(816, 'Meja', 162, '9', 1),
(817, 'Koraon **', 162, '9', 1),
(818, 'Fatehpur', 163, '9', 1),
(819, 'Ramnagar', 163, '9', 1),
(820, 'Nawabganj', 163, '9', 1),
(821, 'Sirauli Gauspur**', 163, '9', 1),
(822, 'Ramsanehighat', 163, '9', 1),
(823, 'Haidergarh', 163, '9', 1),
(824, 'Rudauli', 164, '9', 1),
(825, 'Milkipur **', 164, '9', 1),
(826, 'Sohawal **', 164, '9', 1),
(827, 'Faizabad', 164, '9', 1),
(828, 'Bikapur', 164, '9', 1),
(829, 'Tanda', 165, '9', 1),
(830, 'Allapur **', 165, '9', 1),
(831, 'Jalalpur', 165, '9', 1),
(832, 'Akbarpur', 165, '9', 1),
(833, 'Musafirkhana', 166, '9', 1),
(834, 'Gauriganj', 166, '9', 1),
(835, 'Amethi', 166, '9', 1),
(836, 'Sultanpur', 166, '9', 1),
(837, 'Lambhuwa **', 166, '9', 1),
(838, 'Kadipur', 166, '9', 1),
(839, 'Nanpara', 167, '9', 1),
(840, 'Mahasi **', 167, '9', 1),
(841, 'Bahraich', 167, '9', 1),
(842, 'Kaiserganj', 167, '9', 1),
(843, 'Bhinga', 168, '9', 1),
(844, 'Ikauna **', 168, '9', 1),
(845, 'Payagpur **', 168, '9', 1),
(846, 'Balrampur', 169, '9', 1),
(847, 'Tulsipur', 169, '9', 1),
(848, 'Utraula', 169, '9', 1),
(849, 'Gonda', 170, '9', 1),
(850, 'Colonelganj', 170, '9', 1),
(851, 'Tarabganj', 170, '9', 1),
(852, 'Mankapur', 170, '9', 1),
(853, 'Shohratgarh **', 171, '9', 1),
(854, 'Naugarh', 171, '9', 1),
(855, 'Bansi', 171, '9', 1),
(856, 'Itwa', 171, '9', 1),
(857, 'Domariyaganj', 171, '9', 1),
(858, 'Bhanpur', 172, '9', 1),
(859, 'Harraiya', 172, '9', 1),
(860, 'Basti', 172, '9', 1),
(861, 'Mehdawal **', 173, '9', 1),
(862, 'Khalilabad', 173, '9', 1),
(863, 'Ghanghata **', 173, '9', 1),
(864, 'Nautanwa', 174, '9', 1),
(865, 'Nichlaul', 174, '9', 1),
(866, 'Pharenda', 174, '9', 1),
(867, 'Maharajganj', 174, '9', 1),
(868, 'Campierganj **', 175, '9', 1),
(869, 'Sahjanwa', 175, '9', 1),
(870, 'Gorakhpur', 175, '9', 1),
(871, 'Chauri Chaura', 175, '9', 1),
(872, 'Bansgaon', 175, '9', 1),
(873, 'Khajani', 175, '9', 1),
(874, 'Gola', 175, '9', 1),
(875, 'Padrauna', 176, '9', 1),
(876, 'Hata', 176, '9', 1),
(877, 'Kasya **', 176, '9', 1),
(878, 'Tamkuhi Raj', 176, '9', 1),
(879, 'Deoria', 177, '9', 1),
(880, 'Rudrapur', 177, '9', 1),
(881, 'Barhaj **', 177, '9', 1),
(882, 'Salempur', 177, '9', 1),
(883, 'Bhatpar Rani **', 177, '9', 1),
(884, 'Burhanpur', 178, '9', 1),
(885, 'Sagri', 178, '9', 1),
(886, 'Azamgarh', 178, '9', 1),
(887, 'Nizamabad **', 178, '9', 1),
(888, 'Phulpur', 178, '9', 1),
(889, 'Lalganj', 178, '9', 1),
(890, 'Mehnagar **', 178, '9', 1),
(891, 'Ghosi', 179, '9', 1),
(892, 'Madhuban **', 179, '9', 1),
(893, 'Maunath Bhanjan', 179, '9', 1),
(894, 'Muhammadabad Gohna', 179, '9', 1),
(895, 'Belthara Road **', 180, '9', 1),
(896, 'Sikanderpur **', 180, '9', 1),
(897, 'Rasra', 180, '9', 1),
(898, 'Ballia', 180, '9', 1),
(899, 'Bansdih', 180, '9', 1),
(900, 'Bairia', 180, '9', 1),
(901, 'Shahganj', 181, '9', 1),
(902, 'Badlapur', 181, '9', 1),
(903, 'Machhlishahr', 181, '9', 1),
(904, 'Jaunpur', 181, '9', 1),
(905, 'Mariahu', 181, '9', 1),
(906, 'Kerakat', 181, '9', 1),
(907, 'Jakhanian **', 182, '9', 1),
(908, 'Saidpur', 182, '9', 1),
(909, 'Ghazipur', 182, '9', 1),
(910, 'Mohammadabad', 182, '9', 1),
(911, 'Zamania', 182, '9', 1),
(912, 'Sakaldiha', 183, '9', 1),
(913, 'Chandauli', 183, '9', 1),
(914, 'Chakia', 183, '9', 1),
(915, 'Pindra **', 184, '9', 1),
(916, 'Varanasi', 184, '9', 1),
(917, 'Bhadohi', 185, '9', 1),
(918, 'Gyanpur', 185, '9', 1),
(919, 'Mirzapur', 186, '9', 1),
(920, 'Lalganj', 186, '9', 1),
(921, 'Marihan', 186, '9', 1),
(922, 'Chunar', 186, '9', 1),
(923, 'Ghorawal **', 187, '9', 1),
(924, 'Robertsganj', 187, '9', 1),
(925, 'Dudhi', 187, '9', 1),
(926, 'Sidhaw', 188, '10', 1),
(927, 'Ramnagar', 188, '10', 1),
(928, 'Gaunaha', 188, '10', 1),
(929, 'Mainatanr', 188, '10', 1),
(930, 'Narkatiaganj', 188, '10', 1),
(931, 'Lauria', 188, '10', 1),
(932, 'Bagaha', 188, '10', 1),
(933, 'Piprasi', 188, '10', 1),
(934, 'Madhubani', 188, '10', 1),
(935, 'Bhitaha', 188, '10', 1),
(936, 'Thakrahan', 188, '10', 1),
(937, 'Jogapatti', 188, '10', 1),
(938, 'Chanpatia', 188, '10', 1),
(939, 'Sikta', 188, '10', 1),
(940, 'Majhaulia', 188, '10', 1),
(941, 'Bettiah', 188, '10', 1),
(942, 'Bairia', 188, '10', 1),
(943, 'Nautan', 188, '10', 1),
(944, 'Raxaul', 189, '10', 1),
(945, 'Adapur', 189, '10', 1),
(946, 'Ramgarhwa', 189, '10', 1),
(947, 'Sugauli', 189, '10', 1),
(948, 'Banjaria', 189, '10', 1),
(949, 'Narkatia', 189, '10', 1),
(950, 'Bankatwa', 189, '10', 1),
(951, 'Ghorasahan', 189, '10', 1),
(952, 'Dhaka', 189, '10', 1),
(953, 'Chiraia', 189, '10', 1),
(954, 'Motihari', 189, '10', 1),
(955, 'Turkaulia', 189, '10', 1),
(956, 'Harsidhi', 189, '10', 1),
(957, 'Paharpur', 189, '10', 1),
(958, 'Areraj', 189, '10', 1),
(959, 'Sangrampur', 189, '10', 1),
(960, 'Kesaria', 189, '10', 1),
(961, 'Kalyanpur', 189, '10', 1),
(962, 'Kotwa', 189, '10', 1),
(963, 'Piprakothi', 189, '10', 1),
(964, 'Chakia(Pipra)', 189, '10', 1),
(965, 'Pakri Dayal', 189, '10', 1),
(966, 'Patahi', 189, '10', 1),
(967, 'Phenhara', 189, '10', 1),
(968, 'Madhuban', 189, '10', 1),
(969, 'Tetaria', 189, '10', 1),
(970, 'Mehsi', 189, '10', 1),
(971, 'Purnahiya', 190, '10', 1),
(972, 'Piprarhi', 190, '10', 1),
(973, 'Sheohar', 190, '10', 1),
(974, 'Dumri Katsari', 190, '10', 1),
(975, 'Tariani Chowk', 190, '10', 1),
(976, 'Bairgania', 191, '10', 1),
(977, 'Suppi', 191, '10', 1),
(978, 'Majorganj', 191, '10', 1),
(979, 'Sonbarsa', 191, '10', 1),
(980, 'Parihar', 191, '10', 1),
(981, 'Sursand', 191, '10', 1),
(982, 'Bathnaha', 191, '10', 1),
(983, 'Riga', 191, '10', 1),
(984, 'Parsauni', 191, '10', 1),
(985, 'Belsand', 191, '10', 1),
(986, 'Runisaidpur', 191, '10', 1),
(987, 'Dumra', 191, '10', 1),
(988, 'Bajpatti', 191, '10', 1),
(989, 'Charaut', 191, '10', 1),
(990, 'Pupri', 191, '10', 1),
(991, 'Nanpur', 191, '10', 1),
(992, 'Bokhara', 191, '10', 1),
(993, 'Madhwapur', 192, '10', 1),
(994, 'Harlakhi', 192, '10', 1),
(995, 'Basopatti', 192, '10', 1),
(996, 'Jainagar', 192, '10', 1),
(997, 'Ladania', 192, '10', 1),
(998, 'Laukaha', 192, '10', 1),
(999, 'Laukahi', 192, '10', 1),
(1000, 'Phulparas', 192, '10', 1),
(1001, 'Babubarhi', 192, '10', 1),
(1002, 'Khajauli', 192, '10', 1),
(1003, 'Kaluahi', 192, '10', 1),
(1004, 'Benipatti', 192, '10', 1),
(1005, 'Bisfi', 192, '10', 1),
(1006, 'Madhubani', 192, '10', 1),
(1007, 'Pandaul', 192, '10', 1),
(1008, 'Rajnagar', 192, '10', 1),
(1009, 'Andhratharhi', 192, '10', 1),
(1010, 'Jhanjharpur', 192, '10', 1),
(1011, 'Ghoghardiha', 192, '10', 1),
(1012, 'Lakhnaur', 192, '10', 1),
(1013, 'Madhepur', 192, '10', 1),
(1014, 'Nirmali', 193, '10', 1),
(1015, 'Basantpur', 193, '10', 1),
(1016, 'Chhatapur', 193, '10', 1),
(1017, 'Pratapganj', 193, '10', 1),
(1018, 'Raghopur', 193, '10', 1),
(1019, 'Saraigarh Bhaptiyahi', 193, '10', 1),
(1020, 'Kishanpur', 193, '10', 1),
(1021, 'Marauna', 193, '10', 1),
(1022, 'Supaul', 193, '10', 1),
(1023, 'Pipra', 193, '10', 1),
(1024, 'Tribeniganj', 193, '10', 1),
(1025, 'Narpatganj', 194, '10', 1),
(1026, 'Forbesganj', 194, '10', 1),
(1027, 'Bhargama', 194, '10', 1),
(1028, 'Raniganj', 194, '10', 1),
(1029, 'Araria', 194, '10', 1),
(1030, 'Kursakatta', 194, '10', 1),
(1031, 'Sikti', 194, '10', 1),
(1032, 'Palasi', 194, '10', 1),
(1033, 'Jokihat', 194, '10', 1),
(1034, 'Terhagachh', 195, '10', 1),
(1035, 'Dighalbank', 195, '10', 1),
(1036, 'Thakurganj', 195, '10', 1),
(1037, 'Pothia', 195, '10', 1),
(1038, 'Bahadurganj', 195, '10', 1),
(1039, 'Kochadhamin', 195, '10', 1),
(1040, 'Kishanganj', 195, '10', 1),
(1041, 'Banmankhi', 196, '10', 1),
(1042, 'Barhara', 196, '10', 1),
(1043, 'Bhawanipur', 196, '10', 1),
(1044, 'Rupauli', 196, '10', 1),
(1045, 'Dhamdaha', 196, '10', 1),
(1046, 'Krityanand Nagar', 196, '10', 1),
(1047, 'Purnia East', 196, '10', 1),
(1048, 'Kasba', 196, '10', 1),
(1049, 'Srinagar', 196, '10', 1),
(1050, 'Jalalgarh', 196, '10', 1),
(1051, 'Amour', 196, '10', 1),
(1052, 'Baisa', 196, '10', 1),
(1053, 'Baisi', 196, '10', 1),
(1054, 'Dagarua', 196, '10', 1),
(1055, 'Falka', 197, '10', 1),
(1056, 'Korha', 197, '10', 1),
(1057, 'Hasanganj', 197, '10', 1),
(1058, 'Kadwa', 197, '10', 1),
(1059, 'Balrampur', 197, '10', 1),
(1060, 'Barsoi', 197, '10', 1),
(1061, 'Azamnagar', 197, '10', 1),
(1062, 'Pranpur', 197, '10', 1),
(1063, 'Dandkhora', 197, '10', 1),
(1064, 'katihar', 197, '10', 1),
(1065, 'Mansahi', 197, '10', 1),
(1066, 'Barari', 197, '10', 1),
(1067, 'Sameli', 197, '10', 1),
(1068, 'Kursela', 197, '10', 1),
(1069, 'Manihari', 197, '10', 1),
(1070, 'Amdabad', 197, '10', 1),
(1071, 'Gamharia', 198, '10', 1),
(1072, 'Singheshwar', 198, '10', 1),
(1073, 'Ghailarh', 198, '10', 1),
(1074, 'Madhepura', 198, '10', 1),
(1075, 'Shankarpur', 198, '10', 1),
(1076, 'Kumarkhand', 198, '10', 1),
(1077, 'Murliganj', 198, '10', 1),
(1078, 'Gwalpara', 198, '10', 1),
(1079, 'Bihariganj', 198, '10', 1),
(1080, 'Kishanganj', 198, '10', 1),
(1081, 'Puraini', 198, '10', 1),
(1082, 'Alamnagar', 198, '10', 1),
(1083, 'Chausa', 198, '10', 1),
(1084, 'Nauhatta', 199, '10', 1),
(1085, 'Satar Kataiya', 199, '10', 1),
(1086, 'Mahishi', 199, '10', 1),
(1087, 'Kahara', 199, '10', 1),
(1088, 'Saur Bazar', 199, '10', 1),
(1089, 'Patarghat', 199, '10', 1),
(1090, 'Sonbarsa', 199, '10', 1),
(1091, 'Simri Bakhtiarpur', 199, '10', 1),
(1092, 'Salkhua', 199, '10', 1),
(1093, 'Banma Itarhi', 199, '10', 1),
(1094, 'Jale', 200, '10', 1),
(1095, 'Singhwara', 200, '10', 1),
(1096, 'Keotiranway', 200, '10', 1),
(1097, 'Darbhanga', 200, '10', 1),
(1098, 'Manigachhi', 200, '10', 1),
(1099, 'Tardih', 200, '10', 1),
(1100, 'Alinagar', 200, '10', 1),
(1101, 'Benipur', 200, '10', 1),
(1102, 'Bahadurpur', 200, '10', 1),
(1103, 'Hanumannagar', 200, '10', 1),
(1104, 'Hayaghat', 200, '10', 1),
(1105, 'Baheri', 200, '10', 1),
(1106, 'Biraul', 200, '10', 1),
(1107, 'Ghanshyampur', 200, '10', 1),
(1108, 'Kiratpur', 200, '10', 1),
(1109, 'Gora Bauram', 200, '10', 1),
(1110, 'Kusheshwar Asthan', 200, '10', 1),
(1111, 'Kusheshwar Asthan Purbi', 200, '10', 1),
(1112, 'Sahebganj', 201, '10', 1),
(1113, 'Baruraj (Motipur)', 201, '10', 1),
(1114, 'Paroo', 201, '10', 1),
(1115, 'Saraiya', 201, '10', 1),
(1116, 'Marwan', 201, '10', 1),
(1117, 'Kanti', 201, '10', 1),
(1118, 'Minapur', 201, '10', 1),
(1119, 'Bochaha', 201, '10', 1),
(1120, 'Aurai', 201, '10', 1),
(1121, 'Katra', 201, '10', 1),
(1122, 'Gaighat', 201, '10', 1),
(1123, 'Bandra', 201, '10', 1),
(1124, 'Dholi (Moraul)', 201, '10', 1),
(1125, 'Musahari', 201, '10', 1),
(1126, 'Kurhani', 201, '10', 1),
(1127, 'Sakra', 201, '10', 1),
(1128, 'Kataiya', 202, '10', 1),
(1129, 'Bijaipur', 202, '10', 1),
(1130, 'Bhorey', 202, '10', 1),
(1131, 'Pachdeori', 202, '10', 1),
(1132, 'Kuchaikote', 202, '10', 1),
(1133, 'phulwaria', 202, '10', 1),
(1134, 'Hathua', 202, '10', 1),
(1135, 'Uchkagaon', 202, '10', 1),
(1136, 'Thawe', 202, '10', 1),
(1137, 'Gopalganj', 202, '10', 1),
(1138, 'Manjha', 202, '10', 1),
(1139, 'Barauli', 202, '10', 1),
(1140, 'Sidhwalia', 202, '10', 1),
(1141, 'Baikunthpur', 202, '10', 1),
(1142, 'Nautan', 203, '10', 1),
(1143, 'Siwan', 203, '10', 1),
(1144, 'Barharia', 203, '10', 1),
(1145, 'Goriakothi', 203, '10', 1),
(1146, 'Lakri Nabiganj', 203, '10', 1),
(1147, 'Basantpur', 203, '10', 1),
(1148, 'Bhagwanpur Hat', 203, '10', 1),
(1149, 'Maharajganj', 203, '10', 1),
(1150, 'Pachrukhi', 203, '10', 1),
(1151, 'Hussainganj', 203, '10', 1),
(1152, 'Ziradei', 203, '10', 1),
(1153, 'Mairwa', 203, '10', 1),
(1154, 'Guthani', 203, '10', 1),
(1155, 'Darauli', 203, '10', 1),
(1156, 'Andar', 203, '10', 1),
(1157, 'Raghunathpur', 203, '10', 1),
(1158, 'Hasanpura', 203, '10', 1),
(1159, 'Daraundha', 203, '10', 1),
(1160, 'Siswan', 203, '10', 1),
(1161, 'Mashrakh', 204, '10', 1),
(1162, 'Panapur', 204, '10', 1),
(1163, 'Taraiya', 204, '10', 1),
(1164, 'Ishupur', 204, '10', 1),
(1165, 'Baniapur', 204, '10', 1),
(1166, 'Lahladpur', 204, '10', 1),
(1167, 'Ekma', 204, '10', 1),
(1168, 'Manjhi', 204, '10', 1),
(1169, 'Jalalpur', 204, '10', 1),
(1170, 'Revelganj', 204, '10', 1),
(1171, 'Chapra', 204, '10', 1),
(1172, 'Nagra', 204, '10', 1),
(1173, 'Marhaura', 204, '10', 1),
(1174, 'Amnour', 204, '10', 1),
(1175, 'Maker', 204, '10', 1),
(1176, 'Parsa', 204, '10', 1),
(1177, 'Dariapur', 204, '10', 1),
(1178, 'Garkha', 204, '10', 1),
(1179, 'Dighwara', 204, '10', 1),
(1180, 'Sonepur', 204, '10', 1),
(1181, 'Vaishali', 205, '10', 1),
(1182, 'Paterhi Belsar', 205, '10', 1),
(1183, 'Lalganj', 205, '10', 1),
(1184, 'Bhagwanpur', 205, '10', 1),
(1185, 'Goraul', 205, '10', 1),
(1186, 'Chehra Kalan', 205, '10', 1),
(1187, 'Patepur', 205, '10', 1),
(1188, 'Mahua', 205, '10', 1),
(1189, 'Jandaha', 205, '10', 1),
(1190, 'Raja Pakar', 205, '10', 1),
(1191, 'Hajipur', 205, '10', 1),
(1192, 'Raghopur', 205, '10', 1),
(1193, 'Bidupur', 205, '10', 1),
(1194, 'Desri', 205, '10', 1),
(1195, 'Sahdai Buzurg', 205, '10', 1),
(1196, 'Mahnar', 205, '10', 1),
(1197, 'Kalyanpur', 206, '10', 1),
(1198, 'Warisnagar', 206, '10', 1),
(1199, 'Shivaji Nagar', 206, '10', 1),
(1200, 'Khanpur', 206, '10', 1),
(1201, 'Samastipur', 206, '10', 1),
(1202, 'Pusa', 206, '10', 1),
(1203, 'Tajpur', 206, '10', 1),
(1204, 'Morwa', 206, '10', 1),
(1205, 'Patori', 206, '10', 1),
(1206, 'Mohanpur', 206, '10', 1),
(1207, 'Mohiuddinagar', 206, '10', 1),
(1208, 'Sarairanjan', 206, '10', 1),
(1209, 'Vidyapati Nagar', 206, '10', 1),
(1210, 'Dalsinghsarai', 206, '10', 1),
(1211, 'Ujiarpur', 206, '10', 1),
(1212, 'Bibhutpur', 206, '10', 1),
(1213, 'Rosera', 206, '10', 1),
(1214, 'Singhia', 206, '10', 1),
(1215, 'Hasanpur', 206, '10', 1),
(1216, 'Bithan', 206, '10', 1),
(1217, 'Khudabandpur', 207, '10', 1),
(1218, 'Chorahi', 207, '10', 1),
(1219, 'Garhpura', 207, '10', 1),
(1220, 'Cheria Bariarpur', 207, '10', 1),
(1221, 'Bhagwanpur', 207, '10', 1),
(1222, 'Mansurchak', 207, '10', 1),
(1223, 'Bachhwara', 207, '10', 1),
(1224, 'Teghra', 207, '10', 1),
(1225, 'Barauni', 207, '10', 1),
(1226, 'Birpur', 207, '10', 1),
(1227, 'Begusarai', 207, '10', 1),
(1228, 'Naokothi', 207, '10', 1),
(1229, 'Bakhri', 207, '10', 1),
(1230, 'Dandari', 207, '10', 1),
(1231, 'Sahebpur Kamal', 207, '10', 1),
(1232, 'Balia', 207, '10', 1),
(1233, 'Matihani', 207, '10', 1),
(1234, 'Shamho Akha Kurha', 207, '10', 1),
(1235, 'Alauli', 208, '10', 1),
(1236, 'Khagaria', 208, '10', 1),
(1237, 'Mansi', 208, '10', 1),
(1238, 'Chautham', 208, '10', 1),
(1239, 'Beldaur', 208, '10', 1),
(1240, 'Gogari', 208, '10', 1),
(1241, 'Parbatta', 208, '10', 1),
(1242, 'Narayanpur', 209, '10', 1),
(1243, 'Bihpur', 209, '10', 1),
(1244, 'Kharik', 209, '10', 1),
(1245, 'Naugachhia', 209, '10', 1),
(1246, 'Rangra Chowk', 209, '10', 1),
(1247, 'Gopalpur', 209, '10', 1),
(1248, 'Pirpainti', 209, '10', 1),
(1249, 'Colgong', 209, '10', 1),
(1250, 'Ismailpur', 209, '10', 1),
(1251, 'Sabour', 209, '10', 1),
(1252, 'Nathnagar', 209, '10', 1),
(1253, 'Sultanganj', 209, '10', 1),
(1254, 'Shahkund', 209, '10', 1),
(1255, 'Goradih', 209, '10', 1),
(1256, 'Jagdishpur', 209, '10', 1),
(1257, 'Sonhaula', 209, '10', 1),
(1258, 'Shambhuganj', 210, '10', 1),
(1259, 'Amarpur', 210, '10', 1),
(1260, 'Rajaun', 210, '10', 1),
(1261, 'Dhuraiya', 210, '10', 1),
(1262, 'Barahat', 210, '10', 1),
(1263, 'Banka', 210, '10', 1),
(1264, 'Phulidumar', 210, '10', 1),
(1265, 'Belhar', 210, '10', 1),
(1266, 'Chanan', 210, '10', 1),
(1267, 'Katoria', 210, '10', 1),
(1268, 'Bausi', 210, '10', 1),
(1269, 'Munger', 211, '10', 1),
(1270, 'Bariyarpur', 211, '10', 1),
(1271, 'Jamalpur', 211, '10', 1),
(1272, 'Dharhara', 211, '10', 1),
(1273, 'Kharagpur', 211, '10', 1),
(1274, 'Asarganj', 211, '10', 1),
(1275, 'Tarapur', 211, '10', 1),
(1276, 'Tetiha Bambor', 211, '10', 1),
(1277, 'Sangrampur', 211, '10', 1),
(1278, 'Barahiya', 212, '10', 1),
(1279, 'Pipariya', 212, '10', 1),
(1280, 'Surajgarha', 212, '10', 1),
(1281, 'Lakhisarai', 212, '10', 1),
(1282, 'Ramgarh Chowk', 212, '10', 1),
(1283, 'Halsi', 212, '10', 1),
(1284, 'Barbigha', 213, '10', 1),
(1285, 'Shekhopur Sarai', 213, '10', 1),
(1286, 'Sheikhpura', 213, '10', 1),
(1287, 'Ghat Kusmha', 213, '10', 1),
(1288, 'Chewara', 213, '10', 1),
(1289, 'Ariari', 213, '10', 1),
(1290, 'Karai Parsurai', 214, '10', 1),
(1291, 'Nagar Nausa', 214, '10', 1),
(1292, 'Harnaut', 214, '10', 1),
(1293, 'Chandi', 214, '10', 1),
(1294, 'Rahui', 214, '10', 1),
(1295, 'Bind', 214, '10', 1),
(1296, 'Sarmera', 214, '10', 1),
(1297, 'Asthawan', 214, '10', 1),
(1298, 'Bihar', 214, '10', 1),
(1299, 'Noorsarai', 214, '10', 1),
(1300, 'Tharthari', 214, '10', 1),
(1301, 'Parbalpur', 214, '10', 1),
(1302, 'Hilsa', 214, '10', 1),
(1303, 'Ekangarsarai', 214, '10', 1),
(1304, 'Islampur', 214, '10', 1),
(1305, 'Ben', 214, '10', 1),
(1306, 'Rajgir', 214, '10', 1),
(1307, 'Silao', 214, '10', 1),
(1308, 'Giriak', 214, '10', 1),
(1309, 'Katrisarai', 214, '10', 1),
(1310, 'Maner', 215, '10', 1),
(1311, 'Dinapur-Cum-Khagaul', 215, '10', 1),
(1312, 'Patna Rural (a) Patna Rural (b)', 215, '10', 1),
(1313, 'Sampatchak', 215, '10', 1),
(1314, 'Phulwari', 215, '10', 1),
(1315, 'Bihta', 215, '10', 1),
(1316, 'Naubatpur', 215, '10', 1),
(1317, 'Bikram', 215, '10', 1),
(1318, 'Dulhin Bazar', 215, '10', 1),
(1319, 'Paliganj', 215, '10', 1),
(1320, 'Masaurhi', 215, '10', 1),
(1321, 'Dhanarua', 215, '10', 1),
(1322, 'Punpun', 215, '10', 1),
(1323, 'Fatwah', 215, '10', 1),
(1324, 'Daniawan', 215, '10', 1),
(1325, 'Khusrupur', 215, '10', 1),
(1326, 'Bakhtiarpur', 215, '10', 1),
(1327, 'Athmalgola', 215, '10', 1),
(1328, 'Belchhi', 215, '10', 1),
(1329, 'Barh', 215, '10', 1),
(1330, 'Pandarak', 215, '10', 1),
(1331, 'Ghoswari', 215, '10', 1),
(1332, 'Mokameh', 215, '10', 1),
(1333, 'Shahpur', 216, '10', 1),
(1334, 'Arrah', 216, '10', 1),
(1335, 'Barhara', 216, '10', 1),
(1336, 'Koilwar', 216, '10', 1),
(1337, 'Sandesh', 216, '10', 1),
(1338, 'Udwant Nagar', 216, '10', 1),
(1339, 'Behea', 216, '10', 1),
(1340, 'Jagdishpur', 216, '10', 1),
(1341, 'Piro', 216, '10', 1),
(1342, 'Charpokhri', 216, '10', 1),
(1343, 'Garhani', 216, '10', 1),
(1344, 'Agiaon', 216, '10', 1),
(1345, 'Tarari', 216, '10', 1),
(1346, 'Sahar', 216, '10', 1),
(1347, 'Simri', 217, '10', 1),
(1348, 'Chakki', 217, '10', 1),
(1349, 'Barhampur', 217, '10', 1),
(1350, 'Chaugain', 217, '10', 1),
(1351, 'Kesath', 217, '10', 1),
(1352, 'Dumraon', 217, '10', 1),
(1353, 'Buxar', 217, '10', 1),
(1354, 'Chausa', 217, '10', 1),
(1355, 'Rajpur', 217, '10', 1),
(1356, 'Itarhi', 217, '10', 1),
(1357, 'Nawanagar', 217, '10', 1),
(1358, 'Ramgarh', 218, '10', 1),
(1359, 'Noawan', 218, '10', 1),
(1360, 'Kudra', 218, '10', 1),
(1361, 'Mohania', 218, '10', 1),
(1362, 'Durgawati', 218, '10', 1),
(1363, 'Chand', 218, '10', 1),
(1364, 'Chainpur', 218, '10', 1),
(1365, 'Bhabua', 218, '10', 1),
(1366, 'Rampur', 218, '10', 1),
(1367, 'Bhagwanpur', 218, '10', 1),
(1368, 'Adhaura', 218, '10', 1),
(1369, 'Kochas', 219, '10', 1),
(1370, 'Dinara', 219, '10', 1),
(1371, 'Dawath', 219, '10', 1),
(1372, 'Suryapura', 219, '10', 1),
(1373, 'Bikramganj', 219, '10', 1),
(1374, 'Karakat', 219, '10', 1),
(1375, 'Nasriganj', 219, '10', 1),
(1376, 'Rajpur', 219, '10', 1),
(1377, 'Sanjhauli', 219, '10', 1),
(1378, 'Nokha', 219, '10', 1),
(1379, 'Kargahar', 219, '10', 1),
(1380, 'Chenari', 219, '10', 1),
(1381, 'Nauhatta', 219, '10', 1),
(1382, 'Sheosagar', 219, '10', 1),
(1383, 'Sasaram', 219, '10', 1),
(1384, 'Akorhi Gola', 219, '10', 1),
(1385, 'Dehri', 219, '10', 1),
(1386, 'Tilouthu', 219, '10', 1),
(1387, 'Rohtas', 219, '10', 1),
(1388, 'Arwal', 220, '10', 1),
(1389, 'Kaler', 220, '10', 1),
(1390, 'Karpi', 220, '10', 1),
(1391, 'Sonbhadra Banshi', 220, '10', 1),
(1392, 'Suryapur Kurtha', 220, '10', 1),
(1393, 'Ratni Faridpur', 220, '10', 1),
(1394, 'Jehanabad', 220, '10', 1),
(1395, 'Kako', 220, '10', 1),
(1396, 'Modanganj', 220, '10', 1),
(1397, 'Ghoshi', 220, '10', 1),
(1398, 'Makhdumpur', 220, '10', 1),
(1399, 'Hulasganj', 220, '10', 1),
(1400, 'Daudnagar', 221, '10', 1),
(1401, 'Haspura', 221, '10', 1),
(1402, 'Goh', 221, '10', 1),
(1403, 'Rafiganj', 221, '10', 1),
(1404, 'Obra', 221, '10', 1),
(1405, 'Aurangabad', 221, '10', 1),
(1406, 'Barun', 221, '10', 1),
(1407, 'Nabinagar', 221, '10', 1),
(1408, 'Kutumba', 221, '10', 1),
(1409, 'Deo', 221, '10', 1),
(1410, 'Madanpur', 221, '10', 1),
(1411, 'Konch', 222, '10', 1),
(1412, 'Tikari', 222, '10', 1),
(1413, 'Belaganj', 222, '10', 1),
(1414, 'Khizirsarai', 222, '10', 1),
(1415, 'Neem Chak Bathani', 222, '10', 1),
(1416, 'Muhra', 222, '10', 1),
(1417, 'Atri', 222, '10', 1),
(1418, 'Manpur', 222, '10', 1),
(1419, 'Gaya', 222, '10', 1),
(1420, 'Paraiya', 222, '10', 1),
(1421, 'Guraru', 222, '10', 1),
(1422, 'Gurua', 222, '10', 1),
(1423, 'Amas', 222, '10', 1),
(1424, 'Banke Bazar', 222, '10', 1),
(1425, 'Imamganj', 222, '10', 1),
(1426, 'Dumaria', 222, '10', 1),
(1427, 'Sherghati', 222, '10', 1),
(1428, 'Dobhi', 222, '10', 1),
(1429, 'Bodh Gaya', 222, '10', 1),
(1430, 'Tan Kuppa', 222, '10', 1),
(1431, 'Wazirganj', 222, '10', 1),
(1432, 'Fatehpur', 222, '10', 1),
(1433, 'Mohanpur', 222, '10', 1),
(1434, 'Barachatti', 222, '10', 1),
(1435, 'Nardiganj', 223, '10', 1),
(1436, 'Nawada', 223, '10', 1),
(1437, 'Warisaliganj', 223, '10', 1),
(1438, 'Kashi Chak', 223, '10', 1),
(1439, 'Pakribarawan', 223, '10', 1),
(1440, 'Kawakol', 223, '10', 1),
(1441, 'Roh', 223, '10', 1),
(1442, 'Govindpur', 223, '10', 1),
(1443, 'Akbarpur', 223, '10', 1),
(1444, 'Hisua', 223, '10', 1),
(1445, 'Narhat', 223, '10', 1),
(1446, 'Meskaur', 223, '10', 1),
(1447, 'Sirdala', 223, '10', 1),
(1448, 'Rajauli', 223, '10', 1),
(1449, 'Islamnagar Aliganj', 224, '10', 1),
(1450, 'Sikandra', 224, '10', 1),
(1451, 'Jamui', 224, '10', 1),
(1452, 'Barhat', 224, '10', 1),
(1453, 'Lakshmipur', 224, '10', 1),
(1454, 'Jhajha', 224, '10', 1),
(1455, 'Gidhaur', 224, '10', 1),
(1456, 'Khaira', 224, '10', 1),
(1457, 'Sono', 224, '10', 1),
(1458, 'Chakai', 224, '10', 1),
(1459, 'Chungthang', 225, '11', 1),
(1460, 'Mangan', 225, '11', 1),
(1461, 'Gyalshing', 226, '11', 1),
(1462, 'Soreng', 226, '11', 1),
(1463, 'Namchi', 227, '11', 1),
(1464, 'Ravong', 227, '11', 1),
(1465, 'Gangtok', 228, '11', 1),
(1466, 'Pakyong', 228, '11', 1),
(1467, 'Rongli', 228, '11', 1),
(1468, 'Zemithang Circle', 229, '12', 1),
(1469, 'Lumla Circle', 229, '12', 1),
(1470, 'Dudunghar Circle', 229, '12', 1),
(1471, 'Tawang Circle', 229, '12', 1),
(1472, 'Jang Circle', 229, '12', 1),
(1473, 'Mukto Circle', 229, '12', 1),
(1474, 'Thingbu Circle', 229, '12', 1),
(1475, 'Dirang Circle', 230, '12', 1),
(1476, 'Nafra Circle', 230, '12', 1),
(1477, 'Bomdila Circle', 230, '12', 1),
(1478, 'Kalaktang Circle', 230, '12', 1),
(1479, 'Rupa Circle', 230, '12', 1),
(1480, 'Singchung Circle', 230, '12', 1),
(1481, 'Jamiri Circle', 230, '12', 1),
(1482, 'Thrizino Circle', 230, '12', 1),
(1483, 'Bhalukpong Circle', 230, '12', 1),
(1484, 'Balemu Circle', 230, '12', 1),
(1485, 'Seijosa Circle', 231, '12', 1),
(1486, 'Pakke Kessang Circle', 231, '12', 1),
(1487, 'Richukrong Circle', 231, '12', 1),
(1488, 'Seppa Circle', 231, '12', 1),
(1489, 'Lada Circle', 231, '12', 1),
(1490, 'Bameng Circle', 231, '12', 1),
(1491, 'Pipu Circle', 231, '12', 1),
(1492, 'Khenewa Circle', 231, '12', 1),
(1493, 'Chayangtajo Circle', 231, '12', 1),
(1494, 'Sawa Circle', 231, '12', 1),
(1495, 'Balijan Circle', 232, '12', 1),
(1496, 'Itanagar Circle', 232, '12', 1),
(1497, 'Naharlagun Circle', 232, '12', 1),
(1498, 'Doimukh Circle', 232, '12', 1),
(1499, 'Toru Circle', 232, '12', 1),
(1500, 'Sagalee Circle', 232, '12', 1),
(1501, 'Leporiang Circle', 232, '12', 1),
(1502, 'Mengio Circle', 232, '12', 1),
(1503, 'Kimin Circle', 232, '12', 1),
(1504, 'Ziro Circle', 233, '12', 1),
(1505, 'Yachuli Circle', 233, '12', 1),
(1506, 'Pistana Circle', 233, '12', 1),
(1507, 'Palin Circle', 233, '12', 1),
(1508, 'Yangte Circle', 233, '12', 1),
(1509, 'Sangram Circle', 233, '12', 1),
(1510, 'Nyapin Circle', 233, '12', 1),
(1511, 'Koloriang Circle', 233, '12', 1),
(1512, 'Chambang Circle', 233, '12', 1),
(1513, 'Sarli Circle', 233, '12', 1),
(1514, 'Parsi-Parlo Circle', 233, '12', 1),
(1515, 'Damin Circle', 233, '12', 1),
(1516, 'Longding Koling Circle', 233, '12', 1),
(1517, 'Tali Circle', 233, '12', 1),
(1518, 'Kamporijo Circle', 233, '12', 1),
(1519, 'Dollungmukh Circle', 233, '12', 1),
(1520, 'Raga Circle', 233, '12', 1),
(1521, 'Taksing Circle', 234, '12', 1),
(1522, 'Limeking Circle', 234, '12', 1),
(1523, 'Nacho Circle', 234, '12', 1),
(1524, 'Siyum Circle', 234, '12', 1),
(1525, 'Taliha Circle', 234, '12', 1),
(1526, 'Payeng Circle', 234, '12', 1),
(1527, 'Giba Circle', 234, '12', 1),
(1528, 'Daporijo Circle', 234, '12', 1),
(1529, 'Puchi Geko Circle', 234, '12', 1),
(1530, 'Dumporijo Circle', 234, '12', 1),
(1531, 'Baririjo Circle', 234, '12', 1),
(1532, 'Mechuka Circle', 235, '12', 1),
(1533, 'Monigong Circle', 235, '12', 1),
(1534, 'Pidi Circle', 235, '12', 1),
(1535, 'Payum Circle', 235, '12', 1),
(1536, 'Tato Circle', 235, '12', 1),
(1537, 'Kaying Circle', 235, '12', 1),
(1538, 'Darak Circle', 235, '12', 1),
(1539, 'Kamba Circle', 235, '12', 1),
(1540, 'Rumgong Circle', 235, '12', 1),
(1541, 'Jomlo Mobuk Circle', 235, '12', 1),
(1542, 'Liromoba Circle', 235, '12', 1),
(1543, 'Yomcha Circle', 235, '12', 1),
(1544, 'Along Circle', 235, '12', 1),
(1545, 'Tirbin Circle', 235, '12', 1),
(1546, 'Basar Circle', 235, '12', 1),
(1547, 'Daring Circle', 235, '12', 1),
(1548, 'Gensi Circle', 235, '12', 1),
(1549, 'Likabali Circle', 235, '12', 1),
(1550, 'Kangku Circle', 235, '12', 1),
(1551, 'Bagra Circle', 235, '12', 1),
(1552, 'Boleng Circle', 236, '12', 1),
(1553, 'Riga Circle', 236, '12', 1),
(1554, 'Pangin Circle', 236, '12', 1),
(1555, 'Rebo-Perging Circle', 236, '12', 1),
(1556, 'Koyu Circle', 236, '12', 1),
(1557, 'Nari Circle', 236, '12', 1),
(1558, 'New Seren Circle', 236, '12', 1),
(1559, 'Bilat Circle', 236, '12', 1),
(1560, 'Ruksin Circle', 236, '12', 1),
(1561, 'Sille-Oyan Circle', 236, '12', 1),
(1562, 'Pasighat Circle', 236, '12', 1),
(1563, 'Mebo Circle', 236, '12', 1),
(1564, 'Tuting Circle', 237, '12', 1),
(1565, 'Migging Circle', 237, '12', 1),
(1566, 'Palling Circle', 237, '12', 1),
(1567, 'Gelling Circle', 237, '12', 1),
(1568, 'Singa Circle', 237, '12', 1),
(1569, 'Yingwong Circle', 237, '12', 1),
(1570, 'Jengging Circle', 237, '12', 1),
(1571, 'Geku Circle', 237, '12', 1),
(1572, 'Mariyang Circle', 237, '12', 1),
(1573, 'Katan Circle', 237, '12', 1),
(1574, 'Mipi Circle', 238, '12', 1),
(1575, 'Anini Circle', 238, '12', 1),
(1576, 'Etalin Circle', 238, '12', 1),
(1577, 'Anelih Circle', 238, '12', 1),
(1578, 'Koronli Circle', 238, '12', 1),
(1579, 'Hunli Circle', 238, '12', 1),
(1580, 'Desali Circle', 238, '12', 1),
(1581, 'Roing Circle', 238, '12', 1),
(1582, 'Dambuk Circle', 238, '12', 1),
(1583, 'Koronu Circle', 238, '12', 1),
(1584, 'Sunpura Circle', 239, '12', 1),
(1585, 'Tezu Circle', 239, '12', 1),
(1586, 'Hayuliang Circle', 239, '12', 1),
(1587, 'Manchal Circle', 239, '12', 1),
(1588, 'Goiliang Circle', 239, '12', 1),
(1589, 'Chaglagam Circle', 239, '12', 1),
(1590, 'Kibithoo Circle', 239, '12', 1),
(1591, 'Walong Circle', 239, '12', 1),
(1592, 'Hawai Circle', 239, '12', 1),
(1593, 'Wakro Circle', 239, '12', 1),
(1594, 'Chowkham Circle', 239, '12', 1),
(1595, 'Namsai Circle', 239, '12', 1),
(1596, 'Piyong Circle', 239, '12', 1),
(1597, 'Mahadevpur Circle', 239, '12', 1),
(1598, 'Khimiyong Circle', 240, '12', 1),
(1599, 'Changlang Circle', 240, '12', 1),
(1600, 'Namtok Circle', 240, '12', 1),
(1601, 'Manmao Circle', 240, '12', 1),
(1602, 'Nampong Circle', 240, '12', 1),
(1603, 'Jairampur Circle', 240, '12', 1);
INSERT INTO `tbl_city` (`city_id`, `city_name`, `district_id`, `state_id`, `country_id`) VALUES
(1604, 'Vijoynagar Circle', 240, '12', 1),
(1605, 'Miao Circle', 240, '12', 1),
(1606, 'Kharsang Circle', 240, '12', 1),
(1607, 'Diyun Circle', 240, '12', 1),
(1608, 'Bordumsa Circle', 240, '12', 1),
(1609, 'Namsang Circle', 241, '12', 1),
(1610, 'Khonsa Circle', 241, '12', 1),
(1611, 'Kanubari Circle', 241, '12', 1),
(1612, 'Longding Circle', 241, '12', 1),
(1613, 'Pumao Circle', 241, '12', 1),
(1614, 'Pangchao Circle', 241, '12', 1),
(1615, 'Wakka Circle', 241, '12', 1),
(1616, 'Laju Circle', 241, '12', 1),
(1617, 'Naginimora', 242, '13', 1),
(1618, 'Tizit', 242, '13', 1),
(1619, 'Hunta', 242, '13', 1),
(1620, 'Shangyu', 242, '13', 1),
(1621, 'Mon Sadar', 242, '13', 1),
(1622, 'Wakching', 242, '13', 1),
(1623, 'Aboi', 242, '13', 1),
(1624, 'Longshen', 242, '13', 1),
(1625, 'Phomching', 242, '13', 1),
(1626, 'Chen', 242, '13', 1),
(1627, 'Longching', 242, '13', 1),
(1628, 'Mopong', 242, '13', 1),
(1629, 'Tobu', 242, '13', 1),
(1630, 'Monyakshu', 242, '13', 1),
(1631, 'Tamlu', 243, '13', 1),
(1632, 'Yongya', 243, '13', 1),
(1633, 'Longleng', 243, '13', 1),
(1634, 'Noksen', 243, '13', 1),
(1635, 'Chare', 243, '13', 1),
(1636, 'Longkhim', 243, '13', 1),
(1637, 'Tuensang Sadar', 243, '13', 1),
(1638, 'Noklak', 243, '13', 1),
(1639, 'Panso', 243, '13', 1),
(1640, 'Shamator', 243, '13', 1),
(1641, 'Tsurungtho', 243, '13', 1),
(1642, 'Chessore', 243, '13', 1),
(1643, 'Seyochung', 243, '13', 1),
(1644, 'Amahator', 243, '13', 1),
(1645, 'Kiphire Sadar', 243, '13', 1),
(1646, 'Thonoknyu', 243, '13', 1),
(1647, 'Kiusam', 243, '13', 1),
(1648, 'Sitimi', 243, '13', 1),
(1649, 'Longmatra', 243, '13', 1),
(1650, 'Pungro', 243, '13', 1),
(1651, 'Longchem', 244, '13', 1),
(1652, 'Alongkima', 244, '13', 1),
(1653, 'Tuli', 244, '13', 1),
(1654, 'Changtongya', 244, '13', 1),
(1655, 'Chuchuyimlang', 244, '13', 1),
(1656, 'Kubolong', 244, '13', 1),
(1657, 'Mangkolemba', 244, '13', 1),
(1658, 'Ongpangkong', 244, '13', 1),
(1659, 'V.K.', 245, '13', 1),
(1660, 'Akuluto', 245, '13', 1),
(1661, 'Suruhoto', 245, '13', 1),
(1662, 'Asuto', 245, '13', 1),
(1663, 'Aghunato', 245, '13', 1),
(1664, 'Zunheboto Sadar', 245, '13', 1),
(1665, 'Atoizu', 245, '13', 1),
(1666, 'Pughoboto', 245, '13', 1),
(1667, 'Ghatashi', 245, '13', 1),
(1668, 'Satakha', 245, '13', 1),
(1669, 'Satoi', 245, '13', 1),
(1670, 'Changpang', 246, '13', 1),
(1671, 'Aitepyong', 246, '13', 1),
(1672, 'Bhandari', 246, '13', 1),
(1673, 'Baghty', 246, '13', 1),
(1674, 'Sungro', 246, '13', 1),
(1675, 'Sanis', 246, '13', 1),
(1676, 'Lotsu', 246, '13', 1),
(1677, 'Ralan', 246, '13', 1),
(1678, 'Wozhuro', 246, '13', 1),
(1679, 'Wokha Sadar', 246, '13', 1),
(1680, 'Chukitong', 246, '13', 1),
(1681, 'Niuland', 247, '13', 1),
(1682, 'Kuhoboto', 247, '13', 1),
(1683, 'Nihokhu', 247, '13', 1),
(1684, 'Dimapur Sadar', 247, '13', 1),
(1685, 'Chumukedima', 247, '13', 1),
(1686, 'Dhansiripar', 247, '13', 1),
(1687, 'Medziphema', 247, '13', 1),
(1688, 'Tseminyu', 248, '13', 1),
(1689, 'Chiephobozou', 248, '13', 1),
(1690, 'Kezocha', 248, '13', 1),
(1691, 'Jakhama', 248, '13', 1),
(1692, 'Kohima Sadar', 248, '13', 1),
(1693, 'Sechu', 248, '13', 1),
(1694, 'Ngwalwa', 248, '13', 1),
(1695, 'Jalukie', 248, '13', 1),
(1696, 'Athibung', 248, '13', 1),
(1697, 'Nsong', 248, '13', 1),
(1698, 'Tening', 248, '13', 1),
(1699, 'Peren', 248, '13', 1),
(1700, 'Sekruzu', 249, '13', 1),
(1701, 'Phek Sadar', 249, '13', 1),
(1702, 'Meluri', 249, '13', 1),
(1703, 'Phokhungri', 249, '13', 1),
(1704, 'Chazouba', 249, '13', 1),
(1705, 'Chetheba', 249, '13', 1),
(1706, 'Sakraba', 249, '13', 1),
(1707, 'Pfutsero', 249, '13', 1),
(1708, 'Khezhakeno', 249, '13', 1),
(1709, 'Chizami', 249, '13', 1),
(1710, 'Mao-Maram Sub-Division', 250, '14', 1),
(1711, 'Paomata Sub-Division', 250, '14', 1),
(1712, 'Purul Sub-Division', 250, '14', 1),
(1713, 'Sadar Hills West Sub-Division', 250, '14', 1),
(1714, 'Saitu Gamphazol Sub-Division', 250, '14', 1),
(1715, 'Sadar Hills East Sub-Division', 250, '14', 1),
(1716, 'Tamenglong West Sub-Division', 251, '14', 1),
(1717, 'Tamenglong North Sub-Division', 251, '14', 1),
(1718, 'Tamenglong Sub-Division', 251, '14', 1),
(1719, 'Nungba Sub-Division', 251, '14', 1),
(1720, 'Tipaimukh Sub-Division', 252, '14', 1),
(1721, 'Thanlon Sub-Division', 252, '14', 1),
(1722, 'Churachandpur North Sub-Div.', 252, '14', 1),
(1723, 'Churachandpur  Sub-Division', 252, '14', 1),
(1724, 'Singngat Sub-Division', 252, '14', 1),
(1725, 'Nambol Sub-Division', 253, '14', 1),
(1726, 'Bishnupur Sub-Division', 253, '14', 1),
(1727, 'Moirang Sub-Division', 253, '14', 1),
(1728, 'Lilong Sub-Division', 254, '14', 1),
(1729, 'Thoubal Sub-Division', 254, '14', 1),
(1730, 'Kakching Sub-Div.', 254, '14', 1),
(1731, 'Lamshang Sub-Division', 255, '14', 1),
(1732, 'Patsoi Sub-Division', 255, '14', 1),
(1733, 'Lamphelpat Sub-Division', 255, '14', 1),
(1734, 'Wangoi Sub-Division', 255, '14', 1),
(1735, 'Jiribam  Sub-Division', 256, '14', 1),
(1736, 'Sawombung Sub-Division', 256, '14', 1),
(1737, 'Porompat Sub-Division', 256, '14', 1),
(1738, 'Keirao Bitra Sub-Division', 256, '14', 1),
(1739, 'Ukhrul North  Sub-Division', 257, '14', 1),
(1740, 'Ukhrul Central Sub-Division', 257, '14', 1),
(1741, 'Kamjong Chassad Sub-Div.', 257, '14', 1),
(1742, 'Phungyar Phaisat Sub-Division', 257, '14', 1),
(1743, 'Ukhrul South Sub-Division', 257, '14', 1),
(1744, 'Machi  Sub-Division', 258, '14', 1),
(1745, 'Tengnoupal Sub-Division', 258, '14', 1),
(1746, 'Chandel Sub-Div.', 258, '14', 1),
(1747, 'Chakpikarong Sub-Division', 258, '14', 1),
(1748, 'Zawlnuam', 259, '15', 1),
(1749, 'West Phaileng', 259, '15', 1),
(1750, 'Reiek', 259, '15', 1),
(1751, 'North Thingdawl', 260, '15', 1),
(1752, 'Darlawn', 261, '15', 1),
(1753, 'Phullen', 261, '15', 1),
(1754, 'Thingsulthliah', 261, '15', 1),
(1755, 'Tlangnuam', 261, '15', 1),
(1756, 'Aibawk', 261, '15', 1),
(1757, 'Ngopa', 262, '15', 1),
(1758, 'Khawzawl', 262, '15', 1),
(1759, 'Khawbung', 262, '15', 1),
(1760, 'Serchhip', 263, '15', 1),
(1761, 'East Lungdar', 263, '15', 1),
(1762, 'West Bunghmun', 264, '15', 1),
(1763, 'Lungsen', 264, '15', 1),
(1764, 'Lunglei', 264, '15', 1),
(1765, 'Hnahthial', 264, '15', 1),
(1766, 'Chawngte', 265, '15', 1),
(1767, 'Lawngtlai', 265, '15', 1),
(1768, 'Sangau', 266, '15', 1),
(1769, 'Tuipang', 266, '15', 1),
(1770, 'Mohanpur', 267, '16', 1),
(1771, 'Hezamara', 267, '16', 1),
(1772, 'Pabmabil', 267, '16', 1),
(1773, 'Khowai', 267, '16', 1),
(1774, 'Tulashikhar', 267, '16', 1),
(1775, 'Kalyanpur', 267, '16', 1),
(1776, 'Teliamura', 267, '16', 1),
(1777, 'Mandai', 267, '16', 1),
(1778, 'Jirania', 267, '16', 1),
(1779, 'Dukli', 267, '16', 1),
(1780, 'Jampuijala', 267, '16', 1),
(1781, 'Bishalgarh', 267, '16', 1),
(1782, 'Boxanagar', 267, '16', 1),
(1783, 'Melaghar', 267, '16', 1),
(1784, 'Kathalia', 267, '16', 1),
(1785, 'Killa', 268, '16', 1),
(1786, 'Amarpur', 268, '16', 1),
(1787, 'Matarbari', 268, '16', 1),
(1788, 'Kakraban', 268, '16', 1),
(1789, 'Rajnagar', 268, '16', 1),
(1790, 'Hrishyamukh', 268, '16', 1),
(1791, 'Bagafa', 268, '16', 1),
(1792, 'Karbuk', 268, '16', 1),
(1793, 'Rupaichhari', 268, '16', 1),
(1794, 'Satchand', 268, '16', 1),
(1795, 'Salema', 269, '16', 1),
(1796, 'Manu', 269, '16', 1),
(1797, 'Ambassa', 269, '16', 1),
(1798, 'Chhamanu', 269, '16', 1),
(1799, 'Dumburnagar', 269, '16', 1),
(1800, 'Gournagar', 270, '16', 1),
(1801, 'Kadamtala', 270, '16', 1),
(1802, 'Panisagar', 270, '16', 1),
(1803, 'Damchhara', 270, '16', 1),
(1804, 'Pencharthal', 270, '16', 1),
(1805, 'Kumarghat', 270, '16', 1),
(1806, 'Dasda', 270, '16', 1),
(1807, 'Jampuii hills', 270, '16', 1),
(1808, 'Selsella', 271, '17', 1),
(1809, 'Dadenggiri', 271, '17', 1),
(1810, 'Tikrikilla', 271, '17', 1),
(1811, 'Rongram', 271, '17', 1),
(1812, 'Betasing', 271, '17', 1),
(1813, 'Zikzak', 271, '17', 1),
(1814, 'Dalu', 271, '17', 1),
(1815, 'Resubelpara', 272, '17', 1),
(1816, 'Dambo Rongjeng', 272, '17', 1),
(1817, 'Songsak', 272, '17', 1),
(1818, 'Samanda', 272, '17', 1),
(1819, 'Chokpot', 273, '17', 1),
(1820, 'Baghmara', 273, '17', 1),
(1821, 'Rongara', 273, '17', 1),
(1822, 'Mawshynrut', 274, '17', 1),
(1823, 'Nongstoin', 274, '17', 1),
(1824, 'Mairang', 274, '17', 1),
(1825, 'Ranikor', 274, '17', 1),
(1826, 'Mawkyrwat', 274, '17', 1),
(1827, 'Umling', 275, '17', 1),
(1828, 'Umsning', 275, '17', 1),
(1829, 'Mawphlang', 276, '17', 1),
(1830, 'Mylliem', 276, '17', 1),
(1831, 'Mawryngkneng', 276, '17', 1),
(1832, 'Mawkynrew', 276, '17', 1),
(1833, 'Mawsynram', 276, '17', 1),
(1834, 'Shella Bholaganj', 276, '17', 1),
(1835, 'Pynursla', 276, '17', 1),
(1836, 'Thadlaskein', 277, '17', 1),
(1837, 'Laskein', 277, '17', 1),
(1838, 'Amlarem', 277, '17', 1),
(1839, 'Khliehriat', 277, '17', 1),
(1840, 'Gossaigaon', 278, '18', 1),
(1841, 'Bhowraguri', 278, '18', 1),
(1842, 'Dotoma', 278, '18', 1),
(1843, 'Kokrajhar', 278, '18', 1),
(1844, 'Sidli (PT-I)', 278, '18', 1),
(1845, 'Agamoni', 279, '18', 1),
(1846, 'Golokganj', 279, '18', 1),
(1847, 'Dhubri', 279, '18', 1),
(1848, 'BagribariI', 279, '18', 1),
(1849, 'Bilasipara', 279, '18', 1),
(1850, 'Chapar', 279, '18', 1),
(1851, 'South Salmara', 279, '18', 1),
(1852, 'Mankachar', 279, '18', 1),
(1853, 'Lakhipur', 280, '18', 1),
(1854, 'Balijana', 280, '18', 1),
(1855, 'Matia', 280, '18', 1),
(1856, 'Dudhnai', 280, '18', 1),
(1857, 'Rangjuli', 280, '18', 1),
(1858, 'Sidli (PT-II)', 281, '18', 1),
(1859, 'Bongaigaon', 281, '18', 1),
(1860, 'Boitamari', 281, '18', 1),
(1861, 'Srijangram', 281, '18', 1),
(1862, 'Bijni', 281, '18', 1),
(1863, 'Barnagar', 282, '18', 1),
(1864, 'Kalgachia', 282, '18', 1),
(1865, 'Baghbor', 282, '18', 1),
(1866, 'Barpeta', 282, '18', 1),
(1867, 'Sarthebari', 282, '18', 1),
(1868, 'Bajali', 282, '18', 1),
(1869, 'Sarupeta', 282, '18', 1),
(1870, 'Jalah', 282, '18', 1),
(1871, 'Goreswar', 283, '18', 1),
(1872, 'Rangia', 283, '18', 1),
(1873, 'Kamalpur', 283, '18', 1),
(1874, 'Kamalpur', 283, '18', 1),
(1875, 'Hajo', 283, '18', 1),
(1876, 'Chhaygaon', 283, '18', 1),
(1877, 'Chamaria', 283, '18', 1),
(1878, 'Nagarbera', 283, '18', 1),
(1879, 'Boko', 283, '18', 1),
(1880, 'Palasbari', 283, '18', 1),
(1881, 'Guwahati', 283, '18', 1),
(1882, 'North Guwahati', 283, '18', 1),
(1883, 'Dispur', 283, '18', 1),
(1884, 'Sonapur', 283, '18', 1),
(1885, 'Chandrapur', 283, '18', 1),
(1886, 'Baska', 284, '18', 1),
(1887, 'Barama', 284, '18', 1),
(1888, 'Tihu', 284, '18', 1),
(1889, 'Pachim Nalbari', 284, '18', 1),
(1890, 'Barkhetri', 284, '18', 1),
(1891, 'Barbhag', 284, '18', 1),
(1892, 'Nalbari', 284, '18', 1),
(1893, 'Ghograpar', 284, '18', 1),
(1894, 'Tamulpur', 284, '18', 1),
(1895, 'Harisinga', 285, '18', 1),
(1896, 'Khoirabari', 285, '18', 1),
(1897, 'Pathorighat', 285, '18', 1),
(1898, 'Sipajhar', 285, '18', 1),
(1899, 'Mangaldoi', 285, '18', 1),
(1900, 'Kalajgaon', 285, '18', 1),
(1901, 'Dalgaon', 285, '18', 1),
(1902, 'Dalgaon', 285, '18', 1),
(1903, 'Udalguri', 285, '18', 1),
(1904, 'Majbat', 285, '18', 1),
(1905, 'Mayong', 286, '18', 1),
(1906, 'Bhuragaon', 286, '18', 1),
(1907, 'Laharighat', 286, '18', 1),
(1908, 'Marigaon', 286, '18', 1),
(1909, 'Mikirbheta', 286, '18', 1),
(1910, 'Koliabor', 287, '18', 1),
(1911, 'Samaguri', 287, '18', 1),
(1912, 'Samaguri', 287, '18', 1),
(1913, 'Rupahi', 287, '18', 1),
(1914, 'Rupahi', 287, '18', 1),
(1915, 'Dhing', 287, '18', 1),
(1916, 'Nagaon', 287, '18', 1),
(1917, 'Raha', 287, '18', 1),
(1918, 'Kampur', 287, '18', 1),
(1919, 'Hojai', 287, '18', 1),
(1920, 'Lanka', 287, '18', 1),
(1921, 'Dhekiajuli', 288, '18', 1),
(1922, 'Chariduar', 288, '18', 1),
(1923, 'Tezpur', 288, '18', 1),
(1924, 'Na-Duar', 288, '18', 1),
(1925, 'Biswanath', 288, '18', 1),
(1926, 'Helem', 288, '18', 1),
(1927, 'Gohpur', 288, '18', 1),
(1928, 'Narayanpur', 289, '18', 1),
(1929, 'Bihpuraia', 289, '18', 1),
(1930, 'Naobaicha', 289, '18', 1),
(1931, 'Kadam', 289, '18', 1),
(1932, 'North Lakhimpur', 289, '18', 1),
(1933, 'Dhakuakhana (PT-I)', 289, '18', 1),
(1934, 'Subansiri (PT-I)', 289, '18', 1),
(1935, 'Subansiri (PT-II)', 290, '18', 1),
(1936, 'Dhemaji', 290, '18', 1),
(1937, 'Dhakuakhana (PT-II)', 290, '18', 1),
(1938, 'Sissibargaon', 290, '18', 1),
(1939, 'Jonai', 290, '18', 1),
(1940, 'Sadiya', 291, '18', 1),
(1941, 'Doom Dooma', 291, '18', 1),
(1942, 'Tinsukia', 291, '18', 1),
(1943, 'Margherita', 291, '18', 1),
(1944, 'Dibrugarh West', 292, '18', 1),
(1945, 'Dibrugarh East', 292, '18', 1),
(1946, 'Chabua', 292, '18', 1),
(1947, 'Tengakhat', 292, '18', 1),
(1948, 'Moran', 292, '18', 1),
(1949, 'Tingkhong', 292, '18', 1),
(1950, 'Naharkathiya', 292, '18', 1),
(1951, 'Dimow', 293, '18', 1),
(1952, 'Sibsagar', 293, '18', 1),
(1953, 'Amguri', 293, '18', 1),
(1954, 'Amguri', 293, '18', 1),
(1955, 'Nazira', 293, '18', 1),
(1956, 'Nazira', 293, '18', 1),
(1957, 'Sonari', 293, '18', 1),
(1958, 'Sonari', 293, '18', 1),
(1959, 'Mahmora', 293, '18', 1),
(1960, 'Majuli', 294, '18', 1),
(1961, 'Jorhat West', 294, '18', 1),
(1962, 'Jorhat East', 294, '18', 1),
(1963, 'Teok', 294, '18', 1),
(1964, 'Titabar', 294, '18', 1),
(1965, 'Bokakhat', 295, '18', 1),
(1966, 'Khumtai', 295, '18', 1),
(1967, 'Dergaon', 295, '18', 1),
(1968, 'Golaghat', 295, '18', 1),
(1969, 'Sarupathar', 295, '18', 1),
(1970, 'Donka', 296, '18', 1),
(1971, 'Diphu', 296, '18', 1),
(1972, 'Diphu', 296, '18', 1),
(1973, 'Phuloni', 296, '18', 1),
(1974, 'Phuloni', 296, '18', 1),
(1975, 'Silonijan', 296, '18', 1),
(1976, 'Umrangso', 297, '18', 1),
(1977, 'Haflong', 297, '18', 1),
(1978, 'Mahur', 297, '18', 1),
(1979, 'Maibong', 297, '18', 1),
(1980, 'Katigora', 298, '18', 1),
(1981, 'Silchar', 298, '18', 1),
(1982, 'Udarbond', 298, '18', 1),
(1983, 'Sonai', 298, '18', 1),
(1984, 'Sonai', 298, '18', 1),
(1985, 'Lakhipur', 298, '18', 1),
(1986, 'Karimganj', 299, '18', 1),
(1987, 'Badarpur', 299, '18', 1),
(1988, 'Nilambazar', 299, '18', 1),
(1989, 'Patharkandi', 299, '18', 1),
(1990, 'Ramkrishna Nagar', 299, '18', 1),
(1991, 'Algapur', 300, '18', 1),
(1992, 'Hailakandi', 300, '18', 1),
(1993, 'Lala', 300, '18', 1),
(1994, 'Katlichara', 300, '18', 1),
(1995, 'Darjeeling Pulbazar', 301, '19', 1),
(1996, 'Rangli Rangliot', 301, '19', 1),
(1997, 'Kalimpong -I', 301, '19', 1),
(1998, 'Kalimpong - II', 301, '19', 1),
(1999, 'Gorubathan', 301, '19', 1),
(2000, 'Jorebunglow Sukiapokhri', 301, '19', 1),
(2001, 'Mirik', 301, '19', 1),
(2002, 'Kurseong', 301, '19', 1),
(2003, 'Matigara', 301, '19', 1),
(2004, 'Naxalbari', 301, '19', 1),
(2005, 'Phansidewa', 301, '19', 1),
(2006, 'Kharibari', 301, '19', 1),
(2007, 'Rajganj', 302, '19', 1),
(2008, 'Mal', 302, '19', 1),
(2009, 'Matiali', 302, '19', 1),
(2010, 'Nagrakata', 302, '19', 1),
(2011, 'Madarihat', 302, '19', 1),
(2012, 'Kalchini', 302, '19', 1),
(2013, 'Kumargram', 302, '19', 1),
(2014, 'Alipurduar - I', 302, '19', 1),
(2015, 'Alipurduar - II', 302, '19', 1),
(2016, 'Falakata', 302, '19', 1),
(2017, 'Dhupguri', 302, '19', 1),
(2018, 'Maynaguri', 302, '19', 1),
(2019, 'Jalpaiguri', 302, '19', 1),
(2020, 'Haldibari', 303, '19', 1),
(2021, 'Mekliganj', 303, '19', 1),
(2022, 'Mathabhanga - I', 303, '19', 1),
(2023, 'Mathabhanga - II', 303, '19', 1),
(2024, 'Cooch Behar - I', 303, '19', 1),
(2025, 'Cooch Behar - II', 303, '19', 1),
(2026, 'Tufanganj - I', 303, '19', 1),
(2027, 'Tufanganj - II', 303, '19', 1),
(2028, 'Dinhata - I', 303, '19', 1),
(2029, 'Dinhata - II', 303, '19', 1),
(2030, 'Sitai', 303, '19', 1),
(2031, 'Sitalkuchi', 303, '19', 1),
(2032, 'Chopra', 304, '19', 1),
(2033, 'Islampur', 304, '19', 1),
(2034, 'Goalpokhar - I', 304, '19', 1),
(2035, 'Goalpokhar - II', 304, '19', 1),
(2036, 'Karandighi', 304, '19', 1),
(2037, 'Raiganj', 304, '19', 1),
(2038, 'Hemtabad', 304, '19', 1),
(2039, 'Kaliaganj', 304, '19', 1),
(2040, 'Itahar', 304, '19', 1),
(2041, 'Kushmundi', 305, '19', 1),
(2042, 'Gangarampur', 305, '19', 1),
(2043, 'Kumarganj', 305, '19', 1),
(2044, 'Hilli', 305, '19', 1),
(2045, 'Balurghat', 305, '19', 1),
(2046, 'Tapan', 305, '19', 1),
(2047, 'Bansihari', 305, '19', 1),
(2048, 'Harirampur', 305, '19', 1),
(2049, 'Harishchandrapur - I', 306, '19', 1),
(2050, 'Harishchandrapur - II', 306, '19', 1),
(2051, 'Chanchal - I', 306, '19', 1),
(2052, 'Chanchal - II', 306, '19', 1),
(2053, 'Ratua - I', 306, '19', 1),
(2054, 'Ratua - II', 306, '19', 1),
(2055, 'Gazole', 306, '19', 1),
(2056, 'Bamangola', 306, '19', 1),
(2057, 'Habibpur', 306, '19', 1),
(2058, 'Maldah (old)', 306, '19', 1),
(2059, 'English Bazar', 306, '19', 1),
(2060, 'Manikchak', 306, '19', 1),
(2061, 'Kaliachak - I', 306, '19', 1),
(2062, 'Kaliachak - II', 306, '19', 1),
(2063, 'Kaliachak - III', 306, '19', 1),
(2064, 'Farakka', 307, '19', 1),
(2065, 'Samserganj', 307, '19', 1),
(2066, 'Suti - I', 307, '19', 1),
(2067, 'Suti - II', 307, '19', 1),
(2068, 'Raghunathganj - I', 307, '19', 1),
(2069, 'Raghunathganj - II', 307, '19', 1),
(2070, 'Lalgola', 307, '19', 1),
(2071, 'Sagardighi', 307, '19', 1),
(2072, 'Bhagawangola - I', 307, '19', 1),
(2073, 'Bhagawangola - II', 307, '19', 1),
(2074, 'Raninagar - II', 307, '19', 1),
(2075, 'Jalangi', 307, '19', 1),
(2076, 'Domkal', 307, '19', 1),
(2077, 'Raninagar - I', 307, '19', 1),
(2078, 'Murshidabad Jiaganj', 307, '19', 1),
(2079, 'Nabagram', 307, '19', 1),
(2080, 'Khargram', 307, '19', 1),
(2081, 'Kandi', 307, '19', 1),
(2082, 'Berhampore', 307, '19', 1),
(2083, 'Hariharpara', 307, '19', 1),
(2084, 'Nawda', 307, '19', 1),
(2085, 'Beldanga - I', 307, '19', 1),
(2086, 'Beldanga - II', 307, '19', 1),
(2087, 'Bharatpur - II', 307, '19', 1),
(2088, 'Bharatpur - I', 307, '19', 1),
(2089, 'Burwan', 307, '19', 1),
(2090, 'Murarai - I', 308, '19', 1),
(2091, 'Murarai - II', 308, '19', 1),
(2092, 'Nalhati - I', 308, '19', 1),
(2093, 'Nalhati - II', 308, '19', 1),
(2094, 'Rampurhat - I', 308, '19', 1),
(2095, 'Rampurhat - II', 308, '19', 1),
(2096, 'Mayureswar - I', 308, '19', 1),
(2097, 'Mayureswar - II', 308, '19', 1),
(2098, 'Mohammad Bazar', 308, '19', 1),
(2099, 'Rajnagar', 308, '19', 1),
(2100, 'Suri - I', 308, '19', 1),
(2101, 'Suri - II', 308, '19', 1),
(2102, 'Sainthia', 308, '19', 1),
(2103, 'Labpur', 308, '19', 1),
(2104, 'Nanoor', 308, '19', 1),
(2105, 'Bolpur Sriniketan', 308, '19', 1),
(2106, 'Illambazar', 308, '19', 1),
(2107, 'Dubrajpur', 308, '19', 1),
(2108, 'Khoyrasol', 308, '19', 1),
(2109, 'Salanpur', 309, '19', 1),
(2110, 'Barabani', 309, '19', 1),
(2111, 'Jamuria', 309, '19', 1),
(2112, 'Raniganj', 309, '19', 1),
(2113, 'Ondal', 309, '19', 1),
(2114, 'Pandabeswar', 309, '19', 1),
(2115, 'Faridpur Durgapur', 309, '19', 1),
(2116, 'Kanksa', 309, '19', 1),
(2117, 'Ausgram - II', 309, '19', 1),
(2118, 'Ausgram - I', 309, '19', 1),
(2119, 'Mangolkote', 309, '19', 1),
(2120, 'Ketugram - I', 309, '19', 1),
(2121, 'Ketugram - II', 309, '19', 1),
(2122, 'Katwa - I', 309, '19', 1),
(2123, 'Katwa - II', 309, '19', 1),
(2124, 'Purbasthali - I', 309, '19', 1),
(2125, 'Purbasthali - II', 309, '19', 1),
(2126, 'Manteswar', 309, '19', 1),
(2127, 'Bhatar', 309, '19', 1),
(2128, 'Galsi - I', 309, '19', 1),
(2129, 'Galsi - II', 309, '19', 1),
(2130, 'Burdwan - I', 309, '19', 1),
(2131, 'Burdwan - II', 309, '19', 1),
(2132, 'Memari - I', 309, '19', 1),
(2133, 'Memari - II', 309, '19', 1),
(2134, 'Kalna - I', 309, '19', 1),
(2135, 'Kalna - II', 309, '19', 1),
(2136, 'Jamalpur', 309, '19', 1),
(2137, 'Raina - I', 309, '19', 1),
(2138, 'Khandaghosh', 309, '19', 1),
(2139, 'Raina - II', 309, '19', 1),
(2140, 'Karimpur - I', 310, '19', 1),
(2141, 'Karimpur - II', 310, '19', 1),
(2142, 'Tehatta - I', 310, '19', 1),
(2143, 'Tehatta - II', 310, '19', 1),
(2144, 'Kaliganj', 310, '19', 1),
(2145, 'Nakashipara', 310, '19', 1),
(2146, 'Chapra', 310, '19', 1),
(2147, 'Krishnagar - II', 310, '19', 1),
(2148, 'Nabadwip', 310, '19', 1),
(2149, 'Krishnagar - I', 310, '19', 1),
(2150, 'Krishnaganj', 310, '19', 1),
(2151, 'Hanskhali', 310, '19', 1),
(2152, 'Santipur', 310, '19', 1),
(2153, 'Ranaghat - I', 310, '19', 1),
(2154, 'Ranaghat - II', 310, '19', 1),
(2155, 'Chakdah', 310, '19', 1),
(2156, 'Haringhata', 310, '19', 1),
(2157, 'Bagda', 311, '19', 1),
(2158, 'Bongaon', 311, '19', 1),
(2159, 'Gaighata', 311, '19', 1),
(2160, 'Swarupnagar', 311, '19', 1),
(2161, 'Habra - I', 311, '19', 1),
(2162, 'Habra - II', 311, '19', 1),
(2163, 'Amdanga', 311, '19', 1),
(2164, 'Barrackpur - I', 311, '19', 1),
(2165, 'Barrackpur - II', 311, '19', 1),
(2166, 'Barasat - I', 311, '19', 1),
(2167, 'Barasat - II', 311, '19', 1),
(2168, 'Deganga', 311, '19', 1),
(2169, 'Baduria', 311, '19', 1),
(2170, 'Basirhat - I', 311, '19', 1),
(2171, 'Basirhat - II', 311, '19', 1),
(2172, 'Haroa', 311, '19', 1),
(2173, 'Rajarhat', 311, '19', 1),
(2174, 'Minakhan', 311, '19', 1),
(2175, 'Sandeskhali - I', 311, '19', 1),
(2176, 'Sandeskhali - II', 311, '19', 1),
(2177, 'Hasnabad', 311, '19', 1),
(2178, 'Hingalganj', 311, '19', 1),
(2179, 'Goghat - I', 312, '19', 1),
(2180, 'Goghat - II', 312, '19', 1),
(2181, 'Arambag', 312, '19', 1),
(2182, 'Pursura', 312, '19', 1),
(2183, 'Tarakeswar', 312, '19', 1),
(2184, 'Dhaniakhali', 312, '19', 1),
(2185, 'Pandua', 312, '19', 1),
(2186, 'Balagarh', 312, '19', 1),
(2187, 'Chinsurah - Magra', 312, '19', 1),
(2188, 'Polba - Dadpur', 312, '19', 1),
(2189, 'Haripal', 312, '19', 1),
(2190, 'Singur', 312, '19', 1),
(2191, 'Serampur Uttarpara', 312, '19', 1),
(2192, 'Chanditala - I', 312, '19', 1),
(2193, 'Chanditala - II', 312, '19', 1),
(2194, 'Jangipara', 312, '19', 1),
(2195, 'Khanakul - I', 312, '19', 1),
(2196, 'Khanakul - II', 312, '19', 1),
(2197, 'Saltora', 313, '19', 1),
(2198, 'Mejhia', 313, '19', 1),
(2199, 'Gangajalghati', 313, '19', 1),
(2200, 'Chhatna', 313, '19', 1),
(2201, 'Indpur', 313, '19', 1),
(2202, 'Bankura - I', 313, '19', 1),
(2203, 'Bankura - II', 313, '19', 1),
(2204, 'Barjora', 313, '19', 1),
(2205, 'Sonamukhi', 313, '19', 1),
(2206, 'Patrasayer', 313, '19', 1),
(2207, 'Indus', 313, '19', 1),
(2208, 'Kotulpur', 313, '19', 1),
(2209, 'Jaypur', 313, '19', 1),
(2210, 'Vishnupur', 313, '19', 1),
(2211, 'Onda', 313, '19', 1),
(2212, 'Taldangra', 313, '19', 1),
(2213, 'Simlapal', 313, '19', 1),
(2214, 'Khatra', 313, '19', 1),
(2215, 'Hirbandh', 313, '19', 1),
(2216, 'Ranibundh', 313, '19', 1),
(2217, 'Raipur', 313, '19', 1),
(2218, 'Sarenga', 313, '19', 1),
(2219, 'Jaipur', 314, '19', 1),
(2220, 'Purulia - II', 314, '19', 1),
(2221, 'Para', 314, '19', 1),
(2222, 'Raghunathpur - II', 314, '19', 1),
(2223, 'Raghunathpur - I', 314, '19', 1),
(2224, 'Neturia', 314, '19', 1),
(2225, 'Santuri', 314, '19', 1),
(2226, 'Kashipur', 314, '19', 1),
(2227, 'Hura', 314, '19', 1),
(2228, 'Purulia - I', 314, '19', 1),
(2229, 'Puncha', 314, '19', 1),
(2230, 'Arsha', 314, '19', 1),
(2231, 'Jhalda - I', 314, '19', 1),
(2232, 'Jhalda - II', 314, '19', 1),
(2233, 'Bagmundi', 314, '19', 1),
(2234, 'Balarampur', 314, '19', 1),
(2235, 'Barabazar', 314, '19', 1),
(2236, 'Manbazar - I', 314, '19', 1),
(2237, 'Manbazar - II', 314, '19', 1),
(2238, 'Bundwan', 314, '19', 1),
(2239, 'Binpur - II', 315, '19', 1),
(2240, 'Binpur - I', 315, '19', 1),
(2241, 'Garbeta - II', 315, '19', 1),
(2242, 'Garbeta - I', 315, '19', 1),
(2243, 'Garbeta - III', 315, '19', 1),
(2244, 'Chandrakona - I', 315, '19', 1),
(2245, 'Chandrakona - II', 315, '19', 1),
(2246, 'Ghatal', 315, '19', 1),
(2247, 'Daspur - I', 315, '19', 1),
(2248, 'Daspur - II', 315, '19', 1),
(2249, 'Keshpur', 315, '19', 1),
(2250, 'Salbani', 315, '19', 1),
(2251, 'Midnapore', 315, '19', 1),
(2252, 'Jhargram', 315, '19', 1),
(2253, 'Jamboni', 315, '19', 1),
(2254, 'Gopiballavpur - II', 315, '19', 1),
(2255, 'Gopiballavpur - I', 315, '19', 1),
(2256, 'Nayagram', 315, '19', 1),
(2257, 'Sankrail', 315, '19', 1),
(2258, 'Kharagpur - I', 315, '19', 1),
(2259, 'Kharagpur - II', 315, '19', 1),
(2260, 'Debra', 315, '19', 1),
(2261, 'Panskura - I', 315, '19', 1),
(2262, 'Panskura - II', 315, '19', 1),
(2263, 'Tamluk', 315, '19', 1),
(2264, 'Sahid Matangini', 315, '19', 1),
(2265, 'Nanda Kumar', 315, '19', 1),
(2266, 'Mahisadal', 315, '19', 1),
(2267, 'Moyna', 315, '19', 1),
(2268, 'Pingla', 315, '19', 1),
(2269, 'Sabang', 315, '19', 1),
(2270, 'Narayangarh', 315, '19', 1),
(2271, 'Keshiary', 315, '19', 1),
(2272, 'Dantan - I', 315, '19', 1),
(2273, 'Dantan - II', 315, '19', 1),
(2274, 'Potashpur - I', 315, '19', 1),
(2275, 'Potashpur - II', 315, '19', 1),
(2276, 'Bhagawanpur - II', 315, '19', 1),
(2277, 'Bhagawanpur - I', 315, '19', 1),
(2278, 'Nandigram - III', 315, '19', 1),
(2279, 'Sutahata - I', 315, '19', 1),
(2280, 'Sutahata - II', 315, '19', 1),
(2281, 'Nandigram - I', 315, '19', 1),
(2282, 'Nandigram - II', 315, '19', 1),
(2283, 'Khejuri - I', 315, '19', 1),
(2284, 'Khejuri - II', 315, '19', 1),
(2285, 'Contai - I', 315, '19', 1),
(2286, 'Contai - II', 315, '19', 1),
(2287, 'Contai - III', 315, '19', 1),
(2288, 'Egra - I', 315, '19', 1),
(2289, 'Egra - II', 315, '19', 1),
(2290, 'Mohanpur', 315, '19', 1),
(2291, 'Ramnagar - I', 315, '19', 1),
(2292, 'Ramnagar - II', 315, '19', 1),
(2293, 'Udaynarayanpur', 316, '19', 1),
(2294, 'Amta - II', 316, '19', 1),
(2295, 'Amta - I', 316, '19', 1),
(2296, 'Jagatballavpur', 316, '19', 1),
(2297, 'Domjur', 316, '19', 1),
(2298, 'Bally Jagachha', 316, '19', 1),
(2299, 'Sankrail', 316, '19', 1),
(2300, 'Panchla', 316, '19', 1),
(2301, 'Uluberia - II', 316, '19', 1),
(2302, 'Uluberia - I', 316, '19', 1),
(2303, 'Bagnan - I', 316, '19', 1),
(2304, 'Bagnan - II', 316, '19', 1),
(2305, 'Shyampur - I', 316, '19', 1),
(2306, 'Shyampur - II', 316, '19', 1),
(2307, 'Thakurpukur Mahestola', 318, '19', 1),
(2308, 'Budge Budge - I', 318, '19', 1),
(2309, 'Budge Budge - II', 318, '19', 1),
(2310, 'Bishnupur - I', 318, '19', 1),
(2311, 'Bishnupur - II', 318, '19', 1),
(2312, 'Sonarpur', 318, '19', 1),
(2313, 'Bhangar - I', 318, '19', 1),
(2314, 'Bhangar - II', 318, '19', 1),
(2315, 'Canning - I', 318, '19', 1),
(2316, 'Canning - II', 318, '19', 1),
(2317, 'Baruipur', 318, '19', 1),
(2318, 'Magrahat - II', 318, '19', 1),
(2319, 'Magrahat - I', 318, '19', 1),
(2320, 'Falta', 318, '19', 1),
(2321, 'Diamond Harbour - I', 318, '19', 1),
(2322, 'Diamond Harbour - II', 318, '19', 1),
(2323, 'Kulpi', 318, '19', 1),
(2324, 'Mandirbazar', 318, '19', 1),
(2325, 'Mathurapur - I', 318, '19', 1),
(2326, 'Jaynagar - I', 318, '19', 1),
(2327, 'Jaynagar - II', 318, '19', 1),
(2328, 'Kultali', 318, '19', 1),
(2329, 'Basanti', 318, '19', 1),
(2330, 'Gosaba', 318, '19', 1),
(2331, 'Mathurapur - II', 318, '19', 1),
(2332, 'Kakdwip', 318, '19', 1),
(2333, 'Sagar', 318, '19', 1),
(2334, 'Namkhana', 318, '19', 1),
(2335, 'Patharpratima', 318, '19', 1),
(2336, 'Kharaundhi', 319, '20', 1),
(2337, 'Bhawnathpur', 319, '20', 1),
(2338, 'Kandi', 319, '20', 1),
(2339, 'Majhiaon', 319, '20', 1),
(2340, 'Ramna', 319, '20', 1),
(2341, 'Nagaruntari', 319, '20', 1),
(2342, 'Dhurki', 319, '20', 1),
(2343, 'Dandai', 319, '20', 1),
(2344, 'Chinia', 319, '20', 1),
(2345, 'Meral (Pipra Kalan)', 319, '20', 1),
(2346, 'Garhwa', 319, '20', 1),
(2347, 'Ranka', 319, '20', 1),
(2348, 'Ramkanda', 319, '20', 1),
(2349, 'Bhandaria', 319, '20', 1),
(2350, 'Hussainabad', 320, '20', 1),
(2351, 'Hariharganj', 320, '20', 1),
(2352, 'Chhatarpur', 320, '20', 1),
(2353, 'Pandu', 320, '20', 1),
(2354, 'Bishrampur', 320, '20', 1),
(2355, 'Patan', 320, '20', 1),
(2356, 'Manatu', 320, '20', 1),
(2357, 'Panki', 320, '20', 1),
(2358, 'Manika', 320, '20', 1),
(2359, 'Satbarwa', 320, '20', 1),
(2360, 'Leslieganj', 320, '20', 1),
(2361, 'Daltonganj', 320, '20', 1),
(2362, 'Chainpur', 320, '20', 1),
(2363, 'Barwadih', 320, '20', 1),
(2364, 'Mahuadanr', 320, '20', 1),
(2365, 'Garu', 320, '20', 1),
(2366, 'Latehar', 320, '20', 1),
(2367, 'Balumath', 320, '20', 1),
(2368, 'Chandwa', 320, '20', 1),
(2369, 'Hunterganj', 321, '20', 1),
(2370, 'Pratappur', 321, '20', 1),
(2371, 'Kunda', 321, '20', 1),
(2372, 'Lawalaung', 321, '20', 1),
(2373, 'Chatra', 321, '20', 1),
(2374, 'Itkhori', 321, '20', 1),
(2375, 'Gidhaur', 321, '20', 1),
(2376, 'Pathalgora', 321, '20', 1),
(2377, 'Simaria', 321, '20', 1),
(2378, 'Tandwa', 321, '20', 1),
(2379, 'Chauparan', 322, '20', 1),
(2380, 'Barhi', 322, '20', 1),
(2381, 'Padma', 322, '20', 1),
(2382, 'Ichak', 322, '20', 1),
(2383, 'Barkatha', 322, '20', 1),
(2384, 'Bishungarh', 322, '20', 1),
(2385, 'Hazaribag', 322, '20', 1),
(2386, 'Katkamsandi', 322, '20', 1),
(2387, 'Keredari', 322, '20', 1),
(2388, 'Barkagaon', 322, '20', 1),
(2389, 'Patratu', 322, '20', 1),
(2390, 'Churchu', 322, '20', 1),
(2391, 'Mandu', 322, '20', 1),
(2392, 'Ramgarh', 322, '20', 1),
(2393, 'Gola', 322, '20', 1),
(2394, 'Satgawan', 323, '20', 1),
(2395, 'Kodarma', 323, '20', 1),
(2396, 'Jainagar', 323, '20', 1),
(2397, 'Markacho', 323, '20', 1),
(2398, 'Gawan', 324, '20', 1),
(2399, 'Tisri', 324, '20', 1),
(2400, 'Deori', 324, '20', 1),
(2401, 'Dhanwar', 324, '20', 1),
(2402, 'Jamua', 324, '20', 1),
(2403, 'Bengabad', 324, '20', 1),
(2404, 'Gande', 324, '20', 1),
(2405, 'Giridih', 324, '20', 1),
(2406, 'Birni', 324, '20', 1),
(2407, 'Bagodar', 324, '20', 1),
(2408, 'Dumri', 324, '20', 1),
(2409, 'Pirtanr', 324, '20', 1),
(2410, 'Deoghar', 325, '20', 1),
(2411, 'Mohanpur', 325, '20', 1),
(2412, 'Sarwan', 325, '20', 1),
(2413, 'Devipur', 325, '20', 1),
(2414, 'Madhupur', 325, '20', 1),
(2415, 'Karon', 325, '20', 1),
(2416, 'Sarath', 325, '20', 1),
(2417, 'Palojori', 325, '20', 1),
(2418, 'Meherma', 326, '20', 1),
(2419, 'Thakur Gangti', 326, '20', 1),
(2420, 'Boarijor', 326, '20', 1),
(2421, 'Mahagama', 326, '20', 1),
(2422, 'Pathargama', 326, '20', 1),
(2423, 'Godda', 326, '20', 1),
(2424, 'Poreyahat', 326, '20', 1),
(2425, 'Sundar Pahari', 326, '20', 1),
(2426, 'Sahibganj', 327, '20', 1),
(2427, 'Mandro', 327, '20', 1),
(2428, 'Borio', 327, '20', 1),
(2429, 'Barhait', 327, '20', 1),
(2430, 'Taljhari', 327, '20', 1),
(2431, 'Rajmahal', 327, '20', 1),
(2432, 'Udhwa', 327, '20', 1),
(2433, 'Pathna', 327, '20', 1),
(2434, 'Barharwa', 327, '20', 1),
(2435, 'Litipara', 328, '20', 1),
(2436, 'Amrapara', 328, '20', 1),
(2437, 'Hiranpur', 328, '20', 1),
(2438, 'Pakaur', 328, '20', 1),
(2439, 'Maheshpur', 328, '20', 1),
(2440, 'Pakuria', 328, '20', 1),
(2441, 'Saraiyahat', 329, '20', 1),
(2442, 'Jarmundi', 329, '20', 1),
(2443, 'Ramgarh', 329, '20', 1),
(2444, 'Gopikandar', 329, '20', 1),
(2445, 'Kathikund', 329, '20', 1),
(2446, 'Shikaripara', 329, '20', 1),
(2447, 'Ranishwar', 329, '20', 1),
(2448, 'Dumka', 329, '20', 1),
(2449, 'Jama', 329, '20', 1),
(2450, 'Masalia', 329, '20', 1),
(2451, 'Narayanpur', 329, '20', 1),
(2452, 'Jamtara', 329, '20', 1),
(2453, 'Nala', 329, '20', 1),
(2454, 'Kundhit', 329, '20', 1),
(2455, 'Tundi', 330, '20', 1),
(2456, 'Topchanchi', 330, '20', 1),
(2457, 'Baghmara-Cum-Katras', 330, '20', 1),
(2458, 'Gobindpur', 330, '20', 1),
(2459, 'Dhanbad-Cum-Ken-duadih-Cum-Jagta', 330, '20', 1),
(2460, 'Jharia-Cum-Jorap-okhar-Cum-Sindri', 330, '20', 1),
(2461, 'Baliapur', 330, '20', 1),
(2462, 'Nirsa-Cum-Chirkunda', 330, '20', 1),
(2463, 'Nawadih', 331, '20', 1),
(2464, 'Bermo', 331, '20', 1),
(2465, 'Gumia', 331, '20', 1),
(2466, 'Peterwar', 331, '20', 1),
(2467, 'Kasmar', 331, '20', 1),
(2468, 'Jaridih', 331, '20', 1),
(2469, 'Chas', 331, '20', 1),
(2470, 'Chandankiyari', 331, '20', 1),
(2471, 'Burmu', 332, '20', 1),
(2472, 'Kanke', 332, '20', 1),
(2473, 'Ormanjhi', 332, '20', 1),
(2474, 'Angara', 332, '20', 1),
(2475, 'Silli', 332, '20', 1),
(2476, 'Sonahatu', 332, '20', 1),
(2477, 'Namkum', 332, '20', 1),
(2478, 'Ratu', 332, '20', 1),
(2479, 'Mandar', 332, '20', 1),
(2480, 'Chanho', 332, '20', 1),
(2481, 'Bero', 332, '20', 1),
(2482, 'Lapung', 332, '20', 1),
(2483, 'Karra', 332, '20', 1),
(2484, 'Torpa', 332, '20', 1),
(2485, 'Rania', 332, '20', 1),
(2486, 'Murhu', 332, '20', 1),
(2487, 'Khunti', 332, '20', 1),
(2488, 'Bundu', 332, '20', 1),
(2489, 'Erki (Tamar II)', 332, '20', 1),
(2490, 'Tamar I', 332, '20', 1),
(2491, 'Kisko', 333, '20', 1),
(2492, 'Kuru', 333, '20', 1),
(2493, 'Lohardaga', 333, '20', 1),
(2494, 'Senha', 333, '20', 1),
(2495, 'Bhandra', 333, '20', 1),
(2496, 'Bishunpur', 334, '20', 1),
(2497, 'Ghaghra', 334, '20', 1),
(2498, 'Sisai', 334, '20', 1),
(2499, 'Verno', 334, '20', 1),
(2500, 'Kamdara', 334, '20', 1),
(2501, 'Basia', 334, '20', 1),
(2502, 'Gumla', 334, '20', 1),
(2503, 'Chainpur', 334, '20', 1),
(2504, 'Dumri', 334, '20', 1),
(2505, 'Raidih', 334, '20', 1),
(2506, 'Palkot', 334, '20', 1),
(2507, 'simdega', 334, '20', 1),
(2508, 'Kurdeg', 334, '20', 1),
(2509, 'Bolba', 334, '20', 1),
(2510, 'Thethaitangar', 334, '20', 1),
(2511, 'Kolebira', 334, '20', 1),
(2512, 'Jaldega', 334, '20', 1),
(2513, 'Bano', 334, '20', 1),
(2514, 'Sonua', 335, '20', 1),
(2515, 'Bandgaon', 335, '20', 1),
(2516, 'Chakradharpur', 335, '20', 1),
(2517, 'Kuchai', 335, '20', 1),
(2518, 'Kharsawan', 335, '20', 1),
(2519, 'Chandil', 335, '20', 1),
(2520, 'Ichagarh', 335, '20', 1),
(2521, 'Nimdih', 335, '20', 1),
(2522, 'Adityapur', 335, '20', 1),
(2523, 'Seraikela', 335, '20', 1),
(2524, 'Gobindpur', 335, '20', 1),
(2525, 'Khuntpani', 335, '20', 1),
(2526, 'Goilkera', 335, '20', 1),
(2527, 'Manoharpur', 335, '20', 1),
(2528, 'Noamundi', 335, '20', 1),
(2529, 'Tonto', 335, '20', 1),
(2530, 'Chaibasa', 335, '20', 1),
(2531, 'Tantnagar', 335, '20', 1),
(2532, 'Manjhari', 335, '20', 1),
(2533, 'Jhinkpani', 335, '20', 1),
(2534, 'Jagannathpur', 335, '20', 1),
(2535, 'Kumardungi', 335, '20', 1),
(2536, 'Majhgaon', 335, '20', 1),
(2537, 'Patamda', 336, '20', 1),
(2538, 'Golmuri-Cum-Jugsalai', 336, '20', 1),
(2539, 'Ghatshila', 336, '20', 1),
(2540, 'Potka', 336, '20', 1),
(2541, 'Musabani', 336, '20', 1),
(2542, 'Dumaria', 336, '20', 1),
(2543, 'Dhalbhumgarh', 336, '20', 1),
(2544, 'Chakulia', 336, '20', 1),
(2545, 'Baharagora', 336, '20', 1),
(2546, 'Paikamal', 337, '21', 1),
(2547, 'Jharabandha', 337, '21', 1),
(2548, 'Jharabandha', 337, '21', 1),
(2549, 'Padmapur', 337, '21', 1),
(2550, 'Burden', 337, '21', 1),
(2551, 'Gaisilet', 337, '21', 1),
(2552, 'Melchhamunda', 337, '21', 1),
(2553, 'Sohela', 337, '21', 1),
(2554, 'Bijepur', 337, '21', 1),
(2555, 'Barapali', 337, '21', 1),
(2556, 'Bheden', 337, '21', 1),
(2557, 'Bargarh', 337, '21', 1),
(2558, 'Bhatli', 337, '21', 1),
(2559, 'Ambabhona', 337, '21', 1),
(2560, 'Attabira', 337, '21', 1),
(2561, 'Rengali', 338, '21', 1),
(2562, 'Lakhanpur', 338, '21', 1),
(2563, 'Belpahar', 338, '21', 1),
(2564, 'Banaharapali', 338, '21', 1),
(2565, 'Orient', 338, '21', 1),
(2566, 'Brajarajnagar', 338, '21', 1),
(2567, 'Jharsuguda', 338, '21', 1),
(2568, 'Laikera', 338, '21', 1),
(2569, 'Kolabira', 338, '21', 1),
(2570, 'Govindpur', 339, '21', 1),
(2571, 'Mahulpalli', 339, '21', 1),
(2572, 'Kochinda', 339, '21', 1),
(2573, 'Jamankira', 339, '21', 1),
(2574, 'Kisinda', 339, '21', 1),
(2575, 'Naktideul', 339, '21', 1),
(2576, 'Rairakhol', 339, '21', 1),
(2577, 'Charamal', 339, '21', 1),
(2578, 'Jujomura', 339, '21', 1),
(2579, 'Dhama', 339, '21', 1),
(2580, 'Burla', 339, '21', 1),
(2581, 'Hirakud', 339, '21', 1),
(2582, 'Ainthapali', 339, '21', 1),
(2583, 'Dhanupali', 339, '21', 1),
(2584, 'Sadar', 339, '21', 1),
(2585, 'Sasan', 339, '21', 1),
(2586, 'Katarbaga', 339, '21', 1),
(2587, 'Debagarh', 340, '21', 1),
(2588, 'Barkot', 340, '21', 1),
(2589, 'Kundheigola', 340, '21', 1),
(2590, 'Reamal', 340, '21', 1),
(2591, 'Hemgir', 341, '21', 1),
(2592, 'Lephripara', 341, '21', 1),
(2593, 'Bhasma', 341, '21', 1),
(2594, 'Bhasma', 341, '21', 1),
(2595, 'Sundargarh Town', 341, '21', 1),
(2596, 'Sundargarh', 341, '21', 1),
(2597, 'Kinjirkela', 341, '21', 1),
(2598, 'Kinjirkela', 341, '21', 1),
(2599, 'Kinjirkela', 341, '21', 1),
(2600, 'Talasara', 341, '21', 1),
(2601, 'Talasara', 341, '21', 1),
(2602, 'Baragaon', 341, '21', 1),
(2603, 'Kutra', 341, '21', 1),
(2604, 'Rajagangapur', 341, '21', 1),
(2605, 'Rajagangapur', 341, '21', 1),
(2606, 'Raiboga', 341, '21', 1),
(2607, 'Biramitrapur', 341, '21', 1),
(2608, 'Biramitrapur', 341, '21', 1),
(2609, 'Hatibari', 341, '21', 1),
(2610, 'Bisra', 341, '21', 1),
(2611, 'Bisra', 341, '21', 1),
(2612, 'Bondamunda', 341, '21', 1),
(2613, 'Bondamunda', 341, '21', 1),
(2614, 'Brahmani Tarang', 341, '21', 1),
(2615, 'Raghunathapali', 341, '21', 1),
(2616, 'Tangarapali', 341, '21', 1),
(2617, 'Lathikata', 341, '21', 1),
(2618, 'Banki', 341, '21', 1),
(2619, 'Kamarposh Balang', 341, '21', 1),
(2620, 'Koida', 341, '21', 1),
(2621, 'Lahunipara', 341, '21', 1),
(2622, 'Gurundia', 341, '21', 1),
(2623, 'Tikaetpali', 341, '21', 1),
(2624, 'Banei', 341, '21', 1),
(2625, 'Mahulpada', 341, '21', 1),
(2626, 'Telkoi', 342, '21', 1),
(2627, 'Kanjipani', 342, '21', 1),
(2628, 'Nayakote', 342, '21', 1),
(2629, 'Barbil', 342, '21', 1),
(2630, 'Joda', 342, '21', 1),
(2631, 'Champua', 342, '21', 1),
(2632, 'Champua', 342, '21', 1),
(2633, 'Baria', 342, '21', 1),
(2634, 'Turumunga', 342, '21', 1),
(2635, 'Turumunga', 342, '21', 1),
(2636, 'Patana', 342, '21', 1),
(2637, 'Patana', 342, '21', 1),
(2638, 'Ghatgaon', 342, '21', 1),
(2639, 'Ghatgaon', 342, '21', 1),
(2640, 'Kendujhar Sadar', 342, '21', 1),
(2641, 'Kendujhar Town', 342, '21', 1),
(2642, 'Pandapara', 342, '21', 1),
(2643, 'Harichandanpur', 342, '21', 1),
(2644, 'Daitari', 342, '21', 1),
(2645, 'Ghasipura', 342, '21', 1),
(2646, 'Sainkul', 342, '21', 1),
(2647, 'Nandipada', 342, '21', 1),
(2648, 'Anandapur', 342, '21', 1),
(2649, 'Anandapur', 342, '21', 1),
(2650, 'Soso', 342, '21', 1),
(2651, 'Tiringi', 343, '21', 1),
(2652, 'Bahalda', 343, '21', 1),
(2653, 'Gorumahisani', 343, '21', 1),
(2654, 'Rairangpur', 343, '21', 1),
(2655, 'Rairangpur Town', 343, '21', 1),
(2656, 'Badampahar', 343, '21', 1),
(2657, 'Bisoi', 343, '21', 1),
(2658, 'Bangiriposi', 343, '21', 1),
(2659, 'Jharpokharia', 343, '21', 1),
(2660, 'Chandua', 343, '21', 1),
(2661, 'Koliana', 343, '21', 1),
(2662, 'Baripada Sadar', 343, '21', 1),
(2663, 'Baripada Town', 343, '21', 1),
(2664, 'Suliapada', 343, '21', 1),
(2665, 'Muruda', 343, '21', 1),
(2666, 'Muruda', 343, '21', 1),
(2667, 'Muruda', 343, '21', 1),
(2668, 'Betanati', 343, '21', 1),
(2669, 'Betanati', 343, '21', 1),
(2670, 'Rasagobindapur', 343, '21', 1),
(2671, 'Baisinga', 343, '21', 1),
(2672, 'Barsahi', 343, '21', 1),
(2673, 'Khunta', 343, '21', 1),
(2674, 'Udala', 343, '21', 1),
(2675, 'Kaptipada', 343, '21', 1),
(2676, 'Sharata', 343, '21', 1),
(2677, 'Mahuldiha', 343, '21', 1),
(2678, 'Thakurmunda', 343, '21', 1),
(2679, 'Karanjia', 343, '21', 1),
(2680, 'Jashipur', 343, '21', 1),
(2681, 'Jashipur', 343, '21', 1),
(2682, 'Raruan', 343, '21', 1),
(2683, 'Raruan', 343, '21', 1),
(2684, 'Raibania', 344, '21', 1),
(2685, 'Jaleswar', 344, '21', 1),
(2686, 'Bhograi', 344, '21', 1),
(2687, 'Baliapal', 344, '21', 1),
(2688, 'Singla', 344, '21', 1),
(2689, 'Singla', 344, '21', 1),
(2690, 'Basta', 344, '21', 1),
(2691, 'Rupsa', 344, '21', 1),
(2692, 'Baleshwar Sadar', 344, '21', 1),
(2693, 'Chandipur', 344, '21', 1),
(2694, 'Remuna', 344, '21', 1),
(2695, 'Bampada', 344, '21', 1),
(2696, 'Nilagiri', 344, '21', 1),
(2697, 'Berhampur', 344, '21', 1),
(2698, 'Oupada', 344, '21', 1),
(2699, 'Soro', 344, '21', 1),
(2700, 'Khaira', 344, '21', 1),
(2701, 'Similia', 344, '21', 1),
(2702, 'Agarpada', 345, '21', 1),
(2703, 'Bant', 345, '21', 1),
(2704, 'Bant', 345, '21', 1),
(2705, 'Bhadrak Rural', 345, '21', 1),
(2706, 'Bhadrak Rural', 345, '21', 1),
(2707, 'Bhandari Pokhari', 345, '21', 1),
(2708, 'Dhamanagar', 345, '21', 1),
(2709, 'Dhusuri', 345, '21', 1),
(2710, 'Dhusuri', 345, '21', 1),
(2711, 'Tihidi', 345, '21', 1),
(2712, 'Tihidi', 345, '21', 1),
(2713, 'Chandabali', 345, '21', 1),
(2714, 'Bansada', 345, '21', 1),
(2715, 'Naikanidihi', 345, '21', 1),
(2716, 'Basudebpur', 345, '21', 1),
(2717, 'Rajkanika', 346, '21', 1),
(2718, 'Aali', 346, '21', 1),
(2719, 'Pattamundai', 346, '21', 1),
(2720, 'Kendrapara', 346, '21', 1),
(2721, 'Patkura', 346, '21', 1),
(2722, 'Patkura', 346, '21', 1),
(2723, 'Mahakalapada', 346, '21', 1),
(2724, 'Rajnagar', 346, '21', 1),
(2725, 'Paradip', 347, '21', 1),
(2726, 'Kujang', 347, '21', 1),
(2727, 'Ersama', 347, '21', 1),
(2728, 'Tirtol', 347, '21', 1),
(2729, 'Balikuda', 347, '21', 1),
(2730, 'Naugaon', 347, '21', 1),
(2731, 'Jagatsinghapur', 347, '21', 1),
(2732, 'Mahanga', 348, '21', 1),
(2733, 'Salepur', 348, '21', 1),
(2734, 'Jagatpur', 348, '21', 1),
(2735, 'Kishannagar', 348, '21', 1),
(2736, 'Niali', 348, '21', 1),
(2737, 'Gobindpur', 348, '21', 1),
(2738, 'Cuttack Sadar', 348, '21', 1),
(2739, 'Tangi', 348, '21', 1),
(2740, 'Choudwar', 348, '21', 1),
(2741, 'Choudwar', 348, '21', 1),
(2742, 'Gurudijhatia', 348, '21', 1),
(2743, 'Barang', 348, '21', 1),
(2744, 'Athagad', 348, '21', 1),
(2745, 'Tigiria', 348, '21', 1),
(2746, 'Banki', 348, '21', 1),
(2747, 'Baidyeswar', 348, '21', 1),
(2748, 'Badamba', 348, '21', 1),
(2749, 'Kanpur', 348, '21', 1),
(2750, 'Narasinghpur', 348, '21', 1),
(2751, 'Sukinda', 349, '21', 1),
(2752, 'Duburi', 349, '21', 1),
(2753, 'Jajapur Road', 349, '21', 1),
(2754, 'Korai', 349, '21', 1),
(2755, 'Jajapur', 349, '21', 1),
(2756, 'Mangalpur', 349, '21', 1),
(2757, 'Binjharpur', 349, '21', 1),
(2758, 'Binjharpur', 349, '21', 1),
(2759, 'Balichandrapur', 349, '21', 1),
(2760, 'Balichandrapur', 349, '21', 1),
(2761, 'Badachana', 349, '21', 1),
(2762, 'Badachana', 349, '21', 1),
(2763, 'Dharmasala', 349, '21', 1),
(2764, 'Bhuban', 350, '21', 1),
(2765, 'Kamakshyanagar', 350, '21', 1),
(2766, 'Kamakshyanagar', 350, '21', 1),
(2767, 'Parajang', 350, '21', 1),
(2768, 'Parajang', 350, '21', 1),
(2769, 'Tumusingha', 350, '21', 1),
(2770, 'Motunga', 350, '21', 1),
(2771, 'Balimi', 350, '21', 1),
(2772, 'Hindol', 350, '21', 1),
(2773, 'Rasol', 350, '21', 1),
(2774, 'Dhenkanal Sadar', 350, '21', 1),
(2775, 'Gandia', 350, '21', 1),
(2776, 'Gandia', 350, '21', 1),
(2777, 'Gandia', 350, '21', 1),
(2778, 'Palalahada', 351, '21', 1),
(2779, 'Khamar', 351, '21', 1),
(2780, 'Rengali Damsite', 351, '21', 1),
(2781, 'Kaniha', 351, '21', 1),
(2782, 'NTPC', 351, '21', 1),
(2783, 'Samal Barrage', 351, '21', 1),
(2784, 'Talcher Sadar', 351, '21', 1),
(2785, 'Colliery', 351, '21', 1),
(2786, 'Bikrampur', 351, '21', 1),
(2787, 'NALCO', 351, '21', 1),
(2788, 'Banarpal', 351, '21', 1),
(2789, 'Anugul', 351, '21', 1),
(2790, 'Bantala', 351, '21', 1),
(2791, 'Purunakot', 351, '21', 1),
(2792, 'Jarapada', 351, '21', 1),
(2793, 'Jarapada', 351, '21', 1),
(2794, 'Chhendipada', 351, '21', 1),
(2795, 'Handapa', 351, '21', 1),
(2796, 'Kishorenagar', 351, '21', 1),
(2797, 'Thakurgarh', 351, '21', 1),
(2798, 'Athmallik', 351, '21', 1),
(2799, 'Dasapalla', 352, '21', 1),
(2800, 'Gania', 352, '21', 1),
(2801, 'Khandapada', 352, '21', 1),
(2802, 'Fategarh', 352, '21', 1),
(2803, 'Nayagarh', 352, '21', 1),
(2804, 'Nuagaon', 352, '21', 1),
(2805, 'Odagaon', 352, '21', 1),
(2806, 'Sarankul', 352, '21', 1),
(2807, 'Ranapur', 352, '21', 1),
(2808, 'Bolagad', 353, '21', 1),
(2809, 'Begunia', 353, '21', 1),
(2810, 'Begunia', 353, '21', 1),
(2811, 'Khordha', 353, '21', 1),
(2812, 'Khordha', 353, '21', 1),
(2813, 'Chandaka', 353, '21', 1),
(2814, 'Chandaka', 353, '21', 1),
(2815, 'Khandagiri', 353, '21', 1),
(2816, 'Saheednagar', 353, '21', 1),
(2817, 'Balianta', 353, '21', 1),
(2818, 'Balipatana', 353, '21', 1),
(2819, 'Lingaraj', 353, '21', 1),
(2820, 'Lingaraj', 353, '21', 1),
(2821, 'Jatani', 353, '21', 1),
(2822, 'Jankia', 353, '21', 1),
(2823, 'Jankia', 353, '21', 1),
(2824, 'Jankia', 353, '21', 1),
(2825, 'Tangi', 353, '21', 1),
(2826, 'Tangi', 353, '21', 1),
(2827, 'Balugaon', 353, '21', 1),
(2828, 'Banapur', 353, '21', 1),
(2829, 'Delanga', 354, '21', 1),
(2830, 'Pipili', 354, '21', 1),
(2831, 'Nimapada', 354, '21', 1),
(2832, 'Nimapada', 354, '21', 1),
(2833, 'Gop', 354, '21', 1),
(2834, 'Gop', 354, '21', 1),
(2835, 'Kakatpur', 354, '21', 1),
(2836, 'Konark', 354, '21', 1),
(2837, 'Konark', 354, '21', 1),
(2838, 'Satyabadi', 354, '21', 1),
(2839, 'Satyabadi', 354, '21', 1),
(2840, 'Chandanpur', 354, '21', 1),
(2841, 'Sadar', 354, '21', 1),
(2842, 'Sadar', 354, '21', 1),
(2843, 'Brahmagiri', 354, '21', 1),
(2844, 'Brahmagiri', 354, '21', 1),
(2845, 'Krushna Prasad', 354, '21', 1),
(2846, 'Tarasingi', 355, '21', 1),
(2847, 'Buguda', 355, '21', 1),
(2848, 'Bhanjanagar', 355, '21', 1),
(2849, 'Bhanjanagar', 355, '21', 1),
(2850, 'Gangapur', 355, '21', 1),
(2851, 'Gangapur', 355, '21', 1),
(2852, 'Gangapur', 355, '21', 1),
(2853, 'Gangapur', 355, '21', 1),
(2854, 'Surada', 355, '21', 1),
(2855, 'Badagada', 355, '21', 1),
(2856, 'Badagada', 355, '21', 1),
(2857, 'Asika', 355, '21', 1),
(2858, 'Purusottampur', 355, '21', 1),
(2859, 'Purusottampur', 355, '21', 1),
(2860, 'Purusottampur', 355, '21', 1),
(2861, 'Kabisuryanagar', 355, '21', 1),
(2862, 'Kabisuryanagar', 355, '21', 1),
(2863, 'Kodala', 355, '21', 1),
(2864, 'Kodala', 355, '21', 1),
(2865, 'Khalikote', 355, '21', 1),
(2866, 'Khalikote', 355, '21', 1),
(2867, 'Rambha', 355, '21', 1),
(2868, 'Rambha', 355, '21', 1),
(2869, 'Rambha', 355, '21', 1),
(2870, 'Chhatrapur', 355, '21', 1),
(2871, 'Chhatrapur', 355, '21', 1),
(2872, 'Gopalpur', 355, '21', 1),
(2873, 'Gopalpur', 355, '21', 1),
(2874, 'Brahmapur Sadar', 355, '21', 1),
(2875, 'Brahmapur Sadar', 355, '21', 1),
(2876, 'Brahmapur Sadar', 355, '21', 1),
(2877, 'Golanthara', 355, '21', 1),
(2878, 'Golanthara', 355, '21', 1),
(2879, 'Nuagaon', 355, '21', 1),
(2880, 'Nuagaon', 355, '21', 1),
(2881, 'Nuagaon', 355, '21', 1),
(2882, 'Digapahandi', 355, '21', 1),
(2883, 'Digapahandi', 355, '21', 1),
(2884, 'Digapahandi', 355, '21', 1),
(2885, 'Jarada', 355, '21', 1),
(2886, 'Patapur', 355, '21', 1),
(2887, 'Patapur', 355, '21', 1),
(2888, 'Patapur', 355, '21', 1),
(2889, 'Hinjili', 355, '21', 1),
(2890, 'Hinjili', 355, '21', 1),
(2891, 'Hinjili', 355, '21', 1),
(2892, 'Hinjili', 355, '21', 1),
(2893, 'Hinjili', 355, '21', 1),
(2894, 'Ramagiri', 355, '21', 1),
(2895, 'Ramagiri', 356, '21', 1),
(2896, 'Ramagiri', 356, '21', 1),
(2897, 'Adva', 356, '21', 1),
(2898, 'Mohana', 356, '21', 1),
(2899, 'R.Udaygiri', 356, '21', 1),
(2900, 'Garabandha', 356, '21', 1),
(2901, 'Parlakhemundi', 356, '21', 1),
(2902, 'Kashinagara', 356, '21', 1),
(2903, 'Serango', 356, '21', 1),
(2904, 'Serango', 356, '21', 1),
(2905, 'Rayagada', 356, '21', 1),
(2906, 'Gochhapada', 357, '21', 1),
(2907, 'Phulabani', 357, '21', 1),
(2908, 'Phulabani Town', 357, '21', 1),
(2909, 'Khajuripada', 357, '21', 1),
(2910, 'G.Udayagiri', 357, '21', 1),
(2911, 'Tikabali', 357, '21', 1),
(2912, 'Sarangagarh', 357, '21', 1),
(2913, 'Sarangagarh', 357, '21', 1),
(2914, 'Phiringia', 357, '21', 1),
(2915, 'Baliguda', 357, '21', 1),
(2916, 'Tumudibandha', 357, '21', 1),
(2917, 'Belaghar', 357, '21', 1),
(2918, 'Kotagarh', 357, '21', 1),
(2919, 'Brahmanigaon', 357, '21', 1),
(2920, 'Daringbadi', 357, '21', 1),
(2921, 'Raikia', 357, '21', 1),
(2922, 'Kantamal', 358, '21', 1),
(2923, 'Manamunda', 358, '21', 1),
(2924, 'Manamunda', 358, '21', 1),
(2925, 'Baunsuni', 358, '21', 1),
(2926, 'Baudh Sadar', 358, '21', 1),
(2927, 'Puruna Katak', 358, '21', 1),
(2928, 'Harbhanga', 358, '21', 1),
(2929, 'Dunguripali', 359, '21', 1),
(2930, 'Dunguripali', 359, '21', 1),
(2931, 'Dunguripali', 359, '21', 1),
(2932, 'Tarbha', 359, '21', 1),
(2933, 'Sonapur', 359, '21', 1),
(2934, 'Biramaharajpur', 359, '21', 1),
(2935, 'Ulunda', 359, '21', 1),
(2936, 'Binika', 359, '21', 1),
(2937, 'Binika', 359, '21', 1),
(2938, 'Rampur', 359, '21', 1),
(2939, 'Rampur', 359, '21', 1),
(2940, 'Khaprakhol', 360, '21', 1),
(2941, 'Turekela', 360, '21', 1),
(2942, 'Belpara', 360, '21', 1),
(2943, 'Kantabanji', 360, '21', 1),
(2944, 'Bangomunda', 360, '21', 1),
(2945, 'Sindhekela', 360, '21', 1),
(2946, 'Sindhekela', 360, '21', 1),
(2947, 'Titlagarh', 360, '21', 1),
(2948, 'Saintala', 360, '21', 1),
(2949, 'Tushura', 360, '21', 1),
(2950, 'Patnagarh', 360, '21', 1),
(2951, 'Balangir', 360, '21', 1),
(2952, 'Balangir', 360, '21', 1),
(2953, 'Loisinga', 360, '21', 1),
(2954, 'Loisinga', 360, '21', 1),
(2955, 'Jonk', 361, '21', 1),
(2956, 'Nuapada', 361, '21', 1),
(2957, 'Komana', 361, '21', 1),
(2958, 'Khariar', 361, '21', 1),
(2959, 'Boden', 361, '21', 1),
(2960, 'Sinapali', 361, '21', 1),
(2961, 'Kokasara', 362, '21', 1),
(2962, 'Kokasara', 362, '21', 1),
(2963, 'Dharamgarh', 362, '21', 1),
(2964, 'Kegaon', 362, '21', 1),
(2965, 'Kegaon', 362, '21', 1),
(2966, 'Sadar', 362, '21', 1),
(2967, 'Sadar', 362, '21', 1),
(2968, 'Kesinga', 362, '21', 1),
(2969, 'Kesinga', 362, '21', 1),
(2970, 'Narala', 362, '21', 1),
(2971, 'Narala', 362, '21', 1),
(2972, 'Madanpur Rampur', 362, '21', 1),
(2973, 'Lanjigarh', 362, '21', 1),
(2974, 'Lanjigarh', 362, '21', 1),
(2975, 'Thuamul Rampur', 362, '21', 1),
(2976, 'Junagarh', 362, '21', 1),
(2977, 'Junagarh', 362, '21', 1),
(2978, 'Jayapatna', 362, '21', 1),
(2979, 'Ambadala', 363, '21', 1),
(2980, 'Muniguda', 363, '21', 1),
(2981, 'Muniguda', 363, '21', 1),
(2982, 'Bishamakatak', 363, '21', 1),
(2983, 'Gudari', 363, '21', 1),
(2984, 'Padmapur', 363, '21', 1),
(2985, 'Puttasing', 363, '21', 1),
(2986, 'Gunupur', 363, '21', 1),
(2987, 'Rayagada', 363, '21', 1),
(2988, 'Kalyanasingpur', 363, '21', 1),
(2989, 'Kashipur', 363, '21', 1),
(2990, 'Tikiri', 363, '21', 1),
(2991, 'Raighar', 364, '21', 1),
(2992, 'Umarkote', 364, '21', 1),
(2993, 'Chandahandi', 364, '21', 1),
(2994, 'Jharigan', 364, '21', 1),
(2995, 'Jharigan', 364, '21', 1),
(2996, 'Dabugan', 364, '21', 1),
(2997, 'Dabugan', 364, '21', 1),
(2998, 'Paparahandi', 364, '21', 1),
(2999, 'Tentulikhunti', 364, '21', 1),
(3000, 'Khatiguda', 364, '21', 1),
(3001, 'Nabarangapur', 364, '21', 1),
(3002, 'Kodinga', 364, '21', 1),
(3003, 'Kotpad', 365, '21', 1),
(3004, 'Boriguma', 365, '21', 1),
(3005, 'Bhairabsingipur', 365, '21', 1),
(3006, 'Dasamantapur', 365, '21', 1),
(3007, 'Lakshmipur', 365, '21', 1),
(3008, 'Narayanpatana', 365, '21', 1),
(3009, 'Kakiriguma', 365, '21', 1),
(3010, 'Koraput', 365, '21', 1),
(3011, 'Koraput Town', 365, '21', 1),
(3012, 'Nandapur', 365, '21', 1),
(3013, 'Nandapur', 365, '21', 1),
(3014, 'Similiguda', 365, '21', 1),
(3015, 'Damanjodi', 365, '21', 1),
(3016, 'Pottangi', 365, '21', 1),
(3017, 'Padua', 365, '21', 1),
(3018, 'Sunabeda', 365, '21', 1),
(3019, 'Machh kund', 365, '21', 1),
(3020, 'Boipariguda', 365, '21', 1),
(3021, 'Jeypur', 365, '21', 1),
(3022, 'Kundura', 365, '21', 1),
(3023, 'Malkangiri', 366, '21', 1),
(3024, 'Mathili', 366, '21', 1),
(3025, 'Mudulipada', 366, '21', 1),
(3026, 'Chitrakonda', 366, '21', 1),
(3027, 'Orkel', 366, '21', 1),
(3028, 'Kalimela', 366, '21', 1),
(3029, 'M.V. 79', 366, '21', 1),
(3030, 'Motu', 366, '21', 1),
(3031, 'Bharatpur', 367, '22', 1),
(3032, 'Baikunthpur', 367, '22', 1),
(3033, 'Sonhat', 367, '22', 1),
(3034, 'Manendragarh', 367, '22', 1),
(3035, 'Pal', 368, '22', 1),
(3036, 'Wadrafnagar', 368, '22', 1),
(3037, 'Pratappur', 368, '22', 1),
(3038, 'Samari', 368, '22', 1),
(3039, 'Surajpur', 368, '22', 1),
(3040, 'Ambikapur', 368, '22', 1),
(3041, 'Rajpur', 368, '22', 1),
(3042, 'Lundra', 368, '22', 1),
(3043, 'Sitapur', 368, '22', 1),
(3044, 'Bagicha', 369, '22', 1),
(3045, 'Jashpur', 369, '22', 1),
(3046, 'Kunkuri', 369, '22', 1),
(3047, 'Pathalgaon', 369, '22', 1),
(3048, 'Udaipur (Dharamjaigarh)', 370, '22', 1),
(3049, 'Lailunga', 370, '22', 1),
(3050, 'Gharghoda', 370, '22', 1),
(3051, 'Raigarh', 370, '22', 1),
(3052, 'Kharsia', 370, '22', 1),
(3053, 'Sarangarh', 370, '22', 1),
(3054, 'Katghora', 371, '22', 1),
(3055, 'Pali', 371, '22', 1),
(3056, 'Korba', 371, '22', 1),
(3057, 'Kartala', 371, '22', 1),
(3058, 'Janjgir', 372, '22', 1),
(3059, 'Nawagarh', 372, '22', 1),
(3060, 'Champa', 372, '22', 1),
(3061, 'Sakti', 372, '22', 1),
(3062, 'Pamgarh', 372, '22', 1),
(3063, 'Dabhara', 372, '22', 1),
(3064, 'Malkharoda', 372, '22', 1),
(3065, 'Jaijaipur', 372, '22', 1),
(3066, 'Pendraroad', 373, '22', 1),
(3067, 'Lormi', 373, '22', 1),
(3068, 'Kota', 373, '22', 1),
(3069, 'Mungeli', 373, '22', 1),
(3070, 'Takhatpur', 373, '22', 1),
(3071, 'Bilaspur', 373, '22', 1),
(3072, 'Masturi', 373, '22', 1),
(3073, 'Bilha', 373, '22', 1),
(3074, 'Kawardha', 374, '22', 1),
(3075, 'Pandariya', 374, '22', 1),
(3076, 'Chhuikhadan', 375, '22', 1),
(3077, 'Khairagarh', 375, '22', 1),
(3078, 'Dongargarh', 375, '22', 1),
(3079, 'Rajnandgaon', 375, '22', 1),
(3080, 'Dongargaon', 375, '22', 1),
(3081, 'Mohla', 375, '22', 1),
(3082, 'Manpur', 375, '22', 1),
(3083, 'Ambagarh', 375, '22', 1),
(3084, 'Nawagarh', 376, '22', 1),
(3085, 'Bemetra', 376, '22', 1),
(3086, 'Saja', 376, '22', 1),
(3087, 'Berla', 376, '22', 1),
(3088, 'Dhamdha', 376, '22', 1),
(3089, 'Durg', 376, '22', 1),
(3090, 'Patan', 376, '22', 1),
(3091, 'Gunderdehi', 376, '22', 1),
(3092, 'Dondiluhara', 376, '22', 1),
(3093, 'Sanjari Balod', 376, '22', 1),
(3094, 'Gurur', 376, '22', 1),
(3095, 'Simga', 377, '22', 1),
(3096, 'Bhatapara', 377, '22', 1),
(3097, 'Baloda Bazar', 377, '22', 1),
(3098, 'Palari', 377, '22', 1),
(3099, 'Kasdol', 377, '22', 1),
(3100, 'Bilaigarh', 377, '22', 1),
(3101, 'Arang', 377, '22', 1),
(3102, 'Abhanpur', 377, '22', 1),
(3103, 'Raipur', 377, '22', 1),
(3104, 'Rajim', 377, '22', 1),
(3105, 'Tilda', 377, '22', 1),
(3106, 'Bindranawagarh', 377, '22', 1),
(3107, 'Deobhog', 377, '22', 1),
(3108, 'Basna', 378, '22', 1),
(3109, 'Saraipali', 378, '22', 1),
(3110, 'Mahasamund', 378, '22', 1);
INSERT INTO `tbl_city` (`city_id`, `city_name`, `district_id`, `state_id`, `country_id`) VALUES
(3111, 'Kurud', 379, '22', 1),
(3112, 'Dhamtari', 379, '22', 1),
(3113, 'Nagri', 379, '22', 1),
(3114, 'Charama', 380, '22', 1),
(3115, 'Bhanupratappur', 380, '22', 1),
(3116, 'Kanker', 380, '22', 1),
(3117, 'Narharpur', 380, '22', 1),
(3118, 'Antagarh', 380, '22', 1),
(3119, 'Pakhanjur', 380, '22', 1),
(3120, 'Keshkal', 381, '22', 1),
(3121, 'Narayanpur', 381, '22', 1),
(3122, 'Kondagaon', 381, '22', 1),
(3123, 'Jagdalpur', 381, '22', 1),
(3124, 'Bhopalpattanam (Matdand)', 382, '22', 1),
(3125, 'Bijapur', 382, '22', 1),
(3126, 'Dantewada', 382, '22', 1),
(3127, 'Konta', 382, '22', 1),
(3128, 'Vijaypur', 383, '23', 1),
(3129, 'Sheopur', 383, '23', 1),
(3130, 'Karahal', 383, '23', 1),
(3131, 'Ambah', 384, '23', 1),
(3132, 'Porsa', 384, '23', 1),
(3133, 'Morena', 384, '23', 1),
(3134, 'Joura', 384, '23', 1),
(3135, 'Kailaras', 384, '23', 1),
(3136, 'Sabalgarh', 384, '23', 1),
(3137, 'Ater', 385, '23', 1),
(3138, 'Bhind', 385, '23', 1),
(3139, 'Mehgaon', 385, '23', 1),
(3140, 'Gohad', 385, '23', 1),
(3141, 'Ron', 385, '23', 1),
(3142, 'Mihona', 385, '23', 1),
(3143, 'Lahar', 385, '23', 1),
(3144, 'Gird', 386, '23', 1),
(3145, 'Pichhore', 386, '23', 1),
(3146, 'Bhitarwar', 386, '23', 1),
(3147, 'Seondha', 387, '23', 1),
(3148, 'Datia', 387, '23', 1),
(3149, 'Bhander', 387, '23', 1),
(3150, 'Pohari', 388, '23', 1),
(3151, 'Shivpuri', 388, '23', 1),
(3152, 'Narwar', 388, '23', 1),
(3153, 'Karera', 388, '23', 1),
(3154, 'Kolaras', 388, '23', 1),
(3155, 'Pichhore', 388, '23', 1),
(3156, 'Khaniyadhana', 388, '23', 1),
(3157, 'Isagarh', 389, '23', 1),
(3158, 'Chanderi', 389, '23', 1),
(3159, 'Guna', 389, '23', 1),
(3160, 'Ashoknagar', 389, '23', 1),
(3161, 'Raghogarh', 389, '23', 1),
(3162, 'Mungaoli', 389, '23', 1),
(3163, 'Kumbhraj', 389, '23', 1),
(3164, 'Aron', 389, '23', 1),
(3165, 'Chachaura', 389, '23', 1),
(3166, 'Niwari', 390, '23', 1),
(3167, 'Prithvipur', 390, '23', 1),
(3168, 'Jatara', 390, '23', 1),
(3169, 'Palera', 390, '23', 1),
(3170, 'Baldeogarh', 390, '23', 1),
(3171, 'Tikamgarh', 390, '23', 1),
(3172, 'Gaurihar', 391, '23', 1),
(3173, 'Laundi', 391, '23', 1),
(3174, 'Nowgaon', 391, '23', 1),
(3175, 'Chhatarpur', 391, '23', 1),
(3176, 'Rajnagar', 391, '23', 1),
(3177, 'Bada-Malhera', 391, '23', 1),
(3178, 'Bijawar', 391, '23', 1),
(3179, 'Ajaigarh', 392, '23', 1),
(3180, 'Panna', 392, '23', 1),
(3181, 'Gunnor', 392, '23', 1),
(3182, 'Pawai', 392, '23', 1),
(3183, 'Shahnagar', 392, '23', 1),
(3184, 'Bina', 393, '23', 1),
(3185, 'Khurai', 393, '23', 1),
(3186, 'Banda', 393, '23', 1),
(3187, 'Rahatgarh', 393, '23', 1),
(3188, 'Sagar', 393, '23', 1),
(3189, 'Garhakota', 393, '23', 1),
(3190, 'Rehli', 393, '23', 1),
(3191, 'Kesli', 393, '23', 1),
(3192, 'Deori', 393, '23', 1),
(3193, 'Hatta', 394, '23', 1),
(3194, 'Patera', 394, '23', 1),
(3195, 'Batiyagarh', 394, '23', 1),
(3196, 'Patharia', 394, '23', 1),
(3197, 'Damoh', 394, '23', 1),
(3198, 'Jabera', 394, '23', 1),
(3199, 'Tendukheda', 394, '23', 1),
(3200, 'Raghurajnagar', 395, '23', 1),
(3201, 'Nagod', 395, '23', 1),
(3202, 'Unchehara', 395, '23', 1),
(3203, 'Rampur-Baghelan', 395, '23', 1),
(3204, 'Amarpatan', 395, '23', 1),
(3205, 'Ramnagar', 395, '23', 1),
(3206, 'Maihar', 395, '23', 1),
(3207, 'Teonthar', 396, '23', 1),
(3208, 'Sirmour', 396, '23', 1),
(3209, 'Hanumana', 396, '23', 1),
(3210, 'Mauganj', 396, '23', 1),
(3211, 'Huzur', 396, '23', 1),
(3212, 'Raipur - Karchuliyan', 396, '23', 1),
(3213, 'Gurh', 396, '23', 1),
(3214, 'Bandhogarh', 397, '23', 1),
(3215, 'Beohari', 398, '23', 1),
(3216, 'Jaisinghnagar', 398, '23', 1),
(3217, 'Sohagpur', 398, '23', 1),
(3218, 'Jaitpur', 398, '23', 1),
(3219, 'Kotma', 398, '23', 1),
(3220, 'Anuppur', 398, '23', 1),
(3221, 'Jaithari', 398, '23', 1),
(3222, 'Pushprajgarh', 398, '23', 1),
(3223, 'Rampur Naikin', 399, '23', 1),
(3224, 'Churhat', 399, '23', 1),
(3225, 'Gopadbanas', 399, '23', 1),
(3226, 'Sihawal', 399, '23', 1),
(3227, 'Chitrangi', 399, '23', 1),
(3228, 'Deosar', 399, '23', 1),
(3229, 'Majhauli', 399, '23', 1),
(3230, 'Kusmi', 399, '23', 1),
(3231, 'Singrauli', 399, '23', 1),
(3232, 'Jawad', 400, '23', 1),
(3233, 'Neemuch', 400, '23', 1),
(3234, 'Manasa', 400, '23', 1),
(3235, 'Bhanpura', 401, '23', 1),
(3236, 'Malhargarh', 401, '23', 1),
(3237, 'Garoth', 401, '23', 1),
(3238, 'Mandsaur', 401, '23', 1),
(3239, 'Sitamau', 401, '23', 1),
(3240, 'Piploda', 402, '23', 1),
(3241, 'Jaora', 402, '23', 1),
(3242, 'Alot', 402, '23', 1),
(3243, 'Sailana', 402, '23', 1),
(3244, 'Bajna', 402, '23', 1),
(3245, 'Ratlam', 402, '23', 1),
(3246, 'Khacharod', 403, '23', 1),
(3247, 'Nagda', 403, '23', 1),
(3248, 'Mahidpur', 403, '23', 1),
(3249, 'Ghatiya', 403, '23', 1),
(3250, 'Tarana', 403, '23', 1),
(3251, 'Ujjain', 403, '23', 1),
(3252, 'Badnagar', 403, '23', 1),
(3253, 'Susner', 404, '23', 1),
(3254, 'Nalkheda', 404, '23', 1),
(3255, 'Badod', 404, '23', 1),
(3256, 'Agar', 404, '23', 1),
(3257, 'Shajapur', 404, '23', 1),
(3258, 'Moman Badodiya', 404, '23', 1),
(3259, 'Shujalpur', 404, '23', 1),
(3260, 'Kalapipal', 404, '23', 1),
(3261, 'Tonk Khurd', 405, '23', 1),
(3262, 'Sonkatch', 405, '23', 1),
(3263, 'Dewas', 405, '23', 1),
(3264, 'Kannod', 405, '23', 1),
(3265, 'Bagli', 405, '23', 1),
(3266, 'Khategaon', 405, '23', 1),
(3267, 'Thandla', 406, '23', 1),
(3268, 'Petlawad', 406, '23', 1),
(3269, 'Meghnagar', 406, '23', 1),
(3270, 'Jhabua', 406, '23', 1),
(3271, 'Bhavra', 406, '23', 1),
(3272, 'Jobat', 406, '23', 1),
(3273, 'Alirajpur', 406, '23', 1),
(3274, 'Ranapur', 406, '23', 1),
(3275, 'Badnawar', 407, '23', 1),
(3276, 'Sardarpur', 407, '23', 1),
(3277, 'Dhar', 407, '23', 1),
(3278, 'Gandhwani', 407, '23', 1),
(3279, 'Kukshi', 407, '23', 1),
(3280, 'Manawar', 407, '23', 1),
(3281, 'Dharampuri', 407, '23', 1),
(3282, 'Depalpur', 408, '23', 1),
(3283, 'Sawer', 408, '23', 1),
(3284, 'Indore', 408, '23', 1),
(3285, 'Mhow', 408, '23', 1),
(3286, 'Barwaha', 409, '23', 1),
(3287, 'Maheshwar', 409, '23', 1),
(3288, 'Kasrawad', 409, '23', 1),
(3289, 'Segaon', 409, '23', 1),
(3290, 'Bhikangaon', 409, '23', 1),
(3291, 'Khargone', 409, '23', 1),
(3292, 'Bhagwanpura', 409, '23', 1),
(3293, 'Jhiranya', 409, '23', 1),
(3294, 'Barwani', 410, '23', 1),
(3295, 'Thikri', 410, '23', 1),
(3296, 'Rajpur', 410, '23', 1),
(3297, 'Pansemal', 410, '23', 1),
(3298, 'Niwali', 410, '23', 1),
(3299, 'Sendhwa', 410, '23', 1),
(3300, 'Harsud', 411, '23', 1),
(3301, 'Khandwa', 411, '23', 1),
(3302, 'Pandhana', 411, '23', 1),
(3303, 'Burhanpur', 411, '23', 1),
(3304, 'Nepanagar', 411, '23', 1),
(3305, 'Jirapur', 412, '23', 1),
(3306, 'Khilchipur', 412, '23', 1),
(3307, 'Rajgarh', 412, '23', 1),
(3308, 'Biaora', 412, '23', 1),
(3309, 'Sarangpur', 412, '23', 1),
(3310, 'Narsinghgarh', 412, '23', 1),
(3311, 'Lateri', 413, '23', 1),
(3312, 'Sironj', 413, '23', 1),
(3313, 'Kurwai', 413, '23', 1),
(3314, 'Basoda', 413, '23', 1),
(3315, 'Nateran', 413, '23', 1),
(3316, 'Gyaraspur', 413, '23', 1),
(3317, 'Vidisha', 413, '23', 1),
(3318, 'Berasia', 414, '23', 1),
(3319, 'Huzur', 414, '23', 1),
(3320, 'Sehore', 415, '23', 1),
(3321, 'Ashta', 415, '23', 1),
(3322, 'Ichhawar', 415, '23', 1),
(3323, 'Nasrullaganj', 415, '23', 1),
(3324, 'Budni', 415, '23', 1),
(3325, 'Raisen', 416, '23', 1),
(3326, 'Gairatganj', 416, '23', 1),
(3327, 'Begamganj', 416, '23', 1),
(3328, 'Goharganj', 416, '23', 1),
(3329, 'Baraily', 416, '23', 1),
(3330, 'Silwani', 416, '23', 1),
(3331, 'Udaipura', 416, '23', 1),
(3332, 'Bhainsdehi', 417, '23', 1),
(3333, 'Betul', 417, '23', 1),
(3334, 'Shahpur', 417, '23', 1),
(3335, 'Multai', 417, '23', 1),
(3336, 'Amla', 417, '23', 1),
(3337, 'Khirkiya', 418, '23', 1),
(3338, 'Harda', 418, '23', 1),
(3339, 'Timarni', 418, '23', 1),
(3340, 'Seoni-Malwa', 419, '23', 1),
(3341, 'Itarsi', 419, '23', 1),
(3342, 'Hoshangabad', 419, '23', 1),
(3343, 'Babai', 419, '23', 1),
(3344, 'Sohagpur', 419, '23', 1),
(3345, 'Pipariya', 419, '23', 1),
(3346, 'Bankhedi', 419, '23', 1),
(3347, 'Murwara', 420, '23', 1),
(3348, 'Vijayraghavgarh', 420, '23', 1),
(3349, 'Bahoriband', 420, '23', 1),
(3350, 'Dhimar Kheda', 420, '23', 1),
(3351, 'Sihora', 421, '23', 1),
(3352, 'Patan', 421, '23', 1),
(3353, 'Jabalpur', 421, '23', 1),
(3354, 'Kundam', 421, '23', 1),
(3355, 'Gotegaon', 422, '23', 1),
(3356, 'Gadarwara', 422, '23', 1),
(3357, 'Narsimhapur', 422, '23', 1),
(3358, 'Kareli', 422, '23', 1),
(3359, 'Tendukheda', 422, '23', 1),
(3360, 'Shahpura', 423, '23', 1),
(3361, 'Dindori', 423, '23', 1),
(3362, 'Niwas', 424, '23', 1),
(3363, 'Mandla', 424, '23', 1),
(3364, 'Bichhiya', 424, '23', 1),
(3365, 'Nainpur', 424, '23', 1),
(3366, 'Tamia', 425, '23', 1),
(3367, 'Amarwara', 425, '23', 1),
(3368, 'Chaurai', 425, '23', 1),
(3369, 'Jamai', 425, '23', 1),
(3370, 'Parasia', 425, '23', 1),
(3371, 'Chhindwara', 425, '23', 1),
(3372, 'Sausar', 425, '23', 1),
(3373, 'Bichhua', 425, '23', 1),
(3374, 'Pandhurna', 425, '23', 1),
(3375, 'Lakhnadon', 426, '23', 1),
(3376, 'Ghansor', 426, '23', 1),
(3377, 'Keolari', 426, '23', 1),
(3378, 'Seoni', 426, '23', 1),
(3379, 'Barghat', 426, '23', 1),
(3380, 'Kurai', 426, '23', 1),
(3381, 'Katangi', 427, '23', 1),
(3382, 'Waraseoni', 427, '23', 1),
(3383, 'Balaghat', 427, '23', 1),
(3384, 'Kirnapur', 427, '23', 1),
(3385, 'Baihar', 427, '23', 1),
(3386, 'Lanji', 427, '23', 1),
(3387, 'Lakhpat', 428, '24', 1),
(3388, 'Rapar', 428, '24', 1),
(3389, 'Bhachau', 428, '24', 1),
(3390, 'Anjar', 428, '24', 1),
(3391, 'Bhuj', 428, '24', 1),
(3392, 'Nakhatrana', 428, '24', 1),
(3393, 'Abdasa', 428, '24', 1),
(3394, 'Mandvi', 428, '24', 1),
(3395, 'Mundra', 428, '24', 1),
(3396, 'Gandhidham', 428, '24', 1),
(3397, 'Vav', 429, '24', 1),
(3398, 'Tharad', 429, '24', 1),
(3399, 'Dhanera', 429, '24', 1),
(3400, 'Dantiwada', 429, '24', 1),
(3401, 'Amirgadh', 429, '24', 1),
(3402, 'Danta', 429, '24', 1),
(3403, 'Vadgam', 429, '24', 1),
(3404, 'Palanpur', 429, '24', 1),
(3405, 'Deesa', 429, '24', 1),
(3406, 'Deodar', 429, '24', 1),
(3407, 'Bhabhar', 429, '24', 1),
(3408, 'Kankrej', 429, '24', 1),
(3409, 'Santalpur', 430, '24', 1),
(3410, 'Radhanpur', 430, '24', 1),
(3411, 'Vagdod', 430, '24', 1),
(3412, 'Sidhpur', 430, '24', 1),
(3413, 'Patan', 430, '24', 1),
(3414, 'Harij', 430, '24', 1),
(3415, 'Sami', 430, '24', 1),
(3416, 'Chanasma', 430, '24', 1),
(3417, 'Satlasana', 431, '24', 1),
(3418, 'Kheralu', 431, '24', 1),
(3419, 'Unjha', 431, '24', 1),
(3420, 'Visnagar', 431, '24', 1),
(3421, 'Vadnagar', 431, '24', 1),
(3422, 'Vijapur', 431, '24', 1),
(3423, 'Mahesana', 431, '24', 1),
(3424, 'Becharaji', 431, '24', 1),
(3425, 'Kadi', 431, '24', 1),
(3426, 'Khedbrahma', 432, '24', 1),
(3427, 'Vijaynagar', 432, '24', 1),
(3428, 'Vadali', 432, '24', 1),
(3429, 'Idar', 432, '24', 1),
(3430, 'Bhiloda', 432, '24', 1),
(3431, 'Meghraj', 432, '24', 1),
(3432, 'Himatnagar', 432, '24', 1),
(3433, 'Prantij', 432, '24', 1),
(3434, 'Talod', 432, '24', 1),
(3435, 'Modasa', 432, '24', 1),
(3436, 'Dhansura', 432, '24', 1),
(3437, 'Malpur', 432, '24', 1),
(3438, 'Bayad', 432, '24', 1),
(3439, 'Kalol', 433, '24', 1),
(3440, 'Mansa', 433, '24', 1),
(3441, 'Gandhinagar', 433, '24', 1),
(3442, 'Dehgam', 433, '24', 1),
(3443, 'Mandal', 434, '24', 1),
(3444, 'Detroj-Rampura', 434, '24', 1),
(3445, 'Viramgam', 434, '24', 1),
(3446, 'Sanand', 434, '24', 1),
(3447, 'Ahmadabad City', 434, '24', 1),
(3448, 'Daskroi', 434, '24', 1),
(3449, 'Dholka', 434, '24', 1),
(3450, 'Bavla', 434, '24', 1),
(3451, 'Ranpur', 434, '24', 1),
(3452, 'Barwala', 434, '24', 1),
(3453, 'Dhandhuka', 434, '24', 1),
(3454, 'Halvad', 435, '24', 1),
(3455, 'Dhrangadhra', 435, '24', 1),
(3456, 'Dasada', 435, '24', 1),
(3457, 'Lakhtar', 435, '24', 1),
(3458, 'Wadhwan', 435, '24', 1),
(3459, 'Muli', 435, '24', 1),
(3460, 'Chotila', 435, '24', 1),
(3461, 'Sayla', 435, '24', 1),
(3462, 'Chuda', 435, '24', 1),
(3463, 'Limbdi', 435, '24', 1),
(3464, 'Maliya', 436, '24', 1),
(3465, 'Morvi', 436, '24', 1),
(3466, 'Tankara', 436, '24', 1),
(3467, 'Wankaner', 436, '24', 1),
(3468, 'Paddhari', 436, '24', 1),
(3469, 'Rajkot', 436, '24', 1),
(3470, 'Lodhika', 436, '24', 1),
(3471, 'Kotda Sangani', 436, '24', 1),
(3472, 'Jasdan', 436, '24', 1),
(3473, 'Gondal', 436, '24', 1),
(3474, 'Jamkandorna', 436, '24', 1),
(3475, 'Upleta', 436, '24', 1),
(3476, 'Dhoraji', 436, '24', 1),
(3477, 'Jetpur', 436, '24', 1),
(3478, 'Okhamandal', 437, '24', 1),
(3479, 'Khambhalia', 437, '24', 1),
(3480, 'Jamnagar', 437, '24', 1),
(3481, 'Jodiya', 437, '24', 1),
(3482, 'Dhrol', 437, '24', 1),
(3483, 'Kalavad', 437, '24', 1),
(3484, 'Lalpur', 437, '24', 1),
(3485, 'Kalyanpur', 437, '24', 1),
(3486, 'Bhanvad', 437, '24', 1),
(3487, 'Jamjodhpur', 437, '24', 1),
(3488, 'Porbandar', 438, '24', 1),
(3489, 'Ranavav', 438, '24', 1),
(3490, 'Kutiyana', 438, '24', 1),
(3491, 'Manavadar', 439, '24', 1),
(3492, 'Vanthali', 439, '24', 1),
(3493, 'Junagadh', 439, '24', 1),
(3494, 'Bhesan', 439, '24', 1),
(3495, 'Visavadar', 439, '24', 1),
(3496, 'Mendarda', 439, '24', 1),
(3497, 'Keshod', 439, '24', 1),
(3498, 'Mangrol', 439, '24', 1),
(3499, 'Malia', 439, '24', 1),
(3500, 'Talala', 439, '24', 1),
(3501, 'Patan-Veraval', 439, '24', 1),
(3502, 'Sutrapada', 439, '24', 1),
(3503, 'Kodinar', 439, '24', 1),
(3504, 'Una', 439, '24', 1),
(3505, 'Kunkavav Vadia', 440, '24', 1),
(3506, 'Babra', 440, '24', 1),
(3507, 'Lathi', 440, '24', 1),
(3508, 'Lilia', 440, '24', 1),
(3509, 'Amreli', 440, '24', 1),
(3510, 'Bagasara', 440, '24', 1),
(3511, 'Dhari', 440, '24', 1),
(3512, 'Savar Kundla', 440, '24', 1),
(3513, 'Khambha', 440, '24', 1),
(3514, 'Jafrabad', 440, '24', 1),
(3515, 'Rajula', 440, '24', 1),
(3516, 'Botad', 441, '24', 1),
(3517, 'Vallabhipur', 441, '24', 1),
(3518, 'Gadhada', 441, '24', 1),
(3519, 'Umrala', 441, '24', 1),
(3520, 'Bhavnagar', 441, '24', 1),
(3521, 'Ghogha', 441, '24', 1),
(3522, 'Sihor', 441, '24', 1),
(3523, 'Gariadhar', 441, '24', 1),
(3524, 'Palitana', 441, '24', 1),
(3525, 'Talaja', 441, '24', 1),
(3526, 'Mahuva', 441, '24', 1),
(3527, 'Tarapur', 442, '24', 1),
(3528, 'Sojitra', 442, '24', 1),
(3529, 'Umreth', 442, '24', 1),
(3530, 'Anand', 442, '24', 1),
(3531, 'Petlad', 442, '24', 1),
(3532, 'Khambhat', 442, '24', 1),
(3533, 'Borsad', 442, '24', 1),
(3534, 'Anklav', 442, '24', 1),
(3535, 'Kapadvanj', 443, '24', 1),
(3536, 'Virpur', 443, '24', 1),
(3537, 'Balasinor', 443, '24', 1),
(3538, 'Kathlal', 443, '24', 1),
(3539, 'Mehmedabad', 443, '24', 1),
(3540, 'Kheda', 443, '24', 1),
(3541, 'Matar', 443, '24', 1),
(3542, 'Nadiad', 443, '24', 1),
(3543, 'Mahudha', 443, '24', 1),
(3544, 'Thasra', 443, '24', 1),
(3545, 'Khanpur', 444, '24', 1),
(3546, 'Kadana', 444, '24', 1),
(3547, 'Santrampur', 444, '24', 1),
(3548, 'Lunawada', 444, '24', 1),
(3549, 'Shehera', 444, '24', 1),
(3550, 'Morwa (Hadaf)', 444, '24', 1),
(3551, 'Godhra', 444, '24', 1),
(3552, 'Kalol', 444, '24', 1),
(3553, 'Ghoghamba', 444, '24', 1),
(3554, 'Halol', 444, '24', 1),
(3555, 'Jambughoda', 444, '24', 1),
(3556, 'Fatepura', 445, '24', 1),
(3557, 'Jhalod', 445, '24', 1),
(3558, 'Limkheda', 445, '24', 1),
(3559, 'Dohad', 445, '24', 1),
(3560, 'Garbada', 445, '24', 1),
(3561, 'Devgadbaria', 445, '24', 1),
(3562, 'Dhanpur', 445, '24', 1),
(3563, 'Savli', 446, '24', 1),
(3564, 'Vadodara', 446, '24', 1),
(3565, 'Vaghodia', 446, '24', 1),
(3566, 'Jetpur Pavi', 446, '24', 1),
(3567, 'Chhota Udaipur', 446, '24', 1),
(3568, 'Kavant', 446, '24', 1),
(3569, 'Nasvadi', 446, '24', 1),
(3570, 'Sankheda', 446, '24', 1),
(3571, 'Dabhoi', 446, '24', 1),
(3572, 'Padra', 446, '24', 1),
(3573, 'Karjan', 446, '24', 1),
(3574, 'Sinor', 446, '24', 1),
(3575, 'Tilakwada', 447, '24', 1),
(3576, 'Nandod', 447, '24', 1),
(3577, 'Dediapada', 447, '24', 1),
(3578, 'Sagbara', 447, '24', 1),
(3579, 'Jambusar', 448, '24', 1),
(3580, 'Amod', 448, '24', 1),
(3581, 'Vagra', 448, '24', 1),
(3582, 'Bharuch', 448, '24', 1),
(3583, 'Jhagadia', 448, '24', 1),
(3584, 'Anklesvar', 448, '24', 1),
(3585, 'Hansot', 448, '24', 1),
(3586, 'Valia', 448, '24', 1),
(3587, 'Olpad', 449, '24', 1),
(3588, 'Mangrol', 449, '24', 1),
(3589, 'Umarpada', 449, '24', 1),
(3590, 'Nizar', 449, '24', 1),
(3591, 'Uchchhal', 449, '24', 1),
(3592, 'Songadh', 449, '24', 1),
(3593, 'Mandvi', 449, '24', 1),
(3594, 'Kamrej', 449, '24', 1),
(3595, 'Surat City', 449, '24', 1),
(3596, 'Chorasi', 449, '24', 1),
(3597, 'Palsana', 449, '24', 1),
(3598, 'Bardoli', 449, '24', 1),
(3599, 'Vyara', 449, '24', 1),
(3600, 'Valod', 449, '24', 1),
(3601, 'Mahuva', 449, '24', 1),
(3602, 'The Dangs', 450, '24', 1),
(3603, 'Navsari', 451, '24', 1),
(3604, 'Jalalpore', 451, '24', 1),
(3605, 'Gandevi', 451, '24', 1),
(3606, 'Chikhli', 451, '24', 1),
(3607, 'Bansda', 451, '24', 1),
(3608, 'Valsad', 452, '24', 1),
(3609, 'Dharampur', 452, '24', 1),
(3610, 'Pardi', 452, '24', 1),
(3611, 'Kaprada', 452, '24', 1),
(3612, 'Umbergaon', 452, '24', 1),
(3613, 'Diu', 453, '25', 1),
(3614, 'Daman', 454, '25', 1),
(3615, 'Dadra & Nagar Haveli', 455, '26', 1),
(3616, 'Akkalkuwa', 456, '27', 1),
(3617, 'Akrani', 456, '27', 1),
(3618, 'Talode', 456, '27', 1),
(3619, 'Shahade', 456, '27', 1),
(3620, 'Nandurbar', 456, '27', 1),
(3621, 'Nawapur', 456, '27', 1),
(3622, 'Shirpur', 457, '27', 1),
(3623, 'Sindkhede', 457, '27', 1),
(3624, 'Sakri', 457, '27', 1),
(3625, 'Dhule', 457, '27', 1),
(3626, 'Chopda', 458, '27', 1),
(3627, 'Yawal', 458, '27', 1),
(3628, 'Raver', 458, '27', 1),
(3629, 'Edlabad (Muktainagar)', 458, '27', 1),
(3630, 'Bodvad', 458, '27', 1),
(3631, 'Bhusawal', 458, '27', 1),
(3632, 'Jalgaon', 458, '27', 1),
(3633, 'Erandol', 458, '27', 1),
(3634, 'Dharangaon', 458, '27', 1),
(3635, 'Amalner', 458, '27', 1),
(3636, 'Parola', 458, '27', 1),
(3637, 'Bhadgaon', 458, '27', 1),
(3638, 'Chalisgaon', 458, '27', 1),
(3639, 'Pachora', 458, '27', 1),
(3640, 'Jamner', 458, '27', 1),
(3641, 'Jalgaon (Jamod)', 459, '27', 1),
(3642, 'Sangrampur', 459, '27', 1),
(3643, 'Shegaon', 459, '27', 1),
(3644, 'Nandura', 459, '27', 1),
(3645, 'Malkapur', 459, '27', 1),
(3646, 'Motala', 459, '27', 1),
(3647, 'Khamgaon', 459, '27', 1),
(3648, 'Mehkar', 459, '27', 1),
(3649, 'Chikhli', 459, '27', 1),
(3650, 'Buldana', 459, '27', 1),
(3651, 'Deolgaon Raja', 459, '27', 1),
(3652, 'Sindkhed Raja', 459, '27', 1),
(3653, 'Lonar', 459, '27', 1),
(3654, 'Telhara', 460, '27', 1),
(3655, 'Akot', 460, '27', 1),
(3656, 'Balapur', 460, '27', 1),
(3657, 'Akola', 460, '27', 1),
(3658, 'Murtijapur', 460, '27', 1),
(3659, 'Patur', 460, '27', 1),
(3660, 'Barshitakli', 460, '27', 1),
(3661, 'Malegaon', 461, '27', 1),
(3662, 'Mangrulpir', 461, '27', 1),
(3663, 'Karanja', 461, '27', 1),
(3664, 'Manora', 461, '27', 1),
(3665, 'Washim', 461, '27', 1),
(3666, 'Risod', 461, '27', 1),
(3667, 'Dharni', 462, '27', 1),
(3668, 'Chikhaldara', 462, '27', 1),
(3669, 'Anjangaon Surji', 462, '27', 1),
(3670, 'Achalpur', 462, '27', 1),
(3671, 'Chandurbazar', 462, '27', 1),
(3672, 'Morshi', 462, '27', 1),
(3673, 'Warud', 462, '27', 1),
(3674, 'Teosa', 462, '27', 1),
(3675, 'Amravati', 462, '27', 1),
(3676, 'Bhatkuli', 462, '27', 1),
(3677, 'Daryapur', 462, '27', 1),
(3678, 'Nandgaon-Khandeshwar', 462, '27', 1),
(3679, 'Chandur Railway', 462, '27', 1),
(3680, 'Dhamangaon Railway', 462, '27', 1),
(3681, 'Ashti', 463, '27', 1),
(3682, 'Karanja', 463, '27', 1),
(3683, 'Arvi', 463, '27', 1),
(3684, 'Seloo', 463, '27', 1),
(3685, 'Wardha', 463, '27', 1),
(3686, 'Deoli', 463, '27', 1),
(3687, 'Hinganghat', 463, '27', 1),
(3688, 'Samudrapur', 463, '27', 1),
(3689, 'Narkhed', 464, '27', 1),
(3690, 'Katol', 464, '27', 1),
(3691, 'Kalameshwar', 464, '27', 1),
(3692, 'Savner', 464, '27', 1),
(3693, 'Parseoni', 464, '27', 1),
(3694, 'Ramtek', 464, '27', 1),
(3695, 'Mauda', 464, '27', 1),
(3696, 'Kamptee', 464, '27', 1),
(3697, 'Nagpur (Rural)', 464, '27', 1),
(3698, 'Nagpur (Urban)', 464, '27', 1),
(3699, 'Hingna', 464, '27', 1),
(3700, 'Umred', 464, '27', 1),
(3701, 'Kuhi', 464, '27', 1),
(3702, 'Bhiwapur', 464, '27', 1),
(3703, 'Tumsar', 465, '27', 1),
(3704, 'Mohadi', 465, '27', 1),
(3705, 'Bhandara', 465, '27', 1),
(3706, 'Sakoli', 465, '27', 1),
(3707, 'Lakhani', 465, '27', 1),
(3708, 'Pauni', 465, '27', 1),
(3709, 'Lakhandur', 465, '27', 1),
(3710, 'Tirora', 466, '27', 1),
(3711, 'Goregaon', 466, '27', 1),
(3712, 'Gondiya', 466, '27', 1),
(3713, 'Amgaon', 466, '27', 1),
(3714, 'Salekasa', 466, '27', 1),
(3715, 'Sadak-Arjuni', 466, '27', 1),
(3716, 'Arjuni Morgaon', 466, '27', 1),
(3717, 'Deori', 466, '27', 1),
(3718, 'Desaiganj (Vadasa)', 467, '27', 1),
(3719, 'Armori', 467, '27', 1),
(3720, 'Kurkheda', 467, '27', 1),
(3721, 'Korchi', 467, '27', 1),
(3722, 'Dhanora', 467, '27', 1),
(3723, 'Gadchiroli', 467, '27', 1),
(3724, 'Chamorshi', 467, '27', 1),
(3725, 'Mulchera', 467, '27', 1),
(3726, 'Etapalli', 467, '27', 1),
(3727, 'Bhamragad', 467, '27', 1),
(3728, 'Aheri', 467, '27', 1),
(3729, 'Sironcha', 467, '27', 1),
(3730, 'Warora', 468, '27', 1),
(3731, 'Chimur', 468, '27', 1),
(3732, 'Nagbhir', 468, '27', 1),
(3733, 'Brahmapuri', 468, '27', 1),
(3734, 'Sawali', 468, '27', 1),
(3735, 'Sindewahi', 468, '27', 1),
(3736, 'Bhadravati', 468, '27', 1),
(3737, 'Chandrapur', 468, '27', 1),
(3738, 'Mul', 468, '27', 1),
(3739, 'Pombhurna', 468, '27', 1),
(3740, 'Ballarpur', 468, '27', 1),
(3741, 'Korpana', 468, '27', 1),
(3742, 'Rajura', 468, '27', 1),
(3743, 'Gondpipri', 468, '27', 1),
(3744, 'Ner', 469, '27', 1),
(3745, 'Babulgaon', 469, '27', 1),
(3746, 'Kalamb', 469, '27', 1),
(3747, 'Yavatmal', 469, '27', 1),
(3748, 'Darwha', 469, '27', 1),
(3749, 'Digras', 469, '27', 1),
(3750, 'Pusad', 469, '27', 1),
(3751, 'Umarkhed', 469, '27', 1),
(3752, 'Mahagaon', 469, '27', 1),
(3753, 'Arni', 469, '27', 1),
(3754, 'Ghatanji', 469, '27', 1),
(3755, 'Kelapur', 469, '27', 1),
(3756, 'Ralegaon', 469, '27', 1),
(3757, 'Maregaon', 469, '27', 1),
(3758, 'Zari-Jamani', 469, '27', 1),
(3759, 'Wani', 469, '27', 1),
(3760, 'Mahoor', 470, '27', 1),
(3761, 'Kinwat', 470, '27', 1),
(3762, 'Himayatnagar', 470, '27', 1),
(3763, 'Hadgaon', 470, '27', 1),
(3764, 'Ardhapur', 470, '27', 1),
(3765, 'Nanded', 470, '27', 1),
(3766, 'Mudkhed', 470, '27', 1),
(3767, 'Bhokar', 470, '27', 1),
(3768, 'Umri', 470, '27', 1),
(3769, 'Dharmabad', 470, '27', 1),
(3770, 'Biloli', 470, '27', 1),
(3771, 'Naigaon (Khairgaon)', 470, '27', 1),
(3772, 'Loha', 470, '27', 1),
(3773, 'Kandhar', 470, '27', 1),
(3774, 'Mukhed', 470, '27', 1),
(3775, 'Deglur', 470, '27', 1),
(3776, 'Sengaon', 471, '27', 1),
(3777, 'Hingoli', 471, '27', 1),
(3778, 'Aundha (Nagnath)', 471, '27', 1),
(3779, 'Kalamnuri', 471, '27', 1),
(3780, 'Basmath', 471, '27', 1),
(3781, 'Sailu', 472, '27', 1),
(3782, 'Jintur', 472, '27', 1),
(3783, 'Parbhani', 472, '27', 1),
(3784, 'Manwath', 472, '27', 1),
(3785, 'Pathri', 472, '27', 1),
(3786, 'Sonpeth', 472, '27', 1),
(3787, 'Gangakhed', 472, '27', 1),
(3788, 'Palam', 472, '27', 1),
(3789, 'Purna', 472, '27', 1),
(3790, 'Bhokardan', 473, '27', 1),
(3791, 'Jafferabad', 473, '27', 1),
(3792, 'Jalna', 473, '27', 1),
(3793, 'Badnapur', 473, '27', 1),
(3794, 'Ambad', 473, '27', 1),
(3795, 'Ghansawangi', 473, '27', 1),
(3796, 'Partur', 473, '27', 1),
(3797, 'Mantha', 473, '27', 1),
(3798, 'Kannad', 474, '27', 1),
(3799, 'Soegaon', 474, '27', 1),
(3800, 'Sillod', 474, '27', 1),
(3801, 'Phulambri', 474, '27', 1),
(3802, 'Aurangabad', 474, '27', 1),
(3803, 'Khuldabad', 474, '27', 1),
(3804, 'Vaijapur', 474, '27', 1),
(3805, 'Gangapur', 474, '27', 1),
(3806, 'Paithan', 474, '27', 1),
(3807, 'Surgana', 475, '27', 1),
(3808, 'Kalwan', 475, '27', 1),
(3809, 'Deola', 475, '27', 1),
(3810, 'Baglan', 475, '27', 1),
(3811, 'Malegaon', 475, '27', 1),
(3812, 'Nandgaon', 475, '27', 1),
(3813, 'Chandvad', 475, '27', 1),
(3814, 'Dindori', 475, '27', 1),
(3815, 'Peint', 475, '27', 1),
(3816, 'Trimbakeshwar', 475, '27', 1),
(3817, 'Nashik', 475, '27', 1),
(3818, 'Igatpuri', 475, '27', 1),
(3819, 'Sinnar', 475, '27', 1),
(3820, 'Niphad', 475, '27', 1),
(3821, 'Yevla', 475, '27', 1),
(3822, 'Talasari', 476, '27', 1),
(3823, 'Dahanu', 476, '27', 1),
(3824, 'Vikramgad', 476, '27', 1),
(3825, 'Jawhar', 476, '27', 1),
(3826, 'Mokhada', 476, '27', 1),
(3827, 'Vada', 476, '27', 1),
(3828, 'Palghar', 476, '27', 1),
(3829, 'Vasai', 476, '27', 1),
(3830, 'Thane', 476, '27', 1),
(3831, 'Bhiwandi', 476, '27', 1),
(3832, 'Shahapur', 476, '27', 1),
(3833, 'Kalyan', 476, '27', 1),
(3834, 'Ulhasnagar', 476, '27', 1),
(3835, 'Ambarnath', 476, '27', 1),
(3836, 'Murbad', 476, '27', 1),
(3837, 'Uran', 479, '27', 1),
(3838, 'Panvel', 479, '27', 1),
(3839, 'Karjat', 479, '27', 1),
(3840, 'Khalapur', 479, '27', 1),
(3841, 'Pen', 479, '27', 1),
(3842, 'Alibag', 479, '27', 1),
(3843, 'Murud', 479, '27', 1),
(3844, 'Roha', 479, '27', 1),
(3845, 'Sudhagad', 479, '27', 1),
(3846, 'Mangaon', 479, '27', 1),
(3847, 'Tala', 479, '27', 1),
(3848, 'Shrivardhan', 479, '27', 1),
(3849, 'Mhasla', 479, '27', 1),
(3850, 'Mahad', 479, '27', 1),
(3851, 'Poladpur', 479, '27', 1),
(3852, 'Junnar', 480, '27', 1),
(3853, 'Ambegaon', 480, '27', 1),
(3854, 'Shirur', 480, '27', 1),
(3855, 'Khed', 480, '27', 1),
(3856, 'Mawal', 480, '27', 1),
(3857, 'Mulshi', 480, '27', 1),
(3858, 'Haveli', 480, '27', 1),
(3859, 'Pune City', 480, '27', 1),
(3860, 'Daund', 480, '27', 1),
(3861, 'Purandhar', 480, '27', 1),
(3862, 'Velhe', 480, '27', 1),
(3863, 'Bhor', 480, '27', 1),
(3864, 'Baramati', 480, '27', 1),
(3865, 'Indapur', 480, '27', 1),
(3866, 'Akola', 481, '27', 1),
(3867, 'Sangamner', 481, '27', 1),
(3868, 'Kopargaon', 481, '27', 1),
(3869, 'Rahta', 481, '27', 1),
(3870, 'Shrirampur', 481, '27', 1),
(3871, 'Nevasa', 481, '27', 1),
(3872, 'Shevgaon', 481, '27', 1),
(3873, 'Pathardi', 481, '27', 1),
(3874, 'Nagar', 481, '27', 1),
(3875, 'Rahuri', 481, '27', 1),
(3876, 'Parner', 481, '27', 1),
(3877, 'Shrigonda', 481, '27', 1),
(3878, 'Karjat', 481, '27', 1),
(3879, 'Jamkhed', 481, '27', 1),
(3880, 'Ashti', 482, '27', 1),
(3881, 'Patoda', 482, '27', 1),
(3882, 'Shirur (Kasar)', 482, '27', 1),
(3883, 'Georai', 482, '27', 1),
(3884, 'Manjalegaon', 482, '27', 1),
(3885, 'Wadwani', 482, '27', 1),
(3886, 'Bid', 482, '27', 1),
(3887, 'Kaij', 482, '27', 1),
(3888, 'Dharur', 482, '27', 1),
(3889, 'Parli', 482, '27', 1),
(3890, 'Ambejogai', 482, '27', 1),
(3891, 'Latur', 483, '27', 1),
(3892, 'Renapur', 483, '27', 1),
(3893, 'Ahmadpur', 483, '27', 1),
(3894, 'Jalkot', 483, '27', 1),
(3895, 'Chakur', 483, '27', 1),
(3896, 'Shirur-Anantpal', 483, '27', 1),
(3897, 'Ausa', 483, '27', 1),
(3898, 'Nilanga', 483, '27', 1),
(3899, 'Deoni', 483, '27', 1),
(3900, 'Udgir', 483, '27', 1),
(3901, 'Paranda', 484, '27', 1),
(3902, 'Bhum', 484, '27', 1),
(3903, 'Washi', 484, '27', 1),
(3904, 'Kalamb', 484, '27', 1),
(3905, 'Osmanabad', 484, '27', 1),
(3906, 'Tuljapur', 484, '27', 1),
(3907, 'Lohara', 484, '27', 1),
(3908, 'Umarga', 484, '27', 1),
(3909, 'Karmala', 485, '27', 1),
(3910, 'Madha', 485, '27', 1),
(3911, 'Barshi', 485, '27', 1),
(3912, 'Solapur North', 485, '27', 1),
(3913, 'Mohol', 485, '27', 1),
(3914, 'Pandharpur', 485, '27', 1),
(3915, 'Malshiras', 485, '27', 1),
(3916, 'Sangole', 485, '27', 1),
(3917, 'Mangalvedhe', 485, '27', 1),
(3918, 'Solapur South', 485, '27', 1),
(3919, 'Akkalkot', 485, '27', 1),
(3920, 'Mahabaleshwar', 486, '27', 1),
(3921, 'Wai', 486, '27', 1),
(3922, 'Khandala', 486, '27', 1),
(3923, 'Phaltan', 486, '27', 1),
(3924, 'Man', 486, '27', 1),
(3925, 'Khatav', 486, '27', 1),
(3926, 'Koregaon', 486, '27', 1),
(3927, 'Satara', 486, '27', 1),
(3928, 'Jaoli', 486, '27', 1),
(3929, 'Patan', 486, '27', 1),
(3930, 'Karad', 486, '27', 1),
(3931, 'Mandangad', 487, '27', 1),
(3932, 'Dapoli', 487, '27', 1),
(3933, 'Khed', 487, '27', 1),
(3934, 'Chiplun', 487, '27', 1),
(3935, 'Guhagar', 487, '27', 1),
(3936, 'Ratnagiri', 487, '27', 1),
(3937, 'Sangameshwar', 487, '27', 1),
(3938, 'Lanja', 487, '27', 1),
(3939, 'Rajapur', 487, '27', 1),
(3940, 'Devgad', 488, '27', 1),
(3941, 'Vaibhavvadi', 488, '27', 1),
(3942, 'Kankavli', 488, '27', 1),
(3943, 'Malwan', 488, '27', 1),
(3944, 'Vengurla', 488, '27', 1),
(3945, 'Kudal', 488, '27', 1),
(3946, 'Sawantwadi', 488, '27', 1),
(3947, 'Dodamarg', 488, '27', 1),
(3948, 'Shahuwadi', 489, '27', 1),
(3949, 'Panhala', 489, '27', 1),
(3950, 'Hatkanangle', 489, '27', 1),
(3951, 'Shirol', 489, '27', 1),
(3952, 'Karvir', 489, '27', 1),
(3953, 'Bavda', 489, '27', 1),
(3954, 'Radhanagari', 489, '27', 1),
(3955, 'Kagal', 489, '27', 1),
(3956, 'Bhudargad', 489, '27', 1),
(3957, 'Ajra', 489, '27', 1),
(3958, 'Gadhinglaj', 489, '27', 1),
(3959, 'Chandgad', 489, '27', 1),
(3960, 'Shirala', 490, '27', 1),
(3961, 'Walwa', 490, '27', 1),
(3962, 'Palus', 490, '27', 1),
(3963, 'Khanapur', 490, '27', 1),
(3964, 'Atpadi', 490, '27', 1),
(3965, 'Tasgaon', 490, '27', 1),
(3966, 'Miraj', 490, '27', 1),
(3967, 'Kavathe-Mahankal', 490, '27', 1),
(3968, 'Jat', 490, '27', 1),
(3969, 'Tamsi', 491, '28', 1),
(3970, 'Adilabad', 491, '28', 1),
(3971, 'Jainad', 491, '28', 1),
(3972, 'Bela', 491, '28', 1),
(3973, 'Talamadugu', 491, '28', 1),
(3974, 'Gudihatnoor', 491, '28', 1),
(3975, 'Indervelly', 491, '28', 1),
(3976, 'Narnoor', 491, '28', 1),
(3977, 'Kerameri', 491, '28', 1),
(3978, 'Wankidi', 491, '28', 1),
(3979, 'Sirpur (T)', 491, '28', 1),
(3980, 'Koutala', 491, '28', 1),
(3981, 'Bejjur', 491, '28', 1),
(3982, 'Kaghaznagar', 491, '28', 1),
(3983, 'Asifabad', 491, '28', 1),
(3984, 'Jainoor', 491, '28', 1),
(3985, 'Utnoor', 491, '28', 1),
(3986, 'Ichoda', 491, '28', 1),
(3987, 'Bazarhatnoor', 491, '28', 1),
(3988, 'Boath', 491, '28', 1),
(3989, 'Neeradigonda', 491, '28', 1),
(3990, 'Sirpur', 491, '28', 1),
(3991, 'Rebbena', 491, '28', 1),
(3992, 'Bhimini', 491, '28', 1),
(3993, 'Dahegaon', 491, '28', 1),
(3994, 'Vemanpalle', 491, '28', 1),
(3995, 'Nennel', 491, '28', 1),
(3996, 'Tandur', 491, '28', 1),
(3997, 'Tiryani', 491, '28', 1),
(3998, 'Jannaram', 491, '28', 1),
(3999, 'Kaddam (Peddur)', 491, '28', 1),
(4000, 'Sarangapur', 491, '28', 1),
(4001, 'Kuntala', 491, '28', 1),
(4002, 'Kubeer', 491, '28', 1),
(4003, 'Bhainsa', 491, '28', 1),
(4004, 'Thanoor', 491, '28', 1),
(4005, 'Mudhole', 491, '28', 1),
(4006, 'Lokeshwaram', 491, '28', 1),
(4007, 'Dilawarpur', 491, '28', 1),
(4008, 'Nirmal', 491, '28', 1),
(4009, 'Laxmanchanda', 491, '28', 1),
(4010, 'Mamda', 491, '28', 1),
(4011, 'Khanapur', 491, '28', 1),
(4012, 'Dandepalle', 491, '28', 1),
(4013, 'Kasipet', 491, '28', 1),
(4014, 'Bellampalle', 491, '28', 1),
(4015, 'Kotapalle', 491, '28', 1),
(4016, 'Mandamarri', 491, '28', 1),
(4017, 'Luxettipet', 491, '28', 1),
(4018, 'Mancherial', 491, '28', 1),
(4019, 'Jaipur', 491, '28', 1),
(4020, 'Chennur', 491, '28', 1),
(4021, 'Ranjal', 492, '28', 1),
(4022, 'Navipet', 492, '28', 1),
(4023, 'Nandipet', 492, '28', 1),
(4024, 'Armur', 492, '28', 1),
(4025, 'Balkonda', 492, '28', 1),
(4026, 'Mortad', 492, '28', 1),
(4027, 'Kammar palle', 492, '28', 1),
(4028, 'Bheemgal', 492, '28', 1),
(4029, 'Velpur', 492, '28', 1),
(4030, 'Jakranpalle', 492, '28', 1),
(4031, 'Makloor', 492, '28', 1),
(4032, 'Nizamabad', 492, '28', 1),
(4033, 'Yedpalle', 492, '28', 1),
(4034, 'Bodhan', 492, '28', 1),
(4035, 'Kotgiri', 492, '28', 1),
(4036, 'Madnoor', 492, '28', 1),
(4037, 'Jukkal', 492, '28', 1),
(4038, 'Bichkunda', 492, '28', 1),
(4039, 'Birkoor', 492, '28', 1),
(4040, 'Varni', 492, '28', 1),
(4041, 'Dichpalle', 492, '28', 1),
(4042, 'Dharpalle', 492, '28', 1),
(4043, 'Sirkonda', 492, '28', 1),
(4044, 'Machareddy', 492, '28', 1),
(4045, 'Sadasivanagar', 492, '28', 1),
(4046, 'Gandhari', 492, '28', 1),
(4047, 'Banswada', 492, '28', 1),
(4048, 'Pitlam', 492, '28', 1),
(4049, 'Nizamsagar', 492, '28', 1),
(4050, 'Yellareddy', 492, '28', 1),
(4051, 'Nagareddypet', 492, '28', 1),
(4052, 'Lingampet', 492, '28', 1),
(4053, 'Tadwai', 492, '28', 1),
(4054, 'Kamareddy', 492, '28', 1),
(4055, 'Bhiknur', 492, '28', 1),
(4056, 'Domakonda', 492, '28', 1),
(4057, 'Ibrahimpatnam', 493, '28', 1),
(4058, 'Mallapur', 493, '28', 1),
(4059, 'Raikal', 493, '28', 1),
(4060, 'Sarangapur', 493, '28', 1),
(4061, 'Dharmapuri', 493, '28', 1),
(4062, 'Velgatoor', 493, '28', 1),
(4063, 'Ramagundam', 493, '28', 1),
(4064, 'Kamanpur', 493, '28', 1),
(4065, 'Manthani', 493, '28', 1),
(4066, 'Kataram', 493, '28', 1),
(4067, 'Mahadevpur', 493, '28', 1),
(4068, 'Mutharam (N)', 493, '28', 1),
(4069, 'Malharrao mandal', 493, '28', 1),
(4070, 'Mutharam (A)', 493, '28', 1),
(4071, 'Srirampur', 493, '28', 1),
(4072, 'Peddapalle', 493, '28', 1),
(4073, 'Julapalle', 493, '28', 1),
(4074, 'Bommareddypalle (H/o.Dharmaram)', 493, '28', 1),
(4075, 'Gollapalle', 493, '28', 1),
(4076, 'Mallial', 493, '28', 1),
(4077, 'Jagtial', 493, '28', 1),
(4078, 'Medipalle', 493, '28', 1),
(4079, 'Koratla', 493, '28', 1),
(4080, 'Metpalle', 493, '28', 1),
(4081, 'Kathlapur', 493, '28', 1),
(4082, 'Chandurthi', 493, '28', 1),
(4083, 'Kodimial', 493, '28', 1),
(4084, 'Pegadapalle', 493, '28', 1),
(4085, 'Gangadhara', 493, '28', 1),
(4086, 'Ramadugu', 493, '28', 1),
(4087, 'Choppadandi', 493, '28', 1),
(4088, 'Sulthanabad', 493, '28', 1),
(4089, 'Odela', 493, '28', 1),
(4090, 'Manakondur', 493, '28', 1),
(4091, 'Karimnagar', 493, '28', 1),
(4092, 'Boinpalle', 493, '28', 1),
(4093, 'Vemulawada', 493, '28', 1),
(4094, 'Konaraopeta', 493, '28', 1),
(4095, 'Yellareddipet', 493, '28', 1),
(4096, 'Gambhiraopet', 493, '28', 1),
(4097, 'Mustabad', 493, '28', 1),
(4098, 'Sirsilla', 493, '28', 1),
(4099, 'Ellanthakunta', 493, '28', 1),
(4100, 'Bejjanki', 493, '28', 1),
(4101, 'Thimmapur (LMD)', 493, '28', 1),
(4102, 'Veenavanka', 493, '28', 1),
(4103, 'Jammikunta', 493, '28', 1),
(4104, 'Shankarapeta kesavapatnam', 493, '28', 1),
(4105, 'Chigurumamidi', 493, '28', 1),
(4106, 'Koheda', 493, '28', 1),
(4107, 'Husnabad', 493, '28', 1),
(4108, 'Saidapur', 493, '28', 1),
(4109, 'Huzurabad', 493, '28', 1),
(4110, 'Kamalapur', 493, '28', 1),
(4111, 'Bheemadevarpalle', 493, '28', 1),
(4112, 'Elkathurthy', 493, '28', 1),
(4113, 'Kangti', 494, '28', 1),
(4114, 'Manoor', 494, '28', 1),
(4115, 'Narayankhed', 494, '28', 1),
(4116, 'Kalher', 494, '28', 1),
(4117, 'Shankarampet (A)', 494, '28', 1),
(4118, 'Papannapet', 494, '28', 1),
(4119, 'Medak', 494, '28', 1),
(4120, 'Ramayampet', 494, '28', 1),
(4121, 'Dubbak', 494, '28', 1),
(4122, 'Siddipet', 494, '28', 1),
(4123, 'Chinnakodur', 494, '28', 1),
(4124, 'Nangnoor', 494, '28', 1),
(4125, 'Kondapak', 494, '28', 1),
(4126, 'Mirdoddi', 494, '28', 1),
(4127, 'Doulthabad', 494, '28', 1),
(4128, 'Chegunta', 494, '28', 1),
(4129, 'Shankarampet (R)', 494, '28', 1),
(4130, 'Kulcharam', 494, '28', 1),
(4131, 'Tekmal', 494, '28', 1),
(4132, 'Alladurg', 494, '28', 1),
(4133, 'Regode', 494, '28', 1),
(4134, 'Raikode', 494, '28', 1),
(4135, 'Nyalkal', 494, '28', 1),
(4136, 'Zahirabad', 494, '28', 1),
(4137, 'Kohir', 494, '28', 1),
(4138, 'Jharasangam', 494, '28', 1),
(4139, 'Munipalle', 494, '28', 1),
(4140, 'Pulkal', 494, '28', 1),
(4141, 'Andole', 494, '28', 1),
(4142, 'Kowdipalle', 494, '28', 1),
(4143, 'Veldurthy', 494, '28', 1),
(4144, 'Tupran', 494, '28', 1),
(4145, 'Gajwel', 494, '28', 1),
(4146, 'Jagdevpur', 494, '28', 1),
(4147, 'Wargal', 494, '28', 1),
(4148, 'Mulugu', 494, '28', 1),
(4149, 'Shivampet', 494, '28', 1),
(4150, 'Narsapur', 494, '28', 1),
(4151, 'Hathnoora', 494, '28', 1),
(4152, 'Sadasivpet', 494, '28', 1),
(4153, 'Kondapoor', 494, '28', 1),
(4154, 'Sangareddy', 494, '28', 1),
(4155, 'Jinnaram', 494, '28', 1),
(4156, 'Patancheru', 494, '28', 1),
(4157, 'Ramchandrapuram', 494, '28', 1),
(4158, 'Shaikpet', 495, '28', 1),
(4159, 'Ameerpet', 495, '28', 1),
(4160, 'Secunderabad', 495, '28', 1),
(4161, 'Tirumalagiri', 495, '28', 1),
(4162, 'Maredpalle', 495, '28', 1),
(4163, 'Musheerabad', 495, '28', 1),
(4164, 'Amberpet', 495, '28', 1),
(4165, 'Himayathnagar', 495, '28', 1),
(4166, 'Nampally', 495, '28', 1),
(4167, 'Khairatabad', 495, '28', 1),
(4168, 'Asifnagar', 495, '28', 1),
(4169, 'Golconda', 495, '28', 1),
(4170, 'Bahadurpura', 495, '28', 1),
(4171, 'Bandlaguda', 495, '28', 1),
(4172, 'Charminar', 495, '28', 1),
(4173, 'Saidabad', 495, '28', 1),
(4174, 'Marpalle', 496, '28', 1),
(4175, 'Mominpet', 496, '28', 1),
(4176, 'Nawabpet', 496, '28', 1),
(4177, 'Shankarpalle', 496, '28', 1),
(4178, 'Serilingampalle', 496, '28', 1),
(4179, 'Balanagar', 496, '28', 1),
(4180, 'Quthbullapur', 496, '28', 1),
(4181, 'Medchal', 496, '28', 1),
(4182, 'Shamirpet', 496, '28', 1),
(4183, 'Malkajgiri', 496, '28', 1),
(4184, 'Keesara', 496, '28', 1),
(4185, 'Ghatkesar', 496, '28', 1),
(4186, 'Uppal kalan', 496, '28', 1),
(4187, 'Hayathnagar', 496, '28', 1),
(4188, 'Saroornagar', 496, '28', 1),
(4189, 'Rajendranagar', 496, '28', 1),
(4190, 'Moinabad', 496, '28', 1),
(4191, 'Chevella', 496, '28', 1),
(4192, 'Vicarabad', 496, '28', 1),
(4193, 'Dharur', 496, '28', 1),
(4194, 'Bantwaram', 496, '28', 1),
(4195, 'Peddemul', 496, '28', 1),
(4196, 'Tandur', 496, '28', 1),
(4197, 'Basheerabad', 496, '28', 1),
(4198, 'Yalal', 496, '28', 1),
(4199, 'Doma', 496, '28', 1),
(4200, 'Gandeed', 496, '28', 1),
(4201, 'Kulkacharla', 496, '28', 1),
(4202, 'Pargi', 496, '28', 1),
(4203, 'Pudur', 496, '28', 1),
(4204, 'Shabad', 496, '28', 1),
(4205, 'Shamshabad', 496, '28', 1),
(4206, 'Maheswaram', 496, '28', 1),
(4207, 'Kandukur', 496, '28', 1),
(4208, 'Ibrahimpatnam', 496, '28', 1),
(4209, 'Manchal', 496, '28', 1),
(4210, 'Yacharam', 496, '28', 1),
(4211, 'Kodangal', 497, '28', 1),
(4212, 'Bomraspet', 497, '28', 1),
(4213, 'Kosgi', 497, '28', 1),
(4214, 'Doulathabad', 497, '28', 1),
(4215, 'Damaragidda', 497, '28', 1),
(4216, 'Maddur', 497, '28', 1),
(4217, 'Hanwada', 497, '28', 1),
(4218, 'Nawabpet', 497, '28', 1),
(4219, 'Balanagar', 497, '28', 1),
(4220, 'Kondurg', 497, '28', 1),
(4221, 'Farooqnagar', 497, '28', 1),
(4222, 'Kothur', 497, '28', 1),
(4223, 'Keshampet', 497, '28', 1),
(4224, 'Talakondapalle', 497, '28', 1),
(4225, 'Amangal', 497, '28', 1),
(4226, 'Madgul', 497, '28', 1),
(4227, 'Veldanda', 497, '28', 1),
(4228, 'Midjil', 497, '28', 1),
(4229, 'Jadcharla', 497, '28', 1),
(4230, 'Mahabubnagar', 497, '28', 1),
(4231, 'Koilkonda', 497, '28', 1),
(4232, 'Narayanpet', 497, '28', 1),
(4233, 'Utkoor', 497, '28', 1),
(4234, 'Dhanwada', 497, '28', 1),
(4235, 'Devarkadra', 497, '28', 1),
(4236, 'Bhoothpur', 497, '28', 1),
(4237, 'Thimmajipet', 497, '28', 1),
(4238, 'Kalwakurthy', 497, '28', 1),
(4239, 'Vangoor', 497, '28', 1),
(4240, 'Amrabad', 497, '28', 1),
(4241, 'Achampet', 497, '28', 1),
(4242, 'Uppununthala', 497, '28', 1),
(4243, 'Telkapalle', 497, '28', 1),
(4244, 'Tadoor', 497, '28', 1),
(4245, 'Nagarkurnool', 497, '28', 1),
(4246, 'Bijinapalle', 497, '28', 1),
(4247, 'Ghanpur', 497, '28', 1),
(4248, 'Addakal', 497, '28', 1),
(4249, 'Chinnachintakunta', 497, '28', 1),
(4250, 'Narwa', 497, '28', 1),
(4251, 'Makthal', 497, '28', 1),
(4252, 'Maganoor', 497, '28', 1),
(4253, 'Dharur', 497, '28', 1),
(4254, 'Atmakur', 497, '28', 1),
(4255, 'Kothakota', 497, '28', 1),
(4256, 'Peddamandadi', 497, '28', 1),
(4257, 'Wanaparthy', 497, '28', 1),
(4258, 'Gopalpeta', 497, '28', 1),
(4259, 'Balmoor', 497, '28', 1),
(4260, 'Lingal', 497, '28', 1),
(4261, 'Peddakothapalle', 497, '28', 1),
(4262, 'Kodair', 497, '28', 1),
(4263, 'Pangal', 497, '28', 1),
(4264, 'Pebbair', 497, '28', 1),
(4265, 'Gadwal', 497, '28', 1),
(4266, 'Maldakal', 497, '28', 1),
(4267, 'Ghattu', 497, '28', 1),
(4268, 'Aiza', 497, '28', 1),
(4269, 'Itikyal', 497, '28', 1),
(4270, 'Weepangandla', 497, '28', 1),
(4271, 'Kollapur', 497, '28', 1),
(4272, 'Waddepalle', 497, '28', 1),
(4273, 'Manopad', 497, '28', 1),
(4274, 'Alampur', 497, '28', 1),
(4275, 'Bommalaramaram', 498, '28', 1),
(4276, 'M.Turkapalle', 498, '28', 1),
(4277, 'Rajapet', 498, '28', 1),
(4278, 'Yadagirigutta', 498, '28', 1),
(4279, 'Alair', 498, '28', 1),
(4280, 'Gundala', 498, '28', 1),
(4281, 'Thirumalgiri', 498, '28', 1),
(4282, 'Thungathurthi', 498, '28', 1),
(4283, 'Nuthankal', 498, '28', 1),
(4284, 'Atmakur (S)', 498, '28', 1),
(4285, 'Jaji reddi gudem', 498, '28', 1),
(4286, 'Sali gouraram', 498, '28', 1),
(4287, 'Mothkur', 498, '28', 1),
(4288, 'Atmakur (M)', 498, '28', 1),
(4289, 'Valigonda', 498, '28', 1),
(4290, 'Bhuvanagiri', 498, '28', 1),
(4291, 'Bibinagar', 498, '28', 1),
(4292, 'Pochampalle', 498, '28', 1),
(4293, 'Choutuppal', 498, '28', 1),
(4294, 'Ramannapeta', 498, '28', 1),
(4295, 'Chityala', 498, '28', 1),
(4296, 'Narketpalle', 498, '28', 1),
(4297, 'Kattangoor', 498, '28', 1),
(4298, 'Nakrekal', 498, '28', 1),
(4299, 'Kethe palle', 498, '28', 1),
(4300, 'Suryapet', 498, '28', 1),
(4301, 'Chivvemla', 498, '28', 1),
(4302, 'Mothey', 498, '28', 1),
(4303, 'Nadigudem', 498, '28', 1),
(4304, 'Munagala', 498, '28', 1),
(4305, 'Penpahad', 498, '28', 1),
(4306, 'Vemulapalle', 498, '28', 1),
(4307, 'Thipparthi', 498, '28', 1),
(4308, 'Nalgonda', 498, '28', 1),
(4309, 'Munugode', 498, '28', 1),
(4310, 'Narayanpur', 498, '28', 1),
(4311, 'Marriguda', 498, '28', 1),
(4312, 'Chintha palle', 498, '28', 1),
(4313, 'Gundla palle', 498, '28', 1),
(4314, 'Chandam pet', 498, '28', 1),
(4315, 'Devarkonda', 498, '28', 1),
(4316, 'Nampalle', 498, '28', 1),
(4317, 'Chandur', 498, '28', 1),
(4318, 'Kangal', 498, '28', 1),
(4319, 'Gurrampode', 498, '28', 1),
(4320, 'Pedda adiserla palle', 498, '28', 1),
(4321, 'Peddavoora', 498, '28', 1),
(4322, 'Anumula', 498, '28', 1),
(4323, 'Nidamanur', 498, '28', 1),
(4324, 'Thripuraram', 498, '28', 1),
(4325, 'Damaracherla', 498, '28', 1),
(4326, 'Miryalaguda', 498, '28', 1),
(4327, 'Nereducherla', 498, '28', 1),
(4328, 'Garide palle', 498, '28', 1),
(4329, 'Chilkur', 498, '28', 1),
(4330, 'Kodad', 498, '28', 1),
(4331, 'Huzurnagar', 498, '28', 1),
(4332, 'Mattam palle', 498, '28', 1),
(4333, 'Mella cheruvu', 498, '28', 1),
(4334, 'Cherial', 499, '28', 1),
(4335, 'Maddur', 499, '28', 1),
(4336, 'Bachannapet', 499, '28', 1),
(4337, 'Narmetta', 499, '28', 1),
(4338, 'Ghanpur (Station)', 499, '28', 1),
(4339, 'Dharamsagar', 499, '28', 1),
(4340, 'Hasanparthy', 499, '28', 1),
(4341, 'Parakal', 499, '28', 1),
(4342, 'Mogullapalle', 499, '28', 1),
(4343, 'Chityal', 499, '28', 1),
(4344, 'Bhupalpalle', 499, '28', 1),
(4345, 'Ghanpur (Mulug)', 499, '28', 1),
(4346, 'Venkatapur', 499, '28', 1),
(4347, 'Eturnagaram', 499, '28', 1),
(4348, 'Mangapet', 499, '28', 1),
(4349, 'Tadvai', 499, '28', 1),
(4350, 'Govindaraopet', 499, '28', 1),
(4351, 'Mulug', 499, '28', 1),
(4352, 'Regonda', 499, '28', 1),
(4353, 'Shyampet', 499, '28', 1),
(4354, 'Nallabelly', 499, '28', 1),
(4355, 'Duggondi', 499, '28', 1),
(4356, 'Atmakur', 499, '28', 1),
(4357, 'Hanamkonda', 499, '28', 1),
(4358, 'Zaffergadh', 499, '28', 1),
(4359, 'Palakurthi', 499, '28', 1),
(4360, 'Raghunathpalle', 499, '28', 1),
(4361, 'Jangaon', 499, '28', 1),
(4362, 'Lingalaghanpur', 499, '28', 1),
(4363, 'Devaruppula', 499, '28', 1),
(4364, 'Kodakandla', 499, '28', 1),
(4365, 'Raiparthy', 499, '28', 1),
(4366, 'Wardhanna pet', 499, '28', 1),
(4367, 'Sangam', 499, '28', 1),
(4368, 'Warangal', 499, '28', 1),
(4369, 'Geesugonda', 499, '28', 1),
(4370, 'Narsampet', 499, '28', 1),
(4371, 'Khanapur', 499, '28', 1),
(4372, 'Kothagudem', 499, '28', 1),
(4373, 'Gudur', 499, '28', 1),
(4374, 'Chennaraopet', 499, '28', 1),
(4375, 'Nekkonda', 499, '28', 1),
(4376, 'Parvathagiri', 499, '28', 1),
(4377, 'Thorrur', 499, '28', 1),
(4378, 'Nellikudur', 499, '28', 1),
(4379, 'Kesamudram', 499, '28', 1),
(4380, 'Mahabubabad', 499, '28', 1),
(4381, 'Narsimhulapet', 499, '28', 1),
(4382, 'Maripeda', 499, '28', 1),
(4383, 'Kuravi', 499, '28', 1),
(4384, 'Dornakal', 499, '28', 1),
(4385, 'Wazeed', 500, '28', 1),
(4386, 'Venkatapuram', 500, '28', 1),
(4387, 'Pinapaka', 500, '28', 1),
(4388, 'Cherla', 500, '28', 1),
(4389, 'Manugur', 500, '28', 1),
(4390, 'Aswapuram', 500, '28', 1),
(4391, 'Dummugudem', 500, '28', 1),
(4392, 'Bhadrachalam', 500, '28', 1),
(4393, 'Kunavaram', 500, '28', 1),
(4394, 'Chintur', 500, '28', 1),
(4395, 'Vararamachandrapuram', 500, '28', 1),
(4396, 'Velairpad', 500, '28', 1),
(4397, 'Kukunoor', 500, '28', 1),
(4398, 'Burgumpahad', 500, '28', 1),
(4399, 'Palwancha', 500, '28', 1),
(4400, 'Kothagudem', 500, '28', 1),
(4401, 'Tekulapalle', 500, '28', 1),
(4402, 'Yellandu', 500, '28', 1),
(4403, 'Gundala', 500, '28', 1),
(4404, 'Bayyaram', 500, '28', 1),
(4405, 'Garla', 500, '28', 1),
(4406, 'Singareni', 500, '28', 1),
(4407, 'Kamepalle', 500, '28', 1),
(4408, 'Julurpadu', 500, '28', 1),
(4409, 'Chandrugonda', 500, '28', 1),
(4410, 'Mulkalapalle', 500, '28', 1),
(4411, 'Aswaraopet', 500, '28', 1),
(4412, 'Dammapet', 500, '28', 1),
(4413, 'Sathupalle', 500, '28', 1),
(4414, 'Penuballe', 500, '28', 1),
(4415, 'Enkuru', 500, '28', 1),
(4416, 'Tirumalayapalem', 500, '28', 1),
(4417, 'Kusumanchi', 500, '28', 1),
(4418, 'Khammam (Rural)', 500, '28', 1),
(4419, 'Khammam (Urban)', 500, '28', 1),
(4420, 'Mudigonda', 500, '28', 1),
(4421, 'Nelakondapalle', 500, '28', 1),
(4422, 'Chinthakani', 500, '28', 1),
(4423, 'Konijerla', 500, '28', 1),
(4424, 'Tallada', 500, '28', 1),
(4425, 'Kallur', 500, '28', 1),
(4426, 'Wyra', 500, '28', 1),
(4427, 'Bonakal', 500, '28', 1),
(4428, 'Madhira', 500, '28', 1),
(4429, 'Yerrupalem', 500, '28', 1),
(4430, 'Vemsoor', 500, '28', 1),
(4431, 'Veeraghattam', 501, '28', 1),
(4432, 'Seethampeta', 501, '28', 1),
(4433, 'Bhamini', 501, '28', 1),
(4434, 'Kothuru', 501, '28', 1),
(4435, 'Pathapatnam', 501, '28', 1),
(4436, 'Meliaputtu', 501, '28', 1),
(4437, 'Palasa', 501, '28', 1),
(4438, 'Mandasa', 501, '28', 1),
(4439, 'Kanchili', 501, '28', 1),
(4440, 'Ichchapuram', 501, '28', 1),
(4441, 'Kaviti', 501, '28', 1),
(4442, 'Sompeta', 501, '28', 1),
(4443, 'Vajrapukothuru', 501, '28', 1),
(4444, 'Nandigam', 501, '28', 1),
(4445, 'Hiramandalam', 501, '28', 1),
(4446, 'Palakonda', 501, '28', 1),
(4447, 'Vangara', 501, '28', 1),
(4448, 'Regidi Amadalavalasa', 501, '28', 1),
(4449, 'Laxminarasupeta', 501, '28', 1),
(4450, 'Saravakota', 501, '28', 1),
(4451, 'Tekkali', 501, '28', 1),
(4452, 'Santhabommali', 501, '28', 1),
(4453, 'Kotabommili', 501, '28', 1),
(4454, 'Jalumuru', 501, '28', 1),
(4455, 'Sarubujjili', 501, '28', 1),
(4456, 'Burja', 501, '28', 1),
(4457, 'Santhakaviti', 501, '28', 1),
(4458, 'Rajam', 501, '28', 1),
(4459, 'Ganguvarisigadam', 501, '28', 1),
(4460, 'Amadalavalasa', 501, '28', 1),
(4461, 'Narasannapeta', 501, '28', 1),
(4462, 'Polaki', 501, '28', 1),
(4463, 'Gara', 501, '28', 1),
(4464, 'Srikakulam', 501, '28', 1),
(4465, 'Ponduru', 501, '28', 1),
(4466, 'Laveru', 501, '28', 1),
(4467, 'Ranasthalam', 501, '28', 1),
(4468, 'Etcherla', 501, '28', 1),
(4469, 'Komarada', 502, '28', 1),
(4470, 'Gummalakshmipuram', 502, '28', 1),
(4471, 'Kurupam', 502, '28', 1),
(4472, 'Jiyyammavalasa', 502, '28', 1),
(4473, 'Garugubilli', 502, '28', 1),
(4474, 'Parvathipuram', 502, '28', 1),
(4475, 'Makkuva', 502, '28', 1),
(4476, 'Seethanagaram', 502, '28', 1),
(4477, 'Balijipeta', 502, '28', 1),
(4478, 'Bobbili', 502, '28', 1),
(4479, 'Salur', 502, '28', 1),
(4480, 'Pachipenta', 502, '28', 1),
(4481, 'Ramabhadrapuram', 502, '28', 1),
(4482, 'Badangi', 502, '28', 1),
(4483, 'Therlam', 502, '28', 1),
(4484, 'Merakamudidam', 502, '28', 1),
(4485, 'Dathirajeru', 502, '28', 1),
(4486, 'Mentada', 502, '28', 1),
(4487, 'Gajapathinagaram', 502, '28', 1),
(4488, 'Garividi', 502, '28', 1),
(4489, 'Cheepurupalle', 502, '28', 1),
(4490, 'Gurla', 502, '28', 1),
(4491, 'Bondapalle', 502, '28', 1),
(4492, 'Gantyada', 502, '28', 1),
(4493, 'Srungavarapukota', 502, '28', 1),
(4494, 'Vepada', 502, '28', 1),
(4495, 'Lakkavarapukota', 502, '28', 1),
(4496, 'Kothavalasa', 502, '28', 1),
(4497, 'Jami', 502, '28', 1),
(4498, 'Vizianagaram', 502, '28', 1),
(4499, 'Nellimarla', 502, '28', 1),
(4500, 'Pusapatirega', 502, '28', 1),
(4501, 'Denkada', 502, '28', 1),
(4502, 'Bhogapuram', 502, '28', 1),
(4503, 'Munchingi puttu', 503, '28', 1),
(4504, 'Peda bayalu', 503, '28', 1),
(4505, 'Dumbriguda', 503, '28', 1),
(4506, 'Araku valley', 503, '28', 1),
(4507, 'Ananthagiri', 503, '28', 1),
(4508, 'Hukumpeta', 503, '28', 1),
(4509, 'Paderu', 503, '28', 1),
(4510, 'G.madugula', 503, '28', 1),
(4511, 'Chintapalle', 503, '28', 1),
(4512, 'Gudem kotha veedhi', 503, '28', 1),
(4513, 'Koyyuru', 503, '28', 1),
(4514, 'Nathavaram', 503, '28', 1),
(4515, 'Golugonda', 503, '28', 1),
(4516, 'Narsipatnam', 503, '28', 1),
(4517, 'Rolugunta', 503, '28', 1),
(4518, 'Ravikamatham', 503, '28', 1),
(4519, 'Madugula', 503, '28', 1),
(4520, 'Cheedikada', 503, '28', 1),
(4521, 'Devarapalle', 503, '28', 1),
(4522, 'K.Kotapadu', 503, '28', 1),
(4523, 'Sabbavaram', 503, '28', 1),
(4524, 'Pendurthi', 503, '28', 1),
(4525, 'Anandapuram', 503, '28', 1),
(4526, 'Padmanabham', 503, '28', 1),
(4527, 'Bheemunipatnam', 503, '28', 1),
(4528, 'Visakhapatnam (Rural)', 503, '28', 1),
(4529, 'Visakhapatnam (Urban)', 503, '28', 1),
(4530, 'Pedagantyada', 503, '28', 1),
(4531, 'Gajuwaka', 503, '28', 1),
(4532, 'Paravada', 503, '28', 1),
(4533, 'Anakapalle', 503, '28', 1),
(4534, 'Chodavaram', 503, '28', 1),
(4535, 'Butchayyapeta', 503, '28', 1),
(4536, 'Kotauratla', 503, '28', 1),
(4537, 'Makavarapalem', 503, '28', 1),
(4538, 'Kasimkota', 503, '28', 1),
(4539, 'Munagapaka', 503, '28', 1),
(4540, 'Atchutapuram', 503, '28', 1),
(4541, 'Yelamanchili', 503, '28', 1),
(4542, 'Nakkapalle', 503, '28', 1),
(4543, 'Payakaraopeta', 503, '28', 1),
(4544, 'S.Rayavaram', 503, '28', 1),
(4545, 'Rambilli', 503, '28', 1),
(4546, 'Maredumilli', 504, '28', 1),
(4547, 'Devipatnam', 504, '28', 1),
(4548, 'Y. Ramavaram', 504, '28', 1),
(4549, 'Addateegala', 504, '28', 1),
(4550, 'Rajavommangi', 504, '28', 1),
(4551, 'Kotananduru', 504, '28', 1),
(4552, 'Tuni', 504, '28', 1),
(4553, 'Sankhavaram', 504, '28', 1),
(4554, 'Yeleswaram', 504, '28', 1),
(4555, 'Gangavaram', 504, '28', 1),
(4556, 'Rampachodavaram', 504, '28', 1),
(4557, 'Seethanagaram', 504, '28', 1),
(4558, 'Gokavaram', 504, '28', 1),
(4559, 'Jaggampeta', 504, '28', 1),
(4560, 'Kirlampudi', 504, '28', 1),
(4561, 'Prathipadu', 504, '28', 1),
(4562, 'Thondangi', 504, '28', 1),
(4563, 'Gollaprolu', 504, '28', 1),
(4564, 'Peddapuram', 504, '28', 1),
(4565, 'Gandepalle', 504, '28', 1),
(4566, 'Korukonda', 504, '28', 1),
(4567, 'Rajahmundry (U)', 504, '28', 1),
(4568, 'Rajahmundry Rural', 504, '28', 1),
(4569, 'Rajanagaram', 504, '28', 1),
(4570, 'Rangampeta', 504, '28', 1),
(4571, 'Samalkota', 504, '28', 1),
(4572, 'Pithapuram', 504, '28', 1),
(4573, 'Kothapalle', 504, '28', 1),
(4574, 'Kakinada Rural', 504, '28', 1),
(4575, 'Kakinada (U)', 504, '28', 1),
(4576, 'Pedapudi', 504, '28', 1),
(4577, 'Biccavolu', 504, '28', 1),
(4578, 'Anaparthy', 504, '28', 1),
(4579, 'Kadiam', 504, '28', 1),
(4580, 'Atreyapuram', 504, '28', 1),
(4581, 'Mandapeta', 504, '28', 1),
(4582, 'Rayavaram', 504, '28', 1),
(4583, 'Karapa', 504, '28', 1),
(4584, 'Kajuluru', 504, '28', 1),
(4585, 'Ramachandrapuram', 504, '28', 1),
(4586, 'Alamuru', 504, '28', 1),
(4587, 'Ravulapalem', 504, '28', 1),
(4588, 'Kothapeta', 504, '28', 1),
(4589, 'Kapileswarapuram', 504, '28', 1),
(4590, 'Pamarru', 504, '28', 1),
(4591, 'Thallarevu', 504, '28', 1),
(4592, 'I. Polavaram', 504, '28', 1),
(4593, 'Mummidivaram', 504, '28', 1),
(4594, 'Ainavilli', 504, '28', 1),
(4595, 'P.Gannavaram', 504, '28', 1),
(4596, 'Ambajipeta', 504, '28', 1),
(4597, 'Mamidikuduru', 504, '28', 1),
(4598, 'Razole', 504, '28', 1),
(4599, 'Malikipuram', 504, '28', 1),
(4600, 'Sakhinetipalle', 504, '28', 1),
(4601, 'Allavaram', 504, '28', 1),
(4602, 'Amalapuram', 504, '28', 1),
(4603, 'Uppalaguptam', 504, '28', 1),
(4604, 'Katrenikona', 504, '28', 1),
(4605, 'Chintalapudi', 505, '28', 1),
(4606, 'Lingapalem', 505, '28', 1),
(4607, 'T.Narasapuram', 505, '28', 1),
(4608, 'Jeelugu milli', 505, '28', 1),
(4609, 'Buttayagudem', 505, '28', 1),
(4610, 'Polavaram', 505, '28', 1),
(4611, 'Tallapudi', 505, '28', 1),
(4612, 'Gopalapuram', 505, '28', 1),
(4613, 'Koyyalagudem', 505, '28', 1),
(4614, 'Jangareddigudem', 505, '28', 1),
(4615, 'Kamavarapukota', 505, '28', 1),
(4616, 'Dwarakatirumala', 505, '28', 1),
(4617, 'Nallajerla', 505, '28', 1),
(4618, 'Devarapalle', 505, '28', 1),
(4619, 'Kovvur', 505, '28', 1),
(4620, 'Chagallu', 505, '28', 1),
(4621, 'Nidadavole', 505, '28', 1),
(4622, 'Tadepalligudem', 505, '28', 1),
(4623, 'Unguturu', 505, '28', 1),
(4624, 'Bhimadole', 505, '28', 1),
(4625, 'Pedavegi', 505, '28', 1),
(4626, 'Pedapadu', 505, '28', 1),
(4627, 'Eluru', 505, '28', 1),
(4628, 'Denduluru', 505, '28', 1),
(4629, 'Nidamarru', 505, '28', 1),
(4630, 'Pentapadu', 505, '28', 1),
(4631, 'Undrajavaram', 505, '28', 1),
(4632, 'Peravali', 505, '28', 1),
(4633, 'Tanuku', 505, '28', 1),
(4634, 'Attili', 505, '28', 1),
(4635, 'Ganapavaram', 505, '28', 1),
(4636, 'Akividu', 505, '28', 1),
(4637, 'Undi', 505, '28', 1),
(4638, 'Palacoderu', 505, '28', 1),
(4639, 'Penumantra', 505, '28', 1),
(4640, 'Iragavaram', 505, '28', 1),
(4641, 'Penugonda', 505, '28', 1),
(4642, 'Achanta', 505, '28', 1),
(4643, 'Poduru', 505, '28', 1),
(4644, 'Veeravasaram', 505, '28', 1),
(4645, 'Bhimavaram', 505, '28', 1),
(4646, 'Kalla', 505, '28', 1),
(4647, 'Mogaltur', 505, '28', 1),
(4648, 'Narsapur', 505, '28', 1),
(4649, 'Palacole', 505, '28', 1),
(4650, 'Elamanchili', 505, '28', 1),
(4651, 'Vatsavai', 506, '28', 1),
(4652, 'Jaggayyapeta', 506, '28', 1),
(4653, 'Penuganchiprolu', 506, '28', 1),
(4654, 'Nandigama', 506, '28', 1),
(4655, 'Veerullapadu', 506, '28', 1);
INSERT INTO `tbl_city` (`city_id`, `city_name`, `district_id`, `state_id`, `country_id`) VALUES
(4656, 'Mylavaram', 506, '28', 1),
(4657, 'Gampalagudem', 506, '28', 1),
(4658, 'Tiruvuru', 506, '28', 1),
(4659, 'A.Konduru', 506, '28', 1),
(4660, 'Reddigudem', 506, '28', 1),
(4661, 'Vissannapeta', 506, '28', 1),
(4662, 'Chatrai', 506, '28', 1),
(4663, 'Musunuru', 506, '28', 1),
(4664, 'Nuzvid', 506, '28', 1),
(4665, 'Bapulapadu', 506, '28', 1),
(4666, 'Agiripalle', 506, '28', 1),
(4667, 'G.Konduru', 506, '28', 1),
(4668, 'Kanchikacherla', 506, '28', 1),
(4669, 'Chandarlapadu', 506, '28', 1),
(4670, 'Ibrahimpatnam', 506, '28', 1),
(4671, 'Vijayawada (Urban)', 506, '28', 1),
(4672, 'Vijayawada (Rural)', 506, '28', 1),
(4673, 'Gannavaram', 506, '28', 1),
(4674, 'Unguturu', 506, '28', 1),
(4675, 'Nandivada', 506, '28', 1),
(4676, 'Mandavalli', 506, '28', 1),
(4677, 'Kaikalur', 506, '28', 1),
(4678, 'Kalidindi', 506, '28', 1),
(4679, 'Kruthivennu', 506, '28', 1),
(4680, 'Bantumilli', 506, '28', 1),
(4681, 'Mudinepalle', 506, '28', 1),
(4682, 'Gudivada', 506, '28', 1),
(4683, 'Pedaparupudi', 506, '28', 1),
(4684, 'Kankipadu', 506, '28', 1),
(4685, 'Penamaluru', 506, '28', 1),
(4686, 'Thotlavalluru', 506, '28', 1),
(4687, 'Pamidimukkala', 506, '28', 1),
(4688, 'Vuyyuru', 506, '28', 1),
(4689, 'Pamarru', 506, '28', 1),
(4690, 'Gudlavalleru', 506, '28', 1),
(4691, 'Pedana', 506, '28', 1),
(4692, 'Guduru', 506, '28', 1),
(4693, 'Movva', 506, '28', 1),
(4694, 'Ghantasala', 506, '28', 1),
(4695, 'Machilipatnam', 506, '28', 1),
(4696, 'Challapalle', 506, '28', 1),
(4697, 'Mopidevi', 506, '28', 1),
(4698, 'Avanigadda', 506, '28', 1),
(4699, 'Nagayalanka', 506, '28', 1),
(4700, 'Koduru', 506, '28', 1),
(4701, 'Macherla', 507, '28', 1),
(4702, 'Veldurthy', 507, '28', 1),
(4703, 'Durgi', 507, '28', 1),
(4704, 'Rentachintala', 507, '28', 1),
(4705, 'Gurazala', 507, '28', 1),
(4706, 'Dachepalle', 507, '28', 1),
(4707, 'Karempudi', 507, '28', 1),
(4708, 'Piduguralla', 507, '28', 1),
(4709, 'Machavaram', 507, '28', 1),
(4710, 'Bellamkonda', 507, '28', 1),
(4711, 'Atchampet', 507, '28', 1),
(4712, 'Krosuru', 507, '28', 1),
(4713, 'Amaravathi', 507, '28', 1),
(4714, 'Thullur', 507, '28', 1),
(4715, 'Tadepalle', 507, '28', 1),
(4716, 'Mangalagiri', 507, '28', 1),
(4717, 'Tadikonda', 507, '28', 1),
(4718, 'Pedakurapadu', 507, '28', 1),
(4719, 'Sattenapalle', 507, '28', 1),
(4720, 'Rajupalem', 507, '28', 1),
(4721, 'Nekarikallu', 507, '28', 1),
(4722, 'Bollapalle', 507, '28', 1),
(4723, 'Vinukonda', 507, '28', 1),
(4724, 'Nuzendla', 507, '28', 1),
(4725, 'Savalyapuram Kanumarlapudi', 507, '28', 1),
(4726, 'Ipur', 507, '28', 1),
(4727, 'Rompicherla', 507, '28', 1),
(4728, 'Narasaraopeta', 507, '28', 1),
(4729, 'Muppalla', 507, '28', 1),
(4730, 'Nadendla', 507, '28', 1),
(4731, 'Chilakaluripet H/o.Purushotha Patnam', 507, '28', 1),
(4732, 'Edlapadu', 507, '28', 1),
(4733, 'Phirangipuram', 507, '28', 1),
(4734, 'Medikonduru', 507, '28', 1),
(4735, 'Guntur', 507, '28', 1),
(4736, 'Pedakakani', 507, '28', 1),
(4737, 'Duggirala', 507, '28', 1),
(4738, 'Kollipara', 507, '28', 1),
(4739, 'Tenali', 507, '28', 1),
(4740, 'Chebrolu', 507, '28', 1),
(4741, 'Vatticherukuru', 507, '28', 1),
(4742, 'Prathipadu', 507, '28', 1),
(4743, 'Pedanandipadu', 507, '28', 1),
(4744, 'Kakumanu', 507, '28', 1),
(4745, 'Ponnur', 507, '28', 1),
(4746, 'Tsundur', 507, '28', 1),
(4747, 'Amruthalur', 507, '28', 1),
(4748, 'Vemuru', 507, '28', 1),
(4749, 'Kollur', 507, '28', 1),
(4750, 'Bhattiprolu', 507, '28', 1),
(4751, 'Cherukupalle H/o Arumbaka', 507, '28', 1),
(4752, 'Pittalavanipalem', 507, '28', 1),
(4753, 'Karlapalem', 507, '28', 1),
(4754, 'Bapatla', 507, '28', 1),
(4755, 'Nizampatnam', 507, '28', 1),
(4756, 'Nagaram', 507, '28', 1),
(4757, 'Repalle', 507, '28', 1),
(4758, 'Yerragondapalem', 508, '28', 1),
(4759, 'Pullalacheruvu', 508, '28', 1),
(4760, 'Tripuranthakam', 508, '28', 1),
(4761, 'Dornala', 508, '28', 1),
(4762, 'Pedda Raveedu', 508, '28', 1),
(4763, 'Donakonda', 508, '28', 1),
(4764, 'Kurichedu', 508, '28', 1),
(4765, 'Santhamaguluru', 508, '28', 1),
(4766, 'Ballikurava', 508, '28', 1),
(4767, 'Martur', 508, '28', 1),
(4768, 'Yeddana pudi', 508, '28', 1),
(4769, 'Parchur', 508, '28', 1),
(4770, 'Karamchedu', 508, '28', 1),
(4771, 'Inkollu', 508, '28', 1),
(4772, 'Janakavarampanguluru', 508, '28', 1),
(4773, 'Addanki', 508, '28', 1),
(4774, 'Mundlamuru', 508, '28', 1),
(4775, 'Darsi', 508, '28', 1),
(4776, 'Markapur', 508, '28', 1),
(4777, 'Ardhaveedu', 508, '28', 1),
(4778, 'Cumbum', 508, '28', 1),
(4779, 'Tarlupadu', 508, '28', 1),
(4780, 'Konakanamitla', 508, '28', 1),
(4781, 'Podili', 508, '28', 1),
(4782, 'Thallur', 508, '28', 1),
(4783, 'Korisapadu', 508, '28', 1),
(4784, 'Chirala', 508, '28', 1),
(4785, 'Vetapalem', 508, '28', 1),
(4786, 'Chinaganjam', 508, '28', 1),
(4787, 'Naguluppala padu', 508, '28', 1),
(4788, 'Maddipadu', 508, '28', 1),
(4789, 'Chimakurthy', 508, '28', 1),
(4790, 'Marripudi', 508, '28', 1),
(4791, 'Hanumanthuni padu', 508, '28', 1),
(4792, 'Bestavaripeta', 508, '28', 1),
(4793, 'Racherla', 508, '28', 1),
(4794, 'Giddaluru', 508, '28', 1),
(4795, 'Komarolu', 508, '28', 1),
(4796, 'Veligandla', 508, '28', 1),
(4797, 'Kanigiri', 508, '28', 1),
(4798, 'Kondapi', 508, '28', 1),
(4799, 'Santhanuthala padu', 508, '28', 1),
(4800, 'Ongole', 508, '28', 1),
(4801, 'Kotha patnam', 508, '28', 1),
(4802, 'Tangutur', 508, '28', 1),
(4803, 'Zarugumilli', 508, '28', 1),
(4804, 'Ponnaluru', 508, '28', 1),
(4805, 'Pedacherlo palle', 508, '28', 1),
(4806, 'Chandra sekhara puram', 508, '28', 1),
(4807, 'Pamur', 508, '28', 1),
(4808, 'Voletivaripalem', 508, '28', 1),
(4809, 'Kandukur', 508, '28', 1),
(4810, 'Singarayakonda', 508, '28', 1),
(4811, 'Lingasamudram', 508, '28', 1),
(4812, 'Gudlur', 508, '28', 1),
(4813, 'Ulavapadu', 508, '28', 1),
(4814, 'Seetharamapuram', 509, '28', 1),
(4815, 'Udayagiri', 509, '28', 1),
(4816, 'Varikuntapadu', 509, '28', 1),
(4817, 'Kondapuram', 509, '28', 1),
(4818, 'Jaladanki', 509, '28', 1),
(4819, 'Kavali', 509, '28', 1),
(4820, 'Bogole', 509, '28', 1),
(4821, 'Kaligiri', 509, '28', 1),
(4822, 'Vinjamur', 509, '28', 1),
(4823, 'Duttalur', 509, '28', 1),
(4824, 'Marripadu', 509, '28', 1),
(4825, 'Atmakur', 509, '28', 1),
(4826, 'Anumasamudrampeta', 509, '28', 1),
(4827, 'Dagadarthi', 509, '28', 1),
(4828, 'Allur', 509, '28', 1),
(4829, 'Vidavalur', 509, '28', 1),
(4830, 'Kodavalur', 509, '28', 1),
(4831, 'Buchireddipalem', 509, '28', 1),
(4832, 'Sangam', 509, '28', 1),
(4833, 'Chejerla', 509, '28', 1),
(4834, 'Ananthasagaram', 509, '28', 1),
(4835, 'Kaluvoya', 509, '28', 1),
(4836, 'Rapur', 509, '28', 1),
(4837, 'Podalakur', 509, '28', 1),
(4838, 'Nellore', 509, '28', 1),
(4839, 'Kovur', 509, '28', 1),
(4840, 'Indukurpet', 509, '28', 1),
(4841, 'Thotapalligudur', 509, '28', 1),
(4842, 'Muthukur', 509, '28', 1),
(4843, 'Venkatachalam', 509, '28', 1),
(4844, 'Manubolu', 509, '28', 1),
(4845, 'Gudur', 509, '28', 1),
(4846, 'Sydapuram', 509, '28', 1),
(4847, 'Dakkili', 509, '28', 1),
(4848, 'Venkatagiri', 509, '28', 1),
(4849, 'Balayapalle', 509, '28', 1),
(4850, 'Ozili', 509, '28', 1),
(4851, 'Chillakur', 509, '28', 1),
(4852, 'Kota', 509, '28', 1),
(4853, 'Vakadu', 509, '28', 1),
(4854, 'Chittamur', 509, '28', 1),
(4855, 'Naidupet', 509, '28', 1),
(4856, 'Pellakur', 509, '28', 1),
(4857, 'Doravarisatram', 509, '28', 1),
(4858, 'Sullurpeta', 509, '28', 1),
(4859, 'Tada', 509, '28', 1),
(4860, 'Kondapuram', 510, '28', 1),
(4861, 'Mylavaram', 510, '28', 1),
(4862, 'Peddamudium', 510, '28', 1),
(4863, 'Rajupalem', 510, '28', 1),
(4864, 'Duvvur', 510, '28', 1),
(4865, 'S.Mydukur', 510, '28', 1),
(4866, 'Brahmamgarimattam', 510, '28', 1),
(4867, 'Sri Avadhuth kasinayana', 510, '28', 1),
(4868, 'Kalasapadu', 510, '28', 1),
(4869, 'Porumamilla', 510, '28', 1),
(4870, 'B.Kodur', 510, '28', 1),
(4871, 'Badvel', 510, '28', 1),
(4872, 'Gopavaram', 510, '28', 1),
(4873, 'Khajipet', 510, '28', 1),
(4874, 'Chapadu', 510, '28', 1),
(4875, 'Proddatur', 510, '28', 1),
(4876, 'Jammalamadugu', 510, '28', 1),
(4877, 'Muddanur', 510, '28', 1),
(4878, 'Simhadripuram', 510, '28', 1),
(4879, 'Lingala', 510, '28', 1),
(4880, 'Pulivendla', 510, '28', 1),
(4881, 'Vemula', 510, '28', 1),
(4882, 'Thondur', 510, '28', 1),
(4883, 'Veerapunayunipalle', 510, '28', 1),
(4884, 'Yerraguntla', 510, '28', 1),
(4885, 'Kamalapuram', 510, '28', 1),
(4886, 'Vallur', 510, '28', 1),
(4887, 'Chennur', 510, '28', 1),
(4888, 'Atlur', 510, '28', 1),
(4889, 'Vontimitta', 510, '28', 1),
(4890, 'Sidhout', 510, '28', 1),
(4891, 'Cuddapah', 510, '28', 1),
(4892, 'Chinthakommadinne', 510, '28', 1),
(4893, 'Pendlimarry', 510, '28', 1),
(4894, 'Vempalle', 510, '28', 1),
(4895, 'Chakarayapet', 510, '28', 1),
(4896, 'Galiveedu', 510, '28', 1),
(4897, 'Chinnamudiam', 510, '28', 1),
(4898, 'Sambepalle', 510, '28', 1),
(4899, 'T.Sundupalle', 510, '28', 1),
(4900, 'Rayachoti', 510, '28', 1),
(4901, 'Lakkireddipalle', 510, '28', 1),
(4902, 'Ramapuram', 510, '28', 1),
(4903, 'Veeraballe', 510, '28', 1),
(4904, 'Nandalur', 510, '28', 1),
(4905, 'Penagalur', 510, '28', 1),
(4906, 'Chitvel', 510, '28', 1),
(4907, 'Rajampet', 510, '28', 1),
(4908, 'Pullampet', 510, '28', 1),
(4909, 'Obulavaripalle', 510, '28', 1),
(4910, 'Rly.kodur', 510, '28', 1),
(4911, 'Mantralayam', 511, '28', 1),
(4912, 'Kosigi', 511, '28', 1),
(4913, 'Kowthalam', 511, '28', 1),
(4914, 'Pedda kadabur', 511, '28', 1),
(4915, 'Yemmiganur', 511, '28', 1),
(4916, 'Nandavaram', 511, '28', 1),
(4917, 'C.Belagal', 511, '28', 1),
(4918, 'Gudur', 511, '28', 1),
(4919, 'Kallur', 511, '28', 1),
(4920, 'Kurnool', 511, '28', 1),
(4921, 'Nandikotkur', 511, '28', 1),
(4922, 'Pagidyala', 511, '28', 1),
(4923, 'Jupadu bungalow', 511, '28', 1),
(4924, 'Kothapalle', 511, '28', 1),
(4925, 'Srisailam', 511, '28', 1),
(4926, 'Atmakur', 511, '28', 1),
(4927, 'Pamulapadu', 511, '28', 1),
(4928, 'Midthur', 511, '28', 1),
(4929, 'Orvakal', 511, '28', 1),
(4930, 'Kodumur', 511, '28', 1),
(4931, 'Gonegandla', 511, '28', 1),
(4932, 'Adoni', 511, '28', 1),
(4933, 'Holagunda', 511, '28', 1),
(4934, 'Halaharvi', 511, '28', 1),
(4935, 'Alur', 511, '28', 1),
(4936, 'Aspari', 511, '28', 1),
(4937, 'Devanakonda', 511, '28', 1),
(4938, 'Krishnagiri', 511, '28', 1),
(4939, 'Veldurthi', 511, '28', 1),
(4940, 'Bethamcherla', 511, '28', 1),
(4941, 'Panyam', 511, '28', 1),
(4942, 'Gadivemula', 511, '28', 1),
(4943, 'Velgode', 511, '28', 1),
(4944, 'Bandi Atmakur', 511, '28', 1),
(4945, 'Nandyal', 511, '28', 1),
(4946, 'Mahanandi', 511, '28', 1),
(4947, 'Sirvel', 511, '28', 1),
(4948, 'Gospadu', 511, '28', 1),
(4949, 'Banaganapalle', 511, '28', 1),
(4950, 'Dhone', 511, '28', 1),
(4951, 'Pathikonda', 511, '28', 1),
(4952, 'Chippagiri', 511, '28', 1),
(4953, 'Maddikera (East)', 511, '28', 1),
(4954, 'Tuggali', 511, '28', 1),
(4955, 'Peapally', 511, '28', 1),
(4956, 'Owk', 511, '28', 1),
(4957, 'Koilkuntla', 511, '28', 1),
(4958, 'Rudravaram', 511, '28', 1),
(4959, 'Allagadda', 511, '28', 1),
(4960, 'Dornipadu', 511, '28', 1),
(4961, 'Sanjamala', 511, '28', 1),
(4962, 'Kolimigundla', 511, '28', 1),
(4963, 'Uyyalawada', 511, '28', 1),
(4964, 'Chagalamarri', 511, '28', 1),
(4965, 'D.Hirehal', 512, '28', 1),
(4966, 'Rayadurg', 512, '28', 1),
(4967, 'Kanekal', 512, '28', 1),
(4968, 'Bommanahal', 512, '28', 1),
(4969, 'Vidapanakal', 512, '28', 1),
(4970, 'Guntakal', 512, '28', 1),
(4971, 'Gooty', 512, '28', 1),
(4972, 'Peddavadugur', 512, '28', 1),
(4973, 'Yadiki', 512, '28', 1),
(4974, 'Tadpatri', 512, '28', 1),
(4975, 'Peddapappur', 512, '28', 1),
(4976, 'Pamidi', 512, '28', 1),
(4977, 'Vijrakarur', 512, '28', 1),
(4978, 'Uravakonda', 512, '28', 1),
(4979, 'Beluguppa', 512, '28', 1),
(4980, 'Gummagatta', 512, '28', 1),
(4981, 'Brahmasamudram', 512, '28', 1),
(4982, 'Kalyandurg', 512, '28', 1),
(4983, 'Atmakur', 512, '28', 1),
(4984, 'Kudair', 512, '28', 1),
(4985, 'Garladinne', 512, '28', 1),
(4986, 'Singanamala', 512, '28', 1),
(4987, 'Putlur', 512, '28', 1),
(4988, 'Yellanur', 512, '28', 1),
(4989, 'Narpala', 512, '28', 1),
(4990, 'Bukkarayasamudram', 512, '28', 1),
(4991, 'Anantapur', 512, '28', 1),
(4992, 'Raptadu', 512, '28', 1),
(4993, 'Settur', 512, '28', 1),
(4994, 'Kundurpi', 512, '28', 1),
(4995, 'Kambadur', 512, '28', 1),
(4996, 'Kanaganapalle', 512, '28', 1),
(4997, 'Dharmavaram', 512, '28', 1),
(4998, 'Bathalapalle', 512, '28', 1),
(4999, 'Tadimarri', 512, '28', 1),
(5000, 'Mudigubba', 512, '28', 1),
(5001, 'Talupula', 512, '28', 1),
(5002, 'Nambulapulakunta', 512, '28', 1),
(5003, 'Gandlapenta', 512, '28', 1),
(5004, 'Kadiri', 512, '28', 1),
(5005, 'Nallamada', 512, '28', 1),
(5006, 'Bukkapatnam', 512, '28', 1),
(5007, 'Kothacheruvu', 512, '28', 1),
(5008, 'Chennekothapalle', 512, '28', 1),
(5009, 'Ramagiri', 512, '28', 1),
(5010, 'Roddam', 512, '28', 1),
(5011, 'Madakasira', 512, '28', 1),
(5012, 'Amarapuram', 512, '28', 1),
(5013, 'Gudibanda', 512, '28', 1),
(5014, 'Rolla', 512, '28', 1),
(5015, 'Agali', 512, '28', 1),
(5016, 'Parigi', 512, '28', 1),
(5017, 'Penukonda', 512, '28', 1),
(5018, 'Puttaparthi', 512, '28', 1),
(5019, 'Obuladevarecheruvu', 512, '28', 1),
(5020, 'Nallacheruvu', 512, '28', 1),
(5021, 'Tanakallu', 512, '28', 1),
(5022, 'Amadagur', 512, '28', 1),
(5023, 'Gorantla', 512, '28', 1),
(5024, 'Somandepalle', 512, '28', 1),
(5025, 'Hindupur', 512, '28', 1),
(5026, 'Lepakshi', 512, '28', 1),
(5027, 'Chilamathur', 512, '28', 1),
(5028, 'Mulakalacheruvu', 513, '28', 1),
(5029, 'Thamballapalle', 513, '28', 1),
(5030, 'Peddamandyam', 513, '28', 1),
(5031, 'Gurramkonda', 513, '28', 1),
(5032, 'Kalakada', 513, '28', 1),
(5033, 'Kambhamvaripalle', 513, '28', 1),
(5034, 'Rompicherla', 513, '28', 1),
(5035, 'Yerravaripalem', 513, '28', 1),
(5036, 'Tirupathi (Rural)', 513, '28', 1),
(5037, 'Renigunta', 513, '28', 1),
(5038, 'Yerpedu', 513, '28', 1),
(5039, 'Srikalahasti', 513, '28', 1),
(5040, 'Thottambedu', 513, '28', 1),
(5041, 'Buchinaidu Khandriga', 513, '28', 1),
(5042, 'Varadaiahpalem', 513, '28', 1),
(5043, 'K.V.B.Puram', 513, '28', 1),
(5044, 'Tirupati (Urban)', 513, '28', 1),
(5045, 'Chandragiri', 513, '28', 1),
(5046, 'Chinnagottigallu', 513, '28', 1),
(5047, 'Piler', 513, '28', 1),
(5048, 'Kalikiri', 513, '28', 1),
(5049, 'Vayalpad', 513, '28', 1),
(5050, 'Kurabalakota', 513, '28', 1),
(5051, 'Peddathippa samudram', 513, '28', 1),
(5052, 'B.Kothakota', 513, '28', 1),
(5053, 'Madanapalle', 513, '28', 1),
(5054, 'Nimmanapalle', 513, '28', 1),
(5055, 'Sodum', 513, '28', 1),
(5056, 'Pulicherla', 513, '28', 1),
(5057, 'Pakala', 513, '28', 1),
(5058, 'Vedurukuppam', 513, '28', 1),
(5059, 'Ramachandra puram', 513, '28', 1),
(5060, 'Vadamalapeta', 513, '28', 1),
(5061, 'Narayanavanam', 513, '28', 1),
(5062, 'Pitchatur', 513, '28', 1),
(5063, 'Satyavedu', 513, '28', 1),
(5064, 'Nagalapuram', 513, '28', 1),
(5065, 'Nindra', 513, '28', 1),
(5066, 'Vijayapuram', 513, '28', 1),
(5067, 'Nagari', 513, '28', 1),
(5068, 'Puttur', 513, '28', 1),
(5069, 'Karvetinagar', 513, '28', 1),
(5070, 'Penumur', 513, '28', 1),
(5071, 'Puthalapattu', 513, '28', 1),
(5072, 'Irala', 513, '28', 1),
(5073, 'Somala', 513, '28', 1),
(5074, 'Chowdepalle', 513, '28', 1),
(5075, 'Ramasamudram', 513, '28', 1),
(5076, 'Punganur', 513, '28', 1),
(5077, 'Peddapanjani', 513, '28', 1),
(5078, 'Gangavaram', 513, '28', 1),
(5079, 'Thavanampalle', 513, '28', 1),
(5080, 'Srirangarajapuram', 513, '28', 1),
(5081, 'Gangadhara Nellore', 513, '28', 1),
(5082, 'Chittoor', 513, '28', 1),
(5083, 'Palamaner', 513, '28', 1),
(5084, 'Baireddipalle', 513, '28', 1),
(5085, 'Venkatagirikota', 513, '28', 1),
(5086, 'Santhipuram', 513, '28', 1),
(5087, 'Gudupalle', 513, '28', 1),
(5088, 'Kuppam', 513, '28', 1),
(5089, 'Ramakuppam', 513, '28', 1),
(5090, 'Bangarupalyam', 513, '28', 1),
(5091, 'Yadamari', 513, '28', 1),
(5092, 'Gudipala', 513, '28', 1),
(5093, 'Palasamudram', 513, '28', 1),
(5094, 'Chikodi', 514, '29', 1),
(5095, 'Athni', 514, '29', 1),
(5096, 'Raybag', 514, '29', 1),
(5097, 'Gokak', 514, '29', 1),
(5098, 'Hukeri', 514, '29', 1),
(5099, 'Belgaum', 514, '29', 1),
(5100, 'Khanapur', 514, '29', 1),
(5101, 'Sampgaon', 514, '29', 1),
(5102, 'Parasgad', 514, '29', 1),
(5103, 'Ramdurg', 514, '29', 1),
(5104, 'Jamkhandi', 515, '29', 1),
(5105, 'Bilgi', 515, '29', 1),
(5106, 'Mudhol', 515, '29', 1),
(5107, 'Badami', 515, '29', 1),
(5108, 'Bagalkot', 515, '29', 1),
(5109, 'Hungund', 515, '29', 1),
(5110, 'Bijapur', 516, '29', 1),
(5111, 'Indi', 516, '29', 1),
(5112, 'Sindgi', 516, '29', 1),
(5113, 'Basavana Bagevadi', 516, '29', 1),
(5114, 'Muddebihal', 516, '29', 1),
(5115, 'Aland', 517, '29', 1),
(5116, 'Afzalpur', 517, '29', 1),
(5117, 'Gulbarga', 517, '29', 1),
(5118, 'Chincholi', 517, '29', 1),
(5119, 'Sedam', 517, '29', 1),
(5120, 'Chitapur', 517, '29', 1),
(5121, 'Jevargi', 517, '29', 1),
(5122, 'Shahpur', 517, '29', 1),
(5123, 'Shorapur', 517, '29', 1),
(5124, 'Yadgir', 517, '29', 1),
(5125, 'Basavakalyan', 518, '29', 1),
(5126, 'Aurad', 518, '29', 1),
(5127, 'Bhalki', 518, '29', 1),
(5128, 'Bidar', 518, '29', 1),
(5129, 'Homnabad', 518, '29', 1),
(5130, 'Lingsugur', 519, '29', 1),
(5131, 'Devadurga', 519, '29', 1),
(5132, 'Raichur', 519, '29', 1),
(5133, 'Manvi', 519, '29', 1),
(5134, 'Sindhnur', 519, '29', 1),
(5135, 'Yelbarga', 520, '29', 1),
(5136, 'Kushtagi', 520, '29', 1),
(5137, 'Gangawati', 520, '29', 1),
(5138, 'Koppal', 520, '29', 1),
(5139, 'Nargund', 521, '29', 1),
(5140, 'Ron', 521, '29', 1),
(5141, 'Gadag', 521, '29', 1),
(5142, 'Shirhatti', 521, '29', 1),
(5143, 'Mundargi', 521, '29', 1),
(5144, 'Dharwad', 522, '29', 1),
(5145, 'Navalgund', 522, '29', 1),
(5146, 'Hubli', 522, '29', 1),
(5147, 'Kalghatgi', 522, '29', 1),
(5148, 'Kundgol', 522, '29', 1),
(5149, 'Karwar', 523, '29', 1),
(5150, 'Supa', 523, '29', 1),
(5151, 'Haliyal', 523, '29', 1),
(5152, 'Yellapur', 523, '29', 1),
(5153, 'Mundgod', 523, '29', 1),
(5154, 'Sirsi', 523, '29', 1),
(5155, 'Ankola', 523, '29', 1),
(5156, 'Kumta', 523, '29', 1),
(5157, 'Siddapur', 523, '29', 1),
(5158, 'Honavar', 523, '29', 1),
(5159, 'Bhatkal', 523, '29', 1),
(5160, 'Shiggaon', 524, '29', 1),
(5161, 'Savanur', 524, '29', 1),
(5162, 'Hangal', 524, '29', 1),
(5163, 'Haveri', 524, '29', 1),
(5164, 'Byadgi', 524, '29', 1),
(5165, 'Hirekerur', 524, '29', 1),
(5166, 'Ranibennur', 524, '29', 1),
(5167, 'Hadagalli', 525, '29', 1),
(5168, 'Hagaribommanahalli', 525, '29', 1),
(5169, 'Hospet', 525, '29', 1),
(5170, 'Siruguppa', 525, '29', 1),
(5171, 'Bellary', 525, '29', 1),
(5172, 'Sandur', 525, '29', 1),
(5173, 'Kudligi', 525, '29', 1),
(5174, 'Molakalmuru', 526, '29', 1),
(5175, 'Challakere', 526, '29', 1),
(5176, 'Chitradurga', 526, '29', 1),
(5177, 'Holalkere', 526, '29', 1),
(5178, 'Hosdurga', 526, '29', 1),
(5179, 'Hiriyur', 526, '29', 1),
(5180, 'Harihar', 527, '29', 1),
(5181, 'Harapanahalli', 527, '29', 1),
(5182, 'Jagalur', 527, '29', 1),
(5183, 'Davanagere', 527, '29', 1),
(5184, 'Honnali', 527, '29', 1),
(5185, 'Channagiri', 527, '29', 1),
(5186, 'Sagar', 528, '29', 1),
(5187, 'Sorab', 528, '29', 1),
(5188, 'Shikarpur', 528, '29', 1),
(5189, 'Hosanagara', 528, '29', 1),
(5190, 'Tirthahalli', 528, '29', 1),
(5191, 'Shimoga', 528, '29', 1),
(5192, 'Bhadravati', 528, '29', 1),
(5193, 'Kundapura', 529, '29', 1),
(5194, 'Udupi', 529, '29', 1),
(5195, 'Karkal', 529, '29', 1),
(5196, 'Sringeri', 530, '29', 1),
(5197, 'Koppa', 530, '29', 1),
(5198, 'Narasimharajapura', 530, '29', 1),
(5199, 'Tarikere', 530, '29', 1),
(5200, 'Kadur', 530, '29', 1),
(5201, 'Chikmagalur', 530, '29', 1),
(5202, 'Mudigere', 530, '29', 1),
(5203, 'Chiknayakanhalli', 531, '29', 1),
(5204, 'Sira', 531, '29', 1),
(5205, 'Pavagada', 531, '29', 1),
(5206, 'Madhugiri', 531, '29', 1),
(5207, 'Koratagere', 531, '29', 1),
(5208, 'Tumkur', 531, '29', 1),
(5209, 'Gubbi', 531, '29', 1),
(5210, 'Tiptur', 531, '29', 1),
(5211, 'Turuvekere', 531, '29', 1),
(5212, 'Kunigal', 531, '29', 1),
(5213, 'Gauribidanur', 532, '29', 1),
(5214, 'Chik Ballapur', 532, '29', 1),
(5215, 'Gudibanda', 532, '29', 1),
(5216, 'Bagepalli', 532, '29', 1),
(5217, 'Sidlaghatta', 532, '29', 1),
(5218, 'Chintamani', 532, '29', 1),
(5219, 'Srinivaspur', 532, '29', 1),
(5220, 'Kolar', 532, '29', 1),
(5221, 'Malur', 532, '29', 1),
(5222, 'Bangarapet', 532, '29', 1),
(5223, 'Mulbagal', 532, '29', 1),
(5224, 'Bangalore North', 533, '29', 1),
(5225, 'Bangalore South', 533, '29', 1),
(5226, 'Anekal', 533, '29', 1),
(5227, 'Nelamangala', 534, '29', 1),
(5228, 'Dod Ballapur', 534, '29', 1),
(5229, 'Devanhalli', 534, '29', 1),
(5230, 'Hoskote', 534, '29', 1),
(5231, 'Magadi', 534, '29', 1),
(5232, 'Ramanagaram', 534, '29', 1),
(5233, 'Channapatna', 534, '29', 1),
(5234, 'Kanakapura', 534, '29', 1),
(5235, 'Krishnarajpet', 535, '29', 1),
(5236, 'Nagamangala', 535, '29', 1),
(5237, 'Pandavapura', 535, '29', 1),
(5238, 'Shrirangapattana', 535, '29', 1),
(5239, 'Mandya', 535, '29', 1),
(5240, 'Maddur', 535, '29', 1),
(5241, 'Malavalli', 535, '29', 1),
(5242, 'Sakleshpur', 536, '29', 1),
(5243, 'Belur', 536, '29', 1),
(5244, 'Arsikere', 536, '29', 1),
(5245, 'Hassan', 536, '29', 1),
(5246, 'Alur', 536, '29', 1),
(5247, 'Arkalgud', 536, '29', 1),
(5248, 'Hole Narsipur', 536, '29', 1),
(5249, 'Channarayapatna', 536, '29', 1),
(5250, 'Mangalore', 537, '29', 1),
(5251, 'Bantval', 537, '29', 1),
(5252, 'Beltangadi', 537, '29', 1),
(5253, 'Puttur', 537, '29', 1),
(5254, 'Sulya', 537, '29', 1),
(5255, 'Madikeri', 538, '29', 1),
(5256, 'Somvarpet', 538, '29', 1),
(5257, 'Virajpet', 538, '29', 1),
(5258, 'Piriyapatna', 539, '29', 1),
(5259, 'Hunsur', 539, '29', 1),
(5260, 'Krishnarajanagara', 539, '29', 1),
(5261, 'Mysore', 539, '29', 1),
(5262, 'Heggadadevankote', 539, '29', 1),
(5263, 'Nanjangud', 539, '29', 1),
(5264, 'Tirumakudal Narsipur', 539, '29', 1),
(5265, 'Gundlupet', 540, '29', 1),
(5266, 'Chamarajanagar', 540, '29', 1),
(5267, 'Yelandur', 540, '29', 1),
(5268, 'Kollegal', 540, '29', 1),
(5269, 'Pernem', 541, '30', 1),
(5270, 'Bardez', 541, '30', 1),
(5271, 'Tiswadi', 541, '30', 1),
(5272, 'Bicholim', 541, '30', 1),
(5273, 'Satari', 541, '30', 1),
(5274, 'Ponda', 541, '30', 1),
(5275, 'Mormugao', 542, '30', 1),
(5276, 'Salcete', 542, '30', 1),
(5277, 'Quepem', 542, '30', 1),
(5278, 'Sanguem', 542, '30', 1),
(5279, 'Canacona', 542, '30', 1),
(5280, 'Amini', 543, '31', 1),
(5281, 'Kavaratti', 543, '31', 1),
(5282, 'Andrott', 543, '31', 1),
(5283, 'Minicoy', 543, '31', 1),
(5284, 'Kasaragod', 544, '32', 1),
(5285, 'Hosdurg', 544, '32', 1),
(5286, 'Taliparamba', 545, '32', 1),
(5287, 'Kannur', 545, '32', 1),
(5288, 'Thalassery', 545, '32', 1),
(5289, 'Mananthavady', 546, '32', 1),
(5290, 'Sulthanbathery', 546, '32', 1),
(5291, 'Vythiri', 546, '32', 1),
(5292, 'Vadakara', 547, '32', 1),
(5293, 'Quilandy', 547, '32', 1),
(5294, 'Kozhikode', 547, '32', 1),
(5295, 'Ernad', 548, '32', 1),
(5296, 'Nilambur', 548, '32', 1),
(5297, 'Perinthalmanna', 548, '32', 1),
(5298, 'Tirur', 548, '32', 1),
(5299, 'Tirurangadi', 548, '32', 1),
(5300, 'Ponnani', 548, '32', 1),
(5301, 'Ottappalam', 549, '32', 1),
(5302, 'Mannarkad', 549, '32', 1),
(5303, 'Palakkad', 549, '32', 1),
(5304, 'Chittur', 549, '32', 1),
(5305, 'Alathur', 549, '32', 1),
(5306, 'Talappilly', 550, '32', 1),
(5307, 'Chavakkad', 550, '32', 1),
(5308, 'Thrissur', 550, '32', 1),
(5309, 'Kodungallur', 550, '32', 1),
(5310, 'Mukundapuram', 550, '32', 1),
(5311, 'Kunnathunad', 551, '32', 1),
(5312, 'Aluva', 551, '32', 1),
(5313, 'Paravur', 551, '32', 1),
(5314, 'Kochi', 551, '32', 1),
(5315, 'Kanayannur', 551, '32', 1),
(5316, 'Muvattupuzha', 551, '32', 1),
(5317, 'Kothamangalam', 551, '32', 1),
(5318, 'Devikulam', 552, '32', 1),
(5319, 'Udumbanchola', 552, '32', 1),
(5320, 'Thodupuzha', 552, '32', 1),
(5321, 'Peerumade', 552, '32', 1),
(5322, 'Meenachil', 553, '32', 1),
(5323, 'Vaikom', 553, '32', 1),
(5324, 'Kottayam', 553, '32', 1),
(5325, 'Changanassery', 553, '32', 1),
(5326, 'Kanjirappally', 553, '32', 1),
(5327, 'Cherthala', 554, '32', 1),
(5328, 'Ambalappuzha', 554, '32', 1),
(5329, 'Kuttanad', 554, '32', 1),
(5330, 'Karthikappally', 554, '32', 1),
(5331, 'Chengannur', 554, '32', 1),
(5332, 'Mavelikkara', 554, '32', 1),
(5333, 'Thiruvalla', 555, '32', 1),
(5334, 'Mallappally', 555, '32', 1),
(5335, 'Ranni', 555, '32', 1),
(5336, 'Kozhenchery', 555, '32', 1),
(5337, 'Adoor', 555, '32', 1),
(5338, 'Karunagappally', 556, '32', 1),
(5339, 'Kunnathur', 556, '32', 1),
(5340, 'Pathanapuram', 556, '32', 1),
(5341, 'Kottarakkara', 556, '32', 1),
(5342, 'Kollam', 556, '32', 1),
(5343, 'Chirayinkeezhu', 557, '32', 1),
(5344, 'Nedumangad', 557, '32', 1),
(5345, 'Thiruvananthapuram', 557, '32', 1),
(5346, 'Neyyattinkara', 557, '32', 1),
(5347, 'Gummidipoondi', 558, '33', 1),
(5348, 'Ponneri', 558, '33', 1),
(5349, 'Uthukkottai', 558, '33', 1),
(5350, 'Tiruttani', 558, '33', 1),
(5351, 'Pallipattu', 558, '33', 1),
(5352, 'Thiruvallur', 558, '33', 1),
(5353, 'Poonamallee', 558, '33', 1),
(5354, 'Ambattur', 558, '33', 1),
(5355, 'Sriperumbudur', 560, '33', 1),
(5356, 'Tambaram', 560, '33', 1),
(5357, 'Chengalpattu', 560, '33', 1),
(5358, 'Kancheepuram', 560, '33', 1),
(5359, 'Uthiramerur', 560, '33', 1),
(5360, 'Tirukalukundram', 560, '33', 1),
(5361, 'Maduranthakam', 560, '33', 1),
(5362, 'Cheyyur', 560, '33', 1),
(5363, 'Gudiyatham', 561, '33', 1),
(5364, 'Katpadi', 561, '33', 1),
(5365, 'Wallajah', 561, '33', 1),
(5366, 'Arakonam', 561, '33', 1),
(5367, 'Arcot', 561, '33', 1),
(5368, 'Vellore', 561, '33', 1),
(5369, 'Vaniyambadi', 561, '33', 1),
(5370, 'Tirupathur', 561, '33', 1),
(5371, 'Hosur', 562, '33', 1),
(5372, 'Krishnagiri', 562, '33', 1),
(5373, 'Denkanikottai', 562, '33', 1),
(5374, 'Palakkodu', 562, '33', 1),
(5375, 'Pochampalli', 562, '33', 1),
(5376, 'Uthangarai', 562, '33', 1),
(5377, 'Harur', 562, '33', 1),
(5378, 'Pappireddipatti', 562, '33', 1),
(5379, 'Dharmapuri', 562, '33', 1),
(5380, 'Pennagaram', 562, '33', 1),
(5381, 'Arani', 563, '33', 1),
(5382, 'Cheyyar', 563, '33', 1),
(5383, 'Vandavasi', 563, '33', 1),
(5384, 'Polur', 563, '33', 1),
(5385, 'Chengam', 563, '33', 1),
(5386, 'Tiruvannamalai', 563, '33', 1),
(5387, 'Gingee', 564, '33', 1),
(5388, 'Tindivanam', 564, '33', 1),
(5389, 'Vanur', 564, '33', 1),
(5390, 'Viluppuram', 564, '33', 1),
(5391, 'Tirukkoyilur', 564, '33', 1),
(5392, 'Sankarapuram', 564, '33', 1),
(5393, 'Kallakkurichi', 564, '33', 1),
(5394, 'Ulundurpettai', 564, '33', 1),
(5395, 'Mettur', 565, '33', 1),
(5396, 'Omalur', 565, '33', 1),
(5397, 'Edappadi', 565, '33', 1),
(5398, 'Sankari', 565, '33', 1),
(5399, 'Salem', 565, '33', 1),
(5400, 'Yercaud', 565, '33', 1),
(5401, 'Vazhapadi', 565, '33', 1),
(5402, 'Attur', 565, '33', 1),
(5403, 'Gangavalli', 565, '33', 1),
(5404, 'Tiruchengode', 566, '33', 1),
(5405, 'Rasipuram', 566, '33', 1),
(5406, 'Namakkal', 566, '33', 1),
(5407, 'Paramathi-Velur', 566, '33', 1),
(5408, 'Sathyamangalam', 567, '33', 1),
(5409, 'Bhavani', 567, '33', 1),
(5410, 'Gobichetti - Palayam', 567, '33', 1),
(5411, 'Perundurai', 567, '33', 1),
(5412, 'Erode', 567, '33', 1),
(5413, 'Kangeyam', 567, '33', 1),
(5414, 'Dharapuram', 567, '33', 1),
(5415, 'Panthalur', 568, '33', 1),
(5416, 'Gudalur', 568, '33', 1),
(5417, 'Udhagamandalam', 568, '33', 1),
(5418, 'Kotagiri', 568, '33', 1),
(5419, 'Coonoor', 568, '33', 1),
(5420, 'Kundah', 568, '33', 1),
(5421, 'Mettupalayam', 569, '33', 1),
(5422, 'Avanashi', 569, '33', 1),
(5423, 'Tiruppur', 569, '33', 1),
(5424, 'Palladam', 569, '33', 1),
(5425, 'Coimbatore North', 569, '33', 1),
(5426, 'Coimbatore South', 569, '33', 1),
(5427, 'Pollachi', 569, '33', 1),
(5428, 'Udumalaipettai', 569, '33', 1),
(5429, 'Valparai', 569, '33', 1),
(5430, 'Palani', 570, '33', 1),
(5431, 'Oddanchatram', 570, '33', 1),
(5432, 'Vedasandur', 570, '33', 1),
(5433, 'Natham', 570, '33', 1),
(5434, 'Dindigul', 570, '33', 1),
(5435, 'Kodaikanal', 570, '33', 1),
(5436, 'Nilakkottai', 570, '33', 1),
(5437, 'Aravakurichi', 571, '33', 1),
(5438, 'Karur', 571, '33', 1),
(5439, 'Krishnarayapuram', 571, '33', 1),
(5440, 'Kulithalai', 571, '33', 1),
(5441, 'Thottiyam', 572, '33', 1),
(5442, 'Musiri', 572, '33', 1),
(5443, 'Thuraiyur', 572, '33', 1),
(5444, 'Manachanallur', 572, '33', 1),
(5445, 'Lalgudi', 572, '33', 1),
(5446, 'Srirangam', 572, '33', 1),
(5447, 'Tiruchirappalli', 572, '33', 1),
(5448, 'Manapparai', 572, '33', 1),
(5449, 'Veppanthattai', 573, '33', 1),
(5450, 'Perambalur', 573, '33', 1),
(5451, 'Kunnam', 573, '33', 1),
(5452, 'Sendurai', 574, '33', 1),
(5453, 'Udayarpalayam', 574, '33', 1),
(5454, 'Ariyalur', 574, '33', 1),
(5455, 'Panruti', 575, '33', 1),
(5456, 'Cuddalore', 575, '33', 1),
(5457, 'Chidambaram', 575, '33', 1),
(5458, 'Kattumannarkoil', 575, '33', 1),
(5459, 'Virudhachalam', 575, '33', 1),
(5460, 'Tittakudi', 575, '33', 1),
(5461, 'Sirkali', 576, '33', 1),
(5462, 'Mayiladuthurai', 576, '33', 1),
(5463, 'Tharangambadi', 576, '33', 1),
(5464, 'Nagapattinam', 576, '33', 1),
(5465, 'Kilvelur', 576, '33', 1),
(5466, 'Thirukkuvalai', 576, '33', 1),
(5467, 'Vedaranyam', 576, '33', 1),
(5468, 'Valangaiman', 577, '33', 1),
(5469, 'Kodavasal', 577, '33', 1),
(5470, 'Nannilam', 577, '33', 1),
(5471, 'Thiruvarur', 577, '33', 1),
(5472, 'Needamangalam', 577, '33', 1),
(5473, 'Mannargudi', 577, '33', 1),
(5474, 'Thiruthuraipoondi', 577, '33', 1),
(5475, 'Thiruvidaimarudur', 578, '33', 1),
(5476, 'Kumbakonam', 578, '33', 1),
(5477, 'Papanasam', 578, '33', 1),
(5478, 'Thiruvaiyaru', 578, '33', 1),
(5479, 'Thanjavur', 578, '33', 1),
(5480, 'Orathanadu', 578, '33', 1),
(5481, 'Pattukkottai', 578, '33', 1),
(5482, 'Peravurani', 578, '33', 1),
(5483, 'Iluppur', 579, '33', 1),
(5484, 'Kulathur', 579, '33', 1),
(5485, 'Gandarvakkottai', 579, '33', 1),
(5486, 'Pudukkottai', 579, '33', 1),
(5487, 'Thirumayam', 579, '33', 1),
(5488, 'Alangudi', 579, '33', 1),
(5489, 'Aranthangi', 579, '33', 1),
(5490, 'Manamelkudi', 579, '33', 1),
(5491, 'Avudayarkoil', 579, '33', 1),
(5492, 'Tirupathur', 580, '33', 1),
(5493, 'Karaikkudi', 580, '33', 1),
(5494, 'Devakottai', 580, '33', 1),
(5495, 'Sivaganga', 580, '33', 1),
(5496, 'Manamadurai', 580, '33', 1),
(5497, 'Ilayangudi', 580, '33', 1),
(5498, 'Melur', 581, '33', 1),
(5499, 'Madurai North', 581, '33', 1),
(5500, 'Vadipatti', 581, '33', 1),
(5501, 'Usilampatti', 581, '33', 1),
(5502, 'Peraiyur', 581, '33', 1),
(5503, 'Thirumangalam', 581, '33', 1),
(5504, 'Madurai South', 581, '33', 1),
(5505, 'Bodinayakanur', 582, '33', 1),
(5506, 'Periyakulam', 582, '33', 1),
(5507, 'Theni', 582, '33', 1),
(5508, 'Uthamapalayam', 582, '33', 1),
(5509, 'Andipatti', 582, '33', 1),
(5510, 'Rajapalayam', 583, '33', 1),
(5511, 'Srivilliputhur', 583, '33', 1),
(5512, 'Sivakasi', 583, '33', 1),
(5513, 'Virudhunagar', 583, '33', 1),
(5514, 'Kariapatti', 583, '33', 1),
(5515, 'Tiruchuli', 583, '33', 1),
(5516, 'Aruppukkottai', 583, '33', 1),
(5517, 'Sattur', 583, '33', 1),
(5518, 'Tiruvadanai', 584, '33', 1),
(5519, 'Paramakudi', 584, '33', 1),
(5520, 'Mudukulathur', 584, '33', 1),
(5521, 'Kamuthi', 584, '33', 1),
(5522, 'Kadaladi', 584, '33', 1),
(5523, 'Ramanathapuram', 584, '33', 1),
(5524, 'Rameswaram', 584, '33', 1),
(5525, 'Kovilpatti', 585, '33', 1),
(5526, 'Ettayapuram', 585, '33', 1),
(5527, 'Vilathikulam', 585, '33', 1),
(5528, 'Ottapidaram', 585, '33', 1),
(5529, 'Thoothukkudi', 585, '33', 1),
(5530, 'Srivaikuntam', 585, '33', 1),
(5531, 'Tiruchendur', 585, '33', 1),
(5532, 'Sathankulam', 585, '33', 1),
(5533, 'Sivagiri', 586, '33', 1),
(5534, 'Sankarankoil', 586, '33', 1),
(5535, 'Veerakeralamputhur', 586, '33', 1),
(5536, 'Tenkasi', 586, '33', 1),
(5537, 'Shenkottai', 586, '33', 1),
(5538, 'Alangulam', 586, '33', 1),
(5539, 'Tirunelveli', 586, '33', 1),
(5540, 'Palayamkottai', 586, '33', 1),
(5541, 'Ambasamudram', 586, '33', 1),
(5542, 'Nanguneri', 586, '33', 1),
(5543, 'Radhapuram', 586, '33', 1),
(5544, 'Vilavancode', 587, '33', 1),
(5545, 'Kalkulam', 587, '33', 1),
(5546, 'Thovala', 587, '33', 1),
(5547, 'Agastheeswaram', 587, '33', 1),
(5548, 'Mannadipet Commune Panchayat', 589, '34', 1),
(5549, 'Villianur Commune Panchayat', 589, '34', 1),
(5550, 'Ariankuppam Commune Panchayat', 589, '34', 1),
(5551, 'Nettapakkam Commune Panchayat', 589, '34', 1),
(5552, 'Bahour Commune Panchayat', 589, '34', 1),
(5553, 'Nedungadu Commune Panchayat', 591, '34', 1),
(5554, 'Kottucherry Commune Panchayat', 591, '34', 1),
(5555, 'Thirunallar Commune Panchayat', 591, '34', 1),
(5556, 'Neravy Commune Panchayat', 591, '34', 1),
(5557, 'Thirumalairayan Pattinam Commune Panchayat', 591, '34', 1),
(5558, 'Diglipur', 592, '35', 1),
(5559, 'Mayabunder', 592, '35', 1),
(5560, 'Rangat', 592, '35', 1),
(5561, 'Ferrargunj', 592, '35', 1),
(5562, 'Port Blair', 592, '35', 1),
(5563, 'Car Nicobar', 593, '35', 1),
(5564, 'Nancowry', 593, '35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_construction_ages`
--

CREATE TABLE `tbl_construction_ages` (
  `construction_age_id` int(11) NOT NULL,
  `construction_age_name` varchar(255) DEFAULT NULL,
  `construction_age_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_construction_ages`
--

INSERT INTO `tbl_construction_ages` (`construction_age_id`, `construction_age_name`, `construction_age_status`, `created_at`, `updated_at`) VALUES
(1, 'Newly construction (With in 1 year)', 1, '1575461980', '1575544610'),
(2, '1-5 Year Old ', 1, '1575461987', '1575544598'),
(3, '6-10 year Old ', 1, '1575544625', '1575544767'),
(4, '11-15 Year Old', 1, '1575544648', '1575544648'),
(5, '16-20 Year Old ', 1, '1575544671', '1575544671'),
(6, '21-25 Year Old', 1, '1575544687', '1575544687'),
(7, '26-30 Year Old', 1, '1575544705', '1575544757'),
(8, '31-40 Year Old ', 1, '1575544726', '1575544746'),
(9, '41-50 year Old', 1, '1575544738', '1575544738');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`country_id`, `country_name`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `department_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`department_id`, `department_name`, `department_status`, `created_at`, `updated_at`) VALUES
(1, 'IT Department ', 1, '1574512117', '1574512117'),
(2, 'Accounts Dept.', 1, '1574512125', '1574512125'),
(3, 'Education Department ', 1, '1574512136', '1574512136'),
(4, 'Army ', 1, '1574512169', '1574512169'),
(5, 'Police Department ', 1, '1574512182', '1574512182'),
(6, 'Legal Department ', 1, '1574512192', '1574512192'),
(7, 'Health Department', 1, '1679671258', '1679671258');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designations`
--

CREATE TABLE `tbl_designations` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(255) DEFAULT NULL,
  `designation_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_designations`
--

INSERT INTO `tbl_designations` (`designation_id`, `designation_name`, `designation_status`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 1, '1575029318', '1575029318'),
(2, 'Other', 1, '1719112598', '1719112598');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facings`
--

CREATE TABLE `tbl_facings` (
  `facing_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `facing_status` tinyint(1) DEFAULT 0 COMMENT '1:active, 0:dactive',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facings`
--

INSERT INTO `tbl_facings` (`facing_id`, `title`, `facing_status`, `created_at`, `updated_at`) VALUES
(13, 'East - North', 1, '1719112098', '1719112098'),
(4, 'North', 1, '2018-12-11 17:59:51', '2018-12-11 17:59:51'),
(5, 'East', 1, '2018-12-11 18:00:00', '2018-12-11 18:00:00'),
(6, 'West', 1, '2018-12-11 18:00:05', '2018-12-11 18:00:05'),
(7, 'South', 1, '2018-12-11 18:00:10', '2018-12-11 18:00:10'),
(8, 'North-East', 1, '2018-12-11 18:00:20', '2018-12-11 18:00:20'),
(10, 'North-West', 1, '2018-12-11 18:01:44', '2018-12-11 18:01:44'),
(11, 'South-East', 1, '2018-12-11 18:01:54', '2018-12-11 18:01:54'),
(12, 'South-West', 1, '2018-12-11 18:02:00', '2018-12-11 18:02:00'),
(14, 'East - South', 1, '1719112115', '1719112115'),
(15, 'West - North', 1, '1719112131', '1719112131'),
(16, 'West -  South', 1, '1719112142', '1719112142');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedbacks`
--

CREATE TABLE `tbl_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `like_property` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'customer like 1: Yes, 0: No',
  `visit_date` varchar(255) DEFAULT NULL,
  `visit_time` varchar(255) DEFAULT NULL,
  `customer_offer` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedbacks`
--

INSERT INTO `tbl_feedbacks` (`feedback_id`, `account_id`, `user_id`, `lead_id`, `comment`, `like_property`, `visit_date`, `visit_time`, `customer_offer`, `created_at`, `requirement_id`, `property_id`, `type`) VALUES
(1, 12, 12, 4, 'not interest in that property\r\n', 1, '27-08-2020', '21:13 pm', '', '1597907633', 1, 2, 'project_property'),
(2, 12, 12, 4, 'not interest ', 0, '20-08-2020', '12:44 pm', '', '1597907669', 1, 2, 'project_property'),
(3, 12, 12, 4, 'good', 1, '20-08-2020', '13:48 pm', '', '1597907922', 1, 2, 'project_property'),
(4, 12, 12, 4, '3 bhk not required\r\n', 0, '', '', '', '1598543081', 1, 3, 'project_property'),
(12, 12, 12, 10, 'Nice place', 1, '6-4-2023', '06:30 PM', '', '1681212821', 26, 3, 'simple_property');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finances`
--

CREATE TABLE `tbl_finances` (
  `finance_id` int(11) NOT NULL,
  `finance_name` varchar(255) DEFAULT NULL,
  `finance_image` varchar(255) DEFAULT NULL,
  `finance_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_finances`
--

INSERT INTO `tbl_finances` (`finance_id`, `finance_name`, `finance_image`, `finance_status`, `created_at`, `updated_at`) VALUES
(1, 'SBI', 'd946f2011a8bfe3852ae3114b3b6811d.jpg', 1, '1573535379', '1573535450'),
(2, 'PNB', '3581d5a8dc6a7e99f33f060f680e53a8.jpg', 1, '1573535469', '1573535469'),
(3, 'OBC', '57cf5c0b9d3114d499dd096681d70ed5.jpg', 1, '1573535504', '1573535521'),
(4, 'ICICI', 'e071bc0460c52688d242dfaaaf231202.png', 1, '1573535529', '1573535529');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_firm_types`
--

CREATE TABLE `tbl_firm_types` (
  `firm_type_id` bigint(20) NOT NULL,
  `firm_type_name` varchar(255) NOT NULL,
  `firm_type_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:active. 0:inactive',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_firm_types`
--

INSERT INTO `tbl_firm_types` (`firm_type_id`, `firm_type_name`, `firm_type_status`, `created_at`, `updated_at`) VALUES
(1, 'Partnership', 1, '2018-05-04 00:00:00', '1573468952'),
(2, 'Proprietorship', 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
(3, 'LLP', 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
(4, 'PVT LTD', 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
(5, 'LTD', 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
(6, 'Public Limited', 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_floors`
--

CREATE TABLE `tbl_floors` (
  `floor_id` int(11) NOT NULL,
  `floor_name` varchar(255) DEFAULT NULL,
  `floor_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_floors`
--

INSERT INTO `tbl_floors` (`floor_id`, `floor_name`, `floor_status`, `created_at`, `updated_at`) VALUES
(1, 'Ground Floor', 1, '1573474424', '1573474424'),
(2, '1st Floor', 1, '1573474424', '1573474424'),
(3, '2nd Floor', 1, '1573474424', '1573474424'),
(4, '3rd Floor', 1, '1573474424', '1573474424'),
(5, '4th Floor', 1, '1581762396', '1581762396'),
(6, '5th Floor', 1, '1581762405', '1581762405'),
(7, '6th Floor', 1, '1581762416', '1581762416'),
(8, '7th Floor', 1, '1581762425', '1581762425'),
(9, '8th Floor', 1, '1581762436', '1581762436'),
(10, '9th Floor', 1, '1581762447', '1581762447'),
(11, '10th Floor', 1, '1581762456', '1581762456'),
(12, '11th Floor', 1, '1581762468', '1581762468'),
(13, '12th Floor', 1, '1581762478', '1581762478'),
(14, '13th Floor', 1, '1581762487', '1581762487'),
(15, '14th Floor', 1, '1581762497', '1581762497'),
(16, '15th Floor', 1, '1719110871', '1719110871'),
(17, '16th Floor', 1, '1719110881', '1719110881'),
(18, '17th Floor', 1, '1719110891', '1719110891'),
(19, '18th Floor', 1, '1719110911', '1719110911'),
(20, '19th Floor', 1, '1719110922', '1719110922'),
(21, '20th Floor', 1, '1719110932', '1719110932'),
(22, '21st Floor', 1, '1719110943', '1719111031'),
(23, '22nd Floor', 1, '1719110952', '1719111003'),
(24, '23rd Floor', 1, '1719111053', '1719111053'),
(25, '24th Floor', 1, '1719111073', '1719111073'),
(26, '25th Floor', 1, '1719111085', '1719111085'),
(27, '26th Floor', 1, '1719111093', '1719111093'),
(28, '27th Floor', 1, '1719111105', '1719111105'),
(29, '28th Floor', 1, '1719111120', '1719111120'),
(30, '29th Floor', 1, '1719111134', '1719111134'),
(31, '30th Floor', 1, '1719111144', '1719111144'),
(32, '31st Floor', 1, '1719111154', '1719111154'),
(33, '32nd Floor', 1, '1719111164', '1719111164'),
(34, '33rd Floor', 1, '1719111187', '1719111187'),
(35, '34th Floor', 1, '1719111200', '1719111200'),
(36, '35th Floor', 1, '1719111209', '1719111209'),
(37, '36th Floor', 1, '1719111222', '1719111222'),
(38, '37th Floor', 1, '1719111236', '1719111236'),
(39, '38th Floor', 1, '1719111247', '1719111247'),
(40, '39th Floor', 1, '1719111261', '1719111261'),
(41, '40th Floor', 1, '1719111274', '1719111274'),
(42, '41st Floor', 1, '1719111284', '1719111284'),
(43, '42st Floor', 1, '1719111911', '1719111911'),
(44, '43rd Floor', 1, '1719111926', '1719111926'),
(45, '44th Floor ', 1, '1719111939', '1719111939'),
(46, '45th Floor', 1, '1719111950', '1719111950'),
(47, '46th Floor', 1, '1719111960', '1719111960'),
(48, '47th Floor', 1, '1719111971', '1719111971'),
(49, '48th Floor', 1, '1719111986', '1719111986'),
(50, '49th Floor', 1, '1719111994', '1719111994'),
(51, '50th Floor', 1, '1719112005', '1719112005');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_followup`
--

CREATE TABLE `tbl_followup` (
  `followup_id` int(11) NOT NULL,
  `lead_stage_id` int(11) DEFAULT NULL,
  `lead_status_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `next_action` int(11) DEFAULT NULL,
  `next_followup_date` varchar(255) DEFAULT NULL,
  `next_followup_time` varchar(255) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `task_desc` text DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `assign_user_id` int(11) DEFAULT NULL,
  `followup_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: pending, 2: complete, 3: cancel',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_followup`
--

INSERT INTO `tbl_followup` (`followup_id`, `lead_stage_id`, `lead_status_id`, `comment`, `next_action`, `next_followup_date`, `next_followup_time`, `project_id`, `task_desc`, `lead_id`, `user_id`, `account_id`, `assign_user_id`, `followup_status`, `created_at`, `updated_at`, `added_by`) VALUES
(1, 2, 1, '', 1, '24-03-2023', '21:40 pm', 0, '', 4, 12, 12, 12, 1, '1679674213', '1679674213', 12),
(2, 4, 1, '', 3, '25-03-2023', '14:00 pm', 0, 'site visit of One DXp & Sec 111 M3m & Golf estate 2\r\n', 8, 12, 12, 12, 1, '1679721690', '1679721690', 12),
(3, 2, 1, '', 3, '27-03-2023', '22:00 pm', 0, '', 2, 12, 12, 12, 2, '1679722111', '1679722111', 12),
(4, 2, 1, '', 3, '26-03-2023', '17:00 pm', 0, '', 9, 12, 12, 12, 1, '1679722290', '1679722290', 12),
(5, 4, 1, '', 1, '25-03-2023', '17:45 pm', 0, '', 10, 12, 12, 12, 1, '1679722581', '1679722581', 12),
(6, 2, 1, '', 1, '10-04-2023', '22:00 pm', 0, '', 11, 12, 12, 12, 3, '1679723413', '1679723413', 12),
(7, 2, 1, '', 1, '30-03-2023', '10:00 am', 0, '', 13, 12, 12, 12, 2, '1679724289', '1679724289', 12),
(8, 2, 1, '', 1, '01-04-2023', '17:32 pm', 0, 'trrtre6r', 14, 12, 12, 12, 2, '1680257059', '1680257059', 12),
(9, 2, 1, '', 1, '18-04-2023', '18:46 pm', 0, '', 2, 12, 12, 20, 3, '1680873525', '1680873525', 12),
(10, 5, 3, '', 2, '11-04-2023', '20:47 pm', 0, '', 2, 12, 12, 20, 2, '1680873571', '1680873571', 12),
(11, 4, 2, '', 2, '18-04-2023', '18:50 pm', 0, '', 2, 12, 12, 12, 1, '1680873767', '1680873767', 12),
(12, 2, 3, '', 2, '12-04-2023', '16:53 pm', 0, '', 14, 12, 12, 12, 1, '1680873933', '1680873933', 12),
(13, 3, 1, '', 2, '12-04-2023', '18:09 pm', 0, '', 13, 12, 12, 20, 1, '1681119822', '1681119822', 12),
(14, 3, 1, '', 2, '12-04-2023', '18:09 pm', 0, '', 13, 12, 12, 20, 2, '1681119834', '1681119834', 12),
(15, 0, 0, '', 0, '', '', 0, '', 14, 12, 12, 0, 1, '1681121919', '1681121919', 12),
(16, 0, 0, '', 0, '', '', 0, '', 13, 12, 12, 0, 1, '1681122061', '1681122061', 12),
(17, 0, 0, '', 0, '', '', 0, '', 13, 12, 12, 0, 1, '1681122244', '1681122244', 12),
(18, 2, 2, '', 1, '19-2-2002', '06:20 AM', 0, '', 11, 12, 12, 0, 1, '1681124189', '1681124189', 12),
(19, 3, 1, '', 1, '27-04-2023', '20:34 pm', 0, '', 12, 12, 12, 12, 2, '1681124802', '1681124802', 12),
(20, 2, 1, '', 3, '13-4-2023', '06:20 AM', 0, '', 7, 12, 12, 0, 1, '1681126238', '1681126238', 12),
(21, 1, 2, '', 1, '20-4-2023', '06:20 AM', 0, '', 12, 12, 12, 0, 1, '1681126590', '1681126590', 12),
(22, 2, 1, '', 1, '13-04-2023', '19:46 pm', 0, 'test', 6, 12, 12, 12, 1, '1681309062', '1681309062', 12),
(23, 7, 2, '', 0, '', '', 0, '', 24, 20, 12, 0, 1, '1716457927', '1716457927', 20),
(24, 4, 1, '', 3, '24-05-2024', '11:01 am', 0, '', 25, 20, 12, 20, 1, '1716458103', '1716458103', 20),
(25, 4, 1, '', 1, '25-05-2024', '11:00 am', 0, '', 12, 28, 26, 26, 2, '1716509799', '1716509799', 26),
(26, 1, 1, '', 1, '25-05-2024', '20:53 pm', 0, '', 39, 26, 26, 26, 2, '1716650608', '1716650608', 26),
(27, 2, 1, '', 2, '02-06-2024', '12:28 pm', 0, '', 39, 26, 26, 26, 2, '1717311528', '1717311528', 26),
(28, 2, 3, '', 1, '11-06-2024', '11:58 am', 0, '', 40, 26, 26, 28, 1, '1718000938', '1718000938', 26),
(29, 4, 1, 'abc', 2, '11-06-2024', '12:06 pm', 0, '', 12, 28, 26, 26, 2, '1718001398', '1718001398', 26),
(30, 4, 1, '', 2, '11-06-2024', '12:06 pm', 0, '', 12, 28, 26, 26, 1, '1718001398', '1718001398', 26),
(31, 4, 1, '', 2, '18-06-2024', '19:42 pm', 0, 'xyx', 12, 28, 26, 28, 1, '1718719953', '1718719953', 26),
(32, 2, 1, '', 1, '21-06-2024', '16:00 pm', 0, '', 48, 32, 31, 32, 2, '1718951066', '1718951066', 32),
(33, 1, 1, '', 1, '22-06-2024', '16:30 pm', 0, '', 47, 32, 31, 32, 1, '1718952155', '1718952155', 32),
(34, 2, 1, '', 1, '22-06-2024', '16:00 pm', 0, '', 51, 32, 31, 32, 2, '1718953022', '1718953022', 32),
(35, 2, 1, '', 1, '22-06-2024', '16:00 pm', 0, '', 57, 32, 31, 32, 1, '1718954436', '1718954436', 32),
(36, 2, 1, '', 1, '21-06-2024', '17:00 pm', 0, '', 74, 32, 31, 32, 1, '1718955046', '1718955046', 32),
(37, 2, 1, '', 1, '22-06-2024', '16:59 pm', 0, '', 73, 32, 31, 32, 1, '1718956179', '1718956179', 32),
(38, 2, 1, '', 1, '22-06-2024', '16:00 pm', 0, '', 69, 32, 31, 32, 1, '1718956492', '1718956492', 32),
(39, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 70, 32, 31, 32, 1, '1718956686', '1718956686', 32),
(40, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 72, 32, 31, 32, 2, '1718959365', '1718959365', 32),
(41, 2, 1, '', 1, '22-06-2024', '10:00 am', 0, '', 79, 32, 31, 32, 1, '1718960039', '1718960039', 32),
(42, 2, 1, '', 1, '28-06-2024', '17:00 pm', 0, '', 80, 32, 31, 32, 1, '1718960470', '1718960470', 32),
(43, 2, 1, 'today meet not possible', 1, '22-06-2024', '16:00 pm', 0, '', 84, 32, 31, 32, 2, '1718960836', '1718960836', 32),
(44, 2, 1, '', 1, '21-06-2024', '17:00 pm', 0, '', 85, 32, 31, 32, 1, '1718961074', '1718961074', 32),
(45, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 81, 32, 31, 32, 2, '1718961225', '1718961225', 32),
(46, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 82, 32, 31, 32, 2, '1718961350', '1718961350', 32),
(47, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 83, 32, 31, 32, 1, '1718961486', '1718961486', 32),
(48, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 86, 32, 31, 32, 2, '1718962478', '1718962478', 32),
(49, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 87, 32, 31, 32, 2, '1718963196', '1718963196', 32),
(50, 2, 1, '', 1, '22-06-2024', '10:00 am', 0, '', 88, 32, 31, 32, 2, '1718969313', '1718969313', 32),
(51, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 89, 32, 31, 32, 1, '1718970983', '1718970983', 32),
(52, 2, 1, 'not interested', 1, '22-06-2024', '17:00 pm', 0, '', 92, 32, 31, 32, 2, '1718973373', '1718973373', 32),
(53, 2, 1, '', 1, '22-06-2024', '17:00 pm', 0, '', 91, 32, 31, 32, 1, '1718974284', '1718974284', 32),
(54, 2, 1, '', 1, '23-06-2024', '11:00 am', 0, 'today not possible to meet, call on tomorrow around 11am regarding meeting ', 88, 32, 31, 32, 1, '1719033029', '1719033029', 32),
(55, 2, 1, '', 1, '22-06-2024', '00:00 am', 0, 'dheeraj said i will call you back regarding confirm a meeting time today', 48, 32, 31, 32, 2, '1719033625', '1719033625', 32),
(56, 2, 1, '', 1, '22-06-2024', '05:00 am', 0, 'detail share comercial project', 97, 32, 31, 32, 1, '1719035781', '1719035781', 32),
(57, 2, 1, '', 1, '23-06-2024', '16:00 pm', 0, '', 93, 32, 31, 32, 1, '1719040224', '1719040224', 32),
(58, 2, 1, '', 1, '24-06-2024', '17:00 pm', 0, 'call on tomorrow then plan a next meeting time', 84, 32, 31, 32, 2, '1719119289', '1719119289', 32),
(59, 2, 1, '', 1, '24-06-2024', '17:00 pm', 0, '', 104, 32, 31, 32, 1, '1719120251', '1719120251', 32),
(60, 2, 1, '', 1, '24-06-2024', '17:00 pm', 0, '', 101, 32, 31, 32, 1, '1719121203', '1719121203', 32),
(61, 2, 1, '', 1, '24-06-2024', '17:00 pm', 0, '', 96, 32, 31, 32, 1, '1719124088', '1719124088', 32),
(62, 2, 1, '', 1, '24-06-2024', '17:00 pm', 0, '', 106, 32, 31, 32, 1, '1719135631', '1719135631', 32),
(63, 2, 1, '', 1, '24-06-2024', '10:59 am', 0, '', 107, 32, 31, 32, 2, '1719138545', '1719138545', 32),
(64, 2, 1, '', 1, '24-06-2024', '17:00 pm', 0, '', 108, 32, 31, 32, 2, '1719143896', '1719143896', 32),
(65, 2, 1, '', 1, '26-06-2024', '17:00 pm', 0, '', 100, 32, 31, 32, 2, '1719207667', '1719207667', 32),
(66, 7, 2, '', 0, '', '', 0, '', 98, 32, 31, 0, 1, '1719208829', '1719208829', 32),
(67, 2, 1, '', 1, '26-06-2024', '17:00 pm', 0, '', 115, 32, 31, 32, 1, '1719209141', '1719209141', 32),
(68, 2, 1, '', 1, '28-06-2024', '11:00 am', 0, 'abhi thora plan change hai maam m3m 57 mai open deal a rhe thy to app thora wait krke Friday contact krle ', 84, 32, 31, 32, 1, '1719212832', '1719212832', 32),
(69, 2, 1, '', 1, '28-06-2024', '16:00 pm', 0, '', 90, 32, 31, 32, 1, '1719213475', '1719213475', 32),
(70, 2, 1, '', 1, '24-06-2024', '17:00 pm', 0, 'maam sham ko batt krta hui abhi busy hui khi betha hui', 108, 32, 31, 32, 1, '1719214240', '1719214240', 32),
(71, 2, 1, '', 1, '24-06-2024', '16:02 pm', 0, 'maam abhi batt nhi krsakta sham ko batt krte hai', 107, 32, 31, 32, 1, '1719214390', '1719214390', 32),
(72, 2, 1, '', 1, '26-06-2024', '16:00 pm', 0, 'he is not interested but will try again ', 72, 32, 31, 32, 1, '1719218391', '1719218391', 32),
(73, 2, 1, '', 1, '26-06-2024', '10:00 am', 0, 'meet on wednesday around 12pm', 81, 32, 31, 32, 2, '1719218549', '1719218549', 32),
(74, 2, 1, '', 1, '26-06-2024', '14:00 pm', 0, 'firstly he will discuss on uncle then he will update ', 82, 32, 31, 32, 2, '1719218724', '1719218724', 32),
(75, 2, 1, '', 1, '26-06-2024', '11:00 am', 0, '', 113, 32, 31, 32, 1, '1719220642', '1719220642', 32),
(76, 2, 1, '', 1, '30-06-2024', '16:00 pm', 0, '', 112, 32, 31, 32, 1, '1719220831', '1719220831', 32),
(77, 7, 2, '', 0, '', '', 0, '', 110, 32, 31, 0, 1, '1719221482', '1719221482', 32),
(78, 7, 2, '', 0, '', '', 0, '', 109, 32, 31, 0, 1, '1719221656', '1719221656', 32),
(79, 2, 1, 'number not exist', 1, '26-06-2024', '16:00 pm', 0, '', 121, 32, 31, 32, 2, '1719226120', '1719226120', 32),
(80, 2, 1, '', 1, '26-06-2024', '16:00 pm', 0, '', 120, 32, 31, 32, 2, '1719226237', '1719226237', 32),
(81, 7, 2, '', 0, '', '', 0, '', 52, 32, 31, 0, 1, '1719228423', '1719228423', 32),
(82, 7, 2, '', 0, '', '', 0, '', 55, 32, 31, 0, 1, '1719228745', '1719228745', 32),
(83, 2, 1, '', 1, '29-06-2024', '15:00 pm', 0, '', 127, 32, 31, 32, 2, '1719381596', '1719381596', 32),
(84, 2, 1, '', 2, '29-06-2024', '16:00 pm', 0, 'Call on Saturday and take a time on Sunday', 127, 32, 31, 32, 1, '1719382053', '1719382053', 32),
(85, 7, 2, '', 0, '', '', 0, '', 123, 32, 31, 0, 1, '1719382653', '1719382653', 32),
(86, 2, 1, '', 1, '28-06-2024', '16:00 pm', 0, 'DLF Garden city enclave mai 179 sq yd 1.80 lac/sqyd', 122, 32, 31, 32, 1, '1719382949', '1719382949', 32),
(87, 7, 2, '', 0, '', '', 0, '', 126, 32, 31, 32, 1, '1719383264', '1719383264', 32),
(88, 2, 1, '', 1, '27-06-2024', '16:00 pm', 0, '', 134, 32, 31, 32, 2, '1719383775', '1719383775', 32),
(89, 2, 2, '', 1, '29-06-2024', '16:00 pm', 0, '', 111, 32, 31, 32, 1, '1719386167', '1719386167', 32),
(90, 2, 1, '', 1, '06-06-2025', '16:00 pm', 0, '150 sq.yd 3cr mai', 53, 32, 31, 32, 2, '1719391111', '1719391111', 32),
(91, 2, 1, '', 1, '28-06-2024', '16:00 pm', 0, '', 114, 32, 31, 32, 1, '1719391631', '1719391631', 32),
(92, 2, 1, '', 1, '29-06-2024', '17:00 pm', 0, '', 56, 32, 31, 32, 1, '1719391953', '1719391953', 32),
(93, 2, 1, '', 1, '05-07-2024', '16:00 pm', 0, 'meet on next weekend', 53, 32, 31, 32, 1, '1719394142', '1719394142', 32),
(94, 7, 2, '', 0, '', '', 0, '', 49, 32, 31, 0, 1, '1719466583', '1719466583', 32),
(95, 7, 2, '', 0, '', '', 0, '', 50, 32, 31, 0, 1, '1719466743', '1719466743', 32),
(96, 7, 2, '', 0, '', '', 0, '', 54, 32, 31, 0, 1, '1719466923', '1719466923', 32),
(97, 7, 2, '', 0, '', '', 0, '', 71, 32, 31, 0, 1, '1719467087', '1719467087', 32),
(98, 2, 1, '', 1, '30-06-2024', '12:17 pm', 0, 'she said i will call you', 75, 32, 31, 32, 1, '1719467301', '1719467301', 32),
(99, 2, 1, '', 1, '05-07-2024', '15:00 pm', 0, 'meet on nest weekend\r\n', 77, 32, 31, 32, 1, '1719467746', '1719467746', 32),
(100, 2, 1, '', 1, '28-06-2024', '16:59 pm', 0, '', 143, 32, 31, 32, 1, '1719468911', '1719468911', 32),
(101, 2, 1, '', 1, '28-06-2024', '16:00 pm', 0, 'sco plot', 140, 32, 31, 32, 1, '1719470005', '1719470005', 32),
(102, 7, 2, '', 0, '', '', 0, '', 136, 32, 31, 0, 1, '1719470617', '1719470617', 32),
(103, 7, 2, '', 0, '', '', 0, '', 133, 32, 31, 0, 1, '1719471360', '1719471360', 32),
(104, 7, 2, '', 0, '', '', 0, '', 103, 32, 31, 0, 1, '1719472782', '1719472782', 32),
(105, 7, 2, '', 0, '', '', 0, '', 128, 32, 31, 0, 1, '1719480568', '1719480568', 32),
(106, 2, 1, '', 1, '28-06-2024', '16:00 pm', 0, 'firstly share dlf detail', 138, 32, 31, 32, 1, '1719481296', '1719481296', 32),
(107, 7, 2, '', 0, '', '', 0, '', 141, 32, 31, 0, 1, '1719481597', '1719481597', 32),
(108, 2, 1, '', 1, '28-06-2024', '16:00 pm', 0, 'inke bhaiya sai batt krne k liye bola hai unhone ', 134, 32, 31, 32, 1, '1719481861', '1719481861', 32),
(109, 4, 1, '', 1, '28-06-2024', '16:01 pm', 0, 'call on friday take a time on saturday,jms the nation 150 and 175 sqyd in 3cr', 100, 32, 31, 32, 1, '1719483585', '1719483585', 32),
(110, 4, 1, '', 1, '28-06-2024', '16:01 pm', 0, 'call on friday take a time on saturday,jms the nation 150 and 175 sqyd in 3cr', 100, 32, 31, 32, 1, '1719483585', '1719483585', 32),
(111, 4, 1, '', 1, '28-06-2024', '16:01 pm', 0, 'call on friday take a time on saturday,jms the nation 150 and 175 sqyd in 3cr', 100, 32, 31, 32, 1, '1719483585', '1719483585', 32),
(112, 4, 1, '', 1, '28-06-2024', '16:01 pm', 0, 'call on friday take a time on saturday,jms the nation 150 and 175 sqyd in 3cr', 100, 32, 31, 32, 1, '1719483585', '1719483585', 32),
(113, 4, 1, '', 1, '28-06-2024', '16:01 pm', 0, 'call on friday take a time on saturday,jms the nation 150 and 175 sqyd in 3cr', 100, 32, 31, 32, 1, '1719483585', '1719483585', 32),
(114, 4, 1, '', 1, '28-06-2024', '16:01 pm', 0, 'call on friday take a time on saturday,jms the nation 150 and 175 sqyd in 3cr', 100, 32, 31, 32, 1, '1719483585', '1719483585', 32),
(115, 4, 1, '', 1, '28-06-2024', '16:01 pm', 0, 'call on friday take a time on saturday,jms the nation 150 and 175 sqyd in 3cr', 100, 32, 31, 32, 1, '1719483594', '1719483594', 32),
(116, 2, 1, '', 1, '30-06-2024', '16:05 pm', 0, 'he is going to out of station, he was saying that share the detail with me, i will update you about the meeting when i come back. ', 120, 32, 31, 32, 1, '1719484649', '1719484649', 32),
(117, 7, 2, '', 0, '', '', 0, '', 121, 32, 31, 0, 1, '1719484747', '1719484747', 32),
(118, 2, 1, '', 1, '28-06-2024', '16:10 pm', 0, 'i will talk to you later maam', 82, 32, 31, 32, 1, '1719484878', '1719484878', 32),
(119, 4, 1, '', 1, '28-06-2024', '10:25 am', 0, 'he meet on tomorrow morning call on tomorrow', 86, 32, 31, 32, 1, '1719485755', '1719485755', 32),
(120, 4, 1, '', 1, '28-06-2024', '10:00 am', 0, 'meet on tomorrow moening arond 12pm ,orris woodview ', 81, 32, 31, 32, 1, '1719486542', '1719486542', 32),
(121, 2, 1, '', 1, '28-06-2024', '14:00 pm', 0, 'sir ek bar beth k batt  krte hai', 87, 32, 31, 32, 1, '1719486840', '1719486840', 32),
(122, 4, 1, '', 1, '29-06-2024', '10:00 am', 0, 'call kregye saturday ko visit k liye ', 48, 32, 31, 32, 1, '1719487201', '1719487201', 32),
(123, 4, 1, '', 1, '30-06-2024', '10:00 am', 0, '1-2 din mai ayegye gurgaon,orris andham ora mai plot dekhegye abhi fridabadh mai hai', 51, 32, 31, 32, 1, '1719487376', '1719487376', 32),
(124, 7, 2, '', 0, '', '', 0, '', 92, 32, 31, 0, 1, '1719487619', '1719487619', 32);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_furnised_status`
--

CREATE TABLE `tbl_furnised_status` (
  `furnised_status_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_furnised_status`
--

INSERT INTO `tbl_furnised_status` (`furnised_status_id`, `title`, `status`) VALUES
(1, 'Furnished', 1),
(2, 'Unfurnished', 1),
(3, 'Semi Furnished', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_furnishings`
--

CREATE TABLE `tbl_furnishings` (
  `furnishing_id` int(11) NOT NULL,
  `furnishing_name` varchar(255) DEFAULT NULL,
  `input_type` tinyint(1) DEFAULT NULL COMMENT '1: Input Number, 2: Yes/No',
  `furnishing_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_furnishings`
--

INSERT INTO `tbl_furnishings` (`furnishing_id`, `furnishing_name`, `input_type`, `furnishing_status`, `created_at`, `updated_at`) VALUES
(1, 'Wardrobe', 1, 1, '1579854165', '1579854165'),
(2, 'Beds', 1, 1, '1579854343', '1579855115'),
(3, 'Fans', 1, 1, '1579855150', '1579855150'),
(4, 'Light', 1, 1, '1579855177', '1579855177'),
(5, 'Modular Kitchen', 2, 1, '1579855190', '1579855190'),
(6, 'Fridge', 2, 1, '1579855201', '1579855201'),
(7, 'Ac', 1, 1, '1579855461', '1579855461'),
(8, 'Geyser', 1, 1, '1579855497', '1579855497');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ideal_business`
--

CREATE TABLE `tbl_ideal_business` (
  `ideal_business_id` int(11) NOT NULL,
  `ideal_business_name` varchar(255) DEFAULT NULL,
  `ideal_business_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ideal_business`
--

INSERT INTO `tbl_ideal_business` (`ideal_business_id`, `ideal_business_name`, `ideal_business_status`, `created_at`, `updated_at`) VALUES
(1, 'Home Contractor', 1, NULL, '1575537633'),
(2, 'Home Cleaning Service', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `builder_id` int(11) DEFAULT NULL,
  `unit_code` varchar(255) DEFAULT NULL,
  `unit_no` varchar(255) DEFAULT NULL,
  `basic_cost` varchar(255) DEFAULT NULL,
  `club_cost` varchar(255) DEFAULT NULL,
  `tower` varchar(255) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  `extra_entry` text DEFAULT NULL,
  `reference` text DEFAULT NULL,
  `block_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `parking` tinyint(1) NOT NULL DEFAULT 0,
  `parking_o` tinyint(1) NOT NULL DEFAULT 0,
  `parking_s` tinyint(1) NOT NULL DEFAULT 0,
  `parking_b` tinyint(1) NOT NULL DEFAULT 0,
  `o_current_rate` varchar(255) DEFAULT NULL,
  `o_current_rate_unit` varchar(255) DEFAULT NULL,
  `o_current_rate_gst` varchar(255) DEFAULT NULL,
  `o_cost_update` tinyint(1) NOT NULL DEFAULT 0,
  `s_current_rate` varchar(255) DEFAULT NULL,
  `s_current_rate_unit` varchar(255) DEFAULT NULL,
  `s_current_rate_gst` varchar(255) DEFAULT NULL,
  `s_cost_update` tinyint(1) NOT NULL DEFAULT 0,
  `b_current_rate` varchar(255) DEFAULT NULL,
  `b_current_rate_unit` varchar(255) DEFAULT NULL,
  `b_current_rate_gst` varchar(255) DEFAULT NULL,
  `b_cost_update` tinyint(1) NOT NULL DEFAULT 0,
  `inventory_status` int(11) DEFAULT 1,
  `last_update` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`inventory_id`, `product_id`, `builder_id`, `unit_code`, `unit_no`, `basic_cost`, `club_cost`, `tower`, `floor_id`, `extra_entry`, `reference`, `block_id`, `created_at`, `updated_at`, `parking`, `parking_o`, `parking_s`, `parking_b`, `o_current_rate`, `o_current_rate_unit`, `o_current_rate_gst`, `o_cost_update`, `s_current_rate`, `s_current_rate_unit`, `s_current_rate_gst`, `s_cost_update`, `b_current_rate`, `b_current_rate_unit`, `b_current_rate_gst`, `b_cost_update`, `inventory_status`, `last_update`) VALUES
(2, 1, 2, '3', 'B-17', '1', '0', NULL, 1, '', 'B-17/W', '', '1679895647', '1716477301', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(4, 3, 4, '6', 'B-23/25', '1', '0', NULL, 1, '', 'B-23/25', '', '1716509569', '1716509569', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(5, 4, 5, '7', '101', '1', '0', NULL, 2, '', 'T-H/3BHk/2125/101', '2', '1716647053', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 2, '1718037046'),
(6, 4, 5, '7', '103', '1', '0', NULL, 2, '', 'T-H/3BHk/2125/103', '2', '1716647053', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(7, 4, 5, '7', '201', '1', '0', NULL, 3, '', 'T-H/3BHk/2125/201', '2', '1716647053', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(8, 4, 5, '7', '203', '1', '0', NULL, 3, '', 'T-H/3BHk/2125/203', '2', '1716647053', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(9, 4, 5, '8', '102', '1', '0', NULL, 2, '', 'T-H/3.5BHk/2506/102', '2', '1716648019', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(10, 4, 5, '8', '104', '1', '0', NULL, 2, '', 'T-H/3.5BHk/2506/104', '2', '1716648019', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(11, 4, 5, '8', '202', '1', '0', NULL, 3, '', 'T-H/3.5BHk/2506/202', '2', '1716648019', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(12, 4, 5, '8', '204', '1', '0', NULL, 3, '', 'T-H/3.5BHk/2506/104', '2', '1716648019', '1716649523', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(13, 2, 3, '4', '', '0', '0', NULL, 1, '', '', '', '1716710185', '1716710185', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(14, 6, 6, '9', '9', '1', '0', NULL, 1, '', '', '', '1719020202', '1719020202', 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(15, 7, 2, '12', '101', '1', '0', NULL, 2, '', '3 BHK + Servant /3K/101\r\n', '3', '1719158395', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(16, 7, 2, '12', '102', '1', '0', NULL, 2, '', '3 BHK + Servant /3K/102\r\n', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(17, 7, 2, '12', '201', '1', '0', NULL, 3, '', '3 BHK + Servant /3K/201', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(18, 7, 2, '12', '202', '1', '0', NULL, 3, '', '3 BHK + Servant /3K/202', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(19, 7, 2, '12', '301', '1', '0', NULL, 4, '', '3 BHK + Servant /3K/301\r\n', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(20, 7, 2, '12', '302', '1', '0', NULL, 4, '', '3 BHK + Servant /3K/302', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(21, 7, 2, '12', '401', '1', '0', NULL, 5, '', '3 BHK + Servant /3K/401\r\n', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(22, 7, 2, '12', '402', '1', '0', NULL, 5, '', '3 BHK + Servant /3K/402', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(23, 7, 2, '12', '501', '1', '0', NULL, 6, '', '3 BHK + Servant /3K/501\r\n', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(24, 7, 2, '12', '502', '1', '0', NULL, 6, '', '3 BHK + Servant /3K/502', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(25, 7, 2, '12', '601', '1', '0', NULL, 7, '', '3 BHK + Servant /3K/601', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(26, 7, 2, '12', '602', '1', '0', NULL, 7, '', '3 BHK + Servant /3K/602', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(27, 7, 2, '12', '701', '1', '0', NULL, 8, '', '3 BHK + Servant /3K/701\r\n', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(28, 7, 2, '12', '702', '1', '0', NULL, 8, '', '3 BHK + Servant /3K/702', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(29, 7, 2, '12', '801', '1', '0', NULL, 9, '', '3 BHK + Servant /3K/801\r\n', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(30, 7, 2, '12', '802', '1', '0', NULL, 9, '', '3 BHK + Servant /3K/802', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(31, 7, 2, '12', '901', '1', '0', NULL, 10, '', '3 BHK + Servant /3K/901\r\n', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(32, 7, 2, '12', '1001', '1', '0', NULL, 11, '', '3 BHK + Servant /3K/1001', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(33, 7, 2, '12', '1002', '1', '0', NULL, 11, '', '3 BHK + Servant /3K/1002', '3', '1719159040', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(34, 7, 2, '12', '101', '1', '0', NULL, 2, '', '3 BHK + Servant /3L/101\r\n', '4', '1719159622', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(35, 7, 2, '12', '102', '1', '0', NULL, 2, '', '3 BHK + Servant /3L/102', '4', '1719159622', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(36, 7, 2, '12', '201', '1', '0', NULL, 3, '', '3 BHK + Servant /3L/201', '4', '1719159622', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(37, 7, 2, '12', '202', '1', '0', NULL, 3, '', '3 BHK + Servant /3L/202\r\n', '4', '1719159622', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(38, 7, 2, '12', '301', '1', '0', NULL, 4, '', '3 BHK + Servant /3L/301\r\n', '4', '1719159622', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(39, 7, 2, '12', '302', '1', '0', NULL, 4, '', '3 BHK + Servant /3L/302', '4', '1719159622', '1719196509', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(40, 7, 2, '12', '401', '1', '0', NULL, 5, '', '3 BHK + Servant /3L/401\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(41, 7, 2, '12', '402', '1', '0', NULL, 5, '', '3 BHK + Servant /3L/402', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(42, 7, 2, '12', '501', '1', '0', NULL, 6, '', '3 BHK + Servant /3L/501\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(43, 7, 2, '12', '502', '1', '0', NULL, 6, '', '3 BHK + Servant /3L/502', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(44, 7, 2, '12', '601', '1', '0', NULL, 7, '', '3 BHK + Servant /3L/601\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(45, 7, 2, '12', '602', '1', '0', NULL, 7, '', '3 BHK + Servant /3L/602', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(46, 7, 2, '12', '701', '1', '0', NULL, 8, '', '3 BHK + Servant /3L/701\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(47, 7, 2, '12', '702', '1', '0', NULL, 8, '', '3 BHK + Servant /3L/702\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(48, 7, 2, '12', '801', '1', '0', NULL, 9, '', '3 BHK + Servant /3L/801\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(49, 7, 2, '12', '802', '1', '0', NULL, 9, '', '3 BHK + Servant /3L/802\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(50, 7, 2, '12', '901', '1', '0', NULL, 10, '', '3 BHK + Servant /3L/901\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(51, 7, 2, '12', '902', '1', '0', NULL, 10, '', '3 BHK + Servant /3L/902', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(52, 7, 2, '12', '1001', '1', '0', NULL, 11, '', '3 BHK + Servant /3L/1001\r\n', '4', '1719159622', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(54, 7, 2, '12', '101', '1', '0', NULL, 2, '', '3 BHK + Servant /3M/101\r\n', '5', '1719160861', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(55, 7, 2, '12', '102', '1', '0', NULL, 2, '', '3 BHK + Servant /3M/102\r\n', '5', '1719160861', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(56, 7, 2, '12', '201', '1', '0', NULL, 3, '', '3 BHK + Servant /3M/201\r\n', '5', '1719160861', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(57, 7, 2, '12', '202', '1', '0', NULL, 3, '', '3 BHK + Servant /3M/202\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(58, 7, 2, '12', '301', '1', '0', NULL, 4, '', '3 BHK + Servant /3M/301\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(59, 7, 2, '12', '302', '1', '0', NULL, 4, '', '3 BHK + Servant /3M/302\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(60, 7, 2, '12', '401', '1', '0', NULL, 5, '', '3 BHK + Servant /3M/401\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(61, 7, 2, '12', '402', '1', '0', NULL, 5, '', '3 BHK + Servant /3M/402', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(62, 7, 2, '12', '501', '1', '0', NULL, 6, '', '3 BHK + Servant /3M/501\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(63, 7, 2, '12', '502', '1', '0', NULL, 6, '', '3 BHK + Servant /3M/502', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(64, 7, 2, '12', '601', '1', '0', NULL, 7, '', '3 BHK + Servant /3M/601\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(65, 7, 2, '12', '602', '1', '0', NULL, 7, '', '3 BHK + Servant /3M/602', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(66, 7, 2, '12', '701', '1', '0', NULL, 8, '', '3 BHK + Servant /3M/701\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(67, 7, 2, '12', '702', '1', '0', NULL, 8, '', '3 BHK + Servant /3M/702', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(68, 7, 2, '12', '801', '1', '0', NULL, 9, '', '3 BHK + Servant /3M/801\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(69, 7, 2, '12', '802', '1', '0', NULL, 9, '', '3 BHK + Servant /3M/802', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(70, 7, 2, '12', '901', '1', '0', NULL, 10, '', '3 BHK + Servant /3M/901\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(71, 7, 2, '12', '902', '1', '0', NULL, 10, '', '3 BHK + Servant /3M/902', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(72, 7, 2, '12', '1001', '1', '0', NULL, 11, '', '3 BHK + Servant /3M/1001\r\n', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(73, 7, 2, '12', '1002', '1', '0', NULL, 11, '', '3 BHK + Servant /3M/1002', '5', '1719160862', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(74, 7, 2, '12', '101', '1', '0', NULL, 2, '', '3 BHK + Servant /3N/101\r\n', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(75, 7, 2, '12', '102', '1', '0', NULL, 2, '', '3 BHK + Servant /3N/102', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(76, 7, 2, '12', '201', '1', '0', NULL, 3, '', '3 BHK + Servant /3N/201', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(77, 7, 2, '12', '202', '1', '0', NULL, 3, '', '3 BHK + Servant /3N/202', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(78, 7, 2, '12', '301', '1', '0', NULL, 4, '', '3 BHK + Servant /3N/301', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(79, 7, 2, '12', '302', '1', '0', NULL, 4, '', '3 BHK + Servant /3N/302', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(80, 7, 2, '12', '401', '1', '0', NULL, 5, '', '3 BHK + Servant /3N/401', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(81, 7, 2, '12', '402', '1', '0', NULL, 5, '', '3 BHK + Servant /3N/402', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(82, 7, 2, '12', '501', '1', '0', NULL, 6, '', '3 BHK + Servant /3N/501', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(83, 7, 2, '12', '502', '1', '0', NULL, 6, '', '3 BHK + Servant /3N/502', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(84, 7, 2, '12', '601', '1', '0', NULL, 7, '', '3 BHK + Servant /3N/601', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(85, 7, 2, '12', '602', '1', '0', NULL, 7, '', '3 BHK + Servant /3N/602', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(86, 7, 2, '12', '702', '1', '0', NULL, 8, '', '3 BHK + Servant /3N/702', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(87, 7, 2, '12', '801', '1', '0', NULL, 9, '', '3 BHK + Servant /3N/801', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(88, 7, 2, '12', '802', '1', '0', NULL, 9, '', '3 BHK + Servant /3N/802', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(89, 7, 2, '12', '901', '1', '0', NULL, 10, '', '3 BHK + Servant /3N/901', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(90, 7, 2, '12', '902', '1', '0', NULL, 10, '', '3 BHK + Servant /3N/902', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(91, 7, 2, '12', '1002', '1', '0', NULL, 11, '', '3 BHK + Servant /3N/1002', '6', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(92, 7, 2, '12', '101', '1', '0', NULL, 2, '', '3 BHK + Servant /3O/101', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(93, 7, 2, '12', '102', '1', '0', NULL, 2, '', '3 BHK + Servant /3O/102', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(94, 7, 2, '12', '201', '1', '0', NULL, 3, '', '3 BHK + Servant /3O/201', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(95, 7, 2, '12', '301', '1', '0', NULL, 4, '', '3 BHK + Servant /3O/301', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(96, 7, 2, '12', '401', '1', '0', NULL, 5, '', '3 BHK + Servant /3O/401', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(97, 7, 2, '12', '501', '1', '0', NULL, 6, '', '3 BHK + Servant /3O/501', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(98, 7, 2, '12', '502', '1', '0', NULL, 6, '', '3 BHK + Servant /3O/502', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(99, 7, 2, '12', '601', '1', '0', NULL, 7, '', '3 BHK + Servant /3O/601', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(100, 7, 2, '12', '602', '1', '0', NULL, 7, '', '3 BHK + Servant /3O/602', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(101, 7, 2, '12', '701', '1', '0', NULL, 8, '', '3 BHK + Servant /3O/701', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(102, 7, 2, '12', '702', '1', '0', NULL, 8, '', '3 BHK + Servant /3O/702', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(103, 7, 2, '12', '801', '1', '0', NULL, 9, '', '3 BHK + Servant /3O/801', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(104, 7, 2, '12', '901', '1', '0', NULL, 10, '', '3 BHK + Servant /3O/901', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(105, 7, 2, '12', '902', '1', '0', NULL, 10, '', '3 BHK + Servant /3O/902', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(106, 7, 2, '12', '1001', '1', '0', NULL, 11, '', '3 BHK + Servant /3O/1001', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(107, 7, 2, '12', '1002', '1', '0', NULL, 11, '', '3 BHK + Servant /3O/1002', '7', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(108, 7, 2, '12', '101', '1', '0', NULL, 2, '', '3 BHK + Servant /3P/101\r\n', '8', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(109, 7, 2, '12', '102', '1', '0', NULL, 2, '', '3 BHK + Servant /3P/102', '8', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(110, 7, 2, '12', '201', '1', '0', NULL, 3, '', '3 BHK + Servant /3P/201', '8', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(111, 7, 2, '12', '202', '1', '0', NULL, 3, '', '3 BHK + Servant /3P/202', '8', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(112, 7, 2, '12', '301', '1', '0', NULL, 4, '', '3 BHK + Servant /3P/301', '8', '1719161743', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(113, 7, 2, '12', '302', '1', '0', NULL, 4, '', '3 BHK + Servant /3P/302', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(114, 7, 2, '12', '401', '1', '0', NULL, 5, '', '3 BHK + Servant /3P/401', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(115, 7, 2, '12', '402', '1', '0', NULL, 5, '', '3 BHK + Servant /3P/402', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(116, 7, 2, '12', '501', '1', '0', NULL, 6, '', '3 BHK + Servant /3P/501', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(117, 7, 2, '12', '502', '1', '0', NULL, 6, '', '3 BHK + Servant /3P/502', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(118, 7, 2, '12', '601', '1', '0', NULL, 7, '', '3 BHK + Servant /3P/601', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(119, 7, 2, '12', '602', '1', '0', NULL, 7, '', '3 BHK + Servant /3P/602', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(120, 7, 2, '12', '701', '1', '0', NULL, 8, '', '3 BHK + Servant /3P/701', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(121, 7, 2, '12', '702', '1', '0', NULL, 8, '', '3 BHK + Servant /3P/702', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(122, 7, 2, '12', '801', '1', '0', NULL, 9, '', '3 BHK + Servant /3P/801', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(123, 7, 2, '12', '802', '1', '0', NULL, 9, '', '3 BHK + Servant /3P/802', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(124, 7, 2, '12', '901', '1', '0', NULL, 10, '', '3 BHK + Servant /3P/901', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(125, 7, 2, '12', '902', '1', '0', NULL, 10, '', '3 BHK + Servant /3P/902', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(126, 7, 2, '12', '1001', '1', '0', NULL, 11, '', '3 BHK + Servant /3P/1001', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(127, 7, 2, '12', '1002', '1', '0', NULL, 11, '', '3 BHK + Servant /3P/1002', '8', '1719162292', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(128, 7, 2, '13', '101', '1', '0', NULL, 2, '', '4 BHK + Servent/4A/101', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(129, 7, 2, '13', '102', '1', '0', NULL, 2, '', '4 BHK + Servent/4A/102', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(130, 7, 2, '13', '201', '1', '0', NULL, 3, '', '4 BHK + Servent/4A/201', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(131, 7, 2, '13', '202', '1', '0', NULL, 3, '', '4 BHK + Servent/4A/202', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(132, 7, 2, '13', '301', '1', '0', NULL, 4, '', '4 BHK + Servent/4A/301', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(133, 7, 2, '13', '302', '1', '0', NULL, 4, '', '4 BHK + Servent/4A/302', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(134, 7, 2, '13', '401', '1', '0', NULL, 5, '', '4 BHK + Servent/4A/401', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(135, 7, 2, '13', '501', '1', '0', NULL, 6, '', '4 BHK + Servent/4A/501', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(136, 7, 2, '13', '502', '1', '0', NULL, 6, '', '4 BHK + Servent/4A/502', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(137, 7, 2, '13', '601', '1', '0', NULL, 7, '', '4 BHK + Servent/4A/601', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(138, 7, 2, '13', '602', '1', '0', NULL, 7, '', '4 BHK + Servent/4A/602', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(139, 7, 2, '13', '701', '1', '0', NULL, 8, '', '4 BHK + Servent/4A/701', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(140, 7, 2, '13', '702', '1', '0', NULL, 8, '', '4 BHK + Servent/4A/702', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(141, 7, 2, '13', '802', '1', '0', NULL, 41, '', '4 BHK + Servent/4A/802', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(142, 7, 2, '13', '902', '1', '0', NULL, 10, '', '4 BHK + Servent/4A/902', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(143, 7, 2, '13', '1001', '1', '0', NULL, 11, '', '4 BHK + Servent/4A/1001', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(144, 7, 2, '13', '1002', '1', '0', NULL, 11, '', '4 BHK + Servent/4A/1002', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(145, 7, 2, '13', '101', '1', '0', NULL, 2, '', '4 BHK + Servent/4B/101', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(146, 7, 2, '13', '102', '1', '0', NULL, 2, '', '4 BHK + Servent/4B/102', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(147, 7, 2, '13', '201', '1', '0', NULL, 3, '', '4 BHK + Servent/4B/201', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(148, 7, 2, '13', '301', '1', '0', NULL, 4, '', '4 BHK + Servent/4B/301', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(149, 7, 2, '13', '401', '1', '0', NULL, 5, '', '4 BHK + Servent/4B/401', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(150, 7, 2, '13', '402', '1', '0', NULL, 5, '', '4 BHK + Servent/4B/402', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(151, 7, 2, '13', '501', '1', '0', NULL, 6, '', '4 BHK + Servent/4B/501', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(152, 7, 2, '13', '502', '1', '0', NULL, 6, '', '4 BHK + Servent/4B/502', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(153, 7, 2, '13', '601', '1', '0', NULL, 7, '', '4 BHK + Servent/4B/601', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(154, 7, 2, '13', '701', '1', '0', NULL, 8, '', '4 BHK + Servent/4B/701', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(155, 7, 2, '13', '702', '1', '0', NULL, 8, '', '4 BHK + Servent/4B/702', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(156, 7, 2, '13', '801', '1', '0', NULL, 9, '', '4 BHK + Servent/4B/801', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(157, 7, 2, '13', '802', '1', '0', NULL, 9, '', '4 BHK + Servent/4B/802', '9', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(158, 7, 2, '13', '901', '1', '0', NULL, 10, '', '4 BHK + Servent/4B/901', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(159, 7, 2, '13', '1001', '1', '0', NULL, 11, '', '4 BHK + Servent/4B/1001', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(160, 7, 2, '13', '1002', '1', '0', NULL, 11, '', '4 BHK + Servent/4B/1002', '10', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(161, 7, 2, '13', '101', '1', '0', NULL, 2, '', '4 BHK + Servent/4C/101', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(162, 7, 2, '13', '102', '1', '0', NULL, 2, '', '4 BHK + Servent/4C/102', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(163, 7, 2, '13', '202', '1', '0', NULL, 3, '', '4 BHK + Servent/4C/202', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(164, 7, 2, '13', '301', '1', '0', NULL, 4, '', '4 BHK + Servent/4C/301', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(165, 7, 2, '13', '302', '1', '0', NULL, 4, '', '4 BHK + Servent/4C/302', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(166, 7, 2, '13', '401', '1', '0', NULL, 5, '', '4 BHK + Servent/4C/401', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(167, 7, 2, '13', '501', '1', '0', NULL, 6, '', '4 BHK + Servent/4C/501', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(168, 7, 2, '13', '502', '1', '0', NULL, 6, '', '4 BHK + Servent/4C/502', '11', '1719194948', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(169, 7, 2, '13', '601', '1', '0', NULL, 7, '', '4 BHK + Servent/4C/601', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(170, 7, 2, '13', '602', '1', '0', NULL, 7, '', '4 BHK + Servent/4C/602', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(171, 7, 2, '13', '701', '1', '0', NULL, 8, '', '4 BHK + Servent/4C/701', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(172, 7, 2, '13', '702', '1', '0', NULL, 8, '', '4 BHK + Servent/4C/702', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(173, 7, 2, '13', '801', '1', '0', NULL, 9, '', '4 BHK + Servent/4C/801', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(174, 7, 2, '13', '802', '1', '0', NULL, 9, '', '4 BHK + Servent/4C/802', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(175, 7, 2, '13', '901', '1', '0', NULL, 10, '', '4 BHK + Servent/4C/901', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(176, 7, 2, '13', '902', '1', '0', NULL, 10, '', '4 BHK + Servent/4C/902', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(177, 7, 2, '13', '1002', '1', '0', NULL, 11, '', '4 BHK + Servent/4C/1002', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(178, 7, 2, '13', '201', '1', '0', NULL, 3, '', '4 BHK + Servent/4C/201', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL),
(179, 7, 2, '13', '402', '1', '0', NULL, 5, '', '4 BHK + Servent/4C/402', '11', '1719195369', '1719196510', 1, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_additional`
--

CREATE TABLE `tbl_inventory_additional` (
  `inventory_additional_id` int(11) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `product_additional_detail_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `current_rate` varchar(255) DEFAULT NULL,
  `current_rate_unit` varchar(255) DEFAULT NULL,
  `current_rate_gst` varchar(255) DEFAULT NULL,
  `cost_update` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory_additional`
--

INSERT INTO `tbl_inventory_additional` (`inventory_additional_id`, `inventory_id`, `product_additional_detail_id`, `is_active`, `current_rate`, `current_rate_unit`, `current_rate_gst`, `cost_update`) VALUES
(1, 1, 1, 1, '150', '2', '', 1),
(2, 1, 2, 1, NULL, NULL, NULL, 0),
(3, 2, 1, 1, NULL, NULL, NULL, 0),
(4, 2, 2, 1, NULL, NULL, NULL, 0),
(5, 14, 6, 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_plc`
--

CREATE TABLE `tbl_inventory_plc` (
  `inventory_plc_id` int(11) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `product_plc_detail_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `current_rate` varchar(255) DEFAULT NULL,
  `current_rate_unit` varchar(255) DEFAULT NULL,
  `current_rate_gst` varchar(255) DEFAULT NULL,
  `cost_update` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory_plc`
--

INSERT INTO `tbl_inventory_plc` (`inventory_plc_id`, `inventory_id`, `product_plc_detail_id`, `is_active`, `current_rate`, `current_rate_unit`, `current_rate_gst`, `cost_update`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, 0),
(2, 2, 1, 1, NULL, NULL, NULL, 0),
(3, 14, 7, 0, NULL, NULL, NULL, 0),
(4, 14, 8, 1, NULL, NULL, NULL, 0),
(5, 14, 9, 0, NULL, NULL, NULL, 0),
(6, 14, 10, 0, NULL, NULL, NULL, 0),
(7, 14, 11, 0, NULL, NULL, NULL, 0),
(8, 14, 12, 0, NULL, NULL, NULL, 0),
(9, 15, 13, 1, NULL, NULL, NULL, 0),
(10, 16, 13, 1, NULL, NULL, NULL, 0),
(11, 17, 13, 1, NULL, NULL, NULL, 0),
(12, 18, 13, 1, NULL, NULL, NULL, 0),
(13, 19, 13, 1, NULL, NULL, NULL, 0),
(14, 20, 13, 1, NULL, NULL, NULL, 0),
(15, 21, 13, 1, NULL, NULL, NULL, 0),
(16, 22, 13, 1, NULL, NULL, NULL, 0),
(17, 23, 13, 1, NULL, NULL, NULL, 0),
(18, 24, 13, 1, NULL, NULL, NULL, 0),
(19, 25, 13, 1, NULL, NULL, NULL, 0),
(20, 26, 13, 1, NULL, NULL, NULL, 0),
(21, 27, 13, 1, NULL, NULL, NULL, 0),
(22, 28, 13, 1, NULL, NULL, NULL, 0),
(23, 29, 13, 1, NULL, NULL, NULL, 0),
(24, 30, 13, 1, NULL, NULL, NULL, 0),
(25, 31, 13, 1, NULL, NULL, NULL, 0),
(26, 32, 13, 1, NULL, NULL, NULL, 0),
(27, 33, 13, 1, NULL, NULL, NULL, 0),
(28, 34, 13, 1, NULL, NULL, NULL, 0),
(29, 35, 13, 1, NULL, NULL, NULL, 0),
(30, 36, 13, 1, NULL, NULL, NULL, 0),
(31, 37, 13, 1, NULL, NULL, NULL, 0),
(32, 38, 13, 1, NULL, NULL, NULL, 0),
(33, 39, 13, 1, NULL, NULL, NULL, 0),
(34, 40, 13, 1, NULL, NULL, NULL, 0),
(35, 41, 13, 1, NULL, NULL, NULL, 0),
(36, 42, 13, 1, NULL, NULL, NULL, 0),
(37, 43, 13, 1, NULL, NULL, NULL, 0),
(38, 44, 13, 1, NULL, NULL, NULL, 0),
(39, 45, 13, 1, NULL, NULL, NULL, 0),
(40, 46, 13, 1, NULL, NULL, NULL, 0),
(41, 47, 13, 1, NULL, NULL, NULL, 0),
(42, 48, 13, 1, NULL, NULL, NULL, 0),
(43, 49, 13, 1, NULL, NULL, NULL, 0),
(44, 50, 13, 1, NULL, NULL, NULL, 0),
(45, 51, 13, 1, NULL, NULL, NULL, 0),
(46, 52, 13, 1, NULL, NULL, NULL, 0),
(47, 53, 13, 1, NULL, NULL, NULL, 0),
(48, 54, 13, 1, NULL, NULL, NULL, 0),
(49, 55, 13, 0, NULL, NULL, NULL, 0),
(50, 56, 13, 1, NULL, NULL, NULL, 0),
(51, 57, 13, 0, NULL, NULL, NULL, 0),
(52, 58, 13, 1, NULL, NULL, NULL, 0),
(53, 59, 13, 0, NULL, NULL, NULL, 0),
(54, 60, 13, 1, NULL, NULL, NULL, 0),
(55, 61, 13, 0, NULL, NULL, NULL, 0),
(56, 62, 13, 1, NULL, NULL, NULL, 0),
(57, 63, 13, 0, NULL, NULL, NULL, 0),
(58, 64, 13, 1, NULL, NULL, NULL, 0),
(59, 65, 13, 0, NULL, NULL, NULL, 0),
(60, 66, 13, 1, NULL, NULL, NULL, 0),
(61, 67, 13, 0, NULL, NULL, NULL, 0),
(62, 68, 13, 1, NULL, NULL, NULL, 0),
(63, 69, 13, 0, NULL, NULL, NULL, 0),
(64, 70, 13, 1, NULL, NULL, NULL, 0),
(65, 71, 13, 0, NULL, NULL, NULL, 0),
(66, 72, 13, 1, NULL, NULL, NULL, 0),
(67, 73, 13, 0, NULL, NULL, NULL, 0),
(68, 74, 13, 0, NULL, NULL, NULL, 0),
(69, 75, 13, 1, NULL, NULL, NULL, 0),
(70, 76, 13, 0, NULL, NULL, NULL, 0),
(71, 77, 13, 1, NULL, NULL, NULL, 0),
(72, 78, 13, 0, NULL, NULL, NULL, 0),
(73, 79, 13, 1, NULL, NULL, NULL, 0),
(74, 80, 13, 0, NULL, NULL, NULL, 0),
(75, 81, 13, 1, NULL, NULL, NULL, 0),
(76, 82, 13, 0, NULL, NULL, NULL, 0),
(77, 83, 13, 1, NULL, NULL, NULL, 0),
(78, 84, 13, 0, NULL, NULL, NULL, 0),
(79, 85, 13, 1, NULL, NULL, NULL, 0),
(80, 86, 13, 1, NULL, NULL, NULL, 0),
(81, 87, 13, 0, NULL, NULL, NULL, 0),
(82, 88, 13, 1, NULL, NULL, NULL, 0),
(83, 89, 13, 0, NULL, NULL, NULL, 0),
(84, 90, 13, 1, NULL, NULL, NULL, 0),
(85, 91, 13, 1, NULL, NULL, NULL, 0),
(86, 92, 13, 1, NULL, NULL, NULL, 0),
(87, 93, 13, 0, NULL, NULL, NULL, 0),
(88, 94, 13, 1, NULL, NULL, NULL, 0),
(89, 95, 13, 1, NULL, NULL, NULL, 0),
(90, 96, 13, 1, NULL, NULL, NULL, 0),
(91, 97, 13, 1, NULL, NULL, NULL, 0),
(92, 98, 13, 0, NULL, NULL, NULL, 0),
(93, 99, 13, 1, NULL, NULL, NULL, 0),
(94, 100, 13, 0, NULL, NULL, NULL, 0),
(95, 101, 13, 1, NULL, NULL, NULL, 0),
(96, 102, 13, 0, NULL, NULL, NULL, 0),
(97, 103, 13, 1, NULL, NULL, NULL, 0),
(98, 104, 13, 1, NULL, NULL, NULL, 0),
(99, 105, 13, 0, NULL, NULL, NULL, 0),
(100, 106, 13, 1, NULL, NULL, NULL, 0),
(101, 107, 13, 0, NULL, NULL, NULL, 0),
(102, 108, 13, 0, NULL, NULL, NULL, 0),
(103, 109, 13, 1, NULL, NULL, NULL, 0),
(104, 110, 13, 0, NULL, NULL, NULL, 0),
(105, 111, 13, 1, NULL, NULL, NULL, 0),
(106, 112, 13, 0, NULL, NULL, NULL, 0),
(107, 113, 13, 1, NULL, NULL, NULL, 0),
(108, 114, 13, 0, NULL, NULL, NULL, 0),
(109, 115, 13, 1, NULL, NULL, NULL, 0),
(110, 116, 13, 0, NULL, NULL, NULL, 0),
(111, 117, 13, 1, NULL, NULL, NULL, 0),
(112, 118, 13, 0, NULL, NULL, NULL, 0),
(113, 119, 13, 1, NULL, NULL, NULL, 0),
(114, 120, 13, 0, NULL, NULL, NULL, 0),
(115, 121, 13, 1, NULL, NULL, NULL, 0),
(116, 122, 13, 0, NULL, NULL, NULL, 0),
(117, 123, 13, 1, NULL, NULL, NULL, 0),
(118, 124, 13, 0, NULL, NULL, NULL, 0),
(119, 125, 13, 1, NULL, NULL, NULL, 0),
(120, 126, 13, 0, NULL, NULL, NULL, 0),
(121, 127, 13, 1, NULL, NULL, NULL, 0),
(122, 128, 13, 0, NULL, NULL, NULL, 0),
(123, 129, 13, 1, NULL, NULL, NULL, 0),
(124, 130, 13, 0, NULL, NULL, NULL, 0),
(125, 131, 13, 1, NULL, NULL, NULL, 0),
(126, 132, 13, 0, NULL, NULL, NULL, 0),
(127, 133, 13, 1, NULL, NULL, NULL, 0),
(128, 134, 13, 0, NULL, NULL, NULL, 0),
(129, 135, 13, 0, NULL, NULL, NULL, 0),
(130, 136, 13, 1, NULL, NULL, NULL, 0),
(131, 137, 13, 0, NULL, NULL, NULL, 0),
(132, 138, 13, 1, NULL, NULL, NULL, 0),
(133, 139, 13, 0, NULL, NULL, NULL, 0),
(134, 140, 13, 1, NULL, NULL, NULL, 0),
(135, 141, 13, 1, NULL, NULL, NULL, 0),
(136, 142, 13, 1, NULL, NULL, NULL, 0),
(137, 143, 13, 0, NULL, NULL, NULL, 0),
(138, 144, 13, 1, NULL, NULL, NULL, 0),
(139, 145, 13, 0, NULL, NULL, NULL, 0),
(140, 146, 13, 0, NULL, NULL, NULL, 0),
(141, 147, 13, 0, NULL, NULL, NULL, 0),
(142, 148, 13, 0, NULL, NULL, NULL, 0),
(143, 149, 13, 0, NULL, NULL, NULL, 0),
(144, 150, 13, 0, NULL, NULL, NULL, 0),
(145, 151, 13, 0, NULL, NULL, NULL, 0),
(146, 152, 13, 0, NULL, NULL, NULL, 0),
(147, 153, 13, 0, NULL, NULL, NULL, 0),
(148, 154, 13, 0, NULL, NULL, NULL, 0),
(149, 155, 13, 0, NULL, NULL, NULL, 0),
(150, 156, 13, 0, NULL, NULL, NULL, 0),
(151, 157, 13, 0, NULL, NULL, NULL, 0),
(152, 158, 13, 0, NULL, NULL, NULL, 0),
(153, 159, 13, 0, NULL, NULL, NULL, 0),
(154, 160, 13, 0, NULL, NULL, NULL, 0),
(155, 161, 13, 1, NULL, NULL, NULL, 0),
(156, 162, 13, 0, NULL, NULL, NULL, 0),
(157, 163, 13, 0, NULL, NULL, NULL, 0),
(158, 164, 13, 1, NULL, NULL, NULL, 0),
(159, 165, 13, 0, NULL, NULL, NULL, 0),
(160, 166, 13, 1, NULL, NULL, NULL, 0),
(161, 167, 13, 1, NULL, NULL, NULL, 0),
(162, 168, 13, 0, NULL, NULL, NULL, 0),
(163, 169, 13, 1, NULL, NULL, NULL, 0),
(164, 170, 13, 0, NULL, NULL, NULL, 0),
(165, 171, 13, 1, NULL, NULL, NULL, 0),
(166, 172, 13, 0, NULL, NULL, NULL, 0),
(167, 173, 13, 1, NULL, NULL, NULL, 0),
(168, 174, 13, 0, NULL, NULL, NULL, 0),
(169, 175, 13, 1, NULL, NULL, NULL, 0),
(170, 176, 13, 0, NULL, NULL, NULL, 0),
(171, 177, 13, 1, NULL, NULL, NULL, 0),
(172, 178, 13, 1, NULL, NULL, NULL, 0),
(173, 179, 13, 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_status`
--

CREATE TABLE `tbl_inventory_status` (
  `inventory_status_id` int(11) NOT NULL,
  `inventory_status_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory_status`
--

INSERT INTO `tbl_inventory_status` (`inventory_status_id`, `inventory_status_name`) VALUES
(1, 'Available'),
(2, 'Under Processing'),
(3, 'Hold'),
(4, 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leads`
--

CREATE TABLE `tbl_leads` (
  `lead_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `lead_title` varchar(255) DEFAULT NULL,
  `lead_first_name` varchar(255) DEFAULT NULL,
  `lead_last_name` varchar(255) DEFAULT NULL,
  `lead_date` varchar(255) DEFAULT NULL,
  `lead_time` varchar(255) DEFAULT NULL,
  `lead_mobile_no` varchar(255) DEFAULT NULL,
  `lead_mobile_no_2` varchar(255) DEFAULT NULL,
  `lead_email` varchar(255) DEFAULT NULL,
  `lead_address` text DEFAULT NULL,
  `lead_state_id` int(11) DEFAULT NULL,
  `lead_city_id` int(11) DEFAULT NULL,
  `lead_occupation_id` int(11) DEFAULT NULL,
  `lead_department_id` int(11) DEFAULT NULL,
  `lead_dob` varchar(255) DEFAULT NULL,
  `lead_doa` varchar(255) DEFAULT NULL,
  `lead_source_id` int(11) DEFAULT NULL,
  `lead_stage_id` int(11) DEFAULT NULL,
  `lead_status` tinyint(1) DEFAULT 0,
  `added_to_followup` tinyint(1) NOT NULL DEFAULT 0,
  `followup_date` varchar(255) DEFAULT NULL,
  `lead_pan_no` varchar(255) DEFAULT NULL,
  `lead_adhar_no` varchar(255) DEFAULT NULL,
  `lead_voter_id` varchar(255) DEFAULT NULL,
  `lead_passport_no` varchar(255) DEFAULT NULL,
  `lead_gender` varchar(255) DEFAULT NULL,
  `lead_marital_status` varchar(255) DEFAULT NULL,
  `lead_designation` varchar(255) DEFAULT NULL,
  `lead_company` varchar(255) DEFAULT NULL,
  `lead_annual_income` varchar(255) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `is_customer` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leads`
--

INSERT INTO `tbl_leads` (`lead_id`, `user_id`, `account_id`, `lead_title`, `lead_first_name`, `lead_last_name`, `lead_date`, `lead_time`, `lead_mobile_no`, `lead_mobile_no_2`, `lead_email`, `lead_address`, `lead_state_id`, `lead_city_id`, `lead_occupation_id`, `lead_department_id`, `lead_dob`, `lead_doa`, `lead_source_id`, `lead_stage_id`, `lead_status`, `added_to_followup`, `followup_date`, `lead_pan_no`, `lead_adhar_no`, `lead_voter_id`, `lead_passport_no`, `lead_gender`, `lead_marital_status`, `lead_designation`, `lead_company`, `lead_annual_income`, `property_id`, `is_customer`, `created_at`, `updated_at`, `added_by`) VALUES
(1, 26, 26, 'Mr.', 'Varun', 'Kapoor', '23-05-2024', '05:42:43 pm', '9899997080', '', 'orangetel47@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716466482', '1716466482', 26),
(2, 27, 26, 'Mr.', 'Kapil', 'Jain', '23-05-2024', '05:44:43 pm', '9999947128', '', 'kapil.12.kj@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716466578', '1716466578', 26),
(3, 27, 26, 'Ms.', 'Jyoti ', '', '23-05-2024', '05:46:19 pm', '9910302226', '', 'Jyotimakeovers@gmail.com', '', 6, 347, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716466726', '1716466726', 26),
(4, 27, 26, 'Mr.', 'Shubham', 'Aggarwal', '23-05-2024', '05:48:47 pm', '8447207545', '', 'shubham.aggarwal1297@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467174', '1716467174', 26),
(5, 27, 26, 'Mr.', 'Vikas', 'Yadav', '23-05-2024', '05:56:15 pm', '9811864277', '', 'vikas_yadav_bti@live.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467248', '1716467248', 26),
(6, 27, 26, 'Mr.', 'Anupam', 'Gupta', '23-05-2024', '05:57:29 pm', '9810110720', '', 'Anupamgupta116@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467349', '1716467349', 26),
(7, 27, 26, 'Mr.', 'Ayush ', 'Chaudhary', '23-05-2024', '05:59:10 pm', '9910094270', '', 'ayush9503@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467515', '1716467515', 26),
(8, 27, 26, 'Ms.', 'Richa', 'Marwah', '23-05-2024', '06:01:56 pm', '9650690708', '', 'richamarwah26@gmail.com', '', 6, 347, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467595', '1716467595', 26),
(9, 27, 26, 'Mr.', 'Shweta ', 'Gupta', '23-05-2024', '06:03:16 pm', '9312237576', '', 'saisprinklers@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467716', '1716467716', 26),
(10, 27, 26, 'Mr.', 'Ashok ', 'Arora', '23-05-2024', '06:05:17 pm', '9312727272', '', 'ashokumar.arora@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467763', '1716467763', 26),
(11, 27, 26, 'Mr.', 'Sarthak ', 'De', '23-05-2024', '06:06:03 pm', '9650456880', '', 'sarthakde007@gmail.com', '', 9, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716467903', '1716467903', 26),
(12, 28, 26, 'Mr.', 'Yogesh', ' Kumar', '24-05-2024', '05:43:11 am', '9910360122', '', 'int8yogeshkumar@yahoo.co.in', '', 6, 347, 4, 0, '', '', 9, 4, 1, 1, '24-05-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716509710', '1716509710', 26),
(13, 26, 26, 'Mr.', 'Ajay ', 'Sangwan', '24-05-2024', '02:09:43 pm', '9315006234', '', 'ajaypanipat134@gmail.com', '', 6, 347, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716540080', '1716540080', 26),
(14, 27, 26, 'Mr.', 'Prakhar ', 'Hasija', '24-05-2024', '02:12:16 pm', '9559349264', '', 'hasijaprakhar@gmail.com', '', 6, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716540235', '1716540235', 28),
(15, 28, 26, 'Mr.', 'Suchit ', 'Sachdeva', '24-05-2024', '02:13:56 pm', '7042792955', '', 'suchitsachdeva@ymail.com', '', 6, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716540363', '1716540363', 28),
(16, 28, 26, 'Mr.', 'Rishabh', ' Narula', '24-05-2024', '02:16:04 pm', '8882107070', '', 'narula.rishab4@gmail.com', '', 6, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716540439', '1716540439', 28),
(17, 28, 26, 'Mr.', 'Narender ', 'Kumar Jain', '24-05-2024', '02:17:20 pm', '9873391565', '', 'vipuljainadvocate@gmail.com', '', 6, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716540542', '1716540542', 28),
(18, 28, 26, 'Mr.', 'Vimal ', 'Goel', '24-05-2024', '02:19:03 pm', '9810602727', '', 'vimalgoel1919@gmail.com', '', 6, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716540635', '1716540635', 28),
(19, 28, 26, 'Mr.', 'Vijay ', 'Sharma', '24-05-2024', '02:20:36 pm', '9718350003', '', 'yhggj@gmil.com', '', 6, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716540862', '1716540862', 28),
(20, 28, 26, 'Mr.', 'Ashish ', 'yadav', '24-05-2024', '02:32:35 pm', '9899334899', '', 'A@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(21, 28, 26, 'Mr.', 'Harshal Khasa', 'Khasa', '24-05-2024', '02:32:36 pm', '9599648804', '', 'harshal.khasa@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(22, 28, 26, 'Mr.', 'Pankaj ', 'Sharma', '24-05-2024', '02:32:36 pm', '9871383436', '', 'P@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(23, 28, 26, 'Mr.', 'gagandeep ', '.', '24-05-2024', '02:32:36 pm', '7696006767', '', '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(24, 28, 26, 'Mr.', 'chetan ', 'khadria', '24-05-2024', '02:32:36 pm', '8708269715', '', 'ckhadria18@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(25, 28, 26, 'Mr.', 'Sumit ', 'Gualani ', '24-05-2024', '02:32:36 pm', '7827127344', '', 's@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(26, 26, 26, 'Mr.', 'Shushil', 'Rahul', '24-05-2024', '02:32:36 pm', '9910121783', '', 'sushil1970@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(27, 26, 26, 'Mr.', 'Rishi ', 'Bhardwaj', '24-05-2024', '02:32:36 pm', '7024305139', '', 'Swatigaurbhardwaj@gmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, '', '', '', '', 'Male', 'Married', '', '', '', NULL, 0, NULL, '1716564566', 26),
(28, 27, 26, 'Mr.', 'Ankit Khaneja ', 'Khaneja', '24-05-2024', '02:32:36 pm', '8860601125', '', 'khaneja.ankit2@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 28),
(29, 30, 30, 'Mr.', 'Ashish ', 'yadav', '24-05-2024', '08:13:17 pm', '9899334899', '', 'A@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(30, 30, 30, 'Mr.', 'Harshal Khasa', 'Khasa', '24-05-2024', '08:13:17 pm', '9599648804', '', 'harshal.khasa@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(31, 30, 30, 'Mr.', 'Pankaj ', 'Sharma', '24-05-2024', '08:13:17 pm', '9871383436', '', 'P@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(32, 30, 30, 'Mr.', 'gagandeep ', '.', '24-05-2024', '08:13:17 pm', '7696006767', '', '', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(33, 30, 30, 'Mr', 'abhi', NULL, NULL, NULL, NULL, NULL, 'ckhadria18@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '1718771265', 30),
(34, 30, 30, 'Mr.', 'Sumit ', 'Gualani ', '24-05-2024', '08:13:17 pm', '7827127344', '', 's@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(35, 30, 30, 'Mr.', 'Shushil', 'Rahul', '24-05-2024', '08:13:17 pm', '9910121783', '', 'sushil1970@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(36, 30, 30, 'Mr.', 'Yogesh', ' Kumar', '24-05-2024', '08:13:17 pm', '9910360122', '', 'int8yogeshkumar@yahoo.co.in', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(37, 30, 30, 'Mr.', 'Rishi ', 'Bhardwaj', '24-05-2024', '08:13:17 pm', '7024305139', '', 'Swatigaurbhardwaj@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(38, 30, 30, 'Mr.', 'Ankit Khaneja ', 'Khaneja', '24-05-2024', '08:13:17 pm', '8860601125', '', 'khaneja.ankit2@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 30),
(39, 26, 26, 'Mr.', 'Test', 'Test', '25-05-2024', '08:52:25 pm', '9999999999', '', 'test@test.com', '', 0, 0, 0, 0, '', '', 0, 6, 3, 1, '25-05-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1716650568', '1716722148', 26),
(40, 27, 26, 'Mr.', 'Test-1', '', '10-06-2024', '11:54:12 am', '9999999988', '', 'abc@gmail.com', '', 0, 0, 0, 0, '', '', 9, 2, 3, 1, '10-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718000700', '1718000700', 26),
(41, 26, 26, 'Mr.', 'xyz', 'abs', '14-06-2024', '12:52:46 pm', '123456789', '1234567890', 'xyz@gmail.com', 'xyzzz', 8, 394, 1, 3, '', '', 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718349836', '1718349836', 26),
(42, 27, 26, 'Mr.', 'akash', 'sharma', '18-06-2024', '01:02:31 pm', '8949945675', '8949945675', 'akash1@gmail.com', 'xvz\n', 5, 246, 5, 1, '', '', 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718696069', '1718696069', 26),
(43, 26, 26, 'Ms.', 'ak', 'jain', '18-06-2024', '03:47:31 pm', '1234567890', '1234567890', 'akshujain1201@gmail.com', 'vihar ', 4, 241, 2, 1, '', '', 2, 1, 1, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, '1718705932', '1718714066', 26),
(44, 26, 26, '', 'test', '', '19-06-2024', '09:32:07 am', '5876984750', '', 'shaaadf@gmail.com', '', 0, 0, 0, 0, '', '', 0, 1, 1, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, '1718769786', '1718771091', 26),
(45, 26, 26, 'Mr.', 'abc singhal', '', '20-06-2024', '12:27:09 pm', '9999888877', '', 'abc@hotmail.com', '', 0, 0, 0, 0, '', '', 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718866659', '1718866659', 26),
(46, 30, 30, 'Mr.', 'xyz singhal', '', '20-06-2024', '12:27:54 pm', '9999888877', '', 'abc@hotmail.com', '', 0, 0, 0, 0, '', '', 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718866689', '1718866689', 30),
(47, 32, 31, 'Mr.', 'Sandeep ', 'Bhalla', '21-06-2024', '11:38:43 am', '9212293474', '', 'sandeepb1970@rediffmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718950227', '1718950227', 31),
(48, 32, 31, 'Mr.', 'Dheeraj ', ' Mehta', '21-06-2024', '11:41:48 am', '9818214570', '', 'dheeraj.mehta78@gmail.com', '', 6, 347, 0, 0, '', '', 9, 4, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718950914', '1718950914', 31),
(49, 32, 31, 'Mr.', 'Amit', 'Kumar', '21-06-2024', '11:51:55 am', '7975620720', '', 'amitdotkumar@gmail.com', '', 7, 0, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718950968', '1718950968', 31),
(50, 32, 31, 'Mr.', 'Akhil ', 'Gupta', '21-06-2024', '11:57:47 am', '9971600486', '', 'shribalajitimbertraders@gmail.com', '', 7, 0, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951458', '1718951458', 31),
(51, 32, 31, 'Mr.', 'Deepak ', 'Rao', '21-06-2024', '12:00:58 pm', '9911573737', '', 'shs.deepak7@gmail.com', 'shs.deepak7@gmail.com', 6, 347, 0, 0, '', '', 9, 4, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951551', '1718951551', 31),
(52, 32, 31, 'Mr.', 'Vicky ', 'Thadani', '21-06-2024', '12:02:31 pm', '9999846846', '', 'vicky25101983@gmail.com', '', 6, 347, 0, 0, '', '', 9, 7, 2, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951588', '1718951588', 31),
(53, 32, 31, 'Mr.', 'Garg', '', '21-06-2024', '12:03:09 pm', '9292357357', '', 'nik.garg707@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951680', '1718951680', 31),
(54, 32, 31, 'Mr.', 'Tarang', 'Arora', '21-06-2024', '12:04:41 pm', '9999692922', '', 'Abcd@gmail.com', '', 0, 0, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951732', '1718951732', 31),
(55, 32, 31, 'Mr.', 'Sadhuram', 'Tayal', '21-06-2024', '12:05:33 pm', '9810679627', '', 'srtaya91@gmail.com', '', 6, 316, 0, 0, '', '', 9, 7, 2, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951820', '1718951820', 31),
(56, 32, 31, 'Mr.', 'Saurabh', 'Sharma', '21-06-2024', '12:07:01 pm', '9911588232', '', 'Saurabh3.sharma@icloud.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951856', '1718951856', 31),
(57, 32, 31, 'Mr.', 'Suman', 'Kothari', '21-06-2024', '12:07:37 pm', '9899256227', '', 'sumankothari.6@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718951977', '1718951977', 31),
(58, 26, 26, 'Mr.', 'Manoj Kumar', 'Sharma', '21-06-2024', '12:17:33 pm', '9810194446', '', 'swen009@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952496', '1718952496', 26),
(59, 26, 26, '', 'hello43', '', '21-06-2024', '12:13:41 pm', '9878785478', '', '', '', 0, 0, 0, 0, '', '', 0, 1, 1, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, '1718952526', '1718952829', 26),
(60, 26, 26, 'Ms.', 'Suman', 'Rani', '21-06-2024', '12:18:17 pm', '9810246691', '', 'sumanrani2278@gmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952596', '1718952596', 26),
(61, 26, 26, 'Mr.', 'Chirag', 'Ahuja', '21-06-2024', '12:19:57 pm', '9971333142', '', 'email.chiragahuja.insta@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952658', '1718952658', 26),
(62, 26, 26, 'Mr.', 'Vishesh', 'Agnihotri', '21-06-2024', '12:20:59 pm', '7042553242', '', 'visheshagnihotri0112@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952708', '1718952708', 26),
(63, 26, 26, 'Mr.', 'Chintu', '', '21-06-2024', '12:21:49 pm', '9811434348', '', 'Chsac81@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952789', '1718952789', 26),
(64, 26, 26, 'Mr.', 'Vaibhav', 'Bhatia', '21-06-2024', '12:23:10 pm', '8802449290', '', 'vaibhavbhatia1994@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952825', '1718952825', 26),
(65, 26, 26, 'Mr.', 'Rajan', '', '21-06-2024', '12:23:45 pm', '9810168011', '', 'nikitasinghal.adv@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952870', '1718952870', 26),
(66, 26, 26, 'Mr.', 'Vakul', 'Chopra', '21-06-2024', '12:24:31 pm', '9899214525', '', 'vakulchopra0009@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718952907', '1718952907', 26),
(67, 26, 26, 'Mr.', 'jitender', 'jawa', '21-06-2024', '12:25:08 pm', '9911400057', '', 'jitender_jawa@yahoo.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718953245', '1718953245', 26),
(68, 26, 26, 'Mr.', 'Vineet ', 'Mathur', '21-06-2024', '12:30:46 pm', '9899786144', '', 'mathur.vineet85@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718953337', '1718953337', 26),
(69, 32, 31, 'Ms.', 'Suman', 'Rani', '21-06-2024', '12:49:03 pm', '9810246691', '', 'sumanrani2278@gmail.com', '', 0, 0, 0, 0, '', '', 9, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718954417', '1718954417', 31),
(70, 32, 31, 'Mr.', 'Chirag ', 'Ahuja', '21-06-2024', '12:50:19 pm', '9971333142', '', 'chiragahuja.insta@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718954460', '1718954460', 31),
(71, 32, 31, 'Mr.', 'Vishesh', 'Agnihotri', '21-06-2024', '12:51:01 pm', '7042553242', '', 'visheshagnihotri0112@gmail.com', '', 7, 0, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718954772', '1718954772', 31),
(72, 32, 31, 'Mr.', 'Chintu', '', '21-06-2024', '12:56:13 pm', '9811434348', '', 'Chsac81@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718954822', '1718954822', 31),
(73, 32, 31, 'Mr.', 'Vaibhav ', 'Bhatia', '21-06-2024', '12:57:03 pm', '8802449290', '', 'vaibhavbhatia1994@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718954884', '1718954884', 31),
(74, 32, 31, 'Mr.', 'varun ', 'Gupta', '21-06-2024', '12:58:30 pm', '9205400659', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718954965', '1718972943', 32),
(75, 32, 31, 'Ms.', 'Nikita', 'singhal', '21-06-2024', '12:58:05 pm', '9810168011', '', 'nikitasinghal.adv@gmail.com', '', 0, 0, 0, 0, '', '', 9, 2, 1, 1, '27-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718954992', '1719467236', 32),
(76, 32, 31, 'Mr.', 'Vakul ', 'Chopra', '21-06-2024', '12:59:53 pm', '9899214525', '', 'vakulchopra0009@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718955041', '1718955041', 31),
(77, 32, 31, 'Mr.', 'Jitender', 'Jawa', '21-06-2024', '01:00:42 pm', '9911400057', '', 'jitender_jawa@yahoo.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718955130', '1718955130', 31),
(78, 32, 31, 'Mr.', 'Vineet', 'Mathur', '21-06-2024', '01:02:11 pm', '9899786144', '', 'mathur.vineet85@gmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718955171', '1718955171', 31),
(79, 32, 31, 'Mr.', 'Naresh ', '', '21-06-2024', '02:19:14 pm', '7732858416', '', '', '', 6, 347, 0, 0, '', '', 9, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718959915', '1718959915', 32),
(80, 32, 31, 'Mr.', 'Yash', ' Pratap', '21-06-2024', '02:27:52 pm', '8764396699', '', '', '', 6, 347, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718960337', '1718960337', 32),
(81, 32, 31, 'Ms.', 'Preeti ', 'Johar', '21-06-2024', '02:33:34 pm', '8920303702', '', '', '', 0, 0, 0, 0, '', '', 6, 4, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718960646', '1718972693', 32),
(82, 31, 31, 'Mr.', 'Harpreet ', 'Chawla', '21-06-2024', '02:34:22 pm', '9999092585', '', '', '', 7, 0, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718960692', '1719227895', 31),
(83, 31, 31, 'Mr.', 'Balbir ', 'Manchana', '21-06-2024', '02:34:56 pm', '9811141980', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718960730', '1719218795', 31),
(84, 32, 31, 'Mr.', 'Vipan', ' Kaura', '21-06-2024', '02:35:57 pm', '9999955449', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718960782', '1718973119', 32),
(85, 32, 31, 'Mr.', 'Sameer ', 'Malik', '21-06-2024', '02:39:52 pm', '9168590353', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718961031', '1718972927', 32),
(86, 32, 31, 'Mr.', 'pankaj ', 'yadav', '21-06-2024', '03:03:39 pm', '9999892085', '', '', '', 0, 0, 0, 0, '', '', 6, 4, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718962443', '1718972776', 32),
(87, 32, 31, 'Mr.', 'Sandeep ', 'Jahangir', '21-06-2024', '03:15:00 pm', '9210682170', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718963165', '1718972799', 32),
(88, 32, 31, 'Mr.', 'Yashpal', 'yadav', '21-06-2024', '04:57:38 pm', '9417869424', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718969279', '1718972960', 32),
(89, 31, 31, 'Mrs.', 'Anita', '', '21-06-2024', '05:25:01 pm', '9871035922', '', '', '', 6, 347, 0, 0, '', '', 6, 2, 1, 1, '21-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1718970948', '1719036609', 31),
(90, 32, 31, 'Mr.', 'Angad', '', '21-06-2024', '05:36:13 pm', '9811664741', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '24-06-2024', '', '', '', '', 'Male', 'Married', '', '', '', NULL, 0, '1718971610', '1718971674', 31),
(91, 32, 31, 'Mr.', 'Dev Chirag ', 'Ghai', '21-06-2024', '05:53:32 pm', '9582724744', '', 'devchiragghai@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718972671', '1718972671', 31),
(92, 32, 31, 'Mr.', 'Rajan ', 'Suri', '21-06-2024', '05:54:32 pm', '9810841028', '', 'rajansuri33@gmail.com', '', 6, 347, 0, 0, '', '', 9, 7, 2, 1, '21-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718972734', '1718972734', 31),
(93, 32, 31, 'Mr.', 'Manjot', 'Kaur', '21-06-2024', '05:55:35 pm', '8800900655', '', 'ankwarrior@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '22-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1718972785', '1718972785', 31),
(94, 32, 31, 'Mr.', 'Ravi', 'Chandna', '22-06-2024', '08:59:00 am', '9810162289', '', 'ravi@lademure.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719026981', '1719026981', 31),
(95, 32, 31, 'Ms.', 'Meenu ', 'Gupta', '22-06-2024', '08:59:42 am', '9999449385', '', 'meenugupta21@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719027044', '1719027044', 31),
(96, 32, 31, 'Mr.', 'Rajesh', 'Yadav', '22-06-2024', '09:00:49 am', '9350514530', '', 'rky1999@gmail.com', '', 6, 347, 0, 0, '', '', 9, 2, 1, 1, '23-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719027094', '1719027094', 31),
(97, 32, 31, 'Mr.', 'shalin ', 'Sharma', '22-06-2024', '11:22:36 am', '7027974755', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '22-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719035591', '1719035630', 32),
(98, 32, 31, 'Mr.', 'Sanjay', '', '22-06-2024', '08:48:22 pm', '9958446274', '', 'aggarwal.sanjay567@gmail.com', '', 6, 347, 0, 0, '', '', 9, 7, 2, 1, '24-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719069552', '1719208759', 32),
(99, 32, 31, 'Mr.', 'Tanraj', '', '22-06-2024', '08:49:13 pm', '7217873011', '', 'tanraj.mfpl@gmail.com', '', 6, 347, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719069629', '1719069629', 31),
(100, 32, 31, 'Mr.', 'Harrish', 'Arora', '22-06-2024', '08:50:30 pm', '9811395049', '', 'harisharora061967@gmail.com', '', 7, 384, 0, 0, '', '', 9, 4, 1, 1, '24-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719069692', '1719207803', 32),
(101, 32, 31, 'Mr.', 'Manish', 'Agarwal', '22-06-2024', '08:51:33 pm', '8826956956', '', 'manishba20@gmail.com', 'gurgaon,sector 57', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '23-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719069811', '1719121336', 32),
(102, 32, 31, 'Mr.', 'J K ', 'Jain', '23-06-2024', '07:11:36 am', '9810945946', '', 'jainsushil1973@gmail.com', '', 6, 347, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719106956', '1719106956', 31),
(103, 32, 31, 'Mr.', 'Shivam', 'Kochhar', '23-06-2024', '07:12:37 am', '9971000444', '', 'Shivamkochhar@gmail.com', '', 7, 0, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719107044', '1719107044', 31),
(104, 32, 31, 'Mr.', 'Suresh', 'Arora', '23-06-2024', '07:14:05 am', '9215124848', '', 'sk50arora@gmail.com', '', 6, 337, 4, 0, '', '', 9, 2, 1, 1, '23-06-2024', '', '', '', '', 'Male', 'Married', '', '', '', NULL, 0, '1719107116', '1719120495', 32),
(105, 32, 31, 'Mr.', 'Ranjeet', 'choudhary', '23-06-2024', '11:20:35 am', '9661022306', '', 'rajetkumar551@gmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, '1719121928', '1719136417', 32),
(106, 32, 31, 'Mr.', 'Rama', '', '23-06-2024', '03:09:04 pm', '9910000618', '', '', '', 0, 0, 0, 0, '', '', 6, 2, 1, 1, '23-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719135582', '1719135609', 32),
(107, 32, 31, 'Mr.', 'Neeraj ', 'bhardwaj', '23-06-2024', '03:56:03 pm', '9999608236', '', 'neerajbhardwajpataudi@gmail.com', '', 0, 0, 0, 0, '', '', 9, 2, 1, 1, '23-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719138489', '1719138489', 32),
(108, 32, 31, 'Mr.', 'deepanshu', 'Gupta', '23-06-2024', '05:23:45 pm', '9464688032', '', '', '', 3, 208, 0, 0, '', '', 9, 2, 1, 1, '23-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719143859', '1719214167', 32),
(109, 32, 31, 'Mr.', 'Geeta Vinnet ', 'Kohli', '24-06-2024', '08:30:43 am', '9910450557', '', 'Saidocuments2021@gmail.com', '', 0, 0, 0, 0, '', '', 9, 7, 2, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719198085', '1719198085', 31),
(110, 32, 31, 'Mr.', 'Guddu Zamadar ', 'Hashmi', '24-06-2024', '08:31:26 am', '9893757682', '9540434441', 'yogeshwari.sahay@gmail.com', '', 0, 0, 0, 0, '', '', 9, 7, 2, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719198256', '1719198256', 31),
(111, 32, 31, 'Mr.', 'Ram Prakash', '', '24-06-2024', '08:37:14 am', '9910038882', '', 'rpmedipharma@yahoo.in', '', 7, 0, 0, 0, '', '', 9, 2, 2, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719198480', '1719198480', 31),
(112, 32, 31, 'Mr.', 'Moksh ', 'Malik', '24-06-2024', '11:28:15 am', '8295664444', '', 'mokshmalik1991@gmail.com', '', 6, 337, 0, 0, '', '', 9, 2, 1, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719208782', '1719208782', 31),
(113, 32, 31, 'Mr.', 'Parmod ', 'Madaan', '24-06-2024', '11:29:43 am', '9818486587', '', 'needoparmodmadaan@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719208930', '1719208930', 31),
(114, 32, 31, 'Mr.', 'Parteek ', 'Makkar', '24-06-2024', '11:32:11 am', '9996662784', '', 'parteekmakkar@gmail.com', '', 6, 339, 0, 0, '', '', 9, 2, 1, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719208996', '1719208996', 31),
(115, 31, 31, 'Mr.', 'Gurdeep ', 'Arora', '24-06-2024', '11:32:16 am', '9541776000', '', '', '', 6, 316, 3, 0, '', '', 6, 2, 1, 1, '24-06-2024', '', '', '', '', 'Male', 'Married', '', '', '', NULL, 0, '1719209024', '1719209117', 31),
(116, 32, 31, 'Mr.', 'Sanjeev ', 'Sehgal', '24-06-2024', '11:33:17 am', '9416015406', '', 'sehgal34223@gmail.com', '', 6, 313, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719209068', '1719209068', 31),
(117, 31, 31, 'Mr.', 'Yogesh', '', '24-06-2024', '12:36:40 pm', '9910360122', '', '', '', 6, 347, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719212827', '1719212827', 31),
(118, 32, 31, 'Mr.', 'Uttam Kumar ', 'Pradhan', '24-06-2024', '03:13:23 pm', '8130432591', '', 'uttamkumarpradhan10@gamil.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719222426', '1719222426', 31),
(119, 32, 31, 'Mr.', 'Aditya ', 'Kalania', '24-06-2024', '03:20:15 pm', '9717811222', '', 'dvkalania@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719222778', '1719222778', 31),
(120, 32, 31, 'Mr.', 'Rajeev ', 'Sehgal', '24-06-2024', '03:22:59 pm', '9718597080', '', 'rajeevprimeservices0002@yahoo.co.in', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719222863', '1719222863', 31),
(121, 32, 31, 'Mr.', 'Anshu Manish', 'Sethi', '24-06-2024', '03:58:27 pm', '8008965430', '', 'anshu.arora886@gmail.com', '', 5, 277, 0, 0, '', '', 9, 7, 2, 1, '24-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719225088', '1719225088', 31),
(122, 32, 31, 'Mr.', 'Pankaj', 'Bhatia', '26-06-2024', '11:14:36 am', '9034566124', '', 'pankajbhatiapnp@gmail.com', '', 6, 308, 0, 0, '', '', 9, 2, 1, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719380740', '1719380740', 31),
(123, 32, 31, 'Mr.', 'Jitender', '', '26-06-2024', '11:15:41 am', '8078395668', '', 'jituseweach89@gmail.com', '', 6, 345, 0, 0, '', '', 9, 7, 2, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719381130', '1719381130', 31),
(124, 32, 31, 'Ms.', 'Akansha', 'Khanna', '26-06-2024', '11:22:11 am', '9810118176', '', 'akansha_k@hotmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719381192', '1719381192', 31),
(125, 32, 31, '', 'Shree Group Education', '', '26-06-2024', '11:23:13 am', '9813329329', '', 'shreegroupedu22@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719381335', '1719381335', 31),
(126, 32, 31, 'Mr.', 'Ronak', 'Nagar', '26-06-2024', '11:26:04 am', '9773713094', '', 'rnjds99@gmail.com', '', 0, 0, 0, 0, '', '', 9, 7, 2, 1, '26-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719381436', '1719381579', 31),
(127, 32, 31, 'Mr.', 'Abhijeet ', 'Singh', '26-06-2024', '11:27:17 am', '6201034330', '', 'abhijeetraj1122002@gmail.com', '', 7, 0, 0, 0, '', '', 9, 2, 1, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719381507', '1719381507', 31),
(128, 32, 31, 'Ms.', 'Tamanna', 'Sehji', '26-06-2024', '11:44:53 am', '9000030998', '', 'tamannasehji@yahoo.com', '', 6, 347, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719382586', '1719382586', 31),
(129, 32, 31, 'Mr.', 'Abhishek ', 'Gupta', '26-06-2024', '11:46:27 am', '9650821895', '', 'abhishek821895@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719382648', '1719382648', 31),
(130, 32, 31, '', 'Dharma Statues', '', '26-06-2024', '11:47:29 am', '9911160011', '', 'digamberexports@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719382731', '1719382731', 31),
(131, 32, 31, 'Mr.', 'Tarun', 'Gupta', '26-06-2024', '11:48:52 am', '9818764768', '', 'tarun_gupta_85@yahoo.co.in', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, '', '', '', '', 'Male', '', '', '', '', NULL, 0, '1719382901', '1719383207', 31),
(132, 32, 31, 'Mr.', 'Ayush ', 'Arora', '26-06-2024', '11:51:42 am', '9899119944', '', 'aroraayush2000@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719382986', '1719382986', 31),
(133, 32, 31, 'Mr.', 'Robin ', 'Jindgar', '26-06-2024', '11:53:07 am', '9355150051', '', 'jindgarrobin@gmail.com', '', 6, 323, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719383062', '1719383062', 31),
(134, 32, 31, 'Mr.', 'Ankit', 'Maan', '26-06-2024', '11:54:23 am', '9179655042', '', 'ankitmaan777@gmail.com', '', 8, 415, 0, 0, '', '', 9, 2, 1, 1, '26-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719383132', '1719383132', 31),
(135, 32, 31, 'Mr.', 'Amar Preet', 'Singh', '27-06-2024', '10:57:19 am', '9899021077', '', 'bains_sard@yahoo.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719466096', '1719466096', 31),
(136, 32, 31, 'Mr.', 'Gaurrav', 'Nagpal', '27-06-2024', '10:58:17 am', '9711141606', '', 'Gaurravnagpal18@yahoo.com', '', 6, 347, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719466156', '1719466156', 31),
(137, 32, 31, 'Mr.', 'Nikhil', 'Sharma', '27-06-2024', '10:59:17 am', '9999174326', '', 'Nikhilsharma1699@gmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719466210', '1719466210', 31),
(138, 32, 31, 'Mr.', 'Pratyush ', 'Raj', '27-06-2024', '11:00:11 am', '9830484327', '', 'pratyush111raj@gmail.com', '', 6, 347, 0, 0, '', '', 9, 2, 1, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719466316', '1719466316', 31),
(139, 32, 31, 'Ms.', 'Reena G ', 'Kapoor', '27-06-2024', '11:01:57 am', '9891440194', '', 'Reenakapoor14_10_94@yahoo.co.in', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719466511', '1719466511', 31),
(140, 32, 31, 'Mr.', 'Lakshay ', 'Badak', '27-06-2024', '11:05:12 am', '9810384945', '', 'Lakshaybadak@gmail.com', '', 6, 347, 0, 0, '', '', 9, 2, 1, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719466572', '1719466572', 31),
(141, 32, 31, 'Mr.', 'K', 'Bhattacharjee', '27-06-2024', '11:06:13 am', '9910409229', '', 'kaustabhbhattacharjee@gmail.com', '', 9, 0, 0, 0, '', '', 9, 7, 2, 1, '27-06-2024', '', '', '', '', '', '', '', '', '', NULL, 0, '1719466675', '1719467165', 31),
(142, 32, 31, 'Mr.', 'Aditya ', 'Arora', '27-06-2024', '11:07:56 am', '9818497212', '', 'Aditya_arora86@hotmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719466744', '1719466744', 31),
(143, 32, 31, 'Mr.', 'Kanchan ', 'Guglani', '27-06-2024', '11:09:05 am', '9716356464', '', 'kanchanguglani322@gmail.com', '', 0, 0, 0, 0, '', '', 9, 2, 1, 1, '27-06-2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719467051', '1719467051', 31),
(144, 32, 31, 'Mr.', 'Ravindra', '', '27-06-2024', '08:08:34 pm', '8447755955', '', ' ravindra.rgi@yahoo.co.in', '', 6, 347, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719499171', '1719499171', 31),
(145, 32, 31, 'Mr.', 'Atul', 'Jain', '27-06-2024', '08:09:32 pm', '9990182249', '', 'AYUSHIJAIN853149@GMAIL.Com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719499256', '1719499256', 31),
(146, 32, 31, 'Mr.', 'lakshay ', 'Khanna', '27-06-2024', '08:10:57 pm', '9899998006', '', 'lakshaykhanna2013@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719499413', '1719499413', 31),
(147, 32, 31, 'Mr.', 'Vikas ', 'Sethi', '27-06-2024', '08:13:34 pm', '9971345885', '', 'goldysethi56@gmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719499573', '1719499573', 31),
(148, 32, 31, 'Mr.', 'Parbhakar', 'Jain', '27-06-2024', '08:20:39 pm', '9818306821', '', 'prkjain@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719499943', '1719499943', 31),
(149, 31, 31, 'Mr.', 'Davinder', '', '28-06-2024', '08:59:32 am', '8800226877', '', 'Signinforget@gmail.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719545508', '1719545508', 31),
(150, 31, 31, 'Mr.', 'Hans ', 'Kataria', '28-06-2024', '09:01:48 am', '9810570131', '', 'mediherbs@rediffmail.com', '', 0, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719545580', '1719545580', 31),
(151, 31, 31, 'Ms.', 'Monica ', 'Sharma', '28-06-2024', '09:03:01 am', '9811760019', '', 'monicanavya@yahoo.com', '', 7, 0, 0, 0, '', '', 9, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719545684', '1719545684', 31),
(152, 26, 26, 'Mr.', 'abhi', 'jeet', '29-06-2024', '09:40:07 am', '7561938164', '', 'sharmaabhijeet806@gmail.com', '', 0, 0, 0, 0, '', '', 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719634354', '1719634354', 26),
(153, 26, 26, 'Mr.', 'abhijeet', 'sharma', '29-06-2024', '09:42:35 am', '8547956845', '', '', '', 0, 0, 0, 0, '', '', 0, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1719634433', '1719634433', 26),
(154, 26, 26, 'Mr.', 'abhijeet', 'sharma', '29-06-2024', '12:36:36 pm', '9858754857', '', 'sharmaabhijeet8066@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 26),
(155, 26, 26, 'Mr.', 'hello', 'sdfaj', '29-06-2024', '12:36:36 pm', '2758457854', '', 'hello@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 26),
(156, 27, 26, 'Mr.', 'this', 'hello', '29-06-2024', '12:36:36 pm', '8958758458', '', 'this@gmail.com', '', 0, 0, 0, 0, '', '', 0, 0, 0, 0, NULL, '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_actions`
--

CREATE TABLE `tbl_lead_actions` (
  `lead_action_id` int(11) NOT NULL,
  `lead_action_name` varchar(255) DEFAULT NULL,
  `lead_action_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead_actions`
--

INSERT INTO `tbl_lead_actions` (`lead_action_id`, `lead_action_name`, `lead_action_status`, `created_at`, `updated_at`) VALUES
(1, 'FOLLOWUP', 1, '1575261189', '1575261189'),
(2, 'Site Visit', 1, '1575261231', '1575261231'),
(3, 'Meeting ', 1, '1575261246', '1575261246');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_history`
--

CREATE TABLE `tbl_lead_history` (
  `lead_history_id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `followup_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead_history`
--

INSERT INTO `tbl_lead_history` (`lead_history_id`, `title`, `description`, `user_id`, `lead_id`, `followup_id`, `account_id`, `created_at`) VALUES
(1, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 1, NULL, 26, '1716466482'),
(2, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 2, NULL, 26, '1716466578'),
(3, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 3, NULL, 26, '1716466726'),
(4, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 4, NULL, 26, '1716467174'),
(5, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 5, NULL, 26, '1716467248'),
(6, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 6, NULL, 26, '1716467349'),
(7, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 7, NULL, 26, '1716467515'),
(8, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 8, NULL, 26, '1716467595'),
(9, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 9, NULL, 26, '1716467716'),
(10, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 10, NULL, 26, '1716467763'),
(11, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 11, NULL, 26, '1716467903'),
(12, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1716509710'),
(13, 'Lead Added To Followup', 'Lead added to followup and assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1716509799'),
(14, 'New Requirement', 'Requirement created by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1716509874'),
(15, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 11, NULL, 26, '1716521065'),
(16, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 10, NULL, 26, '1716521104'),
(17, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 9, NULL, 26, '1716521135'),
(18, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 8, NULL, 26, '1716521151'),
(19, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 7, NULL, 26, '1716521171'),
(20, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 6, NULL, 26, '1716521197'),
(21, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 5, NULL, 26, '1716521232'),
(22, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 4, NULL, 26, '1716521257'),
(23, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 3, NULL, 26, '1716521291'),
(24, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 2, NULL, 26, '1716521314'),
(25, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 13, NULL, 26, '1716540080'),
(26, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 14, NULL, 26, '1716540235'),
(27, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 15, NULL, 26, '1716540363'),
(28, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 16, NULL, 26, '1716540439'),
(29, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 17, NULL, 26, '1716540542'),
(30, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 18, NULL, 26, '1716540635'),
(31, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 19, NULL, 26, '1716540862'),
(32, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 20, NULL, 26, '1716541356'),
(33, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 21, NULL, 26, '1716541356'),
(34, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 22, NULL, 26, '1716541356'),
(35, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 23, NULL, 26, '1716541356'),
(36, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 24, NULL, 26, '1716541356'),
(37, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 25, NULL, 26, '1716541356'),
(38, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 26, NULL, 26, '1716541356'),
(39, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 27, NULL, 26, '1716541356'),
(40, 'Lead Created', 'Lead created by Mr. Sunil  Kumar', 28, 28, NULL, 26, '1716541356'),
(41, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 29, NULL, 30, '1716561797'),
(42, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 30, NULL, 30, '1716561797'),
(43, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 31, NULL, 30, '1716561797'),
(44, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 32, NULL, 30, '1716561797'),
(45, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 33, NULL, 30, '1716561797'),
(46, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 34, NULL, 30, '1716561797'),
(47, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 35, NULL, 30, '1716561797'),
(48, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 36, NULL, 30, '1716561797'),
(49, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 37, NULL, 30, '1716561797'),
(50, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 38, NULL, 30, '1716561797'),
(51, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 39, NULL, 26, '1716650568'),
(52, 'Lead Added To Followup', 'Lead added to followup and assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 39, NULL, 26, '1716650608'),
(53, 'New Requirement', 'Requirement created by Mr. Sanjay  Grover', 26, 39, NULL, 26, '1716650670'),
(54, 'New Requirement', 'Requirement created by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1717310744'),
(55, 'Followup', 'Followup assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 39, NULL, 26, '1717311528'),
(56, 'Site Visit', 'Site Visit assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 39, NULL, 26, '1717311528'),
(57, 'Transfer Lead', 'Lead transfer to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 28, NULL, 26, '1717920093'),
(58, 'Transfer Lead', 'Lead transfer to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 26, NULL, 26, '1717920133'),
(59, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 40, NULL, 26, '1718000700'),
(60, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 40, NULL, 26, '1718000755'),
(61, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 14, NULL, 26, '1718000785'),
(62, 'Lead Added To Followup', 'Lead added to followup and assign to Mr. Sunil  Kumar by Mr. Sanjay  Grover', 26, 40, NULL, 26, '1718000938'),
(63, 'Followup', 'Followup assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1718001398'),
(64, 'Site Visit', 'Site Visit assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1718001398'),
(65, 'Followup', 'Followup assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1718001398'),
(66, 'Site Visit', 'Site Visit assign to Mr. Sanjay  Grover by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1718001398'),
(67, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 28, NULL, 26, '1718003064'),
(68, 'Booking', 'New Booking by Mr. Sanjay  Grover', 26, 39, NULL, 26, '1718037046'),
(69, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 41, NULL, 26, '1718349836'),
(70, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 42, NULL, 26, '1718696069'),
(71, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 43, NULL, 26, '1718705932'),
(72, 'Followup', 'Followup assign to Mr. Sunil  Kumar by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1718719953'),
(73, 'Site Visit', 'Site Visit assign to Mr. Sunil  Kumar by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1718719953'),
(74, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 44, NULL, 26, '1718769786'),
(75, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 42, NULL, 26, '1718865931'),
(76, 'Transfer Lead', 'Lead transfer to Mr. Sunil  Kumar by Mr. Sanjay  Grover', 26, 12, NULL, 26, '1718866208'),
(77, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 45, NULL, 26, '1718866659'),
(78, 'Lead Created', 'Lead created by Mr. Test Test2', 30, 46, NULL, 30, '1718866689'),
(79, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 47, NULL, 31, '1718950227'),
(80, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 47, NULL, 31, '1718950284'),
(81, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 48, NULL, 31, '1718950914'),
(82, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 48, NULL, 31, '1718950925'),
(83, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 49, NULL, 31, '1718950968'),
(84, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 48, NULL, 31, '1718951066'),
(85, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 48, NULL, 31, '1718951178'),
(86, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 50, NULL, 31, '1718951458'),
(87, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 51, NULL, 31, '1718951551'),
(88, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 52, NULL, 31, '1718951588'),
(89, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 53, NULL, 31, '1718951680'),
(90, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 54, NULL, 31, '1718951732'),
(91, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 55, NULL, 31, '1718951820'),
(92, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 56, NULL, 31, '1718951856'),
(93, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 57, NULL, 31, '1718951977'),
(94, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 49, NULL, 31, '1718952018'),
(95, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 57, NULL, 31, '1718952031'),
(96, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 56, NULL, 31, '1718952053'),
(97, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 55, NULL, 31, '1718952067'),
(98, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 54, NULL, 31, '1718952091'),
(99, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 53, NULL, 31, '1718952102'),
(100, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 52, NULL, 31, '1718952116'),
(101, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 51, NULL, 31, '1718952130'),
(102, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 50, NULL, 31, '1718952148'),
(103, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 47, NULL, 31, '1718952155'),
(104, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 47, NULL, 31, '1718952342'),
(105, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 58, NULL, 26, '1718952496'),
(106, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 59, NULL, 26, '1718952526'),
(107, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 60, NULL, 26, '1718952596'),
(108, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 61, NULL, 26, '1718952658'),
(109, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 62, NULL, 26, '1718952708'),
(110, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 63, NULL, 26, '1718952789'),
(111, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 64, NULL, 26, '1718952825'),
(112, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 65, NULL, 26, '1718952870'),
(113, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 66, NULL, 26, '1718952907'),
(114, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 51, NULL, 31, '1718953022'),
(115, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 51, NULL, 31, '1718953204'),
(116, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 67, NULL, 26, '1718953245'),
(117, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 68, NULL, 26, '1718953337'),
(118, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 69, NULL, 31, '1718954418'),
(119, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 57, NULL, 31, '1718954436'),
(120, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 70, NULL, 31, '1718954460'),
(121, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 57, NULL, 31, '1718954545'),
(122, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 71, NULL, 31, '1718954772'),
(123, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 72, NULL, 31, '1718954822'),
(124, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 73, NULL, 31, '1718954884'),
(125, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 74, NULL, 31, '1718954965'),
(126, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 75, NULL, 31, '1718954992'),
(127, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 76, NULL, 31, '1718955041'),
(128, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 74, NULL, 31, '1718955046'),
(129, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 77, NULL, 31, '1718955130'),
(130, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 78, NULL, 31, '1718955171'),
(131, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 78, NULL, 31, '1718955219'),
(132, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 77, NULL, 31, '1718955299'),
(133, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 76, NULL, 31, '1718955322'),
(134, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 75, NULL, 31, '1718955332'),
(135, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 73, NULL, 31, '1718955351'),
(136, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 74, NULL, 31, '1718955817'),
(137, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 69, NULL, 31, '1718955922'),
(138, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 71, NULL, 31, '1718955938'),
(139, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 70, NULL, 31, '1718955969'),
(140, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 72, NULL, 31, '1718956022'),
(141, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 73, NULL, 31, '1718956179'),
(142, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 73, NULL, 31, '1718956275'),
(143, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 69, NULL, 31, '1718956492'),
(144, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 69, NULL, 31, '1718956565'),
(145, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 70, NULL, 31, '1718956686'),
(146, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 70, NULL, 31, '1718957214'),
(147, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 72, NULL, 31, '1718959365'),
(148, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 72, NULL, 31, '1718959436'),
(149, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 79, NULL, 31, '1718959915'),
(150, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 79, NULL, 31, '1718960039'),
(151, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 79, NULL, 31, '1718960117'),
(152, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 80, NULL, 31, '1718960337'),
(153, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 80, NULL, 31, '1718960470'),
(154, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 80, NULL, 31, '1718960519'),
(155, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 81, NULL, 31, '1718960646'),
(156, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 82, NULL, 31, '1718960692'),
(157, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 83, NULL, 31, '1718960730'),
(158, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 84, NULL, 31, '1718960782'),
(159, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 84, NULL, 31, '1718960836'),
(160, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 84, NULL, 31, '1718960958'),
(161, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 85, NULL, 31, '1718961031'),
(162, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 85, NULL, 31, '1718961074'),
(163, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 85, NULL, 31, '1718961173'),
(164, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 81, NULL, 31, '1718961225'),
(165, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 81, NULL, 31, '1718961312'),
(166, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 82, NULL, 31, '1718961350'),
(167, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 82, NULL, 31, '1718961436'),
(168, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 83, NULL, 31, '1718961486'),
(169, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 83, NULL, 31, '1718961557'),
(170, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 86, NULL, 31, '1718962443'),
(171, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 86, NULL, 31, '1718962478'),
(172, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 86, NULL, 31, '1718962570'),
(173, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 87, NULL, 31, '1718963165'),
(174, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 87, NULL, 31, '1718963196'),
(175, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 87, NULL, 31, '1718963280'),
(176, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 88, NULL, 31, '1718969279'),
(177, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 88, NULL, 31, '1718969313'),
(178, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 88, NULL, 31, '1718969428'),
(179, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 89, NULL, 31, '1718970948'),
(180, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 89, NULL, 31, '1718970983'),
(181, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 89, NULL, 31, '1718971205'),
(182, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 90, NULL, 31, '1718971610'),
(183, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 91, NULL, 31, '1718972671'),
(184, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 92, NULL, 31, '1718972734'),
(185, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 93, NULL, 31, '1718972785'),
(186, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 93, NULL, 31, '1718972877'),
(187, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 92, NULL, 31, '1718972890'),
(188, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 91, NULL, 31, '1718972903'),
(189, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 92, NULL, 31, '1718973373'),
(190, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 92, NULL, 31, '1718973622'),
(191, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 91, NULL, 31, '1718974284'),
(192, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 91, NULL, 31, '1718974538'),
(193, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 94, NULL, 31, '1719026981'),
(194, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 95, NULL, 31, '1719027048'),
(195, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 96, NULL, 31, '1719027094'),
(196, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 90, NULL, 31, '1719027777'),
(197, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 96, NULL, 31, '1719027800'),
(198, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 95, NULL, 31, '1719027840'),
(199, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 88, NULL, 31, '1719033029'),
(200, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 48, NULL, 31, '1719033625'),
(201, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 97, NULL, 31, '1719035591'),
(202, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 97, NULL, 31, '1719035781'),
(203, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 97, NULL, 31, '1719036116'),
(204, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 93, NULL, 31, '1719040224'),
(205, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 93, NULL, 31, '1719040422'),
(206, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 98, NULL, 31, '1719069552'),
(207, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 99, NULL, 31, '1719069629'),
(208, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 100, NULL, 31, '1719069692'),
(209, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 101, NULL, 31, '1719069811'),
(210, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 94, NULL, 31, '1719069887'),
(211, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 101, NULL, 31, '1719069918'),
(212, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 100, NULL, 31, '1719069954'),
(213, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 99, NULL, 31, '1719069977'),
(214, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 98, NULL, 31, '1719069997'),
(215, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 102, NULL, 31, '1719106956'),
(216, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 103, NULL, 31, '1719107044'),
(217, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 104, NULL, 31, '1719107116'),
(218, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 104, NULL, 31, '1719107128'),
(219, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 103, NULL, 31, '1719107138'),
(220, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 102, NULL, 31, '1719107149'),
(221, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 84, NULL, 31, '1719119289'),
(222, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 104, NULL, 31, '1719120251'),
(223, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 104, NULL, 31, '1719120416'),
(224, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 101, NULL, 31, '1719121203'),
(225, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 101, NULL, 31, '1719121305'),
(226, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 105, NULL, 31, '1719121928'),
(227, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 105, NULL, 31, '1719121946'),
(228, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 96, NULL, 31, '1719124088'),
(229, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 96, NULL, 31, '1719124192'),
(230, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 96, NULL, 31, '1719124272'),
(231, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 106, NULL, 31, '1719135582'),
(232, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 106, NULL, 31, '1719135631'),
(233, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 106, NULL, 31, '1719135723'),
(234, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 107, NULL, 31, '1719138489'),
(235, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 107, NULL, 31, '1719138545'),
(236, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 107, NULL, 31, '1719138626'),
(237, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 108, NULL, 31, '1719143859'),
(238, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 108, NULL, 31, '1719143896'),
(239, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 108, NULL, 31, '1719144178'),
(240, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 109, NULL, 31, '1719198085'),
(241, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 110, NULL, 31, '1719198256'),
(242, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 111, NULL, 31, '1719198480'),
(243, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719207667'),
(244, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719207772'),
(245, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 109, NULL, 31, '1719208556'),
(246, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 110, NULL, 31, '1719208570'),
(247, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 111, NULL, 31, '1719208583'),
(248, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 112, NULL, 31, '1719208782'),
(249, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 98, NULL, 31, '1719208829'),
(250, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 113, NULL, 31, '1719208930'),
(251, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 114, NULL, 31, '1719208996'),
(252, 'Lead Created', 'Lead created by Ms. Priksha Sharma', 32, 115, NULL, 31, '1719209024'),
(253, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 116, NULL, 31, '1719209068'),
(254, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 116, NULL, 31, '1719209136'),
(255, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 115, NULL, 31, '1719209141'),
(256, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 114, NULL, 31, '1719209146'),
(257, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 113, NULL, 31, '1719209179'),
(258, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 112, NULL, 31, '1719209196'),
(259, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 117, NULL, 31, '1719212827'),
(260, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 84, NULL, 31, '1719212832'),
(261, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 90, NULL, 31, '1719213475'),
(262, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 90, NULL, 31, '1719213578'),
(263, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 108, NULL, 31, '1719214240'),
(264, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 107, NULL, 31, '1719214390'),
(265, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 72, NULL, 31, '1719218391'),
(266, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 81, NULL, 31, '1719218549'),
(267, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 82, NULL, 31, '1719218724'),
(268, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 113, NULL, 31, '1719220642'),
(269, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 113, NULL, 31, '1719220767'),
(270, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 112, NULL, 31, '1719220831'),
(271, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 112, NULL, 31, '1719220915'),
(272, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 110, NULL, 31, '1719221482'),
(273, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 109, NULL, 31, '1719221656'),
(274, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 118, NULL, 31, '1719222426'),
(275, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 119, NULL, 31, '1719222778'),
(276, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 120, NULL, 31, '1719222863'),
(277, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 118, NULL, 31, '1719222886'),
(278, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 119, NULL, 31, '1719222916'),
(279, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 120, NULL, 31, '1719222942'),
(280, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 121, NULL, 31, '1719225088'),
(281, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 121, NULL, 31, '1719225527'),
(282, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 121, NULL, 31, '1719226120'),
(283, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 120, NULL, 31, '1719226237'),
(284, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 120, NULL, 31, '1719226405'),
(285, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 52, NULL, 31, '1719228423'),
(286, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 55, NULL, 31, '1719228745'),
(287, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 122, NULL, 31, '1719380740'),
(288, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 123, NULL, 31, '1719381130'),
(289, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 124, NULL, 31, '1719381192'),
(290, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 125, NULL, 31, '1719381335'),
(291, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 126, NULL, 31, '1719381436'),
(292, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 127, NULL, 31, '1719381507'),
(293, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 127, NULL, 31, '1719381526'),
(294, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 126, NULL, 31, '1719381536'),
(295, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 125, NULL, 31, '1719381547'),
(296, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 127, NULL, 31, '1719381596'),
(297, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 126, NULL, 31, '1719381613'),
(298, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 124, NULL, 31, '1719381634'),
(299, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 127, NULL, 31, '1719381790'),
(300, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 123, NULL, 31, '1719381893'),
(301, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 122, NULL, 31, '1719381915'),
(302, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 127, NULL, 31, '1719382053'),
(303, 'Site Visit', 'Site Visit assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 127, NULL, 31, '1719382053'),
(304, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 128, NULL, 31, '1719382586'),
(305, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 129, NULL, 31, '1719382648'),
(306, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 123, NULL, 31, '1719382653'),
(307, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 130, NULL, 31, '1719382731'),
(308, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 131, NULL, 31, '1719382901'),
(309, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 122, NULL, 31, '1719382949'),
(310, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 132, NULL, 31, '1719382986'),
(311, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 133, NULL, 31, '1719383062'),
(312, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 134, NULL, 31, '1719383132'),
(313, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 134, NULL, 31, '1719383149'),
(314, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 133, NULL, 31, '1719383159'),
(315, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 132, NULL, 31, '1719383172'),
(316, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 122, NULL, 31, '1719383180'),
(317, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 131, NULL, 31, '1719383186'),
(318, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 130, NULL, 31, '1719383229'),
(319, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 129, NULL, 31, '1719383262'),
(320, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 126, NULL, 31, '1719383264'),
(321, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 134, NULL, 31, '1719383775'),
(322, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 134, NULL, 31, '1719383907'),
(323, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 111, NULL, 31, '1719386167'),
(324, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 53, NULL, 31, '1719391111'),
(325, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 53, NULL, 31, '1719391482'),
(326, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 114, NULL, 31, '1719391631'),
(327, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 114, NULL, 31, '1719391738'),
(328, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 56, NULL, 31, '1719391953'),
(329, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 56, NULL, 31, '1719392058'),
(330, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 53, NULL, 31, '1719394142'),
(331, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 131, NULL, 31, '1719465856'),
(332, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 128, NULL, 31, '1719465900'),
(333, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 86, NULL, 31, '1719466084'),
(334, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 135, NULL, 31, '1719466096'),
(335, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 136, NULL, 31, '1719466156'),
(336, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 137, NULL, 31, '1719466210'),
(337, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 138, NULL, 31, '1719466316'),
(338, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 139, NULL, 31, '1719466511'),
(339, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 140, NULL, 31, '1719466572'),
(340, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 49, NULL, 31, '1719466583'),
(341, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 141, NULL, 31, '1719466675'),
(342, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 50, NULL, 31, '1719466743'),
(343, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 142, NULL, 31, '1719466744'),
(344, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 54, NULL, 31, '1719466923'),
(345, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 143, NULL, 31, '1719467051'),
(346, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 71, NULL, 31, '1719467087'),
(347, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 143, NULL, 31, '1719467132'),
(348, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 142, NULL, 31, '1719467144'),
(349, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 142, NULL, 31, '1719467144'),
(350, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 141, NULL, 31, '1719467174'),
(351, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 140, NULL, 31, '1719467222'),
(352, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 139, NULL, 31, '1719467245'),
(353, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 138, NULL, 31, '1719467259'),
(354, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 137, NULL, 31, '1719467280'),
(355, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 136, NULL, 31, '1719467295'),
(356, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 75, NULL, 31, '1719467301'),
(357, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 135, NULL, 31, '1719467319'),
(358, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 77, NULL, 31, '1719467746'),
(359, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 77, NULL, 31, '1719468207'),
(360, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 143, NULL, 31, '1719468911'),
(361, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 143, NULL, 31, '1719469719'),
(362, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 140, NULL, 31, '1719470005'),
(363, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 140, NULL, 31, '1719470185'),
(364, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 136, NULL, 31, '1719470617'),
(365, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 133, NULL, 31, '1719471360'),
(366, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 115, NULL, 31, '1719472225'),
(367, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 103, NULL, 31, '1719472782'),
(368, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 128, NULL, 31, '1719480568'),
(369, 'Lead Added To Followup', 'Lead added to followup and assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 138, NULL, 31, '1719481296'),
(370, 'New Requirement', 'Requirement created by Ms. Priksha Sharma', 32, 138, NULL, 31, '1719481379'),
(371, 'Lead Added To Followup', 'Lead added to followup and assign to  by Ms. Priksha Sharma', 32, 141, NULL, 31, '1719481597'),
(372, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 134, NULL, 31, '1719481861'),
(373, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719483585'),
(374, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719483585'),
(375, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719483585'),
(376, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719483585'),
(377, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719483585'),
(378, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719483585'),
(379, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 100, NULL, 31, '1719483594'),
(380, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 120, NULL, 31, '1719484649'),
(381, 'Followup', 'Followup assign to  by Ms. Priksha Sharma', 32, 121, NULL, 31, '1719484747'),
(382, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 82, NULL, 31, '1719484878'),
(383, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 86, NULL, 31, '1719485757'),
(384, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 81, NULL, 31, '1719486543'),
(385, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 87, NULL, 31, '1719486840'),
(386, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 48, NULL, 31, '1719487201'),
(387, 'Followup', 'Followup assign to Ms. Priksha Sharma by Ms. Priksha Sharma', 32, 51, NULL, 31, '1719487376'),
(388, 'Followup', 'Followup assign to  by Ms. Priksha Sharma', 32, 92, NULL, 31, '1719487619'),
(389, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 144, NULL, 31, '1719499171'),
(390, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 145, NULL, 31, '1719499256'),
(391, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 146, NULL, 31, '1719499413'),
(392, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 147, NULL, 31, '1719499573'),
(393, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 148, NULL, 31, '1719499943'),
(394, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 148, NULL, 31, '1719499987'),
(395, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 147, NULL, 31, '1719500002'),
(396, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 146, NULL, 31, '1719500030'),
(397, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 145, NULL, 31, '1719500051'),
(398, 'Transfer Lead', 'Lead transfer to Ms. Priksha Sharma by Mr. AK Singhal', 31, 144, NULL, 31, '1719500079'),
(399, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 149, NULL, 31, '1719545508'),
(400, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 150, NULL, 31, '1719545580'),
(401, 'Lead Created', 'Lead created by Mr. AK Singhal', 31, 151, NULL, 31, '1719545684'),
(402, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 152, NULL, 26, '1719634354'),
(403, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 153, NULL, 26, '1719634433'),
(404, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 154, NULL, 26, '1719644796'),
(405, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 155, NULL, 26, '1719644796'),
(406, 'Lead Created', 'Lead created by Mr. Sanjay  Grover', 26, 156, NULL, 26, '1719644796'),
(407, 'Transfer Lead', 'Lead transfer to Mr. Sunil  Kumar by Mr. Sanjay  Grover', 26, 156, NULL, 26, '1719646862'),
(408, 'Transfer Lead', 'Lead transfer to Ms. Poonam Rajpoot by Mr. Sanjay  Grover', 26, 156, NULL, 26, '1719646880');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_options`
--

CREATE TABLE `tbl_lead_options` (
  `lead_option_id` int(11) NOT NULL,
  `lead_option_name` varchar(255) DEFAULT NULL,
  `lead_option_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead_options`
--

INSERT INTO `tbl_lead_options` (`lead_option_id`, `lead_option_name`, `lead_option_status`) VALUES
(1, 'For Sale', 1),
(2, 'For Rent', 1),
(3, 'For Buy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_sources`
--

CREATE TABLE `tbl_lead_sources` (
  `lead_source_id` int(11) NOT NULL,
  `lead_source_name` varchar(255) DEFAULT NULL,
  `lead_source_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead_sources`
--

INSERT INTO `tbl_lead_sources` (`lead_source_id`, `lead_source_name`, `lead_source_status`, `created_at`, `updated_at`) VALUES
(1, 'Magic Bricks', 1, '1574776828', '1574776828'),
(2, '99 Acres', 1, '1574776837', '1574776837'),
(3, 'Homeonline.com', 1, '1574776850', '1574776850'),
(4, 'Makaan.com', 1, '1574776869', '1574776869'),
(5, 'Walk in', 1, '1574776992', '1574776992'),
(6, 'Referance', 1, '1574777005', '1574777005'),
(7, 'New paper Adver.', 1, '1574777016', '1574777016'),
(8, 'web Site lead', 1, '1574777026', '1574777026'),
(9, 'Face Book Lead', 1, '1574777036', '1574777036'),
(10, 'IVR Lead', 1, '1574777055', '1574777055'),
(11, 'Google Ad world', 1, '1574777071', '1574777071'),
(12, 'Cold Call', 1, '1719108970', '1719108970');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_stages`
--

CREATE TABLE `tbl_lead_stages` (
  `lead_stage_id` int(11) NOT NULL,
  `lead_stage_name` varchar(255) DEFAULT NULL,
  `lead_stage_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead_stages`
--

INSERT INTO `tbl_lead_stages` (`lead_stage_id`, `lead_stage_name`, `lead_stage_status`, `created_at`, `updated_at`) VALUES
(1, 'Initial', 1, '1574777105', '1574777105'),
(2, 'Followup', 1, '1574777114', '1574777114'),
(3, 'Enquiry', 1, '1574777123', '1574777123'),
(4, 'Site Visit', 1, '1574777132', '1574777132'),
(5, 'Metting', 1, '1574777150', '1574777150'),
(6, 'Success ', 1, '1574777166', '1574777166'),
(7, 'Dump', 1, '1574777184', '1574777184');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_transfer`
--

CREATE TABLE `tbl_lead_transfer` (
  `lead_transfer_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `transfer_from` int(11) DEFAULT NULL,
  `transfer_to` int(11) DEFAULT NULL,
  `transfer_by` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead_transfer`
--

INSERT INTO `tbl_lead_transfer` (`lead_transfer_id`, `lead_id`, `transfer_from`, `transfer_to`, `transfer_by`, `created_at`) VALUES
(1, 4, 12, 13, 12, '1597907316'),
(2, 6, 13, 12, 12, '1600139716'),
(3, 5, 12, 21, 12, '1681813029'),
(4, 5, 21, 20, 12, '1681813315'),
(5, 5, 20, 12, 12, '1681813408'),
(6, 5, 12, 20, 0, '1681815616'),
(7, 5, 20, 21, 0, '1681815660'),
(8, 24, 12, 20, 12, '1716457827'),
(9, 23, 12, 20, 12, '1716457892'),
(10, 22, 12, 20, 12, '1716457907'),
(11, 11, 26, 27, 26, '1716521065'),
(12, 10, 26, 27, 26, '1716521104'),
(13, 9, 26, 27, 26, '1716521135'),
(14, 8, 26, 27, 26, '1716521151'),
(15, 7, 26, 27, 26, '1716521171'),
(16, 6, 26, 27, 26, '1716521197'),
(17, 5, 26, 27, 26, '1716521232'),
(18, 4, 26, 27, 26, '1716521257'),
(19, 3, 26, 27, 26, '1716521291'),
(20, 2, 26, 27, 26, '1716521314'),
(21, 28, 28, 26, 26, '1717920093'),
(22, 26, 28, 26, 26, '1717920133'),
(23, 40, 26, 27, 26, '1718000755'),
(24, 14, 28, 27, 26, '1718000785'),
(25, 28, 26, 27, 26, '1718003064'),
(26, 42, 26, 27, 26, '1718865931'),
(27, 12, 26, 28, 26, '1718866208'),
(28, 47, 31, 32, 31, '1718950284'),
(29, 48, 31, 32, 31, '1718950925'),
(30, 49, 31, 32, 31, '1718952018'),
(31, 57, 31, 32, 31, '1718952031'),
(32, 56, 31, 32, 31, '1718952053'),
(33, 55, 31, 32, 31, '1718952067'),
(34, 54, 31, 32, 31, '1718952091'),
(35, 53, 31, 32, 31, '1718952102'),
(36, 52, 31, 32, 31, '1718952116'),
(37, 51, 31, 32, 31, '1718952130'),
(38, 50, 31, 32, 31, '1718952148'),
(39, 78, 31, 32, 31, '1718955219'),
(40, 77, 31, 32, 31, '1718955299'),
(41, 76, 31, 32, 31, '1718955322'),
(42, 75, 31, 32, 31, '1718955332'),
(43, 73, 31, 32, 31, '1718955351'),
(44, 69, 31, 32, 31, '1718955922'),
(45, 71, 31, 32, 31, '1718955938'),
(46, 70, 31, 32, 31, '1718955969'),
(47, 72, 31, 32, 31, '1718956022'),
(48, 93, 31, 32, 31, '1718972877'),
(49, 92, 31, 32, 31, '1718972890'),
(50, 91, 31, 32, 31, '1718972903'),
(51, 90, 31, 32, 31, '1719027777'),
(52, 96, 31, 32, 31, '1719027800'),
(53, 95, 31, 32, 31, '1719027840'),
(54, 94, 31, 32, 31, '1719069887'),
(55, 101, 31, 32, 31, '1719069918'),
(56, 100, 31, 32, 31, '1719069954'),
(57, 99, 31, 32, 31, '1719069977'),
(58, 98, 31, 32, 31, '1719069997'),
(59, 104, 31, 32, 31, '1719107128'),
(60, 103, 31, 32, 31, '1719107138'),
(61, 102, 31, 32, 31, '1719107149'),
(62, 105, 31, 32, 31, '1719121946'),
(63, 109, 31, 32, 31, '1719208556'),
(64, 110, 31, 32, 31, '1719208570'),
(65, 111, 31, 32, 31, '1719208583'),
(66, 116, 31, 32, 31, '1719209136'),
(67, 114, 31, 32, 31, '1719209146'),
(68, 113, 31, 32, 31, '1719209179'),
(69, 112, 31, 32, 31, '1719209196'),
(70, 118, 31, 32, 31, '1719222886'),
(71, 119, 31, 32, 31, '1719222916'),
(72, 120, 31, 32, 31, '1719222942'),
(73, 121, 31, 32, 31, '1719225527'),
(74, 127, 31, 32, 31, '1719381526'),
(75, 126, 31, 32, 31, '1719381536'),
(76, 125, 31, 32, 31, '1719381547'),
(77, 126, 31, 32, 31, '1719381613'),
(78, 124, 31, 32, 31, '1719381633'),
(79, 123, 31, 32, 31, '1719381893'),
(80, 122, 31, 32, 31, '1719381915'),
(81, 134, 31, 32, 31, '1719383149'),
(82, 133, 31, 32, 31, '1719383159'),
(83, 132, 31, 32, 31, '1719383172'),
(84, 131, 31, 32, 31, '1719383186'),
(85, 130, 31, 32, 31, '1719383229'),
(86, 129, 31, 32, 31, '1719383262'),
(87, 131, 31, 32, 31, '1719465856'),
(88, 128, 31, 32, 31, '1719465900'),
(89, 143, 31, 32, 31, '1719467132'),
(90, 142, 31, 32, 31, '1719467144'),
(91, 142, 32, 32, 31, '1719467144'),
(92, 141, 31, 32, 31, '1719467174'),
(93, 140, 31, 32, 31, '1719467222'),
(94, 139, 31, 32, 31, '1719467245'),
(95, 138, 31, 32, 31, '1719467259'),
(96, 137, 31, 32, 31, '1719467280'),
(97, 136, 31, 32, 31, '1719467295'),
(98, 135, 31, 32, 31, '1719467319'),
(99, 148, 31, 32, 31, '1719499987'),
(100, 147, 31, 32, 31, '1719500002'),
(101, 146, 31, 32, 31, '1719500030'),
(102, 145, 31, 32, 31, '1719500051'),
(103, 144, 31, 32, 31, '1719500079'),
(104, 156, 26, 28, 26, '1719646862'),
(105, 156, 28, 27, 26, '1719646880');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_types`
--

CREATE TABLE `tbl_lead_types` (
  `lead_type_id` int(11) NOT NULL,
  `lead_type_name` varchar(255) DEFAULT NULL,
  `lead_type_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead_types`
--

INSERT INTO `tbl_lead_types` (`lead_type_id`, `lead_type_name`, `lead_type_status`, `created_at`, `updated_at`) VALUES
(1, 'Active', 1, '1574845925', '1574845925'),
(2, 'InActive', 1, '1574845938', '1719108932'),
(3, 'Success', 1, '1574845954', '1574845954');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listing_types`
--

CREATE TABLE `tbl_listing_types` (
  `listing_type_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `listing_type_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_listing_types`
--

INSERT INTO `tbl_listing_types` (`listing_type_id`, `title`, `listing_type_status`) VALUES
(1, 'For Rent', 1),
(2, 'For Sale', 1),
(3, 'For PG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locations`
--

CREATE TABLE `tbl_locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `location_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_locations`
--

INSERT INTO `tbl_locations` (`location_id`, `location_name`, `state_id`, `city_id`, `location_status`, `created_at`, `updated_at`) VALUES
(2, 'Ghatwa', 8, 488, 1, '1573212059', '1574146375'),
(3, 'Pratap Nagar', 8, 474, 1, '1574276639', '1574276639'),
(4, 'Vaishali Nagar', 8, 474, 1, '1574276672', '1574276672'),
(5, 'Ajmer Road', 8, 474, 1, '1574317937', '1574317937'),
(6, 'Vaishali Nagar Ext.', 8, 474, 1, '1574339268', '1574339268'),
(7, 'Nirman nagar', 8, 474, 1, '1574339292', '1574339292'),
(8, 'Shyam nagar', 8, 474, 1, '1574339318', '1574339318'),
(9, 'Mansarovar ', 8, 474, 1, '1574339335', '1574339335'),
(10, 'Mansarovar Ext.', 8, 474, 1, '1574339345', '1574339345'),
(11, 'Jagatpura', 8, 474, 1, '1574339376', '1574339376'),
(12, 'Tonk Road', 8, 474, 1, '1574339395', '1574339395'),
(13, 'Sitapura Industrial Area', 8, 474, 1, '1574339412', '1574339412'),
(14, 'Malviya Nagar', 8, 474, 1, '1574339434', '1574339434'),
(15, 'JAWAHAR NAGAR', 8, 474, 1, '1574339446', '1574339446'),
(16, 'DURGAPURA', 8, 474, 1, '1574339464', '1574339464'),
(17, 'Bani park', 8, 474, 1, '1574339481', '1574339481'),
(18, 'C-Scheme', 8, 474, 1, '1574339507', '1574339507'),
(19, 'Gopalpura By pass', 8, 474, 1, '1574339526', '1574339526'),
(20, 'Sirsi Road', 8, 474, 1, '1574339546', '1574339546'),
(21, 'Rani Sati Nagar', 8, 474, 1, '1574339568', '1574339568'),
(22, 'Jaipur/Delhi Road', 8, 401, 1, '1574339607', '1574339725'),
(23, 'Sadul Ganj', 8, 401, 1, '1574339619', '1574339619'),
(24, 'NH-15', 8, 401, 1, '1574339633', '1574339633'),
(25, 'Sardar Shehar', 8, 401, 1, '1574339645', '1574339645'),
(26, 'Rani bazar', 8, 401, 1, '1574339660', '1574339660'),
(27, 'Jaisalmer Road', 8, 401, 1, '1574339678', '1574339678'),
(28, 'Marudhara Nagar', 8, 401, 1, '1574339746', '1574339746'),
(29, 'JNV (Jai Narayan Vyas Colony)', 8, 401, 1, '1574339764', '1574339764'),
(30, 'Pawan Puri', 8, 401, 1, '1574339790', '1574339790'),
(31, 'Sector - 84', 6, 347, 1, '1680240413', '1680240413'),
(32, 'Sector - 90', 6, 347, 1, '1680240439', '1680240439'),
(33, 'Sector - 92', 6, 347, 1, '1680240468', '1680240468'),
(34, 'Sector - 89', 6, 347, 1, '1716474300', '1716474597'),
(35, 'Sector - 79', 6, 347, 1, '1716474333', '1716474607'),
(36, 'Sector - 47', 6, 347, 1, '1716474373', '1716474615'),
(37, 'Sector - 91', 6, 347, 1, '1716474429', '1716474623'),
(38, 'Sector - 93', 6, 347, 1, '1716474728', '1716474728'),
(39, 'Sector - 94', 6, 347, 1, '1716474750', '1716474750'),
(40, 'Sector - 85', 6, 347, 1, '1716474963', '1716474963'),
(41, 'Sector - 86', 6, 347, 1, '1716475008', '1716475008'),
(42, 'Sector - 87', 6, 347, 1, '1716475031', '1716475031'),
(43, 'Sector - 88', 6, 347, 1, '1716475052', '1716475052'),
(44, 'Sector - 95', 6, 347, 1, '1716475115', '1716475115'),
(45, 'Sector - 70', 6, 347, 1, '1716647222', '1716647222'),
(46, 'Sector - 71', 6, 347, 1, '1716647316', '1716647316'),
(47, 'Sector - 72', 6, 347, 1, '1716647341', '1716647341'),
(48, 'Sector - 73', 6, 347, 1, '1716647358', '1716647358'),
(49, 'Sector - 74', 6, 347, 1, '1716647387', '1716647387'),
(50, 'Sector - 75', 6, 347, 1, '1716647407', '1716647407'),
(51, 'Sector - 76', 6, 347, 1, '1716647443', '1716647443'),
(52, 'Sector - 77', 6, 347, 1, '1716647490', '1716647490'),
(53, 'Sector - 78', 6, 347, 1, '1716647510', '1716647510'),
(54, 'Sector - 102', 6, 347, 1, '1718953191', '1718953191'),
(55, 'Sector - 49', 6, 347, 1, '1718954539', '1718954539'),
(56, 'Sector - 37D', 6, 347, 1, '1718955808', '1718955808'),
(57, 'Sector - 9, Manesar ', 6, 347, 1, '1719018144', '1719018144'),
(58, 'Sector - 01', 6, 347, 1, '1719021621', '1719022238'),
(59, 'Sector - 02', 6, 347, 1, '1719021646', '1719022258'),
(60, 'Sector - 03', 6, 347, 1, '1719021666', '1719022272'),
(61, 'Sector - 04', 6, 347, 1, '1719021679', '1719022280'),
(62, 'Sector - 05', 6, 347, 1, '1719021694', '1719022291'),
(63, 'Sector - 06', 6, 347, 1, '1719021721', '1719022223'),
(64, 'Sector - 07', 6, 347, 1, '1719021754', '1719022301'),
(65, 'Sector - 08', 6, 347, 1, '1719021771', '1719022313'),
(66, 'Sector - 09', 6, 347, 1, '1719021796', '1719022323'),
(67, 'Sector - 9A', 6, 347, 1, '1719021811', '1719021811'),
(68, 'Sector - 10', 6, 347, 1, '1719021826', '1719021826'),
(69, 'Sector - 10A', 6, 347, 1, '1719021844', '1719021844'),
(70, 'Sector - 11', 6, 347, 1, '1719021859', '1719021859'),
(71, 'Sector - 80', 6, 347, 1, '1719021930', '1719021930'),
(72, 'Sector - 81', 6, 347, 1, '1719021939', '1719021939'),
(73, 'Sector - 82', 6, 347, 1, '1719021956', '1719021956'),
(74, 'Sector - 82A', 6, 347, 1, '1719021970', '1719021970'),
(75, 'Sector - 83', 6, 347, 1, '1719021986', '1719021986'),
(76, 'Sector - 70A', 6, 347, 1, '1719022031', '1719022031'),
(77, 'Sector - 69', 6, 347, 1, '1719022045', '1719022045'),
(78, 'Sector - 68', 6, 347, 1, '1719022063', '1719022063'),
(79, 'Sector - 67', 6, 347, 1, '1719022078', '1719022078'),
(80, 'Sector - 66', 6, 347, 1, '1719022089', '1719022089'),
(81, 'Sector - 65', 6, 347, 1, '1719022107', '1719022107'),
(82, 'Sector - 64', 6, 347, 1, '1719022119', '1719022119'),
(83, 'Sector - 63', 6, 347, 1, '1719022136', '1719022136'),
(84, 'Sector - 63A', 6, 347, 1, '1719022149', '1719022149'),
(85, 'Sector - 62', 6, 347, 1, '1719022161', '1719022161'),
(86, 'Sector - 61', 6, 347, 1, '1719022187', '1719022187'),
(87, 'Sector - 60', 6, 347, 1, '1719022341', '1719022341'),
(88, 'Sector - 50', 6, 347, 1, '1719022373', '1719022373'),
(89, 'Sector - 51', 6, 347, 1, '1719022384', '1719022384'),
(90, 'Sector - 52', 6, 347, 1, '1719022405', '1719022405'),
(91, 'Sector - 53', 6, 347, 1, '1719022419', '1719022419'),
(92, 'Sector - 54', 6, 347, 1, '1719022430', '1719022430'),
(93, 'Sector - 55', 6, 347, 1, '1719022448', '1719022448'),
(94, 'Sector - 56', 6, 347, 1, '1719022476', '1719022476'),
(95, 'Sector - 57', 6, 347, 1, '1719022493', '1719022493'),
(96, 'Sector - 58', 6, 347, 1, '1719022513', '1719022513'),
(97, 'Sector - 59', 6, 347, 1, '1719022529', '1719022529'),
(98, 'Sector - 48', 6, 347, 1, '1719022573', '1719022573'),
(99, 'Sector - 40', 6, 347, 1, '1719022591', '1719022591'),
(100, 'Sector - 41', 6, 347, 1, '1719022604', '1719022604'),
(101, 'Sector - 42', 6, 347, 1, '1719022621', '1719022621'),
(102, 'Sector - 43', 6, 347, 1, '1719022636', '1719022636'),
(103, 'Sector - 44', 6, 347, 1, '1719022651', '1719022651'),
(104, 'Sector - 45', 6, 347, 1, '1719022688', '1719022688'),
(105, 'Sector - 46', 6, 347, 1, '1719022702', '1719022702'),
(106, 'Sector - 30', 6, 347, 1, '1719022780', '1719022780'),
(107, 'Sector - 31', 6, 347, 1, '1719022799', '1719022799'),
(108, 'Sector - 32', 6, 347, 1, '1719022813', '1719022813'),
(109, 'Sector - 33', 6, 347, 1, '1719022827', '1719022827'),
(110, 'Sector - 34', 6, 347, 1, '1719022847', '1719022847'),
(111, 'Sector - 35', 6, 347, 1, '1719022862', '1719022862'),
(112, 'Sector - 36', 6, 347, 1, '1719022876', '1719022876'),
(113, 'Sector - 36A', 6, 347, 1, '1719022897', '1719022897'),
(114, 'Sector - 38', 6, 347, 1, '1719022916', '1719022916'),
(115, 'Sector - 39', 6, 347, 1, '1719022935', '1719022935'),
(116, 'Sector - 96', 6, 347, 1, '1719022973', '1719022973'),
(117, 'Sector - 97', 6, 347, 1, '1719022987', '1719022987'),
(118, 'Sector - 98', 6, 347, 1, '1719022998', '1719022998'),
(119, 'Sector - 99', 6, 347, 1, '1719023012', '1719023012'),
(120, 'Sector - 99A', 6, 347, 1, '1719023027', '1719023027'),
(121, 'Sector - 100', 6, 347, 1, '1719023040', '1719023040'),
(122, 'Sector - 101', 6, 347, 1, '1719023061', '1719023061'),
(123, 'Sector - 103', 6, 347, 1, '1719023077', '1719023077'),
(124, 'Sector - 104', 6, 347, 1, '1719023093', '1719023093'),
(125, 'Sector - 105', 6, 347, 1, '1719023108', '1719023108'),
(126, 'Sector - 106', 6, 347, 1, '1719023124', '1719023124'),
(127, 'Sector - 107', 6, 347, 1, '1719023143', '1719023143'),
(128, 'Sector - 108', 6, 347, 1, '1719023165', '1719023165'),
(129, 'Sector - 109', 6, 347, 1, '1719023182', '1719023182'),
(130, 'Sector - 110', 6, 347, 1, '1719023195', '1719023195'),
(131, 'Sector - 111', 6, 347, 1, '1719023210', '1719023210'),
(132, 'Sector - 112', 6, 347, 1, '1719023223', '1719023223'),
(133, 'Sector - 113', 6, 347, 1, '1719023236', '1719023236'),
(134, 'Sector - 114', 6, 347, 1, '1719023248', '1719023248'),
(135, 'Sector - 115', 6, 347, 1, '1719023261', '1719023261'),
(136, 'DLF PHASE -  1', 6, 347, 1, '1719470803', '1719470803'),
(137, 'DLF PHASE- 2', 6, 347, 1, '1719470834', '1719470834'),
(138, 'DLF PHASE - 3', 6, 347, 1, '1719470860', '1719470889'),
(139, 'DLF PHASE - 4', 6, 347, 1, '1719470918', '1719470918'),
(140, 'DLF PHASE - 5', 6, 347, 1, '1719470982', '1719470982');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `module_code` varchar(255) DEFAULT NULL,
  `module_order` int(11) DEFAULT NULL,
  `module_page_name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `perm_create` tinyint(1) NOT NULL DEFAULT 0,
  `perm_edit` tinyint(1) NOT NULL DEFAULT 0,
  `perm_delete` tinyint(1) NOT NULL DEFAULT 0,
  `perm_view` tinyint(1) NOT NULL DEFAULT 0,
  `module_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(255) DEFAULT NULL,
  `updated_at` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`module_id`, `module_name`, `module_code`, `module_order`, `module_page_name`, `parent_id`, `perm_create`, `perm_edit`, `perm_delete`, `perm_view`, `module_status`, `created_at`, `updated_at`) VALUES
(1, 'Leads', 'leads', NULL, '', 0, 1, 1, 1, 1, 1, 1588571484, 1588571918),
(2, 'Followup', 'followup', NULL, '', 0, 0, 0, 0, 0, 1, 1588571603, 1588593232),
(3, 'Followup Profile', 'followup_profile', NULL, '', 0, 0, 1, 0, 1, 1, 1588571656, 1588592908),
(4, 'Followup Requirement', 'followup_requirement', NULL, '', 0, 1, 1, 1, 1, 1, 1588571686, 1588571686),
(5, 'Followup Followup', 'followup_followup', NULL, '', 0, 1, 1, 1, 1, 1, 1588571719, 1588571719),
(6, 'Followup History', 'followup_history', NULL, '', 0, 0, 0, 0, 1, 1, 1588571740, 1588592926),
(7, 'Followup Product', 'followup_product', NULL, '', 0, 0, 1, 0, 1, 1, 1588571758, 1588593133),
(8, 'Followup Search', 'followup_search', NULL, '', 0, 0, 0, 0, 1, 1, 1588571779, 1588571879),
(9, 'Followup Advance Search', 'followup_advance_search', NULL, '', 0, 0, 0, 0, 1, 1, 1588571820, 1588571833),
(10, 'Followup Download', 'followup_download', NULL, '', 0, 0, 0, 0, 1, 1, 1588571861, 1588571869),
(11, 'Product', 'product', NULL, '', 0, 0, 0, 0, 0, 1, 1588571983, 1588593246),
(12, 'Product List', 'product_list', NULL, '', 0, 0, 0, 0, 1, 1, 1588572010, 1588592800),
(13, 'Product Project', 'product_project', NULL, '', 0, 0, 0, 0, 1, 1, 1588572039, 1588592708),
(14, 'Product Property', 'product_property', NULL, '', 0, 1, 1, 1, 1, 1, 1588572107, 1588572107),
(15, 'Product Manage Inventory', 'product_manage_inventory', NULL, '', 0, 0, 0, 0, 1, 1, 1588572133, 1588591912),
(16, 'Product Update Inventory', 'product_update_inventory', NULL, '', 0, 0, 0, 0, 1, 1, 1588572154, 1588591898),
(17, 'Product Update Ad Cost', 'product_update_ad_cost', NULL, '', 0, 0, 0, 0, 1, 1, 1588572217, 1588591855),
(18, 'Product Update Basic Cost', 'product_update_basic_cost', NULL, '', 0, 0, 0, 0, 1, 1, 1588572239, 1588591889),
(19, 'Customer', 'customer', NULL, '', 0, 0, 0, 0, 1, 1, 1588591554, 1588591563),
(20, 'Chat', 'chat', NULL, '', 0, 0, 0, 0, 1, 1, 1588591593, 1588591606),
(21, 'Setting ', 'setting', NULL, '', 0, 0, 0, 0, 0, 1, 1588591651, 1588593226),
(22, 'Setting My Account', 'setting_my_account', NULL, '', 0, 0, 0, 0, 1, 1, 1588591734, 1588591744),
(23, 'Setting  Email Configration', 'setting_email_configration', NULL, '', 0, 0, 0, 0, 1, 1, 1588591785, 1588591795),
(24, 'Teams', 'teams', NULL, '', 0, 1, 1, 1, 1, 1, 1588599246, 1588599246),
(25, 'Setting SMS Configration', 'setting_sms_configration', NULL, '', 0, 0, 0, 0, 1, 1, 1588829449, 1588829459),
(26, 'Setting Online Portal Api', 'setting_online_portal_api', NULL, '', 0, 0, 0, 0, 1, 1, 1588829537, 1588829548),
(27, 'Setting Auto Dialer Option', 'setting_auto_dialer_option', NULL, '', 0, 0, 0, 0, 1, 1, 1588829537, 1588829548),
(28, 'Setting Templet', 'setting_templet', NULL, '', 0, 0, 0, 0, 1, 1, 1588829537, 1588829548),
(29, 'Project', 'project', NULL, '', 0, 1, 1, 1, 1, 1, 1588829537, 1588829548);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_occupations`
--

CREATE TABLE `tbl_occupations` (
  `occupation_id` int(11) NOT NULL,
  `occupation_name` varchar(255) DEFAULT NULL,
  `occupation_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_occupations`
--

INSERT INTO `tbl_occupations` (`occupation_id`, `occupation_name`, `occupation_status`, `created_at`, `updated_at`) VALUES
(3, 'Business Class', 1, '1574512062', '1574512062'),
(4, 'Service Class- Private', 1, '1574512074', '1574512074'),
(5, 'Service Class- Government ', 1, '1574512083', '1574512083');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `otp_id` int(11) NOT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `otp_type` int(1) DEFAULT NULL COMMENT '1: register',
  `create_at` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_otp`
--

INSERT INTO `tbl_otp` (`otp_id`, `otp`, `mobile`, `otp_type`, `create_at`, `update_at`) VALUES
(2, '9347', '8791346601', 1, '1716456257', '1716456297');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paid_type`
--

CREATE TABLE `tbl_paid_type` (
  `paid_type_id` int(11) NOT NULL,
  `paid_type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_paid_type`
--

INSERT INTO `tbl_paid_type` (`paid_type_id`, `paid_type_name`) VALUES
(1, 'Paytm'),
(2, 'Cash'),
(3, 'Cheque'),
(4, 'UPI'),
(5, 'TRF');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `no_of_user` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount_per_user` decimal(10,2) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:pending, 1:success, 2:failed',
  `order_id` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `txn_date` varchar(255) DEFAULT NULL,
  `txn_status` varchar(255) DEFAULT NULL,
  `payment_getway` varchar(255) DEFAULT NULL,
  `current_plan_date` varchar(255) DEFAULT NULL,
  `next_due_date` varchar(255) DEFAULT NULL,
  `create_at` varchar(255) DEFAULT NULL,
  `entry_type` tinyint(1) DEFAULT NULL COMMENT '1:Custom, 2:Invoice',
  `monthly_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invoice_type` tinyint(11) DEFAULT 0 COMMENT '1:Performa Invoice,2: TAX Invoice',
  `invoice_date` varchar(255) DEFAULT NULL,
  `receipt_date` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cancel_reason` text DEFAULT NULL,
  `cancel_time` varchar(255) DEFAULT NULL,
  `paid_type` int(11) DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `cheque_date` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `receipt_remark` text DEFAULT NULL,
  `invoice_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `user_id`, `plan_id`, `no_of_user`, `total_amount`, `amount_per_user`, `payment_status`, `order_id`, `txn_id`, `payment_mode`, `txn_date`, `txn_status`, `payment_getway`, `current_plan_date`, `next_due_date`, `create_at`, `entry_type`, `monthly_cost`, `invoice_type`, `invoice_date`, `receipt_date`, `name`, `state`, `city`, `address`, `mobile`, `email`, `cancel_reason`, `cancel_time`, `paid_type`, `cheque_no`, `cheque_date`, `bank_name`, `receipt_remark`, `invoice_id`) VALUES
(1, 20, 2, 1, '500.00', '500.00', 1, '80103b1ff70a5605bb1203c55d2e06e31227454cecc4829279e64d624cd8a8c9ddf1', '20200911111212800110168193401899044', 'NB', '2020-09-11 17:17:44.0', 'TXN_SUCCESS', 'Paytm', '12-09-2020', '12-10-2020', '1599824861', 1, '0.00', 0, '11-09-2020', '11-09-2020', 'Mr. Rakesh Kumar', 'RAJASTHAN', 'Jaipur', 'j', 'dffdfdf', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0001'),
(2, 20, 2, 1, '600.00', '500.00', 1, 'ab231907356386eda996344e9ea153fd837613aa032c050c662b5a61369eea82681c1', '20200911111212800110168070301896049', 'NB', '2020-09-11 17:24:12.0', 'TXN_SUCCESS', 'Paytm', '12-10-2020', '12-11-2020', '1599825199', 2, '100.00', 1, '11-09-2020', '11-09-2020', 'Mr. Rakesh Kumar', 'RAJASTHAN', 'Jaipur', 'j', 'dffdfdf', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0002'),
(3, 20, 2, 1, '600.00', '500.00', 1, '5a251064a6fd02611effe20cd0dec5c4247319fb92dbe14e7ced09c12c56f0a6912b1', '20200911111212800110168947301893929', 'NB', '2020-09-11 17:26:40.0', 'TXN_SUCCESS', 'Paytm', '12-11-2020', '12-12-2020', '1599825354', 2, '100.00', 1, '11-09-2020', '11-09-2020', 'Mr. Rakesh Kumar', 'RAJASTHAN', 'Jaipur', 'j', 'dffdfdf', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0003'),
(4, 20, 2, 1, '600.00', '500.00', 1, '522c376d042407f940ddabc303bd85996834d0921d442ee91b896ad95059d13df618', '20200911111212800110168527201925291', 'NB', '2020-09-11 17:28:04.0', 'TXN_SUCCESS', 'Paytm', '12-09-2020', '12-10-2020', '1599825482', 1, '100.00', 0, '11-09-2020', '11-09-2020', 'Mr. Rakesh Kumar', 'RAJASTHAN', 'Jaipur', 'j', 'dffdfdf', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0004'),
(5, 20, 2, 1, '600.00', '500.00', 1, 'e6a135798010ed940905bf90f1e72bfa521382c6ee860dfb322d0fc5dbbf5a2aa0b39', '20200911111212800110168328001922028', 'NB', '2020-09-11 17:32:08.0', 'TXN_SUCCESS', 'Paytm', '12-10-2020', '12-11-2020', '1599825597', 2, '100.00', 1, '11-09-2020', '11-09-2020', 'Mr. Rakesh Kumar', 'RAJASTHAN', 'Jaipur', 'j', 'dffdfdf', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0005'),
(6, 15, 2, 1, '1500.00', '500.00', 0, 'a9a1bb32de47dbe14b12a94c083bcc11369712cb68e802e8526c54e727af156c898e7', NULL, NULL, NULL, NULL, '', '09-10-2020', '09-11-2020', '1599832347', 2, '1000.00', 1, '11-09-2020', NULL, 'Mr. Rakesh Kumar', 'RAJASTHAN', 'Jaipur', 'Jaipur', '8005756759', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 0, NULL, NULL, NULL, NULL, '0006'),
(7, 17, 2, 1, '1300.00', '300.00', 2, '6c0a117af47efc599f829c95b645d13b9192c7b03782920d35145eb4c97556d194a3', '20200912111212800110168283601901526', 'NB', '2020-09-12 13:07:20.0', 'TXN_FAILURE', 'Paytm', '11-09-2020', '11-10-2020', '1599896238', 1, '1000.00', 0, '12-09-2020', NULL, NULL, 'DELHI', 'Rajouri Garden', '', '9694222444', 'anshikacreations19@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0007'),
(8, 17, 2, 1, '1300.00', '300.00', 1, 'a9de2d7946853ed2b6b6b81e0fa99eab87224ab50afd6dcc95fcba76d0fe04295632', '20200912111212800110168871001893501', 'NB', '2020-09-12 13:07:56.0', 'TXN_SUCCESS', 'Paytm', '11-09-2020', '11-10-2020', '1599896276', 1, '1000.00', 0, '12-09-2020', '12-09-2020', NULL, 'DELHI', 'Rajouri Garden', '', '9694222444', 'anshikacreations19@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0008'),
(9, 17, 2, 1, '1300.00', '300.00', 0, 'def1b51b3639e47d85260e229bae87b117071e395ecb7abdec5a7478e2ef5562456d9', NULL, NULL, NULL, NULL, '', '11-10-2020', '11-11-2020', '1599896479', 2, '1000.00', 1, '12-09-2020', NULL, '', 'DELHI', 'Rajouri Garden', '', '9694222444', 'anshikacreations19@gmail.com', NULL, NULL, 0, NULL, NULL, NULL, NULL, '0009'),
(10, 12, 2, 1, '1500.00', '500.00', 0, '4cb1cc2fa2ced49669efa4b128a685a9887301f21a1a957ae8783bfe33f3bdea38de1', NULL, NULL, NULL, NULL, '', '10-10-2020', '10-11-2020', '1600398369', 2, '1000.00', 1, '18-09-2020', NULL, 'Click4assists.com', 'RAJASTHAN', 'Jaipur', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '1111111111', 'click4assists@gmail.com', NULL, NULL, 0, NULL, NULL, NULL, NULL, '0010'),
(11, 15, 2, 1, '1500.00', '500.00', 0, 'a46956a7b26dde52b657bf5b6090e536567664668c712bb7bf79b28f0489afb7ecc58', NULL, NULL, NULL, NULL, '', '18-09-2020', '18-10-2020', '1600404460', 2, '1000.00', 1, '18-09-2020', NULL, 'Mr. Rakesh Kumar', 'RAJASTHAN', 'Jaipur', 'Jaipur', '8005756759', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 0, NULL, NULL, NULL, NULL, '0011'),
(12, 12, 2, 1, '1500.00', '500.00', 1, 'a5e892e349f7c3447b73cdab3b0d2cdb2065a9c397afa342c368ba24e7620ee41a94', '20201018111212800110168982702003334', 'NB', '2020-10-18 16:07:12.0', 'TXN_SUCCESS', 'Paytm', '10-10-2020', '10-11-2020', '1603017431', 1, '1000.00', 0, '18-10-2020', '18-10-2020', 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '1111111111', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0012'),
(13, 14, 2, 1, '500.00', '500.00', 1, '12102acd8a463a88ead1c075f0249933949258182b82110146887c02dbd78719e3d5', '20201103111212800110168668002051859', 'NB', '2020-11-03 22:02:01.0', 'TXN_SUCCESS', 'Paytm', '04-10-2020', '04-11-2020', '1604421119', 1, '0.00', 0, '03-11-2020', '03-11-2020', 'Aarav Buildhomes Pvt Ltd.', '8', '427', 'B-52, Ambedkar Nagar', '1313131313', 'aaravbuildhomes@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0013'),
(14, 12, 2, 1, '1500.00', '500.00', 2, '3826ca5194027341c13a4eef0755b60c749707ac7cd13fd0eb1654ccdbd222b81437', '20201104111212800110168263302050492', 'NB', '2020-11-04 11:50:21.0', 'TXN_FAILURE', 'Paytm', '10-11-2020', '10-12-2020', '1604470820', 1, '1000.00', 0, '04-11-2020', NULL, 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '1111111111', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0014'),
(15, 12, 2, 1, '1500.00', '500.00', 1, 'd0096d5dc71b2bfad092bac81a477c67531901d8bae291b1e4724443375634ccfa0e', '20201111111212800110168152702083870', 'NB', '2020-11-11 13:36:34.0', 'TXN_SUCCESS', 'Paytm', '10-11-2020', '10-12-2020', '1605081993', 1, '1000.00', 0, '11-11-2020', '11-11-2020', 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '1111111111', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0015'),
(16, 12, 2, 1, '1500.00', '500.00', 1, '4a5706d50f9ad319bb1de688f58a2cc47737bb4abc56ac2093f48c7c26980ec4a4c0', '20201211111212800110168161302170282', 'NB', '2020-12-11 08:27:06.0', 'TXN_SUCCESS', 'Paytm', '10-12-2020', '10-01-2021', '1607655422', 1, '1000.00', 0, '11-12-2020', '11-12-2020', 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '1111111111', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0016'),
(17, 12, 2, 1, '1500.00', '500.00', 1, '1995fac72a0958a8ab116755e6d896f72750b14680dec683e744ada1f2fe08614086', '20210118111212800110168814902280520', 'NB', '2021-01-18 11:37:38.0', 'TXN_SUCCESS', 'Paytm', '10-01-2021', '10-02-2021', '1610950057', 1, '1000.00', 0, '18-01-2021', '18-01-2021', 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '1111111111', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0017'),
(18, 15, 2, 1, '1500.00', '500.00', 1, 'c31654991d46594f5cc3d28ab00dedde6256f0fcf351df4eb6786e9bb6fc4e2dee02', '20210224111212800110168744302389175', 'NB', '2021-02-24 22:35:20.0', 'TXN_SUCCESS', 'Paytm', '18-09-2020', '18-10-2020', '1614186317', 1, '1000.00', 0, '24-02-2021', '24-02-2021', 'Mr. Rakesh Kumar', '8', '474', 'Jaipur', '8005756759', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0018'),
(19, 15, 2, 1, '1500.00', '500.00', 0, 'cd3541d23866280ed853539919f94dd133138643c8e2107ba86c47371e037059c4b7', NULL, NULL, NULL, NULL, 'Paytm', '18-10-2020', '18-11-2020', '1614186346', 1, '1000.00', 0, '24-02-2021', NULL, 'Mr. Rakesh Kumar', '8', '474', 'Jaipur', '8005756759', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0019'),
(20, 15, 2, 1, '1500.00', '500.00', 1, '62ea82d6628a0f7f9727b9aaf4d4ffda8882c646a3b8b24cb64c1314c03292fff0fd', '20210225111212800110168910702398875', 'NB', '2021-02-25 11:25:57.0', 'TXN_SUCCESS', 'Paytm', '18-10-2020', '18-11-2020', '1614232557', 1, '1000.00', 0, '25-02-2021', '25-02-2021', 'Mr. Rakesh Kumar', '8', '474', 'Jaipur', '8005756759', 'rakeshkumar.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0020'),
(21, 12, 2, 1, '1500.00', '500.00', 1, '4d988e669c102b91db75c52a794ca31133408ce5d989374d216a867cdc8871484b43', '20210301111212800110168509502397387', 'NB', '2021-03-01 11:24:38.0', 'TXN_SUCCESS', 'Paytm', '10-02-2021', '10-03-2021', '1614578077', 1, '1000.00', 0, '01-03-2021', '01-03-2021', 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '7742591036', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0021'),
(22, 12, 2, 1, '1500.00', '500.00', 0, 'f6c3faf23cbc51f958d5f302966bb4d182814b4edc2630fe75800ddc29a7b4070add', NULL, NULL, NULL, NULL, 'Paytm', '10-03-2021', '10-04-2021', '1679670130', 1, '1000.00', 0, '24-03-2023', NULL, 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '7742591036', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0022'),
(23, 20, 2, 0, '0.00', '500.00', 0, '94cc6a15789ca35847bd0fec2553570b2161ccb421d5f36c5a412816d494b15ca9f6', NULL, NULL, NULL, NULL, 'Paytm', '31-03-2023', '30-04-2023', '1680237578', 1, '0.00', 0, '31-03-2023', NULL, 'Mr. Sunil  Kumar', NULL, NULL, '', '8851776437', 'sonu.sunil.kumar92@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0023'),
(24, 12, 2, 3, '2500.00', '500.00', 2, 'e86985148b828ff49d49f3b52d29d251493083715fd4755b33f9c3958e1a9ee221e1', NULL, NULL, NULL, 'TXN_FAILURE', 'Paytm', '10-05-2024', '10-06-2024', '1716442543', 1, '1000.00', 0, '23-05-2024', NULL, 'Click4assists.com', '8', '474', 'A-266, Vidhut Nagar, \nopp Hotel sarovar portico', '7742591036', 'click4assists@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0024'),
(25, 30, 2, 1, '500.00', '500.00', 2, '8106d28fce70000013c5a18acc12b3532684d8074a35855a7f4935e3e19222d9a9eb', NULL, NULL, NULL, 'TXN_FAILURE', 'Paytm', '30-05-2024', '30-06-2024', '1717310659', 1, '0.00', 0, '02-06-2024', NULL, 'Mr. Test Test2', '8', '474', 'test\ntest\nteswt', '8547854785', 'abhijeet.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0025'),
(26, 30, 2, 1, '500.00', '500.00', 2, 'e39fcda35a92f44646971146b4cbe2083361e721a54a8cf18c8543d44782d9ef681f', NULL, NULL, NULL, 'TXN_FAILURE', 'Paytm', '30-05-2024', '30-06-2024', '1717310877', 1, '0.00', 0, '02-06-2024', NULL, 'Mr. Test Test2', '8', '474', 'test\ntest\nteswt', '8547854785', 'abhijeet.softechure@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '0026');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plan`
--

CREATE TABLE `tbl_plan` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `no_of_user` int(11) DEFAULT NULL,
  `per_user_amount` int(11) DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_plan`
--

INSERT INTO `tbl_plan` (`plan_id`, `plan_name`, `no_of_user`, `per_user_amount`, `trial_days`) VALUES
(1, 'Basic', 1, 500, 7),
(2, 'PRO', NULL, 500, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_price_components`
--

CREATE TABLE `tbl_price_components` (
  `price_component_id` int(11) NOT NULL,
  `price_component_name` varchar(255) DEFAULT NULL,
  `price_group_id` int(11) DEFAULT NULL,
  `price_component_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_price_components`
--

INSERT INTO `tbl_price_components` (`price_component_id`, `price_component_name`, `price_group_id`, `price_component_status`, `created_at`, `updated_at`) VALUES
(1, 'Stilt', 2, 1, '1573444794', '1573444794'),
(2, 'Power Back (1 Kv)', 3, 1, '1573444819', '1573444819'),
(3, 'Park Facing + Adjoining Park', 4, 1, '1573444831', '1573444831'),
(4, 'Park Facing', 4, 1, '1573444851', '1573444851'),
(5, 'Operational Change', 3, 1, '1573444865', '1573444865'),
(6, 'Open', 2, 1, '1573444885', '1573444885'),
(7, 'One Time Maitenance Cost', 3, 1, '1573444898', '1573444898'),
(8, 'Interest Free Maintenance Security', 3, 1, '1573444911', '1573444911'),
(9, 'Ht Line Charges', 3, 1, '1573444919', '1573444919'),
(10, 'Gas Line Installation Cost', 3, 1, '1573444931', '1573444931'),
(11, 'FFEC', 3, 1, '1573444953', '1573444953'),
(12, 'External Development Charges', 3, 1, '1573444965', '1573444965'),
(13, 'Corner unit', 4, 1, '1574410115', '1574410565'),
(14, 'Adjoin Park', 4, 1, '1719019413', '1719019413'),
(15, '24Mtr Wide Road', 4, 1, '1719019429', '1719019429'),
(16, '18Mtr Wide Road', 4, 1, '1719019448', '1719019448'),
(17, '12 Mtr Wide Road', 4, 1, '1719019465', '1719019465'),
(18, 'Pack on Back Side', 4, 1, '1719019514', '1719019514'),
(19, '84Mtr Road Facing ', 4, 1, '1719019620', '1719019620');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_price_groups`
--

CREATE TABLE `tbl_price_groups` (
  `price_group_id` int(11) NOT NULL,
  `price_group_name` varchar(255) DEFAULT NULL,
  `price_group_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_price_groups`
--

INSERT INTO `tbl_price_groups` (`price_group_id`, `price_group_name`, `price_group_status`, `created_at`, `updated_at`) VALUES
(1, 'Baisc', 1, NULL, NULL),
(2, 'Parking', 1, NULL, NULL),
(3, 'Additional', 1, NULL, NULL),
(4, 'PLC', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `builder_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `builder_group_id` int(11) DEFAULT NULL,
  `base_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `project_name` varchar(200) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `project_status` int(11) DEFAULT 0,
  `property_type` varchar(255) DEFAULT NULL,
  `project_type` int(11) NOT NULL DEFAULT 0,
  `rera_application` varchar(255) DEFAULT NULL,
  `rera_no` varchar(20) DEFAULT NULL,
  `commisment_date` varchar(255) DEFAULT NULL,
  `lattitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `address1` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `land_area` varchar(20) DEFAULT NULL,
  `buildup_area` varchar(20) DEFAULT NULL,
  `land_area_unit` varchar(50) DEFAULT NULL,
  `buildup_area_unit` varchar(50) DEFAULT NULL,
  `project_area` varchar(255) DEFAULT NULL,
  `authority_approval` int(11) DEFAULT NULL,
  `cc_certificate` tinyint(1) DEFAULT NULL,
  `oc_certificate` tinyint(1) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `no_of_tower` int(11) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `project_logo` varchar(255) DEFAULT NULL,
  `b_cost_unit` varchar(255) DEFAULT NULL,
  `b_cost_gst` decimal(11,2) DEFAULT 0.00,
  `club_cost_unit` varchar(255) DEFAULT NULL,
  `club_gst` decimal(11,2) NOT NULL DEFAULT 0.00,
  `parking_open` tinyint(1) DEFAULT 0,
  `o_price` decimal(11,2) DEFAULT 0.00,
  `parking_stilt` tinyint(1) DEFAULT 0,
  `s_price` decimal(11,2) DEFAULT 0.00,
  `parking_basment` tinyint(1) DEFAULT 0,
  `b_price` decimal(11,2) DEFAULT 0.00,
  `parking_gst` decimal(11,2) NOT NULL DEFAULT 0.00,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `amenitie` text DEFAULT NULL,
  `finance` text DEFAULT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT 0,
  `date_register` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `user_id`, `builder_id`, `agent_id`, `builder_group_id`, `base_title`, `slug`, `project_name`, `location`, `city`, `project_status`, `property_type`, `project_type`, `rera_application`, `rera_no`, `commisment_date`, `lattitude`, `longitude`, `address1`, `address2`, `country_id`, `state_id`, `city_id`, `pincode`, `land_area`, `buildup_area`, `land_area_unit`, `buildup_area_unit`, `project_area`, `authority_approval`, `cc_certificate`, `oc_certificate`, `description`, `no_of_tower`, `banner_image`, `project_logo`, `b_cost_unit`, `b_cost_gst`, `club_cost_unit`, `club_gst`, `parking_open`, `o_price`, `parking_stilt`, `s_price`, `parking_basment`, `b_price`, `parking_gst`, `created_at`, `updated_at`, `is_featured`, `status`, `amenitie`, `finance`, `product_status`, `date_register`) VALUES
(1, NULL, 2, 26, 4, NULL, 'woodview-residency', 'Woodview Residency', '34', NULL, 3, '3', 2, 'not_applicable', '', '', '', '', '', NULL, NULL, 6, 347, NULL, '118', '', '10', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, '1', '0.00', '', '0.00', NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00', '1716475716', '1716478792', 0, 0, '2,11,12,15', '', 1, '23-05-2024'),
(2, NULL, 3, 26, 4, NULL, 'anandam-ora', 'Anandam Ora', '38', NULL, 2, '3', 2, 'not_applicable', '', '', '', '', '', NULL, NULL, 6, 347, NULL, '27', '', '10', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, '1', '0.00', '', '0.00', NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00', '1716480230', '1716480350', 0, 0, '2,12,15', '', 1, '23-05-2024'),
(3, NULL, 4, 26, 9, NULL, 'dlf-garden-city', 'DLF Garden City', '37', NULL, 3, '3', 2, 'not_applicable', '', '', '', '', '', NULL, NULL, 6, 347, NULL, '100', '', '10', '', NULL, NULL, 1, 1, '', NULL, NULL, NULL, '1', '0.00', '', '0.00', NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00', '1716509420', '1716509452', 0, 0, '2,12,15', '', 1, '24-05-2024'),
(4, NULL, 5, 26, 5, NULL, 'godrej-101', 'GODREJ 101', '35', NULL, 2, '1', 2, 'registred', '', '', '', '', 'Sector -79, Gurgaon', NULL, NULL, 6, 347, NULL, '', '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, '5', '5.00', '', '0.00', NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00', '1716645984', '1716649813', 0, 0, '2,3,5,6,9,14,15', '', 1, '25-05-2024'),
(5, NULL, 0, 0, 0, NULL, 's', 's', '', NULL, 2, '1', 2, 'registred', '', '', '', '', '', NULL, NULL, 0, 0, NULL, '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0.00', '', '0.00', NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00', '1718592044', '1718592444', 0, 0, '', '', 1, '17-06-2024'),
(6, NULL, 6, 31, 10, NULL, 'the-golden-city', 'The Golden City', '57', NULL, 2, '3', 2, 'registred', 'GGM/625/357/2022/100', '', '', '', 'The Golden City, IMT, Manesar, Sector M-9, M-10, Gurgaon, Haryana-122051', NULL, NULL, 6, 347, NULL, '21.5', '', '10', '', NULL, NULL, NULL, NULL, 'THE GOLDEN CITY\r\nThe new emerging Manesar-Gurgaon.\r\n\r\nA rare opportunity to own Freehold Industrial\r\nPlot or Residential Plot in the heart of Gurgaon -\r\nManesar. Whether you are looking out for setting\r\nup a manufacturing base or an expansion, wish\r\nto have a residence or guest house close to your\r\nplant, this is really a once-in-a-life-time chance!', NULL, NULL, '0e88d4250556634a9f758cd8d6f5ff78.png', '1', '0.00', '1', '0.00', NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00', '1719019002', '1719020680', 0, 0, '2,10,14,17,18', '', 1, '22-06-2024'),
(7, NULL, 2, 31, 4, NULL, 'aster-court-primier', 'Aster Court Primier', '40', NULL, 3, '1', 2, 'registred', 'RC/REP/Harera/GGM/20', '', '28.405695', '76.953363', 'Sector -85, Badha, Manesar, Gurgaon', NULL, NULL, 6, 347, NULL, '2.90625', '450000', '10', '2', NULL, 3, 1, 1, 'Loaded with all world class amenities and strategically located, Orris Aster Court Premier is an address which only a people like, who are destined for eminence in life. The residents of these Residential Apartments in Gurgaon enjoys a lifestyle that is sought by many and experienced by few. Orris Aster Court Premier in Sector 85 offers you an elite lifestyle that you have always cherished. The floor plan of Orris Aster Court Premier enables best utilisation of space such that every room, kitchen, bathroom or balconies appear to be more bigger and spacious. Orris Aster Court Premier offers 3 BHK and 4 BHK luxurious Apartments in Gurgaon. The master plan of Orris Aster Court Premier ensures that these Apartments in Sector 85 are Vastu compliant to present its residents with a cheerful mood and blissful life throughout all seasons. Location of Orris Aster Court Premier is perfect for the ones who desire to invest in property in Gurgaon with many schools, colleges, hospitals, supermarkets, recreational areas, parks and many other facilities nearby Sector 85. Currently Orris Aster Court Premier is completed and is available.', NULL, NULL, 'd2cd51521b5f38bb96e6673ae7808dd4.jpeg', '2', '0.00', '2', '0.00', NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00', '1719154015', '1719155299', 0, 0, '1,2,3,5,6,9,12,14,15,16,18', '', 1, '23-06-2024'),
(8, NULL, 7, 31, 2, NULL, 'm3m-golf-hill', 'M3M GOLF HILL ', '35', NULL, 2, '1', 2, 'registred', 'RERA-GRG-PROJ- 1331-', '', '28.362538', '76.972493', '', NULL, NULL, 6, 347, NULL, '75', '261000', '10', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', NULL, '0.00', 0, '0.00', 0, '0.00', 0, '0.00', '0.00', '1719421156', '1719421156', 0, 0, NULL, NULL, 1, '26-06-2024');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_additional_details`
--

CREATE TABLE `tbl_product_additional_details` (
  `product_additional_detail_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price_comp_id` int(11) DEFAULT NULL,
  `gst` decimal(11,2) NOT NULL DEFAULT 0.00,
  `price` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_additional_details`
--

INSERT INTO `tbl_product_additional_details` (`product_additional_detail_id`, `product_id`, `price_comp_id`, `gst`, `price`, `unit`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '0.00', '', '', '1716475786', '1716478788'),
(2, 2, 0, '0.00', '', '', '1716480343', '1716480343'),
(3, 3, 0, '0.00', '', '', '1716509445', '1716509445'),
(4, 4, 0, '0.00', '', '', '1716646621', '1716649810'),
(5, 5, 0, '0.00', '', '', '1718592109', '1718592109'),
(6, 6, 2, '0.00', '', '', '1719019201', '1719020656'),
(7, 7, 0, '0.00', '', '', '1719154668', '1719155295');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_block_details`
--

CREATE TABLE `tbl_product_block_details` (
  `block_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `property_type` varchar(11) DEFAULT NULL,
  `block_name` varchar(255) DEFAULT NULL,
  `no_of_floor` varchar(5) DEFAULT NULL,
  `no_of_flat` varchar(11) DEFAULT NULL,
  `unit_per_floor` varchar(11) DEFAULT NULL,
  `no_of_ps_lift` varchar(11) DEFAULT NULL,
  `no_of_service_lift` varchar(11) DEFAULT NULL,
  `edp` varchar(255) DEFAULT NULL,
  `payment_plan` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `project_type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_block_details`
--

INSERT INTO `tbl_product_block_details` (`block_id`, `product_id`, `property_type`, `block_name`, `no_of_floor`, `no_of_flat`, `unit_per_floor`, `no_of_ps_lift`, `no_of_service_lift`, `edp`, `payment_plan`, `created_at`, `updated_at`, `project_type`) VALUES
(3, 7, '1', '3K', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(2, 4, '1', 'H', '14', '56', '4', '2', '0', '05/01/2027', NULL, '1716647866', '1716649777', 2),
(4, 7, '1', '3L', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(5, 7, '1', '3M', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(6, 7, '1', '3N', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(7, 7, '1', '3O', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(8, 7, '1', '3P', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(9, 7, '1', '4A', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(10, 7, '1', '4B', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(11, 7, '1', '4C', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(12, 7, '1', '4D', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(13, 7, '1', '4E', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2),
(14, 7, '1', '4F', '10', '20', '', '1', '1', '', NULL, '1719154015', '1719155287', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_images`
--

CREATE TABLE `tbl_product_images` (
  `product_image_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_image_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_plc_details`
--

CREATE TABLE `tbl_product_plc_details` (
  `product_plc_detail_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price_comp_id` int(11) DEFAULT NULL,
  `gst` decimal(11,2) NOT NULL DEFAULT 0.00,
  `price` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_plc_details`
--

INSERT INTO `tbl_product_plc_details` (`product_plc_detail_id`, `product_id`, `price_comp_id`, `gst`, `price`, `unit`, `created_at`, `updated_at`) VALUES
(4, 3, 0, '0.00', '', '', '1716509445', '1716509445'),
(2, 2, 0, '0.00', '', '', '1681190041', '1716480343'),
(3, 1, 0, '0.00', '', '', '1716477665', '1716478788'),
(5, 4, 0, '0.00', '', '', '1716646621', '1716649810'),
(6, 5, 0, '0.00', '', '', '1718592109', '1718592109'),
(7, 6, 4, '0.00', '', '', '1719019201', '1719020656'),
(8, 6, 13, '0.00', '', '', '1719019201', '1719020656'),
(9, 6, 15, '0.00', '', '', '1719019201', '1719020656'),
(10, 6, 17, '0.00', '', '', '1719019759', '1719020656'),
(11, 6, 15, '0.00', '', '', '1719019759', '1719020656'),
(12, 6, 18, '0.00', '', '', '1719019759', '1719020656'),
(13, 7, 13, '0.00', '', '', '1719154668', '1719155295');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_specifications`
--

CREATE TABLE `tbl_product_specifications` (
  `product_specification_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `specification_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_specifications`
--

INSERT INTO `tbl_product_specifications` (`product_specification_id`, `product_id`, `specification_id`, `description`, `created_at`, `updated_at`) VALUES
(6, 4, 0, '<p>* Split A/c&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;-Enjoy Confortable Temperatures all year Round</p>', '1716646621', '1716649810'),
(5, 3, 0, '', '1716509445', '1716509445'),
(4, 2, 0, '', '1716480343', '1716480343'),
(3, 1, 0, '', '1716475786', '1716478788'),
(7, 5, 0, '', '1718592109', '1718592109'),
(8, 6, 6, '<p><em>1. Secure and Gated Township</em></p>\r\n<p><em><span style=\"font-size: 14px;\">2. East and West facing rectangular plots.</span></em></p>\r\n<p><em><span style=\"font-size: 14px;\">3. Over 40% open and green spaces</span></em></p>\r\n<p><em><span style=\"font-size: 14px;\">4. Neighbourhood Retail for daily needs</span></em></p>\r\n<p><em><span style=\"font-size: 14px;\">5. FTTH Optic Fibre connectivity cables underground</span></em></p>\r\n<p><em><span style=\"font-size: 14px;\">6. Aesthetic landscaping</span></em></p>\r\n<p><em><span style=\"font-size: 14px;\">7. Provision for visitors\' parking & club</span></em></p>\r\n<p><em><span style=\"font-size: 14px;\">8. Recreational facilities for all the age groups</span></em></p>\r\n<p><em><span style=\"font-size: 14px;\">9. Promoting \'Walk to Work\' lifestyle</span></em></p>', '1719019201', '1719020656'),
(9, 7, 6, '<p>1.&nbsp; &nbsp; &nbsp;<span style=\"color: #212529; font-family: Poppins, sans-serif; font-size: 16px;\">Supermarket and nursery school within the complex</span></p>\r\n<p><span style=\"color: #212529; font-family: Poppins, sans-serif; font-size: 16px;\">2.&nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif; padding: 0px; margin: 0px; box-sizing: border-box; font-weight: bolder; border: 0px; outline: none;\">05 Minutes&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">- Delhi Public School, Sector-84, Gurugram St. Xavier\'s High School, Sector-&nbsp; 81, Gurugram</span></p>\r\n<p><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">3.&nbsp; &nbsp; &nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif; padding: 0px; margin: 0px; box-sizing: border-box; font-weight: bolder; border: 0px; outline: none;\">05 Minutes&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">- RPS International School, Sector-89, Gurugram</span></p>\r\n<p><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">4.&nbsp; &nbsp; &nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif; padding: 0px; margin: 0px; box-sizing: border-box; font-weight: bolder; border: 0px; outline: none;\">05 Minutes&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">- Aarvy Healthcare Super Specialty Hospital, Sector 90, Gurugram</span></p>\r\n<p><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">5.&nbsp; &nbsp; &nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif; padding: 0px; margin: 0px; box-sizing: border-box; font-weight: bolder; border: 0px; outline: none;\">15 Minutes&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">- Rockland Hospital, IMT Manesar, Gurugram</span></p>\r\n<p><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">6.&nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif; padding: 0px; margin: 0px; box-sizing: border-box; font-weight: bolder; border: 0px; outline: none;\">25 Minutes&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">- Medanta, The Medicity, Gurugram</span></p>\r\n<p><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">7.&nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif; padding: 0px; margin: 0px; box-sizing: border-box; font-weight: bolder; border: 0px; outline: none;\">30 Minutes&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">- Cyber City, Gurugram</span></p>\r\n<p><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">8.&nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif; padding: 0px; margin: 0px; box-sizing: border-box; font-weight: bolder; border: 0px; outline: none;\">35 Minutes&nbsp;</span><span style=\"font-size: 1em; color: #212529; font-family: Poppins, sans-serif;\">- IGI Airport, New Delhi.</span></p>\r\n<p>&nbsp;</p>', '1719154668', '1719155295');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_types`
--

CREATE TABLE `tbl_product_types` (
  `product_type_id` int(11) NOT NULL,
  `product_type_name` varchar(255) DEFAULT NULL,
  `product_type_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_types`
--

INSERT INTO `tbl_product_types` (`product_type_id`, `product_type_name`, `product_type_status`, `created_at`, `updated_at`) VALUES
(1, 'Agricultural', 1, '1574055144', '1574055144'),
(2, 'Residencial', 1, '1574055155', '1574055155'),
(3, 'Commercial', 1, '1574055155', '1574055155'),
(4, 'Industrial', 1, '1719109623', '1719109623');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_unit_details`
--

CREATE TABLE `tbl_product_unit_details` (
  `product_unit_detail_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `property_type` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `no_of_unit` varchar(255) DEFAULT NULL,
  `ca` varchar(255) DEFAULT NULL,
  `sa` varchar(255) DEFAULT NULL,
  `ba` varchar(255) DEFAULT NULL,
  `basic_cost` varchar(11) DEFAULT NULL,
  `charges` varchar(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `plot_size` varchar(255) DEFAULT NULL,
  `plot_unit` varchar(255) DEFAULT NULL,
  `dimension` varchar(50) DEFAULT NULL,
  `facing` varchar(50) DEFAULT NULL,
  `accomodation` varchar(255) DEFAULT NULL,
  `no_of_floor` varchar(255) DEFAULT NULL,
  `construction_area` varchar(255) DEFAULT NULL,
  `con_unit` varchar(255) DEFAULT NULL,
  `no_of_bedroom` varchar(255) DEFAULT NULL,
  `no_of_bathroom` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `project_type` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_unit_details`
--

INSERT INTO `tbl_product_unit_details` (`product_unit_detail_id`, `product_id`, `property_type`, `code`, `type`, `no_of_unit`, `ca`, `sa`, `ba`, `basic_cost`, `charges`, `image`, `plot_size`, `plot_unit`, `dimension`, `facing`, `accomodation`, `no_of_floor`, `construction_area`, `con_unit`, `no_of_bedroom`, `no_of_bathroom`, `created_at`, `updated_at`, `sub_category`, `project_type`, `unit`) VALUES
(1, 1, '', '206', NULL, '4', '178', '206', '190', NULL, NULL, NULL, NULL, NULL, '10 X 11', NULL, '1', NULL, NULL, NULL, NULL, NULL, '1679895212', '1679895212', '4', 3, '2'),
(3, 1, '3', 'Type-B', NULL, '85', NULL, NULL, NULL, '165000', '1', '', '182.98', '1', '27.88 x  59.056', '3', NULL, NULL, NULL, NULL, NULL, NULL, '1716475716', '1716478763', NULL, 2, NULL),
(4, 2, '3', '122/E', NULL, '2', NULL, NULL, NULL, '130000', '', '', '122', '1', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1716480230', '1716480230', NULL, 2, NULL),
(5, 2, '3', '160/W', NULL, '2', NULL, NULL, NULL, '130000', '', '', '160', '1', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1716480230', '1716480230', NULL, 2, NULL),
(6, 3, '3', '350/west', NULL, '4', NULL, NULL, NULL, '200000', '', '', '350', '8', '', '6', NULL, NULL, NULL, NULL, NULL, NULL, '1716509420', '1716509420', NULL, 2, NULL),
(7, 4, '1', 'Type/2125', NULL, '28', '1400', '2125', '1600', '28500000', '', 'a9123236147cf6119b76ea94945899ca.JPG', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, '3', '4', '1716645984', '1716649777', NULL, 2, '2'),
(8, 4, '1', 'Type/2506', NULL, '28', '1800', '2506', '2000', '31500000', '', 'b0b363bd50260d78303c108722eb4e6d.jpg', NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, '3', '4', '1716647866', '1716649777', NULL, 2, '2'),
(9, 6, '3', '155 Sqyd', NULL, '102', NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1719020104', '1719020646', NULL, 2, NULL),
(10, 6, '3', '165 Sqyd', NULL, '118', NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1719020104', '1719020646', NULL, 2, NULL),
(11, 6, '3', '175 Sqyd', NULL, '158', NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '1719020104', '1719020646', NULL, 2, NULL),
(12, 7, '1', '', NULL, '120', '1240', '2120', '1616', '', '', '6295054df086313dad0bf378c6f1c6b0.jpg', NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, '3', '3', '1719154015', '1719155287', NULL, 2, '2'),
(13, 7, '1', '', NULL, '120', '1513', '2560', '2017', '', '', '6d0606cca99236edf087bfbb8e5daa23.jpg', NULL, NULL, NULL, NULL, '13', NULL, NULL, NULL, '4', '4', '1719154015', '1719155287', NULL, 2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_share`
--

CREATE TABLE `tbl_project_share` (
  `project_share_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `share_account_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project_share`
--

INSERT INTO `tbl_project_share` (`project_share_id`, `account_id`, `share_account_id`, `project_id`, `created_at`) VALUES
(5, 12, 15, 1, '1682490394');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_status`
--

CREATE TABLE `tbl_project_status` (
  `project_status_id` int(11) NOT NULL,
  `project_status_name` varchar(255) DEFAULT NULL,
  `project_status_flag` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project_status`
--

INSERT INTO `tbl_project_status` (`project_status_id`, `project_status_name`, `project_status_flag`, `created_at`, `updated_at`) VALUES
(1, 'Upcomming Project', 1, '2018-10-30 06:04:54', '2018-10-30 06:04:54'),
(2, 'Ongoing Project', 1, '2018-10-30 06:04:54', '2018-10-30 06:04:54'),
(3, 'Past Project', 1, '2018-10-30 06:04:54', '2018-10-30 06:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_types`
--

CREATE TABLE `tbl_project_types` (
  `project_type_id` int(11) NOT NULL,
  `project_type_name` varchar(255) DEFAULT NULL,
  `project_type_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property`
--

CREATE TABLE `tbl_property` (
  `property_id` int(11) NOT NULL,
  `listing_type` int(11) DEFAULT NULL,
  `post_date` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL,
  `unit_type_id` int(11) NOT NULL,
  `furnised_status_id` int(11) DEFAULT NULL,
  `modify_interiors` tinyint(1) DEFAULT 0,
  `lock_period_year` varchar(255) DEFAULT NULL,
  `personal_washroom` varchar(255) DEFAULT NULL,
  `pantry_cafeteria` varchar(255) DEFAULT NULL,
  `project_society` varchar(255) DEFAULT NULL,
  `land_zone` int(11) DEFAULT NULL,
  `ideal_business_id` text DEFAULT NULL,
  `corner_shop` tinyint(1) DEFAULT 0,
  `main_road_shop` tinyint(1) NOT NULL DEFAULT 0,
  `bedroom` varchar(255) DEFAULT NULL,
  `balconies` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `total_floor` varchar(255) DEFAULT NULL,
  `bathroom` varchar(255) DEFAULT NULL,
  `covered_area` varchar(255) DEFAULT NULL,
  `covered_area_unit` int(11) DEFAULT NULL,
  `plot_area` varchar(255) DEFAULT NULL,
  `plot_area_unit` int(11) DEFAULT NULL,
  `plot_size_length` varchar(255) DEFAULT NULL,
  `plot_size_wirth` varchar(255) DEFAULT NULL,
  `plot_size_unit` int(11) DEFAULT NULL,
  `shop_size_length` varchar(255) DEFAULT NULL,
  `shop_size_wirth` varchar(255) DEFAULT NULL,
  `shop_size_unit` varchar(255) DEFAULT NULL,
  `built_up_area` varchar(255) DEFAULT NULL,
  `built_up_area_unit` int(11) DEFAULT NULL,
  `super_built_up_area` varchar(255) DEFAULT NULL,
  `super_built_up_area_unit` int(11) DEFAULT NULL,
  `super_area` varchar(255) DEFAULT NULL,
  `super_area_unit` int(11) DEFAULT NULL,
  `property_status` int(11) DEFAULT NULL,
  `corner_plot` tinyint(1) DEFAULT 0,
  `facing_id` int(11) DEFAULT NULL,
  `avaliability_from` varchar(255) DEFAULT NULL,
  `immediately` tinyint(1) DEFAULT 0,
  `construction_age` int(11) DEFAULT NULL,
  `monthly_rent` varchar(255) DEFAULT NULL,
  `monthly_rent_unit` int(11) DEFAULT NULL,
  `security_deposit` varchar(255) DEFAULT NULL,
  `maintenance` varchar(255) DEFAULT NULL,
  `maintenance_unit` int(11) DEFAULT NULL,
  `electrticity_charge` tinyint(1) DEFAULT 0,
  `water_bill_charge` tinyint(1) NOT NULL DEFAULT 0,
  `sale_price` varchar(255) DEFAULT NULL,
  `sale_price_unit` int(11) DEFAULT NULL,
  `sale_other_charge` varchar(255) DEFAULT NULL,
  `owner_title` varchar(255) DEFAULT NULL,
  `owner_first_name` varchar(255) DEFAULT NULL,
  `owner_last_name` varchar(255) DEFAULT NULL,
  `owner_mobile_no` varchar(255) DEFAULT NULL,
  `owner_contact_no` varchar(255) DEFAULT NULL,
  `owner_email` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `youtube_video` varchar(255) DEFAULT NULL,
  `is_post` tinyint(1) NOT NULL DEFAULT 0,
  `account_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_property`
--

INSERT INTO `tbl_property` (`property_id`, `listing_type`, `post_date`, `latitude`, `longitude`, `state_id`, `city_id`, `location_id`, `address`, `product_type_id`, `unit_type_id`, `furnised_status_id`, `modify_interiors`, `lock_period_year`, `personal_washroom`, `pantry_cafeteria`, `project_society`, `land_zone`, `ideal_business_id`, `corner_shop`, `main_road_shop`, `bedroom`, `balconies`, `floor`, `total_floor`, `bathroom`, `covered_area`, `covered_area_unit`, `plot_area`, `plot_area_unit`, `plot_size_length`, `plot_size_wirth`, `plot_size_unit`, `shop_size_length`, `shop_size_wirth`, `shop_size_unit`, `built_up_area`, `built_up_area_unit`, `super_built_up_area`, `super_built_up_area_unit`, `super_area`, `super_area_unit`, `property_status`, `corner_plot`, `facing_id`, `avaliability_from`, `immediately`, `construction_age`, `monthly_rent`, `monthly_rent_unit`, `security_deposit`, `maintenance`, `maintenance_unit`, `electrticity_charge`, `water_bill_charge`, `sale_price`, `sale_price_unit`, `sale_other_charge`, `owner_title`, `owner_first_name`, `owner_last_name`, `owner_mobile_no`, `owner_contact_no`, `owner_email`, `photo`, `youtube_video`, `is_post`, `account_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '26-05-2024', '', '', 6, 347, 37, '', 2, 1, 3, 0, '', '', '', 'TEST SOCIETY', 0, '', 1, 1, '3', '2', '2', '29', '4', '1200', 2, '', 0, '', '', 0, '', '', '', '1400', 2, '1470', 2, '', 0, 0, 2, 0, '26-05-2024', NULL, 3, '', 0, '', '', NULL, 0, 0, '21500000', 5, '', 'Mr.', 'Test', 'Test', '9999999999', '', '', NULL, '', 1, 26, 26, '1716721820', '1716722148'),
(2, 2, '26-05-2024', '', '', 6, 347, 37, '', 2, 3, 0, 0, '', '', '', '', 0, '', 2, 2, '', '', '', '', '', '', 0, '350', 1, '', '', 0, '', '', '', '', 0, '', 0, '', 0, 0, 2, 3, '26-05-2024', NULL, 0, '', 0, '', '', NULL, 0, 0, '', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 26, 26, '1716722278', '1716722343'),
(3, 2, '02-06-2024', '', '', 6, 347, 46, '', 2, 1, 2, 0, '', '', '', 'Greenopolic', 0, '', 2, 2, '3', '2', '2', '23', '3', '2500', 2, '', 0, '', '', 0, '', '', '', '2600', 2, '2700', 2, '', 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 26, 26, '1717309674', '1717310289'),
(4, 2, '08-06-2024', '', '', 6, 347, 41, '', 2, 1, 0, 0, '', '', '', '', 0, '', 2, 2, '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', 0, '', 0, '', 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 26, 26, '1717816171', '1717817051'),
(5, 2, '10-06-2024', '', '', 6, 347, 48, '', 2, 3, 0, 0, '', '', '', '', 0, '', 2, 2, '', '', '', '', '', '', 0, '100', 1, '10', '10', 2, '', '', '', '', 0, '', 0, '', 0, 0, 1, 4, '10-06-2024', NULL, 0, '', 0, '', '', NULL, 0, 0, '', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 26, 26, '1718036918', '1718036962');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_detail`
--

CREATE TABLE `tbl_property_detail` (
  `property_detail_id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `road_wirth` varchar(255) DEFAULT NULL,
  `road_wirth_unit` varchar(255) DEFAULT NULL,
  `park_facing` varchar(255) DEFAULT NULL,
  `approval_state` varchar(255) DEFAULT NULL COMMENT '1: Socity Patta, 2: Government Approved',
  `sociaty_name` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `rate_unit` varchar(255) DEFAULT NULL,
  `inclusive_all` tinyint(1) DEFAULT 0,
  `remark` text DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `sale_amenities` varchar(255) DEFAULT NULL,
  `rent_amenities` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_property_detail`
--

INSERT INTO `tbl_property_detail` (`property_detail_id`, `property_id`, `road_wirth`, `road_wirth_unit`, `park_facing`, `approval_state`, `sociaty_name`, `rate`, `rate_unit`, `inclusive_all`, `remark`, `amenities`, `sale_amenities`, `rent_amenities`) VALUES
(1, 1, '', '', '1', '', '', '', '', NULL, '', '', '', ''),
(2, 2, '9', '9', '2', '', '', '180000', '1', NULL, '', '', '', ''),
(3, 3, '', '', '2', '', '', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(4, 4, '', '', '2', '', '', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 5, '', '', '1', '2', '', '10000', '1', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_furnishing`
--

CREATE TABLE `tbl_property_furnishing` (
  `property_furnishing_id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `furnishing_id` int(11) DEFAULT NULL,
  `furnishing_value` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_property_furnishing`
--

INSERT INTO `tbl_property_furnishing` (`property_furnishing_id`, `property_id`, `furnishing_id`, `furnishing_value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', '1716721985', '1716722136'),
(2, 1, 2, '', '1716721985', '1716722136'),
(3, 1, 3, '', '1716721985', '1716722136'),
(4, 1, 4, '', '1716721985', '1716722136'),
(5, 1, 5, '1', '1716721985', '1716722136'),
(6, 1, 6, '0', '1716721985', '1716722136'),
(7, 1, 7, '', '1716721985', '1716722136'),
(8, 1, 8, '', '1716721985', '1716722136'),
(9, 2, 1, '', '1716722325', NULL),
(10, 2, 2, '', '1716722325', NULL),
(11, 2, 3, '', '1716722325', NULL),
(12, 2, 4, '', '1716722325', NULL),
(13, 2, 5, '0', '1716722325', NULL),
(14, 2, 6, '0', '1716722325', NULL),
(15, 2, 7, '', '1716722325', NULL),
(16, 2, 8, '', '1716722325', NULL),
(17, 3, 1, '', '1717310289', NULL),
(18, 3, 2, '', '1717310289', NULL),
(19, 3, 3, '', '1717310289', NULL),
(20, 3, 4, '', '1717310289', NULL),
(21, 3, 5, '0', '1717310289', NULL),
(22, 3, 6, '0', '1717310289', NULL),
(23, 3, 7, '', '1717310289', NULL),
(24, 3, 8, '', '1717310289', NULL),
(25, 4, 1, '', '1717817051', NULL),
(26, 4, 2, '', '1717817051', NULL),
(27, 4, 3, '', '1717817051', NULL),
(28, 4, 4, '', '1717817051', NULL),
(29, 4, 5, '0', '1717817051', NULL),
(30, 4, 6, '0', '1717817051', NULL),
(31, 4, 7, '', '1717817051', NULL),
(32, 4, 8, '', '1717817051', NULL),
(33, 5, 1, '', '1718036950', NULL),
(34, 5, 2, '', '1718036950', NULL),
(35, 5, 3, '', '1718036950', NULL),
(36, 5, 4, '', '1718036950', NULL),
(37, 5, 5, '0', '1718036950', NULL),
(38, 5, 6, '0', '1718036950', NULL),
(39, 5, 7, '', '1718036950', NULL),
(40, 5, 8, '', '1718036950', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_types`
--

CREATE TABLE `tbl_property_types` (
  `property_type_id` int(11) NOT NULL,
  `property_type_name` varchar(255) DEFAULT NULL,
  `property_type_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_property_types`
--

INSERT INTO `tbl_property_types` (`property_type_id`, `property_type_name`, `property_type_status`, `created_at`, `updated_at`) VALUES
(1, 'Flat', 1, '1573473216', '1573473216'),
(2, 'Villa', 1, '1573473224', '1573473224'),
(3, 'Plot', 1, '1573473236', '1573473236');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requirements`
--

CREATE TABLE `tbl_requirements` (
  `requirement_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `look_for` int(11) DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL,
  `unit_type_id` int(11) DEFAULT NULL,
  `accomodation_id` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `budget_min` varchar(255) DEFAULT NULL,
  `budget_max` varchar(255) DEFAULT NULL,
  `size_min` varchar(255) DEFAULT NULL,
  `size_max` varchar(255) DEFAULT NULL,
  `size_unit` int(11) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `dor` varchar(255) DEFAULT NULL,
  `requirement_status` tinyint(1) NOT NULL DEFAULT 0,
  `property_id` int(11) DEFAULT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_requirements`
--

INSERT INTO `tbl_requirements` (`requirement_id`, `lead_id`, `user_id`, `account_id`, `look_for`, `product_type_id`, `unit_type_id`, `accomodation_id`, `state_id`, `city_id`, `location`, `budget_min`, `budget_max`, `size_min`, `size_max`, `size_unit`, `remark`, `dor`, `requirement_status`, `property_id`, `customer_mobile`, `created_at`, `updated_at`, `added_by`) VALUES
(1, 4, 13, 12, 3, 2, 1, '', 8, 474, '4,5', '4', '6', '900', '1290', 2, '', '20-08-2020', 0, NULL, NULL, '1597907509', '1679721994', NULL),
(2, 4, 12, 12, 3, 1, 6, '', 8, 474, NULL, '5', '8', '2', '3', 3, '', '27-08-2020', 0, NULL, NULL, '1598543154', '1679721985', NULL),
(3, 10, 15, 15, 3, 2, 1, '', 8, 474, '5', '2', '5', '700', '1100', 2, '', '09-09-2020', 1, NULL, NULL, '1599627993', '1599628056', NULL),
(4, 11, 12, 12, 2, 2, 1, '', 8, 474, '5', '3', '6', '900', '1500', 2, '', '17-09-2020', 0, NULL, NULL, '1600315306', '1679723437', NULL),
(5, 12, 12, 12, 1, 2, 1, NULL, 6, 291, '', '8', '8', '', '', 7, '', '18-09-2020', 0, NULL, NULL, '1600446470', '1680866997', NULL),
(6, 4, 12, 12, 3, 3, 4, '', 6, 347, NULL, '7', '13', '200', '500', 2, '', '24-03-2023', 1, NULL, NULL, '1679674308', '1679674308', NULL),
(7, 8, 12, 12, 3, 2, 1, '', 6, 347, NULL, '19', '23', '1400', '2500', 2, '', '25-03-2023', 1, NULL, NULL, '1679721913', '1679721913', NULL),
(8, 11, 12, 12, 3, 2, 3, '', 6, 347, NULL, '11', '14', '100', '150', 1, 'Plot ', '25-03-2023', 1, NULL, NULL, '1679723519', '1679723519', NULL),
(9, 14, 12, 12, 2, 1, 6, '', 8, 509, NULL, '7', '10', '100', '100', 2, '', '05-04-2023', 1, NULL, NULL, '1680696101', '1680696101', NULL),
(10, 14, 12, 12, 2, 1, 6, '', 0, 392, NULL, '9', '15', '120', '100', 9, '', '05-04-2023', 1, NULL, NULL, '1680696168', '1680696168', NULL),
(11, 14, 12, 12, 2, 1, 6, '', 0, 392, NULL, '9', '15', '120', '100', 9, '', '05-04-2023', 1, NULL, NULL, '1680696172', '1680696172', NULL),
(12, 14, 12, 12, 1, NULL, NULL, '', NULL, NULL, NULL, '', '', '', '', NULL, '', '05-04-2023', 1, NULL, NULL, '1680696265', '1680696347', NULL),
(13, 8, 12, 12, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '05-04-2023', 1, NULL, NULL, '1680697699', '1680697699', NULL),
(15, 8, 12, 12, 2, 0, 0, '', 0, 0, NULL, '', '', '', '', 0, '', '05-04-2023', 1, NULL, NULL, '1680697781', '1680698274', NULL),
(17, 14, 12, 12, 1, 1, 1, NULL, 3, 169, '', '', '45 Lac', '', '', 1, '', '07-04-2023', 1, NULL, NULL, '1680861542', '1680864843', NULL),
(18, 14, 12, 12, 1, 1, 1, NULL, 7, 358, '', '7', '16', '', '', 1, '', '07-04-2023', 1, NULL, NULL, '1680862099', '1680866865', NULL),
(19, 0, 12, 12, 1, 0, 0, NULL, 0, 0, '', '', '', '', '', 0, '', '07-04-2023', 1, NULL, NULL, '1680863037', '1680863037', NULL),
(20, 0, 12, 12, 1, 0, 0, NULL, 0, 0, '', '', '', '', '', 0, '', '07-04-2023', 1, NULL, NULL, '1680863133', '1680863133', NULL),
(21, 0, 12, 12, 2, 1, 5, NULL, 5, 0, '', '', '50 Lac', '', '', 6, '', '07-04-2023', 1, NULL, NULL, '1680863209', '1680863209', NULL),
(22, 14, 12, 12, 2, 2, 7, NULL, 8, 411, '', '9', '9', '100', '500', 9, 'Krishna test ', '07-04-2023', 1, NULL, NULL, '1680864368', '1680866910', NULL),
(23, NULL, 12, 12, 2, 2, 0, NULL, 0, 0, '', '', '', '', '', 0, '', '07-04-2023', 1, NULL, NULL, '1680867139', '1680867139', NULL),
(24, NULL, 12, 12, 2, 0, 0, NULL, 0, 0, '', '', '', '', '', 0, '', '07-04-2023', 1, NULL, NULL, '1680867272', '1680867272', NULL),
(25, 10, 12, 12, 2, 3, 5, NULL, 6, 297, '', '', '', '', '', 0, '', '07-04-2023', 1, NULL, NULL, '1680867466', '1680867939', NULL),
(26, 10, 12, 12, 1, 1, 6, '', 9, 682, NULL, '', '', '', '', 0, '', '11-04-2023', 1, 3, '9856465645', '1681189392', '1681190170', NULL),
(27, 10, 12, 12, 1, 3, 4, '', 9, 631, '', '', '', '', '', 0, '', '11-04-2023', 1, 4, '1424545454', '1681198612', '1681198620', NULL),
(28, 10, 12, 12, 1, 1, 6, '', 9, 631, '', '', '', '', '', 0, '', '11-04-2023', 1, 4, '1424545454', '1681198702', '1681198733', NULL),
(29, 10, 12, 12, 1, 1, 6, '', 9, 631, '', '', '', '', '', 0, '', '11-04-2023', 1, 4, '1424545454', '1681198827', '1681198842', NULL),
(30, 25, 12, 12, 3, 3, 4, '', 6, 347, '31', '8', '11', '', '', 0, '', '23-05-2024', 1, NULL, NULL, '1716459095', '1716459095', NULL),
(31, 12, 28, 26, 3, 2, 3, '', 6, 347, '37', '26', '28', '330', '350', 1, '', '24-05-2024', 1, NULL, NULL, '1716509874', '1716650905', NULL),
(32, 39, 26, 26, 1, 2, 1, '', 6, 347, '35', '19', '23', '2000', '4000', 2, '', '25-05-2024', 1, NULL, NULL, '1716650670', '1717310990', NULL),
(33, 12, 28, 26, 1, 2, 1, '', 6, 347, '35', '19', '23', '2000', '4000', 2, '', '02-06-2024', 1, NULL, NULL, '1717310744', '1718001290', NULL),
(34, 48, 32, 31, 3, 2, 3, '', 6, 347, '38', '17', '19', '125', '160', 1, '', '21-06-2024', 1, NULL, NULL, '1718951178', '1718951178', NULL),
(35, 47, 32, 31, 3, 2, 3, '', 6, 347, '34,54', '', '', '200', '250', 1, 'sector 102 bptp amsotria, and he need a loan ', '21-06-2024', 1, NULL, NULL, '1718952342', '1719026820', NULL),
(36, 51, 32, 31, 3, 2, 3, '', 6, 347, '38', '19', '22', '150', '179', 1, 'dlf garden city enclave', '21-06-2024', 1, NULL, NULL, '1718953202', '1718953202', NULL),
(37, 57, 32, 31, 3, 2, 3, '', 6, 347, '55', '22', '23', '200', '250', 1, 'sector 49', '21-06-2024', 1, NULL, NULL, '1718954545', '1719399631', NULL),
(38, 74, 32, 31, 3, 2, 1, '', 6, 347, '56', '23', '24', '1500', '1700', 2, '3bhk,2unit', '21-06-2024', 1, NULL, NULL, '1718955817', '1719379991', NULL),
(39, 73, 32, 31, 3, 2, 3, '', 6, 347, '37', '22', '23', '250', '300', 1, 'full white', '21-06-2024', 1, NULL, NULL, '1718956275', '1719219718', NULL),
(40, 69, 32, 31, 3, 2, 3, '', 6, 347, '37', '24', '25', '200', '300', 1, 'dlf mai chiye', '21-06-2024', 1, NULL, NULL, '1718956565', '1719380041', NULL),
(41, 70, 32, 31, 3, 2, 3, '', 6, 347, '38', '22', '', '150', '179', 1, 'dlf garden city  enclave', '21-06-2024', 1, NULL, NULL, '1718957214', '1719211673', NULL),
(42, 72, 32, 31, 3, 2, 3, '', 6, 347, '34', '23', '24', '250', '300', 1, '', '21-06-2024', 1, NULL, NULL, '1718959436', '1719214431', NULL),
(43, 79, 32, 31, 3, 2, 1, '', 6, 347, '46', '19', '24', '2500', '2700', 2, 'signature 71 ', '21-06-2024', 1, NULL, NULL, '1718960117', '1718960117', NULL),
(44, 80, 32, 31, 3, 2, 1, '', 6, 347, '46,55', '24', '', '2500', '2700', 2, 'signature 71 /central park resort new tower mai', '21-06-2024', 1, NULL, NULL, '1718960519', '1719212342', NULL),
(45, 84, 32, 31, 3, 3, 4, '', 6, 347, NULL, '24', '25', '250', '500', 2, 'dwarka comercial investment, he is living in dlf phase 2', '21-06-2024', 1, NULL, NULL, '1718960958', '1719212674', NULL),
(46, 85, 32, 31, 3, 2, 3, '', 6, 347, '55', '25', '26', '200', '250', 1, 'with 10-15km from cyber hub', '21-06-2024', 1, NULL, NULL, '1718961173', '1718971498', NULL),
(47, 81, 32, 31, 3, 2, 3, '', 6, 347, '34', '25', '26', '250', '300', 1, 'orris woodview d68 number ki batt hui hai', '21-06-2024', 1, NULL, NULL, '1718961312', '1719218431', NULL),
(48, 82, 32, 31, 3, 2, 3, '', 6, 347, '38', '25', '26', '200', '250', 1, '3 plot ', '21-06-2024', 1, NULL, NULL, '1718961436', '1719218457', NULL),
(49, 83, 32, 31, 3, 2, 3, '', 6, 347, '34', '21', '25', '250', '300', 1, 'orris woodview', '21-06-2024', 1, NULL, NULL, '1718961557', '1718961557', NULL),
(50, 86, 32, 31, 3, 2, 3, '', 6, 347, '31,73,75', '21', '22', '200', '250', 1, 'vatika plot', '21-06-2024', 1, NULL, NULL, '1718962570', '1719036811', NULL),
(51, 87, 32, 31, 3, 2, 3, '', 6, 347, '34', '22', '23', '180', '200', 1, '2 plot ', '21-06-2024', 1, NULL, NULL, '1718963280', '1718963280', NULL),
(52, 88, 32, 31, 3, 3, 4, '', 6, 347, NULL, '17', '19', '250', '500', 2, 'dwarka omax commercial', '21-06-2024', 1, NULL, NULL, '1718969428', '1718969439', NULL),
(53, 89, 32, 31, 3, 2, 1, '', 6, 347, '34,38,41', '20', '21', '2200', '2700', 2, 'new gurgaon, 4bhk,rtm, orris nhi chiye', '21-06-2024', 1, NULL, NULL, '1718971205', '1719036251', NULL),
(54, 92, 32, 31, 3, 2, 3, '', 6, 347, '33', '21', '23', '250', '300', 1, '', '21-06-2024', 1, NULL, NULL, '1718973622', '1719400083', NULL),
(55, 91, 32, 31, 3, 2, 3, '', 6, 347, '34', '18', '19', '200', '250', 1, '', '21-06-2024', 1, NULL, NULL, '1718974538', '1719221929', NULL),
(56, 97, 32, 31, 3, 3, 4, '', 6, 347, '80', '20', '21', '250', '700', 2, '', '22-06-2024', 1, NULL, NULL, '1719036116', '1719036116', NULL),
(57, 93, 32, 31, 3, 2, 3, '', 6, 347, '38,44', '19', '20', '200', '250', 1, 'firstly share the detail in this budget', '22-06-2024', 1, NULL, NULL, '1719040422', '1719040422', NULL),
(58, 104, 32, 31, 3, 2, 3, '', 6, 347, '33,34', '25', '26', '200', '250', 1, 'firstly share detail,visit plan on next sunday', '23-06-2024', 1, NULL, NULL, '1719120416', '1719120542', NULL),
(59, 101, 32, 31, 3, 2, 3, '', 6, 347, '33', '25', '26', '220', '250', 1, 'dlf mai mini 220 sqyd ka plot chiye, ', '23-06-2024', 1, NULL, NULL, '1719121305', '1719121305', NULL),
(60, 96, 32, 31, 3, 2, 3, '', 6, 347, '95,99,108,114', '20', '21', '161', '200', 1, 'plot required', '23-06-2024', 1, NULL, NULL, '1719124192', '1719124192', NULL),
(61, 96, 32, 31, 3, 2, 2, '', 6, 347, '95,99,108,114', '21', '22', '161', '200', 1, 'old house', '23-06-2024', 1, NULL, NULL, '1719124272', '1719124272', NULL),
(62, 106, 32, 31, 3, 2, 3, '', 6, 347, '38,44', '19', '20', '120', '150', 1, 'btata hui but investment krni hai 2cr ki', '23-06-2024', 1, NULL, NULL, '1719135723', '1719135723', NULL),
(63, 107, 32, 31, 3, 2, 3, '', 6, 347, '38,44', '21', '22', '180', '200', 1, 'investment purpose, dlf plot best rate kya ho sakta hai', '23-06-2024', 1, NULL, NULL, '1719138626', '1719138626', NULL),
(64, 108, 32, 31, 3, 2, 3, '', 6, 347, '57', '23', '24', '150', '175', 1, 'bulk m plotting chiye broker hai ye ', '23-06-2024', 1, NULL, NULL, '1719144178', '1719144178', NULL),
(65, 100, 32, 31, 3, NULL, NULL, '', 6, 347, '34,38,44', '20', '21', '150', '200', 1, '', '24-06-2024', 1, NULL, NULL, '1719207772', '1719210131', NULL),
(66, 90, 32, 31, 3, 2, 1, '', 6, 347, '40', '19', '20', '2100', '2200', 2, 'orris aster court 3bhk detail share krni hai', '24-06-2024', 1, NULL, NULL, '1719213578', '1719213592', NULL),
(67, 113, 32, 31, 3, 2, 3, '', 6, 347, '43,119', '21', '22', '150', '200', 1, 'Dwarka expressway p plot chiye', '24-06-2024', 1, NULL, NULL, '1719220766', '1719220777', NULL),
(68, 112, 32, 31, 3, 2, 3, '', 6, 347, '34', '23', '24', '200', '250', 1, 'Now he is out of station contact after 30th june', '24-06-2024', 1, NULL, NULL, '1719220914', '1719220914', NULL),
(69, 120, 32, 31, 3, 2, 3, '', 6, 347, '33,34', '22', '23', '200', '250', 1, 'plot chiye inko investment purpose ', '24-06-2024', 1, NULL, NULL, '1719226405', '1719226405', NULL),
(70, 127, 32, 31, 3, 3, 4, '', 6, 347, '31,34,73', '16', '17', '200', '400', 2, '1.5cr in commercial investment', '26-06-2024', 1, NULL, NULL, '1719381790', '1719381790', NULL),
(71, 122, 32, 31, 3, 2, 3, '', 6, 347, '38', '22', '23', '179', '179', 1, '179 sqyd in budget 4cr', '26-06-2024', 1, NULL, NULL, '1719383180', '1719383180', NULL),
(72, 134, 32, 31, 3, 2, 1, '', 6, 347, '35', '25', '26', '2200', '2300', 2, 'need 2 unit golf hills 3bhk 12k/per.sqft', '26-06-2024', 1, NULL, NULL, '1719383907', '1719383907', NULL),
(73, 53, 32, 31, 3, 2, 3, '', 6, 347, '38,44', '20', '21', '150', '175', 1, '150 sq.yd in budget 3Cr Mai', '26-06-2024', 1, NULL, NULL, '1719391482', '1719391482', NULL),
(74, 114, 32, 31, 3, 2, 3, '', 6, 347, '33', '24', '25', '270', '350', 1, 'dlf garden city ki detail share krdo as such budget delfine nhi kr sakta ', '26-06-2024', 1, NULL, NULL, '1719391738', '1719391738', NULL),
(75, 56, 32, 31, 3, 2, 3, '', 6, 347, '33', '22', '23', '250', '300', 1, '250 sq.yd in budget 1.60 lac/per.sq.yd', '26-06-2024', 1, NULL, NULL, '1719392058', '1719392058', NULL),
(76, 86, 32, 31, 3, 2, 2, '', 6, 347, '31,54,73,75,132', '26', '27', '500', '700', 1, 'villa in Dwarka and Vatika', '27-06-2024', 1, NULL, NULL, '1719466084', '1719466084', NULL),
(77, 77, 32, 31, 3, 2, 3, '', 6, 347, '38,44', '18', '19', '120', '150', 1, '', '27-06-2024', 1, NULL, NULL, '1719468207', '1719468207', NULL),
(78, 143, 32, 31, 3, 2, 1, '', 6, 347, '126', '24', '25', '2300', '2500', 2, 'he need a residential apartment elan 106,2450sqft,', '27-06-2024', 1, NULL, NULL, '1719469719', '1719469719', NULL),
(79, 140, 32, 31, 3, 3, 18, '', 6, 347, '136,137,138', '27', '28', '150', '200', 1, 'he need sco plot in gurgaon', '27-06-2024', 1, NULL, NULL, '1719470185', '1719470958', NULL),
(80, 115, 32, 31, 3, 2, 7, '', 6, 347, '73,75,119', '21', '22', '300', '350', 1, 'he need near to dwarka expressway,4bhk in budget 3cr', '27-06-2024', 1, NULL, NULL, '1719472225', '1719472249', NULL),
(81, 138, 32, 31, 3, 2, 3, '', 6, 347, '33,37,38', '21', '22', '179', '300', 1, 'he need only dlf\r\n', '27-06-2024', 1, NULL, NULL, '1719481379', '1719481379', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `is_admin_member` tinyint(1) NOT NULL DEFAULT 0,
  `is_agent_member` tinyint(1) NOT NULL DEFAULT 0,
  `role_status` tinyint(1) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role_name`, `user_id`, `is_admin_member`, `is_agent_member`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 0, 0, 0, 1, '1573276249', '1573276249'),
(2, 'Agent', 0, 0, 0, 1, '1573276249', '1573276249'),
(3, 'Level 1', 0, 0, 1, 1, '1574162805', '1587803712'),
(4, 'Level 2', 0, 0, 1, 1, '1587803721', '1587803721'),
(5, 'Level 3', 0, 0, 1, 1, '1587803736', '1587803736');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_rights`
--

CREATE TABLE `tbl_role_rights` (
  `role_right_id` int(11) NOT NULL,
  `rr_create` varchar(255) DEFAULT NULL,
  `rr_edit` varchar(255) DEFAULT NULL,
  `rr_delete` varchar(255) DEFAULT NULL,
  `rr_view` varchar(255) DEFAULT NULL,
  `module_id` int(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role_rights`
--

INSERT INTO `tbl_role_rights` (`role_right_id`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`, `module_id`, `role_id`) VALUES
(1, '1', '1', '1', '1', 1, 2),
(2, '0', '0', '0', '0', 2, 2),
(3, '0', '1', '0', '1', 3, 2),
(4, '1', '1', '1', '1', 4, 2),
(5, '1', '1', '1', '1', 5, 2),
(6, '0', '0', '0', '1', 6, 2),
(7, '0', '0', '0', '1', 7, 2),
(8, '0', '0', '0', '1', 8, 2),
(9, '0', '0', '0', '1', 9, 2),
(10, '0', '0', '0', '1', 10, 2),
(11, '0', '0', '0', '0', 11, 2),
(12, '0', '0', '0', '1', 12, 2),
(13, '0', '0', '0', '1', 13, 2),
(14, '1', '1', '1', '1', 14, 2),
(15, '0', '0', '0', '1', 15, 2),
(16, '0', '0', '0', '1', 16, 2),
(17, '0', '0', '0', '1', 17, 2),
(18, '0', '0', '0', '1', 18, 2),
(19, '0', '0', '0', '1', 19, 2),
(20, '0', '0', '0', '1', 20, 2),
(21, '0', '0', '0', '0', 21, 2),
(22, '0', '0', '0', '1', 22, 2),
(23, '0', '0', '0', '1', 23, 2),
(24, '1', '0', '0', '1', 1, 3),
(25, '0', '0', '0', '0', 2, 3),
(26, '0', '1', '0', '1', 3, 3),
(27, '1', '0', '0', '1', 4, 3),
(28, '0', '1', '0', '1', 5, 3),
(29, '0', '0', '0', '0', 6, 3),
(30, '0', '1', '0', '1', 7, 3),
(31, '0', '0', '0', '1', 8, 3),
(32, '0', '0', '0', '0', 9, 3),
(33, '0', '0', '0', '0', 10, 3),
(34, '0', '0', '0', '0', 11, 3),
(35, '0', '0', '0', '0', 12, 3),
(36, '0', '0', '0', '0', 13, 3),
(37, '1', '0', '0', '1', 14, 3),
(38, '0', '0', '0', '0', 15, 3),
(39, '0', '0', '0', '0', 16, 3),
(40, '0', '0', '0', '0', 17, 3),
(41, '0', '0', '0', '0', 18, 3),
(42, '0', '0', '0', '0', 19, 3),
(43, '0', '0', '0', '1', 20, 3),
(44, '0', '0', '0', '0', 21, 3),
(45, '0', '0', '0', '1', 22, 3),
(46, '0', '0', '0', '1', 23, 3),
(47, '1', '0', '0', '1', 1, 4),
(48, '0', '0', '0', '0', 2, 4),
(49, '0', '1', '0', '1', 3, 4),
(50, '1', '0', '0', '1', 4, 4),
(51, '0', '1', '0', '1', 5, 4),
(52, '0', '0', '0', '0', 6, 4),
(53, '0', '1', '0', '1', 7, 4),
(54, '0', '0', '0', '1', 8, 4),
(55, '0', '0', '0', '0', 9, 4),
(56, '0', '0', '0', '0', 10, 4),
(57, '0', '0', '0', '0', 11, 4),
(58, '0', '0', '0', '1', 12, 4),
(59, '0', '0', '0', '0', 13, 4),
(60, '1', '0', '0', '1', 14, 4),
(61, '0', '0', '0', '0', 15, 4),
(62, '0', '0', '0', '0', 16, 4),
(63, '0', '0', '0', '0', 17, 4),
(64, '0', '0', '0', '0', 18, 4),
(65, '0', '0', '0', '1', 19, 4),
(66, '0', '0', '0', '1', 20, 4),
(67, '0', '0', '0', '0', 21, 4),
(68, '0', '0', '0', '1', 22, 4),
(69, '0', '0', '0', '1', 23, 4),
(70, '1', '0', '0', '1', 1, 5),
(71, '0', '0', '0', '0', 2, 5),
(72, '0', '1', '0', '1', 3, 5),
(73, '1', '0', '0', '1', 4, 5),
(74, '0', '1', '0', '1', 5, 5),
(75, '0', '0', '0', '1', 6, 5),
(76, '0', '1', '0', '1', 7, 5),
(77, '0', '0', '0', '1', 8, 5),
(78, '0', '0', '0', '1', 9, 5),
(79, '0', '0', '0', '1', 10, 5),
(80, '0', '0', '0', '0', 11, 5),
(81, '0', '0', '0', '1', 12, 5),
(82, '0', '0', '0', '1', 13, 5),
(83, '1', '0', '0', '1', 14, 5),
(84, '0', '0', '0', '0', 15, 5),
(85, '0', '0', '0', '1', 16, 5),
(86, '0', '0', '0', '0', 17, 5),
(87, '0', '0', '0', '0', 18, 5),
(88, '0', '0', '0', '1', 19, 5),
(89, '0', '0', '0', '1', 20, 5),
(90, '0', '0', '0', '0', 21, 5),
(91, '0', '0', '0', '1', 22, 5),
(92, '0', '0', '0', '1', 23, 5),
(93, '1', '1', '1', '1', 24, 2),
(94, '0', '0', '0', '0', 24, 3),
(95, '0', '0', '0', '1', 25, 2),
(96, '0', '0', '0', '1', 26, 2),
(97, '0', '0', '0', '1', 27, 2),
(98, '0', '0', '0', '1', 28, 2),
(99, '1', '1', '1', '1', 29, 2),
(100, '0', '0', '0', '0', 25, 3),
(101, '0', '0', '0', '0', 26, 3),
(102, '0', '0', '0', '1', 27, 3),
(103, '0', '0', '0', '0', 28, 3),
(104, '0', '0', '0', '0', 29, 3),
(105, '0', '0', '0', '0', 24, 4),
(106, '0', '0', '0', '0', 25, 4),
(107, '0', '0', '0', '0', 26, 4),
(108, '0', '0', '0', '1', 27, 4),
(109, '0', '0', '0', '0', 28, 4),
(110, '0', '0', '0', '0', 29, 4),
(111, '0', '0', '0', '0', 24, 5),
(112, '0', '0', '0', '0', 25, 5),
(113, '0', '0', '0', '0', 26, 5),
(114, '0', '0', '0', '1', 27, 5),
(115, '0', '0', '0', '1', 28, 5),
(116, '0', '0', '0', '0', 29, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `setting_id` int(11) NOT NULL,
  `invoice_company_name` text DEFAULT NULL,
  `invoice_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`setting_id`, `invoice_company_name`, `invoice_address`) VALUES
(1, 'M/s Anshika Creations', '24, Forth Floor, Rosewood Apartment, Pocket-A Sector-13, Dwarka, Delhi -110075');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_setting`
--

CREATE TABLE `tbl_site_setting` (
  `site_setting_id` int(11) NOT NULL,
  `app_url` text DEFAULT NULL,
  `app_version` int(11) DEFAULT NULL,
  `app_update_title` varchar(255) DEFAULT NULL,
  `app_update_message` text DEFAULT NULL,
  `app_force_update` tinyint(1) NOT NULL DEFAULT 0,
  `ios_app_url` text DEFAULT NULL,
  `web_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_site_setting`
--

INSERT INTO `tbl_site_setting` (`site_setting_id`, `app_url`, `app_version`, `app_update_title`, `app_update_message`, `app_force_update`, `ios_app_url`, `web_url`) VALUES
(1, 'https://play.google.com/store/apps/details', 1, 'Update App', 'Please update for new features...', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_visit`
--

CREATE TABLE `tbl_site_visit` (
  `site_visit_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `assign_to` varchar(255) DEFAULT NULL,
  `visit_date` varchar(255) DEFAULT NULL,
  `visit_time` varchar(255) DEFAULT NULL,
  `attend_by` varchar(255) DEFAULT NULL,
  `site_visit_status` int(1) DEFAULT 1 COMMENT '1: pending, 2: sucess, 3:postpone',
  `interested` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:interested: 2:not interested',
  `comment` text DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_site_visit`
--

INSERT INTO `tbl_site_visit` (`site_visit_id`, `lead_id`, `project_id`, `assign_to`, `visit_date`, `visit_time`, `attend_by`, `site_visit_status`, `interested`, `comment`, `account_id`, `user_id`, `created_at`, `updated_at`, `added_by`) VALUES
(1, 4, 1, '13', '20-08-2020', '13:46 pm', 'rajan', 2, 2, 'location issue', 12, 13, '1597907837', '1597907872', 13),
(2, 10, 1, '15', '09-09-2020', '12:37 am', 'raj kuar ', 2, 1, '', 15, 15, '1599628095', '1599628159', 15),
(3, 8, 1, '14', '16-09-2020', '09:41 am', '', 1, 0, '', 14, 14, '1600139530', NULL, 14),
(4, 7, 1, '13', '16-09-2020', '06:45 am', '', 3, 0, 'plan changer will visit later\r\n', 12, 12, '1600139755', '1600140131', 12),
(5, 11, 1, '12', '18-09-2020', '10:30 am', '', 1, 0, '', 12, 12, '1600315217', NULL, 12),
(6, 12, 1, '12', '19-09-2020', '22:56 pm', '', 1, 0, '', 12, 12, '1600446428', NULL, 12),
(7, 2, 1, '20', '11-04-2023', '20:47 pm', '', 1, 0, '', 12, 12, '1680873571', NULL, 12),
(8, 2, 1, '12', '18-04-2023', '18:50 pm', '', 1, 0, '', 12, 12, '1680873767', NULL, 12),
(9, 14, 1, '12', '12-04-2023', '16:53 pm', '', 1, 0, '', 12, 12, '1680873933', NULL, 12),
(10, 13, 1, '20', '12-04-2023', '18:09 pm', '', 1, 0, '', 12, 12, '1681119822', NULL, 12),
(11, 13, 1, '20', '12-04-2023', '18:09 pm', '', 1, 0, '', 12, 12, '1681119834', NULL, 12),
(12, 39, 3, '26', '02-06-2024', '12:28 pm', '', 1, 0, '', 26, 26, '1717311528', NULL, 26),
(13, 12, 2, '26', '11-06-2024', '12:06 pm', '', 1, 0, '', 26, 28, '1718001398', NULL, 26),
(14, 12, 2, '26', '11-06-2024', '12:06 pm', '', 1, 0, '', 26, 28, '1718001398', NULL, 26),
(15, 12, 2, '28', '18-06-2024', '19:42 pm', '', 1, 0, '', 26, 28, '1718719953', NULL, 26),
(16, 127, 6, '32', '29-06-2024', '16:00 pm', '', 1, 0, '', 31, 32, '1719382053', NULL, 32);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_credit`
--

CREATE TABLE `tbl_sms_credit` (
  `sms_credit_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `no_of_sms` int(11) NOT NULL DEFAULT 0,
  `sms_before` int(11) NOT NULL DEFAULT 0,
  `sms_after` int(11) NOT NULL DEFAULT 0,
  `user_type` tinyint(1) DEFAULT NULL COMMENT '1: Admin, 2: Agent',
  `create_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sms_credit`
--

INSERT INTO `tbl_sms_credit` (`sms_credit_id`, `account_id`, `amount`, `no_of_sms`, `sms_before`, `sms_after`, `user_type`, `create_at`) VALUES
(1, 12, '', 5, 0, 5, 2, '05-09-2020 00:20:43 AM'),
(2, 25, '100', 100, 0, 100, 2, '24-05-2024 20:39:35 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_history`
--

CREATE TABLE `tbl_sms_history` (
  `sms_history_id` int(11) NOT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `team_user_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sms_before` int(11) NOT NULL DEFAULT 0,
  `sms_after` int(11) NOT NULL DEFAULT 0,
  `create_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sms_history`
--

INSERT INTO `tbl_sms_history` (`sms_history_id`, `account_id`, `team_user_id`, `customer_id`, `mobile`, `message`, `sms_before`, `sms_after`, `create_at`) VALUES
(1, '12', '12', '11', '9494555666', 'Hi! Thank you for confirming your appointment @ 10:30 am on 18-09-2020 to visit the Shankra Residency. for any assistance call us @ Click4assists.com', 5, 4, '17-09-2020 09:30:19 AM'),
(2, '12', '', '', '8005756759', 'hello', 4, 3, '11-12-2020 13:13:07 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_specifications`
--

CREATE TABLE `tbl_specifications` (
  `specification_id` int(11) NOT NULL,
  `specification_name` varchar(255) DEFAULT NULL,
  `specification_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_specifications`
--

INSERT INTO `tbl_specifications` (`specification_id`, `specification_name`, `specification_status`, `created_at`, `updated_at`) VALUES
(1, 'WATER SUPPLY', 1, '1573532599', '1573532645'),
(2, 'DOORS', 1, '1573532655', '1573532655'),
(3, 'ELECTRICAL', 1, '1573532666', '1573532666'),
(4, 'WINDOWS/BALCONY', 1, '1573532676', '1573532676'),
(5, 'KITCHEN', 1, '1573532686', '1573532686'),
(6, 'Highlights', 1, '1719020355', '1719020355');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

CREATE TABLE `tbl_states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`state_id`, `state_name`, `country_id`) VALUES
(1, 'JAMMU & KASHMIR', 1),
(2, 'HIMACHAL PRADESH', 1),
(3, 'PUNJAB', 1),
(4, 'CHANDIGARH', 1),
(5, 'UTTARANCHAL', 1),
(6, 'HARYANA', 1),
(7, 'DELHI', 1),
(8, 'RAJASTHAN', 1),
(9, 'UTTAR PRADESH', 1),
(10, 'BIHAR', 1),
(11, 'SIKKIM', 1),
(12, 'ARUNACHAL PRADESH', 1),
(13, 'NAGALAND', 1),
(14, 'MANIPUR', 1),
(15, 'MIZORAM', 1),
(16, 'TRIPURA', 1),
(17, 'MEGHALAYA', 1),
(18, 'ASSAM', 1),
(19, 'WEST BENGAL', 1),
(20, 'JHARKHAND', 1),
(21, 'ORISSA', 1),
(22, 'CHHATTISGARH', 1),
(23, 'MADHYA PRADESH', 1),
(24, 'GUJARAT', 1),
(25, 'DAMAN & DIU', 1),
(26, 'DADRA & NAGAR HAVELI', 1),
(27, 'MAHARASHTRA', 1),
(28, 'ANDHRA PRADESH', 1),
(29, 'KARNATAKA', 1),
(30, 'GOA', 1),
(31, 'LAKSHADWEEP', 1),
(32, 'KERALA', 1),
(33, 'TAMIL NADU', 1),
(34, 'PONDICHERRY', 1),
(35, 'ANDAMAN & NICOBAR ISLANDS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_templates`
--

CREATE TABLE `tbl_templates` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `template_message` text DEFAULT NULL,
  `template_subject` text DEFAULT NULL,
  `template_type` int(11) DEFAULT NULL COMMENT '1:SMS, 2:Email, 3: Whatsapp',
  `template_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `disable_delete` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_templates`
--

INSERT INTO `tbl_templates` (`template_id`, `template_name`, `template_message`, `template_subject`, `template_type`, `template_status`, `created_at`, `updated_at`, `disable_delete`, `user_id`) VALUES
(1, 'user_deactivation_sms', 'Hello [name],\r\nYour plan has expired', NULL, 1, 1, '1600083027', '1600087394', 0, 0),
(2, 'user_deactivation_whatsapp', 'Hello [name], Your plan has expired', '', 3, 1, '1600087305', '1600087305', 0, 0),
(3, 'user_deactivation_email', 'Hello [name], Your plan has expired', 'Your plan has expired', 2, 1, '1600087405', '1600087405', 0, 0),
(4, 'share_project_sms', 'Hello [name],\r\nProject Name: [project_name]\r\nProject Link: [project_link]', '', 1, 1, '1600254321', '1600254321', 1, 0),
(5, 'share_project_whatsapp', 'Hello [name], \r\nProject Name: [project_name] \r\nClick [project_link] to Know More ', '', 3, 1, '1600254434', '1600447037', 1, 0),
(6, 'share_project_email', 'Hello [name],\r\nProject Name: [project_name]\r\nProject Link: [project_link]', 'Share Project', 2, 1, '1600254365', '1600254365', 1, 0),
(7, 'Customer Admin SMS', 'Hello [customer_name]', '', 1, 1, '1604703952', '1604703952', 0, 0),
(8, 'Customer Admin EMAIL', 'Hello [customer_name]', 'Customer Test', 2, 1, '1604704261', '1604704261', 0, 0),
(10, 'lead_sms', 'Hello [customer_name]', '', 1, 1, '1606715662', '1681715377', 0, 12),
(11, 'lead_email', 'Hello [customer_name] ', '', 2, 1, '1606715757', '1681713846', 0, 12),
(12, 'lead_whatsapp', 'Hello [customer_name]', '', 3, 1, '1606715779', '1606715779', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE `tbl_tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_track_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `ticket_title` text DEFAULT NULL,
  `ticket_message` text DEFAULT NULL,
  `ticket_status` tinyint(1) DEFAULT 0 COMMENT '1: open, 2, closed',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_messages`
--

CREATE TABLE `tbl_ticket_messages` (
  `ticket_message_id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `ticket_message` text DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_title`
--

CREATE TABLE `tbl_title` (
  `title_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_title`
--

INSERT INTO `tbl_title` (`title_id`, `title`) VALUES
(1, 'Mr.'),
(2, 'Ms.'),
(3, 'Mrs.'),
(4, 'Dr.'),
(5, 'Prof.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_units`
--

CREATE TABLE `tbl_units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `unit_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_units`
--

INSERT INTO `tbl_units` (`unit_id`, `unit_name`, `unit_status`, `created_at`, `updated_at`) VALUES
(1, 'Sq. Yard', 1, '1573474424', '1719109114'),
(2, 'Sq.Ft', 1, '1573474424', '1573474424'),
(3, 'Bigha', 1, '1573474424', '1573474424'),
(4, 'Sq.Mtr', 1, '1573474424', '1573474424'),
(5, 'Fix', 1, '1574409238', '1574409238'),
(6, '% of BSP', 1, '1574409256', '1574409256'),
(7, 'Feet', 1, '1583761930', '1583761930'),
(8, 'Yard', 1, '1583761946', '1583761946'),
(9, 'Meter ', 1, '1583761959', '1583761959'),
(10, 'Acres', 1, '1583762029', '1583762029');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_groups`
--

CREATE TABLE `tbl_unit_groups` (
  `unit_group_id` int(11) NOT NULL,
  `unit_group_name` varchar(255) DEFAULT NULL,
  `unit_group_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_unit_groups`
--

INSERT INTO `tbl_unit_groups` (`unit_group_id`, `unit_group_name`, `unit_group_status`, `created_at`, `updated_at`) VALUES
(1, 'Residential', 1, NULL, NULL),
(2, 'Commercial', 1, NULL, NULL),
(3, 'Agriculture', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_types`
--

CREATE TABLE `tbl_unit_types` (
  `unit_type_id` int(11) NOT NULL,
  `unit_type_name` varchar(255) DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL,
  `unit_type_status` tinyint(1) DEFAULT 0,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `requirement_accomodation` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_unit_types`
--

INSERT INTO `tbl_unit_types` (`unit_type_id`, `unit_type_name`, `product_type_id`, `unit_type_status`, `created_at`, `updated_at`, `requirement_accomodation`) VALUES
(1, 'Multistory Apartment', 2, 1, '1574057008', '1574276725', 0),
(2, 'Villa', 2, 1, '1574057020', '1574867209', 0),
(3, 'Plot', 2, 1, '1574057033', '1574057033', 0),
(4, 'Shop', 3, 1, '1574057122', '1574057122', 0),
(5, 'Office', 3, 1, '1574057143', '1574057143', 0),
(6, 'LAND', 1, 1, '1574057158', '1574057158', 0),
(7, 'Builder Floor', 2, 1, '1574058149', '1574058149', 0),
(8, 'Independent House', 2, 1, '1574867228', '1574867228', 0),
(9, 'Studio Apartment', 2, 1, '1574867243', '1574867243', 0),
(10, 'Pent House', 2, 1, '1574867254', '1574867254', 0),
(11, ' Land', 3, 1, '1574867289', '1574867289', 0),
(12, 'Showroom', 3, 1, '1574867303', '1574867303', 0),
(13, 'Warehouse/ Godown', 3, 1, '1574867314', '1574867314', 0),
(14, 'Industrial land', 3, 1, '1574867336', '1574867336', 0),
(15, 'Industrial Building', 3, 1, '1574867345', '1574867345', 0),
(16, 'Farm House', 1, 1, '1574867356', '1574867356', 0),
(17, 'Agricultural Land', 1, 1, '1574867368', '1574867368', 0),
(18, 'SCO Plot', 3, 1, '1719470249', '1719470249', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) DEFAULT NULL,
  `user_title` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verify` tinyint(1) NOT NULL DEFAULT 0,
  `email_confirm_code` varchar(255) DEFAULT NULL,
  `reset_code` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_hash` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `mobile_verify` tinyint(1) NOT NULL DEFAULT 0,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `user_status` tinyint(1) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `work_time_from` varchar(255) DEFAULT NULL,
  `work_time_to` varchar(255) DEFAULT NULL,
  `associate_complete` tinyint(1) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `accept_terms` tinyint(1) NOT NULL DEFAULT 0,
  `unique_code` varchar(255) DEFAULT NULL,
  `builder_group_id` int(11) DEFAULT NULL,
  `is_individual` tinyint(1) DEFAULT NULL,
  `sdw_title` varchar(255) DEFAULT NULL,
  `sdw_first_name` varchar(255) DEFAULT NULL,
  `sdw_last_name` varchar(255) DEFAULT NULL,
  `firm_type_id` varchar(255) DEFAULT NULL,
  `firm_name` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `address_3` varchar(255) DEFAULT NULL,
  `rera_registered` varchar(255) DEFAULT NULL,
  `rera_no` varchar(255) DEFAULT NULL,
  `owner_title` varchar(255) DEFAULT NULL,
  `owner_first_name` varchar(255) DEFAULT NULL,
  `owner_last_name` varchar(255) DEFAULT NULL,
  `owner_mobile` varchar(255) DEFAULT NULL,
  `owner_contact_no` varchar(255) DEFAULT NULL,
  `owner_whatsapp_no` varchar(255) DEFAULT NULL,
  `rera_dor` varchar(255) DEFAULT NULL,
  `rera_valid_till` varchar(255) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `adhar_no` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `cin_no` varchar(255) DEFAULT NULL,
  `tan_no` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `cin_image` varchar(255) DEFAULT NULL,
  `tan_image` varchar(255) DEFAULT NULL,
  `pan_image` varchar(255) DEFAULT NULL,
  `gst_image` varchar(255) DEFAULT NULL,
  `adhar_image` varchar(255) DEFAULT NULL,
  `rera_image` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `date_register` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `no_of_user` int(11) DEFAULT 0,
  `last_visit` varchar(255) DEFAULT NULL,
  `report_to` int(11) DEFAULT 0,
  `mobile_otp` varchar(255) DEFAULT NULL,
  `current_plan_date` varchar(255) DEFAULT NULL,
  `next_due_date` varchar(255) DEFAULT NULL,
  `per_user_amount` varchar(255) DEFAULT NULL,
  `monthly_cost` varchar(255) DEFAULT NULL,
  `no_of_sms` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `role_id`, `username`, `user_title`, `first_name`, `last_name`, `full_name`, `email`, `email_verify`, `email_confirm_code`, `reset_code`, `password`, `user_hash`, `mobile`, `mobile_verify`, `whatsapp_no`, `contact_no`, `user_status`, `parent_id`, `work_time_from`, `work_time_to`, `associate_complete`, `country_id`, `state_id`, `city_id`, `plan_id`, `accept_terms`, `unique_code`, `builder_group_id`, `is_individual`, `sdw_title`, `sdw_first_name`, `sdw_last_name`, `firm_type_id`, `firm_name`, `address_1`, `address_2`, `address_3`, `rera_registered`, `rera_no`, `owner_title`, `owner_first_name`, `owner_last_name`, `owner_mobile`, `owner_contact_no`, `owner_whatsapp_no`, `rera_dor`, `rera_valid_till`, `pan_no`, `adhar_no`, `gst_no`, `cin_no`, `tan_no`, `logo`, `cin_image`, `tan_image`, `pan_image`, `gst_image`, `adhar_image`, `rera_image`, `image`, `group_name`, `date_register`, `created_at`, `updated_at`, `no_of_user`, `last_visit`, `report_to`, `mobile_otp`, `current_plan_date`, `next_due_date`, `per_user_amount`, `monthly_cost`, `no_of_sms`) VALUES
(1, 1, 'admin', 'Mr', 'Admin', NULL, NULL, 'admin@gmail.com', 1, NULL, NULL, '35996ae6a7b2fcae1f90aa025cfdf43a', 'a59abbe56e057f20f8', '7793042536', 1, NULL, NULL, 1, 0, '', '', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdfdf', 'fdf', 'dfdf', 0, '1588652518', 0, NULL, NULL, NULL, NULL, NULL, 0),
(25, 2, 'sudhir', NULL, 'Sudhir', 'singh', NULL, 'sudhir.softechure@gmail.com', 1, '62012950d8f38175bebc71a9176fca292c3a55aa0daeba274a50e7525c068707', NULL, '25f9e794323b453885f5181f1b624d0b', '2c3a55aa0daeba274a50e7525c06870717164605615571', '7742929092', 1, '7742929092', NULL, 1, 0, NULL, NULL, 0, 1, 8, 474, 1, 1, '752435', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23-05-2024', '1716460561', '1716460561', 1, NULL, 0, NULL, '23-05-2024', '30-05-2025', '0', '0', 100),
(26, 2, 'Grovestate', 'Mr.', 'Sanjay ', 'Grover', NULL, 'Grovestate1@gmail.com', 1, '', NULL, '836b3fdc42d30c0f7161834ed1298889', '7d6364a726df0b358dbe3c7b593968ad17164650505188', '8630024655', 1, '8630024655', '', 1, 0, NULL, NULL, 1, 1, 6, 347, 1, 1, '871235', NULL, 1, 'Mr.', '.', '.', '', '', '709, 7th Floor, ILD Trade Center', 'Sector 47, Sohna Road', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23-05-2024', '1716465050', '1716465584', 1, '1719469273', 0, NULL, '23-05-2024', '30-05-2025', '0', '0', 0),
(27, 3, 'P_rajpoot', 'Ms.', 'Poonam', 'Rajpoot', NULL, 'sshiddat314@gmail.com', 1, NULL, NULL, '42ede01046caf754678328a011ce520b', '5113ec2073529e1f766547eb0d0aab6e17164660239776', '8368300754', 0, '', NULL, 1, 26, '', '', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23-05-2024', '1716466023', '1716466023', 0, NULL, 26, NULL, NULL, NULL, NULL, NULL, 0),
(28, 3, 'Sunil_kumar', 'Mr.', 'Sunil ', 'Kumar', NULL, 'sunilkumar15987412@gmail.com', 1, NULL, '', 'b68bca2b7357d1ce6ac6e711f5c426dd', 'f2d57003082c0d5d7a295ae9ed686b6417164661037658', '8851639830', 0, '', NULL, 1, 26, '', '', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23-05-2024', '1716466103', '1716466103', 0, NULL, 26, NULL, NULL, NULL, NULL, NULL, 0),
(30, 2, 'abhijeet', 'Mr.', 'test', 'test2', NULL, 'abhijeet.softechure@gmail.com', 1, '', NULL, '25d55ad283aa400af464c76d713c07ad', 'ee2df17cb0828c9a961a83b1e37e18cf17164670655841', '8547854785', 1, '8547854785', '5845878548', 1, 0, NULL, NULL, 1, 1, 8, 474, 1, 1, '175315', NULL, 1, 'Mr.', 'test', 'test', '', '', 'test', 'test', 'teswt', '0', '', '', '', '', '', '', '', '', '', 'psfgf2345n', '584584578458', '09AAACH7409R1ZZ', '', '', NULL, NULL, NULL, '6c37ed1ed352701b106314587eac0957.png', 'c048d4419e2704ad32015aff917b49e8.png', 'f4fbdbb080aa06706264860f8b7d6f69.png', NULL, 'ca6a9f6c5970ede58d2635488575ad6d.png', NULL, '23-05-2024', '1716467065', '1716467238', 1, NULL, 0, NULL, '23-05-2024', '30-05-2025', '0', '0', 0),
(31, 2, 'click4assists', 'Mr.', 'AK', 'Singhal', NULL, 'Click4assists@gmail.com', 1, '', NULL, '4eb2c610b061cf4803d26061e42c77ab', 'e307bc8f41d1e03684380ad34f39adfa17189484645863', '9319931036', 1, '9319931036', '', 1, 0, NULL, NULL, 1, 1, 8, 474, 1, 1, '187652', NULL, 1, 'Mr.', 'AK', 'K', '', '', 'Jaipur', 'Jaipur', 'Jaipur', '0', '', '', '', '', '', '', '', '', '', 'ABCDD9587N', '587584785454', '22AAAAA0000A1Z5', '', '', NULL, NULL, NULL, '1e557b9a96c510bf7f2b866661446494.jpg', '85a63acb4eb617aa3d00520cbf788397.jpg', '260157ca616be78df726c98a44a0539d.jpg', NULL, '13ad83fe67cf6a10fcc3d53b134333a0.jpg', NULL, '21-06-2024', '1718948464', '1718948809', 1, '1719108705', 0, NULL, '21-06-2024', '28-06-2025', '1', '0', 0),
(32, 3, 'P', 'Ms.', 'Priksha', 'Sharma', NULL, 'prikshasharma950@gmail.com', 1, NULL, NULL, '75ec4a2de73beb7badd616cd92474ed4', '46dd9a2170aeba1506481e471f70067817192120082253', '9650410848', 0, '9650410848', NULL, 1, 31, '', '', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21-06-2024', '1718950031', '1719212008', 0, NULL, 33, NULL, NULL, NULL, NULL, NULL, 0),
(33, 4, 'V_Verma', 'Mr.', 'Vinayak', 'Verma', NULL, 'vasuverma221@gmail.com', 1, NULL, NULL, '42d23ea30420d9773a4692279d3d6989', 'bb0f899767e0db88d375771de57a394617192117364471', '86300 2465', 0, '86300 2465', NULL, 1, 31, '', '', 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24-06-2024', '1719211659', '1719211736', 0, NULL, 31, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_details`
--

CREATE TABLE `tbl_user_details` (
  `user_detail_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `whatsapp_api_mobile` varchar(255) DEFAULT NULL,
  `whatsapp_api_password` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_details`
--

INSERT INTO `tbl_user_details` (`user_detail_id`, `user_id`, `whatsapp_api_mobile`, `whatsapp_api_password`, `mail_username`, `mail_password`) VALUES
(2, '26', '9319931036', '', NULL, NULL),
(3, '31', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accomodations`
--
ALTER TABLE `tbl_accomodations`
  ADD PRIMARY KEY (`accomodation_id`);

--
-- Indexes for table `tbl_additional_cost`
--
ALTER TABLE `tbl_additional_cost`
  ADD PRIMARY KEY (`additional_cost_id`);

--
-- Indexes for table `tbl_additional_parking_cost`
--
ALTER TABLE `tbl_additional_parking_cost`
  ADD PRIMARY KEY (`additional_parking_cost_id`);

--
-- Indexes for table `tbl_additional_plc_cost`
--
ALTER TABLE `tbl_additional_plc_cost`
  ADD PRIMARY KEY (`additional_plc_cost_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_admin_roles`
--
ALTER TABLE `tbl_admin_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_admin_teams`
--
ALTER TABLE `tbl_admin_teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `tbl_agents`
--
ALTER TABLE `tbl_agents`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `tbl_amenities`
--
ALTER TABLE `tbl_amenities`
  ADD PRIMARY KEY (`amenitie_id`);

--
-- Indexes for table `tbl_authorities`
--
ALTER TABLE `tbl_authorities`
  ADD PRIMARY KEY (`authority_id`);

--
-- Indexes for table `tbl_basic_cost`
--
ALTER TABLE `tbl_basic_cost`
  ADD PRIMARY KEY (`basic_cost_id`,`inventory_id`);

--
-- Indexes for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_budgets`
--
ALTER TABLE `tbl_budgets`
  ADD PRIMARY KEY (`budget_id`);

--
-- Indexes for table `tbl_builders`
--
ALTER TABLE `tbl_builders`
  ADD PRIMARY KEY (`builder_id`);

--
-- Indexes for table `tbl_builder_groups`
--
ALTER TABLE `tbl_builder_groups`
  ADD PRIMARY KEY (`builder_group_id`);

--
-- Indexes for table `tbl_chats`
--
ALTER TABLE `tbl_chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_construction_ages`
--
ALTER TABLE `tbl_construction_ages`
  ADD PRIMARY KEY (`construction_age_id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_designations`
--
ALTER TABLE `tbl_designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `tbl_facings`
--
ALTER TABLE `tbl_facings`
  ADD PRIMARY KEY (`facing_id`);

--
-- Indexes for table `tbl_feedbacks`
--
ALTER TABLE `tbl_feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_finances`
--
ALTER TABLE `tbl_finances`
  ADD PRIMARY KEY (`finance_id`);

--
-- Indexes for table `tbl_firm_types`
--
ALTER TABLE `tbl_firm_types`
  ADD PRIMARY KEY (`firm_type_id`);

--
-- Indexes for table `tbl_floors`
--
ALTER TABLE `tbl_floors`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `tbl_followup`
--
ALTER TABLE `tbl_followup`
  ADD PRIMARY KEY (`followup_id`);

--
-- Indexes for table `tbl_furnised_status`
--
ALTER TABLE `tbl_furnised_status`
  ADD PRIMARY KEY (`furnised_status_id`);

--
-- Indexes for table `tbl_furnishings`
--
ALTER TABLE `tbl_furnishings`
  ADD PRIMARY KEY (`furnishing_id`);

--
-- Indexes for table `tbl_ideal_business`
--
ALTER TABLE `tbl_ideal_business`
  ADD PRIMARY KEY (`ideal_business_id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `tbl_inventory_additional`
--
ALTER TABLE `tbl_inventory_additional`
  ADD PRIMARY KEY (`inventory_additional_id`);

--
-- Indexes for table `tbl_inventory_plc`
--
ALTER TABLE `tbl_inventory_plc`
  ADD PRIMARY KEY (`inventory_plc_id`);

--
-- Indexes for table `tbl_inventory_status`
--
ALTER TABLE `tbl_inventory_status`
  ADD PRIMARY KEY (`inventory_status_id`);

--
-- Indexes for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `tbl_lead_actions`
--
ALTER TABLE `tbl_lead_actions`
  ADD PRIMARY KEY (`lead_action_id`);

--
-- Indexes for table `tbl_lead_history`
--
ALTER TABLE `tbl_lead_history`
  ADD PRIMARY KEY (`lead_history_id`);

--
-- Indexes for table `tbl_lead_options`
--
ALTER TABLE `tbl_lead_options`
  ADD PRIMARY KEY (`lead_option_id`);

--
-- Indexes for table `tbl_lead_sources`
--
ALTER TABLE `tbl_lead_sources`
  ADD PRIMARY KEY (`lead_source_id`);

--
-- Indexes for table `tbl_lead_stages`
--
ALTER TABLE `tbl_lead_stages`
  ADD PRIMARY KEY (`lead_stage_id`);

--
-- Indexes for table `tbl_lead_transfer`
--
ALTER TABLE `tbl_lead_transfer`
  ADD PRIMARY KEY (`lead_transfer_id`);

--
-- Indexes for table `tbl_lead_types`
--
ALTER TABLE `tbl_lead_types`
  ADD PRIMARY KEY (`lead_type_id`);

--
-- Indexes for table `tbl_listing_types`
--
ALTER TABLE `tbl_listing_types`
  ADD PRIMARY KEY (`listing_type_id`);

--
-- Indexes for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `tbl_occupations`
--
ALTER TABLE `tbl_occupations`
  ADD PRIMARY KEY (`occupation_id`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `tbl_paid_type`
--
ALTER TABLE `tbl_paid_type`
  ADD PRIMARY KEY (`paid_type_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_plan`
--
ALTER TABLE `tbl_plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `tbl_price_components`
--
ALTER TABLE `tbl_price_components`
  ADD PRIMARY KEY (`price_component_id`);

--
-- Indexes for table `tbl_price_groups`
--
ALTER TABLE `tbl_price_groups`
  ADD PRIMARY KEY (`price_group_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_product_additional_details`
--
ALTER TABLE `tbl_product_additional_details`
  ADD PRIMARY KEY (`product_additional_detail_id`);

--
-- Indexes for table `tbl_product_block_details`
--
ALTER TABLE `tbl_product_block_details`
  ADD PRIMARY KEY (`block_id`);

--
-- Indexes for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Indexes for table `tbl_product_plc_details`
--
ALTER TABLE `tbl_product_plc_details`
  ADD PRIMARY KEY (`product_plc_detail_id`);

--
-- Indexes for table `tbl_product_specifications`
--
ALTER TABLE `tbl_product_specifications`
  ADD PRIMARY KEY (`product_specification_id`);

--
-- Indexes for table `tbl_product_types`
--
ALTER TABLE `tbl_product_types`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `tbl_product_unit_details`
--
ALTER TABLE `tbl_product_unit_details`
  ADD PRIMARY KEY (`product_unit_detail_id`);

--
-- Indexes for table `tbl_project_share`
--
ALTER TABLE `tbl_project_share`
  ADD PRIMARY KEY (`project_share_id`);

--
-- Indexes for table `tbl_project_status`
--
ALTER TABLE `tbl_project_status`
  ADD PRIMARY KEY (`project_status_id`);

--
-- Indexes for table `tbl_project_types`
--
ALTER TABLE `tbl_project_types`
  ADD PRIMARY KEY (`project_type_id`);

--
-- Indexes for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `tbl_property_detail`
--
ALTER TABLE `tbl_property_detail`
  ADD PRIMARY KEY (`property_detail_id`);

--
-- Indexes for table `tbl_property_furnishing`
--
ALTER TABLE `tbl_property_furnishing`
  ADD PRIMARY KEY (`property_furnishing_id`);

--
-- Indexes for table `tbl_property_types`
--
ALTER TABLE `tbl_property_types`
  ADD PRIMARY KEY (`property_type_id`);

--
-- Indexes for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  ADD PRIMARY KEY (`requirement_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_role_rights`
--
ALTER TABLE `tbl_role_rights`
  ADD PRIMARY KEY (`role_right_id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `tbl_site_setting`
--
ALTER TABLE `tbl_site_setting`
  ADD PRIMARY KEY (`site_setting_id`);

--
-- Indexes for table `tbl_site_visit`
--
ALTER TABLE `tbl_site_visit`
  ADD PRIMARY KEY (`site_visit_id`);

--
-- Indexes for table `tbl_sms_credit`
--
ALTER TABLE `tbl_sms_credit`
  ADD PRIMARY KEY (`sms_credit_id`);

--
-- Indexes for table `tbl_sms_history`
--
ALTER TABLE `tbl_sms_history`
  ADD PRIMARY KEY (`sms_history_id`);

--
-- Indexes for table `tbl_specifications`
--
ALTER TABLE `tbl_specifications`
  ADD PRIMARY KEY (`specification_id`);

--
-- Indexes for table `tbl_states`
--
ALTER TABLE `tbl_states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `tbl_ticket_messages`
--
ALTER TABLE `tbl_ticket_messages`
  ADD PRIMARY KEY (`ticket_message_id`);

--
-- Indexes for table `tbl_title`
--
ALTER TABLE `tbl_title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `tbl_units`
--
ALTER TABLE `tbl_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `tbl_unit_groups`
--
ALTER TABLE `tbl_unit_groups`
  ADD PRIMARY KEY (`unit_group_id`);

--
-- Indexes for table `tbl_unit_types`
--
ALTER TABLE `tbl_unit_types`
  ADD PRIMARY KEY (`unit_type_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD PRIMARY KEY (`user_detail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accomodations`
--
ALTER TABLE `tbl_accomodations`
  MODIFY `accomodation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_additional_cost`
--
ALTER TABLE `tbl_additional_cost`
  MODIFY `additional_cost_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_additional_parking_cost`
--
ALTER TABLE `tbl_additional_parking_cost`
  MODIFY `additional_parking_cost_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_additional_plc_cost`
--
ALTER TABLE `tbl_additional_plc_cost`
  MODIFY `additional_plc_cost_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin_roles`
--
ALTER TABLE `tbl_admin_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin_teams`
--
ALTER TABLE `tbl_admin_teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_agents`
--
ALTER TABLE `tbl_agents`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_amenities`
--
ALTER TABLE `tbl_amenities`
  MODIFY `amenitie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_authorities`
--
ALTER TABLE `tbl_authorities`
  MODIFY `authority_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_basic_cost`
--
ALTER TABLE `tbl_basic_cost`
  MODIFY `basic_cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_budgets`
--
ALTER TABLE `tbl_budgets`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_builders`
--
ALTER TABLE `tbl_builders`
  MODIFY `builder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_builder_groups`
--
ALTER TABLE `tbl_builder_groups`
  MODIFY `builder_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_chats`
--
ALTER TABLE `tbl_chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5565;

--
-- AUTO_INCREMENT for table `tbl_construction_ages`
--
ALTER TABLE `tbl_construction_ages`
  MODIFY `construction_age_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_designations`
--
ALTER TABLE `tbl_designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_facings`
--
ALTER TABLE `tbl_facings`
  MODIFY `facing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_feedbacks`
--
ALTER TABLE `tbl_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_finances`
--
ALTER TABLE `tbl_finances`
  MODIFY `finance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_firm_types`
--
ALTER TABLE `tbl_firm_types`
  MODIFY `firm_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_floors`
--
ALTER TABLE `tbl_floors`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_followup`
--
ALTER TABLE `tbl_followup`
  MODIFY `followup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `tbl_furnised_status`
--
ALTER TABLE `tbl_furnised_status`
  MODIFY `furnised_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_furnishings`
--
ALTER TABLE `tbl_furnishings`
  MODIFY `furnishing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_ideal_business`
--
ALTER TABLE `tbl_ideal_business`
  MODIFY `ideal_business_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `tbl_inventory_additional`
--
ALTER TABLE `tbl_inventory_additional`
  MODIFY `inventory_additional_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_inventory_plc`
--
ALTER TABLE `tbl_inventory_plc`
  MODIFY `inventory_plc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `tbl_inventory_status`
--
ALTER TABLE `tbl_inventory_status`
  MODIFY `inventory_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `tbl_lead_actions`
--
ALTER TABLE `tbl_lead_actions`
  MODIFY `lead_action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_lead_history`
--
ALTER TABLE `tbl_lead_history`
  MODIFY `lead_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `tbl_lead_options`
--
ALTER TABLE `tbl_lead_options`
  MODIFY `lead_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_lead_sources`
--
ALTER TABLE `tbl_lead_sources`
  MODIFY `lead_source_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_lead_stages`
--
ALTER TABLE `tbl_lead_stages`
  MODIFY `lead_stage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_lead_transfer`
--
ALTER TABLE `tbl_lead_transfer`
  MODIFY `lead_transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_lead_types`
--
ALTER TABLE `tbl_lead_types`
  MODIFY `lead_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_listing_types`
--
ALTER TABLE `tbl_listing_types`
  MODIFY `listing_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_locations`
--
ALTER TABLE `tbl_locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_occupations`
--
ALTER TABLE `tbl_occupations`
  MODIFY `occupation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_paid_type`
--
ALTER TABLE `tbl_paid_type`
  MODIFY `paid_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_plan`
--
ALTER TABLE `tbl_plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_price_components`
--
ALTER TABLE `tbl_price_components`
  MODIFY `price_component_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_price_groups`
--
ALTER TABLE `tbl_price_groups`
  MODIFY `price_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_product_additional_details`
--
ALTER TABLE `tbl_product_additional_details`
  MODIFY `product_additional_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product_block_details`
--
ALTER TABLE `tbl_product_block_details`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product_plc_details`
--
ALTER TABLE `tbl_product_plc_details`
  MODIFY `product_plc_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_product_specifications`
--
ALTER TABLE `tbl_product_specifications`
  MODIFY `product_specification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_product_types`
--
ALTER TABLE `tbl_product_types`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_product_unit_details`
--
ALTER TABLE `tbl_product_unit_details`
  MODIFY `product_unit_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_project_share`
--
ALTER TABLE `tbl_project_share`
  MODIFY `project_share_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_project_status`
--
ALTER TABLE `tbl_project_status`
  MODIFY `project_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_project_types`
--
ALTER TABLE `tbl_project_types`
  MODIFY `project_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_property`
--
ALTER TABLE `tbl_property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_property_detail`
--
ALTER TABLE `tbl_property_detail`
  MODIFY `property_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_property_furnishing`
--
ALTER TABLE `tbl_property_furnishing`
  MODIFY `property_furnishing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_property_types`
--
ALTER TABLE `tbl_property_types`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_role_rights`
--
ALTER TABLE `tbl_role_rights`
  MODIFY `role_right_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_site_setting`
--
ALTER TABLE `tbl_site_setting`
  MODIFY `site_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_site_visit`
--
ALTER TABLE `tbl_site_visit`
  MODIFY `site_visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_sms_credit`
--
ALTER TABLE `tbl_sms_credit`
  MODIFY `sms_credit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sms_history`
--
ALTER TABLE `tbl_sms_history`
  MODIFY `sms_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_specifications`
--
ALTER TABLE `tbl_specifications`
  MODIFY `specification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_states`
--
ALTER TABLE `tbl_states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ticket_messages`
--
ALTER TABLE `tbl_ticket_messages`
  MODIFY `ticket_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_title`
--
ALTER TABLE `tbl_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_units`
--
ALTER TABLE `tbl_units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_unit_groups`
--
ALTER TABLE `tbl_unit_groups`
  MODIFY `unit_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_unit_types`
--
ALTER TABLE `tbl_unit_types`
  MODIFY `unit_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
