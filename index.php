<?php 
if (!isset($_SESSION)) {
    session_start();
}

require_once './src/controller/UserController.php';
require_once './src/controller/ProductController.php';

$UserController = new UserController();
$ProductController = new ProductController();
$action = $_GET['action'] ?? '';

$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] >= 0 
    ? (int) $_GET['id'] 
    : 0;

$offset = isset($_GET['offset']) && is_numeric($_GET['offset']) && $_GET['offset'] >= 0 
    ? (int) $_GET['offset'] 
    : 0;
    
$result = match ($action) {
    'home' => ['view' => './src/views/home.php', 'title' => 'Página Inicial', 'css' => './src/assets/styles/index.css'], // Página principal
    'about' => ['view' => './src/views/about.php', 'title' => 'Sobre'],
    "exemplo" => ['view' => './src/views/exemplo.html', 'title' => 'titulo', 'css' => './src/assets/styles/exemplo.css'],
    'login' => $UserController->login(),
    'user-create' => $UserController->create(), // Cria usuários src/views/user/create.php
    'user-edit' => $UserController->edit(), // Edita usuários src/views/user/edit.php
    'product-create' => $ProductController->create(), // Cria produtos src/views/product/create.php
    'product-list' => $ProductController->list($offset), // Lista os produtos do vendedor
    'product-edit' => $ProductController->edit($id), // Cria edita src/views/product/edit.php
    'product-read' => $ProductController->read($id),
    'user' => ['view' => './src/views/user/user.php', 'title' => 'Perfil'], // Perfil do usuário
    'vendas' => $ProductController->listAll($offset), // Lista os produtos de todos os vendedores
    'logout' => ['view' => './src/config/logout.php', 'title' => 'Saindo'],
    'carrinho' => ['view' => './src/views/product/carrinho.php', 'title' => 'Carrinho'],
    'adicionar_carrinho' => ['view' => './src/views/product/adicionar_carrinho.php', 'title' => 'Carrinho'],
    default => ['view' => './src/views/home.php', 'title' => 'Página Inicial', 'css' => './src/assets/styles/index.css']
};

$view = $result['view'];
$css = $result['css'] ?? '';
$title = $result['title'];
$products = $result['data'] ?? '';
$error = $result['error'] ?? '';

require './src/layout/layout.php';