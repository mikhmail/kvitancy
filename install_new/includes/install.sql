-- phpMyAdmin SQL Dump
-- version 4.4.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 30 2016 г., 12:06
-- Версия сервера: 5.5.44
-- Версия PHP: 5.4.41

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `admin_remont`
--

-- --------------------------------------------------------

--
-- Структура таблицы `aparaty`
--

CREATE TABLE IF NOT EXISTS `aparaty` (
  `id_aparat` int(4) NOT NULL,
  `aparat_name` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=156 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `aparaty`
--

INSERT INTO `aparaty` (`id_aparat`, `aparat_name`) VALUES
(0, '0ДРУГОЕ'),
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
(131, 'Электронная ламна');

-- --------------------------------------------------------

--
-- Структура таблицы `aparat_p`
--

CREATE TABLE IF NOT EXISTS `aparat_p` (
  `id_aparat_p` int(3) NOT NULL,
  `id_aparat` int(3) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=775 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `aparat_p`
--

INSERT INTO `aparat_p` (`id_aparat_p`, `id_aparat`, `title`) VALUES
(201, 27, '0-Другое'),
(38, 27, 'Матрицы/экраны'),
(199, 27, 'Строчные трансформаторы'),
(44, 27, 'Кабели'),
(197, 27, 'Инверторы'),
(40, 27, 'Блоки питания'),
(46, 27, 'Модули подсветки'),
(469, 27, 'Тюнеры/ Медиаплееры'),
(470, 27, 'Платы управления'),
(471, 27, 'Процессоры'),
(472, 27, 'Пульты'),
(473, 27, 'Шлейфы'),
(113, 8, 'Клавиатуры'),
(114, 8, 'Дисплеи'),
(115, 8, 'Динамики слуховые'),
(116, 8, 'Камеры'),
(117, 8, 'Аккумуляторы'),
(119, 8, 'Клавиатурные подложки'),
(120, 8, 'Кнопки /Джойстики'),
(122, 8, '0-Другое'),
(121, 8, 'Кабели'),
(483, 8, 'Тачскрины/Сенсоры'),
(626, 7, 'Матрицы 7'),
(335, 7, 'Корпуса'),
(336, 7, 'Рамки, крышки'),
(337, 7, 'Петли'),
(338, 7, 'Клавиатуры'),
(339, 7, 'Тачпады'),
(340, 7, 'Динамики'),
(341, 7, 'Шлейфы'),
(342, 7, 'Материнские платы'),
(343, 7, 'Дополнительные платы'),
(344, 7, 'Разъемы'),
(345, 7, 'Система охлаждения в сборе'),
(346, 7, 'Кулеры'),
(347, 7, 'Карманы для HDD'),
(348, 7, 'CD-DVD приводы'),
(349, 7, 'Процессоры'),
(350, 7, 'WiFi, Bluetooth, 3g модули - карты'),
(351, 7, 'Блоки питания'),
(352, 7, 'Оперативная память ОЗУ'),
(353, 7, 'Батареи'),
(354, 7, 'Инверторы'),
(355, 7, 'Вебкамеры'),
(356, 7, 'Заглушки'),
(357, 7, '0-Другое'),
(371, 22, '0-Другое'),
(372, 22, 'Камеры'),
(374, 22, 'Кнопки (громкости, включения, home)'),
(375, 22, 'Корпуса'),
(376, 22, 'Матрицы/экраны'),
(377, 22, 'Микросхемы'),
(378, 22, 'Модули(экран+тач)'),
(379, 22, 'Блоки питания'),
(380, 22, 'Тачскрины/сенсоры'),
(395, 22, 'Шлейфы'),
(361, 12, 'Блоки питания'),
(381, 12, 'Видеокарты'),
(382, 12, 'Внутренние HDD (жесткие диски)'),
(383, 12, '0-Другое'),
(384, 12, 'Звуковые карты'),
(385, 12, 'Кардридеры'),
(386, 12, 'Клавиатуры'),
(387, 12, 'Контроллеры'),
(388, 12, 'Корпуса'),
(389, 12, 'Материнские платы'),
(390, 12, 'Модули памяти'),
(391, 12, 'Оптические приводы'),
(392, 12, 'Процессоры'),
(393, 12, 'Сетевые карты'),
(394, 12, 'Системы охлаждения'),
(396, 13, 'Блок питания'),
(397, 13, 'Главная плата управления'),
(398, 13, '0-Другое'),
(399, 13, 'Корпус'),
(400, 13, 'Матрица'),
(401, 13, 'Панель управления'),
(402, 13, 'Экран'),
(403, 32, 'Бойлера'),
(404, 32, 'Датчики'),
(405, 32, '0-Другое'),
(406, 32, 'Заварные устройства'),
(407, 32, 'Кофемолки'),
(408, 32, 'Клапаны'),
(409, 32, 'Корпусные детали'),
(410, 32, 'Краны горячей воды/Паровые краны'),
(411, 32, 'Платы'),
(412, 32, 'Помпы'),
(413, 32, 'Раздаточные группы'),
(414, 32, 'Рожки (холдеры), фильтродержатели'),
(415, 32, 'Теплообменные стаканы/системы трубок'),
(431, 20, 'Корпуса'),
(432, 20, 'Ламели'),
(433, 20, 'Лампы'),
(434, 20, 'Матрицы'),
(435, 20, 'Механизмы'),
(436, 20, 'Микросхемы'),
(437, 20, 'Модули (узловые сборки)'),
(438, 20, 'Наглазники'),
(439, 20, 'Объективы'),
(440, 20, 'Платы'),
(441, 20, 'Предохранители'),
(442, 20, 'Фокусировочные экраны'),
(443, 20, 'Шестерни'),
(444, 20, 'Шлейфы'),
(448, 59, 'Валы тефлоновые'),
(446, 59, 'Валы первичного заряда'),
(447, 59, 'Валы резиновые'),
(449, 59, 'Втулки'),
(450, 59, 'Датчики'),
(451, 59, '0-Другое'),
(452, 59, 'Корпуса'),
(453, 59, 'Лезвия дозирования'),
(454, 59, 'Лезвия чистящие'),
(455, 59, 'Лезвия уплотнительные'),
(456, 59, 'Муфты'),
(457, 59, 'Нагревательные элементы'),
(458, 59, 'Накладки'),
(459, 59, 'Платы питания'),
(460, 59, 'Платы управления'),
(461, 59, 'Ролики'),
(462, 59, 'Сепараторы'),
(463, 59, 'Термопленки'),
(464, 59, 'Тормозные площадки'),
(465, 59, 'Узлы закрепления (печки)'),
(466, 59, 'Фотобарабаны'),
(467, 59, 'Шестерни'),
(468, 59, 'Шлейфы,кабели'),
(474, 8, 'Динамики полифонические'),
(475, 8, 'Корпуса'),
(476, 8, 'Микросхемы'),
(477, 8, 'Микрофоны'),
(478, 8, 'Модули'),
(479, 8, 'Платы'),
(480, 8, 'Разъмы'),
(481, 8, 'Шлейфы'),
(486, 7, 'Микросхемы'),
(487, 7, 'Чипы'),
(491, 47, 'Венчики'),
(490, 47, 'Шестерни'),
(492, 47, 'Гайки'),
(493, 47, 'Держатели терок'),
(494, 47, 'Крышки'),
(495, 47, 'Лотки'),
(496, 47, 'Мясорубки'),
(497, 47, 'Ножи'),
(498, 47, 'Овощерезки'),
(499, 47, 'Решетки'),
(500, 47, 'Соковыжималки'),
(501, 47, 'Терки'),
(502, 47, 'Толкатели'),
(503, 47, 'Тубусы'),
(504, 47, 'Уплотнения'),
(505, 47, 'Двигатели'),
(506, 47, '0-Другое'),
(507, 46, 'Двигатели'),
(508, 46, 'Держатели сита'),
(509, 46, 'Другое'),
(510, 46, 'Ножи-сито'),
(511, 46, 'Заглушки'),
(512, 46, 'Насадки'),
(513, 46, 'Защелки'),
(514, 46, 'Контейнеры для жмыха'),
(515, 46, 'Крышки корпуса'),
(516, 46, 'Сливы для сока'),
(517, 46, 'Толкатели'),
(518, 46, 'Чаши'),
(519, 40, 'Гайки'),
(520, 40, '0-Другое'),
(578, 47, 'Насадки'),
(522, 40, 'Кеббе'),
(523, 40, 'Лотки'),
(524, 40, 'Муфты-предохранители'),
(525, 40, 'Мясорубки'),
(526, 40, 'Нарезки кубики'),
(527, 40, 'Ножи'),
(528, 40, 'Овощерезки'),
(529, 40, 'Решетки'),
(530, 40, 'Соковыжималки'),
(531, 40, 'Терки'),
(532, 40, 'Толкатели'),
(533, 40, 'Тубусы'),
(534, 40, 'Шнеки'),
(535, 40, 'Насадки'),
(536, 40, 'Двигатели'),
(537, 22, 'Материнские платы'),
(538, 22, 'Модули связи (3G, wi-fi)'),
(539, 22, 'Разъемы'),
(540, 22, 'Динамики'),
(541, 22, 'Микрофоны'),
(550, 44, 'Вентиляторы'),
(551, 44, '0-Другое'),
(552, 44, 'Дверки'),
(553, 44, 'Диоды'),
(554, 44, 'Кнопки'),
(555, 44, 'Конденсаторы'),
(556, 44, 'Лампочки'),
(557, 44, 'Магнетроны'),
(558, 44, 'Моторчики тарелки'),
(559, 44, 'Моторы'),
(560, 44, 'Панели управления'),
(561, 44, 'Пластмассовые изделия'),
(562, 44, 'Предохранители'),
(563, 44, 'Программаторы'),
(564, 44, 'Резисторы'),
(565, 44, 'Реле'),
(566, 44, 'Роллеры'),
(567, 44, 'Ручки'),
(568, 44, 'Слюда'),
(569, 44, 'Стекла дверки'),
(570, 44, 'Таймеры'),
(571, 44, 'Тарелки'),
(572, 44, 'Термостаты'),
(573, 44, 'Трансформаторы'),
(574, 44, 'ТЭНы'),
(575, 44, 'Электрические датчики t'),
(576, 44, 'Электронные модули'),
(577, 47, 'Муфты'),
(586, 38, 'Ведра, лотки, подставки'),
(587, 38, 'Лопатки'),
(588, 38, 'Электронные платы'),
(589, 38, '0-Другое'),
(590, 38, 'Мерные ложки и стаканы'),
(591, 38, 'Ремни'),
(592, 38, 'Сальники'),
(593, 38, 'Тэны'),
(594, 38, 'Подшипники'),
(595, 38, 'Моторы'),
(596, 38, 'Шестерни'),
(597, 38, 'Шкивы'),
(598, 38, 'Приводы ведра (контейнера)'),
(599, 38, 'Клавиатуры'),
(600, 38, 'Крышки'),
(601, 12, 'Шлейфы'),
(602, 7, 'Кабели питания'),
(603, 7, 'Жесткие диски'),
(604, 59, 'Картриджи'),
(605, 41, 'шестерня'),
(606, 41, 'двигатель'),
(607, 32, 'Резинки'),
(617, 7, 'Матрицы 9'),
(618, 7, 'Матрицы 10'),
(619, 7, 'Матрицы 11'),
(620, 7, 'Матрицы 12'),
(621, 7, 'Матрицы 13'),
(622, 7, 'Матрицы 14'),
(623, 7, 'Матрицы 15'),
(624, 7, 'Матрицы 16'),
(625, 7, 'Матрицы 17'),
(627, 8, 'Сим приемник'),
(628, 43, 'ИБП'),
(629, 22, 'Кабель'),
(630, 80, 'Трансформатор'),
(631, 43, 'Батарея'),
(632, 61, 'блок питания'),
(633, 8, 'Стекло'),
(634, 21, 'Материнская плата'),
(635, 45, 'вилка'),
(636, 69, 'УНЧ'),
(637, 80, 'Ремкомплект'),
(638, 80, 'Тройник'),
(639, 80, 'Хомут'),
(640, 80, 'Клапан'),
(641, 8, 'чехол'),
(642, 7, 'Карман Для HDD'),
(643, 80, 'Пищевой концентрат для удаления накипи'),
(644, 80, 'Капучинатор'),
(645, 129, 'ШИМ'),
(646, 129, 'Стабилитрон'),
(647, 8, 'аудио разъемы'),
(648, 8, 'набор болтиков'),
(649, 8, 'Антенна'),
(650, 7, 'мульт'),
(651, 7, 'USB разъем'),
(652, 12, 'электролиты'),
(653, 7, 'Разъемы питания'),
(654, 8, 'Тач скрин'),
(655, 80, 'Плата'),
(656, 80, 'Мотор'),
(657, 80, 'Мотор кофемолки'),
(658, 80, 'Мотор кофемолки.'),
(659, 80, 'Панарела'),
(660, 80, 'Диспенсер'),
(661, 80, 'Кнопка включения'),
(662, 80, 'Решетка поддона'),
(663, 27, 'транзистор'),
(664, 22, 'Батарея(3.7v)'),
(665, 21, 'Микросхема'),
(666, 22, 'SIM коннектор'),
(667, 28, 'трансформатор'),
(668, 28, 'предохранитель'),
(669, 27, 'шим'),
(670, 117, 'диод'),
(671, 117, 'предохранитель'),
(672, 7, 'Тачскрин(Сенсор)'),
(673, 80, 'Резинка под холдер'),
(674, 80, 'Кофемолка'),
(675, 80, 'Помпа'),
(676, 102, 'Клапан котушки'),
(677, 102, 'Клапан катушки'),
(678, 80, 'штуцер'),
(679, 7, 'ICS9LPRS480'),
(680, 117, 'Трансформатор'),
(681, 96, 'АКБ'),
(682, 27, 'FSP132-4F02'),
(683, 24, 'Системный блок'),
(684, 31, 'Матрица'),
(685, 57, 'Аккумуляторы'),
(686, 101, 'шим'),
(687, 101, 'резистор'),
(688, 80, 'Бункер отходов'),
(689, 119, 'Аккумулятор'),
(690, 80, 'Бойлер'),
(691, 80, 'Бункер для воды'),
(692, 21, 'Матрицы/экраны'),
(693, 24, 'Провод'),
(694, 61, 'Провод'),
(695, 80, 'Теплообменник'),
(696, 80, 'Дренажный клапан'),
(697, 80, 'Резиновый уплотнители'),
(698, 80, 'Носик выдачи кофе'),
(699, 80, 'Направляющее дозатора'),
(700, 80, 'Направляющае дозатора'),
(701, 80, 'Направляющая дозатора'),
(702, 37, 'Терморелле'),
(703, 80, 'Катушка электроклапана'),
(704, 31, 'чипи'),
(705, 40, 'Шестерни'),
(706, 22, 'Плата зарядки'),
(707, 101, 'Шлейф'),
(708, 7, 'Шим'),
(709, 80, 'Пластик для двери'),
(710, 80, 'Петля для двери верхняя.'),
(711, 80, 'Жернова'),
(712, 24, 'Блок питания'),
(713, 144, 'Провод'),
(714, 29, 'Наушники'),
(715, 24, 'Автомобильный блок питания USB 5V'),
(716, 145, 'Защитное стекло'),
(717, 146, 'Защитная пленка'),
(718, 123, 'Софтнер'),
(719, 80, 'редуктор ЗУ'),
(720, 80, 'Шестерня'),
(721, 56, 'Динамик'),
(722, 79, 'Медиаплеер'),
(723, 80, 'Полка поддона чашек'),
(724, 80, 'Концентрат для очистки жиров и масел'),
(725, 80, 'Нагревательный элемент'),
(726, 154, 'Батарейки'),
(727, 80, 'Крышка для штуцера.'),
(728, 13, 'шим'),
(729, 155, 'micro USB'),
(730, 80, 'Датчик'),
(731, 80, 'Сетевые кабели.'),
(732, 52, 'Шим контроллеры'),
(733, 52, 'Резисторы'),
(734, 52, 'Стабилитрони'),
(735, 80, 'Дисплей (Экран)'),
(736, 7, 'Кнопка'),
(737, 43, 'Транзистор MOSFET'),
(738, 80, 'Переходник'),
(739, 80, 'Прокладка'),
(740, 32, 'Штуцер/переходник/фитинг'),
(774, 7, 'что-то');

-- --------------------------------------------------------

--
-- Структура таблицы `cash`
--

CREATE TABLE IF NOT EXISTS `cash` (
  `id` int(8) NOT NULL,
  `name` text NOT NULL,
  `plus` float NOT NULL DEFAULT '0',
  `minus` float NOT NULL DEFAULT '0',
  `id_kvitancy` int(8) DEFAULT NULL,
  `update_user` int(8) DEFAULT NULL,
  `update_time` time DEFAULT '00:00:00',
  `id_sc` int(2) NOT NULL,
  `update_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=cp1251;



-- --------------------------------------------------------

--
-- Структура таблицы `ci_cookies`
--

CREATE TABLE IF NOT EXISTS `ci_cookies` (
  `id` int(11) NOT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `user_id` int(4) NOT NULL,
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
  `gorod_id` int(4) NOT NULL,
  `id_group` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(4) NOT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `comment` text NOT NULL,
  `id_user` int(4) DEFAULT NULL,
  `id_kvitancy` int(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `goroda`
--

CREATE TABLE IF NOT EXISTS `goroda` (
  `gorod_id` int(4) NOT NULL,
  `gorod` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `goroda`
--

INSERT INTO `goroda` (`gorod_id`, `gorod`) VALUES
(6, 'Киев');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_dostupa`
--

CREATE TABLE IF NOT EXISTS `groups_dostupa` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(16) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=cp1251;

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
  `id_kvitancy` int(4) NOT NULL,
  `user_id` int(4) DEFAULT '1',
  `id_aparat` int(4) DEFAULT NULL,
  `id_proizvod` int(4) NOT NULL DEFAULT '0',
  `model` text NOT NULL,
  `ser_nomer` text NOT NULL,
  `id_remonta` int(4) DEFAULT NULL,
  `neispravnost` text NOT NULL,
  `vid` text NOT NULL,
  `komplektnost` text,
  `date_priemka` date DEFAULT '0000-00-00',
  `date_okonchan` date DEFAULT '0000-00-00',
  `date_vydachi` date DEFAULT '0000-00-00',
  `id_sost` int(4) DEFAULT NULL,
  `id_mechanic` int(4) DEFAULT NULL,
  `id_sc` int(2) NOT NULL DEFAULT '1',
  `primechaniya` text,
  `comments` text NOT NULL,
  `update_time` text NOT NULL,
  `update_user` text NOT NULL,
  `id_where` int(11) NOT NULL,
  `id_responsible` int(11) NOT NULL,
  `full_cost` decimal(16,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  `id_group` int(1) NOT NULL,
  `id_sc` int(2) NOT NULL,
  `active` int(1) DEFAULT '1',
  `show_my_tickets` int(1) DEFAULT '1',
  `show_call_tickets` int(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `membership`
--

INSERT INTO `membership` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`, `id_group`, `id_sc`, `active`, `show_my_tickets`, `show_call_tickets`) VALUES
(3, 'Adm', 'Test', 'admin@fixinka.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `parts`
--

CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(4) NOT NULL,
  `name` text NOT NULL,
  `id_aparat` int(4) NOT NULL DEFAULT '0',
  `id_aparat_p` int(4) NOT NULL DEFAULT '0',
  `id_proizvod` int(4) NOT NULL DEFAULT '0',
  `model` text,
  `serial` text,
  `vid` text,
  `id_sost` int(1) NOT NULL DEFAULT '1',
  `user_id` int(4) DEFAULT '1',
  `date_priemka` date DEFAULT '0000-00-00',
  `date_vydachi` date DEFAULT '0000-00-00',
  `cost` float NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `id_kvitancy` int(8) DEFAULT NULL,
  `update_user` int(8) DEFAULT NULL,
  `update_time` varchar(100) DEFAULT NULL,
  `id_resp` int(8) DEFAULT NULL,
  `id_from` varchar(100) DEFAULT NULL,
  `id_where` int(1) NOT NULL,
  `id_sc` int(2) NOT NULL,
  `text` text
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Структура таблицы `proizvoditel`
--

CREATE TABLE IF NOT EXISTS `proizvoditel` (
  `id_proizvod` int(4) NOT NULL,
  `name_proizvod` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=454 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `proizvoditel`
--

INSERT INTO `proizvoditel` (`id_proizvod`, `name_proizvod`) VALUES
(0, '0ДРУГОЕ'),
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
(446, 'amico');

-- --------------------------------------------------------

--
-- Структура таблицы `service_centers`
--

CREATE TABLE IF NOT EXISTS `service_centers` (
  `id_sc` int(4) NOT NULL,
  `id_gorod` int(4) NOT NULL,
  `site` varchar(50) DEFAULT NULL,
  `name_sc` text NOT NULL,
  `adres_sc` text NOT NULL,
  `phone_sc` text NOT NULL,
  `kontakt_sc` text NOT NULL,
  `mail_sc` text NOT NULL,
  `rab_sc` varchar(500) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=cp1251 PACK_KEYS=0;

--
-- Дамп данных таблицы `service_centers`
--

INSERT INTO `service_centers` (`id_sc`, `id_gorod`, `site`, `name_sc`, `adres_sc`, `phone_sc`, `kontakt_sc`, `mail_sc`, `rab_sc`) VALUES
(1, 6, 'www.fixinka.com', 'Сервис1', 'г.Київ. ул.Крещатик 17, оф.1,', '', '', 'support@fixinka.com', 'пн.-пт. с8 до 20, сб 11-16, нд. - вихідний');

-- --------------------------------------------------------

--
-- Структура таблицы `sost_remonta`
--

CREATE TABLE IF NOT EXISTS `sost_remonta` (
  `id_sost` int(4) NOT NULL,
  `name_sost` text,
  `background` varchar(20) NOT NULL,
  `type` int(1) DEFAULT '1',
  `call2client` int(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=cp1251;

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
-- Структура таблицы `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` int(4) NOT NULL,
  `name` text NOT NULL,
  `id_aparat` int(4) NOT NULL DEFAULT '0',
  `id_aparat_p` int(4) NOT NULL DEFAULT '0',
  `id_proizvod` int(4) NOT NULL DEFAULT '0',
  `model` text,
  `serial` text,
  `vid` text,
  `id_sost` int(1) NOT NULL DEFAULT '1',
  `user_id` int(4) DEFAULT '1',
  `date_priemka` date DEFAULT '0000-00-00',
  `date_vydachi` date DEFAULT '0000-00-00',
  `cost` float NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `id_kvitancy` int(8) DEFAULT NULL,
  `update_user` int(8) DEFAULT NULL,
  `update_time` varchar(100) DEFAULT NULL,
  `id_resp` int(8) DEFAULT NULL,
  `id_from` varchar(100) DEFAULT NULL,
  `id_where` int(1) NOT NULL,
  `id_sc` int(2) NOT NULL,
  `text` text
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(4) NOT NULL,
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
  `active` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

--
-- Структура таблицы `vid_remonta`
--

CREATE TABLE IF NOT EXISTS `vid_remonta` (
  `id_remonta` int(4) NOT NULL,
  `name_remonta` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `vid_remonta`
--

INSERT INTO `vid_remonta` (`id_remonta`, `name_remonta`) VALUES
(1, 'гарантийный'),
(2, 'негарантийный'),
(3, 'предпродажный'),
(4, 'выезд(гарантийный)'),
(5, 'выезд(негарантийный)'),
(9, 'Доставка');

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(4) NOT NULL,
  `id_sc` int(1) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cost` int(8) NOT NULL,
  `user_id` int(8) DEFAULT NULL,
  `id_kvitancy` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `aparaty`
--
ALTER TABLE `aparaty`
  ADD PRIMARY KEY (`id_aparat`);

--
-- Индексы таблицы `aparat_p`
--
ALTER TABLE `aparat_p`
  ADD PRIMARY KEY (`id_aparat_p`);

--
-- Индексы таблицы `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ci_cookies`
--
ALTER TABLE `ci_cookies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Индексы таблицы `goroda`
--
ALTER TABLE `goroda`
  ADD PRIMARY KEY (`gorod_id`);

--
-- Индексы таблицы `groups_dostupa`
--
ALTER TABLE `groups_dostupa`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `kvitancy`
--
ALTER TABLE `kvitancy`
  ADD PRIMARY KEY (`id_kvitancy`);

--
-- Индексы таблицы `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`PersonId`);

--
-- Индексы таблицы `proizvoditel`
--
ALTER TABLE `proizvoditel`
  ADD PRIMARY KEY (`id_proizvod`);

--
-- Индексы таблицы `service_centers`
--
ALTER TABLE `service_centers`
  ADD PRIMARY KEY (`id_sc`);

--
-- Индексы таблицы `sost_remonta`
--
ALTER TABLE `sost_remonta`
  ADD PRIMARY KEY (`id_sost`);

--
-- Индексы таблицы `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `vid_remonta`
--
ALTER TABLE `vid_remonta`
  ADD PRIMARY KEY (`id_remonta`);

--
-- Индексы таблицы `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `aparaty`
--
ALTER TABLE `aparaty`
  MODIFY `id_aparat` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT для таблицы `aparat_p`
--
ALTER TABLE `aparat_p`
  MODIFY `id_aparat_p` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=775;
--
-- AUTO_INCREMENT для таблицы `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `ci_cookies`
--
ALTER TABLE `ci_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `goroda`
--
ALTER TABLE `goroda`
  MODIFY `gorod_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `groups_dostupa`
--
ALTER TABLE `groups_dostupa`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `kvitancy`
--
ALTER TABLE `kvitancy`
  MODIFY `id_kvitancy` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT для таблицы `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `people`
--
ALTER TABLE `people`
  MODIFY `PersonId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `proizvoditel`
--
ALTER TABLE `proizvoditel`
  MODIFY `id_proizvod` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=454;
--
-- AUTO_INCREMENT для таблицы `service_centers`
--
ALTER TABLE `service_centers`
  MODIFY `id_sc` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `sost_remonta`
--
ALTER TABLE `sost_remonta`
  MODIFY `id_sost` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `store`
--
ALTER TABLE `store`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `vid_remonta`
--
ALTER TABLE `vid_remonta`
  MODIFY `id_remonta` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `works`
--
ALTER TABLE `works`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
