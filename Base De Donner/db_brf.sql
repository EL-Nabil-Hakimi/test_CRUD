-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3307
-- Généré le : lun. 27 nov. 2023 à 09:45
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_brf`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`categoryID`, `CategoryName`) VALUES
(14, 'SPORT'),
(15, 'MUSIC');

-- --------------------------------------------------------

--
-- Structure de la table `project1`
--

CREATE TABLE `project1` (
  `ProjectID` int(11) NOT NULL,
  `ProjectName` varchar(50) NOT NULL,
  `DescriptionProject` text NOT NULL,
  `Date_Start` date NOT NULL,
  `Date_End` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ressource1`
--

CREATE TABLE `ressource1` (
  `ResourceID` int(11) NOT NULL,
  `subcategoryID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `squadID` int(11) DEFAULT NULL,
  `projectID` int(11) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ressource1`
--

INSERT INTO `ressource1` (`ResourceID`, `subcategoryID`, `categoryID`, `squadID`, `projectID`, `Nom`) VALUES
(15, NULL, NULL, NULL, NULL, 'pl'),
(16, 20, 14, NULL, NULL, 'yyy'),
(17, NULL, NULL, NULL, NULL, 'RESOUCE 1');

-- --------------------------------------------------------

--
-- Structure de la table `squad1`
--

CREATE TABLE `squad1` (
  `id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `squad1`
--

INSERT INTO `squad1` (`id`, `Nom`, `userID`, `ProjectID`) VALUES
(7, 'Squad1A2', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

CREATE TABLE `sub_category` (
  `SubCategoryID` int(11) NOT NULL,
  `SubCategoryName` varchar(50) NOT NULL,
  `categoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`SubCategoryID`, `SubCategoryName`, `categoryID`) VALUES
(19, 'Piano', NULL),
(20, 'FOOTBALL', 14),
(22, 'Guitar', NULL),
(23, 'Tinis ', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Userid` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `squadID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Userid`, `Nom`, `Prenom`, `Email`, `squadID`) VALUES
(1, 'Nabil', 'El Hakimi', 'NabilElhakimi2023@gmail.com', NULL),
(106, 'Nima', 'El Hraychi', 'Nima@gmail.com', NULL),
(110, 'Kahlid', 'Znouhi', 'Znouhu@N.N', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Index pour la table `project1`
--
ALTER TABLE `project1`
  ADD PRIMARY KEY (`ProjectID`);

--
-- Index pour la table `ressource1`
--
ALTER TABLE `ressource1`
  ADD PRIMARY KEY (`ResourceID`),
  ADD KEY `category_ID` (`subcategoryID`),
  ADD KEY `subcategory_ID` (`categoryID`),
  ADD KEY `squad_ID1` (`squadID`),
  ADD KEY `project_ID1` (`projectID`);

--
-- Index pour la table `squad1`
--
ALTER TABLE `squad1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ID` (`userID`),
  ADD KEY `Project_ID` (`ProjectID`);

--
-- Index pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`SubCategoryID`),
  ADD KEY `subcategoryID` (`categoryID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Userid`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `squad_ID` (`squadID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `project1`
--
ALTER TABLE `project1`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ressource1`
--
ALTER TABLE `ressource1`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `squad1`
--
ALTER TABLE `squad1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `SubCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ressource1`
--
ALTER TABLE `ressource1`
  ADD CONSTRAINT `category_ID` FOREIGN KEY (`subcategoryID`) REFERENCES `sub_category` (`SubCategoryID`),
  ADD CONSTRAINT `project_ID1` FOREIGN KEY (`projectID`) REFERENCES `project1` (`ProjectID`),
  ADD CONSTRAINT `squad_ID1` FOREIGN KEY (`squadID`) REFERENCES `squad1` (`id`),
  ADD CONSTRAINT `subcategory_ID` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Contraintes pour la table `squad1`
--
ALTER TABLE `squad1`
  ADD CONSTRAINT `Project_ID` FOREIGN KEY (`ProjectID`) REFERENCES `project1` (`ProjectID`),
  ADD CONSTRAINT `user_ID` FOREIGN KEY (`userID`) REFERENCES `user` (`Userid`);

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `subcategoryID` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `squad_ID` FOREIGN KEY (`squadID`) REFERENCES `squad1` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
