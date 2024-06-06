CREATE DATABASE IF NOT EXISTS phptest;
USE phptest;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS jouets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix FLOAT NOT NULL,
    quantite_stock INT NOT NULL,
    image_url VARCHAR(255)
);

INSERT INTO users (username, password, admin) VALUES
('admin', '$2y$10$tXO8o96L./7xKmdJ7ODlnuZRlb/2FmR/EVP/C4a0Qkyw3I6gT380i', 1);

INSERT INTO jouets (nom, description, prix, quantite_stock, image_url) VALUES
('Jouet 1', 'Description du jouet 1', 19.99, 50, 'image1.jpg'),
('Jouet 2', 'Description du jouet 2', 29.99, 30, 'image2.jpg'),
('Jouet 3', 'Description du jouet 3', 39.99, 20, 'image3.jpg');
