-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 01:47 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easymenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `url`, `class`, `position`, `group_id`) VALUES
(1, 0, 'Homes', '/', '', 1, 1),
(63, 62, 'new case', '#', '', 1, 8),
(19, 0, 'Affiliate', '/affiliate.html', '', 1, 2),
(18, 0, 'Forum', '/forum', '', 2, 2),
(17, 0, 'Make Money', '/make-money.html', '', 3, 2),
(62, 0, 't 3', '#', '', 3, 8),
(8, 0, 'Blog', '/blog', '', 2, 1),
(9, 0, 'Products', '/products', '', 3, 1),
(10, 9, 'Handicraft', '/products/handicraft', '', 1, 1),
(11, 9, 'Furniture', '/products/furniture', '', 2, 1),
(12, 10, 'Tissue Box', '/products/handicraft/tissue', '', 1, 1),
(13, 10, 'Frame', '/products/handicraft/frame', '', 2, 1),
(14, 11, 'Cabinet', '/products/furniture/cabinet', '', 1, 1),
(15, 11, 'Chair', '/products/furniture/chair', '', 2, 1),
(16, 9, 'Tables', '/products/furniture/table', '', 3, 1),
(20, 0, 'Help', '/help', '', 4, 2),
(21, 20, 'Support Center', '/support-center.html', '', 1, 2),
(22, 20, 'Sitemap', '/sitemap.html', '', 3, 2),
(23, 0, 'Author Dashboard', '/author-dashboard', '', 1, 3),
(24, 0, 'My Profile', '/member/profile', '', 2, 3),
(25, 0, 'Settings', '/member/settings', '', 3, 3),
(26, 25, 'Downloads', '/member/downloads', '', 3, 3),
(27, 0, 'Bookmarks', '/member/bookmarks', '', 4, 3),
(28, 0, 'Logout', '/logout.php', '', 5, 3),
(29, 25, 'Profile', '/member/settings/profile', '', 1, 3),
(30, 25, 'Change Password', '/member/settings/password', '', 2, 3),
(31, 0, 'Item 1', '', '', 1, 4),
(32, 31, 'Item 1.1', '', '', 1, 4),
(33, 31, 'Item 1.2', '', '', 2, 4),
(34, 0, 'Item 2', '', '', 2, 4),
(35, 34, 'Item 2.1', '', '', 1, 4),
(36, 35, 'Item 2.1.1', '', '', 1, 4),
(37, 35, 'Item 2.1.2', '', '', 2, 4),
(38, 34, 'Item 2.2', '', '', 2, 4),
(39, 21, 'Popular Files', '/popular', '', 1, 2),
(40, 21, 'Top Authors', '/top', '', 2, 2),
(41, 20, 'Wordpress', '/wp', '', 2, 2),
(61, 55, 't 2.3.1', '#', '', 1, 8),
(55, 54, 't 2.2', '#', '', 1, 8),
(54, 0, 't 2', '#', '', 2, 8),
(52, 0, 't 1', '#', '', 1, 8),
(53, 52, 't 1.1', '#', '', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `title`) VALUES
(1, 'Main Menu'),
(2, 'Footer Menu'),
(3, 'Member Menu'),
(4, 'Admin Menu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
