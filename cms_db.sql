-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 06:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_posts`
--

CREATE TABLE `cms_posts` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `content_text` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `featured_image` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_posts`
--

INSERT INTO `cms_posts` (`id`, `user_id`, `title`, `content_text`, `status`, `featured_image`, `created_at`, `updated_at`) VALUES
(1, 0, '[value-3]', '[value-4]', 0, '[value-6]', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

CREATE TABLE `cms_users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT 1,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `forgot_key` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`id`, `created_at`, `updated_at`, `status`, `email`, `first_name`, `last_name`, `password`, `forgot_key`) VALUES
(25, NULL, '2024-02-07 22:36:10', 1, 'admin@example.com', 'admin', NULL, 'admin@', 'B9sJOE'),
(26, NULL, '2024-02-08 09:20:24', 1, 'min@example.com', 'min', NULL, 'admin@123', NULL),
(27, NULL, '2024-02-08 15:59:36', 2, 'rohan@gmail.com', 'Rohan', '', 'admin@123', NULL),
(28, NULL, '2024-02-08 16:01:20', 1, 'rohit@gmial.com', 'Rohit', 'Yadav', 'admin@123', NULL),
(29, NULL, '2024-02-08 16:40:29', 2, 'adminn@example.com', 'admin', NULL, '1234', NULL),
(30, NULL, '2024-02-08 18:43:08', 2, 'sdsd@gmail.com', 'dsd', NULL, '12345', NULL),
(31, NULL, '2024-02-08 18:48:00', 2, 'admi47364@example.com', 'vhvhv', NULL, 'ewew', NULL),
(33, NULL, '2024-02-08 18:50:26', 2, 'dfxzfdnxhhgrhygcv@gmail.com', 'sdcadfzfdcfadf', NULL, '123', NULL),
(34, NULL, '2024-02-08 18:54:31', 2, 'sgfjjsbf@gmail.com', 'hhejbfdj', NULL, '1234', NULL);

--
-- Triggers `cms_users`
--
DELIMITER $$
CREATE TRIGGER `test_trigger` AFTER INSERT ON `cms_users` FOR EACH ROW BEGIN
    INSERT INTO cms_user_details (user_id) VALUES (NEW.id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_user_details`
--

CREATE TABLE `cms_user_details` (
  `mothers_name` varchar(150) DEFAULT NULL,
  `fathers_name` varchar(150) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `nationality` varchar(150) DEFAULT NULL,
  `adhar_number` bigint(12) DEFAULT NULL,
  `pan_number` varchar(10) DEFAULT NULL,
  `10th_percentage` decimal(5,2) DEFAULT NULL,
  `12th_percentage` decimal(5,2) DEFAULT NULL,
  `id` smallint(5) NOT NULL,
  `user_id` smallint(5) UNSIGNED DEFAULT NULL,
  `form_flag` smallint(3) DEFAULT 1,
  `grad_percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_user_details`
--

INSERT INTO `cms_user_details` (`mothers_name`, `fathers_name`, `dob`, `nationality`, `adhar_number`, `pan_number`, `10th_percentage`, `12th_percentage`, `id`, `user_id`, `form_flag`, `grad_percentage`) VALUES
('fdf', 'cfcfc', '2024-02-01', 'Bangladesh', 123456789012, 'asdfg1234q', 43.00, 43.00, 52, 25, 1, 23.00),
('dsd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, 26, 1, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, 27, 1, NULL),
('Seema Devi ', 'Sarthak sing', '2024-02-07', 'Bangladesh', NULL, NULL, 22.00, 44.00, 55, 28, 4, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, 29, 1, NULL),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, 34, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_posts`
--
ALTER TABLE `cms_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `cms_user_details`
--
ALTER TABLE `cms_user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_posts`
--
ALTER TABLE `cms_posts`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cms_user_details`
--
ALTER TABLE `cms_user_details`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cms_user_details`
--
ALTER TABLE `cms_user_details`
  ADD CONSTRAINT `fk_cms_user_details_user_id` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
