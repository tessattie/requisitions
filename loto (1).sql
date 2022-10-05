-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 05, 2022 at 02:24 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loto`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorizations`
--

DROP TABLE IF EXISTS `authorizations`;
CREATE TABLE IF NOT EXISTS `authorizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorizations`
--

INSERT INTO `authorizations` (`id`, `name`, `type`) VALUES
(63, 'Créer une réquisiton', 2),
(64, 'Editer une réquisition', 2),
(65, 'Visualiser les réquisitions', 2),
(66, 'Visualiser le dashboard', 1),
(67, 'Visualiser les catégories', 3),
(68, 'Créer / Editer une catégorie', 3),
(69, 'Ajouter des notes pour les réquisitions', 2),
(70, 'Ajouter des pièces jointes aux réquisitions', 2),
(71, 'Gérer les utilisateurs et les rôles', 4),
(72, 'Changer le statut d\'une réquisition', 2),
(73, 'Modifier une réquisition une fois qu\'elle est validée', 2);

-- --------------------------------------------------------

--
-- Table structure for table `authorizations_roles`
--

DROP TABLE IF EXISTS `authorizations_roles`;
CREATE TABLE IF NOT EXISTS `authorizations_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorization_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorizations_roles`
--

INSERT INTO `authorizations_roles` (`id`, `authorization_id`, `role_id`) VALUES
(1, 66, 1),
(2, 64, 1),
(3, 70, 1),
(4, 69, 1),
(5, 65, 1),
(6, 63, 1),
(7, 67, 1),
(8, 68, 1),
(9, 71, 1),
(10, 66, 7),
(11, 65, 7),
(12, 67, 7),
(15, 65, 5),
(18, 67, 5),
(19, 72, 1),
(20, 73, 1),
(21, 66, 6),
(23, 64, 6),
(24, 65, 6),
(25, 69, 6),
(26, 70, 6),
(27, 72, 6),
(28, 73, 6),
(29, 67, 6),
(31, 63, 5),
(35, 66, 5),
(41, 63, 6),
(42, 68, 6);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'MOBILIER'),
(2, 'LOYER'),
(3, 'TESTS');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requisition_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `requisition_id`, `location`, `created`, `modified`, `user_id`) VALUES
(1, 1, 'E28073D3-C869-4118-AC59-C6E00508B6EC.jpeg', '2022-08-16 10:43:38', '2022-08-16 10:43:38', 9),
(2, 1, '365037_1.jpg', '2022-08-16 10:51:36', '2022-08-16 10:51:36', 9),
(3, 1, '461866_1.docx', '2022-08-16 10:53:55', '2022-08-16 10:53:55', 9),
(4, 1, '71546_1.pdf', '2022-08-16 10:54:22', '2022-08-16 10:54:22', 9),
(5, 1, '125080_1.png', '2022-08-16 10:54:58', '2022-08-16 10:54:58', 9),
(6, 1, '56103_1.jpeg', '2022-08-16 11:03:49', '2022-08-16 11:03:49', 9),
(7, 1, '7365_1.jpg', '2022-08-16 11:05:24', '2022-08-16 11:05:24', 9),
(8, 2, '167426_2.jpeg', '2022-08-16 12:07:08', '2022-08-16 12:07:08', 9),
(9, 2, '246191_2.pdf', '2022-08-16 12:07:16', '2022-08-16 12:07:16', 9),
(10, 2, '49567_2.jpeg', '2022-08-17 09:09:51', '2022-08-17 09:09:51', 9),
(11, 3, '288753_3.pdf', '2022-09-05 16:04:32', '2022-09-05 16:04:32', 9),
(12, 3, '399952_3.png', '2022-09-05 16:04:37', '2022-09-05 16:04:37', 9),
(13, 3, '431999_3.png', '2022-09-05 16:04:41', '2022-09-05 16:04:41', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requisition_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `requisition_id`, `description`, `user_id`, `created`, `modified`) VALUES
(1, 1, 'Faut ajouter les documents', 9, '2022-08-16 14:02:23', '2022-08-16 14:02:23'),
(2, 1, 'Verifier l\'gheure du systeme', 9, '2022-08-16 10:03:35', '2022-08-16 10:03:35'),
(3, 2, 'Prend trop de temps', 9, '2022-08-16 12:07:34', '2022-08-16 12:07:34'),
(4, 1, 'SVP ajouter budget', 9, '2022-08-17 09:08:59', '2022-08-17 09:08:59'),
(5, 2, 'SVP ne depassez pas le budget', 9, '2022-08-17 09:10:12', '2022-08-17 09:10:12'),
(6, 3, 'Une note', 9, '2022-09-05 16:06:52', '2022-09-05 16:06:52'),
(7, 3, 'Une autre note', 9, '2022-09-05 16:07:01', '2022-09-05 16:07:01'),
(8, 3, 'Et une autre', 9, '2022-09-05 16:07:07', '2022-09-05 16:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

DROP TABLE IF EXISTS `requisitions`;
CREATE TABLE IF NOT EXISTS `requisitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requisition_number` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `due_date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount_requested` float DEFAULT NULL,
  `amount_authorized` float DEFAULT NULL,
  `archived` tinyint(4) NOT NULL DEFAULT '1',
  `rate` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL DEFAULT '9',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `requisition_number`, `created`, `modified`, `due_date`, `category_id`, `title`, `location`, `full_name`, `description`, `amount_requested`, `amount_authorized`, `archived`, `rate`, `status`, `user_id`) VALUES
(1, 'AV374663', '2022-08-16 12:26:32', '2022-08-17 14:36:19', '2022-08-22', 1, 'Peinture', '', 'Tess Attié', 'Peinture 2e étage bureau place boyer', 80000, NULL, 1, 1, 3, 9),
(2, 'TH78923', '2022-08-16 12:06:48', '2022-08-17 09:21:30', '2022-08-19', 1, 'Demande de paiement pour loyer', 'PL45', 'Yann Attié', 'Paiement loyer', 50000, 40000, 1, 1, 2, 9),
(3, 'SDFJH322SD', '2022-09-05 16:04:15', '2022-09-05 16:07:07', '2022-10-01', 3, 'Titre de la réquisition', 'PL456', 'Tess Attie', 'Un test pour la section requisition ', 80000, NULL, 1, 1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`, `description`) VALUES
(1, 'ADMIN', '2022-08-12 14:33:41', '2022-08-12 15:24:54', NULL),
(5, 'CREATEUR', '2022-08-12 15:25:04', '2022-08-12 15:25:04', NULL),
(6, 'VALIDATEUR', '2022-08-17 13:47:23', '2022-08-17 13:47:23', NULL),
(7, 'CONSULTATEUR', '2022-08-17 13:47:31', '2022-08-17 13:47:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `status`, `role_id`, `created`, `modified`) VALUES
(9, 'Tess ATTIE', 'tattie', '$2y$10$76.QbBhombFl/hF/Ltlclew1PpxCt0mDGy59rbC83bO6ZtGCQn4Hy', 1, 1, '2022-05-12 12:37:39', '2022-08-17 14:08:36'),
(11, 'Yann ATTIE', 'yann', '$2y$10$JNj5vJdlccnryAmsuwVRD.EATkrkTkx7malnGYPxfpDTt1bGuYrSe', 1, 5, '2022-08-17 14:04:03', '2022-08-17 14:08:28'),
(12, 'Geoffrey FOSTUR', 'geoffrey', '$2y$10$uptKpdcvOOrBIDUf5PrAeuUtJ9eUmLRo48CYlX.NCOcsYscg.IFJi', 1, 6, '2022-08-17 14:41:19', '2022-08-17 14:41:19'),
(13, 'Emmanuel ROODLY NOEL', 'emmanuel', '$2y$10$.kxF2elcJPVJmKk56YR8UeNHbbRXIibnUoiZJqFcu5ycj6y0.Xp8.', 1, 7, '2022-08-17 14:41:45', '2022-08-17 14:41:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
