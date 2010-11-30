-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2010 at 04:50 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scryptic`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `created_at`, `deleted_at`, `updated_at`, `status`) VALUES
(1, NULL, NULL, '2010-09-28 09:06:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `activation_code`
--

CREATE TABLE IF NOT EXISTS `activation_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activation_code_FI_1` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `activation_code`
--


-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `configuration_key` varchar(64) DEFAULT NULL,
  `configuration_value` text,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `configuration_key` (`configuration_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `title`, `configuration_key`, `configuration_value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Activation Email Subject', 'ACTIVATION_EMAIL_SUBJECT', 'Welcome to Scryptic', 'Welcome email subject.', '2009-01-12 11:11:11', '2009-01-12 11:11:11'),
(2, 'Activation Email Content', 'ACTIVATION_EMAIL_CONTENT', '<p>Welcome to Scryptic!</p> <p>Congratulations on opening a new account with us.</p> <p>Please follow this link to verify your account: <a href="ACCOUNT_ACTIVATION_URL">ACCOUNT_ACTIVATION_URL</a></p> <p>Below is your Scryptic username and temporary password. Please keep this for your records, since you will need it to log into your account.</p> <p>Your login is: EMAIL_ADDRESS and your password is: PASSWORD</p>\r\n<p>The Scryptic Team</p>', 'First email a new user gets, to activate their account.', '2009-01-12 11:11:11', '2009-01-12 11:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `file_hash` varchar(128) NOT NULL,
  `size` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `content_type` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_FI_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `file`
--


-- --------------------------------------------------------

--
-- Table structure for table `font`
--

CREATE TABLE IF NOT EXISTS `font` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `file_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `font`
--

INSERT INTO `font` (`id`, `name`, `file_name`) VALUES
(1, 'Arial', 'Arial.ttf'),
(2, 'Times-Roman', 'Times-New-Roman.ttf'),
(3, 'Courier', 'Courier-New.ttf'),
(4, 'Arial Hollow', 'ArialicHollow.ttf'),
(5, 'Persona', 'Persona.ttf'),
(6, 'LeMans', 'LeMans.ttf'),
(7, 'Impact', 'impact.ttf');

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE IF NOT EXISTS `layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `image` varchar(64) NOT NULL,
  `php_obj` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `layout`
--

INSERT INTO `layout` (`id`, `name`, `image`, `php_obj`) VALUES
(1, 'Top-Bottom', 'empty', 'empty'),
(2, 'Left-Right', 'empty', 'empty'),
(3, 'Diagonal-45', 'empty', 'empty'),
(4, 'Diagonal-135', 'empty', 'empty');

-- --------------------------------------------------------

--
-- Table structure for table `print_configuration`
--

CREATE TABLE IF NOT EXISTS `print_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `font_id` int(11) NOT NULL DEFAULT '1',
  `size` int(11) NOT NULL DEFAULT '16',
  `colour` varchar(16) NOT NULL DEFAULT '0',
  `opacity` int(11) NOT NULL DEFAULT '50',
  `created_at` datetime DEFAULT NULL,
  `watermark_image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `print_configuration_FI_1` (`account_id`),
  KEY `print_configuration_FI_2` (`layout_id`),
  KEY `print_configuration_FI_3` (`font_id`),
  KEY `fk_print_configuration_watermark_id` (`watermark_image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `print_configuration`
--


-- --------------------------------------------------------

--
-- Table structure for table `print_history`
--

CREATE TABLE IF NOT EXISTS `print_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(32) NOT NULL,
  `file_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `num_documents` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `creation_time` int(11) NOT NULL,
  `total_time` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `print_history_FI_1` (`user_id`),
  KEY `print_history_FI_3` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `print_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `print_history_configuration`
--

CREATE TABLE IF NOT EXISTS `print_history_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `print_history_id` int(11) NOT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `font_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `colour` varchar(16) NOT NULL,
  `opacity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `print_history_configuration_FK_1` (`layout_id`),
  KEY `print_history_configuration_FK_2` (`font_id`),
  KEY `print_history_configuration_FK_3` (`print_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `print_history_configuration`
--


-- --------------------------------------------------------

--
-- Table structure for table `print_history_group`
--

CREATE TABLE IF NOT EXISTS `print_history_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `print_history_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `print_history_group_FI_1` (`print_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `print_history_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `print_history_group_item`
--

CREATE TABLE IF NOT EXISTS `print_history_group_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `print_history_group_id` int(11) NOT NULL,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `print_history_group_item_FI_1` (`print_history_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `print_history_group_item`
--


-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_group`
--

CREATE TABLE IF NOT EXISTS `sf_guard_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_group_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sf_guard_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_group_permission`
--

CREATE TABLE IF NOT EXISTS `sf_guard_group_permission` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`permission_id`),
  KEY `sf_guard_group_permission_FI_2` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sf_guard_group_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_permission`
--

CREATE TABLE IF NOT EXISTS `sf_guard_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_permission_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sf_guard_permission`
--

INSERT INTO `sf_guard_permission` (`id`, `name`, `description`) VALUES
(1, 'administrator', 'Administrator'),
(2, 'system_admin', 'System Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_remember_key`
--

CREATE TABLE IF NOT EXISTS `sf_guard_remember_key` (
  `user_id` int(11) NOT NULL,
  `remember_key` varchar(32) DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sf_guard_remember_key`
--


-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_user`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_super_admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_user_username_unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sf_guard_user`
--

INSERT INTO `sf_guard_user` (`id`, `username`, `algorithm`, `salt`, `password`, `created_at`, `last_login`, `is_active`, `is_super_admin`) VALUES
(1, 'scryptic@scryptic.com', 'sha1', 'bce87c1f6df418d145f36544fee8a219', '806d5e0d6d29f27a41022637c0408b36dc4646de', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_user_group`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `sf_guard_user_group_FI_2` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sf_guard_user_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_user_permission`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `sf_guard_user_permission_FI_2` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sf_guard_user_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `sf_guard_user_profile`
--

CREATE TABLE IF NOT EXISTS `sf_guard_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `force_password_change` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sf_guard_user_profile_FI_1` (`account_id`),
  KEY `sf_guard_user_profile_FI_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sf_guard_user_profile`
--

INSERT INTO `sf_guard_user_profile` (`id`, `account_id`, `first_name`, `last_name`, `user_id`, `is_deleted`, `force_password_change`) VALUES
(1, 1, 'Scryptic', 'User', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `watermark_image`
--

CREATE TABLE IF NOT EXISTS `watermark_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `image_name` varchar(64) NOT NULL,
  `content_type` varchar(32) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_watermark_image_acnt_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `watermark_image`
--


-- --------------------------------------------------------

--
-- Table structure for table `wm_group`
--

CREATE TABLE IF NOT EXISTS `wm_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wm_group_FI_1` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wm_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `wm_group_item`
--

CREATE TABLE IF NOT EXISTS `wm_group_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wm_group_id` int(11) NOT NULL,
  `value` varchar(128) NOT NULL,
  `alt_value` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wm_group_item_FI_1` (`wm_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wm_group_item`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation_code`
--
ALTER TABLE `activation_code`
  ADD CONSTRAINT `activation_code_FK_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user_profile` (`id`);

--
-- Constraints for table `print_configuration`
--
ALTER TABLE `print_configuration`
  ADD CONSTRAINT `fk_print_configuration_watermark_id` FOREIGN KEY (`watermark_image_id`) REFERENCES `watermark_image` (`id`),
  ADD CONSTRAINT `print_configuration_FK_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `print_configuration_FK_2` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`id`),
  ADD CONSTRAINT `print_configuration_FK_3` FOREIGN KEY (`font_id`) REFERENCES `font` (`id`);

--
-- Constraints for table `print_history`
--
ALTER TABLE `print_history`
  ADD CONSTRAINT `print_history_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user_profile` (`id`),
  ADD CONSTRAINT `print_history_FK_3` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`);

--
-- Constraints for table `print_history_configuration`
--
ALTER TABLE `print_history_configuration`
  ADD CONSTRAINT `print_history_configuration_FK_1` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`id`),
  ADD CONSTRAINT `print_history_configuration_FK_2` FOREIGN KEY (`font_id`) REFERENCES `font` (`id`),
  ADD CONSTRAINT `print_history_configuration_FK_3` FOREIGN KEY (`print_history_id`) REFERENCES `print_history` (`id`);

--
-- Constraints for table `print_history_group`
--
ALTER TABLE `print_history_group`
  ADD CONSTRAINT `print_history_group_FK_1` FOREIGN KEY (`print_history_id`) REFERENCES `print_history` (`id`);

--
-- Constraints for table `print_history_group_item`
--
ALTER TABLE `print_history_group_item`
  ADD CONSTRAINT `print_history_group_item_FK_1` FOREIGN KEY (`print_history_group_id`) REFERENCES `print_history_group` (`id`);

--
-- Constraints for table `sf_guard_group_permission`
--
ALTER TABLE `sf_guard_group_permission`
  ADD CONSTRAINT `sf_guard_group_permission_FK_1` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_group_permission_FK_2` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sf_guard_remember_key`
--
ALTER TABLE `sf_guard_remember_key`
  ADD CONSTRAINT `sf_guard_remember_key_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sf_guard_user_group`
--
ALTER TABLE `sf_guard_user_group`
  ADD CONSTRAINT `sf_guard_user_group_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_user_group_FK_2` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sf_guard_user_permission`
--
ALTER TABLE `sf_guard_user_permission`
  ADD CONSTRAINT `sf_guard_user_permission_FK_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sf_guard_user_permission_FK_2` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sf_guard_user_profile`
--
ALTER TABLE `sf_guard_user_profile`
  ADD CONSTRAINT `sf_guard_user_profile_FK_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `sf_guard_user_profile_FK_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`);

--
-- Constraints for table `watermark_image`
--
ALTER TABLE `watermark_image`
  ADD CONSTRAINT `fk_watermark_image_acnt_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `wm_group`
--
ALTER TABLE `wm_group`
  ADD CONSTRAINT `wm_group_FK_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `wm_group_item`
--
ALTER TABLE `wm_group_item`
  ADD CONSTRAINT `wm_group_item_FK_1` FOREIGN KEY (`wm_group_id`) REFERENCES `wm_group` (`id`);
