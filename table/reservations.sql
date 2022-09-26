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
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `date_paye` date NOT NULL,
  `nbr_jour` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chambre_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservations_chambre_id_unique` (`chambre_id`),
  KEY `reservations_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `date_debut`, `date_fin`, `date_paye`, `nbr_jour`, `montant`, `status`, `desc`, `chambre_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2021-05-12', '2021-05-16', '2021-05-16', '5', 25000, 'Accepté', 'Réservation accepté', 1, 1, '2021-05-12 10:05:16', '2021-05-13 14:21:30'),
(2, '2021-05-15', '2021-05-23', '2021-05-23', '9', 45000, 'Annulé', 'Annuler satri misy tsy ampy ny information', 4, 1, '2021-05-14 08:45:56', '2021-05-14 09:58:05'),
(4, '2021-05-18', '2021-05-21', '2021-05-21', '4', 40000, 'En attente', 'Veuillez attender la validation de votre reservation!', 2, 1, '2021-05-18 05:56:41', '2021-05-18 05:56:41'),
(5, '2021-05-22', '2021-05-30', '2021-05-30', '9', 180000, 'En attente', 'Veuillez attender la validation de votre reservation!', 6, 3, '2021-05-18 15:07:11', '2021-05-18 15:07:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
