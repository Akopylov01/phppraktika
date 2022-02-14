-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 14 2022 г., 04:20
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `FIO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `FIO`) VALUES
(22, 'Александр Сергеевич Пушкин'),
(23, 'Федор Михайлович Достоевский');

-- --------------------------------------------------------

--
-- Структура таблицы `author_books`
--

CREATE TABLE `author_books` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `author_books`
--

INSERT INTO `author_books` (`id`, `book_id`, `author_id`) VALUES
(61, 109, 22),
(62, 110, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `cost` float NOT NULL,
  `new` tinyint(1) NOT NULL,
  `annotation` varchar(255) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `author`, `image`, `title`, `genre`, `category`, `year`, `cost`, `new`, `annotation`, `count`) VALUES
(109, 22, '166494-igra_v_kalmara_squid_game-500x.jpg', 'Капитанская дочка', 'Повесть', 'Художественная литература', 2020, 600, 0, 'В идеальном состоянии', 0),
(110, 23, '145031-glaz-krug-rozovyj-resnichka-graficeskij_dizajn-500x.jpg', 'Преступление и наказание', 'Роман', 'Художественная литература', 1999, 0, 0, 'Потрепанная', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(11) NOT NULL,
  `date_issue` date NOT NULL,
  `date_return` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `library_cards`
--

CREATE TABLE `library_cards` (
  `id` int(11) NOT NULL,
  `library_card_id` varchar(15) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `date_issued` date NOT NULL,
  `date_closed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `library_cards`
--

INSERT INTO `library_cards` (`id`, `library_card_id`, `isActive`, `date_issued`, `date_closed`) VALUES
(104, '95038215', 0, '2022-02-09', '0000-00-00'),
(105, '94871403', 0, '2022-02-09', '0000-00-00'),
(106, '91079700', 0, '2022-02-09', '0000-00-00'),
(107, '96048243', 0, '2022-02-09', '0000-00-00'),
(108, '90541808', 0, '2022-02-09', '0000-00-00'),
(109, '97830599', 0, '2022-02-09', '0000-00-00'),
(110, '96029987', 0, '2022-02-09', '0000-00-00'),
(111, '95875457', 1, '2022-02-09', '0000-00-00'),
(112, '96721767', 1, '2022-02-09', '0000-00-00'),
(113, '92879780', 1, '2022-02-09', '0000-00-00'),
(114, '99956405', 1, '2022-02-10', '0000-00-00'),
(115, '96961654', 1, '2022-02-10', '0000-00-00'),
(116, '93973530', 1, '2022-02-10', '0000-00-00'),
(117, '92503375', 1, '2022-02-10', '0000-00-00'),
(118, '99133151', 1, '2022-02-10', '0000-00-00'),
(119, '98352151', 1, '2022-02-10', '0000-00-00'),
(120, '91747946', 1, '2022-02-10', '0000-00-00'),
(121, '97683855', 1, '2022-02-10', '0000-00-00'),
(122, '93005825', 1, '2022-02-10', '0000-00-00'),
(123, '94130741', 1, '2022-02-10', '0000-00-00'),
(124, '96232089', 1, '2022-02-10', '0000-00-00'),
(125, '99080158', 1, '2022-02-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Админ'),
(2, 'Библиотекарь'),
(3, 'Читатель');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `FIO` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `FIO`, `address`, `image`, `phone`, `role`) VALUES
(160, '95038215', '65606ea73034e7d74bf99534904254b5', 'zxc', 'zxc', '', 0, 1),
(167, '95875457', '5daa0ea859b548a08309826d46d3571e', 'Гуляшов Виктор Витальевич', 'Москва, ул Пушкина, дом Пушкина', '', 2147483647, 2),
(175, '91747946', '3789ddfc97d0b2b5bfc784fc60c37131', 'Сашов Саша Сашович', 'zxc', '', 0, 3),
(176, '97683855', '7a270961995f9ce2cffd22a0573caa1f', 'Петров Петя Петелии', 'asd', '', 0, 3),
(177, '99080158', '134892db21b93f21c8c43769c8752f4b', 'Павелов Павел Павлович', 'ячс', '', 0, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FIO` (`FIO`);

--
-- Индексы таблицы `author_books`
--
ALTER TABLE `author_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Индексы таблицы `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id_2` (`book_id`);

--
-- Индексы таблицы `library_cards`
--
ALTER TABLE `library_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `library_card_id` (`library_card_id`),
  ADD KEY `library_card_id_2` (`library_card_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `login_2` (`login`),
  ADD UNIQUE KEY `login_3` (`login`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `author_books`
--
ALTER TABLE `author_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT для таблицы `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `library_cards`
--
ALTER TABLE `library_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `author_books`
--
ALTER TABLE `author_books`
  ADD CONSTRAINT `author_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `author_books_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `issued_books`
--
ALTER TABLE `issued_books`
  ADD CONSTRAINT `issued_books_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issued_books_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`login`) REFERENCES `library_cards` (`library_card_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
