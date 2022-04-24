-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2022 at 04:50 PM
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
(1, 'images/descarga.jpg', 2, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaahhhhh</p><p></p>', 'pie', 'cabecera', 2, b'0', 'null'),
(2, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2, b'0', 'eliminado'),
(3, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2, b'0', 'eliminado'),
(4, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2, b'1', NULL),
(5, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2, b'1', NULL);

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
(54, 1, 0, '2022-04-23 17:54:49', 'Hola chavales iwa', 1);

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
(1, 1, 'images/1images (2).jpg', 'Pelaje', '<p>bbbbbbbbbbbb</p><p>fffffffffffffffffasasas</p><p></p>'),
(2, 1, 'images/2images (3).jpg', 'Pelaje', '<p>bbbbbbbbbbbb</p><p>fffffffffffffffffasasas</p><p></p>'),
(7, 2, 'images/6images.jpg', 'cssssssss', '<p>sssssssssssss</p><p>aaaaaaaaaaaa</p>');

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
  `dni` varchar(9) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `comunidad` varchar(30) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `Rol` varchar(15) DEFAULT NULL,
  `gmail` varchar(50) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `fechaSuscripcion` datetime DEFAULT NULL,
  `banner` datetime DEFAULT NULL,
  `perBanned` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidos`, `usuario`, `pass`, `dni`, `direccion`, `comunidad`, `provincia`, `cp`, `Rol`, `gmail`, `telefono`, `fechaSuscripcion`, `banner`, `perBanned`) VALUES
(1, 'nombre', 'apellidos', 'Elleon', 'aaaaaaaa', 'dni', 'direccion', 'comunidad', 'provincia', 'cp', 'usuario', 'sasa@gmail.com', '777777777', '2022-06-29 02:08:16', '2022-06-29 02:08:16', NULL),
(2, '', 'asdf fadfa asfsf', 'elgatillo', 'Fasi123@', '20481142X', 'dasde', 'Baleares', 'Baleares', '07015', 'adminnistrador', 'EFESFSDFE@UYIBHEFC.ES', '654456456', '2022-09-14 10:24:32', '2022-06-29 02:08:16', b'0'),
(4, 'nombre', 'apellidos', 'gatillo', 'aaaaaaaa', 'dni', 'direccion', 'comunidad', 'provincia', 'cp', 'usuario', 'sasa@gmail.com', '777777777', NULL, NULL, NULL),
(6, 'Abraham', 'Mohamed', 'Fasilo', 'Pasi123@', '20481142X', 'C/ Castellon de la plana', 'Cantabria', 'Cantabria', '39004', 'administrador', 'fasi@gmail.com', '654654654', NULL, NULL, NULL),
(8, 'Lucia', 'Reyes', 'bugato', 'Sasi@123', '20481142X', 'C/ Castellon de la plana', 'andalucia', 'Huelva', '21003', 'usuario', 'Lucia@gmail.com', '666666666', NULL, NULL, NULL),
(10, 'Hasan', 'El Fahsi', 'gatuso', 'Gatuso1@', '20481142X', 'C/ Castellon de la plana', 'andalucia', 'almería', '04000', 'usuario', 'Hasan@gmail.com', '654987987', NULL, '2022-04-29 20:51:00', b'0');

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
  ADD PRIMARY KEY (`idUsuario`);

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
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `hilo`
--
ALTER TABLE `hilo`
  MODIFY `idHilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
