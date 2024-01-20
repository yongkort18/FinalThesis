-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 02:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catering_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_name`, `price`) VALUES
(42, 'package A', 800),
(45, 'Package C', 700);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `package_name`, `package_id`) VALUES
(6, 'product 2', 'package B'),
(7, 'product 2', 'package B');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(8, 'Clark ', 5, 'Thanks for your service', 1698569417),
(9, 'Clark ', 5, 'I love it ', 1698569424),
(10, 'Clark ', 1, 'Bad review', 1698569434),
(13, 'Clark', 5, 'Hi Here', 1700577305),
(26, 'clark dale layos', 0, 'wtf', 1704317363);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about`
--

CREATE TABLE `tbl_about` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `paragraph` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_about`
--

INSERT INTO `tbl_about` (`id`, `image`, `heading`, `paragraph`) VALUES
(7, '1703670954.png', 'About Loreto\'s', 'At Loreto\'s Event Management, we pride ourselves on being architects of unforgettable experiences. Whether it\'s a corporate affair, a milestone celebration, or a meticulously curated wedding, our dedicated team orchestrates every detail with precision and finesse.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_account`
--

CREATE TABLE `tbl_admin_account` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_account`
--

INSERT INTO `tbl_admin_account` (`id`, `name`, `username`, `password`, `type`) VALUES
(96, 'john smith', 'john', '$2y$10$Hm4zIPtPNPpwleQe1E0PP.vk828dsbr6MfnymlwkHnOlDpDTe3n4u', 'Admin'),
(105, 'Clark', 'casper', '$2y$10$IsaLjsffUMRurkaOd7GnQuF8NaalfjOM1ncsfb5eMYjzERMU/CBoq', 'Staff'),
(106, 'aaron', 'aaron', '$2y$10$qG6EHeSDuh8D6bHcSKzCtOXpCKBQZUXaeTqF2bONaLCCIGJz9G51i', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `Intro` varchar(1000) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `Intro`, `Location`, `Email`, `Phone`) VALUES
(1, 'Have a question or need assistance? We are here to help! Feel free to get in touch with us using the contact information below. Your inquiries and feedback are important to us, and we will respond promptly. Thank you for choosing Loreto\'s Event Management.', 'Canlubang, Calamba, Philippines', 'loretoseventmanagement@gmail.com', '(0912)-942-2005');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`id`, `question`, `answer`) VALUES
(4, '1. How much is Reservation fee? ', 'The Reservation Fee is only ₱75 pesos.'),
(16, '2. Do You Offer Venues Places', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_list`
--

CREATE TABLE `tbl_food_list` (
  `id` int(11) NOT NULL,
  `foodname` varchar(255) NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food_list`
--

INSERT INTO `tbl_food_list` (`id`, `foodname`, `package_id`) VALUES
(24, 'ice tea', 42),
(25, 'beef', 42),
(26, 'soup', 42),
(27, 'pasta', 42),
(28, 'dessert', 42),
(29, 'pork', 42),
(30, 'chicken', 42),
(40, 'Chicken Ala King', 45),
(41, 'Beef Hamonado', 45),
(42, 'Beef Salpicao', 45),
(43, 'Beef Morcon', 45);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance`
--

CREATE TABLE `tbl_maintenance` (
  `id` int(11) NOT NULL,
  `titlepage` varchar(255) NOT NULL,
  `navcolor` varchar(255) NOT NULL,
  `bgcolor` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_maintenance`
--

INSERT INTO `tbl_maintenance` (`id`, `titlepage`, `navcolor`, `bgcolor`, `image`) VALUES
(16, 'Loreto\'s Reservation System', 'Black', '', '1704272531.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `foodname` varchar(255) NOT NULL,
  `foodtype` varchar(255) NOT NULL,
  `foodprice` int(11) NOT NULL,
  `foodserving` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `foodname`, `foodtype`, `foodprice`, `foodserving`, `image`) VALUES
(81, 'Beef and Mushroom in Oyster Sauce', 'Beef', 3000, 'Tray', '1703961633.png'),
(82, 'Beef Broccoli', 'Beef', 3000, 'Tray', '1703961686.png'),
(83, 'Beef Caldereta', 'Beef', 3000, 'Tray', '1703961705.png'),
(84, 'Beef Hamonado', 'Beef', 3000, 'Tray', '1703961723.png'),
(85, 'Beef Kare-Kare', 'Beef', 3000, 'Tray', '1703961758.png'),
(86, 'Beef Morcon', 'Beef', 3000, 'Tray', '1703961780.png'),
(87, 'Beef Salpicao', 'Beef', 3000, 'Tray', '1703961800.png'),
(88, 'Beef Tapa', 'Beef', 3000, 'Tray', '1703961816.png'),
(89, 'Mechado', 'Beef', 3000, 'Tray', '1703961830.png'),
(90, 'Roast Beef', 'Beef', 3000, 'Tray', '1703961845.png'),
(91, 'Buffalo Chicken', 'Chicken', 2200, 'Tray', '1703961886.png'),
(92, 'Buttered Chicken with corn', 'Chicken', 2200, 'Tray', '1703961908.png'),
(93, 'Chicken Ala King', 'Chicken', 2200, 'Tray', '1703961927.png'),
(94, 'Chicken BBQ', 'Chicken', 2200, 'Tray', '1703961942.png'),
(95, 'Chicken Curry', 'Chicken', 2200, 'Tray', '1703961962.png'),
(96, 'Chicken Finger', 'Chicken', 2200, 'Tray', '1703961989.png'),
(97, 'Chicken in Salted Egg Sauce', 'Chicken', 2200, 'Tray', '1703962016.png'),
(98, 'Chicken Kebab', 'Chicken', 2200, 'Tray', '1703962031.png'),
(99, 'Chicken Pandan', 'Chicken', 2200, 'Tray', '1703962046.png'),
(100, 'Chicken Pastel', 'Chicken', 2200, 'Tray', '1703962070.png'),
(101, 'Chicken Teriyaki', 'Chicken', 2200, 'Tray', '1703962093.png'),
(102, 'Filipino Pineapple Chicken', 'Chicken', 2200, 'Tray', '1703962118.png'),
(103, 'Cordon Bleu', 'Chicken', 2200, 'Tray', '1703962155.png'),
(104, 'Friend Chicken', 'Chicken', 2200, 'Tray', '1703962175.png'),
(105, 'Tropical Chicken', 'Chicken', 2200, 'Tray', '1703962195.png'),
(106, 'Adobo', 'Pork', 2500, 'Tray', '1703962608.png'),
(107, 'Bicol Express', 'Pork', 2500, 'Tray', '1703962659.png'),
(108, 'Binagoongan', 'Pork', 2500, 'Tray', '1703962680.png'),
(109, 'Bopis', 'Pork', 2500, 'Tray', '1703962699.png'),
(110, 'Braised Pork', 'Pork', 2500, 'Tray', '1703962718.png'),
(111, 'Dinuguan', 'Pork', 2500, 'Tray', '1703962734.png'),
(112, 'Embutido', 'Pork', 2500, 'Tray', '1703962747.png'),
(113, 'Hamonado', 'Pork', 2500, 'Tray', '1703962766.png'),
(114, 'Hardinera', 'Pork', 2500, 'Tray', '1703962786.png'),
(115, 'Humba', 'Pork', 2500, 'Tray', '1703962804.png'),
(116, 'Kaldereta', 'Pork', 2500, 'Tray', '1703962819.png'),
(117, 'Kare-Kare', 'Pork', 2500, 'Tray', '1703962836.png'),
(118, 'Lechon Kawali', 'Pork', 2500, 'Tray', '1703962856.png'),
(119, 'Menudo', 'Pork', 2500, 'Tray', '1703962875.png'),
(120, 'Pork in Oyster Sauce', 'Pork', 2500, 'Tray', '1703962901.png'),
(121, 'Pork Siomai', 'Pork', 2500, 'Tray', '1703962919.png'),
(122, 'Shanghai', 'Pork', 2500, 'Tray', '1703962940.png'),
(123, 'Sisig', 'Pork', 2500, 'Tray', '1703962951.png'),
(124, 'Spare Ribs BBQ', 'Pork', 2500, 'Tray', '1703962970.png'),
(125, 'Sweet and Sour', 'Pork', 2500, 'Tray', '1703962989.png'),
(126, 'Tokwa at Baboy', 'Pork', 2500, 'Tray', '1703963009.png'),
(127, 'Daing na Bangus', 'Fish', 2200, 'Tray', '1703963099.png'),
(128, 'Fish Fillet in Black Beans', 'Fish', 2200, 'Tray', '1703963179.png'),
(129, 'Fish Fillet with Special Sauce', 'Fish', 2200, 'Tray', '1703963210.png'),
(130, 'Sweet and Sour Fish Fillet', 'Fish', 2200, 'Tray', '1703963250.png'),
(131, 'Relienong Bangus', 'Fish', 2200, 'Tray', '1703963285.png'),
(132, 'Bulalo Soup', 'Soup', 1500, 'Couldron', '1703963504.png'),
(133, 'Butternut Squash Soup', 'Soup', 1500, 'Couldron', '1703963540.png'),
(134, 'Crab and Corn Soup', 'Soup', 1500, 'Couldron', '1703963560.png'),
(135, 'Mushroom Soup', 'Soup', 1500, 'Couldron', '1703963587.png'),
(136, 'Beef Stroganoff', 'Pasta', 2100, 'Tray', '1703963704.png'),
(137, 'Carbonara', 'Pasta', 2100, 'Tray', '1703963741.png'),
(138, 'Chicken Alfredo', 'Pasta', 2100, 'Tray', '1703963803.png'),
(139, 'Chicken Pesto', 'Pasta', 2100, 'Tray', '1703963831.png'),
(140, 'Mac and Cheese', 'Pasta', 2100, 'Tray', '1703963845.png'),
(141, 'Spaghetti', 'Pasta', 2100, 'Tray', '1703963871.png'),
(142, 'Tuna Pesto', 'Pasta', 2500, 'Tray', '1703963889.png'),
(143, 'Bibingka Kanin', 'Kakanin', 1500, 'Bilao', '1703963967.png'),
(144, 'Kutsinta', 'Kakanin', 1500, 'Bilao', '1703963982.png'),
(145, 'Maja Blanca', 'Kakanin', 1500, 'Bilao', '1703964009.png'),
(146, 'Puto Cheese', 'Kakanin', 1500, 'Bilao', '1703964024.png'),
(147, 'Sapin-Sapin', 'Kakanin', 1500, 'Bilao', '1703964042.png'),
(148, 'Sinukmani', 'Kakanin', 1500, 'Bilao', '1703964059.png'),
(149, 'Banana Plantain in Caramel Syrup', 'Desserts', 250, 'Tub', '1703964230.png'),
(150, 'Buko Pandan', 'Desserts', 300, 'Tub', '1703964269.png'),
(151, 'Buko Salad', 'Desserts', 350, 'Tub', '1703964296.png'),
(152, 'Coffee Jelly', 'Desserts', 250, 'Tub', '1703964320.png'),
(153, 'Fruit Salad', 'Desserts', 300, 'Tub', '1703964348.png'),
(154, 'Gelatin', 'Desserts', 200, 'Tub', '1703964389.png'),
(155, 'Mixed Fruits', 'Desserts', 250, 'Tub', '1703964414.png'),
(156, 'Nata with Sago', 'Desserts', 250, 'Tub', '1703964460.png'),
(158, '121312', 'Pork', 0, 'Tray', '1704299073.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `food_package` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `pax` int(11) NOT NULL,
  `total` double NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`id`, `user_name`, `number`, `email`, `date`, `food_package`, `price`, `pax`, `total`, `image`) VALUES
(14, 'clark dale layos', 312312312, 'layos@gmail.com', '2024-01-18', 'package A', 800, 10, 8000, '1704317170.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `servicesType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `image`, `servicesType`) VALUES
(5, '1703965568.png', 'Weddings'),
(6, '1703965689.jpg', 'Private Party'),
(7, '1704203278.png', 'Birthday Party');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_account`
--

CREATE TABLE `tbl_users_account` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users_account`
--

INSERT INTO `tbl_users_account` (`id`, `firstname`, `lastname`, `middlename`, `email`, `password`) VALUES
(79, 'clark', 'layos', 'dale', 'layos@gmail.com', '$2y$10$xwYZ0ffKb25G4GQRd5aZ5uRpJXItLNfppa/EiFgROtBAtKqMt61cS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_account`
--
ALTER TABLE `tbl_admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_list`
--
ALTER TABLE `tbl_food_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_maintenance`
--
ALTER TABLE `tbl_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users_account`
--
ALTER TABLE `tbl_users_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_admin_account`
--
ALTER TABLE `tbl_admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_food_list`
--
ALTER TABLE `tbl_food_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_maintenance`
--
ALTER TABLE `tbl_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_users_account`
--
ALTER TABLE `tbl_users_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
