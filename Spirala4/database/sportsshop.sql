-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2017 at 07:40 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportsshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikli`
--

CREATE TABLE `artikli` (
  `artikalid` int(11) NOT NULL,
  `naziv` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `cijena` double NOT NULL,
  `tip` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(22) COLLATE utf8_slovenian_ci NOT NULL,
  `prezime` varchar(22) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(44) COLLATE utf8_slovenian_ci NOT NULL,
  `korisnicko_ime` varchar(44) COLLATE utf8_slovenian_ci NOT NULL,
  `sifra` varchar(44) COLLATE utf8_slovenian_ci NOT NULL,
  `rola` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `email`, `korisnicko_ime`, `sifra`, `rola`) VALUES
(35, 'Admin', 'Admin', 'admin@admin.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skladiste`
--

CREATE TABLE `skladiste` (
  `ID` int(11) NOT NULL,
  `STANJE` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `slikaid` int(11) NOT NULL,
  `lokacija` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikli`
--
ALTER TABLE `artikli`
  ADD UNIQUE KEY `naziv` (`naziv`),
  ADD KEY `artikalid` (`artikalid`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `skladiste`
--
ALTER TABLE `skladiste`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD UNIQUE KEY `slikaid` (`slikaid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `skladiste`
--
ALTER TABLE `skladiste`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikli`
--
ALTER TABLE `artikli`
  ADD CONSTRAINT `artikli_ibfk_1` FOREIGN KEY (`artikalid`) REFERENCES `skladiste` (`ID`);

--
-- Constraints for table `slike`
--
ALTER TABLE `slike`
  ADD CONSTRAINT `slike_ibfk_1` FOREIGN KEY (`slikaid`) REFERENCES `skladiste` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
