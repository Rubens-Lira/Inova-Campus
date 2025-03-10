<?php

require_once './src/database/Database.php';

class Carrinho {
  private $conn, $carrinho = [], $id, $name, $unit_price, $units = 1, $image, $user;

  public function __construct($db) {
    $this->conn = $db;
    $this->carrinho = $_SESSION['carrinho'] ?? [];
  }

  public function addCarrinho(): void {
    $produtoExiste = false;
    foreach ($this->carrinho as &$item) {
      if ($item['id'] === $this->id) {
        $item['quantidade'] += $this->units;
        $item['valor_total'] = $item['quantidade'] * $item['preco'];
        $item['vendedor'] = $this->user;
        $produtoExiste = true;
        break;
      }
    }
    if (!$produtoExiste) {
      $this->carrinho[] = [
        'id' => $this->id, 'nome' => $this->name, 'preco' => $this->unit_price,
        'imagem' => $this->image, 'quantidade' => $this->units, 'valor_total' => $this->units * $this->unit_price, 'vendedor' => $this->user
      ];
    }
    $_SESSION['carrinho'] = $this->carrinho;
  }

  public function rmCarrinho() {
    foreach ($this->carrinho as &$item) {
      if ($item['id'] === $this->id && $this->units > 0) {
        $item['quantidade'] -= $this->units;
        $item['valor_total'] = $item['quantidade'] * $item['preco'];
        $item['vendedor'] = $this->user;
        break;
      }
    }
    $_SESSION['carrinho'] = $this->carrinho;
  }

  public function getCarrinho(): array {
    return $this->carrinho;
  }

  public function limparCarrinho(): void {
    $_SESSION['carrinho'] = [];
    $this->carrinho = [];
  }

  public function setId(int $id): self { $this->id = $id; return $this; }
  public function setName(string $name): self { $this->name = $name; return $this; }
  public function setImage(string $image): self { $this->image = $image; return $this; }
  public function setUnitPrice(float $unit_price): self { $this->unit_price = $unit_price; return $this; }
  public function setUnits(int $units): self { $this->units = $units; return $this; }
  public function setUser(int $user): self { $this->user = $user; return $this; }
}
