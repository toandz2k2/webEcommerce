-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 01, 2022 lúc 04:17 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webgiaynu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_admin`
--

CREATE TABLE `t_admin` (
  `id_admin` int(10) NOT NULL,
  `name_admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_admin` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass_admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `t_admin`
--

INSERT INTO `t_admin` (`id_admin`, `name_admin`, `email_admin`, `user_admin`, `pass_admin`, `level`) VALUES
(2, 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(3, 'Thanh Trúc', 'thanhtruc@gmail.com', 'thanhtruc', '21232f297a57a5a743894a0e4a801fc3', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_brand`
--

CREATE TABLE `t_brand` (
  `id_brand` int(10) UNSIGNED NOT NULL,
  `name_brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `t_brand`
--

INSERT INTO `t_brand` (`id_brand`, `name_brand`) VALUES
(4, 'Sabalanca'),
(5, 'Laka'),
(6, 'Juno'),
(7, 'Vascara'),
(8, 'Valentino'),
(9, 'GAFA'),
(10, 'D&amp;G'),
(11, 'DKNY');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_cart`
--

CREATE TABLE `t_cart` (
  `id_cart` int(10) NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `sid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `t_cart`
--

INSERT INTO `t_cart` (`id_cart`, `id_product`, `sid`, `name_product`, `price`, `quantity`, `image`) VALUES
(46, 30, '8d04e29c4cd67d0836d57c4353a884df', 'giày nữ', '30000', 1, 'c8697a6f14.jpeg'),
(51, 29, '8d04e29c4cd67d0836d57c4353a884df', 'Giày pha lê', '3000000', 1, '407336cf0e.jpeg'),
(54, 27, '7d8ba6f699d08f80c71765f79b6e3cda', 'Louis Vuitton', '150000', 1, 'd6af050991.jpg'),
(56, 29, '7d8ba6f699d08f80c71765f79b6e3cda', 'Giày pha lê', '3000000', 1, '407336cf0e.jpeg'),
(57, 27, '0b2900c99c11fa61e259fe7fb8cdb74a', 'Louis Vuitton', '150000', 1, 'd6af050991.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_category`
--

CREATE TABLE `t_category` (
  `id_cat` int(10) UNSIGNED NOT NULL,
  `name_cat` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `t_category`
--

INSERT INTO `t_category` (`id_cat`, `name_cat`) VALUES
(12, 'Giày cao gót'),
(13, 'Giày nữ'),
(14, 'Giày boot nữ'),
(15, 'Giày thấp gót'),
(16, 'Sandal cao gót');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_compare`
--

CREATE TABLE `t_compare` (
  `id` int(10) NOT NULL,
  `id_customer` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_customer`
--

CREATE TABLE `t_customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `t_customer`
--

INSERT INTO `t_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(1, 'nang', 'trại cúp', 'Hà Nội', 'Việt Nam', '1234', '0965882491', 'nangvipvp02@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_order`
--

CREATE TABLE `t_order` (
  `id` int(10) NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_customer` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL,
  `date_order` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_product`
--

CREATE TABLE `t_product` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity_product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_cat` int(10) UNSIGNED NOT NULL,
  `id_brand` int(10) UNSIGNED NOT NULL,
  `desc_product` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(10) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `t_product`
--

INSERT INTO `t_product` (`id_product`, `name_product`, `quantity_product`, `id_cat`, `id_brand`, `desc_product`, `type`, `price`, `image`) VALUES
(27, 'Louis Vuitton', '12', 12, 4, 'là thương hiệu hàng đầu trong phái đẹp', 3, '150000', 'd6af050991.jpg'),
(28, 'Giày cao gót', '5', 12, 10, 'Giày cao gót trắng đẹp', 1, '15000', '49bf9f94c2.jpeg'),
(29, 'Giày pha lê', '28', 12, 5, 'pha lê siêu đẹp', 2, '3000000', '407336cf0e.jpeg'),
(30, 'giày nữ', '6', 13, 8, 'đẹp', 3, '30000', 'c8697a6f14.jpeg'),
(31, 'Giày', '33', 13, 8, 'giày thể thao nữ', 3, '350.000', '195b6e97e2.jpeg'),
(32, 'Guốc hàn quốc', '44', 12, 6, '<p>guốc h&agrave;n quốc</p>', 3, '100.000', '128e207419.jpeg'),
(33, 'Boot nữ', '55', 14, 10, 'boot nữ cao cấp', 0, '200.000', '29ce2a207b.jpeg'),
(34, 'Giày cao gót GU2301', '23', 12, 9, 'siêu đẹp', 0, '150000', '0a592167ad.jpeg'),
(35, 'Giày cao gót chuỗi', '24', 12, 10, 'chuỗi ngọc trai trắng sáng', 0, '240.000', '1b673d6932.jpeg'),
(36, 'Giày cao gót đỏ', '43', 12, 5, 'màu đỏ đẹp', 1, '230.000', '477c5f7b5a.webp'),
(37, 'Giày pha lê xanh', '34', 12, 11, 'pha lê xanh đá quý siêu đẹp', 2, '400.000', '705c1b0ccd.jpeg'),
(38, 'Giày pha lê trắng', '45', 12, 7, 'trắng đẹp', 2, '750.000', 'a82be353ac.webp'),
(39, 'Giày pha lê tím', '56', 12, 8, 'hàng siêu chất lượng', 2, '900.000', 'a08995b9f9.jpeg'),
(41, 'GIày cao gót xanh', '53', 12, 9, 'đẹp', 1, '240.000', 'e5e095f029.png'),
(42, 'Giày cao gót đen', '42', 12, 11, 'đen huyền bí', 1, '240.000', '87e3f305a7.jpeg'),
(43, 'Giày cao gót', '5', 12, 7, 'qưdwd', 0, '30000', 'bc13cc11b1.jpeg'),
(44, 'Giày thấp gót đen', '11', 15, 9, 'đẹp', 3, '170.000', '0bc71010b0.jpeg'),
(46, 'Giày thấp gót ', '29', 15, 4, '<p>si&ecirc;u đẹp</p>', 3, '240.000', 'ef0d103e38.jpeg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_slider`
--

CREATE TABLE `t_slider` (
  `id_slider` int(10) NOT NULL,
  `name_slider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_slider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_warehouse`
--

CREATE TABLE `t_warehouse` (
  `id_warehouse` int(10) NOT NULL,
  `id_sanpham` int(10) UNSIGNED NOT NULL,
  `sl_nhap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sl_ngaynhap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_wishlist`
--

CREATE TABLE `t_wishlist` (
  `id` int(10) NOT NULL,
  `id_customer` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `t_brand`
--
ALTER TABLE `t_brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Chỉ mục cho bảng `t_cart`
--
ALTER TABLE `t_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_product` (`id_product`);

--
-- Chỉ mục cho bảng `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Chỉ mục cho bảng `t_compare`
--
ALTER TABLE `t_compare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Chỉ mục cho bảng `t_customer`
--
ALTER TABLE `t_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`,`id_customer`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Chỉ mục cho bảng `t_product`
--
ALTER TABLE `t_product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_cat` (`id_cat`,`id_brand`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Chỉ mục cho bảng `t_slider`
--
ALTER TABLE `t_slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Chỉ mục cho bảng `t_warehouse`
--
ALTER TABLE `t_warehouse`
  ADD PRIMARY KEY (`id_warehouse`),
  ADD KEY `id_sanpham` (`id_sanpham`);

--
-- Chỉ mục cho bảng `t_wishlist`
--
ALTER TABLE `t_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `t_brand`
--
ALTER TABLE `t_brand`
  MODIFY `id_brand` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `t_cart`
--
ALTER TABLE `t_cart`
  MODIFY `id_cart` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `t_category`
--
ALTER TABLE `t_category`
  MODIFY `id_cat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `t_compare`
--
ALTER TABLE `t_compare`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_customer`
--
ALTER TABLE `t_customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `t_order`
--
ALTER TABLE `t_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_product`
--
ALTER TABLE `t_product`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `t_slider`
--
ALTER TABLE `t_slider`
  MODIFY `id_slider` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_warehouse`
--
ALTER TABLE `t_warehouse`
  MODIFY `id_warehouse` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_wishlist`
--
ALTER TABLE `t_wishlist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `t_cart`
--
ALTER TABLE `t_cart`
  ADD CONSTRAINT `t_cart_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `t_product` (`id_product`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `t_compare`
--
ALTER TABLE `t_compare`
  ADD CONSTRAINT `t_compare_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `t_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `t_compare_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `t_product` (`id_product`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `t_order`
--
ALTER TABLE `t_order`
  ADD CONSTRAINT `t_order_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `t_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `t_order_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `t_product` (`id_product`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `t_product`
--
ALTER TABLE `t_product`
  ADD CONSTRAINT `t_product_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `t_category` (`id_cat`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `t_product_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `t_brand` (`id_brand`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `t_warehouse`
--
ALTER TABLE `t_warehouse`
  ADD CONSTRAINT `t_warehouse_ibfk_1` FOREIGN KEY (`id_sanpham`) REFERENCES `t_product` (`id_product`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `t_wishlist`
--
ALTER TABLE `t_wishlist`
  ADD CONSTRAINT `t_wishlist_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `t_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `t_wishlist_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `t_product` (`id_product`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
