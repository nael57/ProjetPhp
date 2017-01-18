-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: mysql2.paris1.alwaysdata.com
-- Generation Time: Jan 18, 2017 at 09:31 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `giftbox54_projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cadeau`
--

CREATE TABLE IF NOT EXISTS `Cadeau` (
  `idca` varchar(255) NOT NULL,
  `id_coffret` int(11) NOT NULL,
  PRIMARY KEY (`idca`),
  UNIQUE KEY `id_coffret` (`id_coffret`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cadeau`
--

INSERT INTO `Cadeau` (`idca`, `id_coffret`) VALUES
('F9744C3338231807', 38),
('8E3B488937FFE7C3', 39),
('42DCFC94C343E0E6', 40),
('477E70EC053F0F30', 41),
('265F4C83F01ED4CF', 43),
('48BEB1EBC1D5528D', 44),
('FDC81122970E9EBB', 47);

-- --------------------------------------------------------

--
-- Table structure for table `Cagnotte`
--

CREATE TABLE IF NOT EXISTS `Cagnotte` (
  `idcagnotte` int(11) NOT NULL AUTO_INCREMENT,
  `id_coffret` int(11) NOT NULL,
  `contribution` int(11) NOT NULL,
  `Lienparticipation` varchar(257) NOT NULL,
  `Liengestion` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`idcagnotte`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `Categorie`
--

CREATE TABLE IF NOT EXISTS `Categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Categorie`
--

INSERT INTO `Categorie` (`id`, `nom`) VALUES
(1, 'Attention'),
(2, 'Activité'),
(3, 'Restauration'),
(4, 'Hébergement');

-- --------------------------------------------------------

--
-- Table structure for table `Coffret`
--

CREATE TABLE IF NOT EXISTS `Coffret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `mail` varchar(80) DEFAULT NULL,
  `commentaire` varchar(500) DEFAULT NULL,
  `modePaiement` varchar(20) DEFAULT NULL,
  `lien` varchar(100) NOT NULL,
  `etat` varchar(11) NOT NULL,
  `mdp` varchar(257) NOT NULL,
  `etatcadeau` varchar(255) DEFAULT NULL,
  `dateouverture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `Coffret`
--

INSERT INTO `Coffret` (`id`, `nom`, `prenom`, `mail`, `commentaire`, `modePaiement`, `lien`, `etat`, `mdp`, `etatcadeau`, `dateouverture`) VALUES
(33, 'hgbfvfbhncxf', 'frgtrhy', 'zrgesh@g.fr', 'sfgdsthdyujhdygfd', 'classique', 'A33EBC4C9B1BCB9A', 'paye', '', NULL, '0000-00-00'),
(34, 'rzgteytur', 'gtryh', 'aretzgf@aeqg.r', 'fgsdthfygsf', 'classique', 'ABD7CECE8BA713FD', 'paye', '', NULL, '0000-00-00'),
(35, 'nhsfbgvwxcvfbgsnhd', 'fsdv', 'grafg@htzh.fr', 'azrgaeh', 'classique', '59970199BE231C7B', 'paye', '', NULL, '0000-00-00'),
(36, 'Pierre', 'Pasckoe', 'contact.securdent@gmail.com', 'Pascoke ferme ta gueule', 'classique', '5539520E75103154', 'paye', '', NULL, '0000-00-00'),
(37, 'Pierre', 'Pasckoe', 'contact.securdent@gmail.com', '', 'classique', '4A41B3217850C26D', 'paye', '', NULL, '0000-00-00'),
(38, 'fzgqfzqf<qg', 'iohrqehgh', 'contact.securdent@gmail.com', 'test', 'classique', 'F60C13047C352910', 'paye', '', NULL, '0000-00-00'),
(39, 'khbp', 'ppiv', 'igfge@gh.fr', 'gitjeobdhwjb', 'classique', 'E21E9BF5369B0F9B', 'paye', '', NULL, '0000-00-00'),
(40, 'trgnq', 'jkbeojn', 'haeqh@ta.fr', 'ça me saoule', 'classique', '9379563C8657586B', 'paye', '$2y$10$XMPiWYoBX1p.6fFHJGN2KuCEgRCpEpn2x/QHVPwWQSWrVZE3/6N2.', NULL, '0000-00-00'),
(41, 'gaggaegesg', 'qggddq', 'kbgbgpqhj@gzr.gta', 'Ceci est un test pour afficher le commentaire', 'classique', 'D23B9088BCCC05DB', 'paye', '', 'Ouvert', 'Tuesday 17th of January 2017 11:13:55 PM'),
(42, NULL, NULL, NULL, NULL, 'cagnotte', '', 'paye', '', NULL, NULL),
(43, 'yhrsgqrg', 'qgdh', 'gdqhqh@hgqh.r', '', 'classique', '9686B162D3CF5F2D', 'paye', '', 'fermé', NULL),
(44, 'tehh', 'hethr', 'hgzheh@gztehg.rf', 'grshtjuriyjhdxbgfvwxc', 'classique', '8BCCA2D874853B4E', 'paye', 'klQyaPTHpXqAA', 'Ouvert', 'Wednesday 18th of January 2017 03:14:20 PM'),
(45, NULL, NULL, NULL, NULL, 'cagnotte', '', 'en cours', '', NULL, NULL),
(46, NULL, NULL, NULL, NULL, 'cagnotte', '', 'paye', '', NULL, NULL),
(47, 'Bouzaza', 'Nael', 'admin@admin.admin', 'Salut c''est Nael', 'classique', '1964338DFDE5A15A', 'paye', '', 'fermé', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Contient`
--

CREATE TABLE IF NOT EXISTS `Contient` (
  `id_coo` int(11) NOT NULL,
  `id_pre` int(11) NOT NULL,
  PRIMARY KEY (`id_coo`,`id_pre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Contient`
--

INSERT INTO `Contient` (`id_coo`, `id_pre`) VALUES
(8, 7),
(8, 24),
(9, 7),
(9, 10),
(9, 24),
(10, 1),
(11, 7),
(11, 12),
(11, 24),
(12, 10),
(12, 23),
(12, 24),
(12, 27),
(13, 3),
(13, 7),
(13, 10),
(13, 23),
(13, 24),
(14, 7),
(14, 16),
(14, 23),
(14, 24),
(15, 24),
(16, 2),
(16, 4),
(17, 2),
(17, 3),
(17, 6),
(17, 7),
(17, 12),
(17, 16),
(17, 19),
(17, 20),
(17, 23),
(17, 24),
(18, 8),
(18, 17),
(18, 24),
(19, 19),
(19, 24),
(20, 6),
(20, 8),
(20, 9),
(20, 10),
(20, 17),
(20, 24),
(21, 7),
(21, 23),
(21, 24),
(22, 4),
(23, 7),
(23, 24),
(23, 25),
(24, 1),
(24, 2),
(24, 4),
(25, 1),
(25, 2),
(25, 24),
(26, 1),
(27, 2),
(27, 8),
(27, 10),
(27, 24),
(28, 8),
(28, 24),
(29, 5),
(30, 23),
(31, 1),
(32, 1),
(32, 3),
(32, 24),
(33, 9),
(34, 24),
(35, 3),
(35, 23),
(36, 19),
(36, 24),
(37, 1),
(37, 24),
(38, 4),
(38, 23),
(39, 4),
(39, 6),
(40, 21),
(40, 24),
(41, 8),
(41, 27),
(42, 3),
(42, 15),
(42, 23),
(42, 24),
(43, 1),
(43, 5),
(44, 1),
(44, 5),
(45, 1),
(45, 24),
(46, 4),
(46, 15),
(46, 21),
(46, 24),
(47, 1),
(47, 2),
(47, 24);

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id`, `nom_utilisateur`, `mot_de_passe`, `type`) VALUES
(3, 'admin', 'klD2aXpfJ68U6', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `prestation`
--

CREATE TABLE IF NOT EXISTS `prestation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `descr` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `img` text NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `etat` varchar(255) NOT NULL DEFAULT 'actif',
  `sommevotes` int(11) NOT NULL DEFAULT '0',
  `nbvotes` int(11) NOT NULL DEFAULT '0',
  `moyenne` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `prestation`
--

INSERT INTO `prestation` (`id`, `nom`, `descr`, `cat_id`, `img`, `prix`, `etat`, `sommevotes`, `nbvotes`, `moyenne`) VALUES
(1, 'Champagne', 'Bouteille de champagne + flutes + jeux à gratter', 1, 'champagne.jpg', '20.00', 'actif', 0, 0, '0.00'),
(2, 'Musique', 'Partitions de piano à 4 mains', 1, 'musique.jpg', '25.00', 'actif', 14, 4, '3.50'),
(3, 'Exposition', 'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel', 2, 'poirelregarder.jpg', '14.00', 'actif', 0, 0, '0.00'),
(4, 'Goûter', 'Goûter au FIFNL', 3, 'gouter.jpg', '20.00', 'actif', 3, 1, '3.00'),
(5, 'Projection', 'Projection courts-métrages au FIFNL', 2, 'film.jpg', '10.00', 'actif', 5, 1, '5.00'),
(6, 'Bouquet', 'Bouquet de roses et Mots de Marion Renaud', 1, 'rose.jpg', '16.00', 'actif', 0, 0, '0.00'),
(7, 'Diner Stanislas', 'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)', 3, 'bonroi.jpg', '60.00', 'actif', 0, 0, '0.00'),
(8, 'Origami', 'Baguettes magiques en Origami en buvant un thé', 3, 'origami.jpg', '12.00', 'actif', 0, 0, '0.00'),
(9, 'Livres', 'Livre bricolage avec petits-enfants + Roman', 1, 'bricolage.jpg', '24.00', 'actif', 0, 0, '0.00'),
(10, 'Diner  Grand Rue ', 'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)', 3, 'grandrue.jpg', '59.00', 'actif', 0, 0, '0.00'),
(11, 'Visite guidée', 'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas', 2, 'place.jpg', '11.00', 'actif', 0, 0, '0.00'),
(12, 'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil', 1, 'bijoux.jpg', '29.00', 'actif', 0, 0, '0.00'),
(13, 'Opéra', 'Concert commenté à l’Opéra', 2, 'opera.jpg', '15.00', 'actif', 0, 0, '0.00'),
(14, 'Thé Hotel de la reine', 'Thé de debriefing au bar de l’Hotel de la reine', 3, 'hotelreine.gif', '5.00', 'actif', 0, 0, '0.00'),
(15, 'Jeu connaissance', 'Jeu pour faire connaissance', 2, 'connaissance.jpg', '6.00', 'actif', 0, 0, '0.00'),
(16, 'Diner', 'Diner (Apéritif / Plat / Vin / Dessert / Café)', 3, 'diner.jpg', '40.00', 'actif', 0, 0, '0.00'),
(17, 'Cadeaux individuels', 'Cadeaux individuels sur le thème de la soirée', 1, 'cadeaux.jpg', '13.00', 'actif', 0, 0, '0.00'),
(18, 'Animation', 'Activité animée par un intervenant extérieur', 2, 'animateur.jpg', '9.00', 'actif', 0, 0, '0.00'),
(19, 'Jeu contacts', 'Jeu pour échange de contacts', 2, 'contact.png', '5.00', 'actif', 0, 0, '0.00'),
(20, 'Cocktail', 'Cocktail de fin de soirée', 3, 'cocktail.jpg', '12.00', 'actif', 0, 0, '0.00'),
(21, 'Star Wars', 'Star Wars - Le Réveil de la Force. Séance cinéma 3D', 2, 'starwars.jpg', '12.00', 'actif', 9, 2, '4.50'),
(22, 'Concert', 'Un concert à Nancy', 2, 'concert.jpg', '17.00', 'actif', 0, 0, '0.00'),
(23, 'Appart Hotel', 'Appart’hôtel Coeur de Ville, en plein centre-ville', 4, 'apparthotel.jpg', '56.00', 'actif', 0, 0, '0.00'),
(24, 'Hôtel d''Haussonville', 'Hôtel d''Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas', 4, 'hotel_haussonville_logo.jpg', '169.00', 'actif', 0, 0, '0.00'),
(25, 'Boite de nuit', 'Discothèque, Boîte tendance avec des soirées à thème & DJ invités', 2, 'boitedenuit.jpg', '32.00', 'actif', 0, 0, '0.00'),
(26, 'Planètes Laser', 'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.', 2, 'laser.jpg', '15.00', 'actif', 0, 0, '0.00'),
(27, 'Fort Aventure', 'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l''élastique inversé, Toboggan géant... et bien plus encore.', 2, 'fort.jpg', '25.00', 'actif', 0, 0, '0.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
