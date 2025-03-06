<?php

require_once './src/database/Database.php';

class Carrinho {
  private $conn;
  private array $carrinho;
  private int $id;
  private string $name;
  private float $unit_price;
  private int $units;
  private int $user;

  public function __construct($db) {
    $this->setConn($db);

    $this->carregarCarrinho();
  }

  public function addCarrinho(): void {
    $produtoExiste = false;

    foreach ($this->carrinho as &$item) {
      if ($item['id'] === $this->getId()) {
        $item['quantidade'] += $this->getUnits();
        $item['valor_total'] = $item['quantidade'] * $item['preco'];
        $item['vendedor'] = $this->getUser();
        $produtoExiste = true;
        break;
      }
    }

    if (!$produtoExiste) {
      $this->carrinho[] = [
        'id' => $this->getId(),
        'nome' => $this->getName(),
        'preco' => $this->getUnitPrice(),
        'quantidade' => $this->getUnits(),
        'valor_total' => $this->getUnits() * $this->getUnitPrice(),
        'vendedor' => $this->getUser()
      ];
    }

    $this->salvarCarrinho();
  }

  public function rmCarrinho() {
    foreach ($this->carrinho as $key => $item) {
      if ($item['id'] === $this->getId()) {
          unset($this->carrinho[$key]);
          break;
      }
    }

    $this->salvarCarrinho();
  }

  private function carregarCarrinho(): void {
    $this->carrinho = $_SESSION['carrinho'] ?? [];
  }

  private function salvarCarrinho(): void {
    $_SESSION['carrinho'] = $this->carrinho;
  }

  public function getCarrinho(): array {
    return $this->carrinho;
  }

  public function limparCarrinho(): void {
    $_SESSION['carrinho'] = [];
    $this->carrinho = [];
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
    $this->name = $name;
    return $this;
  }

  public function getUnitPrice(): float {
    return $this->unit_price;
  }

  public function setUnitPrice(float $unit_price): self {
    $this->unit_price = $unit_price;
    return $this;
  }

  public function getUnits(): int {
    return $this->units;
  }

  public function setUnits(int $units): self {
    $this->units = $units;
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
