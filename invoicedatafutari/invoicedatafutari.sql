-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 03:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoicedatafutari`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `access` int(11) NOT NULL,
  `accessname` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`access`, `accessname`) VALUES
(1, 'Admin'),
(2, 'Member'),
(3, 'Visitor');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientid` int(11) NOT NULL,
  `compnames` varchar(55) NOT NULL,
  `compaddress` varchar(55) NOT NULL,
  `compcontnum` int(12) NOT NULL,
  `customernem` varchar(55) NOT NULL,
  `manageria` varchar(55) NOT NULL,
  `comlog` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientid`, `compnames`, `compaddress`, `compcontnum`, `customernem`, `manageria`, `comlog`) VALUES
(3, 'Futari Mecca Utama', 'Perduaan Gituplak', 2147483647, 'Aksdjasfoh', 'Gitupak Sandresno', '9869983f54dad864f7b87098d16bf958.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kateid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kateid`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `maindata`
--

CREATE TABLE `maindata` (
  `invoiceid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `payid` int(11) NOT NULL,
  `proid` int(11) NOT NULL,
  `quantity` int(12) NOT NULL,
  `unit` varchar(55) NOT NULL,
  `ppn` int(12) NOT NULL,
  `invoicenum` varchar(55) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `ponum` varchar(55) NOT NULL,
  `donum` varchar(55) NOT NULL,
  `termofpayment` int(12) NOT NULL,
  `currency` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payid` int(11) NOT NULL,
  `bankname` varchar(55) NOT NULL,
  `bankaccount` varchar(55) NOT NULL,
  `banknumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payid`, `bankname`, `bankaccount`, `banknumber`) VALUES
(5, 'OVO', 'Ahidi Nurhudin', '2147483648');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `proid` int(11) NOT NULL,
  `proname` varchar(55) NOT NULL,
  `prodesc` varchar(100) NOT NULL,
  `proimg` varchar(55) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`proid`, `proname`, `prodesc`, `proimg`, `price`) VALUES
(2, 'Lakban A103bs', 'Lakban ini adalah lakban dengan kedua yang sisi kuat, dapat menempelkan apapun dengan tekanan tinggi', 'f0ebd2268d1c54e0bfbf518e2b79370d.jpg', '4999');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status` int(11) NOT NULL,
  `statusdsp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status`, `statusdsp`) VALUES
(1, 'Online'),
(2, 'Ofline');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `access`, `username`, `password`, `status`) VALUES
(8, 1, 'tamu', '$2y$10$8Yt/kkKlt9Ftjf4U2gK7vesz1EGgVv.eeVNEN1a2eyYS/M2xWMmmO', '1'),
(9, 2, 'damn', '$2y$10$wtLe7Gwb48YXA0DJpkKteeX8YaRLIDNzrTnSrhTjpaDK5U6eSVQKK', '1'),
(13, 3, 'access', '$2y$10$/gego2AN5NgcwQMEZftup.6x8lLXS/yOcZpDvnQADq3riMc.T0JpW', '1'),
(15, 1, 'Admin Account', '$2y$10$X/1tibfLJvhPo8rHKfb3DuoVtdYJmU0RJpm94E5.rhQZ9gJRJCjhK', '1'),
(16, 2, 'Member Account', '$2y$10$szWid9JdPg7Q0twXbnNoXOJGG0BENiboV.7z1MAgnWXuIt7Lz3R8i', '1'),
(18, 2, 'status', '$2y$10$eNjs1Ed8cK8DXcWkGPXTKuBMF6CaCZ/1LYgD5UZ5wWK3S6.h7ckie', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`access`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kateid`);

--
-- Indexes for table `maindata`
--
ALTER TABLE `maindata`
  ADD PRIMARY KEY (`invoiceid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`proid`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maindata`
--
ALTER TABLE `maindata`
  MODIFY `invoiceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `proid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
