<?php

require_once './src/database/Database.php';

class Product {
    private $conn;
    public $table = 'inv_products';
    private int $id;
    private string $name;
    private float $price;
    private string $image;
    private int $user;

    public function __construct($db) {
        $this->setConn($db); 
    }

    public function create() {
        $table = $this->table;

        $query = "INSERT INTO {$table} (pdt_name, pdt_unit_price, pdt_img, pdt_user)
            VALUES (:name, :price, :image, :user)";
        $stmt = $this->conn->prepare($query);
        $data = [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'image' => $this->getimage(),
            'user' => $this->getUser()
        ];
        return $stmt->execute($data);
    }

    public function read($id) {
        $table = $this->table;
    
        $query = "SELECT * FROM {$table} WHERE pdt_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function getImageRoute($id) {
        $table = $this->table;
    
        $query = "SELECT pdt_img FROM {$table} WHERE pdt_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function list($offset = 0) {
        $table = $this->table;
    
        $query = "SELECT * FROM {$table} WHERE pdt_user = :id ORDER BY pdt_name ASC LIMIT 20 OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
    
    public function listAll($offset = 0): mixed {
        $table = $this->table;
    
        $query = "SELECT * FROM {$table} ORDER BY pdt_name ASC LIMIT 20 OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function edit() {
        $table = $this->table;
        $id = $this->getId();

        if (!$this->read($id)) return false;

        $query = "UPDATE {$table} SET pdt_name = :name, pdt_unit_price = :price, pdt_img = :image
            WHERE pdt_id = :id";
        $stmt = $this->conn->prepare($query);

        $data = [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'image' => $this->getimage(),
            'id' => $id
        ];

        return $stmt->execute($data);
    }

    public function delete() {
        $table = $this->table;
        $id = $this->getId();
        $query = "DELETE FROM {$table} WHERE pdt_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function getConn() {
        return $this->conn;
    }

    public function setConn($conn): self {
        $this->conn = $conn;
        return $this;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = strip_tags($name);
        return $this;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): self {
        $this->price = $price;
        return $this;
    }

    public function getimage(): string {
        return $this->image;
    }

    public function setimage(string $image): self {
        $this->image = strip_tags($image);
        return $this;
    }

    public function getUser(): int {
        return $this->user;
    }

    public function setUser(int $user): self {
        $this->user = $user;
        return $this;
    }
}