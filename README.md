# Maison Rose 🌸 — Boutique de mode (PHP POO)

Boutique e-commerce de démonstration en **PHP 8+ orienté objet**, **MariaDB**, **HTML**, **CSS** et **JavaScript**.

## Fonctionnalités
- Page d'accueil éditoriale responsive
- Catalogue de vêtements et accessoires avec recherche, catégories et tri par prix
- Photos de mode réelles hébergées sur Unsplash (illustratives, non contractuelles, nécessitent Internet)
- Favoris dans le navigateur (`localStorage`)
- Fiches produits, panier PHP en session, modification des quantités
- Simulation de commande enregistrée en base (aucun paiement réel)
- Animations CSS et affichage adapté aux mobiles

## Installation (Linux Penguin)
```bash
sudo apt install php php-mysql mariadb-server
sudo service mariadb start
sudo mariadb < database/schema.sql
cd maison-rose-v2
DB_USER=maisonrose DB_PASSWORD='votre_mot_de_passe' php -S localhost:8000 -t public
```

Si tu n'as pas encore créé l'utilisateur MariaDB, utilise :
```sql
CREATE USER IF NOT EXISTS 'maisonrose'@'localhost' IDENTIFIED BY 'votre_mot_de_passe';
GRANT ALL PRIVILEGES ON maison_rose.* TO 'maisonrose'@'localhost';
```
L'import SQL doit se faire **depuis le dossier du projet** (par exemple `sudo mariadb < database/schema.sql`). Si la base est déjà importée, inutile de la réimporter : la V2 utilise les mêmes tables.

Ouvrir **http://localhost:8000**. La configuration peut être passée avec `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`. Ne jamais publier ses vrais identifiants.

## Structure
- `app/` : classes PHP POO `Database`, `Product`, `Cart`, `Order`
- `views/` : carte produit réutilisable
- `public/` : site et ressources CSS/JS
- `database/schema.sql` : base et produits de démonstration

## Note sur les images
Les images sont des **photographies de mode illustratives provenant d'Unsplash**. Elles ne représentent pas nécessairement les produits fictifs affichés. Elles sont chargées depuis Internet et ne sont pas incluses dans le ZIP. Pour une vraie boutique, utiliser des photos autorisées et correspondant exactement aux articles vendus.

Projet étudiant, aucune transaction ni livraison réelle.


## Ajouter 40 produits (V3)

La V3 ajoute 10 nouveaux produits dans chacune des quatre catégories (40 au total), en conservant les six produits de la V1. Exécutez depuis le dossier du projet :

```bash
mariadb -u maisonrose -p maison_rose < database/add_products.sql
```

Le script peut être réexécuté sans dupliquer les nouveaux produits. Les photographies Unsplash sont illustratives et nécessitent Internet ; vérifier les droits d'utilisation et remplacer les photos par des visuels produits autorisés pour un véritable commerce.
