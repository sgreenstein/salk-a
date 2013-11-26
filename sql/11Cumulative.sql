-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2013 at 04:06 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `salkData`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `campers`
--

DROP TABLE IF EXISTS `campers`;
CREATE TABLE IF NOT EXISTS `campers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `insurance_card_id` int(10) unsigned DEFAULT NULL,
  `birth_date` date NOT NULL,
  `background_check` tinyint(1) DEFAULT '0',
  `shirt_size` enum('S','M','L','XL','2XL','3XL','4XL') NOT NULL,
  `camp_choice_1` int(10) unsigned NOT NULL,
  `camp_choice_2` int(10) unsigned NOT NULL,
  `camp_assignment` int(10) unsigned DEFAULT NULL,
  `site_assignment` int(10) unsigned DEFAULT NULL,
  `paid` tinyint(1) DEFAULT '0',
  `application_complete` tinyint(1) DEFAULT '0',
  `accepted` tinyint(1) DEFAULT '0',
  `address_1` varchar(40) NOT NULL,
  `address_2` varchar(40) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(10) NOT NULL,
  `cell_phone` char(10) NOT NULL,
  `church` varchar(40) NOT NULL,
  `district` varchar(30) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `campers_camps`
--

DROP TABLE IF EXISTS `campers_camps`;
CREATE TABLE IF NOT EXISTS `campers_camps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camper_id` int(10) unsigned NOT NULL,
  `camp_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `camps`
--

DROP TABLE IF EXISTS `camps`;
CREATE TABLE IF NOT EXISTS `camps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `year` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int(10) unsigned NOT NULL,
  `camp_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(200) NOT NULL,
  `description` text,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_cards`
--

DROP TABLE IF EXISTS `insurance_cards`;
CREATE TABLE IF NOT EXISTS `insurance_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camper_id` int(10) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camp_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `schedule_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camp_id` int(10) DEFAULT NULL,
  `site_id` int(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` int(20) DEFAULT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `camper_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

INSERT INTO `users` (`id`, `username`, `password`, `level`, `profile_picture`, `first_name`, `last_name`, `created`, `modified`, `site_id`, `camp_id`) VALUES
(1, 'admin', '4824dfa5b9ad27a24c4465eeeb60c5157a469fa6', 100, NULL, 'The', 'Admin', '2013-11-06 14:13:03', '2013-11-06 15:50:10', NULL, NULL),
(2, 'camper', '725ff77885215dfd5c9bfef4d0c2aa0ea03214df', 20, NULL, NULL, NULL, '2013-11-06 16:07:30', '2013-11-06 16:07:30', NULL, NULL),
(4, 'testCamper001', '725ff77885215dfd5c9bfef4d0c2aa0ea03214df', NULL, NULL, NULL, NULL, '2013-11-10 15:38:53', '2013-11-10 15:38:53', NULL, NULL),
(5, 'testCamper002', '725ff77885215dfd5c9bfef4d0c2aa0ea03214df', 20, NULL, NULL, NULL, '2013-11-10 15:41:04', '2013-11-10 15:41:04', NULL, NULL),
(6, 'testParent001', '725ff77885215dfd5c9bfef4d0c2aa0ea03214df', 10, NULL, NULL, NULL, '2013-11-10 15:47:31', '2013-11-10 15:47:31', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

