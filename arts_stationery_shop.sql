-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 10:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arts_stationery_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `arts_users`
--

CREATE TABLE `arts_users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_employee` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arts_users`
--

INSERT INTO `arts_users` (`id`, `fname`, `lname`, `email`, `pass`, `is_admin`, `is_employee`, `is_active`) VALUES
(1, 'Salas', 'Sadiq', 'salassadiq187@gmail.com', '123', 1, 0, 1),
(2, 'Haroon', 'Khalid', 'haroonkhalid@gmail.com', '$2y$10$9INJwrvjIYGOD1QuoE8of.vXNZuoSWyfpckNoj9loyqHAVee6w0da', 0, 1, 0),
(3, 'Haroon', 'Waris', 'haroonwaris@gmail.com', '$2y$10$hY05PkGnbjwzoU3d2oLlMuVoXyvo7kcv8z6fbXwBUDyDPPa7rDtsq', 0, 1, 1),
(4, 'Nabeel', 'Baleem', 'nabeelbaleem@gmail.com', '$2y$10$8oJCmxn7MSrk1Ewm2/Inu.PG1f.6o/9ohiQomQ3AhDn0Euvw9tfvW', 0, 1, 1),
(5, 'Robin', 'Javed', 'robinjaved@gmail.com', '$2y$10$10crB5XQdbqnWH2AkYgM7.mX8v4edVb18Q06NF/S.qujh88VblQRq', 0, 1, 0),
(6, 'Mehfoz', 'Anthony', 'mehfozanthony@gmail.com', '$2y$10$g/rVM/Cwp0J4LEVX3OSlyeP4fof3.0VoK/ppJFT1lepJl0sLdaT6S', 0, 1, 0),
(7, 'Sunil', 'Iqbal', 'suniliqbal@gmail.com', '$2y$10$hmIh0NDMOTfZ2ZvkZY18CO/2tVx9qKxbQdXF6AR5RakE9jhjqUc4W', 0, 1, 1),
(8, 'Sharoon', 'Grishna', 'sharoongrishna@gmail.com', '$2y$10$LHsBU3CbRax4RgLJFe/MAOd6NoyJqFZpqyT8AjoVP7SMpM4Z0C3i.', 0, 1, 1),
(9, 'jawaad', 'javed', 'jawaadjaved@gmail.com', '$2y$10$uB26kPEehj1bK2fzS/.9BuQkSh/lqYsIKIjkYoiN1Rgmb04ly1L6K', 0, 1, 1),
(10, 'Wasif', 'Alam', 'wasifalam@gmail.com', '$2y$10$D5e3ZnzRXfCYMh9eqLHene439toSnbHK13Rtpl7OWtgXrM8utySFi', 0, 1, 0),
(11, 'Anas', 'Imran', 'anasimran@gmail.com', '$2y$10$m4/ykXsd74XmjCvPbrisDOaDNG3qhg7SSVm5v1l9PVk7tQYudiwTW', 0, 1, 0),
(12, 'Mohammad', 'Ansari', 'mohammadansari@gmail.com', '$2y$10$alXmKL1egUG0rpIyxPm0ke8PnWoAHFw9GsuNX7Kouo560At3H7tlG', 0, 1, 1),
(13, 'Robin', 'Waris', 'haroonkhalid1@gmail.com', '$2y$10$iRV5kskhkut49wqZPa6HX.5HImcgHPI8cgN2Ho.fXKxExctUK8fC.', 0, 1, 1),
(14, 'babar', 'azam', 'babarazam@gmail.com', '$2y$10$x1ha7KWYIEGm2dQ3MhMFWe/BZtELUz48VDBlxg1b74j9AY1hUnh9a', 0, 1, 0),
(15, 'singam', 'bajirao', 'singambajirao@gmail.com', '$2y$10$zriwkrGtbY4o1HURI1g4feRBW0NtS2o1uAqQHAyUAYBrHkwiGtvlO', 0, 1, 1),
(16, 'Raja', 'Kamal', 'kamalraja123@gmail.com', '$2y$10$aw//ZX2OdlOevoZasxCMle.hz/G5J2EyUJTR1vYk7rWuTHRdnKU0a', 0, 1, 1),
(17, 'Seth', 'Rollins', 'sethrollins@gmail.com', '$2y$10$0A64Jdt7lzqFPp8Bw8URp.vXKcCp7WQLatlXCc096lGI3HTry/HES', 0, 1, 0),
(18, 'Roman', 'Reigns', 'romanreigns@gmail.com', '$2y$10$irOqEuShXPmfFpgLG5TlY.UGFKF0dEVwSnEW.Ap4mVSGf4DKlmLGe', 0, 1, 1),
(19, 'Shahrukh', 'Khan', 'shahrukhkhan@gmail.com', '$2y$10$AYZZ7CTeqpK93aBu0wZlaOl5f/gcJqXdFTryyRhRg7VfT98rVKxea', 0, 1, 0),
(20, 'Krishna', 'Kumar', 'krishnakumar@gmail.com', '$2y$10$xhWDXrGkqD87BZNuSI8z0.n./RxWIhfrcEKnzWrckjBdbzEEGjncW', 0, 1, 0),
(21, 'Sulman', 'Khan', 'sulmankhan@gmail.com', '$2y$10$IdnzSsocjWl.XAseqoK5mOMFgRxAvivbn31GEdzPTThBl2YVBOwOO', 0, 1, 1),
(22, 'Singh', 'Arijit', 'arijitsingh123@gmail.com', '$2y$10$T7i8pSCiql0r1fKnueoiAOHUIK98UlQonKRD4nfOC4/Z6ITv1h6rK', 0, 1, 0),
(23, 'Sam', 'David', 'samdavidsam@gmail.com', '$2y$10$EKnKmmCgnSWoktFnEg9RDOi61tqEvlD7h28Zym3g7p2h0g/XwJpPq', 0, 1, 0),
(24, 'Christopher', 'peter', 'peterchrishtoper@gmail.com', '$2y$10$N4t7IjVRRzNKi32bwLzLQ.aORr7FTasVrwn45OKTBN8jfh/mtQDwS', 0, 0, 1),
(25, 'Jason', 'Parker', 'jsonparker@gmail.com', '$2y$10$cDhon2M3qPkF03xW/Gl.OuhzQSfQrfRX6reOP3rhOnRRcIxTcGKLS', 0, 0, 1),
(26, 'Mason', 'Paul', 'masonpaul@gmail.com', '$2y$10$4.LeEvP9clNVYmI2rfjiYO3Pg6QPhlmBE5qsJVNZlJA.fRsl2sin6', 0, 0, 1),
(28, 'Tom', 'Jerry', 'tom&jerry@gmail.com', '$2y$10$lCrIQ6I0KRXCA9NyUL0O4.L4bHWVYFZdTE2fwF1SobSOVzR6hWo7W', 0, 0, 1),
(29, 'Jay', 'Mason', 'jaymason@gmail.com', '$2y$10$h3lcP5FwXJ4fexw3eQjRJeSnzXItorwEPshBi6NmcEFJMZm3xd6De', 0, 1, 1),
(30, 'New', 'User', 'newuser@gmail.com', '$2y$10$vigxod10RsZdiZ/X1n7N.O4E.xVsNB9qsEMNn8uikXZa8ZPZpSA3K', 0, 0, 1),
(31, 'recent', 'user', 'recentuser@gmail.com', '$2y$10$0D4L4qF9ErZs/4F6YWsO.uJeFmzW0SYOS41OlEF6acuz2grkLoRMu', 0, 0, 1),
(32, 'Sam', 'Nelson', 'samnelson@gmail.com', '$2y$10$VF1zBbVIjoyRdTjoQB/aUevNFNsxYLQt7rKpeg6Ja4BZBBXh4CVpq', 0, 0, 1),
(33, 'Kenneth', 'Wiz', 'kennethwiz@gmail.com', '$2y$10$dpo/mI8NiQhB3sHGmvT3Y.OUbrD9wgYJNbQBZTMsCRp79dhicM8H6', 0, 0, 1),
(34, 'Nabi', 'Salay', 'salastelecomagent57@gmail.com', '$2y$10$LqntMOH4I6.ZcQPiQtTFauiPISe10X8FtoLHAoXCeSvafPbtx3RXa', 0, 0, 1),
(35, 'Louis', 'Sadiq', 'louissadiq001@gmail.com', '$2y$10$yRWieIYwPCzg1lJtOhSsrOrWx5DJCJ5n79/Jy1mDBbYaqwltVZ5RO', 0, 1, 1),
(36, 'Vinces', 'John', 'vincesjohn@gmail.com', '$2y$10$Vu1noQD4kJXCiphV320ItOp4ql9iLl9MFhhKpSPnNDlS8G6LbcDT2', 0, 0, 1),
(37, 'James', 'Nelson', 'jamesnelson@gmail.com', '$2y$10$Yl26xvnm/gdXZ5suGc9FhuXyvGW7WO0Dtvb2bshhSKomb9uwsEIVC', 0, 0, 1),
(38, 'Vinces', 'Jerry', 'vincesjerry011@gmail.com', '$2y$10$B0ymdDzS4TyKHMugWfNxXuV/2nQwfiGTXvK1MEcg1ZSdgsubbfQE.', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` varchar(2) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `is_active`) VALUES
('01', 'pencils', 0),
('02', 'pens', 1),
('03', 'bags', 1),
('04', 'notebooks', 1),
('05', 'desk accessories', 1),
('06', 'markers', 1),
('07', 'art supplies', 1),
('08', 'stationery sets', 1),
('09', 'office furniture', 1),
('10', 'calendars and planners', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacttable`
--

CREATE TABLE `contacttable` (
  `id` int(11) NOT NULL,
  `personName` varchar(255) NOT NULL,
  `personEmail` varchar(255) NOT NULL,
  `personMessage` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacttable`
--

INSERT INTO `contacttable` (`id`, `personName`, `personEmail`, `personMessage`) VALUES
(1, 'Salas', 'salas@gmail.com', 'helo'),
(2, 'Salas', 'salas@gmail.com', 'helo');

-- --------------------------------------------------------

--
-- Table structure for table `forgetpass_requests`
--

CREATE TABLE `forgetpass_requests` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `forgetpassToken` varchar(255) NOT NULL,
  `tokenExpiry` varchar(255) NOT NULL,
  `has_used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forgetpass_requests`
--

INSERT INTO `forgetpass_requests` (`id`, `userEmail`, `forgetpassToken`, `tokenExpiry`, `has_used`) VALUES
(2, 'salastelecomagent57@gmail.com', '7765b8ef9290de4838e0f9af9d8515cbf72760f7fc2c47a97614340d34540955', '1703504629', 1),
(3, 'louissadiq001@gmail.com', 'c736491b15d50d128e4917efc5656306264d1ddd69dbcf5d8a1a697eb7671972', '1703535402', 1),
(4, 'jamesnelson@gmail.com', '2bd79022e0f01e3e2fe4b283918e3c90e5410adc51dea8c0ce7eed77c4ce7b50', '1703537188', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_number` varchar(16) NOT NULL,
  `product_id` varchar(7) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,1) NOT NULL,
  `total_price` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_number`, `product_id`, `quantity`, `price`, `total_price`) VALUES
('1080000100000001', '0200001', 3, 1.0, 3.0),
('1080000100000001', '0500001', 1, 13.0, 13.0),
('1080000100000001', '0800001', 2, 20.0, 40.0),
('2100000100000002', '0800002', 1, 50.0, 50.0),
('2100000100000002', '1000001', 2, 5.0, 10.0),
('1050000200000003', '0100001', 3, 2.0, 6.0),
('1050000200000003', '0100002', 1, 2.0, 2.0),
('1050000200000003', '0200001', 2, 1.0, 2.0),
('1050000200000003', '0300002', 1, 25.0, 25.0),
('1050000200000003', '0500002', 1, 30.0, 30.0),
('2040000200000004', '0400002', 1, 8.0, 8.0),
('1090000200000005', '0900002', 1, 150.0, 150.0),
('1090000200000005', '1000001', 1, 5.0, 5.0),
('1090000200000006', '0900002', 1, 150.0, 150.0),
('1090000200000006', '1000001', 2, 5.0, 10.0),
('2090000200000007', '0800001', 2, 20.0, 40.0),
('2090000200000007', '0900001', 1, 100.0, 100.0),
('2090000200000007', '0900002', 2, 150.0, 300.0),
('2100000200000008', '1000002', 2, 8.0, 16.0),
('1010000300000009', '0100003', 1, 0.0, 0.0),
('2100000200000010', '1000002', 2, 8.0, 16.0),
('2100000200000010', '0700002', 2, 7.0, 14.0),
('1090000100000011', '0900001', 1, 100.0, 100.0),
('1090000200000012', '0900002', 1, 150.0, 150.0),
('2080000100000013', '0800001', 1, 20.0, 20.0),
('1040000200000014', '0400002', 1, 8.0, 8.0),
('1010000100000015', '0100001', 2, 2.0, 4.0),
('1010000300000016', '0100003', 1, 0.0, 0.0),
('1010000300000016', '1000002', 2, 8.0, 16.0),
('2090000100000017', '0900001', 1, 100.0, 100.0),
('1090000200000018', '0900002', 1, 150.0, 150.0),
('2100000200000019', '1000002', 1, 8.0, 8.0),
('2080000200000020', '0800002', 1, 50.0, 50.0),
('2010000300000021', '0100003', 1, 0.0, 0.0),
('2010000300000021', '1000002', 1, 8.0, 8.0),
('1100000200000022', '0900001', 2, 100.0, 200.0),
('1100000200000022', '1000002', 3, 8.0, 24.0),
('2100000200000023', '1000002', 1, 8.0, 8.0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(8) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `DeliveryType` tinyint(1) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `OrderNumber` varchar(16) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,1) NOT NULL,
  `payment_done` tinyint(1) NOT NULL DEFAULT 0,
  `has_dispatched` tinyint(1) NOT NULL DEFAULT 0,
  `has_completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_on` datetime DEFAULT NULL,
  `has_cancel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `userEmail`, `DeliveryType`, `payment_method`, `OrderNumber`, `OrderDate`, `total_amount`, `payment_done`, `has_dispatched`, `has_completed`, `completed_on`, `has_cancel`) VALUES
('00000001', 'peterchrishtoper@gmail.com', 1, 'Credit Card', '1080000100000001', '2023-12-06 23:13:37', 0.0, 1, 1, 0, NULL, 0),
('00000002', 'masonpaul@gmail.com', 2, 'Cash On Delivery', '2100000100000002', '2023-12-07 04:36:28', 0.0, 1, 1, 0, NULL, 0),
('00000003', 'tom&jerry@gmail.com', 1, 'Credit Card', '1050000200000003', '2023-12-07 04:49:53', 0.0, 0, 0, 0, NULL, 0),
('00000004', 'tom&jerry@gmail.com', 2, 'Credit Card', '2040000200000004', '2023-12-08 04:16:44', 0.0, 1, 1, 0, NULL, 0),
('00000005', 'tom&jerry@gmail.com', 1, 'Cash On Delivery', '1090000200000005', '2023-12-08 04:56:42', 160.0, 1, 1, 0, NULL, 0),
('00000006', 'peterchrishtoper@gmail.com', 1, 'Credit Card', '1090000200000006', '2023-12-11 23:47:25', 165.0, 1, 1, 0, NULL, 0),
('00000007', 'masonpaul@gmail.com', 2, 'Credit Card', '2090000200000007', '2023-12-13 23:59:10', 455.0, 1, 1, 0, NULL, 0),
('00000008', 'recentuser@gmail.com', 2, 'Cheque Payment', '2100000200000008', '2023-12-16 23:35:53', 31.0, 0, 0, 0, NULL, 0),
('00000009', 'recentuser@gmail.com', 1, 'Credit Card', '1010000300000009', '2023-12-16 23:45:40', 5.0, 0, 0, 0, NULL, 0),
('00000010', 'samnelson@gmail.com', 2, 'Credit Card', '2100000200000010', '2023-12-16 23:49:36', 45.0, 1, 1, 0, NULL, 0),
('00000011', 'samnelson@gmail.com', 1, 'Cheque Payment', '1090000100000011', '2023-12-16 23:52:36', 105.0, 0, 0, 0, NULL, 0),
('00000012', 'samnelson@gmail.com', 1, 'Cash On Delivery', '1090000200000012', '2023-12-16 23:54:58', 155.0, 0, 1, 0, NULL, 1),
('00000013', 'samnelson@gmail.com', 2, 'Credit Card', '2080000100000013', '2023-12-16 23:59:40', 35.0, 1, 1, 0, NULL, 0),
('00000014', 'samnelson@gmail.com', 1, 'Cheque Payment', '1040000200000014', '2023-12-17 00:00:58', 13.0, 0, 0, 0, NULL, 1),
('00000015', 'kennethwiz@gmail.com', 1, 'Credit Card', '1010000100000015', '2023-12-17 00:19:14', 9.0, 0, 0, 0, NULL, 0),
('00000016', 'jsonparker@gmail.com', 1, 'Credit Card', '1010000300000016', '2023-12-25 20:07:13', 21.0, 1, 0, 0, NULL, 0),
('00000017', 'jsonparker@gmail.com', 2, 'Cash On Delivery', '2090000100000017', '2023-12-25 20:10:00', 115.0, 1, 1, 0, NULL, 0),
('00000018', 'jsonparker@gmail.com', 1, 'Credit Card', '1090000200000018', '2023-12-25 20:37:15', 155.0, 1, 1, 0, NULL, 0),
('00000019', 'salastelecomagent57@gmail.com', 2, 'Credit Card', '2100000200000019', '2023-12-25 22:53:14', 23.0, 1, 1, 0, NULL, 0),
('00000020', 'salastelecomagent57@gmail.com', 2, 'Cheque Payment', '2080000200000020', '2023-12-25 23:00:23', 65.0, 1, 1, 0, NULL, 0),
('00000021', 'vincesjerry011@gmail.com', 2, 'Credit Card', '2010000300000021', '2023-12-27 10:20:00', 23.0, 1, 1, 0, NULL, 0),
('00000022', 'salastelecomagent57@gmail.com', 1, 'Credit Card', '1100000200000022', '2023-12-27 10:31:04', 229.0, 1, 1, 0, NULL, 0),
('00000023', 'salastelecomagent57@gmail.com', 2, 'Cash On Delivery', '2100000200000023', '2023-12-27 10:43:20', 23.0, 0, 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,1) DEFAULT NULL,
  `warranty` varchar(255) NOT NULL,
  `prodImg` varchar(255) NOT NULL,
  `prodNumb` varchar(5) NOT NULL,
  `prodCode` varchar(2) NOT NULL,
  `prodID` varchar(7) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `description`, `price`, `warranty`, `prodImg`, `prodNumb`, `prodCode`, `prodID`, `Status`) VALUES
(1, 'Standard HB Pencil', 2.0, '1.5 year', 'Standard HB Pencil.jpg', '00001', '01', '0100001', 0),
(2, 'Colored Pencil Set (12 colors)', 2.0, 'no warrenty', 'Colored Pencil Set (12 colors).png', '00002', '01', '0100002', 0),
(3, 'Ballpoint Pen (Black ink)', 1.0, '2 Year', 'Ballpoint Pen (Black ink).png', '00001', '02', '0200001', 1),
(4, 'Gel Pen Set (Assorted colors)', 2.0, '6  Month', 'Gel Pen Set (Assorted colors).png', '00002', '02', '0200002', 1),
(5, 'Small Backpack', 15.0, '1 year', 'Small Backpack.png', '00001', '03', '0300001', 1),
(6, ' Laptop Bag', 25.0, '2 Year', 'Laptop Bag.png', '00002', '03', '0300002', 1),
(7, 'Spiral-Bound Notebook (100 pages)', 3.0, 'no warrenty', 'Spiral-Bound Notebook (100 pages).png', '00001', '04', '0400001', 1),
(8, 'Leather-Bound Journal', 8.0, 'no warrenty', 'Leather-Bound Journal.png', '00002', '04', '0400002', 1),
(9, 'Desk Organizer Set', 13.0, 'no warrenty', 'Desk Organizer Set.png', '00001', '05', '0500001', 1),
(10, 'Desk Lamp with Special  USB Port', 30.0, '1.6 Year', 'Desk Lamp with USB Port.jpg', '00002', '05', '0500002', 1),
(11, 'Fine Tip Permanent Markers (Pack of 5)', 4.0, 'no warrenty', 'Fine Tip Permanent Markers (Pack of 5).png', '00001', '06', '0600001', 1),
(12, 'Whiteboard Markers (Assorted Colors, Pack of 8)', 6.0, '6 Month', 'Whiteboard Markers (Assorted Colors, Pack of 8).png', '00001', '06', '0600002', 1),
(13, 'Acrylic Paint Set (12 Colors)', 15.0, 'no warrenty', 'Acrylic Paint Set (12 Colors).png', '00001', '07', '0700001', 1),
(14, 'Sketchbook (50 Sheets, Acid-Free Paper)', 7.0, 'no warrenty', 'Sketchbook (50 Sheets, Acid-Free Paper).png', '00002', '07', '0700002', 1),
(15, 'Premium Stationery Set (Includes Pen, Notebook, and Organizer)', 20.0, 'no warrenty', 'Premium Stationery Set (Includes Pen, Notebook, and Organizer).png', '00001', '08', '0800001', 1),
(16, 'Executive Writing Set (Fountain Pen, Notepad, and Leather Case)', 50.0, '1 Year', 'Executive Writing Set (Fountain Pen, Notepad, and Leather Case).png', '00002', '08', '0800002', 1),
(17, 'Ergonomic Office Chair', 100.0, '2 Year', 'Ergonomic Office Chair.png', '00001', '09', '0900001', 1),
(18, 'L-Shaped Desk with Storage', 150.0, 'no warrenty', 'L-Shaped Desk with Storage.png', '00002', '09', '0900002', 1),
(19, 'Wall Calendar (12 Months)', 5.0, 'no warrenty', 'Wall Calendar (12 Months).png', '00001', '10', '1000001', 1),
(20, 'Weekly Planner Notebook', 8.0, 'no warrenty', 'Weekly Planner Notebook.png', '00002', '10', '1000002', 1),
(21, 'Designer 2b Pencil', 0.0, 'no warrenty', '2b pencil.jpeg', '00003', '01', '0100003', 0),
(22, 'Designer 2b Pencil', 0.0, 'no warrenty', '2b pencil.jpeg', '00004', '01', '0100004', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `productID` varchar(7) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `has_ordered` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `userId` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `st_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` int(5) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`userId`, `fname`, `lname`, `st_address`, `city`, `country`, `zip`, `mobile`, `email`) VALUES
(1, 'Christopher', 'peter', '1836 Washington rd', 'New York', 'New York', 10009, '243 425 643', 'peterchrishtoper@gmail.com'),
(2, 'Mason', 'Paul', '123 SW Rd', 'New York', 'New York', 10007, '300-453-300', 'masonpaul@gmail.com'),
(3, 'Tom', 'Jerry', '8493 Eastern Rd', 'greensboro', 'New Jeresy', 58392, '930-283-742', 'tom&jerry@gmail.com'),
(4, 'Tom', 'Jerry', '8493 Eastern Rd ', 'greensboro', 'New Jeresy ', 58392, '930-283-742', 'tom&jerry@gmail.com'),
(5, 'Tom', 'Jerry', '8493 Eastern Rd', 'greensboro', 'New Jeresy', 58392, '930-283-742', 'tom&jerry@gmail.com'),
(6, 'Christopher', 'peter', '1836 Washington rd', 'New York', 'New York', 10009, '243 425 643', 'peterchrishtoper@gmail.com'),
(7, 'Sam', 'Nelson', '2453 ground rd', 'Karachi', 'pakistan', 58392, '03592773952', 'samnelson@gmail.com'),
(8, 'Kenneth', 'Wiz', '492 kingston view', 'Orange', 'NJ', 10535, '352-853-835', 'kennethwiz@gmail.com'),
(9, 'Json', 'Parker', '123 sunshine rd', 'karachi', 'pakistan', 10001, '03429229816', 'jsonparker@gmail.com'),
(10, 'Nabi', 'Salay', '1313 Down St', 'Karachi', 'Pakistan', 10014, '03425338562', 'salastelecomagent57@gmail.com'),
(11, 'Vinces', 'Jerry', '123 S Rd', 'karachi', 'Pakistan', 20005, '03592773952', 'vincesjerry011@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arts_users`
--
ALTER TABLE `arts_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `contacttable`
--
ALTER TABLE `contacttable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgetpass_requests`
--
ALTER TABLE `forgetpass_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ct_code` (`prodCode`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arts_users`
--
ALTER TABLE `arts_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `contacttable`
--
ALTER TABLE `contacttable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forgetpass_requests`
--
ALTER TABLE `forgetpass_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_ct_code` FOREIGN KEY (`prodCode`) REFERENCES `category` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
