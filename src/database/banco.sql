-- Criar o banco de dados 
CREATE DATABASE inova_campus
    ENCODING 'UTF8'
    LC_COLLATE 'pt_BR.utf8'
    LC_CTYPE 'pt_BR.utf8'
    TEMPLATE template0;

-- Usar o banco de dados 
\c inova_campus;

-- Criar tabela de usuários
CREATE TABLE inv_users (
    usr_id SERIAL PRIMARY KEY,
    usr_name VARCHAR(100) NOT NULL,
    usr_email VARCHAR(255) NOT NULL,
    usr_password VARCHAR(255) NOT NULL,
    usr_phone VARCHAR(15) NOT NULL,
    usr_img VARCHAR(255) NOT NULL
);

-- Criar tabela de produtos
CREATE TABLE inv_products (
    pdt_id SERIAL PRIMARY KEY,
    pdt_name VARCHAR(255) NOT NULL,
    pdt_unit_price DECIMAL(10,2) NOT NULL, 
    pdt_units INT,
    pdt_img VARCHAR(255) NOT NULL,
    pdt_user INT NOT NULL,
    CONSTRAINT fk_products_users FOREIGN KEY (pdt_user) REFERENCES inv_users(usr_id) ON DELETE CASCADE
);


