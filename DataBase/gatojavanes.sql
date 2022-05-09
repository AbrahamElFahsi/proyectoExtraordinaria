-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2022 at 05:54 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gatojavanes`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulo`
--

CREATE TABLE `articulo` (
  `idArticulo` int(11) NOT NULL,
  `image` varchar(40) DEFAULT NULL,
  `idHilo` int(11) NOT NULL,
  `cuerpo` longtext,
  `pie` longtext,
  `cabecera` varchar(200) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `premium` bit(1) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articulo`
--

INSERT INTO `articulo` (`idArticulo`, `image`, `idHilo`, `cuerpo`, `pie`, `cabecera`, `idUsuario`, `premium`, `estado`) VALUES
(1, 'images/descarga.jpg', 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaas sssssssssssss aaaaaaaaaaaa ssssss aa asss ssssss aaa ssssss aaaaaaaa ssssssss aaaaaaaaaaaa<br>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa<br>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '', 'Duchar a tu gato', 2, b'0', 'null'),
(2, 'images/descarga.jpg', 1, 'aaaaaaaaaaaaaaasassss<br>asasaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa<br>aaaaaaaaaaaaaa', '', 'Comedero de tu gato', 2, b'0', 'Null'),
(3, 'images/descarga.jpg', 7, '', '', 'Raciaonar la comida', 2, b'0', 'eliminado'),
(4, 'images/descarga.jpg', 1, '', '', 'cabecera', 2, b'1', 'Null'),
(5, 'images/descarga.jpg', 1, '', '', 'cabecera', 2, b'1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idRespuesta` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `contenido` varchar(180) DEFAULT NULL,
  `idArticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `idUsuario`, `idRespuesta`, `fecha`, `contenido`, `idArticulo`) VALUES
(48, 2, 0, '2022-04-16 15:34:17', 'Holaaaaaaaaa', 1),
(49, 4, 0, '2022-04-16 15:34:58', 'asasas', 3),
(50, 4, 0, '2022-04-16 15:35:01', 'asasasasa', 3),
(52, 10, 0, '2022-04-19 14:17:42', 'Hola, soy nuevo necesito ayuda con el pelaje de mi gato', 1),
(53, 10, 0, '2022-04-19 14:20:03', 'si alguien me responde', 1),
(54, 1, 0, '2022-04-23 17:54:49', 'Hola chavales iwa', 1),
(56, 2, 0, '2022-05-05 13:33:09', 'AAAAAAAAAAA', 4),
(57, 2, 0, '2022-05-06 14:35:12', '25dsdsd', 1),
(58, 8, 0, '2022-05-07 08:46:01', 'Hola', 1),
(59, 8, 0, '2022-05-08 09:40:17', 'Cuanto cuesta la suscripcion?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hilo`
--

CREATE TABLE `hilo` (
  `idHilo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `imagen` varchar(30) DEFAULT NULL,
  `tema` varchar(100) DEFAULT NULL,
  `descripcion` varchar(240) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hilo`
--

INSERT INTO `hilo` (`idHilo`, `idUsuario`, `imagen`, `tema`, `descripcion`) VALUES
(1, 1, 'images/1images (2).jpg', 'Pelaje', 'Aprende todo sobre el pelaje de tu gato y mantenerlo perfecto<br>Lo mejor en elGatoJavaness<br>'),
(2, 1, 'images/2images (3).jpg', 'Agua', ''),
(7, 2, 'images/6images.jpg', 'Comida', '');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `dni` varchar(9) NOT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `comunidad` varchar(30) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `Rol` varchar(15) DEFAULT NULL,
  `gmail` varchar(50) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `fechaSuscripcion` datetime DEFAULT NULL,
  `banner` datetime DEFAULT NULL,
  `perBanned` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidos`, `usuario`, `pass`, `dni`, `direccion`, `comunidad`, `provincia`, `cp`, `Rol`, `gmail`, `telefono`, `fechaSuscripcion`, `banner`, `perBanned`) VALUES
(1, 'nombre', 'fasi', 'Elleon', 'aaaaaaaa', 'dni', 'direccion', 'comunidad', 'provincia', 'cp', 'usuario', 'sasa@gmail.com', '777777777', '2022-06-29 02:08:16', NULL, 0),
(2, '', 'asdf fadfa asfsf', 'elgatillo', 'a', '20481132X', 'dasde', 'Baleares', 'Baleares', '07015', 'adminnistrador', 'EFESFSDFE@UYIBHEFC.ES', '654456456', '2022-07-06 13:05:59', '2022-05-07 18:01:31', 0),
(4, 'nombre', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 'ssssssssssssssssssssssssssssssssssssssss', 'Fasi123@123', '50458796W', 'direccion', 'Asturias', 'Asturia', '0', 'usuario', 'fasi@gmail.com', '654646', NULL, NULL, NULL),
(6, 'Abraham', 'Mohamed', 'Fasilo', 'Pasi123@', '20481144X', 'C/ Castellon de la plana', 'Cantabria', 'Cantabria', '39004', 'adminnistrador', 'fasi@gmail.com', '654654654', NULL, '2022-05-09 15:46:00', 0),
(8, 'Lucia', 'Reyes', 'bugato', 'Sasi@123', '20481145X', 'C/ Castellon de la plana', 'Baleares', 'Baleares', '07007', 'usuario', 'Lucia@gmail.com', '666666666', NULL, '2022-05-09 15:29:00', 0),
(10, 'Hasan', 'El Fahsi', 'gatuso', 'Gatuso1@', '20481147X', 'C/ Castellon de la plana', 'andalucia', 'almería', '04000', 'usuario', 'Hasan@gmail.com', '654987987', NULL, '2022-05-09 15:50:00', 0),
(11, '', '', 'dasdew', '', '', '', 'Baleares', 'Baleares', '07011', 'usuario', '', '', NULL, '2022-05-09 15:46:00', 0),
(20, 'asdsf', 'ededw', 'elLion', 'Sasi@123', '20481143B', 'C/ Castellon de la plana', 'andalucia', 'Granada', '18015', 'usuario', 'dsasdffrr@gmail.com', '', NULL, NULL, NULL),
(28, 'Hamed', 'asdasd', 'sdfsfsf', 'Fasi123@', '20481181A', 'C/ CANTABRIA', 'Baleares', 'Baleares', '07013', 'usuario', 'asdasd@asd.vfd', '654654666', NULL, NULL, NULL),
(33, 'Fasi', 'asds', 'gatoLoco', 'Sasi123@', '20481142X', 'adsdasds', 'Baleares', 'Baleares', '07013', 'usuario', 'abrahamelfahsi@gmail.com', '654789321', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idArticulo`),
  ADD KEY `idHilo` (`idHilo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idArticulo` (`idArticulo`);

--
-- Indexes for table `hilo`
--
ALTER TABLE `hilo`
  ADD PRIMARY KEY (`idHilo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `hilo`
--
ALTER TABLE `hilo`
  MODIFY `idHilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`idHilo`) REFERENCES `hilo` (`idHilo`),
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`idArticulo`);

--
-- Constraints for table `hilo`
--
ALTER TABLE `hilo`
  ADD CONSTRAINT `hilo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
