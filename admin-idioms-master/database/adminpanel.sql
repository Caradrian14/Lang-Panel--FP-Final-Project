-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2023 a las 10:41:25
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adminpanel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `tag` varchar(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lang`
--

INSERT INTO `lang` (`id`, `name`, `tag`, `created_at`, `last_updated`) VALUES
(3, 'Castellano', 'es', '2023-03-08 16:11:37', '2023-03-08 16:11:37'),
(4, 'English', 'en', '2023-03-09 08:14:52', '2023-03-09 08:14:52'),
(5, 'Catalan', 'ca', '2023-03-10 08:35:23', '2023-03-10 08:35:23'),
(6, 'Frances', 'fr', '2023-03-10 08:35:23', '2023-03-10 08:35:23'),
(7, 'Germano', 'de', '2023-03-10 08:36:19', '2023-03-10 08:36:19'),
(20, 'Esperanto', 'eo', '2023-03-28 09:42:42', '2023-03-28 09:42:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lang_text`
--

CREATE TABLE `lang_text` (
  `id` int(11) NOT NULL,
  `textId` varchar(60) NOT NULL,
  `langTag` varchar(6) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lang_text`
--

INSERT INTO `lang_text` (`id`, `textId`, `langTag`, `body`) VALUES
(82, 'Testeo-27-3', 'es', 'probemos castellano'),
(83, 'Testeo-27-3', 'en', 'probamos en ingles'),
(84, 'Testeo-27-3', 'ca', 'catalaa1'),
(85, 'Testeo-27-3', 'fr', 'gsgsg'),
(86, 'Testeo-27-3', 'de', 'Aleman'),
(88, 'Titulo', 'es', 'Titulo'),
(89, 'Titulo', 'en', 'Title'),
(90, 'Titulo', 'ca', 'Titol'),
(91, 'Titulo', 'fr', 'Titulo en frances'),
(92, 'Titulo', 'de', 'lo que sea en aleman'),
(94, 'searcher_nav', 'es', 'Buscador'),
(95, 'searcher_nav', 'en', 'Searcher'),
(96, 'searcher_nav', 'ca', 'Buscador'),
(97, 'searcher_nav', 'fr', ''),
(98, 'searcher_nav', 'de', 'q'),
(128, 'miau', 'es', 'castellanoooo'),
(129, 'miau', 'en', ''),
(130, 'miau', 'ca', ''),
(131, 'miau', 'fr', ''),
(132, 'miau', 'de', 'rgrgr'),
(142, 'Yoshi island', 'es', 'yoshi'),
(143, 'Yoshi island', 'en', 'yoshi'),
(144, 'Yoshi island', 'ca', 'yoshi'),
(145, 'Yoshi island', 'fr', ''),
(146, 'Yoshi island', 'de', 'aleman'),
(241, 'Footer', 'es', 'afasdasd'),
(242, 'Footer', 'en', 'asdasdas'),
(243, 'Footer', 'ca', ''),
(244, 'Footer', 'fr', ''),
(245, 'Footer', 'de', ''),
(246, 'Footer', 'eo', 'adsaasd'),
(247, 'tag nuevo', 'es', ''),
(248, 'tag nuevo', 'en', ''),
(249, 'tag nuevo', 'ca', ''),
(250, 'tag nuevo', 'fr', ''),
(251, 'tag nuevo', 'de', ''),
(252, 'tag nuevo', 'eo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `namr` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `namr`) VALUES
(1, 'client'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texts`
--

CREATE TABLE `texts` (
  `id` int(11) NOT NULL,
  `tag` varchar(60) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `texts`
--

INSERT INTO `texts` (`id`, `tag`, `active`, `created_at`, `last_updated`) VALUES
(51, 'Testeo-27-3', 1, '2023-03-24 09:45:18', '2023-03-24 09:45:18'),
(52, 'Titulo', 1, '2023-03-24 10:46:45', '2023-03-24 10:46:45'),
(53, 'searcher_nav', 1, '2023-03-24 10:54:21', '2023-03-24 10:54:21'),
(55, 'miau', 1, '2023-03-24 12:22:13', '2023-03-24 12:22:13'),
(56, 'Yoshi island', 1, '2023-03-24 12:22:23', '2023-03-24 12:22:23'),
(63, 'Footer', 1, '2023-03-28 09:49:03', '2023-03-28 09:49:03'),
(64, 'tag nuevo', 0, '2023-03-28 10:24:05', '2023-03-28 10:24:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `name`, `email`, `password`, `rol`, `created_at`, `last_updated`) VALUES
(1, 'test', '1', 'test@test.com', '$2y$10$w2/dduN5ZfgZAjKQn5.SaOMi1bjDSUrOa76byjiwIxlbqyPIw4eKq', 1, '2023-03-02 11:47:02', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag` (`tag`);

--
-- Indices de la tabla `lang_text`
--
ALTER TABLE `lang_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_relation` (`langTag`),
  ADD KEY `text_relation` (`textId`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`,`tag`),
  ADD KEY `tag` (`tag`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`rol`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `lang_text`
--
ALTER TABLE `lang_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lang_text`
--
ALTER TABLE `lang_text`
  ADD CONSTRAINT `lang_relation` FOREIGN KEY (`langTag`) REFERENCES `lang` (`tag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `text_relation` FOREIGN KEY (`textId`) REFERENCES `texts` (`tag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
