-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 19 fév. 2024 à 18:17
-- Version du serveur : 8.0.36-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bpce`
--

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_23_162536_create_notifications_table', 2),
(7, '2024_02_08_153720_create_questionnaires_table', 3),
(8, '2024_02_08_153740_create_questions_table', 3),
(10, '2024_02_09_141720_add_state_to_questionnaires', 4),
(11, '2024_02_10_105504_add_state_to_questions', 5);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `content`, `state`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Votre compte ont été activé avec succes', 'unread', 'user', '2024-01-23 15:33:40', '2024-01-23 15:33:40');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'main', '6eab30afb34260d74a7ec1333d3ca86c7fdd3bd668e2b32d67c99401b4587fd7', '[\"*\"]', NULL, '2024-01-23 14:52:24', '2024-01-23 14:52:24'),
(2, 'App\\Models\\User', 1, 'main', 'eb635a0c153738b3660f121fdb9aa3355af1e22dc37f5f691fed6473ab06d12d', '[\"*\"]', NULL, '2024-01-23 14:57:21', '2024-01-23 14:57:21'),
(3, 'App\\Models\\User', 1, 'main', 'bc668544934a0f0014e41076975ae64da3d97fc6b559be73848a26de70af0497', '[\"*\"]', NULL, '2024-01-23 14:57:27', '2024-01-23 14:57:27'),
(4, 'App\\Models\\User', 1, 'main', 'c2948837e9a4cf675a76993c8647a51de9abcb8e08b78be874303a92a52c0e42', '[\"*\"]', NULL, '2024-01-23 14:57:28', '2024-01-23 14:57:28'),
(5, 'App\\Models\\User', 1, 'main', '87c9bd0090a8a1636fee91e0ca26834359d7ab56b5f83ef1464234cc28673ee5', '[\"*\"]', NULL, '2024-01-23 14:57:59', '2024-01-23 14:57:59'),
(6, 'App\\Models\\User', 1, 'main', '83e996a37e9e6d91802a921adcafa7349808bbc6c755f1c7b82405857d7c6ac4', '[\"*\"]', NULL, '2024-01-23 14:58:00', '2024-01-23 14:58:00'),
(7, 'App\\Models\\User', 1, 'main', '20f400d2f456809d414bbafde90f14a848ca88301a0aed6d5dda89000bad243e', '[\"*\"]', NULL, '2024-01-23 14:58:04', '2024-01-23 14:58:04'),
(8, 'App\\Models\\User', 1, 'main', '92666ec27f92bca0b9e5ba0e4e8272c20dcb64eb6bda8e9b8b2e1357f7f2719b', '[\"*\"]', NULL, '2024-01-23 14:58:23', '2024-01-23 14:58:23'),
(9, 'App\\Models\\User', 1, 'main', '8b858f9cbb4f75e258ec0764e340161386ec87a95942be7f360c9913d9dedf9b', '[\"*\"]', NULL, '2024-01-23 15:03:52', '2024-01-23 15:03:52'),
(10, 'App\\Models\\User', 1, 'main', 'a26fcb693d9621b331a2f3cccbac2d57c9beb7e12b7daf2962a05bb41dab9e4f', '[\"*\"]', NULL, '2024-01-23 15:07:33', '2024-01-23 15:07:33'),
(11, 'App\\Models\\User', 1, 'main', 'ca334db0c0dc647dd0cb91e805f5df21f15f0a6e4ab1db5657d8e06fa0c4a72d', '[\"*\"]', NULL, '2024-01-23 15:07:49', '2024-01-23 15:07:49'),
(12, 'App\\Models\\User', 1, 'main', 'f35099d95d0e6ecc8c501f7839e2fcf9cd8366e93b495195a15337b63310968d', '[\"*\"]', NULL, '2024-01-25 15:13:13', '2024-01-25 15:13:13'),
(13, 'App\\Models\\User', 1, 'main', 'd0f5ed84a738da3d25eca8eaf7a3f35aaeac3e263a176adbd50857757e4fae97', '[\"*\"]', NULL, '2024-01-25 15:31:30', '2024-01-25 15:31:30'),
(14, 'App\\Models\\User', 1, 'main', '773ad23a3636f144da7e02fedf33eff66cb41c20a418db4ff326c7d649ccde06', '[\"*\"]', NULL, '2024-01-25 15:42:59', '2024-01-25 15:42:59'),
(15, 'App\\Models\\User', 1, 'main', '06cfb62eb77780e560370821228aecf9acd1ad66bfaec6ddb772936a1df94361', '[\"*\"]', NULL, '2024-01-25 15:43:08', '2024-01-25 15:43:08'),
(16, 'App\\Models\\User', 1, 'main', '656282e8594756b5db371b738426ce94084e2942b17b8b446f09aaaec9496b22', '[\"*\"]', NULL, '2024-02-08 14:00:08', '2024-02-08 14:00:08'),
(17, 'App\\Models\\User', 1, 'main', 'fee914685ebe57ae55c63703509021005d1b42c34eeeb46ad7e926a6b6130c5e', '[\"*\"]', NULL, '2024-02-09 09:55:41', '2024-02-09 09:55:41'),
(18, 'App\\Models\\User', 1, 'main', '7e4e50fa2c63b665b49e28b242a32ce43a2dc762736ce6047bb85c6cfc52e2f1', '[\"*\"]', '2024-02-10 10:36:56', '2024-02-10 10:08:44', '2024-02-10 10:36:56'),
(19, 'App\\Models\\User', 1, 'main', '180f17a7f861123ae72266bd3058f55868dd8fab552e789f07032031e8b5df1a', '[\"*\"]', '2024-02-19 10:44:35', '2024-02-19 10:38:00', '2024-02-19 10:44:35'),
(20, 'App\\Models\\User', 2, 'main', '803b2daf9fee504e840538350b78454bf7a4d56ec36ee70da07fc8b9b2e495ed', '[\"*\"]', NULL, '2024-02-19 14:32:38', '2024-02-19 14:32:38'),
(21, 'App\\Models\\User', 2, 'main', 'a33f8998b536df689207dd75d8d962682f70bc0ea45c78f83fbab5aacf1820bb', '[\"*\"]', '2024-02-19 14:49:04', '2024-02-19 14:49:01', '2024-02-19 14:49:04'),
(22, 'App\\Models\\User', 2, 'main', 'f674cb2d083b5452437b83d72ad9e4f40251a55404e4428d9a0128cd353d227f', '[\"*\"]', '2024-02-19 16:24:19', '2024-02-19 15:44:10', '2024-02-19 16:24:19'),
(23, 'App\\Models\\User', 2, 'main', '4e9a42562f42b1f28df7724916a607b346962d5e489437194a00dea3004eb90f', '[\"*\"]', '2024-02-19 16:25:45', '2024-02-19 16:25:43', '2024-02-19 16:25:45'),
(24, 'App\\Models\\User', 2, 'main', 'd93a2f7dc52a68ddbc828e8fe86896b8b6195967d20e4ba11c3ef9b779406202', '[\"*\"]', '2024-02-19 16:43:03', '2024-02-19 16:43:02', '2024-02-19 16:43:03'),
(25, 'App\\Models\\User', 2, 'main', 'b9e3348b84729f7b6d039c45f6bbe7645944ef899fb6d192df308e6ac860d50e', '[\"*\"]', '2024-02-19 16:46:45', '2024-02-19 16:44:47', '2024-02-19 16:46:45'),
(26, 'App\\Models\\User', 2, 'main', '68d812d0bfc49c3b9557fff5766ead7f443115aed3f8e92ff5cfbb5a9fa6bdd8', '[\"*\"]', '2024-02-19 16:46:51', '2024-02-19 16:46:50', '2024-02-19 16:46:51'),
(27, 'App\\Models\\User', 2, 'main', 'f098556fa4be919346e570869644ab01591f0519cf4d98baa139a2dd08113e5d', '[\"*\"]', '2024-02-19 16:46:56', '2024-02-19 16:46:56', '2024-02-19 16:46:56'),
(28, 'App\\Models\\User', 2, 'main', 'b4eb9a6c656bb57ff12d903dc9339a07063b5cfb3615a620b9ea7c27a0f49a98', '[\"*\"]', '2024-02-19 16:46:59', '2024-02-19 16:46:59', '2024-02-19 16:46:59'),
(29, 'App\\Models\\User', 2, 'main', '40e1370ca6510702a7b7ac3bca9750e807e52762e77dfbf9f9239feb3c003148', '[\"*\"]', '2024-02-19 16:49:22', '2024-02-19 16:49:20', '2024-02-19 16:49:22');

-- --------------------------------------------------------

--
-- Structure de la table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questionnaires`
--

INSERT INTO `questionnaires` (`id`, `name`, `created_at`, `updated_at`, `state`) VALUES
(1, 'QUESTIONNAIRE 1', '2024-02-09 10:53:46', '2024-02-09 10:53:46', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_one` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_two` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_three` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_four` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `questionnaire_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `description`, `choice_one`, `choice_two`, `choice_three`, `choice_four`, `response`, `questionnaire_id`, `created_at`, `updated_at`, `state`) VALUES
(1, 'test de lettres ?', 'ete', 'tyu', 'wew', 'eww', 'b', 1, '2024-02-09 11:06:37', '2024-02-09 11:06:37', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `matricule`, `img`, `state`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kemayo', 'Denis', 'kemayo@bpce-it.fr', 'B1223445', NULL, 'asset', 'admin', NULL, '$2y$10$sTlJMRp9XS01bAfyBUWz3e1zYhE.zHKpXBuwgTPoD9xz464jLqQUe', NULL, '2024-01-23 14:52:24', '2024-01-23 15:33:39'),
(2, 'Sessou', 'Boris', 'boris@bpce-it.fr', 'BEJYU67', NULL, 'asset', 's_member', NULL, '$2y$10$9uu.GdN7MwS4ZEI1u4Syle3d3FlEEXSKo7R5eecUrRD/NpX0l7U9G', NULL, '2024-02-19 14:32:37', '2024-02-19 14:32:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_questionnaire_id_foreign` (`questionnaire_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_matricule_unique` (`matricule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_questionnaire_id_foreign` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
