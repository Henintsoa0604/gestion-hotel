-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 19 mai 2021 à 15:48
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
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_cli` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrs_cli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_cli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal_cli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays_cli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_cli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `prenom_cli`, `adrs_cli`, `ville_cli`, `code_postal_cli`, `pays_cli`, `tel_cli`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rakotonavalona', 'hery', 'bat E', 'andrainjato', '6352', 'fianarantsoa', '0342507977', 'rakoto@gmail.com', '$2y$10$ZefuCcBD6JFAyRGUGOrfQugervz3vc1LFoBqffGDzcDPXoE6f90gu', 'WVyieUCp3AbNnDNrWV2NYJjJvxDJCcJkFGncZMEPDBdRNxhxAdsKR2np22H1', '2021-05-12 10:03:52', '2021-05-18 16:02:50'),
(2, 'client1', NULL, 'qzdqzd', 'jkomd', '455', 'dqzjdj', '555454525', 'client1@gmail.com', '$2y$10$LLbYJ9Hoe6nBrDRCUnV91uB5/uZRSYL4J0de779plVG7V./QuO3Iu', NULL, '2021-05-14 10:15:00', '2021-05-14 10:15:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
