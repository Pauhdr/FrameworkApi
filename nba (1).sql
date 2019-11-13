-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2019 a las 13:13:40
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `codigo` int(8) NOT NULL,
  `comment` mediumtext COLLATE utf8_spanish_ci NOT NULL,
  `codigoUsuario` int(8) NOT NULL,
  `codigoJugador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`codigo`, `comment`, `codigoUsuario`, `codigoJugador`) VALUES
(1, 'zdthzh', 3, 61),
(2, 'papapapapapa', 6, 62),
(3, 'sghrthartrhhh', 6, 62),
(4, 'adhtfxgckhljkÃ±okjh', 6, 62),
(5, 'ikujytgad', 6, 62),
(6, 'rgagagg', 6, 61);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int(8) NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `avatar` varchar(75) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `usuario`, `password`, `avatar`) VALUES
(1, 'aaa', '123', ''),
(2, 'pepe', '$2y$10$/8MR84dxN/UneQe.qYKxuuudvgwRAKNUFro.9zKUDynBDz6y2WCqi', ''),
(3, 'jose', '$2y$10$cyimieCDn5.mLyPjIG0teexcsWWRtElV3G/v8nMkUO7x25DD.0zhC', ''),
(4, 'marta', '$2y$10$6FvBa.02Zea4ssLWYS4aCuEy4QEGSSK/E8kdtH6X8o5QNSSv0VBsa', 'avatar0.jpg'),
(6, 'josefa', '$2y$10$NxKHMMjxwLwSdp5QKzUFNeSkJFr1jw/llpDHIGTN4.h61x22j7AnG', 'avatar0.jpg'),
(9, 'mar', '$2y$10$07/G9y3tDj/rpgln158D/uCq55cz7cCmpRmRmO9mxbxWNKwVEszeG', ''),
(12, 'dd', '$2y$10$Rty65qBwDrAyLjRmKWXekuzAjOWfZAIb4HekH8VqAPOaPuA2Nog4G', ''),
(15, 'q', '$2y$10$utba.yLsExtdOzSA3AeIceKjs1erG5nmh.hPSzZUv8G7ZQblmBLSu', ''),
(17, 'w', '$2y$10$OfM3RtF4HRCXd73NhWlr8OtrLUQjK9WV7.3Egq4SrCXL4SVYIK9am', ''),
(20, 'sfs', '$2y$10$t9qb6ffvkMmdRvVL3KsP.ex3WiQsObMaJw7D6uqarLCL.aXh4XytS', 'tienda.jpg'),
(25, 'qq', '$2y$10$EeU/s5hTCNqQsnng2Wx0weLSaDywTxjLBmPkNtOa.ztkz9bqfq8iS', 'tienda.jpg'),
(26, 'mmmm', '$2y$10$j4vtxdgBfD5EOXL4eK1kl.KcGPUuUmpQ3i3c5f68jkNMu/CE..vz2', 'camisa.jpg'),
(27, 'asd', '$2y$10$QSPOs.zfWqh7DQMt8ZH8V.ggh3S9lTl9KmmZOCW3XoY3AOTDUoc8u', 'camisa.jpg'),
(28, 'rew', '$2y$10$Flx/mHWRJto5ApV1xN7SW.LvbVueMRnkSOSDtOIB/AJ2TaYO1ry.K', 'avatar28.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `nombre` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `codigo` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
