-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 10:42 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swottanews`
--

-- --------------------------------------------------------

--
-- Table structure for table `addimage`
--

CREATE TABLE `addimage` (
  `id` int(11) NOT NULL,
  `link` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addimage`
--

INSERT INTO `addimage` (`id`, `link`, `description`, `type`) VALUES
(1, 'images/add/23add1.png', 'We are the world&#039;s stunt double.', 0),
(2, 'images/add/24add2.png', 'Save upto 50%', 0),
(3, 'images/add/25add3.png', 'We have a lot of customer growth FireHost can scale right along with us', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(2, 'Amrinder Sing', 'amrinder146@gmail.com', 'd0b1cb3d79295081b85fe3d00ce555645a74b38a'),
(5, 'Shohag', 'shohagsiraj.ru@gmail.com', 'aedfc79e79a8c43c5dfc6c6f8c161f90d0c89c04'),
(6, 'Admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `head` varchar(500) NOT NULL,
  `body` mediumtext NOT NULL,
  `image` varchar(500) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `head`, `body`, `image`, `createdat`) VALUES
(15, 'Bangladesh country profile', 'Bangladesh is one of the world&#039;s most densely populated countries, with its people crammed into a delta of rivers that empties into the Bay of Bengal. <br />\r\n<br />\r\n Bangladesh is one of the world&#039;s most densely populated countries, with its people crammed into a delta of rivers that empties into the Bay of Bengal<br />\r\n<br />\r\n <br />\r\n<br />\r\n Bangladesh is one of the world&#039;s most densely populated countries, with its people crammed into a delta of rivers that empties into the Bay of Bengal. <br />\r\n<br />\r\nBangladesh is one of the world&#039;s most densely populated countries, with its people crammed into a delta of rivers that empties into the Bay of Bengal. <br />\r\n<br />\r\nBangladesh is one of the world&#039;s most densely populated countries, with its people crammed into a delta of rivers that empties into the Bay of Bengal.<br />\r\n<br />\r\nBangladesh is one of the world&#039;s most densely populated countries, with its people crammed into a delta of rivers that empties into the Bay of Bengal.<br />\r\n<br />\r\nBangladesh is one of the world&#039;s most densely populated countries, with its people crammed into a delta of rivers that empties into the Bay of Bengal.', 'images//122bangladesh_map.png', '2017-05-07 12:05:23'),
(16, 'Bangladesh War', 'On 13 June 1971, an article in the UK&#039;s Sunday Times exposed the brutality of Pakistan&#039;s suppression of the Bangladeshi uprising. It forced the reporter&#039;s family into hiding and changed history.<br />\r\n<br />\r\n<br />\r\n<br />\r\nOn 13 June 1971, an article in the UK&#039;s Sunday Times exposed the brutality of Pakistan&#039;s suppression of the Bangladeshi uprising. It forced the reporter&#039;s family into hiding and changed history.<br />\r\n<br />\r\n<br />\r\n<br />\r\nOn 13 June 1971, an article in the UK&#039;s Sunday Times exposed the brutality of Pakistan&#039;s suppression of the Bangladeshi uprising. It forced the reporter&#039;s family into hiding and changed history.<br />\r\n<br />\r\n<br />\r\n<br />\r\nOn 13 June 1971, an article in the UK&#039;s Sunday Times exposed the brutality of Pakistan&#039;s suppression of the Bangladeshi uprising. It forced the reporter&#039;s family into hiding and changed history.<br />\r\n<br />\r\n<br />\r\n<br />\r\nOn 13 June 1971, an article in the UK&#039;s Sunday Times exposed the brutality of Pakistan&#039;s suppression of the Bangladeshi uprising. It forced the reporter&#039;s family into hiding and changed history.', 'images//121Bangladesh_war.png', '2017-05-07 12:06:04'),
(17, 'Bangladeshi London', 'The Bangladeshi community is thriving in the capital with third generation Bangladeshis on their way to establishing themselves in the mainstream of London commerce and politics.<br />\r\n<br />\r\nThe Bangladeshi community is thriving in the capital with third generation Bangladeshis on their way to establishing themselves in the mainstream of London commerce and politics.<br />\r\n<br />\r\nThe Bangladeshi community is thriving in the capital with third generation Bangladeshis on their way to establishing themselves in the mainstream of London commerce and politics.<br />\r\n<br />\r\nThe Bangladeshi community is thriving in the capital with third generation Bangladeshis on their way to establishing themselves in the mainstream of London commerce and politics.<br />\r\n<br />\r\nThe Bangladeshi community is thriving in the capital with third generation Bangladeshis on their way to establishing themselves in the mainstream of London commerce and politics.<br />\r\n<br />\r\nThe Bangladeshi community is thriving in the capital with third generation Bangladeshis on their way to establishing themselves in the mainstream of London commerce and politics.<br />\r\n<br />\r\nThe Bangladeshi community is thriving in the capital with third generation Bangladeshis on their way to establishing themselves in the mainstream of London commerce and politics.', 'images/article/111Bangladesi_london.png', '2017-05-07 12:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'WORLDNEWS'),
(2, 'BLOGS'),
(3, 'BUSINESS'),
(4, 'TECHNOLOGY'),
(5, 'POLITICAL'),
(6, 'STUDY'),
(7, 'ENTERTAINMENT'),
(8, 'SPORTS'),
(9, 'LIFE&STYLE');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(30) NOT NULL,
  `scid` int(20) NOT NULL,
  `cid` int(11) NOT NULL,
  `head` text NOT NULL,
  `body` mediumtext NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` text NOT NULL,
  `readcount` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `scid`, `cid`, `head`, `body`, `createdat`, `image`, `readcount`) VALUES
(10, 33, 1, 'Global Development', 'Bangladesh is already one of the most climate vulnerable nations in the world, and global warming will bring more floods, stronger cyclones. At the dry fish yards, close to the airport at the coastal town of Cox&rsquo;s Bazar, women are busy sorting fish to dry in the sun. They say the process, which begins in October, can continue through to February or March if the weather is good.', '2017-04-28 13:53:27', 'images/8Global_devolopment.png', 0),
(18, 13, 4, 'Facebook&#039;s purge disables hundreds of authentic Bangladeshi users profile', 'Facebook has waged an uphill war against fake news for the last couple of months now. And couple days back, it announced it&rsquo;s newest crusade: Fake accounts. In an announcement made by Facebook this Friday, the social media giant informed that it has launched a massive operation against a substantial number of accounts that it believes to be fake.', '2017-04-29 14:41:50', '', 0),
(19, 13, 4, 'Samsung announces pre-order of Galaxy S8 and S8+ in Bangladesh', ' Samsung unboxed the Galaxy S8 and S8+ in the Bangladesh Market. Preorders began on April 12 with exclusive bundle offer from Grameenphone. Customers can pre-book by visiting www.preorders8.com or www.grameenphone.com or from any Samsung store or Grameenphone center. In Bangladesh, the Galaxy S8 will be available in Midnight Black and Maple Gold.', '2017-04-29 14:44:58', '', 0),
(20, 13, 4, 'Dhaka 2nd among top cities with active Facebook users', ' Dhaka has been ranked second among the top cities across the world having active Facebook users, according to a recent study. Social media research organisations -- We Are Social and Hootsuite jointly conducted the study and revealed the information where Bangkok is the top city.', '2017-04-29 14:45:46', '', 0),
(21, 13, 4, 'The iPhone of cars? Apple enters self-driving car race', ' Ending years of speculation, Apple&rsquo;s late entry into a crowded field was made official Friday with the disclosure that the California Department of Motor Vehicles had awarded a permit for the company to start testing its self-driving car technology on public roads in the state. The permit covers three vehicles &mdash; all 2015 Lexus RX 450h hybrid SUVs &mdash; and six individual drivers. California law requires people to be in a self-driving car who can take control if something goes wrong.', '2017-04-29 14:46:20', '', 0),
(23, 3, 1, 'Testing running', ' ', '2017-05-06 15:26:28', 'images/contents/895141images.jpg', 0),
(28, 2, 1, 'test', ' test', '2017-05-07 09:06:17', 'images/contents/963.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `desk`
--

CREATE TABLE `desk` (
  `id` int(11) NOT NULL,
  `head` varchar(500) NOT NULL,
  `body` mediumtext NOT NULL,
  `image` varchar(500) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desk`
--

INSERT INTO `desk` (`id`, `head`, `body`, `image`, `createdat`) VALUES
(6, 'Dhaka celebrates Bengali new year', 'Bangladesh&#039;s capital enjoyed its colourful end-of-year festival amid high security.', 'images//119_95397241_migrantworkers.png', '2017-05-07 13:29:58'),
(7, 'Prime minister: Sheikh Hasina', 'Sheikh Hasina started a third term as prime minister in January 2014 after her Awami League won elections boycotted by the opposition amid an ongoing political crisis. Politics has long been dominated by bitter rivalry between two women: Sheikh Hasina and Khaleda Zia of the Bangladesh Nationalist Pa', 'images/desk/125cricket.png', '2017-05-07 13:30:43'),
(8, 'President: Abdul Hamid', 'Abdul Hamid, formerly the Speaker of parliament, was elected unopposed to the ceremonial post in 2013.', '', '2017-05-07 13:31:17'),
(9, 'Desk is under test', 'Testing desk time.', '', '2017-05-07 14:37:20'),
(10, 'News Desk Testing', 'News desk is testing for the time showing under each post.', '', '2017-05-09 08:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `editorial`
--

CREATE TABLE `editorial` (
  `id` int(11) NOT NULL,
  `head` varchar(500) NOT NULL,
  `body` mediumtext NOT NULL,
  `image` varchar(500) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `editorial`
--

INSERT INTO `editorial` (`id`, `head`, `body`, `image`, `createdat`) VALUES
(14, 'Greece farm shooting: Migrants win damages from state', 'Testing<br />\r\n<br />\r\nTesting Shohag<br />\r\n<br />\r\nTesting again', 'images//120Bangladesi_london.png', '2017-05-07 14:14:52'),
(15, 'Is Bangladesh winning the war against militants?', 'Testing Editorial<br />\r\n<br />\r\nTesting', 'images/editorial/114envoy_attack.png', '2017-05-07 14:17:28'),
(16, 'Bangladesh executes Islamist for 2004 British envoy attack', 'Testing Editorial', 'images/editorial/115militans.png', '2017-05-07 14:18:17'),
(17, 'Dhaka celebrates Bengali new year', 'Testing', 'images/editorial/116Bengali new year.png', '2017-05-07 14:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `head`, `image`, `type`, `createdat`) VALUES
(1, 'Mustafijur Rahman, a Bangladeshi medium fast bowler .', 'images/gallery/16cricket.png', 0, '2017-04-29 17:04:26'),
(2, 'Rampal Heat Electricity Project', 'images/gallery/17Rampal.png', 0, '2017-04-29 17:04:26'),
(3, 'Bus accident !! Bus fall in river from a bridge . ', 'images/gallery/18bangladesh_newspaper.png', 0, '2017-04-29 17:04:26'),
(4, 'Every person of every age want proper justice for the war criminals . ', 'images/gallery/19image_2.png', 0, '2017-04-29 17:04:26'),
(5, 'Hefajot E Islam road show.', 'images/gallery/20image1.png', 0, '2017-04-29 17:04:26'),
(6, 'Bull Fight at village area.', 'images/gallery/21bangladesh2.png', 0, '2017-04-29 17:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `photon`
--

CREATE TABLE `photon` (
  `id` int(10) NOT NULL,
  `count` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photon`
--

INSERT INTO `photon` (`id`, `count`) VALUES
(1, 128);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL,
  `type` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `description`, `link`, `type`) VALUES
(1, 'Surfer ', 'images/slider/341.jpg', 0),
(2, 'Buying', 'images/slider/35contentsImage2.jpg', 0),
(3, 'Little cute girl', 'images/slider/363.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(20) NOT NULL,
  `cid` int(20) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `cid`, `name`) VALUES
(2, 1, 'Middle East'),
(3, 1, 'US'),
(4, 2, 'EDITOR'),
(5, 2, 'CRYPTIC'),
(6, 2, 'PRICE'),
(7, 2, 'GENIUS'),
(8, 2, 'SPEEDY'),
(9, 3, 'CENSUS'),
(10, 3, 'MARKET'),
(11, 3, 'BUDGET'),
(12, 3, 'CLASSIFIEDS'),
(13, 4, 'SCIENCE'),
(14, 4, 'HEALTH'),
(15, 4, 'AGRICULTURE'),
(16, 5, 'DHAKA'),
(17, 5, 'CHITTAGONG'),
(18, 5, 'KHULNA'),
(19, 6, 'CAREER'),
(20, 6, 'COLLEGE'),
(21, 6, 'SCHOOL'),
(22, 7, 'ART'),
(23, 7, 'MOVIES'),
(24, 7, 'DANCE'),
(25, 7, 'MUSIC'),
(26, 8, 'FOOTBALL'),
(27, 8, 'CRICKET'),
(28, 8, 'TENNIS'),
(29, 8, 'LIVE SCORES'),
(30, 9, 'FASHION'),
(31, 9, 'FOOD'),
(33, 1, 'Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'najmul@gmail.com', '$2y$10$iusesomecrazystrings2ufKKB081n3f/8Ms9kQ/CjwCYmBs2ftqW'),
(2, 'student0@gmail.com', '$2y$10$iusesomecrazystrings2uz/HkvnvHFd41nowL3oLCmiMEM4CLQyW'),
(3, 'james@gmail.com', '$2y$10$iusesomecrazystrings2uz/HkvnvHFd41nowL3oLCmiMEM4CLQyW'),
(4, 'najmul2022@gmail.com', '$2y$10$iusesomecrazystrings2uz/HkvnvHFd41nowL3oLCmiMEM4CLQyW'),
(5, 'shohagsiraj.ru@gmail.com', '$2y$10$iusesomecrazystrings2usB4gT40Ccti7a1rP9hmZmNmi6.wurEG'),
(6, 'akash@gmail.com', '$2y$10$iusesomecrazystrings2uz/HkvnvHFd41nowL3oLCmiMEM4CLQyW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addimage`
--
ALTER TABLE `addimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desk`
--
ALTER TABLE `desk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addimage`
--
ALTER TABLE `addimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `desk`
--
ALTER TABLE `desk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `editorial`
--
ALTER TABLE `editorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
