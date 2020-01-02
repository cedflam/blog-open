-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 02 jan. 2020 à 08:27
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
  PRIMARY KEY (`id_pk_article`),
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_pk_article`, `title`, `sentence`, `content_article`, `date_article`, `id_author`) VALUES
(2, 'Après la pluie vient le beau temps !', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero ad illo sint beatae perspiciatis asperiores!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum molestiae assumenda eius, non similique magnam reprehenderit ullam cupiditate laboriosam? Obcaecati labore itaque dolores corporis minus amet ratione nostrum accusamus! Itaque temporibus maxime magnam harum delectus perspiciatis ipsam nisi nobis sunt praesentium? Facere tempore, rerum at, odio voluptate facilis vero dolore explicabo consectetur dolorem laboriosam placeat nobis delectus aperiam perspiciatis eveniet unde temporibus in voluptates ex reprehenderit non. Totam, placeat ducimus deleniti accusamus optio natus at non, quibusdam, corporis consequatur unde doloremque ut voluptas eum vero. Voluptatibus totam at tempore repellendus blanditiis animi dolor ipsa corporis vitae similique fugit, hic eligendi pariatur, atque delectus optio fuga amet sit dolorem perspiciatis. Sint necessitatibus impedit quaerat aut maxime itaque obcaecati repudiandae sed corrupti architecto saepe repellat consectetur earum cum esse modi deserunt magni maiores dolor iste cupiditate illo libero, sit aspernatur! Consequuntur maiores enim ea distinctio, eius delectus neque nobis corporis itaque fugit!', '2019-12-19 15:59:01', 1),
(3, 'Les vaches et les coups de soleil !', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero ad illo sint beatae perspiciatis asperiores!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum molestiae assumenda eius, non similique magnam reprehenderit ullam cupiditate laboriosam? Obcaecati labore itaque dolores corporis minus amet ratione nostrum accusamus! Itaque temporibus maxime magnam harum delectus perspiciatis ipsam nisi nobis sunt praesentium? Facere tempore, rerum at, odio voluptate facilis vero dolore explicabo consectetur dolorem laboriosam placeat nobis delectus aperiam perspiciatis eveniet unde temporibus in voluptates ex reprehenderit non. Totam, placeat ducimus deleniti accusamus optio natus at non, quibusdam, corporis consequatur unde doloremque ut voluptas eum vero. Voluptatibus totam at tempore repellendus blanditiis animi dolor ipsa corporis vitae similique fugit, hic eligendi pariatur, atque delectus optio fuga amet sit dolorem perspiciatis. Sint necessitatibus impedit quaerat aut maxime itaque obcaecati repudiandae sed corrupti architecto saepe repellat consectetur earum cum esse modi deserunt magni maiores dolor iste cupiditate illo libero, sit aspernatur! Consequuntur maiores enim ea distinctio, eius delectus neque nobis corporis itaque fugit!', '2019-12-19 15:59:01', 1),
(4, 'Aller sur Mars en delta-plane ?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, ipsa corporis possimus alias sequi quaerat.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque quisquam, maiores ipsa ea praesentium sequi. Commodi, architecto voluptatem, perferendis modi quam voluptatum earum in dolores, itaque unde harum possimus. Eveniet hic quam magnam itaque veniam perspiciatis illo veritatis, voluptas dignissimos aperiam sit, facilis omnis earum dolores blanditiis eius libero officiis quisquam recusandae aliquid laborum architecto natus sequi? Ex consequatur voluptatum distinctio illum officia dolor qui sint error itaque ab consequuntur aut eos tempore sit animi dolorum, a vitae quod repudiandae aspernatur pariatur quidem deserunt quam illo? Dolorem fuga aspernatur neque fugit deleniti, mollitia voluptatibus autem rem tempora amet ipsam suscipit modi inventore recusandae itaque perferendis nobis! Eligendi et at corporis laborum reprehenderit minima odit recusandae necessitatibus autem minus odio nam aliquid placeat labore quasi qui dolorem temporibus cum, rerum voluptate molestias? Inventore obcaecati aperiam reprehenderit nisi ipsam minus sequi assumenda dignissimos vel nobis doloribus debitis tempore sunt ratione, sapiente aspernatur?', '2019-12-19 16:02:25', 2),
(5, '                Neil Armstrong toujours sur la lune ?                ', '																																																																																																																								Il semblerait que Neil Armstrong ne soit jamais revenu de la lune et qu\'un colis alimentaire parte de la terre chaque mois en direction de son camp de base.\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							', '																																																																																																																																Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque quisquam, maiores ipsa ea praesentium sequi. Commodi, architecto voluptatem, perferendis modi quam voluptatum earum in dolores, itaque unde harum possimus. Eveniet hic quam magnam itaque veniam perspiciatis illo veritatis, voluptas dignissimos aperiam sit, facilis omnis earum dolores blanditiis eius libero officiis quisquam recusandae aliquid laborum architecto natus sequi? Ex consequatur voluptatum distinctio illum officia dolor qui sint error itaque ab consequuntur aut eos tempore sit animi dolorum, a vitae quod repudiandae aspernatur pariatur quidem deserunt quam illo? Dolorem fuga aspernatur neque fugit deleniti, mollitia voluptatibus autem rem tempora amet ipsam suscipit modi inventore recusandae itaque perferendis nobis! Eligendi et at corporis laborum reprehenderit minima odit recusandae necessitatibus autem minus odio nam aliquid placeat labore quasi qui dolorem temporibus cum, rerum voluptate molestias? Inventore obcaecati aperiam reprehenderit nisi ipsam minus sequi assumenda dignissimos vel nobis doloribus debitis tempore sunt ratione, sapiente aspernatur?\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							', '2019-12-27 11:16:39', 1),
(6, 'Je mange des fleurs chaque matin !', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod dolor neque officia blanditiis, corporis voluptatum.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, illo. Doloremque minus perspiciatis quae consequuntur ratione laudantium nulla, alias, nemo, sed non repellat corrupti exercitationem excepturi minima odio nisi soluta iste distinctio facere! Porro sed mollitia nostrum natus laudantium ad accusamus. Nihil similique nostrum quaerat vitae ea, ipsa architecto quo obcaecati cum rerum dolorum ipsum quia earum enim ad maiores repudiandae est non minus porro alias. Nihil atque nostrum fugit corporis deleniti perspiciatis placeat nulla hic doloremque facere consequuntur sint suscipit, quos distinctio doloribus dolorem quaerat architecto harum. Voluptatum eaque commodi mollitia cum debitis laboriosam molestias illum, id nobis fuga!', '2019-12-19 16:04:52', 3),
(7, '                Salade de pissenlits revisitée !                ', '																																																																																																																																Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod dolor neque officia blanditiis, corporis voluptatum.\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							', '																																																																																																																																Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, illo. Doloremque minus perspiciatis quae consequuntur ratione laudantium nulla, alias, nemo, sed non repellat corrupti exercitationem excepturi minima odio nisi soluta iste distinctio facere! Porro sed mollitia nostrum natus laudantium ad accusamus. Nihil similique nostrum quaerat vitae ea, ipsa architecto quo obcaecati cum rerum dolorum ipsum quia earum enim ad maiores repudiandae est non minus porro alias. Nihil atque nostrum fugit corporis deleniti perspiciatis placeat nulla hic doloremque facere consequuntur sint suscipit, quos distinctio doloribus dolorem quaerat architecto harum. Voluptatum eaque commodi mollitia cum debitis laboriosam molestias illum, id nobis fuga!\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							', '2019-12-27 15:15:07', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`id_pk_author`, `firstName`, `lastName`, `hash`, `email`, `role`, `valid`) VALUES
(1, 'Cedric', 'Flamain', '$2y$10$h/4WrR.iA84jWJBG2r5t/.VGq/hDKly4HE4rXBaKYO8stq77viDd6', 'cedflam@gmail.com', 'admin', 1),
(2, 'Jean', 'Dupont', '$2y$10$h/4WrR.iA84jWJBG2r5t/.VGq/hDKly4HE4rXBaKYO8stq77viDd6', 'j.dupont@gmail.com', 'user', 1),
(3, 'Julie', 'Lescaux', '$2y$10$h/4WrR.iA84jWJBG2r5t/.VGq/hDKly4HE4rXBaKYO8stq77viDd6', 'jule@hotmail.fr', 'user', 1),
(32, 'Thibault', 'Chazottes', '$2y$10$tc1w5sDBftyRVmz1I5t5NOm4ARAM0HiPmN6xrLlcUdXmmLk9.StoW', 'thibault@gmail.com', 'admin', 0);

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
  `valid` tinyint(1) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id_pk_comment`),
  KEY `fk_id_article` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_pk_comment`, `content_comment`, `date_comment`, `name_comment`, `valid`, `id_article`) VALUES
(1, 'Ouai c\'est ça et pourquoi pas en vélo aussi ?', '2019-12-19 16:08:55', 'Bisounours', 1, 4),
(2, 'Sans dec tu en as d\'autres des nouvelles comme ça ?', '2019-12-19 16:08:55', 'SmallPoney', 1, 2),
(3, 'Hummm ! Avec un bon steak ça doit être délicieux !', '2019-12-19 16:11:28', 'Johnny', 1, 6),
(4, 'Ah ouai ! Je vais de ce pas chercher de la crème solaire à la pharmacie pour la mienne ! Merci !', '2019-12-19 16:11:28', 'Jean-claude l\'agriculteur', 1, 3),
(5, 'J\'en étais sur !', '2019-12-19 16:14:37', 'AstroMan', 1, 5),
(6, 'Beuuuurk ! Qu\'elle idée ! C\'est pas pour moi ! \r\n								', '2019-12-19 16:14:37', 'silhouette', 1, 7),
(12, 'ah pas mal ! je vais essayer de ce pas ! J\'en ai plein dans mon jardin !', '2019-12-28 15:11:16', 'cedflam', 1, 7);

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
