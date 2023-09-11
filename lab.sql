-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-05-23 15:18:19
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `lab`
--

-- --------------------------------------------------------

--
-- 資料表結構 `buy`
--

CREATE TABLE `buy` (
  `sid` varchar(20) NOT NULL,
  `b_user` varchar(20) NOT NULL,
  `b_money` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `buy`
--

INSERT INTO `buy` (`sid`, `b_user`, `b_money`) VALUES
('2StysVep2s8IBQhswYxC', 'chcv1234', 1717),
('2StysVep2s8IBQhswYxC', 'M093040012', 1718),
('2StysVep2s8IBQhswYxC', 'admin', 1719),
('kLL5k5WUlUeGGxFm4dkb', 'chcv1234', 2000),
('Ye8Mcetk4kuV8ZzidTaH', 'chcv1234', 1000),
('Z6Ye4Avvbkjwjt9vkzCD', 'chcv1234', 888),
('kLL5k5WUlUeGGxFm4dkb', 'M093040012', 2021),
('y9Rg3SQ7Boq0IASCa7He', 'chcv1234', 1),
('Z6Ye4Avvbkjwjt9vkzCD', 'M093040012', 999),
('WGtuOlYvRspFfdTlTiZ3', 'chcv1234', 25),
('JQB3Gtkyv2g5E9AJMIHr', 'M093040012', 1300),
('JQB3Gtkyv2g5E9AJMIHr', 'admin', 9527),
('ecX7NeInURIKl96UaeEk', 'M093040012', 45),
('ecX7NeInURIKl96UaeEk', 'chcv1234', 50),
('ecX7NeInURIKl96UaeEk', 'admin', 47),
('nTz0qJOlUz09GpUPQNah', 'M093040012', 913),
('SYMHSGhHfBtQUieMrK7o', 'admin', 135),
('ecX7NeInURIKl96UaeEk', 'nsysu', 49),
('bAEcsRchxbnuOwOot9rH', 'M093040012', 444),
('d80ba6a0LhmJUVazKa9U', 'M093040012', 567),
('0enjGObhA4nskV6oi3Yz', 'M093040012', 987),
('0enjGObhA4nskV6oi3Yz', 'admin', 999);

-- --------------------------------------------------------

--
-- 資料表結構 `classification`
--

CREATE TABLE `classification` (
  `class` varchar(20) NOT NULL,
  `cname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `classification`
--

INSERT INTO `classification` (`class`, `cname`) VALUES
('1', '食品'),
('2', '民生'),
('3', '3C'),
('4', '圖書');

-- --------------------------------------------------------

--
-- 資料表結構 `commodity`
--

CREATE TABLE `commodity` (
  `pid` varchar(20) NOT NULL,
  `pname` varchar(20) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `class` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `commodity`
--

INSERT INTO `commodity` (`pid`, `pname`, `picture`, `class`) VALUES
('2i456OGhiK4jhRg0v8Fa', 'time', '/img/2i456OGhiK4jhRg0v8Fa.jpg', '4'),
('3VYbLL2av0fHNOMFJsTs', '留言', '/img/3VYbLL2av0fHNOMFJsTs.jpg', '4'),
('5gRsdH8OHlIQk2mWZZma', 'abc', '/img/5gRsdH8OHlIQk2mWZZma.jpg', '1'),
('CfUqpJ98N7bYahEZZRO8', 'time2', '/img/CfUqpJ98N7bYahEZZRO8.jpg', '1'),
('faZhVmS2QU3io1YXX78l', 'aaa', '/img/faZhVmS2QU3io1YXX78l.jpg', '1'),
('I6vrK3N6y0ISx57NE7pA', '測試', '/img/I6vrK3N6y0ISx57NE7pA.png', '3'),
('LoQeap48bjCGTpIjH0G7', '送流', '/img/LoQeap48bjCGTpIjH0G7.jpg', '4'),
('sEnCaPbBMMi03rSXgPWi', '洋蔥', '/img/sEnCaPbBMMi03rSXgPWi.jpg', '1'),
('vAy9FAw8FABgelZ3uzau', 'bbb', '/img/vAy9FAw8FABgelZ3uzau.jpg', '2'),
('Vid8f17rb7ksD2PeNbjI', '成吉思汗', '/img/Vid8f17rb7ksD2PeNbjI.jpg', '1'),
('xkACt27o8JZMse4cYqSw', '流', '/img/xkACt27o8JZMse4cYqSw.jpg', '4'),
('YfVB4dnlEQl01GfDw7hE', 'fff', '/img/YfVB4dnlEQl01GfDw7hE.jpg', '2'),
('zjYfpK0v2F4B1Me7Gj0R', 'aT', '/img/zjYfpK0v2F4B1Me7Gj0R.jpg', '3');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `sid` varchar(20) NOT NULL,
  `s_user` varchar(20) DEFAULT NULL,
  `b_user` varchar(20) NOT NULL,
  `context` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`sid`, `s_user`, `b_user`, `context`) VALUES
('2StysVep2s8IBQhswYxC', 'chcv1234', 'admin', '消失的商品'),
('JQB3Gtkyv2g5E9AJMIHr', 'M093040012', 'admin', '巴拉萊一卡'),
('Z6Ye4Avvbkjwjt9vkzCD', 'chcv1234', 'M093040012', '+%Z%'),
('0enjGObhA4nskV6oi3Yz', 'M093040012', 'admin', '留言測試');

-- --------------------------------------------------------

--
-- 資料表結構 `sell`
--

CREATE TABLE `sell` (
  `sid` varchar(20) NOT NULL,
  `s_user` varchar(20) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `s_money` int(10) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `send` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `sell`
--

INSERT INTO `sell` (`sid`, `s_user`, `start`, `end`, `s_money`, `pid`, `send`) VALUES
('0enjGObhA4nskV6oi3Yz', 'M093040012', '2021-05-01', '2021-05-16', 987, '3VYbLL2av0fHNOMFJsTs', 1),
('2StysVep2s8IBQhswYxC', 'chcv1234', '2021-04-01', '2021-05-13', 1717, '5gRsdH8OHlIQk2mWZZma', 1),
('bAEcsRchxbnuOwOot9rH', 'M093040012', '2021-05-24', '2021-05-31', 444, '2i456OGhiK4jhRg0v8Fa', 0),
('d80ba6a0LhmJUVazKa9U', 'M093040012', '2021-05-23', '2021-06-30', 567, 'CfUqpJ98N7bYahEZZRO8', 0),
('ecX7NeInURIKl96UaeEk', 'M093040012', '2021-05-01', '2021-05-31', 45, 'sEnCaPbBMMi03rSXgPWi', 0),
('JQB3Gtkyv2g5E9AJMIHr', 'M093040012', '2021-05-01', '2021-05-06', 1300, 'Vid8f17rb7ksD2PeNbjI', 1),
('kLL5k5WUlUeGGxFm4dkb', 'chcv1234', '2021-05-06', '2021-08-09', 2000, 'vAy9FAw8FABgelZ3uzau', 0),
('nTz0qJOlUz09GpUPQNah', 'M093040012', '2021-05-01', '2021-05-05', 913, 'xkACt27o8JZMse4cYqSw', 1),
('SYMHSGhHfBtQUieMrK7o', 'admin', '2021-05-01', '2021-05-09', 135, 'LoQeap48bjCGTpIjH0G7', 1),
('WGtuOlYvRspFfdTlTiZ3', 'chcv1234', '2021-05-01', '2021-05-30', 25, 'zjYfpK0v2F4B1Me7Gj0R', 0),
('y9Rg3SQ7Boq0IASCa7He', 'chcv1234', '2021-05-01', '2021-05-30', 1, 'I6vrK3N6y0ISx57NE7pA', 0),
('Ye8Mcetk4kuV8ZzidTaH', 'chcv1234', '2021-01-01', '2021-11-11', 1000, 'faZhVmS2QU3io1YXX78l', 0),
('Z6Ye4Avvbkjwjt9vkzCD', 'chcv1234', '2021-01-01', '2021-05-08', 888, 'YfVB4dnlEQl01GfDw7hE', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `user_list`
--

CREATE TABLE `user_list` (
  `user` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `ID` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user_list`
--

INSERT INTO `user_list` (`user`, `password`, `ID`, `phone`, `email`) VALUES
('admin', 'admin', 'Q741852963', '0987878787', 'chcv1234@csie.io'),
('chcv1234', 'cvc123', 'A123456789', '0977777777', 'email@yahoo.com.tw'),
('M093040012', '861111', 'Z285038726', '0978945612', 'rdrrs@gmail.com'),
('nsysu', 'nsysu', 'A138999460', '0956123478', 'ssssssss@gmail.com');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`class`);

--
-- 資料表索引 `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`pid`);

--
-- 資料表索引 `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
