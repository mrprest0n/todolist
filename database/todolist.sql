-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 27 2018 г., 18:50
-- Версия сервера: 8.0.13
-- Версия PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todolist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `dt_create` date NOT NULL,
  `dt_change` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `lists`
--

INSERT INTO `lists` (`id`, `name`, `description`, `user`, `dt_create`, `dt_change`) VALUES
(2, 'Работа', 'Список дел по работе перед отпуском', 4, '2018-12-24', '2018-12-24'),
(3, 'Дом', 'Список дел по дому', 4, '2018-12-24', '2018-12-24'),
(4, 'Отпуск', 'Всё для отпуска', 4, '2018-12-24', '2018-12-24'),
(5, 'Подготовиться к собеседованию', 'Не забыть изучить', 4, '2018-12-24', '2018-12-24'),
(6, 'Список покупок', 'На Новый год', 6, '2018-12-25', '2018-12-25'),
(8, 'Взять в поход', 'Из-за того, что Вероника -- веган, учесть её специфический рацион.', 5, '2018-12-25', '2018-12-25'),
(10, '111111111', '', 4, '2018-12-26', '2018-12-26'),
(11, '222222', '2222', 4, '2018-12-26', '2018-12-26'),
(12, '333333333', '333333333', 4, '2018-12-26', '2018-12-26'),
(19, '444444', '444444', 4, '2018-12-26', '2018-12-26');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lists` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `lists`, `done`) VALUES
(1, 'Убраться на кухне', 'За холодильником тоже', 3, 1),
(2, 'Кукуруза', '', 6, 1),
(3, 'Зелёный горошек', '', 6, 0),
(4, 'Помыть полы', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 1),
(6, 'Погладить кота', 'Нежно', 3, 1),
(7, 'Постирать грязные вещи', 'Цветные кинуть отдельно!', 3, 0),
(13, 'Приготовить ужин', 'Опять придут Петровы и опять всё сожрут.', 3, 0),
(15, 'Выбить ковры', 'Будто кому-то они нужны...', 3, 0),
(16, 'Помыть посуду', 'Ведь ты — посудомойка, а не женщина.', 3, 0),
(27, 'Майонез', 'Нужно боооооольше майонеза', 6, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_hash` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_reset_token` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(4, 'admin', 'q1mxT18lzeYjZBx4Ixs77jWSgkwdXnvC', '$2y$13$RDd1152BqsBaoURD94ifCee0RN5fQ5tYX8TLvBfpaMOTv5kRM/QZq', NULL, 'admin@admin.ru', 10, 1545432745, 1545432745),
(5, 'admin2', 'zjEQO9ivjUkzY1ELtvRwo4ZTmEE5rjLe', '$2y$13$lCV9tsV5MVtif6nk9rPgUeDUb/B5x9F0Il0i6OiAE.kfbZKs.edEO', NULL, 'admin2@admin2.ru', 10, 1545670074, 1545670074),
(6, 'mrpreston', 'XRLHRYxTvWfFdHK_aXPrSiCEKngnHOHx', '$2y$13$8CjAuUp0IauOm6/Mqh7IE.sP2LQREgtSxIvN8na30LIdSdbb24WwO', NULL, 'mrpreston@mail.ru', 10, 1545671421, 1545923668);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user` (`user`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lists` (`lists`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`lists`) REFERENCES `lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
