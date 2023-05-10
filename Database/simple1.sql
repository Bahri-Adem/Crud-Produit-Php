-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 mai 2023 à 12:46
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `simple1`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `code` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`code`, `nom`) VALUES
(1, 'flowers'),
(2, 'roses'),
(3, 'Violets'),
(4, 'bouquets');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `code` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `prix` float NOT NULL,
  `qte` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `code_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`code`, `designation`, `prix`, `qte`, `image`, `code_categorie`) VALUES
(26, 'Jardinière', 52, 15, 'fifth.jfif', 4),
(27, 'Opale', 34, 25, 'bouquet.jpg', 2),
(28, 'Innocence', 50, 20, 'third.jfif', 2),
(29, 'Jardinière ', 40, 15, 'first.jpg', 2),
(30, 'Opale', 34, 25, 'second.jpg', 3),
(31, 'Roses tendresse', 52, 10, 'fourth.jfif', 1);

-- --------------------------------------------------------

--
-- Structure de la table `simple1`
--

CREATE TABLE `simple1` (
  `username` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `simple1`
--

INSERT INTO `simple1` (`username`, `name`, `password`) VALUES
('adem.bahri', 'adem', 'password1'),
('', '', ''),
('wadhah.mabrouk', 'wadhah', 'password2'),
('maher.bouchnak', 'maher', 'password3');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD KEY `code` (`code`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`code`),
  ADD KEY `produit_ibfk_1` (`code_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`code_categorie`) REFERENCES `categorie` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
