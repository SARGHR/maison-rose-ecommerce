<?php
session_start();
require_once __DIR__.'/../app/Database.php';
require_once __DIR__.'/../app/Product.php';
require_once __DIR__.'/../app/Cart.php';
require_once __DIR__.'/../app/Order.php';
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function productPhoto(array $p): string {
    $photos = [
      'Sac Élise' => 'photo-1548036328-c9fa89d128fa',
      'Pull Camille' => 'photo-1434389677669-e08b4cac3105',
      'Lunettes Alba' => 'photo-1511499767150-a48a237f0083',
      'Robe Juliette' => 'photo-1539008835657-9e8e9680c956',
      'Baskets Léa' => 'photo-1549298916-b41d501d3772',
      'Chapeau Nina' => 'photo-1521369909029-2afed882baee',
      'Blazer Sofia' => 'photo-1591047139829-d91aecb6caea',
      'Chemise Iris' => 'photo-1598554747436-c9293d6a588f',
      'Jean Clara' => 'photo-1542272604-787c3835535d',
      'Cardigan Emma' => 'photo-1576566588028-4147f3842f27',
      'Jupe Louise' => 'photo-1583496661160-fb5886a13d27',
      'Trench Adèle' => 'photo-1539533018447-63fcce2678e3',
      'Top Mila' => 'photo-1503342217505-b0a15ec3261c',
      'Robe Chloé' => 'photo-1515372039744-b8f02a3ae446',
      'Pull Olivia' => 'photo-1434389677669-e08b4cac3105',
      'Pantalon Alice' => 'photo-1594633312681-425c7b97ccd1',
      'Sac Luna' => 'photo-1584917865442-de89df76afd3',
      'Sac Jade' => 'photo-1547949003-9792a18a2601',
      'Sac Romy' => 'photo-1566150905458-1bf1fc113f0d',
      'Sac Noémie' => 'photo-1553062407-98eeb64c6a62',
      'Sac Inès' => 'photo-1548036328-c9fa89d128fa',
      'Sac Zoé' => 'photo-1584917865442-de89df76afd3',
      'Sac Alba' => 'photo-1566150905458-1bf1fc113f0d',
      'Sac Nina' => 'photo-1547949003-9792a18a2601',
      'Sac Louise' => 'photo-1553062407-98eeb64c6a62',
      'Sac Camille' => 'photo-1548036328-c9fa89d128fa',
      'Baskets Nova' => 'photo-1549298916-b41d501d3772',
      'Bottines Iris' => 'photo-1525966222134-fcfa99b8ae77',
      'Mocassins Jade' => 'photo-1543163521-1bf539c55dd2',
      'Sandales Mila' => 'photo-1515347619252-60a4bf4fff4f',
      'Escarpins Rose' => 'photo-1514989940723-e8e51635b782',
      'Ballerines Emma' => 'photo-1560343090-f0409e92791a',
      'Baskets Léonie' => 'photo-1600185365483-26d7a4cc7519',
      'Bottes Clara' => 'photo-1542291026-7eec264c27ff',
      'Sandales Chloé' => 'photo-1520639888713-7851133b1ed0',
      'Mocassins Alice' => 'photo-1460353581641-37baddab0fa2',
      'Collier Luna' => 'photo-1611652022419-a9419f74343d',
      'Boucles Étoile' => 'photo-1535632066927-ab7c9ab60908',
      'Ceinture Jade' => 'photo-1553062407-98eeb64c6a62',
      'Foulard Iris' => 'photo-1601924994987-69e26d50dc26',
      'Lunettes Romy' => 'photo-1511499767150-a48a237f0083',
      'Bracelet Emma' => 'photo-1573408301185-9146fe634ad0',
      'Chapeau Alba' => 'photo-1521369909029-2afed882baee',
      'Montre Sofia' => 'photo-1523275335684-37898b6baf30',
      'Pince Chloé' => 'photo-1596944924616-7b38e7cfac36',
      'Écharpe Louise' => 'photo-1601924994987-69e26d50dc26',
    ];
    $id = $photos[$p['name']] ?? 'photo-1483985988355-763728e1935b';
    return 'https://images.unsplash.com/'.$id.'?auto=format&fit=crop&w=900&q=85';
}
function money(float $n): string { return number_format($n,2,',',' ').' €'; }
if (!isset($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(16));
$error=''; $success='';
try { $db=Database::connect(); $products=new Product($db); $cart=new Cart(); }
catch (Throwable $ex) { http_response_code(500); exit('Connexion à la base impossible. Vérifie app/Database.php et importe database/schema.sql.'); }
$page=$_GET['page']??'home';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (!hash_equals($_SESSION['csrf'],$_POST['csrf']??'')) { http_response_code(403); exit('Formulaire invalide'); }
    $action=$_POST['action']??''; $id=filter_var($_POST['id']??null,FILTER_VALIDATE_INT);
    if ($action==='add' && $id && $products->find($id)) { $cart->add($id); header('Location: ?page=cart'); exit; }
    if ($action==='update' && $id) { $cart->update($id,max(0,(int)($_POST['quantity']??1))); header('Location: ?page=cart'); exit; }
    if ($action==='remove' && $id) { $cart->remove($id); header('Location: ?page=cart'); exit; }
    if ($action==='order') {
        $name=trim($_POST['name']??''); $email=trim($_POST['email']??'');
        if ($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL)) $error='Saisis un nom et une adresse e-mail valides.';
        elseif (!$cart->items($products)) $error='Ton panier est vide.';
        else { try { $number=(new Order($db))->create($name,$email,$cart->items($products)); $cart->clear(); header('Location: ?page=thanks&number='.$number); exit; } catch(Throwable $ex) { $error='Impossible d’enregistrer la commande.'; } }
        $page='checkout';
    }
}
$all=$products->all(); $items=$cart->items($products); $total=array_sum(array_column($items,'subtotal'));
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="#f8f3ef"><meta name="description" content="Maison Rose, boutique de mode et accessoires. Projet de démonstration PHP POO."><title>Maison Rose — Mode & accessoires</title><link rel="preconnect" href="https://images.unsplash.com"><link rel="stylesheet" href="assets/style.css" defer><script src="assets/shop.js" defer></script></head><body>
<div class="announcement">Livraison offerte dès 80 € · Boutique de démonstration — aucun paiement réel</div>
<header class="site-header"><a class="logo" href="?">maison<span>rose</span><small>MODE & ACCESSOIRES</small></a><nav class="nav" aria-label="Navigation principale"><a href="?">Accueil</a><a href="?page=catalog">La collection</a><a href="?page=catalog#collection">Nouveautés</a></nav><div class="header-actions"><button type="button" class="icon-button" id="favToggle" title="Afficher mes favoris" aria-label="Afficher mes favoris">♡ <span id="favCount">0</span></button><a class="bag" href="?page=cart" aria-label="Voir le panier">Panier <span><?= array_sum($_SESSION['cart'] ?? []) ?></span></a></div></header>
<main>
<?php if ($page==='home'): ?>
<section class="hero"><div class="hero-copy"><span class="eyebrow">NOUVELLE COLLECTION · ÉDITION 2026</span><h1>Le style se vit<br><em>en douceur.</em></h1><p>Des pièces intemporelles, des détails qui font la différence. Trouve tes nouveaux essentiels.</p><a class="btn dark" href="?page=catalog">Explorer la collection <span>↗</span></a><div class="hero-note">✦ Des pièces à aimer longtemps</div></div><div class="hero-photo" role="img" aria-label="Photographie de mode"><div class="hero-stamp">NEW<br>SEASON<br>✳</div></div></section>
<section class="benefits"><span>✦ Sélection tendance</span><span>♡ Style intemporel</span><span>✧ Inspiration quotidienne</span></section>
<section class="section-wrap"><div class="section-head"><div><span class="eyebrow">NOS FAVORIS</span><h2>La sélection du moment</h2></div><a class="text-link" href="?page=catalog">Voir toute la collection ↗</a></div><div class="product-grid"><?php foreach(array_slice($all,0,4) as $p): include __DIR__.'/../views/card.php'; endforeach; ?></div></section>
<section class="editorial"><div><span class="eyebrow">L'ART DES DÉTAILS</span><h2>Une touche de rose,<br>beaucoup de personnalité.</h2><p>Des accessoires et des essentiels pensés pour toutes tes envies.</p><a class="btn light" href="?page=catalog">Découvrir les pièces ↗</a></div></section>
<?php elseif ($page==='catalog'): ?>
<section class="catalog-heading" id="collection"><span class="eyebrow">MAISON ROSE / COLLECTION</span><h1>La collection</h1><p>Des essentiels choisis pour toi.</p></section>
<section class="section-wrap catalog-layout"><div class="catalog-toolbar"><div class="filters"><button class="filter active" data-filter="Tous">Tout voir</button><button class="filter" data-filter="Vêtements">Vêtements</button><button class="filter" data-filter="Sacs">Sacs</button><button class="filter" data-filter="Chaussures">Chaussures</button><button class="filter" data-filter="Accessoires">Accessoires</button></div><div class="search-sort"><input id="search" type="search" placeholder="Rechercher une pièce..." aria-label="Rechercher un produit"><select id="sort" aria-label="Trier les produits"><option value="default">Trier par</option><option value="asc">Prix croissant</option><option value="desc">Prix décroissant</option><option value="az">Nom A–Z</option></select></div></div><p class="results" id="results"></p><div class="product-grid" id="products"><?php foreach($all as $p): include __DIR__.'/../views/card.php'; endforeach; ?></div><p class="empty" id="empty" hidden>Aucun produit ne correspond à ta recherche.</p></section>
<?php elseif ($page==='product'): $p=$products->find((int)($_GET['id']??0)); ?>
<?php if (!$p): ?><div class="section-wrap"><h1>Produit introuvable</h1></div><?php else: ?><section class="product-detail section-wrap"><div class="detail-image"><img src="<?= e(productPhoto($p)) ?>" alt="Photo illustrative : <?= e($p['name']) ?>"></div><div class="detail-copy"><a class="crumb" href="?page=catalog">← Retour à la collection</a><span class="eyebrow"><?= e($p['category']) ?></span><h1><?= e($p['name']) ?></h1><div class="detail-price"><?= money((float)$p['price']) ?></div><p><?= e($p['description']) ?></p><p class="muted">Photographie illustrative. Produit fictif de démonstration.</p><form method="post"><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="action" value="add"><input type="hidden" name="id" value="<?= (int)$p['id'] ?>"><button class="btn dark full">Ajouter au panier +</button></form><div class="detail-benefits">✦ Style sélectionné avec soin<br>♡ Panier modifiable à tout moment</div></div></section><?php endif; ?>
<?php elseif ($page==='cart'): ?>
<section class="section-wrap narrow"><span class="eyebrow">VOTRE SÉLECTION</span><h1>Mon panier <span class="muted">(<?= array_sum($_SESSION['cart'] ?? []) ?>)</span></h1><?php if (!$items): ?><div class="empty-cart"><div>♡</div><h2>Ton panier attend ses coups de cœur</h2><p>Découvre la collection et trouve ta prochaine pièce préférée.</p><a class="btn dark" href="?page=catalog">Voir la collection ↗</a></div><?php else: ?><div class="cart-list"><?php foreach($items as $item): ?><article class="cart-item"><img src="<?= e(productPhoto($item)) ?>" alt="<?= e($item['name']) ?>"><div class="grow"><span class="eyebrow"><?= e($item['category']) ?></span><h3><?= e($item['name']) ?></h3><p><?= money((float)$item['price']) ?></p></div><form method="post" class="quantity"><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><label>Qté <input type="number" name="quantity" min="0" max="99" value="<?= (int)$item['quantity'] ?>"></label><button class="small-btn">Modifier</button></form><form method="post"><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="action" value="remove"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><button class="remove">Retirer ×</button></form></article><?php endforeach; ?></div><div class="cart-summary"><span>Total</span><strong><?= money((float)$total) ?></strong></div><div class="align-right"><a class="btn dark" href="?page=checkout">Passer commande ↗</a></div><?php endif; ?></section>
<?php elseif ($page==='checkout'): ?>
<section class="section-wrap narrow"><span class="eyebrow">DERNIÈRE ÉTAPE</span><h1>Finaliser ma commande</h1><?php if (!$items): ?><p>Ton panier est vide.</p><a href="?page=catalog">Retour à la boutique</a><?php else: ?><p>Total : <strong><?= money((float)$total) ?></strong></p><p class="note">Simulation uniquement : aucun paiement réel ni livraison.</p><?php if($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?><form class="checkout" method="post"><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="action" value="order"><label>Nom complet<input required maxlength="100" name="name" value="<?= e($_POST['name']??'') ?>"></label><label>Adresse e-mail<input required type="email" maxlength="190" name="email" value="<?= e($_POST['email']??'') ?>"></label><button class="btn dark">Confirmer la commande ↗</button></form><?php endif; ?></section>
<?php elseif ($page==='thanks'): ?><section class="section-wrap thanks"><div class="flower">✿</div><h1>Merci pour ta commande !</h1><p>Commande fictive n°<?= (int)($_GET['number']??0) ?> enregistrée.</p><a class="btn dark" href="?page=catalog">Continuer mes achats ↗</a></section>
<?php else: ?><section class="section-wrap"><h1>Page introuvable</h1></section><?php endif; ?>
</main><footer><div class="footer-top"><div><a class="logo" href="?">maison<span>rose</span><small>MODE & ACCESSOIRES</small></a><p>La mode, tout en douceur.</p></div><div><strong>Explorer</strong><a href="?page=catalog">Collection</a><a href="?page=cart">Panier</a></div><div><strong>À propos</strong><p>Projet étudiant PHP POO + MariaDB.<br>Site de démonstration, sans paiement réel.</p></div></div><div class="footer-bottom">© <?= date('Y') ?> Maison Rose · Conçu avec ♡</div></footer></body></html>
