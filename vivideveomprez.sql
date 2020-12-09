-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : vivideveomprez.mysql.db
-- Généré le :  Dim 18 oct. 2020 à 23:31
-- Version du serveur :  5.6.48-log
-- Version de PHP :  7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vivideveomprez`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`) VALUES
(3),
(4);

-- --------------------------------------------------------

--
-- Structure de la table `avion`
--

CREATE TABLE `avion` (
  `id` int(11) NOT NULL,
  `capacite` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `avion`
--

INSERT INTO `avion` (`id`, `capacite`, `model`) VALUES
(2, 225, 'AirBus Pro110'),
(3, 250, 'AirBus Pro112'),
(4, 180, '205'),
(5, 250, 'AirBus Pro2100');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idmatriel` int(11) NOT NULL,
  `datep` date NOT NULL,
  `dater` date DEFAULT NULL,
  `duree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `iduser`, `idmatriel`, `datep`, `dater`, `duree`) VALUES
(7, 1, 1, '2014-05-10', NULL, 30);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'admin', 'admin', 'admin@admin', 'admin@admin', 1, '8cc9j5ahi3k08o40og0g8k4gogs084c', 'f4d0xeFzl/vnSLrawUc1z0fkz/msMblR0DAp5q1VQkpZFbHnRrH2JwgJEy5ms+ZgPDU9YhAVxsI9o8GJujZR6g==', '2014-04-11 23:20:24', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Equipe1', 'Equipe responsable sur sur produit X', '2015-05-08 12:04:17', '2015-05-08 12:04:17'),
(2, 'Equipe2', 'Equipe xwewqewew wew wqewe', '2015-05-08 16:16:02', '2015-05-08 16:16:02'),
(3, 'Equipe3', 'djkföljaskldfjaskldfjaskldjaskldjsa', '2015-06-04 10:10:38', '2015-06-04 10:10:38');

-- --------------------------------------------------------

--
-- Structure de la table `groupe_personnel`
--

CREATE TABLE `groupe_personnel` (
  `personnel_id` int(10) UNSIGNED NOT NULL,
  `groupe_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `groupe_personnel`
--

INSERT INTO `groupe_personnel` (`personnel_id`, `groupe_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(3, 1),
(2, 3),
(1, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_presentation`
--

CREATE TABLE `groupe_presentation` (
  `presentation_id` int(10) UNSIGNED NOT NULL,
  `groupe_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `groupe_presentation`
--

INSERT INTO `groupe_presentation` (`presentation_id`, `groupe_id`) VALUES
(15, 1),
(15, 2),
(16, 1),
(14, 2);

-- --------------------------------------------------------

--
-- Structure de la table `matriel`
--

CREATE TABLE `matriel` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matriel`
--

INSERT INTO `matriel` (`id`, `nom`, `photo`) VALUES
(1, 'Audi', 'img/audi.jpg'),
(2, 'Megane', 'img/megane.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_03_06_155504_create_presentation_table', 2),
('2015_03_06_160726_create_presentations_table', 3),
('2015_03_08_141407_create_personnels_table', 4),
('2015_03_23_200328_create_personnel_presentation_table', 5),
('2015_04_08_154957_create_presentations_views_table', 6),
('2015_04_11_154047_create_view_delais_table', 7),
('2015_05_08_123424_create_groupes_table', 8),
('2015_05_08_132501_create_personnel_groupe_table', 9),
('2015_05_08_134830_create_groupe_personnel_table', 10),
('2015_05_08_1345030_create_groupe_personnel_table', 11),
('2015_05_08_142218_create_groupe_presentation_table', 12),
('2015_05_09_204607_create_questions_table', 13);

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`id`, `nom`, `prenom`, `dateNaissance`, `sexe`) VALUES
(5, 'Test', 'Testtt', '1990-01-01', 'M'),
(6, 'Salim', 'Salhi', '1992-01-01', 'M');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `poste` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `nom`, `prenom`, `dateNaissance`, `sexe`, `poste`) VALUES
(1, 'Marwen', 'Kheder', '1994-01-01', 'M', 'Commandant du bord'),
(2, 'Ali', 'Zahouri', '2010-09-07', 'M', 'Copilote'),
(3, 'Salwa', 'Allouli', '1990-10-10', 'F', 'Hôtesse'),
(4, 'Sawsen', 'Kallou', '1990-12-06', 'F', 'Hôtesse'),
(5, 'Salhi', 'Dous', '1989-09-19', 'M', 'Commandant du bord');

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE `personnels` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personnels`
--

INSERT INTO `personnels` (`id`, `nom`, `prenom`, `photo`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Déléguée A', 'Prénom A', 'personnels/1602863785.png', 'DéléguéeA@test.com', '098f6bcd4621d373cade4e832627b4f6', '2015-03-08 15:49:47', '2020-10-16 13:56:25'),
(2, 'test2', 'rttttrrte', NULL, 'test2@test.com', 'cc03e747a6afbbcbf8be7668acfebee5', '2015-03-09 17:49:28', '2020-09-09 17:02:00'),
(3, 'test3', 'prenim', NULL, 'test3@test.com', '8ad8757baa8564dc136c1e07507f4a98', '2015-05-08 16:15:45', '2015-05-08 16:15:45'),
(7, 'Rahali', 'Dali', NULL, 'rahali.dali@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', '2020-08-18 11:20:37', '2020-08-24 12:17:18'),
(8, 'Douki', 'Skander', NULL, 's.douki@pixelstrade.com', 'ae82f701213e3b71372f502b6aa6718a', '2020-08-18 11:58:06', '2020-09-14 13:03:34');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_presentation`
--

CREATE TABLE `personnel_presentation` (
  `personnel_id` int(10) UNSIGNED NOT NULL,
  `presentation_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personnel_presentation`
--

INSERT INTO `personnel_presentation` (`personnel_id`, `presentation_id`) VALUES
(1, 15),
(2, 15),
(1, 16),
(1, 18),
(1, 19),
(3, 14),
(7, 21),
(8, 14),
(7, 19),
(7, 14),
(7, 18),
(2, 14),
(2, 16),
(8, 18);

-- --------------------------------------------------------

--
-- Structure de la table `personnel_vol`
--

CREATE TABLE `personnel_vol` (
  `personnel_id` int(11) NOT NULL,
  `vol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `presentations`
--

CREATE TABLE `presentations` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ZipURI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ThumURI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `message_product` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `presentations`
--

INSERT INTO `presentations` (`id`, `nom`, `version`, `description`, `ZipURI`, `ThumURI`, `id_product`, `message_product`, `created_at`, `updated_at`) VALUES
(14, 'Test html', 1, 'Hqehqqeqwqwq', 'uploads/1427838808Archive.zip', 'uploads/1427838808Archive/thumb.jpg', NULL, NULL, '2015-03-29 14:18:27', '2015-03-31 20:53:28'),
(15, 'Test html2', 0, 'ewewew', 'uploads/1427738766Test html2Archive.zip', 'uploads/1427738766Test html2Archive/thumb.jpg', NULL, NULL, '2015-03-30 17:06:06', '2015-03-30 17:06:06'),
(16, 'Celiprol', 1, 'dwjlkqwjlkjelkwje', 'uploads/1432844942Archive.zip', 'uploads/1432844942Archive/thumb.jpg', NULL, NULL, '2015-04-02 13:29:19', '2015-05-28 19:29:02'),
(18, 'Doliprex', 1, 'Doliprex est préconisé dans les maux de tête et la congestion nasale. Il soulage les symptômes des processus catarrhaux et grippaux avec fièvre et douleur élevée ou modérée. Cette présentation est réservée à l\'adulte (à partir de 15 ans).', 'uploads/1430586220Archive 2.zip', 'uploads/1430586220Archive 2/thumb.jpg', NULL, NULL, '2015-05-02 16:02:13', '2015-05-02 16:03:40'),
(19, 'Demo1', 0, 'Demo Pour PFE', 'uploads/1432843834Demo1Archive.zip', 'uploads/1432843834Demo1Archive/thumb.jpg', NULL, NULL, '2015-05-28 19:10:34', '2015-05-28 19:10:34'),
(20, 'Prez 2017 testing marque blanche', 0, 'reprendre la le projet afin de le mettre en ligne sur azure et le commercialiser', 'uploads/1491476359Prez 2017 testing marque blanchePIXELSTRADE eADV WorldWide.pdf', '', NULL, NULL, '2017-04-06 08:59:19', '2017-04-06 08:59:19'),
(21, 'test presentation', 0, 'test', 'uploads/1597757786test presentation1427838808Archive (1).zip', 'uploads/1597757786test presentation1427838808Archive (1)/thumb.jpg', NULL, NULL, '2020-08-18 11:36:26', '2020-08-18 11:36:26'),
(22, 'd', 0, 'd', 'uploads/1601818058d1601559923PdfToImagePdfToImage.zip', 'uploads/1601818058d1601559923PdfToImagePdfToImage/thumb.jpg', NULL, NULL, '2020-10-04 11:27:38', '2020-10-04 11:27:38'),
(23, 'fa', 0, 'dfffa', 'uploads/1601818250ddtest.html', '', NULL, NULL, '2020-10-04 11:30:50', '2020-10-04 11:34:27'),
(24, 'ss', 0, 'sss', 'uploads/1601891711ssE ADV NICOPASS 29 03 19.pdf.zip', '', NULL, NULL, '2020-10-05 07:55:46', '2020-10-05 07:55:46'),
(25, 'heloooooooooooooooooo', 0, 'heloooooooooooooooooo', 'uploads/1601898408helooooooooooooooooooE ADV NICOPASS 29 03 19.pdf.zip', '', NULL, NULL, '2020-10-05 09:47:24', '2020-10-05 09:47:24'),
(26, 'test2', 0, 'test2', 'uploads/1601898537test2prezmanager.pdf.zip', '', NULL, NULL, '2020-10-05 09:48:59', '2020-10-05 09:48:59'),
(27, 'ddhgf', 0, 'gfh', 'uploads/1602287237ddhgfprezmanager.pdf.zip', '', NULL, NULL, '2020-10-09 21:47:22', '2020-10-09 21:47:22'),
(28, 'fh', 1, 'fgh', 'uploads/16025040101602503746fhE ADV NICOPASS 29 03 19.pdf.zip', 'uploads/16025040101602503746fhE ADV NICOPASS 29 03 19.pdf/thumb.jpg', 2, NULL, '2020-10-12 09:56:51', '2020-10-12 10:00:10'),
(29, 'EADV', 0, 'EADV DESCRIPTION', 'uploads/16029297932E ADV NICOPASS 29 03 19.pdf.zip', 'uploads/16029297932E ADV NICOPASS 29 0/thumb.jpg', 3, NULL, '2020-10-17 08:17:38', '2020-10-17 08:25:17');

-- --------------------------------------------------------

--
-- Structure de la table `presentations_views`
--

CREATE TABLE `presentations_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `presentation_id` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `presentations_views`
--

INSERT INTO `presentations_views` (`id`, `presentation_id`, `created_at`) VALUES
(1, 15, '2015-04-08'),
(2, 15, '2015-04-08'),
(3, 15, '2015-04-09'),
(4, 15, '2015-04-09'),
(5, 15, '2015-04-09'),
(6, 15, '2015-04-11'),
(7, 15, '2015-04-12'),
(8, 15, '2015-04-12'),
(9, 14, '2015-04-09'),
(10, 16, '2015-04-09'),
(11, 16, '2015-04-09'),
(12, 14, '2015-04-12'),
(17, 16, '2015-04-21'),
(19, 16, '2015-04-22'),
(20, 15, '2015-04-22'),
(21, 16, '2015-04-22'),
(22, 16, '2015-04-22'),
(23, 16, '2015-04-22'),
(24, 16, '2015-04-22'),
(25, 16, '2015-04-22'),
(26, 16, '2015-04-22'),
(27, 16, '2015-04-22'),
(28, 16, '2015-04-22'),
(29, 16, '2015-04-22'),
(30, 16, '2015-04-22'),
(31, 16, '2015-04-22'),
(32, 16, '2015-04-22'),
(33, 16, '2015-04-22'),
(34, 14, '2015-04-22'),
(35, 14, '2015-04-22'),
(36, 14, '2015-04-22'),
(37, 16, '2015-04-23'),
(38, 15, '2015-04-23'),
(39, 16, '2015-04-23'),
(40, 16, '2015-04-23'),
(41, 16, '2015-04-23'),
(42, 16, '2015-04-28'),
(43, 16, '2015-04-28'),
(44, 14, '2015-04-28'),
(45, 14, '2015-04-28'),
(46, 16, '2015-04-28'),
(47, 16, '2015-04-28'),
(48, 16, '2015-04-28'),
(49, 16, '2015-04-28'),
(50, 16, '2015-04-28'),
(51, 16, '2015-04-28'),
(52, 16, '2015-04-28'),
(53, 16, '2015-04-28'),
(54, 16, '2015-04-28'),
(56, 16, '2015-04-28'),
(57, 16, '2015-04-28'),
(58, 16, '2015-04-30'),
(59, 16, '2015-04-30'),
(60, 18, '2015-05-02'),
(61, 18, '2015-05-05'),
(62, 18, '2015-05-05'),
(63, 16, '2015-05-05'),
(64, 16, '2015-05-10'),
(65, 18, '2015-05-10'),
(66, 18, '2015-05-10'),
(67, 15, '2015-05-10'),
(68, 15, '2015-05-10'),
(69, 15, '2015-05-10'),
(70, 15, '2015-05-10'),
(71, 18, '2015-05-28'),
(72, 16, '2015-05-28'),
(73, 15, '2015-05-28'),
(74, 14, '2015-05-28'),
(75, 16, '2015-05-28'),
(76, 15, '2015-05-28'),
(77, 19, '2015-05-28'),
(78, 19, '2015-05-28'),
(79, 19, '2015-05-28'),
(80, 16, '2015-05-28'),
(81, 14, '2015-05-29'),
(82, 18, '2015-05-29'),
(83, 18, '2015-05-29'),
(84, 18, '2015-05-29'),
(85, 16, '2015-05-29'),
(86, 18, '2015-08-27'),
(87, 18, '2015-08-27'),
(88, 18, '2015-08-27'),
(89, 19, '2015-09-01'),
(90, 16, '2015-09-01'),
(91, 15, '2015-09-01'),
(92, 19, '2015-09-03'),
(93, 16, '2015-09-03'),
(94, 19, '2015-09-03'),
(95, 18, '2015-09-03'),
(96, 19, '2015-09-03'),
(97, 19, '2015-09-03'),
(98, 18, '2015-09-03'),
(99, 15, '2020-09-10');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `nom`, `photo`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Prod 1', 'products/1602926188.png', 'DESCRIPTION Prod 1', '2020-10-17 09:16:28', '2020-10-17 09:16:28'),
(3, 'Prod 2', 'products/1602930233.png', 'Prod 2', '2020-10-17 10:23:53', '2020-10-17 10:23:53');

-- --------------------------------------------------------

--
-- Structure de la table `produitferme`
--

CREATE TABLE `produitferme` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `uri` varchar(250) NOT NULL,
  `prix` int(11) NOT NULL,
  `qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produitferme`
--

INSERT INTO `produitferme` (`id`, `nom`, `uri`, `prix`, `qnt`) VALUES
(1, 'cocacola', 'src/resource/coca.jpg', 700, 14),
(2, 'Apla', 'src/resource/apla.jpg', 300, 6),
(3, 'Fanta', 'src/resource/fanta.jpg', 700, 9),
(4, 'orangina', 'src/resource/orangina.jpg', 600, 20),
(5, 'eau', 'src/resource/eau.jpg', 300, 20),
(6, '7up', 'src/resource/7up.jpg', 900, 30),
(7, 'Boga', 'src/resource/boga.jpg', 800, 10),
(8, 'Pepsi', 'src/resource/pepsi.jpg', 900, 17),
(9, 'schweppes', 'src/resource/schweppes.jpg', 900, 36),
(10, 'sprite', 'src/resource/sprite.jpg', 900, 15);

-- --------------------------------------------------------

--
-- Structure de la table `produitouvert`
--

CREATE TABLE `produitouvert` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `uri` varchar(250) NOT NULL,
  `prix` int(11) NOT NULL,
  `qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produitouvert`
--

INSERT INTO `produitouvert` (`id`, `nom`, `uri`, `prix`, `qnt`) VALUES
(1, 'lait', 'src/resource/lait.jpg', 400, 11),
(2, 'cafe', 'src/resource/cafe.png', 300, 7),
(3, 'citronade', 'src/resource/citronade.png', 700, 9),
(4, 'the', 'src/resource/the.jpg', 600, 20),
(5, 'Chocolat', 'src/resource/chocolat.jpg', 300, 20);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `Question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `response` text COLLATE utf8_unicode_ci NOT NULL,
  `repindex` int(11) NOT NULL,
  `presentation_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `Question`, `response`, `repindex`, `presentation_id`) VALUES
(1, 'Question babababababa', '[\"Aaaaa\",\"Bbbbbb\",\"Cccccc\"]', 1, 15),
(2, 'Question babababababa', '[\"Aaaaa\",\"Bbbbbb\",\"Cccccc\"]', 2, 15),
(3, 'Question babababababa', '[\"Aaaaa\",\"Bbbbbb\",\"Cccccc\"]', 2, 15),
(4, 'Qui est balalaw ?', '[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]', 1, 15),
(5, 'Qui est balalaw ?', '[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]', 2, 15),
(6, 'Qui est balalaw ?', '[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]', 2, 15),
(7, 'Qui est balalaw ?', '[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]', 0, 15),
(8, 'Qui est balalaw ?', '[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]', 2, 15),
(9, 'Qualité de produit ?', '[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]', 2, 15),
(10, 'Qualité de produit ?', '[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]', 0, 15),
(11, 'Qualité de produit ?', '[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]', 2, 15),
(12, 'Qualité de produit ?', '[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]', 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `passager_id` int(11) DEFAULT NULL,
  `vol_id` int(11) DEFAULT NULL,
  `etat` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `passager_id`, `vol_id`, `etat`) VALUES
(1, 5, 5, 'V'),
(5, 5, 7, 'A'),
(6, 5, 2, 'V'),
(10, 5, 6, 'V');

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `idcreator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `teamid` int(11) NOT NULL,
  `socre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `teamid`, `socre`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.com', '$2y$10$wmyGzMIb/lB93sXOmd6rBufzugNr4bxPB7i2ssA81ouTMOi5Bp/HG', 'xUZf1QpCCyPvHLKpkxeOlXxp121IU3hR3I6eMq0oYMa6rFDyV7JTKzttEJoJ', '2015-03-06 15:27:27', '2020-09-04 07:49:43');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`) VALUES
(1, 'kheder', 'Marwen', 'test@test'),
(2, 'Ali', 'Salhi', 'Test@test');

-- --------------------------------------------------------

--
-- Structure de la table `view_delais`
--

CREATE TABLE `view_delais` (
  `id` int(10) UNSIGNED NOT NULL,
  `presentation_id` int(10) UNSIGNED NOT NULL,
  `personnel_id` int(11) DEFAULT NULL,
  `delai` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `view_delais`
--

INSERT INTO `view_delais` (`id`, `presentation_id`, `personnel_id`, `delai`) VALUES
(1, 15, NULL, '[5,2,3,4]'),
(2, 15, NULL, '[7,1,5,2]'),
(3, 15, NULL, '[5,3,7,4]'),
(4, 14, NULL, '[2,5,3,4]'),
(5, 15, 7, '[5,2,3,4]'),
(6, 15, 7, '[5,2,3,4]');

-- --------------------------------------------------------

--
-- Structure de la table `vol`
--

CREATE TABLE `vol` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Avion_id` int(11) DEFAULT NULL,
  `duree` int(11) NOT NULL,
  `heure` time NOT NULL,
  `etat` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `vol`
--

INSERT INTO `vol` (`id`, `date`, `destination`, `Avion_id`, `duree`, `heure`, `etat`) VALUES
(2, '2014-10-06', 'United Kingdom', 2, 55, '10:23:00', 'C'),
(4, '2014-04-16', 'Algeria', 2, 14, '12:15:00', ''),
(5, '2014-04-07', 'Japan', 2, 50, '13:30:00', ''),
(6, '2014-04-14', 'United States', 4, 20, '16:15:00', ''),
(7, '2014-04-15', 'Tunisia', 2, 2323, '18:00:00', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avion`
--
ALTER TABLE `avion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe_personnel`
--
ALTER TABLE `groupe_personnel`
  ADD KEY `groupe_personnel_personnel_id_foreign` (`personnel_id`),
  ADD KEY `groupe_personnel_groupe_id_foreign` (`groupe_id`);

--
-- Index pour la table `groupe_presentation`
--
ALTER TABLE `groupe_presentation`
  ADD KEY `groupe_presentation_presentation_id_foreign` (`presentation_id`),
  ADD KEY `groupe_presentation_groupe_id_foreign` (`groupe_id`);

--
-- Index pour la table `matriel`
--
ALTER TABLE `matriel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personnels_email_unique` (`email`);

--
-- Index pour la table `personnel_presentation`
--
ALTER TABLE `personnel_presentation`
  ADD KEY `personnel_presentation_personnel_id_foreign` (`personnel_id`),
  ADD KEY `personnel_presentation_presentation_id_foreign` (`presentation_id`);

--
-- Index pour la table `personnel_vol`
--
ALTER TABLE `personnel_vol`
  ADD PRIMARY KEY (`personnel_id`,`vol_id`),
  ADD KEY `IDX_42FB6A5B1C109075` (`personnel_id`),
  ADD KEY `IDX_42FB6A5B9F2BFB7A` (`vol_id`);

--
-- Index pour la table `presentations`
--
ALTER TABLE `presentations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `presentations_views`
--
ALTER TABLE `presentations_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presentations_views_presentation_id_foreign` (`presentation_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produitferme`
--
ALTER TABLE `produitferme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produitouvert`
--
ALTER TABLE `produitouvert`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_presentation_id_foreign` (`presentation_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C454C68271A51189` (`passager_id`),
  ADD KEY `IDX_C454C6829F2BFB7A` (`vol_id`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `view_delais`
--
ALTER TABLE `view_delais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `view_delais_presentation_id_foreign` (`presentation_id`);

--
-- Index pour la table `vol`
--
ALTER TABLE `vol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3111D10B79CDDA17` (`Avion_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avion`
--
ALTER TABLE `avion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `matriel`
--
ALTER TABLE `matriel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `presentations`
--
ALTER TABLE `presentations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `presentations_views`
--
ALTER TABLE `presentations_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `produitferme`
--
ALTER TABLE `produitferme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `produitouvert`
--
ALTER TABLE `produitouvert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `view_delais`
--
ALTER TABLE `view_delais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `vol`
--
ALTER TABLE `vol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `groupe_personnel`
--
ALTER TABLE `groupe_personnel`
  ADD CONSTRAINT `groupe_personnel_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groupe_personnel_personnel_id_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `personnels` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groupe_presentation`
--
ALTER TABLE `groupe_presentation`
  ADD CONSTRAINT `groupe_presentation_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groupe_presentation_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personnel_presentation`
--
ALTER TABLE `personnel_presentation`
  ADD CONSTRAINT `personnel_presentation_personnel_id_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `personnels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `personnel_presentation_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `presentations_views`
--
ALTER TABLE `presentations_views`
  ADD CONSTRAINT `presentations_views_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `view_delais`
--
ALTER TABLE `view_delais`
  ADD CONSTRAINT `view_delais_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
