-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 04:48 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `archive-new`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ahkams`
--

CREATE TABLE `ahkams` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ahkam',
  `date_of_archiving` date DEFAULT NULL,
  `type_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_document` date DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `molahezat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ahkam_comments`
--

CREATE TABLE `ahkam_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ahkam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ahkam_user`
--

CREATE TABLE `ahkam_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `ahkam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_ahkams`
--

CREATE TABLE `deleted_ahkams` (
  `id` int(10) UNSIGNED NOT NULL,
  `database_id` smallint(6) DEFAULT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ahkam',
  `date_of_archiving` date DEFAULT NULL,
  `type_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_document` date DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `molahezat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_estelams`
--

CREATE TABLE `deleted_estelams` (
  `id` int(10) UNSIGNED NOT NULL,
  `database_id` smallint(6) DEFAULT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'estelam',
  `date_of_archiving` date DEFAULT NULL,
  `date_of_estelam` date DEFAULT NULL,
  `date_of_sodor` date DEFAULT NULL,
  `add_of_sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wozarat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reyasat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marja` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taslemi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_peshnehads`
--

CREATE TABLE `deleted_peshnehads` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `database_id` smallint(6) DEFAULT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peshnehad',
  `date_of_peshnehad` date DEFAULT NULL,
  `date_of_archiving` date DEFAULT NULL,
  `add_of_peshnehader` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taslemi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_saderamalis`
--

CREATE TABLE `deleted_saderamalis` (
  `id` int(10) UNSIGNED NOT NULL,
  `database_id` smallint(6) DEFAULT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'saderamali',
  `date_of_archiving` date DEFAULT NULL,
  `date_of_sodor` date DEFAULT NULL,
  `mursal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mursal_alia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_dosia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_archive` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_saderas`
--

CREATE TABLE `deleted_saderas` (
  `id` int(10) UNSIGNED NOT NULL,
  `database_id` smallint(6) DEFAULT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'sadera',
  `dateofmaktoob` date DEFAULT NULL,
  `mursal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mursal_alia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_dosia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `almary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_archiving` date DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_treports`
--

CREATE TABLE `deleted_treports` (
  `id` int(10) UNSIGNED NOT NULL,
  `database_id` int(11) DEFAULT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'report',
  `date_of_archiving` date DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revised_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_waradas`
--

CREATE TABLE `deleted_waradas` (
  `id` int(10) UNSIGNED NOT NULL,
  `database_id` smallint(6) DEFAULT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sadera',
  `number_of_warada` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_warada` date DEFAULT NULL,
  `mursal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reyasat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moderyat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mursal_alia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_dosia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `almary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_archiving` date DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estelams`
--

CREATE TABLE `estelams` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'estelam',
  `date_of_archiving` date DEFAULT NULL,
  `date_of_estelam` date DEFAULT NULL,
  `date_of_sodor` date DEFAULT NULL,
  `add_of_sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wozarat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reyasat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marja` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taslemi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estelam_comments`
--

CREATE TABLE `estelam_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estelam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estelam_user`
--

CREATE TABLE `estelam_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `estelam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notis`
--

CREATE TABLE `notis` (
  `id` int(10) UNSIGNED NOT NULL,
  `notifiable_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `noti_for` tinyint(4) DEFAULT NULL,
  `read` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peshnehads`
--

CREATE TABLE `peshnehads` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peshnehad',
  `date_of_peshnehad` date DEFAULT NULL,
  `date_of_archiving` date DEFAULT NULL,
  `add_of_peshnehader` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taslemi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peshnehad_comments`
--

CREATE TABLE `peshnehad_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peshnehad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peshnehad_user`
--

CREATE TABLE `peshnehad_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `peshnehad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saderamalis`
--

CREATE TABLE `saderamalis` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'saderamali',
  `date_of_archiving` date DEFAULT NULL,
  `date_of_sodor` date DEFAULT NULL,
  `mursal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mursal_alia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_dosia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_archive` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saderamali_comments`
--

CREATE TABLE `saderamali_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `saderamali_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saderamali_user`
--

CREATE TABLE `saderamali_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `saderamali_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saderas`
--

CREATE TABLE `saderas` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sadera',
  `dateofmaktoob` date DEFAULT NULL,
  `mursal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mursal_alia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_dosia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `almary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_archiving` date DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadera_comments`
--

CREATE TABLE `sadera_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sadera_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadera_notis`
--

CREATE TABLE `sadera_notis` (
  `id` int(10) UNSIGNED NOT NULL,
  `notifiable_id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `read` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadera_user`
--

CREATE TABLE `sadera_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `sadera_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_reports`
--

CREATE TABLE `sys_reports` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treports`
--

CREATE TABLE `treports` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'report',
  `date_of_archiving` date DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revised_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treport_comments`
--

CREATE TABLE `treport_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treport_user`
--

CREATE TABLE `treport_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `dept` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `dept`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$disv2IALRs4o58VwMORIF.Jo3BPVajk9u05PNutRLP7Tsqj2x2ucG', 1, 'GEP', NULL, 1, '2021-09-17 02:28:26', '2021-09-16 21:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `waradas`
--

CREATE TABLE `waradas` (
  `id` int(10) UNSIGNED NOT NULL,
  `crida_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'warada',
  `number_of_warada` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_warada` date DEFAULT NULL,
  `mursal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reyasat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moderyat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zamema` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kholasmatlab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mursal_alia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_dosia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `almary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_archiving` date DEFAULT NULL,
  `more` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warada_comments`
--

CREATE TABLE `warada_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `warada_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warada_user`
--

CREATE TABLE `warada_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `warada_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `ahkams`
--
ALTER TABLE `ahkams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ahkams_crida_number_unique` (`crida_number`);

--
-- Indexes for table `ahkam_comments`
--
ALTER TABLE `ahkam_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ahkam_user`
--
ALTER TABLE `ahkam_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_ahkams`
--
ALTER TABLE `deleted_ahkams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_estelams`
--
ALTER TABLE `deleted_estelams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_peshnehads`
--
ALTER TABLE `deleted_peshnehads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_saderamalis`
--
ALTER TABLE `deleted_saderamalis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_saderas`
--
ALTER TABLE `deleted_saderas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_treports`
--
ALTER TABLE `deleted_treports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_waradas`
--
ALTER TABLE `deleted_waradas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estelams`
--
ALTER TABLE `estelams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estelams_crida_number_unique` (`crida_number`);

--
-- Indexes for table `estelam_comments`
--
ALTER TABLE `estelam_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estelam_user`
--
ALTER TABLE `estelam_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notis`
--
ALTER TABLE `notis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peshnehads`
--
ALTER TABLE `peshnehads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peshnehads_crida_number_unique` (`crida_number`);

--
-- Indexes for table `peshnehad_comments`
--
ALTER TABLE `peshnehad_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peshnehad_user`
--
ALTER TABLE `peshnehad_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saderamalis`
--
ALTER TABLE `saderamalis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `saderamalis_crida_number_unique` (`crida_number`);

--
-- Indexes for table `saderamali_comments`
--
ALTER TABLE `saderamali_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saderamali_user`
--
ALTER TABLE `saderamali_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saderas`
--
ALTER TABLE `saderas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crida_number` (`crida_number`);

--
-- Indexes for table `sadera_comments`
--
ALTER TABLE `sadera_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sadera_notis`
--
ALTER TABLE `sadera_notis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sadera_user`
--
ALTER TABLE `sadera_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_reports`
--
ALTER TABLE `sys_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treports`
--
ALTER TABLE `treports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `treports_crida_number_unique` (`crida_number`);

--
-- Indexes for table `treport_comments`
--
ALTER TABLE `treport_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treport_user`
--
ALTER TABLE `treport_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `waradas`
--
ALTER TABLE `waradas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `waradas_crida_number_unique` (`crida_number`);

--
-- Indexes for table `warada_comments`
--
ALTER TABLE `warada_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warada_user`
--
ALTER TABLE `warada_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ahkams`
--
ALTER TABLE `ahkams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ahkam_comments`
--
ALTER TABLE `ahkam_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ahkam_user`
--
ALTER TABLE `ahkam_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deleted_ahkams`
--
ALTER TABLE `deleted_ahkams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deleted_estelams`
--
ALTER TABLE `deleted_estelams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deleted_peshnehads`
--
ALTER TABLE `deleted_peshnehads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deleted_saderamalis`
--
ALTER TABLE `deleted_saderamalis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deleted_saderas`
--
ALTER TABLE `deleted_saderas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `deleted_treports`
--
ALTER TABLE `deleted_treports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `deleted_waradas`
--
ALTER TABLE `deleted_waradas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estelams`
--
ALTER TABLE `estelams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `estelam_comments`
--
ALTER TABLE `estelam_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estelam_user`
--
ALTER TABLE `estelam_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notis`
--
ALTER TABLE `notis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=428;

--
-- AUTO_INCREMENT for table `peshnehads`
--
ALTER TABLE `peshnehads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peshnehad_comments`
--
ALTER TABLE `peshnehad_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peshnehad_user`
--
ALTER TABLE `peshnehad_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saderamalis`
--
ALTER TABLE `saderamalis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `saderamali_comments`
--
ALTER TABLE `saderamali_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saderamali_user`
--
ALTER TABLE `saderamali_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `saderas`
--
ALTER TABLE `saderas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sadera_comments`
--
ALTER TABLE `sadera_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sadera_notis`
--
ALTER TABLE `sadera_notis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sadera_user`
--
ALTER TABLE `sadera_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sys_reports`
--
ALTER TABLE `sys_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `treports`
--
ALTER TABLE `treports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `treport_comments`
--
ALTER TABLE `treport_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `treport_user`
--
ALTER TABLE `treport_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `waradas`
--
ALTER TABLE `waradas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `warada_comments`
--
ALTER TABLE `warada_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warada_user`
--
ALTER TABLE `warada_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
