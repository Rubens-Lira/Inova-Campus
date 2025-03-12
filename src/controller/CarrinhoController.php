<?php

require_once "./src/models/Carrinho.php";

class CarrinhoController {
  private Carrinho $carrinho;

  public function __construct() {
    $this->carrinho = new Carrinho();
  }

  public function addCarrinho() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->carrinho
      ->setId($_POST["id"])
      ->setName($_POST["name"])
      ->setImage($_POST["image"])
      ->setUnitPrice($_POST["unit_price"])
      ->setUser($_POST["user"])
      ->setPhone($_POST["phone"]);
      
      $this->carrinho->addCarrinho();
      header("Location: index.php?action=carrinho");
      exit;
    }
  }

  public function rmCarrinho() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->carrinho
      ->setId($_POST["id"])
      ->setName($_POST["name"])
      ->setImage($_POST["image"])
      ->setUnitPrice($_POST["unit_price"])
      ->setUser($_POST["user"])
      ->setPhone($_POST["phone"]);
      
      $this->carrinho->rmCarrinho();
      header("Location: index.php?action=carrinho");
      exit;
    }
  }

  public function limparCarrinho() {
    $this->limparCarrinho();
  }

  // public function rmCarrinho($id) {
  //   $this->carrinho->setId($id);
  //   $this->carrinho->rmCarrinho();
  //   header("Location: index.php?action=carrinho");
  //   exit;
  // }


}