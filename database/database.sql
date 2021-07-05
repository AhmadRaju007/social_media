/*
SQLyog Enterprise - MySQL GUI v8.14 
MySQL - 5.5.5-10.4.14-MariaDB : Database - face_clone
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`face_clone` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `face_clone`;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `comments` */

insert  into `comments`(`id`,`post_id`,`comment`,`user_id`,`created_at`,`updated_at`) values (1,1,'Test Comment',4,'2021-05-28 20:20:44','2021-05-28 20:20:44'),(2,1,'This is my second comment.',4,'2021-05-28 20:55:25','2021-05-28 20:55:25');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_04_11_194433_update_users_table',2),(5,'2021_04_23_195245_create_posts_table',3),(7,'2021_05_28_194225_create_comments_table',4),(8,'2021_05_29_192105_add_last_login_to_users_table',5);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values ('rajuahmad6789@gmail.com','$2y$10$7npXtc0h4e9BpSDY7c4qD.n1UJ2CLY.V5R0kipUHR5/rsEWEtLX36','2021-04-12 18:51:38');

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `likes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`likes`)),
  `shares` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shares`)),
  `comments` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`status`,`photo`,`likes`,`shares`,`comments`,`user_id`,`created_at`,`updated_at`) values (1,'This is my first post','/images/user_4/image_1619380889.png','[]','[]',2,4,'2021-04-26 02:01:29','2021-05-30 02:05:12'),(2,' has updated his profile picture!','/images/user_4/image_1621630173.png','[]','[]',0,4,'2021-05-22 02:49:33','2021-05-22 02:49:33'),(3,'Raju_Test has updated his profile picture!','/images/user_4/image_1621630275.jpg','[]','[]',0,4,'2021-05-22 02:51:15','2021-05-22 02:51:15');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `b_day` date NOT NULL DEFAULT '2021-01-01',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`fname`,`lname`,`sex`,`b_day`,`image`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`last_login`) values (1,'Test','Name1',0,'2021-01-01','','raju@raju.c',NULL,'d',NULL,'2021-04-02 18:55:02','2021-04-02 18:55:02','2021-05-30 01:24:06'),(2,'Test','Name2',1,'2002-11-15',NULL,'raju@raju.co',NULL,'11111111',NULL,NULL,NULL,'2021-05-30 01:24:06'),(3,'Test','Name3',1,'1994-07-11',NULL,'rajuahmad6789@gmail.com',NULL,'$2y$10$r5f4PdUoAOjD6BEjeAes1.mg4tRQ9Z7nSJDS/ycqCAVg/CnXv7fPu',NULL,NULL,NULL,'2021-05-30 01:56:06'),(4,'আহমাদ','রাজু',1,'2016-11-12','/images/user_4/image_1621630275.jpg','raju@raju.com',NULL,'$2y$10$/9IzNJPV7uZfXcncqtzIbOCh.HnOtUVRRdre8L3.a4hTT/WLzTEZu','ZFLhzAGyrbGbJ8PmmJT6UenFQmpcB8D6zlkk5DDRvcU6oDlTvjIWataF0aFv',NULL,'2021-05-30 02:06:16','2021-05-30 02:06:16'),(5,'Test','Name4',1,'1998-08-18',NULL,'r@c.cm',NULL,'$2y$10$tPlTf9alXsVUEWOs0y275ulYfjuK4LA.gHUmNX3KFpJIl9cPsyMLy',NULL,'2021-04-16 20:38:35','2021-04-16 20:38:35','2021-05-30 01:24:06'),(6,'Test','Name5',1,'1998-08-18',NULL,'r@c.c',NULL,'$2y$10$XbG1F8ICL9S5ApK8XWMP0.i2LsslaNerCEgXIOsOJybLe.Ag3.3qC',NULL,'2021-04-16 20:40:41','2021-04-16 20:40:41','2021-05-30 01:24:06'),(7,'Raju','Ahmed',1,'2006-10-11',NULL,'raju@raju1.com',NULL,'$2y$10$eYVBkT97SZxwL.A0fxqih.EdYj4DZtS5zTeAoSomXA6gUXuUF4yTG',NULL,'2021-07-04 00:05:54','2021-07-04 00:06:08','2021-07-04 00:06:08');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
