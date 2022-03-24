-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2022 at 01:14 PM
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
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articulo`
--

INSERT INTO `articulo` (`idArticulo`, `image`, `idHilo`, `cuerpo`, `pie`, `cabecera`, `idUsuario`) VALUES
(1, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2),
(2, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2),
(3, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2),
(4, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2),
(5, 'images/descarga.jpg', 1, '<p>Lo mejor en cuanto a cuidados de tu gato , en este peour e ehfbr </p><p>aaa aaaaaaaaa aaaaaa aaaaaa aaaaa</p>', 'pie', 'cabecera', 2);

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
  `fechaSuscripcion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidos`, `usuario`, `pass`, `dni`, `direccion`, `comunidad`, `provincia`, `cp`, `Rol`, `gmail`, `telefono`, `fechaSuscripcion`) VALUES
(1, 'nombre', 'apellidos', 'Elleon', 'aaaaaaaa', 'dni', 'direccion', 'comunidad', 'provincia', 'cp', 'usuario', 'sasa@gmail.com', '777777777', NULL),
(2, '', 'asdf fadfa asfsf', 'elgatillo', 'Fasi123@', '20481142X', 'dasde', 'Baleares', 'Baleares', '07015', 'administrador', 'EFESFSDFE@UYIBHEFC.ES', '654456456', '2022-09-14 10:24:32'),
(4, 'nombre', 'apellidos', 'gatillo', 'aaaaaaaa', 'dni', 'direccion', 'comunidad', 'provincia', 'cp', 'usuario', 'sasa@gmail.com', '777777777', NULL),
(5, 'Mohamed', 'Mohamed', 'Fasias', 'eLFAZZIO123@', '20481142x', 'C/ Castellon de la plana', 'Cantabria', 'Cantabria', '39009', 'usuario', 'fasi@gmail.com', '666666666', NULL),
(6, 'Abraham', 'Mohamed', 'Fasilo', 'Pasi123@', '20481142X', 'C/ Castellon de la plana', 'Cantabria', 'Cantabria', '39004', 'adminnistrador', 'fasi@gmail.com', '654654654', NULL),
(8, 'Lucia', 'Reyes', 'bugato', 'Sasi@123', '20481142X', 'C/ Castellon de la plana', 'andalucia', 'Huelva', '21003', 'usuario', 'Lucia@gmail.com', '666666666', NULL),
(10, 'Hasan', 'El Fahsi', 'gatuso', 'Gatuso1@', '20481142X', 'C/ Castellon de la plana', 'andalucia', 'almería', '04000', 'usuario', 'Hasan@gmail.com', '654987987', NULL);

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
-- Constraints for table `hilo`
--
ALTER TABLE `hilo`
  ADD CONSTRAINT `hilo_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
