CREATE DATABASE IF NOT EXISTS maison_rose CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE maison_rose;
CREATE TABLE IF NOT EXISTS products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 category VARCHAR(50) NOT NULL,
 description TEXT NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 color VARCHAR(20) NOT NULL,
 symbol VARCHAR(10) NOT NULL
);
CREATE TABLE IF NOT EXISTS orders (
 id INT AUTO_INCREMENT PRIMARY KEY,
 customer_name VARCHAR(100) NOT NULL,
 customer_email VARCHAR(190) NOT NULL,
 total DECIMAL(10,2) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS order_items (
 id INT AUTO_INCREMENT PRIMARY KEY,
 order_id INT NOT NULL,
 product_id INT NOT NULL,
 quantity INT NOT NULL,
 unit_price DECIMAL(10,2) NOT NULL,
 FOREIGN KEY (order_id) REFERENCES orders(id),
 FOREIGN KEY (product_id) REFERENCES products(id)
);
INSERT INTO products (name,category,description,price,color,symbol) VALUES
('Sac Élise','Sacs','Un sac élégant et pratique pour tous les jours.',39.90,'rose','👜'),
('Pull Camille','Vêtements','Un pull doux et confortable, parfait pour l’automne.',34.90,'cream','🧥'),
('Lunettes Alba','Accessoires','Des lunettes de soleil au style intemporel.',24.90,'sage','🕶️'),
('Robe Juliette','Vêtements','Une robe légère et féminine pour les beaux jours.',49.90,'lilac','👗'),
('Baskets Léa','Chaussures','Des baskets simples et confortables.',59.90,'peach','👟'),
('Chapeau Nina','Accessoires','Un chapeau chic pour compléter votre tenue.',19.90,'blue','👒');
