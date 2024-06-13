-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2023 at 02:32 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `beemart`
--

-- --------------------------------------------------------

--
-- Table structure for table `baocaobanhang`
--

CREATE TABLE `baocaobanhang` (
  `SpID` int(10) NOT NULL auto_increment,
  `maSanPham` int(10) NOT NULL,
  `thangBanHang` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `soLuongTonKho` int(10) NOT NULL,
  `soLuongDaBan` int(10) NOT NULL,
  `giaBan` double NOT NULL,
  PRIMARY KEY  (`SpID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `baocaobanhang`
--

INSERT INTO `baocaobanhang` (`SpID`, `maSanPham`, `thangBanHang`, `soLuongTonKho`, `soLuongDaBan`, `giaBan`) VALUES
(1, 103, '2023-12-10 12:27:25', 10, 25, 7000000),
(2, 104, '2023-12-10 12:27:42', 6, 14, 2000000),
(3, 105, '2023-12-10 12:02:55', 10, 20, 400000),
(4, 106, '2023-12-10 12:02:55', 8, 30, 2100000),
(5, 107, '2023-12-10 12:02:55', 15, 40, 1350000),
(6, 108, '2023-12-10 12:02:55', 12, 15, 200000),
(7, 109, '2023-12-10 12:02:55', 7, 12, 1000000),
(8, 110, '2023-12-10 12:02:55', 6, 16, 2000000),
(9, 111, '2023-12-10 12:02:55', 15, 10, 20000),
(10, 112, '2023-12-10 12:03:36', 7, 12, 2900000);
