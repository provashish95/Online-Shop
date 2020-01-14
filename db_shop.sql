-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 07:04 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Tonmoy Roy', 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(15, 'CODING'),
(16, 'HP'),
(17, 'SUNLIGHT'),
(18, 'TOP TEN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `sId`, `productId`, `productName`, `price`, `quantity`, `image`) VALUES
(25, '4a8a9gfut84afk8jn5e7cjlf95', 35, 'HP COMPUTER', 200, 1, ''),
(31, '8krg8shaj2ss95eoll2ko9b8h8', 37, 'Winter cloth', 400, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(25, 'Cloth'),
(26, 'Electrical'),
(27, 'Computer'),
(28, 'Educational');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_compare`
--

INSERT INTO `tbl_compare` (`id`, `cmrId`, `productId`, `productName`, `price`, `image`) VALUES
(12, 8, 35, 'HP COMPUTER', 200, 'upload/62df2288fe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `pass`) VALUES
(7, 'Provashish Roy', 'manikgonj', 'Dhaka', 'Bangladesh', '1207', '01766552407', 'provashish95@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'Tonmoy Roy TONU', 'Ghior, Manikgonj', 'Manikgonj', 'Bangladesh', '1824', '0000000', 'roytonmoy95@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(53, 8, '37', 'Winter cloth', 1, 400.00, '', '2020-01-14 22:34:42', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `brandId` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,3) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `brandId`, `catId`, `body`, `price`, `image`, `type`) VALUES
(34, 'JAVA', 15, 28, '<p>java is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguagejava is a programming laguage</p>', 100.000, 'upload/70af5bf377.jpg', 0),
(35, 'HP COMPUTER', 16, 27, '<p>hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;hp computer is a gd computer&nbsp;</p>', 200.000, 'upload/62df2288fe.jpg', 0),
(36, 'Light', 17, 26, '<p>Sunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home designSunlight is good product for home design</p>', 300.000, 'upload/22c2ad3c20.png', 0),
(37, 'Winter cloth', 18, 25, '<p>winter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter seasonwinter cloth is best cloth for winter season</p>', 400.000, 'upload/afeb76270a.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist`
--

CREATE TABLE `tbl_wlist` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wlist`
--

INSERT INTO `tbl_wlist` (`id`, `cmrId`, `productId`, `productName`, `price`, `image`) VALUES
(28, 8, 36, 'Light', 300, 'upload/22c2ad3c20.png'),
(29, 8, 35, 'HP COMPUTER', 200, 'upload/62df2288fe.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
