-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-07 11:02:11
-- 服务器版本： 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakeshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `adminlist`
--

CREATE TABLE `adminlist` (
  `adminnumber` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `pwd` varchar(30) DEFAULT NULL,
  `addr` varchar(30) DEFAULT NULL,
  `phon` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `adminlist`
--

INSERT INTO `adminlist` (`adminnumber`, `name`, `pwd`, `addr`, `phon`, `email`) VALUES
(1, 'wildman', '123456789', 'V16 628', '15919208549', 'm730026028@mail.uic.edu.hk');

-- --------------------------------------------------------

--
-- 表的结构 `booklist`
--

CREATE TABLE `booklist` (
  `orderNo` int(10) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `cakestyle` varchar(1) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `chocolate` varchar(1) DEFAULT NULL,
  `fruit` varchar(1) DEFAULT NULL,
  `oreo` varchar(1) DEFAULT NULL,
  `candy` varchar(1) DEFAULT NULL,
  `nut` varchar(1) DEFAULT NULL,
  `jelly` varchar(1) DEFAULT NULL,
  `giftcard` varchar(1) DEFAULT NULL,
  `comment` text,
  `city` varchar(30) DEFAULT NULL,
  `phoneNO` varchar(20) DEFAULT NULL,
  `complete` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `booklist`
--

INSERT INTO `booklist` (`orderNo`, `username`, `cakestyle`, `size`, `time`, `chocolate`, `fruit`, `oreo`, `candy`, `nut`, `jelly`, `giftcard`, `comment`, `city`, `phoneNO`, `complete`) VALUES
(1, 'wildman', 'A', 'Small', '2018-06-07 07:25:05', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'yoooooo', 'v16 645', '12345678911', 'N'),
(2, 'wildman', 'A', 'Small', '2018-06-07 07:26:02', 'Y', 'Y', 'F', 'F', 'F', 'F', 'F', 'TRYETYTERY', 'v16 645', '12345678911', 'Y'),
(3, 'FRANK', 'B', 'Large', '2018-06-07 07:30:18', 'Y', 'Y', 'Y', 'Y', 'F', 'Y', 'F', 'tuuuuuuu', 'v16 632', '12345678911', 'Y');

-- --------------------------------------------------------

--
-- 表的结构 `userlist`
--

CREATE TABLE `userlist` (
  `name` varchar(30) DEFAULT NULL,
  `pwd` varchar(30) DEFAULT NULL,
  `addr` varchar(30) DEFAULT NULL,
  `phon` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `usernumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `userlist`
--

INSERT INTO `userlist` (`name`, `pwd`, `addr`, `phon`, `email`, `usernumber`) VALUES
('frank', '13579', 'V16 225', '123456778', 'asdjfafsasfaw', 1),
('m730026028', 'Rirud-/-/254K', 'V16 628', '15919208549', 'harryttt@126.com', 2),
('wildman', 'Rirud-/-/254K', 'V16 628', '15919208549', 'harryttt@126.com', 3),
('123', 'Rirud-/-/254K', 'V16 628', '15919208549', 'harryttt@126.com', 7),
('HARRU', 'Rirud-/-/254K', 'V16 628', '15919208549', 'harryttt@126.com', 8),
('ecwu', 'Qsddt-=123Q', 'V20 628', '14778945611', 'harryttt@126.com', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlist`
--
ALTER TABLE `adminlist`
  ADD PRIMARY KEY (`adminnumber`);

--
-- Indexes for table `booklist`
--
ALTER TABLE `booklist`
  ADD PRIMARY KEY (`orderNo`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`usernumber`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `adminlist`
--
ALTER TABLE `adminlist`
  MODIFY `adminnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `booklist`
--
ALTER TABLE `booklist`
  MODIFY `orderNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `userlist`
--
ALTER TABLE `userlist`
  MODIFY `usernumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
