DROP DATABASE IF EXISTS db_videogames;

CREATE DATABASE db_videogames DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- servidor 2
CREATE TABLE USUARIO
(ID INT(3) AUTO_INCREMENT,
USUARIO VARCHAR(10) NOT NULL,
PASSWORD VARCHAR(10) NOT NULL,
FECHA_REGISTRO DATE NOT NULL,
PRIMARY KEY (ID));

-- Servidor 1 principal
CREATE TABLE `USUARIO` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(10) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  `FECHA_REGISTRO` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=FEDERATED DEFAULT CHARSET=latin1 CONNECTION='mysql://root@db2/db_videogames/USUARIO';

CREATE TABLE COMPRA
(ID INT(2) AUTO_INCREMENT,
ID_USUARIO INT(3) NOT NULL,
ID_JUEGO INT(3) NOT NULL,
NOMBRE VARCHAR(100) NOT NULL,
DESCRIPCION VARCHAR(500) NOT NULL,
VALOR INT(5) NOT NULL,
PRIMARY KEY (ID),
FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID));


/*DATOS*/

INSERT INTO `usuario` (`USUARIO`, `PASSWORD`, `FECHA_REGISTRO`) VALUES 
('Jeniffer', '12456', '2022-03-14'); 
('2', 'Gissela', '845632', '2022-02-18'),
('3', 'asdfgh', 'rtyu45', '2022-01-21'),
('4', 'zxcvb', '34567ghjk', '2021-12-10'),
('5', 'tyuio', 'ghj515', '2022-03-06');


INSERT INTO `juego` (`ID`, `NOMBRE`, `DESCRIPCION`, `VALOR`) VALUES 
('102', 'CALL OF DUTTY', 'Juego de acci�n', '50000'), 
('202', 'MARIO BROS', 'Juego de aventura', '40000'),
('301', 'ARMY OF TWO', 'Juego de acci�n', '80000'),
('400', 'FIFA', 'Juego de deportes', '90000'),
('552', 'LOL', 'Juego de roles', '85000');


INSERT INTO `usuario_juego` (`ID`, `ID_USUARIO`, `ID_JUEGO`) VALUES 
('1', '1', '102'), 
('2', '2', '202'),
('3', '3', '301'),
('4', '4', '400'),
('5', '5', '552');


CREATE TABLE login
(ID INT(3) AUTO_INCREMENT,
usuario VARCHAR(10) NOT NULL,
password VARCHAR(10) NOT NULL, 
FECHA_REGISTRO DATE NOT NULL,
PRIMARY KEY (ID));

INSERT INTO `login` (`usuario`, `password`, `FECHA_REGISTRO`) VALUES 
('Jeniffer', '12456', '2022-03-14');


CREATE TABLE `USUARIO_BLACKLIST` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(10) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
);

CREATE EVENT PurgeBlackListTable
ON SCHEDULE EVERY 30 SECOND
DO
BEGIN
DELETE FROM `USUARIO_BLACKLIST` WHERE TIME_TO_SEC(TIMEDIFF(NOW(),`FECHA_REGISTRO`)) >= 30;
END

SET GLOBAL event_scheduler = ON;