<?php

require_once './src/database/Database.php';

class Carrinho {
  private $conn;
  private $carrinho;

  public function __construct($db) {
    $this->setConn($db); 
    $this->carregarCarrinho();
  }

  public function addCarrinho($id, $name, $unit_price, $units, $user) {
    $produtoExiste = false;

    foreach ($this->carrinho as &$item) { // Adicionado "&" para referenciar o item no array
        if ($item['id'] == $id) {
            $item['quantidade'] += $units; // Incrementa a quantidade
            $item['valor_total'] = $item['quantidade'] * $item['preco']; // Atualiza o valor total
            $item['vendedor'] = $user; // Vendedor do produto
            $produtoExiste = true;
            break;
        }
    }
    unset($item);

    if (!$produtoExiste) {
      $this->carrinho[] = [
          'id' => $id,
          'nome' => $name,
          'preco' => $unit_price,
          'quantidade' => $units,
          'valor_total' => $units * $unit_price,
          'vendedor' => $user
      ];
    }

    $this->salvarCarrinho();
  }

  // Método para carregar o carrinho do cookie
  private function carregarCarrinho() {
    $this->carrinho = isset($_COOKIE['carrinho']) ? json_decode($_COOKIE['carrinho'], true) : [];
  }

  // Método para salvar o carrinho no cookie
  private function salvarCarrinho() {
    setcookie('carrinho', json_encode($this->carrinho), time() + 86400 * 7, "/");
  }

  // Método para obter o carrinho
  public function getCarrinho() {
    return $this->carrinho;
  }

  // Getters e Setters
  public function getConn() {
    return $this->conn;
  }

  public function setConn($conn): self {
    $this->conn = $conn;
    return $this;
  }
}