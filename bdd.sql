-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS proyecto2024;

-- Usar la base de datos creada
USE proyecto2024;

-- Creación de la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    nombre_completo VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    numero_telefono VARCHAR(20) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Creación de la tabla de administradores
CREATE TABLE IF NOT EXISTS administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    nombre_completo VARCHAR(255) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Creación de la tabla de preguntas
CREATE TABLE IF NOT EXISTS preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    ciudad TEXT NOT NULL,
    texto_pregunta TEXT NOT NULL,
    estado ENUM('pendiente', 'respondida') DEFAULT 'pendiente',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Creación de la tabla de respuestas
CREATE TABLE IF NOT EXISTS respuestas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pregunta INT NOT NULL,
    id_administrador INT NOT NULL,
    texto_respuesta TEXT NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pregunta) REFERENCES preguntas(id),
    FOREIGN KEY (id_administrador) REFERENCES administradores(id)
);

-- Creación de la tabla de categorías de preguntas
CREATE TABLE IF NOT EXISTS categorias_preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Creación de la tabla de relación entre preguntas y categorías
CREATE TABLE IF NOT EXISTS relacion_pregunta_categoria (
    id_pregunta INT NOT NULL,
    id_categoria INT NOT NULL,
    PRIMARY KEY (id_pregunta, id_categoria),
    FOREIGN KEY (id_pregunta) REFERENCES preguntas(id),
    FOREIGN KEY (id_categoria) REFERENCES categorias_preguntas(id)
);


-- Insertar las categorías
INSERT INTO categorias_preguntas (nombre_categoria) VALUES
('Alumbrado'),
('Arbolado'),
('Plantacion'),
('Acoso sexual'),
('Limpieza de grafittis'),
('Estado de los contenedores'),
('Problema de limpieza'),
('Solicitud de retiro de poda, escombros o residuos'),
('Saneamiento: Bocas de tormenta'),
('Saneamiento: Conexiones y Colectores'),
('Tránsito: Semáforos'),
('Tránsito: Señalización'),
('Quejas'),
('Consultas: Trámite'),
('Consultas: Tributo'),
('Consultas: Otro');

-- Crear un administrador principal
INSERT INTO administradores (nombre_usuario, correo_electronico, contrasena, nombre_completo)
VALUES ('admin', 'admin@example.com', 'admin', 'Administrador');



-- Ejemplos de preguntas:
-- ¿Cuándo se realizarán reparaciones en las luminarias dañadas de mi calle?
-- Reporté una lámpara rota hace dos meses y todavía no la han arreglado. ¿Qué tan difícil es hacer mantenimiento?
