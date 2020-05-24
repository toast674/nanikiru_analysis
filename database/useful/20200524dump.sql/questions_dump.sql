-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2020 年 5 月 24 日 05:18
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `NANIKIRU_ANALYSIS`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `questions`
--

CREATE TABLE `questions` (
  `id` int(8) NOT NULL COMMENT 'id',
  `question_type_id` int(8) NOT NULL COMMENT '問題タイプ',
  `question` varchar(20) NOT NULL COMMENT '問題牌姿',
  `dora` varchar(4) NOT NULL COMMENT 'ドラ',
  `junme` int(4) NOT NULL COMMENT '巡目',
  `kyoku` varchar(10) NOT NULL COMMENT '局',
  `tya` varchar(4) NOT NULL COMMENT '家',
  `description` varchar(400) NOT NULL COMMENT '解答解説'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `questions`
--

INSERT INTO `questions` (`id`, `question_type_id`, `question`, `dora`, `junme`, `kyoku`, `tya`, `description`) VALUES
(1, 1, '455567m123789p66z', '1z', 6, '東一局', '西', '7mは4mの下位互換。5mと7mでは打点面で4mの方が優れている。'),
(2, 1, '578m55567p123567s', '1z', 6, '東一局', '西', '実質7mと8mの二択。良形のリーチピンフと愚形のリーチ三色ではリーチ三色の方が期待値が高い。'),
(3, 1, '22m224678p677889s', '9s', 6, '東一局', '西', '実質2pと4pの二択。より端に近く、待ちの種類が多いため4pを切ってのシャンポン待ちにとる。'),
(4, 2, '122378m45789p234s', '9p', 6, '東一局', '西', '2mを切りでのヘッドレス形が一番受け入れが多いが、両面が先に埋まると単騎待ちになってしまう。両面×2を生かす1m3m切りを推奨。安全度を考えて3mから切る。'),
(5, 2, '667m3445789p3445s', '9p', 6, '東一局', '西', 'ヘッドを固定して中ぶくれ×2の形にとる。中ぶくれは受け入れも広く良形率も高い。'),
(6, 2, '44r55m3578889p777z', '1z', 6, '東一局', '西', '3p5pを単体ターツとして見てしまうと4m切りがベターに見えるかもしれない。しかしピンズは複合形で、6pの受け入れが残る上イーペーコー三暗刻と打点も見れるため3pが優位。9p切りだとイーペーコーを逃す。'),
(7, 3, '4567m3445p112347s', '1z', 6, '東一局', '西', '四連形(ノベタン)や中ぶくれはくっつきの受け入れが広い。孤立牌よりも連続形を残す。'),
(8, 3, '34568m13458p357s7z', '1z', 3, '東一局', '西', 'ヘッドがない形。よりピンフを作りやすいように役牌よりも数牌を残す。2p引きでの連続形は嬉しいがタンヤオの目を残すため8pを残す。'),
(9, 3, '1345678m66789p1s7z', '1z', 3, '東一局', '西', 'イッツーの見える1mは残す。1sを残した方が受け入れ自体は多いもののくっついても愚形リーチのみになるため、ダイレクトでリーチ役牌の見える中を残す。6p引きの単騎待ちでもリーチが打てる。'),
(10, 4, '145899m136p24566z', '1z', 1, '東一局', '西', '役牌のみに頼ると安くて遠い手になる。ホンイツを見て6pを切る。あえて1mと南で比較するなら横伸びのある1mの方が強い。'),
(11, 4, '112m4899p689s2236z', '1z', 1, '東一局', '西', ''),
(12, 4, '169m1359p899s2466z', '1z', 1, '東一局', '西', '手なりで進行するには厳しい手。ホンイツ・チャンタ・国士を意識する。赤引きの縦への貢献度・ホンイツのなりやすさで5pよりも6mがおすすめ。'),
(13, 5, '245667m456p33499s', '1z', 6, '東一局', '西', '6巡目のイーシャンテンからタンヤオのためだけに9sは落とせない。3sと2mは受け入れ自体は同じだがピンフのなりやすさで3sに軍配が上がる。'),
(14, 5, '345m446688p45567s', '1z', 6, '東一局', '西', '飛びトイツ形として有名な形。4pよりも6pの方が受け入れが広い。'),
(15, 5, '455m445789p12388s', '1z', 6, '東一局', '西', '4pか5mを切ることで有名な「完全イーシャンテン」の基本形になる。赤の受け入れが残るため4pの方が優秀。'),
(16, 6, '13678m24777p3r599s', '1z', 6, '東一局', '西', 'ターツオーバー形なので一番価値の低いターツを落とす。9sは唯一のヘッドなので切らない。3pより2mの方が端に近い良い待ちなので2p4pを落とす。'),
(17, 6, '134568m3466p2367s', '1z', 6, '東一局', '西', '7sを切ることで5ブロックに構えることができるが、愚形残りになるので両面は落とさない。1mか8mだとタンヤオがつく分1m切りが優位。'),
(18, 6, '13m123r56p2355778s', '1z', 6, '東一局', '西', '実質1mか7sの二択。5ブロックに構えるなら1m切りだが三色の可能性が消える。最後までターツ選択の余地を残すため7sを切って6ブロックに受けたい形。');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=19;
