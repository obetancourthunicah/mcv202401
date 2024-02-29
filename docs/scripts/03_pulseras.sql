CREATE TABLE pulseras(  
    sku varchar(32) NOT NULL PRIMARY KEY,
    nombre varchar(128) NOT NULL,
    precio DECIMAL(13,2) NOT NULL DEFAULT 0,
    colorDominante varchar(32) NOT NULL DEFAULT 'blanco'
) COMMENT 'Tabla de Pulseras';