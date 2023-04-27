-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 04:07 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `id_payment` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `photo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`id_payment`, `id_purchase`, `id_user`, `status`, `payment`, `photo`) VALUES
(1, 6, 4, 1, 92000, 'phoneix.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `id_product` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `harga` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`id_product`, `id_supplier`, `name`, `harga`) VALUES
(1, 4, 'egg', '5000'),
(3, 5, 'flour', '10000'),
(4, 4, 'rice', '12000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase`
--

CREATE TABLE `tb_purchase` (
  `id_purchase` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=rejected; 1=toBeApproved; 2=Approved; 3=Payed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_purchase`
--

INSERT INTO `tb_purchase` (`id_purchase`, `id_supplier`, `id_user`, `status`) VALUES
(6, 4, 4, 2),
(7, 5, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_detail`
--

CREATE TABLE `tb_purchase_detail` (
  `id_detail` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_purchase_detail`
--

INSERT INTO `tb_purchase_detail` (`id_detail`, `id_purchase`, `id_product`, `qty`, `harga_satuan`, `harga_total`) VALUES
(8, 6, '1', '4', 5000, 20000),
(9, 6, '4', '6', 12000, 72000),
(10, 7, '3', '4', 10000, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `name`) VALUES
(4, 'PT Test2'),
(5, 'PT Test1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `role`, `is_active`) VALUES
(4, 'admin', '$2y$10$kaI8cYQoFw8ErrQ1vdcs5.00Qy2VSTmMc7dYagpHO8PBZHlOaiZge', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Indexes for table `tb_purchase_detail`
--
ALTER TABLE `tb_purchase_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_purchase_detail`
--
ALTER TABLE `tb_purchase_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
