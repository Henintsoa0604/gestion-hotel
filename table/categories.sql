-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 19 mai 2021 à 15:57
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gest_hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_cat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_cat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_cat` int(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_code_cat_unique` (`code_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `code_cat`, `description_cat`, `prix_cat`, `created_at`, `updated_at`) VALUES
(1, 'cat1', 'Chambre simple', 5000, '2021-04-26 14:41:24', '2021-04-26 14:41:24'),
(2, 'cat2', 'Chambre moyenne', 10000, '2021-04-26 14:41:40', '2021-04-26 14:41:40'),
(3, 'cat3', 'Chambre luxe', 20000, '2021-04-26 14:41:54', '2021-04-26 14:41:54'),
(4, 'cscwsc', 'nklqgdbqlb jbjlbcdqozdhnq ldhn qdbkkbdhozidnhkzbd!qz db zjldbnkq dhinqzdlbqzhd!lnqldjb jzdbjzldn;dnjlzdnzkdnqzjldnqzldn:qjldhqzidnqzd', 200000, '2021-05-19 13:38:03', '2021-05-19 13:38:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
