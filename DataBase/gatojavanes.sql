-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2022 at 06:35 PM
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
  `premium` int(1) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articulo`
--

INSERT INTO `articulo` (`idArticulo`, `image`, `idHilo`, `cuerpo`, `pie`, `cabecera`, `idUsuario`, `premium`, `estado`) VALUES
(1, 'images/img3.jpg', 2, 'En estos casos debes lavar a tu minino con agua tibia y un poco de champú para gatos. Asimismo, debes asegurarte de que la temperatura del ambiente esté templada para que no pase frío. También deberías tener una toalla preparada para secarlo. Es fundamental que seas muy cuidadoso, ya que muchos gatos temen al agua.<br>', 'En estos casos debes lavar a tu minino con agua tibia y un poco de champú para gatos. Asimismo, debes asegurarte de que la temperatura del ambiente es<br>', 'Duchar a tu gato', 2, 0, 'null'),
(3, 'images/ducha.jpg', 2, 'Ante la pregunta de cuánta agua debe beber un gato, hay que tener en cuenta que, cualquier gato, para mantenerse bien hidratado, necesita ingerir una media diaria de 50 a 100 mililitros de agua por kg de peso. Este límite conviene verse sobrepasado si tu gato está muy expuesto a altas temperaturas y/o se ejercita en exceso durante el periodo estival.<br>El problema es que algunos gatos muestran poca predisposición al contacto con el agua, y que su temperamento sibarita los condiciona a ser muy exigentes ante los condicionantes a la hora de ingerirla. Si éste es tu caso, te recomendamos que sigas los siguientes consejos sobre cómo hidratar a un gato para asegurar que tu gato bebe la cantidad de agua que requiere su cuerpo para mantenerse hidratado durante todo el verano.', 'Por eso recomendamos que ubiques varios bebedores en distintos lugares de tu casa. Su extremo sentido de la limpieza, puede hacer que se niegue a bebe<br>', 'Raciaonar la comida', 2, 0, 'Null'),
(10, 'images/descargar.jpg', 14, 'Busca un lugar tranquilo. Una de las cosas más importantes a la hora de saber dónde poner el arenero para tu gato es encontrar un sitio apartado del ajetreo de ...<br>', 'Intenta colocar el arenero en un sitio higiénico. Debes mantener tanto la arena como el entorno limpio, de lo contrario tampoco querrá usar esa bandej<br>', 'Donde ponerselo', 2, NULL, NULL),
(11, 'images/th.jpg', 15, 'Un gato adulto normal y sano puede pasar unas 16 horas dedicado al sueño. Podemos encontrarlo durmiendo en cualquier lugar de la casa, preferiblemente al sol o, en su ausencia, en un lugar cálido o escondido, en función de su personalidad. Por eso, a simple vista, parece importante que disponga de un lugar confortable en el que dormir.<br>', 'Un gato adulto normal y sano puede pasar unas 16 horas dedicado al sueño. <br>', 'Donde duermen', 2, NULL, NULL),
(12, 'images/OIP.jpg', 1, 'Cómo cuidar el pelaje de un gato: acostumbrarlo al cepillado. Por desgracia, no todos los gatos valoran que queramos ayudarlos con el cuidado del pelo.Cómo cuidar el pelaje de un gato: acostumbrarlo al cepillado. Por desgracia, no todos los gatos valoran que queramos ayudarlos con el cuidado del pelo.Cómo cuidar el pelaje de un gato: acostumbrarlo al cepillado. Por desgracia, no todos los gatos valoran que queramos ayudarlos con el cuidado del pelo.Cómo cuidar el pelaje de un gato: acostumbrarlo al cepillado. Por desgracia, no todos los gatos valoran que queramos ayudarlos con el cuidado del pelo.<br>Cómo cuidar el pelaje de un gato: acostumbrarlo al cepillado. Por desgracia, no todos los gatos valoran que queramos ayudarlos con el cuidado del pelo.', 'Cómo cuidar el pelaje de un gato: acostumbrarlo al cepillado. Por desgracia, no todos los gatos valoran que queramos ayudarlos con el cuidado del pelo<br>', 'Cómo cuidar el pelaje', 2, NULL, NULL);

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
(57, 2, 0, '2022-05-06 14:35:12', '25dsdsd', 1),
(58, 8, 0, '2022-05-07 08:46:01', 'Hola', 1),
(59, 8, 0, '2022-05-08 09:40:17', 'Cuanto cuesta la suscripcion?', 1),
(60, 33, 0, '2022-05-11 13:18:30', 'sasd', 3),
(62, 8, 0, '2022-05-12 09:50:12', 'dddddd', 3);

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
(1, 2, 'images/img1.jpg', 'Pelaje', 'Aprende todo sobre el pelaje de tu gato y mantenerlo perfecto<br>Lo mejor en elGatoJavaness<br>'),
(2, 2, 'images/img2.jpg', 'Agua', 'Cuando, donde ponele el agua...'),
(13, 2, 'images/img3.jpg', 'Comedero', 'Crea rutinas para el habito de comer y mucho más'),
(14, 2, 'images/img4.jpg', 'Arenero', 'Crea rutinas para el habito de comer y mucho más'),
(15, 2, 'images/img5.jpg', 'Descanso', 'Aprende todo sobre el descanso de tu gato');

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
(1, 'nombre', 'fasi', 'Elleon', 'Fasi@123', 'dni', 'direccion', 'comunidad', 'provincia', 'cp', 'usuario', 'sasa@gmail.com', '777777777', '2022-03-02 02:08:16', '2022-05-12 10:37:00', 0),
(2, '', 'asdf fadfa asfsf', 'elgatillo', 'Fasi@123', '20481132X', 'dasde', 'Baleares', 'Baleares', '07015', 'adminnistrador', 'EFESFSDFE@UYIBHEFC.ES', '654456456', NULL, '2022-05-12 15:21:00', 0),
(4, 'nombre', 'dddddddddddddddddd', 'gatoJava', 'Fasi@123', '50458796W', 'direccion', 'Asturias', 'Asturia', '0', 'usuario', 'fasi@gmail.com', '654646', NULL, '2023-01-26 17:07:00', 0),
(6, 'Abraham', 'Mohamed', 'Fasilo', 'Fasi@123', '20481144X', 'C/ Castellon de la plana', 'Cantabria', 'Cantabria', '39004', 'usuario', 'fasi@gmail.com', '654654654', '2022-07-14 19:12:16', NULL, 0),
(8, 'Lucia', 'Reyes', 'bugato', 'Sasi@123', '20481145X', 'C/ Castellon de la plana', 'Baleares', 'Baleares', '07007', 'usuario', 'Lucia@gmail.com', '666666666', NULL, NULL, 0),
(10, 'Hasan', 'El Fahsi', 'gatuso', 'Gatuso1@', '20481147X', 'C/ Castellon de la plana', 'andalucia', 'almería', '04000', 'usuario', 'Hasan@gmail.com', '654987987', NULL, NULL, 0),
(11, '', '', 'dasdew', '', '', '', 'Baleares', 'Baleares', '07011', 'usuario', '', '', NULL, NULL, 0),
(20, 'asdsf', 'ededw', 'elLion', 'Sasi@123', '20481143B', 'C/ Castellon de la plana', 'andalucia', 'Granada', '18015', 'usuario', 'dsasdffrr@gmail.com', '', NULL, NULL, 0),
(28, 'Hamed', 'asdasd', 'sdfsfsf', 'Fasi123@', '20481181A', 'C/ CANTABRIA', 'Baleares', 'Baleares', '07013', 'usuario', 'asdasd@asd.vfd', '654654666', NULL, NULL, 0),
(33, 'Fasi', 'asds', 'gatoLoco', 'Fasila@12', '20481142X', 'adsdasds', 'Baleares', 'Baleares', '07013', 'usuario', 'abrahamelfahsi@gmail.com', '654789321', NULL, NULL, 0),
(34, 'Dasd', 'asdsds', 'dasdsad', 'Sasi123@', '28063017G', 'cadssac', 'Aragon', 'Teruel', '44002', 'usuario', 'abrahamelfahsi@gmail.com', '666666666', NULL, NULL, NULL);

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
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `hilo`
--
ALTER TABLE `hilo`
  MODIFY `idHilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
