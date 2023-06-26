-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-26 10:25:54
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `phpboard`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `passwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`username`, `passwd`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `board`
--

CREATE TABLE `board` (
  `boardid` int(11) UNSIGNED NOT NULL,
  `boardname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardsex` enum('男','女') COLLATE utf8_unicode_ci DEFAULT '男',
  `boardsubject` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardtime` datetime DEFAULT NULL,
  `boardmail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardweb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `boardcontent` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `board`
--

INSERT INTO `board` (`boardid`, `boardname`, `boardsex`, `boardsubject`, `boardtime`, `boardmail`, `boardweb`, `boardcontent`) VALUES
(8, 'RF', '男', 'GGG', '2023-06-12 17:34:30', '', '', 'rgrgrgrgrgrgrg'),
(9, 'NO', '男', 'HIHI', '2023-06-13 16:27:41', 'ddd@ffr.conr', '', 'GOGOG'),
(11, 'QQQQQQQQ', '男', 'QQQQQQQQQ', '2023-06-13 16:29:00', '', '', 'QQQQQQQQQQQQQQ'),
(12, 'rtuztu', '男', 'usruzu', '2023-06-16 10:43:42', 'uua', 's6ua6u', 'sua6ua6ik'),
(13, 'artartr', '女', 'artR', '2023-06-16 10:44:06', 'rtT', 'tT', 'YYYYYYYYYYYYYYY'),
(14, 'THETH', '女', 'REHARE', '2023-06-16 11:07:17', 'R4THH', 'RHrh', 'hH'),
(15, 'THETH', '女', 'REHARE', '2023-06-16 15:11:51', 'R4THH', 'RHrh', 'hH'),
(16, 'HHHHHHHHHHHHHHHHHHHHHHHH', '男', 'HHHHHHHHHHHH', '2023-06-16 15:12:06', 'HHHHHHHHHHHHH', 'HHHHHHHHHHHHHHHHHH', 'HHHHHHHHHHH'),
(17, 'HHHHHHHHHHHHHHHHHHHHHHHH', '男', 'HHHHHHHHHHHH', '2023-06-16 16:31:14', 'HHHHHHHHHHHHH', 'HHHHHHHHHHHHHHHHHH', 'HHHHHHHHHHH'),
(18, 'rrrrrrrrrrrrrrr', '男', 'rrrrrrrrr', '2023-06-16 16:31:25', 'rrrrrrrrr', 'rrrrrrrrr', 'rrrrrrrrr'),
(19, 'rrrrrrrrrrrrrrr', '男', 'rrrrrrrrr', '2023-06-16 16:31:49', 'rrrrrrrrr', 'rrrrrrrrr', 'rrrrrrrrr'),
(20, 'AAAAAAAAA', '男', 'AAAAAAAAA', '2023-06-16 16:31:55', 'AAAAAAAAA', 'AAAAAAAAA', 'AAAAAAAAA'),
(23, '小明', '女', 'BB', '2023-06-16 16:43:32', 'CCCCCCC', 'DDDDDDDD', 'WHY明天要上班'),
(26, 'Y1', '男', 'Y2', '2023-06-16 16:46:31', 'Y3', 'Y4', 'Y5'),
(27, '', '男', '明天要上班 今天禮拜五', '2023-06-16 16:46:56', '', '', ''),
(31, 'dd', '男', 'dd', '2023-06-16 17:34:19', 'dd', 'dd', 'dd'),
(32, '帝皇', '男', '戰鎚', '2023-06-16 17:34:37', '44', '44', '好好玩'),
(37, '小子', '男', '神奇寶貝', '2023-06-19 10:15:16', '', '', '皮卡修最強'),
(57, '大目博士', '男', '使用', '2023-06-26 15:53:46', 'nnn', 'eee', '十萬伏特');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- 資料表索引 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`boardid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board`
--
ALTER TABLE `board`
  MODIFY `boardid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
