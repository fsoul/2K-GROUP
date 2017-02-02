-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 02 2017 г., 05:27
-- Версия сервера: 5.5.53
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `metro`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dealer`
--

CREATE TABLE `dealer` (
  `id` int(11) NOT NULL,
  `dealer_name` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dealer`
--

INSERT INTO `dealer` (`id`, `dealer_name`, `address`, `phone`) VALUES
(1, '1-й диллер', '1-й адрес', '111111111'),
(2, '2-й диллер', '2-й адрес', '22222222'),
(3, '3-й диллер', '3-й адрес', '33333333'),
(4, '4-й диллер', '4-й адрес', '44444444');

-- --------------------------------------------------------

--
-- Структура таблицы `metro_dealer`
--

CREATE TABLE `metro_dealer` (
  `metro_station_id` int(11) NOT NULL DEFAULT '0',
  `dealer_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `metro_dealer`
--

INSERT INTO `metro_dealer` (`metro_station_id`, `dealer_id`) VALUES
(2, 1),
(2, 4),
(3, 2),
(3, 4),
(4, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `metro_station`
--

CREATE TABLE `metro_station` (
  `id` int(11) NOT NULL,
  `metro_station_name` varchar(150) DEFAULT NULL,
  `metro_station_coords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `metro_station`
--

INSERT INTO `metro_station` (`id`, `metro_station_name`, `metro_station_coords`) VALUES
(1, 'Белорусская', '303,259,5;311,255,367,270'),
(2, 'Маяковская', '342,301,5;284,302,337,308'),
(3, 'Пушкинская', '367,323,5;310,329,364,345'),
(4, 'Цветной бульвар', '398,280,5;405,269,442,287');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `metro_dealer`
--
ALTER TABLE `metro_dealer`
  ADD PRIMARY KEY (`metro_station_id`,`dealer_id`);

--
-- Индексы таблицы `metro_station`
--
ALTER TABLE `metro_station`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dealer`
--
ALTER TABLE `dealer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `metro_station`
--
ALTER TABLE `metro_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
