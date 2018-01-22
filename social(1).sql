-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `comment_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment_content`, `status`, `created_at`, `updated_at`) VALUES
(1,	5,	9,	'Corrupti tempora reprehenderit repudiandae blanditiis numquam quos. Corrupti provident ut inventore in hic. Pariatur iste id eum id asperiores nemo. Voluptatem itaque at recusandae pariatur.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(2,	1,	5,	'Dolore fugiat sapiente ipsam odit. Animi cum quibusdam mollitia maiores. Et eveniet excepturi quisquam quasi et delectus.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(3,	2,	8,	'Magni voluptas sed aliquam at. Dicta corporis quia molestiae est voluptatem unde hic aut. Veniam itaque aut rerum nulla adipisci ex impedit. Soluta facere id distinctio reiciendis omnis ullam.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(4,	2,	6,	'Assumenda aut nemo est libero incidunt et eligendi. Accusantium exercitationem qui praesentium architecto hic. Animi et atque magnam doloribus quaerat.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(5,	4,	7,	'Doloremque aut quas reiciendis. Perferendis provident dolorem rem ut. Quas veniam corporis occaecati nobis. Facilis deserunt assumenda et ipsa. Id rerum deserunt architecto voluptas tempora dolorum repellat voluptatem.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(6,	5,	10,	'Aut est dicta neque error quod. Repudiandae aut soluta voluptatem quo culpa earum quasi quis. Aut quia nobis est commodi.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(7,	4,	10,	'Sint repudiandae voluptatem nemo repellat dignissimos quibusdam. Repellendus est pariatur veniam expedita quos aliquid illo debitis.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(8,	5,	4,	'Consequatur fugit vel rerum ducimus libero maxime. Voluptatem et doloribus illum tempore sed impedit. Et vel qui fugiat. Provident nihil impedit omnis.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(9,	2,	7,	'Nemo assumenda et harum temporibus dolorum et. Voluptatum neque et ipsa rerum qui. Impedit recusandae veritatis rerum ipsa expedita. Blanditiis vel tempore placeat sit ipsum fuga. Quia qui dicta dolor dolorem reiciendis eveniet.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(10,	2,	1,	'Dolor eos sit quisquam cupiditate. Voluptatum eum hic dolores excepturi molestiae qui dolores quod. Quo voluptatem voluptatem autem laudantium dignissimos voluptate dignissimos eum. Alias et illum quia eos vel.',	'1',	'2018-01-18 00:08:19',	'2018-01-18 00:08:19');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2018_01_17_180239_create_posts_table',	1),
(4,	'2018_01_17_183909_create_comments_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `like` int(11) DEFAULT NULL,
  `dislike` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `user_id`, `post_content`, `post_file`, `status`, `like`, `dislike`, `created_at`, `updated_at`) VALUES
(1,	5,	'Non quis quasi et sed. Architecto omnis autem sunt molestiae consequatur. Praesentium est ipsum esse nulla rerum. Mollitia beatae aut voluptatibus vel.',	'public/post_images/285c2cbf49e513012bfaf1cd9d063310.jpg',	'1',	2,	6,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(2,	2,	'Nulla hic nemo eligendi aut nam animi. Quo eveniet explicabo totam deleniti qui ut delectus. Aliquid dolorem aspernatur omnis impedit. Eligendi sequi ea minima et. Natus at sint veniam quam velit beatae officia a. In sint laborum et qui.',	'public/post_images/c1bd3ad27e07966d31c53049cd3a452c.jpg',	'1',	6,	8,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(3,	3,	'Hic aut id optio iste eos iste harum sapiente. Iusto autem amet eaque aut deleniti eos. Eos repellendus quod voluptas aut odio. Non natus omnis porro harum aut quia.',	'public/post_images/d8966e8564dc827e6a3e5af17222aaef.jpg',	'1',	2,	9,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(4,	2,	'Nisi quas ab iusto velit. Soluta minus deleniti voluptates voluptatibus eveniet accusamus beatae amet. Omnis non labore voluptas facilis exercitationem laboriosam est. Nam animi veniam illo placeat eaque eos.',	'public/post_images/4c334149cd61ce2dae02c9cc557a087b.jpg',	'1',	5,	0,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(5,	4,	'Illo corporis et est ipsam. Et dicta in sint. Non quia velit non nesciunt. Ratione deserunt assumenda autem sed sequi. Quo adipisci sit laudantium aut quidem sit. Provident omnis consequatur nihil. Quia ex aperiam id nam est non dolore.',	'public/post_images/c13846de6df779f88dfbe4bb21946327.jpg',	'1',	6,	5,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(6,	2,	'Esse cupiditate voluptas quibusdam ut aut. Et culpa tempore officiis illum assumenda impedit voluptatem. Praesentium voluptates delectus id qui nam. Molestias officiis id asperiores rerum molestiae.',	'public/post_images/814769e601cf5a2290f599ace514c9c8.jpg',	'1',	8,	0,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(7,	3,	'Id distinctio tempore fugiat at accusantium doloribus excepturi. Eaque qui sit tempora iusto reiciendis. Similique eligendi omnis quisquam.',	'public/post_images/d3b0df8f4277cbffbcc32523188308ba.jpg',	'1',	2,	5,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(8,	5,	'Quisquam et quo ut voluptas maiores in quam. Aut neque blanditiis suscipit esse. Odio excepturi nobis mollitia quia quia.',	'public/post_images/680e587e5aa638ed19944797f6e990e2.jpg',	'1',	3,	7,	'2018-01-18 00:08:18',	'2018-01-18 00:08:18'),
(9,	5,	'Possimus molestiae amet dicta laborum. Id voluptatum molestias voluptas aspernatur. Quos quidem excepturi voluptatem veniam.',	'public/post_images/5ecfbc5014d2fe332e4d44a9588a28c0.jpg',	'1',	5,	1,	'2018-01-18 00:08:19',	'2018-01-18 00:08:19'),
(10,	3,	'Voluptatem voluptas qui quisquam nemo accusantium quas. Reprehenderit est doloribus quam provident sunt recusandae. Rerum assumenda quaerat et quibusdam quia. Unde ab rerum quis et id iure expedita.',	'public/post_images/5d627e3c341461b049b7352b922c71ad.jpg',	'1',	0,	6,	'2018-01-18 00:08:19',	'2018-01-18 00:08:19');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `profile_image`, `cover_image`, `mobile`, `username`, `email`, `password`, `dop`, `city`, `country`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Luz',	'Schumm',	'public/images/4694c26f40ae15e612015896bf5cc301.jpg',	'https://lorempixel.com/820/312/?46142',	'+1 (817) 968-7248',	'wuckert.dianna',	'grimes.wilburn@hotmail.com',	'$2y$10$V76irRf2AwSNM5mEQ1ixputeDNl16ibni0gVt8UVDa.fv3YCh8L.G',	'1988-10-24 23:35:04',	'Florenciostad',	'Norway',	'1',	1,	'LDFlu0EljW',	'2018-01-18 00:08:09',	'2018-01-18 00:08:09'),
(2,	'Suzanne',	'Ferry',	'public/images/d61c5c1c0365bbe265b0bb423cbec09c.jpg',	'https://lorempixel.com/820/312/?17266',	'(903) 354-7973',	'vgislason',	'qsmitham@hotmail.com',	'$2y$10$bwRJxOlunhNyHzjjCAE6hOwEqlq80ms1nUzzsk86j8G8Jj0GfbhHu',	'1989-01-11 21:45:33',	'Hermistonhaven',	'Denmark',	'1',	1,	'6QjwGV9Bpi',	'2018-01-18 00:08:09',	'2018-01-18 00:08:09'),
(3,	'Lew',	'Stoltenberg',	'public/images/96112f4e00c4c87649e6e94c9e232f31.jpg',	'https://lorempixel.com/820/312/?82549',	'676-253-8622',	'emerald.moore',	'verla38@yahoo.com',	'$2y$10$v6FEmuGXCRaXZW9vQ8u4ruBOsEff185/mOFpwhwpwOBhdEoTZaSvq',	'1990-12-10 05:39:40',	'Josefaton',	'Ghana',	'1',	1,	'Yzacy5M5ey',	'2018-01-18 00:08:09',	'2018-01-18 00:08:09'),
(4,	'Maybell',	'Dickens',	'public/images/b774f65e19bc016605d5edfe5e150759.jpg',	'https://lorempixel.com/820/312/?88282',	'675.239.9310 x000',	'wuckert.rick',	'runolfsson.omer@gmail.com',	'$2y$10$Z5Mk9TR2HYlTscBfwrEYxerWxtDrXOUZv5pDGuOyK7ZNkoEfNhmgm',	'1981-03-22 20:51:28',	'North Jaquanport',	'Belize',	'1',	1,	'f218gvJqmF',	'2018-01-18 00:08:09',	'2018-01-18 00:08:09'),
(5,	'Kacey',	'Cronin',	'public/images/87b4b784df54d4be8f2e5b6ae25b0997.jpg',	'https://lorempixel.com/820/312/?19289',	'831.973.0168 x93864',	'aking',	'karli.wisozk@hotmail.com',	'$2y$10$ILa1cGGHKK8tIPU5BizVHu/JYv9/VyPX/NWiPIM.oOmU34jIlF6C2',	'1990-07-14 16:38:11',	'North Yessenia',	'India',	'1',	1,	'ivAjKj2ReX',	'2018-01-18 00:08:09',	'2018-01-18 00:08:09'),
(6,	'suraj',	'nirala',	NULL,	NULL,	NULL,	NULL,	'surajnirala@gmail.com',	'$2y$10$.GWcL37T4qkRvVt0GXvs0uIT9PbiI5xxHi0ixaJP1XhXsDwau30Zq',	'18-11-1995',	NULL,	NULL,	'1',	1,	NULL,	'2018-01-18 05:24:52',	'2018-01-18 05:24:52'),
(7,	'pratap',	'singh',	NULL,	NULL,	NULL,	NULL,	'vijay@gmail.com',	'$2y$10$teyHdJWRv9PdmQirvWWjAevBvDObqtNuA5IGfPV4t0RybPy0dNN36',	'18-11-1995',	NULL,	NULL,	'1',	1,	NULL,	'2018-01-18 05:51:56',	'2018-01-18 05:51:56');

-- 2018-01-22 09:28:06
