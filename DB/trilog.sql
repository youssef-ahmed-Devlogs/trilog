-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 04:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trilog`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `avatar`
--

INSERT INTO `avatar` (`id`, `name`, `user`) VALUES
(2, '4.jpg', 2),
(3, '8.jpg', 1),
(4, '12.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  `user` bigint(20) NOT NULL,
  `post` bigint(20) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user`, `post`, `time`) VALUES
(2, 'gammed', 3, 11, '1647815377'),
(3, 'good mornnig my friend', 2, 21, '1647821675'),
(5, 'newwwwwwwww', 1, 31, '1647824597'),
(6, 'newwsssas', 1, 31, '1647824652'),
(7, 'ds', 1, 31, '1647824790'),
(8, 'ds', 1, 31, '1647824791'),
(9, 'ds', 1, 31, '1647824791'),
(10, 'ds', 1, 31, '1647824791'),
(11, 'ds', 1, 31, '1647824792'),
(12, 'ddddddddd', 1, 31, '1647824833'),
(13, '222222222222222', 1, 31, '1647824865'),
(14, 'dsadaaaaaaaaaaaaaaaaaaaaa', 1, 31, '1647824873'),
(15, 'ddddddddddddddddddd', 1, 31, '1647824878'),
(16, 'جميلة', 1, 10, '1647829532');

-- --------------------------------------------------------

--
-- Table structure for table `comments_likes`
--

CREATE TABLE `comments_likes` (
  `id` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `comment` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments_likes`
--

INSERT INTO `comments_likes` (`id`, `user`, `comment`) VALUES
(2, 1, 3),
(4, 2, 2),
(6, 1, 2),
(7, 1, 16),
(8, 1, 15),
(9, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `post` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user`, `post`) VALUES
(32, 2, 12),
(34, 2, 10),
(35, 2, 2),
(36, 2, 3),
(43, 1, 11),
(44, 1, 9),
(47, 1, 22),
(52, 1, 23),
(53, 1, 24),
(55, 1, 12),
(56, 1, 10),
(57, 1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(11) NOT NULL,
  `text` text NOT NULL,
  `images` text NOT NULL,
  `user` bigint(20) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `text`, `images`, `user`, `time`) VALUES
(2, 'Welcome my friends', '167954030527239.jpeg,440831186852562.jpeg,725373488376702.jpeg', 1, '1647799311'),
(3, 'this is my second post and its without photos. ????', '', 1, '1647799362'),
(5, 'gajldgjaldhfadfasdfadsf', '', 1, '1647799425'),
(7, 'new post 2', '868592317471461.jpeg', 2, '1647802232'),
(8, '', '214844905360800.jpeg', 2, '1647802953'),
(9, '', '999773332228044.jpeg,14176357172505.jpeg,784244609795790.jpeg,680324779918080.jpeg', 2, '1647803481'),
(10, '', '441042467872347.jpeg,210596929650855.jpeg', 2, '1647804227'),
(11, 'new amazing post', '1434915244125.jpeg,427790902021461.jpeg,265698647927955.jpeg,356952588021315.jpeg,166726143458226.jpeg,565313151181185.jpeg,324956462013909.jpeg', 2, '1647804412'),
(12, 'dasdasd', '', 2, '1647805775'),
(21, 'Good Morning', '192831518839608.jpeg,601767360395685.jpeg,703689168935511.jpeg', 1, '1647815323'),
(22, '', '714723904871559.jpeg,698810587052490.jpeg,644276793587229.jpeg', 1, '1647815377'),
(23, 'post gammed', '462423994975800.jpeg', 1, '1647821675'),
(24, 'dsadsadsad', '', 1, '1647823025'),
(25, 'dsad', '1785089523195.jpeg,13365658690461.jpeg', 1, '1647823037'),
(26, '', '934169954601906.jpeg,356021316287802.jpeg,922277940632235.jpeg,15801890392926.jpeg,140597797204161.jpeg,322696267755939.jpeg,416513826381807.jpeg,4685876815455.jpeg,25597293854616.jpeg,499280111625537.jpeg,248373970938918.jpeg,847810724208624.jpeg,676736701901766.jpeg,515987275182093.jpeg,39629837319930.jpeg,371812415000004.jpeg,936911834316513.jpeg', 1, '1647823121'),
(27, '', '321936304289886.jpeg,706944944405403.jpeg,351412010784450.jpeg,641191704257016.jpeg,565970944975227.jpeg,555158003087556.jpeg,263333253661038.jpeg,424122767651583.jpeg,14266925384778.jpeg,776833090271865.jpeg,986582575105677.jpeg,48155070621339.jpeg,369836705720691.jpeg,742950500459706.jpeg,369312036612849.jpeg', 1, '1647823244'),
(28, '', '779136380749782.jpeg,411626495003823.jpeg,389542569627222.jpeg,952970820557283.jpeg,975456827861670.jpeg,955647463966173.jpeg,465641142318891.jpeg,235047055753719.jpeg,223681089793986.jpeg,140975035716537.jpeg,85017154284315.jpeg', 1, '1647823301'),
(29, '', '476536223721789.jpeg,26574526891539.jpeg,141008807049066.jpeg,204739622920107.jpeg,392039507398473.jpeg,4574628181431.jpeg,381753892172862.jpeg,724456030701645.jpeg,695127827905236.jpeg,30870907840476.jpeg,856192659441273.jpeg,580583607642819.jpeg,342746830009188.jpeg,242472139061130.jpeg,421321068469521.jpeg,659661273305397.jpeg', 1, '1647823528'),
(30, '', '796644031219641.jpeg,351749887663383.jpeg,366696965426121.jpeg', 1, '1647823651'),
(31, '', '812996968052412.jpeg,897106663011735.jpeg', 1, '1647823663');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `reg_status` tinyint(4) NOT NULL DEFAULT 0,
  `verify_code` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `date_of_birth`, `gender`, `join_date`, `reg_status`, `verify_code`) VALUES
(1, 'Youssef', 'Ahmed', 'yossef96.ahmad@gmail.com', '4297f44b13955235245b2497399d7a93', '2000-11-04', 'male', '2022-03-20', 1, '44473'),
(2, 'Fatma', 'Ahmed', 'fatma@gmail.com', '4297f44b13955235245b2497399d7a93', '2000-10-27', 'female', '2022-03-20', 1, '95780'),
(3, 'Ahmed', 'Ali', 'ahmed.a@gmail.com', '3d186804534370c3c817db0563f0e461', '2000-06-14', 'male', '2022-03-20', 1, '28627');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_avatar` (`user`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comment` (`post`),
  ADD KEY `user_comment` (`user`);

--
-- Indexes for table `comments_likes`
--
ALTER TABLE `comments_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_like` (`comment`),
  ADD KEY `user_like_comment` (`user`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_like` (`post`),
  ADD KEY `user_like` (`user`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_posts` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments_likes`
--
ALTER TABLE `comments_likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `user_avatar` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_comment` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments_likes`
--
ALTER TABLE `comments_likes`
  ADD CONSTRAINT `comment_like` FOREIGN KEY (`comment`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_like_comment` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `post_like` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_like` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_posts` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
