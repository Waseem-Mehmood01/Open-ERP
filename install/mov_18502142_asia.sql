-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql106.move.pk
-- Generation Time: Aug 02, 2016 at 02:44 AM
-- Server version: 5.6.30-76.3
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mov_18502142_asia`
--

-- --------------------------------------------------------

--
-- Table structure for table `sa_companies`
--

CREATE TABLE IF NOT EXISTS `sa_companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_db_prefix` varchar(6) NOT NULL,
  `company_address_1` varchar(255) DEFAULT NULL,
  `company_address_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `phone_1` varchar(255) DEFAULT NULL,
  `phone_2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `company_time_zone` varchar(255) DEFAULT 'GMT',
  `coa_levels` int(2) DEFAULT '4',
  `coa_level_1_label` varchar(255) DEFAULT 'company',
  `coa_level_1_length` int(1) DEFAULT '1',
  `coa_level_2_label` varchar(255) DEFAULT 'Main',
  `coa_level_2_length` int(1) DEFAULT '2',
  `coa)level_3_label` varchar(255) DEFAULT 'control',
  `coa_level_3_length` int(1) DEFAULT '2',
  `coa_level_4_label` varchar(255) DEFAULT 'sub-control',
  `coa_level_4_length` int(1) DEFAULT '2',
  `coa_level_5_label` varchar(255) DEFAULT 'Activity',
  `coa_level_5_length` int(1) DEFAULT '5',
  `coa_level_6_label` varchar(255) DEFAULT NULL,
  `coa_level_6_length` int(1) DEFAULT '5',
  `coa_level_7_label` varchar(255) DEFAULT NULL,
  `coa_level_7_length` int(1) DEFAULT '5',
  `coa_level_8_label` varchar(255) DEFAULT NULL,
  `coa_level_8_length` int(1) DEFAULT '5',
  `coa_level_9_label` varchar(255) DEFAULT NULL,
  `coa_level_9_length` int(1) DEFAULT '5',
  `company_logo_home` varchar(255) DEFAULT NULL,
  `company_logo_head` varchar(255) DEFAULT NULL,
  `company_logo_icon` varchar(255) DEFAULT NULL,
  `super_admin_user` varchar(255) DEFAULT NULL,
  `super_admin_password` varchar(255) DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_status` varchar(100) DEFAULT 'active',
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sa_companies`
--

INSERT INTO `sa_companies` (`company_id`, `company_name`, `company_db_prefix`, `company_address_1`, `company_address_2`, `city`, `country`, `currency`, `phone_1`, `phone_2`, `email`, `website`, `industry`, `company_time_zone`, `coa_levels`, `coa_level_1_label`, `coa_level_1_length`, `coa_level_2_label`, `coa_level_2_length`, `coa)level_3_label`, `coa_level_3_length`, `coa_level_4_label`, `coa_level_4_length`, `coa_level_5_label`, `coa_level_5_length`, `coa_level_6_label`, `coa_level_6_length`, `coa_level_7_label`, `coa_level_7_length`, `coa_level_8_label`, `coa_level_8_length`, `coa_level_9_label`, `coa_level_9_length`, `company_logo_home`, `company_logo_head`, `company_logo_icon`, `super_admin_user`, `super_admin_password`, `last_modified_by`, `last_modified_on`, `created_by`, `created_on`, `company_status`) VALUES
(1, 'Ø§ÛŒØ´ÛŒØ§Ø¡ Ù¹Ø±ÛŒÚˆØ±Ø²', 'test_', 'Ù¾Ø±Ø§Ù†ÛŒ ØºÙ„Ø§Ø¡ Ù…Ù†ÚˆÛŒ', 'Ø§ÙˆÚ©Ø§Ú‘Û', 'Ø§ÙˆÚ©Ø§Ú‘Û', 'Pakistan', 'PKR', '123456', '+92-321-5551086', 'waseem.mehmood01@gmail.com', 'http://asiatraders.move.pk', 'Sales', 'GMT', 5, 'company', 1, 'Main', 2, 'control', 2, 'sub-control', 4, 'Activity', 5, NULL, 0, NULL, 0, NULL, 0, NULL, 0, 'http://www.sky-valley-web-design.ca/images/250x400.gif', 'http://www.sky-valley-web-design.ca/images/250x150.gif', 'http://www.sky-valley-web-design.ca/images/100x100.gif', 'admin', 'admin', 'admin', '2016-05-28 00:41:07', 'system', '2016-05-28 04:41:07', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sa_sys_config`
--

CREATE TABLE IF NOT EXISTS `sa_sys_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `key_label` varchar(255) DEFAULT NULL,
  `key_help_text` varchar(255) DEFAULT NULL,
  `value` varchar(255) NOT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sa_sys_config`
--

INSERT INTO `sa_sys_config` (`config_id`, `key`, `key_label`, `key_help_text`, `value`, `last_modified_by`, `last_modified_on`, `created_by`, `created_on`) VALUES
(1, 'super_user_id', NULL, NULL, 'mansoor', 'system', '2015-03-23 19:16:39', 'system', '2015-03-23 23:17:28'),
(2, 'super_user_pass', NULL, NULL, 'pakistan', 'system', '2015-03-23 19:16:39', 'system', '2015-03-23 23:17:29'),
(3, 'default_company_id', NULL, NULL, '1', 'system', '2015-03-23 19:16:39', 'system', '2015-03-23 23:16:46'),
(4, 'default_company_db_prefix', NULL, NULL, 'test', 'system', '2015-03-23 19:16:39', 'system', '2015-03-23 23:17:34'),
(5, 'default_time_zone', NULL, NULL, 'GMT', 'system', '2015-03-23 19:16:39', 'system', '2015-03-31 22:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_app_management`
--

CREATE TABLE IF NOT EXISTS `sa_test_app_management` (
  `app_management_id` int(11) NOT NULL AUTO_INCREMENT,
  `module` enum('Purchase','Sales') NOT NULL,
  `debit_account` int(11) NOT NULL,
  `credit_account` int(11) NOT NULL,
  `last_modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified_by` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`app_management_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sa_test_app_management`
--

INSERT INTO `sa_test_app_management` (`app_management_id`, `module`, `debit_account`, `credit_account`, `last_modified_on`, `last_modified_by`, `active`) VALUES
(1, 'Sales', 34, 38, '2016-07-13 15:22:39', NULL, 1),
(2, 'Purchase', 40, 39, '2016-07-13 15:23:15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_coa`
--

CREATE TABLE IF NOT EXISTS `sa_test_coa` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` varchar(255) DEFAULT NULL,
  `account_group` int(11) DEFAULT NULL,
  `account_desc_short` varchar(255) DEFAULT NULL,
  `account_desc_long` varchar(255) DEFAULT NULL,
  `activity_account` tinyint(1) DEFAULT '0',
  `consolidate_only` tinyint(1) DEFAULT '1',
  `has_parent` tinyint(1) DEFAULT '0',
  `coa_level` tinyint(1) DEFAULT '1',
  `has_children` tinyint(1) DEFAULT '0',
  `parent_account_id` int(11) DEFAULT '0',
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `account_status` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `sa_test_coa`
--

INSERT INTO `sa_test_coa` (`account_id`, `account_code`, `account_group`, `account_desc_short`, `account_desc_long`, `activity_account`, `consolidate_only`, `has_parent`, `coa_level`, `has_children`, `parent_account_id`, `last_modified_by`, `last_modified_on`, `created_by`, `created_on`, `account_status`) VALUES
(33, '1001', 10, 'Cash', 'account balance', 1, 0, 0, 1, 0, 0, 'test', '1970-01-01 00:00:00', 'test', '0000-00-00 00:00:00', 'Active'),
(34, '1002', 10, 'Account recievable', 'Amount owned', 1, 0, 0, 1, 0, 0, 'test', '1970-01-01 00:00:00', 'test', '0000-00-00 00:00:00', 'Active'),
(35, '2001', 11, 'Cash payable', 'amount payable', 1, 0, 0, 1, 0, 0, 'test', '1970-01-01 00:00:00', 'test', '0000-00-00 00:00:00', 'Active'),
(36, '3001', 12, 'Munshi Capital', 'Munshi has amount', 1, 0, 0, 1, 0, 0, 'test', '1970-01-01 00:00:00', 'test', '0000-00-00 00:00:00', 'Active'),
(38, '2002', 11, 'Cost of good sold', 'cost of good sold', 1, 0, 0, 1, 0, 0, 'test', '1970-01-01 00:00:00', 'test', '0000-00-00 00:00:00', 'Active'),
(39, '2003', 11, 'Expense', 'Other expenses of purchase', 1, 0, 0, 1, 0, 0, 'test', '1970-01-01 00:00:00', 'test', '0000-00-00 00:00:00', 'Active'),
(40, '5001', 14, 'Account payable', 'Account payable', 1, 0, 0, 1, 0, 0, 'test', '2016-07-20 11:15:24', 'test', '0000-00-00 00:00:00', 'Active'),
(44, '1016', 16, 'Sohail Mir & Sons', 'Mandi party 40 Ghala mandi', 1, 0, 0, 1, 0, 0, 'test', '1970-01-01 05:00:00', 'test', '1970-01-01 10:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_coa_groups`
--

CREATE TABLE IF NOT EXISTS `sa_test_coa_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_code` varchar(255) DEFAULT NULL,
  `group_description` varchar(255) DEFAULT NULL,
  `balance_sheet_group` tinyint(1) DEFAULT '1' COMMENT 'Is a Balance Sheet Account',
  `balance_sheet_side` varchar(255) DEFAULT 'Debit' COMMENT 'Debit or Credit',
  `pls_group` tinyint(1) DEFAULT '0' COMMENT 'Is a PLS account',
  `pls_side` varchar(255) DEFAULT 'Expenses' COMMENT 'Expenses or Income',
  `statistics_only` tinyint(1) DEFAULT '0' COMMENT 'NonFinancial Account for statistics only',
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `group_status` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `sa_test_coa_groups`
--

INSERT INTO `sa_test_coa_groups` (`group_id`, `group_code`, `group_description`, `balance_sheet_group`, `balance_sheet_side`, `pls_group`, `pls_side`, `statistics_only`, `last_modified_by`, `last_modified_on`, `created_by`, `created_on`, `group_status`) VALUES
(10, '1000', 'ASSETS', 1, 'debit', 0, '', 0, NULL, NULL, NULL, NULL, 'active'),
(11, '2000', 'LIABILITIES', 1, 'credit', 0, '', 0, NULL, NULL, NULL, NULL, 'active'),
(12, '3000', 'Owner''s Equity', 1, 'credit', 0, '', 0, NULL, NULL, NULL, NULL, 'active'),
(14, '5000', 'Account payable', 1, 'debit', 0, '', 0, NULL, NULL, NULL, NULL, 'active'),
(16, '4000', 'Customers', 1, '', 0, '', 0, NULL, NULL, NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_customers`
--

CREATE TABLE IF NOT EXISTS `sa_test_customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mob` varchar(25) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sa_test_customers`
--

INSERT INTO `sa_test_customers` (`customer_id`, `name`, `mob`, `phone`, `email`, `address`, `created_on`, `active`) VALUES
(3, 'Dawood Comission Shop', '03001234569', '02100000', 'dawood@abc.com', 'Lahore road, Multan', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_fiscal_years`
--

CREATE TABLE IF NOT EXISTS `sa_test_fiscal_years` (
  `fiscal_year_id` int(11) NOT NULL AUTO_INCREMENT,
  `fiscal_year_desc` varchar(255) DEFAULT NULL,
  `fiscal_year_start_date` date DEFAULT NULL,
  `fiscal_year_end_date` date DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `fy_status` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`fiscal_year_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sa_test_fiscal_years`
--

INSERT INTO `sa_test_fiscal_years` (`fiscal_year_id`, `fiscal_year_desc`, `fiscal_year_start_date`, `fiscal_year_end_date`, `last_modified_by`, `last_modified_on`, `created_by`, `created_on`, `fy_status`) VALUES
(1, 'FY2014-15', '2014-06-01', '2015-05-31', NULL, '2015-04-23 18:13:42', NULL, NULL, 'active'),
(2, 'FY2015', '2015-06-01', '2016-05-31', NULL, '2015-04-23 18:14:07', NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_general_journal`
--

CREATE TABLE IF NOT EXISTS `sa_test_general_journal` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_date` datetime DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `entry_description` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `debit` decimal(11,2) DEFAULT '0.00',
  `credit` decimal(11,2) DEFAULT '0.00',
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_journal_vouchers`
--

CREATE TABLE IF NOT EXISTS `sa_test_journal_vouchers` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_ref_no` varchar(255) NOT NULL,
  `voucher_date` datetime DEFAULT NULL,
  `voucher description` varchar(255) DEFAULT NULL,
  `debits_total` decimal(11,2) DEFAULT '0.00',
  `credits_total` decimal(11,2) DEFAULT '0.00',
  `voucher_tags` varchar(255) DEFAULT NULL,
  `has_attachment` tinyint(1) DEFAULT '0',
  `attachment_url` varchar(255) DEFAULT NULL,
  `voucher_approved_by` varchar(255) DEFAULT NULL,
  `voucher_approved_on` datetime DEFAULT NULL,
  `voucher_approval_comments` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `voucher_status` varchar(255) DEFAULT 'draft',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`voucher_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `sa_test_journal_vouchers`
--

INSERT INTO `sa_test_journal_vouchers` (`voucher_id`, `voucher_ref_no`, `voucher_date`, `voucher description`, `debits_total`, `credits_total`, `voucher_tags`, `has_attachment`, `attachment_url`, `voucher_approved_by`, `voucher_approved_on`, `voucher_approval_comments`, `created_by`, `created_on`, `last_modified_by`, `last_modified_on`, `voucher_status`, `active`) VALUES
(9, 'a463', '2016-07-07 00:00:00', '', '127800.00', '127800.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-07-12 14:01:26', NULL, '2016-07-12 18:01:28', 'draft', 1),
(11, '6469', '2016-07-13 12:09:21', 'Sale entry', '35700.00', '35700.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-07-13 12:09:21', NULL, '2016-07-13 16:09:23', 'draft', 1),
(12, 'ce01', '2016-07-13 12:16:42', 'Purchase entry', '11760.00', '11760.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-07-13 12:16:42', NULL, '2016-07-13 16:16:44', 'draft', 1),
(13, 'e5c0', '2016-07-16 10:10:50', 'Sale entry', '21600.00', '21600.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-07-16 10:10:50', NULL, '2016-07-16 14:10:53', 'draft', 1),
(14, 'f1be', '2016-07-19 08:27:16', 'Purchase entry', '27600.00', '27600.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-07-19 08:27:16', NULL, '2016-07-19 12:27:19', 'draft', 1),
(15, '94f0', '2016-07-19 08:40:20', 'Sale entry', '36000.00', '36000.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-07-19 08:40:20', NULL, '2016-07-19 12:40:22', 'draft', 1),
(17, '376b2', '2016-07-25 16:43:09', 'Sale entry', '193525.50', '0.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-07-25 16:43:09', NULL, '2016-07-25 11:45:19', 'draft', 1),
(18, 'b6878', '2016-08-28 00:00:00', 'Purchase entry', '0.00', '200250.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-08-01 11:59:32', NULL, '2016-08-01 07:01:56', 'draft', 1),
(19, '396d', '2016-08-31 00:00:00', 'erqerqweq', '200000.00', '200000.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2016-08-01 12:40:55', NULL, '2016-08-01 07:43:18', 'draft', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_journal_voucher_details`
--

CREATE TABLE IF NOT EXISTS `sa_test_journal_voucher_details` (
  `voucher_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_id` int(11) NOT NULL,
  `voucher_date` datetime DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `entry_description` varchar(255) DEFAULT NULL,
  `debit_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `credit_amount` decimal(11,2) DEFAULT '0.00',
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` timestamp NULL DEFAULT NULL,
  `voucher_detail_status` varchar(255) DEFAULT 'draft',
  PRIMARY KEY (`voucher_detail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `sa_test_journal_voucher_details`
--

INSERT INTO `sa_test_journal_voucher_details` (`voucher_detail_id`, `voucher_id`, `voucher_date`, `account_id`, `entry_description`, `debit_amount`, `credit_amount`, `created_by`, `created_on`, `last_modified_by`, `last_modified_on`, `voucher_detail_status`) VALUES
(7, 9, NULL, 33, '', '127800.00', '0.00', NULL, '2016-07-12 14:01:26', NULL, NULL, 'draft'),
(8, 9, NULL, 34, '', '0.00', '127800.00', NULL, '2016-07-12 14:01:26', NULL, NULL, 'draft'),
(9, 11, NULL, 34, 'Sale entry', '35700.00', '0.00', NULL, '2016-07-13 12:09:21', NULL, NULL, 'draft'),
(10, 11, NULL, 38, 'Sale entry', '0.00', '35700.00', NULL, '2016-07-13 12:09:21', NULL, NULL, 'draft'),
(11, 12, NULL, 40, 'Purchase entry', '11760.00', '0.00', NULL, '2016-07-13 12:16:42', NULL, NULL, 'draft'),
(12, 12, NULL, 39, 'Purchase entry', '0.00', '11760.00', NULL, '2016-07-13 12:16:42', NULL, NULL, 'draft'),
(13, 13, NULL, 34, 'Sale entry', '21600.00', '0.00', NULL, '2016-07-16 10:10:50', NULL, NULL, 'draft'),
(14, 13, NULL, 38, 'Sale entry', '0.00', '21600.00', NULL, '2016-07-16 10:10:50', NULL, NULL, 'draft'),
(15, 14, NULL, 34, 'Purchase entry', '27600.00', '0.00', NULL, '2016-07-19 08:27:16', NULL, NULL, 'draft'),
(16, 14, NULL, 38, 'Purchase entry', '0.00', '27600.00', NULL, '2016-07-19 08:27:16', NULL, NULL, 'draft'),
(17, 15, NULL, 34, 'Sale entry', '36000.00', '0.00', NULL, '2016-07-19 08:40:20', NULL, NULL, 'draft'),
(18, 15, NULL, 38, 'Sale entry', '0.00', '36000.00', NULL, '2016-07-19 08:40:20', NULL, NULL, 'draft'),
(20, 17, NULL, 44, 'Sale entry', '193525.50', '0.00', NULL, '2016-07-25 16:43:09', NULL, NULL, 'draft'),
(21, 18, NULL, 44, 'Purchase entry', '0.00', '200250.00', NULL, '2016-08-01 11:59:32', NULL, NULL, 'draft'),
(22, 19, NULL, 44, 'Payment Against purchase', '200000.00', '0.00', NULL, '2016-08-01 12:40:55', NULL, NULL, 'draft'),
(23, 19, NULL, 33, '', '0.00', '200000.00', NULL, '2016-08-01 12:40:55', NULL, NULL, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_module_category`
--

CREATE TABLE IF NOT EXISTS `sa_test_module_category` (
  `category_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `category_path` varchar(100) DEFAULT '',
  `category_class` varchar(100) DEFAULT '',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `sa_test_module_category`
--

INSERT INTO `sa_test_module_category` (`category_id`, `category_title`, `category_path`, `category_class`) VALUES
(1, 'SALES', '#', 'glyphicon glyphicon-gift'),
(2, 'PURCHASE', '#', 'glyphicon glyphicon-shopping-cart'),
(3, 'ACCOUNTS', '#', 'glyphicon glyphicon-briefcase'),
(4, 'REPORTS', '#', 'glyphicon glyphicon-stats');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_purchase`
--

CREATE TABLE IF NOT EXISTS `sa_test_purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) DEFAULT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `mill_name` varchar(100) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `mill_address` varbinary(255) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `payment_paid` tinyint(1) NOT NULL DEFAULT '1',
  `is_return` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  KEY `purchase_id` (`purchase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sa_test_purchase`
--

INSERT INTO `sa_test_purchase` (`purchase_id`, `ref_no`, `vehicle_no`, `mill_name`, `order_date`, `mill_address`, `total_amount`, `payment_paid`, `is_return`, `is_approved`, `created_on`, `active`) VALUES
(1, '34IU3', 'LDB1289', 'Ghulam Rasool', '2016-06-14', 'Faisalabad Pakistan ', 24150, 1, 1, 0, NULL, 1),
(4, 'a87d', 'LEA1232', 'Mandi', '2016-06-14', 'Multan road Lodhran', 12600, 1, 0, 0, '2016-07-20 21:28:01', 1),
(5, 'ce01', 'MLM787', 'Local Markeet', '2016-07-13', 'Lodhran village area', 11760, 1, 0, 0, NULL, 1),
(6, 'f1be', 'LES8983', 'Local Markeet', '2016-07-19', 'Lodhran village area', 27600, 1, 0, 1, '2016-07-19 12:27:16', 1),
(7, 'b6878', 'les 3199', 'Asia Traders', '2016-08-28', 'Okara Mandi', 200250, 0, 0, 1, '2016-08-01 15:59:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_purchase_detail`
--

CREATE TABLE IF NOT EXISTS `sa_test_purchase_detail` (
  `purchase_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `bags` int(11) DEFAULT NULL,
  `rate` float NOT NULL,
  `total_amount` float DEFAULT NULL,
  PRIMARY KEY (`purchase_detail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sa_test_purchase_detail`
--

INSERT INTO `sa_test_purchase_detail` (`purchase_detail_id`, `purchase_id`, `customer_name`, `weight`, `unit`, `bags`, `rate`, `total_amount`) VALUES
(1, 1, 'Ethehad', 23, 'Maunds', 23, 1050, 24150),
(4, 5, 'Khadim', 12, 'Maunds', 110, 980, 11760),
(5, 6, 'Bilal', 23, 'Maunds', 20, 1200, 27600),
(7, 4, 'Munshi Capital', 12, 'Maunds', 120, 1050, 12600),
(8, 4, '', 0, 'KG', 0, 0, 0),
(9, 7, 'Sohail Mir & Sons', 8900, 'KG', 100, 900, 200250);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_reporting_periods`
--

CREATE TABLE IF NOT EXISTS `sa_test_reporting_periods` (
  `reporting_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `fiscal_year_id` int(11) DEFAULT NULL,
  `reporting_period_desc` varchar(255) DEFAULT NULL,
  `reporting_period_start_date` date DEFAULT NULL,
  `reporting_period_end_date` date DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `rp_status` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`reporting_period_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sa_test_reporting_periods`
--

INSERT INTO `sa_test_reporting_periods` (`reporting_period_id`, `fiscal_year_id`, `reporting_period_desc`, `reporting_period_start_date`, `reporting_period_end_date`, `last_modified_by`, `last_modified_on`, `created_by`, `created_on`, `rp_status`) VALUES
(1, 1, 'Q1-2014-15', '2014-06-01', '2014-08-31', NULL, '2015-04-23 20:34:29', NULL, NULL, 'active'),
(2, 1, 'Q2-2014-15', '2014-09-01', '2014-12-31', NULL, '2015-04-23 20:36:24', NULL, NULL, 'active'),
(3, 1, 'Q3-2014-15', '2015-01-01', '2015-03-31', NULL, '2015-04-23 20:37:19', NULL, NULL, 'active'),
(4, 1, 'Q4-2014-15', '2015-04-01', '2015-06-30', NULL, '2015-04-25 08:59:34', NULL, NULL, 'active'),
(5, 2, NULL, NULL, '2015-08-31', NULL, '2015-04-25 09:02:14', NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_sale`
--

CREATE TABLE IF NOT EXISTS `sa_test_sale` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) DEFAULT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `mill_name` varchar(255) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `mill_address` varchar(255) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `payment_received` tinyint(1) NOT NULL DEFAULT '1',
  `is_return` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sale_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sa_test_sale`
--

INSERT INTO `sa_test_sale` (`sale_id`, `ref_no`, `vehicle_no`, `mill_name`, `order_date`, `mill_address`, `total_amount`, `payment_received`, `is_return`, `is_approved`, `created_on`, `active`) VALUES
(5, 'e318', 'LDB8768', 'Itefaq', '2016-06-20', 'Multan road Lodhran', 84650, 1, 0, 0, NULL, 1),
(8, '6469', 'LDB897', 'Kissan mill', '2016-07-13', 'Bwp road lodhran', 35700, 1, 0, 0, '2016-07-13 16:09:21', 1),
(9, 'e5c0', 'LES8983', 'lives co ltd', '2016-07-16', 'Bahawalpur pakistan', 21600, 1, 0, 0, '2016-07-16 14:10:50', 1),
(10, '94f0', 'LEA1232', 'Kissan mill', '2016-07-13', 'Multan road Lodhran', 36000, 1, 1, 1, '2016-07-19 12:40:20', 1),
(12, 'd705', 'LEA1232', 'Local Markeet', '2016-07-20', 'Lodhran village area', 264500, 1, 0, 1, '2016-07-20 20:41:32', 1),
(13, '376b2', 'MLM787', 'Local Markeet', '2016-07-25', 'Multan road Okara', 193525.5, 1, 0, 0, '2016-07-25 20:43:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_sale_detail`
--

CREATE TABLE IF NOT EXISTS `sa_test_sale_detail` (
  `sale_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `bags` int(11) DEFAULT NULL,
  `rate` float NOT NULL,
  `total_amount` float DEFAULT NULL,
  PRIMARY KEY (`sale_detail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `sa_test_sale_detail`
--

INSERT INTO `sa_test_sale_detail` (`sale_detail_id`, `sale_id`, `customer_name`, `weight`, `unit`, `bags`, `rate`, `total_amount`) VALUES
(10, 5, 'Ethehad', 34, 'KG', 45, 1100, 37400),
(11, 5, 'Bilal', 45, 'KG', 34, 1050, 47250),
(15, 8, 'Kamran', 34, 'Maunds', 34, 1050, 35700),
(16, 9, 'Owner Lives', 20, 'Maunds', 20, 1080, 21600),
(17, 10, 'Kamran', 30, 'Maunds', 20, 1200, 36000),
(21, 12, 'Meer comission shop', 230, 'Maunds', 20, 1150, 264500),
(23, 13, 'Sohail Mir & Sons', 7899, 'KG', 78, 980, 193525);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_transactions`
--

CREATE TABLE IF NOT EXISTS `sa_test_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `account_id` int(11) NOT NULL,
  `account_code` varchar(255) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `debit` double(11,2) NOT NULL DEFAULT '0.00',
  `credit` double(11,2) NOT NULL DEFAULT '0.00',
  `reference` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `appproved_by` varchar(255) DEFAULT NULL,
  `approved_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT 'CURRENT_TIMESTAMP',
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_users`
--

CREATE TABLE IF NOT EXISTS `sa_test_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(24) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `first_name` varchar(24) NOT NULL,
  `last_name` varchar(24) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `auth_code` varchar(30) DEFAULT NULL,
  `user_avatar_url` varchar(255) DEFAULT NULL,
  `user_nic` varchar(255) DEFAULT NULL,
  `user_title` varchar(255) DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `user_status` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sa_test_users`
--

INSERT INTO `sa_test_users` (`user_id`, `user_name`, `user_email`, `first_name`, `last_name`, `password`, `role_id`, `company_id`, `auth_code`, `user_avatar_url`, `user_nic`, `user_title`, `last_modified_by`, `last_modified_on`, `created_by`, `created_on`, `user_status`) VALUES
(4, 'test', 'waseem.mehmood01@gmail.com', 'waseem', 'mehmood', 'test', 1, 1, '7876j', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active'),
(9, 'admin', 'test@test.com', 'Test Admin', 'Test2', 'admin', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-07-20 16:06:04', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_user_modules`
--

CREATE TABLE IF NOT EXISTS `sa_test_user_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` mediumint(9) NOT NULL DEFAULT '0',
  `module_title` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `module_file` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `module_path` varchar(100) DEFAULT '',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

--
-- Dumping data for table `sa_test_user_modules`
--

INSERT INTO `sa_test_user_modules` (`module_id`, `category_id`, `module_title`, `module_file`, `module_path`) VALUES
(1, 1, 'New Sale Order', 'new_sale', 'modules/sales/'),
(2, 1, 'View All Sale Orders', 'view_sale', 'modules/sales/'),
(173, 1, 'Sales Return', 'return_sale', 'modules/sales/'),
(174, 2, 'New Purchase Order', 'new_purchase', 'modules/purchase/'),
(175, 2, 'View All Purchase Orders', 'view_purchase', 'modules/purchase/'),
(176, 2, 'Purchase Return', 'return_purchase', 'modules/purchase/'),
(177, 3, 'Accounting Heads', 'list_coa_groups', 'modules/gl/setup/coa_groups/'),
(178, 3, 'View Accounts', 'list_coa', 'modules/gl/setup/coa/'),
(179, 3, 'Journal Entry', 'add_journal_voucher', 'modules/gl/transactions/journal_vouchers/'),
(180, 4, 'Balance Sheet', 'balance_sheet', 'modules/reports/'),
(181, 4, 'Profit and Loss', 'profit_loss', 'modules/reports/'),
(182, 4, 'Trial Balance', 'trial_balance', 'modules/reports/'),
(183, 4, 'View Account Balance', 'view_account_balance', 'modules/reports/');

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_user_module_access`
--

CREATE TABLE IF NOT EXISTS `sa_test_user_module_access` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_test_user_module_access`
--

INSERT INTO `sa_test_user_module_access` (`user_id`, `module_id`) VALUES
(4, 182),
(4, 181),
(4, 180),
(4, 179),
(4, 178),
(4, 177),
(4, 176),
(4, 175),
(4, 174),
(4, 173),
(4, 2),
(4, 1),
(9, 1),
(9, 174),
(4, 183);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_voucher_expense`
--

CREATE TABLE IF NOT EXISTS `sa_test_voucher_expense` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_ref_no` varchar(255) DEFAULT NULL,
  `voucher_date` datetime DEFAULT NULL,
  `voucher description` varchar(255) DEFAULT NULL,
  `paid_from_account` int(11) DEFAULT NULL,
  `voucher_total` decimal(11,2) DEFAULT '0.00',
  `voucher_tags` varchar(255) DEFAULT NULL,
  `has_attachment` tinyint(1) DEFAULT '0',
  `voucher_attachment_url` varchar(255) DEFAULT NULL,
  `voucher_approved_by` varchar(255) DEFAULT NULL,
  `voucher_approved_on` datetime DEFAULT NULL,
  `voucher_approval_comments` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` datetime DEFAULT NULL,
  `voucher_status` varchar(255) DEFAULT 'draft',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`voucher_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sa_test_voucher_expense`
--

INSERT INTO `sa_test_voucher_expense` (`voucher_id`, `voucher_ref_no`, `voucher_date`, `voucher description`, `paid_from_account`, `voucher_total`, `voucher_tags`, `has_attachment`, `voucher_attachment_url`, `voucher_approved_by`, `voucher_approved_on`, `voucher_approval_comments`, `created_by`, `created_on`, `last_modified_by`, `last_modified_on`, `voucher_status`, `active`) VALUES
(11, NULL, '2016-07-13 19:01:32', 'Split AC', 10, '30000.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sa_test_voucher_expense_detail`
--

CREATE TABLE IF NOT EXISTS `sa_test_voucher_expense_detail` (
  `voucher_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_id` int(11) NOT NULL,
  `expense_date` datetime DEFAULT NULL,
  `expense_account_id` int(11) NOT NULL,
  `expense_description` varchar(255) DEFAULT NULL,
  `expense_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `last_modified_by` varchar(255) DEFAULT NULL,
  `last_modified_on` timestamp NULL DEFAULT NULL,
  `voucher_detail_status` varchar(255) DEFAULT 'draft',
  PRIMARY KEY (`voucher_detail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sa_test_voucher_expense_detail`
--

INSERT INTO `sa_test_voucher_expense_detail` (`voucher_detail_id`, `voucher_id`, `expense_date`, `expense_account_id`, `expense_description`, `expense_amount`, `created_by`, `created_on`, `last_modified_by`, `last_modified_on`, `voucher_detail_status`) VALUES
(2, 11, '2016-07-13 19:02:05', 10, 'Split AC', '30000.00', NULL, '0000-00-00 00:00:00', NULL, NULL, 'draft');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
