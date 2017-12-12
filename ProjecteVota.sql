-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 11-12-2017 a les 20:30:04
-- Versió del servidor: 5.7.20-0ubuntu0.16.04.1
-- Versió de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `ProjecteVota`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `consulta`
--

CREATE TABLE `consulta` (
  `id_consulta` int(4) NOT NULL,
  `pregunta` text NOT NULL,
  `id_usuario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `consulta`
--

INSERT INTO `consulta` (`id_consulta`, `pregunta`, `id_usuario`) VALUES
(1, 'Chocolate negro o blanco?', 1),
(2, 'Gimnasio o Workout?', 1),
(3, 'Cocacola o fanta?', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `invitaciones`
--

CREATE TABLE `invitaciones` (
  `id_usuario` int(11) NOT NULL,
  `id_consulta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `opciones`
--

CREATE TABLE `opciones` (
  `id_opciones` int(4) NOT NULL,
  `descripcionOpciones` varchar(30) NOT NULL,
  `id_consulta` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `opciones`
--

INSERT INTO `opciones` (`id_opciones`, `descripcionOpciones`, `id_consulta`) VALUES
(1, 'Negro', 1),
(2, 'Blanco', 1),
(3, 'Gimnasio', 2),
(4, 'Workout', 2),
(5, 'fanta', 3),
(6, 'cocacola', 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(4) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `token` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `password`, `email`, `Admin`, `token`) VALUES
(1, 'Admin', 'Torres', '1234', 'polperez@gmail.com', 1, ''),
(2, 'genis', 'torres', '1234', 'genis@gmail.com', 0, ''),
(3, NULL, NULL, 'wioehifbi3g2324', 'genistorres97@gmail.com', 0, 'wioehifbi3g2324'),
(4, NULL, NULL, '', 'genis', 0, 'obf');

-- --------------------------------------------------------

--
-- Estructura de la taula `votos`
--

CREATE TABLE `votos` (
  `id_voto` int(4) NOT NULL,
  `id_opciones` int(4) NOT NULL,
  `id_usuario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `votos`
--

INSERT INTO `votos` (`id_voto`, `id_opciones`, `id_usuario`) VALUES
(3, 2, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 3, 1),
(8, 3, 1);

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Index de la taula `invitaciones`
--
ALTER TABLE `invitaciones`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `id_usuario_2` (`id_usuario`);

--
-- Index de la taula `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id_opciones`),
  ADD KEY `id_opciones` (`id_opciones`),
  ADD KEY `id_consulta` (`id_consulta`);

--
-- Index de la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Index de la taula `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_voto` (`id_voto`),
  ADD KEY `id_opciones` (`id_opciones`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la taula `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id_opciones` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la taula `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la taula `votos`
--
ALTER TABLE `votos`
  MODIFY `id_voto` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restriccions per la taula `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `consulta` (`id_consulta`);

--
-- Restriccions per la taula `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`id_opciones`) REFERENCES `opciones` (`id_opciones`),
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
