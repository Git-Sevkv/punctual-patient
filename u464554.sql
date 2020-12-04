-- phpMyAdmin SQL Dump
-- version 4.9.0.1-mh4
-- https://www.phpmyadmin.net/
--
-- Хост: u464554.mysql.masterhost.ru
-- Время создания: Дек 04 2020 г., 14:55
-- Версия сервера: 5.6.48-log
-- Версия PHP: 7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u464554`
--

-- --------------------------------------------------------

--
-- Структура таблицы `CAV_doctor`
--

CREATE TABLE `CAV_doctor` (
  `id` int(11) NOT NULL,
  `id_ind_doc` int(11) NOT NULL,
  `doctor` varchar(250) NOT NULL,
  `n_kab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `CAV_doctor`
--

INSERT INTO `CAV_doctor` (`id`, `id_ind_doc`, `doctor`, `n_kab`) VALUES
(1, 2, 'Терапевт', 21),
(2, 3, 'Хирург', 15),
(3, 1, 'Окулист', 34);

-- --------------------------------------------------------

--
-- Структура таблицы `CAV_individ`
--

CREATE TABLE `CAV_individ` (
  `id` int(11) NOT NULL,
  `fam` varchar(400) NOT NULL,
  `name` varchar(400) NOT NULL,
  `s_name` varchar(400) NOT NULL,
  `date_of_brth` varchar(250) NOT NULL,
  `login` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `CAV_individ`
--

INSERT INTO `CAV_individ` (`id`, `fam`, `name`, `s_name`, `date_of_brth`, `login`, `password`) VALUES
(1, 'Иванов', 'Иван', 'Иванович', '2020-11-18', 're', 'tr'),
(2, 'Киров', 'Дмитрий', 'Вячеславович', '1999-02-18', 'rpr', 'es'),
(3, 'Трепин', 'Сергей', 'Дмитриевич', '2000-06-05', 'ty', 'tr'),
(4, 'Климов', 'Анатолий', 'Сергеевич', '1992-12-10', 'po', 'rt'),
(5, 'Капустин', 'Николай', 'Александрович', '1995-08-28', 'bn', 'cv'),
(6, 'Ларюхина', 'Анастасия', 'Юрьевна', '2004-03-18', 'la', 'cecbr'),
(7, 'Самолина', 'Дарья', 'Олеговна', '1998-06-26', 'as', 'df');

-- --------------------------------------------------------

--
-- Структура таблицы `CAV_pac`
--

CREATE TABLE `CAV_pac` (
  `id` int(11) NOT NULL,
  `id_ind_pac` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `date_p` date NOT NULL,
  `time` time NOT NULL,
  `time_arrived` time DEFAULT NULL,
  `time_way_fact` time DEFAULT NULL,
  `time_way` time NOT NULL,
  `time_after` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `CAV_pac`
--

INSERT INTO `CAV_pac` (`id`, `id_ind_pac`, `id_doc`, `date_p`, `time`, `time_arrived`, `time_way_fact`, `time_way`, `time_after`) VALUES
(5, 3, 2, '2020-12-03', '15:00:00', NULL, NULL, '15:00:00', NULL),
(6, 1, 2, '2020-12-04', '12:00:00', '13:06:23', '13:28:13', '13:21:26', '13:28:13'),
(7, 5, 2, '2020-12-04', '12:30:00', '14:35:41', '14:50:33', '14:50:33', NULL),
(8, 4, 2, '2020-12-04', '12:45:00', NULL, NULL, '15:05:33', NULL),
(9, 2, 2, '2020-12-04', '12:15:00', '13:13:44', '14:11:04', '14:11:01', '14:11:04'),
(10, 7, 2, '2020-12-05', '14:30:00', NULL, NULL, '14:30:00', NULL),
(11, 6, 3, '2020-12-04', '12:30:00', '14:18:51', NULL, '12:30:00', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `CAV_doctor`
--
ALTER TABLE `CAV_doctor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `CAV_individ`
--
ALTER TABLE `CAV_individ`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `CAV_pac`
--
ALTER TABLE `CAV_pac`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
