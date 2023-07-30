-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2023 a las 20:51:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prevesuy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anios`
--

CREATE TABLE `anios` (
  `id` int(11) NOT NULL,
  `año` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anios`
--

INSERT INTO `anios` (`id`, `año`) VALUES
(1, '2023'),
(2, '2005'),
(3, '2011'),
(4, '2007'),
(5, '2008');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`) VALUES
(1, 'ARTIGAS'),
(17, 'CANELONES'),
(6, 'CERRO LARGO'),
(15, 'COLONIA'),
(8, 'DURAZNO'),
(11, 'FLORES'),
(12, 'FLORIDA'),
(13, 'LAVALLEJA'),
(18, 'MALDONADO'),
(19, 'MONTEVIDEO'),
(4, 'PAYSANDU'),
(7, 'RÍO NEGRO'),
(3, 'RIVERA'),
(14, 'ROCHA'),
(2, 'SALTO'),
(16, 'SAN JOSE'),
(10, 'SORIANO'),
(5, 'TACUAREMBÓ'),
(9, 'TREINTA Y TRES'),
(20, 'URUGUAY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `enlace` text DEFAULT NULL,
  `Fijado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `imagen`, `descripcion`, `enlace`, `Fijado`) VALUES
(1, 'Uruguay, ante el desafío de frenar los suicidios', 'Uruguay, ante el desafío de frenar los suicidios0507231688583571.png', 'El país sudamericano registra una de las tasas más altas de este flagelo en las Américas, con una tendencia al alza desde hace 20 años. Una campaña promueve la salud psicoemocional de los adolescentes', 'https://elpais.com/planeta-futuro/2022-09-10/uruguay-ante-el-desafio-de-frenar-los-suicidios.html', 1),
(3, 'Suicidios en Uruguay: un tema que preocupa y duele', 'U3VpY2lkaW9zIGVuIFVydWd1YXk6IHVuIHRlbWEgcXVlIHByZW9jdXBhIHkgZHVlbGUwNTA3MjMxNjg4NTg0Njk0.png', 'Según datos preliminares del Ministerio de Salud Pública (MSP) en Uruguay se quitaron la vida 818 personas en 2022. La mayoría eran hombres y la tendencia es al alza, de forma sostenida, desde 2017.', 'https://icm.org.uy/suicidios-en-uruguay-un-tema-que-preocupa-y-duele/', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabias_que`
--

CREATE TABLE `sabias_que` (
  `id` int(11) NOT NULL,
  `sabiasque` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sabias_que`
--

INSERT INTO `sabias_que` (`id`, `sabiasque`) VALUES
(1, 'Sabias que en nuestro país el año pasado se suicidaron 758\r\npersonas?'),
(2, '¿Sabías que muchos de ellos eran de edad que van desde los 13 a los 18 años?'),
(3, 'Sabes que en este año los pronósticos dicen que va en\r\naumento?'),
(4, 'La mayoría de estos jóvenes estaban deprimidos y\r\nprobablemente no lo sabían. ¿Sabías que la depresión es una enfermedad que le puede tocar a cualquiera de nosotros? ¿Sabes que tiene cura?\r\n'),
(5, 'La mayoría de los jóvenes que intentaron suicidarse o se\r\nsuicidaron no habían pedido ayuda previamente.\r\n'),
(6, '¿Sabes que, si pides ayuda, se reducen notoriamente las posibilidades de llegar a intentar o quitarte la vida?'),
(7, 'Sabias que, de cada 4 suicidas, ¿3 son hombres y 1 es mujer?'),
(8, '¿Sabías que tener problemas con el alcohol y las drogas aumenta el riesgo suicida?'),
(9, '¿Sabías que si tienes antecedentes de Suicidio en tu familia aumenta el riesgo de tener conductas suicidas? Sabias que estar en una situación de pérdida, de duelo aumenta la probabilidad de conductas\r\nsuicidas?\r\n'),
(10, '¿Sabías que puedes tener conductas suicidas sin darte cuenta? Cómo por ejemplo cuando te expones a conductas de mucho riesgo.'),
(11, 'Sabias que los momentos de cambios en la vida, pueden generar trastornos depresivos. Cómo la adolescencia, la crisis de la mitad de la vida y la vejez.'),
(12, '¿Sabías que el suicidio no tiene nada que ver con la cobardía y la valentía? Es un problema de Salud Mental.'),
(13, '¿Hay un mito que dice que aquel que se quiere o dice que se va a matar no lo hace, sabes que no es real? La inmensa mayoría de los que se suicidaron algún mensaje dejaron. Debemos estar atentos.'),
(14, '¿Sabes que portar un arma de fuego aumenta el riesgo suicida?'),
(15, 'Sabes que todos podemos estar\r\natentos y cuidarnos para que podamos reducir este número tan grande y triste de suicidios.\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_departamento`
--

CREATE TABLE `s_departamento` (
  `id` int(11) NOT NULL,
  `departamento` int(11) NOT NULL,
  `hombres` double NOT NULL,
  `mujeres` double NOT NULL,
  `menosDeCatorce` double NOT NULL,
  `entreQuinceYTreinta` double NOT NULL,
  `entreTreintaYUnoYSesenta` double NOT NULL,
  `entreSesentaYUnoYOchenta` double NOT NULL,
  `entreOchentaYUnoYNoventa` double NOT NULL,
  `superiorANoventa` double NOT NULL,
  `total` int(11) NOT NULL,
  `anios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `s_departamento`
--

INSERT INTO `s_departamento` (`id`, `departamento`, `hombres`, `mujeres`, `menosDeCatorce`, `entreQuinceYTreinta`, `entreTreintaYUnoYSesenta`, `entreSesentaYUnoYOchenta`, `entreOchentaYUnoYNoventa`, `superiorANoventa`, `total`, `anios`) VALUES
(1, 19, 342, 342, 324, 342, 432, 342, 342, 342, 442, 1),
(2, 18, 34, 2, 432, 342, 324, 324, 432, 432, 342, 1),
(3, 17, 342, 324, 432, 342, 342, 342, 432, 432, 342, 1),
(4, 16, 2, 432, 342, 342, 342, 342, 34, 234, 34, 1),
(5, 15, 432, 342, 342, 432, 342, 432, 342, 324, 2, 1),
(6, 14, 432, 4, 32, 342, 342, 423, 43, 342, 432, 1),
(7, 13, 432, 432, 43, 2, 3434, 2, 342, 43, 432, 1),
(8, 12, 342, 342, 432, 43, 2, 432, 342, 432, 342, 1),
(9, 11, 43, 24, 3, 432, 43, 342, 432, 32, 432, 1),
(10, 10, 32, 342, 342, 432, 342, 432, 43, 2, 4, 1),
(11, 9, 432, 432, 432, 43, 2, 43, 23, 324, 34, 1),
(12, 8, 32, 432, 342, 432, 4, 32, 432, 342, 4, 1),
(13, 7, 432, 432, 342, 342, 432, 324, 432, 432, 432, 1),
(14, 6, 2, 432, 342, 432, 432, 342, 43, 2, 43, 1),
(15, 5, 432, 342, 342, 342, 432, 43, 234, 2, 432, 1),
(16, 4, 432, 234, 432, 432, 432, 432, 324, 3, 432, 1),
(17, 3, 4, 432, 34, 324, 43, 2, 432, 432, 23, 1),
(18, 2, 43, 324, 43, 234, 342, 432, 342, 342, 342, 1),
(19, 1, 34, 2, 342, 43, 342, 43, 432, 234, 432, 1),
(21, 20, 63.4, 73.3, 0, 73.4, 63.4, 73.3, 23.4, 27.3, 84, 1),
(22, 20, 21, 43, 35, 23, 64, 12, 57, 34, 54, 2),
(23, 19, 5, 4, 8, 6, 67, 23, 57, 25, 15, 2),
(24, 18, 53, 86, 75, 56, 53, 17, 42, 56, 76, 2),
(25, 17, 43, 52, 98, 59, 10, 3, 45, 7, 24, 2),
(26, 16, 46, 26, 73, 28, 37, 53, 34, 36, 13, 2),
(27, 15, 23, 65, 32, 64, 64, 72, 38, 42, 86, 2),
(28, 14, 34, 64, 23, 65, 73, 47, 26, 34, 36, 2),
(29, 13, 75, 29, 28, 25, 82, 73, 63, 27, 65, 2),
(30, 12, 13, 36, 85, 3, 4, 56, 42, 53, 23, 2),
(31, 11, 63, 12, 43, 52, 36, 42, 63, 63, 94, 2),
(32, 10, 4, 2, 53, 25, 12, 64, 23, 64, 84, 2),
(33, 9, 32, 54, 65, 56, 54, 75, 75, 43, 76, 2),
(34, 8, 62, 53, 35, 21, 64, 23, 541, 532, 19, 2),
(35, 7, 564, 321, 64, 74, 32, 98, 65, 34, 74, 2),
(36, 6, 57, 32, 75, 43, 75, 32, 60, 21, 52, 2),
(37, 5, 45, 32, 64, 27, 53, 63, 36, 32, 97, 2),
(38, 4, 32, 67, 23, 632, 53, 32, 643, 64, 73, 2),
(39, 3, 2, 44, 32, 64, 236, 32, 63, 62, 43, 2),
(40, 2, 526, 325, 23, 53, 23, 45, 21, 53, 19, 2),
(41, 1, 54, 23, 64, 23, 64, 236, 32, 544, 85, 2),
(42, 20, 21, 43, 35, 23, 64, 12, 57, 34, 52, 3),
(43, 19, 5, 4, 8, 6, 67, 23, 57, 25, 15, 3),
(44, 18, 53, 86, 75, 56, 53, 17, 42, 56, 76, 3),
(45, 17, 43, 52, 98, 59, 10, 3, 45, 7, 24, 3),
(46, 16, 46, 26, 73, 28, 37, 53, 34, 36, 13, 3),
(47, 15, 23, 65, 32, 64, 64, 72, 38, 42, 86, 3),
(48, 14, 34, 64, 23, 65, 73, 47, 26, 34, 36, 3),
(49, 13, 75, 29, 28, 25, 82, 73, 63, 27, 65, 3),
(50, 12, 13, 36, 85, 3, 4, 56, 42, 53, 23, 3),
(51, 11, 63, 12, 43, 52, 36, 42, 63, 63, 94, 3),
(52, 10, 4, 2, 53, 25, 12, 64, 23, 64, 84, 3),
(53, 9, 32, 54, 65, 56, 54, 75, 75, 43, 76, 3),
(54, 8, 62, 53, 35, 21, 64, 23, 541, 532, 19, 3),
(55, 7, 564, 321, 64, 74, 32, 98, 65, 34, 74, 3),
(56, 6, 57, 32, 75, 43, 75, 32, 60, 21, 52, 3),
(57, 5, 45, 32, 64, 27, 53, 63, 36, 32, 97, 3),
(58, 4, 32, 67, 23, 632, 53, 32, 643, 64, 73, 3),
(59, 3, 2, 44, 32, 64, 236, 32, 63, 62, 43, 3),
(60, 2, 526, 325, 23, 53, 23, 45, 21, 53, 19, 3),
(61, 1, 54, 23, 64, 23, 64, 236, 32, 544, 85, 3),
(62, 20, 2, 62, 125, 123, 63, 125, 132, 13, 3, 4),
(63, 19, 32, 74, 25, 74, 73, 26, 48, 12, 64, 4),
(64, 18, 43, 75, 17, 43, 62, 16, 36, 32, 57, 4),
(65, 17, 45, 25, 85, 21, 64, 23, 67, 53, 86, 4),
(66, 16, 23, 64, 42, 3, 25, 61, 64, 23, 26, 4),
(67, 15, 26, 754, 34, 54, 642, 36, 24, 64, 64, 4),
(68, 14, 64, 14, 64, 28, 43, 23, 75, 26, 23, 4),
(69, 13, 23, 64, 26, 42, 64, 26, 43, 74, 43, 4),
(70, 12, 53, 82, 53, 27, 34, 752, 642, 67, 2, 4),
(71, 11, 64, 36, 45, 18, 35, 64, 26, 32, 42, 4),
(72, 10, 26, 35, 62, 75, 84, 23, 56, 32, 64, 4),
(73, 9, 23, 64, 64, 24, 54, 26, 27, 43, 64, 4),
(74, 8, 75, 48, 4, 26, 64, 28, 42, 75, 73, 4),
(75, 7, 46, 26, 46, 2, 46, 42, 75, 21, 73, 4),
(76, 6, 12, 86, 32, 57, 86, 23, 86, 23, 86, 4),
(77, 5, 23, 57, 43, 65, 23, 75, 34, 87, 86, 4),
(78, 4, 13, 57, 863, 75, 38, 52, 86, 24, 97, 4),
(79, 3, 34, 74, 24, 65, 86, 24, 86, 24, 68, 4),
(80, 2, 76, 24, 75, 23, 85, 86, 34, 23, 75, 4),
(81, 1, 23, 75, 42, 75, 243, 75, 43, 75, 75, 4),
(82, 20, 64, 14, 54, 12, 63, 74, 12, 86, 23, 5),
(83, 19, 86, 12, 86, 2, 6, 8, 65, 23, 16, 5),
(84, 18, 12, 86, 212, 754, 75, 23, 86, 21, 65, 5),
(85, 17, 236, 42, 642, 46, 86, 23, 57, 23, 64, 5),
(86, 16, 23, 75, 23, 64, 75, 23, 86, 97, 75, 5),
(87, 15, 54, 64, 86, 23, 57, 85, 43, 75, 23, 5),
(88, 14, 23, 57, 23, 64, 75, 23, 57, 43, 86, 5),
(89, 13, 23, 57, 86, 34, 57, 86, 23, 86, 75, 5),
(90, 12, 57, 23, 23, 43, 54, 12, 5, 12, 545, 5),
(91, 11, 3, 56, 41, 53, 12, 46, 5, 36, 53, 5),
(92, 10, 64, 64, 23, 64, 13, 32, 65, 86, 21, 5),
(93, 9, 75, 223, 64, 21, 53, 63, 23, 45, 23, 5),
(94, 8, 12, 46, 75, 12, 75, 12, 35, 37, 64, 5),
(95, 7, 64, 12, 35, 13, 54, 1, 34, 54, 52, 5),
(96, 6, 12, 54, 36, 34, 65, 23, 54, 64, 64, 5),
(97, 5, 53, 43, 75, 68, 12, 46, 76, 864, 75, 5),
(98, 4, 23, 57, 23, 75, 85, 45, 23, 46, 54, 5),
(99, 3, 32, 64, 46, 75, 347, 234, 653, 573, 24, 5),
(100, 2, 754, 32, 64, 23, 75, 23, 64, 23, 752, 5),
(101, 1, 23, 42, 64, 23, 64, 23, 6, 23, 65, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testdebienestar`
--

CREATE TABLE `testdebienestar` (
  `id` int(11) NOT NULL,
  `pregunta` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `opcion_1` varchar(255) NOT NULL,
  `opcion_2` varchar(255) NOT NULL,
  `opcion_3` varchar(255) DEFAULT NULL,
  `opcion_4` varchar(255) DEFAULT NULL,
  `respuesta_1` int(11) NOT NULL,
  `respuesta_2` int(11) NOT NULL,
  `respuesta_3` int(11) DEFAULT NULL,
  `respuesta_4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id` int(11) NOT NULL,
  `Historia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id`, `Historia`) VALUES
(1, 'un día una chica de un grupo de amigos estaban tranquilamente en el recreo del colegio, un día un chico apareció y pidió unirse al grupo, que es amigo de uno de los integrantes, el grupo lo acepto y todo aparentaba ir bien. Un día como cualquiera la chica fue temprano al colegio y esperando al grupo de amigos el primero que llega es el nuevo, el chico se acercó a ella y empezó a confesarse que le gustaba, la chica sin indirectas le dijo que no estaba interesada, al principio parecía que se lo tomo a bien pero cuando era hora de salida, el chico nuevo del grupo empezó a seguirla en el camino a casa, eso paso por varios días. La chica hablo un día sobre este chico con su grupo de amigos del comportamiento extraño que posee este, el grupo entendió y alejo al chico del grupo. Pero esta fue la gota que colmo el vaso, el chico se mudó al mismo apartamento que la chica y no la dejaba ir ni irse del colegio, la chica estaba siendo acosada por este tipo y sintió una profunda depresión, no podía vivir en paz sin que el chico estuviera tras ella y como eran jóvenes menores de edad no podrían ir a prisión por lo tal una denuncia solo complicaría las cosas. La chica fue al psicólogo y le pidió ayuda de como tratar con este chico. El psicólogo reconoció el chico del que ella le hablaba y le contó que justo también es su paciente y tiene el numero de los padres. Hablo con los padres del chico sobre el tema. Los padres del chico lo cambiaron de colegio y apartamento y le citaron más días diarios para el psicólogo para que cambie esa actitud. Al final la chica y el grupo quedo como antes y volvieron a ser felices como antes… ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anios`
--
ALTER TABLE `anios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sabias_que`
--
ALTER TABLE `sabias_que`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `s_departamento`
--
ALTER TABLE `s_departamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Departamento` (`departamento`),
  ADD KEY `FK_Año` (`anios`);

--
-- Indices de la tabla `testdebienestar`
--
ALTER TABLE `testdebienestar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anios`
--
ALTER TABLE `anios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sabias_que`
--
ALTER TABLE `sabias_que`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `s_departamento`
--
ALTER TABLE `s_departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `testdebienestar`
--
ALTER TABLE `testdebienestar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `s_departamento`
--
ALTER TABLE `s_departamento`
  ADD CONSTRAINT `FK_Año` FOREIGN KEY (`anios`) REFERENCES `anios` (`id`),
  ADD CONSTRAINT `FK_Departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
