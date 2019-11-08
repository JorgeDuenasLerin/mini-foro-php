/*

Base de datos de foro

Por Jorge Dueñás Lerín

*/

DROP TABLE IF EXISTS Respuesta;
DROP TABLE IF EXISTS Tema;

CREATE TABLE Tema (
  id MEDIUMINT NOT NULL AUTO_INCREMENT,
  titulo    varchar(120) NOT NULL ,
  nombre    varchar(20)  NOT NULL,
  pass      varchar(20) NOT NULL,
  etiqueta  varchar(20) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);


DROP TABLE IF EXISTS Respuesta;
CREATE TABLE Respuesta (
  id MEDIUMINT NOT NULL AUTO_INCREMENT,
  titulo    varchar(120) NOT NULL ,
  contenido varchar(1024)  NOT NULL,
  nombre    varchar(20) NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  id_tema MEDIUMINT NOT NULL,
  FOREIGN KEY (id_tema) REFERENCES Tema(id)
);

INSERT INTO Tema (id, titulo, nombre, pass, etiqueta)
 VALUES
  (1, 'DWES mola', 'jorge', '1234', 'Cosas ciertas'),
  (2, 'Sugerencias en Mini foro', 'pepe', '1234', 'Administración')
;

INSERT INTO Respuesta (id, id_tema, titulo, nombre, contenido)
 VALUES
  (1, 1, 'Cierto', 'pepe', 'Tienes razón'),
  (2, 1, 'Cierto', 'almudena', 'Yo también lo creo'),
  (3, 1, 'Nop', 'Iniaki', 'Y una kk'),
  (4, 2, 'Algo', 'nombre1', 'Cosa, cosa'),
  (5, 2, 'Algo', 'nombre2', 'Asd, Dsf, Cosa, cosa'),
  (6, 2, 'Algo', 'nombre3', 'Cosa, cosa, JKU, LOP')
;
