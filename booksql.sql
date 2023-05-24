-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th1 07, 2023 lúc 04:55 PM
-- Phiên bản máy phục vụ: 5.7.33
-- Phiên bản PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `Book_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quyenhan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `password`, `quyenhan`) VALUES
('admin', '1', 1),
('khai', '1', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(18,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `note`, `total`) VALUES
(1, 'Khai Duong', '0368822641', 'Ha Noi', 'ok', '110000'),
(2, 'Khai Duong', '0368822641', 'Ha Noi', 'okkk', '340000'),
(3, 'aaa', '0368822641', 'Ha Noi', 'aaaaa', '100000'),
(4, 'Khai Duong', '0368822641', 'Ha Noi', 'aaaaaaaaa', '110000'),
(5, 'Khai Duong', '0368822641', 'Ha Noi', 'aaaaaaaaa', '110000'),
(6, 'Khai Duong', '0368822641', 'Ha Noi', 'aaaaaaa', '210000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_unit` decimal(18,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price_unit`) VALUES
(1, 6, 12, 1, '110000'),
(2, 6, 11, 1, '100000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`.
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(18,0) NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `description`) VALUES
(11, 'Politics - law books', '100000', 'image/book.jpg', 1, 'Theoretical, political and legal books are books with contents directly contributing to the protection, propagation and development of Marxism-Leninism, Ho Chi Minhs thoughts, viewpoints, and lines of the Party, policies, etc. the laws of the State; introduce knowledge and experience of political activities of countries and political parties; introduce the life and political career of the leaders of the international communist and workers movements; is a specialized book with the content is the system and analysis of codes, statutes, guiding documents for law enforcement in the fields of state, administration, civil, criminal, marriage - family, finance, economy, labor...'),
(12, 'Book of Science, Technology - Economics', '110000', 'image/book2.jpg', 1, 'Science and technology policy is a system of viewpoints, goals, guiding principles, development orientations, institutions and measures to promote the acquisition, development and use of science and technology and science and technology supporting branches to realize socio-economic development goals, and at the same time develop national science and technology capacity in each period.'),
(13, 'Books of Literature and Art', '120000', 'image/book3.jpg', 1, 'Art and literature (also known as elite literature) is a high-class literature, created by the intellectual class of society with the need to discover the inner and spiritual life of people, help people understand the deep psychological complexities of people, such as the desire to live, to be free, or the guilt of the soul.'),
(14, 'Book of Socio-Cultural - History', '129000', 'image/book4.jpg', 2, 'Cultural history combines anthropological and historical approaches to examine popular cultural traditions and cultural interpretations of historical experiences. It examines historical records and narrative descriptions of matter, including the continuum of events (which occur consecutively and lead from the past to the present and even to the future) related to a culture.'),
(16, 'Textbook', '120000', 'image/book8.jpg', 2, 'Curriculum is the system of curriculum of a subject. It is a learning or teaching material designed and compiled on the basis of a subject curriculum. The purpose is to make official teaching materials for teachers and official learning materials for students. The nature of the curriculum must adhere to the training program, ensuring the systematicity, applicability, basicity, accuracy and up-to-date scientific content of the subject.'),
(17, 'Books of Stories, Novels', '120000', 'image/book7.jpg', 3, 'Fiction is a genre of fictional prose that, through characters, situations, and events to reflect the broad social picture and problems of human life, manifesting its narrative, nature and character. Tell stories in prose on definite themes.'),
(18, 'Books on Psychology, Spirituality, Religion', '130000', 'image/book9.jpg', 3, 'Psychology books are books that share in-depth research on psychology, they often describe, analyze and explain psychological phenomena, emotions, personality, ... in each individual. These books require highly qualified writers or regularly study and absorb new psychological theories.'),
(19, 'Books Children Books', '112000', 'image/book1.jpg', 3, 'We need to understand simply that childrens books are books that carry once upon a time stories, magazines and poems made for children. Childrens literature has two types: classical style and modern style.');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
