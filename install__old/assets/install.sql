-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 11 2015 г., 14:18
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ciadm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `aparaty`
--

CREATE TABLE IF NOT EXISTS `aparaty` (
  `id_aparat` int(4) NOT NULL AUTO_INCREMENT,
  `aparat_name` text NOT NULL,
  PRIMARY KEY (`id_aparat`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=138 ;

--
-- Дамп данных таблицы `aparaty`
--

INSERT INTO `aparaty` (`id_aparat`, `aparat_name`) VALUES
(1, 'ДРУГОЕ'),
(18, 'Картридж'),
(8, 'Мобильный телефон'),
(7, 'Ноутбук'),
(10, 'Принтер'),
(11, 'Маршрутизатор'),
(12, 'Системный блок'),
(13, 'Монитор'),
(14, 'Накопитель'),
(20, 'Фотоаппарат'),
(123, 'Посудомоечные машины'),
(17, 'Периферия'),
(21, 'Электронная книга'),
(22, 'Планшет'),
(23, 'Материнская плата'),
(24, 'Блок питания'),
(25, 'МР3 плеер'),
(26, 'Карман для HDD'),
(27, 'Телевизор'),
(28, 'Сабвуфер'),
(29, 'Наушники'),
(31, 'Моноблок'),
(32, 'Кофеварка'),
(33, 'Ультрабук'),
(34, 'Сканер'),
(35, 'Аккумулятор'),
(36, 'Видеокарта'),
(37, 'Утюг'),
(38, 'Хлебопечка'),
(39, 'Видеокамера'),
(40, 'Мясорубка'),
(41, 'Блендер'),
(42, 'мп3-плеер'),
(43, 'ИБП'),
(44, 'СВЧ'),
(45, 'Фен'),
(46, 'Соковыжималка'),
(47, 'Кухонный комбайн'),
(48, 'Кофемолка'),
(49, 'Рамка'),
(90, 'Универсальный пульт'),
(51, 'Пароварка'),
(52, 'Мультиварка'),
(54, 'Видеоплеер'),
(56, 'Колонка'),
(57, 'Пылесос'),
(58, 'Ресивер'),
(59, 'МФУ'),
(60, 'Объектив'),
(61, 'Зарядное устройство'),
(88, 'Проектор'),
(63, 'Диктофон'),
(64, 'Магнитофон'),
(65, 'Гарнитура'),
(66, 'GPS-Навигатор'),
(67, 'Электро щепцы'),
(68, 'Электро щипцы'),
(69, 'Музыкальный центр'),
(70, 'Очиститель воздуха'),
(71, 'Фоторамка'),
(72, 'Плата'),
(73, 'Пульт'),
(89, 'Домофон'),
(75, 'Мышка'),
(76, 'Докстанция'),
(77, 'Винчестер'),
(78, 'Стабилизатор напряжения'),
(79, 'Медиаплеер'),
(80, 'Кофемашина'),
(81, 'Домашний кинотеатр'),
(82, 'Тостер'),
(83, 'переводчик'),
(84, 'Звуковая карта'),
(85, 'Проектор?'),
(87, 'Электрочайник'),
(91, 'Шредер'),
(92, 'Клавиатура'),
(93, 'Капучинатор'),
(94, 'Роутер'),
(95, 'видеорегистратор'),
(96, 'Навигатор'),
(97, 'Часы'),
(98, 'Модем 3g'),
(99, 'Жесткий диск'),
(100, 'Вспышка'),
(101, 'Плеер'),
(102, 'Пароочеститель'),
(103, 'Память ОЗУ'),
(104, 'Фритюрница'),
(105, 'Термос'),
(106, 'Флешка'),
(124, 'Дековый телефон'),
(108, 'Плойка'),
(109, 'Насос'),
(110, 'Радиотелефон'),
(111, 'Весы'),
(112, 'Чайник'),
(113, 'Коммутатор'),
(114, 'Тример'),
(115, 'Редиоприёмник'),
(116, 'Радиоприёмник'),
(117, 'Микроволновка'),
(118, 'Аудио система'),
(119, 'Аудиосистема'),
(120, 'Джойстик'),
(121, 'Автомагнитола'),
(122, 'Машинка для денег.'),
(125, 'Усилитель звука'),
(126, 'Маска для лица'),
(127, 'Кондиционер'),
(129, 'Считыватель меток'),
(130, 'Сетевой адаптер'),
(131, 'Электронная ламна'),
(132, 'нотик'),
(133, 'нотичек'),
(134, 'ноутик');

-- --------------------------------------------------------

--
-- Структура таблицы `ci_cookies`
--

CREATE TABLE IF NOT EXISTS `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(4) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text NOT NULL,
  `id_user` int(4) DEFAULT NULL,
  `id_kvitancy` int(4) NOT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `goroda`
--

CREATE TABLE IF NOT EXISTS `goroda` (
  `gorod_id` int(4) NOT NULL AUTO_INCREMENT,
  `gorod` text NOT NULL,
  PRIMARY KEY (`gorod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `goroda`
--

INSERT INTO `goroda` (`gorod_id`, `gorod`) VALUES
(1, 'Киев');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_dostupa`
--

CREATE TABLE IF NOT EXISTS `groups_dostupa` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `groups_dostupa`
--

INSERT INTO `groups_dostupa` (`id`, `name`) VALUES
(1, 'Администраторы'),
(2, 'Менеджеры'),
(3, 'Механики');

-- --------------------------------------------------------

--
-- Структура таблицы `kvitancy`
--

CREATE TABLE IF NOT EXISTS `kvitancy` (
  `id_kvitancy` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) DEFAULT '1',
  `nomer_kvitancy` int(7) NOT NULL,
  `id_aparat` int(4) DEFAULT NULL,
  `id_proizvod` int(4) NOT NULL DEFAULT '0',
  `model` text NOT NULL,
  `ser_nomer` text NOT NULL,
  `product_code` varchar(100) DEFAULT NULL,
  `date_prodag` date DEFAULT '0000-00-00',
  `id_remonta` int(4) DEFAULT NULL,
  `neispravnost` text NOT NULL,
  `vid` text NOT NULL,
  `komplektnost` text,
  `date_priemka` date DEFAULT '0000-00-00',
  `date_okonchan` date DEFAULT '0000-00-00',
  `date_vydachi` date DEFAULT '0000-00-00',
  `id_sost` int(4) DEFAULT NULL,
  `id_mechanic` int(4) DEFAULT NULL,
  `show_main_admin` int(4) NOT NULL DEFAULT '0',
  `show_main_manag` int(4) NOT NULL DEFAULT '0',
  `date_zakaza` date DEFAULT '0000-00-00',
  `date_poluch` date DEFAULT '0000-00-00',
  `full_cost` decimal(16,2) NOT NULL DEFAULT '0.00',
  `id_sc` int(2) NOT NULL DEFAULT '1',
  `primechaniya` text,
  `id_avtoriz_price` int(4) NOT NULL DEFAULT '1',
  `ind_price` decimal(16,2) NOT NULL DEFAULT '0.00',
  `wprice` text NOT NULL,
  `mehanic` int(11) NOT NULL,
  `comments` text NOT NULL,
  `update_time` text NOT NULL,
  `update_user` text NOT NULL,
  `remont` int(11) NOT NULL,
  `whereid` int(11) NOT NULL,
  `id_where` int(1) NOT NULL,
  `id_responsible` int(11) NOT NULL,
  PRIMARY KEY (`id_kvitancy`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  `id_group` int(1) NOT NULL,
  `id_sc` int(2) NOT NULL,
  `active` int(1) DEFAULT '1',
  `show_my_tickets` int(1) DEFAULT '1',
  `show_call_tickets` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `membership`
--

INSERT INTO `membership` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`, `id_group`, `id_sc`, `active`, `show_my_tickets`, `show_call_tickets`) VALUES
(3, 'Adm', 'Test', 'admin@fixinka.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `proizvoditel`
--

CREATE TABLE IF NOT EXISTS `proizvoditel` (
  `id_proizvod` int(4) NOT NULL AUTO_INCREMENT,
  `name_proizvod` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proizvod`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=451 ;

--
-- Дамп данных таблицы `proizvoditel`
--

INSERT INTO `proizvoditel` (`id_proizvod`, `name_proizvod`) VALUES
(1, 'ДРУГОЕ'),
(13, 'LG'),
(14, 'Panasonic'),
(15, 'HTC'),
(4, 'Asus'),
(5, 'Lenovo'),
(6, 'Samsung'),
(7, 'Dell'),
(8, 'Hewlett Packard'),
(9, 'Sony'),
(10, 'Apple'),
(11, 'Fujitsu'),
(12, 'Packard Bell'),
(16, 'Fly'),
(17, 'Nokia'),
(18, 'Canon'),
(19, 'Epson'),
(20, 'Xerox'),
(21, 'Hitachi'),
(22, 'Philips'),
(23, 'Sony Ericsson'),
(24, 'BenQ'),
(25, 'View Sonic'),
(26, 'Microsoft'),
(27, 'IBM'),
(28, 'CompaQ'),
(29, 'E-Machines'),
(30, 'RoverBook'),
(31, 'Кор'),
(32, 'Cisco'),
(33, 'TP Link'),
(411, 'Ga.ma'),
(35, 'Toshiba'),
(36, 'MSI'),
(37, 'D-Link'),
(38, '0 - китайского производства'),
(39, 'Nikon'),
(40, 'Cisco Linksys'),
(41, 'Assistant'),
(42, 'Wexler'),
(43, 'Motorola'),
(44, 'Olympus'),
(45, 'Archos'),
(46, 'Transcend'),
(47, 'Orion'),
(48, 'Gateway'),
(49, 'BBK'),
(50, 'Sanyo'),
(51, 'Prology'),
(52, 'Gigabyte'),
(53, 'Prestigio'),
(54, 'HUAWEI'),
(55, 'Pioneer'),
(56, 'Sharp'),
(57, 'Sennheiser'),
(58, 'Koss'),
(59, 'Bosch'),
(60, 'Casio'),
(61, 'Pentax'),
(62, 'Kenwood'),
(63, 'Pocketbook'),
(64, 'Texet'),
(65, 'Amazon'),
(66, 'Kodak'),
(67, 'APC'),
(68, 'Electrolux'),
(69, 'Lavazza'),
(70, 'Gsmart'),
(71, 'Kindle'),
(72, 'Braun'),
(73, 'Nexus'),
(74, 'Tefal'),
(75, 'Nespresso'),
(76, 'Delonghi'),
(77, 'Atlas'),
(78, 'Saeco'),
(79, 'Apache'),
(81, 'THOMSON'),
(82, 'globex'),
(83, 'Francis Francis'),
(84, 'Krups'),
(85, 'Goclever'),
(86, 'AEG'),
(87, 'Candy'),
(88, 'Melitta'),
(89, 'Alienware'),
(90, 'Piano'),
(91, 'Zelmer'),
(92, 'Digma'),
(93, 'Pixus'),
(94, 'Impression'),
(95, 'Cooler Master'),
(96, 'Elite'),
(97, 'Jura'),
(98, 'Dex'),
(99, 'Logitech'),
(100, 'Q3'),
(101, 'LogigPower'),
(102, 'Flootach 32'),
(103, 'Flytouch'),
(104, 'Kub'),
(105, 'Jawbone'),
(106, 'Steelseries'),
(107, 'Moulinex'),
(108, 'Marshall'),
(109, 'Fujifilm'),
(110, 'FranciseFrancise'),
(111, 'NooK'),
(112, 'DNS'),
(113, 'T30'),
(114, 'Must'),
(115, 'MiD'),
(116, 'Yamaha'),
(117, 'iriver'),
(118, 'Hyundai'),
(217, 'Jeka'),
(120, 'Cowon'),
(121, 'BlackBerry'),
(122, 'GigaWorks'),
(123, 'Luxeon'),
(124, 'Mustek'),
(125, 'Onda'),
(126, 'ainol'),
(127, 'Luk'),
(128, 'Swiss Quality'),
(129, 'UFO'),
(130, 'NEC'),
(131, 'illy'),
(132, 'Plenue'),
(133, 'Сoolpad'),
(134, 'Step'),
(135, 'Rowento'),
(136, 'JVC'),
(137, 'AirON'),
(138, 'Momster'),
(139, 'Ipad'),
(140, 'Gaggia'),
(141, 'Plantronics'),
(142, 'Deso'),
(304, 'Albinar'),
(144, 'Lacie'),
(145, 'Navo'),
(146, 'Medion'),
(147, 'Сompag'),
(148, 'Ergo'),
(149, 'Nyundli'),
(150, 'Xperia'),
(151, 'Daikin Industries'),
(152, 'Belinea'),
(153, 'Beats'),
(154, 'Alcatel'),
(155, 'Seagate'),
(156, 'Sealife'),
(157, 'APS'),
(158, '3q'),
(159, 'LuxPad'),
(160, 'TDK'),
(161, 'Vitesse'),
(162, 'Nescafe'),
(163, 'mytab'),
(164, 'Razer'),
(165, 'WD'),
(166, 'Aoson'),
(167, '0 - нет названия'),
(168, 'siemens'),
(169, 'Chieftec'),
(170, 'Gopro'),
(171, 'Delux'),
(172, 'Gorenje'),
(173, 'SVEN'),
(174, 'AKG'),
(175, 'Scarlett'),
(176, 'TrinkPad'),
(177, 'Phaser'),
(178, 'qumo'),
(179, 'ZTPad'),
(180, 'Solis'),
(181, 'Simonelli'),
(182, '3Com'),
(183, 'saturn'),
(184, 'monsterbeats'),
(185, 'Villa'),
(186, 'СANYON'),
(187, 'Zelos'),
(188, 'Zopo'),
(189, 'LARETTI'),
(190, 'Everex'),
(191, 'SCULLCANDY'),
(192, 'Екомтех'),
(193, 'Supremo'),
(194, 'IconBit'),
(195, 'Pipo'),
(196, 'Eureka'),
(197, 'Emtec'),
(198, 'Сoffee Center'),
(199, 'Hannspree'),
(200, 'Rowena'),
(201, 'iura'),
(202, 'Dicple'),
(203, 'Konica Minolta'),
(204, 'Creative Professinal'),
(205, 'Bistro'),
(206, 'Grado'),
(207, 'Cuisinart'),
(208, 'urbanears'),
(209, 'JBL'),
(210, 'Reellex'),
(211, 'Plaer'),
(212, 'Leica'),
(213, 'Proview'),
(214, 'ICOO'),
(215, 'MYSTERY'),
(216, 'Caffytaly'),
(218, 'Joom'),
(219, 'Vertice'),
(220, 'SUPRA'),
(221, 'Spidem'),
(222, 'Clatronic'),
(223, 'Linksys'),
(224, 'oysters'),
(225, 'Elipso'),
(226, 'Kocaso'),
(227, 'Cube'),
(228, 'Chuwi'),
(229, 'General Electric'),
(230, 'Е-учебник'),
(231, 'Evromedia'),
(232, 'Enot'),
(233, 'Pantech'),
(234, 'caykend'),
(235, 'Intel'),
(236, 'Perfero'),
(237, 'Brother'),
(238, 'arnova'),
(239, 'Gaoapad'),
(240, 'Chalenger'),
(241, 'Verbatim'),
(242, 'Crown'),
(243, 'Shivaki'),
(244, 'Ariete'),
(245, 'Romos'),
(246, 'Сresyn'),
(247, 'bowers&amp;wilkins'),
(248, 'Conforta'),
(249, 'Bialetti'),
(250, 'Rowenta'),
(251, 'Ampe'),
(252, 'LaPiccola'),
(253, 'Agent'),
(254, 'Hanbit'),
(255, 'SanDisk'),
(256, 'ImPad'),
(257, 'Minolta'),
(258, 'E-Book'),
(259, 'Keepon'),
(260, 'Google'),
(261, 'ZyXel'),
(262, 'Caballero'),
(263, 'Polaroid'),
(264, 'fisher'),
(265, 'Coffe centere'),
(266, 'MIUIi'),
(267, 'Coby'),
(268, 'Rotel'),
(269, 'ProfiJooc'),
(270, 'Creative'),
(271, 'aiwa'),
(272, 'Mobile Phone'),
(273, 'Beyerdynamic'),
(274, 'Verizon'),
(275, 'Susegana'),
(276, 'Strong'),
(277, 'Zenius'),
(278, 'e.HOT'),
(279, 'Atom Epad'),
(280, 'Diakele'),
(281, 'Fritz'),
(282, 'Amoi'),
(283, 'Hanns-g'),
(284, 'Bork'),
(285, 'Cortland'),
(286, 'DUNE'),
(287, 'Arcelik'),
(288, 'Nabi'),
(289, 'Tunex'),
(290, 'Kensington'),
(291, 'IZUMI'),
(292, 'Evga'),
(293, 'Orda'),
(294, 'Play Pad'),
(295, 'Stone'),
(296, 'Thl'),
(297, 'speedlink'),
(298, 'Blaser'),
(299, 'Smart'),
(300, 'Urbaners'),
(301, 'android'),
(302, 'SiliconPower'),
(303, 'Ematic'),
(305, 'Tokina'),
(306, 'Freelqnder'),
(307, 'Skullcandy'),
(308, 'Elenberg'),
(309, 'Kanex'),
(310, 'Surface'),
(311, 'IfiveMX'),
(312, 'Daewoo DC'),
(313, 'Pavoni'),
(314, 'MikroTIK'),
(315, 'Zenithink'),
(316, 'HGST'),
(317, 'VOYO'),
(318, 'Quick Mill'),
(319, 'Design'),
(320, 'HIFIMen'),
(321, 'Xdigital'),
(322, 'Cron'),
(323, 'ROCCAT'),
(324, 'Bravis'),
(325, 'Hansol'),
(326, 'Teclast'),
(328, 'Genius'),
(329, 'Western Digital'),
(330, 'Gemix'),
(331, 'Explay'),
(332, 'S-Tell'),
(333, 'Iconcept'),
(334, 'Nouva Simonelli'),
(335, 'Senkatel'),
(336, 'Runbo'),
(337, 'Velas'),
(338, 'Hasselblad'),
(339, 'Zune'),
(340, 'Koenig'),
(341, 'Dreambox'),
(342, 'Kuppersbusch'),
(343, 'Verico'),
(344, 'San Marco'),
(345, 'Ripjaws'),
(346, 'Nomi'),
(347, 'Xiaomi'),
(348, 'Land Rover'),
(349, 'Inch'),
(350, 'Wega'),
(351, 'Aspiring'),
(352, 'Obreey'),
(353, 'Teclast TPad'),
(354, 'jayu'),
(355, 'Mi'),
(356, 'iocean'),
(357, 'Elephone'),
(358, 'Zalmer'),
(359, 'Ельво'),
(360, 'Tenda'),
(361, 'GoldStar'),
(362, 'Donod'),
(363, 'HP'),
(364, 'Kyros'),
(365, 'iRULU'),
(366, 'NZXT'),
(367, 'bianshi sara'),
(368, 'Delfa'),
(369, 'Keener'),
(370, 'Gastrorag'),
(371, 'La Cimbali'),
(372, 'Magimix'),
(373, 'Milly'),
(374, 'Сanon'),
(375, 'CrazyFire'),
(376, 'Miele'),
(377, 'ROHS'),
(378, 'TrekStor'),
(379, 'Сhallenger'),
(380, 'Grundic'),
(381, 'tenex'),
(382, 'Merlin'),
(383, 'karcher'),
(384, 'Garmin'),
(385, 'Naide'),
(386, 'Vitek'),
(387, 'Delta Electronics'),
(388, 'Soul'),
(389, 'SoundMAGIC'),
(390, 'Cimbali'),
(391, 'Emachines'),
(392, 'Multimedia'),
(393, 'Extreme'),
(394, 'Megaworks'),
(395, 'Foxgate'),
(396, 'Highscreen'),
(397, 'Turnigy'),
(398, 'Hairway'),
(399, 'Zalman'),
(400, 'ETOM'),
(401, 'audiotechnica'),
(402, 'Icute'),
(403, 'inomi'),
(404, 'Tactik'),
(405, 'Classic'),
(406, 'Commax'),
(407, 'LV'),
(408, 'Snopow'),
(409, 'ECM'),
(410, 'DeLaRue'),
(412, 'Conti Clap'),
(413, 'Pineng'),
(414, 'Fama'),
(415, 'Modecom'),
(416, 'Inew'),
(417, 'Oki'),
(418, 'UniPad'),
(419, 'APart'),
(420, 'Targa'),
(421, 'Fiorenzato'),
(422, 'Beaurer'),
(423, 'Atlanfa'),
(424, 'DAIKIN'),
(425, 'Pendo'),
(426, 'Iuni'),
(427, 'LSRock'),
(428, 'Chunmi'),
(429, 'Cgher-shot'),
(430, 'brugnetti'),
(431, 'Dexcom'),
(432, 'CAT'),
(433, 'Beko'),
(434, 'Ricoh'),
(435, 'AEE'),
(436, 'Canyon'),
(437, 'Quinto'),
(438, 'GameCom'),
(439, 'Sanremo'),
(440, 'Mitsubishi'),
(441, 'Midea'),
(442, 'My Passport'),
(443, 'Cooper'),
(444, 'Porsche Design'),
(445, 'Acube'),
(446, 'amico'),
(447, 'asustek2');

-- --------------------------------------------------------

--
-- Структура таблицы `service_centers`
--

CREATE TABLE IF NOT EXISTS `service_centers` (
  `id_sc` int(4) NOT NULL AUTO_INCREMENT,
  `id_gorod` int(4) NOT NULL,
  `site` varchar(50) DEFAULT NULL,
  `name_sc` text NOT NULL,
  `adres_sc` text NOT NULL,
  `phone_sc` text NOT NULL,
  `kontakt_sc` text NOT NULL,
  `mail_sc` text NOT NULL,
  `rab_sc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_sc`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 PACK_KEYS=0 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `service_centers`
--

INSERT INTO `service_centers` (`id_sc`, `id_gorod`, `site`, `name_sc`, `adres_sc`, `phone_sc`, `kontakt_sc`, `mail_sc`, `rab_sc`) VALUES
(1, 1, 'www.fixinka.com', 'Фиксинка', 'г.Київ. ул.Крещатик 17, оф.1,', '', '', 'support@fixinka.com', 'пн.-пт. с8 до 20, сб 11-16, нд. - вихідний');

-- --------------------------------------------------------

--
-- Структура таблицы `sost_remonta`
--

CREATE TABLE IF NOT EXISTS `sost_remonta` (
  `id_sost` int(4) NOT NULL AUTO_INCREMENT,
  `name_sost` text,
  `background` varchar(20) NOT NULL,
  `type` int(1) DEFAULT '1',
  `call2client` int(1) DEFAULT '0',
  PRIMARY KEY (`id_sost`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `sost_remonta`
--

INSERT INTO `sost_remonta` (`id_sost`, `name_sost`, `background`, `type`, `call2client`) VALUES
(1, 'Новый', '#999999', 1, 0),
(3, 'Ожидает запчасть', '#666633', 1, 0),
(4, 'Готов', '#006666', 1, 0),
(5, 'Без ремонта', '#dedede', 1, 0),
(7, 'Выдан без ремонта', '#696969', 0, 0),
(8, 'Списан на запчасти', '#696969', 0, 0),
(9, 'Согласовать цену', '#FF6600', 1, 1),
(10, 'Позвонить клиенту', '#DEB887', 1, 1),
(11, 'На тесте', '#CCCC00', 1, 1),
(2, 'В работе', '#8B0000', 1, 0),
(6, 'Выдан с ремонтом', '#696969', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `id_sc` int(4) DEFAULT '1',
  `fam` text NOT NULL,
  `imya` text NOT NULL,
  `otch` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  `send_mail` datetime NOT NULL,
  `phone` text NOT NULL,
  `adres` text NOT NULL,
  `zavod` text NOT NULL,
  `gorod_id` int(4) NOT NULL,
  `id_group` int(4) NOT NULL,
  `id_portret` int(4) NOT NULL DEFAULT '1',
  `user_hash` text NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `vid_remonta`
--

CREATE TABLE IF NOT EXISTS `vid_remonta` (
  `id_remonta` int(4) NOT NULL AUTO_INCREMENT,
  `name_remonta` text NOT NULL,
  PRIMARY KEY (`id_remonta`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `vid_remonta`
--

INSERT INTO `vid_remonta` (`id_remonta`, `name_remonta`) VALUES
(1, 'гарантийный'),
(2, 'негарантийный'),
(3, 'предпродажный'),
(4, 'выезд(гарантийный)'),
(5, 'выезд(негарантийный)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
