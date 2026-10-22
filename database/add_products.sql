-- Ajout non destructif de 40 produits.
USE maison_rose;
INSERT INTO products (name, category, description, price, color, symbol)
SELECT seed.name, seed.category, seed.description, seed.price, seed.color, seed.symbol
FROM (
SELECT 'Blazer Sofia' AS name, 'Vêtements' AS category, 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.' AS description, 79.90 AS price, 'rose' AS color, '👗' AS symbol
UNION ALL
SELECT 'Chemise Iris', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 39.90, 'rose', '👗'
UNION ALL
SELECT 'Jean Clara', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 54.90, 'rose', '👗'
UNION ALL
SELECT 'Cardigan Emma', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 44.90, 'rose', '👗'
UNION ALL
SELECT 'Jupe Louise', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 35.90, 'rose', '👗'
UNION ALL
SELECT 'Trench Adèle', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 99.90, 'rose', '👗'
UNION ALL
SELECT 'Top Mila', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 24.90, 'rose', '👗'
UNION ALL
SELECT 'Robe Chloé', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 64.90, 'rose', '👗'
UNION ALL
SELECT 'Pull Olivia', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 46.90, 'rose', '👗'
UNION ALL
SELECT 'Pantalon Alice', 'Vêtements', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 49.90, 'rose', '👗'
UNION ALL
SELECT 'Sac Luna', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 59.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Jade', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 45.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Romy', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 69.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Noémie', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 39.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Inès', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 49.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Zoé', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 55.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Alba', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 62.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Nina', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 34.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Louise', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 72.90, 'rose', '👜'
UNION ALL
SELECT 'Sac Camille', 'Sacs', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 42.90, 'rose', '👜'
UNION ALL
SELECT 'Baskets Nova', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 69.90, 'rose', '👟'
UNION ALL
SELECT 'Bottines Iris', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 89.90, 'rose', '👟'
UNION ALL
SELECT 'Mocassins Jade', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 65.90, 'rose', '👟'
UNION ALL
SELECT 'Sandales Mila', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 39.90, 'rose', '👟'
UNION ALL
SELECT 'Escarpins Rose', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 79.90, 'rose', '👟'
UNION ALL
SELECT 'Ballerines Emma', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 44.90, 'rose', '👟'
UNION ALL
SELECT 'Baskets Léonie', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 64.90, 'rose', '👟'
UNION ALL
SELECT 'Bottes Clara', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 99.90, 'rose', '👟'
UNION ALL
SELECT 'Sandales Chloé', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 49.90, 'rose', '👟'
UNION ALL
SELECT 'Mocassins Alice', 'Chaussures', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 59.90, 'rose', '👟'
UNION ALL
SELECT 'Collier Luna', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 24.90, 'rose', '✨'
UNION ALL
SELECT 'Boucles Étoile', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 19.90, 'rose', '✨'
UNION ALL
SELECT 'Ceinture Jade', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 29.90, 'rose', '✨'
UNION ALL
SELECT 'Foulard Iris', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 22.90, 'rose', '✨'
UNION ALL
SELECT 'Lunettes Romy', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 34.90, 'rose', '✨'
UNION ALL
SELECT 'Bracelet Emma', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 18.90, 'rose', '✨'
UNION ALL
SELECT 'Chapeau Alba', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 29.90, 'rose', '✨'
UNION ALL
SELECT 'Montre Sofia', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 59.90, 'rose', '✨'
UNION ALL
SELECT 'Pince Chloé', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 12.90, 'rose', '✨'
UNION ALL
SELECT 'Écharpe Louise', 'Accessoires', 'Une pièce tendance de la collection Maison Rose, sélectionnée pour compléter votre style.', 27.90, 'rose', '✨'
) AS seed
WHERE NOT EXISTS (SELECT 1 FROM products p WHERE p.name = seed.name AND p.category = seed.category);
