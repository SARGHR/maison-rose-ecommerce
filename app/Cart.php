<?php
class Cart {
    public function __construct() { if (!isset($_SESSION['cart'])) $_SESSION['cart']=[]; }
    public function add(int $id): void { $_SESSION['cart'][$id]=($_SESSION['cart'][$id]??0)+1; }
    public function update(int $id,int $qty): void { if ($qty<=0) unset($_SESSION['cart'][$id]); else $_SESSION['cart'][$id]=min($qty,99); }
    public function remove(int $id): void { unset($_SESSION['cart'][$id]); }
    public function clear(): void { $_SESSION['cart']=[]; }
    public function items(Product $products): array {
        $result=[];
        foreach ($_SESSION['cart'] as $id=>$qty) { $p=$products->find((int)$id); if ($p) { $p['quantity']=$qty; $p['subtotal']=$p['price']*$qty; $result[]=$p; } }
        return $result;
    }
}
