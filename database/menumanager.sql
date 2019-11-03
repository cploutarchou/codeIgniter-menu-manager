-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 01:47 PM
-- Server version: 10.1.37-MariaDB

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menumanager`
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

INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (1, 0, 'Home', '/', '', 1, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (63, 62, 'new case', '#', '', 1, 8);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (62, 0, 't 3', '#', '', 3, 8);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (8, 0, 'Blog', '/blog', '', 2, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (9, 0, 'Products', '/products', '', 3, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (10, 9, 'Sample1', '/products/sample1', '', 1, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (11, 9, 'Product 2', '/sample1/product2', '', 2, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (12, 10, 'Test Sub Sub 1', '/products/sample1/product1', '', 1, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (13, 10, 'Test Sub Sub 2', '/products/sample1/product2', '', 2, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (14, 11, 'Test Product', '/products2/TestProduct', '', 1, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (15, 14, 'Test Product', '/products/TestProduct/TestProduct', '', 1, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (16, 15, 'Test Product', '/products/TestProduct/TestProduct', '', 1, 1);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (23, 0, 'Author Dashboard', '/author-dashboard', '', 1, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (24, 0, 'My Profile', '/member/profile', '', 2, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (25, 0, 'Settings', '/member/settings', '', 3, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (26, 25, 'Downloads', '/member/downloads', '', 3, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (27, 0, 'Bookmarks', '/member/bookmarks', '', 4, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (28, 0, 'Logout', '/logout.php', '', 5, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (29, 25, 'Profile', '/member/settings/profile', '', 1, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (30, 25, 'Change Password', '/member/settings/password', '', 2, 3);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (32, 31, 'Item 1.1', '', '', 1, 4);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (33, 31, 'Item 1.2', '', '', 2, 4);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (34, 0, 'Item 2', '', '', 2, 4);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (35, 34, 'Item 2.1', '', '', 1, 4);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (36, 35, 'Item 2.1.1', '', '', 1, 4);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (38, 34, 'Item 2.2', '', '', 2, 4);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (61, 55, 't 2.3.1', '#', '', 1, 8);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (55, 54, 't 2.2', '#', '', 1, 8);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (54, 0, 't 2', '#', '', 2, 8);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (52, 0, 't 1', '#', '', 1, 8);
INSERT INTO menu_manager.menu (id, parent_id, title, url, class, position, group_id) VALUES (53, 52, 't 1.1', '#', '', 1, 8);

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
(1, 'Main MenuController'),
(2, 'Footer MenuController'),
(3, 'Member MenuController'),
(4, 'Admin MenuController');

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
