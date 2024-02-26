-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 26 fév. 2024 à 03:32
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `videos_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int NOT NULL,
  `note` int NOT NULL DEFAULT '0',
  `commentaire` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `id_video` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `note`, `commentaire`, `id_video`) VALUES
(1, 240, 'Excellent', 1),
(2, 300, 'Génial', 1),
(3, 450, 'Extraordinaire', 1),
(4, 120, 'brillant', 1),
(5, 780, 'Suprême', 1),
(6, 1000, 'Fabuleux', 3),
(7, 20, 'Formidable', 3),
(8, 560, 'Super', 1),
(9, 470, 'Original', 5),
(10, 1, 'Médiocre', 1),
(11, 0, 'Magnifique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description_video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image_video` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categorie` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_publication` date NOT NULL,
  `duree` int NOT NULL,
  `nombres_vues` int NOT NULL DEFAULT '0',
  `score` int NOT NULL DEFAULT '0',
  `utilisateur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `nom`, `description_video`, `code`, `image_video`, `categorie`, `date_publication`, `duree`, `nombres_vues`, `score`, `utilisateur`) VALUES
(1, 'Adorables chatons les plus mignons', 'Mignon, câlin et complètement chaotique ! Ces adorables chatons sautent', 'CAT785612', 'https://picsum.photos/id/238/300/200', 'Funnyy', '2024-01-15', 40550, 74, 45000, ' Le collectif d\'animaux de compagnie'),
(3, 'The Ocean 4K - Calming Music', 'The Ocean is one of the most incredible places on earth. Enjoy this 4K Scenic Wildlife Film featuring the diverse animals and scenery of the ocean.', 'MUS125623', 'https://picsum.photos/id/240/300/200', 'Music', '2024-01-22', 85000, 60, 30, 'Scenic Relaxation'),
(4, 'Décorer sa maison avec des plantes', ' Repas maison cette semaine: Beurre sauce soja oeuf riz, Makguksu épicé (sauce soja 2T, poudre de piment rouge 3T, pâte de piment 2T, vinaigre 2T, sirop de prune 2T, sucre 4T, sirop d\'amidon 3T, ail haché 2T, un peu de sel)', 'CIU134589', 'https://picsum.photos/id/241/300/200', 'Cuisine', '2024-01-10', 895410, 70, 147000, 'Hami maman'),
(5, ' Les trois petits amis', 'Il souffle et il souffle et il fait exploser la maison avec sa musique cool ! Wally, fais attention ! JJ et le reste de ses amis les animaux chantent l\'histoire des 3 petits amis', 'KID122356', 'https://picsum.photos/id/250/300/200', 'Kids', '2024-01-25', 89504, 40, 20, 'CoComelon JJ\'s Animal Time '),
(6, 'Nettoyage complet d\'un bureau', 'Vidéo pédagogique sur la méthode de nettoyage complet d\'un bureau.', 'NET234589', 'https://picsum.photos/id/248/300/200', 'Nettoyage', '2024-01-25', 4560, 70, 520000, 'Mamy en affaire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `video_avis` (`id_video`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `video_avis` FOREIGN KEY (`id_video`) REFERENCES `video` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
