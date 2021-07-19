-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 19 juil. 2021 à 07:13
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formation_members`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `secret` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `creation_date`, `secret`) VALUES
(1, 'Lunalya', 'Bout-chu@hotmail.fr', 'aq100b917fdf09ce34585403a78b2d70fc671b873dc25', '2021-06-04 14:18:48', 'da39a3ee5e6b4b0d3255bfef95601890afd8070916228091281622809128'),
(2, '  Annette', 'test@test.com', 'aq100b917fdf09ce34585403a78b2d70fc671b873dc25', '2021-06-04 14:33:30', 'da39a3ee5e6b4b0d3255bfef95601890afd8070916228100101622810010'),
(8, 'Lorenzo', 'adresse@ad.com', 'aq10d467c11c1f788a43266782aac388b66b0f2255125', '2021-06-28 13:39:42', 'e7553dd2e9fb702514401f0cbd752de0d3ccd88f16248803821624880382'),
(9, 'test', 'test@test.fr', 'aq100b917fdf09ce34585403a78b2d70fc671b873dc25', '2021-06-28 13:44:23', 'e7a49068078594aa934a22ec1d3f2412b104f34116248806631624880663'),
(10, 'Lune', 'mooncraft@space.com', 'aq10d467c11c1f788a43266782aac388b66b0f2255125', '2021-06-28 13:51:14', '55b9f4d4294bcaffd456d3df59de55d8b7504ec016248810741624881074');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
