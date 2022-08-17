

-- Listage de la structure de la base pour blogue-db
CREATE DATABASE IF NOT EXISTS `blogue-db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blogue-db`;

-- Listage de la structure de la table blogue-db. article
CREATE TABLE IF NOT EXISTS `article` (
  `idArticle` int(10) NOT NULL AUTO_INCREMENT,
  `codeArt` varchar(255) NOT NULL,
  `idCat` int(10) NOT NULL,
  `idMembre` int(10) NOT NULL,
  `titre` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `source` varchar(255) NOT NULL,
  `lien` varchar(255) NOT NULL,
  `visite` int(100) NOT NULL,
  `like` varchar(255) NOT NULL,
  `statutArticle` varchar(255) NOT NULL,
  `modifier` varchar(255) NOT NULL,
  `dateDuJour` date NOT NULL,
  `dateDuJourMod` date NOT NULL,
  PRIMARY KEY (`idArticle`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table blogue-db.article : ~0 rows (environ)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`idArticle`, `codeArt`, `idCat`, `idMembre`, `titre`, `photo`, `contenu`, `source`, `lien`, `visite`, `like`, `statutArticle`, `modifier`, `dateDuJour`, `dateDuJourMod`) VALUES
	(1, '', 1, 2, 'Incidunt occaecati maiores sit impedit', '62fc51c87f275.jpg', 'Bibendum mauris vitae debitis ridiculus laudantium nulla litora, cursus rerum accusantium hendrerit quasi aptent luctus scelerisque consequuntur lectus, varius ullam. Proin accusantium quas incididunt! Officia hymenaeos. Per metus, tortor fuga, nam unde? Tortor eaque aut! Et, unde volutpat beatae quaerat faucibus ab corporis, senectus incidunt lorem senectus? Deleniti. Aute repudiandae mus minus, error, sint dicta dis magnam! Parturient numquam malesuada praesent earum vehicula aut, pretium, eiusmod sem illo necessitatibus ipsam, primis metus, corporis litora, ante? Et possimus, ea nascetur odio et praesentium venenatis turpis. Quas animi tincidunt magnis nisl magnam, morbi class volutpat assumenda! Lorem parturient deserunt nobis, dolores diam', '', '', 0, '', 'active', '', '2022-08-17', '0000-00-00'),
	(2, '', 2, 2, 'unde volutpat beatae quaerat faucibus ab c', '62fc51d8b3cc6.jpg', 'Bibendum mauris vitae debitis ridiculus laudantium nulla litora, cursus rerum accusantium hendrerit quasi aptent luctus scelerisque consequuntur lectus, varius ullam. Proin accusantium quas incididunt! Officia hymenaeos. Per metus, tortor fuga, nam unde? Tortor eaque aut! Et, unde volutpat beatae quaerat faucibus ab corporis, senectus incidunt lorem senectus? Deleniti. Aute repudiandae mus minus, error, sint dicta dis magnam! Parturient numquam malesuada praesent earum vehicula aut, pretium, eiusmod sem illo necessitatibus ipsam, primis metus, corporis litora, ante? Et possimus, ea nascetur odio et praesentium venenatis turpis. Quas animi tincidunt magnis nisl magnam, morbi class volutpat assumenda! Lorem parturient deserunt nobis, dolores diam', '', '', 0, '', 'active', '', '2022-08-17', '0000-00-00'),
	(3, '', 7, 2, 'a praesent earum vehicula aut, pretium, eiusmod sem illo necessitatibus ipsam, primis', '62fc51f0119af.jpg', 'Bibendum mauris vitae debitis ridiculus laudantium nulla litora, cursus rerum accusantium hendrerit quasi aptent luctus scelerisque consequuntur lectus, varius ullam. Proin accusantium quas incididunt! Officia hymenaeos. Per metus, tortor fuga, nam unde? Tortor eaque aut! Et, unde volutpat beatae quaerat faucibus ab corporis, senectus incidunt lorem senectus? Deleniti. Aute repudiandae mus minus, error, sint dicta dis magnam! Parturient numquam malesuada praesent earum vehicula aut, pretium, eiusmod sem illo necessitatibus ipsam, primis metus, corporis litora, ante? Et possimus, ea nascetur odio et praesentium venenatis turpis. Quas animi tincidunt magnis nisl magnam, morbi class volutpat assumenda! Lorem parturient deserunt nobis, dolores diam', '', '', 0, '', 'active', '', '2022-08-17', '0000-00-00');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Listage de la structure de la table blogue-db. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCat` int(10) NOT NULL AUTO_INCREMENT,
  `codeCat` varchar(255) NOT NULL,
  `libCat` varchar(255) NOT NULL,
  `descriptionCat` varchar(500) NOT NULL,
  `statutCat` varchar(255) NOT NULL,
  `dateDuJour` date NOT NULL,
  PRIMARY KEY (`idCat`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Listage des données de la table blogue-db.categorie : ~14 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`idCat`, `codeCat`, `libCat`, `descriptionCat`, `statutCat`, `dateDuJour`) VALUES
	(1, '', 'POLITIQUE', 'POLITIQUE', 'active', '2019-02-03'),
	(2, '', 'SOCIETE', 'SOCIETE', 'active', '2019-02-03'),
	(3, '', 'SPORT', 'SPORT', 'active', '2019-02-03'),
	(4, '', 'ECONOMIE/FINANCE', 'ECONOMIE/FINANCE', 'active', '2019-02-03'),
	(5, '', 'ART/CULTURE', 'ART/CULTURE', 'active', '2019-02-03'),
	(6, '', 'TECHNOLOGIE', 'TECHNOLOGIE', 'active', '2019-02-03'),
	(7, '', 'PEOPLE', 'PEOPLE', 'active', '2019-02-03'),
	(8, '', 'EDUCATION/EMPLOIS', 'EDUCATION/EMPLOIS', 'active', '2019-02-03'),
	(9, '', 'RELIGION', 'RELIGION', 'active', '2019-02-03'),
	(10, '', 'SANTE', 'SANTE', 'active', '2019-02-03'),
	(11, '', 'FLASHINFOS', 'FLASHINFOS', 'active', '2019-02-03'),
	(12, '', 'INTERNATIONAL', 'INTERNATIONAL', 'active', '2019-02-03'),
	(13, '', 'ARCHIVES', 'ARCHIVES', 'active', '2019-02-03'),
	(14, '', 'JEUX/LOISIRS', 'JEUX/LOISIRS', 'active', '2019-02-03');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table blogue-db. groupe
CREATE TABLE IF NOT EXISTS `groupe` (
  `idGroupe` int(100) NOT NULL AUTO_INCREMENT,
  `nomGroupe` varchar(255) NOT NULL,
  `descGroupe` varchar(255) NOT NULL,
  `statutGroupe` varchar(255) NOT NULL,
  `dateDuJour` date NOT NULL,
  PRIMARY KEY (`idGroupe`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table blogue-db.groupe : ~2 rows (environ)
/*!40000 ALTER TABLE `groupe` DISABLE KEYS */;
INSERT INTO `groupe` (`idGroupe`, `nomGroupe`, `descGroupe`, `statutGroupe`, `dateDuJour`) VALUES
	(1, 'membre', 'membre', 'active', '2018-03-04'),
	(2, 'admin', 'admin', 'active', '2018-03-04');
/*!40000 ALTER TABLE `groupe` ENABLE KEYS */;

-- Listage de la structure de la table blogue-db. membre
CREATE TABLE IF NOT EXISTS `membre` (
  `idMembre` int(100) NOT NULL AUTO_INCREMENT,
  `idGroupe` int(100) NOT NULL,
  `codeMembre` varchar(255) NOT NULL,
  `emailMembre` varchar(255) NOT NULL,
  `pwdMembre` varchar(255) NOT NULL,
  `pwdConfMembre` varchar(255) NOT NULL,
  `ancPwdMembre` varchar(255) NOT NULL,
  `nomMembre` varchar(255) NOT NULL,
  `telMembre` varchar(255) NOT NULL,
  `statutMembre` varchar(255) NOT NULL,
  `dateDuJour` date NOT NULL,
  `modifier` varchar(255) NOT NULL,
  `dateDuJourMod` date NOT NULL,
  PRIMARY KEY (`idMembre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table blogue-db.membre : ~2 rows (environ)
/*!40000 ALTER TABLE `membre` DISABLE KEYS */;
INSERT INTO `membre` (`idMembre`, `idGroupe`, `codeMembre`, `emailMembre`, `pwdMembre`, `pwdConfMembre`, `ancPwdMembre`, `nomMembre`, `telMembre`, `statutMembre`, `dateDuJour`, `modifier`, `dateDuJourMod`) VALUES
	(1, 2, 'BLOG2022/00001', 'test@test.ca', '5a105e8b9d40e1329780d62ea2265d8a', '5a105e8b9d40e1329780d62ea2265d8a', '098f6bcd4621d373cade4e832627b4f6', 'test', '23589', 'active', '2022-08-17', 'ok', '2022-08-17'),
	(2, 2, 'BLOG2022/00002', 'test2@test.ca', 'ad0234829205b9033196ba818f7a872b', 'ad0234829205b9033196ba818f7a872b', '', 'test2', '12458', 'active', '2022-08-17', '', '0000-00-00');
