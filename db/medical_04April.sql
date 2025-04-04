-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 05:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blood_group`
--

CREATE TABLE `tbl_blood_group` (
  `blood_group_id` int(11) NOT NULL,
  `blood_group_name` varchar(50) DEFAULT NULL,
  `blood_group_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blood_group_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_blood_group`
--

INSERT INTO `tbl_blood_group` (`blood_group_id`, `blood_group_name`, `blood_group_updated_on`, `blood_group_created_on`) VALUES
(1, 'A+', '2023-11-01 10:40:31', '2023-11-01 10:40:31'),
(2, 'A-', '2023-11-01 10:40:31', '2023-11-01 10:40:31'),
(3, 'B+', '2023-11-01 10:40:43', '2023-11-01 10:40:43'),
(4, 'B-', '2023-11-01 10:40:43', '2023-11-01 10:40:43'),
(5, 'AB+', '2023-11-01 10:41:02', '2023-11-01 10:41:02'),
(6, 'AB-', '2023-11-01 10:41:02', '2023-11-01 10:41:02'),
(7, 'O+', '2023-11-01 10:41:23', '2023-11-01 10:41:23'),
(8, 'O-', '2023-11-01 10:41:23', '2023-11-01 10:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_billing_number` varchar(25) DEFAULT NULL,
  `cart_user_id` int(11) NOT NULL,
  `cart_stock_id` int(11) NOT NULL,
  `cart_qty` float NOT NULL,
  `is_cutting` float NOT NULL,
  `cart_price_rate_gst` float NOT NULL,
  `cart_price_mrp` float NOT NULL,
  `cart_price` float NOT NULL,
  `is_paid_cart` int(11) NOT NULL,
  `cart_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cart_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_billing_number`, `cart_user_id`, `cart_stock_id`, `cart_qty`, `is_cutting`, `cart_price_rate_gst`, `cart_price_mrp`, `cart_price`, `is_paid_cart`, `cart_updated_on`, `cart_created_on`) VALUES
(9, '2', 13, 3, 5, 1, 6.72, 15.52, 20, 1, '2025-04-04 15:26:11', '2025-04-04 15:25:33'),
(10, '2', 13, 3, 1, 0, 13.44, 31.04, 30, 1, '2025-04-04 15:26:11', '2025-04-04 15:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_bill`
--

CREATE TABLE `tbl_customer_bill` (
  `bill_id` int(11) NOT NULL,
  `bill_customer_id` int(11) DEFAULT NULL,
  `bill_doctor_id` int(11) DEFAULT NULL,
  `bill_details` text NOT NULL,
  `bill_total_amount` float NOT NULL,
  `bill_total_discount` float NOT NULL,
  `bill_total_net` float NOT NULL,
  `bill_payment_mode` int(11) NOT NULL,
  `bill_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer_bill`
--

INSERT INTO `tbl_customer_bill` (`bill_id`, `bill_customer_id`, `bill_doctor_id`, `bill_details`, `bill_total_amount`, `bill_total_discount`, `bill_total_net`, `bill_payment_mode`, `bill_created_on`) VALUES
(2, 13, 0, '{\"10\":\"30\",\"9\":\"20\"}', 0, 0, 50, 2, '2025-04-04 15:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detal_numbering`
--

CREATE TABLE `tbl_detal_numbering` (
  `dental_id` int(11) NOT NULL,
  `dental_number_id` int(11) NOT NULL,
  `dental_name` varchar(50) DEFAULT NULL,
  `dental_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dental_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detal_numbering`
--

INSERT INTO `tbl_detal_numbering` (`dental_id`, `dental_number_id`, `dental_name`, `dental_updated_on`, `dental_created_on`) VALUES
(1, 11, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(2, 12, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(3, 13, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(4, 14, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(5, 15, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(6, 16, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(7, 17, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(8, 18, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(9, 21, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(10, 22, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(11, 23, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(12, 24, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(13, 25, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(14, 26, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(15, 27, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(16, 28, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(17, 31, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(18, 32, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(19, 33, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(20, 34, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(21, 35, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(22, 36, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(23, 37, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(24, 38, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(25, 41, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(26, 42, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(27, 43, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(28, 44, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(29, 45, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(30, 46, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(31, 47, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(32, 48, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(33, 51, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(34, 52, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(35, 53, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(36, 54, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(37, 55, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(38, 61, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(39, 62, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(40, 63, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(41, 64, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(42, 65, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(43, 71, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(44, 72, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(45, 73, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(46, 74, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(47, 75, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(48, 81, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(49, 82, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(50, 83, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(51, 84, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12'),
(52, 85, NULL, '2024-06-10 10:04:12', '2024-06-10 10:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_type`
--

CREATE TABLE `tbl_employee_type` (
  `emp_type_id` int(11) NOT NULL,
  `emp_type_name` varchar(50) NOT NULL,
  `emp_type_access` text DEFAULT NULL,
  `emp_type_status` int(11) NOT NULL DEFAULT 1,
  `emp_type_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `emp_type_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employee_type`
--

INSERT INTO `tbl_employee_type` (`emp_type_id`, `emp_type_name`, `emp_type_access`, `emp_type_status`, `emp_type_updated_on`, `emp_type_created_on`) VALUES
(1, 'Admin', '[\"main-user-list\",\"user-list\",\"add-user\",\"update-user\",\"role-list\",\"add-role\",\"update-role\",\"main-customer-list\",\"customer-list\",\"add-customer\",\"update-customer\",\"patient-history-list\",\"appointment-list\",\"add-appointment\",\"update-appointment\",\"document-list\",\"add-document\",\"treatment-list\",\"add-treatment\",\"update-treatment\",\"payment-list\",\"add-payment\",\"update-payment\",\"main-appointment-list\",\"all-appointment-list\",\"today-appointment-list\",\"upcoming-appointment-list\",\"main-medicine-list\",\"medicine-list\",\"add-medicine\",\"update-medicine\",\"medicine-category-list\",\"add-medicine-category\",\"update-medicine-category\",\"lab-test-list\",\"add-lab-test\",\"update-lab-test\",\"prescription-list\",\"add-prescription\"]', 1, '2025-03-25 13:55:07', '2022-02-21 14:25:43'),
(2, 'Doctor', '[\"main-user-list\",\"user-list\",\"add-user\",\"update-user\"]', 1, '2023-11-02 06:04:54', '2022-02-21 14:25:43'),
(3, 'Patient', NULL, 1, '2023-11-02 06:03:51', '2022-02-21 14:25:43'),
(5, 'Pharmacist', NULL, 1, '2023-11-01 07:09:36', '2022-02-21 14:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_test`
--

CREATE TABLE `tbl_lab_test` (
  `lab_test_id` int(11) NOT NULL,
  `lab_test_created_id` int(11) NOT NULL,
  `lab_test_name` varchar(50) NOT NULL,
  `lab_test_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lab_test_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lab_test`
--

INSERT INTO `tbl_lab_test` (`lab_test_id`, `lab_test_created_id`, `lab_test_name`, `lab_test_updated_on`, `lab_test_created_on`) VALUES
(1, 1, 'Urine ', '2023-11-08 11:30:23', '2023-11-08 11:27:16'),
(2, 1, 'Blood', '2023-11-08 11:30:35', '2023-11-08 11:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine`
--

CREATE TABLE `tbl_medicine` (
  `med_id` int(11) NOT NULL,
  `med_created_id` int(11) NOT NULL,
  `med_name` varchar(50) NOT NULL,
  `med_cat_id` int(11) NOT NULL,
  `med_mfg` varchar(50) DEFAULT NULL,
  `med_unit` varchar(50) DEFAULT NULL,
  `med_scheme` varchar(50) DEFAULT NULL,
  `med_mrp` varchar(50) DEFAULT NULL,
  `med_rate` varchar(50) DEFAULT NULL,
  `med_disc` varchar(50) DEFAULT NULL,
  `med_hsn` varchar(50) DEFAULT NULL,
  `med_gst_per` varchar(25) DEFAULT NULL,
  `med_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `med_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_medicine`
--

INSERT INTO `tbl_medicine` (`med_id`, `med_created_id`, `med_name`, `med_cat_id`, `med_mfg`, `med_unit`, `med_scheme`, `med_mrp`, `med_rate`, `med_disc`, `med_hsn`, `med_gst_per`, `med_updated_on`, `med_created_on`) VALUES
(4, 0, 'Eazyspas Syp', 1, 'AME', '60ML', '', '65.00', '18.00', '', '3004', '12.00', '2024-06-12 13:53:53', '2024-06-12 13:53:53'),
(5, 0, 'FLUCID-B Cream', 1, 'BIO', '10GM', '', '117.80', '17', '', '1211', '12', '2024-06-12 13:58:35', '2024-06-12 13:58:35'),
(6, 0, 'AMLIP 5', 1, 'CIP', '10TAB', '', '27.99', '7.90', '', '3004', '12', '2024-06-12 17:34:02', '2024-06-12 13:59:48'),
(7, 0, 'OKACET-L', 3, 'CIP', '10TAB', '', '68.97', '5.10', '5', '3004', '12', '2025-03-23 16:50:06', '2024-06-12 14:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine_category`
--

CREATE TABLE `tbl_medicine_category` (
  `med_cat_id` int(11) NOT NULL,
  `med_cat_created_id` int(11) NOT NULL,
  `med_cat_name` varchar(50) NOT NULL,
  `med_cat_default` int(11) NOT NULL,
  `med_cat_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `med_cat_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_medicine_category`
--

INSERT INTO `tbl_medicine_category` (`med_cat_id`, `med_cat_created_id`, `med_cat_name`, `med_cat_default`, `med_cat_updated_on`, `med_cat_created_on`) VALUES
(1, 1, 'Genric', 0, '2025-03-23 15:45:25', '2023-11-06 10:52:09'),
(2, 1, 'Standard', 0, '2025-03-23 15:45:18', '2023-11-06 10:58:03'),
(3, 1, 'Cosmetics', 1, '2025-03-23 16:45:01', '2025-03-23 15:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine_store`
--

CREATE TABLE `tbl_medicine_store` (
  `meds_id` int(11) NOT NULL,
  `meds_created_id` int(11) NOT NULL,
  `meds_bill_number` int(11) NOT NULL,
  `meds_agency` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `meds_mfg` varchar(50) DEFAULT NULL,
  `meds_unit` varchar(50) DEFAULT NULL,
  `meds_quantity` varchar(50) DEFAULT NULL,
  `meds_scheme` varchar(50) DEFAULT NULL,
  `meds_batch` varchar(50) DEFAULT NULL,
  `meds_expiry` varchar(50) DEFAULT NULL,
  `meds_mrp` varchar(50) DEFAULT NULL,
  `meds_rate` varchar(50) DEFAULT NULL,
  `meds_disc` varchar(50) DEFAULT NULL,
  `meds_hsn` varchar(50) DEFAULT NULL,
  `meds_gst_per` varchar(25) DEFAULT NULL,
  `meds_gst_value` varchar(50) DEFAULT NULL,
  `meds_net_value` varchar(50) DEFAULT NULL,
  `meds_per_cost` varchar(50) DEFAULT NULL,
  `meds_in_stock` int(11) NOT NULL DEFAULT 1,
  `meds_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `meds_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_med_agency`
--

CREATE TABLE `tbl_med_agency` (
  `agency_id` int(11) NOT NULL,
  `agency_name` varchar(100) NOT NULL,
  `agency_status` int(11) NOT NULL DEFAULT 1,
  `agency_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `agency_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_med_agency`
--

INSERT INTO `tbl_med_agency` (`agency_id`, `agency_name`, `agency_status`, `agency_updated_on`, `agency_created_on`) VALUES
(1, 'Sunrise Agencies', 1, '2024-06-12 15:10:06', '2024-06-12 15:02:00'),
(2, 'Raunak Pharma', 1, '2024-06-12 15:10:30', '2024-06-12 15:10:30'),
(3, 'Suyash Pharma Distributors', 1, '2024-06-12 15:10:48', '2024-06-12 15:10:48'),
(4, 'Faizal Enterprises', 1, '2025-04-02 12:06:31', '2025-04-02 12:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_appointment`
--

CREATE TABLE `tbl_patient_appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_patient_id` int(11) NOT NULL,
  `appointment_date_time` varchar(50) DEFAULT NULL,
  `appointment_book_user_id` int(11) NOT NULL,
  `appointment_doctor_id` int(11) NOT NULL,
  `appointment_description` text DEFAULT NULL,
  `appointment_treatment` varchar(100) DEFAULT NULL,
  `appointment_remark` text DEFAULT NULL,
  `appointment_location_id` int(11) NOT NULL DEFAULT 1,
  `appointment_status` varchar(25) DEFAULT NULL,
  `appointment_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `appointment_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patient_appointment`
--

INSERT INTO `tbl_patient_appointment` (`appointment_id`, `appointment_patient_id`, `appointment_date_time`, `appointment_book_user_id`, `appointment_doctor_id`, `appointment_description`, `appointment_treatment`, `appointment_remark`, `appointment_location_id`, `appointment_status`, `appointment_updated_on`, `appointment_created_on`) VALUES
(1, 12, '2023-11-01 19:15:00', 1, 2, 'abcc detnt', NULL, 'abbbbbbb', 1, 'Confirmed', '2023-11-01 12:58:09', '2023-11-01 12:42:00'),
(2, 12, '2023-11-02 12:30:00', 1, 2, 'Dentcheck', NULL, '', 1, 'Confirmed', '2023-11-02 06:48:58', '2023-11-01 12:58:28'),
(3, 12, '2023-11-03 10:20:00', 1, 2, 'abc', NULL, '', 1, 'Confirmed', '2023-11-02 06:49:58', '2023-11-02 06:49:58'),
(4, 12, '2023-11-03 11:00:00', 1, 2, '', NULL, '', 1, 'Confirmed', '2023-11-03 12:11:17', '2023-11-03 12:11:17'),
(5, 12, '2024-06-11 13:00:00', 1, 2, 'abc', '5', 'abc', 1, 'Confirmed', '2024-06-11 07:51:33', '2024-06-11 07:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_document`
--

CREATE TABLE `tbl_patient_document` (
  `document_id` int(11) NOT NULL,
  `document_upload_user_id` int(11) NOT NULL,
  `document_patient_id` int(11) NOT NULL,
  `document_name` varchar(50) DEFAULT NULL,
  `document_path` varchar(255) NOT NULL,
  `document_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `document_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patient_document`
--

INSERT INTO `tbl_patient_document` (`document_id`, `document_upload_user_id`, `document_patient_id`, `document_name`, `document_path`, `document_updated_on`, `document_created_on`) VALUES
(3, 1, 12, 'Blood sample report', 'uploads/document/document_path_202311091699513830709118.jpeg', '2023-11-09 07:10:30', '2023-11-09 07:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_option`
--

CREATE TABLE `tbl_payment_option` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `option_status` int(1) NOT NULL DEFAULT 1,
  `option_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_option`
--

INSERT INTO `tbl_payment_option` (`option_id`, `option_name`, `option_status`, `option_created_on`) VALUES
(1, 'Online', 0, '2024-06-11 13:37:16'),
(2, 'Cash', 1, '2023-01-09 10:46:40'),
(3, 'UPI (Google Pay, PhonePe, PayTM, etc.)', 1, '2023-01-30 08:15:00'),
(4, 'Cheque', 1, '2023-01-09 10:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription`
--

CREATE TABLE `tbl_prescription` (
  `pre_id` int(11) NOT NULL,
  `pre_doctor_id` int(11) NOT NULL,
  `pre_patient_id` int(11) NOT NULL,
  `pre_details` text DEFAULT NULL,
  `pre_details_in_detail` text DEFAULT NULL,
  `pre_lab_test` text DEFAULT NULL,
  `pre_advice` text DEFAULT NULL,
  `pre_status` int(11) NOT NULL DEFAULT 1,
  `pre_location_id` int(11) DEFAULT NULL,
  `pre_created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_prescription`
--

INSERT INTO `tbl_prescription` (`pre_id`, `pre_doctor_id`, `pre_patient_id`, `pre_details`, `pre_details_in_detail`, `pre_lab_test`, `pre_advice`, `pre_status`, `pre_location_id`, `pre_created_on`) VALUES
(3, 1, 12, '[\"Dolo 650\",\"Diclogen\"]', '{\"pre_patient_id\":\"12\",\"pre_id\":\"\",\"pre_details\":[\"Dolo 650\",\"Diclogen\"],\"medicine_tab\":[\"Dolo 650\",\"Diclogen\"],\"medicine_weight\":[\"100mg\",\"100mg\"],\"medicine_timings\":[\"1+0+1\",\"1+0+1\"],\"medicine_day_course\":[\"5 Days\",\"2 Days\"],\"medicine_tab_after_before\":[\"After Food\",\"before food\"],\"pre_advice\":\"abc\",\"btn_add_prescription\":\"\"}', 'null', 'abc', 1, 1, '2023-11-16 09:05:53'),
(4, 1, 12, '[\"Dolo 650\",\"Diclogen\"]', '{\"pre_patient_id\":\"12\",\"pre_id\":\"\",\"pre_details\":[\"Dolo 650\",\"Diclogen\"],\"medicine_tab\":[\"Dolo 650\",\"Diclogen\"],\"medicine_weight\":[\"100mg\",\"100mg\"],\"medicine_timings\":[\"1+0+1\",\"1+0+1\"],\"medicine_day_course\":[\"5 Days\",\"5 Days\"],\"medicine_tab_after_before\":[\"After Food\",\"After Food\"],\"pre_lab_test\":[\"Urine \",\"Blood\"],\"pre_advice\":\"aabc\",\"btn_add_prescription\":\"\"}', '[\"Urine \",\"Blood\"]', 'aabc', 1, 1, '2024-06-05 03:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_location`
--

CREATE TABLE `tbl_project_location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `location_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_project_location`
--

INSERT INTO `tbl_project_location` (`location_id`, `location_name`, `location_status`) VALUES
(1, 'Kalyan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_bill_number` varchar(50) DEFAULT NULL,
  `stock_agency_id` int(11) NOT NULL,
  `stock_category_id` int(11) NOT NULL,
  `stock_product_name` varchar(255) NOT NULL,
  `stock_unit` float DEFAULT NULL,
  `stock_uom` varchar(50) DEFAULT NULL,
  `stock_qty` float NOT NULL,
  `stock_sch` float NOT NULL,
  `stock_total_qty` float NOT NULL,
  `stock_total_qty_sale` float NOT NULL,
  `stock_batch` varchar(50) NOT NULL,
  `stock_expiry_date` varchar(25) DEFAULT NULL,
  `stock_mrp` float NOT NULL,
  `stock_rate` float NOT NULL,
  `stock_discount_percent` float NOT NULL,
  `stock_gst` float NOT NULL,
  `is_stock_out` int(11) NOT NULL,
  `stock_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_bill_number`, `stock_agency_id`, `stock_category_id`, `stock_product_name`, `stock_unit`, `stock_uom`, `stock_qty`, `stock_sch`, `stock_total_qty`, `stock_total_qty_sale`, `stock_batch`, `stock_expiry_date`, `stock_mrp`, `stock_rate`, `stock_discount_percent`, `stock_gst`, `is_stock_out`, `stock_updated_on`, `stock_created_on`) VALUES
(1, 'RA/12182', 2, 1, 'STMOL 125 SYP', 60, NULL, 3, 0, 3, 3, 'ML24074', NULL, 25, 13, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:01:56'),
(2, 'RA/12182', 2, 1, 'ALKACITRAL SYP', 100, NULL, 3, 0, 3, 3, 'SPA243035', NULL, 148, 26, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:24:01'),
(3, 'RA/12182', 2, 1, 'HIPRESS 50', 10, 'TAB', 5, 0, 5, 3.05, '4BA1096', '2025-08-16', 31.04, 12, 0, 12, 0, '2025-04-04 15:26:11', '2025-03-23 16:26:26'),
(4, 'RA/12182', 2, 1, 'OLOX 200', 10, NULL, 5, 0, 5, 5, 'STC240086', NULL, 80.53, 17, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:27:36'),
(5, 'RA/12182', 2, 1, 'Dr. ORTHO OIL', 60, NULL, 2, 0, 2, 2, '-', NULL, 158, 125.86, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:28:32'),
(6, 'RA/12182', 2, 1, 'CANDID POWDER', 120, NULL, 2, 0, 2, 2, '71230432', NULL, 159, 113.57, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:31:34'),
(7, 'RA/12182', 2, 1, 'CANDID POWDER ', 60, NULL, 3, 0, 3, 3, '71240229', NULL, 104, 74.29, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:32:46'),
(8, 'RA/12182', 2, 1, 'ORSL APPPLE', 200, NULL, 25, 5, 30, 30, 'SK50007', NULL, 42, 30, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:34:00'),
(9, 'RA/12182', 2, 1, 'ORSL PLUS ORANAGE', 200, NULL, 10, 2, 12, 12, 'SK40413', NULL, 45, 32.14, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:35:54'),
(10, 'RA/12182', 2, 1, 'ORSL PLUS ORANAGE', 200, NULL, 15, 3, 18, 18, 'SK50004', NULL, 45, 32.14, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:36:39'),
(11, 'RA/12182', 2, 1, 'ASIKLOPAR SP', 10, NULL, 5, 0, 5, 5, 'APLT-2097', NULL, 176, 15, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 16:37:47'),
(12, 'SA3222', 1, 1, 'SMILOGEL', 10, NULL, 10, 0, 10, 10, 'A25635S', NULL, 35.25, 15.6, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 17:14:18'),
(13, '8615', 4, 3, 'NISHA BLACK', 0, NULL, 10, 0, 10, 10, '', NULL, 15, 8.5, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:22:11'),
(14, '8615', 4, 3, 'GILLETTE GUARD ', 0, NULL, 10, 0, 10, 10, '', NULL, 25, 20, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:29:11'),
(15, '8615', 4, 3, 'COLGATE ZIG ZAG', 0, NULL, 9, 0, 9, 9, '', NULL, 30, 24, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:35:32'),
(16, '8615', 4, 3, 'GOOD NIGHT COMBI PACK', 0, NULL, 2, 0, 2, 2, '', NULL, 105, 94, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:36:08'),
(17, '8615', 4, 3, 'NICIL GERM 50G', 0, NULL, 6, 0, 6, 6, '', NULL, 50, 43, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:36:41'),
(18, '8615', 4, 3, 'COMFORT', 0, NULL, 12, 0, 12, 12, '', NULL, 16, 7.5, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:37:43'),
(19, '8615', 4, 3, 'HIMALAYA LIP BALM', 0, NULL, 12, 0, 12, 12, '', NULL, 40, 33, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:38:20'),
(20, '8615', 4, 3, 'SENSODYNE GEL', 0, NULL, 3, 0, 3, 3, '', NULL, 95, 85, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:38:40'),
(21, '8615', 4, 3, 'WHISPER CHOICE ULTRA', 0, NULL, 12, 0, 12, 12, '', NULL, 50, 41, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:39:02'),
(22, '8615', 4, 3, 'PAMPERS SMALL', 0, NULL, 5, 0, 5, 5, '', NULL, 99, 82, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:39:37'),
(23, '8615', 4, 3, 'PAMPERS SMALL', 0, NULL, 14, 0, 14, 14, '', NULL, 25, 21, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:40:12'),
(24, '8615', 4, 3, 'PAMPERS M', 0, NULL, 7, 0, 7, 7, '', NULL, 13, 11, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:40:44'),
(25, '8615', 4, 3, 'PAMPERS L', 0, NULL, 8, 0, 8, 8, '', NULL, 30, 25, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:41:18'),
(26, '8615', 4, 3, 'PAMPERS XL', 0, NULL, 8, 0, 8, 8, '', NULL, 36, 30, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:41:54'),
(27, '8615', 4, 3, 'MAMYPOKO PANTS L', 0, NULL, 3, 0, 3, 3, '', NULL, 56, 46, 0, 0, 0, '2025-04-04 07:16:39', '2025-03-23 17:42:14'),
(28, '8615', 4, 3, 'MAMYPOKO PANTS XL', 0, NULL, 2, 0, 2, 2, '', NULL, 75, 60, 0, 12, 0, '2025-04-04 07:16:39', '2025-03-23 17:42:38'),
(29, 'SA1', 1, 1, 'MULTANI MITTI (JIN)', 50, NULL, 2, 1, 3, 3, 'RV106', '2027-11-25', 35, 26.67, 3, 5, 0, '2025-04-04 07:16:39', '2025-04-02 12:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_treatment`
--

CREATE TABLE `tbl_treatment` (
  `ttm_id` int(11) NOT NULL,
  `ttm_user_id` int(11) NOT NULL,
  `ttm_treatment_details` text DEFAULT NULL,
  `ttm_payment_details` text DEFAULT NULL,
  `ttm_fees` int(11) NOT NULL,
  `ttm_started_from` varchar(50) DEFAULT NULL,
  `ttm_status` int(11) NOT NULL,
  `ttm_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ttm_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_treatment`
--

INSERT INTO `tbl_treatment` (`ttm_id`, `ttm_user_id`, `ttm_treatment_details`, `ttm_payment_details`, `ttm_fees`, `ttm_started_from`, `ttm_status`, `ttm_updated_on`, `ttm_created_on`) VALUES
(7, 12, '[{\"teeth_treatment\":\"[\\\"5\\\",\\\"6\\\"]\",\"ttm_treatment\":\"1\",\"ttmad_name\":\"Cleaning\",\"ttmad_fees\":\"500\",\"ttmad_total_fees\":1000},{\"teeth_treatment\":\"[\\\"5\\\"]\",\"ttm_treatment\":\"2\",\"ttmad_name\":\"Polish\",\"ttmad_fees\":\"200\",\"ttmad_total_fees\":200}]', '{\"ttm_treatment\":\"\",\"total_amount\":\"1200\",\"discount_amount\":\"300\",\"net_amount\":\"900\",\"ttm_status\":\"0\",\"btn_add_tretment\":\"\"}', 900, NULL, 0, '2024-06-12 05:56:16', '2024-06-11 11:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_treatment_adviced`
--

CREATE TABLE `tbl_treatment_adviced` (
  `ttmad_id` int(11) NOT NULL,
  `ttmad_name` varchar(100) NOT NULL,
  `ttmad_fees` int(11) NOT NULL,
  `ttmad_status` int(11) NOT NULL,
  `ttmad_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ttmad_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_treatment_adviced`
--

INSERT INTO `tbl_treatment_adviced` (`ttmad_id`, `ttmad_name`, `ttmad_fees`, `ttmad_status`, `ttmad_updated_on`, `ttmad_created_on`) VALUES
(1, 'Cleaning', 500, 1, '2024-06-11 10:45:22', '2024-06-11 10:03:47'),
(2, 'Polish', 200, 1, '2024-06-11 10:45:24', '2024-06-11 10:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_treatment_payment`
--

CREATE TABLE `tbl_treatment_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_user_id` int(11) NOT NULL,
  `payment_ttm_id` int(11) NOT NULL,
  `payment_fees` int(11) NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `payment_paid_via` text NOT NULL,
  `payment_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_treatment_payment`
--

INSERT INTO `tbl_treatment_payment` (`payment_id`, `payment_user_id`, `payment_ttm_id`, `payment_fees`, `payment_mode`, `payment_paid_via`, `payment_updated_on`, `payment_created_on`) VALUES
(1, 12, 1, 400, 0, 'UPI Phone pe', '2024-06-11 04:26:38', '2024-06-11 04:16:56'),
(2, 12, 1, 1200, 0, 'google pay\r\n', '2024-06-11 04:26:52', '2024-06-11 04:21:01'),
(3, 12, 5, 500, 0, 'Pay UPI phone pe', '2024-06-11 04:30:55', '2024-06-11 04:30:55'),
(4, 12, 7, 200, 2, '', '2024-06-11 13:38:57', '2024-06-11 13:27:26'),
(5, 12, 7, 700, 2, 'TRANIDN 345345345', '2024-06-12 05:56:51', '2024-06-11 13:31:14'),
(6, 12, 7, 50, 2, '', '2024-06-12 06:13:27', '2024-06-12 06:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_employee_type` int(11) DEFAULT NULL,
  `employee_type` int(11) DEFAULT 0 COMMENT '0 Temperary\r\n1 permanant',
  `user_first_name` varchar(25) DEFAULT NULL,
  `user_last_name` varchar(25) DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT 1,
  `user_birth_date` varchar(25) DEFAULT NULL,
  `user_blood_group` varchar(10) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_profile` text DEFAULT NULL,
  `user_email_id` varchar(30) NOT NULL,
  `user_phone_number` varchar(15) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `project_location_id` int(11) DEFAULT NULL,
  `user_otp` varchar(10) DEFAULT NULL,
  `user_otp_tried` int(11) DEFAULT 0,
  `user_token` text DEFAULT NULL,
  `firebase_user_token` varchar(255) DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT 1,
  `user_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_employee_type`, `employee_type`, `user_first_name`, `user_last_name`, `gender`, `user_birth_date`, `user_blood_group`, `user_address`, `user_profile`, `user_email_id`, `user_phone_number`, `user_password`, `project_location_id`, `user_otp`, `user_otp_tried`, `user_token`, `firebase_user_token`, `user_status`, `user_updated_on`, `user_created_on`) VALUES
(1, 1, 0, 'Admin Tushar', 'Aher', 1, NULL, NULL, '704, Gurunath Tower,\r\nGuravali road, Titwala East', 'Admin', 'tushar.techrnl@gmail.com', '9999900000', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 0, 'asdfsdd', NULL, 1, '2024-06-12 12:36:57', '2022-02-22 06:34:17'),
(2, 5, 0, 'Suvarna', 'Aher', 1, NULL, NULL, '704, Gurunath Tower,\r\nGuravali road, Titwala East', '', 'tushar.techrnl@gmail.com', '9702734925', 'e10adc3949ba59abbe56e057f20f883e', 1, '4283', 0, NULL, NULL, 1, '2024-06-12 12:37:53', '2022-02-22 08:37:58'),
(11, 2, 0, 'Dr. Patil', '', 1, NULL, NULL, 'Tharwani', '', 'tushar.techrnl@gmail.com', '7498981502', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 0, NULL, NULL, 1, '2024-06-12 12:38:58', '2023-11-01 08:56:49'),
(13, 3, 0, 'Tushar', 'Borhade', 1, '', 'B+', '704, Gurunath Tower,\r\nGuravali road, Titwala East', NULL, 'tushar.techrnl@gmail.com', '8652316581', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 0, NULL, NULL, 1, '2025-04-03 14:49:57', '2024-06-12 12:41:14'),
(14, 3, 0, 'Tushar', 'Aher', 1, '1990-11-17', 'B+', '704, Gurunath Tower,\r\nGuravali road, Titwala East', NULL, 'tushar.abc@gmail.com', '9657267261', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 0, NULL, NULL, 1, '2025-03-25 14:16:07', '2025-03-25 14:16:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_blood_group`
--
ALTER TABLE `tbl_blood_group`
  ADD PRIMARY KEY (`blood_group_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_customer_bill`
--
ALTER TABLE `tbl_customer_bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `tbl_detal_numbering`
--
ALTER TABLE `tbl_detal_numbering`
  ADD PRIMARY KEY (`dental_id`);

--
-- Indexes for table `tbl_employee_type`
--
ALTER TABLE `tbl_employee_type`
  ADD PRIMARY KEY (`emp_type_id`);

--
-- Indexes for table `tbl_lab_test`
--
ALTER TABLE `tbl_lab_test`
  ADD PRIMARY KEY (`lab_test_id`);

--
-- Indexes for table `tbl_medicine`
--
ALTER TABLE `tbl_medicine`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `tbl_medicine_category`
--
ALTER TABLE `tbl_medicine_category`
  ADD PRIMARY KEY (`med_cat_id`);

--
-- Indexes for table `tbl_medicine_store`
--
ALTER TABLE `tbl_medicine_store`
  ADD PRIMARY KEY (`meds_id`);

--
-- Indexes for table `tbl_med_agency`
--
ALTER TABLE `tbl_med_agency`
  ADD PRIMARY KEY (`agency_id`);

--
-- Indexes for table `tbl_patient_appointment`
--
ALTER TABLE `tbl_patient_appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `tbl_patient_document`
--
ALTER TABLE `tbl_patient_document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `tbl_payment_option`
--
ALTER TABLE `tbl_payment_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD PRIMARY KEY (`pre_id`);

--
-- Indexes for table `tbl_project_location`
--
ALTER TABLE `tbl_project_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_treatment`
--
ALTER TABLE `tbl_treatment`
  ADD PRIMARY KEY (`ttm_id`);

--
-- Indexes for table `tbl_treatment_adviced`
--
ALTER TABLE `tbl_treatment_adviced`
  ADD PRIMARY KEY (`ttmad_id`);

--
-- Indexes for table `tbl_treatment_payment`
--
ALTER TABLE `tbl_treatment_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_blood_group`
--
ALTER TABLE `tbl_blood_group`
  MODIFY `blood_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_customer_bill`
--
ALTER TABLE `tbl_customer_bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_detal_numbering`
--
ALTER TABLE `tbl_detal_numbering`
  MODIFY `dental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_employee_type`
--
ALTER TABLE `tbl_employee_type`
  MODIFY `emp_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_lab_test`
--
ALTER TABLE `tbl_lab_test`
  MODIFY `lab_test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_medicine`
--
ALTER TABLE `tbl_medicine`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_medicine_category`
--
ALTER TABLE `tbl_medicine_category`
  MODIFY `med_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_medicine_store`
--
ALTER TABLE `tbl_medicine_store`
  MODIFY `meds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_med_agency`
--
ALTER TABLE `tbl_med_agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_patient_appointment`
--
ALTER TABLE `tbl_patient_appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_patient_document`
--
ALTER TABLE `tbl_patient_document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_project_location`
--
ALTER TABLE `tbl_project_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_treatment`
--
ALTER TABLE `tbl_treatment`
  MODIFY `ttm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_treatment_adviced`
--
ALTER TABLE `tbl_treatment_adviced`
  MODIFY `ttmad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_treatment_payment`
--
ALTER TABLE `tbl_treatment_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
