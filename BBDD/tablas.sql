



CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    admin INT DEFAULT 0,
    partidasJugadas INT DEFAULT 0,
    partidasGanadas INT DEFAULT 0
);

CREATE TABLE partida (
    idPartida INT AUTO_INCREMENT PRIMARY KEY,
    idPersona INT NOT NULL,
    tablaOculta VARCHAR(255),
    tablaJugador VARCHAR(255),
    finalizada BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (idPersona) REFERENCES persona(idUsuario)
);

