-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2021 at 08:19 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ace_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` bigint(20) NOT NULL,
  `activity_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) NOT NULL DEFAULT 0,
  `is_menu` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:active,0:in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `activity_name`, `module_id`, `is_menu`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin User Management', 4, 5, 1, NULL, NULL),
(2, 'Admin User Entry', 4, NULL, 1, NULL, NULL),
(3, 'Admin User Update', 4, NULL, 1, NULL, NULL),
(4, 'Admin User Delete', 4, NULL, 1, NULL, NULL),
(5, 'Action Management', 7, 10, 1, NULL, NULL),
(6, 'Action Entry', 7, NULL, 1, NULL, NULL),
(7, 'Action Update', 7, NULL, 1, NULL, NULL),
(8, 'Module Management', 7, 9, 1, NULL, NULL),
(9, 'Module Entry', 7, NULL, 1, NULL, NULL),
(10, 'Module Update', 7, NULL, 1, NULL, NULL),
(11, 'Module Delete', 7, NULL, 1, NULL, NULL),
(12, 'General Setting Management', 11, 8, 1, '2020-04-09 08:26:07', '2020-04-09 19:28:49'),
(15, 'General Setting Update', 11, NULL, 1, '2020-04-09 18:50:37', '2020-04-09 19:28:54'),
(16, 'Group Management', 11, 14, 1, '2020-04-10 04:54:39', '2020-04-10 04:59:51'),
(17, 'User Group Entry', 11, NULL, 1, '2020-04-10 04:55:22', '2020-04-10 04:55:22'),
(18, 'User Group Update', 11, NULL, 1, '2020-04-10 04:55:36', '2020-04-10 04:55:36'),
(19, 'User Group Delete', 11, NULL, 1, '2020-04-10 04:56:36', '2020-04-10 04:56:36'),
(20, 'Assign Group Permission', 11, NULL, 1, '2020-04-10 05:26:19', '2020-04-10 05:26:19'),
(93, 'School Management', 11, 39, 1, '2021-07-18 23:40:08', '2021-07-18 23:41:09'),
(94, 'School Entry', 11, NULL, 1, '2021-07-18 23:41:54', '2021-07-18 23:41:54'),
(95, 'School Update', 11, NULL, 1, '2021-07-18 23:42:12', '2021-07-18 23:42:12'),
(96, 'School Delete', 11, NULL, 1, '2021-07-19 01:32:43', '2021-07-19 01:32:43'),
(99, 'School Admins Management', 4, 41, 1, '2021-07-24 19:08:05', '2021-07-24 19:08:05'),
(100, 'School Admins Entry', 4, NULL, 1, '2021-07-25 11:59:14', '2021-07-25 11:59:14'),
(101, 'School Admin Update', 4, NULL, 1, '2021-07-25 12:00:11', '2021-07-25 12:00:11'),
(102, 'School Admin Delete', 4, NULL, 1, '2021-07-25 12:00:38', '2021-07-25 12:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(53, 'default', '{\"uuid\":\"7a4490d1-5623-4147-b3cf-c94460de06bb\",\"displayName\":\"App\\\\Jobs\\\\UsersEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\UsersEmailJob\",\"command\":\"O:22:\\\"App\\\\Jobs\\\\UsersEmailJob\\\":10:{s:8:\\\"username\\\";s:17:\\\"razib11@gmail.com\\\";s:8:\\\"password\\\";i:1234;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1627566318, 1627566318),
(54, 'default', '{\"uuid\":\"ab36af2e-39f8-4773-a30c-6d59e891373d\",\"displayName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"command\":\"O:45:\\\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\\\":10:{s:8:\\\"username\\\";s:17:\\\"eastsss@gmail.com\\\";s:8:\\\"password\\\";i:1234;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1627657485, 1627657485),
(55, 'default', '{\"uuid\":\"99f5e06c-6bcb-46d4-821a-3c199f5a34d8\",\"displayName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"command\":\"O:45:\\\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\\\":10:{s:8:\\\"username\\\";s:22:\\\"razibeee2019@gmail.com\\\";s:8:\\\"password\\\";i:1234;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1627704547, 1627704547),
(56, 'default', '{\"uuid\":\"bf1218b2-5709-4a1e-959e-89663a7a0e22\",\"displayName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"command\":\"O:45:\\\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\\\":10:{s:8:\\\"username\\\";s:22:\\\"razibeee2084@gmail.com\\\";s:8:\\\"password\\\";i:1234;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1627705444, 1627705444),
(57, 'default', '{\"uuid\":\"7a5d5f57-a769-4ff2-99ff-525d1b472cba\",\"displayName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"command\":\"O:45:\\\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\\\":10:{s:8:\\\"username\\\";s:23:\\\"razibeee20154@gmail.com\\\";s:8:\\\"password\\\";i:1234;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1627708228, 1627708228),
(58, 'default', '{\"uuid\":\"68761ead-65e5-4712-8ecb-63be70ed8fe6\",\"displayName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\",\"command\":\"O:45:\\\"App\\\\Jobs\\\\UsersRegistrationConfirmationMailJob\\\":10:{s:8:\\\"username\\\";s:23:\\\"razibeee20114@gmail.com\\\";s:8:\\\"password\\\";i:1234;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1627708510, 1627708510);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) NOT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT 0 COMMENT 'value:0 if the menu is itself a parent otherwise anyother parent id',
  `serial_no` int(11) DEFAULT NULL,
  `menu_icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:active,0:in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `module_name`, `menu_title`, `menu_url`, `parent_id`, `serial_no`, `menu_icon_class`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Users', 'Users', '', 0, 6, 'pe-7s-users', 1, NULL, NULL),
(5, 'Users', 'Super Admin', 'user/admin/admin-user-management?type=Admin', 4, 1, NULL, 1, NULL, NULL),
(6, 'Users', 'School Admin', 'user/admin/admin-user-management?type=School', 4, 2, NULL, 1, NULL, NULL),
(7, 'Cpanel', 'Control Panel', '', 0, 8, 'pe-7s-tools', 1, NULL, NULL),
(8, 'Settings', 'General Setting', 'settings/general/general-setting', 11, 1, NULL, 1, NULL, NULL),
(9, 'Cpanel', 'Menus/Moduls', 'cp/module/manage-module', 7, 2, NULL, 1, NULL, NULL),
(10, 'Cpanel', 'Actions', 'cp/web-action/web-action-management', 7, 3, NULL, 1, NULL, NULL),
(11, 'Settings', 'Settings', '', 0, 7, 'pe-7s-settings', 1, NULL, NULL),
(14, 'Settings', 'User Groups', 'settings/admin/admin-group-management', 11, 2, NULL, 1, '2020-04-10 04:58:01', '2020-04-10 04:58:01'),
(39, 'Settings', 'Schools', 'settings/admin/school-management', 11, NULL, NULL, 1, '2021-07-18 23:38:48', '2021-07-18 23:38:48'),
(41, 'Users', 'School Admins', 'school/admin/school-admins', 4, NULL, NULL, 1, '2021-07-24 19:00:53', '2021-07-24 19:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2016_06_01_000001_create_oauth_auth_codes_table', 8),
(9, '2016_06_01_000002_create_oauth_access_tokens_table', 8),
(10, '2016_06_01_000003_create_oauth_refresh_tokens_table', 8),
(11, '2016_06_01_000004_create_oauth_clients_table', 8),
(12, '2016_06_01_000005_create_oauth_personal_access_clients_table', 8),
(30, '2021_07_19_062808_create_schools_table', 9),
(31, '2021_07_28_052824_create_jobs_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principle_contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `valid_till` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `address`, `email`, `contact_no`, `principle_name`, `principle_contact_no`, `reference_person`, `reference_contact_no`, `registration_date`, `valid_till`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC', 'dhakassss', 'abcss@gmail.com', '01222500000', 'MAs', '0254550000000', 'JMs', '0055885000000', '2021-07-02', '2021-07-09', 'NOtessss', 'Active', '2021-07-19 01:22:56', '2021-07-25 11:41:50'),
(9, 'CPN', 'Dhaka', 'cpn@gmail.com', '012255', 'K.N', '0555', 'I.P', '0588885', '2021-07-07', '2021-07-22', 'Note', 'Inactive', '2021-07-19 02:27:08', '2021-07-29 19:51:35'),
(15, 'ABCddddd', 'dhakad', 'abc@gmail.com', '012225', 'MA', '025455', 'JM', '0055885', '2021-07-06', '2021-07-21', 'NOte', 'Active', '2021-07-19 05:43:41', '2021-07-19 06:34:24'),
(16, 'BANs', 'Dhakas', 'bans@gmail.com', '0127777778', 'Ranas', '0125585857', 'Kamals', '0888887', '2021-07-12', '2021-07-28', 'Notes', 'Active', '2021-07-19 23:04:36', '2021-07-19 23:05:24'),
(17, 'North', 'Dhaka', 'email@gmail.com', '01525', 'asdf', '022', 'sdfg', '02558', '2021-07-22', '2021-07-22', 'asdf', 'Active', '2021-07-26 17:57:17', '2021-07-26 17:57:17'),
(22, 'eastss', 'Dhaka', 'easted@gmail.com', '022', 'asdf', '120', 'asdf', '855', '2021-07-13', '2021-07-21', 'asdfad', 'Active', '2021-07-27 12:54:44', '2021-07-29 07:27:27'),
(71, 'Dhakss', 'Dhaka', 'razibeee2015@gmail.com', '02558588', 'asdfasd', '5258852', 'klalsdkf', '5488', '2021-06-29', '2021-07-07', 'asdf', 'Active', '2021-07-29 07:52:07', '2021-07-29 07:52:07'),
(73, 'asdf', 'fff', 'razibeee2012@gmail.com', '01255', 'iii', '025', 'ppp', '014', '2021-07-07', '2021-07-29', 'hhh', 'Active', '2021-07-29 08:14:53', '2021-07-29 20:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `short_name`, `site_name`, `admin_email`, `admin_mobile`, `site_url`, `admin_url`, `logo`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ace Learning', 'AceLearning', 'Ace Learning', 'admin@ace-learning.com', '45455', NULL, NULL, 'ace-logo.png', 'sdfsd f, sdf sdf', NULL, '2021-07-14 03:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` bigint(20) DEFAULT NULL COMMENT 'when a user is under a client then client id will set here',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:active,0:in-active',
  `type` enum('School','Admin','Teacher','Student') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `typable_id` bigint(20) DEFAULT NULL,
  `login_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:logged-in,0:Not logged in',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `user_profile_image`, `contact_no`, `remarks`, `school_id`, `status`, `type`, `typable_id`, `login_status`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Momit', 'Hasan', 'momit@technolife.ee', '1616308888.jpg', '74645564654', NULL, NULL, 1, 'Admin', NULL, 0, '$2y$10$zFj3Z1gRkrbgUvoNXF6cXubdAp8p54yy4kRgJ421RQNqllCEvHJka', NULL, NULL, '2021-06-07 06:50:15', '2021-07-20 00:15:09'),
(29, 'Rajib', 'Hasan', 'razibeee2014@gmail.com', NULL, '456456456', NULL, NULL, 1, 'Admin', NULL, 0, '$2y$10$Y/uvlLwHx0MLkStdddi8AuXBM1IfymN7235bzKx4ipthkLpYLCg8S', NULL, NULL, '2021-07-14 06:43:53', '2021-07-31 22:53:10'),
(125, 'asdf', 'asdf', 'easet@gmail.com', NULL, '02155', 'adsf', 9, 0, 'School', NULL, 0, '$2y$10$ZpbM9OH9oW13g4zBKcehmegVDO8BC50Rd79SvuGnlLM4VHpyFgmdK', NULL, NULL, '2021-07-27 19:10:41', '2021-07-29 19:51:35'),
(126, 'sdfasdf', NULL, 'email20@gmail.com', NULL, '02525885', NULL, 9, 1, 'School', NULL, 1, '$2y$10$4737SiJIotAHYGVUP.S/quCsmXpzN6z2uDheGjF9CE9zNZLt5L4gG', NULL, NULL, '2021-07-27 19:15:32', '2021-07-29 18:14:39'),
(174, 'Dhakss', NULL, 'razibeee2015@gmail.com', NULL, '02558588', NULL, 71, 1, 'School', NULL, 1, '$2y$10$dj5Dpf2FGU82GoGuiy.DRebc9rWDP5U0TIkSsuf2ryavADNXpT7Y6', NULL, NULL, '2021-07-29 07:52:07', '2021-07-30 23:08:10'),
(176, 'asdf', NULL, 'razibeee2012@gmail.com', NULL, '01255', NULL, 73, 0, 'School', NULL, 0, '$2y$10$JV1iW598xbT/ji57KV1GpugPZegZWwV4of1pBXz.S96FOoXVBBTPW', NULL, NULL, '2021-07-29 08:14:53', '2021-07-29 19:51:46'),
(177, 'Name', 'PG', 'razib11@gmail.com', NULL, '0255', 'asdf', NULL, 1, 'Admin', NULL, 0, '$2y$10$tBUHlJXPNtXOLnHFdu9GyenHktdyLK24m5UReCwQBBnYIm/19BqNy', NULL, NULL, '2021-07-29 20:45:16', '2021-07-29 20:45:16'),
(178, 'asdf', 'asdf', 'eastsss@gmail.com', NULL, '0252', 'asdf', 15, 1, 'School', NULL, 0, '$2y$10$.y2F2lp7bHPJLCOik5OcPOHFHpr2p5SHtvXoBQWhT5EwPvp06mt4e', NULL, NULL, '2021-07-30 09:04:43', '2021-07-30 09:04:43'),
(179, '', NULL, '', NULL, NULL, NULL, NULL, 1, 'Admin', NULL, 0, '$2y$10$yexBKSGyy7h1z6vt9YuJLuMilPxPAoxenVgriZX1lWkI2Ef3wyp/K', NULL, NULL, '2021-07-30 22:09:06', '2021-07-30 22:09:06'),
(183, 'sad', 'sadf', 'razibeee2084@gmail.com', NULL, '025252', 'dfgh', 15, 1, 'School', NULL, 0, '$2y$10$CGFZx2i2ryJMbVomsUllFuscJjLcf6Rd1/nMYXwuxCL0Rx3DtbyVi', NULL, NULL, '2021-07-30 22:24:04', '2021-07-30 22:24:04'),
(184, 'fff', 'adf', 'razibeee20154@gmail.com', NULL, '05565', 'ff', 22, 1, 'School', NULL, 0, '$2y$10$JVGD8TIQyBL8F1Qk6JTGVeBY6NmGBAXLWGipktzbiv6sKTA0J8.Ae', NULL, NULL, '2021-07-30 23:10:28', '2021-07-30 23:10:28'),
(185, 'asdf', 'sadf', 'razibeee20114@gmail.com', NULL, '055', 'sdf', 22, 1, 'School', NULL, 0, '$2y$10$QL3oREdZqahvBQPwVDgeBOFP/uc/uBPkY0DaRWlDsCYrMSVqrTm9W', NULL, NULL, '2021-07-30 23:15:10', '2021-07-30 23:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:active,0:in-active',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Admin, 2:School, 3:Teacher, 3:Student',
  `editable` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:yes,0:no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `status`, `type`, `editable`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, 1, 0, NULL, NULL),
(2, 'School Admin', 1, 2, 1, '2020-04-10 07:35:07', '2020-04-10 07:35:07'),
(27, 'Teacher', 1, 3, 1, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(29, 'Student', 1, 2, 1, '2021-07-14 06:44:52', '2021-07-14 06:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_members`
--

CREATE TABLE `user_group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:active,0:in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_group_members`
--

INSERT INTO `user_group_members` (`id`, `user_id`, `group_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(4, 1, 2, 0, '2020-04-10 07:35:07', '2020-04-10 07:35:07'),
(5, 1, 27, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(27, 29, 1, 1, '2021-07-14 06:43:53', '2021-07-14 06:43:53'),
(109, 125, 2, 1, '2021-07-27 19:10:41', '2021-07-27 19:10:41'),
(110, 125, 29, 0, '2021-07-27 19:10:41', '2021-07-27 19:10:41'),
(111, 126, 2, 1, '2021-07-27 19:15:32', '2021-07-27 19:15:32'),
(112, 126, 29, 0, '2021-07-27 19:15:32', '2021-07-27 19:15:32'),
(205, 174, 2, 1, '2021-07-29 07:52:07', '2021-07-29 07:52:07'),
(206, 174, 29, 0, '2021-07-29 07:52:07', '2021-07-29 07:52:07'),
(209, 176, 2, 1, '2021-07-29 08:14:53', '2021-07-29 08:14:53'),
(210, 176, 29, 0, '2021-07-29 08:14:53', '2021-07-29 08:14:53'),
(211, 177, 1, 1, '2021-07-29 20:45:16', '2021-07-29 20:45:16'),
(212, 178, 2, 1, '2021-07-30 09:04:43', '2021-07-30 09:04:43'),
(213, 178, 29, 0, '2021-07-30 09:04:43', '2021-07-30 09:04:43'),
(214, 179, 2, 1, '2021-07-30 22:09:06', '2021-07-30 22:09:06'),
(215, 179, 29, 0, '2021-07-30 22:09:06', '2021-07-30 22:09:06'),
(216, 183, 2, 1, '2021-07-30 22:24:04', '2021-07-30 22:24:04'),
(217, 183, 29, 0, '2021-07-30 22:24:04', '2021-07-30 22:24:04'),
(218, 184, 2, 1, '2021-07-30 23:10:28', '2021-07-30 23:10:28'),
(219, 184, 29, 0, '2021-07-30 23:10:28', '2021-07-30 23:10:28'),
(220, 185, 2, 1, '2021-07-30 23:15:10', '2021-07-30 23:15:10'),
(221, 185, 29, 0, '2021-07-30 23:15:10', '2021-07-30 23:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_permissions`
--

CREATE TABLE `user_group_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) NOT NULL DEFAULT 0,
  `action_id` bigint(20) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:active,0:in-active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_group_permissions`
--

INSERT INTO `user_group_permissions` (`id`, `group_id`, `action_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 1, NULL, NULL),
(3, 1, 3, 1, NULL, NULL),
(4, 1, 4, 1, NULL, NULL),
(5, 1, 5, 1, NULL, NULL),
(6, 1, 6, 1, NULL, NULL),
(7, 1, 7, 1, NULL, NULL),
(8, 1, 8, 1, NULL, NULL),
(9, 1, 9, 1, NULL, NULL),
(10, 1, 10, 1, NULL, NULL),
(11, 1, 11, 1, NULL, NULL),
(12, 1, 12, 1, '2020-04-09 08:26:07', '2020-04-09 08:26:07'),
(15, 1, 15, 1, '2020-04-09 18:50:37', '2020-04-09 18:50:37'),
(16, 1, 16, 1, '2020-04-10 04:54:39', '2020-04-10 04:54:39'),
(17, 1, 17, 1, '2020-04-10 04:55:22', '2020-04-10 04:55:22'),
(18, 1, 18, 1, '2020-04-10 04:55:36', '2020-04-10 04:55:36'),
(19, 1, 19, 1, '2020-04-10 04:56:36', '2020-04-10 04:56:36'),
(20, 1, 20, 1, '2020-04-10 05:26:19', '2020-04-10 05:26:19'),
(39, 27, 1, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(40, 27, 2, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(41, 27, 3, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(42, 27, 4, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(43, 27, 5, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(44, 27, 6, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(45, 27, 7, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(46, 27, 8, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(47, 27, 9, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(48, 27, 10, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(49, 27, 11, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(50, 27, 12, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(51, 27, 15, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(52, 27, 16, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(53, 27, 17, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(54, 27, 18, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(55, 27, 19, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(56, 27, 20, 0, '2020-04-12 23:59:15', '2020-04-12 23:59:15'),
(331, 1, 93, 1, '2021-07-18 23:40:08', '2021-07-18 23:40:08'),
(332, 2, 93, 0, '2021-07-18 23:40:08', '2021-07-18 23:40:08'),
(333, 27, 93, 0, '2021-07-18 23:40:08', '2021-07-18 23:40:08'),
(334, 29, 93, 0, '2021-07-18 23:40:08', '2021-07-18 23:40:08'),
(335, 1, 94, 1, '2021-07-18 23:41:54', '2021-07-18 23:41:54'),
(336, 2, 94, 0, '2021-07-18 23:41:54', '2021-07-18 23:41:54'),
(337, 27, 94, 0, '2021-07-18 23:41:54', '2021-07-18 23:41:54'),
(338, 29, 94, 0, '2021-07-18 23:41:54', '2021-07-18 23:41:54'),
(339, 1, 95, 1, '2021-07-18 23:42:12', '2021-07-18 23:42:12'),
(340, 2, 95, 0, '2021-07-18 23:42:12', '2021-07-18 23:42:12'),
(341, 27, 95, 0, '2021-07-18 23:42:12', '2021-07-18 23:42:12'),
(342, 29, 95, 0, '2021-07-18 23:42:12', '2021-07-18 23:42:12'),
(343, 1, 96, 1, '2021-07-19 01:32:44', '2021-07-19 01:32:44'),
(344, 2, 96, 0, '2021-07-19 01:32:44', '2021-07-19 01:32:44'),
(345, 27, 96, 0, '2021-07-19 01:32:44', '2021-07-19 01:32:44'),
(346, 29, 96, 0, '2021-07-19 01:32:44', '2021-07-19 01:32:44'),
(355, 1, 99, 1, '2021-07-24 19:08:05', '2021-07-24 19:08:05'),
(356, 2, 99, 1, '2021-07-24 19:08:05', '2021-07-24 19:08:05'),
(357, 27, 99, 0, '2021-07-24 19:08:05', '2021-07-24 19:08:05'),
(358, 29, 99, 0, '2021-07-24 19:08:05', '2021-07-24 19:08:05'),
(359, 1, 100, 1, '2021-07-25 11:59:14', '2021-07-25 11:59:14'),
(360, 2, 100, 1, '2021-07-25 11:59:14', '2021-07-25 11:59:14'),
(361, 27, 100, 0, '2021-07-25 11:59:14', '2021-07-25 11:59:14'),
(362, 29, 100, 0, '2021-07-25 11:59:14', '2021-07-25 11:59:14'),
(363, 1, 101, 1, '2021-07-25 12:00:11', '2021-07-25 12:00:11'),
(364, 2, 101, 1, '2021-07-25 12:00:11', '2021-07-25 12:00:11'),
(365, 27, 101, 0, '2021-07-25 12:00:11', '2021-07-25 12:00:11'),
(366, 29, 101, 0, '2021-07-25 12:00:11', '2021-07-25 12:00:11'),
(367, 1, 102, 1, '2021-07-25 12:00:38', '2021-07-25 12:00:38'),
(368, 2, 102, 1, '2021-07-25 12:00:38', '2021-07-25 12:00:38'),
(369, 27, 102, 0, '2021-07-25 12:00:38', '2021-07-25 12:00:38'),
(370, 29, 102, 0, '2021-07-25 12:00:38', '2021-07-25 12:00:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_actions_menus` (`module_id`),
  ADD KEY `FK_actions_menus_2` (`is_menu`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_members`
--
ALTER TABLE `user_group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_group_members_users` (`user_id`),
  ADD KEY `FK_user_group_members_user_groups` (`group_id`);

--
-- Indexes for table `user_group_permissions`
--
ALTER TABLE `user_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_group_permissions_user_groups` (`group_id`),
  ADD KEY `FK_user_group_permissions_actions` (`action_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_group_members`
--
ALTER TABLE `user_group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `user_group_permissions`
--
ALTER TABLE `user_group_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `FK_actions_menus` FOREIGN KEY (`module_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `FK_actions_menus_2` FOREIGN KEY (`is_menu`) REFERENCES `menus` (`id`);

--
-- Constraints for table `user_group_members`
--
ALTER TABLE `user_group_members`
  ADD CONSTRAINT `FK_user_group_members_user_groups` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`),
  ADD CONSTRAINT `FK_user_group_members_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_group_permissions`
--
ALTER TABLE `user_group_permissions`
  ADD CONSTRAINT `FK_user_group_permissions_actions` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`),
  ADD CONSTRAINT `FK_user_group_permissions_user_groups` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
