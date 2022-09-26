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
-- Structure de la table `chambres`
--

DROP TABLE IF EXISTS `chambres`;
CREATE TABLE IF NOT EXISTS `chambres` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `num_ch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_tel_ch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbr_lit_ch` int(11) NOT NULL,
  `etage_ch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_ch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chambres_num_ch_unique` (`num_ch`),
  KEY `chambres_categorie_id_index` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`id`, `num_ch`, `num_tel_ch`, `description_ch`, `nbr_lit_ch`, `etage_ch`, `img_ch`, `status_ch`, `categorie_id`, `created_at`, `updated_at`) VALUES
(1, '1', '0342154581', 'Chambre simple pour une personne sans TV', 1, 'Premiere', '1619455370.jpg', 'Reservé', 1, '2021-04-26 14:42:50', '2021-05-12 10:05:16'),
(2, '2', '0342154582', 'Chambre pour deux personnes avec TV Malagasy', 2, 'Deuxieme', '1619455421.jpg', 'Reservé', 2, '2021-04-26 14:43:41', '2021-05-18 05:56:41'),
(3, '3', '0342154583', 'Chambre pour famille avec TV complet chaine canal+', 3, 'Troisieme', '1619455477.jpg', 'libre', 3, '2021-04-26 14:44:37', '2021-05-14 10:25:15'),
(4, '4', '0342154584', 'Chambre simple pour famille sans TV', 3, 'Premiere', '1619531085.jpg', 'Reservé', 1, '2021-04-27 11:44:45', '2021-05-14 08:45:56'),
(5, '5', '0342154585', 'Chambre pour une personne avec TV', 1, 'Troisieme', '1619531130.jpg', 'libre', 2, '2021-04-27 11:45:30', '2021-04-27 11:45:30'),
(6, '6', '0342154586', 'Chambre luxe pour deux personnes avec TV ecran plat et canal +', 2, 'Troisieme', '1619531186.jpg', 'Reservé', 3, '2021-04-27 11:46:26', '2021-05-18 15:07:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
