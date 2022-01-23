-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 23 jan. 2022 à 19:18
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mywishlist`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_hash` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`id`, `username`, `email`, `hash`, `nom`, `prenom`, `token_hash`, `token_expire`) VALUES
(3, 'zefzef', '', '$2y$10$dtJK5zCQBa8FmRN/vu5TJ.jDghSmeiyx7MXol/WLYr7FEp3EOlF.C', 'aaa', 'aaa', NULL, '2022-01-22 16:19:34'),
(8, 'ezzeze', 'zefzef@free.fr', '$2y$10$c/WWQ4E1xkHTY1QFrAIeCe.m08L5rzSCl8TCS1GM8MSHzEb6qC1VW', 'zefze', 'zefze', NULL, '2022-01-22 16:21:46'),
(9, 'zzfefze', 'zeefzzeffez', '$2y$10$C9H2vCivK.lo8I/sCBLY/eTieY82fDijb0pACicoMDeaqRegdI7tm', 'ff', 'ff', '7ede0e85ef4138b5a6068ccbe76c5aeae9da7bf8b3d44c65565238a7c1bab624990a62c454962ec3e4e064dccafe9285580d1fe61af94697d92a836f4633e72916dd9d1c5a5bc867ff801ae5e044311904c725b8ef689a2c10d4b468ffaeda9c728e2bdbf8df9603cc0e534cc72aa02e7ff8fa876e2ab676006e162d7ae3afee', '2022-01-22 16:23:52'),
(10, 'aaass', 'as', '$2y$10$QeUCKVZQrqawCjfUFQQmWuF77MDxR2BWE/GdCK1dLWWpaWk0AlSYa', 'asas', 'asas', 'ddab51b4e9a08cd4d9a3eff442e1d86e834f2454067f438033c3f67d1302b78556ea0fafd2802d7568ea04f3cae726a8bade695c313a288e3c28fbe173342c723b84e2b89c88051795d3eaf200a35cc4e4a49267cd781dc14f84710b621b9cbc0ff049f0c0d791840b0de3f038086f8228b77f3c76db99dac3bf13a6f0a78cdd', '2022-01-22 16:26:18'),
(11, 'PEROT', 'sweetmat100ii@gmail.com', '$2y$10$O/jzQRo9al.nNdLRiZy.Ne6KzISbWYirgNNu1a6JyqAr5xu9/9HxK', 'Mathis PEROT', 'Mathis', NULL, '2022-01-23 11:56:52'),
(13, 'sweet', 'sweetmat100@gmail.com', '$2y$10$4./caATLqMn0QHi6sJToWeOe7iwzN49UFJc/mLyx1bkG.6TK1LKwu', 'prt', 'mm', NULL, '2022-01-23 15:22:46');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `liste_id` int(11) NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descr` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif` decimal(10,2) DEFAULT NULL,
  `account_id_reserv` int(11) DEFAULT NULL,
  `messageReservation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cagnotte` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `num` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration` date NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `public` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`num`, `user_id`, `titre`, `description`, `expiration`, `token`, `public`) VALUES
(5, 13, 'Je veux ca', 'lol', '2022-08-21', '1EPMSv5R', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liste_id` (`liste_id`),
  ADD KEY `account_id_reserv` (`account_id_reserv`);

--
-- Index pour la table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`num`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`liste_id`) REFERENCES `liste` (`num`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`account_id_reserv`) REFERENCES `account` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `liste`
--
ALTER TABLE `liste`
  ADD CONSTRAINT `liste_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
