-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 01:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlbantruyentranh`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `maHD` varchar(7) NOT NULL,
  `maTruyen` varchar(7) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `donGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`maHD`, `maTruyen`, `soLuong`, `donGia`) VALUES
('hd00001', 'tt00001', 2, 30000),
('hd00001', 'tt00002', 2, 30000),
('hd00001', 'tt00003', 2, 30000),
('hd00001', 'tt00004', 2, 30000),
('hd00001', 'tt00005', 2, 30000),
('hd00002', 'tt00006', 1, 25000),
('hd00002', 'tt00007', 3, 25000),
('hd00002', 'tt00008', 4, 25000),
('hd00003', 'tt00010', 2, 25000),
('hd00003', 'tt00016', 2, 145000),
('hd00004', 'tt00009', 4, 25000),
('hd00004', 'tt00010', 2, 25000),
('hd00005', 'tt00003', 3, 30000),
('hd00005', 'tt00004', 2, 30000),
('hd00006', 'tt00017', 1, 145000),
('hd00006', 'tt00018', 1, 145000),
('hd00006', 'tt00019', 1, 145000),
('hd00006', 'tt00020', 1, 145000);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `maHD` varchar(7) NOT NULL,
  `maND` varchar(7) NOT NULL,
  `maPTVC` varchar(5) NOT NULL,
  `maKM` varchar(5) DEFAULT NULL,
  `ngayDat` date NOT NULL,
  `ngayGiao` date NOT NULL,
  `tinhTrang` bit(1) NOT NULL,
  `tongTienHang` bigint(20) NOT NULL,
  `tongThanhToan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`maHD`, `maND`, `maPTVC`, `maKM`, `ngayDat`, `ngayGiao`, `tinhTrang`, `tongTienHang`, `tongThanhToan`) VALUES
('hd00001', 'nd00007', 'vc001', 'km004', '2023-01-02', '2023-01-04', b'1', 300000, 260000),
('hd00002', 'nd00012', 'vc002', 'km006', '2023-02-02', '2023-02-08', b'1', 200000, 170000),
('hd00003', 'nd00016', 'vc001', NULL, '2023-03-12', '2023-03-14', b'1', 340000, 340000),
('hd00004', 'nd00012', 'vc002', 'km008', '2023-06-27', '2023-06-30', b'1', 150000, 84000),
('hd00005', 'nd00011', 'vc003', 'km004', '2023-07-10', '2023-07-16', b'1', 150000, 110000),
('hd00006', 'nd00011', 'vc001', 'km002', '2023-07-25', '2023-07-27', b'1', 580000, 430000);

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `maKM` varchar(5) NOT NULL,
  `maLKM` varchar(5) NOT NULL,
  `code` varchar(20) NOT NULL,
  `giamGia` int(11) NOT NULL,
  `gtDonHang` bigint(20) NOT NULL,
  `ngayBD` date NOT NULL,
  `ngayKT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khuyenmai`
--

INSERT INTO `khuyenmai` (`maKM`, `maLKM`, `code`, `giamGia`, `gtDonHang`, `ngayBD`, `ngayKT`) VALUES
('km001', 'lkm02', 'FAMILYREADS', 15000, 50000, '2023-01-23', '2023-01-30'),
('km002', 'lkm02', 'COFFEEBOOK', 150000, 400000, '2023-03-22', '2023-04-01'),
('km003', 'lkm01', 'GIAIPHONGMIENNAM', 30, 400000, '2023-04-30', '2023-05-01'),
('km004', 'lkm02', 'QUOCTETREEM', 40000, 120000, '2023-06-01', '2023-06-03'),
('km005', 'lkm01', 'TETVUIVE', 40, 250000, '2023-02-03', '2023-02-15'),
('km006', 'lkm01', 'HAMHOC', 15, 100000, '2023-09-01', '2023-09-23'),
('km007', 'lkm02', 'MERRYXMAS', 40000, 150000, '2023-12-20', '2023-12-26'),
('km008', 'lkm01', 'QUOCTETHUVIEN', 44, 100000, '2023-06-23', '2023-06-30'),
('km009', 'lkm02', 'SHARING2023', 23000, 200000, '2023-01-01', '2023-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `loaikhuyenmai`
--

CREATE TABLE `loaikhuyenmai` (
  `maLKM` varchar(5) NOT NULL,
  `tenLKM` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaikhuyenmai`
--

INSERT INTO `loaikhuyenmai` (`maLKM`, `tenLKM`) VALUES
('lkm01', 'Khuyến mãi %'),
('lkm02', 'Khuyến mãi Giá');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `maND` varchar(7) NOT NULL,
  `maVT` varchar(5) NOT NULL,
  `hoTen` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `diaChi` varchar(50) NOT NULL,
  `sdt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`maND`, `maVT`, `hoTen`, `email`, `password`, `diaChi`, `sdt`) VALUES
('nd00001', 'vt001', 'Phạm Nhật Vượng', 'vuong.pn@gmail.com', '123123', '17 Trần Phú, Nha Trang, Khánh Hoà', '0794123213'),
('nd00002', 'vt002', 'Nguyễn Minh Quân', 'quan@outlook.com', 'quan1234', '293 Trần Quý Cáp, Nha Trang, Khánh Hoà', '0832912383'),
('nd00003', 'vt002', 'Nguyễn Hoàng Tùng', 'longga@gmail.com', 'bibobibo', '203 Trần Nhật Duật, Nha Trang, Khánh Hoà', '0265987413'),
('nd00004', 'vt002', 'Lê Đức Trọng', 'cuzwat112@gmail.com', '1234567', '205 Trần Nguyên Hãn, Nha Trang, Khánh Hoà', '0987165423'),
('nd00005', 'vt002', 'Ngô Việt Hưng', 'hunghaha@gmail.com', 'hung1234', '39 Trần Phú, Nha Trang, Khánh Hoà', '0436128795'),
('nd00006', 'vt002', 'Nguyễn Hoàng Đăng Quang', 'quanghh@gmail.com', '023832939', '23 Lê Thánh Tôn, Nha Trang, Khánh Hoà', '023832939'),
('nd00007', 'vt003', 'Nguyễn Công Minh', 'minh12@gmail.com', '12312345', '193 Trần Phú, Nha Trang, Khánh Hoà', '079238284'),
('nd00008', 'vt003', 'Lương Đình Mạnh ', 'manhpo12@gmail.com', '09080702', '329 Ngô Văn Đến, Quận 3, Hồ Chí Minh', '078372483'),
('nd00009', 'vt003', 'Trần Bảo Linh', 'meomeo2@gmail.com', 'poipoi123', '42 Ngô Quyền, Nha Trang, Khánh Hoà', '0798989843'),
('nd00010', 'vt003', 'Đỗ Thị Mai', 'mai20@gmail.com', '12345678', '192/21 Trần Nguyên Hãn, Nha Trang, Khánh Hoà', '0842939239'),
('nd00011', 'vt003', 'Trần Thánh Thiện', 'bibo@gmail.com', '12345678', '93 Phan Xich Long, Quận 3, Hồ Chí Minh', '090332832'),
('nd00012', 'vt003', 'Nguyễn Tấn Minh', 'minhmongmanh@gmail.com', 'Locossoc', '12/23 Luơng Định Của, Nha Trang, Khánh Hoà', '079238283'),
('nd00013', 'vt003', 'Dương Đình Tiến', 'wino@gmail.com', '818181818', '12 Âu Cơ, Nha Trang, Khánh Hoà', '073293823'),
('nd00014', 'vt003', 'Lê Văn Toản', 'thanhdas@gmail.com', 'thanhtahnh123', '239 Lạc Long Quân, Nha Trang, Khánh Hoà', '039239393'),
('nd00015', 'vt003', 'Dương Duy Lân', 'lanlan@gmail.com', 'biobiolan12', '329 23 Tháng 10, Nha Trang, Khánh Hoà', '098328384'),
('nd00016', 'vt003', 'Trần Quốc Hội', 'hoilo123@gmail.com', 'hoilo1234', '12 Nguyễn Thị Minh Khai, quận 1, Hồ Chí Minh', '073929399');

-- --------------------------------------------------------

--
-- Table structure for table `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `maNXB` varchar(5) NOT NULL,
  `tenNXB` varchar(50) NOT NULL,
  `diaChi` varchar(50) NOT NULL,
  `sdt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`maNXB`, `tenNXB`, `diaChi`, `sdt`) VALUES
('xb001', 'NXB Kim Đồng', '55 Quang Trung, Hà Nội', '0239434730'),
('xb002', 'NXB Trẻ', '161B Lý Chính Thắng, Quận 3, Hồ Chí Minh', '08083598'),
('xb003', 'NXB IPM', '110 Nguyễn Ngọc Nại, Hà Nội', '0328383979'),
('xb004', 'NXB Amak Books', '32, ngõ 219/27, Quận Long Biên, Hà Nội', '037474317'),
('xb005', 'NXB Lao động', '175 Giảng Võ, Đống Đa, Hà Nội ', '028384459 ');

-- --------------------------------------------------------

--
-- Table structure for table `ptvanchuyen`
--

CREATE TABLE `ptvanchuyen` (
  `maPTVC` varchar(5) NOT NULL,
  `tenPTVC` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ptvanchuyen`
--

INSERT INTO `ptvanchuyen` (`maPTVC`, `tenPTVC`) VALUES
('vc001', 'Vận chuyển Hoả tốc'),
('vc002', 'Vận chuyển Nhanh'),
('vc003', 'Vận chuyển Thường');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `maSeries` varchar(5) NOT NULL,
  `tenSeries` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`maSeries`, `tenSeries`) VALUES
('ss001', 'Naruto'),
('ss002', 'Bluelock'),
('ss003', 'Doraemon'),
('ss004', 'Kingdom'),
('ss005', 'MASHLE');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `maTG` varchar(5) NOT NULL,
  `tenTG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`maTG`, `tenTG`) VALUES
('tg001', 'Kaneshiro Muneyuki'),
('tg002', 'Fujiko F. Fujio'),
('tg003', 'Tezuka Osamu'),
('tg004', 'Kishimoto Masashi'),
('tg005', 'Yasuhisa Hara');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `maTL` varchar(5) NOT NULL,
  `tenTL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`maTL`, `tenTL`) VALUES
('tl001', 'Action'),
('tl002', 'Horror'),
('tl003', 'Romance'),
('tl004', 'Sport'),
('tl005', 'Comedy'),
('tl006', 'Fighting'),
('tl007', 'Fantasy'),
('tl008', 'Sci-fi'),
('tl009', 'Isekai'),
('tl010', 'Ninja');

-- --------------------------------------------------------

--
-- Table structure for table `truyen`
--

CREATE TABLE `truyen` (
  `maTruyen` varchar(7) NOT NULL,
  `tenTruyen` varchar(50) NOT NULL,
  `anhBia` varchar(100) NOT NULL,
  `maSeries` varchar(5) NOT NULL,
  `maTL` varchar(5) NOT NULL,
  `maNXB` varchar(5) NOT NULL,
  `maTG` varchar(5) NOT NULL,
  `moTa` varchar(500) NOT NULL,
  `soTrang` int(11) NOT NULL,
  `ngonNgu` varchar(20) NOT NULL,
  `ngayPhatHanh` date NOT NULL,
  `donGia` bigint(20) NOT NULL,
  `soLuongTon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truyen`
--

INSERT INTO `truyen` (`maTruyen`, `tenTruyen`, `anhBia`, `maSeries`, `maTL`, `maNXB`, `maTG`, `moTa`, `soTrang`, `ngonNgu`, `ngayPhatHanh`, `donGia`, `soLuongTon`) VALUES
('tt00001', 'MASHLE Tập 1', '', 'ss005', 'tl001', 'xb001', 'tg001', 'Ở thế giới nơi ai cũng dùng được pháp thuật, có một cậu bé tên Mash không biết phù phép ngày ngày khổ luyện và trở thành \"quỷ cơ bắp\". Để bảo vệ những tháng ngày bình yên, Mash phải nhập học trường pháp thuật và đặt mục tiêu trở thành học sinh đứng đầu!? Nghiền nát mọi bùa ếm bằng sức mạnh và cơ bắp được khổ luyện, câu chuyện về chàng phù thủy không bình thường xin phép được bắt đầu!\r\n', 216, 'Tiếng Việt', '2023-05-12', 30000, 12),
('tt00002', 'MASHLE Tập 2', '', 'ss005', 'tl001', 'xb001', 'tg001', 'Trong trận đấu với Lance – pháp sư thiên tài hai vạch sẹo, Mash đã cảm động trước nét tính cách không ngờ của cậu…!? Tránh vỏ dưa gặp vỏ dừa, một buổi ngoại khóa bất ngờ được tổ chức với sự tham gia của hai kí túc xá Adler và Lang. Mash dường như có huông trở thành mục tiêu của những kẻ nguy hiểm và bị cuốn vào cuộc chiến tranh giành xu cũng như uy tín cho nhà mình!!\r\nHãy vung lên nắm đấm công lí cho những kẻ tự xưng cao quý nhưng mục ruỗng tận xương tủy biết mặt nào!!', 200, 'Tiếng Việt', '2022-05-26', 30000, 42),
('tt00003', 'MASHLE Tập 3', '', 'ss005', 'tl001', 'xb001', 'tg001', 'Móng vuốt của nhà Lang đã vươn xa hơn trong cuộc chiến giành xu. Mash và bạn bè trong nhà Adler phải đoàn kết để ngăn chặn lũ sài lang độc chiếm vị trí ứng viên Thần Nhãn. Ngay lúc Mash đang bị cấm túc dọn chòi cú, Đệ Thất và Đệ Lục của Magia Lupus – tổ chức đứng đầu nhà Lang xuất hiện…\r\nLần lượt từng người bạn bị hút mất pháp lực, Mash trong cơn giận dữ đỉnh điểm đã tiến tới đối đầu trực diện với Magia Lupus!!', 208, 'Tiếng Việt', '2023-06-09', 30000, 22),
('tt00004', 'MASHLE Tập 4', '', 'ss005', 'tl001', 'xb001', 'tg001', 'Nắm đấm của Mash không khoan nhượng giáng lên Abyss – Đệ Nhị của Magia Lupus. Bị lộ mặt thật đằng sau chiếc mặt nạ vỡ vụn, đòn tấn công của Abyss lên Mash càng trở nên hung hiểm!?\r\nTrong lúc đó Dot và Finn phải đối đầu nữ phù thủy hai vạch sẹo. Khi Dot bị dồn vào chân tường thì thế sự biến chuyển…!! Abel – kẻ đứng đầu Magia Lupus đang chờ Mash ở sau cánh cửa cuối cùng. Đứng trước đối thủ máu lạnh theo chủ nghĩa phân biệt, cơ bắp toàn thân Mash gầm lên!!', 208, 'Tiếng Việt', '2023-06-23', 30000, 9),
('tt00005', 'MASHLE Tập 5', '', 'ss005', 'tl001', 'xb001', 'tg001', 'Vừa bước vào chế độ “bung lụa” sau khi đánh bại Magia Lupus thì nhóm của Mash đã phải đối đầu với nguy cơ mới từ tổ chức tội phạm bí ẩn Innocent Zero!! Abel bị áp đảo trước sự chênh lệch thực lực với các phù thủy hắc ám, còn Mash lại chẳng ngần ngại tung ra cú đấm\r\nsắt trừng phạt.\r\nTrong một diễn biến khác, tin đồn về “pháp sư hệ vật lí” Mash đã lan ra khắp trường khiến cậu chàng phải đối mặt với phiên tòa pháp thuật…!?', 208, 'Tiếng Việt', '2023-06-23', 30000, 32),
('tt00006', 'Naruto Tập 1', '', 'ss001', 'tl010', 'xb001', 'tg004', 'Tập 1 của series tập trung vào việc Naruto tìm cách thể hiện mình và kiếm được sự công nhận trong làng, bất chấp sự gét bỏ của người dân với cậu do chứa một con quái vật trong người. Cố vượt qua các khó khăn và thử thách, Naruto gặp Sasuke và Sakura, hai người bạn đồng hành đầu tiên. Tập 1 cũng giới thiệu về Hatake Kakashi, người sẽ trở thành sensei của đội của Naruto, Sasuke và Sakura, và bắt đầu hành trình đầy kịch tính của họ để trở thành những ninja mạnh mẽ và bảo vệ làng Konoha.', 195, 'Tiếng Việt', '2018-09-12', 25000, 3),
('tt00007', 'Naruto Tập 2', '', 'ss001', 'tl010', 'xb001', 'tg004', 'Trong tập 2 của Naruto, Naruto Uzumaki và các đồng đội của mình, Sasuke Uchiha và Sakura Haruno, tiếp tục cuộc hành trình của họ để trở thành những ninja xuất sắc và bảo vệ làng Konoha.\r\n\r\nTrong tập này, đội của Naruto bắt đầu bài tập đầu tiên dưới sự hướng dẫn của sensei Hatake Kakashi. Kakashi rất nổi tiếng với cách dạy học khắc nghiệt và khó khăn. Để kiểm tra trình độ của họ, Kakashi đặt cho đội thách thức đầu tiên là \"Chuunin Exams,\" một kỳ thi ninja quan trọng. ', 195, 'Tiếng Việt', '2018-10-18', 25000, 12),
('tt00008', 'Naruto Tập 3', '', 'ss001', 'tl010', 'xb001', 'tg004', 'Trong tập 3 của Naruto, câu chuyện tiếp tục theo chân Naruto Uzumaki và các đồng đội của mình, Sasuke Uchiha và Sakura Haruno, trong cuộc hành trình của họ để trở thành những ninja xuất sắc và bảo vệ làng Konoha.\r\nTập này xoay quanh một nhiệm vụ đặc biệt đầu tiên của đội của Naruto dưới sự hướng dẫn của sensei Hatake Kakashi. ', 195, 'Tiếng Việt', '2020-12-12', 25000, 23),
('tt00009', 'Naruto Tập 4', '', 'ss001', 'tl010', 'xb001', 'tg004', 'Trong tập 4 của Naruto, câu chuyện tiếp tục theo chân Naruto Uzumaki và đội của mình, bao gồm Sasuke Uchiha và Sakura Haruno, trong cuộc hành trình của họ để trở thành những ninja mạnh mẽ và bảo vệ làng Konoha.\r\nTập này tiếp tục câu chuyện sau sự kiện của nhiệm vụ bảo vệ Tazuna khỏi Zabuza Momochi. ', 195, 'Tiếng Việt', '2021-01-14', 25000, 33),
('tt00010', 'Naruto Tập 5', '', 'ss001', 'tl010', 'xb001', 'tg004', 'Tập này tiếp tục tập trung vào quá trình đào tạo của Naruto và nhóm dưới sự hướng dẫn của sensei Hatake Kakashi. Trong quá trình luyện tập, họ phải đối mặt với các thử thách và nhiệm vụ mới, trong đó có việc bảo vệ một cô bé tên là Inari và làng nước nơi cô ấy sống khỏi sự thống trị của một tên cai trị tham lam tên là Gato.', 195, 'Tiếng Việt', '2021-02-12', 25000, 22),
('tt00011', 'Bluelock Tập 1', '', 'ss002', 'tl004', 'xb003', 'tg003', 'Trong tập 1 của Blue Lock, câu chuyện bắt đầu khi một cuộc khủng bố bóng đá đột ngột xuất hiện tại Nhật Bản. Đội tuyển quốc gia của họ thất bại một cách đáng thất vọng trong một giải đấu quốc tế và cả nước đang trong tình trạng chấn động.\r\nVào lúc này, một tổ chức bí mật với tên gọi \"Blue Lock\" xuất hiện và triệu tập 300 cầu thủ trẻ tài năng để tham gia vào một khóa học đặc biệt.', 244, 'Tiếng Việt', '2022-01-02', 44000, 132),
('tt00012', 'Bluelock Tập 2', '', 'ss002', 'tl004', 'xb003', 'tg003', 'Tập này tiếp tục tập trung vào quá trình huấn luyện và cạnh tranh giữa các cầu thủ trẻ. Họ phải trải qua nhiều bài tập thể lực và kỹ thuật khắc nghiệt để nâng cao trình độ của họ. Isagi và các cầu thủ khác đang trải qua một cuộc sống khắc nghiệt và khó khăn trong trại đào tạo của Blue Lock, nhưng họ vẫn quyết tâm đạt được mục tiêu cao cả của mình.', 244, 'Tiếng Việt', '2022-02-23', 44000, 23),
('tt00013', 'Bluelock Tập 3', '', 'ss002', 'tl004', 'xb003', 'tg003', ' 2 trong số 4 trận đấu của vòng tuyển chọn đầu tiên tại BLUELOCK đã kết thúc. Sau khi đánh bại đối thủ trong một trận đấu phải đánh cược cả mạng sống và được nếm trải hương vị chiến thắng, Isagi cùng đội Z hừng hực khí thế tiến tới trận đấu thứ 3 với đội W!! Tuy nhiên lại có lục đục nội bộ ngoài dự kiến phát sinh trong đội Z!?', 244, 'Tiếng Việt', '2022-12-12', 44000, 23),
('tt00014', 'Bluelock Tập 4', '', 'ss002', 'tl004', 'xb003', 'tg003', '  Bắt đầu trận đấu cuối cùng của vòng tuyển chọn đầu tiên tại BLUELOCK! Đội Z của nhóm Isagi sẽ đương đầu với một cuộc chiến định mệnh mà họ không có lựa chọn nào khác ngoài việc chiến thắng, bởi thua hay hòa đều đồng nghĩa với việc bị loại ngay lập tức! Đối thủ của họ là đội V, đội mạnh nhất khu nhà số 5 với sự góp mặt của thiên tài Nagi Seishiro! Liệu những nỗ lực hết mình của đội Z có hiệu quả trước sức tấn công áp đảo của đội V hay không…? ', 244, 'Tiếng Việt', '2023-01-02', 44000, 32),
('tt00015', 'Bluelock Tập 5', '', 'ss002', 'tl004', 'xb003', 'tg003', 'HỌC HỎI VÀ “THỨC TỈNH” BẢN THÂN! TRẬN TỬ CHIẾN VỚI ĐỘI V ĐÃ ĐẾN HỒI KẾT!\r\nĐứng trước đội V của thiên tài Nagi có khả năng ghi bàn áp đảo, đội Z đã gỡ hòa với tỉ số 3-3 trong 15 phút cuối hiệp 2. Các cầu thủ buộc phải xem lại lối chơi của mình hòng tìm ra cấp độ tiếp theo của sự “Thức tỉnh”. ', 244, 'Tiếng Việt', '2022-09-12', 44000, 44),
('tt00016', 'ĐẠI TUYỂN TẬP - DORAEMON TRUYỆN NGẮN TẬP 10', '', 'ss003', 'tl008', 'xb005', 'tg002', 'Mã ISBN: 9786042149600\r\nTác giả: Fujiko F Fujio\r\nKhuôn Khổ: 14.5 x 20.5 cm\r\nSố trang: 760\r\nĐịnh dạng: bìa mềm\r\nTrọng lượng: 850 gram\r\nBộ sách: Fujiko F Fujio Đại tuyển tập - Doraemon truyện ngắn\r\nNgày phát hành: 01/08/2019', 760, 'Tiếng Việt', '2019-08-01', 145000, 23),
('tt00017', 'ĐẠI TUYỂN TẬP - DORAEMON TRUYỆN NGẮN TẬP 4', '', 'ss003', 'tl008', 'xb005', 'tg002', 'Mã ISBN: 9786042103282\r\nTác giả: Fujiko F Fujio\r\nKhuôn Khổ: 14.5 x 20.5cm\r\nSố trang: 612\r\nĐịnh dạng: bìa mềm\r\nTrọng lượng: 530 gram\r\nBộ sách: Fujiko F Fujio Đại tuyển tập - Doraemon truyện ngắn\r\nNgày phát hành: 30/03/2018', 612, 'Tiếng Việt', '2018-03-30', 145000, 40),
('tt00018', 'ĐẠI TUYỂN TẬP - DORAEMON TRUYỆN NGẮN TẬP 19', '', 'ss003', 'tl008', 'xb005', 'tg002', 'Mã EAN 8935244842166\r\nTác giả Fujiko F Fujio\r\nTác giả khác Nhiều người dịch\r\nGiá bìa 145,000\r\nLoại bìa Mềm\r\nKhổ 14,5x20,5cm\r\nSố trang 600\r\nQuà tặng kèm Không\r\nNhà xuất bản NXB Kim Đồng', 600, 'Tiếng Việt', '2020-02-12', 145000, 77),
('tt00019', 'ĐẠI TUYỂN TẬP - DORAEMON TRUYỆN NGẮN TẬP 15', '', 'ss003', 'tl008', 'xb005', 'tg002', 'Bộ sách là phiên bản tập hợp đầy đủ nhất các truyện ngắn Doraemon, trong đó đã bao gồm những truyện\r\nngắn quen thuộc trong bộ 45 tập cùng những sáng tác chưa từng ra mắt của tác giả Fujiko F. Fujio.\r\n', 776, 'Tiếng Việt', '2019-08-09', 145000, 32),
('tt00020', 'DORAEMON ĐẠI TUYỂN TẬP TRUYỆN NGẮN TẬP 14', '', 'ss003', 'tl008', 'xb005', 'tg002', 'Fujiko F Fujio Đại Tuyển Tập - Doraemon Truyện Ngắn - Tập 14\r\nMã EAN 8935244822670\r\nTác giả Fujiko F Fujio\r\nTác giả khác Nhiều người dịch\r\nGiá bìa 145.000\r\nLoại bìa Mềm\r\nKhổ 14,5x20,5cm\r\nSố trang 592\r\nQuà tặng kèm Không bán\r\nNhà xuất bản NXB Kim Đồng\r\nNăm xuất bản 2019', 592, 'Tiếng Việt', '2019-07-12', 145000, 98),
('tt00021', 'Kingdom Tập 1', '', 'ss004', 'tl006', 'xb004', 'tg005', 'Thời kỳ Xuân Thu chiến quốc kéo dài suốt 500 năm do toàn cõi Trung Hoa vẫn chưa quy về một mối. Sinh ra trong thời loạn lạc, cậu thiếu niên mồ côi tên Tín cùng người bằng hữu của mình là Phiêu quyết tâm rèn luyện võ nghệ ngày đêm nhằm thay đổi vận mệnh của mình, phấn đấu trở thành thiên hạ đệ nhất tướng quân ghi danh vào sử sách. Cùng thời điểm ấy, tại kinh đô Hàm Lương của nước Tần, vị vua trẻ Doanh Chính đã lên ngôi, ôm trong mình tham vọng thống nhất lục quốc.', 216, 'Tiếng Việt', '2021-02-23', 43000, 23),
('tt00022', 'Kingdom Tập 2', '', 'ss004', 'tl006', 'xb004', 'tg005', 'Thời kỳ Xuân Thu chiến quốc kéo dài suốt 500 năm do toàn cõi Trung Hoa vẫn chưa quy về một mối. Sinh ra trong thời loạn lạc, cậu thiếu niên mồ côi tên Tín cùng người bằng hữu của mình là Phiêu quyết tâm rèn luyện võ nghệ ngày đêm nhằm thay đổi vận mệnh của mình, phấn đấu trở thành thiên hạ đệ nhất tướng quân ghi danh vào sử sách. Cùng thời điểm ấy, tại kinh đô Hàm Lương của nước Tần, vị vua trẻ Doanh Chính đã lên ngôi, ôm trong mình tham vọng thống nhất lục quốc.', 216, 'Tiếng Việt', '2021-04-12', 43000, 32),
('tt00023', 'Kingdom Tập 3', '', 'ss004', 'tl006', 'xb004', 'tg005', 'Thời kỳ Xuân Thu chiến quốc kéo dài suốt 500 năm do toàn cõi Trung Hoa vẫn chưa quy về một mối. Sinh ra trong thời loạn lạc, cậu thiếu niên mồ côi tên Tín cùng người bằng hữu của mình là Phiêu quyết tâm rèn luyện võ nghệ ngày đêm nhằm thay đổi vận mệnh của mình, phấn đấu trở thành thiên hạ đệ nhất tướng quân ghi danh vào sử sách. Cùng thời điểm ấy, tại kinh đô Hàm Lương của nước Tần, vị vua trẻ Doanh Chính đã lên ngôi, ôm trong mình tham vọng thống nhất lục quốc.', 216, 'Tiếng Việt', '2021-05-23', 43000, 32),
('tt00024', 'Kingdom Tập 4', '', 'ss004', 'tl006', 'xb004', 'tg005', 'Thời kỳ Xuân Thu chiến quốc kéo dài suốt 500 năm do toàn cõi Trung Hoa vẫn chưa quy về một mối. Sinh ra trong thời loạn lạc, cậu thiếu niên mồ côi tên Tín cùng người bằng hữu của mình là Phiêu quyết tâm rèn luyện võ nghệ ngày đêm nhằm thay đổi vận mệnh của mình, phấn đấu trở thành thiên hạ đệ nhất tướng quân ghi danh vào sử sách. Cùng thời điểm ấy, tại kinh đô Hàm Lương của nước Tần, vị vua trẻ Doanh Chính đã lên ngôi, ôm trong mình tham vọng thống nhất lục quốc.', 216, 'Tiếng Việt', '2021-05-21', 43000, 23),
('tt00025', 'Kingdom Tập 5', '', 'ss004', 'tl006', 'xb004', 'tg005', 'Thời kỳ Xuân Thu chiến quốc kéo dài suốt 500 năm do toàn cõi Trung Hoa vẫn chưa quy về một mối. Sinh ra trong thời loạn lạc, cậu thiếu niên mồ côi tên Tín cùng người bằng hữu của mình là Phiêu quyết tâm rèn luyện võ nghệ ngày đêm nhằm thay đổi vận mệnh của mình, phấn đấu trở thành thiên hạ đệ nhất tướng quân ghi danh vào sử sách. Cùng thời điểm ấy, tại kinh đô Hàm Lương của nước Tần, vị vua trẻ Doanh Chính đã lên ngôi, ôm trong mình tham vọng thống nhất lục quốc.', 216, 'Tiếng Việt', '2021-07-23', 43000, 33);

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `maVT` varchar(5) NOT NULL,
  `tenVT` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vaitro`
--

INSERT INTO `vaitro` (`maVT`, `tenVT`) VALUES
('vt001', 'Admin'),
('vt002', 'Nhân viên'),
('vt003', 'Khách hàng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`maHD`,`maTruyen`),
  ADD KEY `maHD` (`maHD`,`maTruyen`),
  ADD KEY `maTruyen` (`maTruyen`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`maHD`),
  ADD KEY `maND` (`maND`,`maPTVC`,`maKM`),
  ADD KEY `maPTVC` (`maPTVC`),
  ADD KEY `maKM` (`maKM`);

--
-- Indexes for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`maKM`),
  ADD KEY `maLKM` (`maLKM`);

--
-- Indexes for table `loaikhuyenmai`
--
ALTER TABLE `loaikhuyenmai`
  ADD PRIMARY KEY (`maLKM`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`maND`),
  ADD KEY `maVT` (`maVT`);

--
-- Indexes for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`maNXB`);

--
-- Indexes for table `ptvanchuyen`
--
ALTER TABLE `ptvanchuyen`
  ADD PRIMARY KEY (`maPTVC`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`maSeries`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`maTG`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`maTL`);

--
-- Indexes for table `truyen`
--
ALTER TABLE `truyen`
  ADD PRIMARY KEY (`maTruyen`),
  ADD KEY `maSeries` (`maSeries`,`maTL`,`maNXB`,`maTG`),
  ADD KEY `maTL` (`maTL`),
  ADD KEY `maTG` (`maTG`),
  ADD KEY `maNXB` (`maNXB`);

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`maVT`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`maHD`) REFERENCES `hoadon` (`maHD`),
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`maTruyen`) REFERENCES `truyen` (`maTruyen`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`maND`) REFERENCES `nguoidung` (`maND`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`maPTVC`) REFERENCES `ptvanchuyen` (`maPTVC`),
  ADD CONSTRAINT `hoadon_ibfk_3` FOREIGN KEY (`maKM`) REFERENCES `khuyenmai` (`maKM`);

--
-- Constraints for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `khuyenmai_ibfk_1` FOREIGN KEY (`maLKM`) REFERENCES `loaikhuyenmai` (`maLKM`);

--
-- Constraints for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`maVT`) REFERENCES `vaitro` (`maVT`);

--
-- Constraints for table `truyen`
--
ALTER TABLE `truyen`
  ADD CONSTRAINT `truyen_ibfk_1` FOREIGN KEY (`maTL`) REFERENCES `theloai` (`maTL`),
  ADD CONSTRAINT `truyen_ibfk_2` FOREIGN KEY (`maSeries`) REFERENCES `series` (`maSeries`),
  ADD CONSTRAINT `truyen_ibfk_3` FOREIGN KEY (`maTG`) REFERENCES `tacgia` (`maTG`),
  ADD CONSTRAINT `truyen_ibfk_4` FOREIGN KEY (`maNXB`) REFERENCES `nhaxuatban` (`maNXB`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
