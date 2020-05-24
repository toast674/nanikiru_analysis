-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2020 年 5 月 24 日 05:15
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `NANIKIRU_ANALYSIS`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `books`
--

CREATE TABLE `books` (
  `id` int(4) NOT NULL COMMENT 'id',
  `title` varchar(100) NOT NULL COMMENT 'タイトル',
  `path` varchar(100) NOT NULL COMMENT '画像ファイルパス'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `books`
--

INSERT INTO `books` (`id`, `title`, `path`) VALUES
(1, 'これだけで勝てる！麻雀の基本形80', 'book1.jpg'),
(2, 'ウザク式麻雀学習牌効率', 'book2.jpg'),
(3, '麻雀傑作「何切る」300選', 'book3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=4;
