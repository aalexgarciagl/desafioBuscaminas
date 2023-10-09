



CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    esAdmin INT DEFAULT 0,
    partidasJugadas INT DEFAULT 0,
    partidasGanadas INT DEFAULT 0
);

CREATE TABLE partida (
    idPartida INT AUTO_INCREMENT PRIMARY KEY,
    idPersona INT NOT NULL,
    tablaOculta VARCHAR(255),
    tablaJugador VARCHAR(255),
    finalizada INT DEFAULT 0  
);


insert into usuarios (idUsuario,nombre,correo,pass,esAdmin,partidasJugadas,partidasGanadas) VALUES 
(DEFAULT,"Alejandro","alejandro","1234",1,DEFAULT,DEFAULT); 