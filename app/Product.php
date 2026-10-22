<?php
class Product {
    public function __construct(private PDO $db) {}
    public function all(): array { return $this->db->query('SELECT * FROM products ORDER BY id')->fetchAll(); }
    public function find(int $id): array|false {
        $q=$this->db->prepare('SELECT * FROM products WHERE id=?'); $q->execute([$id]); return $q->fetch();
    }
}
