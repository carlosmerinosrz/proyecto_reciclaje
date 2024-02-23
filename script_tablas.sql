-- Crear tabla administrados
-- esta parte aun 
CREATE TABLE administradores (
    id_admin TINYINT PRIMARY KEY AUTOINCREMENT,
    usuario VARCHAR(80) NOT NULL,
    nombre VARCHAR(80) NOT NULL,
    contrasenia VARCHAR(255) NOT NULL --la encriptaremos con HASH
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Crear tabla contenedores
CREATE TABLE contenedores (
    id_contenedor TINYINT PRIMARY KEY AUTOINCREMENT,
    nombre VARCHAR(80) NOT NULL,
    img LONGTEXT NOT NULL,
    descripcion VARCHAR(255) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Crear tabla basura
CREATE TABLE basura (
    id_basura INT PRIMARY KEY AUTOINCREMENT,
    nombre VARCHAR(80) NOT NULL,
    descripcion VARCHAR(255) NULL,
    id_contenedor  TINYINT NULL,
    FOREIGN KEY (id_contenedor) REFERENCES contenedores (id_contenedor) ON DELETE SET NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;