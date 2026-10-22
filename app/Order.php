<?php
class Order {
    public function __construct(private PDO $db) {}
    public function create(string $name,string $email,array $items): int {
        if (!$items) throw new RuntimeException('Panier vide');
        $this->db->beginTransaction();
        try {
            $total=array_sum(array_column($items,'subtotal'));
            $q=$this->db->prepare('INSERT INTO orders (customer_name,customer_email,total) VALUES (?,?,?)');
            $q->execute([$name,$email,$total]); $id=(int)$this->db->lastInsertId();
            $q=$this->db->prepare('INSERT INTO order_items (order_id,product_id,quantity,unit_price) VALUES (?,?,?,?)');
            foreach ($items as $item) $q->execute([$id,$item['id'],$item['quantity'],$item['price']]);
            $this->db->commit(); return $id;
        } catch (Throwable $e) { $this->db->rollBack(); throw $e; }
    }
}
