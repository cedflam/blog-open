-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 jan. 2020 à 08:49
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
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_pk_article` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `sentence` varchar(500) NOT NULL,
  `content_article` text NOT NULL,
  `date_article` datetime NOT NULL,
  `id_author` int(11) NOT NULL,
  `valid_article` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_pk_article`),
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_pk_article`, `title`, `sentence`, `content_article`, `date_article`, `id_author`, `valid_article`) VALUES
(25, '                Meilleurs voeux 2020 !  !!            ', '																																																																																																																																																Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo dicta\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								', '																																																																																																																																																Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo dicta quod eaque repellendus nam quis voluptatum recusandae, facilis in quas impedit nisi nihil non libero rerum quasi. Natus neque fugit temporibus voluptatibus est laudantium cum iusto necessitatibus quis odit eveniet et, ut delectus non, omnis provident consequatur nostrum ratione! Nobis molestias similique commodi dignissimos hic odit quae temporibus earum magni dolorum quos eos nam dolore, ad iste iusto laudantium voluptatibus sapiente necessitatibus itaque a unde distinctio. Vitae fugiat, quos iste velit ea veniam alias est molestiae reprehenderit illum labore accusamus non nostrum neque voluptatem nulla voluptate earum, totam rerum maxime laborum odio debitis excepturi? Commodi est obcaecati possimus, odio repudiandae tempore eius debitis natus perspiciatis!\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								', '2020-01-13 18:04:48', 43, 1),
(26, '    Le web en 2020 !    ', '																																				Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo \r\n								\r\n								\r\n								\r\n								', '																																				Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo dicta quod eaque repellendus nam quis voluptatum recusandae, facilis in quas impedit nisi nihil non libero rerum quasi. Natus neque fugit temporibus voluptatibus est laudantium cum iusto necessitatibus quis odit eveniet et, ut delectus non, omnis provident consequatur nostrum ratione! Nobis molestias similique commodi dignissimos hic odit quae temporibus earum magni dolorum quos eos nam dolore, ad iste iusto laudantium voluptatibus sapiente necessitatibus itaque a unde distinctio. Vitae fugiat, quos iste velit ea veniam alias est molestiae reprehenderit illum labore accusamus non nostrum neque voluptatem nulla voluptate earum, totam rerum maxime laborum odio debitis excepturi? Commodi est obcaecati possimus, odio repudiandae tempore eius debitis natus perspiciatis!\r\n								\r\n								\r\n								\r\n								', '2020-01-14 08:12:47', 44, 1),
(27, '      Que faire sans la fibre ??   ', '																																																						Lorem ipsum dolor sit amet consectetur, adipisicing elit.\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								', '																																																						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dolore dolores iste nemo \r\n								\r\n								\r\n								\r\n								\r\n								\r\n								', '2020-01-13 18:05:42', 45, 1),
(28, '      Les règles d\'or d\'un site fonctionnel  ', '																																																						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci iusto\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								', '																																																						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci iusto, amet fugit aliquid ea obcaecati unde libero culpa optio nisi magnam omnis eveniet quas labore ad ipsa mollitia quam alias voluptatum eligendi tempore excepturi sit sunt. Ex neque facilis ad laudantium fugiat ullam, rem, laboriosam quia totam mollitia tempora! Nisi et quod accusamus, repudiandae eius, dolore soluta suscipit ut veritatis a aliquid! Recusandae doloremque asperiores nam molestiae quibusdam sit quisquam quam exercitationem voluptatem excepturi optio voluptatum, repudiandae nostrum debitis sapiente. Et, itaque corporis. Est soluta voluptate sed placeat modi recusandae voluptatum aut voluptatibus, omnis delectus, ex fugit aliquid, ullam iure!\r\n								\r\n								\r\n								\r\n								\r\n								\r\n								', '2020-01-13 19:39:19', 45, 0);

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `id_pk_author` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `hash` varchar(300) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_pk_author`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`id_pk_author`, `firstName`, `lastName`, `hash`, `email`, `role`, `valid`) VALUES
(43, 'Cedric', 'Flamain', '$2y$10$XQ85V06l9BMIEckFh30oa.s3mnRGwOuCV89fBGOvD0xxQkZsW2TDe', 'cedflam@gmail.com', 'admin', 1),
(44, 'Fabien', 'Giraud', '$2y$10$.i2PicoR0mDy3Ma8k3eatulcbtF8Ziy3ISXXydwqZSNm5i1LvYeyq', 'fab@gmail.com', 'user', 1),
(45, 'Sandrine', 'Gumez', '$2y$10$LUAPc.36qGQTyf7KFjV1/u8XpUEhovxpPzaJfPd5ZNcYogXavSk6a', 'dine@gmail.com', 'user', 1),
(71, 'Emilie', 'BUINOUD', '$2y$10$0a357W2yBzehv6ZkVbP8h.H4Xt8e77JXrEFDWc2OHy1koGVP2Q.TK', 'milie@gmail.com', 'user', 0),
(72, 'admin', 'admin', '$2y$10$R1tVELB9r9KAsTLiebW5vubOUy/Xv3j6UGab8N.1K1uperuEZcUuW', 'admin@admin.fr', 'admin', 1),
(73, 'user', 'user', '$2y$10$OSAp6PKABiwsTuG36h2Lvujpk7W3aZ8cPcQz9kBl0diBygvTZrNhi', 'user@user.fr', 'user', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_pk_comment` int(11) NOT NULL AUTO_INCREMENT,
  `content_comment` varchar(500) NOT NULL,
  `date_comment` datetime NOT NULL,
  `name_comment` varchar(255) NOT NULL,
  `valid_comment` tinyint(1) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_author_comment` int(11) NOT NULL,
  PRIMARY KEY (`id_pk_comment`),
  KEY `fk_id_article` (`id_article`),
  KEY `fk_author_comment` (`id_author_comment`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_pk_comment`, `content_comment`, `date_comment`, `name_comment`, `valid_comment`, `id_article`, `id_author_comment`) VALUES
(55, 'Merci ! Bonne année !', '2020-01-14 09:44:53', 'Sandrine Gumez', 1, 25, 45),
(56, 'A toi aussi !', '2020-01-14 09:45:13', 'Fabien Giraud', 0, 25, 44),
(57, 'Bonne question !!!', '2020-01-14 09:45:39', 'Fabien Giraud', 1, 27, 44);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_id_author` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_pk_author`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_id_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_pk_article`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
