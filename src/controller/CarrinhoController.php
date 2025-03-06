<?php

require_once "./src/models/Carrinho.php";

class CarrinhoController {
  private $db;
  private Carrinho $carrinho;

  public function __construct() {
    $database = new Database();
    $this->db = $database->getConnection();
    $this->carrinho = new Carrinho($this->db);
  }

  public function addCarrinho() {
    $this->carrinho->setId($_POST["id"])
      ->setName($_POST["name"])
      ->setUnitPrice($_POST["unit_price"])
      ->setUnits($_POST["units"])
      ->setUser($_POST["user"]);
      
    $this->carrinho->addCarrinho();
    header("Location: index.php?action=product-read&id={$_POST['id']}");
    exit;
  }

  public function rmCarrinho($id) {
    $this->carrinho->setId($id);
    $this->carrinho->rmCarrinho();
    header("Location: index.php?action=carrinho");
    exit;
  }
}