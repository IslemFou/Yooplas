-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 08 juin 2025 à 07:46
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yooplas`
--
CREATE DATABASE IF NOT EXISTS `yooplas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `yooplas`;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `couleur`) VALUES
(1, 'Anniversaire', 'anniversaire', '#EA6060'),
(2, 'Festival', 'festival', '#00c70d'),
(3, 'Fête de fin d\'année', 'fete-de-fin-dannee', '#df2ad9'),
(4, 'Aucune catégorie', 'aucune-categorie', '#02aed9'),
(5, 'peinture', 'peinture', '#e6bf33'),
(6, 'sport', 'sport', '#00e6cb');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250511045224', '2025-05-11 04:56:44', 155),
('DoctrineMigrations\\Version20250511060544', '2025-05-11 06:06:26', 16),
('DoctrineMigrations\\Version20250511190755', '2025-05-11 19:08:26', 84),
('DoctrineMigrations\\Version20250511195346', '2025-05-11 19:54:11', 89),
('DoctrineMigrations\\Version20250513100615', '2025-05-13 10:07:24', 79),
('DoctrineMigrations\\Version20250513103957', '2025-05-13 10:40:06', 83),
('DoctrineMigrations\\Version20250513132917', '2025-05-13 13:29:42', 295),
('DoctrineMigrations\\Version20250522142127', '2025-05-22 14:22:06', 96),
('DoctrineMigrations\\Version20250523101331', '2025-05-23 10:13:51', 71),
('DoctrineMigrations\\Version20250528180543', '2025-05-28 18:06:09', 194);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `zip_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `price` double NOT NULL,
  `creator_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `title`, `slug`, `description`, `photo`, `date_start`, `date_end`, `time_start`, `time_end`, `zip_code`, `city`, `country`, `capacity`, `price`, `creator_id`) VALUES
(7, 'Birthday Kids', 'Birthday-Kids-682f0d64d8ee4', 'anniversaire enfants', 'childrens-birthday-1543897-1280-682f0d64d84aa.jpg', '2025-05-22', '2025-05-22', '16:00:00', '18:00:00', '75010', 'Paris', 'France', 20, 10, 4),
(8, 'Une journée au Louvre : immersion dans l’art et l’histoire', 'Une-journee-au-Louvre-immersion-dans-l-art-et-l-histoire-6839c7751cc8f', 'Dès les premiers pas franchis sous la majestueuse pyramide de verre, la visite au Louvre promet un voyage fascinant à travers des siècles de créativité humaine. Ce temple de l’art, l’un des plus grands musées au monde, offre un écrin exceptionnel pour admirer des chefs-d’œuvre emblématiques, du sourire énigmatique de la Joconde aux impressionnantes sculptures antiques.\r\n\r\nLa promenade dans ses vastes galeries est une invitation à la découverte : chaque salle révèle des trésors uniques, entre peintures, sculptures, objets d’art et antiquités. Le Louvre est aussi un lieu d’histoire, installé dans un ancien palais royal, où architecture et collections dialoguent harmonieusement.\r\n\r\nAu fil de la visite, on se laisse transporter dans différentes époques et civilisations, ressentant la richesse culturelle et la diversité artistique qui façonnent notre patrimoine commun.\r\n\r\nQue l’on soit passionné d’art ou simple curieux, cette sortie au Louvre reste une expérience inoubliable, mêlant émerveillement, réflexion et plaisir des sens.', 'paris-4995725-1280-6839c7750f298.jpg', '2025-06-16', '2025-06-17', '09:00:00', '18:00:00', '75001', 'Paris', 'France', 20, 25, 6),
(9, 'Soirée Ballet Théâtre — Une rencontre entre danse et dramaturgie', 'Soiree-Ballet-Theatre-Une-rencontre-entre-danse-et-dramaturgie-6839cb6ac396b', 'Plongez dans l’univers envoûtant du ballet théâtre, où la grâce de la danse classique rencontre la puissance narrative du théâtre. Ce spectacle unique mêle chorégraphies élégantes, expressions dramatiques et décors immersifs pour raconter des histoires captivantes sans mots, mais avec tout le langage du corps.\r\n\r\nLes danseurs vous emmènent à travers un voyage émotionnel, explorant des thèmes universels tels que l’amour, la passion, la lutte et la rédemption. Chaque mouvement est une phrase, chaque geste une émotion, donnant vie à un récit profond et poétique.\r\n\r\nRejoignez-nous pour une soirée magique où la beauté du ballet se fait théâtre vivant, pour un moment d’émerveillement et de réflexion', 'paris-84251-1280-6839cb6ac2f14.jpg', '2025-07-31', '2025-08-02', '18:00:00', '22:00:00', '75009', 'Paris', 'France', 50, 100, 6),
(10, 'Fête Nationale du 14 Juillet – Célébration de la République Française 🇫🇷', 'Fete-Nationale-du-14-Juillet-Celebration-de-la-Republique-Francaise-6839d5746c34f', 'Le 14 juillet marque la Fête nationale française, célébrée chaque année dans toute la France. Elle commémore deux événements majeurs : la prise de la Bastille en 1789, symbole de la fin de la monarchie absolue, et la Fête de la Fédération en 1790, célébrant l’unité du peuple français.\r\n\r\nCette journée est synonyme de fierté nationale, d’unité et de liberté. Partout en France, de nombreuses festivités sont organisées :\r\n🎆 Feux d’artifice spectaculaires,\r\n🎺 Défilé militaire sur les Champs-Élysées à Paris,\r\n🎶 Concerts, bals populaires et animations en plein air,\r\n🍷 Moments de convivialité entre citoyens.\r\n\r\nC’est un jour où l’histoire se mêle à la fête, où les valeurs républicaines — liberté, égalité, fraternité — résonnent dans chaque ville et village.', 'fc95696697a87679ba400dec21561625-15275699-6839d5746ac7c.jpg', '2025-07-14', '2025-07-14', '18:00:00', '00:00:00', '75000', 'Paris', 'France', 0, 0, 6),
(11, 'Festival des Ballons à Air Chaud – Un Voyage Magique dans les Cieux 🎈', 'Festival-des-Ballons-a-Air-Chaud-Un-Voyage-Magique-dans-les-Cieux-6839d73bdba54', 'Préparez-vous à vivre un moment inoubliable lors de notre Festival des Ballons à Air Chaud ! Rejoignez-nous pour un ou un week-end de rêve, où le ciel s’embrase de couleurs et de formes majestueuses.\r\n\r\nAu programme :\r\n🌅 Décollages en masse au lever et au coucher du soleil,\r\n🎨 Ballons spectaculaires de toutes tailles et aux designs créatifs,\r\n🎵 Animations musicales et ambiance festive sur le terrain,\r\n🍴 Food trucks, buvettes et espaces détente,\r\n🔥 Spectacle nocturne de montgolfières illuminées (\"Night Glow\") accompagné de musique,\r\n🎈 Vols captifs pour les petits et grands rêveurs.\r\n\r\nQue vous soyez amateur de photographie, passionné d’aviation ou simplement à la recherche d’un moment magique en famille, ce festival est fait pour vous !\r\n\r\n📍 Lieu : Paris\r\n📅 Date : 21/07/2025\r\n🕘 Horaires : Dès 09h00 – jusqu’au 22h00\r\n🎟️ Entrée : 50 €', 'hot-air-balloon-3648830-1280-6839d73bdae4d.jpg', '2025-07-21', '2025-08-21', '09:00:00', '22:00:00', '75000', 'Paris', 'France', 30, 50, 6);

-- --------------------------------------------------------

--
-- Structure de la table `event_category`
--

CREATE TABLE `event_category` (
  `event_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_category`
--

INSERT INTO `event_category` (`event_id`, `category_id`) VALUES
(7, 1),
(8, 5),
(9, 2),
(10, 2),
(11, 2);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int NOT NULL,
  `date_reservation` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_reservation` longtext COLLATE utf8mb4_unicode_ci,
  `id_user` int NOT NULL,
  `id_event` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `date_reservation`, `status`, `message_reservation`, `id_user`, `id_event`) VALUES
(1, '2025-05-31 09:42:11', 'accepted', '', 6, 7),
(2, '2025-06-05 09:49:25', 'accepted', '', 10, 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civility` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `civility`, `picture`) VALUES
(1, 'email@email.com', '[]', '$2y$13$n8Zz/SVKr8cGCEjXUnAHquMh.ZI87B90leI.aGnUvSqQF6JstXUFW', 'Islem', 'Fourati', 'f', ''),
(3, 'islemfourati@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$bVWDS9ShLGD9vW/sXvaXWOODQclQd.zhF7AsS5BYNyofIy4MZ0Tau', 'Islem', 'Fourati', 'f', ''),
(4, 'islemfourati@colombbus.org', '[\"ROLE_ADMIN\"]', '$2y$13$qwfXRzvZ0ZajKQJXH1dr8e7.skB/wb/p7.gtnqOYP1ZxdfJ8gaqdm', 'Islem', 'Fourati', 'f', ''),
(6, 'islemaafourati@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$mvYxV5iAotOKJ2Lc.yqGb.zT3YeFKAxsLCfZ5v1kPlgJUACzVXNTS', 'Islem', 'Fourati', 'f', '1000002165-6839a8942cfbc.jpg'),
(8, 'islem.fourati@gmail.com', '[]', '$2y$13$JYagCnGfQPAx0xbjFQ/8.eBWz7xoC.BQcg98TWC3I1vhGqjbm7nKK', 'Islem', 'fourati', 'f', NULL),
(10, 'islem.fourati55@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$kc6cnGqXoT/yLwdRFI.4VuzZIRuw3dVl1Wd3lYhRP.sqM8Gnvwdoi', 'Islem', 'fourati', 'f', 'woman-4290853-1280-6841904067891.jpg'),
(13, 'alexandre.cavet@gmail.com', '[]', '$2y$13$DMUpPjoK9i9lLu6iBf56bOluLadOq3H7MmdvIJtcVmnkh2bQc85TO', 'Alexandre', 'Cavet', 'h', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA761220EA6` (`creator_id`);

--
-- Index pour la table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`event_id`,`category_id`),
  ADD KEY `IDX_40A0F01171F7E88B` (`event_id`),
  ADD KEY `IDX_40A0F01112469DE2` (`category_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C849556B3CA4B` (`id_user`),
  ADD KEY `IDX_42C84955D52B4B97` (`id_event`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA761220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `event_category`
--
ALTER TABLE `event_category`
  ADD CONSTRAINT `FK_40A0F01112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_40A0F01171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C849556B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_42C84955D52B4B97` FOREIGN KEY (`id_event`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
