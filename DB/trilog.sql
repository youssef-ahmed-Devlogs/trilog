-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 03:09 PM
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
(10, '699560691774516.jpeg', 1),
(11, '795393700275240.jpeg', 2),
(12, '742005112557951.jpeg', 2),
(13, '394165657822167.jpeg', 3),
(14, '38474302544964.jpeg', 3);

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
(177, 'Gammed', 2, 97, '1648128719'),
(178, '❤️', 1, 98, '1648128985'),
(179, 'gammed gdn', 3, 98, '1648129658'),
(180, 'صباح النور ❤️', 2, 99, '1648130095'),
(181, 'الف مبروك', 2, 100, '1648130112'),
(182, 'true ❤️', 2, 102, '1648130688'),
(183, 'جمدااان', 3, 102, '1648130818'),
(184, 'جامد جدا ده', 3, 102, '1648130835');

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
(23, 1, 177),
(24, 2, 178),
(25, 3, 178),
(26, 3, 182);

-- --------------------------------------------------------

--
-- Table structure for table `comments_reply`
--

CREATE TABLE `comments_reply` (
  `id` bigint(20) NOT NULL,
  `reply` text NOT NULL,
  `user` bigint(20) NOT NULL,
  `comment` bigint(20) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments_reply`
--

INSERT INTO `comments_reply` (`id`, `reply`, `user`, `comment`, `time`) VALUES
(136, 'Thanks ', 1, 177, '1648128924'),
(137, 'thanks', 2, 178, '1648129006'),
(138, 'اقبلي الادد ', 3, 182, '1648130795');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) NOT NULL,
  `req_id` bigint(20) DEFAULT NULL,
  `send_user` bigint(20) NOT NULL,
  `req_user` bigint(20) NOT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `req_id`, `send_user`, `req_user`, `accepted`) VALUES
(91, 13, 3, 1, 1),
(92, 12, 1, 2, 1);

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
(89, 2, 97),
(90, 1, 98),
(91, 1, 97),
(92, 3, 97),
(93, 3, 98),
(94, 2, 100),
(95, 2, 102),
(96, 3, 102);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `chat_id` bigint(20) NOT NULL,
  `text` text NOT NULL,
  `send_user` bigint(20) NOT NULL,
  `req_user` bigint(20) NOT NULL,
  `time` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `chat_id`, `text`, `send_user`, `req_user`, `time`) VALUES
(95, 13, 'Hello Youssef', 3, 1, '1648129781'),
(96, 13, 'Hi ❤️', 1, 3, '1648129825'),
(97, 12, 'ازيك', 1, 2, '1648130314'),
(98, 12, 'الحمدلله ❤️', 2, 1, '1648130327'),
(99, 13, 'كيف حالك', 1, 3, '1648130358');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(11) NOT NULL,
  `text` text NOT NULL,
  `images` text NOT NULL,
  `user` bigint(20) NOT NULL,
  `time` varchar(255) NOT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `text`, `images`, `user`, `time`, `visibility`) VALUES
(97, 'Heros ❤️', '885581698983399.jpeg,118329435693018.jpeg,921546654768135.jpeg', 1, '1648128662', 1),
(98, 'Good Day ..', '22163511097233.jpeg,819727241427765.jpeg,989232369579729.jpeg,488116237434606.jpeg,614461447230048.jpeg,344972268833049.jpeg', 2, '1648128872', 1),
(99, 'صباح الفل', '', 3, '1648130023', 1),
(100, 'لابتوبي الجديد', '967690682253900.jpeg', 3, '1648130051', 1),
(101, 'مساء الخير', '', 2, '1648130211', 1),
(102, 'You don&#39;t have to be great to start .. but you have to start to be great ❤️', '', 1, '1648130517', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile_cover`
--

CREATE TABLE `profile_cover` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_cover`
--

INSERT INTO `profile_cover` (`id`, `name`, `user`) VALUES
(16, '572740076024424.jpeg', 1),
(17, '351788406201144.jpeg', 2),
(18, '327251685018654.jpeg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `id` bigint(20) NOT NULL,
  `post` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`id`, `post`, `user`) VALUES
(24, 97, 2),
(25, 97, 3),
(26, 100, 1),
(28, 98, 1),
(29, 102, 2),
(30, 99, 2);

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
  `bio` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `reg_status` tinyint(4) NOT NULL DEFAULT 0,
  `verify_code` varchar(60) DEFAULT NULL,
  `trust_user` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `bio`, `date_of_birth`, `gender`, `join_date`, `reg_status`, `verify_code`, `trust_user`) VALUES
(1, 'Youssef', 'Ahmed', 'yossef96.ahmad@gmail.com', '4297f44b13955235245b2497399d7a93', 'Software developer ❤️', '2000-11-04', 'male', '2022-03-20', 1, '44473', 1),
(2, 'Fatma', 'Mohammed', 'fatma@gmail.com', '4297f44b13955235245b2497399d7a93', 'I love fashion', '2000-10-27', 'female', '2022-03-20', 1, '95780', 0),
(3, 'Ahmed', 'Ali', 'ahmed.a@gmail.com', '4297f44b13955235245b2497399d7a93', 'bio 3', '2000-06-14', 'male', '2022-03-20', 1, '53176', 1);

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
-- Indexes for table `comments_reply`
--
ALTER TABLE `comments_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uesr_reply` (`user`),
  ADD KEY `comment_reply` (`comment`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `req_id` (`req_id`),
  ADD KEY `user_send` (`send_user`),
  ADD KEY `user_req` (`req_user`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_like` (`post`),
  ADD KEY `user_like` (`user`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_user` (`send_user`),
  ADD KEY `requester_user` (`req_user`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_posts` (`user`);

--
-- Indexes for table `profile_cover`
--
ALTER TABLE `profile_cover`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profile_cover` (`user`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_saved` (`user`),
  ADD KEY `post_saved` (`post`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `comments_likes`
--
ALTER TABLE `comments_likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comments_reply`
--
ALTER TABLE `comments_reply`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `profile_cover`
--
ALTER TABLE `profile_cover`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- Constraints for table `comments_reply`
--
ALTER TABLE `comments_reply`
  ADD CONSTRAINT `comment_reply` FOREIGN KEY (`comment`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uesr_reply` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `user_req` FOREIGN KEY (`req_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_send` FOREIGN KEY (`send_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `post_like` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_like` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `requester_user` FOREIGN KEY (`req_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sender_user` FOREIGN KEY (`send_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_posts` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile_cover`
--
ALTER TABLE `profile_cover`
  ADD CONSTRAINT `user_profile_cover` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saved`
--
ALTER TABLE `saved`
  ADD CONSTRAINT `post_saved` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_saved` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
