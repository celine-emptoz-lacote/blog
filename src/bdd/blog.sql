-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 15 juil. 2020 à 16:04
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

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
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `article`, `id_utilisateur`, `id_categorie`, `date`, `image`) VALUES
(1, 'Qu\'est-ce que HTML ?', 'HTML signifie « HyperText Markup Language » qu\'on peut traduire par « langage de balises pour l\'hypertexte ». Il est utilisé afin de créer et de représenter le contenu d\'une page web et sa structure. D\'autres technologies sont utilisées avec HTML pour décrire la présentation d\'une page (CSS) et/ou ses fonctionnalités interactives (JavaScript).\r\n\r\nHTML fonctionne grâce à des « balises » qui sont insérées au sein d\'un texte normal. Chacune de ces balises indique la signification de telle ou telle portion de texte dans le site. On parle d\'« hypertexte » en référence aux liens qui connectent les pages web entre elles. C\'est la mécanique originelle du « World Wide Web » que nous connaissons aujourd\'hui. En écrivant et publiant des pages web, vous devenez un acteur du Web dès que votre site est accessible en ligne.', 1, 1, '2020-07-15 12:44:22', 'html.jpg'),
(3, 'Qu\'est-ce que PHP ?', 'PHP (officiellement, ce sigle est un acronyme récursif pour PHP Hypertext Preprocessor) est un langage de scripts généraliste et Open Source, spécialement conçu pour le développement d\'applications web. Il peut être intégré facilement au HTML.\r\nAu lieu d\'utiliser des tonnes de commandes afin d\'afficher du HTML (comme en C ou en Perl), les pages PHP contiennent des fragments HTML dont du code qui fait \"quelque chose\" (dans ce cas, il va afficher \"Bonjour, je suis un script PHP !\"). Le code PHP est inclus entre une balise de début <?php et une balise de fin ?> qui permettent au serveur web de passer en mode PHP.', 1, 3, '2020-07-15 12:46:34', 'php.jpg'),
(4, 'Qu\'est-ce que JAVASCRIPT ?', 'JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives mais aussi pour les serveurs2 avec l\'utilisation (par exemple) de Node.js3. C\'est un langage orienté objet à prototype, c\'est-à-dire que les bases du langage et ses principales interfaces sont fournies par des objets qui ne sont pas des instances de classes, mais qui sont chacun équipés de constructeurs permettant de créer leurs propriétés, et notamment une propriété de prototypage qui permet de créer des objets héritiers personnalisés. En outre, les fonctions sont des objets de première classe. Le langage supporte le paradigme objet, impératif et fonctionnel. JavaScript est le langage possédant le plus large écosystème grâce à son gestionnaire de dépendances npm, avec environ 500 000 paquets en août 20174.', 1, 4, '2020-07-15 12:47:34', 'js.jpg'),
(6, 'Pourquoi apprendre le CSS : 6 raisons', 'Les pages web se chargent plus rapidement et utilisent moins de bande passante\r\nLes feuilles de styles (téléchargée une seule fois puis stockée dans la mémoire cache) simplifies le code HTML ce qui permet de consommer moins de bande passante lors du chargement de la page.\r\n\r\n\r\nLe CSS est compatible avec tous les navigateurs\r\nLes sites web qui emploient correctement le CSS ont une apparence similaire quelque soit le navigateur utilisé.\r\n\r\n\r\nLe CSS peut etre utilisé pour créer des pages web faciles a imprimer\r\nLes images, les couleurs et les autres éléments difficiles a imprimer sont alors éliminés et les pages imprimées plus facilement.\r\n\r\n\r\nLe CSS permet à l\'utilisateur de personnaliser une page web\r\nAujourd\'hui, de nombreux sites web permettent à l\'utilisateur de changer la mise en page d\'un site sans modifier le contenu.\r\n\r\n\r\nLes feuilles de styles qui sont stockées en externe permettent à l\'utilisateur d\'effectuer les changements requis par eux-memes.\r\n\r\n\r\nLe CSS facilite le positionnement dans les moteurs de recherche\r\nle contenu est fourni en premier pour qu\'il soit plus facilement \"capturable\" par les spiders des moteurs.\r\n\r\n\r\nLe CSS rend également le code HTML plus \"propre\" facilitant le travail des robots d\'indexation.\r\n\r\n\r\nLe CSS facilite la portabilité du contenu\r\nEn employant le CSS, vous pouvez régler séparément les feuilles de style pour differents médias. Cela vous donne donc une plus grande souplesse dans la présentation de votre contenu.\r\n\r\n\r\nLe CSS vous permet de modifier les caractéristiques des éléments d\'un site web en fonction de la nécessité de la situation.', 1, 2, '2020-07-15 13:01:27', 'pcss.jpg'),
(7, 'PHP MYADMIN', 'Il s\'agit de l\'une des plus célèbres interfaces pour gérer une base de données MySQL sur un serveur PHP. De nombreux hébergeurs, gratuits comme payants, le proposent ce qui évite à l\'utilisateur d\'avoir à l\'installer.\r\n\r\nCette interface pratique permet d\'exécuter, très facilement et sans grandes connaissances en bases de données, des requêtes comme les créations de table de données, insertions, mises à jour, suppressions et modifications de structure de la base de données, ainsi que l\'attribution et la révocation de droits et l\'import/export. Ce système permet de sauvegarder commodément une base de données sous forme de fichier .sql et d\'y transférer ses données, même sans connaître SQL.\r\n\r\nLes requêtes SQL restent possibles, ce qui permet de les tester interactivement lors de la création d\'un site pour les utiliser ensuite en batch (c\'est-à-dire en différé) une fois au point.', 1, 3, '2020-07-15 13:04:52', 'myadm.png'),
(8, 'PDO - PHP DATA OBJECT', 'L\'extension PHP Data Objects (PDO) définit une excellente interface pour accéder à une base de données depuis PHP. Chaque pilote de base de données implémenté dans l\'interface PDO peut utiliser des fonctionnalités spécifiques de chacune des bases de données en utilisant des extensions de fonctions. Notez que vous ne pouvez exécuter aucune fonction de base de données en utilisant l\'extension PDO par elle-même ; vous devez utiliser un driver PDO spécifique à la base de données pour accéder au serveur de base de données.\r\n\r\nPDO fournit une interface d\'abstraction à l\'accès de données, ce qui signifie que vous utilisez les mêmes fonctions pour exécuter des requêtes ou récupérer les données quel que soit la base de données utilisée. PDO ne fournit pas une abstraction de base de données : il ne réécrit pas le SQL, n\'émule pas des fonctionnalités manquantes. Vous devriez utiliser une interface d\'abstraction complète si vous avez besoin de cela.', 1, 3, '2020-07-15 13:09:28', 'pdo.jpg'),
(9, 'POO - Programation Orienté Objet', 'La programmation par objet ( POO ) a été intégrée au langage PHPdans sa version 4. Mais à cette époque, le modèle objet de PHP étaitbeaucoup trop sommaire. Nous ne pouvions réellement parler deprogrammation orientée objet. Les développeurs de PHP se sont alorspenchés sur la question et ont amélioré ce modèle objet qui, depuis laversion 5, n\'a plus rien à envier aux autres langages objets comme Javaou C++.', 1, 3, '2020-07-15 13:10:34', 'poo.jpg'),
(10, 'PHP - Les Boucles', 'Dans la série des éléments de base de PHP à connaître absolument, voici les boucles ! Répéter des instructions, ça, l\'ordinateur sait faire (et en plus, il ne bronche jamais) !\r\n\r\nImaginez que vous êtes en train de créer le forum de votre site. Sur une page, on affiche par exemple une trentaine de messages. Il serait bien trop long et répétitif de dire « Affiche le message 1 et le nom de son auteur », « Affiche le message 2 et le nom de son auteur », « Affiche le message 3 et le nom de son auteur », etc. Pour éviter d\'avoir à faire cela, on peut utiliser un système de boucle qui nous permettra de dire une seule fois : « Affiche 30 messages et le nom de leur auteur à chaque fois ».\r\n\r\nBien entendu, nous n\'allons pas pouvoir apprendre à créer le forum de votre site dans ce chapitre, il est encore trop tôt. Néanmoins, prenez bien le temps de comprendre le fonctionnement des boucles car nous en aurons besoin tout au long de ce cours. Ce n\'est pas bien compliqué, vous allez voir !', 1, 3, '2020-07-15 13:12:40', 'boucle.jpg'),
(11, 'Quel frameword JAVASCRIPT choisir ? ', 'Si vous maîtrisez un petit peu le JavaScript, vous avez déjà dû vous retrouver face au choix d’un framework front-end pour votre application web. Si tel est le cas, comment avez-vous fait ?\r\n\r\nDifficile de connaître tous les frameworks, et de savoir rapidement lesquelles conviennent à son projet.\r\n\r\nC’est pourquoi nous avons choisi de vous proposer un article autour de trois des frameworks les plus populaires, pour passer en revue leurs avantages, inconvénients et caractéristiques spécifiques.', 1, 4, '2020-07-15 13:14:41', 'top10.jpg'),
(12, 'PHP - FRAMEWORKS', 'PHP, ou préprocesseur hypertexte, est un langage de script côté serveur open source. Il est également extrêmement populaire - près de 80% de tous les sites Web utilisaient PHP en octobre 2018.\r\n\r\nMais comment savoir quel framework PHP vous convient le mieux?\r\n\r\nCet article répertorie les 10 meilleurs cadres PHP disponibles pour vous aider à choisir.\r\n\r\nPourquoi utiliser un framework PHP?\r\nUn framework PHP fournit une structure de base pour rationaliser le développement d\'applications Web. Nous les utilisons car ils accélèrent le processus de développement.\r\n\r\nSurtout, la réactivité des sites Web et des applications construits à l\'aide de frameworks PHP aide les entreprises à répondre à leurs besoins de performance. Il ne fait donc aucun doute que les frameworks PHP continueront de gagner en attention et en popularité en 2019.', 1, 3, '2020-07-15 13:16:28', 'framephp.jpg'),
(13, 'Qu\'est-ce que HTML ?', 'HTML signifie « HyperText Markup Language » qu\'on peut traduire par « langage de balises pour l\'hypertexte ». Il est utilisé afin de créer et de représenter le contenu d\'une page web et sa structure. D\'autres technologies sont utilisées avec HTML pour décrire la présentation d\'une page (CSS) et/ou ses fonctionnalités interactives (JavaScript).\r\n\r\nHTML fonctionne grâce à des « balises » qui sont insérées au sein d\'un texte normal. Chacune de ces balises indique la signification de telle ou telle portion de texte dans le site. On parle d\'« hypertexte » en référence aux liens qui connectent les pages web entre elles. C\'est la mécanique originelle du « World Wide Web » que nous connaissons aujourd\'hui. En écrivant et publiant des pages web, vous devenez un acteur du Web dès que votre site est accessible en ligne.', 1, 1, '2020-07-15 13:17:44', 'html.jpg'),
(14, 'Qu\'est-ce que CSS ?', 'Cascading Style Sheets (CSS) est un langage de feuille de style utilisé pour décrire la présentation d\'un document écrit en HTML ou en XML (on inclut ici les langages basés sur XML comme SVG ou XHTML). CSS décrit la façon dont les éléments doivent être affichés à l\'écran, sur du papier, en vocalisation, ou sur d\'autres supports.\r\n\r\nCSS est l\'un des langages principaux du Web ouvert et a été standardisé par le W3C. Ce standard évolue sous forme de niveaux (levels), CSS1 est désormais considéré comme obsolète, CSS2.1 correspond à la recommandation et CSS3, qui est découpé en modules plus petits, est en voie de standardisation.', 2, 2, '2020-07-15 13:20:28', 'css.jpg'),
(15, 'Qu\'est-ce que PHP ?', 'PHP (officiellement, ce sigle est un acronyme récursif pour PHP Hypertext Preprocessor) est un langage de scripts généraliste et Open Source, spécialement conçu pour le développement d\'applications web. Il peut être intégré facilement au HTML.\r\nAu lieu d\'utiliser des tonnes de commandes afin d\'afficher du HTML (comme en C ou en Perl), les pages PHP contiennent des fragments HTML dont du code qui fait \"quelque chose\" (dans ce cas, il va afficher \"Bonjour, je suis un script PHP !\"). Le code PHP est inclus entre une balise de début <?php et une balise de fin ?> qui permettent au serveur web de passer en mode PHP.', 3, 3, '2020-07-15 13:20:28', 'php.jpg'),
(16, 'Qu\'est-ce que JAVASCRIPT ?', 'JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives mais aussi pour les serveurs2 avec l\'utilisation (par exemple) de Node.js3. C\'est un langage orienté objet à prototype, c\'est-à-dire que les bases du langage et ses principales interfaces sont fournies par des objets qui ne sont pas des instances de classes, mais qui sont chacun équipés de constructeurs permettant de créer leurs propriétés, et notamment une propriété de prototypage qui permet de créer des objets héritiers personnalisés. En outre, les fonctions sont des objets de première classe. Le langage supporte le paradigme objet, impératif et fonctionnel. JavaScript est le langage possédant le plus large écosystème grâce à son gestionnaire de dépendances npm, avec environ 500 000 paquets en août 20174.', 2, 4, '2020-07-15 13:20:28', 'js.jpg'),
(17, 'PHP MYADMIN', 'Il s\'agit de l\'une des plus célèbres interfaces pour gérer une base de données MySQL sur un serveur PHP. De nombreux hébergeurs, gratuits comme payants, le proposent ce qui évite à l\'utilisateur d\'avoir à l\'installer.\r\n\r\nCette interface pratique permet d\'exécuter, très facilement et sans grandes connaissances en bases de données, des requêtes comme les créations de table de données, insertions, mises à jour, suppressions et modifications de structure de la base de données, ainsi que l\'attribution et la révocation de droits et l\'import/export. Ce système permet de sauvegarder commodément une base de données sous forme de fichier .sql et d\'y transférer ses données, même sans connaître SQL.\r\n\r\nLes requêtes SQL restent possibles, ce qui permet de les tester interactivement lors de la création d\'un site pour les utiliser ensuite en batch (c\'est-à-dire en différé) une fois au point.', 2, 3, '2020-07-15 13:23:32', 'myadm.png'),
(18, 'POO - Programation Orienté Objet', 'La programmation par objet ( POO ) a été intégrée au langage PHPdans sa version 4. Mais à cette époque, le modèle objet de PHP étaitbeaucoup trop sommaire. Nous ne pouvions réellement parler deprogrammation orientée objet. Les développeurs de PHP se sont alorspenchés sur la question et ont amélioré ce modèle objet qui, depuis laversion 5, n\'a plus rien à envier aux autres langages objets comme Javaou C++.', 2, 3, '2020-07-15 13:23:32', 'poo.jpg'),
(19, 'PHP - Les Boucles', 'Dans la série des éléments de base de PHP à connaître absolument, voici les boucles ! Répéter des instructions, ça, l\'ordinateur sait faire (et en plus, il ne bronche jamais) !\r\n\r\nImaginez que vous êtes en train de créer le forum de votre site. Sur une page, on affiche par exemple une trentaine de messages. Il serait bien trop long et répétitif de dire « Affiche le message 1 et le nom de son auteur », « Affiche le message 2 et le nom de son auteur », « Affiche le message 3 et le nom de son auteur », etc. Pour éviter d\'avoir à faire cela, on peut utiliser un système de boucle qui nous permettra de dire une seule fois : « Affiche 30 messages et le nom de leur auteur à chaque fois ».\r\n\r\nBien entendu, nous n\'allons pas pouvoir apprendre à créer le forum de votre site dans ce chapitre, il est encore trop tôt. Néanmoins, prenez bien le temps de comprendre le fonctionnement des boucles car nous en aurons besoin tout au long de ce cours. Ce n\'est pas bien compliqué, vous allez voir !', 3, 3, '2020-07-15 13:23:32', 'boucle.jpg'),
(20, 'Quelles sont les différences entre Java et JavaScript ?', 'Java et JavaScript sont deux langages de programmation.\r\nLeur point commun : ce sont tous les deux des langages de type C et ont de ce fait la même structure. Ils sont cependant très différents dans leur fonctionnement et leur utilisation.\r\n\r\nJavaScript est un langage interprété, c’est-à-dire qu’il est directement lu et traduit au fur et à mesure de l’exécution du programme. Le JavaScript est principalement utilisé au travers de votre navigateur internet.\r\nTandis que Java est un langage dit compilé : il faut passer par la JVM (Java Virtual Machine) afin qu’il soit interprété en langage « machine ».\r\n\r\nAutre différence entre ces deux langages : JavaScript a un typage faible tandis que celui de Java est à typage fort. Typer une variable consiste à identifier le type de données à manipuler (Chaine de caractère, nombre, boolean* etc.)\r\n\r\nEn plus de ces deux différences notables, ces deux langages ne sont pas utilisés pour les mêmes raisons ni finalités.', 3, 4, '2020-07-15 13:23:32', 'jvsjs.jpg'),
(21, 'PHP MYADMIN', 'Il s\'agit de l\'une des plus célèbres interfaces pour gérer une base de données MySQL sur un serveur PHP. De nombreux hébergeurs, gratuits comme payants, le proposent ce qui évite à l\'utilisateur d\'avoir à l\'installer.\r\n\r\nCette interface pratique permet d\'exécuter, très facilement et sans grandes connaissances en bases de données, des requêtes comme les créations de table de données, insertions, mises à jour, suppressions et modifications de structure de la base de données, ainsi que l\'attribution et la révocation de droits et l\'import/export. Ce système permet de sauvegarder commodément une base de données sous forme de fichier .sql et d\'y transférer ses données, même sans connaître SQL.\r\n\r\nLes requêtes SQL restent possibles, ce qui permet de les tester interactivement lors de la création d\'un site pour les utiliser ensuite en batch (c\'est-à-dire en différé) une fois au point.', 1, 3, '2020-07-15 13:23:32', 'myadm.png');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'PHP'),
(4, 'JAVASCRIPT');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(2, 'Bonjour, comment on utilise PHPMYadmin ? ', 17, 1, '2020-07-15 13:48:32'),
(3, 'Bonjour, avez vous lu le contenu avant de le copier coller ? \r\n', 20, 1, '2020-07-15 13:49:24'),
(4, 'Non pas vraiment', 20, 1, '2020-07-15 13:49:38'),
(5, 'Ah bravo !!!', 20, 1, '2020-07-15 13:49:45'),
(6, 'Oui ben hein...', 20, 1, '2020-07-15 13:49:54'),
(7, 'C\'est possible de faire une conversation avec un autre utilisateur que toi même ? ', 20, 1, '2020-07-15 13:50:22'),
(8, 'Oui mais j\'ai la flemme de changer d\'utilisateur', 20, 1, '2020-07-15 13:50:58');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1338 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'moderateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'martin', '$2y$10$CHWCqKcH0iKKM/HiEc3yFOMmnCPaLxYMw/27tXl3HyxUSpEpkYn7e', 'martin@lol.lol', 1337),
(2, 'celine', '$2y$10$8x.scjpzTYxKjf5yjbODIue6m44X8kwNYIJxp19wwsiyXlf.USSVO', 'lol@lol.lol', 1337),
(3, 'modo', 'modo', 'modo@modo.modo', 42);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `sup_art` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
