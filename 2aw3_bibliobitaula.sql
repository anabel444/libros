-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2018 a las 12:05:40
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `2aw3_bibliobitaula`
--
CREATE DATABASE IF NOT EXISTS `2aw3_bibliobitaula` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `2aw3_bibliobitaula`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `spAllBooks`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAllBooks` ()  NO SQL
BEGIN
SELECT libros.id,libros.titulo,libros.autor,libros.numPag,libros.idEditorial FROM LIBROS,editorial
where libros.idEditorial=editorial.idEditorial;
END$$

DROP PROCEDURE IF EXISTS `spAllEditorial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAllEditorial` ()  NO SQL
BEGIN
SELECT * FROM editorial;
END$$

DROP PROCEDURE IF EXISTS `spFindIdEditorial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spFindIdEditorial` (IN `id` INT)  NO SQL
BEGIN
SELECT * FROM editorial WHERE editorial.idEditorial=id;
END$$

DROP PROCEDURE IF EXISTS `spInsertLibro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertLibro` (IN `titulo` VARCHAR(50), IN `autor` VARCHAR(50), IN `numPag` INT, IN `idEditorial` INT)  NO SQL
BEGIN
INSERT INTO libros(libros.titulo,libros.autor,libros.numPag,libros.idEditorial)
VALUES (titulo,autor,numPag);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

DROP TABLE IF EXISTS `editorial`;
CREATE TABLE `editorial` (
  `idEditorial` int(11) NOT NULL,
  `nombreEditorial` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`idEditorial`, `nombreEditorial`, `ciudad`) VALUES
(1, 'Planeta', 'Madrid'),
(2, 'Espasa', 'Madrid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE `libros` (
  `id` int(2) NOT NULL,
  `titulo` varchar(27) DEFAULT NULL,
  `autor` varchar(24) DEFAULT NULL,
  `numPag` int(4) DEFAULT NULL,
  `idEditorial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `numPag`, `idEditorial`) VALUES
(3, 'VIDAS MAGICAS E INQUISICION', 'JULIO CARO BAROJA', 850, 1),
(5, 'MUSEO DEL PRADO', 'SANTIAGO ALCOLEA BLANS', 464, 1),
(6, 'EL OPALO NEGRO', 'VICTORIA HOLT', 384, 1),
(7, 'POESIA Y OTROS TEXTOS', 'SAN JUAN DE LA CRUZ', 304, 1),
(8, 'EL JUEGO DE HERRALL', 'STEPHEN KING', 400, 1),
(10, 'EL SEÑOR DE LOS ANILLOS', 'J.R. TOLKIEN', 1104, 1),
(12, 'IT', 'STEPHEN KING', 1000, 2),
(15, 'COMO SI FUERA DIOS', 'ROBIN COOK', 456, 2),
(16, 'TEMINAL', 'ROBIN COOK', 370, 2),
(17, 'OCEANO', 'ALBERTO VAZQUEZ FIGUEROA', 250, 2),
(18, 'LA IGUANA', 'ALBERTO VAZQUEZ FIGUEROA', 290, 2),
(19, 'YALZA', 'ALBERTO VAZQUEZ FIGUEROA', 350, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`idEditorial`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEditorial` (`idEditorial`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `idEditorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`idEditorial`) REFERENCES `editorial` (`idEditorial`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
