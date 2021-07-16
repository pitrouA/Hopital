-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 28 Décembre 2016 à 21:48
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `clinique`
--

-- --------------------------------------------------------

--
-- Structure de la table `compteinterne`
--

CREATE TABLE `compteinterne` (
  `NSS` int(8) NOT NULL,
  `argent` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compteinterne`
--

INSERT INTO `compteinterne` (`NSS`, `argent`, `date`) VALUES
(56231489, 500, '2016-12-03'),
(56231489, -200, '2016-11-08'),
(100, 100, '2016-12-28'),
(100, 0, '2016-12-28'),
(100, -100, '2016-12-28'),
(100, 200, '2016-12-28'),
(100, -100, '2016-12-28'),
(100, 100, '2016-12-28'),
(100, 400, '2016-12-28'),
(100, -250, '2016-12-28');

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE `medecins` (
  `nom` varchar(12) NOT NULL,
  `login` varchar(12) NOT NULL,
  `mdp` varchar(12) NOT NULL,
  `type` varchar(12) NOT NULL,
  `specialite` text NOT NULL,
  `idMedecin` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `medecins`
--

INSERT INTO `medecins` (`nom`, `login`, `mdp`, `type`, `specialite`, `idMedecin`) VALUES
('guimauve', 'guim', 'muscle', 'medecin', 'specialiste des os', 1),
('tartenpion', 'tarte', 'enpion', 'medecin', 'specialiste du coxys', 2),
('Sucess', 'Sucess', 'Sucess', 'medecin', 'Sucess', 5);

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

CREATE TABLE `motif` (
  `motif` text NOT NULL,
  `prix` text NOT NULL,
  `pieces` text NOT NULL,
  `reccomandations` text NOT NULL,
  `idMotif` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `motif`
--

INSERT INTO `motif` (`motif`, `prix`, `pieces`, `reccomandations`, `idMotif`) VALUES
('operation de la carotide', '200', 'Une Brique', 'de preference avec mr Guimauve', 1),
('operation du coxys', '185', 'Un bâton en béton', 'de preference avec mr Tartenpion', 2),
('unActe', '1000', 'carte vitale', '', 8),
('Sucess', '250', 'Sucess, ', 'Sucess', 9);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `nomPatient` varchar(15) NOT NULL,
  `NSS` int(8) NOT NULL,
  `dateDeNaissance` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `numTel` int(10) UNSIGNED ZEROFILL NOT NULL,
  `mail` varchar(30) NOT NULL,
  `profession` text NOT NULL,
  `situationFamiliale` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `patient`
--

INSERT INTO `patient` (`nomPatient`, `NSS`, `dateDeNaissance`, `adresse`, `numTel`, `mail`, `profession`, `situationFamiliale`) VALUES
('berger bob', 56231489, '2016-12-07', '189 rue st andré', 0001456237, 'bob.berger@mail.com', 'ouvrier', 'marié'),
('marie antoinett', 89562314, '2012-12-08', '111 rue du veau', 0236363636, 'marie.antoinette@mail.com', 'couturière', 'celibataire'),
('Sucess', 100, '2016-12-28', 'Sucess', 0101010101, 'Sucess.sucess@sucess.sucess', 'Sucess', 'Sucess');

-- --------------------------------------------------------

--
-- Structure de la table `personnelsauxiliaires`
--

CREATE TABLE `personnelsauxiliaires` (
  `nom` text NOT NULL,
  `login` text NOT NULL,
  `mdp` text NOT NULL,
  `type` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnelsauxiliaires`
--

INSERT INTO `personnelsauxiliaires` (`nom`, `login`, `mdp`, `type`) VALUES
('chefi', 'chef', 'jesuislechef', 'chef'),
('prudente', 'timide', 'hotesse', 'hotesse d\'accueil');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `nom` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `piece`
--

INSERT INTO `piece` (`nom`, `id`) VALUES
('carnet de santé', 3),
('carte vitale', 4),
('Sucess', 5);

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `idMedecin` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `heure` time NOT NULL,
  `idRDV` int(11) DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `planning`
--

INSERT INTO `planning` (`idMedecin`, `date`, `heure`, `idRDV`, `blocked`) VALUES
(1, '2016-12-03', '06:00:00', 0, 1),
(1, '2016-12-03', '04:00:00', 0, 1),
(5, '2016-12-28', '18:00:00', 0, 1),
(1, '2016-12-03', '18:00:00', 0, 1),
(1, '2016-12-03', '01:00:00', 0, 1),
(1, '2016-12-03', '21:00:00', 0, 1),
(1, '2016-12-03', '20:00:00', 0, 1),
(1, '2016-12-03', '09:00:00', 0, 1),
(1, '2016-12-03', '11:00:00', 0, 1),
(1, '2016-12-03', '12:00:00', 0, 1),
(1, '2016-12-28', '18:00:00', 0, 1),
(1, '2016-12-28', '10:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `intitule` text NOT NULL,
  `idMedecin` int(8) NOT NULL,
  `NSSpatient` int(8) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `rdvFini` tinyint(1) NOT NULL,
  `statut` text NOT NULL,
  `compteRendu` text NOT NULL,
  `suivi` text NOT NULL,
  `prescription` text NOT NULL,
  `idMotif` text NOT NULL,
  `idRDV` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rdv`
--

INSERT INTO `rdv` (`intitule`, `idMedecin`, `NSSpatient`, `date`, `heure`, `rdvFini`, `statut`, `compteRendu`, `suivi`, `prescription`, `idMotif`, `idRDV`) VALUES
('une operation urgente', 1, 56231489, '2016-12-03', '00:00:00', 0, 'urgent', '', '', '', '1', 1),
('operation du coxys', 2, 89562314, '2016-12-12', '00:00:00', 0, 'gfdssd', 'hfddsgf', '', '', '2', 2),
('operation sans importance', 1, 56231489, '2016-12-21', '00:00:00', 0, 'dhvcxhfh', 'hbfcghfd', '', '', '1', 3),
('operation de la carotide', 2, 56231489, '2017-01-01', '08:00:00', 0, 'Attente de Paiement', ' ', '', '', '1', 7),
('unActe', 1, 56231489, '2016-12-26', '00:00:00', 0, 'Attente de Paiement', ' ', '', '', '8', 16),
('operation de la carotide', 1, 56231489, '2016-12-03', '03:00:00', 0, 'Attente de Paiement', ' ', '', '', '1', 15),
('unActe', 1, 56231489, '2016-12-27', '12:00:00', 0, 'Attente de Paiement', ' ', '', '', '8', 14),
('operation de la carotide', 1, 56231489, '2016-12-25', '01:00:00', 0, 'Attente de Paiement', ' ', '', '', '1', 13),
('operation de la carotide', 1, 56231489, '2016-12-25', '00:00:00', 0, 'Attente de Paiement', ' ', '', '', '1', 12),
('operation de la carotide', 1, 56231489, '2016-12-26', '14:00:00', 0, 'Attente de Paiement', ' ', '', '', '1', 17),
('operation de la carotide', 1, 56231489, '2016-12-03', '02:00:00', 0, 'Attente de Paiement', ' ', '', '', '1', 18),
('unActe', 1, 56231489, '2016-12-03', '05:00:00', 0, 'Attente de Paiement', ' ', '', '', '8', 19),
('operation de la carotide', 1, 56231489, '2016-12-28', '16:00:00', 1, 'Attente de Paiement', 'a', 'Aucun suivi ', 'Aucune prescription ', '1', 20),
('Sucess', 5, 100, '2016-12-28', '16:00:00', 0, 'Paye', ' ', ' ', ' ', '9', 23),
('Sucess', 5, 100, '2016-12-28', '04:00:00', 1, 'Paye', 'Sucess', 'Sucess', 'Sucess', '9', 24);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`idMedecin`);

--
-- Index pour la table `motif`
--
ALTER TABLE `motif`
  ADD PRIMARY KEY (`idMotif`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`nomPatient`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`idRDV`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `medecins`
--
ALTER TABLE `medecins`
  MODIFY `idMedecin` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `motif`
--
ALTER TABLE `motif`
  MODIFY `idMotif` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `idRDV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
