-- Reinicio de tablas

DROP TABLE IF EXISTS asistentes CASCADE;
DROP TABLE IF EXISTS plantadas CASCADE;
DROP TABLE IF EXISTS eventos CASCADE;
DROP TABLE IF EXISTS usuarios CASCADE;
DROP TABLE IF EXISTS especies CASCADE;

CREATE TABLE usuarios (
nick VARCHAR(50) PRIMARY KEY,
nombre VARCHAR(25),
apellidos VARCHAR(50),
correo VARCHAR(255),
karma INT DEFAULT 0,
suscritoNewsletter BOOLEAN DEFAULT FALSE
);

CREATE TABLE eventos (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(25),
ubicacion VARCHAR(25),
tipo_terreno VARCHAR(25),
fecha DATE,
tipo_evento VARCHAR(25),
anfitrion VARCHAR(50),
imagen VARCHAR(255),
CONSTRAINT fk_eventos_anfitrion
    FOREIGN KEY (anfitrion) REFERENCES usuarios (nick)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE especies(
nombre VARCHAR(50) PRIMARY KEY, -- Nombre cientifico, nunca se repite
clima VARCHAR(25),
region VARCHAR(25),
tiempo_crecimiento VARCHAR(25),
beneficios VARCHAR(25),
imagen VARCHAR(255),
enlace_wikipedia VARCHAR(255)
);

CREATE TABLE asistentes(
nick VARCHAR(50),
evento INT,
CONSTRAINT pk_asistentes
	PRIMARY KEY (nick, evento),
CONSTRAINT fk_asistentes_usuario
    FOREIGN KEY (nick) REFERENCES usuarios (nick)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
CONSTRAINT fk_asistentes_evento
    FOREIGN KEY (evento) REFERENCES eventos (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE plantadas(
especie VARCHAR(50),
evento INT,
cantidad INT,
CONSTRAINT pk_plantadas
	PRIMARY KEY (especie, evento),
CONSTRAINT fk_plantadas_especie
    FOREIGN KEY (especie) REFERENCES especies (nombre)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
CONSTRAINT fk_plantadas_evento
    FOREIGN KEY (evento) REFERENCES eventos (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
