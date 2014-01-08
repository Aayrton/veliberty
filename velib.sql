-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 13 Juin 2013 à 12:29
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `velib`
--

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `favorites`
--

INSERT INTO `favorites` (`id`, `name`, `user_id`, `address`) VALUES
(1, '01023 - ANDRE MALRAUX MUSEE DU LOUVRE', 8, '165 RUE SAINT HONORE - 75001 PARIS'),
(9, '01016 - OPERA PYRAMIDES', 2, '27 RUE THERESE - 75001 PARIS'),
(10, '07005 - BAC', 8, 'FACE 2 BOULEVARD RASPAIL - 75007 PARIS'),
(12, '10115 - DODU', 15, '1 - 3 RUE DES ECLUSES SAINT MARTIN - 75010 PARIS'),
(13, '10017 - GARE DE L''EST SAINT LAURENT', 15, '1 RUE DE LA FIDELITE - 75010 PARIS'),
(15, '12008 - HECTOR MALOT', 16, '15 BIS RUE HECTOR MALOT - 75012 PARIS'),
(16, '08115 - BASSANO', 16, '10 RUE VERNET - 75008 PARIS');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `register_date` date NOT NULL,
  `facebook_id` bigint(20) NOT NULL,
  `img_url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `email`, `register_date`, `facebook_id`, `img_url`) VALUES
(2, 'ayrton', '5259b3fe5915a04a758767ec1c184782c8b60cb0', 'ayrton@hotmail.fr', '2012-12-12', 0, ''),
(3, 'jack', '596727c8a0ea4db3ba2ceceedccbacd3d7b371b8', 'jack@hotmail.fr', '2012-12-13', 0, ''),
(4, 'patou', '20cc03c1009ed428db6f7e1627c07bab7d7771dc', 'patou@hotmail.fr', '2013-03-13', 0, ''),
(8, 'Ayrton Ahou', 'f14a2a8e092924d358f17af5a45d5eec261fe903', '', '2013-03-13', 1478678333, 'http://profile.ak.fbcdn.net/hprofile-ak-ash4/371696_1478678333_861115173_n.jpg'),
(10, 'singe', '4967907e20d8f68f7646997af763a6bd942eff4e', 'singe@singe.fr', '2013-03-15', 0, 'bootstrap/img/user.png'),
(11, 'patrick', 'cbb7353e6d953ef360baf960c122346276c6e320', 'patrick@hotmail.fr', '2013-03-20', 0, 'bootstrap/img/user.png'),
(12, 'Valentin Chong', '0cf2d94eb8d3b917867c3823993a95e8a67443ab', '', '2013-03-26', 1369656584, 'http://profile.ak.fbcdn.net/hprofile-ak-snc6/275924_1369656584_774929073_n.jpg'),
(13, 'Tracy Ahou', '3825028f6346979fbaad30cb22da0cc392a37f0a', '', '2013-06-06', 100000419504456, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash2/273601_100000419504456_726920506_n.jpg'),
(14, 'Marie Felicioli', 'be584a43a21cc4bf0d1eeb2909fce380692b091c', '', '2013-06-06', 612065591, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn2/187165_612065591_535328817_n.jpg'),
(15, 'laurent', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'laurent.brd@hotmail.fr', '2013-06-06', 0, 'bootstrap/img/user.png'),
(16, 'victor', '5bc61b1309c76fcc23f9a71e9f137ce3006b6f72', 'vic.delaunay@gmail.com', '2013-06-10', 0, 'bootstrap/img/user.png'),
(17, 'chris', '8cb2237d0679ca88db6464eac60da96345513964', 'drc.delaunay@orange.fr', '2013-06-10', 0, 'bootstrap/img/user.png'),
(18, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@mail.fr', '2013-06-13', 0, 'bootstrap/img/user.png'),
(19, 'bobby', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'bob@mail.fr', '2013-06-13', 0, 'bootstrap/img/user-icon.png'),
(20, 'Victor Dlny', '997ee26af268586eb4dc6ffe8a36ddf3773b0286', '', '2013-06-13', 1040445367, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn2/274203_1040445367_441342540_n.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
